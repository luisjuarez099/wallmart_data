-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: wm_bd
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `count_trigger`
--

DROP TABLE IF EXISTS `count_trigger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `count_trigger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contador` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `count_trigger`
--

LOCK TABLES `count_trigger` WRITE;
/*!40000 ALTER TABLE `count_trigger` DISABLE KEYS */;
/*!40000 ALTER TABLE `count_trigger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oc`
--

DROP TABLE IF EXISTS `oc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oc` (
  `OC` int(3) NOT NULL,
  `Proveedor` varchar(9) NOT NULL,
  `Producto` varchar(9) NOT NULL,
  `Descripcion` varchar(25) NOT NULL,
  `FechaEntrega` date NOT NULL,
  `Precio` decimal(7,2) NOT NULL,
  `Cantidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc`
--

LOCK TABLES `oc` WRITE;
/*!40000 ALTER TABLE `oc` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER read_data
AFTER INSERT
ON oc FOR EACH ROW
BEGIN
	DECLARE v_oc VARCHAR(9);
	DECLARE v_Proveedor VARCHAR(9);
	DECLARE v_Descripcion VARCHAR(25);
	DECLARE v_Cantidad INT(9);
	DECLARE v_FechaEntrega DATE;
	DECLARE v_Precio DOUBLE(7,2);

	SET v_oc = NEW.oc;
	SET v_Proveedor = NEW.Proveedor;
	SET v_Descripcion = NEW.Descripcion;
	SET v_Cantidad=NEW.Cantidad;
	SET v_FechaEntrega = NEW.FechaEntrega;
	SET v_Precio = NEW.Precio;
	

	INSERT INTO oc_logs (oc, Proveedor, Producto, Descripcion, Cantidad, FechaEntrega, Precio)
	VALUES (v_oc, v_Proveedor, v_Producto, v_Descripcion, v_Cantidad, v_Fechaentrega, v_Precio);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `oc_logs`
--

DROP TABLE IF EXISTS `oc_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oc_logs` (
  `OC` int(3) NOT NULL,
  `Proveedor` varchar(9) NOT NULL,
  `Producto` varchar(9) NOT NULL,
  `Descripcion` varchar(25) NOT NULL,
  `FechaEntrega` date NOT NULL,
  `Precio` decimal(7,2) NOT NULL,
  `Cantidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oc_logs`
--

LOCK TABLES `oc_logs` WRITE;
/*!40000 ALTER TABLE `oc_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `oc_logs` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER up_cont
AFTER INSERT
ON oc_logs FOR EACH ROW
BEGIN 
	INSERT INTO count_trigger (contador) VALUES (0);
	UPDATE count_trigger  SET count_trigger.contador = contador  + 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-13 20:07:43
