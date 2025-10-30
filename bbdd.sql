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


-- ===========================================
-- CREACIÓN DE BASE DE DATOS
-- ===========================================
DROP DATABASE IF EXISTS reto1;
CREATE DATABASE IF NOT EXISTS reto1 
  DEFAULT CHARACTER SET utf8mb4 
  COLLATE utf8mb4_0900_ai_ci 
  DEFAULT ENCRYPTION='N';
USE reto1;

-- ===========================================
-- TABLA ADMINISTRADORES
-- ===========================================

DROP TABLE IF EXISTS administradores;
CREATE TABLE administradores (
  ID_Admin INT NOT NULL AUTO_INCREMENT,
  Username VARCHAR(30) NOT NULL,
  Password VARCHAR(20) NOT NULL,
  Email VARCHAR(50) DEFAULT NULL,
  Tipo VARCHAR(10) DEFAULT 'Gestor',
  PRIMARY KEY (ID_Admin),
  UNIQUE KEY Username (Username),
  UNIQUE KEY Email (Email),
  CONSTRAINT TIPO_ADMIN_CK CHECK (Tipo IN ('SuperAdmin', 'Gestor'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos iniciales de administradores
INSERT INTO administradores (ID_Admin, Username, Password, Email, Tipo) VALUES
    (1, 'Administrador', '12345Abcde', 'admin@test.com', 'SuperAdmin'),
    (2, 'Gestor 1', '12345Abcde', 'gestor1@test.com', 'Gestor'),
    (3, 'Gestor 2', '12345Abcde', 'gestor2@test.com', 'Gestor');

-- ===========================================
-- TABLA USUARIOS
-- ===========================================

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
  ID_Usuario INT NOT NULL AUTO_INCREMENT,
  CIF VARCHAR(9) DEFAULT NULL,
  Username VARCHAR(30) NOT NULL,
  Password VARCHAR(20) NOT NULL,
  Email VARCHAR(50) DEFAULT NULL,
  Tipo VARCHAR(11) DEFAULT NULL,
  PRIMARY KEY (ID_Usuario),
  UNIQUE KEY Username (Username),
  UNIQUE KEY CIF (CIF),
  UNIQUE KEY Email (Email),
  CONSTRAINT TIPO_USER_CK CHECK (Tipo IN ('Cliente', 'Comerciante'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos iniciales de usuarios
INSERT INTO usuarios (ID_Usuario, CIF, Username, Password, Email, Tipo) VALUES
    (1, NULL, 'Comprador', '12345Abcde', 'comprar@test.com', 'Cliente'),
    (2, NULL, 'Vendedor', '12345Abcde', 'vender@test.com', 'Comerciante'),
    (3, NULL, 'Apple', '12345Abcde', 'apple@correo.com', 'Comerciante'),
    (4, NULL, 'BMW', '12345Abcde', 'bmw@correo.com', 'Comerciante'),
    (5, NULL, 'TermoMix', '12345Abcde', 'termo@correo.com', 'Comerciante'),
    (6, NULL, 'Gucci', '12345Abcde', 'bolso@correo.com', 'Comerciante'),
    (7, NULL, 'Dunlop', '12345Abcde', 'dunlop@correo.com', 'Comerciante'),
    (8, NULL, 'Mascotas', '12345Abcde', 'mascotas@correo.com', 'Comerciante'),
    (9, NULL, 'BHD', '12345Abcde', 'bicicletas@correo.com', 'Comerciante');

-- ===========================================
-- TABLA CATEGORIAS
-- ===========================================

DROP TABLE IF EXISTS categorias;
CREATE TABLE categorias (
  ID_Categoria INT NOT NULL AUTO_INCREMENT,
  Nombre VARCHAR(30) NOT NULL,
  Url_icono VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (ID_Categoria),
  UNIQUE KEY Nombre (Nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos iniciales de categorías
INSERT INTO categorias (ID_Categoria, Nombre, Url_icono) VALUES
    (1, 'Moda', 'assets/images/iconos/categorias/Moda.png'),
    (2, 'Belleza', 'assets/images/iconos/categorias/Belleza.png'),
    (3, 'Hogar', 'assets/images/iconos/categorias/Hogar.png'),
    (4, 'Tecnologia', 'assets/images/iconos/categorias/Tecnologia.png'),
    (5, 'Deportes', 'assets/images/iconos/categorias/Deportes.png'),
    (6, 'Automocion', 'assets/images/iconos/categorias/Automocion.png'),
    (7, 'Salud', 'assets/images/iconos/categorias/Salud.png'),
    (8, 'Alimentacion', 'assets/images/iconos/categorias/Alimentacion.png'),
    (9, 'Mascotas', 'assets/images/iconos/categorias/Mascotas.png'),
    (10, 'Infantil', 'assets/images/iconos/categorias/Infantil.png');

-- ===========================================
-- TABLA ANUNCIOS
-- ===========================================

DROP TABLE IF EXISTS anuncios;
CREATE TABLE anuncios (
  ID_Anuncio INT NOT NULL AUTO_INCREMENT,
  ID_Usuario INT DEFAULT NULL,
  ID_Categoria INT DEFAULT NULL,
  Nombre VARCHAR(50) NOT NULL,
  Descripcion VARCHAR(255) DEFAULT NULL,
  Fecha_pub DATETIME DEFAULT CURRENT_TIMESTAMP,
  Precio DECIMAL(10,2) DEFAULT NULL,
  Stock INT DEFAULT 1,
  Url_imagen VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (ID_Anuncio),
  KEY ID_Usuario (ID_Usuario),
  KEY ID_Categoria (ID_Categoria),
  CONSTRAINT anuncios_ibfk_1 FOREIGN KEY (ID_Usuario) REFERENCES usuarios (ID_Usuario) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT anuncios_ibfk_2 FOREIGN KEY (ID_Categoria) REFERENCES categorias (ID_Categoria) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Datos iniciales de anuncios
INSERT INTO anuncios (ID_Usuario, ID_Categoria, Nombre, Descripcion, Fecha_pub, Precio, Stock, Url_imagen) VALUES
( 3, 4, 'iPhone 18', 'Lo último de los móviles', '2025-10-30 10:00:00', 1850.00, 10, 'assets/images/anuncios/iPhone 18.jpg'),
( 3, 4, 'Apple Watch', 'Poder en tu muñeca', '2025-10-30 10:05:00', 300.00, 10, 'assets/images/anuncios/Apple Watch.jpg'),
( 4, 6, 'BMW M4', 'Agresivo con clase', '2025-10-18 10:10:00', 80000.00, 10, 'assets/images/anuncios/BMW m4.jpg'),
( 5, 3, 'Termo Mix Pro', 'Facilidad en la cocina', '2025-10-30 10:15:00', 100.00, 10, 'assets/images/anuncios/Termo Mix.jpg'),
( 6, 1, 'Bolso de mano', 'Muy cómodo. Lujo', '2025-10-18 10:20:00', 475.00, 10, 'assets/images/anuncios/gucci.jpg'),
( 7, 5, 'Dunlop x12', 'Precisión perfecta', '2025-10-30 10:25:00', 120.00, 10, 'assets/images/anuncios/Raqueta Padel.jpg'),
( 8, 9, 'Comida Perro', 'Cuida bien tu mascota', '2025-10-30 10:30:00', 12.00, 10, 'assets/images/anuncios/Comida Mascotas.jpg'),
( 9, 10, 'Bicicleta', 'Saca una sonrisa a tu hijo', '2025-10-18 10:35:00', 160.00, 10, 'assets/images/anuncios/Bicicleta Infantil.jpg'),
(6, 1, 'Air Jordan 1', 'Zapatillas icónicas de edición limitada - Retro High Travis Scott', '2025-10-30 10:00:00', 1200.00, 5, 'assets/images/anuncios/Air Jordan 1 Retro High Travis Scott.jpg'),
(6, 1, 'Adidas Essentials', 'Camiseta deportiva de algodón suave', '2025-10-29 10:05:00', 35.00, 20, 'assets/images/anuncios/camiseta adidas essentials.jpg'),
(6, 1, 'Sudadera Palace con capucha', 'Sudadera gris con logotipo trasero Palace', '2025-10-29 10:10:00', 95.00, 15, 'assets/images/anuncios/sudadera palace con capucha.jpg'),
(5, 7, '1000 mg Curcumina Meriva', 'Suplemento antiinflamatorio natural', '2025-10-29 10:15:00', 22.50, 20, 'assets/images/anuncios/1000 mg Curcumina Meriva.jpg'),
(5, 7, 'Grow Wellness Proteína Vainilla y Galleta', 'Proteína aislada sabor vainilla', '2025-10-29 10:20:00', 34.99, 10, 'assets/images/anuncios/Grow Wellness - Proteina Aislada sabor Vainilla y Galleta.jpg'),
(5, 7, 'Monohidrato de creatina sin sabor 300g', 'Creatina pura micronizada', '2025-10-29 10:25:00', 19.90, 25, 'assets/images/anuncios/monohidrato de creatina sin sabor 300g.jpg'),
(5, 7, 'Braun ThermoScan 7', 'Termómetro digital de oído', '2025-10-29 10:30:00', 48.00, 10, 'assets/images/anuncios/Braun ThermoScan 7 Termómetro de oído.jpg'),
(5, 4, 'HY300 Android 110 Portable Projector', 'Proyector portátil Android de alta definición', '2025-10-29 10:35:00', 180.00, 8, 'assets/images/anuncios/HY300 Android 110 Portable Projector.jpg'),
(5, 3, 'Lavadora Cecotec 6000', 'Lavadora inteligente de bajo consumo', '2025-10-29 10:40:00', 420.00, 6, 'assets/images/anuncios/lavadora cecotec 6000.jpg'),
(5, 8, 'Horeca Collection - 50 Envases Bisagra', 'Paquete de envases rectangulares reutilizables', '2025-10-29 10:45:00', 9.99, 50, 'assets/images/anuncios/Horeca Collection - 50 Envases Bisagra Rectangular.jpg'),
(5, 8, 'Juego Vajilla Bebé Silicona 9 Piezas', 'Vajilla segura para bebés sin BPA', '2025-10-29 10:50:00', 25.00, 15, 'assets/images/anuncios/Juego Vajilla Bebe Silicona 9 Piezas.jpg'),
(3, 4, 'Apple AirPods 3', 'Auriculares inalámbricos de tercera generación', '2025-10-29 10:55:00', 189.00, 20, 'assets/images/anuncios/Apple AirPods 3.jpg'),
(3, 4, 'AirPods Max', 'Auriculares over-ear con audio espacial', '2025-10-29 11:00:00', 629.00, 10, 'assets/images/anuncios/airpods-max-hero.jpg'),
(3, 4, 'GoPro Hero 13', 'Cámara de acción con estabilización avanzada', '2025-10-29 11:05:00', 499.00, 10, 'assets/images/anuncios/goPro hero13.jpg'),
(3, 4, 'Microfono Yeti', 'Micrófono profesional USB para streaming', '2025-10-29 11:10:00', 130.00, 15, 'assets/images/anuncios/microfono yeti.jpg'),
(3, 4, 'Teclado Razer Huntsman', 'Teclado óptico con iluminación RGB', '2025-10-29 11:15:00', 159.00, 25, 'assets/images/anuncios/teclado razer hutsman.jpg'),
(3, 4, 'Portátil Asus Zenbook', 'Ultrabook ligero de alto rendimiento', '2025-10-29 11:20:00', 999.00, 10, 'assets/images/anuncios/portatil asus zenbook.jpg'),
(3, 4, 'Xiaomi Redmi 13', 'Móvil económico con gran pantalla', '2025-10-29 11:25:00', 199.00, 30, 'assets/images/anuncios/xiamo redmi 3.jpg'),
(3, 4, 'Sony A7-IV', 'Cámara profesional mirrorless full-frame', '2025-10-30 08:15:00', 2500.00, 5, 'assets/images/anuncios/Sony-A7-IV.jpg'),
(3, 4, 'Altavoz portátil JBL Party Box', 'Altavoz portátil con graves potentes y batería de larga duración', '2025-10-29 12:55:00', 199.00, 12, 'assets/images/anuncios/altavoz portatil jbl party box.jpg'),
(3, 4, 'Logitech Webcam C270', 'Webcam HD 720p, ideal para videollamadas', '2025-10-29 13:00:00', 24.99, 25, 'assets/images/anuncios/logitech webcam C270.jpg'),
(3, 4, 'Logitech Mouse M185', 'Ratón inalámbrico compacto y fiable', '2025-10-29 13:05:00', 12.99, 30, 'assets/images/anuncios/logitech mouse m185.jpg'),
(3, 4, 'Sony SRS-XB13 Altavoz', 'Mini altavoz Bluetooth con Extra Bass', '2025-10-29 13:10:00', 39.99, 20, 'assets/images/anuncios/sony srs-XB13 altavoz.jpg'),
(3, 4, 'Samsung Galaxy Z Flip6', 'Smartphone plegable con pantalla AMOLED', '2025-10-29 13:15:00', 1099.00, 6, 'assets/images/anuncios/samsung galaxy z flip6.jpg'),
(5, 2, 'Masajeador Facial Eléctrico', 'Dispositivo de cuidado facial con luz LED azul y función térmica para rejuvenecer la piel.', '2025-10-29 13:20:00', 69.99, 15, 'assets/images/anuncios/Masajeador Facial Electrico Cara Masaje.jpg'),
(5, 2, 'Maybelline Lash Sensational Sky High', 'Máscara de pestañas que aporta volumen extremo y longitud sin apelmazar.', '2025-10-29 13:25:00', 12.95, 40, 'assets/images/anuncios/Maybelline New York Lash Sensational Sky High Mascara.jpg'),
(5, 2, 'Olay Regenerist SPF30', 'Crema hidratante antiedad con protección solar y efecto reafirmante.', '2025-10-29 13:30:00', 24.99, 25, 'assets/images/anuncios/Olay Regenerist Crema Facial.jpg'),
(3, 4, 'MSI Thin A15', 'Portátil gaming con RTX y pantalla 144Hz', '2025-10-29 11:35:00', 1150.00, 8, 'assets/images/anuncios/msi thin A15.jpg'),
(3, 4, 'Pioneer DJ DDJ-400', 'Controladora compacta para DJ', '2025-10-29 11:40:00', 270.00, 12, 'assets/images/anuncios/pioneer ddj 400.jpg'),
(3, 4, 'Pioneer DJ XDJ RX3', 'Sistema DJ profesional todo en uno', '2025-10-29 11:45:00', 1900.00, 6, 'assets/images/anuncios/pioneer dj xdj rx3.jpg'),
(7, 5, 'Balón Fútbol Nike Pitch', 'Balón de fútbol resistente y con buen agarre', '2025-10-29 11:50:00', 25.00, 30, 'assets/images/anuncios/balon futbol nike pitch.jpg'),
(7, 5, 'Gafas Natación Arena Air Speed', 'Gafas cómodas para entrenamiento diario', '2025-10-29 11:55:00', 30.00, 20, 'assets/images/anuncios/gafas natacion arena air speed.jpg'),
(7, 5, 'Tectake Canasta Baloncesto Dirk', 'Canasta ajustable para interior y exterior', '2025-10-29 12:00:00', 120.00, 5, 'assets/images/anuncios/tectake canasta baloncesto Dirk.jpg'),
(7, 5, 'Skateboard', 'Monopatín resistente ideal para principiantes', '2025-10-29 12:05:00', 65.00, 15, 'assets/images/anuncios/skateboard.jpg'),
(4, 6, 'BMW i8', 'Deportivo híbrido de lujo', '2025-10-30 12:10:00', 120000.00, 3, 'assets/images/anuncios/bmw i8.jpg'),
(4, 6, 'Michelin Pilot Sport 4S', 'Neumático de alto rendimiento', '2025-10-29 12:15:00', 210.00, 40, 'assets/images/anuncios/MICHELIN pilot sport 4S.jpg'),
(8, 9, 'Zoo Med Food Can O’Crickets', 'Grillos naturales para reptiles y camaleones', '2025-10-29 12:20:00', 7.50, 25, 'assets/images/anuncios/Zoo Med Food Can OCrickets Grillos para Camaleones y Reptiles.jpg'),
(8, 9, 'Sera Reptil Herbivor Nature', 'Alimento vegetal para reptiles herbívoros', '2025-10-29 12:25:00', 5.90, 30, 'assets/images/anuncios/Sera Reptil Herbivor Nature Alimento 80g.jpg'),
(8, 9, 'Tetra Guppy Mini Flakes', 'Alimento en escamas para peces pequeños', '2025-10-29 12:30:00', 3.99, 40, 'assets/images/anuncios/Tetra Guppy Colour Mini Flakes - alimento en escamas. 100mljpg.jpg'),
(9, 10, 'Balakaka Tienda de Juegos', 'Tienda de juegos infantil 182x96x76cm', '2025-10-29 12:35:00', 49.99, 10, 'assets/images/anuncios/Balakaka Tienda de Juegos para niños 182x96x76cm.jpg'),
(9, 10, 'Chicco Torre de Anillos', 'Anillos de colores apilables para bebés', '2025-10-29 12:40:00', 19.00, 25, 'assets/images/anuncios/Chicco Juego Torre de Anillos, 6 Anillos de Colores apilables.jpg'),
(9, 10, 'Cuento de tela Rojo, negro y blanco', 'Libro sensorial para bebés', '2025-10-29 12:45:00', 9.99, 20, 'assets/images/anuncios/Rojo, negro, blanco. Cuento de tela para bebés.jpg'),
(9, 10, 'Tabla de Recompensas para Niños', 'Tablero con imanes para fomentar hábitos', '2025-10-29 12:50:00', 22.00, 15, 'assets/images/anuncios/Tabla de Recompensas para Niños 280 imanes.jpg');

-- ===========================================
-- TABLA FAVORITOS
-- ===========================================

DROP TABLE IF EXISTS favoritos;
CREATE TABLE favoritos (
  ID_Favorito INT NOT NULL AUTO_INCREMENT,
  ID_Usuario INT NOT NULL,
  ID_Anuncio INT NOT NULL,
  PRIMARY KEY (ID_Favorito),
  UNIQUE KEY ID_Usuario (ID_Usuario, ID_Anuncio),
  KEY ID_Anuncio (ID_Anuncio),
  CONSTRAINT favoritos_ibfk_1 FOREIGN KEY (ID_Usuario) REFERENCES usuarios (ID_Usuario) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT favoritos_ibfk_2 FOREIGN KEY (ID_Anuncio) REFERENCES anuncios (ID_Anuncio) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;