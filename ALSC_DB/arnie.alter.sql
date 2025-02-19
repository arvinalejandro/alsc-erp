
DROP TABLE IF EXISTS `option_account_invoice_type`;

CREATE TABLE `option_account_invoice_type` (
  `option_account_invoice_type_id` varchar(50) NOT NULL,
  `option_account_invoice_type_code` varchar(50) DEFAULT NULL,
  `option_account_invoice_type_name` varchar(50) DEFAULT NULL,
  `option_account_invoice_type_order` tinyint(3) unsigned DEFAULT NULL,
  `option_account_invoice_type_key` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`option_account_invoice_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_invoice_type` */

insert  into `option_account_invoice_type`(`option_account_invoice_type_id`,`option_account_invoice_type_code`,`option_account_invoice_type_name`,`option_account_invoice_type_order`,`option_account_invoice_type_key`) values ('billing_document','BD','Billing Documents',NULL,'other'),('club_house','CH','Club House',NULL,'other'),('credit_to_principal','Prin','Credit To Principal',NULL,'0'),('deffered_cash','DC','Deffered Payment',NULL,'0'),('earnest','EN','Earnest',NULL,'rsv'),('misc','Misc.','Miscellaneous',NULL,'0'),('monthly_amortization','MA','Monthly Amortization',NULL,'0'),('monthly_dp','PD','Monthly Down Payment',NULL,'0'),('parking_sticker','PS','Parking Sticker',NULL,'other'),('reservation','RV','Reservation',NULL,'rsv'),('retention','RT','Retention',NULL,'0'),('scattered','SC','Scattered',NULL,'0'),('spot_cash','Spot Cash','Spot Cash',NULL,'0');

/*Table structure for table `option_account_status` */

DROP TABLE IF EXISTS `option_account_status`;

CREATE TABLE `option_account_status` (
  `option_account_status_id` varchar(20) NOT NULL,
  `option_account_status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_account_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_status` */

insert  into `option_account_status`(`option_account_status_id`,`option_account_status_name`) values ('deffered_cash','Defferred Cash Payment'),('ejected','Ejected/Foreclosed'),('fully_paid','Fully Paid'),('monthly_amortization','Monthly Amortization'),('partial_dp','Partial Downpayment'),('reservation','Reservation'),('retention','Retention');
