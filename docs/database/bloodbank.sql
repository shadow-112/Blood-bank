-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: Blood_Bank
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

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
-- Table structure for table `CENTER`
--

DROP TABLE IF EXISTS `CENTER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CENTER` (
  `CenterID` int NOT NULL,
  `CenterName` varchar(50) NOT NULL,
  `CityID` int DEFAULT NULL,
  PRIMARY KEY (`CenterID`),
  KEY `FK_center_Country` (`CityID`),
  CONSTRAINT `FK_center_Country` FOREIGN KEY (`CityID`) REFERENCES `City` (`CityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CENTER`
--

LOCK TABLES `CENTER` WRITE;
/*!40000 ALTER TABLE `CENTER` DISABLE KEYS */;
INSERT INTO `CENTER` VALUES (1,'Karachi Blood Center',1),(2,'Karachi Medical Center',1),(3,'Karachi Plasma Center',1),(4,'Lahore Blood Center',2),(5,'Lahore Medical Center',2),(6,'Lahore Plasma Center',2),(7,'Islamabad Blood Center',3),(8,'Islamabad Medical Center',3),(9,'Islamabad Plasma Center',3),(10,'Rawalpindi Blood Center',4),(11,'Rawalpindi Medical Center',4),(12,'Rawalpindi Plasma Center',4),(13,'Faisalabad Blood Center',5),(14,'Faisalabad Medical Center',5),(15,'Faisalabad Plasma Center',5),(16,'Multan Blood Center',6),(17,'Multan Medical Center',6),(18,'Multan Plasma Center',6),(19,'Gujranwala Blood Center',7),(20,'Gujranwala Medical Center',7),(21,'Gujranwala Plasma Center',7),(22,'Peshawar Blood Center',8),(23,'Peshawar Medical Center',8),(24,'Peshawar Plasma Center',8),(25,'Quetta Blood Center',9),(26,'Quetta Medical Center',9),(27,'Quetta Plasma Center',9),(28,'Sialkot Blood Center',10),(29,'Sialkot Medical Center',10),(30,'Sialkot Plasma Center',10);
/*!40000 ALTER TABLE `CENTER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `City`
--

DROP TABLE IF EXISTS `City`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `City` (
  `CityID` int NOT NULL,
  `CityName` varchar(50) NOT NULL,
  `CountryID` int DEFAULT NULL,
  PRIMARY KEY (`CityID`),
  KEY `FK_City_COuntry` (`CountryID`),
  CONSTRAINT `FK_City_COuntry` FOREIGN KEY (`CountryID`) REFERENCES `Country` (`CountryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `City`
--

LOCK TABLES `City` WRITE;
/*!40000 ALTER TABLE `City` DISABLE KEYS */;
INSERT INTO `City` VALUES (1,'Karachi',1),(2,'Lahore',1),(3,'Islamabad',1),(4,'Rawalpindi',1),(5,'Faisalabad',1),(6,'Multan',1),(7,'Gujranwala',1),(8,'Peshawar',1),(9,'Quetta',1),(10,'Sialkot',1);
/*!40000 ALTER TABLE `City` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Country`
--

DROP TABLE IF EXISTS `Country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Country` (
  `CountryID` int NOT NULL,
  `CountryName` varchar(50) NOT NULL,
  PRIMARY KEY (`CountryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Country`
--

LOCK TABLES `Country` WRITE;
/*!40000 ALTER TABLE `Country` DISABLE KEYS */;
INSERT INTO `Country` VALUES (1,'Pakistan');
/*!40000 ALTER TABLE `Country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Donation`
--

DROP TABLE IF EXISTS `Donation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Donation` (
  `DonationID` int NOT NULL AUTO_INCREMENT,
  `UserID` int DEFAULT NULL,
  `CenterID` int DEFAULT NULL,
  `DonationType` varchar(20) DEFAULT NULL,
  `DonationDate` date DEFAULT NULL,
  `DonorName` varchar(50) NOT NULL,
  `CityID` int DEFAULT NULL,
  `BloodType` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`DonationID`),
  KEY `FK_Donation_User` (`UserID`),
  KEY `FK_Donation_center` (`CenterID`),
  KEY `FK_Donation_City` (`CityID`),
  CONSTRAINT `FK_Donation_center` FOREIGN KEY (`CenterID`) REFERENCES `CENTER` (`CenterID`),
  CONSTRAINT `FK_Donation_City` FOREIGN KEY (`CityID`) REFERENCES `City` (`CityID`),
  CONSTRAINT `FK_Donation_User` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Donation`
--

LOCK TABLES `Donation` WRITE;
/*!40000 ALTER TABLE `Donation` DISABLE KEYS */;
INSERT INTO `Donation` VALUES (35,5,4,'Platelets','2024-05-22','rafay',2,NULL),(36,5,4,'Whole Blood','2024-05-05','rafay',2,'A+'),(37,5,6,'Plasma','2024-05-05','rafay',2,'A+'),(38,5,4,'Platelets','2024-05-05','rafay',2,'A+'),(39,5,5,'Whole Blood','2024-05-06','kkk',2,'A+'),(40,7,2,'Whole Blood','2024-05-06','behram afghan khan',1,'A+'),(41,8,5,'Whole Blood','2024-05-07','arbaz',2,'A-'),(42,9,4,'Whole Blood','2024-05-08','Ahmad ali khan',2,'O+');
/*!40000 ALTER TABLE `Donation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Inventory`
--

DROP TABLE IF EXISTS `Inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Inventory` (
  `DonationID` int NOT NULL,
  `UserID` int DEFAULT NULL,
  `CenterID` int DEFAULT NULL,
  `DonationDate` date DEFAULT NULL,
  `DonationType` varchar(20) DEFAULT NULL,
  `CityID` int DEFAULT NULL,
  `BloodType` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`DonationID`),
  KEY `FK_Inventory_User` (`UserID`),
  KEY `FK_Inventory_centerID` (`CenterID`),
  KEY `FK_Inventory_CityID` (`CityID`),
  CONSTRAINT `FK_Inventory_centerID` FOREIGN KEY (`CenterID`) REFERENCES `CENTER` (`CenterID`),
  CONSTRAINT `FK_Inventory_CityID` FOREIGN KEY (`CityID`) REFERENCES `City` (`CityID`),
  CONSTRAINT `FK_Inventory_Donation` FOREIGN KEY (`DonationID`) REFERENCES `Donation` (`DonationID`),
  CONSTRAINT `FK_Inventory_User` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Inventory`
--

LOCK TABLES `Inventory` WRITE;
/*!40000 ALTER TABLE `Inventory` DISABLE KEYS */;
INSERT INTO `Inventory` VALUES (35,5,4,'2024-05-22','Platelets',2,NULL),(36,5,4,'2024-05-05','Whole Blood',2,'A+'),(37,5,6,'2024-05-05','Plasma',2,'A+'),(38,5,4,'2024-05-05','Platelets',2,'A+'),(39,5,5,'2024-05-06','Whole Blood',2,'A+'),(40,7,2,'2024-05-06','Whole Blood',1,'A+'),(41,8,5,'2024-05-07','Whole Blood',2,'A-'),(42,9,4,'2024-05-08','Whole Blood',2,'O+');
/*!40000 ALTER TABLE `Inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MedicalRecord`
--

DROP TABLE IF EXISTS `MedicalRecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MedicalRecord` (
  `MedicalRecordID` int NOT NULL,
  `UserID` int DEFAULT NULL,
  `MedicalHistory` text,
  `LastCheckupDate` date DEFAULT NULL,
  `DoctorName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`MedicalRecordID`),
  UNIQUE KEY `UserID` (`UserID`),
  CONSTRAINT `FK_MedicalRecord_User` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MedicalRecord`
--

LOCK TABLES `MedicalRecord` WRITE;
/*!40000 ALTER TABLE `MedicalRecord` DISABLE KEYS */;
/*!40000 ALTER TABLE `MedicalRecord` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `BloodType` varchar(3) NOT NULL,
  `PlasmaType` varchar(3) DEFAULT NULL,
  `Location` int DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  KEY `FK_User_City` (`Location`),
  CONSTRAINT `FK_User_City` FOREIGN KEY (`Location`) REFERENCES `City` (`CityID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (5,'rafay','password','A+','B',1),(6,'butt sahab','totaandmaina','A+','A',1),(7,'Behram afghan khan','123','A+','A',1),(8,'arbaz awan','123','A-','A',1),(9,'Ahmad ali khan','1234','O+','O',1);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-11  0:43:16
