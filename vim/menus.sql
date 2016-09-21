#!/usr/bin/env python
--
-- Host: 124.202.158.44    Database: hx_mall_thirdpart
-- ------------------------------------------------------
-- Server version	5.6.17-66.0-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES gbk */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `menus`
--
-- WHERE:   menu_name in ('��������','�ؼ۳������б�','ԤԼ�����б�','�ؼ۳�����')

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES
(93, '�ؼ۳�����'    , '/DiscountCar/ListDiscountCar'           , 47, 0, 3 , '0-47', '2016-04-13 02:35:09', '2016-04-13 02:35:09'),
(94, '��������'      , '/ShopManage/subsidySet'                 , 35, 0, 11, '0-35', '2016-04-13 02:35:27', '2016-04-13 02:36:54'),
(95, 'ԤԼ�����б�'  , '/EnquiryTestDrive/listAppointmentSeeCar', 40, 0, 2 , '0-40', '2016-04-14 08:46:26', '2016-04-18 07:53:00'),
(96, '�ؼ۳������б�', '/OrderManage/listDiscountCarOrder'      , 33, 0, 5 , '0-33', '2016-04-18 06:22:05', '2016-04-18 06:23:08');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-04 11:20:36
