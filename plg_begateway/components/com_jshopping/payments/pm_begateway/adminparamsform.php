<?php
/**
 * @version      2.1.0
 * @author       eComCharge LLC
 * @package      pm_begateway
 * @copyright    Copyright (C) 2020
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

$transaction_types = array();
$transaction_types[] = JHTML::_('select.option', 'payment',_JSHOP_BEGATEWAY_TRANSACTION_TYPE_PAYMENT, 'id', 'name');
$transaction_types[] = JHTML::_('select.option', 'authorization',_JSHOP_BEGATEWAY_TRANSACTION_TYPE_AUTHORIZATION, 'id', 'name');

?>
<div class="col100">
<fieldset class="adminform">
<table class="admintable" width = "100%" >
 <tr>
   <td  class="key">
     <?php echo _JSHOP_BEGATEWAY_DOMAIN_CHECKOUT;?>
   </td>
   <td>
     <input type = "text" class = "inputbox" name = "pm_params[domain_checkout]" size="45" value = "<?php echo $params['domain_checkout']?>" />
     <?php echo \JSHelperAdmin::tooltip(_JSHOP_BEGATEWAY_DOMAIN_CHECKOUT_DESCRIPTION);?>
   </td>
 </tr>
 <tr>
   <td  class="key">
     <?php echo _JSHOP_BEGATEWAY_SHOP_ID;?>
   </td>
   <td>
     <input type = "text" class = "inputbox" name = "pm_params[shop_id]" size="45" value = "<?php echo $params['shop_id']?>" />
     <?php echo \JSHelperAdmin::tooltip(_JSHOP_BEGATEWAY_SHOP_ID_DESCRIPTION);?>
   </td>
 </tr>
  <tr>
    <td  class="key">
      <?php echo _JSHOP_BEGATEWAY_SHOP_SECRET_KEY;?>
    </td>
    <td>
      <input type = "text" class = "inputbox" name = "pm_params[shop_secret_key]" size="45" value = "<?php echo $params['shop_secret_key']?>" />
      <?php echo \JSHelperAdmin::tooltip(_JSHOP_BEGATEWAY_SHOP_SECRET_KEY_DESCRIPTION);?>
    </td>
  </tr>
  <tr>
    <td  class="key">
      <?php echo _JSHOP_BEGATEWAY_WIDGET_CSS;?>
    </td>
    <td>
      <input type = "text" class = "inputbox" name = "pm_params[widget_css]" size="45" value = "<?php echo $params['widget_css']?>" />
      <?php echo \JSHelperAdmin::tooltip(_JSHOP_BEGATEWAY_WIDGET_CSS_DESCRIPTION);?>
    </td>
  </tr>
 <tr>
   <td class="key">
     <?php echo _JSHOP_BEGATEWAY_TRANSACTION_TYPE;?>
   </td>
   <td>
     <?php
     print JHTML::_('select.genericlist', $transaction_types, 'pm_params[transaction_type]', 'class = "inputbox" size = "1"', 'id', 'name', $params['transaction_type'] );
     echo " ".\JSHelperAdmin::tooltip(_JSHOP_BEGATEWAY_TRANSACTION_TYPE_DESCRIPTION);
     ?>
   </td>
 </tr>
 <tr>
   <td class="key">
     <?php echo \JText::_('JSHOP_TRANSACTION_END');?>
   </td>
   <td>
     <?php
     print JHTML::_('select.genericlist', $orders->getAllOrderStatus(), 'pm_params[transaction_end_status]', 'class = "inputbox" size = "1"', 'status_id', 'name', $params['transaction_end_status'] );
     echo " ".\JSHelperAdmin::tooltip(_JSHOP_BEGATEWAY_TRANSACTION_END_DESCRIPTION);
     ?>
   </td>
 </tr>
 <tr>
   <td class="key">
     <?php echo \JText::_('JSHOP_TRANSACTION_PENDING');?>
   </td>
   <td>
     <?php
     echo JHTML::_('select.genericlist',$orders->getAllOrderStatus(), 'pm_params[transaction_pending_status]', 'class = "inputbox" size = "1"', 'status_id', 'name', $params['transaction_pending_status']);
     echo " ".\JSHelperAdmin::tooltip(_JSHOP_BEGATEWAY_TRANSACTION_PENDING_DESCRIPTION);
     ?>
   </td>
 </tr>
 <tr>
   <td class="key">
     <?php echo \JText::_('JSHOP_TRANSACTION_FAILED');?>
   </td>
   <td>
     <?php
     echo JHTML::_('select.genericlist',$orders->getAllOrderStatus(), 'pm_params[transaction_failed_status]', 'class = "inputbox" size = "1"', 'status_id', 'name', $params['transaction_failed_status']);
     echo " ".\JSHelperAdmin::tooltip(_JSHOP_BEGATEWAY_TRANSACTION_FAILED_DESCRIPTION);
     ?>
   </td>
 </tr>
 <tr>
   <td class="key">
     <?php echo _JSHOP_BEGATEWAY_ENABLE_BANKCARD;?>
   </td>
   <td>
     <?php
     print JHTML::_('select.booleanlist', 'pm_params[enable_bankcard]', 'class = "inputbox"', $params['enable_bankcard']);
     ?>
   </td>
 </tr>
 <tr>
   <td class="key">
     <?php echo _JSHOP_BEGATEWAY_ENABLE_BANKCARD_HALVA;?>
   </td>
   <td>
     <?php
     print JHTML::_('select.booleanlist', 'pm_params[enable_bankcard_halva]', 'class = "inputbox"', $params['enable_bankcard_halva']);
     ?>
   </td>
 </tr>
 <tr>
   <td class="key">
     <?php echo _JSHOP_BEGATEWAY_ENABLE_ERIP;?>
   </td>
   <td>
     <?php
     print JHTML::_('select.booleanlist', 'pm_params[enable_erip]', 'class = "inputbox"', $params['enable_erip']);
     ?>
   </td>
 </tr>
 <tr>
   <td class="key">
     <?php echo _JSHOP_BEGATEWAY_TEST_MODE;?>
   </td>
   <td>
     <?php
     print JHTML::_('select.booleanlist', 'pm_params[test_mode]', 'class = "inputbox"', $params['test_mode']);
     ?>
   </td>
 </tr>
</table>
</fieldset>
</div>
<div class="clr"></div>
