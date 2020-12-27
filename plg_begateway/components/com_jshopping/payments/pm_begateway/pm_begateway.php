<?php
/*
 * @version      2.0.0
 * @author       eComCharge LLC
 * @package      pm_begateway
 * @copyright    Copyright (C) 2020
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__) . '/begateway-api-php/lib/BeGateway.php';

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
      'domain_checkout', 'shop_id', 'shop_secret_key', 'shop_public_key',
      'widget_css',
      'transaction_end_status', 'transaction_pending_status', 'transaction_type',
      'transaction_failed_status',
      'test_mode', 'enable_bankcard', 'enable_bankcard_halva', 'enable_erip'
    );

    if (!isset($params['test_mode'])) {
      $params['test_mode'] = 1;
    }
    if (!isset($params['enable_bankcard'])) {
      $params['enable_bankcard'] = 1;
    }
    if (!isset($params['transaction_type'])) {
      $params['transaction_type'] = 'payment';
    }
    
    foreach ($array_params as $key){
      if (!isset($params[$key])) $params[$key] = '';
    }
    $orders = JModelLegacy::getInstance('orders', 'JshoppingModel'); //admin model
    include(dirname(__FILE__)."/adminparamsform.php");
  }

  function checkTransaction($pmconfigs, $order, $act){
    $jshopConfig = JSFactory::getConfig();

    if ($act != 'notify') {
      return;
    }

    $this->_init_pm($pmconfigs);
    $this->_verify_request = new \BeGateway\Webhook();
    if (!$this->_verify_request->isAuthorized()) {
      $this->sendToLog("Status pending. Order ID ".$order->order_id.". Webhook authorization error.");
      return array(0, 'Error to authorize webhook. Order ID: '.$order->order_id);
    }

    $verify_request = $this->_verify_request;

    $tracking_id_parts = explode('|',$verify_request->getTrackingId());

    $errors = 0;
    if ($verify_request->isError()) {
      $this->sendToLog('Error to verify order. Message: '. $verify_request->getMessage() . '. Order ID: '.$order->order_id);
      $errors += 1;
    }

    if ($tracking_id_parts[1] != $order->order_total) {
      $this->sendToLog("Status pending. Order ID ".$order->order_id.". Amount mismatch.");
      $errors += 1;
    }

    if ($tracking_id_parts[2] != $order->currency_code_iso) {
      $this->sendToLog("Status pending. Order ID ".$order->order_id.". Currency mismatch.");
      $errors += 1;
    }

    if ($tracking_id_parts[0] != $order->order_id) {
      $this->sendToLog("Status pending. Order ID ".$order->order_id.". Order Id mismatch.");
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

    if ($verify_request->isIncomplete() || $verify_request->isPending()) {
      return array(2, 'Status Pending. Order ID ' . $order->order_id, $verify_request->getUid());
    }

    return array(0, "Error response. Order ID " . $order->order_id);
  }

  function showEndForm($pmconfigs, $order){
    $jshopConfig = JSFactory::getConfig();
    $item_name = sprintf(_JSHOP_PAYMENT_NUMBER, $order->order_number);

    $uri = JURI::getInstance();

    $notify_url = JURI::root()."index.php?option=com_jshopping&controller=checkout&task=step7&act=notify&js_paymentclass=pm_begateway&no_lang=1&order_id={$order->order_id}";
    $notify_url = str_replace('0.0.0.0', 'webhook.begateway.com:8443', $notify_url);

    $return = JURI::root()."index.php?option=com_jshopping&controller=checkout&task=step7&act=return&js_paymentclass=pm_begateway&order_id={$order->order_id}";
    $cancel_return = JURI::root()."index.php?option=com_jshopping&controller=checkout&task=step7&act=cancel&js_paymentclass=pm_begateway";
    $cancel_return = JURI::root()."index.php?option=com_jshopping&controller=checkout&task=step5&act=cancel&js_paymentclass=pm_begateway";

    $_country = JTable::getInstance('country', 'jshop');
    $_country->load($order->d_country);
    $country = $_country->country_code_2;
    $language = explode('-',JFactory::getLanguage()->getTag());
    $language = $language[0];

    $this->_init_pm($pmconfigs);
    $token = new \BeGateway\GetPaymentToken();
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
    $token->setTestMode($pmconfigs['test_mode'] == 1);

    if ($pmconfigs['transaction_type'] == 'authorization') {
      $token->setAuthorizationTransactionType();
    }

    if ($pmconfigs['enable_bankcard'] == 1) {
      $cc = new \BeGateway\PaymentMethod\CreditCard;
      $token->addPaymentMethod($cc);
    }

    if ($pmconfigs['enable_bankcard_halva'] == 1) {
      $halva = new \BeGateway\PaymentMethod\CreditCardHalva;
      $token->addPaymentMethod($halva);
    }

    if ($pmconfigs['enable_erip'] == 1) {
      $erip = new \BeGateway\PaymentMethod\Erip(array(
        'order_id' => $order->order_id,
        'account_number' => strval($order->order_id)
      ));
      $token->addPaymentMethod($erip);
    }

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

    $data = JApplicationHelper::parseXMLInstallFile($jshopConfig->admin_path."jshopping.xml");
    $token->additional_data->setMeta(
      [
        'cms' => 'JoomShopping',
        'version'   => $data['version']
      ]
    );

    $response = $token->submit();
?>
        <html>
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        </head>
        <body>
<?php
    if ($response->isSuccess()) {
      $url = explode('.', trim($pmconfigs['domain_checkout']));
      $url[0] = 'js';
      $url = 'https://' . implode('.', $url) . '/widget/be_gateway.js';

      // save token along with payment params
      $pm_params = $order->getPaymentParamsData();
      $pm_params['begateway_payment_token'] = $response->getToken();
      $order->setPaymentParamsData($pm_params);
      $order->store();

?>
<script src="<?php echo $url; ?>"></script>
<script>
  this.start_begateway_payment = function () {
    var params = {
      checkout_url: "<?= \BeGateway\Settings::$checkoutBase; ?>",
      token: "<?php echo $response->getToken(); ?>",
      style: {
        <?php echo $pmconfigs['widget_css']; ?>
      },
      closeWidget: function(status) {
        if (status == null) {
          window.location.replace("<?= $cancel_url ?>");
        }
      }
    };
    new BeGateway(params).createWidget();
  };
  window.onload = start_begateway_payment();
 </script>
<?php
      print _JSHOP_REDIRECT_TO_PAYMENT_PAGE;
    } else {
      print _JSHOP_ERROR_PAYMENT . ': ' . $response->getMessage();
    }
?>
        </body>
        </html>
<?php
    die();
  }

  function _init_pm($pmconfigs) {
    \BeGateway\Settings::$gatewayBase = 'https://' . $pmconfigs['domain_gateway'];
    \BeGateway\Settings::$checkoutBase = 'https://' . $pmconfigs['domain_checkout'];
    \BeGateway\Settings::$shopId = $pmconfigs['shop_id'];
    \BeGateway\Settings::$shopKey = $pmconfigs['shop_secret_key'];
    \BeGateway\Settings::$shopPubKey = $pmconfigs['shop_public_key'];
  }

  function getUrlParams($pmconfigs){
    $params = array();
    $params['order_id'] = JFactory::getApplication()->input->getInt('order_id');
    $params['hash'] = "";
    $params['checkHash'] = 0;
    $params['checkReturnParams'] = 0;
    return $params;
  }
}
?>
