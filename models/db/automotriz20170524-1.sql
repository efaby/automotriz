CREATE DATABASE  IF NOT EXISTS `automotriz` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `automotriz`;
-- MySQL dump 10.13  Distrib 5.7.9, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: automotriz
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

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
-- Table structure for table `estado_vehiculo`
--

DROP TABLE IF EXISTS `estado_vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_vehiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_vehiculo`
--

LOCK TABLES `estado_vehiculo` WRITE;
/*!40000 ALTER TABLE `estado_vehiculo` DISABLE KEYS */;
INSERT INTO `estado_vehiculo` VALUES (1,'Funcional'),(2,'Mantenimiento'),(3,'Descompuesto');
/*!40000 ALTER TABLE `estado_vehiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `novedad`
--

DROP TABLE IF EXISTS `novedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `novedad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehiculo_id` int(11) NOT NULL,
  `problema` varchar(1204) NOT NULL,
  `causa` varchar(1024) NOT NULL,
  `solucion` varchar(1024) DEFAULT NULL,
  `proceso` varchar(1024) DEFAULT NULL,
  `elementos` varchar(1024) DEFAULT NULL,
  `observaciones` varchar(1024) DEFAULT NULL,
  `tecnico_asigna` int(11) DEFAULT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `tecnico_repara` int(11) DEFAULT NULL,
  `usuario_registra` int(11) NOT NULL,
  `tiempo_ejecucion` varchar(128) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_atencion` date DEFAULT NULL,
  `atendido` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_novedad_vehiculo1_idx` (`vehiculo_id`),
  CONSTRAINT `fk_novedad_vehiculo1` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `novedad`
--

LOCK TABLES `novedad` WRITE;
/*!40000 ALTER TABLE `novedad` DISABLE KEYS */;
/*!40000 ALTER TABLE `novedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orden_plan`
--

DROP TABLE IF EXISTS `orden_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehiculo_plan_id` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_atencion` date DEFAULT NULL,
  `tiempo_ejecucion` varchar(64) DEFAULT NULL,
  `observacion` varchar(1024) DEFAULT NULL,
  `tecnico_atiende` int(11) DEFAULT NULL,
  `atendido` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_orden_plan_vehiculo_plan1_idx` (`vehiculo_plan_id`),
  CONSTRAINT `fk_orden_plan_vehiculo_plan1` FOREIGN KEY (`vehiculo_plan_id`) REFERENCES `vehiculo_plan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden_plan`
--

LOCK TABLES `orden_plan` WRITE;
/*!40000 ALTER TABLE `orden_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `orden_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan_mantenimiento`
--

DROP TABLE IF EXISTS `plan_mantenimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan_mantenimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tiempo_ejecucion` varchar(64) NOT NULL,
  `estado_maquina` tinyint(4) NOT NULL,
  `herramientas` varchar(256) NOT NULL,
  `materiales` varchar(256) NOT NULL,
  `equipo` varchar(256) NOT NULL,
  `procedimiento` text NOT NULL,
  `observaciones` varchar(2048) NOT NULL,
  `tarea` varchar(1024) NOT NULL,
  `tecnico_id` int(11) NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan_mantenimiento`
--

LOCK TABLES `plan_mantenimiento` WRITE;
/*!40000 ALTER TABLE `plan_mantenimiento` DISABLE KEYS */;
INSERT INTO `plan_mantenimiento` VALUES (1,'10',1,'as','materiales','equipo','&lt;p&gt;pruebas&lt;/p&gt;','&lt;p&gt;pruebas&lt;/p&gt;','Tarea',2,0),(2,'sd',0,'k','kk','k','&lt;p&gt;dslds&lt;/p&gt;','&lt;p&gt;lsdl&lt;/p&gt;','sd',2,1),(3,'34',1,'34','34','43','&lt;p&gt;34&lt;/p&gt;','&lt;p&gt;3443&lt;/p&gt;','43',2,1);
/*!40000 ALTER TABLE `plan_mantenimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Administrador','Usuario Adminstrador'),(2,'Técnico','Usuario Técnico'),(3,'Conductor','Usuario Conductor Vehiculo'),(4,'Operador','Usuario Operador de Maquinaria');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_vehiculo`
--

DROP TABLE IF EXISTS `tipo_vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_vehiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `padre` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_vehiculo`
--

LOCK TABLES `tipo_vehiculo` WRITE;
/*!40000 ALTER TABLE `tipo_vehiculo` DISABLE KEYS */;
INSERT INTO `tipo_vehiculo` VALUES (1,'Vehiculo',0),(2,'Maquinaria',0),(3,'Vehiculo Liviano',1),(4,'Vehiculo Pesado',1),(5,'Maquinaria Pesada',2),(6,'Vehiculo Gasolina',3),(7,'Vehiculo Diesel',3),(8,'Rodillo',5),(9,'Restroescabadora',5),(10,'Cargadora Frontal',5),(11,'Motoniveladora',5),(12,'Bulldocer',5),(13,'Vehiculo Diesel',4);
/*!40000 ALTER TABLE `tipo_vehiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidad`
--

DROP TABLE IF EXISTS `unidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL,
  `descripcion` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidad`
--

LOCK TABLES `unidad` WRITE;
/*!40000 ALTER TABLE `unidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario_id` int(11) NOT NULL,
  `nombres` varchar(64) NOT NULL,
  `apellidos` varchar(64) NOT NULL,
  `identificacion` varchar(13) NOT NULL,
  `direccion` varchar(512) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `usuario` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_tecnico_tipo_usuario_idx` (`tipo_usuario_id`),
  CONSTRAINT `fk_tecnico_tipo_usuario` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'Fabian','Villa','0603108770','Calle 2','2222222222','1111111111','efaby10@gmail.com','efaby','e10adc3949ba59abbe56e057f20f883e',0),(2,2,'Carlos','Perez','0603718577','calle 4','','','mail1@mail.com','0603718577','e10adc3949ba59abbe56e057f20f883e',0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiculo`
--

DROP TABLE IF EXISTS `vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `tipo_vehiculo_id` int(11) NOT NULL,
  `estado_vehiculo_id` int(11) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `numero` varchar(64) NOT NULL,
  `marca` varchar(128) NOT NULL,
  `modelo` varchar(128) NOT NULL,
  `anio` int(11) NOT NULL,
  `numero_motor` varchar(64) NOT NULL,
  `numero_chasis` varchar(64) NOT NULL,
  `medida_uso` double NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_vehiculo_estado_vehiculo1_idx` (`estado_vehiculo_id`),
  KEY `fk_vehiculo_usuario1_idx` (`usuario_id`),
  KEY `fk_vehiculo_tipo_vehiculo1_idx` (`tipo_vehiculo_id`),
  CONSTRAINT `fk_vehiculo_estado_vehiculo1` FOREIGN KEY (`estado_vehiculo_id`) REFERENCES `estado_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehiculo_tipo_vehiculo1` FOREIGN KEY (`tipo_vehiculo_id`) REFERENCES `tipo_vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehiculo_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculo`
--

LOCK TABLES `vehiculo` WRITE;
/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiculo_plan`
--

DROP TABLE IF EXISTS `vehiculo_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehiculo_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehiculo_id` int(11) NOT NULL,
  `plan_mantenimiento_id` int(11) NOT NULL,
  `unidad_id` int(11) NOT NULL,
  `numero_operacion` decimal(5,2) NOT NULL DEFAULT '0.00',
  `unidad_numero` int(11) NOT NULL DEFAULT '0',
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_registro` date NOT NULL,
  `fecha_inicio` date NOT NULL,
  `alerta_numero` int(11) NOT NULL,
  `numero_totales` decimal(5,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `fk_vehiculo_plan_unidad1_idx` (`unidad_id`),
  KEY `fk_vehiculo_plan_vehiculo1_idx` (`vehiculo_id`),
  KEY `fk_vehiculo_plan_plan_mantenimiento1_idx` (`plan_mantenimiento_id`),
  CONSTRAINT `fk_vehiculo_plan_plan_mantenimiento1` FOREIGN KEY (`plan_mantenimiento_id`) REFERENCES `plan_mantenimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehiculo_plan_unidad1` FOREIGN KEY (`unidad_id`) REFERENCES `unidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehiculo_plan_vehiculo1` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculo_plan`
--

LOCK TABLES `vehiculo_plan` WRITE;
/*!40000 ALTER TABLE `vehiculo_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehiculo_plan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-24 16:30:06
