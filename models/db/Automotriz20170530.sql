CREATE DATABASE  IF NOT EXISTS `automotriz` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `automotriz`;
-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: automotriz
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan_mantenimiento`
--

LOCK TABLES `plan_mantenimiento` WRITE;
/*!40000 ALTER TABLE `plan_mantenimiento` DISABLE KEYS */;
INSERT INTO `plan_mantenimiento` VALUES (1,'30 min',0,'juego de llaves','liquido','equipo','&lt;p&gt;1.- Apagar el veh&amp;iacute;culo.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Desconectar los terminales de la bobina en caso de ser bobinas COP caso contrario extraer los cables de alta tensi&amp;oacute;n.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Extraer las buj&amp;iacute;as y revisar la distancia entre electrodos que la luz tenga 0.8 mm.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.- Realizar una limpieza y colocar nuevamente.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Con la Buj&amp;iacute;a limpia procedemos al colocar.&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión de distancia entre electrodos',2,0),(2,'sd',0,'k','kk','k','&lt;p&gt;dslds&lt;/p&gt;','&lt;p&gt;lsdl&lt;/p&gt;','sd',2,1),(3,'34',1,'34','34','43','&lt;p&gt;34&lt;/p&gt;','&lt;p&gt;3443&lt;/p&gt;','43',2,1),(4,'30 min',0,'Juego de llaves, caja de herramientas de 1','1 silicon, guiape','compresor neumático','&lt;p&gt;1.- Apagar el veh&amp;iacute;culo.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Extraer el protector del Carter&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Revisar si existe fugas de aceite por la parte superior del Carter en caso de existir sacar el Carter realizar una limpieza y sustituir el empaque de Carter y colocar nuevamente.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.- Revisar si existe fugas de aceite por el tap&amp;oacute;n del Carter en caso de existir remplazar el tap&amp;oacute;n del Carter.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- En la parte de tapa v&amp;aacute;lvulas revisar de igual manera en caso de existir fugas extraer la tapa v&amp;aacute;lvulas limpiar la tapa v&amp;aacute;lvulas y remplazar el empaque de tapa v&amp;aacute;lvulas&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Realizar un ajuste necesario tanto en la tapa v&amp;aacute;lvulas, el Carter&lt;/p&gt;\r\n\r\n&lt;p&gt;6.- completar el aceite al nivel indicado por la varilla.&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Inspección visual de fugas de aceite',5,0),(5,'3H',0,'Juego de llaves','Empaque de base de filtro','torquimetro','&lt;p&gt;1.- Apagar el veh&amp;iacute;culo.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Quitar el protector del Carter dejar la parte del base del filtro lo m&amp;aacute;s visible y manipulable posible.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Con un torqui metro dar un torque de 10lbs luego 20, hasta llegar 30lbs.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.- En caso de fugas por la base del filtro extraer la base del filtro, realizar una limpieza con un guaipe y remplazar el empaque de base del filtro.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;5.- Colocar correctamente con una capa de silic&amp;oacute;n.&lt;/p&gt;\r\n\r\n&lt;p&gt;6.- Dar un torque de 30lbs&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión del torque adecuado del filtro de aceite',2,0),(6,'2H',0,'juego de llaves','Juejo de bujias','compresor','&lt;p&gt;1.- Apagar el veh&amp;iacute;culo.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Elevar el veh&amp;iacute;culo con una gata hidr&amp;aacute;ulica tipo lagarto y embancarlo.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Extraer los neum&amp;aacute;ticos.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.- Revisar si tiene agrietamientos los bujes si lo tiene sustituir.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Extraer los amortiguadores y con un compresor de muelle suspensi&amp;oacute;n retirar los muelles y cambiarlos.&lt;/p&gt;\r\n\r\n&lt;p&gt;6.- Realizar una limpieza&lt;/p&gt;\r\n\r\n&lt;p&gt;7.- Realizar la instalaci&amp;oacute;n correctamente&lt;/p&gt;','&lt;p&gt;la persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión de los bujes de los amortiguadores',13,0),(7,'1h',0,'juego de llaves','hojas de ballestas','gata hidráulica','&lt;p&gt;1.- Apagar el veh&amp;iacute;culo.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Elevar un veh&amp;iacute;culo con una gata hidr&amp;aacute;ulica tipo lagarto y embancarlo.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Realizar una limpieza con un aire comprimido y guipe.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.-Revisar si los hojas de las ballestas tienen alg&amp;uacute;n ruptura o fisura si est&amp;aacute; en mal estado sustituir.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Extraer las tuercas que sujetan a las ballesta.&lt;/p&gt;\r\n\r\n&lt;p&gt;6.-Sustituir las ballestas e instalar correctamente.&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión de las hojas de ballesta',5,0),(8,'2h',0,'juego de llaves','kit de reparacion de motores de motor de arranque','punta logica, multimetro','&lt;p&gt;1.- Apagar la maquinaria.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Desconectar la bater&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Quitar los protectores y ubicar el motor de arranque.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.-Desconectar el cableado de alimentaci&amp;oacute;n de 12v del Switch del solenoide, y de la fuente de 12v directo de la bater&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Extraer los pernos que sujetan el motor de arranque.&lt;/p&gt;\r\n\r\n&lt;p&gt;6.-Una vez afuera el motor de arranque, revisar el bendix y si tiene ruptura de alg&amp;uacute;n engranaje o desgate remplazarlo.&lt;/p&gt;\r\n\r\n&lt;p&gt;7.-Realizar una limpieza e instalarlo correctamente.&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión del bendix del motor de arranque',4,0),(9,'2h',0,'juego de llaves','kit de reparación de motor de arranque','punta logica','&lt;p&gt;1.- Apagar la maquinaria.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Desconectar la bater&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Quitar los protectores y ubicar el motor de arranque.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.-Desconectar el cableado de alimentaci&amp;oacute;n de 12v del Switch del solenoide, y de la fuente de 12v directo de la bater&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Extraer los pernos que sujetan el motor de arranque.&lt;/p&gt;\r\n\r\n&lt;p&gt;6.- Desarmar el motor de arranque tener cuidado con el solenoide y las escobillas.&lt;/p&gt;\r\n\r\n&lt;p&gt;7.- Con un mult&amp;iacute;metro medir la continuidad del bobinada si no existe continuidad remplazarlo.&lt;/p&gt;\r\n\r\n&lt;p&gt;8.-Realizar una limpieza&lt;/p&gt;\r\n\r\n&lt;p&gt;9.-Instalar correctamente&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión del bobinado de motor de arranque',2,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Administrador','Usuario Adminstrador'),(2,'Secretario','Secretario general'),(3,'Conductor Livianos','Usuario Conductor Vehiculo Liviano'),(4,'Conductor Pesados','Usuario Conductor Vehiculo Pesados'),(5,'Operador','Usuario Operador de Pesados'),(6,'Técnico','Usuario Técnico');
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
INSERT INTO `tipo_vehiculo` VALUES (1,'Automotor Liviano Gasolina',0),(2,'Automotor Liviano Pesados',0),(3,'Automotor Pesados',0),(4,'Rodillo',0),(5,'Retroescabadora',0),(6,'Cargadora Frontal',0),(7,'Motoniveladora',0),(8,'Buldocer',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidad`
--

LOCK TABLES `unidad` WRITE;
/*!40000 ALTER TABLE `unidad` DISABLE KEYS */;
INSERT INTO `unidad` VALUES (1,'Kilometros','Kilometros'),(2,'Horas','Horas');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'Fabian','Villa','0603108770','argentinos y cubas','023689434','0893456794','efaby10@gmail.com','0603108770','e10adc3949ba59abbe56e057f20f883e',0),(2,2,'Carlos','Perez','0603718577','calle 4','','','mail1@mail.com','0603718577','e10adc3949ba59abbe56e057f20f883e',0),(3,3,'jose','gonza','0302424445','calle 12','234576285','0987858010','franciscobmv91@gmail.com','0302424445','81dc9bdb52d04dc20036dbd8313ed055',0),(4,2,'edison','tapia','0304556612','Calee 4','453672578','0983445567','sairi@92gmail.com','0304556612','81dc9bdb52d04dc20036dbd8313ed055',0),(5,2,'francisco','huerta','0302606231','diercion juan montalvo','234567853','0984716918','franciscohuerta1991@hotmail.com','0302606231','81dc9bdb52d04dc20036dbd8313ed055',0),(6,3,'Víctor ',' Peralta','0302674455','carrera ingapirca y 9 de octubre','432563357','0984765523','victore55@gmail.com','0302674455','81dc9bdb52d04dc20036dbd8313ed055',0),(7,3,'Homero ','Sacoto','0306558812','guayaquil y colon','235467892','0985453345','Sacoto67@hotmail.com','0306558812','81dc9bdb52d04dc20036dbd8313ed055',0),(8,3,'Germán ','Arévalo','0308565544','9 de agosto y colon','234567687','0989234543','Arévalo@hotmail.com','0308565544','81dc9bdb52d04dc20036dbd8313ed055',0),(9,3,'Miguel ','Cárdenas','06256788876','24 de mayo y colon','235467458','0987123458','Cárdenas@gmail.com','06256788876','81dc9bdb52d04dc20036dbd8313ed055',0),(10,3,'Luis ','Espinoza','03026876678','carrreno y gaspar','098123568','0983457523','Espinoza@hotmail.com','03026876678','81dc9bdb52d04dc20036dbd8313ed055',0),(11,4,'Ángel ','Crespo','0302675568','colon y gaspar','243678124','0984458877','Crespo@gmail.com','0302675568','81dc9bdb52d04dc20036dbd8313ed055',0),(12,4,'Jimmy ','Sacta','03667856434','Francia y colon','234566853','0981235678','Sacta@gmail.com','03667856434','81dc9bdb52d04dc20036dbd8313ed055',0),(13,2,'pablo','munoz','09856722445','10 de agosto y gaspar','235789235','0981345469','mununz@gmail.com','09856722445','81dc9bdb52d04dc20036dbd8313ed055',0);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculo`
--

LOCK TABLES `vehiculo` WRITE;
/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
INSERT INTO `vehiculo` VALUES (1,3,1,1,'USA-1230','1','CHEVROLET',2015,'4JJLX9761','8LBETF3N7F0267815',344,0),(2,3,1,1,'UBW-193','2','CHEVROLET',2012,'6BD1-175945','8LBETFS25H40113947',3456,0),(3,11,1,1,'ubs-234','1','KOMATSU',2010,'26518093','75353',2345,0),(4,11,4,1,'usa-123','2','KOMATSU',1991,'26528413','75572',5000,0),(5,9,7,1,'UMA-505','26','INTERNACIONAL',2010,'362GM2UB-135281','PH48807',350658,0),(6,10,7,1,'UMA-0077','37','STEYR',1995,'2122437265','LZFS19L172DO12935',200356,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculo_plan`
--

LOCK TABLES `vehiculo_plan` WRITE;
/*!40000 ALTER TABLE `vehiculo_plan` DISABLE KEYS */;
INSERT INTO `vehiculo_plan` VALUES (1,1,4,1,0.00,5000,1,'2017-05-25','2017-05-25',100,0.00),(2,1,1,1,0.00,5000,0,'2017-05-30','2017-05-30',10,0.00),(3,2,1,2,0.00,100,0,'2017-05-25','2017-05-25',10,0.00),(4,3,9,2,0.00,1000,0,'2017-05-27','2017-05-27',20,0.00),(5,1,4,1,0.00,5000,0,'2017-05-27','2017-05-27',100,0.00),(6,1,5,1,0.00,5000,0,'2017-05-27','2017-05-27',20,0.00),(7,3,8,2,0.00,1500,0,'2017-05-27','2017-05-27',20,0.00),(8,2,4,1,0.00,5000,0,'2017-05-27','2017-05-27',20,0.00),(9,2,5,1,0.00,5000,0,'2017-05-27','2017-05-27',10,0.00),(10,4,8,2,0.00,1000,0,'2017-05-27','2017-05-27',20,0.00),(11,4,9,2,0.00,1500,0,'2017-05-27','2017-05-27',20,0.00),(12,5,6,1,0.00,15000,0,'2017-05-27','2017-05-27',10,0.00),(13,5,7,1,0.00,20000,0,'2017-05-27','2017-05-27',10,0.00),(14,6,6,1,0.00,20000,0,'2017-05-27','2017-05-27',10,0.00),(15,6,7,1,0.00,20000,0,'2017-05-27','2017-05-27',20,0.00);
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

-- Dump completed on 2017-05-30  1:03:18
