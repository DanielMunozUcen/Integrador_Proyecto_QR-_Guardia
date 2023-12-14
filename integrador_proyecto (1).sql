-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2023 a las 20:51:05
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
-- Base de datos: `integrador_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `rut_adm` varchar(20) NOT NULL,
  `cargo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`rut_adm`, `cargo`) VALUES
('987', 'administrador pro'),
('admin', 'administrador pro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `rut_e` varchar(20) NOT NULL,
  `carrera` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`rut_e`, `carrera`) VALUES
('10', 'bailarin'),
('18778296-1', 'economia'),
('9999999-9', 'economia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guardia`
--

CREATE TABLE `guardia` (
  `rut_g` varchar(20) NOT NULL,
  `inicio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `guardia`
--

INSERT INTO `guardia` (`rut_g`, `inicio`) VALUES
('1', 2023),
('123', 2023),
('64867030-3', 2023),
('guardia2', 2023);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_egreso`
--

CREATE TABLE `ingreso_egreso` (
  `id_ie` int(11) NOT NULL,
  `rut_e` varchar(20) DEFAULT NULL,
  `rut_g` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `edificio` varchar(1) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `ingreso_egreso`
--

INSERT INTO `ingreso_egreso` (`id_ie`, `rut_e`, `rut_g`, `fecha`, `hora`, `edificio`, `tipo`) VALUES
(1, '9999999-9', '123', '2023-12-10', '00:49:37', 'A', 'ingreso'),
(2, '9999999-9', '123', '2023-12-10', '00:49:40', 'A', 'egreso'),
(3, '9999999-9', '123', '2023-12-10', '00:57:03', 'A', 'ingreso'),
(4, '9999999-9', '123', '2023-12-10', '00:57:07', 'B', 'egreso'),
(5, '9999999-9', '123', '2023-12-10', '00:57:13', 'A', 'ingreso'),
(6, '9999999-9', '123', '2023-12-10', '00:57:17', 'B', 'egreso'),
(7, '9999999-9', '123', '2023-12-10', '00:57:23', 'B', 'ingreso'),
(12, '9999999-9', '123', '2023-12-10', '02:52:26', 'A', 'egreso'),
(13, '9999999-9', '123', '2023-12-10', '02:52:31', 'A', 'ingreso'),
(14, '9999999-9', '123', '2023-12-10', '02:52:37', 'A', 'egreso'),
(15, '9999999-9', '123', '2023-12-10', '03:13:55', 'A', 'ingreso'),
(16, '9999999-9', '123', '2023-12-10', '03:14:00', 'A', 'egreso'),
(17, '9999999-9', '123', '2023-12-10', '03:17:06', 'A', 'ingreso'),
(18, '9999999-9', '123', '2023-12-10', '03:17:12', 'B', 'egreso'),
(19, '9999999-9', '123', '2023-12-10', '19:40:03', 'A', 'ingreso'),
(20, '9999999-9', '123', '2023-12-10', '19:40:09', 'A', 'egreso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `passwords`
--

CREATE TABLE `passwords` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `token` varchar(200) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `passwords`
--

INSERT INTO `passwords` (`id`, `correo`, `token`, `codigo`, `fecha`) VALUES
(1, 'guardia@guardia.com', 'f40339d7ff', 1858, '2023-11-20 01:02:51'),
(2, 'guardia@guardia.com', 'b879e13941', 3348, '2023-11-20 01:05:23'),
(3, 'guardia@guardia.com', '1f2683ede9', 9344, '2023-11-20 01:27:33'),
(4, 'guardia@guardia.com', '3a5201b354', 6462, '2023-11-20 02:21:03'),
(5, 'guardia@guardia.com', 'b40a00f351', 8617, '2023-11-20 02:21:42'),
(6, 'guardia@guardia.com', '7511862422', 1839, '2023-11-20 02:26:35'),
(7, 'guardia@guardia.com', 'fde8c06f2d', 6338, '2023-11-20 02:28:31'),
(8, 'guardia@guardia.com', '959ece796f', 9906, '2023-11-20 02:29:07'),
(9, 'guardia@guardia.com', '97dc10a525', 7059, '2023-11-20 02:30:11'),
(10, 'guardia@guardia.com', 'bd9ed3cdd8', 4073, '2023-11-20 02:31:40'),
(11, 'guardia@guardia.com', '15e816facb', 1298, '2023-11-20 02:35:17'),
(12, 'guardia@guardia.com', 'eb9e6dede3', 2592, '2023-11-20 02:36:13'),
(13, 'guardia@guardia.com', '93d5cd5b24', 7614, '2023-11-20 02:36:27'),
(14, 'guardia@guardia.com', '6e6defa753', 7086, '2023-11-20 02:40:30'),
(15, 'guardia@guardia.com', '7cbd53219c', 7950, '2023-11-20 02:42:13'),
(16, 'guardia@guardia.com', '6e0cd33ec3', 1621, '2023-11-20 02:46:55'),
(17, 'guardia@guardia.com', '65315f26c6', 6981, '2023-11-20 02:48:56'),
(18, 'guardia@guardia.com', '83563a99ce', 7715, '2023-11-20 02:49:19'),
(19, 'guardia@guardia.com', '5afa8709c4', 4735, '2023-11-21 02:49:21'),
(20, 'guardia@guardia.com', '991472de63', 8251, '2023-11-24 01:25:52'),
(21, 'guardia@guardia.com', 'be60f3a499', 2023, '2023-12-04 23:35:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE `transporte` (
  `id_t` varchar(20) NOT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `rut_e` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `transporte`
--

INSERT INTO `transporte` (`id_t`, `marca`, `modelo`, `color`, `tipo`, `rut_e`) VALUES
('1', 'oxford', 'rd1', 'negro', 'bicicleta', '9999999-9'),
('2', 'oxford', 'rd1', 'negro', 'bicicleta', '18778296-1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `rut` varchar(20) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `fono` int(20) DEFAULT NULL,
  `correo` varchar(20) DEFAULT NULL,
  `estado` int(11) DEFAULT 0,
  `clave` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`rut`, `nombre`, `apellido`, `fono`, `correo`, `estado`, `clave`) VALUES
('1', '123', '123', 123, '123', 1, '4dff4ea340f0a823f15d3f4f01ab62eae0e5da579ccb851f8db9dfe84c58b2b37b89903a740e1ee172da793a6e79d560e5f7f9bd058a12a280433ed6fa46510a'),
('10', 'alumnoprueba', 'alumnoprueba', 1111111, 'a@a.cl', 0, 'notienejejeje'),
('123', 'gua', 'ardia', 123, 'guardia@guardia.com', 0, '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2'),
('18778296-1', 'da', 'niel', 1111111, 'a@a.cl', 0, 'jejej'),
('64867030-3', 'Juanita', 'DelFuturo', 123, 'a@a.cl', 1, '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2'),
('987', 'admin', 'administrador', 123, 'a@a.cl', 0, '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2'),
('9999999-9', 'estudiante', 'prueba', 1, 'a@a.cl', 0, ''),
('admin', 'admin', 'admin', 123, 'admin@admin.cl', 0, '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2'),
('guardia2', 'guardia2', 'pepe', 123, 'guardi2a@guardia.com', 0, '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`rut_adm`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`rut_e`);

--
-- Indices de la tabla `guardia`
--
ALTER TABLE `guardia`
  ADD PRIMARY KEY (`rut_g`);

--
-- Indices de la tabla `ingreso_egreso`
--
ALTER TABLE `ingreso_egreso`
  ADD PRIMARY KEY (`id_ie`),
  ADD KEY `rut_e` (`rut_e`),
  ADD KEY `rut_g` (`rut_g`);

--
-- Indices de la tabla `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`id_t`),
  ADD KEY `rut_e` (`rut_e`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`rut`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ingreso_egreso`
--
ALTER TABLE `ingreso_egreso`
  MODIFY `id_ie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`rut_adm`) REFERENCES `usuario` (`rut`);

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`rut_e`) REFERENCES `usuario` (`rut`);

--
-- Filtros para la tabla `guardia`
--
ALTER TABLE `guardia`
  ADD CONSTRAINT `guardia_ibfk_1` FOREIGN KEY (`rut_g`) REFERENCES `usuario` (`rut`);

--
-- Filtros para la tabla `ingreso_egreso`
--
ALTER TABLE `ingreso_egreso`
  ADD CONSTRAINT `ingreso_egreso_ibfk_1` FOREIGN KEY (`rut_e`) REFERENCES `estudiante` (`rut_e`),
  ADD CONSTRAINT `ingreso_egreso_ibfk_2` FOREIGN KEY (`rut_g`) REFERENCES `guardia` (`rut_g`);

--
-- Filtros para la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD CONSTRAINT `transporte_ibfk_1` FOREIGN KEY (`rut_e`) REFERENCES `estudiante` (`rut_e`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
