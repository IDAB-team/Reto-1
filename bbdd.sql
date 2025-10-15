-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for reto1
DROP DATABASE IF EXISTS `reto1`;
CREATE DATABASE IF NOT EXISTS `reto1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `reto1`;

-- Dumping structure for table reto1.administradores
DROP TABLE IF EXISTS `administradores`;
CREATE TABLE IF NOT EXISTS `administradores` (
  `ID_Admin` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Tipo` varchar(10) DEFAULT 'Gestor',
  PRIMARY KEY (`ID_Admin`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`),
  CONSTRAINT `TIPO_ADMIN_CK` CHECK ((`Tipo` in (_utf8mb4'SuperAdmin',_utf8mb4'Gestor')))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table reto1.administradores: ~0 rows (approximately)
INSERT INTO `administradores` (`ID_Admin`, `Username`, `Password`, `Email`, `Tipo`) VALUES
	(1, 'superadmin', '12345Qwerty', 'superadmin@correo.com', 'SuperAdmin'),
	(2, 'gestor1', 'idabteam', 'gestor1@correo.com', 'Gestor'),
	(3, 'gestor2', 'idabteam', 'gestor2@correo.com', 'Gestor');

-- Dumping structure for table reto1.anuncios
DROP TABLE IF EXISTS `anuncios`;
CREATE TABLE IF NOT EXISTS `anuncios` (
  `ID_Anuncio` int NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int DEFAULT NULL,
  `ID_Categoria` int DEFAULT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Fecha_pub` datetime DEFAULT CURRENT_TIMESTAMP,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Stock` int DEFAULT '1',
  PRIMARY KEY (`ID_Anuncio`),
  KEY `ID_Usuario` (`ID_Usuario`),
  KEY `ID_Categoria` (`ID_Categoria`),
  CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `anuncios_ibfk_2` FOREIGN KEY (`ID_Categoria`) REFERENCES `categorias` (`ID_Categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table reto1.anuncios: ~0 rows (approximately)
INSERT INTO `anuncios` (`ID_Anuncio`, `ID_Usuario`, `ID_Categoria`, `Nombre`, `Descripcion`, `Fecha_pub`, `Precio`, `Stock`) VALUES
	(1, 2, 4, 'Iphone 16', 'Nuevo Iphone', '2025-10-14 20:20:01', 699.00, 10),
	(2, 2, 3, 'Aspiradora Dyson', 'Nueva Dyson', '2025-10-14 20:20:01', 599.00, 10),
	(3, 2, 4, 'Pioneer DDJ 400', 'Mesa controladora de sonido', '2025-10-14 20:20:01', 699.00, 10);

-- Dumping structure for table reto1.categorias
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `ID_Categoria` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Categoria`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table reto1.categorias: ~0 rows (approximately)
INSERT INTO `categorias` (`ID_Categoria`, `Nombre`) VALUES
	(8, 'Alimentacion'),
	(6, 'Automocion'),
	(2, 'Belleza'),
	(5, 'Deportes'),
	(3, 'Hogar'),
	(10, 'Infantil'),
	(9, 'Mascotas'),
	(1, 'Moda'),
	(7, 'Salud'),
	(4, 'Tecnologia');

-- Dumping structure for table reto1.favoritos
DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE IF NOT EXISTS `favoritos` (
  `ID_Favorito` int NOT NULL AUTO_INCREMENT,
  `ID_Usuario` int NOT NULL,
  `ID_Anuncio` int NOT NULL,
  PRIMARY KEY (`ID_Favorito`),
  UNIQUE KEY `ID_Usuario` (`ID_Usuario`,`ID_Anuncio`),
  KEY `ID_Anuncio` (`ID_Anuncio`),
  CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`ID_Anuncio`) REFERENCES `anuncios` (`ID_Anuncio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table reto1.favoritos: ~0 rows (approximately)

-- Dumping structure for table reto1.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID_Usuario` int NOT NULL AUTO_INCREMENT,
  `CIF` varchar(9) DEFAULT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Tipo` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Usuario`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `CIF` (`CIF`),
  UNIQUE KEY `Email` (`Email`),
  CONSTRAINT `TIPO_USER_CK` CHECK ((`Tipo` in (_utf8mb4'Cliente',_utf8mb4'Comerciante')))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table reto1.usuarios: ~0 rows (approximately)
INSERT INTO `usuarios` (`ID_Usuario`, `CIF`, `Username`, `Password`, `Email`, `Tipo`) VALUES
	(1, NULL, 'comprador1', '12345Abcde', 'comprador1@correo.com', 'Cliente'),
	(2, '12345678A', 'comerciante1', '12345Abcde', 'comerciante1@correo.com', 'Comerciante');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
