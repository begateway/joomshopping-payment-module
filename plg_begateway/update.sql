INSERT IGNORE INTO `#__jshopping_payment_method`
SET
  `payment_id`            = '10000',
	`payment_code`          = 'begateway',
	`payment_class`         = 'pm_begateway',
	`scriptname`            = 'pm_begateway',
	`payment_publish`       = 0,
	`payment_ordering`      = 0,
  `payment_params`        = "domain_gateway=\ndomain_checkout=\nshop_id=\nshop_secret_key=\ntransaction_end_status=6\ntransaction_pending_status=1\ntransaction_failed_status=3\ncheckdatareturn=1",
	`payment_type`          = 2,
	`price`                 = 0.00,
	`price_type`            = 1,
	`tax_id`                = -1,
	`show_descr_in_email`   = 0,
	`name_en-GB`            = 'Credit or debit card',
	`name_de-DE`            = 'Kredit-oder Debitkarte'
;
