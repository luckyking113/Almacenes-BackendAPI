/*
SQLyog Ultimate v11.3 (32 bit)
MySQL - 5.6.25 : Database - trialdrive
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`trialdrive` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `trialdrive`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `admin_id` int(150) NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(250) DEFAULT NULL,
  `admin_password` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`admin_id`,`admin_email`,`admin_password`) values (1,'test@gmail.com','123456');

/*Table structure for table `tb_driver` */

DROP TABLE IF EXISTS `tb_driver`;

CREATE TABLE `tb_driver` (
  `driver_id` int(150) NOT NULL AUTO_INCREMENT,
  `driver_email` varchar(150) DEFAULT NULL,
  `driver_phone` varchar(150) DEFAULT NULL,
  `driver_password` varchar(150) DEFAULT NULL,
  `driver_lat` varchar(250) DEFAULT '0',
  `driver_lng` varchar(250) DEFAULT '0',
  `driver_status` int(150) DEFAULT '0' COMMENT '0: free, 1: working',
  `driver_name` varchar(250) DEFAULT NULL,
  `driver_accountstatus` int(150) DEFAULT '0' COMMENT '0: active, 1; inactive',
  PRIMARY KEY (`driver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tb_driver` */

insert  into `tb_driver`(`driver_id`,`driver_email`,`driver_phone`,`driver_password`,`driver_lat`,`driver_lng`,`driver_status`,`driver_name`,`driver_accountstatus`) values (1,'zhan1@test.com','12321312','123','0','0',0,'zhan 1',0),(2,'zhan@test.com','11111111','345','0','0',0,'zhan 2',0),(5,'w','1','s','0','0',0,'r',0);

/*Table structure for table `tb_orders` */

DROP TABLE IF EXISTS `tb_orders`;

CREATE TABLE `tb_orders` (
  `order_id` int(150) NOT NULL AUTO_INCREMENT,
  `track_id` varchar(150) DEFAULT NULL,
  `order_destination` varchar(250) DEFAULT NULL,
  `order_lat` varchar(250) DEFAULT '0',
  `order_lng` varchar(250) DEFAULT '0',
  `order_status` varchar(250) DEFAULT '0' COMMENT '0: assigned, 1: started, 2: completed',
  `order_driverid` varchar(250) DEFAULT NULL,
  `order_drivername` varchar(250) DEFAULT NULL,
  `order_assignedtime` varchar(250) DEFAULT NULL,
  `order_startedtime` varchar(250) DEFAULT NULL,
  `order_completedtime` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tb_orders` */

insert  into `tb_orders`(`order_id`,`track_id`,`order_destination`,`order_lat`,`order_lng`,`order_status`,`order_driverid`,`order_drivername`,`order_assignedtime`,`order_startedtime`,`order_completedtime`) values (3,'111111','beijing china','0','0','0','2','zhan 2','01/25/2019 07:39',NULL,NULL),(4,'2222','shenyang china','0','0','1','5','r','01/25/2019 07:39',NULL,NULL),(5,'#124234213','Shanghai, China','0','0','0','2','zhan 2','01/25/2019 19:44',NULL,NULL),(6,'#2222','beijing china','0','0','0','5','r','01/25/2019 19:45',NULL,NULL),(7,'#444','shenyang china','0','0','0','5','r','01/25/2019 19:45',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
