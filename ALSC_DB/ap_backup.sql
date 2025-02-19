

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `account_letter` */

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
  PRIMARY KEY (`account_payable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable` */

insert  into `account_payable`(`account_payable_id`,`request_type_id`,`account_payable_timestamp`,`request_recommended_by`,`request_requestor`,`request_tin`,`option_department_id`,`request_amount`,`request_purpose`,`request_payable_to`,`request_address`,`request_accounted_to`,`option_payment_method_id`,`request_approved_amount`,`request_details`,`request_approval_level_id`,`request_approval_status_id`,`request_approved_by`,`request_approved_date`,`request_date_needed`,`request_release_date`,`is_reimbursement`,`reimbursement_amount`) values (1,'rfp',1430921856,'Annielle Madrid','Arvin Alejandro','2515-2345-234','billing',15987.98,'Basketball Court','Ace Hardware','Bulacan','Arvin Alejandro','check',15987.98,NULL,'completed','approved','Annielle Madrid',1430922640,1430928000,1430922895,0,NULL),(2,'rfp',1430921936,'Annielle Madrid','Ryan Perez','545-241-1515','edp',16000.87,'Repair','747 Hardware','Pasig City','Ryan Perez','check',16000.87,NULL,'journal_entry','approved','Annielle Madrid',1430976163,1432656000,NULL,0,NULL),(3,'rfp',1430922010,'Annielle Madrid','Manny Geronimo','545-241-1515','engineering',18365.25,'Grocery','Hypermart','Mandaluyong City','John Lloyd','check',18365.25,NULL,'cheque_prep','approved','Annielle Madrid',1430976232,1431878400,NULL,0,NULL),(4,'rfp',1430922088,'Annielle Madrid','Teresa Dela Pena','545-241-1515','executive',254685.23,'Shopping','SM','Marikina City','Adam Garcia','check',254685.23,NULL,'journal_entry','approved','Annielle Madrid',1430976208,1432742400,NULL,0,NULL),(5,'rfp',1430922154,'Annielle Madrid','June Jose','2515-2345-234','finance',456986.00,'Repair','Nancy Recto','Manila City','Robert Mercado','check',NULL,NULL,'exec_approve','approved',NULL,NULL,1432569600,NULL,0,NULL),(6,'rfp',1430922256,'Annielle Madrid','Jeffrey Padilla','545-241-1515','executive',15987.98,'Clubhouse','Coco Martin','Mandaluyong City','Brian Kobe','check',NULL,NULL,'exec_approve','approved',NULL,NULL,1432742400,NULL,0,NULL),(7,'rfp',1430922324,'Annielle Madrid','Christian Manaloto','2515-2345-234','edp',16000.00,'Basketball Court','Mons Hardware','Pasig City','Richard Cruz','check',NULL,NULL,'exec_approve','approved',NULL,NULL,1432656000,NULL,0,NULL),(8,'rfp',1430922384,'Annielle Madrid','June Jose','','executive',16000.87,'Construction','Ace Hardware','Manila City','Steve Jobs','check',NULL,NULL,'exec_approve','approved',NULL,NULL,1432828800,NULL,0,NULL),(9,'tba',1430922441,'Annielle Madrid','Jack Black',NULL,'billing',14765.00,'Basketball Court',NULL,NULL,'Richard Cruz','cash',14765.00,'Sample Detail','completed','approved','Annielle Madrid',1430976809,1432656000,1430979965,0,NULL),(10,'tba',1430922481,'Annielle Madrid','Ryan Perez',NULL,'edp',254321.00,'Repair',NULL,NULL,'John Lloyd','cash',50000.50,'Test','completed','approved','Annielle Madrid',1430923282,1432656000,1430923373,0,NULL),(11,'tba',1430922501,'Annielle Madrid','Teresa Dela Pena',NULL,'executive',16000.87,'Clubhouse',NULL,NULL,'Adam Garcia','cash',16000.87,'Test','liquidate','released','Annielle Madrid',1430976170,1432656000,1430979969,0,NULL),(12,'tba',1430922521,'Annielle Madrid','Arvin Alejandro',NULL,'finance',15987.98,'Basketball Court',NULL,NULL,'John Lloyd','cash',15987.98,'test','liquidate','released','Annielle Madrid',1430976181,1432569600,1430977966,0,NULL),(13,'tba',1430922548,'Annielle Madrid','Manny Geronimo',NULL,'engineering',16000.87,'Repair',NULL,NULL,'Robert Mercado','cash',16000.87,'Sample','completed','released','Annielle Madrid',1430976175,1432569600,1431918049,1,5678.23),(14,'tba',1430922569,'Annielle Madrid','Teresa Dela Pena',NULL,'billing',18365.25,'Repair',NULL,NULL,'Adam Garcia','cash',18365.25,'test','completed','released','Annielle Madrid',1430976185,1431964800,1431917901,1,3456.78),(18,'ofv',1430978095,'Annielle Madrid','Ryan Perez',NULL,'billing',84353.73,'OFV - Replenishment',NULL,NULL,'N/A','check',84353.73,NULL,'completed','released','Annielle Madrid',1430978125,0,1430978149,0,NULL),(19,'ofv',1430980066,'Annielle Madrid','Arvin Alejandro',NULL,'edp',46766.74,'OFV - Replenishment',NULL,NULL,'N/A','check',46766.74,NULL,'completed','released','Annielle Madrid',1430980140,0,1430980189,0,NULL),(20,'tba',1431622139,'Annielle Madrid',' ','','finance',0.00,'sales commission',NULL,NULL,'Commission - Computer Generated',NULL,NULL,'Commission - Request','dept_head','recommended',NULL,NULL,0,NULL,0,NULL),(21,'rfp',1431638101,'Annielle Madrid','Arvin Alejandro','545-241-1515','edp',254685.23,'Repair','Ace Hardware','Pasig City','Adam Garcia','check',254685.23,NULL,'completed','approved','Annielle Madrid',1431638216,1432656000,1431638407,0,NULL),(22,'tba',1431638582,'Annielle Madrid','Arvin Alejandro',NULL,'edp',15987.98,'Repair',NULL,NULL,'John Lloyd','cash',50000.50,'','completed','approved','Annielle Madrid',1431638625,1432569600,1431638722,0,NULL),(23,'ofv',1431638930,'Annielle Madrid','Ryan Perez',NULL,'billing',50000.50,'OFV - Replenishment',NULL,NULL,'N/A','check',50000.50,NULL,'completed','released','Annielle Madrid',1431638968,0,1431639243,0,NULL),(24,'tba',1431641282,'Annielle Madrid','Arvin Alejandro',NULL,'edp',15987.98,'Repair',NULL,NULL,'John Lloyd','cash',50000.50,'','completed','released','Annielle Madrid',1431641324,1432656000,1431917751,1,2555.00),(25,'ofv',1431641422,'Annielle Madrid','Ryan Perez',NULL,'billing',50000.50,'OFV - Replenishment',NULL,NULL,'N/A','check',50000.50,NULL,'completed','released','Annielle Madrid',1431641462,0,1431641495,0,NULL),(26,'rfp',1431645005,'Annielle Madrid','Manny Geronimo','545-241-1515','billing',16000.00,'shopping','Ace Hardware','Pasig City','John Lloyd','check',16000.00,NULL,'reconciliation','released','Annielle Madrid',1431645078,1432569600,1431646729,0,NULL),(27,'rfp',1431656029,'Annielle Madrid','Arvin Alejandro','123-345-456-567','executive',10000.00,'meeting','Mizel delos Santos','Pasig City','Ace Hardware','cash',10000.00,NULL,'completed','approved','Annielle Madrid',1431656617,1431705600,1431656901,0,NULL),(28,'rfp',1431656249,'Annielle Madrid','Ryan Perez','123-345-456-567','finance',2000.00,'Meetin for lorem ipsum','Mizel delos Santos','Pasig City','JobCentral Philippines','check',2000.00,NULL,'completed','approved','Annielle Madrid',1431656485,1432137600,1431656955,0,NULL),(29,'tba',1431657193,'Annielle Madrid','Teresa Dela Pena',NULL,'edp',500000.00,'Basketball Court',NULL,NULL,'Ace Hardware','cash',15000.00,'','completed','approved','Annielle Madrid',1431657340,1432137600,1431657450,0,NULL),(30,'ofv',1431657696,'Annielle Madrid','Arvin Alejandro',NULL,'edp',25000.00,'OFV - Replenishment',NULL,NULL,'N/A','check',25000.00,NULL,'completed','released','Annielle Madrid',1431657794,0,1431657847,0,NULL),(31,'rfp',1431660308,'Annielle Madrid','Ryan Perez','123-123-123','finance',150000.00,'e bills','person','adress 123123','Meralco','check',150000.00,NULL,'completed','approved','Annielle Madrid',1431660947,1431619200,1431661426,0,NULL),(32,'tba',1431668155,'Annielle Madrid','Raymond',NULL,'edp',50000.00,'equipment',NULL,NULL,'ALSC','cash',45000.00,'asap','completed','approved','Annielle Madrid',1431668543,1431619200,1431668774,0,NULL),(33,'tba',1431669567,'Annielle Madrid','Ryan Perez',NULL,'engineering',150000.00,'Basketball Court',NULL,NULL,'Adam Garcia','cash',150000.00,'dfgd fgdf gfdg','completed','released','Annielle Madrid',1431669601,1431619200,1431917405,1,2580.00),(34,'ofv',1431669704,'Annielle Madrid','Ryan Perez',NULL,'edp',195000.00,'OFV - Replenishment',NULL,NULL,'N/A','check',195000.00,NULL,'completed','released','Annielle Madrid',1431669797,0,1431669867,0,NULL),(35,'rfp',1431670961,'Annielle Madrid','Ryan Perez','1221321','finance',10000.00,'jhkhkjfjhkfjhkjhjhfkjhj hgjh','ss','sss','sss','check',10000.00,NULL,'cheque_prep','approved','Annielle Madrid',1431671174,1430668800,NULL,0,NULL),(36,'tba',1431914015,'Annielle Madrid','Teresa Dela Pena',NULL,'billing',18365.25,'Basketball Court',NULL,NULL,'John Lloyd','cash',18365.25,'','liquidate','released','Annielle Madrid',1431914045,1432656000,1431993541,0,NULL),(37,'tax',1431991897,'Annielle Madrid','Raymond','N/A','n/a',34406.24,'Tax - Payable','N/A','N/A','N/A','check',34406.24,NULL,'completed','released','Annielle Madrid',1431993827,0,1431994211,0,NULL),(38,'tax',1431994300,'Annielle Madrid','Arvin Alejandro','N/A','n/a',37.44,'Tax - Payable','N/A','N/A','N/A','check',37.44,NULL,'completed','released','Annielle Madrid',1431994329,0,1431994363,0,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_cheque` */

insert  into `account_payable_cheque`(`account_payable_cheque_id`,`account_payable_id`,`account_payable_cheque_timestamp`,`account_payable_cheque_amount`,`account_payable_cheque_date`,`account_payable_cheque_ofv_number`,`account_payable_cheque_po_number`,`bank_id`,`user_id`,`is_released`,`released_date`,`is_encashed`,`encashed_date`,`bank_transaction_id`) values (10,25,1431641462,50000.50,1432828800,'CC55543','AA1234',4,7,0,1431641494,0,1431642118,6),(11,26,1431645078,20713.30,1432656000,'BB1','AA1',4,7,1,1431646728,0,NULL,16),(12,26,1431645078,34343.00,1432742400,'BB2','AA2',3,7,1,1431646728,0,NULL,17),(13,26,1431645078,1500.00,1431619200,'BB3','AA3',1,7,1,1431646728,0,NULL,15),(14,28,1431656484,1000.00,1431446400,'12312','1231231231123123',1,7,1,1431656955,1,1431657088,22),(15,28,1431656485,1000.00,1432224000,'123123','123123',5,7,1,1431656955,1,1431657021,24),(16,30,1431657794,25000.00,1432137600,'234234','1231232',1,7,1,1431657847,1,1431657881,26),(17,31,1431660947,150000.00,1431619200,'4564354','424534',1,7,1,1431661426,0,NULL,30),(18,34,1431669797,195000.00,1431619200,'234234234','342342',1,7,1,1431669867,1,1431669994,36),(19,35,1431671174,10000.00,1430668800,NULL,NULL,1,7,0,NULL,0,NULL,NULL),(20,37,1431993827,34406.24,1432915200,'CCCCC','XXXX',1,7,1,1431994211,1,1431994254,49),(21,38,1431994329,37.44,1432569600,'CCCCC','AAAA',4,7,1,1431994363,0,NULL,50);

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_item` */

insert  into `account_payable_item`(`account_payable_item_id`,`account_payable_item_qty`,`account_payable_item_desc`,`account_payable_item_price`,`account_payable_item_amount`,`account_payable_item_timestamp`,`account_payable_id`) values (1,1,'Bag Cement',1500.00,1500.00,1430921934,1),(2,2,'Plywood',450.00,900.00,1430921934,1),(3,5,'Faucet',122.00,610.00,1430922008,2),(4,6,'Ceramic Tiles',287.00,1722.00,1430922009,2),(5,5,'Canned Goods',250.98,1254.90,1430922085,3),(6,6,'Detergent',116.99,701.94,1430922085,3),(7,5,'Shorts',2342.00,11710.00,1430922153,4),(8,6,'Pants',1500.55,9003.30,1430922153,4),(9,5,'Trucks of Grava',965.99,4829.95,1430922234,5),(10,5,'Sacks of Sand',236.53,1182.65,1430922234,5),(11,25,'Chairs',325.23,8130.75,1430922313,6),(12,15,'Tables',865.00,12975.00,1430922313,6),(13,5,'Fibre Glass',5500.00,27500.00,1430922372,7),(14,5,'Kilos Nails',259.00,1295.00,1430922439,8),(15,7,'Ply Boards',950.00,6650.00,1430922440,8),(16,5,'Kilos Nails',350.86,1754.30,1430923476,10),(17,5,'Ply Boards',650.32,3251.60,1431116637,9),(18,4,'Sacks of Cement',336.13,1344.52,1431116637,9),(19,27,'Cans of Paint',427.45,11541.15,1431116637,9),(20,7,'Paint Brush',26.50,185.50,1431116638,9),(21,5,'bags cement',1500.00,7500.00,1431638177,21),(22,6,'pint paint',455.00,2730.00,1431638177,21),(23,4,'plywood',365.00,1460.00,1431638177,21),(24,5,'bags sand',455.89,2279.45,1431638863,22),(25,6,'pints paint white',465.80,2794.80,1431638863,22),(26,5,'kilos nails',567.99,2839.95,1431638863,22),(27,5,'pants',1500.00,7500.00,1431645039,26),(28,1,'Item A 123',5000.00,5000.00,1431656245,27),(29,4,'Item B 321',1250.00,5000.00,1431656245,27),(30,5,'Item 123 A',200.00,1000.00,1431656359,28),(31,2,'Item 345 B',150.00,300.00,1431656359,28),(32,7,'Item 456 C',100.00,700.00,1431656359,28),(33,5,'Metals',1000.00,5000.00,1431657661,29),(34,1,'cement',5000.00,5000.00,1431657661,29),(35,1,'water',5000.00,5000.00,1431657661,29),(36,150,'e bills',1000.00,150000.00,1431660679,31),(37,10,'hardisk',4000.00,40000.00,1431669070,32),(38,1,'m board',2500.00,2500.00,1431669070,32),(39,1,'mouse',2500.00,2500.00,1431669070,32),(40,1,'cellphone',5000.00,5000.00,1431671097,35),(41,1,'casng',5000.00,5000.00,1431671097,35),(42,5,'test2',256.00,1280.00,1431916000,33),(43,25,'test2',255.00,6375.00,1431916062,24),(44,5,'test2',154.00,770.00,1431917857,14),(45,2,'bags',2345.67,4691.34,1431918013,13);

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
  `project_id` bigint(10) unsigned DEFAULT NULL,
  `project_site_id` bigint(10) unsigned DEFAULT NULL,
  `option_account_chart_child_id` varchar(50) DEFAULT NULL,
  `option_account_chart_parent_id` varchar(50) DEFAULT NULL,
  `account_payable_item_detail_timestamp` bigint(15) DEFAULT NULL,
  `tax_payed` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`account_payable_item_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_item_detail` */

insert  into `account_payable_item_detail`(`account_payable_item_detail_id`,`account_payable_id`,`account_payable_item_id`,`item_gross_amount`,`item_net_amount`,`item_tax_amount`,`item_tax_percent`,`project_id`,`project_site_id`,`option_account_chart_child_id`,`option_account_chart_parent_id`,`account_payable_item_detail_timestamp`,`tax_payed`) values (1,1,1,25000.00,1.76,0.24,12.00,1,1,'moc','advances_to_officers',1430922675,1),(2,1,2,6500.00,5720.00,780.00,12.00,1,1,'basketball_court','development_cost',1430922675,1),(3,10,16,350.00,308.00,42.00,12.00,1,1,'basketball_court','development_cost',1430923476,1),(4,10,16,2500.00,2200.00,300.00,12.00,1,1,'moc','advances_to_officers',1430923476,1),(5,9,17,1500.00,1320.00,180.00,12.00,1,1,'basketball_court','development_cost',1431116637,1),(6,9,17,1752.60,1542.29,210.31,12.00,2,2,'drainage','development_cost',1431116637,1),(7,9,18,890.34,783.50,106.84,12.00,2,2,'clubhouse','development_cost',1431116637,1),(8,9,18,454.00,399.52,54.48,12.00,1,1,'basketball_court','development_cost',1431116637,1),(9,9,19,6541.15,5756.21,784.94,12.00,2,2,'deepwell','development_cost',1431116637,1),(10,9,19,2500.00,2200.00,300.00,12.00,1,1,'clubhouse','development_cost',1431116638,1),(11,9,19,2500.00,2200.00,300.00,12.00,2,2,'basketball_court','development_cost',1431116638,1),(12,9,20,85.50,75.24,10.26,12.00,1,1,'equipment','development_cost',1431116638,1),(13,9,20,100.00,88.00,12.00,12.00,2,2,'equipment','development_cost',1431116638,1),(14,21,21,4500.00,3960.00,540.00,12.00,1,1,'basketball_court','development_cost',1431638264,1),(15,21,22,2765.00,2433.20,331.80,12.00,1,1,'moc','advances_to_officers',1431638264,1),(16,21,23,6562.00,5774.56,787.44,12.00,2,2,'car','advances_to_agents',1431638264,1),(17,22,24,455.89,401.18,54.71,12.00,1,1,'basketball_court','development_cost',1431638863,1),(18,22,25,465.80,409.90,55.90,12.00,2,2,'clubhouse','development_cost',1431638863,1),(19,22,26,567.99,499.83,68.16,12.00,1,1,'deepwell','development_cost',1431638863,1),(20,26,27,5000.00,4400.00,600.00,12.00,1,1,'basketball_court','development_cost',1431645099,1),(21,28,30,500.00,440.00,60.00,12.00,1,1,'basketball_court','development_cost',1431656728,1),(22,28,30,250.00,220.00,30.00,12.00,2,2,'moc','advances_to_officers',1431656728,1),(23,28,30,2500.00,220.00,30.00,12.00,1,1,'car','advances_to_agents',1431656728,1),(24,28,31,300.00,264.00,36.00,12.00,0,0,'0','0',1431656728,1),(25,28,32,700.00,616.00,84.00,12.00,0,0,'0','0',1431656728,1),(26,27,28,5000.00,5000.00,0.00,0.00,1,1,'moc','advances_to_officers',1431656781,1),(27,27,29,5000.00,2800.00,2200.00,44.00,2,2,'basketball_court','development_cost',1431656781,1),(28,29,33,5000.00,4400.00,600.00,12.00,1,1,'basketball_court','development_cost',1431657661,1),(29,29,34,5000.00,4400.00,600.00,12.00,1,1,'clubhouse','development_cost',1431657661,1),(30,29,35,5000.00,4400.00,600.00,12.00,1,1,'moc','advances_to_officers',1431657662,1),(31,31,36,100000.00,88000.00,12000.00,12.00,1,1,'basketball_court','development_cost',1431661183,1),(32,31,36,50000.00,44000.00,6000.00,12.00,0,0,'amb','advances_to_officers',1431661183,1),(33,32,37,10000.00,8800.00,1200.00,12.00,0,0,'equipment','development_cost',1431669070,1),(34,32,37,30000.00,26400.00,3600.00,12.00,0,0,'clubhouse','development_cost',1431669070,1),(35,32,38,2500.00,2200.00,300.00,12.00,0,0,'basketball_court','development_cost',1431669070,1),(36,32,39,2500.00,2200.00,300.00,12.00,0,0,'moc','advances_to_officers',1431669070,1),(37,35,40,5000.00,5000.00,0.00,0.00,1,1,'basketball_court','development_cost',1431671261,1),(38,35,41,5000.00,5000.00,0.00,0.00,0,0,'moc','advances_to_officers',1431671261,1),(39,33,42,1280.00,1126.40,153.60,12.00,1,1,'car','advances_to_agents',1431916000,1),(40,24,43,6544.00,5758.72,785.28,12.00,1,1,'car','advances_to_agents',1431916062,1),(41,14,44,2445.00,2151.60,293.40,12.00,1,1,'car','advances_to_agents',1431917857,1),(42,13,45,124.00,109.12,14.88,12.00,1,1,'car','advances_to_agents',1431918013,1),(43,3,5,257.00,226.16,30.84,12.00,1,1,'gasoline','advances_to_agents',1431993298,1),(44,3,6,55.00,48.40,6.60,12.00,1,1,'car','advances_to_agents',1431993298,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_ofv` */

insert  into `account_payable_ofv`(`account_payable_ofv_id`,`account_payable_id`,`account_payable_ofv_amount`,`account_payable_ofv_release_date`,`account_payable_ofv_po_number`,`account_payable_ofv_ofv_number`,`account_payable_ofv_or_number`,`account_payable_ofv_cov_number`,`user_id`,`is_replenished`,`is_released`,`bank_transaction_id`) values (1,10,50000.50,1432742400,'BB1521',NULL,'AA1234','CC241561',7,1,1,4),(2,14,18365.25,1431100800,'BB1521',NULL,'AA1234','CC241561',7,1,1,8),(3,12,15987.98,1432828800,'BB1521',NULL,'AA1234','CC241561',7,1,1,12),(4,9,14765.00,1432569600,'BB1521',NULL,'AA1234','CC241561',7,1,1,20),(5,11,16000.87,1432224000,'BB1521',NULL,'AA1234','CC241561',7,1,1,21),(6,13,16000.87,1432569600,'BB1521',NULL,'AA1234','CC241561',7,1,1,22),(7,22,50000.50,1432828800,'BB1521',NULL,'AA1234','CC241561',7,1,1,28),(8,24,50000.50,1432310400,'BB1521',NULL,'AA1234','CC241561',7,1,1,5),(9,27,10000.00,1430841600,'123123',NULL,'231231','1231231',7,1,1,23),(10,29,15000.00,1430928000,'123123',NULL,'1231231','234234',7,1,1,25),(11,32,45000.00,1431619200,'',NULL,'','',7,1,1,34),(16,33,2580.00,1432656000,'BB1521',NULL,'1231231','CC241561',7,0,1,44),(17,24,2555.00,1432569600,'123123',NULL,'AA1234','CC241561',7,0,1,45),(18,14,3456.78,1431100800,'BB1521',NULL,'AA1234','CC241561',7,0,1,46),(19,13,5678.23,1450800000,'WWXX22',NULL,'XX222','VVV12',7,0,1,47),(20,36,18365.25,1432569600,'123123',NULL,'AA1234','VVV12',7,0,1,48);

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
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8;

/*Data for the table `account_payable_ticket` */

insert  into `account_payable_ticket`(`account_payable_ticket_id`,`user_id`,`request_approval_level_id`,`request_approval_status_id`,`account_payable_ticket_timestamp`,`account_payable_id`,`request_type_id`) values (1,7,'dept_head','recommended',1430921934,1,'rfp'),(2,7,'dept_head','recommended',1430922009,2,'rfp'),(3,7,'dept_head','recommended',1430922085,3,'rfp'),(4,7,'dept_head','recommended',1430922153,4,'rfp'),(5,7,'dept_head','recommended',1430922234,5,'rfp'),(6,7,'dept_head','recommended',1430922313,6,'rfp'),(7,7,'dept_head','recommended',1430922372,7,'rfp'),(8,7,'dept_head','recommended',1430922440,8,'rfp'),(9,7,'dept_head','recommended',1430922479,9,'tba'),(10,7,'dept_head','recommended',1430922499,10,'tba'),(11,7,'dept_head','recommended',1430922519,11,'tba'),(12,7,'dept_head','recommended',1430922547,12,'tba'),(13,7,'dept_head','recommended',1430922567,13,'tba'),(14,7,'dept_head','recommended',1430922589,14,'tba'),(15,7,'exec_approve','approved',1430922610,1,'rfp'),(16,7,'journal_entry','approved',1430922640,1,'rfp'),(17,7,'cheque_prep','approved',1430922675,1,'rfp'),(18,7,'exec_sign','ready',1430922765,1,'rfp'),(19,7,'cheque_release','signed',1430922777,1,'rfp'),(20,7,'reconciliation','released',1430922895,1,'rfp'),(21,7,'exec_approve','approved',1430923260,10,'tba'),(22,7,'journal_entry','approved',1430923282,10,'tba'),(23,7,'cheque_prep','approved',1430923303,10,'tba'),(24,7,'exec_sign','ready',1430923322,10,'tba'),(25,7,'cheque_release','signed',1430923330,10,'tba'),(26,7,'exec_approve','approved',1430923352,11,'tba'),(27,7,'liquidate','released',1430923373,10,'tba'),(28,7,'completed','approved',1430923476,10,'tba'),(29,7,'completed','approved',1430923506,1,'rfp'),(30,7,'exec_approve','approved',1430923782,15,'ofv'),(31,7,'cheque_prep','approved',1430923841,15,'ofv'),(32,7,'exec_sign','ready',1430923878,15,'ofv'),(33,7,'cheque_release','signed',1430923896,15,'ofv'),(34,7,'completed','released',1430923904,15,'ofv'),(35,7,'exec_approve','approved',1430976098,2,'rfp'),(36,7,'exec_approve','approved',1430976102,3,'rfp'),(37,7,'exec_approve','approved',1430976105,4,'rfp'),(38,7,'exec_approve','approved',1430976110,14,'tba'),(39,7,'exec_approve','approved',1430976113,13,'tba'),(40,7,'exec_approve','approved',1430976116,12,'tba'),(41,7,'exec_approve','approved',1430976123,7,'rfp'),(42,7,'exec_approve','approved',1430976127,5,'rfp'),(43,7,'journal_entry','approved',1430976163,2,'rfp'),(44,7,'journal_entry','approved',1430976170,11,'tba'),(45,7,'journal_entry','approved',1430976175,13,'tba'),(46,7,'journal_entry','approved',1430976181,12,'tba'),(47,7,'journal_entry','approved',1430976185,14,'tba'),(48,7,'journal_entry','approved',1430976207,4,'rfp'),(49,7,'journal_entry','approved',1430976232,3,'rfp'),(50,7,'exec_approve','approved',1430976301,9,'tba'),(51,7,'journal_entry','approved',1430976809,9,'tba'),(52,7,'cheque_prep','approved',1430976828,14,'tba'),(53,7,'cheque_prep','approved',1430976907,13,'tba'),(54,7,'exec_sign','ready',1430976993,14,'tba'),(55,7,'cheque_release','signed',1430977021,14,'tba'),(56,7,'liquidate','released',1430977095,14,'tba'),(57,7,'exec_approve','approved',1430977510,16,'ofv'),(58,7,'cheque_prep','approved',1430977581,16,'ofv'),(59,7,'exec_sign','ready',1430977601,16,'ofv'),(60,7,'cheque_release','signed',1430977616,16,'ofv'),(61,7,'completed','released',1430977656,16,'ofv'),(62,7,'cheque_prep','approved',1430977925,12,'tba'),(63,7,'exec_sign','ready',1430977942,12,'tba'),(64,7,'cheque_release','signed',1430977955,12,'tba'),(65,7,'liquidate','released',1430977966,12,'tba'),(66,7,'exec_approve','approved',1430977979,17,'ofv'),(67,7,'cheque_prep','approved',1430978000,17,'ofv'),(68,7,'exec_approve','approved',1430978103,18,'ofv'),(69,7,'cheque_prep','approved',1430978124,18,'ofv'),(70,7,'exec_sign','ready',1430978135,18,'ofv'),(71,7,'cheque_release','signed',1430978141,18,'ofv'),(72,7,'completed','released',1430978149,18,'ofv'),(73,7,'cheque_prep','approved',1430979888,9,'tba'),(74,7,'cheque_prep','approved',1430979892,11,'tba'),(75,7,'exec_sign','ready',1430979917,9,'tba'),(76,7,'exec_sign','ready',1430979929,11,'tba'),(77,7,'exec_sign','ready',1430979940,13,'tba'),(78,7,'cheque_release','signed',1430979948,9,'tba'),(79,7,'cheque_release','signed',1430979952,11,'tba'),(80,7,'cheque_release','signed',1430979956,13,'tba'),(81,7,'liquidate','released',1430979965,9,'tba'),(82,7,'liquidate','released',1430979969,11,'tba'),(83,7,'liquidate','released',1430979973,13,'tba'),(84,7,'exec_approve','approved',1430980092,19,'ofv'),(85,7,'cheque_prep','approved',1430980140,19,'ofv'),(86,7,'exec_sign','ready',1430980155,19,'ofv'),(87,7,'cheque_release','signed',1430980162,19,'ofv'),(88,7,'completed','released',1430980189,19,'ofv'),(89,7,'completed','approved',1431116638,9,'tba'),(90,7,'exec_approve','approved',1431118036,8,'rfp'),(91,7,'exec_approve','approved',1431118039,6,'rfp'),(92,7,'dept_head','recommended',1431622139,20,'tba'),(93,7,'dept_head','recommended',1431638177,21,'rfp'),(94,7,'exec_approve','approved',1431638190,21,'rfp'),(95,7,'journal_entry','approved',1431638216,21,'rfp'),(96,7,'cheque_prep','approved',1431638264,21,'rfp'),(97,7,'exec_sign','ready',1431638302,21,'rfp'),(98,7,'cheque_release','signed',1431638312,21,'rfp'),(99,7,'reconciliation','released',1431638407,21,'rfp'),(100,7,'completed','approved',1431638546,21,'rfp'),(101,7,'dept_head','recommended',1431638597,22,'tba'),(102,7,'exec_approve','approved',1431638608,22,'tba'),(103,7,'journal_entry','approved',1431638625,22,'tba'),(104,7,'cheque_prep','approved',1431638637,22,'tba'),(105,7,'exec_sign','ready',1431638677,22,'tba'),(106,7,'cheque_release','signed',1431638690,22,'tba'),(107,7,'liquidate','released',1431638722,22,'tba'),(108,7,'completed','approved',1431638863,22,'tba'),(109,7,'exec_approve','approved',1431638938,23,'ofv'),(110,7,'cheque_prep','approved',1431638968,23,'ofv'),(111,7,'exec_sign','ready',1431639224,23,'ofv'),(112,7,'cheque_release','signed',1431639233,23,'ofv'),(113,7,'completed','released',1431639243,23,'ofv'),(114,7,'dept_head','recommended',1431641298,24,'tba'),(115,7,'exec_approve','approved',1431641306,24,'tba'),(116,7,'journal_entry','approved',1431641324,24,'tba'),(117,7,'cheque_prep','approved',1431641336,24,'tba'),(118,7,'exec_sign','ready',1431641368,24,'tba'),(119,7,'cheque_release','signed',1431641383,24,'tba'),(120,7,'liquidate','released',1431641402,24,'tba'),(121,7,'exec_approve','approved',1431641429,25,'ofv'),(122,7,'cheque_prep','approved',1431641462,25,'ofv'),(123,7,'exec_sign','ready',1431641477,25,'ofv'),(124,7,'cheque_release','signed',1431641486,25,'ofv'),(125,7,'completed','released',1431641495,25,'ofv'),(126,7,'dept_head','recommended',1431645039,26,'rfp'),(127,7,'exec_approve','approved',1431645046,26,'rfp'),(128,7,'journal_entry','approved',1431645078,26,'rfp'),(129,7,'cheque_prep','approved',1431645098,26,'rfp'),(130,7,'exec_sign','ready',1431645118,26,'rfp'),(131,7,'cheque_release','signed',1431645130,26,'rfp'),(132,7,'cheque_release','released',1431645162,26,'rfp'),(133,7,'reconciliation','released',1431645200,26,'rfp'),(134,7,'cheque_release','released',1431646519,26,'rfp'),(135,7,'cheque_release','released',1431646714,26,'rfp'),(136,7,'reconciliation','released',1431646729,26,'rfp'),(137,7,'dept_head','recommended',1431656245,27,'rfp'),(138,7,'dept_head','recommended',1431656359,28,'rfp'),(139,7,'exec_approve','approved',1431656395,27,'rfp'),(140,7,'exec_approve','approved',1431656411,28,'rfp'),(141,7,'journal_entry','approved',1431656484,28,'rfp'),(142,7,'journal_entry','approved',1431656617,27,'rfp'),(143,7,'cheque_prep','approved',1431656728,28,'rfp'),(144,7,'cheque_prep','approved',1431656781,27,'rfp'),(145,7,'exec_sign','ready',1431656828,28,'rfp'),(146,7,'exec_sign','ready',1431656852,27,'rfp'),(147,7,'cheque_release','signed',1431656864,28,'rfp'),(148,7,'cheque_release','signed',1431656875,27,'rfp'),(149,7,'cheque_release','released',1431656890,28,'rfp'),(150,7,'reconciliation','released',1431656901,27,'rfp'),(151,7,'reconciliation','released',1431656955,28,'rfp'),(152,7,'completed','approved',1431656976,28,'rfp'),(153,7,'completed','approved',1431656983,27,'rfp'),(154,7,'dept_head','recommended',1431657238,29,'tba'),(155,7,'exec_approve','approved',1431657248,29,'tba'),(156,7,'journal_entry','approved',1431657340,29,'tba'),(157,7,'cheque_prep','approved',1431657362,29,'tba'),(158,7,'exec_sign','ready',1431657393,29,'tba'),(159,7,'cheque_release','signed',1431657414,29,'tba'),(160,7,'liquidate','released',1431657450,29,'tba'),(161,7,'completed','approved',1431657662,29,'tba'),(162,7,'exec_approve','approved',1431657737,30,'ofv'),(163,7,'cheque_prep','approved',1431657794,30,'ofv'),(164,7,'exec_sign','ready',1431657823,30,'ofv'),(165,7,'cheque_release','signed',1431657836,30,'ofv'),(166,7,'completed','released',1431657847,30,'ofv'),(167,7,'dept_head','recommended',1431660679,31,'rfp'),(168,7,'exec_approve','approved',1431660824,31,'rfp'),(169,7,'journal_entry','approved',1431660947,31,'rfp'),(170,7,'cheque_prep','approved',1431661183,31,'rfp'),(171,7,'exec_sign','ready',1431661313,31,'rfp'),(172,7,'cheque_release','signed',1431661354,31,'rfp'),(173,7,'reconciliation','released',1431661426,31,'rfp'),(174,7,'completed','approved',1431661482,31,'rfp'),(175,7,'dept_head','recommended',1431668284,32,'tba'),(176,7,'exec_approve','approved',1431668317,32,'tba'),(177,7,'journal_entry','approved',1431668543,32,'tba'),(178,7,'cheque_prep','approved',1431668605,32,'tba'),(179,7,'exec_sign','ready',1431668687,32,'tba'),(180,7,'cheque_release','signed',1431668745,32,'tba'),(181,7,'liquidate','released',1431668774,32,'tba'),(182,7,'completed','approved',1431669070,32,'tba'),(183,7,'dept_head','recommended',1431669585,33,'tba'),(184,7,'exec_approve','approved',1431669590,33,'tba'),(185,7,'journal_entry','approved',1431669601,33,'tba'),(186,7,'cheque_prep','approved',1431669617,33,'tba'),(187,7,'exec_sign','ready',1431669627,33,'tba'),(188,7,'cheque_release','signed',1431669640,33,'tba'),(189,7,'liquidate','released',1431669653,33,'tba'),(190,7,'exec_approve','approved',1431669724,34,'ofv'),(191,7,'cheque_prep','approved',1431669796,34,'ofv'),(192,7,'exec_sign','ready',1431669825,34,'ofv'),(193,7,'cheque_release','signed',1431669854,34,'ofv'),(194,7,'completed','released',1431669867,34,'ofv'),(195,7,'dept_head','recommended',1431671097,35,'rfp'),(196,7,'exec_approve','approved',1431671119,35,'rfp'),(197,7,'journal_entry','approved',1431671174,35,'rfp'),(198,7,'cheque_prep','approved',1431671260,35,'rfp'),(199,7,'dept_head','recommended',1431914029,36,'tba'),(200,7,'exec_approve','approved',1431914036,36,'tba'),(201,7,'journal_entry','approved',1431914045,36,'tba'),(202,7,'cheque_prep','approved',1431914051,36,'tba'),(203,7,'cheque_prep','Reimbursement',1431916000,33,'tba'),(204,7,'cheque_prep','Reimbursement',1431916062,24,'tba'),(205,7,'exec_sign','ready',1431916655,33,'tba'),(206,7,'exec_sign','ready',1431916931,24,'tba'),(207,7,'cheque_prep','reimbursement',1431917079,33,'tba'),(208,7,'cheque_release','reimbursement',1431917348,33,'tba'),(209,7,'liquidate','released',1431917404,33,'tba'),(210,7,'cheque_release','reimbursement',1431917523,24,'tba'),(211,7,'completed','released',1431917751,24,'tba'),(212,7,'cheque_prep','reimbursement',1431917857,14,'tba'),(213,7,'cheque_release','reimbursement',1431917887,14,'tba'),(214,7,'completed','released',1431917901,14,'tba'),(215,7,'cheque_prep','reimbursement',1431918013,13,'tba'),(216,7,'cheque_release','reimbursement',1431918039,13,'tba'),(217,7,'completed','released',1431918049,13,'tba'),(218,7,'exec_approve','approved',1431991974,37,'tax'),(219,7,'cheque_prep','approved',1431993298,3,'rfp'),(220,7,'exec_sign','ready',1431993333,36,'tba'),(221,7,'cheque_release','signed',1431993531,36,'tba'),(222,7,'liquidate','released',1431993541,36,'tba'),(223,7,'journal_entry','approved',1431993827,37,'tax'),(224,7,'exec_sign','ready',1431993945,37,'tax'),(225,7,'cheque_release','signed',1431993957,37,'tax'),(226,7,'completed','released',1431994211,37,'tax'),(227,7,'exec_approve','approved',1431994306,38,'tax'),(228,7,'cheque_prep','approved',1431994329,38,'tax'),(229,7,'exec_sign','ready',1431994342,38,'tax'),(230,7,'cheque_release','signed',1431994351,38,'tax'),(231,7,'completed','released',1431994363,38,'tax');

/*Table structure for table `account_receive` */

DROP TABLE IF EXISTS `account_receive`;

CREATE TABLE `account_receive` (
  `account_receive_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_account_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `lot_id` bigint(20) unsigned DEFAULT '0',
  `option_payment_method_id` varchar(20) DEFAULT NULL,
  `option_payment_receipt_id` varchar(20) DEFAULT NULL,
  `option_payment_status_id` varchar(20) DEFAULT NULL,
  `option_payment_excess_id` varchar(20) DEFAULT NULL,
  `account_receive_name` varchar(100) DEFAULT NULL,
  `account_receive_payee` varchar(100) DEFAULT NULL,
  `account_receive_address` varchar(200) DEFAULT NULL,
  `account_receive_receipt` varchar(100) DEFAULT NULL,
  `account_receive_amount_paid` double(10,2) unsigned DEFAULT '0.00',
  `account_receive_amount` double(10,2) unsigned DEFAULT '0.00',
  `account_receive_net_amount` double(10,2) unsigned DEFAULT '0.00',
  `account_receive_excess_amount` double(10,2) unsigned DEFAULT '0.00',
  `account_receive_vat_amount` double(10,2) unsigned DEFAULT '0.00',
  `account_receive_surcharge_discount` double(5,2) unsigned DEFAULT '0.00',
  `account_receive_timestamp_today` bigint(15) unsigned DEFAULT '0',
  `account_receive_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`account_receive_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `account_receive` */

insert  into `account_receive`(`account_receive_id`,`client_account_id`,`user_id`,`lot_id`,`option_payment_method_id`,`option_payment_receipt_id`,`option_payment_status_id`,`option_payment_excess_id`,`account_receive_name`,`account_receive_payee`,`account_receive_address`,`account_receive_receipt`,`account_receive_amount_paid`,`account_receive_amount`,`account_receive_net_amount`,`account_receive_excess_amount`,`account_receive_vat_amount`,`account_receive_surcharge_discount`,`account_receive_timestamp_today`,`account_receive_timestamp`) values (1,1,7,0,'0','0','pending','0','',NULL,NULL,'',0.00,20846.66,20846.66,0.00,0.00,0.00,1428595200,1428649746),(2,1,7,0,'0','0','pending','0','',NULL,NULL,'',0.00,41693.32,41693.32,0.00,0.00,0.00,1428595200,1428649963),(3,1,7,0,'0','0','pending','0','',NULL,NULL,'',0.00,104233.30,104233.30,0.00,0.00,0.00,1428595200,1428649971),(4,1,7,0,'0','0','pending','0','',NULL,NULL,'',0.00,83386.64,83386.64,0.00,0.00,0.00,1428595200,1428649978),(5,1,7,0,'0','0','pending','0','',NULL,NULL,'',0.00,41693.32,41693.32,0.00,0.00,0.00,1428595200,1428649989),(6,1,7,0,'0','0','pending','0','',NULL,NULL,'',0.00,104233.30,104233.30,0.00,0.00,0.00,1428595200,1428650107),(7,1,7,0,'0','0','pending','0','',NULL,NULL,'',0.00,104233.30,104233.30,0.00,0.00,0.00,1428595200,1428650115),(8,1,7,0,'0','0','pending','0','',NULL,NULL,'',0.00,104233.30,104233.30,0.00,0.00,0.00,1428595200,1428650122),(9,1,7,0,'0','0','pending','0','',NULL,NULL,'OR12345',0.00,20846.66,20846.66,0.00,0.00,0.00,1429545600,1429600531);

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
  `receive_amount_waive_surcharge` double(10,2) unsigned DEFAULT '0.00',
  `receive_timestamp` bigint(15) unsigned DEFAULT '0',
  PRIMARY KEY (`account_receive_invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `account_receive_invoice` */

insert  into `account_receive_invoice`(`account_receive_invoice_id`,`account_receive_id`,`client_account_id`,`client_account_invoice_id`,`receive_amount`,`receive_amount_surcharge`,`receive_amount_interest`,`receive_amount_principal`,`receive_amount_rebate`,`receive_amount_waive_surcharge`,`receive_timestamp`) values (1,1,1,1,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649746),(2,2,1,2,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649963),(3,2,1,3,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649963),(4,3,1,4,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649971),(5,3,1,5,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649971),(6,3,1,6,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649971),(7,3,1,7,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649971),(8,3,1,8,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649971),(9,4,1,9,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649978),(10,4,1,10,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649978),(11,4,1,11,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649978),(12,4,1,12,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649978),(13,5,1,13,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649989),(14,5,1,14,20846.66,0.00,0.00,20846.66,0.00,0.00,1428649989),(15,6,1,15,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650107),(16,6,1,16,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650107),(17,6,1,17,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650107),(18,6,1,18,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650107),(19,6,1,19,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650107),(20,7,1,20,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650115),(21,7,1,21,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650115),(22,7,1,22,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650115),(23,7,1,23,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650115),(24,7,1,24,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650115),(25,8,1,25,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650122),(26,8,1,26,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650122),(27,8,1,27,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650122),(28,8,1,28,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650122),(29,8,1,29,20846.66,0.00,0.00,20846.66,0.00,0.00,1428650122),(30,9,1,30,20846.66,0.00,0.00,20846.66,0.00,0.00,1429600531);

/*Table structure for table `agent` */

DROP TABLE IF EXISTS `agent`;

CREATE TABLE `agent` (
  `agent_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `agent_commission_scheme` varchar(15) DEFAULT NULL,
  `lot_id` bigint(20) unsigned DEFAULT NULL,
  `agent_first_name` varchar(50) DEFAULT NULL,
  `agent_last_name` varchar(50) DEFAULT NULL,
  `agent_middle_initial` varchar(15) DEFAULT NULL,
  `agent_nick_name` varchar(50) DEFAULT NULL,
  `agent_sequence` int(10) unsigned DEFAULT NULL,
  `agent_monthly_quota` double(15,2) unsigned DEFAULT NULL,
  `agent_sequence_status` tinyint(1) unsigned DEFAULT '0',
  `agent_sequence_timestamp` bigint(15) unsigned DEFAULT NULL,
  `agent_timestamp` bigint(15) unsigned DEFAULT NULL,
  `agent_code` varchar(20) DEFAULT NULL,
  `network_id` int(10) unsigned DEFAULT NULL,
  `network_division_id` int(10) unsigned DEFAULT NULL,
  `agent_birthdate` bigint(15) unsigned DEFAULT NULL,
  `agent_birthplace` varchar(30) DEFAULT NULL,
  `option_gender_id` varchar(10) DEFAULT NULL,
  `option_civil_status_id` varchar(25) DEFAULT NULL,
  `agent_address` varchar(150) DEFAULT NULL,
  `agent_contact_number` varchar(25) DEFAULT NULL,
  `agent_email` varchar(50) DEFAULT NULL,
  `agent_sss` varchar(30) DEFAULT NULL,
  `agent_tin` varchar(30) DEFAULT NULL,
  `option_agent_status_id` varchar(10) DEFAULT NULL,
  `agent_recruited_by` varchar(100) DEFAULT NULL,
  `agent_hire_date` bigint(15) unsigned DEFAULT NULL,
  `option_agent_position_id` varchar(20) DEFAULT NULL,
  `is_deleted` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `agent` */

insert  into `agent`(`agent_id`,`agent_commission_scheme`,`lot_id`,`agent_first_name`,`agent_last_name`,`agent_middle_initial`,`agent_nick_name`,`agent_sequence`,`agent_monthly_quota`,`agent_sequence_status`,`agent_sequence_timestamp`,`agent_timestamp`,`agent_code`,`network_id`,`network_division_id`,`agent_birthdate`,`agent_birthplace`,`option_gender_id`,`option_civil_status_id`,`agent_address`,`agent_contact_number`,`agent_email`,`agent_sss`,`agent_tin`,`option_agent_status_id`,`agent_recruited_by`,`agent_hire_date`,`option_agent_position_id`,`is_deleted`) values (9,NULL,NULL,'Roberto','Cruz','J.','Robert',NULL,48624.00,0,NULL,1431509062,'AG1234',0,0,769622400,'Mandaluyong City','male','single','Block 8 Phase 5-C Pasig City','0905102561','robert@gmail.com','1568-3566','111-4586-1122','active','Martin Feliciano',1304265600,'sales_director',0),(10,NULL,NULL,'Ryan','Fajardo','W.','Ry',NULL,48624.00,0,NULL,1431509203,'AG1234',0,0,177492600,'Pasig City','male','single','L5 Blk 6 Metro Manila','09064823662','ryan@yahoo.com','1568-3566','111-4586-1122','active','Ryan Fajardo',1430582400,'sales_manager',0),(11,NULL,NULL,'Mark','Cruz','C.','Mark',NULL,32624.00,0,NULL,1431509280,'AG1234',0,0,1431273600,'Metro Manila','male','separated','L5 Blk 6 Metro Manila','0905102561','mark@yahoo.com','12341-5676','111-4586-1122','active','Ryan Fajardo',1430582400,'property_consultant',0),(15,'new',NULL,'Roberto','Cruz','C.','Mark',NULL,16000.00,0,NULL,1432263152,'AG1234',0,0,1432656000,'Metro Manila','male','0','','','','','','active','',0,'property_consultant',0);

/*Table structure for table `agent_sales_director` */

DROP TABLE IF EXISTS `agent_sales_director`;

CREATE TABLE `agent_sales_director` (
  `agent_sales_director_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `sales_manager_id` bigint(15) unsigned DEFAULT NULL,
  `sales_director_id` bigint(15) unsigned DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`agent_sales_director_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `agent_sales_director` */

insert  into `agent_sales_director`(`agent_sales_director_id`,`sales_manager_id`,`sales_director_id`,`is_deleted`) values (1,10,9,0);

/*Table structure for table `agent_sales_manager` */

DROP TABLE IF EXISTS `agent_sales_manager`;

CREATE TABLE `agent_sales_manager` (
  `agent_sales_manager` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` bigint(15) unsigned DEFAULT NULL,
  `sales_manager_id` bigint(15) unsigned DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`agent_sales_manager`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `agent_sales_manager` */

insert  into `agent_sales_manager`(`agent_sales_manager`,`agent_id`,`sales_manager_id`,`is_deleted`) values (2,11,10,0),(3,12,10,0),(4,13,10,0),(5,14,10,0),(6,15,10,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `bank` */

insert  into `bank`(`bank_id`,`bank_name`,`bank_account_type`,`bank_branch`,`bank_swift_code`,`bank_contact_number`,`bank_website`,`bank_address`) values (1,'BPI','Peso','Malolos','UFX-1144','+63-02-123-4567','http://www.bpi.com.ph','Bank of the Philippine Islands, Malolos Branch MacArthur Highway, Malolos, Bulacan'),(2,'PNB','Peso','San Miguel','CXA-123','+63-02-123-4567','http://www.pnb.com.ph','Philippine National Bank, Malolos Branch MacArthur Highway, Malolos, Bulacan'),(3,'RCBC','Peso','Plaridel','444-2234','+63-02-123-4567','http://www.rcbc.com.ph','Rizal Commercial Banking Corporation , Malolos Branch MacArthur Highway, Malolos, Bulacan'),(4,'UCPB','Peso','Malolos','CCFV-1457','+63-02-123-4567','http://www.ucpb.com.ph','United Coconut Planters Bank, Malolos Branch MacArthur Highway, Malolos, Bulacan'),(5,'Landbank','Peso','Malolos','AFC-1561','+63-02-123-4567','http://www.landbank.com.ph','Landbank of the Philippines, Malolos Branch MacArthur Highway, Malolos, Bulacan'),(6,'OFV','Peso','N/A','N/A','+63-02-123-4567','N/A','N/A');

/*Table structure for table `bank_transaction` */

DROP TABLE IF EXISTS `bank_transaction`;

CREATE TABLE `bank_transaction` (
  `bank_transaction_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `bank_id` int(9) unsigned DEFAULT NULL,
  `bank_pair_id` int(9) unsigned DEFAULT NULL,
  `account_payable_id` bigint(15) unsigned DEFAULT NULL,
  `option_cashflow_type_id` varchar(25) DEFAULT NULL,
  `bank_transaction_amount` double(15,2) unsigned DEFAULT NULL,
  `option_bank_transaction_source_id` varchar(25) DEFAULT NULL,
  `bank_transaction_timestamp` bigint(15) DEFAULT NULL,
  `bank_transaction_depositor` varchar(100) DEFAULT NULL,
  `bank_transaction_details` varchar(500) DEFAULT NULL,
  `handled_by` varchar(100) DEFAULT NULL,
  `is_pending` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`bank_transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

/*Data for the table `bank_transaction` */

insert  into `bank_transaction`(`bank_transaction_id`,`bank_id`,`bank_pair_id`,`account_payable_id`,`option_cashflow_type_id`,`bank_transaction_amount`,`option_bank_transaction_source_id`,`bank_transaction_timestamp`,`bank_transaction_depositor`,`bank_transaction_details`,`handled_by`,`is_pending`) values (28,1,NULL,NULL,'in',10000000.00,'cash_on_hand',1431660451,'Vincent Borlongan','for presentation','Annielle Madrid',0),(29,5,NULL,NULL,'in',20000000.00,'cash_on_hand',1431660496,'Vincent Borlongan','re','Annielle Madrid',0),(30,1,NULL,31,'out',150000.00,'disbursement',1431661426,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(31,1,NULL,NULL,'in',10000.00,'adjustment_in',1431667876,NULL,'interest','Annielle Madrid',0),(32,5,6,NULL,'out',300000.00,'fund_transfer_out',1431668405,NULL,'presentaton','Annielle Madrid',0),(33,6,5,NULL,'in',300000.00,'fund_transfer_in',1431668405,NULL,'presentaton','Annielle Madrid',0),(34,6,NULL,32,'out',45000.00,'disbursement',1431668774,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(35,6,NULL,33,'out',150000.00,'disbursement',1431669653,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(36,6,1,34,'in',195000.00,'fund_transfer_in',1431669867,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(37,1,6,34,'out',195000.00,'fund_transfer_out',1431669867,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(38,5,2,NULL,'out',5000000.00,'fund_transfer_out',1431670095,NULL,' dgd fgdf gdfg dfg dfg dfg dfg','Annielle Madrid',0),(39,2,5,NULL,'in',5000000.00,'fund_transfer_in',1431670095,NULL,' dgd fgdf gdfg dfg dfg dfg dfg','Annielle Madrid',0),(40,2,NULL,NULL,'in',2000.00,'cash_on_hand',1431670181,'ashley','s df sdf sdf sdf sd f','Annielle Madrid',0),(41,3,NULL,NULL,'in',2000000.00,'cash_on_hand',1431670292,'mayet',' df dfg dfg dfg dfgfg','Annielle Madrid',0),(42,3,NULL,NULL,'in',1000000.00,'adjustment_in',1431670396,NULL,' sdfsdf sdf sdf sdf','Annielle Madrid',0),(43,3,NULL,NULL,'out',1000000.00,'adjustment_out',1431670454,NULL,' sdfs dfsdfsdf sdf sdf s df','Annielle Madrid',0),(44,6,NULL,33,'out',2580.00,'disbursement',1431917404,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(45,6,NULL,24,'out',2555.00,'disbursement',1431917751,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(46,6,NULL,14,'out',3456.78,'disbursement',1431917901,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(47,6,NULL,13,'out',5678.23,'disbursement',1431918049,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(48,6,NULL,36,'out',18365.25,'disbursement',1431993540,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(49,1,NULL,37,'out',34406.24,'disbursement',1431994211,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',0),(50,4,NULL,38,'out',37.44,'disbursement',1431994363,NULL,'Computer Generated - Disbursement Entry','Annielle Madrid',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `client` */

insert  into `client`(`client_id`,`user_id`,`client_name`,`client_surname`,`client_middle_name`,`client_address`,`client_address_abroad`,`option_client_address_id`,`client_city`,`client_zip`,`client_telephone`,`client_mobile`,`client_email`,`client_birthday`,`option_gender_id`,`client_birth_place`,`option_employment_id`,`option_civil_status_id`,`client_tin`,`client_sss`,`client_timestamp`) values (1,7,'Juan','Dela Cruz','Reyes','Blk 2 Lot 8 Kapitolyo Homes, Bagong Silang','55 ST. Beverly Hills, 90210','local','Pasig City','1600','8789943','09178320514','juan@yahoo.com',330280200,'male','Pasig','self_employed','single','100-100-100','1-111-111-1',1428557793),(2,7,'Jenny','Jabson','Sy','Blk 9 Lot 9 SM Homes','1355 ST. NSW, Sydney','local','Quezon City','1589','8759945','09175552321','jenny@yahoo.com',462643200,'female','Mindoro','employed','married','200-100-100','2-111-111-2',1428566293),(3,7,'','','','','','abroad','','','','','',0,'0','','0','0','','',1428632064),(4,7,'','','','','','abroad','','','','','',0,'0','','0','0','','',1428632189);

/*Table structure for table `client_account` */

DROP TABLE IF EXISTS `client_account`;

CREATE TABLE `client_account` (
  `client_account_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `lot_id` bigint(20) unsigned DEFAULT NULL,
  `commission_scheme_id` varchar(25) DEFAULT NULL,
  `commission_scheme_type` varchar(25) DEFAULT NULL,
  `commission_scheme_finance_type` varchar(25) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `client_account` */

insert  into `client_account`(`client_account_id`,`client_id`,`user_id`,`lot_id`,`commission_scheme_id`,`commission_scheme_type`,`commission_scheme_finance_type`,`option_unit_account_type_id`,`option_transaction_type_id`,`option_account_type_id`,`option_account_status_id`,`option_buyer_type_id`,`client_account_structure_id`,`client_account_number`,`client_account_is_vat`,`client_account_date_sale`,`client_account_discount`,`client_account_discount_amount`,`client_account_lcp`,`client_account_lcp_net`,`client_account_hcp`,`client_account_soil_poison`,`client_account_added_cost`,`client_account_added_cost_desc`,`client_account_tcp_net`,`client_account_misc_fee`,`client_account_reservation_paid`,`client_account_dp_percent`,`client_account_dp_amount`,`client_account_dp_net`,`client_account_dp_total`,`option_account_p1_id`,`client_account_dp_due_date`,`option_account_misc_id`,`client_account_misc_fee_monthly`,`client_account_dp_term`,`client_account_dp_monthly`,`client_account_dp_balance_collected_amount`,`client_account_dp_balance_remaining_amount`,`client_account_agent_commission_percent`,`client_account_agent_commission_amount`,`option_account_p2_id`,`network_id`,`network_division_id`,`agent_id`,`avp_id`,`sales_director_id`,`sales_manager_id`,`client_account_timestamp`) values (1,1,7,1,NULL,NULL,NULL,'package','regular','international','reservation','agent',1,'101-001-001-201',1,1427817600,20.00,288000.00,1440000.00,1152000.00,1500000.00,15000.00,10000.00,'',2677000.00,100000.00,10000.00,20.00,535400.00,525400.00,635400.00,'partial_dp',1429027200,'partial',3333.33,30,17513.33,0.00,0.00,2.00,53540.00,'1',0,0,1,NULL,NULL,NULL,1428557793);

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
  `client_account_agent_timestamp` bigint(15) unsigned DEFAULT NULL,
  `is_approved` tinyint(1) unsigned DEFAULT '0',
  `approve_date` bigint(15) unsigned DEFAULT NULL,
  `commission_id` varchar(10) DEFAULT NULL,
  `option_entry_type_id` varchar(15) DEFAULT 'single',
  PRIMARY KEY (`client_account_agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `client_account_agent` */

insert  into `client_account_agent`(`client_account_agent_id`,`client_account_id`,`agent_id`,`user_id`,`client_account_agent_commission_percent_current`,`client_account_agent_commission_amount_current`,`client_account_agent_commission_amount_net`,`client_account_agent_commission_tax_percent`,`client_account_agent_commission_tax_amount`,`client_account_agent_timestamp`,`is_approved`,`approve_date`,`commission_id`,`option_entry_type_id`) values (13,1,1,7,10.00,5354.00,4818.60,10.00,535.40,1428649990,0,NULL,'q1','consolidated'),(14,1,1,7,10.00,5354.00,4818.60,10.00,535.40,1428650122,0,NULL,'q2','consolidated'),(22,NULL,NULL,NULL,NULL,10708.00,NULL,NULL,1070.80,1431859806,0,NULL,NULL,'group');

/*Table structure for table `client_account_agent_consolidate` */

DROP TABLE IF EXISTS `client_account_agent_consolidate`;

CREATE TABLE `client_account_agent_consolidate` (
  `client_account_agent_consolidate_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `group_client_account_agent_id` bigint(15) DEFAULT NULL,
  `client_account_agent_id` bigint(15) DEFAULT NULL,
  PRIMARY KEY (`client_account_agent_consolidate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `client_account_agent_consolidate` */

insert  into `client_account_agent_consolidate`(`client_account_agent_consolidate_id`,`group_client_account_agent_id`,`client_account_agent_id`) values (13,22,13),(14,22,14);

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
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8;

/*Data for the table `client_account_invoice` */

insert  into `client_account_invoice`(`client_account_invoice_id`,`client_id`,`client_account_id`,`client_account_structure_id`,`client_account_invoice_number`,`client_account_invoice_is_late`,`option_invoice_status_id`,`option_account_invoice_type_id`,`client_account_invoice_recurr`,`client_account_invoice_recurr_count`,`client_account_invoice_balance_amount`,`client_account_invoice_amount`,`client_account_invoice_amount_collected`,`client_account_invoice_rebate_amount`,`client_account_invoice_rebate_amount_collected`,`client_account_invoice_principal_amount`,`client_account_invoice_principal_amount_collected`,`client_account_invoice_interest_amount`,`client_account_invoice_interest_amount_collected`,`client_account_invoice_surcharge_amount`,`client_account_invoice_surcharge_amount_collected`,`client_account_invoice_date_due_surcharge_reference`,`client_account_invoice_date_due_surcharge`,`client_account_invoice_date_due_rebate`,`client_account_invoice_date_due`,`client_account_invoice_date_paid`) values (1,1,1,1,1,0,'settled','monthly_dp',1,30,625400.00,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1429113600,0,1429027200,1428649747),(2,1,1,1,2,0,'settled','monthly_dp',1,30,604553.34,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1431705600,0,1431619200,1428649963),(3,1,1,1,3,0,'settled','monthly_dp',1,30,583706.68,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1434384000,0,1434297600,1428649963),(4,1,1,1,4,0,'settled','monthly_dp',1,30,562860.02,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1436976000,0,1436889600,1428649972),(5,1,1,1,5,0,'settled','monthly_dp',1,30,542013.36,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1439654400,0,1439568000,1428649972),(6,1,1,1,6,0,'settled','monthly_dp',1,30,521166.70,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1442332800,0,1442246400,1428649972),(7,1,1,1,7,0,'settled','monthly_dp',1,30,500320.04,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1444924800,0,1444838400,1428649972),(8,1,1,1,8,0,'settled','monthly_dp',1,30,479473.38,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1447603200,0,1447516800,1428649972),(9,1,1,1,9,0,'settled','monthly_dp',1,30,458626.72,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1450195200,0,1450108800,1428649979),(10,1,1,1,10,0,'settled','monthly_dp',1,30,437780.06,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1452873600,0,1452787200,1428649979),(11,1,1,1,11,0,'settled','monthly_dp',1,30,416933.40,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1455552000,0,1455465600,1428649979),(12,1,1,1,12,0,'settled','monthly_dp',1,30,396086.74,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1458057600,0,1457971200,1428649979),(13,1,1,1,13,0,'settled','monthly_dp',1,30,375240.08,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1460736000,0,1460649600,1428649989),(14,1,1,1,14,0,'settled','monthly_dp',1,30,354393.42,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1463328000,0,1463241600,1428649989),(15,1,1,1,15,0,'settled','monthly_dp',1,30,333546.76,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1466006400,0,1465920000,1428650108),(16,1,1,1,16,0,'settled','monthly_dp',1,30,312700.10,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1468598400,0,1468512000,1428650108),(17,1,1,1,17,0,'settled','monthly_dp',1,30,291853.44,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1471276800,0,1471190400,1428650108),(18,1,1,1,18,0,'settled','monthly_dp',1,30,271006.78,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1473955200,0,1473868800,1428650108),(19,1,1,1,19,0,'settled','monthly_dp',1,30,250160.12,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1476547200,0,1476460800,1428650108),(20,1,1,1,20,0,'settled','monthly_dp',1,30,229313.46,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1479225600,0,1479139200,1428650115),(21,1,1,1,21,0,'settled','monthly_dp',1,30,208466.80,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1481817600,0,1481731200,1428650115),(22,1,1,1,22,0,'settled','monthly_dp',1,30,187620.14,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1484496000,0,1484409600,1428650115),(23,1,1,1,23,0,'settled','monthly_dp',1,30,166773.48,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1487174400,0,1487088000,1428650115),(24,1,1,1,24,0,'settled','monthly_dp',1,30,145926.82,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1489593600,0,1489507200,1428650115),(25,1,1,1,25,0,'settled','monthly_dp',1,30,125080.16,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1492272000,0,1492185600,1428650122),(26,1,1,1,26,0,'settled','monthly_dp',1,30,104233.50,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1494864000,0,1494777600,1428650122),(27,1,1,1,27,0,'settled','monthly_dp',1,30,83386.84,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1497542400,0,1497456000,1428650122),(28,1,1,1,28,0,'settled','monthly_dp',1,30,62540.18,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1500134400,0,1500048000,1428650122),(29,1,1,1,29,0,'settled','monthly_dp',1,30,41693.52,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1502812800,0,1502726400,1428650122),(30,1,1,1,30,0,'settled','monthly_dp',1,30,20846.86,20846.66,0.00,0.00,0.00,20846.66,0.00,0.00,0.00,0.00,0.00,0,1505491200,0,1505404800,1429600531),(31,1,1,1,1,0,'pending','monthly_amortization',1,120,2141600.00,37221.00,0.00,1004.97,0.00,6881.67,0.00,30339.33,0.00,0.00,0.00,0,1508083200,1507824000,1507996800,1428631190),(32,1,1,1,2,0,'pending','monthly_amortization',1,120,2134718.33,37221.00,0.00,1004.97,0.00,6979.16,0.00,30241.84,0.00,0.00,0.00,0,1510761600,1510502400,1510675200,1428631190),(33,1,1,1,3,0,'pending','monthly_amortization',1,120,2127739.17,37221.00,0.00,1004.97,0.00,7078.03,0.00,30142.97,0.00,0.00,0.00,0,1513353600,1513094400,1513267200,1428631190),(34,1,1,1,4,0,'pending','monthly_amortization',1,120,2120661.14,37221.00,0.00,1004.97,0.00,7178.30,0.00,30042.70,0.00,0.00,0.00,0,1516032000,1515772800,1515945600,1428631190),(35,1,1,1,5,0,'pending','monthly_amortization',1,120,2113482.84,37221.00,0.00,1004.97,0.00,7279.99,0.00,29941.01,0.00,0.00,0.00,0,1518710400,1518451200,1518624000,1428631190),(36,1,1,1,6,0,'pending','monthly_amortization',1,120,2106202.85,37221.00,0.00,1004.97,0.00,7383.13,0.00,29837.87,0.00,0.00,0.00,0,1521129600,1520870400,1521043200,1428631198),(37,1,1,1,7,0,'pending','monthly_amortization',1,120,2098819.72,37221.00,0.00,1004.97,0.00,7487.72,0.00,29733.28,0.00,0.00,0.00,0,1523808000,1523548800,1523721600,1428631198),(38,1,1,1,8,0,'pending','monthly_amortization',1,120,2091332.00,37221.00,0.00,1004.97,0.00,7593.80,0.00,29627.20,0.00,0.00,0.00,0,1526400000,1526140800,1526313600,1428631198),(39,1,1,1,9,0,'pending','monthly_amortization',1,120,2083738.20,37221.00,0.00,1004.97,0.00,7701.38,0.00,29519.62,0.00,0.00,0.00,0,1529078400,1528819200,1528992000,1428631198),(40,1,1,1,10,0,'pending','monthly_amortization',1,120,2076036.82,37221.00,0.00,1004.97,0.00,7810.48,0.00,29410.52,0.00,0.00,0.00,0,1531670400,1531411200,1531584000,1428631198),(41,1,1,1,11,0,'pending','monthly_amortization',1,120,2068226.34,37221.00,0.00,1004.97,0.00,7921.13,0.00,29299.87,0.00,0.00,0.00,0,1534348800,1534089600,1534262400,1428631203),(42,1,1,1,12,0,'pending','monthly_amortization',1,120,2060305.21,37221.00,0.00,1004.97,0.00,8033.34,0.00,29187.66,0.00,0.00,0.00,0,1537027200,1536768000,1536940800,1428631203),(43,1,1,1,13,0,'pending','monthly_amortization',1,120,2052271.87,37221.00,0.00,1004.97,0.00,8147.15,0.00,29073.85,0.00,0.00,0.00,0,1539619200,1539360000,1539532800,1428631203),(44,1,1,1,14,0,'pending','monthly_amortization',1,120,2044124.72,37221.00,0.00,1004.97,0.00,8262.57,0.00,28958.43,0.00,0.00,0.00,0,1542297600,1542038400,1542211200,1428631203),(45,1,1,1,15,0,'pending','monthly_amortization',1,120,2035862.15,37221.00,0.00,1004.97,0.00,8379.62,0.00,28841.38,0.00,0.00,0.00,0,1544889600,1544630400,1544803200,1428631203),(46,1,1,1,16,0,'pending','monthly_amortization',1,120,2027482.53,37221.00,0.00,1004.97,0.00,8498.33,0.00,28722.67,0.00,0.00,0.00,0,1547568000,1547308800,1547481600,1428646260),(47,1,1,1,17,0,'pending','monthly_amortization',1,120,2018984.20,37221.00,0.00,1004.97,0.00,8618.72,0.00,28602.28,0.00,0.00,0.00,0,1550246400,1549987200,1550160000,1428646260),(48,1,1,1,18,0,'pending','monthly_amortization',1,120,2010365.48,37221.00,0.00,1004.97,0.00,8740.82,0.00,28480.18,0.00,0.00,0.00,0,1552665600,1552406400,1552579200,1428646328),(49,1,1,1,19,0,'pending','monthly_amortization',1,120,2001624.66,37221.00,0.00,1004.97,0.00,8864.65,0.00,28356.35,0.00,0.00,0.00,0,1555344000,1555084800,1555257600,1428646328),(50,1,1,1,20,0,'pending','monthly_amortization',1,120,1992760.01,37221.00,0.00,1004.97,0.00,8990.23,0.00,28230.77,0.00,0.00,0.00,0,1557936000,1557676800,1557849600,1428646498),(51,1,1,1,21,0,'pending','monthly_amortization',1,120,1983769.78,37221.00,0.00,1004.97,0.00,9117.59,0.00,28103.41,0.00,0.00,0.00,0,1560614400,1560355200,1560528000,1428646498),(52,1,1,1,22,0,'pending','monthly_amortization',1,120,1974652.19,37221.00,0.00,1004.97,0.00,9246.76,0.00,27974.24,0.00,0.00,0.00,0,1563206400,1562947200,1563120000,1428646586),(53,1,1,1,23,0,'pending','monthly_amortization',1,120,1965405.43,37221.00,0.00,1004.97,0.00,9377.76,0.00,27843.24,0.00,0.00,0.00,0,1565884800,1565625600,1565798400,1428646586),(54,1,1,1,24,0,'pending','monthly_amortization',1,120,1956027.67,37221.00,0.00,1004.97,0.00,9510.61,0.00,27710.39,0.00,0.00,0.00,0,1568563200,1568304000,1568476800,1428646622),(55,1,1,1,25,0,'pending','monthly_amortization',1,120,1946517.06,37221.00,0.00,1004.97,0.00,9645.34,0.00,27575.66,0.00,0.00,0.00,0,1571155200,1570896000,1571068800,1428646622),(56,1,1,1,26,0,'pending','monthly_amortization',1,120,1936871.72,37221.00,0.00,1004.97,0.00,9781.98,0.00,27439.02,0.00,0.00,0.00,0,1573833600,1573574400,1573747200,1428646826),(57,1,1,1,27,0,'pending','monthly_amortization',1,120,1927089.74,37221.00,0.00,1004.97,0.00,9920.56,0.00,27300.44,0.00,0.00,0.00,0,1576425600,1576166400,1576339200,1428646826),(58,1,1,1,28,0,'pending','monthly_amortization',1,120,1917169.18,37221.00,0.00,1004.97,0.00,10061.10,0.00,27159.90,0.00,0.00,0.00,0,1579104000,1578844800,1579017600,1428646842),(59,1,1,1,29,0,'pending','monthly_amortization',1,120,1907108.08,37221.00,0.00,1004.97,0.00,10203.64,0.00,27017.36,0.00,0.00,0.00,0,1581782400,1581523200,1581696000,1428646989),(60,1,1,1,30,0,'pending','monthly_amortization',1,120,1896904.44,37221.00,0.00,1004.97,0.00,10348.19,0.00,26872.81,0.00,0.00,0.00,0,1584288000,1584028800,1584201600,1428649192),(61,1,1,1,31,0,'pending','monthly_amortization',1,120,1886556.25,37221.00,0.00,1004.97,0.00,10494.79,0.00,26726.21,0.00,0.00,0.00,0,1586966400,1586707200,1586880000,1428649229),(62,1,1,1,32,0,'pending','monthly_amortization',1,120,1876061.46,37221.00,0.00,1004.97,0.00,10643.46,0.00,26577.54,0.00,0.00,0.00,0,1589558400,1589299200,1589472000,1428649229),(63,1,1,1,33,0,'pending','monthly_amortization',1,120,1865418.00,37221.00,0.00,1004.97,0.00,10794.25,0.00,26426.76,0.00,0.00,0.00,0,1592236800,1591977600,1592150400,1428649335),(64,1,1,1,34,0,'pending','monthly_amortization',1,120,1854623.76,37221.00,0.00,1004.97,0.00,10947.16,0.00,26273.84,0.00,0.00,0.00,0,1594828800,1594569600,1594742400,1428649408),(65,1,1,1,35,0,'pending','monthly_amortization',1,120,1843676.60,37221.00,0.00,1004.97,0.00,11102.25,0.00,26118.75,0.00,0.00,0.00,0,1597507200,1597248000,1597420800,1428649425),(66,1,1,1,36,0,'pending','monthly_amortization',1,120,1832574.35,37221.00,0.00,1004.97,0.00,11259.53,0.00,25961.47,0.00,0.00,0.00,0,1600185600,1599926400,1600099200,1428649449),(67,1,1,1,37,0,'pending','monthly_amortization',1,120,1821314.82,37221.00,0.00,1004.97,0.00,11419.04,0.00,25801.96,0.00,0.00,0.00,0,1602777600,1602518400,1602691200,1428649525),(68,1,1,1,38,0,'pending','monthly_amortization',1,120,1809895.78,37221.00,0.00,1004.97,0.00,11580.81,0.00,25640.19,0.00,0.00,0.00,0,1605456000,1605196800,1605369600,1428649545),(69,1,1,1,39,0,'pending','monthly_amortization',1,120,1798314.97,37221.00,0.00,1004.97,0.00,11744.87,0.00,25476.13,0.00,0.00,0.00,0,1608048000,1607788800,1607961600,0),(70,1,1,1,40,0,'pending','monthly_amortization',1,120,1786570.10,37221.00,0.00,1004.97,0.00,11911.26,0.00,25309.74,0.00,0.00,0.00,0,1610726400,1610467200,1610640000,0),(71,1,1,1,41,0,'pending','monthly_amortization',1,120,1774658.84,37221.00,0.00,1004.97,0.00,12080.00,0.00,25141.00,0.00,0.00,0.00,0,1613404800,1613145600,1613318400,0),(72,1,1,1,42,0,'pending','monthly_amortization',1,120,1762578.84,37221.00,0.00,1004.97,0.00,12251.13,0.00,24969.87,0.00,0.00,0.00,0,1615824000,1615564800,1615737600,0),(73,1,1,1,43,0,'pending','monthly_amortization',1,120,1750327.71,37221.00,0.00,1004.97,0.00,12424.69,0.00,24796.31,0.00,0.00,0.00,0,1618502400,1618243200,1618416000,0),(74,1,1,1,44,0,'pending','monthly_amortization',1,120,1737903.02,37221.00,0.00,1004.97,0.00,12600.71,0.00,24620.29,0.00,0.00,0.00,0,1621094400,1620835200,1621008000,0),(75,1,1,1,45,0,'pending','monthly_amortization',1,120,1725302.31,37221.00,0.00,1004.97,0.00,12779.22,0.00,24441.78,0.00,0.00,0.00,0,1623772800,1623513600,1623686400,0),(76,1,1,1,46,0,'pending','monthly_amortization',1,120,1712523.09,37221.00,0.00,1004.97,0.00,12960.26,0.00,24260.74,0.00,0.00,0.00,0,1626364800,1626105600,1626278400,0),(77,1,1,1,47,0,'pending','monthly_amortization',1,120,1699562.83,37221.00,0.00,1004.97,0.00,13143.86,0.00,24077.14,0.00,0.00,0.00,0,1629043200,1628784000,1628956800,0),(78,1,1,1,48,0,'pending','monthly_amortization',1,120,1686418.97,37221.00,0.00,1004.97,0.00,13330.06,0.00,23890.94,0.00,0.00,0.00,0,1631721600,1631462400,1631635200,0),(79,1,1,1,49,0,'pending','monthly_amortization',1,120,1673088.91,37221.00,0.00,1004.97,0.00,13518.91,0.00,23702.09,0.00,0.00,0.00,0,1634313600,1634054400,1634227200,0),(80,1,1,1,50,0,'pending','monthly_amortization',1,120,1659570.00,37221.00,0.00,1004.97,0.00,13710.43,0.00,23510.58,0.00,0.00,0.00,0,1636992000,1636732800,1636905600,0),(81,1,1,1,51,0,'pending','monthly_amortization',1,120,1645859.58,37221.00,0.00,1004.97,0.00,13904.66,0.00,23316.34,0.00,0.00,0.00,0,1639584000,1639324800,1639497600,0),(82,1,1,1,52,0,'pending','monthly_amortization',1,120,1631954.92,37221.00,0.00,1004.97,0.00,14101.64,0.00,23119.36,0.00,0.00,0.00,0,1642262400,1642003200,1642176000,0),(83,1,1,1,53,0,'pending','monthly_amortization',1,120,1617853.28,37221.00,0.00,1004.97,0.00,14301.41,0.00,22919.59,0.00,0.00,0.00,0,1644940800,1644681600,1644854400,0),(84,1,1,1,54,0,'pending','monthly_amortization',1,120,1603551.87,37221.00,0.00,1004.97,0.00,14504.02,0.00,22716.98,0.00,0.00,0.00,0,1647360000,1647100800,1647273600,0),(85,1,1,1,55,0,'pending','monthly_amortization',1,120,1589047.85,37221.00,0.00,1004.97,0.00,14709.49,0.00,22511.51,0.00,0.00,0.00,0,1650038400,1649779200,1649952000,0),(86,1,1,1,56,0,'pending','monthly_amortization',1,120,1574338.36,37221.00,0.00,1004.97,0.00,14917.87,0.00,22303.13,0.00,0.00,0.00,0,1652630400,1652371200,1652544000,0),(87,1,1,1,57,0,'pending','monthly_amortization',1,120,1559420.49,37221.00,0.00,1004.97,0.00,15129.21,0.00,22091.79,0.00,0.00,0.00,0,1655308800,1655049600,1655222400,0),(88,1,1,1,58,0,'pending','monthly_amortization',1,120,1544291.28,37221.00,0.00,1004.97,0.00,15343.54,0.00,21877.46,0.00,0.00,0.00,0,1657900800,1657641600,1657814400,0),(89,1,1,1,59,0,'pending','monthly_amortization',1,120,1528947.74,37221.00,0.00,1004.97,0.00,15560.91,0.00,21660.09,0.00,0.00,0.00,0,1660579200,1660320000,1660492800,0),(90,1,1,1,60,0,'pending','monthly_amortization',1,120,1513386.83,37221.00,0.00,1004.97,0.00,15781.35,0.00,21439.65,0.00,0.00,0.00,0,1663257600,1662998400,1663171200,0),(91,1,1,1,61,0,'pending','monthly_amortization',1,120,1497605.48,37221.00,0.00,1004.97,0.00,16004.92,0.00,21216.08,0.00,0.00,0.00,0,1665849600,1665590400,1665763200,0),(92,1,1,1,62,0,'pending','monthly_amortization',1,120,1481600.56,37221.00,0.00,1004.97,0.00,16231.66,0.00,20989.34,0.00,0.00,0.00,0,1668528000,1668268800,1668441600,0),(93,1,1,1,63,0,'pending','monthly_amortization',1,120,1465368.90,37221.00,0.00,1004.97,0.00,16461.61,0.00,20759.39,0.00,0.00,0.00,0,1671120000,1670860800,1671033600,0),(94,1,1,1,64,0,'pending','monthly_amortization',1,120,1448907.29,37221.00,0.00,1004.97,0.00,16694.81,0.00,20526.19,0.00,0.00,0.00,0,1673798400,1673539200,1673712000,0),(95,1,1,1,65,0,'pending','monthly_amortization',1,120,1432212.48,37221.00,0.00,1004.97,0.00,16931.32,0.00,20289.68,0.00,0.00,0.00,0,1676476800,1676217600,1676390400,0),(96,1,1,1,66,0,'pending','monthly_amortization',1,120,1415281.16,37221.00,0.00,1004.97,0.00,17171.18,0.00,20049.82,0.00,0.00,0.00,0,1678896000,1678636800,1678809600,0),(97,1,1,1,67,0,'pending','monthly_amortization',1,120,1398109.98,37221.00,0.00,1004.97,0.00,17414.44,0.00,19806.56,0.00,0.00,0.00,0,1681574400,1681315200,1681488000,0),(98,1,1,1,68,0,'pending','monthly_amortization',1,120,1380695.54,37221.00,0.00,1004.97,0.00,17661.15,0.00,19559.85,0.00,0.00,0.00,0,1684166400,1683907200,1684080000,0),(99,1,1,1,69,0,'pending','monthly_amortization',1,120,1363034.39,37221.00,0.00,1004.97,0.00,17911.35,0.00,19309.65,0.00,0.00,0.00,0,1686844800,1686585600,1686758400,0),(100,1,1,1,70,0,'pending','monthly_amortization',1,120,1345123.04,37221.00,0.00,1004.97,0.00,18165.09,0.00,19055.91,0.00,0.00,0.00,0,1689436800,1689177600,1689350400,0),(101,1,1,1,71,0,'pending','monthly_amortization',1,120,1326957.95,37221.00,0.00,1004.97,0.00,18422.43,0.00,18798.57,0.00,0.00,0.00,0,1692115200,1691856000,1692028800,0),(102,1,1,1,72,0,'pending','monthly_amortization',1,120,1308535.52,37221.00,0.00,1004.97,0.00,18683.41,0.00,18537.59,0.00,0.00,0.00,0,1694793600,1694534400,1694707200,0),(103,1,1,1,73,0,'pending','monthly_amortization',1,120,1289852.11,37221.00,0.00,1004.97,0.00,18948.10,0.00,18272.90,0.00,0.00,0.00,0,1697385600,1697126400,1697299200,0),(104,1,1,1,74,0,'pending','monthly_amortization',1,120,1270904.01,37221.00,0.00,1004.97,0.00,19216.53,0.00,18004.47,0.00,0.00,0.00,0,1700064000,1699804800,1699977600,0),(105,1,1,1,75,0,'pending','monthly_amortization',1,120,1251687.48,37221.00,0.00,1004.97,0.00,19488.76,0.00,17732.24,0.00,0.00,0.00,0,1702656000,1702396800,1702569600,0),(106,1,1,1,76,0,'pending','monthly_amortization',1,120,1232198.72,37221.00,0.00,1004.97,0.00,19764.85,0.00,17456.15,0.00,0.00,0.00,0,1705334400,1705075200,1705248000,0),(107,1,1,1,77,0,'pending','monthly_amortization',1,120,1212433.87,37221.00,0.00,1004.97,0.00,20044.85,0.00,17176.15,0.00,0.00,0.00,0,1708012800,1707753600,1707926400,0),(108,1,1,1,78,0,'pending','monthly_amortization',1,120,1192389.02,37221.00,0.00,1004.97,0.00,20328.82,0.00,16892.18,0.00,0.00,0.00,0,1710518400,1710259200,1710432000,0),(109,1,1,1,79,0,'pending','monthly_amortization',1,120,1172060.20,37221.00,0.00,1004.97,0.00,20616.81,0.00,16604.19,0.00,0.00,0.00,0,1713196800,1712937600,1713110400,0),(110,1,1,1,80,0,'pending','monthly_amortization',1,120,1151443.39,37221.00,0.00,1004.97,0.00,20908.89,0.00,16312.11,0.00,0.00,0.00,0,1715788800,1715529600,1715702400,0),(111,1,1,1,81,0,'pending','monthly_amortization',1,120,1130534.50,37221.00,0.00,1004.97,0.00,21205.09,0.00,16015.91,0.00,0.00,0.00,0,1718467200,1718208000,1718380800,0),(112,1,1,1,82,0,'pending','monthly_amortization',1,120,1109329.41,37221.00,0.00,1004.97,0.00,21505.50,0.00,15715.50,0.00,0.00,0.00,0,1721059200,1720800000,1720972800,0),(113,1,1,1,83,0,'pending','monthly_amortization',1,120,1087823.91,37221.00,0.00,1004.97,0.00,21810.16,0.00,15410.84,0.00,0.00,0.00,0,1723737600,1723478400,1723651200,0),(114,1,1,1,84,0,'pending','monthly_amortization',1,120,1066013.75,37221.00,0.00,1004.97,0.00,22119.14,0.00,15101.86,0.00,0.00,0.00,0,1726416000,1726156800,1726329600,0),(115,1,1,1,85,0,'pending','monthly_amortization',1,120,1043894.61,37221.00,0.00,1004.97,0.00,22432.49,0.00,14788.51,0.00,0.00,0.00,0,1729008000,1728748800,1728921600,0),(116,1,1,1,86,0,'pending','monthly_amortization',1,120,1021462.12,37221.00,0.00,1004.97,0.00,22750.29,0.00,14470.71,0.00,0.00,0.00,0,1731686400,1731427200,1731600000,0),(117,1,1,1,87,0,'pending','monthly_amortization',1,120,998711.83,37221.00,0.00,1004.97,0.00,23072.58,0.00,14148.42,0.00,0.00,0.00,0,1734278400,1734019200,1734192000,0),(118,1,1,1,88,0,'pending','monthly_amortization',1,120,975639.25,37221.00,0.00,1004.97,0.00,23399.44,0.00,13821.56,0.00,0.00,0.00,0,1736956800,1736697600,1736870400,0),(119,1,1,1,89,0,'pending','monthly_amortization',1,120,952239.81,37221.00,0.00,1004.97,0.00,23730.94,0.00,13490.06,0.00,0.00,0.00,0,1739635200,1739376000,1739548800,0),(120,1,1,1,90,0,'pending','monthly_amortization',1,120,928508.87,37221.00,0.00,1004.97,0.00,24067.12,0.00,13153.88,0.00,0.00,0.00,0,1742054400,1741795200,1741968000,0),(121,1,1,1,91,0,'pending','monthly_amortization',1,120,904441.75,37221.00,0.00,1004.97,0.00,24408.08,0.00,12812.92,0.00,0.00,0.00,0,1744732800,1744473600,1744646400,0),(122,1,1,1,92,0,'pending','monthly_amortization',1,120,880033.67,37221.00,0.00,1004.97,0.00,24753.86,0.00,12467.14,0.00,0.00,0.00,0,1747324800,1747065600,1747238400,0),(123,1,1,1,93,0,'pending','monthly_amortization',1,120,855279.81,37221.00,0.00,1004.97,0.00,25104.54,0.00,12116.46,0.00,0.00,0.00,0,1750003200,1749744000,1749916800,0),(124,1,1,1,94,0,'pending','monthly_amortization',1,120,830175.27,37221.00,0.00,1004.97,0.00,25460.18,0.00,11760.82,0.00,0.00,0.00,0,1752595200,1752336000,1752508800,0),(125,1,1,1,95,0,'pending','monthly_amortization',1,120,804715.09,37221.00,0.00,1004.97,0.00,25820.87,0.00,11400.13,0.00,0.00,0.00,0,1755273600,1755014400,1755187200,0),(126,1,1,1,96,0,'pending','monthly_amortization',1,120,778894.22,37221.00,0.00,1004.97,0.00,26186.67,0.00,11034.33,0.00,0.00,0.00,0,1757952000,1757692800,1757865600,0),(127,1,1,1,97,0,'pending','monthly_amortization',1,120,752707.55,37221.00,0.00,1004.97,0.00,26557.64,0.00,10663.36,0.00,0.00,0.00,0,1760544000,1760284800,1760457600,0),(128,1,1,1,98,0,'pending','monthly_amortization',1,120,726149.91,37221.00,0.00,1004.97,0.00,26933.88,0.00,10287.12,0.00,0.00,0.00,0,1763222400,1762963200,1763136000,0),(129,1,1,1,99,0,'pending','monthly_amortization',1,120,699216.03,37221.00,0.00,1004.97,0.00,27315.44,0.00,9905.56,0.00,0.00,0.00,0,1765814400,1765555200,1765728000,0),(130,1,1,1,100,0,'pending','monthly_amortization',1,120,671900.59,37221.00,0.00,1004.97,0.00,27702.41,0.00,9518.59,0.00,0.00,0.00,0,1768492800,1768233600,1768406400,0),(131,1,1,1,101,0,'pending','monthly_amortization',1,120,644198.18,37221.00,0.00,1004.97,0.00,28094.86,0.00,9126.14,0.00,0.00,0.00,0,1771171200,1770912000,1771084800,0),(132,1,1,1,102,0,'pending','monthly_amortization',1,120,616103.32,37221.00,0.00,1004.97,0.00,28492.87,0.00,8728.13,0.00,0.00,0.00,0,1773590400,1773331200,1773504000,0),(133,1,1,1,103,0,'pending','monthly_amortization',1,120,587610.45,37221.00,0.00,1004.97,0.00,28896.52,0.00,8324.48,0.00,0.00,0.00,0,1776268800,1776009600,1776182400,0),(134,1,1,1,104,0,'pending','monthly_amortization',1,120,558713.93,37221.00,0.00,1004.97,0.00,29305.89,0.00,7915.11,0.00,0.00,0.00,0,1778860800,1778601600,1778774400,0),(135,1,1,1,105,0,'pending','monthly_amortization',1,120,529408.04,37221.00,0.00,1004.97,0.00,29721.05,0.00,7499.95,0.00,0.00,0.00,0,1781539200,1781280000,1781452800,0),(136,1,1,1,106,0,'pending','monthly_amortization',1,120,499686.99,37221.00,0.00,1004.97,0.00,30142.10,0.00,7078.90,0.00,0.00,0.00,0,1784131200,1783872000,1784044800,0),(137,1,1,1,107,0,'pending','monthly_amortization',1,120,469544.89,37221.00,0.00,1004.97,0.00,30569.11,0.00,6651.89,0.00,0.00,0.00,0,1786809600,1786550400,1786723200,0),(138,1,1,1,108,0,'pending','monthly_amortization',1,120,438975.78,37221.00,0.00,1004.97,0.00,31002.18,0.00,6218.82,0.00,0.00,0.00,0,1789488000,1789228800,1789401600,0),(139,1,1,1,109,0,'pending','monthly_amortization',1,120,407973.60,37221.00,0.00,1004.97,0.00,31441.37,0.00,5779.63,0.00,0.00,0.00,0,1792080000,1791820800,1791993600,0),(140,1,1,1,110,0,'pending','monthly_amortization',1,120,376532.23,37221.00,0.00,1004.97,0.00,31886.79,0.00,5334.21,0.00,0.00,0.00,0,1794758400,1794499200,1794672000,0),(141,1,1,1,111,0,'pending','monthly_amortization',1,120,344645.44,37221.00,0.00,1004.97,0.00,32338.52,0.00,4882.48,0.00,0.00,0.00,0,1797350400,1797091200,1797264000,0),(142,1,1,1,112,0,'pending','monthly_amortization',1,120,312306.92,37221.00,0.00,1004.97,0.00,32796.65,0.00,4424.35,0.00,0.00,0.00,0,1800028800,1799769600,1799942400,0),(143,1,1,1,113,0,'pending','monthly_amortization',1,120,279510.27,37221.00,0.00,1004.97,0.00,33261.27,0.00,3959.73,0.00,0.00,0.00,0,1802707200,1802448000,1802620800,0),(144,1,1,1,114,0,'pending','monthly_amortization',1,120,246249.00,37221.00,0.00,1004.97,0.00,33732.47,0.00,3488.53,0.00,0.00,0.00,0,1805126400,1804867200,1805040000,0),(145,1,1,1,115,0,'pending','monthly_amortization',1,120,212516.53,37221.00,0.00,1004.97,0.00,34210.35,0.00,3010.65,0.00,0.00,0.00,0,1807804800,1807545600,1807718400,0),(146,1,1,1,116,0,'pending','monthly_amortization',1,120,178306.18,37221.00,0.00,1004.97,0.00,34695.00,0.00,2526.00,0.00,0.00,0.00,0,1810396800,1810137600,1810310400,0),(147,1,1,1,117,0,'pending','monthly_amortization',1,120,143611.18,37221.00,0.00,1004.97,0.00,35186.51,0.00,2034.49,0.00,0.00,0.00,0,1813075200,1812816000,1812988800,0),(148,1,1,1,118,0,'pending','monthly_amortization',1,120,108424.67,37221.00,0.00,1004.97,0.00,35684.98,0.00,1536.02,0.00,0.00,0.00,0,1815667200,1815408000,1815580800,0),(149,1,1,1,119,0,'pending','monthly_amortization',1,120,72739.69,37221.00,0.00,1004.97,0.00,36190.52,0.00,1030.48,0.00,0.00,0.00,0,1818345600,1818086400,1818259200,0),(150,1,1,1,120,0,'pending','monthly_amortization',1,120,36549.17,37066.95,0.00,1000.81,0.00,36549.17,0.00,517.78,0.00,0.00,0.00,0,1821024000,1820764800,1820937600,0),(151,2,2,2,1,0,'pending','monthly_dp',1,30,506000.00,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,86400,0,0,1428631422),(152,2,2,2,2,0,'pending','monthly_dp',1,30,489133.33,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,2764800,0,2678400,1428631422),(153,2,2,2,3,0,'pending','monthly_dp',1,30,472266.66,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,5184000,0,5097600,1428631422),(154,2,2,2,4,0,'pending','monthly_dp',1,30,455399.99,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,7862400,0,7776000,1428631422),(155,2,2,2,5,0,'pending','monthly_dp',1,30,438533.32,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,10454400,0,10368000,1428631422),(156,2,2,2,6,0,'pending','monthly_dp',1,30,421666.65,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,13132800,0,13046400,1428631430),(157,2,2,2,7,0,'pending','monthly_dp',1,30,404799.98,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,15724800,0,15638400,1428631430),(158,2,2,2,8,0,'pending','monthly_dp',1,30,387933.31,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,18403200,0,18316800,1428631430),(159,2,2,2,9,0,'pending','monthly_dp',1,30,371066.64,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,21081600,0,20995200,1428631430),(160,2,2,2,10,0,'pending','monthly_dp',1,30,354199.97,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,23673600,0,23587200,1428631430),(161,2,2,2,11,0,'pending','monthly_dp',1,30,337333.30,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,26352000,0,26265600,0),(162,2,2,2,12,0,'pending','monthly_dp',1,30,320466.63,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,28944000,0,28857600,0),(163,2,2,2,13,0,'pending','monthly_dp',1,30,303599.96,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,31622400,0,31536000,0),(164,2,2,2,14,0,'pending','monthly_dp',1,30,286733.29,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,34300800,0,34214400,0),(165,2,2,2,15,0,'pending','monthly_dp',1,30,269866.62,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,36720000,0,36633600,0),(166,2,2,2,16,0,'pending','monthly_dp',1,30,252999.95,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,39398400,0,39312000,0),(167,2,2,2,17,0,'pending','monthly_dp',1,30,236133.28,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,41990400,0,41904000,0),(168,2,2,2,18,0,'pending','monthly_dp',1,30,219266.61,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,44668800,0,44582400,0),(169,2,2,2,19,0,'pending','monthly_dp',1,30,202399.94,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,47260800,0,47174400,0),(170,2,2,2,20,0,'pending','monthly_dp',1,30,185533.27,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,49939200,0,49852800,0),(171,2,2,2,21,0,'pending','monthly_dp',1,30,168666.60,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,52617600,0,52531200,0),(172,2,2,2,22,0,'pending','monthly_dp',1,30,151799.93,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,55209600,0,55123200,0),(173,2,2,2,23,0,'pending','monthly_dp',1,30,134933.26,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,57888000,0,57801600,0),(174,2,2,2,24,0,'pending','monthly_dp',1,30,118066.59,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,60480000,0,60393600,0),(175,2,2,2,25,0,'pending','monthly_dp',1,30,101199.92,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,63158400,0,63072000,0),(176,2,2,2,26,0,'pending','monthly_dp',1,30,84333.25,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,65836800,0,65750400,0),(177,2,2,2,27,0,'pending','monthly_dp',1,30,67466.58,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,68342400,0,68256000,0),(178,2,2,2,28,0,'pending','monthly_dp',1,30,50599.91,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,71020800,0,70934400,0),(179,2,2,2,29,0,'pending','monthly_dp',1,30,33733.24,16866.67,0.00,0.00,0.00,16866.67,0.00,0.00,0.00,0.00,0.00,0,73612800,0,73526400,0),(180,2,2,2,30,0,'pending','monthly_dp',1,30,16866.57,16866.57,0.00,0.00,0.00,16866.57,0.00,0.00,0.00,0.00,0.00,0,76291200,0,76204800,0),(181,2,2,2,1,0,'pending','monthly_amortization',1,60,1204000.00,28644.00,0.00,773.39,0.00,13594.00,0.00,15050.00,0.00,0.00,0.00,0,1508947200,1508688000,1508860800,0),(182,2,2,2,2,0,'pending','monthly_amortization',1,60,1190406.00,28644.00,0.00,773.39,0.00,13763.93,0.00,14880.08,0.00,0.00,0.00,0,1511625600,1511366400,1511539200,0),(183,2,2,2,3,0,'pending','monthly_amortization',1,60,1176642.08,28644.00,0.00,773.39,0.00,13935.97,0.00,14708.03,0.00,0.00,0.00,0,1514217600,1513958400,1514131200,0),(184,2,2,2,4,0,'pending','monthly_amortization',1,60,1162706.11,28644.00,0.00,773.39,0.00,14110.17,0.00,14533.83,0.00,0.00,0.00,0,1516896000,1516636800,1516809600,0),(185,2,2,2,5,0,'pending','monthly_amortization',1,60,1148595.94,28644.00,0.00,773.39,0.00,14286.55,0.00,14357.45,0.00,0.00,0.00,0,1519574400,1519315200,1519488000,0),(186,2,2,2,6,0,'pending','monthly_amortization',1,60,1134309.39,28644.00,0.00,773.39,0.00,14465.13,0.00,14178.87,0.00,0.00,0.00,0,1521993600,1521734400,1521907200,0),(187,2,2,2,7,0,'pending','monthly_amortization',1,60,1119844.26,28644.00,0.00,773.39,0.00,14645.95,0.00,13998.05,0.00,0.00,0.00,0,1524672000,1524412800,1524585600,0),(188,2,2,2,8,0,'pending','monthly_amortization',1,60,1105198.31,28644.00,0.00,773.39,0.00,14829.02,0.00,13814.98,0.00,0.00,0.00,0,1527264000,1527004800,1527177600,0),(189,2,2,2,9,0,'pending','monthly_amortization',1,60,1090369.29,28644.00,0.00,773.39,0.00,15014.38,0.00,13629.62,0.00,0.00,0.00,0,1529942400,1529683200,1529856000,0),(190,2,2,2,10,0,'pending','monthly_amortization',1,60,1075354.91,28644.00,0.00,773.39,0.00,15202.06,0.00,13441.94,0.00,0.00,0.00,0,1532534400,1532275200,1532448000,0),(191,2,2,2,11,0,'pending','monthly_amortization',1,60,1060152.85,28644.00,0.00,773.39,0.00,15392.09,0.00,13251.91,0.00,0.00,0.00,0,1535212800,1534953600,1535126400,0),(192,2,2,2,12,0,'pending','monthly_amortization',1,60,1044760.76,28644.00,0.00,773.39,0.00,15584.49,0.00,13059.51,0.00,0.00,0.00,0,1537891200,1537632000,1537804800,0),(193,2,2,2,13,0,'pending','monthly_amortization',1,60,1029176.27,28644.00,0.00,773.39,0.00,15779.30,0.00,12864.70,0.00,0.00,0.00,0,1540483200,1540224000,1540396800,0),(194,2,2,2,14,0,'pending','monthly_amortization',1,60,1013396.97,28644.00,0.00,773.39,0.00,15976.54,0.00,12667.46,0.00,0.00,0.00,0,1543161600,1542902400,1543075200,0),(195,2,2,2,15,0,'pending','monthly_amortization',1,60,997420.43,28644.00,0.00,773.39,0.00,16176.24,0.00,12467.76,0.00,0.00,0.00,0,1545753600,1545494400,1545667200,0),(196,2,2,2,16,0,'pending','monthly_amortization',1,60,981244.19,28644.00,0.00,773.39,0.00,16378.45,0.00,12265.55,0.00,0.00,0.00,0,1548432000,1548172800,1548345600,0),(197,2,2,2,17,0,'pending','monthly_amortization',1,60,964865.74,28644.00,0.00,773.39,0.00,16583.18,0.00,12060.82,0.00,0.00,0.00,0,1551110400,1550851200,1551024000,0),(198,2,2,2,18,0,'pending','monthly_amortization',1,60,948282.56,28644.00,0.00,773.39,0.00,16790.47,0.00,11853.53,0.00,0.00,0.00,0,1553529600,1553270400,1553443200,0),(199,2,2,2,19,0,'pending','monthly_amortization',1,60,931492.09,28644.00,0.00,773.39,0.00,17000.35,0.00,11643.65,0.00,0.00,0.00,0,1556208000,1555948800,1556121600,0),(200,2,2,2,20,0,'pending','monthly_amortization',1,60,914491.74,28644.00,0.00,773.39,0.00,17212.85,0.00,11431.15,0.00,0.00,0.00,0,1558800000,1558540800,1558713600,0),(201,2,2,2,21,0,'pending','monthly_amortization',1,60,897278.89,28644.00,0.00,773.39,0.00,17428.01,0.00,11215.99,0.00,0.00,0.00,0,1561478400,1561219200,1561392000,0),(202,2,2,2,22,0,'pending','monthly_amortization',1,60,879850.88,28644.00,0.00,773.39,0.00,17645.86,0.00,10998.14,0.00,0.00,0.00,0,1564070400,1563811200,1563984000,0),(203,2,2,2,23,0,'pending','monthly_amortization',1,60,862205.02,28644.00,0.00,773.39,0.00,17866.44,0.00,10777.56,0.00,0.00,0.00,0,1566748800,1566489600,1566662400,0),(204,2,2,2,24,0,'pending','monthly_amortization',1,60,844338.58,28644.00,0.00,773.39,0.00,18089.77,0.00,10554.23,0.00,0.00,0.00,0,1569427200,1569168000,1569340800,0),(205,2,2,2,25,0,'pending','monthly_amortization',1,60,826248.81,28644.00,0.00,773.39,0.00,18315.89,0.00,10328.11,0.00,0.00,0.00,0,1572019200,1571760000,1571932800,0),(206,2,2,2,26,0,'pending','monthly_amortization',1,60,807932.92,28644.00,0.00,773.39,0.00,18544.84,0.00,10099.16,0.00,0.00,0.00,0,1574697600,1574438400,1574611200,0),(207,2,2,2,27,0,'pending','monthly_amortization',1,60,789388.08,28644.00,0.00,773.39,0.00,18776.65,0.00,9867.35,0.00,0.00,0.00,0,1577289600,1577030400,1577203200,0),(208,2,2,2,28,0,'pending','monthly_amortization',1,60,770611.43,28644.00,0.00,773.39,0.00,19011.36,0.00,9632.64,0.00,0.00,0.00,0,1579968000,1579708800,1579881600,0),(209,2,2,2,29,0,'pending','monthly_amortization',1,60,751600.07,28644.00,0.00,773.39,0.00,19249.00,0.00,9395.00,0.00,0.00,0.00,0,1582646400,1582387200,1582560000,0),(210,2,2,2,30,0,'pending','monthly_amortization',1,60,732351.07,28644.00,0.00,773.39,0.00,19489.61,0.00,9154.39,0.00,0.00,0.00,0,1585152000,1584892800,1585065600,0),(211,2,2,2,31,0,'pending','monthly_amortization',1,60,712861.46,28644.00,0.00,773.39,0.00,19733.23,0.00,8910.77,0.00,0.00,0.00,0,1587830400,1587571200,1587744000,0),(212,2,2,2,32,0,'pending','monthly_amortization',1,60,693128.23,28644.00,0.00,773.39,0.00,19979.90,0.00,8664.10,0.00,0.00,0.00,0,1590422400,1590163200,1590336000,0),(213,2,2,2,33,0,'pending','monthly_amortization',1,60,673148.33,28644.00,0.00,773.39,0.00,20229.65,0.00,8414.35,0.00,0.00,0.00,0,1593100800,1592841600,1593014400,0),(214,2,2,2,34,0,'pending','monthly_amortization',1,60,652918.68,28644.00,0.00,773.39,0.00,20482.52,0.00,8161.48,0.00,0.00,0.00,0,1595692800,1595433600,1595606400,0),(215,2,2,2,35,0,'pending','monthly_amortization',1,60,632436.16,28644.00,0.00,773.39,0.00,20738.55,0.00,7905.45,0.00,0.00,0.00,0,1598371200,1598112000,1598284800,0),(216,2,2,2,36,0,'pending','monthly_amortization',1,60,611697.61,28644.00,0.00,773.39,0.00,20997.78,0.00,7646.22,0.00,0.00,0.00,0,1601049600,1600790400,1600963200,0),(217,2,2,2,37,0,'pending','monthly_amortization',1,60,590699.83,28644.00,0.00,773.39,0.00,21260.25,0.00,7383.75,0.00,0.00,0.00,0,1603641600,1603382400,1603555200,0),(218,2,2,2,38,0,'pending','monthly_amortization',1,60,569439.58,28644.00,0.00,773.39,0.00,21526.01,0.00,7117.99,0.00,0.00,0.00,0,1606320000,1606060800,1606233600,0),(219,2,2,2,39,0,'pending','monthly_amortization',1,60,547913.57,28644.00,0.00,773.39,0.00,21795.08,0.00,6848.92,0.00,0.00,0.00,0,1608912000,1608652800,1608825600,0),(220,2,2,2,40,0,'pending','monthly_amortization',1,60,526118.49,28644.00,0.00,773.39,0.00,22067.52,0.00,6576.48,0.00,0.00,0.00,0,1611590400,1611331200,1611504000,0),(221,2,2,2,41,0,'pending','monthly_amortization',1,60,504050.97,28644.00,0.00,773.39,0.00,22343.36,0.00,6300.64,0.00,0.00,0.00,0,1614268800,1614009600,1614182400,0),(222,2,2,2,42,0,'pending','monthly_amortization',1,60,481707.61,28644.00,0.00,773.39,0.00,22622.65,0.00,6021.35,0.00,0.00,0.00,0,1616688000,1616428800,1616601600,0),(223,2,2,2,43,0,'pending','monthly_amortization',1,60,459084.96,28644.00,0.00,773.39,0.00,22905.44,0.00,5738.56,0.00,0.00,0.00,0,1619366400,1619107200,1619280000,0),(224,2,2,2,44,0,'pending','monthly_amortization',1,60,436179.52,28644.00,0.00,773.39,0.00,23191.76,0.00,5452.24,0.00,0.00,0.00,0,1621958400,1621699200,1621872000,0),(225,2,2,2,45,0,'pending','monthly_amortization',1,60,412987.76,28644.00,0.00,773.39,0.00,23481.65,0.00,5162.35,0.00,0.00,0.00,0,1624636800,1624377600,1624550400,0),(226,2,2,2,46,0,'pending','monthly_amortization',1,60,389506.11,28644.00,0.00,773.39,0.00,23775.17,0.00,4868.83,0.00,0.00,0.00,0,1627228800,1626969600,1627142400,0),(227,2,2,2,47,0,'pending','monthly_amortization',1,60,365730.94,28644.00,0.00,773.39,0.00,24072.36,0.00,4571.64,0.00,0.00,0.00,0,1629907200,1629648000,1629820800,0),(228,2,2,2,48,0,'pending','monthly_amortization',1,60,341658.58,28644.00,0.00,773.39,0.00,24373.27,0.00,4270.73,0.00,0.00,0.00,0,1632585600,1632326400,1632499200,0),(229,2,2,2,49,0,'pending','monthly_amortization',1,60,317285.31,28644.00,0.00,773.39,0.00,24677.93,0.00,3966.07,0.00,0.00,0.00,0,1635177600,1634918400,1635091200,0),(230,2,2,2,50,0,'pending','monthly_amortization',1,60,292607.38,28644.00,0.00,773.39,0.00,24986.41,0.00,3657.59,0.00,0.00,0.00,0,1637856000,1637596800,1637769600,0),(231,2,2,2,51,0,'pending','monthly_amortization',1,60,267620.97,28644.00,0.00,773.39,0.00,25298.74,0.00,3345.26,0.00,0.00,0.00,0,1640448000,1640188800,1640361600,0),(232,2,2,2,52,0,'pending','monthly_amortization',1,60,242322.23,28644.00,0.00,773.39,0.00,25614.97,0.00,3029.03,0.00,0.00,0.00,0,1643126400,1642867200,1643040000,0),(233,2,2,2,53,0,'pending','monthly_amortization',1,60,216707.26,28644.00,0.00,773.39,0.00,25935.16,0.00,2708.84,0.00,0.00,0.00,0,1645804800,1645545600,1645718400,0),(234,2,2,2,54,0,'pending','monthly_amortization',1,60,190772.10,28644.00,0.00,773.39,0.00,26259.35,0.00,2384.65,0.00,0.00,0.00,0,1648224000,1647964800,1648137600,0),(235,2,2,2,55,0,'pending','monthly_amortization',1,60,164512.75,28644.00,0.00,773.39,0.00,26587.59,0.00,2056.41,0.00,0.00,0.00,0,1650902400,1650643200,1650816000,0),(236,2,2,2,56,0,'pending','monthly_amortization',1,60,137925.16,28644.00,0.00,773.39,0.00,26919.94,0.00,1724.06,0.00,0.00,0.00,0,1653494400,1653235200,1653408000,0),(237,2,2,2,57,0,'pending','monthly_amortization',1,60,111005.22,28644.00,0.00,773.39,0.00,27256.43,0.00,1387.57,0.00,0.00,0.00,0,1656172800,1655913600,1656086400,0),(238,2,2,2,58,0,'pending','monthly_amortization',1,60,83748.79,28644.00,0.00,773.39,0.00,27597.14,0.00,1046.86,0.00,0.00,0.00,0,1658764800,1658505600,1658678400,0),(239,2,2,2,59,0,'pending','monthly_amortization',1,60,56151.65,28644.00,0.00,773.39,0.00,27942.10,0.00,701.90,0.00,0.00,0.00,0,1661443200,1661184000,1661356800,0),(240,2,2,2,60,0,'pending','monthly_amortization',1,60,28209.55,28562.17,0.00,771.18,0.00,28209.55,0.00,352.62,0.00,0.00,0.00,0,1664121600,1663862400,1664035200,0),(241,3,3,3,1,0,'pending','monthly_dp',1,1,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,86400,0,0,0),(242,3,3,3,1,0,'pending','monthly_amortization',1,1,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,86400,0,0,0),(243,4,4,4,1,0,'pending','monthly_dp',1,1,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,86400,0,0,0),(244,4,4,4,1,0,'pending','monthly_amortization',1,1,1000000.00,1012500.00,0.00,0.00,0.00,1000000.00,0.00,12500.00,0.00,0.00,0.00,0,86400,0,0,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `client_account_structure` */

insert  into `client_account_structure`(`client_account_structure_id`,`client_id`,`client_account_id`,`user_id`,`client_account_structure_active`,`client_account_ma_amount`,`client_account_ma_term`,`client_account_ma_due_date`,`client_account_ma_interest`,`client_account_ma_factor`,`client_account_ma_monthly`,`client_account_ma_rebate`,`client_account_ma_balance_collected`,`client_account_ma_balance_remaining`,`client_account_structure_timestamp`) values (1,1,1,7,1,2141600.00,120,1507996800,17.00,0.01737977,37221.00,2.70,0.00,0.00,1428557793),(2,2,2,7,1,1204000.00,60,1508860800,15.00,0.02378993,28644.00,2.70,0.00,0.00,1428566293),(3,3,3,7,1,0.00,1,0,15.00,1.00000000,0.00,0.00,0.00,0.00,1428632064),(4,4,4,7,1,1000000.00,1,0,15.00,1.01250000,1012500.00,0.00,0.00,0.00,1428632189);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `client_member` */

insert  into `client_member`(`client_member_id`,`user_id`,`client_id`,`client_member_name`,`client_member_relation`,`client_member_timestamp`) values (1,7,1,'Clara De Castro','Business Partner',1428557793),(2,7,2,'Mariano Jabson','Husband',1428566316);

/*Table structure for table `commission_percentage` */

DROP TABLE IF EXISTS `commission_percentage`;

CREATE TABLE `commission_percentage` (
  `commission_percentage_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `commission_scheme_id` varchar(25) DEFAULT NULL,
  `commission_agent` varchar(50) DEFAULT NULL,
  `commission_percentage` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`commission_percentage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `commission_percentage` */

insert  into `commission_percentage`(`commission_percentage_id`,`commission_scheme_id`,`commission_agent`,`commission_percentage`) values (1,'new_property_consultant','property_consultant',3.00),(2,'new_property_consultant','sales_manager',1.75),(3,'new_property_consultant','sales_director',1.00),(4,'new_property_consultant','vp_sales',0.25),(5,'new_sales_director','sales_director',1.00),(6,'new_sales_director','vp_sales',0.25),(7,'new_sales_manager','sales_manager',1.75),(8,'new_sales_manager','sales_director',1.00),(9,'new_sales_manager','vp_sales',0.25),(10,'new_vp_sales','vp_sales',5.00),(11,'old_broker','broker',7.00),(12,'old_avp','avp',6.00),(13,'old_avp_ma','avp',3.00),(14,'old_avp_ma','marketing_associate',3.00),(15,'old_avp_sm','avp',1.00),(16,'old_avp_sm','sales_manager',5.00),(17,'old_avp_sm_ma','avp',1.00),(18,'old_avp_sm_ma','sales_manager',2.00),(19,'old_avp_sm_ma','marketing_associate',3.00);

/*Table structure for table `commission_scheme` */

DROP TABLE IF EXISTS `commission_scheme`;

CREATE TABLE `commission_scheme` (
  `commission_scheme_id` varchar(50) NOT NULL,
  `commission_scheme_type` varchar(50) DEFAULT NULL,
  `commission_scheme_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`commission_scheme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `commission_scheme` */

insert  into `commission_scheme`(`commission_scheme_id`,`commission_scheme_type`,`commission_scheme_name`) values ('new_property_consultant','new','Property Consultant'),('new_sales_director','new','Sales Director'),('new_sales_manager','new','Sales Manager'),('new_vp_sales','new','VP of Sales'),('old_avp','old','AVP only'),('old_avp_ma','old','AVP and MA'),('old_avp_sm','old','AVP and SM'),('old_avp_sm_ma','old','AVP-SM-MA'),('old_broker','old','Broker only');

/*Table structure for table `commission_scheme_range` */

DROP TABLE IF EXISTS `commission_scheme_range`;

CREATE TABLE `commission_scheme_range` (
  `commission_scheme_range_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `commission_scheme_type` varchar(25) DEFAULT NULL,
  `commission_scheme_range_sequence` varchar(10) DEFAULT NULL,
  `commission_scheme_range_min` double(15,2) DEFAULT NULL,
  `commission_scheme_range_max` double(15,2) DEFAULT NULL,
  `commission_scheme_release_percent` double(15,2) DEFAULT NULL,
  `commission_scheme_finance_type` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`commission_scheme_range_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `commission_scheme_range` */

insert  into `commission_scheme_range`(`commission_scheme_range_id`,`commission_scheme_type`,`commission_scheme_range_sequence`,`commission_scheme_range_min`,`commission_scheme_range_max`,`commission_scheme_release_percent`,`commission_scheme_finance_type`) values (1,'old','q1',10.00,19.99,10.00,'in_house'),(2,'old','q2',20.00,29.99,10.00,'in_house'),(3,'old','q3',30.00,39.99,10.00,'in_house'),(4,'old','q4',40.00,49.99,10.00,'in_house'),(5,'old','q5',50.00,59.99,10.00,'in_house'),(6,'old','q6',60.00,69.99,10.00,'in_house'),(7,'old','q7',70.00,79.99,10.00,'in_house'),(8,'old','q8',80.00,89.99,10.00,'in_house'),(9,'old','q9',90.00,90.99,10.00,'in_house'),(10,'old','q10',99.99,100.00,10.00,'in_house'),(11,'new','q1',10.00,19.99,10.00,'in_house'),(12,'new','q2',20.00,69.99,10.00,'in_house'),(13,'new','q3',70.00,99.99,50.00,'in_house'),(14,'new','q4',100.00,100.00,30.00,'in_house'),(15,'new','q1',0.00,80.00,80.00,'bank'),(16,'new','q2',81.00,100.00,20.00,'bank');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `document_account` */

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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

/*Data for the table `document_lot` */

insert  into `document_lot`(`document_lot_id`,`document_type_id`,`lot_id`,`document_lot_status`,`document_lot_timestamp`,`document_lot_received_by_firstname`,`document_lot_received_by_lastname`,`document_lot_date_submit`,`document_lot_date_cleared`,`user_id`) values (1,1,43,1,1427068399,'Brian','Reynolds',1439222400,1433779200,3),(2,2,43,0,1427068399,'Arvin','Alejandro',1427068399,1427068399,3),(3,3,43,1,1427068399,'Arvin','Alejandro',1427068399,1427068399,3),(4,1,1,1,1428643031,'Brian','Reynolds',1428422400,1428422400,NULL),(5,2,1,1,1428643031,'Francis','Reynolds',1429027200,1427990400,NULL),(6,3,1,0,1428643031,NULL,NULL,NULL,NULL,NULL),(7,1,2,0,1428643031,NULL,NULL,NULL,NULL,NULL),(8,2,2,0,1428643031,NULL,NULL,NULL,NULL,NULL),(9,3,2,0,1428643031,NULL,NULL,NULL,NULL,NULL),(10,1,3,0,1428643031,NULL,NULL,NULL,NULL,NULL),(11,2,3,0,1428643031,NULL,NULL,NULL,NULL,NULL),(12,3,3,0,1428643031,NULL,NULL,NULL,NULL,NULL),(13,1,4,0,1428643031,NULL,NULL,NULL,NULL,NULL),(14,2,4,0,1428643031,NULL,NULL,NULL,NULL,NULL),(15,3,4,0,1428643031,NULL,NULL,NULL,NULL,NULL),(16,1,5,0,1428643031,NULL,NULL,NULL,NULL,NULL),(17,2,5,0,1428643031,NULL,NULL,NULL,NULL,NULL),(18,3,5,0,1428643031,NULL,NULL,NULL,NULL,NULL),(19,1,6,0,1428643031,NULL,NULL,NULL,NULL,NULL),(20,2,6,0,1428643031,NULL,NULL,NULL,NULL,NULL),(21,3,6,0,1428643031,NULL,NULL,NULL,NULL,NULL),(22,1,7,0,1428643032,NULL,NULL,NULL,NULL,NULL),(23,2,7,0,1428643032,NULL,NULL,NULL,NULL,NULL),(24,3,7,0,1428643032,NULL,NULL,NULL,NULL,NULL),(25,1,8,0,1428643032,NULL,NULL,NULL,NULL,NULL),(26,2,8,0,1428643032,NULL,NULL,NULL,NULL,NULL),(27,3,8,0,1428643032,NULL,NULL,NULL,NULL,NULL),(28,1,9,0,1428643032,NULL,NULL,NULL,NULL,NULL),(29,2,9,0,1428643032,NULL,NULL,NULL,NULL,NULL),(30,3,9,0,1428643032,NULL,NULL,NULL,NULL,NULL),(31,1,10,0,1428643032,NULL,NULL,NULL,NULL,NULL),(32,2,10,0,1428643032,NULL,NULL,NULL,NULL,NULL),(33,3,10,0,1428643032,NULL,NULL,NULL,NULL,NULL),(34,1,11,0,1428643032,NULL,NULL,NULL,NULL,NULL),(35,2,11,0,1428643032,NULL,NULL,NULL,NULL,NULL),(36,3,11,0,1428643032,NULL,NULL,NULL,NULL,NULL),(37,1,12,0,1428643032,NULL,NULL,NULL,NULL,NULL),(38,2,12,0,1428643032,NULL,NULL,NULL,NULL,NULL),(39,3,12,0,1428643032,NULL,NULL,NULL,NULL,NULL),(40,1,13,1,1428643032,'Francis','Reynolds',1428422400,1429200000,NULL),(41,2,13,1,1428643032,'Brian','Rizal',1429632000,1429113600,NULL),(42,3,13,1,1428643032,'Arvin','Alejandro',1429200000,1429459200,NULL),(43,1,14,0,1428643032,NULL,NULL,NULL,NULL,NULL),(44,2,14,0,1428643032,NULL,NULL,NULL,NULL,NULL),(45,3,14,0,1428643032,NULL,NULL,NULL,NULL,NULL),(46,1,15,0,1428643033,NULL,NULL,NULL,NULL,NULL),(47,2,15,0,1428643033,NULL,NULL,NULL,NULL,NULL),(48,3,15,0,1428643033,NULL,NULL,NULL,NULL,NULL),(49,1,16,0,1428643033,NULL,NULL,NULL,NULL,NULL),(50,2,16,0,1428643033,NULL,NULL,NULL,NULL,NULL),(51,3,16,0,1428643033,NULL,NULL,NULL,NULL,NULL),(52,1,17,0,1428643033,NULL,NULL,NULL,NULL,NULL),(53,2,17,0,1428643033,NULL,NULL,NULL,NULL,NULL),(54,3,17,0,1428643033,NULL,NULL,NULL,NULL,NULL),(55,1,18,0,1428643033,NULL,NULL,NULL,NULL,NULL),(56,2,18,0,1428643033,NULL,NULL,NULL,NULL,NULL),(57,3,18,0,1428643033,NULL,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `house` */

insert  into `house`(`house_id`,`project_id`,`option_house_classification_id`,`house_name`,`house_code`,`house_acronym`,`house_area`,`house_price`,`house_timestamp`) values (3,1,'two_storey','Casa Royale','','CSR',200.00,2000000.00,1427758567),(4,1,'bungalow','Casa Buena','','CSB',150.00,1000000.00,1427759126),(5,2,'two_storey','Escapades','','ESC',200.00,2000000.00,1427759652);

/*Table structure for table `house_price` */

DROP TABLE IF EXISTS `house_price`;

CREATE TABLE `house_price` (
  `house_price_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `house_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `house_price_value` double(10,2) unsigned DEFAULT NULL,
  `house_price_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`house_price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Data for the table `house_price` */

insert  into `house_price`(`house_price_id`,`house_id`,`user_id`,`house_price_value`,`house_price_timestamp`) values (9,10,8,1375400.54,1406012978),(11,12,8,13560212.00,1406013743),(12,13,8,1578588.57,1406013878),(13,10,8,1375400.54,1406017116),(14,10,8,1375400.54,1406017130),(16,10,8,138965.54,1406017365),(17,12,8,3560212.00,1406017395),(18,14,8,1084000.00,1406033787),(19,15,3,1931500.00,1406062563),(20,16,3,2077320.00,1406998820),(21,15,3,1731500.00,1408979105),(22,15,7,1331500.00,1409842910),(23,17,7,1800000.00,1412229358),(24,18,7,2500000.00,1412232869),(25,19,7,1800000.00,1412233377),(26,20,7,1300000.00,1412650126),(27,20,7,1500000.00,1412650181),(28,10,7,138965.54,1412650695),(29,10,7,1438000.00,1412650752),(30,20,7,1325520.00,1412655618),(31,21,7,2125000.00,1412829358),(32,22,7,3502125.00,1412829382),(33,23,7,1250468.00,1413261136),(34,17,7,1468760.00,1413425663),(35,17,7,1460600.00,1413425832),(36,24,7,1250000.00,1413865807),(37,1,7,1000000.00,1427598537),(38,2,7,2000000.00,1427758471),(39,3,7,2000000.00,1427758567),(40,3,7,2000000.00,1427758585),(41,3,7,3000000.00,1427758736),(42,3,7,2000000.00,1427758743),(43,4,7,1000000.00,1427759126),(44,5,7,2000000.00,1427759652);

/*Table structure for table `item_type` */

DROP TABLE IF EXISTS `item_type`;

CREATE TABLE `item_type` (
  `item_type_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `item_type_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`item_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `item_type` */

insert  into `item_type`(`item_type_id`,`item_type_name`) values (0,'Monthly Dues'),(1,'Car Sticker'),(2,'Billing Documents'),(3,'Clubhouse Rental'),(4,'Parking Fee'),(5,'Reservation');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `lot` */

insert  into `lot`(`lot_id`,`project_id`,`project_site_id`,`project_site_block_id`,`option_unit_id`,`option_availability_id`,`house_id`,`network_id`,`network_division_id`,`lot_name`,`lot_area`,`lot_price`,`lot_address`,`lot_city`,`lot_zip`,`agent_id`,`sales_manager_id`,`sales_director_id`,`lot_timestamp`) values (1,1,1,1,'package','sold',3,0,0,'1',120.00,12000.00,'Malolos','Bulacan','1600',1,NULL,NULL,1427596947),(2,1,1,1,'package','sold',3,0,0,'2',200.00,10000.00,'Malolos','Bulacan','1500',1,1,1,1427596947),(3,1,1,2,'lot_only','sold',0,0,0,'1',100.00,10000.00,'Malolos','Bulacan','1500',NULL,NULL,NULL,1427596947),(4,1,1,2,'lot_only','sold',0,0,0,'2',100.00,10000.00,'Malolos','Bulacan','1500',NULL,NULL,NULL,1427596947),(5,1,1,3,'lot_only','available',0,0,0,'1',100.00,10000.00,'Malolos','Bulacan','1500',NULL,NULL,NULL,1427596947),(6,1,1,3,'lot_only','on_hold',0,0,0,'2',100.00,10000.00,'Malolos','Bulacan','1500',1,1,1,1427596947),(7,1,1,1,'lot_only','sold',0,2,1,'3',200.00,10000.00,'Malolos','Bulacan','1500',NULL,NULL,NULL,1427597072),(8,1,1,2,'lot_only','sold',0,0,0,'3',200.00,10000.00,'Malolos','Bulacan','1500',1,1,1,1427597072),(9,2,2,4,'package','available',5,0,0,'1',100.00,5000.00,'Calumpit','Bulacan','1200',NULL,NULL,NULL,1427759378),(10,2,2,4,'lot_only','on_hold',0,0,0,'2',100.00,5000.00,'Calumpit','Bulacan','1200',2,2,2,1427759378),(11,2,2,5,'lot_only','available',0,0,0,'1',100.00,5000.00,'Calumpit','Bulacan','1200',NULL,NULL,NULL,1427759378),(12,2,2,5,'lot_only','available',0,0,0,'2',100.00,5000.00,'Calumpit','Bulacan','1200',NULL,NULL,NULL,1427759378),(13,2,2,6,'lot_only','on_hold',0,0,0,'1',100.00,5000.00,'Calumpit','Bulacan','1200',1,1,1,1427759378),(14,2,2,6,'lot_only','available',0,0,0,'2',100.00,5000.00,'Calumpit','Bulacan','1200',NULL,NULL,NULL,1427759378),(15,2,2,7,'lot_only','available',0,0,0,'1',100.00,5000.00,'Calumpit','Bulacan','1200',NULL,NULL,NULL,1427759378),(16,2,2,7,'lot_only','available',0,0,0,'2',100.00,5000.00,'Calumpit','Bulacan','1200',NULL,NULL,NULL,1427759378),(17,2,2,8,'lot_only','available',0,0,0,'1',100.00,5000.00,'Calumpit','Bulacan','1200',NULL,NULL,NULL,1427759378),(18,2,2,8,'lot_only','available',0,0,0,'2',100.00,5000.00,'Calumpit','Bulacan','1200',NULL,NULL,NULL,1427759378);

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

insert  into `lot_construction`(`lot_construction_id`,`lot_id`,`house_id`,`option_unit_construction_id`,`option_unit_status_id`,`option_unit_contractor_id`,`user_id`,`lot_construction_timestamp`) values (1,1,3,'house','for_costing','in_house',7,1427784965),(2,9,5,'house','for_approval','external',7,1427785093),(3,2,3,'house','ready','in_house',7,1428411815);

/*Table structure for table `lot_price` */

DROP TABLE IF EXISTS `lot_price`;

CREATE TABLE `lot_price` (
  `lot_price_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lot_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `lot_price_value` double(10,2) unsigned DEFAULT NULL,
  `lot_price_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`lot_price_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

/*Data for the table `lot_price` */

insert  into `lot_price`(`lot_price_id`,`lot_id`,`user_id`,`lot_price_value`,`lot_price_timestamp`) values (1,1,7,10000.00,1427596947),(2,2,7,10000.00,1427596947),(3,3,7,10000.00,1427596947),(4,4,7,10000.00,1427596947),(5,5,7,10000.00,1427596947),(6,6,7,10000.00,1427596947),(7,7,7,10000.00,1427597072),(8,8,7,10000.00,1427597072),(9,1,7,12000.00,1427598241),(10,1,7,12050.00,1427598278),(11,2,7,10050.00,1427598278),(12,3,7,10050.00,1427598278),(13,4,7,10050.00,1427598278),(14,5,7,10050.00,1427598278),(15,6,7,10050.00,1427598278),(16,7,7,10050.00,1427598278),(17,8,7,10050.00,1427598278),(18,1,7,12000.00,1427598313),(19,2,7,10000.00,1427598313),(20,3,7,10000.00,1427598313),(21,4,7,10000.00,1427598313),(22,5,7,10000.00,1427598313),(23,6,7,10000.00,1427598313),(24,7,7,10000.00,1427598313),(25,8,7,10000.00,1427598313),(26,9,7,5000.00,1427759378),(27,10,7,5000.00,1427759378),(28,11,7,5000.00,1427759378),(29,12,7,5000.00,1427759378),(30,13,7,5000.00,1427759378),(31,14,7,5000.00,1427759378),(32,15,7,5000.00,1427759378),(33,16,7,5000.00,1427759378),(34,17,7,5000.00,1427759378),(35,18,7,5000.00,1427759378);

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

/*Table structure for table `network` */

DROP TABLE IF EXISTS `network`;

CREATE TABLE `network` (
  `network_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `network_name` varchar(200) DEFAULT NULL,
  `network_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`network_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `network` */

insert  into `network`(`network_id`,`network_name`,`network_timestamp`) values (1,'Special Account',NULL),(2,'Achievers',NULL);

/*Table structure for table `network_division` */

DROP TABLE IF EXISTS `network_division`;

CREATE TABLE `network_division` (
  `network_division_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `network_id` bigint(20) unsigned DEFAULT NULL,
  `network_division_name` varchar(200) DEFAULT NULL,
  `network_division_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`network_division_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `network_division` */

insert  into `network_division`(`network_division_id`,`network_id`,`network_division_name`,`network_division_timestamp`) values (1,1,'Acts',NULL),(2,1,'Amazing',NULL),(3,0,'EDP',NULL),(4,0,'Engineering',NULL),(5,0,'Finance',NULL),(6,0,'Executive',NULL),(7,0,'Billing',NULL),(8,2,'Sample DIvision',1432257608);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `ofv_request` */

insert  into `ofv_request`(`ofv_request_id`,`account_payable_id`,`account_payable_ofv_id`) values (6,32,5),(7,33,6),(8,15,1),(9,16,2),(10,17,3),(11,18,1),(12,18,2),(13,18,3),(14,19,4),(15,19,5),(16,19,6),(17,23,7),(18,25,8),(19,30,9),(20,30,10),(21,34,11),(22,34,12);

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
  `option_account_chart_child_id` varchar(100) DEFAULT NULL,
  `option_account_chart_parent_id` varchar(100) DEFAULT NULL,
  `option_account_chart_child_name` varchar(100) DEFAULT NULL,
  `option_account_chart_child_code` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_chart_child` */

insert  into `option_account_chart_child`(`option_account_chart_child_id`,`option_account_chart_parent_id`,`option_account_chart_child_name`,`option_account_chart_child_code`) values ('basketball_court','development_cost','Basketball Court',NULL),('clubhouse','development_cost','Clubhouse',NULL),('deepwell','development_cost','Deepwell',NULL),('drainage','development_cost','Drainage',NULL),('equipment','development_cost','Equipment',NULL),('moc','advances_to_officers','MOC',NULL),('amb','advances_to_officers','AMB',NULL),('car','advances_to_agents','CAR',NULL),('gasoline','advances_to_agents','Gasoline',NULL),('sic_otc','advances_to_agents','SIC/OTC',NULL),('orc','advances_to_agents','ORC',NULL),('future_commission','advances_to_agents','Future Commission',NULL),('others','advances_to_agents','Others',NULL);

/*Table structure for table `option_account_chart_parent` */

DROP TABLE IF EXISTS `option_account_chart_parent`;

CREATE TABLE `option_account_chart_parent` (
  `option_account_chart_parent_id` varchar(100) NOT NULL,
  `option_account_chart_parent_name` varchar(100) DEFAULT NULL,
  `option_account_chart_parent_code` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`option_account_chart_parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_account_chart_parent` */

insert  into `option_account_chart_parent`(`option_account_chart_parent_id`,`option_account_chart_parent_name`,`option_account_chart_parent_code`) values ('advances_to_agents','Advances to Agents',NULL),('advances_to_officers','Advances to Officers',NULL),('development_cost','Development Cost',NULL);

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

insert  into `option_account_invoice_type`(`option_account_invoice_type_id`,`option_account_invoice_type_code`,`option_account_invoice_type_name`,`option_account_invoice_type_order`,`option_account_invoice_type_key`) values ('billing_document','BD','Billing Documents',NULL,'other'),('club_house','CH','Club House',NULL,'other'),('credit_to_principal','Prin','Credit To Principal',NULL,'0'),('earnest','EN','Earnest',NULL,'rsv'),('monthly_amortization','MA','Monthly Amortization',NULL,'0'),('monthly_dp','PD','Monthly Down Payment',NULL,'0'),('parking_sticker','PS','Parking Sticker',NULL,'other'),('reservation','RV','Reservation',NULL,'rsv'),('scattered','SC','Scattered',NULL,'0');

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

insert  into `option_agent_position`(`option_agent_position_id`,`option_agent_position_name`,`agent_commission_scheme`) values ('property_consultant','Property Consultant','new'),('sales_manager','Sales Manager','new'),('sales_director','Sales Director','new'),('marketing_associate','Marketing Associate','old'),('old_sales_manager','Sales Manager','old'),('avp','AVP','old'),('broker','Broker','old');

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

/*Table structure for table `option_bank_transaction_source` */

DROP TABLE IF EXISTS `option_bank_transaction_source`;

CREATE TABLE `option_bank_transaction_source` (
  `option_bank_transaction_source_id` varchar(25) DEFAULT NULL,
  `option_cashflow_type_id` varchar(15) DEFAULT NULL,
  `option_bank_transaction_source_name` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_bank_transaction_source` */

insert  into `option_bank_transaction_source`(`option_bank_transaction_source_id`,`option_cashflow_type_id`,`option_bank_transaction_source_name`) values ('disbursement','out','Disbursement'),('fund_transfer_out','out','Fund Transfer'),('adjustment_out','out','Adjustment'),('cash_on_hand','in','Cash on Hand'),('fund_transfer_in','in','Fund Transfer'),('payment','in','Payment'),('adjustment_in','in','Adjustment');

/*Table structure for table `option_buyer_type` */

DROP TABLE IF EXISTS `option_buyer_type`;

CREATE TABLE `option_buyer_type` (
  `option_buyer_type_id` varchar(20) NOT NULL,
  `option_buyer_type_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`option_buyer_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_buyer_type` */

insert  into `option_buyer_type`(`option_buyer_type_id`,`option_buyer_type_name`) values ('agent','Agent'),('client','Client'),('employee','Employee');

/*Table structure for table `option_cashflow_type` */

DROP TABLE IF EXISTS `option_cashflow_type`;

CREATE TABLE `option_cashflow_type` (
  `option_cashflow_type_id` varchar(25) NOT NULL,
  `option_cashflow_type_name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`option_cashflow_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_cashflow_type` */

insert  into `option_cashflow_type`(`option_cashflow_type_id`,`option_cashflow_type_name`) values ('in','Debit'),('out','Credit');

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

insert  into `option_payment_status`(`option_payment_status_id`,`option_payment_status_name`) values ('bounced','Invalid - Bounced'),('pending','Pending'),('valid','Valid - Cleared');

/*Table structure for table `option_project_status` */

DROP TABLE IF EXISTS `option_project_status`;

CREATE TABLE `option_project_status` (
  `option_project_status_id` varchar(20) NOT NULL,
  `option_project_status_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`option_project_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `option_project_status` */

insert  into `option_project_status`(`option_project_status_id`,`option_project_status_name`) values ('develop','Developed'),('pre_develop','Pre-Developed');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `project` */

insert  into `project`(`project_id`,`option_project_status_id`,`project_code`,`project_name`,`project_acronym`,`project_address`,`project_province`,`project_timestamp`) values (1,NULL,'G1','Grand Royale','GRY',NULL,NULL,1427494833),(2,NULL,'202','The Meadows','THM',NULL,NULL,1427759259);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `project_price` */

insert  into `project_price`(`project_price_id`,`project_id`,`project_site_id`,`user_id`,`project_price_adjustment`,`project_price_value`,`project_price_timestamp`) values (1,1,1,7,1,50.00,1427598278),(2,1,1,7,0,50.00,1427598313);

/*Table structure for table `project_site` */

DROP TABLE IF EXISTS `project_site`;

CREATE TABLE `project_site` (
  `project_site_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `project_site_name` varchar(100) DEFAULT NULL,
  `project_site_code` mediumint(5) unsigned DEFAULT NULL,
  `project_site_timestamp` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`project_site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `project_site` */

insert  into `project_site`(`project_site_id`,`project_id`,`project_site_name`,`project_site_code`,`project_site_timestamp`) values (1,1,'1A',101,1427596947),(2,2,'1A',201,1427759378);

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

insert  into `project_site_block`(`project_site_block_id`,`project_id`,`project_site_id`,`project_site_block_name`,`project_site_block_timestamp`) values (1,1,1,'1',1427596947),(2,1,1,'2',1427596947),(3,1,1,'3',1427596947),(4,2,2,'1',1427759378),(5,2,2,'2',1427759378),(6,2,2,'3',1427759378),(7,2,2,'4',1427759378),(8,2,2,'5',1427759378);

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
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

/*Data for the table `remark` */

insert  into `remark`(`remark_id`,`user_id`,`remark_key`,`remark_key_id`,`remark_content`,`remark_timestamp`) values (1,7,'lot',1,'1A lot',1427596947),(2,7,'lot',2,'1A lot',1427596947),(3,7,'lot',3,'1A lot',1427596947),(4,7,'lot',4,'1A lot',1427596947),(5,7,'lot',5,'1A lot',1427596947),(6,7,'lot',6,'1A lot',1427596947),(7,7,'lot',7,'ddddd',1427597072),(8,7,'lot',8,'ddddd',1427597072),(9,7,'lot',1,'changed the lot area',1427597804),(10,7,'lot',2,'changed the lot area',1427597835),(11,7,'lot',1,'changed the lot area again',1427598145),(12,7,'lot',1,'changed the price',1427598241),(13,7,'project',1,'batch increase 50',1427598279),(14,7,'lot',1,'batch increase 50',1427598279),(15,7,'lot',2,'batch increase 50',1427598279),(16,7,'lot',3,'batch increase 50',1427598279),(17,7,'lot',4,'batch increase 50',1427598279),(18,7,'lot',5,'batch increase 50',1427598279),(19,7,'lot',6,'batch increase 50',1427598279),(20,7,'lot',7,'batch increase 50',1427598279),(21,7,'lot',8,'batch increase 50',1427598279),(22,7,'project',1,'price decrease 50',1427598313),(23,7,'lot',1,'price decrease 50',1427598313),(24,7,'lot',2,'price decrease 50',1427598313),(25,7,'lot',3,'price decrease 50',1427598313),(26,7,'lot',4,'price decrease 50',1427598313),(27,7,'lot',5,'price decrease 50',1427598313),(28,7,'lot',6,'price decrease 50',1427598313),(29,7,'lot',7,'price decrease 50',1427598314),(30,7,'lot',8,'price decrease 50',1427598314),(31,7,'lot',1,'changed status thru edit',1427598341),(32,7,'project',2,'The meadows project',1427759259),(33,7,'lot',9,'added to the meadows',1427759378),(34,7,'lot',10,'added to the meadows',1427759378),(35,7,'lot',11,'added to the meadows',1427759378),(36,7,'lot',12,'added to the meadows',1427759378),(37,7,'lot',13,'added to the meadows',1427759378),(38,7,'lot',14,'added to the meadows',1427759378),(39,7,'lot',15,'added to the meadows',1427759378),(40,7,'lot',16,'added to the meadows',1427759378),(41,7,'lot',17,'added to the meadows',1427759378),(42,7,'lot',18,'added to the meadows',1427759378),(43,7,'lot',1,'test - update package',1427784965),(44,7,'lot',1,'test update',1427785038),(45,7,'lot',9,'please approve',1427785093),(46,7,'client_account',1,'test add',1428557793),(47,7,'client_account',2,'lot only',1428566293),(48,7,'lot',2,'test',1428644025),(49,7,'lot',13,'Good',1428651318),(50,7,'account_payable',18,'BPI, BDO',1429171848),(51,7,'account_payable',20,'good na to',1428877447),(52,7,'account_payable',1,'dept_head_good',1428878717),(53,7,'account_payable',1,'good_exec_approve',1428878844),(54,7,'account_payable',1,'good_journal_entry',1428879347),(55,7,'account_payable',1,'good_cheque_details',1428879732),(56,7,'account_payable',0,'good_exec_sign',1428879948),(57,7,'account_payable',8,'TBA dept head',1429231191),(58,7,'account_payable',8,'exec_approved TBA',1429231635),(59,7,'account_payable',8,'Journal ENtry Approved',1429231863),(60,7,'account_payable',8,'chq_details',1429231895),(61,7,'account_payable',8,'released',1429232341),(62,7,'account_payable',8,'check',1429233287),(63,7,'account_payable',8,'liquidate check',1429233293),(64,7,'account_payable',0,'test',1429572786),(65,7,'account_payable',9,'test',1429572824),(66,7,'ofv_request',1,'test',1429572963),(67,7,'ofv_request',1,'1',1429572969),(68,7,'account_payable',13,'depthead',1429575096),(69,7,'account_payable',13,'execapprove',1429575125),(70,7,'account_payable',13,'dertails',1429575444),(71,7,'account_payable',16,'good',1429577536),(72,7,'account_payable',16,'xchq',1429577575),(73,7,'account_payable',21,'sample remark',1429597683),(74,7,'account_payable_cheque',2,'78KYTYJTYJYUJ',1429601753),(75,7,'bank',0,'test',1430229144),(76,7,'bank',0,'test',1430229158),(77,7,'bank',1,'tst',1430229269),(78,7,'bank_transaction',3,'test',1430235563),(79,7,'bank_transaction',3,'test',1430235607),(80,7,'bank_transaction',13,'test',1430235642),(81,7,'bank_transaction',13,'good',1430235647),(82,7,'bank',3,'test',1430235653),(83,7,'account_payable_cheque',1,'test',1430900682),(84,7,'bank_transaction',3,'test',1430976373),(85,7,'bank_transaction',3,'sample',1430976385),(86,7,'account_payable',27,'I approve this form and needed to be released ASAP',1431656395),(87,7,'account_payable',28,'Needs to be released ASAP',1431656411),(88,7,'account_payable',29,'No way to give 500k. 15k only',1431657340),(89,7,'account_payable',29,'for your approval',1431657393),(90,7,'account_payable',0,'release asap',1431657414),(91,7,'account_payable',29,'released and given to ',1431657450),(92,7,'account_payable',30,'for replenishment',1431657794),(93,7,'account_payable',30,'done',1431657824),(94,7,'account_payable',31,'please prioritize. ',1431660824),(95,7,'account_payable',31,'pls prior',1431660947),(96,7,'account_payable',31,'dd nec hjgk jgkjgh khgkg',1431661184),(97,7,'account_payable',31,'cheque dfgdfgdfg',1431661313),(98,7,'account_payable',31,'got zdsdhsd sd sd ',1431661426),(99,7,'account_payable',32,'go',1431668317),(100,7,'account_payable',32,'50k = 45k',1431668543),(101,7,'account_payable',32,'dsfsd sdf sdf sdf',1431668605),(102,7,'account_payable',32,'readf df df dfdfd',1431668688),(103,7,'account_payable',32,'fghf fhghgf jghf jhgf jfgf jg ',1431668775),(104,7,'account_payable',32,' dfgdfgdfgdfg dfg dfg dfg dfg f d dfgdfg',1431669071),(105,7,'account_payable',34,'sd fsdf sdf sdf',1431669797),(106,7,'account_payable',34,' gff gh',1431669826),(107,7,'bank',3,'bkt ssd fsdf ',1431670527),(108,7,'bank',3,'mam na;k',1431670537),(109,7,'bank_transaction',43,'mjhg jghkjh',1431670567),(110,7,'account_payable',35,'fff',1431671119),(111,7,'account_payable',35,'dddd',1431671174),(112,7,'account_payable',35,'dddd',1431671261);

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

insert  into `request_type`(`request_type_id`,`request_type_name`) values ('rfp','RFP'),('tba','TBA'),('lqd','Lqd'),('ofv','OFV'),('tax','Tax');

/*Table structure for table `sales_agent_lot` */

DROP TABLE IF EXISTS `sales_agent_lot`;

CREATE TABLE `sales_agent_lot` (
  `sales_agent_lot_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` bigint(10) unsigned DEFAULT NULL,
  `sales_manager_id` bigint(10) unsigned DEFAULT NULL,
  `sales_director_id` bigint(10) unsigned DEFAULT NULL,
  `lot_id` bigint(10) unsigned DEFAULT NULL,
  `sales_agent_lot_timestamp` bigint(15) unsigned DEFAULT NULL,
  `option_availability_id` varchar(30) DEFAULT NULL,
  `hold_standard` tinyint(1) DEFAULT '1',
  `sales_agent_lot_timestamp_end` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`sales_agent_lot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `sales_agent_lot` */

insert  into `sales_agent_lot`(`sales_agent_lot_id`,`agent_id`,`sales_manager_id`,`sales_director_id`,`lot_id`,`sales_agent_lot_timestamp`,`option_availability_id`,`hold_standard`,`sales_agent_lot_timestamp_end`) values (1,1,1,1,2,1428644009,'available',1,1429169840),(2,1,1,1,2,1428644025,'available',1,1429169840),(3,1,1,1,8,1428644061,'available',1,1429169840),(4,1,1,1,5,1428644100,'available',1,1429169840),(5,1,1,1,6,1428644164,'available',1,1429169840),(6,1,1,1,13,1428651318,'available',1,1429169841),(7,1,1,1,10,1428827992,'available',0,1428828613),(10,2,2,2,10,1428828613,'on_hold',1,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Data for the table `tax_request` */

insert  into `tax_request`(`tax_request_id`,`account_payable_id`,`account_payable_item_detail_id`) values (1,37,1),(2,37,2),(3,37,3),(4,37,4),(5,37,5),(6,37,6),(7,37,7),(8,37,8),(9,37,9),(10,37,10),(11,37,11),(12,37,12),(13,37,13),(14,37,14),(15,37,15),(16,37,16),(17,37,17),(18,37,18),(19,37,19),(20,37,20),(21,37,21),(22,37,22),(23,37,23),(24,37,24),(25,37,25),(26,37,26),(27,37,27),(28,37,28),(29,37,29),(30,37,30),(31,37,31),(32,37,32),(33,37,33),(34,37,34),(35,37,35),(36,37,36),(37,37,37),(38,37,38),(39,37,39),(40,37,40),(41,37,41),(42,37,42),(43,38,43),(44,38,44);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`user_id`,`option_user_status_id`,`option_department_id`,`user_number`,`user_name`,`user_surname`,`user_email`,`user_contact`,`user_address`,`user_username`,`user_password`,`user_timestamp`,`user_deleted`) values (7,'enabled','executive','0152123','Annielle','Madrid','Bulacan','12345','abcd efg','annille.madrid','password',1403927441,0),(12,'enabled','edp','11111','Mizel','Delos Santos','mizel@alsc.com.ph','12456','pasig','mickey','pogi',1427489510,0);

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
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
