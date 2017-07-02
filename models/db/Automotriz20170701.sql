CREATE DATABASE  IF NOT EXISTS `automotriz` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `automotriz`;
-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: automotriz
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `mantenimiento_respuestos`
--

DROP TABLE IF EXISTS `mantenimiento_respuestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenimiento_respuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `mantenimiento_id` int(11) NOT NULL,
  `tecnico_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `vehiculo_id` int(11) NOT NULL,
  `aprobado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenimiento_respuestos`
--

LOCK TABLES `mantenimiento_respuestos` WRITE;
/*!40000 ALTER TABLE `mantenimiento_respuestos` DISABLE KEYS */;
/*!40000 ALTER TABLE `mantenimiento_respuestos` ENABLE KEYS */;
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
  `causa` varchar(1024) DEFAULT NULL,
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
  `kilometraje` int(11) NOT NULL,
  `tipo_falla_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_novedad_vehiculo1_idx` (`vehiculo_id`),
  CONSTRAINT `fk_novedad_vehiculo1` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `novedad`
--

LOCK TABLES `novedad` WRITE;
/*!40000 ALTER TABLE `novedad` DISABLE KEYS */;
INSERT INTO `novedad` VALUES (1,1,'no enciende','Desconocida','otra pruebqqq','swdsd','zddad','',16,1,16,3,'3 horas','2017-06-11','2017-06-13',1,0,1),(2,1,'no encuiend luces','focos quemados','wdssd','sodjslkdjlsd osdjlsdmsdnmsd','sdsdsd.sdm','sfssd',16,1,16,3,'2 horas','2017-06-12','2017-06-15',1,0,40),(3,1,'wdsd','asdssasa','xcxcxc','asas','zsasa','sesdsd',14,1,14,3,'3 horas','2017-06-12','2017-06-14',1,600,7),(4,1,'','','otra prueba','sdssd','sdsd','',16,1,16,3,'3 horas','2017-06-13','2017-06-13',1,600,2),(5,1,'otro problem','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,NULL,'2017-06-13',NULL,0,750,0),(6,5,'pruebas','preubas','other','xdsdsd','sdsdsd','sdsdsd',14,1,14,9,'10 min','2017-06-21','2017-06-21',1,350678,5);
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
  `tecnico_asignado` int(11) NOT NULL,
  `fecha_atencion` date DEFAULT NULL,
  `tiempo_ejecucion` varchar(64) DEFAULT NULL,
  `observacion` varchar(1024) DEFAULT NULL,
  `tecnico_atiende` int(11) DEFAULT NULL,
  `atendido` int(11) NOT NULL DEFAULT '0',
  `kilometraje` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orden_plan_vehiculo_plan1_idx` (`vehiculo_plan_id`),
  CONSTRAINT `fk_orden_plan_vehiculo_plan1` FOREIGN KEY (`vehiculo_plan_id`) REFERENCES `vehiculo_plan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden_plan`
--

LOCK TABLES `orden_plan` WRITE;
/*!40000 ALTER TABLE `orden_plan` DISABLE KEYS */;
INSERT INTO `orden_plan` VALUES (7,22,'2017-06-07',16,'2017-06-07','39','sl',16,1,0),(8,22,'2017-06-11',16,'2017-06-12','30 minutos','he cmabia de a',16,1,0),(9,23,'2017-06-11',16,'2017-06-11','5 horas','ninguna',2,1,0),(10,21,'2017-06-12',2,NULL,NULL,NULL,NULL,0,0),(11,23,'2017-06-12',2,NULL,NULL,NULL,NULL,0,0),(12,22,'2017-06-13',16,NULL,NULL,NULL,NULL,0,0),(13,24,'2017-06-20',14,'2017-06-20','3 horas','wewewe',14,1,0),(14,25,'2017-06-21',14,'2017-06-21','2 horas','ninguna',14,1,0);
/*!40000 ALTER TABLE `orden_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orden_repuesto`
--

DROP TABLE IF EXISTS `orden_repuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden_repuesto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `repuesto_id` int(11) NOT NULL,
  `mantenimineto_respuesto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden_repuesto`
--

LOCK TABLES `orden_repuesto` WRITE;
/*!40000 ALTER TABLE `orden_repuesto` DISABLE KEYS */;
/*!40000 ALTER TABLE `orden_repuesto` ENABLE KEYS */;
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
  `equipo` varchar(256) DEFAULT NULL,
  `procedimiento` text NOT NULL,
  `observaciones` varchar(2048) NOT NULL,
  `tarea` varchar(1024) NOT NULL,
  `tecnico_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `unidad_id` int(11) NOT NULL,
  `unidad_numero` int(11) NOT NULL,
  `alerta_numero` int(11) NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `url` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan_mantenimiento`
--

LOCK TABLES `plan_mantenimiento` WRITE;
/*!40000 ALTER TABLE `plan_mantenimiento` DISABLE KEYS */;
INSERT INTO `plan_mantenimiento` VALUES (1,'30 min',0,'<p>juego de llaves</p>\r\n','<p>liquido</p>\r\n','equipo','&lt;p&gt;1.- Apagar el veh&amp;iacute;culo.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Desconectar los terminales de la bobina en caso de ser bobinas COP caso contrario extraer los cables de alta tensi&amp;oacute;n.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Extraer las buj&amp;iacute;as y revisar la distancia entre electrodos que la luz tenga 0.8 mm.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.- Realizar una limpieza y colocar nuevamente.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Con la Buj&amp;iacute;a limpia procedemos al colocar.&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión de distancia entre electrodos',2,1,1,350,10,0,'plan1329419111.pdf'),(2,'sd',0,'k','kk','k','&lt;p&gt;dslds&lt;/p&gt;','&lt;p&gt;lsdl&lt;/p&gt;','sd',2,1,0,0,0,1,NULL),(3,'34',1,'34','34','43','&lt;p&gt;34&lt;/p&gt;','&lt;p&gt;3443&lt;/p&gt;','43',2,2,0,0,0,1,NULL),(4,'30 min',0,'Juego de llaves, caja de herramientas de 1','1 silicon, guiape','compresor neumático','&lt;p&gt;1.- Apagar el veh&amp;iacute;culo.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Extraer el protector del Carter&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Revisar si existe fugas de aceite por la parte superior del Carter en caso de existir sacar el Carter realizar una limpieza y sustituir el empaque de Carter y colocar nuevamente.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.- Revisar si existe fugas de aceite por el tap&amp;oacute;n del Carter en caso de existir remplazar el tap&amp;oacute;n del Carter.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- En la parte de tapa v&amp;aacute;lvulas revisar de igual manera en caso de existir fugas extraer la tapa v&amp;aacute;lvulas limpiar la tapa v&amp;aacute;lvulas y remplazar el empaque de tapa v&amp;aacute;lvulas&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Realizar un ajuste necesario tanto en la tapa v&amp;aacute;lvulas, el Carter&lt;/p&gt;\r\n\r\n&lt;p&gt;6.- completar el aceite al nivel indicado por la varilla.&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Inspección visual de fugas de aceite',5,2,0,0,0,0,NULL),(5,'3H',0,'Juego de llaves','Empaque de base de filtro','torquimetro','&lt;p&gt;1.- Apagar el veh&amp;iacute;culo.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Quitar el protector del Carter dejar la parte del base del filtro lo m&amp;aacute;s visible y manipulable posible.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Con un torqui metro dar un torque de 10lbs luego 20, hasta llegar 30lbs.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.- En caso de fugas por la base del filtro extraer la base del filtro, realizar una limpieza con un guaipe y remplazar el empaque de base del filtro.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;5.- Colocar correctamente con una capa de silic&amp;oacute;n.&lt;/p&gt;\r\n\r\n&lt;p&gt;6.- Dar un torque de 30lbs&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión del torque adecuado del filtro de aceite',2,2,0,0,0,0,NULL),(6,'2H',0,'juego de llaves','Juejo de bujias','compresor','&lt;p&gt;1.- Apagar el veh&amp;iacute;culo.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Elevar el veh&amp;iacute;culo con una gata hidr&amp;aacute;ulica tipo lagarto y embancarlo.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Extraer los neum&amp;aacute;ticos.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.- Revisar si tiene agrietamientos los bujes si lo tiene sustituir.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Extraer los amortiguadores y con un compresor de muelle suspensi&amp;oacute;n retirar los muelles y cambiarlos.&lt;/p&gt;\r\n\r\n&lt;p&gt;6.- Realizar una limpieza&lt;/p&gt;\r\n\r\n&lt;p&gt;7.- Realizar la instalaci&amp;oacute;n correctamente&lt;/p&gt;','&lt;p&gt;la persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión de los bujes de los amortiguadores',13,3,0,0,0,0,NULL),(7,'1h',0,'juego de llaves','hojas de ballestas','gata hidráulica','&lt;p&gt;1.- Apagar el veh&amp;iacute;culo.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Elevar un veh&amp;iacute;culo con una gata hidr&amp;aacute;ulica tipo lagarto y embancarlo.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Realizar una limpieza con un aire comprimido y guipe.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.-Revisar si los hojas de las ballestas tienen alg&amp;uacute;n ruptura o fisura si est&amp;aacute; en mal estado sustituir.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Extraer las tuercas que sujetan a las ballesta.&lt;/p&gt;\r\n\r\n&lt;p&gt;6.-Sustituir las ballestas e instalar correctamente.&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión de las hojas de ballesta',5,3,0,0,0,1,NULL),(8,'2h',0,'juego de llaves','kit de reparacion de motores de motor de arranque','punta logica, multimetro','&lt;p&gt;1.- Apagar la maquinaria.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Desconectar la bater&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Quitar los protectores y ubicar el motor de arranque.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.-Desconectar el cableado de alimentaci&amp;oacute;n de 12v del Switch del solenoide, y de la fuente de 12v directo de la bater&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Extraer los pernos que sujetan el motor de arranque.&lt;/p&gt;\r\n\r\n&lt;p&gt;6.-Una vez afuera el motor de arranque, revisar el bendix y si tiene ruptura de alg&amp;uacute;n engranaje o desgate remplazarlo.&lt;/p&gt;\r\n\r\n&lt;p&gt;7.-Realizar una limpieza e instalarlo correctamente.&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión del bendix del motor de arranque',4,4,0,0,0,1,NULL),(9,'2h',0,'juego de llaves','kit de reparación de motor de arranque','punta logica','&lt;p&gt;1.- Apagar la maquinaria.&lt;/p&gt;\r\n\r\n&lt;p&gt;2.- Desconectar la bater&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;3.- Quitar los protectores y ubicar el motor de arranque.&lt;/p&gt;\r\n\r\n&lt;p&gt;4.-Desconectar el cableado de alimentaci&amp;oacute;n de 12v del Switch del solenoide, y de la fuente de 12v directo de la bater&amp;iacute;a.&lt;/p&gt;\r\n\r\n&lt;p&gt;5.- Extraer los pernos que sujetan el motor de arranque.&lt;/p&gt;\r\n\r\n&lt;p&gt;6.- Desarmar el motor de arranque tener cuidado con el solenoide y las escobillas.&lt;/p&gt;\r\n\r\n&lt;p&gt;7.- Con un mult&amp;iacute;metro medir la continuidad del bobinada si no existe continuidad remplazarlo.&lt;/p&gt;\r\n\r\n&lt;p&gt;8.-Realizar una limpieza&lt;/p&gt;\r\n\r\n&lt;p&gt;9.-Instalar correctamente&lt;/p&gt;','&lt;p&gt;La persona encargada de realizar las actividades de mantenimiento deber&amp;aacute; seguir los pasos cuidadosamente y contar con el equipo necesario de seguridad (Guantes, overol, gafas y mascarilla).&lt;/p&gt;','Revisión del bobinado de motor de arranque',2,4,0,0,0,0,NULL),(10,'6 HM',1,'<p>wlwe</p>\r\n','<p>ahii</p>\r\n','ahhhksksk','&lt;p&gt;jane&lt;/p&gt;','&lt;p&gt;ahiii&lt;/p&gt;','Tarea',2,3,0,3,2,1,NULL),(11,'ldsl',0,'<p>sdlsl</p>\r\n','<p>sdll</p>\r\n','','&lt;p&gt;sdlds&lt;/p&gt;','&lt;p&gt;dslsl&lt;/p&gt;','slds',2,3,0,6,3,1,NULL),(12,'aa',1,'<p>dd</p>\r\n','<p>dsd</p>\r\n','aa','&lt;p&gt;dssd&lt;/p&gt;','&lt;p&gt;dfdf&lt;/p&gt;','1111',2,4,0,6,5,0,NULL),(13,'dsldsl',1,'<p>dsk</p>\r\n','<p>sasak</p>\r\n','dslsdl','&lt;p&gt;dsk&lt;/p&gt;','&lt;p&gt;kdk&lt;/p&gt;','asksak dkkds 777',2,1,0,4,3,1,NULL),(14,'50',1,'<p>Ahi va</p>\r\n','<p>Ahi va</p>\r\n','ask','&lt;p&gt;Ahi va&lt;/p&gt;','&lt;p&gt;as&lt;/p&gt;','Mantenimiento Ejemplo',16,1,1,200,50,0,NULL),(15,'10',0,'<p>dl</p>\r\n','<p>asll</p>\r\n','sñ','&lt;p&gt;dsl&lt;/p&gt;','&lt;p&gt;dsl&lt;/p&gt;','prueba de mantenimiento',2,1,1,100,10,1,NULL),(16,'2 horas',0,'<p>etrytyty</p>\r\n','<p>sere</p>\r\n','sdsd','&lt;p&gt;doifhkf,n&lt;/p&gt;','&lt;p&gt;dfhdkfhdf&lt;/p&gt;','act1',14,10,10,200,6,0,NULL),(17,'2 horas',0,'<p>prueba herramientas</p>\r\n','<p>prueba materiales</p>\r\n','sdsd','&lt;p&gt;prueba procedimoento&lt;/p&gt;','&lt;p&gt;prueba nota&lt;/p&gt;','prueba 234',14,7,7,20,3,0,NULL);
/*!40000 ALTER TABLE `plan_mantenimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro`
--

DROP TABLE IF EXISTS `registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehiculo_id` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha` date NOT NULL,
  `numero_ingreso` int(11) NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro`
--

LOCK TABLES `registro` WRITE;
/*!40000 ALTER TABLE `registro` DISABLE KEYS */;
INSERT INTO `registro` VALUES (32,8,'2017-06-07','2017-06-06',257,6,1),(33,8,'2017-06-07','2017-06-07',430,6,1),(34,1,'2017-06-11','2017-06-11',500,3,1),(35,1,'2017-06-12','2017-06-12',600,3,1),(36,1,'2017-06-13','2017-06-13',750,3,1),(37,10,'2017-06-20','2017-06-20',500,3,1),(38,10,'2017-06-20','2017-06-20',800,3,1),(39,5,'2017-06-21','2017-06-21',20,9,4),(40,5,'2017-06-21','2017-06-21',500,9,4),(41,5,'2017-06-21','2017-06-21',25,9,4);
/*!40000 ALTER TABLE `registro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repuestos`
--

DROP TABLE IF EXISTS `repuestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(512) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `codigo` varchar(45) NOT NULL,
  `eliminado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repuestos`
--

LOCK TABLES `repuestos` WRITE;
/*!40000 ALTER TABLE `repuestos` DISABLE KEYS */;
INSERT INTO `repuestos` VALUES (1,'Aceite',2,'cd-001',0),(2,'agua',6,'cd-003',0);
/*!40000 ALTER TABLE `repuestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_falla`
--

DROP TABLE IF EXISTS `tipo_falla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_falla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(512) NOT NULL,
  `descripcion` varchar(512) NOT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_falla`
--

LOCK TABLES `tipo_falla` WRITE;
/*!40000 ALTER TABLE `tipo_falla` DISABLE KEYS */;
INSERT INTO `tipo_falla` VALUES (1,'El vehículo no se enciende','El vehículo no se enciende',0),(2,'Nivel de refrigerante bajo','Nivel de refrigerante bajo',0),(3,'Nivel de líquido de frenos bajo','Nivel de líquido de frenos bajo',0),(4,'Nivel de líquido hidráulico bajo','Nivel de líquido hidráulico bajo',0),(5,'Batería descargada','Batería descargada',0),(6,'Presión del neumático inadecuado','Presión del neumático inadecuado',0),(7,'Fugas de aceite','Fugas de aceite',0),(8,'Fugas de combustible','Fugas de combustible',0),(9,'Fugas de refrigerante','Fugas de refrigerante',0),(10,'Halógenos quemados','Halógenos quemados',0),(11,'Ralentí inadecuado','Ralentí inadecuado',0),(12,'Temperatura del motor inadecuado','Temperatura del motor inadecuado',0),(13,'Ruidos extraños','Ruidos extraños',0),(14,'Bandas rotos','Bandas rotos',0),(15,'Paquetes de ballestas rotas','Paquetes de ballestas rotas',0),(16,'Amortiguadores deteriorados','Amortiguadores deteriorados',0),(17,'Gala la dirección al conducir','Gala la dirección al conducir',0),(18,'El vehículo enciende pero no tiene fuerza','El vehículo enciende pero no tiene fuerza',0),(19,'El vehículo enciende pero al acelerar se apaga','El vehículo enciende pero al acelerar se apaga',0),(20,'Luces de testigo se prenden en el tablero de instrumentos','Luces de testigo se prenden en el tablero de instrumentos',0),(21,'No entra la marcha','No entra la marcha',0),(22,'El vehículo  no acelera','El vehículo  no acelera',0),(23,'Se queda pegado el pedal del embrague','Se queda pegado el pedal del embrague',0),(24,'Elementos extraños incrustados en los neumáticos','Elementos extraños incrustados en los neumáticos',0),(25,'Terminales sucios o sueltos','Terminales sucios o sueltos',0),(26,'Mal funcionamiento de sistema de encendido','Mal funcionamiento de sistema de encendido',0),(27,'Baja compresión en los cilindros','Baja compresión en los cilindros',0),(28,'Defectos en el motor de arranque','Defectos en el motor de arranque',0),(29,'Succión de aire directa','Succión de aire directa',0),(30,'Detonación en los cilindros al exigir potencia al motor','Detonación en los cilindros al exigir potencia al motor',0),(31,'Bujía de mal estado o carbonizado','Bujía de mal estado o carbonizado',0),(32,'Mala sincronización','Mala sincronización',0),(33,'Junta de culata en mal estado','Junta de culata en mal estado',0),(34,'Carbón en la cámara de explosión','Carbón en la cámara de explosión',0),(35,'Válvulas de motor en mal estado y tolerancia','Válvulas de motor en mal estado y tolerancia',0),(36,'Filtros obstruidos','Filtros obstruidos',0),(37,'Bobina quemada','Bobina quemada',0),(38,'Defectos de modulo electrónico','Defectos de modulo electrónico',0),(39,'Conexiones eléctricas sueltas en el circuito de la bobina','Conexiones eléctricas sueltas en el circuito de la bobina',0),(40,'Interruptor de contacto defectuosos','Interruptor de contacto defectuosos',0),(41,'Anillos sincronizadores en mal estado','Anillos sincronizadores en mal estado',0),(42,'Kit de embrague defectuoso','Kit de embrague defectuoso',0),(43,'Palanca de cambios desconectada de su varillaje','Palanca de cambios desconectada de su varillaje',0),(44,'Engranes o ejes rotos de caja de cambios','Engranes o ejes rotos de caja de cambios',0),(45,'Rodamientos de ruedas dañadas','Rodamientos de ruedas dañadas',0),(46,'Engranajes de satélites en mal estado','Engranajes de satélites en mal estado',0),(47,'Retenes o sellos en mal estado','Retenes o sellos en mal estado',0),(48,'Desgaste general de conjunto de la dirección','Desgaste general de conjunto de la dirección',0),(49,'Roturas desgastadas','Roturas desgastadas',0),(50,'Pastillas o forros de friccione zapatas degastados','Pastillas o forros de friccione zapatas degastados',0),(51,'Fallas de servo freno','Fallas de servo freno',0),(52,'Pistones impulsores agarrotados','Pistones impulsores agarrotados',0),(53,'Disco y tambor de freno en mal estado','Disco y tambor de freno en mal estado',0),(54,'Cables o fusibles quemados','Cables o fusibles quemados',0),(55,'Inyectores obstruidos o desgastados','Inyectores obstruidos o desgastados',0),(56,'Turbo de los motores sobrealimentados','Turbo de los motores sobrealimentados',0),(57,'Otros','Otros',0);
/*!40000 ALTER TABLE `tipo_falla` ENABLE KEYS */;
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
INSERT INTO `tipo_usuario` VALUES (1,'Administrador','Jefe de Taller'),(2,'Secretario','Secretario general'),(3,'Conductor V. Livianos','Lista de Conductores de V. Livianos'),(4,'Conductor V.  Pesados','Lista de Conductores de V. Pesados'),(5,'Operario M. Pesada','Lista de Operarios de M. Pesados'),(6,'Técnico','Tecnicos de Mantenimiento');
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
  `tipo_conductor` int(11) NOT NULL DEFAULT '0',
  `plan_mantenimiento` int(11) NOT NULL,
  `descripcion` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_vehiculo`
--

LOCK TABLES `tipo_vehiculo` WRITE;
/*!40000 ALTER TABLE `tipo_vehiculo` DISABLE KEYS */;
INSERT INTO `tipo_vehiculo` VALUES (1,'Automotor Liviano Gasolina Camioneta 4x2',3,1,'Automotores Livianos a Gasolina Camioneta 4x2'),(2,'Automotor Liviano Diesel Camioneta 4x2',3,2,'Automotores Livianos a Diesel Camioneta 4x2'),(3,'Automotor Pesados',4,3,'Automotores Pesados'),(4,'Maquinaria Rodillo',5,4,'Maquinaria - Rodillo'),(5,'Maquinaria Retroescabadora',5,5,'Maquinaria - Retroescabadora'),(6,'Maquinaria Cargadora Frontal',5,6,'Maquinaria - Cargadora Frontal'),(7,'Maquinaria Motoniveladora',5,7,'Maquinaria - Motoniveladora'),(8,'Maquinaria Bulldozer',5,8,'Maquinaria - Bulldozer'),(9,'Automotor Liviano Gasolina Camioneta 4x4',3,9,'Automotores Livianos a Gasolina  Camioneta 4x4'),(10,'Automotor Liviano Diesel Camioneta 4x4',3,10,'Automotores Livianos a Diesel Camioneta 4x4'),(11,'Automotor Liviano Gasolina SUV 4x2',3,11,'Automotores Livianos a Gasolina SUV 4x2'),(12,'Automotor Liviano Gasolina SUV 4x4',3,12,'Automotores Livianos a Gasolina SUV 4x4'),(13,'Automotor Liviano Diesel SUV 4x2',3,13,'Automotores Livianos a Diesel SUV 4x2'),(14,'Automotor Liviano Diesel SUV 4x4',3,14,'Automotores Livianos a Diesel SUV 4x4');
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
  `vehiculos` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_tecnico_tipo_usuario_idx` (`tipo_usuario_id`),
  CONSTRAINT `fk_tecnico_tipo_usuario` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,'Carlos','Villa','0603108770','argentinos y cubas','023689434','0893456794','efaby10@gmail.com','0603108770','e10adc3949ba59abbe56e057f20f883e',0,0),(2,6,'Carlos','Perez','0603718577','calle 4','','','mail1@mail.com','0603718577','e10adc3949ba59abbe56e057f20f883e',0,0),(3,3,'jose','gonza','0302424445','calle 12','234576285','0987858010','franciscobmv91@gmail.com','0302424445','e10adc3949ba59abbe56e057f20f883e',0,1),(4,2,'Edison','Tapia','0304556612','Calee 4','453672578','0983445567','sairi@92gmail.com','0304556612','e10adc3949ba59abbe56e057f20f883e',0,0),(5,2,'Francisco','Huerta','0302606231','juan montalvo','234567853','0984716918','franciscohuerta1991@hotmail.com','0302606231','81dc9bdb52d04dc20036dbd8313ed055',0,0),(6,3,'Víctor ',' Peralta','0302674455','carrera ingapirca y 9 de octubre','432563357','0984765523','victore55@gmail.com','0302674455','e10adc3949ba59abbe56e057f20f883e',0,2),(7,3,'Homero ','Sacoto','0306558812','guayaquil y colon','235467892','0985453345','Sacoto67@hotmail.com','0306558812','81dc9bdb52d04dc20036dbd8313ed055',0,1),(8,3,'Germán ','Arévalo','0308565544','9 de agosto y colon','234567687','0989234543','Arévalo@hotmail.com','0308565544','81dc9bdb52d04dc20036dbd8313ed055',0,0),(9,5,'Miguel ','Cárdenas','06256788876','24 de mayo y colon','235467458','0987123458','Cárdenas@gmail.com','06256788876','e10adc3949ba59abbe56e057f20f883e',0,2),(10,3,'Luis ','Espinoza','03026876678','carrreno y gaspar','098123568','0983457523','Espinoza@hotmail.com','03026876678','81dc9bdb52d04dc20036dbd8313ed055',0,1),(11,4,'Ángel ','Crespo','0302675568','colon y gaspar','243678124','0984458877','Crespo@gmail.com','0302675568','81dc9bdb52d04dc20036dbd8313ed055',0,2),(12,4,'Jimmy ','Sacta','03667856434','Francia y colon','234566853','0981235678','Sacta@gmail.com','03667856434','81dc9bdb52d04dc20036dbd8313ed055',0,0),(13,2,'Pablo','Muñoz','09856722445','10 de agosto y gaspar','235789235','0981345469','mununz@gmail.com','09856722445','81dc9bdb52d04dc20036dbd8313ed055',0,0),(14,6,'TEcnico','TEcnico','1111111111','calle 4','','','','1111111111','e10adc3949ba59abbe56e057f20f883e',0,0),(15,5,'Operador','Operador','2222222222','calle 1','','','','2222222222','e10adc3949ba59abbe56e057f20f883e',0,1),(16,6,'Juan','Con','0602567802','Los Pinos','098888888','0888888888','lajane2020@hotmail.com','0602567802','e10adc3949ba59abbe56e057f20f883e',0,0);
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
  `modelo` varchar(64) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculo`
--

LOCK TABLES `vehiculo` WRITE;
/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
INSERT INTO `vehiculo` VALUES (1,10,1,1,'USA-1230','1','ppp','modelo',2015,'4JJLX9761','8LBETF3N7F0267815',750,0),(2,6,1,1,'UBW-193','2','CHEVROLET',NULL,2012,'6BD1-175945','8LBETFS25H40113947',2000,0),(3,11,1,1,'ubs-234','1','KOMATSU',NULL,2010,'26518093','75353',2345,0),(4,9,4,1,'usa-123','2','KOMATSU','',1991,'26528413','75572',5000,0),(5,9,7,1,'UMA-505','26','INTERNACIONAL','',2010,'362GM2UB-135281','PH48807',351203,0),(6,15,7,1,'UMA-0077','37','STEYR','',1995,'2122437265','LZFS19L172DO12935',200356,0),(7,11,3,2,'sdsd','45','marca 1',NULL,2014,'sdsd','sdsd',456,1),(8,6,1,1,'3','2','Ejemplo',NULL,3,'3','3',430,0),(9,3,1,2,'llsd','191','kas','sallsa',22,'ksdk','dslls',2,0),(10,7,10,1,'45','56','mazda','sdsd',2014,'dfdf','werer',800,0);
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
  `numero_operacion` decimal(5,2) NOT NULL DEFAULT '0.00',
  `fecha_registro` date NOT NULL,
  `fecha_inicio` date NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_vehiculo_plan_vehiculo1_idx` (`vehiculo_id`),
  KEY `fk_vehiculo_plan_plan_mantenimiento1_idx` (`plan_mantenimiento_id`),
  CONSTRAINT `fk_vehiculo_plan_plan_mantenimiento1` FOREIGN KEY (`plan_mantenimiento_id`) REFERENCES `plan_mantenimiento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehiculo_plan_vehiculo1` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculo_plan`
--

LOCK TABLES `vehiculo_plan` WRITE;
/*!40000 ALTER TABLE `vehiculo_plan` DISABLE KEYS */;
INSERT INTO `vehiculo_plan` VALUES (21,8,1,580.00,'2017-06-13','2017-06-07',0),(22,8,14,935.00,'2017-06-12','2017-06-07',0),(23,1,15,505.00,'2017-06-11','2017-06-11',0),(24,10,16,400.00,'2017-06-20','2017-06-20',0),(25,5,17,25.00,'2017-06-21','2017-06-21',0);
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

-- Dump completed on 2017-07-01 23:47:46
