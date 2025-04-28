-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-04-2025 a las 00:03:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shopping_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales`
--

CREATE TABLE `locales` (
  `codLocal` int(11) NOT NULL,
  `nombreLocal` varchar(100) NOT NULL,
  `ubicacionLocal` varchar(100) NOT NULL,
  `rubroLocal` enum('Indumentaria','Comida','Perfumeria','Bazar') NOT NULL,
  `codUsuario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------



INSERT INTO locales (codLocal, nombreLocal, ubicacionLocal, rubroLocal, codUsuario) VALUES
(1, 'Nike', 'Piso 1 Ala Este', 'Indumentaria','4'),
(2, 'Adidas', 'Piso 1 Ala Oeste', 'Indumentaria','4'),
(3, 'Sport 78', 'Piso 0 Ala Este', 'Indumentaria','4'),
(4, 'Isadora', 'Piso 2 Ala Este', 'Perfumeria','4'),
(5, 'McDonals', 'Patio de Comidas', 'Comida','4'),
(6, 'KFC', 'Patio de Comidas', 'Comida','4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedades`
--

CREATE TABLE `novedades` (
  `codNovedad` int(11) NOT NULL,
  `textoNovedad` varchar(100) NOT NULL,
  `fechaDesdeNovedad` date NOT NULL,
  `fechaHastaNovedad` date NOT NULL,
  `tipoUsuario` enum('Inicial','Medium','Premium') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `codPromo` int(11) NOT NULL,
  `textoPromo` varchar(100) NOT NULL,
  `fechaDesdePromo` date NOT NULL,
  `fechaHastaPromo` date NOT NULL,
  `categoriaCliente` enum('Inicial','Medium','Premium') NOT NULL,
  `diasSemana` set('1','2','3','4','5','6','7') NOT NULL,
  `estadoPromo` enum('Pendiente','Aprobada','Denegada') NOT NULL,
  `codLocal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `codSolicitud` int(11) NOT NULL,
  `codUsuario` int(100) NOT NULL,
  `nombreDescuento` varchar(100) NOT NULL,
  `codLocal` int(11) NOT NULL,
  `estado` enum('Confirmada','Pendiente','Rechazada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`codSolicitud`, `codUsuario`, `nombreDescuento`, `codLocal`, `estado`) VALUES
(1, 1, 'Descuento 1', 2, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uso_promociones`
--

CREATE TABLE `uso_promociones` (
  `codCliente` int(11) NOT NULL,
  `codPromo` int(11) NOT NULL,
  `fechaUsoPromo` date NOT NULL,
  `estado` enum('enviada','aceptada','rechazada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `claveUsuario` varchar(255) NOT NULL,
  `tipoUsuario` enum('cliente','dueño de local','administrador') NOT NULL,
  `categoriaCliente` enum('Inicial','Medium','Premium') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codUsuario`, `nombreUsuario`, `email`, `claveUsuario`, `tipoUsuario`, `categoriaCliente`) VALUES
(1, 'enrico', 'ereschini06@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'cliente', 'Inicial'),
(3, 'enricota', 'reschinienrico@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'cliente', 'Inicial'),
(4, 'tralalerotralala', 'tralaleroelmejor@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'dueño de local', ''),
(5, 'br br patapin', 'brbrpata@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'dueño de local', ''),
(6, 'valerina capuchina', 'lavalelarompe@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'dueño de local', ''),
(7, 'enricota2', 'enricota2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'cliente', 'Inicial'),
(8, 'bombini gusini', 'elcocoesaltobobo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', '');


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`codLocal`);

--
-- Indices de la tabla `novedades`
--
ALTER TABLE `novedades`
  ADD PRIMARY KEY (`codNovedad`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`codPromo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `locales`
--
ALTER TABLE `locales`
  MODIFY `codLocal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `novedades`
--
ALTER TABLE `novedades`
  MODIFY `codNovedad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `codPromo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
