


insert  into `option_scheme_finance_type`(`option_scheme_finance_type_id`,`option_scheme_finance_type_name`) values ('bank','Bank'),('in_house','In House');
insert  into `option_account_status`(`option_account_status_id`,`option_account_status_name`) values ('bank','Bank'),('back_out','Backed Out');

alter table `alsc`.`client_account` drop column `commission_scheme_type`,change `commission_scheme_finance_type` `option_scheme_finance_type_id` varchar(25) character set utf8 collate utf8_general_ci NULL ;
alter table `alsc`.`commission_scheme_range` change `commission_scheme_finance_type` `option_scheme_finance_type_id` varchar(25) character set utf8 collate utf8_general_ci NULL ;
alter table `alsc`.`commission_scheme_range` change `commission_scheme_range_sequence` `commission_scheme_range_sequence` int(3) UNSIGNED NULL ;
insert into `option_agent_position`(`option_agent_position_id`,`option_agent_position_name`,`agent_commission_scheme`) values ( 'vp_sales','VP Sales','new');
alter table `alsc`.`commission_percentage` change `commission_agent` `option_agent_position_id` varchar(50) character set utf8 collate utf8_general_ci NULL ;
alter table `alsc`.`agent_sales_manager` change `agent_sales_manager` `agent_sales_manager_id` bigint(15) UNSIGNED NOT NULL AUTO_INCREMENT;




insert  into `commission_percentage`(`commission_percentage_id`,`commission_scheme_id`,`option_agent_position_id`,`client_account_column`,`commission_scheme_heirarchy`,`commission_percentage`) values (1,'new_property_consultant','property_consultant','agent_id',1,3.00),(2,'new_property_consultant','sales_manager','sales_manager_id',2,1.75),(3,'new_property_consultant','sales_director','saled_director_id',3,1.00),(4,'new_property_consultant','vp_sales','0',4,0.25),(5,'new_sales_director','sales_director','saled_director_id',1,1.00),(6,'new_sales_director','vp_sales','0',2,0.25),(7,'new_sales_manager','sales_manager','sales_manager_id',1,1.75),(8,'new_sales_manager','sales_director','saled_director_id',2,1.00),(9,'new_sales_manager','vp_sales','0',3,0.25),(10,'new_vp_sales','vp_sales','0',1,5.00),(11,'old_broker','broker','agent_id',1,7.00),(12,'old_avp','avp','avp_id',1,6.00),(13,'old_avp_ma','avp','avp_id',2,3.00),(14,'old_avp_ma','marketing_associate','agent_id',1,3.00),(15,'old_avp_sm','avp','avp_id',2,1.00),(16,'old_avp_sm','old_sales_manager','sales_manager_id',1,5.00),(17,'old_avp_sm_ma','avp','avp_id',3,1.00),(18,'old_avp_sm_ma','old_sales_manager','sales_manager_id',2,2.00),(19,'old_avp_sm_ma','marketing_associate','agent_id',1,3.00);

drop table `alsc`.`option_cashflow_type`;

alter table `alsc`.`bank_transaction` change `option_cashflow_type_id` `option_bank_transaction_type_id` varchar(25) character set utf8 collate utf8_general_ci NULL , change `bank_transaction_amount` `bank_transaction_amount` double(15,2) UNSIGNED NULL , change `option_bank_transaction_source_id` `option_bank_transaction_category_id` varchar(25) character set utf8 collate utf8_general_ci NULL ;
alter table `alsc`.`account_payable_item_detail` add column `jv_entry` tinyint(1) DEFAULT '0' NULL after `tax_payed`,change `tax_payed` `tax_payed` tinyint(1) UNSIGNED default '0' NULL ;
alter table `alsc`.`account_payable_item_detail` change `project_id` `project_id` bigint(10) UNSIGNED default '0' NULL , change `project_site_id` `project_site_id` bigint(10) UNSIGNED default '0' NULL , change `jv_entry` `jv_entry` tinyint(1) UNSIGNED default '0' NULL ;
alter table `alsc`.`client_account_agent` add column `client_account_agent_commission_contingency` double(5,2) NULL after `client_account_agent_commission_tax_amount`,change `client_account_agent_commission_tax_amount` `client_account_agent_commission_tax_amount` double(15,2) NULL ;
alter table `alsc`.`account_payable_item_detail` add column `particulars` varchar(300) NULL after `bank_transaction_id`;
alter table `alsc`.`account_payable_item_detail` add column `bank_transaction_id` bigint(20) DEFAULT '0' NULL after `jv_entry`;
insert into `request_type`(`request_type_id`,`request_type_name`) values ( 'jv','JV');



DROP TABLE IF EXISTS `account_payable_item`;

CREATE TABLE `account_payable_item` (
  `account_payable_item_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_payable_item_qty` int(9) unsigned DEFAULT NULL,
  `account_payable_item_desc` varchar(350) DEFAULT NULL,
  `account_payable_item_price` double(15,2) unsigned DEFAULT NULL,
  `account_payable_item_amount` double(15,2) unsigned DEFAULT NULL,
  `account_payable_item_timestamp` bigint(15) unsigned DEFAULT NULL,
  `account_payable_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`account_payable_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_item` */

insert  into `account_payable_item`(`account_payable_item_id`,`account_payable_item_qty`,`account_payable_item_desc`,`account_payable_item_price`,`account_payable_item_amount`,`account_payable_item_timestamp`,`account_payable_id`) values (1,1,'test test ',12345.60,12345.60,1432821087,1),(2,1,'testetsetestetset',1121.22,1121.22,1432821991,2),(3,20,'asdfasdfasdfasd ',500.00,10000.00,1432821991,2),(4,4,'testetsets test',5555.00,22220.00,1432822368,3),(5,66,'sdafdsfasd f',100.00,6600.00,1432822368,3),(6,1,'asdfasdfasdfas dfsdasd fasd fasdf',120000.00,120000.00,1432822368,3),(7,1,'asadfas dfasd f',23123.00,23123.00,1432822368,3),(8,5,'test teste',111.00,555.00,1432822771,4),(9,444,'adfasdfasd asd fasd f',1.00,444.00,1432822771,4),(10,1,'testestset',0.99,0.99,1432822771,4),(11,6,'test',345.00,2070.00,1433503508,2),(12,67,'test',244.00,16348.00,1433503508,2),(13,5,'sampe item A',350.00,1750.00,1433517537,8),(14,7,'Sample Item B',450.00,3150.00,1433517537,8),(15,2,'Sample Item C',100.00,200.00,1433517537,8),(16,5,'12dsdvsvdv',2456.78,12283.90,1433597005,10);

/*Table structure for table `account_payable_item_detail` */

DROP TABLE IF EXISTS `account_payable_item_detail`;

CREATE TABLE `account_payable_item_detail` (
  `account_payable_item_detail_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `account_payable_id` bigint(15) unsigned DEFAULT NULL,
  `account_payable_item_id` bigint(15) unsigned DEFAULT NULL,
  `item_gross_amount` double(15,2) unsigned DEFAULT NULL,
  `item_net_amount` double(15,2) unsigned DEFAULT NULL,
  `item_tax_amount` double(15,2) unsigned DEFAULT NULL,
  `item_tax_percent` double(5,2) unsigned DEFAULT NULL,
  `project_id` bigint(10) unsigned DEFAULT '0',
  `project_site_id` bigint(10) unsigned DEFAULT '0',
  `option_account_chart_child_id` varchar(50) DEFAULT NULL,
  `option_account_chart_parent_id` varchar(50) DEFAULT NULL,
  `account_payable_item_detail_timestamp` bigint(15) DEFAULT NULL,
  `tax_payed` tinyint(1) unsigned DEFAULT '0',
  `jv_entry` tinyint(1) unsigned DEFAULT '0',
  `bank_transaction_id` bigint(20) DEFAULT '0',
  `particulars` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`account_payable_item_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_item_detail` */

insert  into `account_payable_item_detail`(`account_payable_item_detail_id`,`account_payable_id`,`account_payable_item_id`,`item_gross_amount`,`item_net_amount`,`item_tax_amount`,`item_tax_percent`,`project_id`,`project_site_id`,`option_account_chart_child_id`,`option_account_chart_parent_id`,`account_payable_item_detail_timestamp`,`tax_payed`,`jv_entry`,`bank_transaction_id`,`particulars`) values (1,1,1,12345.60,10864.13,1481.47,12.00,0,0,'car','advances_to_agents',1432821087,1,0,0,NULL),(2,2,2,1212.22,1066.75,145.47,12.00,2,2,'car','advances_to_agents',1432821991,1,0,0,NULL),(3,2,3,500.00,440.00,60.00,12.00,0,0,'future_commission','advances_to_agents',1432821991,1,0,0,NULL),(4,2,3,5000.00,4400.00,600.00,12.00,1,1,'amb','advances_to_officers',1432821992,1,0,0,NULL),(5,3,4,5555.00,4888.40,666.60,12.00,0,0,'moc','advances_to_officers',1432822568,1,0,0,NULL),(6,3,5,6600.00,5808.00,792.00,12.00,1,1,'moc','advances_to_officers',1432822568,1,0,0,NULL),(7,3,6,60000.00,52800.00,7200.00,12.00,1,1,'car','advances_to_agents',1432822568,1,0,0,NULL),(8,3,6,60000.00,52800.00,7200.00,12.00,2,2,'drainage','development_cost',1432822568,1,0,0,NULL),(9,3,7,23123.00,20348.24,2774.76,12.00,1,1,'car','advances_to_agents',1432822568,1,0,0,NULL),(10,4,8,555.00,488.40,66.60,12.00,0,0,'moc','advances_to_officers',1432822940,1,0,0,NULL),(11,4,9,111.00,97.68,13.32,12.00,0,0,'moc','advances_to_officers',1432822940,1,0,0,NULL),(12,4,9,333.00,293.04,39.96,12.00,0,0,'car','advances_to_agents',1432822940,1,0,0,NULL),(13,4,10,0.99,0.87,0.12,12.00,0,0,'moc','advances_to_officers',1432822940,1,0,0,NULL),(16,0,NULL,NULL,10000000.00,NULL,NULL,0,0,'account_adjustment','adjustment',1433494397,0,1,23,NULL),(17,3,4,5600.00,5000.00,600.00,12.00,1,1,'car','advances_to_agents',1433503417,0,0,0,'This isa sample particular'),(18,3,5,28001.00,25000.89,3000.11,12.00,1,1,'income_tax','tax',1433503417,0,0,0,'This isa sample particular'),(19,2,11,3872.84,3457.89,414.95,12.00,1,1,'account_adjustment','adjustment',1433503508,0,0,0,'Super Sample Particular'),(20,2,12,1407.48,1256.68,150.80,12.00,1,1,'income_tax','tax',1433503508,0,0,0,'Super Sample Particular'),(21,0,NULL,NULL,320000.15,NULL,NULL,0,0,'account_adjustment','adjustment',1433503584,0,1,24,'Sample Particulars and details'),(22,8,13,1960.00,1750.00,210.00,12.00,1,1,'car','advances_to_agents',1433518942,0,0,0,'This is a sample Particular'),(23,8,13,5600.00,5000.00,600.00,12.00,0,0,'orc','advances_to_agents',1433518942,0,0,0,'This is a sample Particular'),(24,8,14,5600.00,5000.00,600.00,12.00,1,1,'car','advances_to_agents',1433518942,0,0,0,'This is a sample Particular'),(25,10,16,759.36,678.00,81.36,12.00,1,4,'sic_otc','advances_to_agents',1433597005,0,0,28,'Hello in Particular'),(26,10,16,2627.40,2345.89,281.51,12.00,1,4,'account_adjustment','adjustment',1433597005,0,0,28,'Hello in Particular');

/*Table structure for table `bank_jv` */

DROP TABLE IF EXISTS `bank_jv`;

CREATE TABLE `bank_jv` (
  `bank_jv_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `bank_transaction_id` bigint(15) DEFAULT NULL,
  `jv_type_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`bank_jv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `bank_jv` */

insert  into `bank_jv`(`bank_jv_id`,`bank_transaction_id`,`jv_type_id`) values (1,15,'cancelled_cheque'),(2,19,'cancelled_cheque'),(3,20,'floating_commission'),(4,21,'quarterly_tax'),(5,22,''),(6,23,'cancelled_cheque'),(7,24,'cancelled_cheque'),(8,28,'floating_commission');

/*Table structure for table `bank_transaction` */

DROP TABLE IF EXISTS `bank_transaction`;

CREATE TABLE `bank_transaction` (
  `bank_transaction_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `bank_id` int(9) unsigned DEFAULT NULL,
  `bank_pair_id` int(9) unsigned DEFAULT NULL,
  `account_payable_id` bigint(15) unsigned DEFAULT NULL,
  `option_bank_transaction_type_id` varchar(25) DEFAULT NULL,
  `bank_transaction_amount` double(15,2) unsigned DEFAULT NULL,
  `option_bank_transaction_category_id` varchar(25) DEFAULT NULL,
  `bank_transaction_timestamp` bigint(15) DEFAULT NULL,
  `bank_transaction_depositor` varchar(100) DEFAULT NULL,
  `bank_transaction_details` varchar(500) DEFAULT NULL,
  `handled_by` varchar(100) DEFAULT NULL,
  `is_pending` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`bank_transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `bank_transaction` */

insert  into `bank_transaction`(`bank_transaction_id`,`bank_id`,`bank_pair_id`,`account_payable_id`,`option_bank_transaction_type_id`,`bank_transaction_amount`,`option_bank_transaction_category_id`,`bank_transaction_timestamp`,`bank_transaction_depositor`,`bank_transaction_details`,`handled_by`,`is_pending`) values (1,6,NULL,1,'out',12345.60,'disbursement',1432820934,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(2,6,NULL,1,'out',5000.00,'disbursement',1432821376,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(3,1,NULL,2,'out',1121.22,'disbursement',1432821704,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(4,5,NULL,2,'out',1000.00,'disbursement',1432821770,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(5,6,NULL,3,'out',171943.00,'disbursement',1432822618,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(6,2,NULL,4,'out',990.99,'disbursement',1432823008,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(7,2,NULL,4,'out',1.00,'disbursement',1432823019,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(8,6,4,5,'in',189288.60,'fund_transfer_in',1432825314,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(9,4,6,5,'out',189288.60,'fund_transfer_out',1432825315,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(10,2,NULL,6,'out',21040.30,'disbursement',1432825493,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(11,6,NULL,NULL,'in',200000.00,'cash_on_hand',1432825550,'Mizel delos Santos','doing via cash on hand','Annielle Madrid',0),(12,2,NULL,NULL,'in',10000000.00,'cash_on_hand',1432825602,'Mizel delos Santos','','Annielle Madrid',0),(13,2,NULL,NULL,'in',45000.32,'adjustment_in',1433242678,NULL,'test','Annielle Madrid',0),(14,2,NULL,NULL,'in',320000.15,'jv_bank_charges_in',1433242725,NULL,'','Annielle Madrid',0),(15,2,NULL,NULL,'out',10000000.00,'jv_tax_out',1433242788,NULL,'','Annielle Madrid',0),(16,2,NULL,NULL,'in',200000.00,'payment',1433242830,'Vincent Borlongan','test','Annielle Madrid',0),(17,2,1,NULL,'out',320000.15,'fund_transfer_out',1433242897,NULL,'','Annielle Madrid',0),(18,1,2,NULL,'in',320000.15,'fund_transfer_in',1433242897,NULL,'','Annielle Madrid',0),(19,4,NULL,NULL,'in',1000000.00,'jv_cancelled_cheque_in',1433339555,NULL,'Canceleed Test','Annielle Madrid',0),(20,1,NULL,NULL,'in',0.00,'jv_bank_charges_in',1433340959,NULL,'test','Annielle Madrid',0),(21,1,NULL,NULL,'out',320000.15,'tax_out',1433494114,NULL,'This tax in particular.','Annielle Madrid',0),(22,1,NULL,NULL,'in',320000.15,'adjustment_in',1433494168,NULL,'test','Annielle Madrid',0),(23,1,NULL,NULL,'out',10000000.00,'tax_out',1433494378,NULL,'This is a tax.','Annielle Madrid',0),(24,1,NULL,NULL,'in',320000.15,'commission_in',1433503549,NULL,'Sample Particulars and details','Annielle Madrid',0),(25,3,NULL,8,'out',15987.98,'disbursement',1433519028,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',1),(26,2,NULL,8,'out',15987.98,'disbursement',1433519028,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',1),(27,6,NULL,9,'out',15987.98,'disbursement',1433520498,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(28,1,NULL,NULL,'out',45000.32,'commission_out',1433596923,NULL,NULL,'Annielle Madrid',0),(29,8,NULL,0,'in',0.00,'Commission Contingency',1433599179,NULL,'Computer Generated - Commission Contingency Entry','Computer Genterated',0),(30,8,NULL,0,'in',0.00,'Commission Contingency',1433599409,NULL,'Computer Generated - Commission Contingency Entry','Computer Genterated',0),(31,8,NULL,0,'in',0.00,'Commission Contingency',1433599410,NULL,'Computer Generated - Commission Contingency Entry','Computer Genterated',0),(32,8,NULL,0,'in',0.00,'Commission Contingency',1433599410,NULL,'Computer Generated - Commission Contingency Entry','Computer Genterated',0);

/*Table structure for table `client_account_agent` */

DROP TABLE IF EXISTS `client_account_agent`;

CREATE TABLE `client_account_agent` (
  `client_account_agent_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `client_account_id` int(9) unsigned DEFAULT NULL,
  `agent_id` int(9) unsigned DEFAULT NULL,
  `user_id` int(5) unsigned DEFAULT NULL,
  `client_account_agent_commission_percent_current` double(5,2) unsigned DEFAULT NULL,
  `client_account_agent_commission_amount_current` double(15,2) unsigned DEFAULT NULL,
  `client_account_agent_commission_amount_net` double(15,2) DEFAULT NULL,
  `client_account_agent_commission_tax_percent` double(5,2) DEFAULT NULL,
  `client_account_agent_commission_tax_amount` double(15,2) DEFAULT NULL,
  `client_account_agent_commission_contingency` double(5,2) DEFAULT NULL,
  `client_account_agent_timestamp` bigint(15) unsigned DEFAULT NULL,
  `is_approved` tinyint(1) unsigned DEFAULT '0',
  `approve_date` bigint(15) unsigned DEFAULT NULL,
  `commission_scheme_range_sequence` varchar(10) DEFAULT NULL,
  `option_entry_type_id` varchar(15) DEFAULT 'single',
  PRIMARY KEY (`client_account_agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `client_account_agent` */

insert  into `client_account_agent`(`client_account_agent_id`,`client_account_id`,`agent_id`,`user_id`,`client_account_agent_commission_percent_current`,`client_account_agent_commission_amount_current`,`client_account_agent_commission_amount_net`,`client_account_agent_commission_tax_percent`,`client_account_agent_commission_tax_amount`,`client_account_agent_commission_contingency`,`client_account_agent_timestamp`,`is_approved`,`approve_date`,`commission_scheme_range_sequence`,`option_entry_type_id`) values (1,1,21,7,10.00,2677.00,2409.30,10.00,267.70,NULL,1432717336,0,NULL,'1','single'),(2,1,22,7,10.00,5354.00,4818.60,10.00,535.40,NULL,1432717336,0,NULL,'1','single'),(3,1,20,7,10.00,8031.00,7227.90,10.00,803.10,NULL,1432717336,0,NULL,'1','single'),(4,1,21,7,10.00,2677.00,2409.30,10.00,267.70,NULL,1432717336,1,1432747939,'2','single'),(5,1,22,7,10.00,5354.00,4818.60,10.00,535.40,NULL,1432717336,1,1432747230,'2','single'),(6,1,20,7,10.00,8031.00,7227.90,10.00,803.10,NULL,1432717336,1,1432747364,'2','single'),(9,1,21,7,10.00,2677.00,2409.30,10.00,267.70,0.00,1433599179,0,NULL,'3','single'),(10,1,21,7,10.00,2677.00,2409.30,10.00,267.70,0.00,1433599409,0,NULL,'4','single'),(11,1,22,7,10.00,5354.00,4818.60,10.00,535.40,0.00,1433599410,0,NULL,'4','single'),(12,1,20,7,10.00,8031.00,7227.90,10.00,803.10,0.00,1433599410,0,NULL,'4','single');

/*Table structure for table `jv_type` */

DROP TABLE IF EXISTS `jv_type`;

CREATE TABLE `jv_type` (
  `jv_type_id` varchar(30) NOT NULL,
  `jv_type_name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`jv_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jv_type` */

insert  into `jv_type`(`jv_type_id`,`jv_type_name`) values ('cancelled_cheque','Cancelled Cheque'),('floating_commission','Floating Commission'),('income_tax','Income Tax'),('quarterly_tax','Quarterly Tax'),('transaction_fee','Transaction Fee'),('withholding_tax','Withholding Tax');

/*Table structure for table `option_account_chart_child` */

DROP TABLE IF EXISTS `option_account_chart_child`;

CREATE TABLE `option_account_chart_child` (
  `option_account_chart_child_id` varchar(100) DEFAULT NULL,
  `option_account_chart_parent_id` varchar(100) DEFAULT NULL,
  `option_account_chart_child_name` varchar(100) DEFAULT NULL,
  `option_account_chart_child_code` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_chart_child` */

insert  into `option_account_chart_child`(`option_account_chart_child_id`,`option_account_chart_parent_id`,`option_account_chart_child_name`,`option_account_chart_child_code`) values ('basketball_court','development_cost','Basketball Court',NULL),('clubhouse','development_cost','Clubhouse',NULL),('deepwell','development_cost','Deepwell',NULL),('drainage','development_cost','Drainage',NULL),('equipment','development_cost','Equipment',NULL),('moc','advances_to_officers','MOC',NULL),('amb','advances_to_officers','AMB',NULL),('car','advances_to_agents','CAR',NULL),('gasoline','advances_to_agents','Gasoline',NULL),('sic_otc','advances_to_agents','SIC/OTC',NULL),('orc','advances_to_agents','ORC',NULL),('future_commission','advances_to_agents','Future Commission',NULL),('others','advances_to_agents','Others',NULL),('income_tax','tax','Income Tax',NULL),('withholding_tax','tax','Withholding Tax',NULL),('quartely_tax','tax','Quarterly Tax',NULL),('bank_charge_bdo','bank_charge','BDO Bank Transaction Fee',NULL),('bank_charge','bank_charge','Bank Charges',NULL),('floating_commission','commission','Floating Commission',NULL),('account_adjustment','adjustment','Account Adjustment',NULL),('cancelled_cheque','cheque','Cancelled Cheque',NULL);

/*Table structure for table `option_account_chart_parent` */

DROP TABLE IF EXISTS `option_account_chart_parent`;

CREATE TABLE `option_account_chart_parent` (
  `option_account_chart_parent_id` varchar(100) NOT NULL,
  `option_account_chart_parent_name` varchar(100) DEFAULT NULL,
  `option_account_chart_parent_code` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`option_account_chart_parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_chart_parent` */

insert  into `option_account_chart_parent`(`option_account_chart_parent_id`,`option_account_chart_parent_name`,`option_account_chart_parent_code`) values ('adjustment','Adjustment',NULL),('advances_to_agents','Advances to Agents',NULL),('advances_to_officers','Advances to Officers',NULL),('bank_charge','Bank Charge',NULL),('cheque','Cheque',NULL),('commission','Commission',NULL),('development_cost','Development Cost',NULL),('tax','Tax',NULL);

/*Table structure for table `option_bank_transaction_category` */

DROP TABLE IF EXISTS `option_bank_transaction_category`;

CREATE TABLE `option_bank_transaction_category` (
  `option_bank_transaction_category_id` varchar(30) NOT NULL,
  `option_bank_transaction_type_id` varchar(30) DEFAULT NULL,
  `option_bank_transaction_category_name` varchar(30) DEFAULT NULL,
  `option_bank_transaction_category_type_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`option_bank_transaction_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_bank_transaction_category` */

insert  into `option_bank_transaction_category`(`option_bank_transaction_category_id`,`option_bank_transaction_type_id`,`option_bank_transaction_category_name`,`option_bank_transaction_category_type_id`) values ('adjustment_in','in','Adjustment(in)','jv'),('adjustment_out','out','Adjustment(out)','jv'),('bank_charges_in','in','Bank Charges(in)','jv'),('bank_charges_out','out','Bank Charges(out)','jv'),('bank_charge_bdo','out','Bank Charges BDO(out)','jv'),('cancelled_cheque_in','in','Cancelled Cheque(in)','jv'),('cancelled_cheque_out','out','Cancelled Cheque(out)','jv'),('cash_on_hand','in','Cash on Hand','bt'),('commission_in','in','Commission(in)','jv'),('commission_out','out','Commission(out)','jv'),('disbursement','out','Disbursement','bt'),('fund_transfer_in','in','Fund Transfer(in)','bt'),('fund_transfer_out','out','Fund Transfer(out)','bt'),('payment','in','Payment','bt'),('tax_out','out','Tax(out)','jv');

/*Table structure for table `option_bank_transaction_category_type` */

DROP TABLE IF EXISTS `option_bank_transaction_category_type`;

CREATE TABLE `option_bank_transaction_category_type` (
  `option_bank_transaction_category_type_id` varchar(25) DEFAULT NULL,
  `option_bank_transaction_category_type_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_bank_transaction_category_type` */

insert  into `option_bank_transaction_category_type`(`option_bank_transaction_category_type_id`,`option_bank_transaction_category_type_name`) values ('jv','Journal Voucher'),('bt','Bank Transaction');

/*Table structure for table `option_bank_transaction_type` */

DROP TABLE IF EXISTS `option_bank_transaction_type`;

CREATE TABLE `option_bank_transaction_type` (
  `option_bank_transaction_type_id` varchar(25) NOT NULL,
  `option_bank_transaction_type_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`option_bank_transaction_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_bank_transaction_type` */

insert  into `option_bank_transaction_type`(`option_bank_transaction_type_id`,`option_bank_transaction_type_name`) values ('in','Debit(Money In)'),('out','Credit(Money Out)');

/*Table structure for table `option_scheme_finance_type` */

DROP TABLE IF EXISTS `option_scheme_finance_type`;

CREATE TABLE `option_scheme_finance_type` (
  `option_scheme_finance_type_id` varchar(15) NOT NULL,
  `option_scheme_finance_type_name` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`option_scheme_finance_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_scheme_finance_type` */

insert  into `option_scheme_finance_type`(`option_scheme_finance_type_id`,`option_scheme_finance_type_name`) values ('bank','Bank'),('in_house','In House');

/*Table structure for table `request_type` */

DROP TABLE IF EXISTS `request_type`;

CREATE TABLE `request_type` (
  `request_type_id` varchar(10) DEFAULT NULL,
  `request_type_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `request_type` */

insert  into `request_type`(`request_type_id`,`request_type_name`) values ('rfp','RFP'),('tba','TBA'),('lqd','Lqd'),('ofv','OFV'),('tax','Tax'),('jv','JV');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

















