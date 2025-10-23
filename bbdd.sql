-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.4.3 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para reto1
DROP DATABASE IF EXISTS `reto1`;
CREATE DATABASE IF NOT EXISTS `reto1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `reto1`;

-- Volcando estructura para tabla reto1.administradores
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

-- Volcando datos para la tabla reto1.administradores: ~3 rows (aproximadamente)
INSERT INTO `administradores` (`ID_Admin`, `Username`, `Password`, `Email`, `Tipo`) VALUES
	(1, 'Administrador', '12345Abcde', 'admin@test.com', 'SAdmin'),
	(2, 'Gestor 1', '12345Abcde', 'gestor1@test.com', 'Gestor'),
	(3, 'Gestor 2', '12345Abcde', 'gestor2@test.com', 'Gestor');

-- Volcando estructura para tabla reto1.anuncios
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
  `Url_imagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_Anuncio`),
  KEY `ID_Usuario` (`ID_Usuario`),
  KEY `ID_Categoria` (`ID_Categoria`),
  CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `anuncios_ibfk_2` FOREIGN KEY (`ID_Categoria`) REFERENCES `categorias` (`ID_Categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla reto1.anuncios: ~8 rows (aproximadamente)
INSERT INTO `anuncios` (`ID_Anuncio`, `ID_Usuario`, `ID_Categoria`, `Nombre`, `Descripcion`, `Fecha_pub`, `Precio`, `Stock`, `Url_imagen`) VALUES
	(17, 3, 4, 'iPhone 18', 'Lo último de los móviles', '2025-10-18 10:00:00', 1850.00, 10, 'assets/images/anuncios/iPhone 18.jpg'),
	(18, 3, 4, 'Apple Watch', 'Poder en tu muñeca', '2025-10-18 10:05:00', 300.00, 10, 'assets/images/anuncios/Apple Watch.jpg'),
	(19, 4, 6, 'BMW M4', 'Agresivo con clase', '2025-10-18 10:10:00', 80000.00, 10, 'assets/images/anuncios/BMW m4.jpg'),
	(20, 5, 3, 'Termo Mix Pro', 'Facilidad en la cocina', '2025-10-18 10:15:00', 100.00, 10, 'assets/images/anuncios/Termo Mix.jpg'),
	(21, 6, 1, 'Bolso de mano', 'Muy cómodo. Lujo', '2025-10-18 10:20:00', 475.00, 10, 'assets/images/anuncios/Bolso Gucci.jpg'),
	(22, 7, 5, 'Dunlop x12', 'Precisión perfecta', '2025-10-18 10:25:00', 120.00, 10, 'assets/images/anuncios/Raqueta Padel.jpg'),
	(23, 8, 8, 'Comida Perro', 'Cuida bien tu mascota', '2025-10-18 10:30:00', 12.00, 10, 'assets/images/anuncios/Comida Mascotas.jpg'),
	(24, 9, 10, 'Bicicleta', 'Saca una sonrisa a tu hijo', '2025-10-18 10:35:00', 160.00, 10, 'assets/images/anuncios/Bicicleta Infantil.jpg');

-- Volcando estructura para tabla reto1.categorias
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `ID_Categoria` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) NOT NULL,
  `Url_icono` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_Categoria`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla reto1.categorias: ~10 rows (aproximadamente)
INSERT INTO `categorias` (`ID_Categoria`, `Nombre`, `Url_icono`) VALUES
	(1, 'Moda', 'assets/images/iconos/categorias/Moda.png'),
	(2, 'Belleza', '/assets/images/iconos/categorias/Belleza.png'),
	(3, 'Hogar', '/assets/images/iconos/categorias/Hogar.png'),
	(4, 'Tecnologia', '/assets/images/iconos/categorias/Tecnologia.png'),
	(5, 'Deportes', '/assets/images/iconos/categorias/Deportes.png'),
	(6, 'Automocion', '/assets/images/iconos/categorias/Automocion.png'),
	(7, 'Salud', '/assets/images/iconos/categorias/Salud.png'),
	(8, 'Alimentacion', '/assets/images/iconos/categorias/Alimentacion.png'),
	(9, 'Mascotas', '/assets/images/iconos/categorias/Mascotas.png'),
	(10, 'Infantil', '/assets/images/iconos/categorias/Infantil.png');

-- Volcando estructura para tabla reto1.favoritos
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

-- Volcando datos para la tabla reto1.favoritos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla reto1.usuarios
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla reto1.usuarios: ~2 rows (aproximadamente)
INSERT INTO `usuarios` (`ID_Usuario`, `CIF`, `Username`, `Password`, `Email`, `Tipo`) VALUES
	(1, NULL, 'Comprador', '12345Abcde', 'comprar@test.com', 'Cliente'),
	(2, NULL, 'Vendedor', '12345Abcde', 'vender@test.com', 'Comerciante'),
	(3, NULL, 'Apple', '12345Abcde', 'apple@correo.com', 'Comerciante'),
	(4, NULL, 'BMW', '12345Abcde', 'bmw@correo.com', 'Comerciante'),
	(5, NULL, 'TermoMix', '12345Abcde', 'termo@correo.com', 'Comerciante'),
	(6, NULL, 'Gucci', '12345Abcde', 'bolso@correo.com', 'Comerciante'),
	(7, NULL, 'Dunlop', '12345Abcde', 'dunlop@correo.com', 'Comerciante'),
	(8, NULL, 'Mascotas', '12345Abcde', 'mascotas@correo.com', 'Comerciante'),
	(9, NULL, 'BHD', '12345Abcde', 'bicicletas@correo.com', 'Comerciante');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
