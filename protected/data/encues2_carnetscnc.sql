-- MySQL dump 10.13  Distrib 5.5.37, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: encues2_carnetscnc
-- ------------------------------------------------------
-- Server version	5.5.37-0ubuntu0.14.04.1

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
-- Table structure for table `AuthAssignment`
--

DROP TABLE IF EXISTS `AuthAssignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `AuthItem`
--

DROP TABLE IF EXISTS `AuthItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `AuthItemChild`
--

DROP TABLE IF EXISTS `AuthItemChild`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(254) DEFAULT NULL,
  `nombre` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `cedula` bigint(20) NOT NULL,
  `tipo_persona` int(11) NOT NULL DEFAULT '1' COMMENT '1:encuestador, 2:supervisor',
  `f_validez_inicial` date DEFAULT NULL COMMENT 'Válido desde',
  `f_caducidad` date DEFAULT NULL COMMENT 'Válido hasta',
  `foto` varchar(100) DEFAULT NULL COMMENT 'Foto',
  `ciudad_encuesta` varchar(100) NOT NULL,
  `dir_domicilio` varchar(100) NOT NULL,
  `ciudad_domicilio` varchar(100) DEFAULT NULL,
  `fec_nacimiento` date NOT NULL,
  `lugar_nacimiento` varchar(100) NOT NULL,
  `genero` enum('M','F') NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `celular` varchar(25) DEFAULT NULL,
  `ocupacion` varchar(150) NOT NULL,
  `estado_civil` char(2) NOT NULL,
  `tiene_experiencia_encuestador` enum('S','N') NOT NULL,
  `tiempo_experiencia_encuestador` varchar(50) DEFAULT NULL,
  `bachiller_titulo` varchar(180) DEFAULT NULL,
  `bachiller_estado` enum('C','N') NOT NULL,
  `bachiller_grado` varchar(255) DEFAULT NULL,
  `tecnico_titulo` varchar(150) DEFAULT NULL,
  `tecnico_estado` enum('C','N') NOT NULL COMMENT 'C= culminado,\nN = No culminado',
  `tecnico_grado` varchar(150) DEFAULT NULL,
  `profesional_titulo` varchar(150) DEFAULT NULL,
  `profesional_estado` enum('C','N') NOT NULL,
  `profesional_grado` varchar(150) DEFAULT NULL,
  `postgrados_titulo` varchar(150) DEFAULT NULL,
  `postgrados_estado` enum('C','N') NOT NULL,
  `postgrados_grado` varchar(150) DEFAULT NULL,
  `actualmente_estudia` enum('S','N') NOT NULL,
  `Horario_estudio` timestamp NULL DEFAULT NULL,
  `experiencia_empresa1` varchar(255) DEFAULT NULL,
  `cargo_empresa1` varchar(255) DEFAULT NULL,
  `telefono_empresa1` varchar(255) DEFAULT NULL,
  `ciudad_empresa1` varchar(255) DEFAULT NULL,
  `tipo_contrato_empresa1` varchar(255) DEFAULT NULL,
  `fec_ingreso_empresa1` date DEFAULT NULL,
  `fec_retiro_empresa1` date DEFAULT NULL,
  `tiempo_total_empresa1` varchar(150) DEFAULT NULL,
  `Motivo_retiro_empresa1` varchar(255) DEFAULT NULL,
  `funciones_realizadas_empresa1` varchar(255) DEFAULT NULL,
  `nombre_empresa1` varchar(150) DEFAULT NULL,
  `nombre_empresa2` varchar(150) DEFAULT NULL,
  `cargo_empresa2` varchar(150) DEFAULT NULL,
  `telefono_empresa2` varchar(150) DEFAULT NULL,
  `ciudad_empresa2` varchar(150) DEFAULT NULL,
  `tipo_contrato_empresa2` varchar(150) DEFAULT NULL,
  `fec_ingreso_empresa2` date DEFAULT NULL,
  `fec_retiro_empresa2` date DEFAULT NULL,
  `tiempo_total_empresa2` varchar(150) DEFAULT NULL,
  `Motivo_retiro_empresa2` varchar(255) DEFAULT NULL,
  `funciones_realizadas_empresa2` varchar(255) DEFAULT NULL,
  `nombre_empresa3` varchar(150) DEFAULT NULL,
  `cargo_empresa3` varchar(150) DEFAULT NULL,
  `telefono_empresa3` varchar(150) DEFAULT NULL,
  `ciudad_empresa3` varchar(150) DEFAULT NULL,
  `tipo_contrato_empresa3` varchar(150) DEFAULT NULL,
  `fec_ingreso_empresa3` date DEFAULT NULL,
  `fec_retiro_empresa3` date DEFAULT NULL,
  `tiempo_total_empresa3` varchar(150) DEFAULT NULL,
  `Motivo_retiro_empresa3` varchar(255) DEFAULT NULL,
  `funciones_realizadas_empresa3` varchar(255) DEFAULT NULL,
  `fecha_trabajo_cnc` date DEFAULT NULL,
  `servicios_cnc` enum('S','N') NOT NULL COMMENT 'S= si presento servicios en la cnc,\nN= no presento servicios en la cnn',
  `Tipo_servicio_cnc` enum('T','C') DEFAULT NULL COMMENT 'T=telefonico , C = Campo',
  `nombre_coordinadora` varchar(120) DEFAULT NULL,
  `experiencia_tiempo` varchar(255) DEFAULT NULL,
  `bachiller_institucion` varchar(255) DEFAULT NULL,
  `tecnico_institucion` varchar(255) DEFAULT NULL,
  `tecnologo_institucion` varchar(255) DEFAULT NULL,
  `profecional_institucion` varchar(255) DEFAULT NULL,
  `postgrado_institucion` varchar(255) DEFAULT NULL,
  `tecnologo_estado` enum('C','N') NOT NULL COMMENT 'C= culminado, N = No culminado',
  `tecnologo_grado` varchar(120) NOT NULL COMMENT 'C= culminado, N = No culminado',
  `tecnologo_titulo` varchar(120) NOT NULL COMMENT 'C= culminado, N = No culminado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `referencias_laborales`
--

DROP TABLE IF EXISTS `referencias_laborales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referencias_laborales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compañia` varchar(150) NOT NULL,
  `cargo` varchar(150) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `id_persona` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`id`),
  KEY `index_id` (`id`),
  KEY `referencias_laborales_persona_FK` (`id_persona`),
  CONSTRAINT `referencias_laborales_persona_FK` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `referencias_personales`
--

DROP TABLE IF EXISTS `referencias_personales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `referencias_personales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `id_persona` bigint(19) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `referencias_personales_persona_FK` (`id_persona`),
  CONSTRAINT `referencias_personales_persona_FK` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-10 10:33:25
