-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: myweb
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

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
-- Table structure for table `rel_concerts`
--

DROP TABLE IF EXISTS `rel_concerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rel_concerts` (
  `esdeveniment_id` int NOT NULL,
  `data_id` int NOT NULL,
  `localitzacio_id` int NOT NULL,
  PRIMARY KEY (`esdeveniment_id`,`data_id`,`localitzacio_id`),
  KEY `data_id` (`data_id`),
  KEY `localitzacio_id` (`localitzacio_id`),
  CONSTRAINT `rel_concerts_ibfk_1` FOREIGN KEY (`esdeveniment_id`) REFERENCES `tbl_esdeveniment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_concerts_ibfk_2` FOREIGN KEY (`data_id`) REFERENCES `tbl_data` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `rel_concerts_ibfk_3` FOREIGN KEY (`localitzacio_id`) REFERENCES `tbl_localitzacio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rel_concerts`
--

LOCK TABLES `rel_concerts` WRITE;
/*!40000 ALTER TABLE `rel_concerts` DISABLE KEYS */;
INSERT INTO `rel_concerts` VALUES (3,2,1),(6,2,7),(3,3,1),(6,3,7),(3,4,1),(6,4,7),(3,6,1),(6,6,7),(3,7,1),(6,7,7),(3,23,9),(7,29,9),(13,71,12);
/*!40000 ALTER TABLE `rel_concerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_data`
--

DROP TABLE IF EXISTS `tbl_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `hora` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_data`
--

LOCK TABLES `tbl_data` WRITE;
/*!40000 ALTER TABLE `tbl_data` DISABLE KEYS */;
INSERT INTO `tbl_data` VALUES (2,'2024-04-15','21:30'),(3,'2024-04-16','21:30'),(4,'2024-04-17','21:52'),(6,'2024-04-21','21:30'),(7,'2024-04-23','21:30'),(8,'2024-04-26','21:30'),(9,'2024-04-27','21:30'),(10,'2024-04-28','21:30'),(11,'2024-04-30','21:30'),(12,'2024-04-04','21:30'),(13,'2024-04-06','21:30'),(14,'2024-04-07','21:30'),(15,'2024-04-10','21:30'),(16,'2024-04-11','21:30'),(17,'2024-04-12','21:30'),(18,'2024-04-14','21:30'),(21,'2023-01-14','17:00'),(22,'2024-01-02','17:00'),(23,'2024-01-02','21:30'),(24,'2024-01-03','21:30'),(25,'2024-01-04','21:30'),(26,'2024-01-05','21:30'),(27,'2024-01-06','21:30'),(28,'2024-01-07','21:30'),(29,'2024-01-08','21:30'),(30,'2024-01-09','21:30'),(31,'2024-01-10','21:30'),(32,'2024-01-11','21:30'),(33,'2024-01-12','21:30'),(34,'2024-01-13','21:30'),(35,'2024-01-14','21:30'),(36,'2024-01-15','21:30'),(37,'2024-01-16','21:30'),(38,'2024-01-17','21:30'),(39,'2024-01-18','21:30'),(40,'2024-01-19','21:30'),(41,'2024-01-20','21:30'),(42,'2024-01-21','21:30'),(43,'2024-01-22','21:30'),(44,'2024-01-23','21:30'),(45,'2024-01-24','21:30'),(46,'2024-01-25','21:30'),(47,'2024-01-26','21:30'),(48,'2024-01-27','21:30'),(49,'2024-02-01','21:30'),(50,'2024-02-02','21:30'),(51,'2024-02-03','21:30'),(52,'2024-02-04','21:30'),(53,'2024-02-05','21:30'),(54,'2024-02-06','21:30'),(55,'2024-02-07','21:30'),(56,'2024-02-08','21:30'),(57,'2024-02-09','21:30'),(58,'2024-02-10','21:30'),(59,'2024-02-11','21:30'),(60,'2024-02-12','21:30'),(61,'2024-02-13','21:30'),(62,'2024-02-14','21:30'),(63,'2024-02-15','21:30'),(64,'2024-02-16','21:30'),(65,'2024-02-17','21:30'),(66,'2024-02-18','21:30'),(67,'2024-02-19','21:30'),(68,'2024-02-20','21:30'),(69,'2024-02-21','21:30'),(70,'2024-02-22','21:30'),(71,'2024-02-23','21:30'),(72,'2024-02-24','21:30'),(73,'2024-02-25','21:30'),(74,'2024-02-26','21:30'),(75,'2024-02-27','21:30'),(77,'2024-03-02','21:30'),(78,'2024-03-03','21:30'),(79,'2024-03-04','21:30'),(80,'2024-03-05','21:30'),(81,'2024-03-06','21:30'),(82,'2024-03-07','21:30'),(83,'2024-03-08','21:30'),(84,'2024-03-09','21:30'),(85,'2024-03-10','21:30'),(86,'2024-03-11','21:30'),(87,'2024-03-12','21:30'),(88,'2024-03-13','21:30'),(89,'2024-03-14','21:30'),(90,'2024-03-15','21:30'),(91,'2024-03-16','21:30'),(92,'2024-03-17','21:30'),(93,'2024-03-18','21:30'),(94,'2024-03-19','21:30'),(95,'2024-03-20','21:30'),(96,'2024-03-21','21:30'),(97,'2024-03-22','21:30'),(98,'2024-03-23','21:30'),(99,'2024-03-24','21:30'),(100,'2024-03-25','21:30'),(101,'2024-03-26','21:30'),(102,'2024-03-27','21:30'),(103,'2023-01-01','21:30'),(104,'2023-01-02','21:30'),(105,'2023-01-03','21:30'),(106,'2023-01-04','21:30'),(107,'2023-01-05','21:30'),(108,'2023-01-06','21:30'),(109,'2023-01-07','21:30'),(110,'2023-01-08','21:30'),(111,'2023-01-09','21:30'),(113,'2023-01-11','21:30'),(114,'2023-01-12','21:30'),(115,'2023-01-13','21:30'),(116,'2023-01-14','21:30'),(117,'2023-01-15','21:30'),(118,'2023-01-16','21:30'),(119,'2023-01-17','21:30'),(120,'2023-01-18','21:30'),(121,'2023-01-19','21:30'),(122,'2023-01-20','21:30'),(123,'2023-01-21','21:30'),(124,'2023-01-22','21:30'),(125,'2023-01-23','21:30'),(126,'2023-01-24','21:30'),(127,'2023-01-25','21:30'),(128,'2023-01-26','21:30'),(129,'2023-01-27','21:30'),(137,'2024-04-18','21:31');
/*!40000 ALTER TABLE `tbl_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_entrada`
--

DROP TABLE IF EXISTS `tbl_entrada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_entrada` (
  `esdeveniment_id` int DEFAULT NULL,
  `data_id` int DEFAULT NULL,
  `loc_id` int DEFAULT NULL,
  `zona_id` int DEFAULT NULL,
  `pagament_id` int DEFAULT NULL,
  `id` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `fila` int NOT NULL,
  `butaca` int NOT NULL,
  `dni` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idX_F60C5C6E71F7E88B` (`esdeveniment_id`),
  KEY `idX_F60C5C6E37F5A13C` (`data_id`),
  KEY `idX_F60C5C6E6505CAD1` (`loc_id`),
  KEY `idX_F60C5C6E104EA8FC` (`zona_id`),
  KEY `idX_F60C5C6E66C49110` (`pagament_id`),
  CONSTRAINT `FK_F60C5C6E104EA8FC` FOREIGN KEY (`zona_id`) REFERENCES `tbl_zona` (`id`),
  CONSTRAINT `FK_F60C5C6E37F5A13C` FOREIGN KEY (`data_id`) REFERENCES `tbl_data` (`id`),
  CONSTRAINT `FK_F60C5C6E6505CAD1` FOREIGN KEY (`loc_id`) REFERENCES `tbl_localitzacio` (`id`),
  CONSTRAINT `FK_F60C5C6E66C49110` FOREIGN KEY (`pagament_id`) REFERENCES `tbl_pagament` (`id`),
  CONSTRAINT `FK_F60C5C6E71F7E88B` FOREIGN KEY (`esdeveniment_id`) REFERENCES `tbl_esdeveniment` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_entrada`
--

LOCK TABLES `tbl_entrada` WRITE;
/*!40000 ALTER TABLE `tbl_entrada` DISABLE KEYS */;
INSERT INTO `tbl_entrada` VALUES (6,2,7,1,2,'24831KRGX5YM14',1,500,'44003603A'),(6,7,7,1,7,'24831LLQ1224RT',9,20,'46007007K'),(3,23,9,2,56,'45266NKO89VB8',5,5,'44003603a'),(13,71,12,7,64,'50706MVV90MF2',2,3,'41005681Q'),(7,29,9,6,65,'52999UQK55IQ0',1,1,'44003603A'),(3,3,1,1,3,'55032FCTM11BP6',1,22,'22404871F'),(3,6,1,1,6,'55032FPTR1178A',14,6,'74003871M'),(3,4,1,1,4,'55032KMMT5YM14',2,1,'22404871F'),(3,2,1,1,2,'55032KRGX5YM14',1,20,'44003603A'),(7,29,9,2,55,'71948ESM54TX9',3,3,'41005681Q');
/*!40000 ALTER TABLE `tbl_entrada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_esdeveniment`
--

DROP TABLE IF EXISTS `tbl_esdeveniment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_esdeveniment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titol` char(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `subtitol` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci,
  `dates` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `imatge` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_esdeveniment`
--

LOCK TABLES `tbl_esdeveniment` WRITE;
/*!40000 ALTER TABLE `tbl_esdeveniment` DISABLE KEYS */;
INSERT INTO `tbl_esdeveniment` VALUES (2,'Tete Montoliu 80 + 4','El gran Tete Montoliu está considerado como el músico más internacional de Jazz del país','2023 Gener','uploads/tete-concierto-210217.original.jpg'),(3,'Elefantes','Elefantes recorrerá algunas de las Salas y Teatros más importantes de nuestra geografía','2023 Agost','uploads/240303_logo_Foto_horizontal_para_Ticketea_claim.jpg'),(4,'Carlos Vives','','2023 Desembre','uploads/258729_logo_Carlos_Vives_ticketea_claim.jpg'),(5,'IZARO','','2024 Febrer','uploads/257415_logo_izaro_claim.jpg'),(6,'THE VERY BEST OF DIRE STRAITS','bROTHES iN bAND. dIRE sTRAITS. The Very Best of dIRE sTRAITS SHOW','2024 Juny','uploads/051214124520_theverybestinternet.jpeg'),(7,'Bruce Springsteen &amp; E Street Band','Gira europea 2024','2024 Juny','https://www.doctormusic.com/upload/events/395m.jpg'),(11,'Vicco - Guitar 24','El nombre de Vicco llegó al gran público con su impresionante participación en el Benidorm Fest de 2023.','2024 Maig','uploads/1701799431.5217_vicco-min.jpg'),(12,'Rozalén','Rozalén, una de las cantautoras más destacadas de España, ha conquistado el corazón de su audiencia con su mezcla única de folk, pop y letras cargadas de profundidad emocional y social.','2024 Maig','uploads/1701799487.8971_image.jpg'),(13,'Maná','Maná es un grupo de rock latino que se fundó el año 1986 en Guadalajara (México).','2024 Juny','uploads/1701799596.5339_mana-generica-tour-espana.jpg'),(14,'Alejandro Sanz','Alejandro Sanz culminará su tour tras dos años consecutivos en los escenarios, y más de un 1.000.000 de seguidores desde su inicio en octubre del 2021, bajo el nombre de La Gira, renombrado SANZ en Vivo en su segunda etapa.','2023 Desembre','uploads/1701799735.5121_00-00088Wi.jpg'),(15,'Noche de Beatles','Noche de Beatles es un tributo homenaje a los Beatles. En esta ocasión el grupo vuelve a repetir en la sala Luz de Gas.','2024 Juny','https://www.atrapalo.com/common/photo/event/4/8/8/5611/1531010/si_372_0.jpg');
/*!40000 ALTER TABLE `tbl_esdeveniment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_idiomes`
--

DROP TABLE IF EXISTS `tbl_idiomes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_idiomes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `iso` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imatge` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actiu` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_idiomes_iso_unique` (`iso`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_idiomes`
--

LOCK TABLES `tbl_idiomes` WRITE;
/*!40000 ALTER TABLE `tbl_idiomes` DISABLE KEYS */;
INSERT INTO `tbl_idiomes` VALUES (1,'cat','languages/cat.png',1,'2022-08-17 15:40:30','2023-03-18 07:28:07'),(2,'euz','languages/euz.png',1,'2022-08-17 15:40:30','2023-03-18 07:41:14'),(3,'es','languages/es.png',1,'2022-08-17 15:40:30','2023-03-10 08:19:49'),(4,'gb','languages/gb.png',1,'2022-08-17 15:40:30','2023-03-11 15:32:55'),(5,'fr','languages/fr.png',0,'2022-08-17 15:40:30','2023-03-10 07:54:46'),(6,'de','languages/de.png',0,'2022-08-17 15:40:30','2023-03-10 07:54:55'),(8,'fn','languages/fn.png',0,'2022-08-18 03:24:13','2023-03-10 07:55:07'),(9,'gr','languages/gr.png',0,'2022-08-18 06:36:07','2023-03-10 07:55:19'),(11,'rus','languages/rus.png',0,'2022-08-18 06:40:02','2023-03-10 07:55:39'),(12,'nl','languages/nl.png',0,'2022-08-19 04:31:22','2023-03-10 07:56:03'),(15,'irl','languages/irl.png',0,'2022-08-20 01:29:11','2023-03-10 07:56:12'),(16,'nor','languages/nor.png',0,'2022-08-20 01:40:17','2023-03-10 07:56:21');
/*!40000 ALTER TABLE `tbl_idiomes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_localitzacio`
--

DROP TABLE IF EXISTS `tbl_localitzacio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_localitzacio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lloc` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `adreca` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `localitat` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_localitzacio`
--

LOCK TABLES `tbl_localitzacio` WRITE;
/*!40000 ALTER TABLE `tbl_localitzacio` DISABLE KEYS */;
INSERT INTO `tbl_localitzacio` VALUES (1,'SALA BIKINI','L&#039;illa Diagonal, L&#039;Illa, Avinguda Diagonal, 547',''),(5,'Continental Bar','Carrer de la Providència, 32','08024 Barcelona'),(6,'Sant Jordi Club','Passeig Olímpic, 5','08038 Barcelo'),(7,'SALA BARTS','Av. del Paral.lel, 62','08001 Barcelona'),(8,'Razzmatazz','Carrer de Pamplona, 88','08018 Barcelona'),(9,'Sala Jamboree','Plaça Reial, 17','08002 Barcelona'),(10,'Sala Bóveda','Carrer de Roc Boronat, 33','08005 Barcelona'),(11,'Palau de la Música Catalana','Carrer del Palau de la Música, 4','08003 Barcelona'),(12,'Estadi Olímpic de Montjuïc Lluís Companys','Passeig Olímpic, 15-17','08038 Barcelona'),(13,'CLAP Mataró','Serra i Moret 4','08302 Mataró'),(14,'El Club  Mataró','Batista i Roca 61','08302 Mataró'),(15,'Sala Foment Mataroní','Nou 11','08302 Mataró'),(16,'Sala Republic','Via Sèrgia 88','08302 Mataró'),(17,'Sala Duba','Bautista i Roca 25','08302 Mataró');
/*!40000 ALTER TABLE `tbl_localitzacio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pagament`
--

DROP TABLE IF EXISTS `tbl_pagament`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_pagament` (
  `id` int NOT NULL AUTO_INCREMENT,
  `banc` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `ref_externa` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `data` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `estat` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pagament`
--

LOCK TABLES `tbl_pagament` WRITE;
/*!40000 ALTER TABLE `tbl_pagament` DISABLE KEYS */;
INSERT INTO `tbl_pagament` VALUES (1,'3025','0078 BPD 843','01/02/2020','CONFIRMAT'),(2,'0235','0078 BPD 2529','01/02/2020','CONFIRMAT'),(3,'2095','0078 BPD 5901','01/02/2020','CONFIRMAT'),(4,'2080','0078 BPD 12645','01/02/2020','CONFIRMAT'),(5,'0128','0078 BPD 26133','01/02/2020','CONFIRMAT'),(6,'2100','0078 BPD 53109','01/02/2020','CONFIRMAT'),(7,'0136','0078 BPD 107061','01/02/2020','CONFIRMAT'),(8,'0019','0078 BPD 214965','01/02/2020','CONFIRMAT'),(9,'0019','0078 BPD 430773','01/02/2020','CONFIRMAT'),(10,'0241','0078 BPD 862389','01/02/2020','CONFIRMAT'),(11,'0136','0078 BPD 1725621','01/02/2020','CONFIRMAT'),(12,'0162','0078 BPD 3452085','01/02/2020','CONFIRMAT'),(13,'0019','0078 BPD 6905013','01/02/2020','CONFIRMAT'),(14,'0188','0078 BPD 13810869','01/02/2020','CONFIRMAT'),(15,'2000','0078 BPD 27622581','01/02/2020','CONFIRMAT'),(16,'0182','0078 BPD 55246005','01/02/2020','CONFIRMAT'),(17,'0182','0078 BPD 110492853','01/02/2020','CONFIRMAT'),(18,'2100','0078 BPD 220986549','01/02/2020','CONFIRMAT'),(19,'2100','0078 BPD 441973941','01/02/2020','CONFIRMAT'),(22,'0049','FGSD 54456SDF4 5','01/01/2023','CONFIRMAT'),(23,'1465','SDFG 654 DAFG06 564FG','01/12/2024','CONFIRMAT'),(24,'0241','0241 ORU 274','12/12/2023','PENDENT'),(25,'0229','0229 YIZ 79','12/12/2023','PENDENT'),(26,'0128','0128 HKC 155','12/12/2023','PENDENT'),(27,'1568','1568 LGC 6724','12/12/2023','PENDENT'),(28,'1544','1544 SOV 164','12/12/2023','PENDENT'),(29,'0188','0188 VQV 50','12/12/2023','PENDENT'),(30,'0188','0188 AEF 8','12/12/2023','PENDENT'),(31,'3035','3035 KYI 8549','12/12/2023','PENDENT'),(32,'2080','2080 BPM 451534','12/12/2023','PENDENT'),(33,'0049','0049 ISQ 484932','12/12/2023','PENDENT'),(34,'2080','2080 QVR 3591','12/12/2023','PENDENT'),(35,'3035','3035 XRJ 34','12/12/2023','PENDENT'),(36,'0003','0003 VQE 7','12/12/2023','PENDENT'),(37,'0182','0182 BEM 723','12/12/2023','PENDENT'),(38,'0234','0234 VUK 124','12/12/2023','PENDENT'),(39,'1544','1544 WBE 84','12/12/2023','PENDENT'),(40,'0188','0188 DQM 679','12/12/2023','PENDENT'),(41,'0049','0049 VUU 85','12/12/2023','PENDENT'),(42,'3058','3058 SGV 98322','12/12/2023','PENDENT'),(43,'2095','2095 NFM 01','12/12/2023','PENDENT'),(44,'2080','2080 CIM 437','12/12/2023','PENDENT'),(45,'0019','0019 CVG 626','12/12/2023','PENDENT'),(46,'0083','0083 FYD 6','12/12/2023','PENDENT'),(47,'1544','1544 CMJ 73','12/12/2023','PENDENT'),(48,'3035','3035 ZVB 5','12/12/2023','PENDENT'),(49,'1568','1568 QLV 7297','12/12/2023','PENDENT'),(50,'0162','0162 TCH 413','12/12/2023','PENDENT'),(51,'1544','1544 LJF 21','12/12/2023','PENDENT'),(52,'0229','0229 MEA 547','12/12/2023','PENDENT'),(53,'0081','0081 JHX 69','12/12/2023','PENDENT'),(54,'0019','0019 AVS 1317','12/12/2023','PENDENT'),(55,'2085','2085 HIG 58','12/12/2023','PENDENT'),(56,'0019','0019 LDP 76','12/12/2023','PENDENT'),(57,'0078','0078 BPD 5901','12/12/2023','PENDENT'),(58,'0078','0078 BPD 5901','12/12/2023','PENDENT'),(59,'0078','0078 BPD 53109','12/12/2023','PENDENT'),(60,'0078','0078 BPD 53109','12/12/2023','PENDENT'),(61,'0078','0078 BPD 53109','12/12/2023','PENDENT'),(62,'2100','2100 XCX 081','13/12/2023','PENDENT'),(63,'0220','0220 LLF 7991','15/12/2023','WEB'),(64,'2095','2095 ZDV 4621','15/12/2023','WEB'),(65,'0136','0136 BEH 73','15/12/2023','WEB'),(66,'3025','3025 NAW 56','15/12/2023','WEB'),(67,'3025','3025 NAW 56','15/12/2023','CONFIRMAT'),(68,'0235','0078 BPD 2529','Array','WEB');
/*!40000 ALTER TABLE `tbl_pagament` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_traduccions`
--

DROP TABLE IF EXISTS `tbl_traduccions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_traduccions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `variable` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idioma_id` bigint unsigned NOT NULL,
  `valor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_traduccions_idioma_id_foreign` (`idioma_id`),
  CONSTRAINT `tbl_traduccions_idioma_id_foreign` FOREIGN KEY (`idioma_id`) REFERENCES `tbl_idiomes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=690 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_traduccions`
--

LOCK TABLES `tbl_traduccions` WRITE;
/*!40000 ALTER TABLE `tbl_traduccions` DISABLE KEYS */;
INSERT INTO `tbl_traduccions` VALUES (177,'cat',1,'català',NULL,NULL),(178,'euz',1,'basc',NULL,NULL),(179,'es',1,'castellà',NULL,NULL),(180,'gb',1,'anglès',NULL,NULL),(181,'fr',1,'francès',NULL,NULL),(182,'de',1,'alemany',NULL,NULL),(183,'fn',1,'finès',NULL,NULL),(184,'gr',1,'grec',NULL,NULL),(185,'rus',1,'rus',NULL,NULL),(186,'nl',1,'holandès',NULL,NULL),(187,'irl',1,'gaèlic',NULL,NULL),(188,'nor',1,'noruec',NULL,NULL),(189,'cat',2,'katalana',NULL,NULL),(190,'euz',2,'euskara',NULL,NULL),(191,'es',2,'gaztelania',NULL,NULL),(192,'gb',2,'ingelesa',NULL,NULL),(193,'fr',2,'frantsesa',NULL,NULL),(194,'de',2,'alemana',NULL,NULL),(195,'fn',2,'helburuak',NULL,NULL),(196,'gr',2,'grecoak',NULL,NULL),(197,'rus',2,'errusiera',NULL,NULL),(198,'nl',2,'holandarra',NULL,NULL),(199,'irl',2,'irlandarra',NULL,NULL),(200,'nor',2,'norvegiara',NULL,NULL),(201,'cat',3,'catalán',NULL,NULL),(202,'euz',3,'vasco',NULL,NULL),(203,'es',3,'castellano',NULL,NULL),(204,'gb',3,'inglés',NULL,NULL),(205,'fr',3,'francés',NULL,NULL),(206,'de',3,'alemán',NULL,NULL),(207,'fn',3,'finés',NULL,NULL),(208,'gr',3,'griego',NULL,NULL),(209,'rus',3,'ruso',NULL,NULL),(210,'nl',3,'holandés',NULL,NULL),(211,'irl',3,'irlandés',NULL,NULL),(212,'nor',3,'noruego',NULL,NULL),(213,'cat',4,'catalan',NULL,NULL),(214,'euz',4,'basque',NULL,NULL),(215,'es',4,'spanish',NULL,NULL),(216,'gb',4,'english',NULL,NULL),(217,'fr',4,'french',NULL,NULL),(218,'de',4,'german',NULL,NULL),(219,'fn',4,'finnish',NULL,NULL),(220,'gr',4,'greek',NULL,NULL),(221,'rus',4,'russian',NULL,NULL),(222,'nl',4,'dutch',NULL,NULL),(223,'irl',4,'irish',NULL,NULL),(224,'nor',4,'norwegian',NULL,NULL),(225,'cat',5,'catalan',NULL,NULL),(226,'euz',5,'basque',NULL,NULL),(227,'es',5,'espagnol',NULL,NULL),(228,'gb',5,'anglais',NULL,NULL),(229,'fr',5,'français',NULL,NULL),(230,'de',5,'allemand',NULL,NULL),(231,'fn',5,'fins',NULL,NULL),(232,'gr',5,'grec',NULL,NULL),(233,'rus',5,'russe',NULL,NULL),(234,'nl',5,'néerlandais',NULL,NULL),(235,'irl',5,'irlandais',NULL,NULL),(236,'nor',5,'norvégien',NULL,NULL),(237,'cat',6,'katalanisch',NULL,NULL),(238,'euz',6,'baskisch',NULL,NULL),(239,'es',6,'spanisch',NULL,NULL),(240,'gb',6,'englisch',NULL,NULL),(241,'fr',6,'französisch',NULL,NULL),(242,'de',6,'deutsch',NULL,NULL),(243,'fn',6,'Zwecke',NULL,NULL),(244,'gr',6,'griechisch',NULL,NULL),(245,'rus',6,'russisch',NULL,NULL),(246,'nl',6,'niederländisch',NULL,NULL),(247,'irl',6,'irisch',NULL,NULL),(248,'nor',6,'norwegisch',NULL,NULL),(249,'cat',8,'katalaani',NULL,NULL),(250,'euz',8,'baski',NULL,NULL),(251,'es',8,'espanja',NULL,NULL),(252,'gb',8,'englanti',NULL,NULL),(253,'fr',8,'ranskan kieli',NULL,NULL),(254,'de',8,'saksan kieli',NULL,NULL),(255,'irl',8,'irlantilainen',NULL,NULL),(256,'fn',8,'tarkoituksiin',NULL,NULL),(257,'gr',8,'kreikkalainen',NULL,NULL),(258,'rus',8,'Venäjän kieli',NULL,NULL),(259,'nl',8,'Hollannin kieli',NULL,NULL),(260,'nor',8,'norjan kieli',NULL,NULL),(261,'cat',9,'καταλανικά',NULL,NULL),(262,'euz',9,'Βάσκος',NULL,NULL),(263,'es',9,'Ισπανικά',NULL,NULL),(264,'gb',9,'Αγγλικά',NULL,NULL),(265,'fr',9,'γαλλική γλώσσα',NULL,NULL),(266,'de',9,'Γερμανός',NULL,NULL),(267,'fn',9,'σκοποί',NULL,NULL),(268,'gr',9,'Ελληνικά',NULL,NULL),(269,'rus',9,'Ρωσική',NULL,NULL),(270,'nl',9,'Ολλανδός',NULL,NULL),(271,'irl',9,'ιρλανδικός',NULL,NULL),(272,'nor',9,'Νορβηγός',NULL,NULL),(273,'cat',11,'Каталонский',NULL,NULL),(274,'euz',11,'baskisch',NULL,NULL),(275,'es',11,'испанский',NULL,NULL),(276,'gb',11,'Английский',NULL,NULL),(277,'fr',11,'Французский',NULL,NULL),(278,'de',11,'Немецкий',NULL,NULL),(279,'fn',11,'цели',NULL,NULL),(280,'gr',11,'греческий',NULL,NULL),(281,'rus',11,'Русский',NULL,NULL),(282,'nl',11,'Голландский',NULL,NULL),(283,'irl',11,'ирландский',NULL,NULL),(284,'nor',11,'Норвежский',NULL,NULL),(285,'cat',12,'catalaans',NULL,NULL),(286,'euz',12,'baskisch',NULL,NULL),(287,'es',12,'Spaans',NULL,NULL),(288,'gb',12,'engels',NULL,NULL),(289,'fr',12,'frans',NULL,NULL),(290,'de',12,'duits',NULL,NULL),(291,'fn',12,'doeleinden',NULL,NULL),(292,'gr',12,'grieks',NULL,NULL),(293,'rus',12,'russisch',NULL,NULL),(294,'nl',12,'nederlands',NULL,NULL),(295,'irl',12,'Iers',NULL,NULL),(296,'nor',12,'noors',NULL,NULL),(297,'cat',15,'catalóinis',NULL,NULL),(298,'euz',15,'bascais',NULL,NULL),(299,'es',15,'spainnis',NULL,NULL),(300,'gb',15,'béarla',NULL,NULL),(301,'fr',15,'fraincis',NULL,NULL),(302,'de',15,'gearmáinis',NULL,NULL),(303,'fn',15,'críocha',NULL,NULL),(304,'gr',15,'gréigis',NULL,NULL),(305,'rus',15,'rúisis',NULL,NULL),(306,'nl',15,'ollainnis',NULL,NULL),(307,'irl',15,'gaeilge',NULL,NULL),(308,'nor',15,'ioruais',NULL,NULL),(309,'nor',16,'norsk',NULL,NULL),(310,'cat',16,'katalansk',NULL,NULL),(311,'euz',16,'baskisk',NULL,NULL),(312,'es',16,'spansk',NULL,NULL),(313,'gb',16,'engelsk',NULL,NULL),(314,'fr',16,'fransk',NULL,NULL),(315,'de',16,'tysk',NULL,NULL),(316,'fn',16,'formål',NULL,NULL),(317,'gr',16,'gresk',NULL,NULL),(318,'rus',16,'russisk',NULL,NULL),(319,'nl',16,'nederlandsk',NULL,NULL),(320,'irl',16,'gælisk',NULL,NULL);
/*!40000 ALTER TABLE `tbl_traduccions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuaris`
--

DROP TABLE IF EXISTS `tbl_usuaris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usuaris` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `tipusIdent` varchar(10) NOT NULL,
  `numeroIdent` varchar(15) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `cognoms` varchar(30) NOT NULL,
  `sexe` varchar(4) NOT NULL,
  `naixement` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `adreca` varchar(100) DEFAULT NULL,
  `codiPostal` varchar(5) DEFAULT NULL,
  `poblacio` varchar(40) DEFAULT NULL,
  `provincia` varchar(40) DEFAULT NULL,
  `telefon` varchar(12) DEFAULT NULL,
  `imatge` varchar(200) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT ' 0: pendent 1:confirmat 2:administradors',
  `navegador` varchar(50) NOT NULL,
  `plataforma` varchar(50) NOT NULL,
  `dataCreacio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dataDarrerAcces` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6446 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuaris`
--

LOCK TABLES `tbl_usuaris` WRITE;
/*!40000 ALTER TABLE `tbl_usuaris` DISABLE KEYS */;
INSERT INTO `tbl_usuaris` VALUES (6445,'joel29tr@gmail.com','hjfvjkgthyj','DNI','39878787Z','Joel','tornay rojano','M','2024-01-10','','','','',NULL,'1706632434810',1,'Chrome/120.0.0.0','Linux x86_64','2024-01-30 16:34:30','2024-01-30 16:34:30');
/*!40000 ALTER TABLE `tbl_usuaris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_zona`
--

DROP TABLE IF EXISTS `tbl_zona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_zona` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcio` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_zona`
--

LOCK TABLES `tbl_zona` WRITE;
/*!40000 ALTER TABLE `tbl_zona` DISABLE KEYS */;
INSERT INTO `tbl_zona` VALUES (1,'PLATEA'),(2,''),(4,'ANFITEATRE'),(5,'ZONA VIP'),(6,'TRIBUNA'),(7,'1a GRADERIA'),(8,'2a GRADERIA'),(9,'3a GRADERIA'),(10,'ACCES 101'),(11,'ACCES 102'),(18,'ACCES 103'),(26,'ACCES 104');
/*!40000 ALTER TABLE `tbl_zona` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-09 12:15:42
