<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105160524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'CMA style';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("
        -- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: 51.15.227.52    Database: iut_lp_00
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `CONTAINER`
--

DROP TABLE IF EXISTS `CONTAINER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CONTAINER` (
                             `ID` int(11) NOT NULL AUTO_INCREMENT,
                             `COLOR` varchar(20) DEFAULT NULL,
                             `CONTAINER_MODEL_ID` int(11) DEFAULT NULL,
                             `CONTAINERSHIP_ID` int(11) DEFAULT NULL,
                             PRIMARY KEY (`ID`),
                             UNIQUE KEY `CONTAINER_ID_uindex` (`ID`),
                             KEY `CONTAINER_CONTAINER_MODEL_ID_fk` (`CONTAINER_MODEL_ID`),
                             KEY `CONTAINER_CONTAINERSHIP_ID_fk` (`CONTAINERSHIP_ID`),
                             CONSTRAINT `CONTAINER_CONTAINERSHIP_ID_fk` FOREIGN KEY (`CONTAINERSHIP_ID`) REFERENCES `CONTAINERSHIP` (`ID`),
                             CONSTRAINT `CONTAINER_CONTAINER_MODEL_ID_fk` FOREIGN KEY (`CONTAINER_MODEL_ID`) REFERENCES `CONTAINER_MODEL` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=latin1 COMMENT='Vous voyer les conteneurs sur les bateaux, c''est ça';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CONTAINER`
--

LOCK TABLES `CONTAINER` WRITE;
/*!40000 ALTER TABLE `CONTAINER` DISABLE KEYS */;
INSERT INTO `CONTAINER` VALUES (3,'ROUGE',3,2),(4,'BLEU',1,3),(5,'BLEU',1,3),(6,'BLEU',1,3),(7,'BLEU',1,3),(8,'VERT',2,1),(9,'VERT',2,1),(10,'VERT',2,1),(11,'VERT',2,1),(12,'VERT',2,1),(13,'VERT',2,1),(14,'VERT',2,1),(15,'VERT',2,1),(16,'VERT',2,1),(17,'VERT',2,1),(18,'VERT',2,1),(19,'VERT',2,1),(20,'VERT',2,1),(21,'VERT',2,1),(22,'VERT',2,1),(23,'VERT',2,1),(24,'VERT',2,1),(25,'VERT',2,1),(26,'VERT',2,1),(27,'VERT',2,1),(28,'VERT',2,1),(29,'VERT',2,1),(30,'VERT',2,1),(31,'VERT',2,1),(32,'VERT',2,1),(33,'VERT',2,1),(34,'VERT',2,1),(35,'VERT',2,1),(36,'VERT',2,1),(37,'VERT',2,1),(38,'VERT',2,1),(39,'VERT',2,1),(40,'VERT',2,1),(41,'VERT',2,1),(42,'VERT',2,1),(43,'VERT',2,1),(44,'VERT',2,1),(45,'VERT',2,1),(46,'VERT',2,1),(47,'VERT',2,1),(48,'VERT',2,1),(49,'VERT',2,1),(50,'VERT',2,1),(51,'VERT',2,1),(52,'VERT',2,1),(53,'VERT',2,1),(54,'VERT',2,1),(55,'VERT',2,1),(56,'VERT',2,1),(57,'VERT',2,1),(58,'VERT',2,1),(59,'VERT',2,1),(60,'VERT',2,1),(61,'VERT',2,1),(62,'VERT',2,1),(63,'VERT',2,1),(64,'VERT',2,1),(65,'VERT',2,1),(66,'VERT',2,1),(67,'VERT',2,1),(68,'VERT',2,1),(69,'VERT',2,1),(70,'VERT',2,1),(71,'VERT',2,1),(72,'VERT',2,1),(73,'VERT',2,1),(74,'VERT',2,1),(75,'VERT',2,1),(76,'VERT',2,1),(77,'VERT',2,1),(78,'VERT',2,1),(79,'VERT',2,1),(80,'VERT',2,1),(81,'VERT',2,1),(82,'VERT',2,1),(83,'VERT',2,1),(84,'VERT',2,1),(85,'VERT',2,1),(86,'VERT',2,1),(87,'VERT',2,1),(88,'VERT',2,1),(89,'VERT',2,1),(90,'VERT',2,1),(91,'VERT',2,1),(92,'VERT',2,1),(93,'VERT',2,1),(94,'VERT',2,1),(95,'VERT',2,1),(96,'VERT',2,1),(97,'VERT',2,1),(98,'VERT',2,1),(99,'VERT',2,1),(100,'VERT',2,1),(101,'VERT',2,1),(102,'VERT',2,1),(103,'VERT',2,1),(104,'VERT',2,1),(105,'VERT',2,1),(106,'VERT',2,1),(107,'VERT',2,1),(108,'VERT',2,1),(109,'VERT',2,1),(110,'VERT',2,1),(111,'VERT',2,1),(112,'VERT',2,1),(113,'VERT',2,1),(114,'VERT',2,1),(115,'VERT',2,1),(116,'VERT',2,1),(117,'VERT',2,1),(118,'VERT',2,1),(119,'VERT',2,1),(120,'VERT',2,1),(121,'VERT',2,1),(122,'VERT',2,1),(123,'VERT',2,1),(124,'VERT',2,1),(125,'VERT',2,1),(126,'VERT',2,1),(127,'VERT',2,1),(128,'VERT',2,1),(129,'VERT',2,1),(130,'VERT',2,1),(131,'VERT',2,1),(132,'VERT',2,1),(133,'VERT',2,1),(134,'VERT',2,1),(135,'VERT',2,1),(136,'VERT',3,1),(137,'VERT',3,1),(138,'VERT',3,1),(139,'VERT',3,1),(140,'VERT',3,1),(141,'VERT',3,1),(142,'VERT',3,1),(143,'VERT',3,1),(144,'VERT',3,1),(145,'VERT',3,1),(146,'VERT',3,1),(147,'VERT',3,1),(148,'VERT',3,1),(149,'VERT',3,1),(150,'VERT',3,1),(151,'VERT',3,1),(152,'VERT',3,1),(153,'VERT',3,1),(154,'VERT',3,1),(155,'VERT',3,1),(156,'VERT',3,1),(157,'VERT',3,1),(158,'VERT',3,1),(159,'VERT',3,1),(160,'VERT',3,1),(161,'VERT',3,1),(162,'VERT',3,1),(163,'VERT',3,1),(164,'VERT',3,1),(165,'VERT',3,1),(166,'VERT',1,1),(167,'VERT',1,1),(168,'VERT',1,1),(169,'VERT',1,1),(170,'VERT',1,1),(171,'VERT',1,1),(172,'VERT',1,1),(173,'VERT',1,1),(174,'VERT',1,1),(175,'VERT',1,1),(176,'VERT',1,1),(177,'VERT',1,1),(178,'VERT',1,1),(179,'VERT',1,1),(180,'VERT',1,1),(181,'VERT',1,1),(182,'VERT',1,1),(183,'VERT',1,1),(184,'VERT',1,1),(185,'VERT',1,1),(186,'VERT',1,1),(187,'VERT',1,1),(188,'VERT',1,1),(189,'VERT',1,1),(190,'VERT',1,1),(191,'VERT',1,1),(192,'VERT',1,1),(193,'VERT',1,1),(194,'VERT',1,1),(195,'VERT',1,1),(196,'VERT',1,1),(197,'VERT',1,1),(198,'VERT',1,1),(199,'VERT',1,1),(200,'VERT',1,1),(201,'VERT',1,1),(202,'VERT',1,1),(203,'VERT',1,1),(204,'VERT',1,1),(205,'VERT',1,1),(206,'VERT',1,1),(207,'VERT',1,1),(208,'VERT',1,1),(209,'VERT',1,1),(210,'VERT',1,1),(211,'VERT',1,1),(212,'VERT',1,1),(213,'VERT',1,1),(214,'VERT',1,1),(215,'VERT',1,1),(216,'VERT',1,1),(217,'VERT',1,1),(218,'VERT',1,1),(219,'VERT',1,1),(220,'VERT',1,1),(221,'VERT',1,1),(222,'VERT',1,1),(223,'VERT',1,1),(224,'VERT',1,1),(225,'VERT',1,1),(226,'VERT',1,1),(227,'VERT',1,1),(228,'VERT',1,1),(229,'VERT',1,1),(230,'VERT',1,1),(231,'VERT',1,1),(232,'VERT',1,1),(233,'VERT',1,1),(234,'VERT',1,1),(235,'VERT',1,1),(236,'VERT',1,1),(237,'VERT',1,1),(238,'VERT',1,1),(239,'VERT',1,1),(240,'VERT',1,1),(241,'VERT',1,1),(242,'VERT',1,1),(243,'VERT',1,1),(244,'VERT',1,1),(245,'VERT',1,1),(246,'VERT',1,1),(247,'VERT',1,1),(248,'VERT',1,1),(249,'VERT',1,1),(250,'VERT',1,1),(251,'VERT',1,1),(252,'VERT',1,1),(253,'VERT',1,1),(254,'VERT',1,1),(255,'VERT',1,1),(256,'VERT',1,1),(257,'VERT',1,1),(258,'VERT',1,1),(259,'VERT',1,1),(260,'VERT',1,1),(261,'VERT',1,1),(262,'VERT',1,1),(263,'VERT',1,1),(264,'VERT',1,1),(265,'VERT',1,1),(266,'VERT',1,1),(267,'VERT',1,1);
/*!40000 ALTER TABLE `CONTAINER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CONTAINERSHIP`
--

DROP TABLE IF EXISTS `CONTAINERSHIP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CONTAINERSHIP` (
                                 `ID` int(11) NOT NULL AUTO_INCREMENT,
                                 `NAME` varchar(255) DEFAULT NULL,
                                 `CAPTAIN_NAME` varchar(255) DEFAULT NULL,
                                 `CONTAINER_LIMIT` int(11) DEFAULT NULL,
                                 PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Vous voyez les bateaux qui transportent des conteneurs, c''est ça';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CONTAINERSHIP`
--

LOCK TABLES `CONTAINERSHIP` WRITE;
/*!40000 ALTER TABLE `CONTAINERSHIP` DISABLE KEYS */;
INSERT INTO `CONTAINERSHIP` VALUES (1,'Costa Concorla','Bob',600),(2,'Petite Barque','Fernandel',1),(3,'P\'titanic','Gérard',6);
/*!40000 ALTER TABLE `CONTAINERSHIP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CONTAINER_MODEL`
--

DROP TABLE IF EXISTS `CONTAINER_MODEL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CONTAINER_MODEL` (
                                   `ID` int(11) NOT NULL AUTO_INCREMENT,
                                   `NAME` varchar(255) DEFAULT NULL,
                                   `LENGTH` int(11) DEFAULT NULL,
                                   `WIDTH` int(11) DEFAULT NULL,
                                   `HEIGHT` int(11) DEFAULT NULL,
                                   PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CONTAINER_MODEL`
--

LOCK TABLES `CONTAINER_MODEL` WRITE;
/*!40000 ALTER TABLE `CONTAINER_MODEL` DISABLE KEYS */;
INSERT INTO `CONTAINER_MODEL` VALUES (1,'P\'tit Container',5000,3000,3000),(2,'Moyen Container',10000,3000,3000),(3,'Fat Container',20000,3000,3000);
/*!40000 ALTER TABLE `CONTAINER_MODEL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CONTAINER_PRODUCT`
--

DROP TABLE IF EXISTS `CONTAINER_PRODUCT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CONTAINER_PRODUCT` (
                                     `ID` int(11) NOT NULL AUTO_INCREMENT,
                                     `CONTAINER_ID` int(11) DEFAULT NULL,
                                     `PRODUCT_ID` int(11) DEFAULT NULL,
                                     `QUANTITY` int(11) DEFAULT NULL,
                                     PRIMARY KEY (`ID`),
                                     KEY `CONTAINER_PRODUCT_CONTAINER_ID_fk` (`CONTAINER_ID`),
                                     KEY `CONTAINER_PRODUCT_PRODUCT_ID_fk` (`PRODUCT_ID`),
                                     CONSTRAINT `CONTAINER_PRODUCT_CONTAINER_ID_fk` FOREIGN KEY (`CONTAINER_ID`) REFERENCES `CONTAINER` (`ID`),
                                     CONSTRAINT `CONTAINER_PRODUCT_PRODUCT_ID_fk` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `PRODUCT` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='C''est là où on stocke le nombre de produits dans les conteneurs';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CONTAINER_PRODUCT`
--

LOCK TABLES `CONTAINER_PRODUCT` WRITE;
/*!40000 ALTER TABLE `CONTAINER_PRODUCT` DISABLE KEYS */;
INSERT INTO `CONTAINER_PRODUCT` VALUES (1,3,1,1),(2,3,4,1000),(3,151,4,2400);
/*!40000 ALTER TABLE `CONTAINER_PRODUCT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PRODUCT`
--

DROP TABLE IF EXISTS `PRODUCT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUCT` (
                           `ID` int(11) NOT NULL AUTO_INCREMENT,
                           `NAME` varchar(255) DEFAULT NULL,
                           `LENGTH` int(11) DEFAULT NULL,
                           `WIDTH` int(11) DEFAULT NULL,
                           `HEIGHT` int(11) DEFAULT NULL,
                           PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='C''est des trucs qu''on met dans les conteneurs';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PRODUCT`
--

LOCK TABLES `PRODUCT` WRITE;
/*!40000 ALTER TABLE `PRODUCT` DISABLE KEYS */;
INSERT INTO `PRODUCT` VALUES (1,'Voiture',4000,2500,2000),(2,'Switch',500,200,150),(3,'Sel',1000,1000,1000),(4,'Biere',500,300,500);
/*!40000 ALTER TABLE `PRODUCT` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-21  9:32:07");
    }
    
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
