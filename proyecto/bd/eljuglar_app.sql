-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2023 a las 10:58:16
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eljuglar_app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `usuario` varchar(16) NOT NULL,
  `texto` varchar(125) NOT NULL,
  `titulo` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecturas`
--

CREATE TABLE `lecturas` (
  `Usuario` varchar(16) CHARACTER SET utf8mb4 NOT NULL,
  `titulo` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `hora de lectura` date NOT NULL,
  `leido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relatos`
--

CREATE TABLE `relatos` (
  `titulo` varchar(32) NOT NULL,
  `texto` varchar(512) NOT NULL,
  `usuario` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(16) NOT NULL,
  `contrasenia` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`texto`),
  ADD KEY `titulo` (`titulo`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `titulo_2` (`titulo`);

--
-- Indices de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD PRIMARY KEY (`Usuario`,`titulo`),
  ADD KEY `titulo` (`titulo`);

--
-- Indices de la tabla `relatos`
--
ALTER TABLE `relatos`
  ADD PRIMARY KEY (`titulo`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `usuario_2` (`usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`),
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`titulo`) REFERENCES `relatos` (`titulo`);

--
-- Filtros para la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD CONSTRAINT `lecturas_ibfk_1` FOREIGN KEY (`Usuario`) REFERENCES `usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lecturas_ibfk_2` FOREIGN KEY (`titulo`) REFERENCES `relatos` (`titulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `relatos`
--
ALTER TABLE `relatos`
  ADD CONSTRAINT `relatos_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
