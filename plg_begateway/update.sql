INSERT INTO `#__jshopping_payment_method`
(
  `payment_code`,
  `payment_class`,
  `scriptname`,
  `payment_publish`,
  `payment_ordering`,
  `payment_params`,
  `payment_type`,
  `price`,
  `price_type`,
  `tax_id`,
  `show_descr_in_email`,
  `name_en-GB`,
  `name_de-DE`
)
SELECT
  'begateway',
  'pm_begateway',
  'pm_begateway',
  0,
  0,
  '{"domain_checkout":"checkout.begateway.com","shop_id":"361","shop_secret_key":"b8647b68898b084b836474ed8d61ffe117c9a01168d867f24953b776ddcb134d","transaction_end_status":"6","transaction_pending_status":"1","transaction_failed_status":"3","transaction_type":"payment","enable_bankcard":"1","enable_bankcard_halva":"0","enable_erip":"0","test_mode":"1","widget_css":"","shop_public_key":"MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArO7bNKtnJgCn0PJVn2X7QmhjGQ2GNNw412D+NMP4y3Qs69y6i5T/zJBQAHwGKLwAxyGmQ2mMpPZCk4pT9HSIHwHiUVtvdZ/78CX1IQJON/Xf22kMULhquwDZcy3Cp8P4PBBaQZVvm7v1FwaxswyLD6WTWjksRgSH/cAhQzgq6WC4jvfWuFtn9AchPf872zqRHjYfjgageX3uwo9vBRQyXaEZr9dFR+18rUDeeEzOEmEP+kp6/Pvt3ZlhPyYm/wt4/fkk9Miokg/yUPnk3MDU81oSuxAw8EHYjLfF59SWQpQObxMaJR68vVKH32Ombct2ZGyzM7L5Tz3+rkk7C4z9oQIDAQAB"}',
  2,
  0.00,
  1,
  -1,
  0,
  'Credit or debit card',
  'Kredit-oder Debitkarte'
WHERE NOT EXISTS (
  SELECT 1 FROM `#__jshopping_payment_method` WHERE `payment_class` = 'pm_begateway'
);
