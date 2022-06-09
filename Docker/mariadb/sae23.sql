-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sae23bis
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administration`
--

DROP TABLE IF EXISTS `administration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `mdp` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administration`
--

LOCK TABLES `administration` WRITE;
/*!40000 ALTER TABLE `administration` DISABLE KEYS */;
INSERT INTO `administration` VALUES (1,'Admin','$2y$10$/zLPk4n4k3BPqxvIhrM0JeEeCcRPlBQkqhxs3p.0QE1lMTvXsosiu');
/*!40000 ALTER TABLE `administration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batiment`
--

DROP TABLE IF EXISTS `batiment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batiment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `login` text NOT NULL,
  `mdp` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batiment`
--

LOCK TABLES `batiment` WRITE;
/*!40000 ALTER TABLE `batiment` DISABLE KEYS */;
INSERT INTO `batiment` VALUES (1,'RT','Gestio-1','$2y$10$zZGc6QOUkgnOiZydaDyLV.0ILINAC5h0t9idYDg4tI0Qv9z9ksZHq'),(2,'CS','Gestio-2','$2y$10$n7ZbPU6rvsw5HIyvZNHuPOqq3mmYC3DoS1yoFBb48h4kDDvad87Qy'),(3,'GIM','Gestio-3','$2y$10$jIU4s5RdCJjVZGAWY2jTt.kf9loNyFPqDCUE9r35j6Q/c16bmOErm');
/*!40000 ALTER TABLE `batiment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `capteur`
--

DROP TABLE IF EXISTS `capteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salle` text NOT NULL,
  `etage` int(11) NOT NULL,
  `type` text NOT NULL,
  `batiment` int(11) NOT NULL,
  `topic` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_batiment` (`batiment`),
  CONSTRAINT `id_batiment` FOREIGN KEY (`batiment`) REFERENCES `batiment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capteur`
--

LOCK TABLES `capteur` WRITE;
/*!40000 ALTER TABLE `capteur` DISABLE KEYS */;
INSERT INTO `capteur` VALUES (1,'E001',0,'temperature',1,'iut/RT/etage0/E001/temperature'),(2,'E001',0,'co2',1,'iut/RT/etage0/E001/co2'),(3,'E101',1,'temperature',2,'iut/CS/etage1/E101/temperature'),(4,'E202',2,'co2',3,'iut/GIM/etage1/E202/co2'),(5,'E102',1,'temperature',1,'iut/GIM/etage1/E102/temperature'),(6,'E102',1,'co2',1,'iut/GIM/etage1/E102/co2'),(9,'E103',1,'temperature',1,'iut/RT/etage1/E103/temperature'),(10,'E103',1,'co2',1,'iut/RT/etage1/E103/co2'),(11,'E202',2,'temperature',3,'iut/GIM/etage1/E202/temperature'),(12,'E101',1,'co2',2,'iut/CS/etage1/E101/co2'),(13,'E203',2,'temperature',2,'iut/CS/etage2/E203/temperature'),(14,'E203',2,'co2',2,'iut/CS/etage2/E203/co2');
/*!40000 ALTER TABLE `capteur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesure`
--

DROP TABLE IF EXISTS `mesure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mesure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesure`
--

LOCK TABLES `mesure` WRITE;
/*!40000 ALTER TABLE `mesure` DISABLE KEYS */;
INSERT INTO `mesure` VALUES (12,'2022-06-08','08:56:47'),(13,'2022-06-08','08:56:52'),(14,'2022-06-08','08:57:28'),(15,'2022-06-08','08:57:33'),(16,'2022-06-08','08:57:39'),(17,'2022-06-08','08:57:44');
/*!40000 ALTER TABLE `mesure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valeur`
--

DROP TABLE IF EXISTS `valeur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valeur` int(11) NOT NULL,
  `id_capteur` int(11) NOT NULL,
  `id_mesure` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mesure` (`id_mesure`),
  KEY `id_capteur` (`id_capteur`),
  CONSTRAINT `id_capteur` FOREIGN KEY (`id_capteur`) REFERENCES `capteur` (`id`),
  CONSTRAINT `id_mesure` FOREIGN KEY (`id_mesure`) REFERENCES `mesure` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valeur`
--

LOCK TABLES `valeur` WRITE;
/*!40000 ALTER TABLE `valeur` DISABLE KEYS */;
INSERT INTO `valeur` VALUES (11,23,1,12),(12,752,2,13),(13,22,1,14),(14,699,2,15),(15,23,3,16),(16,301,4,17);
/*!40000 ALTER TABLE `valeur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-08 10:33:19
