<?php
/**
 * @version      1.00
 * @author       eComCharge Ltd SIA
 * @package      pm_begateway
 * @copyright    Copyright (C) 2015
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

define(_JSHOP_BEGATEWAY_TEST_ORDER, 'Test payment');
define(_JSHOP_BEGATEWAY_DOMAIN_GATEWAY, 'Payment gateway domain');
define(_JSHOP_BEGATEWAY_DOMAIN_CHECKOUT, 'Payment page domain');
define(_JSHOP_BEGATEWAY_SHOP_ID, 'Shop Id');
define(_JSHOP_BEGATEWAY_SHOP_SECRET_KEY, 'Shop secret key');
define(_JSHOP_BEGATEWAY_TRANSACTION_END_DESCRIPTION,'Select the order status to which the actual order is set, if the beGateway webhook notification was successful.');
define(_JSHOP_BEGATEWAY_TRANSACTION_PENDING_DESCRIPTION,'The order Status to which Orders are set, which have no completed Payment Transaction.');
define(_JSHOP_BEGATEWAY_TRANSACTION_FAILED_DESCRIPTION,'Select an order status for failed beGateway transactions.');
define(_JSHOP_BEGATEWAY_CHECK_DATA_RETURN, 'Verify data after beGateway RETURN');
define(_JSHOP_BEGATEWAY_SHOP_ID_DESCRIPTION, '');
define(_JSHOP_BEGATEWAY_SHOP_SECRET_KEY_DESCRIPTION, '');
define(_JSHOP_BEGATEWAY_DOMAIN_GATEWAY_DESCRIPTION, '');
define(_JSHOP_BEGATEWAY_DOMAIN_CHECKOUT_DESCRIPTION, '');
define(_JSHOP_BEGATEWAY_TEST_MODE, 'Enable test mode');
?>
