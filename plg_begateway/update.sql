INSERT IGNORE INTO `#__jshopping_payment_method`
SET
	`payment_code`          = 'begateway',
	`payment_class`         = 'pm_begateway',
	`scriptname`            = 'pm_begateway',
	`payment_publish`       = 0,
	`payment_ordering`      = 0,
  `payment_params`        = "domain_checkout=checkout.begateway.com\nshop_id=361\nshop_secret_key=b8647b68898b084b836474ed8d61ffe117c9a01168d867f24953b776ddcb134d\ntransaction_end_status=6\ntransaction_pending_status=1\ntransaction_failed_status=3\ntransaction_type=payment\nenable_bankcard=1\nenable_bankcard_halva=0\nenable_erip=0\ntest_mode=1\nwidget_css=\nshop_public_key=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArO7bNKtnJgCn0PJVn2X7QmhjGQ2GNNw412D+NMP4y3Qs69y6i5T/zJBQAHwGKLwAxyGmQ2mMpPZCk4pT9HSIHwHiUVtvdZ/78CX1IQJON/Xf22kMULhquwDZcy3Cp8P4PBBaQZVvm7v1FwaxswyLD6WTWjksRgSH/cAhQzgq6WC4jvfWuFtn9AchPf872zqRHjYfjgageX3uwo9vBRQyXaEZr9dFR+18rUDeeEzOEmEP+kp6/Pvt3ZlhPyYm/wt4/fkk9Miokg/yUPnk3MDU81oSuxAw8EHYjLfF59SWQpQObxMaJR68vVKH32Ombct2ZGyzM7L5Tz3+rkk7C4z9oQIDAQAB",
	`payment_type`          = 2,
	`price`                 = 0.00,
	`price_type`            = 1,
	`tax_id`                = -1,
	`show_descr_in_email`   = 0,
	`name_en-GB`            = 'Credit or debit card',
	`name_de-DE`            = 'Kredit-oder Debitkarte'
;
