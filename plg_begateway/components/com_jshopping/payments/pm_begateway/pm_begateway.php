<?php
/*
 * @version      1.55
 * @author       eComCharge Ltd SIA
 * @package      pm_begateway
 * @copyright    Copyright (C) 2014
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

if (!class_exists('\beGateway\Settings'))
  require_once dirname(__FILE__) . '/begateway-api-php/lib/beGateway.php';

class pm_begateway extends PaymentRoot {

  private $_verify_request = null;

  function __construct() {
    $jshopConfig = JSFactory::getConfig();

    JSFactory::loadExtLanguageFile('pm_begateway');
  }

  function showPaymentForm($params, $pmconfigs){
    include(dirname(__FILE__)."/paymentform.php");
  }

  static function sendToLog($message) {
    saveToLog("payment.log", $message);
  }

  //function call in admin
  function showAdminFormParams($params){
    $array_params = array(
      'domain_gateway', 'domain_checkout', 'shop_id', 'shop_secret_key',
      'transaction_end_status', 'transaction_pending_status',
      'transaction_failed_status');

    foreach ($array_params as $key){
      if (!isset($params[$key])) $params[$key] = '';
    }
    $orders = JModelLegacy::getInstance('orders', 'JshoppingModel'); //admin model
    include(dirname(__FILE__)."/adminparamsform.php");
  }

  function checkTransaction($pmconfigs, $order, $act){
    $jshopConfig = JSFactory::getConfig();

    if ($act == 'return') {
      if ($this->_verify_request == null) {
        $this->_query_pm($pmconfigs,JFactory::getApplication()->input->get('uid','0','STRING'));
      }
    }
    if ($act == 'notify') {
      $this->_init_pm($pmconfigs);
      $this->_verify_request = new \beGateway\Webhook();
      if (!$this->_verify_request->isAuthorized()) {
        $this->sendToLog("Status pending. Order ID ".$order->order_id.". Webhook authorization error.");
        return array(0, 'Error to authorize webhook. Order ID: '.$order->order_id);
      }
    }

    $verify_request = $this->_verify_request;

    $tracking_id_parts = explode('|',$verify_request->getTrackingId());

    $errors = 0;
    if ($verify_request->isError()) {
      $this->sendToLog('Error to verify order. Message: '. $verify_request->getMessage() . '. Order ID: '.$order->order_id);
      $errors += 1;
    }

    if ($tracking_id_parts[1] != $order->order_total) {
      $this->sendToLog("Status pending. Order ID ".$order->order_id.". Error amount.");
      $errors += 1;
    }

    if ($tracking_id_parts[2] != $order->currency_code_iso) {
      $this->sendToLog("Status pending. Order ID ".$order->order_id.". Error currency.");
      $errors += 1;
    }

    if ($act == 'return' && $verify_request->getStatus() != JFactory::getApplication()->input->get('status','0','STRING')) {
      $this->sendToLog("Status pending. Order ID ".$order->order_id.". Error status.");
      $errors += 1;
    }

    if ($tracking_id_parts[0] != $order->order_id) {
      $this->sendToLog("Status pending. Order ID ".$order->order_id.". Error order id.");
      $errors += 1;
    }

    if ($errors > 0) {
      return array(0, 'Error to verify order. Order ID: '.$order->order_id);
    }

    $order_info = '';

    if ($verify_request->isTest()) {
      $order_info .= PHP_EOL . _JSHOP_BEGATEWAY_TEST_ORDER . PHP_EOL;
    }
    $order_info .= PHP_EOL . 'UID: ' . $verify_request->getUid() . PHP_EOL;

    if (preg_match('/' . $verify_request->getUid() . '/', $order->order_add_info) != 1) {
      $order->order_add_info .= $order_info;
    }

    if ($verify_request->isSuccess()) {
      $order->store();
      return array(1, '', $verify_request->getUid());
    }

    if ($verify_request->isFailed()) {
      $order->store();
      return array(3, 'Status Failed. Order ID ' . $order->order_id, $verify_request->getUid());
    }

    if ($verify_request->isIncomplete()) {
      return array(2, 'Status Pending. Order ID ' . $order->order_id, $verify_request->getUid());
    }

    return array(0, "Error response. Order ID " . $order->order_id);
  }

  function showEndForm($pmconfigs, $order){
    $jshopConfig = JSFactory::getConfig();
    $item_name = sprintf(_JSHOP_PAYMENT_NUMBER, $order->order_number);

    $uri = JURI::getInstance();

    $notify_url = JURI::root()."index.php?option=com_jshopping&controller=checkout&task=step7&act=notify&js_paymentclass=pm_begateway&no_lang=1";
    $notify_url = str_replace('carts.local', 'webhook.begateway.com:8443', $notify_url);

    $return = JURI::root()."index.php?option=com_jshopping&controller=checkout&task=step7&act=return&js_paymentclass=pm_begateway";
    $cancel_return = JURI::root()."index.php?option=com_jshopping&controller=checkout&task=step7&act=cancel&js_paymentclass=pm_begateway";
    $cancel_return = JURI::root()."index.php?option=com_jshopping&controller=checkout&task=step5&act=cancel&js_paymentclass=pm_begateway";

    $_country = JTable::getInstance('country', 'jshop');
    $_country->load($order->d_country);
    $country = $_country->country_code_2;
    $language = explode('-',JFactory::getLanguage()->getTag());
    $language = $language[0];

    $this->_init_pm($pmconfigs);
    $token = new \beGateway\GetPaymentToken();
    $token->money->setAmount($order->order_total);
    $token->money->setCurrency($order->currency_code_iso);
    $token->setTrackingId("$order->order_id|$order->order_total|$order->currency_code_iso");
    $token->setDescription($item_name);
    $token->setLanguage($language);
    $token->setNotificationUrl($notify_url);
    $token->setSuccessUrl($return);
    $token->setDeclineUrl($cancel_return);
    $token->setFailUrl($cancel_return);
    $token->setCancelUrl($cancel_return);

    $token->customer->setFirstName($order->d_f_name);
    $token->customer->setLastName($order->d_l_name);
    $token->customer->setCountry($country);
    $token->customer->setAddress($order->d_street);
    $token->customer->setCity($order->d_city);
    $token->customer->setZip($order->d_zip);

    if (strlen($order->email) > 0)
      $token->customer->setEmail($order->email);

    if (in_array($country, array('US', 'CA') )) {
      $token->customer->setState($order->d_state);
    }
    $token->setAddressHidden();
    $response = $token->submit();

?>
        <html>
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        </head>
        <body>
<?php
    if ($response->isSuccess()) {
?>
        <form id="paymentform" action="<?php echo $response->getRedirectUrlScriptName(); ?>" name = "paymentform" method = "post">
          <input type='hidden' name='token' value='<?php print $response->getToken(); ?>'>
        </form>
        <?php print _JSHOP_REDIRECT_TO_PAYMENT_PAGE?>
        <br>
        <script type="text/javascript">document.getElementById('paymentform').submit();</script>
<?php
    } else {
      print _JSHOP_ERROR_PAYMENT . ': ' . $response->getMessage();
    }
?>
        </body>
        </html>
<?php
    die();
  }

  function _query_pm($pmconfigs,$uid) {
    $this->_init_pm($pmconfigs);
    $query = new \beGateway\QueryByUid();
    $query->setUid($uid);
    $this->_verify_request = $query->submit();
  }

  function _init_pm($pmconfigs) {
    \beGateway\Settings::$gatewayBase = 'https://' . $pmconfigs['domain_gateway'];
    \beGateway\Settings::$checkoutBase = 'https://' . $pmconfigs['domain_checkout'];
    \beGateway\Settings::$shopId = $pmconfigs['shop_id'];
    \beGateway\Settings::$shopKey = $pmconfigs['shop_secret_key'];
  }

  function getUrlParams($pmconfigs){
    $params = array();
    $params['order_id'] = 0;
    if ($this->_verify_request == null) {
      $uid = JFactory::getApplication()->input->get('uid','0','STRING');
      if ($uid != '0') {
        # try to query by UID
        $this->_query_pm($pmconfigs,JFactory::getApplication()->input->get('uid','0','STRING'));
        $params['order_id'] = $this->_verify_request->getTrackingId();
      }else{
        # try to process webhook
        $this->_init_pm($pmconfigs);
        $this->_verify_request = new \beGateway\Webhook();
        $params['order_id'] = $this->_verify_request->getTrackingId();
      }
    }
    $params['hash'] = "";
    $params['checkHash'] = 0;
    $params['checkReturnParams'] = $pmconfigs['checkdatareturn'];
    return $params;
  }
}
?>
