-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2023 a las 22:53:51
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

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

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`usuario`, `texto`, `titulo`) VALUES
('juan', '', 'en tu casa o en mi casa'),
('juan', 'ayaya', 'en tu casa o en mi casa'),
('juan', 'hola', 'tonti'),
('juan', 'HOLAHOLA', 'tonti'),
('juan', 'que es este relato madre mia ya nadie piensa en los niños', 'en tu casa o en mi casa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `donante` varchar(16) CHARACTER SET utf8mb4 NOT NULL,
  `donado` varchar(16) CHARACTER SET utf8mb4 NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `donaciones`
--

INSERT INTO `donaciones` (`donante`, `donado`, `cantidad`, `id`) VALUES
('test', 'juan', 12, 2),
('test', 'juan', 13, 3),
('test', 'juan', 14, 4),
('test', 'juan', 34, 5),
('juan', 'juan', 22, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecturas`
--

CREATE TABLE `lecturas` (
  `Usuario` varchar(16) CHARACTER SET utf8mb4 NOT NULL,
  `titulo` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `hora_de_lectura` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lecturas`
--

INSERT INTO `lecturas` (`Usuario`, `titulo`, `hora_de_lectura`) VALUES
('juan', 'en tu casa o en mi casa', '2023-05-04 22:51:35'),
('juan', 'tonti', '2023-05-04 21:29:05'),
('test', 'tonti', '2023-05-04 21:22:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relatos`
--

CREATE TABLE `relatos` (
  `titulo` varchar(32) NOT NULL,
  `texto` varchar(512) NOT NULL,
  `usuario` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `relatos`
--

INSERT INTO `relatos` (`titulo`, `texto`, `usuario`) VALUES
('en tu casa o en mi casa', 'erase una vez un gato que andaba por su casa y hacia muuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu despues de comer se fue a la predera con sus amigas las vacas', 'juan'),
('tonti', 'bobi', 'juan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(16) NOT NULL,
  `contrasenia` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `contrasenia`) VALUES
('juan', 'juan'),
('test', 'test');

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
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donado` (`donado`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Filtros para la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD CONSTRAINT `donaciones_ibfk_1` FOREIGN KEY (`donado`) REFERENCES `usuarios` (`usuario`),
  ADD CONSTRAINT `donaciones_ibfk_2` FOREIGN KEY (`donante`) REFERENCES `usuarios` (`usuario`);

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
