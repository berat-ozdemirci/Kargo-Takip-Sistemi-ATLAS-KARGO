-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: kargotaban
-- ------------------------------------------------------
-- Server version	8.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `kargolar`
--

DROP TABLE IF EXISTS `kargolar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kargolar` (
  `kargo_id` int NOT NULL AUTO_INCREMENT,
  `alici_id` int NOT NULL,
  `gonderen_id` int NOT NULL,
  `takip_no` char(12) NOT NULL,
  `kargo_agirlik` float NOT NULL,
  `kargo_ucreti` float NOT NULL,
  `kargo_durum` varchar(30) NOT NULL DEFAULT 'Hazırlanıyor',
  `tarih` datetime NOT NULL,
  `sube_id` int NOT NULL,
  PRIMARY KEY (`kargo_id`),
  UNIQUE KEY `takip_no` (`takip_no`),
  KEY `alici_id` (`alici_id`),
  KEY `gonderen_id` (`gonderen_id`),
  KEY `sube_id` (`sube_id`),
  CONSTRAINT `kargolar_ibfk_1` FOREIGN KEY (`alici_id`) REFERENCES `musteriler` (`musteri_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kargolar_ibfk_2` FOREIGN KEY (`gonderen_id`) REFERENCES `musteriler` (`musteri_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kargolar_ibfk_3` FOREIGN KEY (`sube_id`) REFERENCES `subeler` (`sube_id`),
  CONSTRAINT `kargolar_chk_1` CHECK ((`kargo_durum` in (_utf8mb4'Hazırlanıyor',_utf8mb4'Yolda',_utf8mb4'Dağıtımda',_utf8mb4'Teslim Edildi')))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kargolar`
--

LOCK TABLES `kargolar` WRITE;
/*!40000 ALTER TABLE `kargolar` DISABLE KEYS */;
INSERT INTO `kargolar` VALUES (1,13,1,'78591951',200,100,'Hazırlanıyor','2026-05-30 18:18:07',1),(2,13,14,'52331027',900,275,'Hazırlanıyor','2026-05-30 18:18:27',2),(3,13,1,'71811893',773,243.25,'Hazırlanıyor','2026-05-30 18:20:11',1);
/*!40000 ALTER TABLE `kargolar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `musteriler`
--

DROP TABLE IF EXISTS `musteriler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `musteriler` (
  `musteri_id` int NOT NULL AUTO_INCREMENT,
  `musteri_ad` varchar(64) NOT NULL,
  `musteri_soyad` varchar(64) NOT NULL,
  `telefon` varchar(11) NOT NULL,
  `musteri_adres` varchar(255) NOT NULL,
  PRIMARY KEY (`musteri_id`),
  UNIQUE KEY `telefon` (`telefon`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `musteriler`
--

LOCK TABLES `musteriler` WRITE;
/*!40000 ALTER TABLE `musteriler` DISABLE KEYS */;
INSERT INTO `musteriler` VALUES (1,'Buket','Odacı','05432935643','Maden Mah./ Nalbant Sokak, 26/A /Sarıyer/ İstanbul'),(13,'Berat','Özdemirci','01238721312','Ankara'),(14,'Mehmet','Özdemir','09872431242','Çankırı');
/*!40000 ALTER TABLE `musteriler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personeller`
--

DROP TABLE IF EXISTS `personeller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personeller` (
  `personel_id` int NOT NULL AUTO_INCREMENT,
  `sube_id` int NOT NULL,
  `personel_ad` varchar(64) NOT NULL,
  `personel_soyad` varchar(64) NOT NULL,
  PRIMARY KEY (`personel_id`),
  KEY `sube_id` (`sube_id`),
  CONSTRAINT `personeller_ibfk_1` FOREIGN KEY (`sube_id`) REFERENCES `subeler` (`sube_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personeller`
--

LOCK TABLES `personeller` WRITE;
/*!40000 ALTER TABLE `personeller` DISABLE KEYS */;
INSERT INTO `personeller` VALUES (2,1,'Hülya','Demir'),(6,2,'Ferhat','Yolmaz');
/*!40000 ALTER TABLE `personeller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subeler`
--

DROP TABLE IF EXISTS `subeler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subeler` (
  `sube_id` int NOT NULL AUTO_INCREMENT,
  `sube_adi` varchar(64) NOT NULL,
  `sube_adres` varchar(250) NOT NULL,
  PRIMARY KEY (`sube_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subeler`
--

LOCK TABLES `subeler` WRITE;
/*!40000 ALTER TABLE `subeler` DISABLE KEYS */;
INSERT INTO `subeler` VALUES (1,'Yenimahalle Şubesi','Kaletepe Mah./Demirdağ Cad./Yenimahalle/Ankara'),(2,'Levent Şubesi','İstanbul'),(10,'Çankaya Şubesi','Ankara / Çankaya');
/*!40000 ALTER TABLE `subeler` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-30 20:57:21
