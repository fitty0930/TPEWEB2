-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2019 a las 21:27:45
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tpe`
--
CREATE DATABASE IF NOT EXISTS `db_tpe` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_tpe`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'Computación'),
(2, 'Celulares'),
(3, 'Consolas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gcaptcha`
--

CREATE TABLE IF NOT EXISTS `gcaptcha` (
  `web_key` varchar(200) NOT NULL,
  `secret_key` varchar(200) NOT NULL,
  PRIMARY KEY (`web_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gcaptcha`
--

INSERT INTO `gcaptcha` (`web_key`, `secret_key`) VALUES
('6LfUjr0UAAAAAM5KzEEFPPUvwSgpk8SxUKvQJuKJ', '6LfUjr0UAAAAAEww994jA2E_XXlPgPKo7LKSalWV');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `producto` varchar(20) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `precio` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_categoría` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_categoria`, `producto`, `marca`, `precio`) VALUES
(7, 1, 'Auriculares', 'Genius', 200),
(13, 3, 'Playstation', 'Sony', 1000),
(14, 2, 'S3', 'Motorola', 200),
(16, 3, 'Playstation', 'Sony', 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(15) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `password`) VALUES
(1, 'martin0930', '$2y$10$lalWJ3mJqRWRmGTbPMtsU.XGmJ8//mGUTpH21U4jjw5vVjHnauV.C'),
(2, 'usuario123', '$2y$10$LSfX6H8tdAA/rUJ5mDIO.e7MV8NlTAyaEr83yKXdHKYZ9actu4VAS');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
