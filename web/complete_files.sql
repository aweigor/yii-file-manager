-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: yii2_file_manager
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `file` (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `file_dir` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_ext` varchar(255) DEFAULT NULL,
  `file_color` binary(255) DEFAULT NULL,
  `file_comment` tinytext,
  `file_dateloaded` int DEFAULT NULL,
  `file_user_id` int DEFAULT NULL,
  `file_fold_id` int DEFAULT NULL,
  `file_isDeleted` tinyint DEFAULT NULL,
  `file_isPersonal` tinyint DEFAULT NULL,
  PRIMARY KEY (`file_id`),
  KEY `fk_files_user_id` (`file_user_id`),
  KEY `fk_files_folder_id` (`file_fold_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (1,'uploads/storagenew_horizon_white.png','new_horizon_white','png',NULL,'comment1qq',NULL,3,17,1,0),(2,'uploads/storageлого прозрачный.png','лого прозрачный','png',NULL,' ',NULL,3,17,1,0),(3,'uploads/storageлого белый полупрозрачный _1_.png',NULL,'png',NULL,NULL,NULL,3,17,1,NULL),(4,'uploads/storagenew_horizon_transparent.png','new_horizon_transparent','png',NULL,NULL,NULL,3,17,1,0),(5,'uploads/storagenew_horizon_white.png','new_horizon_white','png',NULL,NULL,NULL,3,17,1,0),(6,'uploads/storagenew_horizon_white.png','new_horizon_white','png',NULL,'comment123',NULL,3,17,1,0),(7,'uploads/storagenew_horizon_mid_opacity.png','new_horizon_mid_opacity','png',NULL,NULL,NULL,3,17,1,0),(8,'uploads/storagenew_horizon_transparent.png','new_horizon_transparent','png',NULL,NULL,NULL,3,17,1,0),(9,'uploads/storage/17/8180c71a58623cccc54f285d48748ad9.png','new_horizon_mid_opacity','png',NULL,NULL,1597167899,3,17,1,0),(10,'uploads/storage/17/9d954fbced8963eafeb2707765ce1931.png','new_horizon_white','png',NULL,NULL,1597168362,3,17,1,0),(11,'uploads/storage/17/7532bfacb7ce6299fac71438f7d36d8b.png','new_horizon_transparent123','png',NULL,NULL,1597211351,3,17,1,1),(12,'uploads/storage/17/094b68d204a1bdeb90c4db7ac0c7071c.png','new_horizon_mid_opacity','png',NULL,NULL,1597216426,3,17,0,1),(13,'uploads/storage/17/59b6ef1a2c99129371dac6cb7e56b9e3.png','new_horizon_mid_opacity','png',NULL,NULL,1597216588,3,17,0,0),(14,'uploads/storage/17/37318410093b09a354770c232f110b90.png','new_horizon_white','png',NULL,NULL,1597310888,3,17,0,0),(15,'uploads/storage/17/37318410093b09a354770c232f110b90.png','new_horizon_transparent','png',NULL,NULL,1597310888,3,17,0,0),(16,'uploads/storage/17/37318410093b09a354770c232f110b90.png','new_horizon_mid_opacity','png',NULL,NULL,1597310888,3,17,0,0),(17,'uploads/storage/17/9158f2b9fb4ed6df6af1c8c19d9acaf7.png','new_horizon_transparent','png',NULL,NULL,1597322621,4,17,0,0),(18,'uploads/storage/18/4c6f7545ee920db0cc3a785ca3f96191.png','лого белый полупрозрачный _1_','png',NULL,NULL,1597331473,3,18,0,0),(19,'uploads/storage/18/4c6f7545ee920db0cc3a785ca3f96191.png','new_horizon_transparent','png',NULL,NULL,1597331473,3,18,0,0),(20,'uploads/storage/18/4c6f7545ee920db0cc3a785ca3f96191.png','new_horizon_white','png',NULL,NULL,1597331473,3,18,0,0),(21,'uploads/storage/18/4c6f7545ee920db0cc3a785ca3f96191.png','new_horizon_mid_opacity','png',NULL,NULL,1597331473,3,18,0,0);
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folder`
--

DROP TABLE IF EXISTS `folder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `folder` (
  `fold_id` int NOT NULL AUTO_INCREMENT,
  `fold_user_id` int DEFAULT NULL,
  `fold_name` varchar(255) DEFAULT NULL,
  `fold_image` varchar(255) DEFAULT NULL,
  `fold_desc` tinytext,
  PRIMARY KEY (`fold_id`),
  KEY `fk_fold_user_id` (`fold_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folder`
--

LOCK TABLES `folder` WRITE;
/*!40000 ALTER TABLE `folder` DISABLE KEYS */;
INSERT INTO `folder` VALUES (17,3,'New Folder',NULL,'New Desc'),(20,3,'Новая папка',NULL,NULL);
/*!40000 ALTER TABLE `folder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folder_user`
--

DROP TABLE IF EXISTS `folder_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `folder_user` (
  `foldus_id` int NOT NULL AUTO_INCREMENT,
  `foldus_user_id` int DEFAULT NULL,
  `foldus_folder_id` int DEFAULT NULL,
  PRIMARY KEY (`foldus_id`),
  KEY `fk_folder_id` (`foldus_folder_id`),
  KEY `fk_user_id` (`foldus_user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`foldus_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folder_user`
--

LOCK TABLES `folder_user` WRITE;
/*!40000 ALTER TABLE `folder_user` DISABLE KEYS */;
INSERT INTO `folder_user` VALUES (1,3,13),(2,4,13),(3,3,14),(4,4,14),(5,3,1),(6,4,1),(7,3,9),(8,4,9),(9,3,9),(10,4,9),(11,3,16),(12,4,16),(13,3,16),(14,4,16),(15,NULL,NULL),(16,NULL,NULL),(17,NULL,NULL),(18,NULL,NULL),(19,NULL,NULL),(20,NULL,NULL),(21,NULL,NULL),(22,NULL,NULL),(23,NULL,NULL),(24,NULL,NULL),(25,NULL,NULL),(26,NULL,NULL),(27,NULL,NULL),(28,NULL,NULL),(29,NULL,NULL),(30,4,17),(31,4,18);
/*!40000 ALTER TABLE `folder_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_pwd` varchar(255) NOT NULL,
  `user_isAdmin` tinyint DEFAULT NULL,
  `user_datecreate` int DEFAULT NULL,
  `user_datelastlogin` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'Admin','admin@admin.admin','Admin',1,NULL,NULL),(4,'Guest','guest@guest.guest','Guest',1,1594736720,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-13 12:53:17
