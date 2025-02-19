/*
SQLyog Enterprise - MySQL GUI v8.02 RC
MySQL - 5.6.16 : Database - alsc-local
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`alsc-local` /*!40100 DEFAULT CHARACTER SET utf8 */;

/*Table structure for table `commission_percentage` */

DROP TABLE IF EXISTS `commission_percentage`;

CREATE TABLE `commission_percentage` (
  `commission_percentage_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `commission_scheme_id` varchar(25) DEFAULT NULL,
  `option_agent_position_id` varchar(50) DEFAULT NULL,
  `client_account_column` varchar(25) DEFAULT NULL,
  `commission_scheme_heirarchy` int(3) DEFAULT NULL,
  `commission_percentage` double(15,2) DEFAULT NULL,
  PRIMARY KEY (`commission_percentage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `commission_percentage` */

insert  into `commission_percentage`(`commission_percentage_id`,`commission_scheme_id`,`option_agent_position_id`,`client_account_column`,`commission_scheme_heirarchy`,`commission_percentage`) values (1,'new_property_consultant','property_consultant','agent_id',1,3.00),(2,'new_property_consultant','sales_manager','sales_manager_id',2,1.75),(3,'new_property_consultant','sales_director','saled_director_id',3,1.00),(4,'new_property_consultant','vp_sales','0',4,0.25),(5,'new_sales_director','sales_director','saled_director_id',1,1.00),(6,'new_sales_director','vp_sales','0',2,0.25),(7,'new_sales_manager','sales_manager','sales_manager_id',1,1.75),(8,'new_sales_manager','sales_director','saled_director_id',2,1.00),(9,'new_sales_manager','vp_sales','0',3,0.25),(10,'new_vp_sales','vp_sales','0',1,5.00),(11,'old_broker','broker','agent_id',1,7.00),(12,'old_avp','avp','avp_id',1,6.00),(13,'old_avp_ma','avp','avp_id',2,3.00),(14,'old_avp_ma','marketing_associate','agent_id',1,3.00),(15,'old_avp_sm','avp','avp_id',2,1.00),(16,'old_avp_sm','old_sales_manager','sales_manager_id',1,5.00),(17,'old_avp_sm_ma','avp','avp_id',3,1.00),(18,'old_avp_sm_ma','old_sales_manager','sales_manager_id',2,2.00),(19,'old_avp_sm_ma','marketing_associate','agent_id',1,3.00);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
