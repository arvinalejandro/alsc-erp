/*
SQLyog Enterprise - MySQL GUI v8.02 RC
MySQL - 5.6.25-log : Database - alsc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`alsc` /*!40100 DEFAULT CHARACTER SET utf8 */;

/*Table structure for table `account_letter` */

DROP TABLE IF EXISTS `account_letter`;

CREATE TABLE `account_letter` (
  `account_letter_id` bigint(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `client_account_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `account_letter_type` varchar(100) DEFAULT NULL,
  `account_letter_name` varchar(200) DEFAULT NULL,
  `account_letter_content` blob,
  `account_letter_year` mediumint(5) unsigned DEFAULT NULL,
  `account_letter_month` tinyint(5) unsigned DEFAULT NULL,
  `account_letter_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`account_letter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `account_letter` */

insert  into `account_letter`(`account_letter_id`,`client_account_id`,`user_id`,`account_letter_type`,`account_letter_name`,`account_letter_content`,`account_letter_year`,`account_letter_month`,`account_letter_timestamp`) values (0000000001,16,7,'thankyou','THANK YOU LETTER','\r\n            <div style=\"margin:0 auto;\">\r\n                \r\n                <div style=\"margin:0 auto; width:500px;\">\r\n    <img src=\"/_application/content/images/ALSC_logo_bnw.jpg\" style=\"margin-right:20px; float:left;\" width=\"80px\">\r\n    <div style=\"float:left; line-height: 8pt;\">\r\n        <h1>ASIAN LAND STRATEGIES CORPORATION</h1>\r\n        <span style=\"font-size:7pt;\">Asian Land Corporate Center, Grand Royale Subdivision, Bulihan, Malolos City, Bulacan</span>\r\n        <span style=\"font-size:7pt;\">Asian Land Branch Office, No. 490, EDSA, Barangay 95, Zone 9, District 2, Caloocan City</span>\r\n        \r\n        <table style=\"font-size:7pt; margin-top:10px;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n            <tr align=\"center\">\r\n                <td>+63 44 791-2508 to 09</td>\r\n                <td>info@asianland.com.ph</td>\r\n                <td>www.asianland.com.ph</td>    \r\n            </tr>\r\n        </table>\r\n    </div>\r\n    <label></label>\r\n</div>    \r\n\r\n    \r\n                    \r\n                <div id=\"document\">THANK YOU LETTER</div>\r\n                \r\n                <p>\r\n                    <b id=\"output_date\">June 11, 2015</b>\r\n                    <b id=\"output_address\">Pasig City, Pasig 1600</b>\r\n                </p>\r\n                \r\n                <p>\r\n                    Subject:\r\n                    <b id=\"output_subject\">Lot Purchased at Block 015 Lot 12, Grand Royale 5-B (Pinagbakahan, Malolos City)</b>\r\n                </p>\r\n                <p>Dear <b id=\"output_name\">Fred Gomez</b>,</p>\r\n                \r\n                <p>We would like to take this opportunity to thank you for purchasing the above property from our company. It is indeed our pleasure to be of service to you.</p>\r\n                <p>We value your trust in our company and it is our objective to maintain this trust by providing you with the best customer service you deserve. Should you have any queries and suggestions, please do not hesitate to call our office and we shall be glad to assist you in anyway we can.</p>\r\n                \r\n                <div style=\"margin-top:50px; float:right;\">\r\n                    <p>Very truly yours,</p>\r\n                    <p style=\"margin-top:50px;\">\r\n                        Ma. Angela O. Celeridad \r\n                        Executive Vice President \r\n                        ASIAN LAND STRATEGIES CORPORATION\r\n                    </p>\r\n                </div>\r\n                <label></label>\r\n                \r\n                <p style=\"font-size:9pt; width:90%; margin:80px auto 0 auto; color:#5d5b5a;\">IMPORTANT NOTICE: We request you to pay in Asian Land Offices or to authorized collecting banks only. All checks should be crossed and made payable to ASIAN LAND STRATEGIES CORPORATION, aslways demand for a receipt when paying. If you will be issued a provisional receipt, please demand for your official receipt within three (3) working days from the date of each payment.</p>\r\n            </div>\r\n            <label></label>',2015,6,1433965843);

/*Table structure for table `account_payable` */

DROP TABLE IF EXISTS `account_payable`;

CREATE TABLE `account_payable` (
  `account_payable_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `request_type_id` varchar(15) DEFAULT NULL,
  `account_payable_timestamp` bigint(15) unsigned DEFAULT NULL,
  `request_recommended_by` varchar(100) DEFAULT NULL,
  `request_requestor` varchar(100) DEFAULT NULL,
  `request_tin` varchar(50) DEFAULT 'N/A',
  `option_department_id` varchar(30) DEFAULT 'n/a',
  `request_amount` double(15,2) unsigned DEFAULT NULL,
  `request_purpose` varchar(150) DEFAULT NULL,
  `request_payable_to` varchar(100) DEFAULT 'N/A',
  `request_address` varchar(150) DEFAULT 'N/A',
  `request_accounted_to` varchar(100) DEFAULT 'N/A',
  `option_payment_method_id` varchar(25) DEFAULT NULL,
  `request_approved_amount` double(15,2) unsigned DEFAULT NULL,
  `request_details` varchar(250) DEFAULT NULL,
  `request_approval_level_id` varchar(20) DEFAULT NULL,
  `request_approval_status_id` varchar(20) DEFAULT NULL,
  `request_approved_by` varchar(100) DEFAULT NULL,
  `request_approved_date` bigint(15) unsigned DEFAULT NULL,
  `request_date_needed` bigint(15) unsigned DEFAULT NULL,
  `request_release_date` bigint(15) DEFAULT NULL,
  `is_reimbursement` tinyint(1) unsigned DEFAULT '0',
  `reimbursement_amount` double(15,2) DEFAULT NULL,
  `is_commission` bigint(20) DEFAULT '0',
  `is_commission_group` tinyint(1) DEFAULT '0',
  `is_liquidated` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`account_payable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable` */

insert  into `account_payable`(`account_payable_id`,`request_type_id`,`account_payable_timestamp`,`request_recommended_by`,`request_requestor`,`request_tin`,`option_department_id`,`request_amount`,`request_purpose`,`request_payable_to`,`request_address`,`request_accounted_to`,`option_payment_method_id`,`request_approved_amount`,`request_details`,`request_approval_level_id`,`request_approval_status_id`,`request_approved_by`,`request_approved_date`,`request_date_needed`,`request_release_date`,`is_reimbursement`,`reimbursement_amount`,`is_commission`,`is_commission_group`,`is_liquidated`) values (1,'rfp',1433971671,'Annielle Madrid','Commission - Computer Generated','N/A','finance',12090.00,'sales commission','ALSC - Sales Commission','N/A','ALSC - Sales','check',12090.00,'Commission - Request','completed','approved','Annielle Madrid',1433972056,1434556800,1433972229,0,NULL,10,1,1),(2,'tba',1433972464,'Annielle Madrid','Ryan Perez','N/A','billing',16000.87,'Repair','N/A','N/A','Ace Hardware','cash',16000.87,'','completed','approved','Annielle Madrid',1433972643,1434038400,1433972745,0,NULL,0,0,1),(3,'rfp',1433972898,'Annielle Madrid','Teresa Dela Pena','123-345-456-567','billing',18365.25,'Maintenance','747 Hardware','Pasig City','747 Hardware','cash',18365.25,NULL,'completed','approved','Annielle Madrid',1433973017,1434643200,1433973126,0,NULL,0,0,1),(4,'tba',1433973170,'Annielle Madrid','Jeffrey Padilla','N/A','engineering',15987.98,'Maintenance','N/A','N/A','ALSC','check',15987.98,'','completed','approved','Annielle Madrid',1433973228,1435161600,1433973298,0,NULL,0,0,1),(6,'ofv',1433973731,'Annielle Madrid','Arvin Alejandro','N/A','n/a',34366.12,'OFV - Replenishment','N/A','N/A','N/A','check',34366.12,NULL,'completed','released','Annielle Madrid',1433973796,0,1433973844,0,NULL,0,0,0),(7,'tba',1433974390,'Annielle Madrid','Manny Geronimo','N/A','edp',12000.00,'Maintenance','N/A','N/A','Ace Hardware','cash',12000.00,'','completed','released','Annielle Madrid',1433974430,1430323200,1434158853,1,4500.00,0,0,1),(8,'ofv',1433974555,'Annielle Madrid','Arvin Alejandro','N/A','n/a',12000.00,'OFV - Replenishment','N/A','N/A','N/A','check',12000.00,NULL,'completed','released','Annielle Madrid',1433974577,0,1433974620,0,NULL,0,0,0),(9,'rfp',1433979671,'Annielle Madrid','Commission - Computer Generated','N/A','finance',6294.00,'sales commission','ALSC - Sales Commission','N/A','ALSC - Sales','check',6294.00,'Commission - Request','reconciliation','released','Annielle Madrid',1433979762,1434556800,1433979987,0,NULL,15,1,1),(10,'jv',1433980707,'N/A','N/A','N/A','n/a',0.00,'JV - Payable','N/A','N/A','N/A','cash',NULL,NULL,'completed','released',NULL,NULL,1433980824,1433980824,0,NULL,0,0,0),(11,'jv',1433980946,'N/A','N/A','N/A','n/a',0.00,'JV - Payable','N/A','N/A','N/A','cash',NULL,NULL,'completed','released',NULL,NULL,1433980995,1433980995,0,NULL,0,0,0),(12,'rfp',1433990008,'Annielle Madrid','Mickey','4234234 234 234','edp',100000.00,'meeting ','sdfsdf sdfsdfs','dgdfg df','comasd','check',100000.00,NULL,'cheque_release','signed','Annielle Madrid',1433990267,1433952000,NULL,0,NULL,0,0,1),(13,'tba',1434308199,'Annielle Madrid','Arvin Alejandro','N/A','billing',25000.00,'Repair','N/A','N/A','Ace Hardware','cash',NULL,'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia vo','dept_head','recommended',NULL,NULL,1435075200,NULL,0,NULL,0,0,0),(14,'tba',1434308286,'Annielle Madrid','Mizel delos Santos','N/A','edp',15987.98,'Maintenance','N/A','N/A','747 Hardware',NULL,NULL,'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia vo','exec_approve','approved',NULL,NULL,1434384000,NULL,0,NULL,0,0,0),(15,'tba',1434308312,'Annielle Madrid','Teresa Dela Pena','N/A','engineering',16000.87,'Repairs','N/A','N/A','Handyman Construction Supply','cash',16000.87,'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia vo','cheque_prep','approved','Annielle Madrid',1434324163,1434988800,NULL,0,NULL,0,0,1),(16,'tba',1434308359,'Annielle Madrid','Nicolas Sandoval','N/A','engineering',254685.23,'Maintenance','N/A','N/A','TTH Hardware','check',200000.00,'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia vo','cheque_prep','approved','Annielle Madrid',1434324154,1435075200,NULL,0,NULL,0,0,1),(17,'tba',1434308403,'Annielle Madrid','Manny Geronimo','N/A','finance',171943.00,'Petty Cash','N/A','N/A','AsianLand','cash',90000.00,'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia vo','completed','approved','Annielle Madrid',1434309182,1434470400,1434309917,0,NULL,0,0,1),(18,'rfp',1434308458,'Annielle Madrid','Ryan Perez','2515-2345-234','billing',350000.00,'Maintenance','Mons Hardware','Pasig City','Mons Hardware','check',350000.00,NULL,'reconciliation','released','Annielle Madrid',1434309165,1434988800,1434309881,0,NULL,0,0,1),(19,'rfp',1434308878,'Annielle Madrid','Christian Manaloto','545-241-1515','executive',10123.50,'Clubhouse','Uratex Manila','Manila City','Uratex Manila','check',NULL,NULL,'dept_head','recommended',NULL,NULL,1435248000,NULL,0,NULL,0,0,0),(20,'rfp',1434323732,'Annielle Madrid','Nicolas Sandoval','545-241-1515','finance',25000.00,'Supplies Payment','Office Warehouse','Pasig City','Office Warehouse','check',25000.00,NULL,'journal_entry','approved','Annielle Madrid',1434324184,1435593600,NULL,0,NULL,0,0,0),(21,'rfp',1434323829,'Annielle Madrid','Ryan Perez','545-241-1515','engineering',350000.00,'Building Inventory','Ace Hardware','Mandaluyong City','Ace Hardware','check',NULL,NULL,'exec_approve','approved',NULL,NULL,1439308800,NULL,0,NULL,0,0,0),(22,'rfp',1434323916,'Annielle Madrid','Jeffrey Padilla','123-123-123','billing',16000.00,'Supplies Payment','Hypermart','Bulacan','Hypermart','cash',16000.00,NULL,'journal_entry','approved','Annielle Madrid',1434324100,1434902400,NULL,0,NULL,0,0,0),(23,'jv',1434324258,'N/A','N/A','N/A','n/a',0.00,'JV - Payable','N/A','N/A','N/A','cash',NULL,NULL,'completed','released',NULL,NULL,1434324310,1434324310,0,NULL,0,0,0),(24,'rfp',1435670843,'Annielle Madrid','Arvin Alejandro','545-241-1515','engineering',350000.00,'Maintenance','Uratex Manila','Pasig City','747 Hardware','check',350000.00,NULL,'completed','approved','Annielle Madrid',1435670944,1434988800,1435671053,0,NULL,0,0,1),(25,'rfp',1435744510,'Annielle Madrid','Commission - Computer Generated','N/A','finance',524.50,'sales commission','ALSC - Sales Commission','N/A','ALSC - Sales','check',524.50,'Commission - Request','reconciliation','released','Annielle Madrid',1435744559,1436284800,1435744657,0,NULL,1,0,1),(26,'rfp',1435745534,'Annielle Madrid','Commission - Computer Generated','N/A','finance',473.00,'sales commission','ALSC - Sales Commission','N/A','ALSC - Sales','check',NULL,'Commission - Request','dept_head','recommended',NULL,NULL,1436284800,NULL,0,NULL,1,0,0),(27,'rfp',1435745949,'Annielle Madrid','Commission - Computer Generated','N/A','finance',473.13,'sales commission','ALSC - Sales Commission','N/A','ALSC - Sales','check',NULL,'Commission - Request','dept_head','recommended',NULL,NULL,1436284800,NULL,0,NULL,5,0,0),(28,'rfp',1435745950,'Annielle Madrid','Commission - Computer Generated','N/A','finance',11354.56,'sales commission','ALSC - Sales Commission','N/A','ALSC - Sales','check',NULL,'Commission - Request','dept_head','recommended',NULL,NULL,1436284800,NULL,0,NULL,9,1,0),(29,'rfp',1435745952,'Annielle Madrid','Commission - Computer Generated','N/A','finance',3784.52,'sales commission','ALSC - Sales Commission','N/A','ALSC - Sales','check',NULL,'Commission - Request','dept_head','recommended',NULL,NULL,1436284800,NULL,0,NULL,10,1,0),(30,'rfp',1435745953,'Annielle Madrid','Commission - Computer Generated','N/A','finance',6622.91,'sales commission','ALSC - Sales Commission','N/A','ALSC - Sales','check',NULL,'Commission - Request','dept_head','recommended',NULL,NULL,1436284800,NULL,0,NULL,11,1,0),(31,'jv',1435787550,'N/A','N/A','N/A','n/a',0.00,'JV - Payable','N/A','N/A','N/A','cash',NULL,NULL,'completed','released',NULL,NULL,1435787652,1435787652,0,NULL,0,0,0);

/*Table structure for table `account_payable_cheque` */

DROP TABLE IF EXISTS `account_payable_cheque`;

CREATE TABLE `account_payable_cheque` (
  `account_payable_cheque_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_payable_id` bigint(20) unsigned DEFAULT NULL,
  `account_payable_cheque_timestamp` bigint(15) unsigned DEFAULT NULL,
  `account_payable_cheque_amount` double(15,2) unsigned DEFAULT NULL,
  `account_payable_cheque_date` bigint(15) unsigned DEFAULT NULL,
  `account_payable_cheque_ofv_number` varchar(50) DEFAULT NULL,
  `account_payable_cheque_po_number` varchar(50) DEFAULT NULL,
  `bank_id` smallint(5) unsigned DEFAULT NULL,
  `user_id` bigint(15) unsigned DEFAULT NULL,
  `is_released` tinyint(1) unsigned DEFAULT '0',
  `released_date` bigint(15) unsigned DEFAULT NULL,
  `is_encashed` tinyint(1) unsigned DEFAULT '0',
  `encashed_date` bigint(15) unsigned DEFAULT NULL,
  `bank_transaction_id` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`account_payable_cheque_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_cheque` */

insert  into `account_payable_cheque`(`account_payable_cheque_id`,`account_payable_id`,`account_payable_cheque_timestamp`,`account_payable_cheque_amount`,`account_payable_cheque_date`,`account_payable_cheque_ofv_number`,`account_payable_cheque_po_number`,`bank_id`,`user_id`,`is_released`,`released_date`,`is_encashed`,`encashed_date`,`bank_transaction_id`) values (1,1,1433972056,12090.00,1434643200,'DD123','111111',1,7,1,1433972229,1,1433972229,65),(2,4,1433973228,15987.98,1435161600,'CC123','BB123',5,7,1,1433973298,1,1433973298,74),(3,5,1433973443,68732.24,1434643200,NULL,NULL,4,7,0,NULL,0,NULL,NULL),(4,6,1433973796,34366.12,1434556800,'12356','AA213',4,7,1,1433973844,1,1435248000,75),(5,8,1433974577,12000.00,1435075200,'23123123123','131231',3,7,1,1433974619,1,1434643200,78),(6,9,1433979762,6294.00,1433952000,'3333','2222',2,7,1,1433979987,0,NULL,91),(7,12,1433990267,50000.00,1433952000,'234234','234234',1,7,1,1433990533,1,1433952000,96),(8,12,1433990267,50000.00,1434038400,'234','234234',1,7,0,1433990533,0,NULL,NULL),(9,18,1434309165,350000.00,1435161600,'123','45545',1,7,1,1434309881,0,NULL,98),(10,16,1434324154,200000.00,1435248000,NULL,NULL,1,7,0,NULL,0,NULL,NULL),(11,20,1434324184,25000.00,1435334400,NULL,NULL,5,7,0,NULL,0,NULL,NULL),(12,24,1435670944,350000.00,1434470400,'BB2','AA2',1,7,1,1435671053,1,1435248000,102),(13,25,1435744559,524.50,1436889600,'BB3','AA3',1,7,1,1435744657,1,1436976000,126);

/*Table structure for table `account_payable_item` */

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_item` */

insert  into `account_payable_item`(`account_payable_item_id`,`account_payable_item_qty`,`account_payable_item_desc`,`account_payable_item_price`,`account_payable_item_amount`,`account_payable_item_timestamp`,`account_payable_id`) values (1,1,'Sales Commission',12090.00,12090.00,1433971671,1),(2,4,'Bags of Cement',1450.00,5800.00,1433972799,2),(3,5,'Sheets of 24 Gauge Metal',1250.00,6250.00,1433972991,3),(4,7,'Ceramic Cutter',345.78,2420.46,1433972991,3),(5,1,'Sales Commission',6294.00,6294.00,1433979671,9),(6,1,'Withholding Tax',5000.00,5000.00,1433980824,10),(7,1,'Adjustment',5000.00,5000.00,1433980995,11),(8,1,'asdf',15000.00,15000.00,1433981136,4),(9,1,'asdfsadf',987.98,987.98,1433981137,4),(10,5,'item 1',5000.00,25000.00,1433990122,12),(11,5,'item 2',5000.00,25000.00,1433990122,12),(12,2,'Packs of Nails',450.00,900.00,1434158669,7),(13,3,'Trucks of Sand',70000.00,210000.00,1434308767,18),(14,2,'Trucks Grava',70000.00,140000.00,1434308767,18),(15,5,'Monoblock Chairs',2024.70,10123.50,1434309027,19),(16,5,'300 Load Card ',300.00,1500.00,1434323522,17),(17,25,'Boxes of Black Ballpen',250.00,6250.00,1434323522,17),(18,5,'Rim Bond Paper',349.89,1749.45,1434323826,20),(19,5,'Boxes Blue Ballpen',263.00,1315.00,1434323826,20),(20,4,'Ink Cartridge',875.00,3500.00,1434323826,20),(21,10,'Trucks Sand',12000.00,120000.00,1434323913,21),(22,200,'Sacks Cement',344.00,68800.00,1434323913,21),(23,5,'Black Ink Cartridge',864.78,4323.90,1434324025,22),(24,5,'Packs paper towel',97.00,485.00,1434324025,22),(25,1,'Input Tax',5000.00,5000.00,1434324310,23),(26,5,'sacks cement',378.87,1894.35,1435670896,24),(27,5,'truck sand',4500.00,22500.00,1435670897,24),(28,1,'Sales Commission',524.50,524.50,1435744510,25),(29,1,'Sales Commission',525.70,525.70,1435745534,26),(30,1,'Sales Commission',525.70,525.70,1435745949,27),(31,1,'Sales Commission',12616.80,12616.80,1435745950,28),(32,1,'Sales Commission',4205.60,4205.60,1435745952,29),(33,1,'Sales Commission',7359.80,7359.80,1435745953,30),(34,1,'Bank Charges',320000.15,320000.15,1435787652,31);

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
  `option_account_chart_child_id` bigint(20) unsigned DEFAULT NULL,
  `option_account_chart_parent_id` bigint(20) unsigned DEFAULT NULL,
  `account_payable_item_detail_timestamp` bigint(15) DEFAULT NULL,
  `tax_payed` tinyint(1) unsigned DEFAULT '0',
  `jv_entry` tinyint(1) unsigned DEFAULT '0',
  `bank_transaction_id` bigint(20) DEFAULT '0',
  `particulars` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`account_payable_item_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_item_detail` */

insert  into `account_payable_item_detail`(`account_payable_item_detail_id`,`account_payable_id`,`account_payable_item_id`,`item_gross_amount`,`item_net_amount`,`item_tax_amount`,`item_tax_percent`,`project_id`,`project_site_id`,`option_account_chart_child_id`,`option_account_chart_parent_id`,`account_payable_item_detail_timestamp`,`tax_payed`,`jv_entry`,`bank_transaction_id`,`particulars`) values (1,1,1,13299.00,12090.00,1209.00,10.00,0,0,25,7,1433972172,0,0,0,'Test'),(2,2,2,6496.00,5800.00,696.00,12.00,1,1,41,11,1433972800,0,0,0,'Test Particular'),(3,3,3,7000.00,6250.00,750.00,12.00,1,1,46,11,1433973085,0,0,0,'This is a sample Particular'),(4,3,4,2710.92,2420.46,290.46,12.00,1,1,48,11,1433973085,0,0,0,'This is a sample Particular'),(5,9,5,6923.40,6294.00,629.40,10.00,1,1,25,7,1433979915,0,0,0,'test particular'),(6,10,6,5000.00,5000.00,0.00,0.00,1,1,66,11,1433980824,0,1,92,'Payment for Taxes'),(7,11,7,5600.00,5000.00,600.00,12.00,1,1,32,8,1433980996,0,1,95,'This is a sample Particular'),(8,4,8,16800.00,15000.00,1800.00,12.00,1,1,16,5,1433981137,0,0,0,'liquidate bahaha'),(9,4,9,1106.54,987.98,118.56,12.00,0,0,18,6,1433981137,0,0,0,'liquidate bahaha'),(10,12,10,28000.00,25000.00,3000.00,12.00,1,1,21,7,1433990394,0,0,0,'MEETING FOR MSDFS DFS DFSDF '),(11,12,11,11200.00,10000.00,1200.00,12.00,1,1,12,3,1433990394,0,0,0,'MEETING FOR MSDFS DFS DFSDF '),(12,12,11,16800.00,15000.00,1800.00,12.00,1,1,21,7,1433990394,0,0,0,'MEETING FOR MSDFS DFS DFSDF '),(13,7,12,504.00,450.00,54.00,12.00,1,1,39,11,1434158669,0,0,0,'This is a sample Particular'),(14,18,13,50400.00,45000.00,5400.00,12.00,1,1,41,11,1434309805,0,0,0,'This is a sample Particular'),(15,18,14,59360.00,53000.00,6360.00,12.00,1,1,45,11,1434309805,0,0,0,'This is a sample Particular'),(16,17,16,1680.00,1500.00,180.00,12.00,1,1,40,11,1434323522,0,0,0,'This is a sample Particular'),(17,17,17,7000.00,6250.00,750.00,12.00,1,1,22,7,1434323522,0,0,0,'This is a sample Particular'),(18,23,25,5000.00,5000.00,0.00,0.00,0,0,74,12,1434324310,0,1,101,'Payment for Taxes'),(19,24,26,425.45,379.87,45.58,12.00,1,1,39,11,1435671011,0,0,0,'This is a sample Particular'),(20,24,27,25200.00,22500.00,2700.00,12.00,1,1,39,11,1435671011,0,0,0,'This is a sample Particular'),(21,25,28,576.95,524.50,52.45,10.00,1,1,26,7,1435744601,0,0,0,'This is a sample Particular'),(22,31,34,358400.17,320000.15,38400.02,12.00,1,2,9,2,1435787652,0,1,158,'This is a sample Particular');

/*Table structure for table `account_payable_ofv` */

DROP TABLE IF EXISTS `account_payable_ofv`;

CREATE TABLE `account_payable_ofv` (
  `account_payable_ofv_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `account_payable_id` bigint(15) unsigned DEFAULT NULL,
  `account_payable_ofv_amount` double(15,2) DEFAULT NULL,
  `account_payable_ofv_release_date` bigint(15) unsigned DEFAULT NULL,
  `account_payable_ofv_po_number` varchar(25) DEFAULT NULL,
  `account_payable_ofv_ofv_number` varchar(25) DEFAULT NULL,
  `account_payable_ofv_or_number` varchar(25) DEFAULT NULL,
  `account_payable_ofv_cov_number` varchar(25) DEFAULT NULL,
  `user_id` int(9) unsigned DEFAULT NULL,
  `is_replenished` tinyint(1) unsigned DEFAULT '0',
  `is_released` tinyint(1) DEFAULT '0',
  `bank_transaction_id` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`account_payable_ofv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_ofv` */

insert  into `account_payable_ofv`(`account_payable_ofv_id`,`account_payable_id`,`account_payable_ofv_amount`,`account_payable_ofv_release_date`,`account_payable_ofv_po_number`,`account_payable_ofv_ofv_number`,`account_payable_ofv_or_number`,`account_payable_ofv_cov_number`,`user_id`,`is_replenished`,`is_released`,`bank_transaction_id`) values (1,2,16000.87,1434038400,'BB1521',NULL,'AA1234','CC241561',7,1,1,72),(2,3,18365.25,1434038400,'BB1521',NULL,'XX222','VVV12',7,1,1,73),(3,7,12000.00,1432569600,'BB1521',NULL,'AA1234','CC241561',7,1,1,77),(4,7,4500.00,1434470400,'123123',NULL,'AA1234','CC241561',7,0,1,97),(5,17,90000.00,1432828800,'123123',NULL,'AA1234','123123',7,0,1,100);

/*Table structure for table `account_payable_ticket` */

DROP TABLE IF EXISTS `account_payable_ticket`;

CREATE TABLE `account_payable_ticket` (
  `account_payable_ticket_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(15) unsigned DEFAULT NULL,
  `request_approval_level_id` varchar(20) DEFAULT NULL,
  `request_approval_status_id` varchar(20) DEFAULT NULL,
  `account_payable_ticket_timestamp` bigint(15) unsigned DEFAULT NULL,
  `account_payable_id` bigint(20) unsigned DEFAULT NULL,
  `request_type_id` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`account_payable_ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_ticket` */

insert  into `account_payable_ticket`(`account_payable_ticket_id`,`user_id`,`request_approval_level_id`,`request_approval_status_id`,`account_payable_ticket_timestamp`,`account_payable_id`,`request_type_id`) values (1,7,'dept_head','recommended',1433971672,1,'rfp'),(2,7,'exec_approve','approved',1433972028,1,'rfp'),(3,7,'journal_entry','approved',1433972056,1,'rfp'),(4,7,'cheque_prep','approved',1433972172,1,'rfp'),(5,7,'exec_sign','ready',1433972199,1,'rfp'),(6,7,'cheque_release','signed',1433972213,1,'rfp'),(7,7,'reconciliation','released',1433972229,1,'rfp'),(8,7,'completed','approved',1433972252,1,'rfp'),(9,7,'dept_head','recommended',1433972493,2,'tba'),(10,7,'exec_approve','approved',1433972505,2,'tba'),(11,7,'journal_entry','approved',1433972643,2,'tba'),(12,7,'cheque_prep','approved',1433972665,2,'tba'),(13,7,'exec_sign','ready',1433972718,2,'tba'),(14,7,'cheque_release','signed',1433972728,2,'tba'),(15,7,'liquidate','released',1433972745,2,'tba'),(16,7,'completed','approved',1433972800,2,'tba'),(17,7,'dept_head','recommended',1433972991,3,'rfp'),(18,7,'exec_approve','approved',1433973000,3,'rfp'),(19,7,'journal_entry','approved',1433973017,3,'rfp'),(20,7,'cheque_prep','approved',1433973084,3,'rfp'),(21,7,'exec_sign','ready',1433973101,3,'rfp'),(22,7,'cheque_release','signed',1433973116,3,'rfp'),(23,7,'reconciliation','released',1433973126,3,'rfp'),(24,7,'completed','approved',1433973141,3,'rfp'),(25,7,'dept_head','recommended',1433973193,4,'tba'),(26,7,'exec_approve','approved',1433973199,4,'tba'),(27,7,'journal_entry','approved',1433973227,4,'tba'),(28,7,'cheque_prep','approved',1433973250,4,'tba'),(29,7,'exec_sign','ready',1433973266,4,'tba'),(30,7,'cheque_release','signed',1433973280,4,'tba'),(31,7,'liquidate','released',1433973298,4,'tba'),(32,7,'exec_approve','approved',1433973409,5,'ofv'),(33,7,'cheque_prep','approved',1433973442,5,'ofv'),(34,7,'exec_approve','approved',1433973764,6,'ofv'),(35,7,'cheque_prep','approved',1433973796,6,'ofv'),(36,7,'exec_sign','ready',1433973817,6,'ofv'),(37,7,'cheque_release','signed',1433973833,6,'ofv'),(38,7,'completed','released',1433973844,6,'ofv'),(39,7,'dept_head','recommended',1433974415,7,'tba'),(40,7,'exec_approve','approved',1433974421,7,'tba'),(41,7,'journal_entry','approved',1433974430,7,'tba'),(42,7,'cheque_prep','approved',1433974495,7,'tba'),(43,7,'exec_sign','ready',1433974521,7,'tba'),(44,7,'cheque_release','signed',1433974529,7,'tba'),(45,7,'liquidate','released',1433974541,7,'tba'),(46,7,'exec_approve','approved',1433974562,8,'ofv'),(47,7,'cheque_prep','approved',1433974577,8,'ofv'),(48,7,'exec_sign','ready',1433974589,8,'ofv'),(49,7,'cheque_release','signed',1433974600,8,'ofv'),(50,7,'completed','released',1433974620,8,'ofv'),(51,7,'dept_head','recommended',1433979671,9,'rfp'),(52,7,'exec_approve','approved',1433979702,9,'rfp'),(53,7,'journal_entry','approved',1433979762,9,'rfp'),(54,7,'cheque_prep','approved',1433979915,9,'rfp'),(55,7,'exec_sign','ready',1433979941,9,'rfp'),(56,7,'cheque_release','signed',1433979962,9,'rfp'),(57,7,'reconciliation','released',1433979987,9,'rfp'),(58,7,'completed','approved',1433981137,4,'tba'),(59,7,'dept_head','recommended',1433990122,12,'rfp'),(60,7,'exec_approve','approved',1433990183,12,'rfp'),(61,7,'journal_entry','approved',1433990267,12,'rfp'),(62,7,'cheque_prep','approved',1433990394,12,'rfp'),(63,7,'exec_sign','ready',1433990450,12,'rfp'),(64,7,'cheque_release','signed',1433990478,12,'rfp'),(65,7,'cheque_release','released',1433990533,12,'rfp'),(66,7,'liquidate','reimbursement',1434158669,7,'tba'),(67,7,'cheque_prep','reimbursement',1434158803,7,'tba'),(68,7,'cheque_release','reimbursement',1434158835,7,'tba'),(69,7,'completed','released',1434158853,7,'tba'),(70,7,'','',1434308275,0,'tba'),(71,7,'','',1434308310,0,'tba'),(72,7,'','',1434308357,0,'tba'),(73,7,'','',1434308402,0,'tba'),(74,7,'','',1434308440,0,'tba'),(75,7,'dept_head','recommended',1434308767,18,'rfp'),(76,7,'dept_head','recommended',1434309027,19,'rfp'),(77,7,'exec_approve','approved',1434309042,18,'rfp'),(78,7,'exec_approve','approved',1434309052,17,'tba'),(79,7,'journal_entry','approved',1434309165,18,'rfp'),(80,7,'journal_entry','approved',1434309182,17,'tba'),(81,7,'cheque_prep','approved',1434309805,18,'rfp'),(82,7,'cheque_prep','approved',1434309811,17,'tba'),(83,7,'exec_sign','ready',1434309824,18,'rfp'),(84,7,'exec_sign','ready',1434309834,17,'tba'),(85,7,'cheque_release','signed',1434309843,18,'rfp'),(86,7,'cheque_release','signed',1434309847,17,'tba'),(87,7,'reconciliation','released',1434309881,18,'rfp'),(88,7,'liquidate','released',1434309917,17,'tba'),(89,7,'completed','approved',1434323522,17,'tba'),(90,7,'dept_head','recommended',1434323827,20,'rfp'),(91,7,'dept_head','recommended',1434323913,21,'rfp'),(92,7,'dept_head','recommended',1434324025,22,'rfp'),(93,7,'exec_approve','approved',1434324059,22,'rfp'),(94,7,'exec_approve','approved',1434324063,21,'rfp'),(95,7,'exec_approve','approved',1434324065,20,'rfp'),(96,7,'exec_approve','approved',1434324073,16,'tba'),(97,7,'exec_approve','approved',1434324076,15,'tba'),(98,7,'exec_approve','approved',1434324080,14,'tba'),(99,7,'journal_entry','approved',1434324100,22,'rfp'),(100,7,'journal_entry','approved',1434324154,16,'tba'),(101,7,'journal_entry','approved',1434324163,15,'tba'),(102,7,'journal_entry','approved',1434324183,20,'rfp'),(103,7,'cheque_prep','approved',1434324205,16,'tba'),(104,7,'cheque_prep','approved',1434324210,15,'tba'),(105,7,'dept_head','recommended',1435670897,24,'rfp'),(106,7,'exec_approve','approved',1435670909,24,'rfp'),(107,7,'journal_entry','approved',1435670944,24,'rfp'),(108,7,'cheque_prep','approved',1435671011,24,'rfp'),(109,7,'exec_sign','ready',1435671032,24,'rfp'),(110,7,'cheque_release','signed',1435671041,24,'rfp'),(111,7,'reconciliation','released',1435671053,24,'rfp'),(112,7,'completed','approved',1435671067,24,'rfp'),(113,7,'dept_head','recommended',1435744510,25,'rfp'),(114,7,'exec_approve','approved',1435744534,25,'rfp'),(115,7,'journal_entry','approved',1435744559,25,'rfp'),(116,7,'cheque_prep','approved',1435744601,25,'rfp'),(117,7,'exec_sign','ready',1435744616,25,'rfp'),(118,7,'cheque_release','signed',1435744627,25,'rfp'),(119,7,'reconciliation','released',1435744657,25,'rfp'),(120,7,'dept_head','recommended',1435745534,26,'rfp'),(121,7,'dept_head','recommended',1435745949,27,'rfp'),(122,7,'dept_head','recommended',1435745950,28,'rfp'),(123,7,'dept_head','recommended',1435745952,29,'rfp'),(124,7,'dept_head','recommended',1435745953,30,'rfp');

/*Table structure for table `account_receive` */

DROP TABLE IF EXISTS `account_receive`;

CREATE TABLE `account_receive` (
  `account_receive_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_account_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `lot_id` bigint(20) unsigned DEFAULT '0',
  `project_site_id` bigint(20) unsigned DEFAULT '0',
  `option_income_type_id` varchar(20) DEFAULT NULL,
  `option_payment_method_id` varchar(20) DEFAULT NULL,
  `option_payment_receipt_id` varchar(20) DEFAULT NULL,
  `option_payment_status_id` varchar(20) DEFAULT NULL,
  `option_payment_excess_id` varchar(20) DEFAULT NULL,
  `account_receive_name` varchar(100) DEFAULT NULL,
  `account_receive_payee` varchar(100) DEFAULT NULL,
  `account_receive_address` varchar(200) DEFAULT NULL,
  `account_receive_receipt` varchar(100) DEFAULT NULL,
  `account_receive_amount_gross` double(10,2) unsigned DEFAULT '0.00',
  `account_receive_amount_net` double(10,2) unsigned DEFAULT '0.00',
  `account_receive_amount_vat` double(10,2) unsigned DEFAULT '0.00',
  `account_receive_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`account_receive_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

/*Data for the table `account_receive` */

insert  into `account_receive`(`account_receive_id`,`client_account_id`,`user_id`,`lot_id`,`project_site_id`,`option_income_type_id`,`option_payment_method_id`,`option_payment_receipt_id`,`option_payment_status_id`,`option_payment_excess_id`,`account_receive_name`,`account_receive_payee`,`account_receive_address`,`account_receive_receipt`,`account_receive_amount_gross`,`account_receive_amount_net`,`account_receive_amount_vat`,`account_receive_timestamp`) values (75,19,7,1,1,'reservation','cash','or','valid',NULL,NULL,'Richard Lopez','Pasig City','OR-603',1000.00,892.86,107.14,1435744945),(76,19,7,1,1,'reservation','cash','or','valid',NULL,NULL,'Richard Lopez','Pasig City','OR-604',9000.00,8035.74,964.26,1435744977),(77,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-3499',85533.35,76369.31,9164.04,1435745412),(78,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-604',85533.35,76369.31,9164.04,1435745424),(79,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-419',85533.35,76369.31,9164.04,1435745442),(80,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR118',85533.35,76369.31,9164.04,1435745780),(81,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-6035',108447.60,96828.52,11619.08,1435745815),(82,20,7,2,1,'reservation','cash','or','valid',NULL,NULL,'Brian Cruz','Manila','OR-60352',10000.00,8928.60,1071.40,1435746049),(83,21,7,3,1,'reservation','cash','or','valid',NULL,NULL,'Fred Gomez','Pasig City','OR-6041',10000.00,8928.60,1071.40,1435746512),(84,20,7,2,1,'sale_of_lot','cash','or','valid','return_change','','Brian Cruz',NULL,'OR-6041',252175.00,225156.97,27018.03,1435746820),(85,20,7,2,1,'sale_of_lot','cash','or','valid','return_change','','Brian Cruz',NULL,'OR-6041',252175.01,225156.98,27018.03,1435746833),(86,20,7,2,1,'sale_of_lot','cash','or','valid','return_change','','Brian Cruz',NULL,'OR-60412',50435.00,45031.39,5403.61,1435747788),(87,21,7,3,1,'sale_of_lot','cash','or','valid','return_change','','Fred Gomez',NULL,'OR-60413',70755.00,63174.31,7580.69,1435748105),(88,21,7,3,1,'sale_of_lot','cash','or','valid','return_change','','Fred Gomez',NULL,'OR-60414',70755.00,63174.31,7580.69,1435748119),(89,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-60413',200105.00,178665.75,21439.25,1435748151),(90,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-60412',200105.00,178665.75,21439.25,1435748192),(91,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-60412',200105.00,178665.75,21439.25,1435749116),(92,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-60354',200105.00,178665.75,21439.25,1435749128),(93,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-604144',200105.00,178665.75,21439.25,1435749142),(94,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-604144',200105.00,178665.75,21439.25,1435749152),(95,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-604124',200105.00,178665.75,21439.25,1435749170),(96,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-60344',200105.00,178665.75,21439.25,1435749196),(97,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-6041444',200105.00,178665.75,21439.25,1435749211),(98,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-6041222',200105.00,178665.75,21439.25,1435749281),(99,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-6041222',200105.01,178665.76,21439.25,1435749291),(100,19,7,1,1,'sale_of_lot','cash','or','valid','return_change','','Richard Lopez',NULL,'OR-604133',160028.44,142882.99,17145.45,1435749697),(101,0,7,16,5,'reservation','cash','or','valid',NULL,NULL,'Brian Cruz','Pasig City','OR-6041',10000.00,8928.60,1071.40,1435759879),(102,22,7,16,5,'sale_of_lot','cash','or','valid','return_change','','Martin Carino',NULL,'OR-6041',620460.00,553983.92,66476.08,1435760133),(103,23,7,15,5,'reservation','cash','or','valid',NULL,NULL,'Brian Cruz','Pasig City','OR-60411',1000.00,892.86,107.14,1435761225),(104,23,7,15,5,'sale_of_lot','cash','or','valid','return_change','','Carlo Raymundo',NULL,'OR-604166',565975.00,505336.44,60638.56,1435761412);

/*Table structure for table `account_receive_invoice` */

DROP TABLE IF EXISTS `account_receive_invoice`;

CREATE TABLE `account_receive_invoice` (
  `account_receive_invoice_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_receive_id` bigint(20) unsigned DEFAULT NULL,
  `client_account_id` bigint(20) unsigned DEFAULT NULL,
  `client_account_invoice_id` bigint(20) unsigned DEFAULT NULL,
  `receive_amount` double(10,2) unsigned DEFAULT '0.00',
  `receive_amount_surcharge` double(10,2) unsigned DEFAULT '0.00',
  `receive_amount_interest` double(10,2) unsigned DEFAULT '0.00',
  `receive_amount_principal` double(10,2) unsigned DEFAULT '0.00',
  `receive_amount_rebate` double(10,2) unsigned DEFAULT '0.00',
  `receive_net` double(10,2) unsigned DEFAULT '0.00',
  `receive_net_surcharge` double(10,2) unsigned DEFAULT '0.00',
  `receive_net_interest` double(10,2) unsigned DEFAULT '0.00',
  `receive_net_principal` double(10,2) unsigned DEFAULT '0.00',
  `receive_timestamp` bigint(15) unsigned DEFAULT '0',
  PRIMARY KEY (`account_receive_invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=utf8;

/*Data for the table `account_receive_invoice` */

insert  into `account_receive_invoice`(`account_receive_invoice_id`,`account_receive_id`,`client_account_id`,`client_account_invoice_id`,`receive_amount`,`receive_amount_surcharge`,`receive_amount_interest`,`receive_amount_principal`,`receive_amount_rebate`,`receive_net`,`receive_net_surcharge`,`receive_net_interest`,`receive_net_principal`,`receive_timestamp`) values (115,75,19,2139,1000.00,0.00,0.00,1000.00,0.00,892.86,0.00,0.00,892.86,1435744945),(116,76,19,2140,9000.00,0.00,0.00,9000.00,0.00,8035.74,0.00,0.00,8035.74,1435744977),(117,77,19,2141,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745412),(118,77,19,2142,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745412),(119,77,19,2143,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745412),(120,77,19,2144,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745412),(121,77,19,2145,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745412),(122,78,19,2146,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745424),(123,78,19,2147,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745424),(124,78,19,2148,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745424),(125,78,19,2149,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745424),(126,78,19,2150,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745424),(127,79,19,2151,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745442),(128,79,19,2152,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745442),(129,79,19,2153,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745442),(130,79,19,2154,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745442),(131,79,19,2155,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745442),(132,80,19,2156,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745780),(133,80,19,2157,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745780),(134,80,19,2158,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745780),(135,80,19,2159,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745780),(136,80,19,2160,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745780),(137,81,19,2161,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745815),(138,81,19,2162,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745815),(139,81,19,2163,17106.67,0.00,0.00,17106.67,0.00,15273.86,0.00,0.00,15273.86,1435745815),(140,81,19,2164,17106.59,0.00,0.00,17106.59,0.00,15273.79,0.00,0.00,15273.79,1435745815),(141,81,19,2165,40021.00,0.00,21028.00,18993.00,0.00,35733.15,0.00,18775.06,16958.09,1435745815),(142,82,20,2225,10000.00,0.00,0.00,10000.00,0.00,8928.60,0.00,0.00,8928.60,1435746049),(143,83,21,2286,10000.00,0.00,0.00,10000.00,0.00,8928.60,0.00,0.00,8928.60,1435746512),(144,84,20,2226,50435.00,0.00,26500.00,23935.00,0.00,45031.39,0.00,23660.79,21370.60,1435746820),(145,84,20,2227,50435.00,0.00,26200.81,24234.19,0.00,45031.39,0.00,23393.66,21637.74,1435746820),(146,84,20,2228,50435.00,0.00,25897.89,24537.11,0.00,45031.39,0.00,23123.19,21908.20,1435746820),(147,84,20,2229,50435.00,0.00,25591.17,24843.83,0.00,45031.39,0.00,22849.33,22182.06,1435746820),(148,84,20,2230,50435.00,0.00,25280.62,25154.38,0.00,45031.39,0.00,22572.05,22459.34,1435746820),(149,85,20,2231,50435.00,0.00,24966.19,25468.81,0.00,45031.39,0.00,22291.31,22740.08,1435746833),(150,85,20,2232,50435.00,0.00,24647.83,25787.17,0.00,45031.39,0.00,22007.06,23024.33,1435746833),(151,85,20,2233,50435.00,0.00,24325.49,26109.51,0.00,45031.39,0.00,21719.26,23312.14,1435746833),(152,85,20,2234,50435.01,0.00,23999.13,26435.88,0.00,45031.40,0.00,21427.86,23603.54,1435746833),(153,85,20,2235,50435.00,0.00,23668.68,26766.32,0.00,45031.39,0.00,21132.82,23898.58,1435746833),(154,86,20,2236,50435.00,0.00,23334.10,27100.90,0.00,45031.39,0.00,20834.08,24197.31,1435747788),(155,87,21,2287,14151.00,0.00,7435.00,6716.00,0.00,12634.86,0.00,6638.41,5996.45,1435748105),(156,87,21,2288,14151.00,0.00,7351.05,6799.95,0.00,12634.86,0.00,6563.46,6071.40,1435748105),(157,87,21,2289,14151.00,0.00,7266.05,6884.95,0.00,12634.86,0.00,6487.57,6147.30,1435748105),(158,87,21,2290,14151.00,0.00,7179.99,6971.01,0.00,12634.86,0.00,6410.73,6224.14,1435748105),(159,87,21,2291,14151.00,0.00,7092.85,7058.15,0.00,12634.86,0.00,6332.92,6301.94,1435748105),(160,88,21,2292,14151.00,0.00,7004.62,7146.38,0.00,12634.86,0.00,6254.15,6380.72,1435748119),(161,88,21,2293,14151.00,0.00,6915.29,7235.71,0.00,12634.86,0.00,6174.39,6460.48,1435748119),(162,88,21,2294,14151.00,0.00,6824.85,7326.15,0.00,12634.86,0.00,6093.64,6541.23,1435748119),(163,88,21,2295,14151.00,0.00,6733.27,7417.73,0.00,12634.86,0.00,6011.87,6622.99,1435748119),(164,88,21,2296,14151.00,0.00,6640.55,7510.45,0.00,12634.86,0.00,5929.08,6705.78,1435748119),(165,89,19,2166,40021.00,0.00,20790.59,19230.41,0.00,35733.15,0.00,18563.09,17170.06,1435748151),(166,89,19,2167,40021.00,0.00,20550.21,19470.79,0.00,35733.15,0.00,18348.46,17384.69,1435748151),(167,89,19,2168,40021.00,0.00,20306.82,19714.18,0.00,35733.15,0.00,18131.15,17602.00,1435748151),(168,89,19,2169,40021.00,0.00,20060.40,19960.60,0.00,35733.15,0.00,17911.13,17822.02,1435748151),(169,89,19,2170,40021.00,0.00,19810.89,20210.11,0.00,35733.15,0.00,17688.35,18044.80,1435748151),(170,90,19,2171,40021.00,0.00,19558.26,20462.74,0.00,35733.15,0.00,17462.79,18270.36,1435748192),(171,90,19,2172,40021.00,0.00,19302.48,20718.52,0.00,35733.15,0.00,17234.41,18498.74,1435748192),(172,90,19,2173,40021.00,0.00,19043.50,20977.50,0.00,35733.15,0.00,17003.18,18729.97,1435748192),(173,90,19,2174,40021.00,0.00,18781.28,21239.72,0.00,35733.15,0.00,16769.05,18964.10,1435748192),(174,90,19,2175,40021.00,0.00,18515.78,21505.22,0.00,35733.15,0.00,16532.00,19201.15,1435748192),(175,91,19,2176,40021.00,0.00,18246.97,21774.03,0.00,35733.15,0.00,16291.99,19441.16,1435749116),(176,91,19,2177,40021.00,0.00,17974.79,22046.21,0.00,35733.15,0.00,16048.97,19684.18,1435749116),(177,91,19,2178,40021.00,0.00,17699.21,22321.79,0.00,35733.15,0.00,15802.92,19930.23,1435749116),(178,91,19,2179,40021.00,0.00,17420.19,22600.81,0.00,35733.15,0.00,15553.79,20179.36,1435749116),(179,91,19,2180,40021.00,0.00,17137.68,22883.32,0.00,35733.15,0.00,15301.55,20431.60,1435749116),(180,92,19,2181,40021.00,0.00,16851.64,23169.36,0.00,35733.15,0.00,15046.16,20686.99,1435749128),(181,92,19,2182,40021.00,0.00,16562.02,23458.98,0.00,35733.15,0.00,14787.57,20945.58,1435749128),(182,92,19,2183,40021.00,0.00,16268.78,23752.22,0.00,35733.15,0.00,14525.74,21207.41,1435749128),(183,92,19,2184,40021.00,0.00,15971.88,24049.12,0.00,35733.15,0.00,14260.65,21472.50,1435749128),(184,92,19,2185,40021.00,0.00,15671.27,24349.73,0.00,35733.15,0.00,13992.25,21740.90,1435749128),(185,93,19,2186,40021.00,0.00,15366.90,24654.10,0.00,35733.15,0.00,13720.49,22012.66,1435749142),(186,93,19,2187,40021.00,0.00,15058.72,24962.28,0.00,35733.15,0.00,13445.33,22287.82,1435749142),(187,93,19,2188,40021.00,0.00,14746.69,25274.31,0.00,35733.15,0.00,13166.73,22566.42,1435749142),(188,93,19,2189,40021.00,0.00,14430.76,25590.24,0.00,35733.15,0.00,12884.65,22848.50,1435749142),(189,93,19,2190,40021.00,0.00,14110.88,25910.12,0.00,35733.15,0.00,12599.04,23134.11,1435749142),(190,94,19,2191,40021.00,0.00,13787.01,26233.99,0.00,35733.15,0.00,12309.87,23423.28,1435749152),(191,94,19,2192,40021.00,0.00,13459.08,26561.92,0.00,35733.15,0.00,12017.07,23716.08,1435749152),(192,94,19,2193,40021.00,0.00,13127.06,26893.94,0.00,35733.15,0.00,11720.63,24012.52,1435749152),(193,94,19,2194,40021.00,0.00,12790.88,27230.12,0.00,35733.15,0.00,11420.47,24312.68,1435749152),(194,94,19,2195,40021.00,0.00,12450.51,27570.49,0.00,35733.15,0.00,11116.56,24616.59,1435749152),(195,95,19,2196,40021.00,0.00,12105.88,27915.12,0.00,35733.15,0.00,10808.86,24924.29,1435749170),(196,95,19,2197,40021.00,0.00,11756.94,28264.06,0.00,35733.15,0.00,10497.30,25235.85,1435749170),(197,95,19,2198,40021.00,0.00,11403.64,28617.36,0.00,35733.15,0.00,10181.85,25551.30,1435749170),(198,95,19,2199,40021.00,0.00,11045.92,28975.08,0.00,35733.15,0.00,9862.46,25870.69,1435749170),(199,95,19,2200,40021.00,0.00,10683.73,29337.27,0.00,35733.15,0.00,9539.08,26194.07,1435749170),(200,96,19,2201,40021.00,0.00,10317.02,29703.98,0.00,35733.15,0.00,9211.65,26521.50,1435749196),(201,96,19,2202,40021.00,0.00,9945.72,30075.28,0.00,35733.15,0.00,8880.14,26853.01,1435749196),(202,96,19,2203,40021.00,0.00,9569.77,30451.23,0.00,35733.15,0.00,8544.46,27188.69,1435749196),(203,96,19,2204,40021.00,0.00,9189.13,30831.87,0.00,35733.15,0.00,8204.61,27528.54,1435749196),(204,96,19,2205,40021.00,0.00,8803.74,31217.26,0.00,35733.15,0.00,7860.51,27872.64,1435749196),(205,97,19,2206,40021.00,0.00,8413.52,31607.48,0.00,35733.15,0.00,7512.10,28221.05,1435749211),(206,97,19,2207,40021.00,0.00,8018.43,32002.57,0.00,35733.15,0.00,7159.34,28573.81,1435749211),(207,97,19,2208,40021.00,0.00,7618.39,32402.61,0.00,35733.15,0.00,6802.16,28930.99,1435749211),(208,97,19,2209,40021.00,0.00,7213.36,32807.64,0.00,35733.15,0.00,6440.52,29292.63,1435749211),(209,97,19,2210,40021.00,0.00,6803.27,33217.73,0.00,35733.15,0.00,6074.37,29658.78,1435749211),(210,98,19,2211,40021.00,0.00,6388.04,33632.96,0.00,35733.15,0.00,5703.63,30029.52,1435749281),(211,98,19,2212,40021.00,0.00,5967.63,34053.37,0.00,35733.15,0.00,5328.26,30404.89,1435749281),(212,98,19,2213,40021.00,0.00,5541.97,34479.03,0.00,35733.15,0.00,4948.20,30784.95,1435749281),(213,98,19,2214,40021.00,0.00,5110.98,34910.02,0.00,35733.15,0.00,4563.39,31169.76,1435749281),(214,98,19,2215,40021.00,0.00,4674.60,35346.40,0.00,35733.15,0.00,4173.76,31559.39,1435749281),(215,99,19,2216,40021.00,0.00,4232.77,35788.23,0.00,35733.15,0.00,3779.27,31953.88,1435749291),(216,99,19,2217,40021.00,0.00,3785.42,36235.58,0.00,35733.15,0.00,3379.85,32353.30,1435749291),(217,99,19,2218,40021.01,0.00,3332.48,36688.53,0.00,35733.16,0.00,2975.44,32757.72,1435749291),(218,99,19,2219,40021.00,0.00,2873.87,37147.13,0.00,35733.15,0.00,2565.96,33167.19,1435749291),(219,99,19,2220,40021.00,0.00,2409.53,37611.47,0.00,35733.15,0.00,2151.37,33581.78,1435749291),(220,100,19,2221,40021.00,0.00,1939.39,38081.61,0.00,35733.15,0.00,1731.60,34001.55,1435749697),(221,100,19,2222,40021.00,0.00,1463.37,38557.63,0.00,35733.15,0.00,1306.58,34426.57,1435749697),(222,100,19,2223,40021.00,0.00,981.40,39039.60,0.00,35733.15,0.00,876.25,34856.90,1435749697),(223,100,19,2224,39965.44,0.00,493.40,39472.04,0.00,35683.54,0.00,440.54,35243.01,1435749697),(224,101,0,2347,10000.00,0.00,0.00,10000.00,0.00,8928.60,0.00,0.00,8928.60,1435759879),(225,102,22,2348,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,1435760133),(226,102,22,2349,620460.00,0.00,7660.00,612800.00,0.00,553983.92,0.00,6839.31,547144.61,1435760133),(227,103,23,2350,1000.00,0.00,0.00,1000.00,0.00,892.86,0.00,0.00,892.86,1435761225),(228,104,23,2351,1000.00,0.00,0.00,1000.00,0.00,892.86,0.00,0.00,892.86,1435761412),(229,104,23,2352,564975.00,0.00,6975.00,558000.00,0.00,504443.58,0.00,6227.70,498215.88,1435761412);

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `bank_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(125) DEFAULT NULL,
  `bank_account_type` varchar(15) DEFAULT 'Peso',
  `bank_branch` varchar(125) DEFAULT NULL,
  `bank_swift_code` varchar(125) DEFAULT 'N/A',
  `bank_contact_number` varchar(25) DEFAULT 'N/A',
  `bank_website` varchar(250) DEFAULT 'N/A',
  `bank_address` varchar(450) DEFAULT 'N/A',
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `bank` */

insert  into `bank`(`bank_id`,`bank_name`,`bank_account_type`,`bank_branch`,`bank_swift_code`,`bank_contact_number`,`bank_website`,`bank_address`) values (1,'BPI','Peso','Malolos','UFX-1144','+63-02-123-4567','http://www.bpi.com.ph','Bank of the Philippine Islands, Malolos Branch MacArthur Highway, Malolos, Bulacan'),(2,'PNB','Peso','San Miguel','CXA-123','+63-02-123-4567','http://www.pnb.com.ph','Philippine National Bank, Malolos Branch MacArthur Highway, Malolos, Bulacan'),(3,'RCBC','Peso','Plaridel','444-2234','+63-02-123-4567','http://www.rcbc.com.ph','Rizal Commercial Banking Corporation , Malolos Branch MacArthur Highway, Malolos, Bulacan'),(4,'UCPB','Peso','Malolos','CCFV-1457','+63-02-123-4567','http://www.ucpb.com.ph','United Coconut Planters Bank, Malolos Branch MacArthur Highway, Malolos, Bulacan'),(5,'Landbank','Peso','Malolos','AFC-1561','+63-02-123-4567','http://www.landbank.com.ph','Landbank of the Philippines, Malolos Branch MacArthur Highway, Malolos, Bulacan'),(6,'OFV','Peso','N/A','N/A','+63-02-123-4567','N/A','N/A'),(7,'Collections','Peso','N/A','N/A','N/A','N/A','N/A'),(8,'Contingency','Peso','N/A','N/A','N/A','N/A','N/A');

/*Table structure for table `bank_jv` */

DROP TABLE IF EXISTS `bank_jv`;

CREATE TABLE `bank_jv` (
  `bank_jv_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `bank_transaction_id` bigint(15) DEFAULT NULL,
  `jv_type_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`bank_jv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `bank_jv` */

insert  into `bank_jv`(`bank_jv_id`,`bank_transaction_id`,`jv_type_id`) values (1,92,'adjustment'),(2,95,''),(3,101,'withholding_tax'),(4,158,'adjustment');

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
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8;

/*Data for the table `bank_transaction` */

insert  into `bank_transaction`(`bank_transaction_id`,`bank_id`,`bank_pair_id`,`account_payable_id`,`option_bank_transaction_type_id`,`bank_transaction_amount`,`option_bank_transaction_category_id`,`bank_transaction_timestamp`,`bank_transaction_depositor`,`bank_transaction_details`,`handled_by`,`is_pending`) values (47,7,NULL,0,'in',10000.00,'cashier',1433965222,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=35\">View Account</a>','Computer Genterated',0),(48,7,NULL,0,'in',16375.00,'cashier',1433965723,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=36\">View Account</a>','Computer Genterated',0),(49,7,NULL,0,'in',10000.00,'cashier',1433965788,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=37\">View Account</a>','Computer Genterated',0),(50,7,NULL,0,'in',10000.00,'cashier',1433967601,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=38\">View Account</a>','Computer Genterated',0),(51,7,NULL,0,'in',71875.00,'cashier',1433967867,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=39\">View Account</a>','Computer Genterated',0),(52,7,NULL,0,'in',81875.00,'cashier',1433967883,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=40\">View Account</a>','Computer Genterated',0),(53,7,NULL,0,'in',81875.00,'cashier',1433967904,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=41\">View Account</a>','Computer Genterated',0),(58,7,NULL,0,'in',81875.00,'cashier',1433968363,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=42\">View Account</a>','Computer Genterated',0),(59,7,NULL,0,'in',101141.01,'cashier',1433968380,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=43\">View Account</a>','Computer Genterated',0),(64,7,NULL,0,'in',3708.33,'cashier',1433969302,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=44\">View Account</a>','Computer Genterated',0),(65,1,NULL,1,'out',12090.00,'disbursement',1433972229,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(66,1,NULL,NULL,'in',100000.00,'cash_on_hand',1433972539,'Vincent Borlongan','','Annielle Madrid',0),(67,5,NULL,NULL,'in',100000.00,'cash_on_hand',1433972566,'Vincent Borlongan','','Annielle Madrid',0),(68,6,NULL,NULL,'in',100000.00,'cash_on_hand',1433972580,'Vincent Borlongan','','Annielle Madrid',0),(69,2,NULL,NULL,'in',100000.00,'cash_on_hand',1433972593,'Vincent Borlongan','','Annielle Madrid',0),(70,3,NULL,NULL,'in',100000.00,'cash_on_hand',1433972604,'Vincent Borlongan','','Annielle Madrid',0),(71,4,NULL,NULL,'in',100000.00,'cash_on_hand',1433972617,'Arvin Alejandro','','Annielle Madrid',0),(72,6,NULL,2,'out',16000.87,'disbursement',1433972744,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(73,6,NULL,3,'out',18365.25,'disbursement',1433973126,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(74,5,NULL,4,'out',15987.98,'disbursement',1433973298,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(75,6,4,6,'in',34366.12,'fund_transfer_in',1433973844,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(76,4,6,6,'out',34366.12,'fund_transfer_out',1433973844,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(77,6,NULL,7,'out',12000.00,'disbursement',1433974541,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(78,6,3,8,'in',12000.00,'fund_transfer_in',1433974619,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(79,3,6,8,'out',12000.00,'fund_transfer_out',1433974620,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(80,7,1,NULL,'out',25000.00,'fund_transfer_out',1433978213,NULL,'','Annielle Madrid',0),(81,1,7,NULL,'in',25000.00,'fund_transfer_in',1433978213,NULL,'','Annielle Madrid',0),(82,7,2,NULL,'out',43000.00,'fund_transfer_out',1433978238,NULL,'','Annielle Madrid',0),(83,2,7,NULL,'in',43000.00,'fund_transfer_in',1433978238,NULL,'','Annielle Madrid',0),(84,7,NULL,0,'in',10000.00,'cashier',1433978983,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=45\">View Account</a>','Computer Genterated',0),(85,7,NULL,0,'in',51200.01,'cashier',1433979404,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=46\">View Account</a>','Computer Genterated',0),(86,7,NULL,0,'in',85333.35,'cashier',1433979511,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=47\">View Account</a>','Computer Genterated',0),(87,7,NULL,0,'in',85333.35,'cashier',1433979525,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=48\">View Account</a>','Computer Genterated',0),(91,2,NULL,9,'out',6294.00,'disbursement',1433979987,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',1),(92,1,NULL,NULL,'out',5000.00,'tax_out',1433980707,NULL,NULL,'Annielle Madrid',0),(93,7,1,NULL,'out',100000.00,'fund_transfer_out',1433980905,NULL,'Collection Yesterday','Annielle Madrid',0),(94,1,7,NULL,'in',100000.00,'fund_transfer_in',1433980905,NULL,'Collection Yesterday','Annielle Madrid',0),(95,1,NULL,NULL,'out',5000.00,'adjustment_out',1433980946,NULL,NULL,'Annielle Madrid',0),(96,1,NULL,12,'out',50000.00,'disbursement',1433990533,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(97,6,NULL,7,'out',4500.00,'disbursement',1434158853,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(98,1,NULL,18,'out',350000.00,'disbursement',1434309881,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',1),(99,1,NULL,NULL,'in',500000.00,'cash_on_hand',1434309891,'Vincent Borlongan','','Annielle Madrid',0),(100,6,NULL,17,'out',90000.00,'disbursement',1434309917,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(101,1,NULL,NULL,'out',5000.00,'tax_out',1434324258,NULL,NULL,'Annielle Madrid',0),(102,1,NULL,24,'out',350000.00,'disbursement',1435671053,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(103,7,NULL,0,'in',85541.70,'cashier',1435741974,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=49\">View Account</a>','Computer Genterated',0),(104,7,NULL,0,'in',85541.70,'cashier',1435742111,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=50\">View Account</a>','Computer Genterated',0),(105,7,NULL,0,'in',85541.70,'cashier',1435742150,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=51\">View Account</a>','Computer Genterated',0),(106,7,NULL,0,'in',85541.70,'cashier',1435742330,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=52\">View Account</a>','Computer Genterated',0),(107,7,NULL,0,'in',85541.70,'cashier',1435742519,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=53\">View Account</a>','Computer Genterated',0),(108,7,NULL,0,'in',85541.70,'cashier',1435742582,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=54\">View Account</a>','Computer Genterated',0),(109,7,NULL,0,'in',85541.70,'cashier',1435742657,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=55\">View Account</a>','Computer Genterated',0),(110,7,NULL,0,'in',85541.70,'cashier',1435742710,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=56\">View Account</a>','Computer Genterated',0),(111,7,NULL,0,'in',85541.70,'cashier',1435742744,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=57\">View Account</a>','Computer Genterated',0),(112,7,NULL,0,'in',85541.70,'cashier',1435742766,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=58\">View Account</a>','Computer Genterated',0),(113,7,NULL,0,'in',136566.87,'cashier',1435742779,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=59\">View Account</a>','Computer Genterated',0),(114,7,NULL,0,'in',213105.00,'cashier',1435743207,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=60\">View Account</a>','Computer Genterated',0),(115,7,NULL,0,'in',0.00,'cashier',1435743219,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=61\">View Account</a>','Computer Genterated',0),(116,7,NULL,0,'in',213105.00,'cashier',1435743233,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=62\">View Account</a>','Computer Genterated',0),(117,7,NULL,0,'in',42621.00,'cashier',1435743458,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=63\">View Account</a>','Computer Genterated',0),(118,7,NULL,0,'in',42621.00,'cashier',1435743486,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=64\">View Account</a>','Computer Genterated',0),(119,7,NULL,0,'in',42621.00,'cashier',1435743535,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=65\">View Account</a>','Computer Genterated',0),(120,7,NULL,0,'in',42621.00,'cashier',1435743557,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=66\">View Account</a>','Computer Genterated',0),(121,7,NULL,0,'in',42621.00,'cashier',1435743783,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=70\">View Account</a>','Computer Genterated',0),(122,7,NULL,0,'in',42621.00,'cashier',1435743796,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=71\">View Account</a>','Computer Genterated',0),(123,7,NULL,0,'in',42621.00,'cashier',1435743815,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=72\">View Account</a>','Computer Genterated',0),(124,7,NULL,0,'in',42621.00,'cashier',1435743827,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=73\">View Account</a>','Computer Genterated',0),(125,7,NULL,0,'in',42621.00,'cashier',1435743838,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=74\">View Account</a>','Computer Genterated',0),(126,1,NULL,25,'out',524.50,'disbursement',1435744657,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(127,7,NULL,0,'in',1000.00,'cashier',1435744945,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=75\">View Account</a>','Computer Genterated',0),(128,7,NULL,0,'in',9000.00,'cashier',1435744977,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=76\">View Account</a>','Computer Genterated',0),(129,7,NULL,0,'in',85533.35,'cashier',1435745412,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=77\">View Account</a>','Computer Genterated',0),(130,7,NULL,0,'in',85533.35,'cashier',1435745424,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=78\">View Account</a>','Computer Genterated',0),(131,7,NULL,0,'in',85533.35,'cashier',1435745442,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=79\">View Account</a>','Computer Genterated',0),(132,7,NULL,0,'in',85533.35,'cashier',1435745780,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=80\">View Account</a>','Computer Genterated',0),(133,7,NULL,0,'in',108447.60,'cashier',1435745815,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=81\">View Account</a>','Computer Genterated',0),(134,7,NULL,0,'in',10000.00,'cashier',1435746049,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=82\">View Account</a>','Computer Genterated',0),(135,7,NULL,0,'in',10000.00,'cashier',1435746512,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=83\">View Account</a>','Computer Genterated',0),(136,7,NULL,0,'in',252175.00,'cashier',1435746820,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=84\">View Account</a>','Computer Genterated',0),(137,7,NULL,0,'in',252175.01,'cashier',1435746833,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=85\">View Account</a>','Computer Genterated',0),(138,7,NULL,0,'in',50435.00,'cashier',1435747788,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=86\">View Account</a>','Computer Genterated',0),(139,7,NULL,0,'in',70755.00,'cashier',1435748105,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=87\">View Account</a>','Computer Genterated',0),(140,7,NULL,0,'in',70755.00,'cashier',1435748119,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=88\">View Account</a>','Computer Genterated',0),(141,7,NULL,0,'in',200105.00,'cashier',1435748151,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=89\">View Account</a>','Computer Genterated',0),(142,7,NULL,0,'in',200105.00,'cashier',1435748192,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=90\">View Account</a>','Computer Genterated',0),(143,7,NULL,0,'in',200105.00,'cashier',1435749116,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=91\">View Account</a>','Computer Genterated',0),(144,7,NULL,0,'in',200105.00,'cashier',1435749128,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=92\">View Account</a>','Computer Genterated',0),(145,7,NULL,0,'in',200105.00,'cashier',1435749142,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=93\">View Account</a>','Computer Genterated',0),(146,7,NULL,0,'in',200105.00,'cashier',1435749152,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=94\">View Account</a>','Computer Genterated',0),(147,7,NULL,0,'in',200105.00,'cashier',1435749170,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=95\">View Account</a>','Computer Genterated',0),(148,7,NULL,0,'in',200105.00,'cashier',1435749196,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=96\">View Account</a>','Computer Genterated',0),(149,7,NULL,0,'in',200105.00,'cashier',1435749211,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=97\">View Account</a>','Computer Genterated',0),(150,7,NULL,0,'in',200105.00,'cashier',1435749281,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=98\">View Account</a>','Computer Genterated',0),(151,7,NULL,0,'in',200105.01,'cashier',1435749291,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=99\">View Account</a>','Computer Genterated',0),(152,7,NULL,0,'in',160028.44,'cashier',1435749698,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=100\">View Account</a>','Computer Genterated',0),(153,8,NULL,0,'in',0.13,'commission_contingency',1435751872,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"http://alsc/sales/commission/profile/&id=1&c_id=19&entry_type=single\">View Commission Profile</a>','Computer Genterated',0),(154,7,NULL,0,'in',10000.00,'cashier',1435759879,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=101\">View Account</a>','Computer Genterated',0),(155,7,NULL,0,'in',620460.00,'cashier',1435760133,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=102\">View Account</a>','Computer Genterated',0),(156,7,NULL,0,'in',1000.00,'cashier',1435761226,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=103\">View Account</a>','Computer Genterated',0),(157,7,NULL,0,'in',565975.00,'cashier',1435761412,NULL,'<a target=\"_blank\" class=\"link_button_inline blue\" href=\"/finance_cashier/transaction/profile/&id=104\">View Account</a>','Computer Genterated',0),(158,1,NULL,NULL,'out',320000.15,'bank_charge_bdo',1435787550,NULL,NULL,'Annielle Madrid',0),(159,1,NULL,NULL,'in',500000.00,'cash_on_hand',1435787665,'Mizel delos Santos','','Annielle Madrid',0),(160,1,3,NULL,'out',100000.00,'fund_transfer_out',1435787733,NULL,'','Annielle Madrid',0),(161,3,1,NULL,'in',100000.00,'fund_transfer_in',1435787733,NULL,'','Annielle Madrid',0);

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `client_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_name` varchar(100) DEFAULT NULL,
  `client_surname` varchar(100) DEFAULT NULL,
  `client_middle_name` varchar(50) DEFAULT NULL,
  `client_address` varchar(1000) DEFAULT NULL,
  `client_address_abroad` varchar(1000) DEFAULT NULL,
  `option_client_address_id` varchar(20) DEFAULT NULL COMMENT 'client_address or client_address_abroad',
  `client_city` varchar(100) DEFAULT NULL,
  `client_zip` varchar(50) DEFAULT NULL,
  `client_telephone` varchar(200) DEFAULT NULL,
  `client_mobile` varchar(200) DEFAULT NULL,
  `client_email` varchar(100) DEFAULT NULL,
  `client_birthday` bigint(15) unsigned DEFAULT NULL,
  `option_gender_id` varchar(20) DEFAULT NULL,
  `client_birth_place` varchar(100) DEFAULT NULL,
  `option_employment_id` varchar(20) DEFAULT NULL,
  `option_civil_status_id` varchar(20) DEFAULT NULL,
  `client_tin` varchar(50) DEFAULT NULL,
  `client_sss` varchar(50) DEFAULT NULL,
  `client_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Data for the table `client` */

insert  into `client`(`client_id`,`user_id`,`client_name`,`client_surname`,`client_middle_name`,`client_address`,`client_address_abroad`,`option_client_address_id`,`client_city`,`client_zip`,`client_telephone`,`client_mobile`,`client_email`,`client_birthday`,`option_gender_id`,`client_birth_place`,`option_employment_id`,`option_civil_status_id`,`client_tin`,`client_sss`,`client_timestamp`) values (22,7,'Richard','Lopez','W.','Pasig City','Los Angeles California','local','Pasig','1600','6228020','0912341231','rick@yahoo.com',1436457600,'male','Pasig City','employed','married','11-11-11-11','222-2222-222',1435745255),(23,7,'Brian','Cruz','C.','Pasig City','Los Angeles California','local','Pasig','1600','6428081','0912341231','rick@yahoo.com',1435766400,'male','Pasig City','self_employed','single','11-11-11-11','123-123-123-123',1435746198),(24,7,'Fred','Gomez','W.','Pasig City','Los Angeles California','local','Pasig','1600','6428081','090150912506','fred@gmail.com',1437494400,'male','Pasig City','employed','married','11-11-11-11','123-123-123-123',1435746670),(25,7,'Martin','Carino','A.','L4B3 Mandaluyong City','Las Vegas Nevada','local','Mandaluyong','1600','6428081','0912341231','mart@yahoo.com',1437494400,'male','Mandaluyong City','self_employed','married','1234-1234-1234','222-2222-222',1435760076),(26,7,'Carlo','Raymundo','S.','Pasig City','Los Angeles California','local','Pasig','1600','6428081','0912341231','carl@yahoo.com',1435852800,'male','Pasig City','employed','single','11-11-11-11','222-2222-222',1435761351);

/*Table structure for table `client_account` */

DROP TABLE IF EXISTS `client_account`;

CREATE TABLE `client_account` (
  `client_account_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `lot_id` bigint(20) unsigned DEFAULT NULL,
  `commission_scheme_id` varchar(25) DEFAULT NULL,
  `option_scheme_finance_type_id` varchar(25) DEFAULT NULL,
  `option_unit_account_type_id` varchar(50) DEFAULT NULL,
  `option_transaction_type_id` varchar(20) DEFAULT NULL,
  `option_account_type_id` varchar(20) DEFAULT NULL,
  `option_account_status_id` varchar(20) DEFAULT NULL,
  `option_buyer_type_id` varchar(20) DEFAULT NULL,
  `client_account_structure_id` bigint(20) unsigned DEFAULT '0',
  `client_account_number` varchar(50) DEFAULT NULL,
  `client_account_is_vat` tinyint(1) unsigned DEFAULT '0',
  `client_account_date_sale` bigint(15) unsigned DEFAULT NULL,
  `client_account_discount` double(5,2) unsigned DEFAULT NULL,
  `client_account_discount_amount` double(10,2) unsigned DEFAULT NULL,
  `client_account_lcp` double(10,2) unsigned DEFAULT NULL,
  `client_account_lcp_net` double(10,2) unsigned DEFAULT NULL,
  `client_account_hcp` double(10,2) unsigned DEFAULT NULL,
  `client_account_soil_poison` double(10,2) unsigned DEFAULT NULL,
  `client_account_added_cost` double(10,2) unsigned DEFAULT NULL,
  `client_account_added_cost_desc` varchar(500) DEFAULT NULL,
  `client_account_tcp_net` double(10,2) unsigned DEFAULT NULL,
  `client_account_misc_fee` double(10,2) unsigned DEFAULT NULL,
  `client_account_reservation_paid` double(10,2) unsigned DEFAULT NULL,
  `client_account_dp_percent` double(5,2) unsigned DEFAULT NULL,
  `client_account_dp_amount` double(10,2) unsigned DEFAULT NULL,
  `client_account_dp_net` double(10,2) unsigned DEFAULT NULL,
  `client_account_dp_total` double(10,2) unsigned DEFAULT NULL,
  `option_account_p1_id` varchar(20) DEFAULT NULL,
  `client_account_dp_due_date` bigint(15) unsigned DEFAULT NULL,
  `option_account_misc_id` varchar(20) DEFAULT 'full',
  `client_account_misc_fee_monthly` double(10,2) unsigned DEFAULT '0.00',
  `client_account_dp_term` smallint(5) unsigned DEFAULT NULL,
  `client_account_dp_monthly` double(10,2) unsigned DEFAULT NULL,
  `client_account_dp_balance_collected_amount` double(10,2) unsigned DEFAULT '0.00',
  `client_account_dp_balance_remaining_amount` double(10,2) unsigned DEFAULT '0.00',
  `client_account_agent_commission_percent` double(5,2) unsigned DEFAULT NULL,
  `client_account_agent_commission_amount` double(10,2) unsigned DEFAULT NULL,
  `option_account_p2_id` varchar(20) DEFAULT NULL,
  `network_id` bigint(20) unsigned DEFAULT NULL,
  `network_division_id` bigint(20) unsigned DEFAULT NULL,
  `agent_id` bigint(20) unsigned DEFAULT NULL,
  `avp_id` bigint(20) DEFAULT NULL,
  `sales_director_id` bigint(20) DEFAULT NULL,
  `sales_manager_id` bigint(20) DEFAULT NULL,
  `client_account_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`client_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `client_account` */

insert  into `client_account`(`client_account_id`,`client_id`,`user_id`,`lot_id`,`commission_scheme_id`,`option_scheme_finance_type_id`,`option_unit_account_type_id`,`option_transaction_type_id`,`option_account_type_id`,`option_account_status_id`,`option_buyer_type_id`,`client_account_structure_id`,`client_account_number`,`client_account_is_vat`,`client_account_date_sale`,`client_account_discount`,`client_account_discount_amount`,`client_account_lcp`,`client_account_lcp_net`,`client_account_hcp`,`client_account_soil_poison`,`client_account_added_cost`,`client_account_added_cost_desc`,`client_account_tcp_net`,`client_account_misc_fee`,`client_account_reservation_paid`,`client_account_dp_percent`,`client_account_dp_amount`,`client_account_dp_net`,`client_account_dp_total`,`option_account_p1_id`,`client_account_dp_due_date`,`option_account_misc_id`,`client_account_misc_fee_monthly`,`client_account_dp_term`,`client_account_dp_monthly`,`client_account_dp_balance_collected_amount`,`client_account_dp_balance_remaining_amount`,`client_account_agent_commission_percent`,`client_account_agent_commission_amount`,`option_account_p2_id`,`network_id`,`network_division_id`,`agent_id`,`avp_id`,`sales_director_id`,`sales_manager_id`,`client_account_timestamp`) values (19,22,7,1,'','','package','regular','local','retention','agent',20,'1-001-001-201',1,1437062400,1.20,7200.00,600000.00,592800.00,1500000.00,5000.00,5000.00,'Other Fees',2102800.00,10000.00,10000.00,20.00,420560.00,410560.00,430560.00,'partial_dp',1436889600,'full',0.00,24,17106.67,0.00,0.00,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,1435745255),(20,23,7,2,'','','package','offset','local','reservation','agent',21,'1-001-002-201',1,1439395200,0.00,0.00,600000.00,600000.00,1500000.00,10000.00,10000.00,'Other Fees',2120000.00,0.00,0.00,0.00,0.00,0.00,0.00,'no_dp',0,'full',0.00,0,0.00,0.00,0.00,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,1435746198),(21,24,7,3,'','','lot_only','lease_to_own','local','ejected','agent',22,'1-001-003-101',1,1442246400,1.20,7200.00,600000.00,592800.00,0.00,1000.00,1000.00,'Other Fees',594800.00,0.00,0.00,0.00,0.00,0.00,0.00,'no_dp',0,'full',0.00,0,0.00,0.00,0.00,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,1435746670),(22,25,7,16,'','','lot_only','offset','local','fully_paid','agent',23,'1-001-004-101',1,1444752000,1.20,7200.00,600000.00,592800.00,0.00,10000.00,10000.00,'Other Fees',612800.00,0.00,0.00,0.00,0.00,0.00,0.00,'spot_cash',1436889600,'full',0.00,1,0.00,0.00,0.00,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,1435760076),(23,26,7,15,'','','lot_only','thru_loan','local','fully_paid','agent',24,'1-001-003-101',1,1447689600,10.00,60000.00,600000.00,540000.00,0.00,10000.00,10000.00,'Other Fees',560000.00,0.00,1000.00,0.00,0.00,1000.00,0.00,'spot_cash',1436889600,'full',0.00,1,1000.00,0.00,0.00,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,1435761351);

/*Table structure for table `client_account_agent` */

DROP TABLE IF EXISTS `client_account_agent`;

CREATE TABLE `client_account_agent` (
  `client_account_agent_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `client_account_id` int(9) unsigned DEFAULT NULL,
  `sales_agent_id` int(9) unsigned DEFAULT NULL,
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
  `sales_commission_scheme_trigger_id` int(9) DEFAULT NULL,
  `option_entry_type_id` varchar(15) DEFAULT 'single',
  `commission_percentage` double(5,2) DEFAULT NULL,
  `contingency_released` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`client_account_agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

/*Data for the table `client_account_agent` */

insert  into `client_account_agent`(`client_account_agent_id`,`client_account_id`,`sales_agent_id`,`user_id`,`client_account_agent_commission_percent_current`,`client_account_agent_commission_amount_current`,`client_account_agent_commission_amount_net`,`client_account_agent_commission_tax_percent`,`client_account_agent_commission_tax_amount`,`client_account_agent_commission_contingency`,`client_account_agent_timestamp`,`is_approved`,`approve_date`,`sales_commission_scheme_trigger_id`,`option_entry_type_id`,`commission_percentage`,`contingency_released`) values (1,19,23,0,10.00,525.70,473.00,10.00,52.57,0.13,1435745442,1,1435745534,1,'single',0.25,0),(2,19,22,0,10.00,3679.90,3311.00,10.00,367.99,0.91,1435745442,1,1435745953,1,'consolidated',1.75,0),(3,19,16,0,10.00,2102.80,1892.00,10.00,210.28,0.52,1435745442,1,1435745952,1,'consolidated',1.00,0),(4,19,19,0,10.00,6308.40,5677.00,10.00,630.84,0.56,1435745442,1,1435745951,1,'consolidated',3.00,0),(5,19,23,0,10.00,525.70,473.13,10.00,52.57,0.13,1435745816,1,1435745949,2,'single',0.25,0),(6,19,22,0,10.00,3679.90,3311.91,10.00,367.99,0.91,1435745816,1,1435745953,2,'consolidated',1.75,0),(7,19,16,0,10.00,2102.80,1892.52,10.00,210.28,0.52,1435745816,1,1435745952,2,'consolidated',1.00,0),(8,19,19,0,10.00,6308.40,5677.56,10.00,630.84,0.56,1435745816,1,1435745951,2,'consolidated',3.00,0),(9,NULL,NULL,NULL,NULL,12616.80,11354.56,NULL,1261.68,NULL,1435745929,1,1435745951,NULL,'group',NULL,0),(10,NULL,NULL,NULL,NULL,4205.60,3784.52,NULL,420.56,NULL,1435745935,1,1435745952,NULL,'group',NULL,0),(11,NULL,NULL,NULL,NULL,7359.80,6622.91,NULL,735.98,NULL,1435745941,1,1435745953,NULL,'group',NULL,0),(15,20,21,0,10.00,2120.00,1908.00,10.00,212.00,0.00,1435747788,0,NULL,7,'single',1.00,0),(16,20,17,0,10.00,4240.00,3816.00,10.00,424.00,0.00,1435747788,0,NULL,7,'single',2.00,0),(17,20,26,0,10.00,6360.00,5724.00,10.00,636.00,0.00,1435747788,0,NULL,7,'single',3.00,0),(18,21,24,0,10.00,594.80,535.32,10.00,59.48,0.32,1435748119,0,NULL,7,'single',1.00,0),(19,21,17,0,10.00,2974.00,2676.60,10.00,297.40,0.60,1435748119,0,NULL,7,'single',5.00,0),(20,19,23,0,50.00,2628.50,2365.65,10.00,262.85,0.65,1435749211,0,NULL,3,'single',0.25,0),(21,19,22,0,50.00,18399.50,16559.55,10.00,1839.95,0.55,1435749211,0,NULL,3,'single',1.75,0),(22,19,16,0,50.00,10514.00,9462.60,10.00,1051.40,0.60,1435749211,0,NULL,3,'single',1.00,0),(23,19,19,0,50.00,31542.00,28387.80,10.00,3154.20,0.80,1435749212,0,NULL,3,'single',3.00,0),(24,22,23,0,10.00,153.20,137.88,10.00,15.32,0.88,1435760134,0,NULL,1,'single',0.25,0),(25,22,17,0,10.00,1072.40,965.16,10.00,107.24,0.16,1435760134,0,NULL,1,'single',1.75,0),(26,22,16,0,10.00,612.80,551.52,10.00,61.28,0.52,1435760134,0,NULL,1,'single',1.00,0),(27,22,18,0,10.00,1838.40,1654.56,10.00,183.84,0.56,1435760134,0,NULL,1,'single',3.00,0),(28,22,23,0,10.00,153.20,137.88,10.00,15.32,0.88,1435760134,0,NULL,2,'single',0.25,0),(29,22,17,0,10.00,1072.40,965.16,10.00,107.24,0.16,1435760134,0,NULL,2,'single',1.75,0),(30,22,16,0,10.00,612.80,551.52,10.00,61.28,0.52,1435760134,0,NULL,2,'single',1.00,0),(31,22,18,0,10.00,1838.40,1654.56,10.00,183.84,0.56,1435760134,0,NULL,2,'single',3.00,0),(32,22,23,0,50.00,766.00,689.40,10.00,76.60,0.40,1435760134,0,NULL,3,'single',0.25,0),(33,22,17,0,50.00,5362.00,4825.80,10.00,536.20,0.80,1435760134,0,NULL,3,'single',1.75,0),(34,22,16,0,50.00,3064.00,2757.60,10.00,306.40,0.60,1435760134,0,NULL,3,'single',1.00,0),(35,22,18,0,50.00,9192.00,8272.80,10.00,919.20,0.80,1435760134,0,NULL,3,'single',3.00,0),(36,22,23,0,30.00,459.60,413.64,10.00,45.96,0.64,1435760134,0,NULL,4,'single',0.25,0),(37,22,17,0,30.00,3217.20,2895.48,10.00,321.72,0.48,1435760134,0,NULL,4,'single',1.75,0),(38,22,16,0,30.00,1838.40,1654.56,10.00,183.84,0.56,1435760134,0,NULL,4,'single',1.00,0),(39,22,18,0,30.00,5515.20,4963.68,10.00,551.52,0.68,1435760135,0,NULL,4,'single',3.00,0),(40,23,23,7,80.00,1120.00,1008.00,10.00,112.00,0.00,1435761413,0,NULL,6,'single',0.25,0),(41,23,24,7,80.00,7840.00,7056.00,10.00,784.00,0.00,1435761413,0,NULL,6,'single',1.75,0),(42,23,16,7,80.00,4480.00,4032.00,10.00,448.00,0.00,1435761413,0,NULL,6,'single',1.00,0),(43,23,25,7,80.00,13440.00,12096.00,10.00,1344.00,0.00,1435761413,0,NULL,6,'single',3.00,0);

/*Table structure for table `client_account_agent_consolidate` */

DROP TABLE IF EXISTS `client_account_agent_consolidate`;

CREATE TABLE `client_account_agent_consolidate` (
  `client_account_agent_consolidate_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `group_client_account_agent_id` bigint(15) DEFAULT NULL,
  `client_account_agent_id` bigint(15) DEFAULT NULL,
  PRIMARY KEY (`client_account_agent_consolidate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `client_account_agent_consolidate` */

insert  into `client_account_agent_consolidate`(`client_account_agent_consolidate_id`,`group_client_account_agent_id`,`client_account_agent_id`) values (1,9,4),(2,9,8),(3,10,3),(4,10,7),(5,11,2),(6,11,6);

/*Table structure for table `client_account_invoice` */

DROP TABLE IF EXISTS `client_account_invoice`;

CREATE TABLE `client_account_invoice` (
  `client_account_invoice_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `client_account_id` bigint(20) unsigned DEFAULT NULL,
  `client_account_structure_id` bigint(20) unsigned DEFAULT NULL,
  `client_account_invoice_number` int(10) unsigned DEFAULT NULL,
  `client_account_invoice_is_late` tinyint(1) unsigned DEFAULT '0',
  `option_invoice_status_id` varchar(20) DEFAULT 'pending',
  `option_account_invoice_type_id` varchar(20) DEFAULT NULL,
  `client_account_invoice_recurr` tinyint(1) unsigned DEFAULT '1',
  `client_account_invoice_recurr_count` int(10) unsigned DEFAULT NULL,
  `client_account_invoice_balance_amount` double(10,2) unsigned DEFAULT '0.00',
  `client_account_invoice_amount` double(10,2) unsigned DEFAULT '0.00',
  `client_account_invoice_amount_collected` double(10,2) unsigned DEFAULT '0.00',
  `client_account_invoice_rebate_amount` double(10,2) unsigned DEFAULT '0.00',
  `client_account_invoice_rebate_amount_collected` double(10,2) unsigned DEFAULT '0.00',
  `client_account_invoice_principal_amount` double(10,2) unsigned DEFAULT '0.00',
  `client_account_invoice_principal_amount_collected` double(10,2) unsigned DEFAULT '0.00',
  `client_account_invoice_interest_amount` double(10,2) unsigned DEFAULT '0.00',
  `client_account_invoice_interest_amount_collected` double(10,2) unsigned DEFAULT '0.00',
  `client_account_invoice_surcharge_amount` double(10,2) unsigned DEFAULT '0.00',
  `client_account_invoice_surcharge_amount_collected` double(10,2) unsigned DEFAULT '0.00',
  `client_account_invoice_date_due_surcharge_reference` int(15) unsigned DEFAULT '0',
  `client_account_invoice_date_due_surcharge` int(15) unsigned DEFAULT '0',
  `client_account_invoice_date_due_rebate` int(15) unsigned DEFAULT '0',
  `client_account_invoice_date_due` bigint(15) unsigned DEFAULT '0',
  `client_account_invoice_date_paid` bigint(20) unsigned DEFAULT '0',
  PRIMARY KEY (`client_account_invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2353 DEFAULT CHARSET=utf8;

/*Data for the table `client_account_invoice` */

insert  into `client_account_invoice`(`client_account_invoice_id`,`client_id`,`client_account_id`,`client_account_structure_id`,`client_account_invoice_number`,`client_account_invoice_is_late`,`option_invoice_status_id`,`option_account_invoice_type_id`,`client_account_invoice_recurr`,`client_account_invoice_recurr_count`,`client_account_invoice_balance_amount`,`client_account_invoice_amount`,`client_account_invoice_amount_collected`,`client_account_invoice_rebate_amount`,`client_account_invoice_rebate_amount_collected`,`client_account_invoice_principal_amount`,`client_account_invoice_principal_amount_collected`,`client_account_invoice_interest_amount`,`client_account_invoice_interest_amount_collected`,`client_account_invoice_surcharge_amount`,`client_account_invoice_surcharge_amount_collected`,`client_account_invoice_date_due_surcharge_reference`,`client_account_invoice_date_due_surcharge`,`client_account_invoice_date_due_rebate`,`client_account_invoice_date_due`,`client_account_invoice_date_paid`) values (2139,22,19,0,1,0,'settled','earnest',0,1,0.00,1000.00,0.00,0.00,0.00,1000.00,0.00,0.00,0.00,0.00,0.00,0,0,0,1435744945,1435744945),(2140,22,19,0,1,0,'settled','reservation',0,1,0.00,9000.00,0.00,0.00,0.00,9000.00,0.00,0.00,0.00,0.00,0.00,0,0,0,1435744977,1435744977),(2141,22,19,20,1,0,'settled','monthly_dp',1,24,410560.00,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1436976000,0,1436889600,1435745412),(2142,22,19,20,2,0,'settled','monthly_dp',1,24,393453.33,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1439654400,0,1439568000,1435745412),(2143,22,19,20,3,0,'settled','monthly_dp',1,24,376346.66,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1442332800,0,1442246400,1435745413),(2144,22,19,20,4,0,'settled','monthly_dp',1,24,359239.99,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1444924800,0,1444838400,1435745413),(2145,22,19,20,5,0,'settled','monthly_dp',1,24,342133.32,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1447603200,0,1447516800,1435745413),(2146,22,19,20,6,0,'settled','monthly_dp',1,24,325026.65,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1450195200,0,1450108800,1435745424),(2147,22,19,20,7,0,'settled','monthly_dp',1,24,307919.98,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1452873600,0,1452787200,1435745424),(2148,22,19,20,8,0,'settled','monthly_dp',1,24,290813.31,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1455552000,0,1455465600,1435745424),(2149,22,19,20,9,0,'settled','monthly_dp',1,24,273706.64,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1458057600,0,1457971200,1435745424),(2150,22,19,20,10,0,'settled','monthly_dp',1,24,256599.97,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1460736000,0,1460649600,1435745424),(2151,22,19,20,11,0,'settled','monthly_dp',1,24,239493.30,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1463328000,0,1463241600,1435745442),(2152,22,19,20,12,0,'settled','monthly_dp',1,24,222386.63,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1466006400,0,1465920000,1435745442),(2153,22,19,20,13,0,'settled','monthly_dp',1,24,205279.96,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1468598400,0,1468512000,1435745442),(2154,22,19,20,14,0,'settled','monthly_dp',1,24,188173.29,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1471276800,0,1471190400,1435745442),(2155,22,19,20,15,0,'settled','monthly_dp',1,24,171066.62,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1473955200,0,1473868800,1435745442),(2156,22,19,20,16,0,'settled','monthly_dp',1,24,153959.95,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1476547200,0,1476460800,1435745780),(2157,22,19,20,17,0,'settled','monthly_dp',1,24,136853.28,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1479225600,0,1479139200,1435745780),(2158,22,19,20,18,0,'settled','monthly_dp',1,24,119746.61,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1481817600,0,1481731200,1435745780),(2159,22,19,20,19,0,'settled','monthly_dp',1,24,102639.94,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1484496000,0,1484409600,1435745780),(2160,22,19,20,20,0,'settled','monthly_dp',1,24,85533.27,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1487174400,0,1487088000,1435745781),(2161,22,19,20,21,0,'settled','monthly_dp',1,24,68426.60,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1489593600,0,1489507200,1435745815),(2162,22,19,20,22,0,'settled','monthly_dp',1,24,51319.93,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1492272000,0,1492185600,1435745816),(2163,22,19,20,23,0,'settled','monthly_dp',1,24,34213.26,17106.67,0.00,0.00,0.00,17106.67,0.00,0.00,0.00,0.00,0.00,0,1494864000,0,1494777600,1435745816),(2164,22,19,20,24,0,'settled','monthly_dp',1,24,17106.59,17106.59,0.00,0.00,0.00,17106.59,0.00,0.00,0.00,0.00,0.00,0,1497542400,0,1497456000,1435745816),(2165,22,19,20,1,0,'settled','monthly_amortization',1,60,1682240.00,40021.00,0.00,480.25,0.00,18993.00,0.00,21028.00,0.00,0.00,0.00,0,1500134400,1499875200,1500048000,1435745816),(2166,22,19,20,2,0,'settled','monthly_amortization',1,60,1663247.00,40021.00,0.00,480.25,0.00,19230.41,0.00,20790.59,0.00,0.00,0.00,0,1502812800,1502553600,1502726400,1435748151),(2167,22,19,20,3,0,'settled','monthly_amortization',1,60,1644016.59,40021.00,0.00,480.25,0.00,19470.79,0.00,20550.21,0.00,0.00,0.00,0,1505491200,1505232000,1505404800,1435748151),(2168,22,19,20,4,0,'settled','monthly_amortization',1,60,1624545.80,40021.00,0.00,480.25,0.00,19714.18,0.00,20306.82,0.00,0.00,0.00,0,1508083200,1507824000,1507996800,1435748152),(2169,22,19,20,5,0,'settled','monthly_amortization',1,60,1604831.62,40021.00,0.00,480.25,0.00,19960.60,0.00,20060.40,0.00,0.00,0.00,0,1510761600,1510502400,1510675200,1435748152),(2170,22,19,20,6,0,'settled','monthly_amortization',1,60,1584871.02,40021.00,0.00,480.25,0.00,20210.11,0.00,19810.89,0.00,0.00,0.00,0,1513353600,1513094400,1513267200,1435748152),(2171,22,19,20,7,0,'settled','monthly_amortization',1,60,1564660.91,40021.00,0.00,480.25,0.00,20462.74,0.00,19558.26,0.00,0.00,0.00,0,1516032000,1515772800,1515945600,1435748192),(2172,22,19,20,8,0,'settled','monthly_amortization',1,60,1544198.17,40021.00,0.00,480.25,0.00,20718.52,0.00,19302.48,0.00,0.00,0.00,0,1518710400,1518451200,1518624000,1435748193),(2173,22,19,20,9,0,'settled','monthly_amortization',1,60,1523479.65,40021.00,0.00,480.25,0.00,20977.50,0.00,19043.50,0.00,0.00,0.00,0,1521129600,1520870400,1521043200,1435748193),(2174,22,19,20,10,0,'settled','monthly_amortization',1,60,1502502.15,40021.00,0.00,480.25,0.00,21239.72,0.00,18781.28,0.00,0.00,0.00,0,1523808000,1523548800,1523721600,1435748193),(2175,22,19,20,11,0,'settled','monthly_amortization',1,60,1481262.43,40021.00,0.00,480.25,0.00,21505.22,0.00,18515.78,0.00,0.00,0.00,0,1526400000,1526140800,1526313600,1435748193),(2176,22,19,20,12,0,'settled','monthly_amortization',1,60,1459757.21,40021.00,0.00,480.25,0.00,21774.03,0.00,18246.97,0.00,0.00,0.00,0,1529078400,1528819200,1528992000,1435749116),(2177,22,19,20,13,0,'settled','monthly_amortization',1,60,1437983.18,40021.00,0.00,480.25,0.00,22046.21,0.00,17974.79,0.00,0.00,0.00,0,1531670400,1531411200,1531584000,1435749117),(2178,22,19,20,14,0,'settled','monthly_amortization',1,60,1415936.97,40021.00,0.00,480.25,0.00,22321.79,0.00,17699.21,0.00,0.00,0.00,0,1534348800,1534089600,1534262400,1435749117),(2179,22,19,20,15,0,'settled','monthly_amortization',1,60,1393615.18,40021.00,0.00,480.25,0.00,22600.81,0.00,17420.19,0.00,0.00,0.00,0,1537027200,1536768000,1536940800,1435749117),(2180,22,19,20,16,0,'settled','monthly_amortization',1,60,1371014.37,40021.00,0.00,480.25,0.00,22883.32,0.00,17137.68,0.00,0.00,0.00,0,1539619200,1539360000,1539532800,1435749117),(2181,22,19,20,17,0,'settled','monthly_amortization',1,60,1348131.05,40021.00,0.00,480.25,0.00,23169.36,0.00,16851.64,0.00,0.00,0.00,0,1542297600,1542038400,1542211200,1435749128),(2182,22,19,20,18,0,'settled','monthly_amortization',1,60,1324961.69,40021.00,0.00,480.25,0.00,23458.98,0.00,16562.02,0.00,0.00,0.00,0,1544889600,1544630400,1544803200,1435749129),(2183,22,19,20,19,0,'settled','monthly_amortization',1,60,1301502.71,40021.00,0.00,480.25,0.00,23752.22,0.00,16268.78,0.00,0.00,0.00,0,1547568000,1547308800,1547481600,1435749129),(2184,22,19,20,20,0,'settled','monthly_amortization',1,60,1277750.49,40021.00,0.00,480.25,0.00,24049.12,0.00,15971.88,0.00,0.00,0.00,0,1550246400,1549987200,1550160000,1435749129),(2185,22,19,20,21,0,'settled','monthly_amortization',1,60,1253701.37,40021.00,0.00,480.25,0.00,24349.73,0.00,15671.27,0.00,0.00,0.00,0,1552665600,1552406400,1552579200,1435749129),(2186,22,19,20,22,0,'settled','monthly_amortization',1,60,1229351.64,40021.00,0.00,480.25,0.00,24654.10,0.00,15366.90,0.00,0.00,0.00,0,1555344000,1555084800,1555257600,1435749142),(2187,22,19,20,23,0,'settled','monthly_amortization',1,60,1204697.54,40021.00,0.00,480.25,0.00,24962.28,0.00,15058.72,0.00,0.00,0.00,0,1557936000,1557676800,1557849600,1435749143),(2188,22,19,20,24,0,'settled','monthly_amortization',1,60,1179735.26,40021.00,0.00,480.25,0.00,25274.31,0.00,14746.69,0.00,0.00,0.00,0,1560614400,1560355200,1560528000,1435749143),(2189,22,19,20,25,0,'settled','monthly_amortization',1,60,1154460.95,40021.00,0.00,480.25,0.00,25590.24,0.00,14430.76,0.00,0.00,0.00,0,1563206400,1562947200,1563120000,1435749143),(2190,22,19,20,26,0,'settled','monthly_amortization',1,60,1128870.71,40021.00,0.00,480.25,0.00,25910.12,0.00,14110.88,0.00,0.00,0.00,0,1565884800,1565625600,1565798400,1435749143),(2191,22,19,20,27,0,'settled','monthly_amortization',1,60,1102960.59,40021.00,0.00,480.25,0.00,26233.99,0.00,13787.01,0.00,0.00,0.00,0,1568563200,1568304000,1568476800,1435749152),(2192,22,19,20,28,0,'settled','monthly_amortization',1,60,1076726.60,40021.00,0.00,480.25,0.00,26561.92,0.00,13459.08,0.00,0.00,0.00,0,1571155200,1570896000,1571068800,1435749152),(2193,22,19,20,29,0,'settled','monthly_amortization',1,60,1050164.68,40021.00,0.00,480.25,0.00,26893.94,0.00,13127.06,0.00,0.00,0.00,0,1573833600,1573574400,1573747200,1435749153),(2194,22,19,20,30,0,'settled','monthly_amortization',1,60,1023270.74,40021.00,0.00,480.25,0.00,27230.12,0.00,12790.88,0.00,0.00,0.00,0,1576425600,1576166400,1576339200,1435749153),(2195,22,19,20,31,0,'settled','monthly_amortization',1,60,996040.62,40021.00,0.00,480.25,0.00,27570.49,0.00,12450.51,0.00,0.00,0.00,0,1579104000,1578844800,1579017600,1435749153),(2196,22,19,20,32,0,'settled','monthly_amortization',1,60,968470.13,40021.00,0.00,480.25,0.00,27915.12,0.00,12105.88,0.00,0.00,0.00,0,1581782400,1581523200,1581696000,1435749170),(2197,22,19,20,33,0,'settled','monthly_amortization',1,60,940555.01,40021.00,0.00,480.25,0.00,28264.06,0.00,11756.94,0.00,0.00,0.00,0,1584288000,1584028800,1584201600,1435749171),(2198,22,19,20,34,0,'settled','monthly_amortization',1,60,912290.95,40021.00,0.00,480.25,0.00,28617.36,0.00,11403.64,0.00,0.00,0.00,0,1586966400,1586707200,1586880000,1435749171),(2199,22,19,20,35,0,'settled','monthly_amortization',1,60,883673.59,40021.00,0.00,480.25,0.00,28975.08,0.00,11045.92,0.00,0.00,0.00,0,1589558400,1589299200,1589472000,1435749171),(2200,22,19,20,36,0,'settled','monthly_amortization',1,60,854698.51,40021.00,0.00,480.25,0.00,29337.27,0.00,10683.73,0.00,0.00,0.00,0,1592236800,1591977600,1592150400,1435749171),(2201,22,19,20,37,0,'settled','monthly_amortization',1,60,825361.24,40021.00,0.00,480.25,0.00,29703.98,0.00,10317.02,0.00,0.00,0.00,0,1594828800,1594569600,1594742400,1435749196),(2202,22,19,20,38,0,'settled','monthly_amortization',1,60,795657.26,40021.00,0.00,480.25,0.00,30075.28,0.00,9945.72,0.00,0.00,0.00,0,1597507200,1597248000,1597420800,1435749196),(2203,22,19,20,39,0,'settled','monthly_amortization',1,60,765581.98,40021.00,0.00,480.25,0.00,30451.23,0.00,9569.77,0.00,0.00,0.00,0,1600185600,1599926400,1600099200,1435749197),(2204,22,19,20,40,0,'settled','monthly_amortization',1,60,735130.75,40021.00,0.00,480.25,0.00,30831.87,0.00,9189.13,0.00,0.00,0.00,0,1602777600,1602518400,1602691200,1435749197),(2205,22,19,20,41,0,'settled','monthly_amortization',1,60,704298.88,40021.00,0.00,480.25,0.00,31217.26,0.00,8803.74,0.00,0.00,0.00,0,1605456000,1605196800,1605369600,1435749197),(2206,22,19,20,42,0,'settled','monthly_amortization',1,60,673081.62,40021.00,0.00,480.25,0.00,31607.48,0.00,8413.52,0.00,0.00,0.00,0,1608048000,1607788800,1607961600,1435749211),(2207,22,19,20,43,0,'settled','monthly_amortization',1,60,641474.14,40021.00,0.00,480.25,0.00,32002.57,0.00,8018.43,0.00,0.00,0.00,0,1610726400,1610467200,1610640000,1435749211),(2208,22,19,20,44,0,'settled','monthly_amortization',1,60,609471.57,40021.00,0.00,480.25,0.00,32402.61,0.00,7618.39,0.00,0.00,0.00,0,1613404800,1613145600,1613318400,1435749211),(2209,22,19,20,45,0,'settled','monthly_amortization',1,60,577068.96,40021.00,0.00,480.25,0.00,32807.64,0.00,7213.36,0.00,0.00,0.00,0,1615824000,1615564800,1615737600,1435749211),(2210,22,19,20,46,0,'settled','monthly_amortization',1,60,544261.32,40021.00,0.00,480.25,0.00,33217.73,0.00,6803.27,0.00,0.00,0.00,0,1618502400,1618243200,1618416000,1435749211),(2211,22,19,20,47,0,'settled','monthly_amortization',1,60,511043.59,40021.00,0.00,480.25,0.00,33632.96,0.00,6388.04,0.00,0.00,0.00,0,1621094400,1620835200,1621008000,1435749281),(2212,22,19,20,48,0,'settled','monthly_amortization',1,60,477410.63,40021.00,0.00,480.25,0.00,34053.37,0.00,5967.63,0.00,0.00,0.00,0,1623772800,1623513600,1623686400,1435749281),(2213,22,19,20,49,0,'settled','monthly_amortization',1,60,443357.26,40021.00,0.00,480.25,0.00,34479.03,0.00,5541.97,0.00,0.00,0.00,0,1626364800,1626105600,1626278400,1435749281),(2214,22,19,20,50,0,'settled','monthly_amortization',1,60,408878.23,40021.00,0.00,480.25,0.00,34910.02,0.00,5110.98,0.00,0.00,0.00,0,1629043200,1628784000,1628956800,1435749282),(2215,22,19,20,51,0,'settled','monthly_amortization',1,60,373968.21,40021.00,0.00,480.25,0.00,35346.40,0.00,4674.60,0.00,0.00,0.00,0,1631721600,1631462400,1631635200,1435749282),(2216,22,19,20,52,0,'settled','monthly_amortization',1,60,338621.81,40021.00,0.00,480.25,0.00,35788.23,0.00,4232.77,0.00,0.00,0.00,0,1634313600,1634054400,1634227200,1435749291),(2217,22,19,20,53,0,'settled','monthly_amortization',1,60,302833.58,40021.00,0.00,480.25,0.00,36235.58,0.00,3785.42,0.00,0.00,0.00,0,1636992000,1636732800,1636905600,1435749291),(2218,22,19,20,54,0,'settled','monthly_amortization',1,60,266598.00,40021.00,0.00,480.25,0.00,36688.53,0.00,3332.48,0.00,0.00,0.00,0,1639584000,1639324800,1639497600,1435749291),(2219,22,19,20,55,0,'settled','monthly_amortization',1,60,229909.48,40021.00,0.00,480.25,0.00,37147.13,0.00,2873.87,0.00,0.00,0.00,0,1642262400,1642003200,1642176000,1435749291),(2220,22,19,20,56,0,'settled','monthly_amortization',1,60,192762.35,40021.00,0.00,480.25,0.00,37611.47,0.00,2409.53,0.00,0.00,0.00,0,1644940800,1644681600,1644854400,1435749291),(2221,22,19,20,57,0,'settled','monthly_amortization',1,60,155150.88,40021.00,0.00,480.25,0.00,38081.61,0.00,1939.39,0.00,0.00,0.00,0,1647360000,1647100800,1647273600,1435749698),(2222,22,19,20,58,0,'settled','monthly_amortization',1,60,117069.27,40021.00,0.00,480.25,0.00,38557.63,0.00,1463.37,0.00,0.00,0.00,0,1650038400,1649779200,1649952000,1435749698),(2223,22,19,20,59,0,'settled','monthly_amortization',1,60,78511.64,40021.00,0.00,480.25,0.00,39039.60,0.00,981.40,0.00,0.00,0.00,0,1652630400,1652371200,1652544000,1435749698),(2224,22,19,20,60,0,'settled','monthly_amortization',1,60,39472.04,39965.44,0.00,479.59,0.00,39472.04,0.00,493.40,0.00,0.00,0.00,0,1655308800,1655049600,1655222400,1435749698),(2225,23,20,0,1,0,'settled','reservation',0,1,0.00,10000.00,0.00,0.00,0.00,10000.00,0.00,0.00,0.00,0.00,0.00,0,0,0,1435746049,1435746049),(2226,23,20,21,1,0,'settled','monthly_amortization',1,60,2120000.00,50435.00,0.00,605.22,0.00,23935.00,0.00,26500.00,0.00,0.00,0.00,0,1439654400,1439395200,1439568000,1435746820),(2227,23,20,21,2,0,'settled','monthly_amortization',1,60,2096065.00,50435.00,0.00,605.22,0.00,24234.19,0.00,26200.81,0.00,0.00,0.00,0,1442332800,1442073600,1442246400,1435746820),(2228,23,20,21,3,0,'settled','monthly_amortization',1,60,2071830.81,50435.00,0.00,605.22,0.00,24537.11,0.00,25897.89,0.00,0.00,0.00,0,1444924800,1444665600,1444838400,1435746820),(2229,23,20,21,4,0,'settled','monthly_amortization',1,60,2047293.70,50435.00,0.00,605.22,0.00,24843.83,0.00,25591.17,0.00,0.00,0.00,0,1447603200,1447344000,1447516800,1435746820),(2230,23,20,21,5,0,'settled','monthly_amortization',1,60,2022449.87,50435.00,0.00,605.22,0.00,25154.38,0.00,25280.62,0.00,0.00,0.00,0,1450195200,1449936000,1450108800,1435746820),(2231,23,20,21,6,0,'settled','monthly_amortization',1,60,1997295.49,50435.00,0.00,605.22,0.00,25468.81,0.00,24966.19,0.00,0.00,0.00,0,1452873600,1452614400,1452787200,1435746833),(2232,23,20,21,7,0,'settled','monthly_amortization',1,60,1971826.68,50435.00,0.00,605.22,0.00,25787.17,0.00,24647.83,0.00,0.00,0.00,0,1455552000,1455292800,1455465600,1435746833),(2233,23,20,21,8,0,'settled','monthly_amortization',1,60,1946039.51,50435.00,0.00,605.22,0.00,26109.51,0.00,24325.49,0.00,0.00,0.00,0,1458057600,1457798400,1457971200,1435746833),(2234,23,20,21,9,0,'settled','monthly_amortization',1,60,1919930.00,50435.00,0.00,605.22,0.00,26435.88,0.00,23999.13,0.00,0.00,0.00,0,1460736000,1460476800,1460649600,1435746833),(2235,23,20,21,10,0,'settled','monthly_amortization',1,60,1893494.13,50435.00,0.00,605.22,0.00,26766.32,0.00,23668.68,0.00,0.00,0.00,0,1463328000,1463068800,1463241600,1435746834),(2236,23,20,21,11,0,'settled','monthly_amortization',1,60,1866727.81,50435.00,0.00,605.22,0.00,27100.90,0.00,23334.10,0.00,0.00,0.00,0,1466006400,1465747200,1465920000,1435747788),(2237,23,20,21,12,0,'pending','monthly_amortization',1,60,1839626.91,50435.00,0.00,605.22,0.00,27439.66,0.00,22995.34,0.00,0.00,0.00,0,1468598400,1468339200,1468512000,0),(2238,23,20,21,13,0,'pending','monthly_amortization',1,60,1812187.25,50435.00,0.00,605.22,0.00,27782.66,0.00,22652.34,0.00,0.00,0.00,0,1471276800,1471017600,1471190400,0),(2239,23,20,21,14,0,'pending','monthly_amortization',1,60,1784404.59,50435.00,0.00,605.22,0.00,28129.94,0.00,22305.06,0.00,0.00,0.00,0,1473955200,1473696000,1473868800,0),(2240,23,20,21,15,0,'pending','monthly_amortization',1,60,1756274.65,50435.00,0.00,605.22,0.00,28481.57,0.00,21953.43,0.00,0.00,0.00,0,1476547200,1476288000,1476460800,0),(2241,23,20,21,16,0,'pending','monthly_amortization',1,60,1727793.08,50435.00,0.00,605.22,0.00,28837.59,0.00,21597.41,0.00,0.00,0.00,0,1479225600,1478966400,1479139200,0),(2242,23,20,21,17,0,'pending','monthly_amortization',1,60,1698955.49,50435.00,0.00,605.22,0.00,29198.06,0.00,21236.94,0.00,0.00,0.00,0,1481817600,1481558400,1481731200,0),(2243,23,20,21,18,0,'pending','monthly_amortization',1,60,1669757.43,50435.00,0.00,605.22,0.00,29563.03,0.00,20871.97,0.00,0.00,0.00,0,1484496000,1484236800,1484409600,0),(2244,23,20,21,19,0,'pending','monthly_amortization',1,60,1640194.40,50435.00,0.00,605.22,0.00,29932.57,0.00,20502.43,0.00,0.00,0.00,0,1487174400,1486915200,1487088000,0),(2245,23,20,21,20,0,'pending','monthly_amortization',1,60,1610261.83,50435.00,0.00,605.22,0.00,30306.73,0.00,20128.27,0.00,0.00,0.00,0,1489593600,1489334400,1489507200,0),(2246,23,20,21,21,0,'pending','monthly_amortization',1,60,1579955.10,50435.00,0.00,605.22,0.00,30685.56,0.00,19749.44,0.00,0.00,0.00,0,1492272000,1492012800,1492185600,0),(2247,23,20,21,22,0,'pending','monthly_amortization',1,60,1549269.54,50435.00,0.00,605.22,0.00,31069.13,0.00,19365.87,0.00,0.00,0.00,0,1494864000,1494604800,1494777600,0),(2248,23,20,21,23,0,'pending','monthly_amortization',1,60,1518200.41,50435.00,0.00,605.22,0.00,31457.49,0.00,18977.51,0.00,0.00,0.00,0,1497542400,1497283200,1497456000,0),(2249,23,20,21,24,0,'pending','monthly_amortization',1,60,1486742.92,50435.00,0.00,605.22,0.00,31850.71,0.00,18584.29,0.00,0.00,0.00,0,1500134400,1499875200,1500048000,0),(2250,23,20,21,25,0,'pending','monthly_amortization',1,60,1454892.21,50435.00,0.00,605.22,0.00,32248.85,0.00,18186.15,0.00,0.00,0.00,0,1502812800,1502553600,1502726400,0),(2251,23,20,21,26,0,'pending','monthly_amortization',1,60,1422643.36,50435.00,0.00,605.22,0.00,32651.96,0.00,17783.04,0.00,0.00,0.00,0,1505491200,1505232000,1505404800,0),(2252,23,20,21,27,0,'pending','monthly_amortization',1,60,1389991.40,50435.00,0.00,605.22,0.00,33060.11,0.00,17374.89,0.00,0.00,0.00,0,1508083200,1507824000,1507996800,0),(2253,23,20,21,28,0,'pending','monthly_amortization',1,60,1356931.29,50435.00,0.00,605.22,0.00,33473.36,0.00,16961.64,0.00,0.00,0.00,0,1510761600,1510502400,1510675200,0),(2254,23,20,21,29,0,'pending','monthly_amortization',1,60,1323457.93,50435.00,0.00,605.22,0.00,33891.78,0.00,16543.22,0.00,0.00,0.00,0,1513353600,1513094400,1513267200,0),(2255,23,20,21,30,0,'pending','monthly_amortization',1,60,1289566.15,50435.00,0.00,605.22,0.00,34315.42,0.00,16119.58,0.00,0.00,0.00,0,1516032000,1515772800,1515945600,0),(2256,23,20,21,31,0,'pending','monthly_amortization',1,60,1255250.73,50435.00,0.00,605.22,0.00,34744.37,0.00,15690.63,0.00,0.00,0.00,0,1518710400,1518451200,1518624000,0),(2257,23,20,21,32,0,'pending','monthly_amortization',1,60,1220506.36,50435.00,0.00,605.22,0.00,35178.67,0.00,15256.33,0.00,0.00,0.00,0,1521129600,1520870400,1521043200,0),(2258,23,20,21,33,0,'pending','monthly_amortization',1,60,1185327.69,50435.00,0.00,605.22,0.00,35618.40,0.00,14816.60,0.00,0.00,0.00,0,1523808000,1523548800,1523721600,0),(2259,23,20,21,34,0,'pending','monthly_amortization',1,60,1149709.29,50435.00,0.00,605.22,0.00,36063.63,0.00,14371.37,0.00,0.00,0.00,0,1526400000,1526140800,1526313600,0),(2260,23,20,21,35,0,'pending','monthly_amortization',1,60,1113645.66,50435.00,0.00,605.22,0.00,36514.43,0.00,13920.57,0.00,0.00,0.00,0,1529078400,1528819200,1528992000,0),(2261,23,20,21,36,0,'pending','monthly_amortization',1,60,1077131.23,50435.00,0.00,605.22,0.00,36970.86,0.00,13464.14,0.00,0.00,0.00,0,1531670400,1531411200,1531584000,0),(2262,23,20,21,37,0,'pending','monthly_amortization',1,60,1040160.37,50435.00,0.00,605.22,0.00,37433.00,0.00,13002.00,0.00,0.00,0.00,0,1534348800,1534089600,1534262400,0),(2263,23,20,21,38,0,'pending','monthly_amortization',1,60,1002727.37,50435.00,0.00,605.22,0.00,37900.91,0.00,12534.09,0.00,0.00,0.00,0,1537027200,1536768000,1536940800,0),(2264,23,20,21,39,0,'pending','monthly_amortization',1,60,964826.46,50435.00,0.00,605.22,0.00,38374.67,0.00,12060.33,0.00,0.00,0.00,0,1539619200,1539360000,1539532800,0),(2265,23,20,21,40,0,'pending','monthly_amortization',1,60,926451.79,50435.00,0.00,605.22,0.00,38854.35,0.00,11580.65,0.00,0.00,0.00,0,1542297600,1542038400,1542211200,0),(2266,23,20,21,41,0,'pending','monthly_amortization',1,60,887597.44,50435.00,0.00,605.22,0.00,39340.03,0.00,11094.97,0.00,0.00,0.00,0,1544889600,1544630400,1544803200,0),(2267,23,20,21,42,0,'pending','monthly_amortization',1,60,848257.41,50435.00,0.00,605.22,0.00,39831.78,0.00,10603.22,0.00,0.00,0.00,0,1547568000,1547308800,1547481600,0),(2268,23,20,21,43,0,'pending','monthly_amortization',1,60,808425.63,50435.00,0.00,605.22,0.00,40329.68,0.00,10105.32,0.00,0.00,0.00,0,1550246400,1549987200,1550160000,0),(2269,23,20,21,44,0,'pending','monthly_amortization',1,60,768095.95,50435.00,0.00,605.22,0.00,40833.80,0.00,9601.20,0.00,0.00,0.00,0,1552665600,1552406400,1552579200,0),(2270,23,20,21,45,0,'pending','monthly_amortization',1,60,727262.15,50435.00,0.00,605.22,0.00,41344.22,0.00,9090.78,0.00,0.00,0.00,0,1555344000,1555084800,1555257600,0),(2271,23,20,21,46,0,'pending','monthly_amortization',1,60,685917.93,50435.00,0.00,605.22,0.00,41861.03,0.00,8573.97,0.00,0.00,0.00,0,1557936000,1557676800,1557849600,0),(2272,23,20,21,47,0,'pending','monthly_amortization',1,60,644056.90,50435.00,0.00,605.22,0.00,42384.29,0.00,8050.71,0.00,0.00,0.00,0,1560614400,1560355200,1560528000,0),(2273,23,20,21,48,0,'pending','monthly_amortization',1,60,601672.61,50435.00,0.00,605.22,0.00,42914.09,0.00,7520.91,0.00,0.00,0.00,0,1563206400,1562947200,1563120000,0),(2274,23,20,21,49,0,'pending','monthly_amortization',1,60,558758.52,50435.00,0.00,605.22,0.00,43450.52,0.00,6984.48,0.00,0.00,0.00,0,1565884800,1565625600,1565798400,0),(2275,23,20,21,50,0,'pending','monthly_amortization',1,60,515308.00,50435.00,0.00,605.22,0.00,43993.65,0.00,6441.35,0.00,0.00,0.00,0,1568563200,1568304000,1568476800,0),(2276,23,20,21,51,0,'pending','monthly_amortization',1,60,471314.35,50435.00,0.00,605.22,0.00,44543.57,0.00,5891.43,0.00,0.00,0.00,0,1571155200,1570896000,1571068800,0),(2277,23,20,21,52,0,'pending','monthly_amortization',1,60,426770.78,50435.00,0.00,605.22,0.00,45100.37,0.00,5334.63,0.00,0.00,0.00,0,1573833600,1573574400,1573747200,0),(2278,23,20,21,53,0,'pending','monthly_amortization',1,60,381670.41,50435.00,0.00,605.22,0.00,45664.12,0.00,4770.88,0.00,0.00,0.00,0,1576425600,1576166400,1576339200,0),(2279,23,20,21,54,0,'pending','monthly_amortization',1,60,336006.29,50435.00,0.00,605.22,0.00,46234.92,0.00,4200.08,0.00,0.00,0.00,0,1579104000,1578844800,1579017600,0),(2280,23,20,21,55,0,'pending','monthly_amortization',1,60,289771.37,50435.00,0.00,605.22,0.00,46812.86,0.00,3622.14,0.00,0.00,0.00,0,1581782400,1581523200,1581696000,0),(2281,23,20,21,56,0,'pending','monthly_amortization',1,60,242958.51,50435.00,0.00,605.22,0.00,47398.02,0.00,3036.98,0.00,0.00,0.00,0,1584288000,1584028800,1584201600,0),(2282,23,20,21,57,0,'pending','monthly_amortization',1,60,195560.49,50435.00,0.00,605.22,0.00,47990.49,0.00,2444.51,0.00,0.00,0.00,0,1586966400,1586707200,1586880000,0),(2283,23,20,21,58,0,'pending','monthly_amortization',1,60,147570.00,50435.00,0.00,605.22,0.00,48590.38,0.00,1844.63,0.00,0.00,0.00,0,1589558400,1589299200,1589472000,0),(2284,23,20,21,59,0,'pending','monthly_amortization',1,60,98979.63,50435.00,0.00,605.22,0.00,49197.75,0.00,1237.25,0.00,0.00,0.00,0,1592236800,1591977600,1592150400,0),(2285,23,20,21,60,0,'pending','monthly_amortization',1,60,49781.88,50404.15,0.00,604.85,0.00,49781.88,0.00,622.27,0.00,0.00,0.00,0,1594828800,1594569600,1594742400,0),(2286,24,21,0,1,0,'settled','reservation',0,1,0.00,10000.00,0.00,0.00,0.00,10000.00,0.00,0.00,0.00,0.00,0.00,0,0,0,1435746512,1435746512),(2287,24,21,22,1,0,'settled','monthly_amortization',1,60,594800.00,14151.00,0.00,169.81,0.00,6716.00,0.00,7435.00,0.00,0.00,0.00,0,1442332800,1442073600,1442246400,1435748105),(2288,24,21,22,2,0,'settled','monthly_amortization',1,60,588084.00,14151.00,0.00,169.81,0.00,6799.95,0.00,7351.05,0.00,0.00,0.00,0,1444924800,1444665600,1444838400,1435748105),(2289,24,21,22,3,0,'settled','monthly_amortization',1,60,581284.05,14151.00,0.00,169.81,0.00,6884.95,0.00,7266.05,0.00,0.00,0.00,0,1447603200,1447344000,1447516800,1435748105),(2290,24,21,22,4,0,'settled','monthly_amortization',1,60,574399.10,14151.00,0.00,169.81,0.00,6971.01,0.00,7179.99,0.00,0.00,0.00,0,1450195200,1449936000,1450108800,1435748105),(2291,24,21,22,5,0,'settled','monthly_amortization',1,60,567428.09,14151.00,0.00,169.81,0.00,7058.15,0.00,7092.85,0.00,0.00,0.00,0,1452873600,1452614400,1452787200,1435748105),(2292,24,21,22,6,0,'settled','monthly_amortization',1,60,560369.94,14151.00,0.00,169.81,0.00,7146.38,0.00,7004.62,0.00,0.00,0.00,0,1455552000,1455292800,1455465600,1435748119),(2293,24,21,22,7,0,'settled','monthly_amortization',1,60,553223.56,14151.00,0.00,169.81,0.00,7235.71,0.00,6915.29,0.00,0.00,0.00,0,1458057600,1457798400,1457971200,1435748119),(2294,24,21,22,8,0,'settled','monthly_amortization',1,60,545987.85,14151.00,0.00,169.81,0.00,7326.15,0.00,6824.85,0.00,0.00,0.00,0,1460736000,1460476800,1460649600,1435748119),(2295,24,21,22,9,0,'settled','monthly_amortization',1,60,538661.70,14151.00,0.00,169.81,0.00,7417.73,0.00,6733.27,0.00,0.00,0.00,0,1463328000,1463068800,1463241600,1435748119),(2296,24,21,22,10,0,'settled','monthly_amortization',1,60,531243.97,14151.00,0.00,169.81,0.00,7510.45,0.00,6640.55,0.00,0.00,0.00,0,1466006400,1465747200,1465920000,1435748119),(2297,24,21,22,11,0,'pending','monthly_amortization',1,60,523733.52,14151.00,0.00,169.81,0.00,7604.33,0.00,6546.67,0.00,0.00,0.00,0,1468598400,1468339200,1468512000,0),(2298,24,21,22,12,0,'pending','monthly_amortization',1,60,516129.19,14151.00,0.00,169.81,0.00,7699.39,0.00,6451.61,0.00,0.00,0.00,0,1471276800,1471017600,1471190400,0),(2299,24,21,22,13,0,'pending','monthly_amortization',1,60,508429.80,14151.00,0.00,169.81,0.00,7795.63,0.00,6355.37,0.00,0.00,0.00,0,1473955200,1473696000,1473868800,0),(2300,24,21,22,14,0,'pending','monthly_amortization',1,60,500634.17,14151.00,0.00,169.81,0.00,7893.07,0.00,6257.93,0.00,0.00,0.00,0,1476547200,1476288000,1476460800,0),(2301,24,21,22,15,0,'pending','monthly_amortization',1,60,492741.10,14151.00,0.00,169.81,0.00,7991.74,0.00,6159.26,0.00,0.00,0.00,0,1479225600,1478966400,1479139200,0),(2302,24,21,22,16,0,'pending','monthly_amortization',1,60,484749.36,14151.00,0.00,169.81,0.00,8091.63,0.00,6059.37,0.00,0.00,0.00,0,1481817600,1481558400,1481731200,0),(2303,24,21,22,17,0,'pending','monthly_amortization',1,60,476657.73,14151.00,0.00,169.81,0.00,8192.78,0.00,5958.22,0.00,0.00,0.00,0,1484496000,1484236800,1484409600,0),(2304,24,21,22,18,0,'pending','monthly_amortization',1,60,468464.95,14151.00,0.00,169.81,0.00,8295.19,0.00,5855.81,0.00,0.00,0.00,0,1487174400,1486915200,1487088000,0),(2305,24,21,22,19,0,'pending','monthly_amortization',1,60,460169.76,14151.00,0.00,169.81,0.00,8398.88,0.00,5752.12,0.00,0.00,0.00,0,1489593600,1489334400,1489507200,0),(2306,24,21,22,20,0,'pending','monthly_amortization',1,60,451770.88,14151.00,0.00,169.81,0.00,8503.86,0.00,5647.14,0.00,0.00,0.00,0,1492272000,1492012800,1492185600,0),(2307,24,21,22,21,0,'pending','monthly_amortization',1,60,443267.02,14151.00,0.00,169.81,0.00,8610.16,0.00,5540.84,0.00,0.00,0.00,0,1494864000,1494604800,1494777600,0),(2308,24,21,22,22,0,'pending','monthly_amortization',1,60,434656.86,14151.00,0.00,169.81,0.00,8717.79,0.00,5433.21,0.00,0.00,0.00,0,1497542400,1497283200,1497456000,0),(2309,24,21,22,23,0,'pending','monthly_amortization',1,60,425939.07,14151.00,0.00,169.81,0.00,8826.76,0.00,5324.24,0.00,0.00,0.00,0,1500134400,1499875200,1500048000,0),(2310,24,21,22,24,0,'pending','monthly_amortization',1,60,417112.31,14151.00,0.00,169.81,0.00,8937.10,0.00,5213.90,0.00,0.00,0.00,0,1502812800,1502553600,1502726400,0),(2311,24,21,22,25,0,'pending','monthly_amortization',1,60,408175.21,14151.00,0.00,169.81,0.00,9048.81,0.00,5102.19,0.00,0.00,0.00,0,1505491200,1505232000,1505404800,0),(2312,24,21,22,26,0,'pending','monthly_amortization',1,60,399126.40,14151.00,0.00,169.81,0.00,9161.92,0.00,4989.08,0.00,0.00,0.00,0,1508083200,1507824000,1507996800,0),(2313,24,21,22,27,0,'pending','monthly_amortization',1,60,389964.48,14151.00,0.00,169.81,0.00,9276.44,0.00,4874.56,0.00,0.00,0.00,0,1510761600,1510502400,1510675200,0),(2314,24,21,22,28,0,'pending','monthly_amortization',1,60,380688.04,14151.00,0.00,169.81,0.00,9392.40,0.00,4758.60,0.00,0.00,0.00,0,1513353600,1513094400,1513267200,0),(2315,24,21,22,29,0,'pending','monthly_amortization',1,60,371295.64,14151.00,0.00,169.81,0.00,9509.80,0.00,4641.20,0.00,0.00,0.00,0,1516032000,1515772800,1515945600,0),(2316,24,21,22,30,0,'pending','monthly_amortization',1,60,361785.84,14151.00,0.00,169.81,0.00,9628.68,0.00,4522.32,0.00,0.00,0.00,0,1518710400,1518451200,1518624000,0),(2317,24,21,22,31,0,'pending','monthly_amortization',1,60,352157.16,14151.00,0.00,169.81,0.00,9749.04,0.00,4401.96,0.00,0.00,0.00,0,1521129600,1520870400,1521043200,0),(2318,24,21,22,32,0,'pending','monthly_amortization',1,60,342408.12,14151.00,0.00,169.81,0.00,9870.90,0.00,4280.10,0.00,0.00,0.00,0,1523808000,1523548800,1523721600,0),(2319,24,21,22,33,0,'pending','monthly_amortization',1,60,332537.22,14151.00,0.00,169.81,0.00,9994.28,0.00,4156.72,0.00,0.00,0.00,0,1526400000,1526140800,1526313600,0),(2320,24,21,22,34,0,'pending','monthly_amortization',1,60,322542.94,14151.00,0.00,169.81,0.00,10119.21,0.00,4031.79,0.00,0.00,0.00,0,1529078400,1528819200,1528992000,0),(2321,24,21,22,35,0,'pending','monthly_amortization',1,60,312423.73,14151.00,0.00,169.81,0.00,10245.70,0.00,3905.30,0.00,0.00,0.00,0,1531670400,1531411200,1531584000,0),(2322,24,21,22,36,0,'pending','monthly_amortization',1,60,302178.03,14151.00,0.00,169.81,0.00,10373.77,0.00,3777.23,0.00,0.00,0.00,0,1534348800,1534089600,1534262400,0),(2323,24,21,22,37,0,'pending','monthly_amortization',1,60,291804.26,14151.00,0.00,169.81,0.00,10503.45,0.00,3647.55,0.00,0.00,0.00,0,1537027200,1536768000,1536940800,0),(2324,24,21,22,38,0,'pending','monthly_amortization',1,60,281300.81,14151.00,0.00,169.81,0.00,10634.74,0.00,3516.26,0.00,0.00,0.00,0,1539619200,1539360000,1539532800,0),(2325,24,21,22,39,0,'pending','monthly_amortization',1,60,270666.07,14151.00,0.00,169.81,0.00,10767.67,0.00,3383.33,0.00,0.00,0.00,0,1542297600,1542038400,1542211200,0),(2326,24,21,22,40,0,'pending','monthly_amortization',1,60,259898.40,14151.00,0.00,169.81,0.00,10902.27,0.00,3248.73,0.00,0.00,0.00,0,1544889600,1544630400,1544803200,0),(2327,24,21,22,41,0,'pending','monthly_amortization',1,60,248996.13,14151.00,0.00,169.81,0.00,11038.55,0.00,3112.45,0.00,0.00,0.00,0,1547568000,1547308800,1547481600,0),(2328,24,21,22,42,0,'pending','monthly_amortization',1,60,237957.58,14151.00,0.00,169.81,0.00,11176.53,0.00,2974.47,0.00,0.00,0.00,0,1550246400,1549987200,1550160000,0),(2329,24,21,22,43,0,'pending','monthly_amortization',1,60,226781.05,14151.00,0.00,169.81,0.00,11316.24,0.00,2834.76,0.00,0.00,0.00,0,1552665600,1552406400,1552579200,0),(2330,24,21,22,44,0,'pending','monthly_amortization',1,60,215464.81,14151.00,0.00,169.81,0.00,11457.69,0.00,2693.31,0.00,0.00,0.00,0,1555344000,1555084800,1555257600,0),(2331,24,21,22,45,0,'pending','monthly_amortization',1,60,204007.12,14151.00,0.00,169.81,0.00,11600.91,0.00,2550.09,0.00,0.00,0.00,0,1557936000,1557676800,1557849600,0),(2332,24,21,22,46,0,'pending','monthly_amortization',1,60,192406.21,14151.00,0.00,169.81,0.00,11745.92,0.00,2405.08,0.00,0.00,0.00,0,1560614400,1560355200,1560528000,0),(2333,24,21,22,47,0,'pending','monthly_amortization',1,60,180660.29,14151.00,0.00,169.81,0.00,11892.75,0.00,2258.25,0.00,0.00,0.00,0,1563206400,1562947200,1563120000,0),(2334,24,21,22,48,0,'pending','monthly_amortization',1,60,168767.54,14151.00,0.00,169.81,0.00,12041.41,0.00,2109.59,0.00,0.00,0.00,0,1565884800,1565625600,1565798400,0),(2335,24,21,22,49,0,'pending','monthly_amortization',1,60,156726.13,14151.00,0.00,169.81,0.00,12191.92,0.00,1959.08,0.00,0.00,0.00,0,1568563200,1568304000,1568476800,0),(2336,24,21,22,50,0,'pending','monthly_amortization',1,60,144534.21,14151.00,0.00,169.81,0.00,12344.32,0.00,1806.68,0.00,0.00,0.00,0,1571155200,1570896000,1571068800,0),(2337,24,21,22,51,0,'pending','monthly_amortization',1,60,132189.89,14151.00,0.00,169.81,0.00,12498.63,0.00,1652.37,0.00,0.00,0.00,0,1573833600,1573574400,1573747200,0),(2338,24,21,22,52,0,'pending','monthly_amortization',1,60,119691.26,14151.00,0.00,169.81,0.00,12654.86,0.00,1496.14,0.00,0.00,0.00,0,1576425600,1576166400,1576339200,0),(2339,24,21,22,53,0,'pending','monthly_amortization',1,60,107036.40,14151.00,0.00,169.81,0.00,12813.05,0.00,1337.96,0.00,0.00,0.00,0,1579104000,1578844800,1579017600,0),(2340,24,21,22,54,0,'pending','monthly_amortization',1,60,94223.36,14151.00,0.00,169.81,0.00,12973.21,0.00,1177.79,0.00,0.00,0.00,0,1581782400,1581523200,1581696000,0),(2341,24,21,22,55,0,'pending','monthly_amortization',1,60,81250.15,14151.00,0.00,169.81,0.00,13135.37,0.00,1015.63,0.00,0.00,0.00,0,1584288000,1584028800,1584201600,0),(2342,24,21,22,56,0,'pending','monthly_amortization',1,60,68114.78,14151.00,0.00,169.81,0.00,13299.57,0.00,851.43,0.00,0.00,0.00,0,1586966400,1586707200,1586880000,0),(2343,24,21,22,57,0,'pending','monthly_amortization',1,60,54815.21,14151.00,0.00,169.81,0.00,13465.81,0.00,685.19,0.00,0.00,0.00,0,1589558400,1589299200,1589472000,0),(2344,24,21,22,58,0,'pending','monthly_amortization',1,60,41349.40,14151.00,0.00,169.81,0.00,13634.13,0.00,516.87,0.00,0.00,0.00,0,1592236800,1591977600,1592150400,0),(2345,24,21,22,59,0,'pending','monthly_amortization',1,60,27715.27,14151.00,0.00,169.81,0.00,13804.56,0.00,346.44,0.00,0.00,0.00,0,1594828800,1594569600,1594742400,0),(2346,24,21,22,60,0,'pending','monthly_amortization',1,60,13910.71,14084.59,0.00,169.02,0.00,13910.71,0.00,173.88,0.00,0.00,0.00,0,1597507200,1597248000,1597420800,0),(2347,0,0,0,1,0,'settled','reservation',0,1,0.00,10000.00,0.00,0.00,0.00,10000.00,0.00,0.00,0.00,0.00,0.00,0,0,0,1435759879,1435759879),(2348,25,22,23,1,0,'settled','spot_cash',1,1,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,1436976000,0,1436889600,1435760133),(2349,25,22,23,1,0,'settled','monthly_amortization',1,1,612800.00,620460.00,0.00,7445.52,0.00,612800.00,0.00,7660.00,0.00,0.00,0.00,0,1444924800,1444665600,1444838400,1435760134),(2350,26,23,0,1,0,'settled','earnest',0,1,0.00,1000.00,0.00,0.00,0.00,1000.00,0.00,0.00,0.00,0.00,0.00,0,0,0,1435761226,1435761226),(2351,26,23,24,1,0,'settled','spot_cash',1,1,1000.00,1000.00,0.00,0.00,0.00,1000.00,0.00,0.00,0.00,0.00,0.00,0,1436976000,0,1436889600,1435761412),(2352,26,23,24,1,0,'settled','monthly_amortization',1,1,558000.00,564975.00,0.00,6779.70,0.00,558000.00,0.00,6975.00,0.00,0.00,0.00,0,1436976000,1436716800,1436889600,1435761413);

/*Table structure for table `client_account_invoice_type` */

DROP TABLE IF EXISTS `client_account_invoice_type`;

CREATE TABLE `client_account_invoice_type` (
  `client_account_invoice_type_id` varchar(50) NOT NULL,
  `client_account_invoice_type_code` varchar(50) DEFAULT NULL,
  `client_account_invoice_type_name` varchar(50) DEFAULT NULL,
  `client_account_invoice_type_order` tinyint(3) unsigned DEFAULT NULL,
  `client_account_invoice_type_key` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`client_account_invoice_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `client_account_invoice_type` */

insert  into `client_account_invoice_type`(`client_account_invoice_type_id`,`client_account_invoice_type_code`,`client_account_invoice_type_name`,`client_account_invoice_type_order`,`client_account_invoice_type_key`) values ('billing_document','BD','Billing Documents',NULL,'other'),('club_house','CH','Club House',NULL,'other'),('credit_to_principal','Prin','Credit To Principal',NULL,'0'),('earnest','EN','Earnest',NULL,'rsv'),('monthly_amortization','MA','Monthly Amortization',NULL,'0'),('monthly_dp','PD','Monthly Down Payment',NULL,'0'),('parking_sticker','PS','Parking Sticker',NULL,'other'),('reservation','RV','Reservation',NULL,'rsv'),('scattered','SC','Scattered',NULL,'0');

/*Table structure for table `client_account_structure` */

DROP TABLE IF EXISTS `client_account_structure`;

CREATE TABLE `client_account_structure` (
  `client_account_structure_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `client_account_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_account_structure_active` tinyint(1) unsigned DEFAULT '1',
  `client_account_ma_amount` double(10,2) unsigned DEFAULT NULL,
  `client_account_ma_term` smallint(5) unsigned DEFAULT NULL,
  `client_account_ma_due_date` bigint(15) unsigned DEFAULT NULL,
  `client_account_ma_interest` double(5,2) unsigned DEFAULT NULL,
  `client_account_ma_factor` double(9,8) unsigned DEFAULT NULL,
  `client_account_ma_monthly` double(10,2) unsigned DEFAULT NULL,
  `client_account_ma_rebate` double(5,2) unsigned DEFAULT NULL,
  `client_account_ma_balance_collected` double(10,2) unsigned DEFAULT '0.00',
  `client_account_ma_balance_remaining` double(10,2) unsigned DEFAULT '0.00',
  `client_account_structure_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`client_account_structure_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `client_account_structure` */

insert  into `client_account_structure`(`client_account_structure_id`,`client_id`,`client_account_id`,`user_id`,`client_account_structure_active`,`client_account_ma_amount`,`client_account_ma_term`,`client_account_ma_due_date`,`client_account_ma_interest`,`client_account_ma_factor`,`client_account_ma_monthly`,`client_account_ma_rebate`,`client_account_ma_balance_collected`,`client_account_ma_balance_remaining`,`client_account_structure_timestamp`) values (20,22,19,7,1,1682240.00,60,1500048000,15.00,0.02378993,40021.00,1.20,0.00,0.00,1435745256),(21,23,20,7,1,2120000.00,60,1439568000,15.00,0.02378993,50435.00,1.20,0.00,0.00,1435746198),(22,24,21,7,1,594800.00,60,1442246400,15.00,0.02378993,14151.00,1.20,0.00,0.00,1435746670),(23,25,22,7,1,612800.00,1,1444838400,15.00,1.01250000,620460.00,1.20,0.00,0.00,1435760076),(24,26,23,7,1,558000.00,1,1436889600,15.00,1.01250000,564975.00,1.20,0.00,0.00,1435761352);

/*Table structure for table `client_account_transfer` */

DROP TABLE IF EXISTS `client_account_transfer`;

CREATE TABLE `client_account_transfer` (
  `client_account_transfer` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `client_account_id` bigint(20) unsigned DEFAULT NULL,
  `lot_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_account_transfer_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`client_account_transfer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `client_account_transfer` */

/*Table structure for table `client_member` */

DROP TABLE IF EXISTS `client_member`;

CREATE TABLE `client_member` (
  `client_member_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `client_member_name` varchar(200) DEFAULT NULL,
  `client_member_relation` varchar(100) DEFAULT NULL,
  `client_member_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`client_member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `client_member` */

/*Table structure for table `commission_contingency` */

DROP TABLE IF EXISTS `commission_contingency`;

CREATE TABLE `commission_contingency` (
  `commission_contingency_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bank_transaction_id` bigint(20) DEFAULT NULL,
  `client_account_agent_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`commission_contingency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `commission_contingency` */

insert  into `commission_contingency`(`commission_contingency_id`,`bank_transaction_id`,`client_account_agent_id`) values (1,54,1),(2,55,0),(3,56,3),(4,57,0),(5,60,5),(6,61,0),(7,62,7),(8,63,0),(9,88,12),(10,89,13),(11,90,14),(12,153,1);

/*Table structure for table `document_account` */

DROP TABLE IF EXISTS `document_account`;

CREATE TABLE `document_account` (
  `document_account_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `document_type_id` smallint(3) unsigned DEFAULT NULL,
  `client_account_id` bigint(10) unsigned DEFAULT NULL,
  `document_account_status` tinyint(1) unsigned DEFAULT '0',
  `document_account_timestamp` bigint(15) unsigned DEFAULT NULL,
  `document_account_received_by_firstname` varchar(25) DEFAULT NULL,
  `document_account_received_by_lastname` varchar(25) DEFAULT NULL,
  `document_account_date_submit` bigint(15) unsigned DEFAULT NULL,
  `document_account_date_cleared` bigint(15) unsigned DEFAULT NULL,
  `user_id` int(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`document_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `document_account` */

insert  into `document_account`(`document_account_id`,`document_type_id`,`client_account_id`,`document_account_status`,`document_account_timestamp`,`document_account_received_by_firstname`,`document_account_received_by_lastname`,`document_account_date_submit`,`document_account_date_cleared`,`user_id`) values (1,1,15,1,1433970061,'Bridgette','Jones',1436803200,1437408000,NULL),(2,2,15,0,1433970061,NULL,NULL,NULL,NULL,NULL),(3,3,15,0,1433970061,NULL,NULL,NULL,NULL,NULL),(4,1,16,1,1433970061,'Bridgette','Ramos',1433865600,1434556800,NULL),(5,2,16,1,1433970061,'Rudy','Jones',1433865600,1434470400,NULL),(6,3,16,1,1433970061,'Bridgette','Jones',1434384000,1434556800,NULL),(7,1,17,0,1433970061,NULL,NULL,NULL,NULL,NULL),(8,2,17,0,1433970061,NULL,NULL,NULL,NULL,NULL),(9,3,17,0,1433970061,NULL,NULL,NULL,NULL,NULL),(10,1,19,0,1435745256,NULL,NULL,NULL,NULL,NULL),(11,2,19,0,1435745256,NULL,NULL,NULL,NULL,NULL),(12,3,19,0,1435745256,NULL,NULL,NULL,NULL,NULL),(13,1,20,0,1435746198,NULL,NULL,NULL,NULL,NULL),(14,2,20,0,1435746198,NULL,NULL,NULL,NULL,NULL),(15,3,20,0,1435746198,NULL,NULL,NULL,NULL,NULL),(16,1,21,0,1435746670,NULL,NULL,NULL,NULL,NULL),(17,2,21,0,1435746670,NULL,NULL,NULL,NULL,NULL),(18,3,21,0,1435746670,NULL,NULL,NULL,NULL,NULL),(19,1,22,0,1435760076,NULL,NULL,NULL,NULL,NULL),(20,2,22,0,1435760076,NULL,NULL,NULL,NULL,NULL),(21,3,22,0,1435760076,NULL,NULL,NULL,NULL,NULL),(22,1,23,0,1435761352,NULL,NULL,NULL,NULL,NULL),(23,2,23,0,1435761352,NULL,NULL,NULL,NULL,NULL),(24,3,23,0,1435761352,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `document_lot` */

DROP TABLE IF EXISTS `document_lot`;

CREATE TABLE `document_lot` (
  `document_lot_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `document_type_id` smallint(3) unsigned DEFAULT NULL,
  `lot_id` bigint(10) unsigned DEFAULT NULL,
  `document_lot_status` tinyint(1) unsigned DEFAULT '0',
  `document_lot_timestamp` bigint(15) unsigned DEFAULT NULL,
  `document_lot_received_by_firstname` varchar(25) DEFAULT NULL,
  `document_lot_received_by_lastname` varchar(25) DEFAULT NULL,
  `document_lot_date_submit` bigint(15) unsigned DEFAULT NULL,
  `document_lot_date_cleared` bigint(15) unsigned DEFAULT NULL,
  `user_id` int(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`document_lot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

/*Data for the table `document_lot` */

insert  into `document_lot`(`document_lot_id`,`document_type_id`,`lot_id`,`document_lot_status`,`document_lot_timestamp`,`document_lot_received_by_firstname`,`document_lot_received_by_lastname`,`document_lot_date_submit`,`document_lot_date_cleared`,`user_id`) values (1,1,1,1,1433964612,'Arvin','Alejandro',1436457600,1436803200,NULL),(2,2,1,0,1433964612,NULL,NULL,NULL,NULL,NULL),(3,3,1,0,1433964613,NULL,NULL,NULL,NULL,NULL),(4,1,2,0,1433964613,NULL,NULL,NULL,NULL,NULL),(5,2,2,0,1433964613,NULL,NULL,NULL,NULL,NULL),(6,3,2,0,1433964613,NULL,NULL,NULL,NULL,NULL),(7,1,3,0,1433964613,NULL,NULL,NULL,NULL,NULL),(8,2,3,0,1433964613,NULL,NULL,NULL,NULL,NULL),(9,3,3,0,1433964613,NULL,NULL,NULL,NULL,NULL),(10,1,4,0,1433964613,NULL,NULL,NULL,NULL,NULL),(11,2,4,0,1433964613,NULL,NULL,NULL,NULL,NULL),(12,3,4,0,1433964613,NULL,NULL,NULL,NULL,NULL),(13,1,5,0,1433964613,NULL,NULL,NULL,NULL,NULL),(14,2,5,0,1433964613,NULL,NULL,NULL,NULL,NULL),(15,3,5,0,1433964613,NULL,NULL,NULL,NULL,NULL),(16,1,8,0,1435759328,NULL,NULL,NULL,NULL,NULL),(17,2,8,0,1435759328,NULL,NULL,NULL,NULL,NULL),(18,3,8,0,1435759328,NULL,NULL,NULL,NULL,NULL),(19,1,9,0,1435759328,NULL,NULL,NULL,NULL,NULL),(20,2,9,0,1435759328,NULL,NULL,NULL,NULL,NULL),(21,3,9,0,1435759328,NULL,NULL,NULL,NULL,NULL),(22,1,10,0,1435759328,NULL,NULL,NULL,NULL,NULL),(23,2,10,0,1435759328,NULL,NULL,NULL,NULL,NULL),(24,3,10,0,1435759329,NULL,NULL,NULL,NULL,NULL),(25,1,11,0,1435759329,NULL,NULL,NULL,NULL,NULL),(26,2,11,0,1435759329,NULL,NULL,NULL,NULL,NULL),(27,3,11,0,1435759329,NULL,NULL,NULL,NULL,NULL),(28,1,12,0,1435759329,NULL,NULL,NULL,NULL,NULL),(29,2,12,0,1435759329,NULL,NULL,NULL,NULL,NULL),(30,3,12,0,1435759329,NULL,NULL,NULL,NULL,NULL),(31,1,13,0,1435759392,NULL,NULL,NULL,NULL,NULL),(32,2,13,0,1435759392,NULL,NULL,NULL,NULL,NULL),(33,3,13,0,1435759392,NULL,NULL,NULL,NULL,NULL),(34,1,14,0,1435759392,NULL,NULL,NULL,NULL,NULL),(35,2,14,0,1435759392,NULL,NULL,NULL,NULL,NULL),(36,3,14,0,1435759392,NULL,NULL,NULL,NULL,NULL),(37,1,15,0,1435759392,NULL,NULL,NULL,NULL,NULL),(38,2,15,0,1435759392,NULL,NULL,NULL,NULL,NULL),(39,3,15,0,1435759392,NULL,NULL,NULL,NULL,NULL),(40,1,16,0,1435759392,NULL,NULL,NULL,NULL,NULL),(41,2,16,0,1435759392,NULL,NULL,NULL,NULL,NULL),(42,3,16,0,1435759392,NULL,NULL,NULL,NULL,NULL),(43,1,17,0,1435759392,NULL,NULL,NULL,NULL,NULL),(44,2,17,0,1435759392,NULL,NULL,NULL,NULL,NULL),(45,3,17,0,1435759392,NULL,NULL,NULL,NULL,NULL),(46,1,18,0,1435759426,NULL,NULL,NULL,NULL,NULL),(47,2,18,0,1435759426,NULL,NULL,NULL,NULL,NULL),(48,3,18,0,1435759426,NULL,NULL,NULL,NULL,NULL),(49,1,19,0,1435759426,NULL,NULL,NULL,NULL,NULL),(50,2,19,0,1435759426,NULL,NULL,NULL,NULL,NULL),(51,3,19,0,1435759426,NULL,NULL,NULL,NULL,NULL),(52,1,20,0,1435759426,NULL,NULL,NULL,NULL,NULL),(53,2,20,0,1435759426,NULL,NULL,NULL,NULL,NULL),(54,3,20,0,1435759426,NULL,NULL,NULL,NULL,NULL),(55,1,21,0,1435759426,NULL,NULL,NULL,NULL,NULL),(56,2,21,0,1435759426,NULL,NULL,NULL,NULL,NULL),(57,3,21,0,1435759426,NULL,NULL,NULL,NULL,NULL),(58,1,22,0,1435759426,NULL,NULL,NULL,NULL,NULL),(59,2,22,0,1435759426,NULL,NULL,NULL,NULL,NULL),(60,3,22,0,1435759427,NULL,NULL,NULL,NULL,NULL),(61,1,23,0,1435759452,NULL,NULL,NULL,NULL,NULL),(62,2,23,0,1435759452,NULL,NULL,NULL,NULL,NULL),(63,3,23,0,1435759452,NULL,NULL,NULL,NULL,NULL),(64,1,24,0,1435759452,NULL,NULL,NULL,NULL,NULL),(65,2,24,0,1435759452,NULL,NULL,NULL,NULL,NULL),(66,3,24,0,1435759452,NULL,NULL,NULL,NULL,NULL),(67,1,25,0,1435759453,NULL,NULL,NULL,NULL,NULL),(68,2,25,0,1435759453,NULL,NULL,NULL,NULL,NULL),(69,3,25,0,1435759453,NULL,NULL,NULL,NULL,NULL),(70,1,26,0,1435759453,NULL,NULL,NULL,NULL,NULL),(71,2,26,0,1435759453,NULL,NULL,NULL,NULL,NULL),(72,3,26,0,1435759453,NULL,NULL,NULL,NULL,NULL),(73,1,27,0,1435759453,NULL,NULL,NULL,NULL,NULL),(74,2,27,0,1435759453,NULL,NULL,NULL,NULL,NULL),(75,3,27,0,1435759453,NULL,NULL,NULL,NULL,NULL),(76,1,28,0,1435759481,NULL,NULL,NULL,NULL,NULL),(77,2,28,0,1435759481,NULL,NULL,NULL,NULL,NULL),(78,3,28,0,1435759481,NULL,NULL,NULL,NULL,NULL),(79,1,29,0,1435759481,NULL,NULL,NULL,NULL,NULL),(80,2,29,0,1435759481,NULL,NULL,NULL,NULL,NULL),(81,3,29,0,1435759481,NULL,NULL,NULL,NULL,NULL),(82,1,30,0,1435759481,NULL,NULL,NULL,NULL,NULL),(83,2,30,0,1435759481,NULL,NULL,NULL,NULL,NULL),(84,3,30,0,1435759481,NULL,NULL,NULL,NULL,NULL),(85,1,31,0,1435759481,NULL,NULL,NULL,NULL,NULL),(86,2,31,0,1435759481,NULL,NULL,NULL,NULL,NULL),(87,3,31,0,1435759481,NULL,NULL,NULL,NULL,NULL),(88,1,32,0,1435759482,NULL,NULL,NULL,NULL,NULL),(89,2,32,0,1435759482,NULL,NULL,NULL,NULL,NULL),(90,3,32,0,1435759482,NULL,NULL,NULL,NULL,NULL),(91,1,33,0,1435759507,NULL,NULL,NULL,NULL,NULL),(92,2,33,0,1435759507,NULL,NULL,NULL,NULL,NULL),(93,3,33,0,1435759507,NULL,NULL,NULL,NULL,NULL),(94,1,34,0,1435759507,NULL,NULL,NULL,NULL,NULL),(95,2,34,0,1435759507,NULL,NULL,NULL,NULL,NULL),(96,3,34,0,1435759507,NULL,NULL,NULL,NULL,NULL),(97,1,35,0,1435759507,NULL,NULL,NULL,NULL,NULL),(98,2,35,0,1435759507,NULL,NULL,NULL,NULL,NULL),(99,3,35,0,1435759507,NULL,NULL,NULL,NULL,NULL),(100,1,36,0,1435759507,NULL,NULL,NULL,NULL,NULL),(101,2,36,0,1435759507,NULL,NULL,NULL,NULL,NULL),(102,3,36,0,1435759507,NULL,NULL,NULL,NULL,NULL),(103,1,37,0,1435759508,NULL,NULL,NULL,NULL,NULL),(104,2,37,0,1435759508,NULL,NULL,NULL,NULL,NULL),(105,3,37,0,1435759508,NULL,NULL,NULL,NULL,NULL),(106,1,38,0,1435759527,NULL,NULL,NULL,NULL,NULL),(107,2,38,0,1435759527,NULL,NULL,NULL,NULL,NULL),(108,3,38,0,1435759527,NULL,NULL,NULL,NULL,NULL),(109,1,39,0,1435759528,NULL,NULL,NULL,NULL,NULL),(110,2,39,0,1435759528,NULL,NULL,NULL,NULL,NULL),(111,3,39,0,1435759528,NULL,NULL,NULL,NULL,NULL),(112,1,40,0,1435759528,NULL,NULL,NULL,NULL,NULL),(113,2,40,0,1435759528,NULL,NULL,NULL,NULL,NULL),(114,3,40,0,1435759528,NULL,NULL,NULL,NULL,NULL),(115,1,41,0,1435759528,NULL,NULL,NULL,NULL,NULL),(116,2,41,0,1435759528,NULL,NULL,NULL,NULL,NULL),(117,3,41,0,1435759528,NULL,NULL,NULL,NULL,NULL),(118,1,42,0,1435759528,NULL,NULL,NULL,NULL,NULL),(119,2,42,0,1435759528,NULL,NULL,NULL,NULL,NULL),(120,3,42,0,1435759528,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `document_type` */

DROP TABLE IF EXISTS `document_type`;

CREATE TABLE `document_type` (
  `document_type_id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `document_type_name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`document_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `document_type` */

insert  into `document_type`(`document_type_id`,`document_type_name`) values (1,'RA'),(2,'CTS'),(3,'ACTS');

/*Table structure for table `house` */

DROP TABLE IF EXISTS `house`;

CREATE TABLE `house` (
  `house_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `option_house_classification_id` varchar(20) DEFAULT NULL,
  `house_name` varchar(100) DEFAULT NULL,
  `house_code` varchar(100) DEFAULT NULL,
  `house_acronym` varchar(50) DEFAULT NULL,
  `house_area` double(10,2) unsigned DEFAULT NULL,
  `house_price` double(10,2) unsigned DEFAULT NULL,
  `house_timestamp` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`house_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `house` */

insert  into `house`(`house_id`,`project_id`,`option_house_classification_id`,`house_name`,`house_code`,`house_acronym`,`house_area`,`house_price`,`house_timestamp`) values (1,1,'two_storey','Casa Royale','','CSR',150.00,1500000.00,1433958948);

/*Table structure for table `house_price` */

DROP TABLE IF EXISTS `house_price`;

CREATE TABLE `house_price` (
  `house_price_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `house_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `house_price_value` double(10,2) unsigned DEFAULT NULL,
  `house_price_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`house_price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `house_price` */

insert  into `house_price`(`house_price_id`,`house_id`,`user_id`,`house_price_value`,`house_price_timestamp`) values (9,10,8,1375400.54,1406012978),(11,12,8,13560212.00,1406013743),(12,13,8,1578588.57,1406013878),(13,10,8,1375400.54,1406017116),(14,10,8,1375400.54,1406017130),(16,10,8,138965.54,1406017365),(17,12,8,3560212.00,1406017395),(18,14,8,1084000.00,1406033787),(19,15,3,1931500.00,1406062563),(20,16,3,2077320.00,1406998820),(21,15,3,1731500.00,1408979105),(22,15,7,1331500.00,1409842910),(23,17,7,1800000.00,1412229358),(24,18,7,2500000.00,1412232869),(25,19,7,1800000.00,1412233377),(26,20,7,1300000.00,1412650126),(27,20,7,1500000.00,1412650181),(28,10,7,138965.54,1412650695),(29,10,7,1438000.00,1412650752),(30,20,7,1325520.00,1412655618),(31,21,7,2125000.00,1412829358),(32,22,7,3502125.00,1412829382),(33,23,7,1250468.00,1413261136),(34,17,7,1468760.00,1413425663),(35,17,7,1460600.00,1413425832),(36,24,7,1250000.00,1413865807),(37,1,7,1000000.00,1427598537),(38,2,7,2000000.00,1427758471),(39,3,7,2000000.00,1427758567),(40,3,7,2000000.00,1427758585),(41,3,7,3000000.00,1427758736),(42,3,7,2000000.00,1427758743),(43,4,7,1000000.00,1427759126),(44,5,7,2000000.00,1427759652),(45,1,7,1500000.00,1433958948);

/*Table structure for table `item_type` */

DROP TABLE IF EXISTS `item_type`;

CREATE TABLE `item_type` (
  `item_type_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `item_type_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`item_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `item_type` */

insert  into `item_type`(`item_type_id`,`item_type_name`) values (1,'Car Sticker'),(2,'Billing Documents'),(3,'Clubhouse Rental'),(4,'Parking Fee'),(5,'Reservation'),(6,'Monthly Dues');

/*Table structure for table `jv_type` */

DROP TABLE IF EXISTS `jv_type`;

CREATE TABLE `jv_type` (
  `jv_type_id` varchar(30) NOT NULL,
  `jv_type_name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`jv_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `jv_type` */

insert  into `jv_type`(`jv_type_id`,`jv_type_name`) values ('adjustment','Adjustment'),('cancelled_cheque','Cancelled Cheque'),('floating_commission','Floating Commission'),('income_tax','Income Tax'),('quarterly_tax','Quarterly Tax'),('transaction_fee','Transaction Fee'),('withholding_tax','Withholding Tax');

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(5) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `log_description` varchar(1000) DEFAULT NULL,
  `log_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `log` */

/*Table structure for table `lot` */

DROP TABLE IF EXISTS `lot`;

CREATE TABLE `lot` (
  `lot_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `project_site_id` bigint(20) unsigned DEFAULT NULL,
  `project_site_block_id` bigint(20) unsigned DEFAULT NULL,
  `option_unit_id` varchar(20) DEFAULT 'lot_only',
  `option_availability_id` varchar(20) DEFAULT 'available',
  `house_id` int(10) unsigned DEFAULT '0',
  `network_id` bigint(20) unsigned DEFAULT '0',
  `network_division_id` bigint(20) unsigned DEFAULT '0',
  `lot_name` varchar(100) DEFAULT NULL,
  `lot_area` double(10,2) unsigned DEFAULT NULL,
  `lot_price` double(10,2) unsigned DEFAULT NULL,
  `lot_address` varchar(100) DEFAULT NULL,
  `lot_city` varchar(50) DEFAULT NULL,
  `lot_zip` varchar(50) DEFAULT NULL,
  `agent_id` bigint(20) DEFAULT NULL,
  `sales_manager_id` bigint(20) DEFAULT NULL,
  `sales_director_id` bigint(20) DEFAULT NULL,
  `lot_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`lot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

/*Data for the table `lot` */

insert  into `lot`(`lot_id`,`project_id`,`project_site_id`,`project_site_block_id`,`option_unit_id`,`option_availability_id`,`house_id`,`network_id`,`network_division_id`,`lot_name`,`lot_area`,`lot_price`,`lot_address`,`lot_city`,`lot_zip`,`agent_id`,`sales_manager_id`,`sales_director_id`,`lot_timestamp`) values (1,1,1,1,'package','sold',1,1,0,'1',120.00,5000.00,'Malolos','Bulacan','1500',0,0,0,1433958879),(2,1,1,1,'package','sold',1,0,0,'2',120.00,5000.00,'Malolos','Bulacan','1500',0,0,0,1433958879),(3,1,1,1,'lot_only','available',0,0,0,'3',120.00,5000.00,'Malolos','Bulacan','1500',0,0,0,1433958879),(4,1,1,1,'lot_only','available',0,1,0,'4',120.00,5000.00,'Malolos','Bulacan','1500',0,0,0,1433958879),(5,1,1,1,'package','available',1,0,0,'5',120.00,5000.00,'Malolos','Bulacan','1500',19,17,16,1433958879),(7,2,2,1,'lot_only','available',0,0,0,'6',120.00,5000.00,'Malolos','Bulacan','1500',NULL,NULL,NULL,1433958879),(8,6,4,2,'lot_only','available',0,0,0,'1',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759328),(9,6,4,2,'lot_only','available',0,0,0,'2',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759328),(10,6,4,2,'lot_only','available',0,0,0,'3',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759328),(11,6,4,2,'lot_only','available',0,0,0,'4',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759329),(12,6,4,2,'lot_only','available',0,0,0,'5',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759329),(13,8,5,3,'lot_only','on_hold',0,0,0,'1',120.00,5000.00,'Bulacan','Bulacan','1600',0,0,0,1435759391),(14,8,5,3,'lot_only','on_hold',0,0,0,'2',120.00,5000.00,'Bulacan','Bulacan','1600',0,0,0,1435759392),(15,8,5,3,'lot_only','sold',0,0,0,'3',120.00,5000.00,'Bulacan','Bulacan','1600',0,0,0,1435759392),(16,8,5,3,'lot_only','sold',0,0,0,'4',120.00,5000.00,'Bulacan','Bulacan','1600',0,0,0,1435759392),(17,8,5,3,'lot_only','available',0,0,0,'5',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759392),(18,3,6,4,'lot_only','available',0,0,0,'1',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759426),(19,3,6,4,'lot_only','available',0,0,0,'2',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759426),(20,3,6,4,'lot_only','available',0,0,0,'3',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759426),(21,3,6,4,'lot_only','available',0,0,0,'4',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759426),(22,3,6,4,'lot_only','available',0,0,0,'5',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759426),(23,9,7,5,'lot_only','available',0,0,0,'1',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759452),(24,9,7,5,'lot_only','available',0,0,0,'2',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759452),(25,9,7,5,'lot_only','available',0,0,0,'3',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759452),(26,9,7,5,'lot_only','available',0,0,0,'4',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759453),(27,9,7,5,'lot_only','available',0,0,0,'5',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759453),(28,7,8,6,'lot_only','available',0,0,0,'1',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759481),(29,7,8,6,'lot_only','available',0,0,0,'2',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759481),(30,7,8,6,'lot_only','available',0,0,0,'3',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759481),(31,7,8,6,'lot_only','available',0,0,0,'4',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759481),(32,7,8,6,'lot_only','available',0,0,0,'5',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759482),(33,5,9,7,'lot_only','available',0,0,0,'1',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759507),(34,5,9,7,'lot_only','available',0,0,0,'2',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759507),(35,5,9,7,'lot_only','available',0,0,0,'3',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759507),(36,5,9,7,'lot_only','available',0,0,0,'4',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759507),(37,5,9,7,'lot_only','available',0,0,0,'5',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759508),(38,4,10,8,'lot_only','available',0,0,0,'1',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759527),(39,4,10,8,'lot_only','available',0,0,0,'2',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759527),(40,4,10,8,'lot_only','available',0,0,0,'3',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759528),(41,4,10,8,'lot_only','available',0,0,0,'4',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759528),(42,4,10,8,'lot_only','available',0,0,0,'5',120.00,5000.00,'Bulacan','Bulacan','1600',NULL,NULL,NULL,1435759528);

/*Table structure for table `lot_construction` */

DROP TABLE IF EXISTS `lot_construction`;

CREATE TABLE `lot_construction` (
  `lot_construction_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lot_id` bigint(20) unsigned DEFAULT NULL,
  `house_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `option_unit_construction_id` varchar(20) DEFAULT NULL,
  `option_unit_status_id` varchar(20) DEFAULT NULL,
  `option_unit_contractor_id` varchar(20) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `lot_construction_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`lot_construction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `lot_construction` */

insert  into `lot_construction`(`lot_construction_id`,`lot_id`,`house_id`,`option_unit_construction_id`,`option_unit_status_id`,`option_unit_contractor_id`,`user_id`,`lot_construction_timestamp`) values (1,1,1,'house','for_costing','in_house',7,1433959011),(2,2,1,'house','ready','in_house',7,1433964729),(3,5,1,'house','ready','in_house',7,1433978834);

/*Table structure for table `lot_price` */

DROP TABLE IF EXISTS `lot_price`;

CREATE TABLE `lot_price` (
  `lot_price_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lot_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `lot_price_value` double(10,2) unsigned DEFAULT NULL,
  `lot_price_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`lot_price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `lot_price` */

insert  into `lot_price`(`lot_price_id`,`lot_id`,`user_id`,`lot_price_value`,`lot_price_timestamp`) values (1,1,7,5000.00,1433958879),(2,2,7,5000.00,1433958879),(3,3,7,5000.00,1433958879),(4,4,7,5000.00,1433958879),(5,5,7,5000.00,1433958879),(6,8,7,5000.00,1435759328),(7,9,7,5000.00,1435759328),(8,10,7,5000.00,1435759329),(9,11,7,5000.00,1435759329),(10,12,7,5000.00,1435759329),(11,13,7,5000.00,1435759392),(12,14,7,5000.00,1435759392),(13,15,7,5000.00,1435759392),(14,16,7,5000.00,1435759392),(15,17,7,5000.00,1435759392),(16,18,7,5000.00,1435759426),(17,19,7,5000.00,1435759426),(18,20,7,5000.00,1435759426),(19,21,7,5000.00,1435759426),(20,22,7,5000.00,1435759427),(21,23,7,5000.00,1435759452),(22,24,7,5000.00,1435759452),(23,25,7,5000.00,1435759453),(24,26,7,5000.00,1435759453),(25,27,7,5000.00,1435759453),(26,28,7,5000.00,1435759481),(27,29,7,5000.00,1435759481),(28,30,7,5000.00,1435759481),(29,31,7,5000.00,1435759481),(30,32,7,5000.00,1435759482),(31,33,7,5000.00,1435759507),(32,34,7,5000.00,1435759507),(33,35,7,5000.00,1435759507),(34,36,7,5000.00,1435759507),(35,37,7,5000.00,1435759508),(36,38,7,5000.00,1435759527),(37,39,7,5000.00,1435759528),(38,40,7,5000.00,1435759528),(39,41,7,5000.00,1435759528),(40,42,7,5000.00,1435759528);

/*Table structure for table `message_group` */

DROP TABLE IF EXISTS `message_group`;

CREATE TABLE `message_group` (
  `message_group_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(9) unsigned DEFAULT NULL,
  `message_group_name` varchar(50) DEFAULT NULL,
  `message_group_timestamp_latest` bigint(15) unsigned DEFAULT NULL,
  `message_group_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`message_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `message_group` */

insert  into `message_group`(`message_group_id`,`user_id`,`message_group_name`,`message_group_timestamp_latest`,`message_group_timestamp`) values (1,7,NULL,1437573504,1437471420),(2,7,NULL,1437573729,1437479164);

/*Table structure for table `message_group_user` */

DROP TABLE IF EXISTS `message_group_user`;

CREATE TABLE `message_group_user` (
  `message_group_user_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `message_group_id` bigint(15) unsigned DEFAULT NULL,
  `user_id` int(9) unsigned DEFAULT NULL,
  `message_read` tinyint(1) unsigned DEFAULT '0',
  `last_view_timestamp` bigint(15) unsigned DEFAULT '0',
  PRIMARY KEY (`message_group_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `message_group_user` */

insert  into `message_group_user`(`message_group_user_id`,`message_group_id`,`user_id`,`message_read`,`last_view_timestamp`) values (1,1,7,1,1437574162),(2,1,12,0,1437571342),(3,2,7,1,1437663983),(4,2,15,0,1437571191),(5,2,12,0,1437571309),(6,2,14,0,0);

/*Table structure for table `message_user` */

DROP TABLE IF EXISTS `message_user`;

CREATE TABLE `message_user` (
  `message_user_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(9) unsigned DEFAULT NULL,
  `message_group_id` bigint(15) unsigned DEFAULT NULL,
  `message_user_content` blob,
  `message_user_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`message_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `message_user` */

insert  into `message_user`(`message_user_id`,`user_id`,`message_group_id`,`message_user_content`,`message_user_timestamp`) values (1,7,1,'asfasfaaafsfafaffsfasf',1437471420),(2,7,1,'Sales\r\nDB structures\r\n-Agents DB structure for Lot Hold\r\n-Change of approch for commission computation and trigger\r\n*Lot table will no longer be embedded by Agent ID, every sale of agent will be through lot hold.\r\n- Merging of DB for Agent Sales Manager and Agent Sales Director.\r\n* Relationships and heirarchy will be through Agent Position Id\r\n**Upon Implementation, Sales Reports Queries will be created.\r\n  \r\n\r\nFor Sales Manager/Sales Director/Network/Division\r\n-Assigning of Lots will be through Lot Hold.\r\n-New View for Assigned lots per Sales Manager/Sales Director/Network/Division\r\n- Revise layout for Lot Hold accommodating Both old and new scheme. (currently only for new scheme)\r\n\r\nFor Contingency\r\n- Trigger after commission is released in disbursement.',1437474420),(3,7,2,'Hello Guys This is a sample chat for you to use',1437479165),(4,7,2,'test',1437482837),(5,7,2,'hello',1437482910),(6,7,2,'testing ulut',1437482980),(7,7,2,'hi',1437482993),(8,7,2,'3333',1437483079),(9,7,2,'111',1437483125),(10,7,2,'hi',1437483142),(11,7,2,'sample',1437484797),(12,7,2,'test',1437484938),(13,7,2,'tesaataa',1437484974),(14,7,2,'teaagagsags',1437485011),(15,7,2,'test',1437485792),(16,7,2,'test',1437485960),(17,7,2,'ehllo',1437485970),(18,7,2,'test',1437565595),(19,7,2,'hello',1437565602),(20,7,2,'yes',1437565707),(21,7,2,'hi',1437565772),(22,7,2,'tst',1437566931),(23,7,2,'aasfafs',1437566934),(24,7,1,'hello',1437567001),(25,7,1,'sample',1437567006),(26,7,1,'test',1437567010),(27,7,2,'hello',1437567026),(28,7,2,'sample',1437567037),(29,7,1,'hi',1437567049),(30,7,2,'hello',1437567105),(31,7,2,'test',1437567149),(32,7,2,'1',1437567219),(33,7,2,'asadsd',1437567256),(34,7,1,'1',1437567282),(35,7,1,'22',1437567476),(36,7,1,'hi',1437567481),(37,7,2,'1',1437567489),(38,7,2,'hi',1437567599),(39,7,1,'hello',1437567615),(40,15,2,'yes?',1437571141),(41,12,1,'hi',1437571320),(42,7,1,'Write your message here',1437573503),(43,7,1,'',1437573504),(44,7,1,'',1437573505),(45,7,2,'wala',1437573729);

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `module_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) DEFAULT NULL,
  `module_link` varchar(200) DEFAULT '#',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `module` */

insert  into `module`(`module_id`,`module_name`,`module_link`) values (7,'Sales','/sales'),(8,'Disbursement','/finance_disbursement'),(9,'Accounting','/finance_accounting'),(10,'Documentation','/documentation'),(11,'EDP Content Management System','/edp_cms'),(12,'EDP Inventory Management System','/edp_inventory'),(13,'EDP Client Management System','/edp_client'),(14,'Finance Cashier','/finance_cashier'),(15,'Finance Billing','/finance_billing'),(16,'Treasury','/treasury');

/*Table structure for table `ofv_balance` */

DROP TABLE IF EXISTS `ofv_balance`;

CREATE TABLE `ofv_balance` (
  `ofv_balance_id` varchar(10) DEFAULT NULL,
  `ofv_balance_amount` double(15,2) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ofv_balance` */

insert  into `ofv_balance`(`ofv_balance_id`,`ofv_balance_amount`) values ('amt',388911.38);

/*Table structure for table `ofv_request` */

DROP TABLE IF EXISTS `ofv_request`;

CREATE TABLE `ofv_request` (
  `ofv_request_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_payable_id` bigint(20) unsigned DEFAULT NULL,
  `account_payable_ofv_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`ofv_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `ofv_request` */

insert  into `ofv_request`(`ofv_request_id`,`account_payable_id`,`account_payable_ofv_id`) values (1,6,1),(2,6,2),(3,8,3);

/*Table structure for table `option` */

DROP TABLE IF EXISTS `option`;

CREATE TABLE `option` (
  `option_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(100) DEFAULT NULL,
  `option_key` varchar(100) DEFAULT NULL,
  `option_value` varchar(1000) DEFAULT NULL,
  `option_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option` */

/*Table structure for table `option_account_chart_child` */

DROP TABLE IF EXISTS `option_account_chart_child`;

CREATE TABLE `option_account_chart_child` (
  `option_account_chart_child_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_account_chart_parent_id` bigint(20) DEFAULT NULL,
  `option_account_chart_child_name` varchar(100) DEFAULT NULL,
  `option_account_chart_child_code` varchar(25) DEFAULT NULL,
  `is_water_related` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`option_account_chart_child_id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

/*Data for the table `option_account_chart_child` */

insert  into `option_account_chart_child`(`option_account_chart_child_id`,`option_account_chart_parent_id`,`option_account_chart_child_name`,`option_account_chart_child_code`,`is_water_related`) values (1,2,'Far East/BPI-Balintawak',NULL,0),(2,2,'Security Bank-Malolos',NULL,0),(3,2,'RBSR',NULL,0),(4,2,'RBPI',NULL,0),(5,2,'PNB-Malolos',NULL,0),(6,2,'Planters-Main',NULL,0),(7,2,'Planters-Malolos',NULL,0),(8,2,'Land Bank-Malolos',NULL,0),(9,2,'BDO/EPCIBANK-Malolos',NULL,0),(10,2,'BDO/EPCIBANK-Manila',NULL,0),(11,2,'Maybank-Hagonoy',NULL,0),(12,3,'PNB-$-SA',NULL,0),(13,3,'SBC-$-SA',NULL,0),(14,4,'BOC-$-BAL',NULL,0),(15,4,'PDB-Main',NULL,0),(16,5,'Main Office',NULL,0),(17,5,'Caloocan',NULL,0),(18,6,'Telephone',NULL,0),(19,6,'SSS',NULL,0),(20,6,'Others',NULL,0),(21,7,'CAR',NULL,0),(22,7,'Gasolin',NULL,0),(23,7,'SIR/OTC',NULL,0),(24,7,'ORC',NULL,0),(25,7,'Future Commission',NULL,0),(26,7,'Others',NULL,0),(27,8,'MAXICARE-ALSC',NULL,0),(28,8,'MAXICARE-JAM ASIA',NULL,0),(29,8,'MAXICARE-PSMI',NULL,0),(30,8,'MAXICARE-SECURITY',NULL,0),(31,8,'Life Insuranace-PSMI',NULL,0),(32,8,'Emergency Loan-JAM',NULL,0),(33,8,'Salary Loan-ALSC',NULL,0),(34,8,'Salary Loan-JAM ASIA',NULL,0),(35,8,'Salary Loan-PSMI',NULL,0),(36,8,'Salary Loan-SECURITY',NULL,0),(37,9,'MOC',NULL,0),(38,9,'AMB',NULL,0),(39,11,'Basketball Court',NULL,0),(40,11,'Clubhouse',NULL,0),(41,11,'Curbs&Gutter',NULL,0),(42,11,'Deepwell',NULL,0),(43,11,'Drainage',NULL,0),(44,11,'Entrance&Rear Gates',NULL,0),(45,11,'Equipment',NULL,0),(46,11,'Filling&Embankment',NULL,0),(47,11,'Furnitures&Fixutures',NULL,0),(48,11,'Ground Maintenance',NULL,0),(49,11,'Guardhouse',NULL,0),(50,11,'Inventory',NULL,0),(51,11,'Landscaping',NULL,0),(52,11,'Light,Power&Water',NULL,0),(53,11,'Miscellaneous',NULL,0),(54,11,'ModelHouse',NULL,0),(55,11,'Other Supplies',NULL,0),(56,11,'Parking Space',NULL,0),(57,11,'Parks & Playground',NULL,0),(58,11,'Perimeter Fence',NULL,0),(59,11,'Power Supply',NULL,0),(60,11,'Repairs & Maintenance',NULL,0),(61,11,'Riprapping',NULL,0),(62,11,'Road Preparation',NULL,0),(63,11,'Signage',NULL,0),(64,11,'Survey',NULL,0),(65,11,'Swimming Pool',NULL,0),(66,11,'Taxes,Licenses&Permits',NULL,0),(67,11,'Temporary Electrical Supply',NULL,0),(68,11,'Water Meter',NULL,1),(69,11,'Water Meter Installation',NULL,1),(70,11,'Water Service Line Connection',NULL,1),(71,11,'Water Tank',NULL,1),(72,12,'Quarterly Tax',NULL,0),(73,12,'Withholding Tax',NULL,0),(74,12,'Input Tax',NULL,0);

/*Table structure for table `option_account_chart_parent` */

DROP TABLE IF EXISTS `option_account_chart_parent`;

CREATE TABLE `option_account_chart_parent` (
  `option_account_chart_parent_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_account_chart_parent_name` varchar(100) DEFAULT NULL,
  `option_account_chart_parent_code` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`option_account_chart_parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `option_account_chart_parent` */

insert  into `option_account_chart_parent`(`option_account_chart_parent_id`,`option_account_chart_parent_name`,`option_account_chart_parent_code`) values (1,'Cash on Hand',NULL),(2,'Cash in Bank',NULL),(3,'Dollar Deposits',NULL),(4,'Time Deposits',NULL),(5,'Petty Cash Fund',NULL),(6,'Accounts Receivable',NULL),(7,'Advance to Agents',NULL),(8,'Advance to Employees',NULL),(9,'Advance to Officers',NULL),(10,'Pension Plan/Trust Fund',NULL),(11,'Development Cost',NULL),(12,'Tax',NULL);

/*Table structure for table `option_account_invoice_type` */

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

insert  into `option_account_invoice_type`(`option_account_invoice_type_id`,`option_account_invoice_type_code`,`option_account_invoice_type_name`,`option_account_invoice_type_order`,`option_account_invoice_type_key`) values ('billing_document','BD','Billing Documents',NULL,'other'),('club_house','CH','Club House',NULL,'other'),('credit_to_principal','Prin','Credit To Principal',NULL,'0'),('deffered_cash','DFC','Deffered Payment',NULL,'0'),('earnest','EN','Earnest',NULL,'rsv'),('misc','Misc.','Miscellaneous',NULL,'0'),('monthly_amortization','MA','Monthly Amortization',NULL,'0'),('monthly_dp','PD','Monthly Down Payment',NULL,'0'),('parking_sticker','PS','Parking Sticker',NULL,'other'),('reservation','RV','Reservation',NULL,'rsv'),('retention','RT','Retention',NULL,'0'),('scattered','SC','Scattered',NULL,'0'),('spot_cash','Spot Cash','Spot Cash',NULL,'0');

/*Table structure for table `option_account_misc` */

DROP TABLE IF EXISTS `option_account_misc`;

CREATE TABLE `option_account_misc` (
  `option_account_misc_id` varchar(20) NOT NULL,
  `option_account_misc_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`option_account_misc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_misc` */

insert  into `option_account_misc`(`option_account_misc_id`,`option_account_misc_name`) values ('full','Full'),('partial','Partial');

/*Table structure for table `option_account_p1` */

DROP TABLE IF EXISTS `option_account_p1`;

CREATE TABLE `option_account_p1` (
  `option_account_p1_id` varchar(20) NOT NULL,
  `option_account_p1_order` tinyint(2) unsigned DEFAULT '0',
  `option_account_p1_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_account_p1_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_p1` */

insert  into `option_account_p1`(`option_account_p1_id`,`option_account_p1_order`,`option_account_p1_name`) values ('full_dp',2,'Full Down Payment'),('no_dp',3,'No Down Payment'),('partial_dp',1,'Partial Down Payment'),('spot_cash',4,'Spot Cash');

/*Table structure for table `option_account_p2` */

DROP TABLE IF EXISTS `option_account_p2`;

CREATE TABLE `option_account_p2` (
  `option_account_p2_id` varchar(20) NOT NULL,
  `option_account_p2_order` tinyint(2) unsigned DEFAULT '0',
  `option_account_p2_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_account_p2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_p2` */

insert  into `option_account_p2`(`option_account_p2_id`,`option_account_p2_order`,`option_account_p2_name`) values ('1',1,'Monthly Amortization'),('2',2,'Deffered Cash Payment');

/*Table structure for table `option_account_status` */

DROP TABLE IF EXISTS `option_account_status`;

CREATE TABLE `option_account_status` (
  `option_account_status_id` varchar(20) NOT NULL,
  `option_account_status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_account_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_status` */

insert  into `option_account_status`(`option_account_status_id`,`option_account_status_name`) values ('deffered_cash','Defferred Cash Payment'),('ejected','Ejected/Foreclosed'),('fully_paid','Fully Paid'),('monthly_amortization','Monthly Amortization'),('partial_dp','Partial Downpayment'),('reservation','Reservation'),('retention','Retention');

/*Table structure for table `option_account_title` */

DROP TABLE IF EXISTS `option_account_title`;

CREATE TABLE `option_account_title` (
  `option_account_title_id` varchar(20) NOT NULL,
  `option_account_title_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_account_title_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_title` */

insert  into `option_account_title`(`option_account_title_id`,`option_account_title_name`) values ('na','Not Applicable'),('pending','Pending'),('title_alsc','Title Under ALSC');

/*Table structure for table `option_account_type` */

DROP TABLE IF EXISTS `option_account_type`;

CREATE TABLE `option_account_type` (
  `option_account_type_id` varchar(20) NOT NULL,
  `option_account_type_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_account_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_type` */

insert  into `option_account_type`(`option_account_type_id`,`option_account_type_name`) values ('international','International'),('local','Local');

/*Table structure for table `option_agent_position` */

DROP TABLE IF EXISTS `option_agent_position`;

CREATE TABLE `option_agent_position` (
  `option_agent_position_id` varchar(25) DEFAULT NULL,
  `option_agent_position_name` varchar(25) DEFAULT NULL,
  `agent_commission_scheme` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_agent_position` */

insert  into `option_agent_position`(`option_agent_position_id`,`option_agent_position_name`,`agent_commission_scheme`) values ('property_consultant','Property Consultant','new'),('sales_manager','Sales Manager','new'),('sales_director','Sales Director','new'),('marketing_associate','Marketing Associate','old'),('old_sales_manager','Sales Manager','old'),('avp','AVP','old'),('broker','Broker','old'),('vp_sales','VP Sales','new');

/*Table structure for table `option_agent_status` */

DROP TABLE IF EXISTS `option_agent_status`;

CREATE TABLE `option_agent_status` (
  `option_agent_status_id` varchar(10) DEFAULT NULL,
  `option_agent_status_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_agent_status` */

insert  into `option_agent_status`(`option_agent_status_id`,`option_agent_status_name`) values ('active','Active'),('inactive','Inactive');

/*Table structure for table `option_availability` */

DROP TABLE IF EXISTS `option_availability`;

CREATE TABLE `option_availability` (
  `option_availability_id` varchar(20) NOT NULL,
  `option_availability_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_availability_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_availability` */

insert  into `option_availability`(`option_availability_id`,`option_availability_name`) values ('available','Available'),('earnest','Earnest'),('on_hold','On-Hold'),('reserved','Reserved'),('sold','Sold');

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

/*Table structure for table `option_buyer_type` */

DROP TABLE IF EXISTS `option_buyer_type`;

CREATE TABLE `option_buyer_type` (
  `option_buyer_type_id` varchar(20) NOT NULL,
  `option_buyer_type_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_buyer_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_buyer_type` */

insert  into `option_buyer_type`(`option_buyer_type_id`,`option_buyer_type_name`) values ('agent','Agent'),('client','Client'),('employee','Employee');

/*Table structure for table `option_civil_status` */

DROP TABLE IF EXISTS `option_civil_status`;

CREATE TABLE `option_civil_status` (
  `option_civil_status_id` varchar(20) NOT NULL,
  `option_civil_status_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`option_civil_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_civil_status` */

insert  into `option_civil_status`(`option_civil_status_id`,`option_civil_status_name`) values ('married','Married'),('separated','Separated'),('single','Single'),('widow','Widow'),('widower','Widower');

/*Table structure for table `option_client_address` */

DROP TABLE IF EXISTS `option_client_address`;

CREATE TABLE `option_client_address` (
  `option_client_address_id` varchar(20) NOT NULL,
  `option_client_address_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_client_address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_client_address` */

insert  into `option_client_address`(`option_client_address_id`,`option_client_address_name`) values ('abroad','Abroad'),('local','Local');

/*Table structure for table `option_commission_version` */

DROP TABLE IF EXISTS `option_commission_version`;

CREATE TABLE `option_commission_version` (
  `option_commission_version_id` varchar(10) NOT NULL,
  `option_commission_version_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`option_commission_version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_commission_version` */

insert  into `option_commission_version`(`option_commission_version_id`,`option_commission_version_name`) values ('new','New Scheme'),('old','Old Scheme');

/*Table structure for table `option_construction` */

DROP TABLE IF EXISTS `option_construction`;

CREATE TABLE `option_construction` (
  `option_construction_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `option_construction_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_construction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `option_construction` */

insert  into `option_construction`(`option_construction_id`,`option_construction_name`) values (1,'In-House Contractor'),(2,'External Contractor');

/*Table structure for table `option_department` */

DROP TABLE IF EXISTS `option_department`;

CREATE TABLE `option_department` (
  `option_department_id` varchar(20) NOT NULL,
  `option_department_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_department` */

insert  into `option_department`(`option_department_id`,`option_department_name`) values ('billing','Billing'),('edp','EDP'),('engineering','Engineering'),('executive','Executive'),('finance','Finance'),('n/a','N/A');

/*Table structure for table `option_dp` */

DROP TABLE IF EXISTS `option_dp`;

CREATE TABLE `option_dp` (
  `option_dp_id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `option_dp_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_dp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `option_dp` */

insert  into `option_dp`(`option_dp_id`,`option_dp_name`) values (20,'20%'),(30,'30%'),(40,'40%');

/*Table structure for table `option_employment` */

DROP TABLE IF EXISTS `option_employment`;

CREATE TABLE `option_employment` (
  `option_employment_id` varchar(20) NOT NULL,
  `option_employment_name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`option_employment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_employment` */

insert  into `option_employment`(`option_employment_id`,`option_employment_name`) values ('employed','Employed'),('self_employed','Self-Employed'),('unemployed','Unemployed');

/*Table structure for table `option_entry_type` */

DROP TABLE IF EXISTS `option_entry_type`;

CREATE TABLE `option_entry_type` (
  `option_entry_type_id` varchar(25) NOT NULL,
  `option_entry_type_name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`option_entry_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_entry_type` */

insert  into `option_entry_type`(`option_entry_type_id`,`option_entry_type_name`) values ('consolidated','Consolidated'),('group','Group'),('single','Single');

/*Table structure for table `option_gender` */

DROP TABLE IF EXISTS `option_gender`;

CREATE TABLE `option_gender` (
  `option_gender_id` varchar(20) NOT NULL,
  `option_gender_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`option_gender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_gender` */

insert  into `option_gender`(`option_gender_id`,`option_gender_name`) values ('female','Female'),('male','Male');

/*Table structure for table `option_house_classification` */

DROP TABLE IF EXISTS `option_house_classification`;

CREATE TABLE `option_house_classification` (
  `option_house_classification_id` varchar(20) NOT NULL,
  `option_house_classification_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_house_classification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_house_classification` */

insert  into `option_house_classification`(`option_house_classification_id`,`option_house_classification_name`) values ('bungalow','Bungalow'),('two_storey','Two-Storey');

/*Table structure for table `option_income_type` */

DROP TABLE IF EXISTS `option_income_type`;

CREATE TABLE `option_income_type` (
  `option_income_type_id` varchar(100) NOT NULL,
  `option_income_type_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_income_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_income_type` */

insert  into `option_income_type`(`option_income_type_id`,`option_income_type_name`) values ('car','CAR'),('downpayment','Downpayment'),('other','Other'),('reservation','Reservation'),('sale_of_lot','Sale of Lot');

/*Table structure for table `option_invoice_status` */

DROP TABLE IF EXISTS `option_invoice_status`;

CREATE TABLE `option_invoice_status` (
  `option_invoice_status_id` varchar(20) NOT NULL,
  `option_invoice_status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_invoice_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_invoice_status` */

insert  into `option_invoice_status`(`option_invoice_status_id`,`option_invoice_status_name`) values ('notified','Notified'),('pending','Pending'),('settled','Setteled');

/*Table structure for table `option_payment_excess` */

DROP TABLE IF EXISTS `option_payment_excess`;

CREATE TABLE `option_payment_excess` (
  `option_payment_excess_id` varchar(20) NOT NULL,
  `option_payment_excess_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_payment_excess_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_payment_excess` */

insert  into `option_payment_excess`(`option_payment_excess_id`,`option_payment_excess_name`) values ('credit_to_principal','Credit To Principal'),('return_change','Return Change'),('scattered','Scattered');

/*Table structure for table `option_payment_method` */

DROP TABLE IF EXISTS `option_payment_method`;

CREATE TABLE `option_payment_method` (
  `option_payment_method_id` varchar(20) NOT NULL,
  `option_payment_method_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_payment_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_payment_method` */

insert  into `option_payment_method`(`option_payment_method_id`,`option_payment_method_name`) values ('bank_transfer','Bank Transfer'),('cash','Cash'),('check','Check');

/*Table structure for table `option_payment_receipt` */

DROP TABLE IF EXISTS `option_payment_receipt`;

CREATE TABLE `option_payment_receipt` (
  `option_payment_receipt_id` varchar(20) NOT NULL,
  `option_payment_receipt_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_payment_receipt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_payment_receipt` */

insert  into `option_payment_receipt`(`option_payment_receipt_id`,`option_payment_receipt_name`) values ('car','CAR'),('cr','CR'),('or','OR');

/*Table structure for table `option_payment_status` */

DROP TABLE IF EXISTS `option_payment_status`;

CREATE TABLE `option_payment_status` (
  `option_payment_status_id` varchar(20) NOT NULL,
  `option_payment_status_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_payment_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_payment_status` */

insert  into `option_payment_status`(`option_payment_status_id`,`option_payment_status_name`) values ('invalid','Invalid - Bounced'),('pending','Pending'),('valid','Valid - Cleared');

/*Table structure for table `option_project_status` */

DROP TABLE IF EXISTS `option_project_status`;

CREATE TABLE `option_project_status` (
  `option_project_status_id` varchar(20) NOT NULL,
  `option_project_status_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_project_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_project_status` */

insert  into `option_project_status`(`option_project_status_id`,`option_project_status_name`) values ('develop','Developed'),('pre_develop','Pre-Developed');

/*Table structure for table `option_scheme_finance_type` */

DROP TABLE IF EXISTS `option_scheme_finance_type`;

CREATE TABLE `option_scheme_finance_type` (
  `option_scheme_finance_type_id` varchar(15) NOT NULL,
  `option_scheme_finance_type_name` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`option_scheme_finance_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_scheme_finance_type` */

insert  into `option_scheme_finance_type`(`option_scheme_finance_type_id`,`option_scheme_finance_type_name`) values ('bank','Bank'),('in_house','In House');

/*Table structure for table `option_transaction_type` */

DROP TABLE IF EXISTS `option_transaction_type`;

CREATE TABLE `option_transaction_type` (
  `option_transaction_type_id` varchar(20) NOT NULL,
  `option_transaction_type_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_transaction_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_transaction_type` */

insert  into `option_transaction_type`(`option_transaction_type_id`,`option_transaction_type_name`) values ('lease_to_own','Lease-to-own'),('offset','Offsetting'),('regular','Regular'),('special_account','Special Account'),('thru_loan','Thru Loan');

/*Table structure for table `option_unit` */

DROP TABLE IF EXISTS `option_unit`;

CREATE TABLE `option_unit` (
  `option_unit_id` varchar(20) NOT NULL,
  `option_unit_name` varchar(50) DEFAULT NULL,
  `option_unit_type` tinyint(1) unsigned DEFAULT NULL,
  `option_unit_code` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`option_unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lot.option_unit: tells if a house is already built to this lot';

/*Data for the table `option_unit` */

insert  into `option_unit`(`option_unit_id`,`option_unit_name`,`option_unit_type`,`option_unit_code`) values ('lot_only','Lot Only',1,101),('package','Package',1,201);

/*Table structure for table `option_unit_account_type` */

DROP TABLE IF EXISTS `option_unit_account_type`;

CREATE TABLE `option_unit_account_type` (
  `option_unit_account_type_id` varchar(20) NOT NULL,
  `option_unit_account_type_order` tinyint(3) unsigned DEFAULT NULL,
  `option_unit_account_type_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`option_unit_account_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='client_account.option_unit_account_type : the type of unit bought under this accout. i.e fence, lot only, house only, package';

/*Data for the table `option_unit_account_type` */

insert  into `option_unit_account_type`(`option_unit_account_type_id`,`option_unit_account_type_order`,`option_unit_account_type_name`) values ('fence',5,'Fence'),('house_only',3,'House Only'),('lot_only',2,'Lot Only'),('package',1,'Package'),('refurbish',4,'Refurbish');

/*Table structure for table `option_unit_construction` */

DROP TABLE IF EXISTS `option_unit_construction`;

CREATE TABLE `option_unit_construction` (
  `option_unit_construction_id` varchar(20) NOT NULL,
  `option_unit_construction_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`option_unit_construction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_unit_construction` */

insert  into `option_unit_construction`(`option_unit_construction_id`,`option_unit_construction_name`) values ('fence','Fence Construction'),('house','House Construction'),('refurbish','Refurbish');

/*Table structure for table `option_unit_construction_status` */

DROP TABLE IF EXISTS `option_unit_construction_status`;

CREATE TABLE `option_unit_construction_status` (
  `option_unit_status_id` varchar(20) NOT NULL,
  `option_unit_status_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_unit_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_unit_construction_status` */

insert  into `option_unit_construction_status`(`option_unit_status_id`,`option_unit_status_name`) values ('for_approval','For Approval'),('for_costing','For Costing'),('ongoing','Ongoing Construction'),('ready','Ready For Occupancy');

/*Table structure for table `option_unit_contractor` */

DROP TABLE IF EXISTS `option_unit_contractor`;

CREATE TABLE `option_unit_contractor` (
  `option_unit_contractor_id` varchar(20) NOT NULL,
  `option_unit_contractor_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`option_unit_contractor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_unit_contractor` */

insert  into `option_unit_contractor`(`option_unit_contractor_id`,`option_unit_contractor_name`) values ('external','External Contractor'),('in_house','In-House Contractor');

/*Table structure for table `option_unit_status` */

DROP TABLE IF EXISTS `option_unit_status`;

CREATE TABLE `option_unit_status` (
  `option_unit_status_id` varchar(20) NOT NULL,
  `option_unit_status_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_unit_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_unit_status` */

insert  into `option_unit_status`(`option_unit_status_id`,`option_unit_status_name`) values ('for_approval','For Approval'),('for_costing','For Costing'),('ongoing','Ongoing Construction'),('ready','Ready For Occupancy');

/*Table structure for table `option_user_status` */

DROP TABLE IF EXISTS `option_user_status`;

CREATE TABLE `option_user_status` (
  `option_user_status_id` varchar(20) NOT NULL,
  `option_user_status_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_user_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_user_status` */

insert  into `option_user_status`(`option_user_status_id`,`option_user_status_name`) values ('disabled','Disabled'),('enabled','Active');

/*Table structure for table `project` */

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project` (
  `project_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_project_status_id` varchar(20) DEFAULT NULL,
  `project_code` varchar(50) DEFAULT NULL,
  `project_name` varchar(200) DEFAULT NULL,
  `project_acronym` varchar(100) DEFAULT NULL,
  `project_address` varchar(200) DEFAULT NULL,
  `project_province` varchar(100) DEFAULT NULL,
  `project_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `project` */

insert  into `project`(`project_id`,`option_project_status_id`,`project_code`,`project_name`,`project_acronym`,`project_address`,`project_province`,`project_timestamp`) values (1,NULL,'101','Grand Royale','GRY',NULL,NULL,1433958816),(3,NULL,'102','Dream Crest Homes','DCH',NULL,NULL,1435757801),(4,NULL,'103','Woodlands of Grand Royale','WGRY',NULL,NULL,1435757825),(5,NULL,'104','The Meadows','THM',NULL,NULL,1435757844),(6,NULL,'105','Casa Buena de Pulilan','CBP',NULL,NULL,1435757870),(7,NULL,'106','Royale Estate','ROE',NULL,NULL,1435757891),(8,NULL,'107','Casa Royale','CAR',NULL,NULL,1435757915),(9,NULL,'108','Grand Industrial Estate','GIE',NULL,NULL,1435757939);

/*Table structure for table `project_price` */

DROP TABLE IF EXISTS `project_price`;

CREATE TABLE `project_price` (
  `project_price_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `project_site_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `project_price_adjustment` tinyint(1) unsigned DEFAULT NULL COMMENT '1 - increment / 0 - decrease',
  `project_price_value` double(10,2) unsigned DEFAULT NULL,
  `project_price_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`project_price_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `project_price` */

/*Table structure for table `project_site` */

DROP TABLE IF EXISTS `project_site`;

CREATE TABLE `project_site` (
  `project_site_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `project_site_name` varchar(100) DEFAULT NULL,
  `project_site_code` mediumint(5) unsigned DEFAULT NULL,
  `project_site_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`project_site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `project_site` */

insert  into `project_site`(`project_site_id`,`project_id`,`project_site_name`,`project_site_code`,`project_site_timestamp`) values (1,1,'1',1,1433958879),(2,1,'2',2,1433958879),(4,6,'1',1,1435759327),(5,8,'1',1,1435759391),(6,3,'1',1,1435759425),(7,9,'1',1,1435759452),(8,7,'1',1,1435759481),(9,5,'1',1,1435759506),(10,4,'1',1,1435759527);

/*Table structure for table `project_site_block` */

DROP TABLE IF EXISTS `project_site_block`;

CREATE TABLE `project_site_block` (
  `project_site_block_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `project_site_id` bigint(20) unsigned DEFAULT NULL,
  `project_site_block_name` varchar(100) DEFAULT NULL,
  `project_site_block_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`project_site_block_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `project_site_block` */

insert  into `project_site_block`(`project_site_block_id`,`project_id`,`project_site_id`,`project_site_block_name`,`project_site_block_timestamp`) values (1,1,1,'1',1433958879),(2,6,4,'1',1435759327),(3,8,5,'1',1435759391),(4,3,6,'1',1435759425),(5,9,7,'1',1435759452),(6,7,8,'1',1435759481),(7,5,9,'1',1435759506),(8,4,10,'1',1435759527);

/*Table structure for table `rate` */

DROP TABLE IF EXISTS `rate`;

CREATE TABLE `rate` (
  `rate_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rate_dp_id` varchar(100) DEFAULT NULL,
  `rate_name` varchar(200) DEFAULT NULL,
  `rate_timestamp` bigint(15) unsigned DEFAULT NULL,
  `rate_deleted` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`rate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `rate` */

insert  into `rate`(`rate_id`,`rate_dp_id`,`rate_name`,`rate_timestamp`,`rate_deleted`) values (1,'30','2005 - Interest Rate',NULL,1),(2,'30','2006 - Interest Rate',NULL,1),(3,'20','2007 - Interest Rate',NULL,1),(4,'0','2009 - Interest Rate (Standard)',NULL,1),(5,'0','2009 - Interest Rate (Casa Royale)',NULL,1),(6,'30','2006 - Standard',NULL,1),(7,'0','2010 - Standard',NULL,1),(8,'30','2005 - Standard',NULL,0);

/*Table structure for table `rate_dp` */

DROP TABLE IF EXISTS `rate_dp`;

CREATE TABLE `rate_dp` (
  `rate_dp_id` varchar(100) NOT NULL,
  `rate_dp_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rate_dp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `rate_dp` */

insert  into `rate_dp`(`rate_dp_id`,`rate_dp_name`) values ('0','Multiple'),('20','20%'),('30','30%'),('40','40%');

/*Table structure for table `rate_interest` */

DROP TABLE IF EXISTS `rate_interest`;

CREATE TABLE `rate_interest` (
  `rate_interest_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rate_id` bigint(20) unsigned DEFAULT NULL,
  `rate_interest_min` mediumint(5) unsigned DEFAULT NULL,
  `rate_interest_max` mediumint(5) unsigned DEFAULT NULL,
  `option_dp_id` smallint(3) unsigned DEFAULT NULL,
  `rate_interest_value` double(8,2) unsigned DEFAULT NULL,
  `rate_interest_rebate` double(8,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`rate_interest_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `rate_interest` */

insert  into `rate_interest`(`rate_interest_id`,`rate_id`,`rate_interest_min`,`rate_interest_max`,`option_dp_id`,`rate_interest_value`,`rate_interest_rebate`) values (3,5,60,120,20,5.00,5.00),(7,6,60,120,30,22.00,2.75),(9,6,121,150,30,23.00,3.00),(10,7,12,60,20,15.00,2.25),(11,8,60,120,30,22.00,2.75),(12,8,121,170,30,23.00,3.00);

/*Table structure for table `remark` */

DROP TABLE IF EXISTS `remark`;

CREATE TABLE `remark` (
  `remark_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `remark_key` varchar(100) DEFAULT NULL,
  `remark_key_id` bigint(20) unsigned DEFAULT NULL,
  `remark_content` varchar(1000) DEFAULT NULL,
  `remark_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`remark_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Data for the table `remark` */

insert  into `remark`(`remark_id`,`user_id`,`remark_key`,`remark_key_id`,`remark_content`,`remark_timestamp`) values (1,7,'project',1,'Test',1433958816),(2,7,'project',1,'test',1433958824),(3,7,'lot',1,'test',1433958879),(4,7,'lot',2,'test',1433958879),(5,7,'lot',3,'test',1433958879),(6,7,'lot',4,'test',1433958879),(7,7,'lot',5,'test',1433958879),(8,7,'lot',1,'test',1433959011),(9,7,'client_account_agent',9,'comment',1433968483),(10,7,'account_payable_cheque',5,'test',1433975617),(11,7,'lot',5,'in 5 days',1433978897),(12,7,'client_account',18,'test',1433979301),(13,7,'account_payable',9,'test',1433979915),(14,7,'account_payable',9,'test',1433979987),(15,7,'account_payable',4,'go',1433981137),(16,7,'bank_transaction',94,'testerer  ere r',1433989953),(17,7,'account_payable',12,'wyhyy 50 ',1433990183),(18,7,'account_payable',12,'OK',1433990267),(19,7,'account_payable',12,'TEST',1433990394),(20,7,'account_payable',12,'FG S SDFS DFS 4345345',1433990533),(21,7,'account_payable_cheque',7,'DFGD FGDFG',1433990586),(22,7,'lot',4,'indefinite',1434140492),(23,7,'lot',0,'standard',1434140981),(24,7,'lot',4,'test',1434141058),(25,7,'client_account_agent',16,'trst',1434149855),(26,7,'client_account',16,'test1',1434149870),(27,7,'client_account',16,'test2',1434149972),(28,7,'agent',21,'test',1435214555),(29,7,'sales_agent',21,'test',1435214588),(30,7,'sales_agent',18,'2222',1435214597),(31,7,'sales_agent',26,'989898',1435214607),(32,7,'network',1,'test',1435215410),(33,7,'sales_network_division',1,'test',1435216966),(34,7,'lot',1,'test',1435313650),(35,7,'sales_director',16,'test',1435408975),(36,7,'sales_director',16,'test',1435409231),(37,7,'sales_agent',16,'asfasaf',1435409288),(38,7,'sales_agent',17,'tet',1435412223),(39,7,'sales_agent',17,'test',1435412271),(40,7,'lot',4,'test',1435414249),(41,7,'sales_agent',16,'tgsgdsg',1435414540),(42,7,'sales_agent',16,'hello',1435433430),(43,7,'account_payable',24,'hello',1435670944),(44,7,'lot',3,'hold remark',1435746467);

/*Table structure for table `report` */

DROP TABLE IF EXISTS `report`;

CREATE TABLE `report` (
  `report_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `report_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `report` */

insert  into `report`(`report_id`,`report_name`) values (1,'Ageing Accounts'),(2,'Ageing by Division'),(3,'Agent Prod. Report'),(4,'Backout Accounts'),(5,'BIPR'),(6,'FPD Accounts'),(7,'Inv. Of Rec.'),(8,'Network Prod');

/*Table structure for table `request_approval_level` */

DROP TABLE IF EXISTS `request_approval_level`;

CREATE TABLE `request_approval_level` (
  `request_approval_level_id` varchar(25) DEFAULT NULL,
  `request_approval_level_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `request_approval_level` */

insert  into `request_approval_level`(`request_approval_level_id`,`request_approval_level_name`) values ('dept_head','Department Head'),('exec_approve','Executive Approval'),('journal_entry','Journal Entry'),('cheque_prep','Cheque Preparation'),('exec_sign','Executive Signature'),('cheque_release','Cheque Release'),('reconciliation','Reconciliation'),('liquidate','Liquidate'),('completed','Completed'),('dept_sec','Department Secretary');

/*Table structure for table `request_approval_status` */

DROP TABLE IF EXISTS `request_approval_status`;

CREATE TABLE `request_approval_status` (
  `request_approval_status_id` varchar(25) DEFAULT NULL,
  `request_approval_status_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `request_approval_status` */

insert  into `request_approval_status`(`request_approval_status_id`,`request_approval_status_name`) values ('declined','Declined'),('approved','Approved'),('released','Released'),('hold','Hold'),('recommended','Recommended'),('ready','Ready'),('revoked','Revoked'),('signed','Signed'),('processing','Processing'),('reimbursement','Reimbursement'),('pending','Pending');

/*Table structure for table `request_type` */

DROP TABLE IF EXISTS `request_type`;

CREATE TABLE `request_type` (
  `request_type_id` varchar(10) DEFAULT NULL,
  `request_type_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `request_type` */

insert  into `request_type`(`request_type_id`,`request_type_name`) values ('rfp','RFP'),('tba','TBA'),('lqd','Lqd'),('ofv','OFV'),('tax','Tax'),('jv','JV');

/*Table structure for table `sales_agent` */

DROP TABLE IF EXISTS `sales_agent`;

CREATE TABLE `sales_agent` (
  `sales_agent_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sales_agent_first_name` varchar(50) DEFAULT NULL,
  `sales_agent_last_name` varchar(50) DEFAULT NULL,
  `sales_agent_middle_initial` varchar(15) DEFAULT NULL,
  `sales_agent_nick_name` varchar(50) DEFAULT NULL,
  `sales_agent_sequence` int(10) unsigned DEFAULT NULL,
  `sales_agent_monthly_quota` double(15,2) unsigned DEFAULT NULL,
  `sales_agent_sequence_status` tinyint(1) unsigned DEFAULT '0',
  `sales_agent_sequence_timestamp` bigint(15) unsigned DEFAULT NULL,
  `sales_agent_timestamp` bigint(15) unsigned DEFAULT NULL,
  `sales_agent_code` varchar(20) DEFAULT NULL,
  `sales_network_division_id` int(10) unsigned DEFAULT '0',
  `sales_agent_birthdate` bigint(15) unsigned DEFAULT NULL,
  `sales_agent_birthplace` varchar(30) DEFAULT NULL,
  `option_gender_id` varchar(10) DEFAULT NULL,
  `option_civil_status_id` varchar(25) DEFAULT NULL,
  `sales_agent_address` varchar(150) DEFAULT NULL,
  `sales_agent_contact_number` varchar(25) DEFAULT NULL,
  `sales_agent_email` varchar(50) DEFAULT NULL,
  `sales_agent_sss` varchar(30) DEFAULT NULL,
  `sales_agent_tin` varchar(30) DEFAULT NULL,
  `option_agent_status_id` varchar(10) DEFAULT NULL,
  `sales_agent_recruited_by` varchar(100) DEFAULT NULL,
  `sales_agent_hire_date` bigint(15) unsigned DEFAULT NULL,
  `sales_agent_position_old_id` varchar(20) DEFAULT NULL,
  `sales_agent_position_id` varchar(20) DEFAULT NULL,
  `lot_id` bigint(20) unsigned DEFAULT '0',
  `is_deleted` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`sales_agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `sales_agent` */

insert  into `sales_agent`(`sales_agent_id`,`sales_agent_first_name`,`sales_agent_last_name`,`sales_agent_middle_initial`,`sales_agent_nick_name`,`sales_agent_sequence`,`sales_agent_monthly_quota`,`sales_agent_sequence_status`,`sales_agent_sequence_timestamp`,`sales_agent_timestamp`,`sales_agent_code`,`sales_network_division_id`,`sales_agent_birthdate`,`sales_agent_birthplace`,`option_gender_id`,`option_civil_status_id`,`sales_agent_address`,`sales_agent_contact_number`,`sales_agent_email`,`sales_agent_sss`,`sales_agent_tin`,`option_agent_status_id`,`sales_agent_recruited_by`,`sales_agent_hire_date`,`sales_agent_position_old_id`,`sales_agent_position_id`,`lot_id`,`is_deleted`) values (16,'Arvin','Alejandro','C.','Arvin',NULL,292390.60,0,NULL,1432612622,'AG1234',0,884707200,'Metro Manila','male','single','L5 Blk 6 Metro Manila','09064823662','arvin@gmail.com','12341-5676','111-4586-1122','active','Ryan Fajardo',1433088000,'','sales_director',0,0),(17,'Roberto','Cruz','A.','Robert',NULL,118500.00,0,NULL,1432612709,'AG1234',6,1427990400,'Mandaluyong City','male','single','Block 8 Phase 5-C Pasig City','09064823662','robert@gmail.com','12341-5676','125-353-6765','active','Ryan Fajardo',1433088000,'sales_manager','sales_manager',0,0),(18,'Richard','Maquez','A.','Ry',NULL,28000.00,0,NULL,1432612758,'AG1234',0,1431273600,'Mandaluyong City','male','married','L5 Blk 6 Metro Manila','09064823662','ryan@yahoo.com','12341-5676','111-4586-1122','active','Ryan Fajardo',1434988800,'','property_consultant',0,0),(19,'Patrick','Raymundo','D.','Rick',NULL,68890.60,0,NULL,1432612883,'AG1234',0,145125000,'Quezon City','male','separated','Lot 4A Unit 6C Quezon City','023447247','pat@yahoo.com','2551-21451-12415','222-2515-1245','active','Martin Feliciano',1431964800,'','property_consultant',0,0),(20,'Gilbert','Garcia','A.','Bert',NULL,90500.00,0,NULL,1432616037,'AG1234',8,1430582400,'Manila','male','married','Unit 5-D Townhomes Manila','09064823662','bert@hotmail.com','1215-12511','123-1516-16712','active','Jun Mendoza',1430582400,'sales_manager','property_consultant',0,0),(21,'Martin','Padilla','F.','Tin',NULL,6000000.00,0,NULL,1432616156,'AG1234',0,379526400,'San Juan','male','separated','89 St. San Juan','0905102561','tin@yahoo.com','1568-3566','125-353-6765','active','Jun Mendoza',1339430400,'avp','sales_director',0,0),(22,'Gregory','Reyes','X.','Ory',NULL,68890.60,0,NULL,1432616361,'AG1234',8,1426003200,'Quezon City','male','single','Lot 22A Unit 6C Quezon City','023447247','ory@gmail.com','1568-3566','125-353-6765','active','Jun Mendoza',1433347200,'sales_manager','sales_manager',0,0),(23,'Christopher','Meneses','A.','Chris',NULL,NULL,0,NULL,1432616361,'AG1234',NULL,1431014400,'San Juan','male','single','Lot 22A Unit 6C Quezon City','023447247','ory@gmail.com','1568-3566','123-1516-16712','active','Jun Mendoza',1431446400,NULL,'vp_sales',0,0),(24,'Francisco','Loyola','W','France',NULL,105000.00,0,NULL,1435210456,'AG1234',6,892742400,'Pasig City','male','married','Lot 4 Blk 4 Malinao Pasig City','64224653663','france@gmail.com','222-4412-51515','112-2425-2415-2516','active','Ryan Fajardo',1433088000,'avp','sales_manager',0,0),(25,'Ronnie','Gomez','W.','Ricky',NULL,25000.00,0,NULL,1435212828,'AG1234',13,1433088000,'Pasig City','female','single','Lot 4 Blk 4 Malinao Pasig City','64224653663','ron@yahoo','222-4412-51515','112-2425-2415-2516','active','Ryan Fajardo',1434902400,'sales_manager','property_consultant',0,0),(26,'Jeffrey','Reyes','S.','jeff',NULL,80000.00,0,NULL,1435213071,'AG1234',1,1226332800,'Marikina City','male','married','89 St. Marcos Hi-way Marikina CIty','094242772','jeff@gmail','22-16-167-17-7-1','124-1516-16-161-61','active','Martin Cruz',1434988800,'marketing_associate','property_consultant',0,0),(27,'Michael','Cristobal','M.','Mike',NULL,6000000.00,0,NULL,1435764347,'AG1234',0,1435766400,'Marikina City','male','single','89 St. Marcos Hi-way Marikina CIty','64224653663','mike@yahoo.com','222-4412-51515','112-2425-2415-2516','active','Ryan Fajardo',1433692800,'','sales_manager',0,0),(28,'Gretchen','Manalo','M.','gret',NULL,6000000.00,0,NULL,1435764409,'AG1234',0,1435766400,'Pasig City','female','married','Lot 4 Blk 4 Malinao Pasig City','64224653663','gret@gmail.com','22-16-167-17-7-1','112-2425-2415-2516','active','Ryan Fajardo',0,'','property_consultant',0,0);

/*Table structure for table `sales_agent_agent` */

DROP TABLE IF EXISTS `sales_agent_agent`;

CREATE TABLE `sales_agent_agent` (
  `sales_agent_agent_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sales_agent_id` bigint(20) unsigned DEFAULT NULL,
  `sales_agent_head_id` bigint(20) unsigned DEFAULT NULL,
  `is_deleted` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`sales_agent_agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `sales_agent_agent` */

insert  into `sales_agent_agent`(`sales_agent_agent_id`,`sales_agent_id`,`sales_agent_head_id`,`is_deleted`) values (1,18,17,0),(2,17,16,1),(3,17,21,1),(4,19,22,0),(5,20,17,0),(6,22,16,0),(7,24,21,1),(8,25,24,1),(9,26,24,1),(10,17,21,1),(11,24,16,1),(12,24,16,0),(13,25,24,0),(14,26,24,0),(15,17,21,1),(16,17,21,1),(17,17,16,0),(18,27,21,0),(19,28,27,0);

/*Table structure for table `sales_agent_lot` */

DROP TABLE IF EXISTS `sales_agent_lot`;

CREATE TABLE `sales_agent_lot` (
  `sales_agent_lot_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `sales_commission_scheme_id` varchar(20) DEFAULT NULL,
  `lot_id` bigint(20) unsigned DEFAULT NULL,
  `is_sold` tinyint(1) unsigned DEFAULT '0',
  `hold_standard` tinyint(1) unsigned DEFAULT NULL,
  `hold_status` varchar(20) DEFAULT 'active',
  `sales_agent_lot_timestamp` bigint(15) unsigned DEFAULT NULL,
  `sales_agent_lot_timestamp_end` bigint(15) unsigned DEFAULT NULL,
  `old_sales_agent_id_avp` bigint(20) unsigned DEFAULT NULL,
  `old_sales_agent_id_sm` bigint(20) unsigned DEFAULT NULL,
  `old_sales_agent_id_ma` bigint(20) unsigned DEFAULT NULL,
  `old_sales_agent_id_broker` bigint(20) unsigned DEFAULT NULL,
  `sales_agent_id_vp` bigint(20) unsigned DEFAULT NULL,
  `sales_agent_id_sd` bigint(20) unsigned DEFAULT NULL,
  `sales_agent_id_sm` bigint(20) unsigned DEFAULT NULL,
  `sales_agent_id_pc` bigint(20) unsigned DEFAULT NULL,
  `sales_agent_id_broker` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`sales_agent_lot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `sales_agent_lot` */

insert  into `sales_agent_lot`(`sales_agent_lot_id`,`sales_commission_scheme_id`,`lot_id`,`is_sold`,`hold_standard`,`hold_status`,`sales_agent_lot_timestamp`,`sales_agent_lot_timestamp_end`,`old_sales_agent_id_avp`,`old_sales_agent_id_sm`,`old_sales_agent_id_ma`,`old_sales_agent_id_broker`,`sales_agent_id_vp`,`sales_agent_id_sd`,`sales_agent_id_sm`,`sales_agent_id_pc`,`sales_agent_id_broker`) values (1,'6',1,1,0,'active',1435744839,1435745259,NULL,NULL,NULL,NULL,23,16,22,19,NULL),(2,'4',2,1,0,'active',1435745974,1435746201,0,0,26,NULL,NULL,NULL,NULL,NULL,NULL),(3,'2',3,1,0,'active',1435746467,1435746672,24,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'6',16,1,0,'active',1435759801,1435760076,NULL,NULL,NULL,NULL,23,17,17,18,NULL),(5,'6',15,1,0,'active',1435761175,1435761352,NULL,NULL,NULL,NULL,23,16,24,25,NULL),(6,'6',13,0,0,'active',1435773295,NULL,NULL,NULL,NULL,NULL,23,21,27,28,NULL),(7,'3',14,0,0,'active',1435775177,NULL,21,NULL,26,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `sales_agent_position` */

DROP TABLE IF EXISTS `sales_agent_position`;

CREATE TABLE `sales_agent_position` (
  `sales_agent_position_id` varchar(25) DEFAULT NULL,
  `sales_agent_position_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sales_agent_position` */

insert  into `sales_agent_position`(`sales_agent_position_id`,`sales_agent_position_name`) values ('property_consultant','Property Consultant'),('sales_manager','Sales Manager'),('sales_director','Sales Director'),('broker','Broker'),('vp_sales','VP Sales');

/*Table structure for table `sales_agent_position_old` */

DROP TABLE IF EXISTS `sales_agent_position_old`;

CREATE TABLE `sales_agent_position_old` (
  `sales_agent_position_old_id` varchar(20) NOT NULL,
  `sales_agent_position_old_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sales_agent_position_old_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sales_agent_position_old` */

insert  into `sales_agent_position_old`(`sales_agent_position_old_id`,`sales_agent_position_old_name`) values ('avp','AVP'),('broker','Broker'),('marketing_associate','Marketing Associate'),('sales_manager','Sales Manager');

/*Table structure for table `sales_commission_account` */

DROP TABLE IF EXISTS `sales_commission_account`;

CREATE TABLE `sales_commission_account` (
  `sales_commission_account_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_account_id` bigint(20) unsigned DEFAULT NULL,
  `sales_commission_scheme_id` varchar(20) DEFAULT NULL,
  `sales_commission_account_amount_total` double(15,2) unsigned DEFAULT NULL,
  `sales_commission_account_timestamp` bigint(15) unsigned DEFAULT NULL,
  `old_sales_agent_id_avp` bigint(20) unsigned DEFAULT NULL,
  `old_sales_agent_id_sm` bigint(20) unsigned DEFAULT NULL,
  `old_sales_agent_id_ma` bigint(20) unsigned DEFAULT NULL,
  `old_sales_agent_id_broker` bigint(20) unsigned DEFAULT NULL,
  `sales_agent_id_vp` bigint(20) unsigned DEFAULT NULL,
  `sales_agent_id_sd` bigint(20) unsigned DEFAULT NULL,
  `sales_agent_id_sm` bigint(20) unsigned DEFAULT NULL,
  `sales_agent_id_pc` bigint(20) unsigned DEFAULT NULL,
  `sales_agent_id_broker` bigint(20) unsigned DEFAULT NULL,
  `old_sales_commission_account_amount_avp` double(15,2) unsigned DEFAULT NULL,
  `old_sales_commission_account_amount_sm` double(15,2) unsigned DEFAULT NULL,
  `old_sales_commission_account_amount_ma` double(15,2) unsigned DEFAULT NULL,
  `old_sales_commission_account_amount_broker` double(15,2) unsigned DEFAULT NULL,
  `sales_commission_account_amount_vp` double(15,2) unsigned DEFAULT NULL,
  `sales_commission_account_amount_sd` double(15,2) unsigned DEFAULT NULL,
  `sales_commission_account_amount_sm` double(15,2) unsigned DEFAULT NULL,
  `sales_commission_account_amount_pc` double(15,2) unsigned DEFAULT NULL,
  `sales_commission_account_amount_broker` double(15,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`sales_commission_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `sales_commission_account` */

insert  into `sales_commission_account`(`sales_commission_account_id`,`client_account_id`,`sales_commission_scheme_id`,`sales_commission_account_amount_total`,`sales_commission_account_timestamp`,`old_sales_agent_id_avp`,`old_sales_agent_id_sm`,`old_sales_agent_id_ma`,`old_sales_agent_id_broker`,`sales_agent_id_vp`,`sales_agent_id_sd`,`sales_agent_id_sm`,`sales_agent_id_pc`,`sales_agent_id_broker`,`old_sales_commission_account_amount_avp`,`old_sales_commission_account_amount_sm`,`old_sales_commission_account_amount_ma`,`old_sales_commission_account_amount_broker`,`sales_commission_account_amount_vp`,`sales_commission_account_amount_sd`,`sales_commission_account_amount_sm`,`sales_commission_account_amount_pc`,`sales_commission_account_amount_broker`) values (1,19,'6',126168.00,1435745259,NULL,NULL,NULL,NULL,23,16,22,19,NULL,NULL,NULL,NULL,NULL,5257.00,21028.00,36799.00,63084.00,NULL),(2,20,'4',127200.00,1435746201,21,17,26,NULL,NULL,NULL,NULL,NULL,NULL,21200.00,42400.00,63600.00,NULL,NULL,NULL,NULL,NULL,NULL),(3,21,'2',35688.00,1435746672,24,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5948.00,29740.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,22,'6',36768.00,1435760076,NULL,NULL,NULL,NULL,23,0,17,18,NULL,NULL,NULL,NULL,NULL,1532.00,6128.00,10724.00,18384.00,NULL),(5,23,'6',33600.00,1435761352,NULL,NULL,NULL,NULL,23,16,24,25,NULL,NULL,NULL,NULL,NULL,1400.00,5600.00,9800.00,16800.00,NULL);

/*Table structure for table `sales_commission_scheme` */

DROP TABLE IF EXISTS `sales_commission_scheme`;

CREATE TABLE `sales_commission_scheme` (
  `sales_commission_scheme_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `sales_commission_scheme_key` varchar(20) DEFAULT NULL,
  `option_commission_version_id` varchar(20) DEFAULT NULL,
  `old_sales_commission_scheme_value_avp` double(5,2) unsigned DEFAULT NULL,
  `old_sales_commission_scheme_value_sm` double(5,2) unsigned DEFAULT NULL,
  `old_sales_commission_scheme_value_ma` double(5,2) unsigned DEFAULT NULL,
  `old_sales_commission_scheme_value_broker` double(5,2) unsigned DEFAULT NULL,
  `sales_commission_scheme_value_vp` double(5,2) unsigned DEFAULT NULL,
  `sales_commission_scheme_value_sd` double(5,2) unsigned DEFAULT NULL,
  `sales_commission_scheme_value_sm` double(5,2) unsigned DEFAULT NULL,
  `sales_commission_scheme_value_pc` double(5,2) unsigned DEFAULT NULL,
  `sales_commission_scheme_value_broker` double(5,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`sales_commission_scheme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `sales_commission_scheme` */

insert  into `sales_commission_scheme`(`sales_commission_scheme_id`,`sales_commission_scheme_key`,`option_commission_version_id`,`old_sales_commission_scheme_value_avp`,`old_sales_commission_scheme_value_sm`,`old_sales_commission_scheme_value_ma`,`old_sales_commission_scheme_value_broker`,`sales_commission_scheme_value_vp`,`sales_commission_scheme_value_sd`,`sales_commission_scheme_value_sm`,`sales_commission_scheme_value_pc`,`sales_commission_scheme_value_broker`) values (1,'AVP only','old',6.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'AVP & Sales Manager','old',1.00,5.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'AVP & Marketing Asso','old',3.00,NULL,3.00,NULL,NULL,NULL,NULL,NULL,NULL),(4,'Marketing Associate','old',1.00,2.00,3.00,NULL,NULL,NULL,NULL,NULL,NULL),(5,'Broker Sale(old)','old',NULL,NULL,NULL,7.00,NULL,NULL,NULL,NULL,NULL),(6,'Property Consultant','new',NULL,NULL,NULL,NULL,0.25,1.00,1.75,3.00,NULL),(7,'Broker Sale','new',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,7.00);

/*Table structure for table `sales_commission_scheme_trigger` */

DROP TABLE IF EXISTS `sales_commission_scheme_trigger`;

CREATE TABLE `sales_commission_scheme_trigger` (
  `sales_commission_scheme_trigger_id` bigint(9) unsigned NOT NULL AUTO_INCREMENT,
  `option_commission_version_id` varchar(10) DEFAULT NULL,
  `finance_type` varchar(10) DEFAULT NULL,
  `sales_commission_scheme_trigger_value` double(5,2) unsigned DEFAULT NULL,
  `sales_commission_scheme_trigger_release` double(5,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`sales_commission_scheme_trigger_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `sales_commission_scheme_trigger` */

insert  into `sales_commission_scheme_trigger`(`sales_commission_scheme_trigger_id`,`option_commission_version_id`,`finance_type`,`sales_commission_scheme_trigger_value`,`sales_commission_scheme_trigger_release`) values (1,'new','in_house',10.00,10.00),(2,'new','in_house',20.00,10.00),(3,'new','in_house',70.00,50.00),(4,'new','in_house',100.00,30.00),(6,'new','bank',100.00,80.00),(7,'old','in_house',10.00,10.00),(8,'old','in_house',20.00,10.00),(9,'old','in_house',30.00,10.00),(10,'old','in_house',40.00,10.00),(11,'old','in_house',50.00,10.00),(12,'old','in_house',60.00,10.00),(13,'old','in_house',70.00,10.00),(14,'old','in_house',80.00,10.00),(15,'old','in_house',90.00,10.00),(16,'old','in_house',100.00,10.00);

/*Table structure for table `sales_director` */

DROP TABLE IF EXISTS `sales_director`;

CREATE TABLE `sales_director` (
  `sales_director_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `sales_director_first_name` varchar(100) DEFAULT NULL,
  `sales_director_last_name` varchar(100) DEFAULT NULL,
  `sales_director_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`sales_director_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `sales_director` */

insert  into `sales_director`(`sales_director_id`,`sales_director_first_name`,`sales_director_last_name`,`sales_director_timestamp`) values (1,'Coco ','Martin',NULL),(2,'Daniel ','Padilla',NULL),(3,'Ed','Sheeran',1426487908),(4,'Bruce','Bowen',NULL),(5,'Martin','Agustin',NULL),(6,'Rick','Bunga',NULL),(7,'Jun','Arestorenas',NULL);

/*Table structure for table `sales_manager` */

DROP TABLE IF EXISTS `sales_manager`;

CREATE TABLE `sales_manager` (
  `sales_manager_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `sales_manager_first_name` varchar(100) DEFAULT NULL,
  `sales_manager_last_name` varchar(100) DEFAULT NULL,
  `sales_director_id` tinyint(3) unsigned DEFAULT NULL,
  `sales_manager_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`sales_manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `sales_manager` */

insert  into `sales_manager`(`sales_manager_id`,`sales_manager_first_name`,`sales_manager_last_name`,`sales_director_id`,`sales_manager_timestamp`) values (1,'Piolo ','Pascual',1,NULL),(2,'John Lloyd ','Cruz',2,NULL),(3,'Brandon','Boyd',1,1426487892),(4,'John','Legend',1,NULL),(5,'Taylor ','Swift',1,NULL),(6,'Johny','Debt',2,NULL),(7,'Randy','Orton',3,NULL),(8,'Jason','Jose',4,NULL),(9,'Brian','Cayabyab',5,NULL),(10,'Tirso','Cruz',5,NULL),(11,'Richard','Ward',4,NULL),(12,'Kobe','Bryant',7,NULL),(13,'Leborn','James',6,NULL),(14,'Dirk','Nowitzki',5,NULL),(15,'Maria','Clara',4,NULL),(16,'Juan','Dela Cruz',7,NULL),(17,'Josefa','Tuazon',6,NULL),(18,'Michael','Fajatin',5,NULL),(19,'Eddie','Bautista',6,NULL),(20,'Richard','Garcia',7,NULL);

/*Table structure for table `sales_network` */

DROP TABLE IF EXISTS `sales_network`;

CREATE TABLE `sales_network` (
  `sales_network_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sales_network_name` varchar(200) DEFAULT NULL,
  `sales_agent_id` bigint(20) unsigned DEFAULT NULL,
  `sales_network_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`sales_network_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `sales_network` */

insert  into `sales_network`(`sales_network_id`,`sales_network_name`,`sales_agent_id`,`sales_network_timestamp`) values (1,'Special Account',21,NULL),(2,'Achievers',24,NULL),(3,'Net25',NULL,1435215870);

/*Table structure for table `sales_network_division` */

DROP TABLE IF EXISTS `sales_network_division`;

CREATE TABLE `sales_network_division` (
  `sales_network_division_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sales_network_id` bigint(20) unsigned DEFAULT NULL,
  `sales_network_division_name` varchar(200) DEFAULT NULL,
  `sales_agent_id` bigint(20) unsigned DEFAULT NULL,
  `sales_network_division_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`sales_network_division_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `sales_network_division` */

insert  into `sales_network_division`(`sales_network_division_id`,`sales_network_id`,`sales_network_division_name`,`sales_agent_id`,`sales_network_division_timestamp`) values (1,1,'Acts',17,NULL),(2,1,'Amazing',NULL,NULL),(3,1,'EDP',NULL,NULL),(4,1,'Engineering',NULL,NULL),(5,1,'Finance',NULL,NULL),(6,2,'Executive',NULL,NULL),(7,1,'Billing',NULL,NULL),(8,2,'Sample DIvision',22,1432257608),(9,2,'Test Division',NULL,1433974225),(10,1,'Test Division 2',NULL,1434138706),(11,2,'Test Division 3',NULL,1434138714),(12,1,'Sample DIvision 2',NULL,1434138723),(13,3,'Divx22',NULL,1435236083);

/*Table structure for table `sysglobal` */

DROP TABLE IF EXISTS `sysglobal`;

CREATE TABLE `sysglobal` (
  `sysglobal_id` varchar(20) NOT NULL,
  `surcharge_rate` double(10,2) unsigned DEFAULT NULL,
  `earnest_duration` int(10) unsigned DEFAULT NULL,
  `vat_rate` double(5,2) unsigned DEFAULT NULL,
  PRIMARY KEY (`sysglobal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sysglobal` */

insert  into `sysglobal`(`sysglobal_id`,`surcharge_rate`,`earnest_duration`,`vat_rate`) values ('global',50.00,11,12.00);

/*Table structure for table `tax_request` */

DROP TABLE IF EXISTS `tax_request`;

CREATE TABLE `tax_request` (
  `tax_request_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `account_payable_id` bigint(15) unsigned DEFAULT NULL,
  `account_payable_item_detail_id` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`tax_request_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

/*Data for the table `tax_request` */

insert  into `tax_request`(`tax_request_id`,`account_payable_id`,`account_payable_item_detail_id`) values (1,37,1),(2,37,2),(3,37,3),(4,37,4),(5,37,5),(6,37,6),(7,37,7),(8,37,8),(9,37,9),(10,37,10),(11,37,11),(12,37,12),(13,37,13),(14,37,14),(15,37,15),(16,37,16),(17,37,17),(18,37,18),(19,37,19),(20,37,20),(21,37,21),(22,37,22),(23,37,23),(24,37,24),(25,37,25),(26,37,26),(27,37,27),(28,37,28),(29,37,29),(30,37,30),(31,37,31),(32,37,32),(33,37,33),(34,37,34),(35,37,35),(36,37,36),(37,37,37),(38,37,38),(39,37,39),(40,37,40),(41,37,41),(42,37,42),(43,38,43),(44,38,44),(45,6,1),(46,6,2),(47,6,3),(48,6,4),(49,6,5),(50,6,6),(51,6,7),(52,6,8),(53,6,9),(54,6,10),(55,6,11),(56,6,12),(57,6,13);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_user_status_id` varchar(20) DEFAULT NULL,
  `option_department_id` varchar(20) DEFAULT NULL,
  `user_number` varchar(100) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_surname` varchar(50) DEFAULT NULL,
  `user_email` varchar(50) DEFAULT NULL,
  `user_contact` varchar(100) DEFAULT NULL,
  `user_address` varchar(500) DEFAULT NULL,
  `user_username` varchar(100) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_timestamp` bigint(15) unsigned DEFAULT NULL,
  `user_deleted` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`user_id`,`option_user_status_id`,`option_department_id`,`user_number`,`user_name`,`user_surname`,`user_email`,`user_contact`,`user_address`,`user_username`,`user_password`,`user_timestamp`,`user_deleted`) values (7,'enabled','executive','0152123','Annielle','Madrid','Bulacan','12345','abcd efg','annielle','pass1',1403927441,0),(12,'enabled','edp','11111','Mizel','Delos Santos','mizel@alsc.com.ph','12456','pasig','mickey','pass2',1427489510,0),(13,'enabled','edp','121212','Arvin','Alejandro','arvin@gmail.com','123456','Pasig','arvin','pass',1427489510,0),(14,'enabled','edp','141414','Arnie','Alejandro','arnie@yahoo.com','151515','Pasig','arnie','pass',1427489510,0),(15,'enabled','executive','1616161','Richard','Mercado','ricky@gmail.com','121414','Manila','ricky','pass',1427489510,0);

/*Table structure for table `user_module` */

DROP TABLE IF EXISTS `user_module`;

CREATE TABLE `user_module` (
  `user_module_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `module_id` mediumint(5) unsigned DEFAULT NULL,
  `user_module_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

/*Data for the table `user_module` */

insert  into `user_module`(`user_module_id`,`user_id`,`module_id`,`user_module_timestamp`) values (24,3,2,1403918058),(27,3,5,1403918060),(46,4,1,1403938224),(47,4,2,1403957109),(48,7,1,1403958730),(49,7,2,1403958731),(57,8,1,1403960366),(58,8,2,1403961135),(60,0,0,1405815658),(62,3,4,1409171882),(63,7,3,1409734673),(64,7,4,1409734673),(65,7,5,1409734674),(66,7,6,1409734675),(68,3,6,1412641334),(69,4,3,1413250880),(70,4,4,1413250881),(71,4,5,1413250883),(72,3,1,1413348052),(79,7,7,1424853783),(80,7,8,1424853784),(81,7,9,1424853784),(82,7,10,1424853785),(83,7,11,1425200495),(84,7,12,1425200495),(85,7,13,1425200495),(86,7,14,1425200496),(87,7,15,1425200496),(88,12,7,1427492801),(89,12,8,1427492801),(91,12,10,1427492802),(92,12,11,1427492802);

/*Table structure for table `user_report` */

DROP TABLE IF EXISTS `user_report`;

CREATE TABLE `user_report` (
  `user_report_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `report_id` mediumint(5) unsigned DEFAULT NULL,
  `user_report_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/*Data for the table `user_report` */

insert  into `user_report`(`user_report_id`,`user_id`,`report_id`,`user_report_timestamp`) values (10,7,8,1403929912),(17,4,1,1403936448),(18,4,2,1403936449),(19,4,3,1403936449),(20,4,4,1403936449),(24,7,3,1403958774),(25,7,4,1403958774),(26,7,6,1403958775),(27,7,7,1403958775),(29,8,2,1403960481),(30,8,1,1403960566),(31,8,3,1403960566),(32,8,4,1403960567),(33,8,5,1403960567),(37,3,4,1412641343),(38,3,5,1412641345),(39,3,6,1412641346),(40,3,7,1412641348),(41,12,1,1427492805),(42,12,2,1427492805),(43,12,3,1427492807),(44,12,4,1427492807),(45,7,1,1427492850),(46,7,2,1427492850);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;