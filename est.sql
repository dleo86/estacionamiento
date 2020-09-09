-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-09-2020 a las 06:03:23
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `est`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `idCaja` int(11) NOT NULL,
  `totalCaja` float NOT NULL,
  `fechaCaja` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idCaja`, `totalCaja`, `fechaCaja`) VALUES
(1, 0, '2020-06-09 19:00:00'),
(2, 7750, '2020-06-09 19:51:41'),
(4, 11200, '2020-06-13 18:28:36'),
(5, 1950, '2020-06-16 12:19:23'),
(6, 0, '2020-06-16 19:47:02'),
(7, 20550, '2020-06-16 19:47:07'),
(8, 8800, '2020-06-19 10:31:42'),
(9, 307000, '2020-06-23 01:48:10'),
(10, 50, '2020-09-07 02:29:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `Vehiculo_idVehiculo` int(11) NOT NULL,
  `Persona_idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `Vehiculo_idVehiculo`, `Persona_idPersona`) VALUES
(1, 1, 2),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE `domicilio` (
  `idDomicilio` int(11) NOT NULL,
  `calleDom` varchar(45) DEFAULT NULL,
  `numDom` int(11) DEFAULT NULL,
  `pisoDom` int(11) DEFAULT NULL,
  `dptoDom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`idDomicilio`, `calleDom`, `numDom`, `pisoDom`, `dptoDom`) VALUES
(1, 'Viamonte', 223, 0, ''),
(2, 'Viamonte', 223, NULL, NULL),
(4, 'Rondo', 130, 0, ''),
(5, 'Charlone', 141, 0, ''),
(6, 'Terrada', 123, 6, 'B'),
(9, 'Soler', 137, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

CREATE TABLE `lugar` (
  `idLugar` int(11) NOT NULL,
  `Lugar` varchar(45) NOT NULL,
  `Estado` varchar(45) NOT NULL DEFAULT 'No ocupado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`idLugar`, `Lugar`, `Estado`) VALUES
(1, '1', 'Ocupado'),
(2, '2', 'No ocupado'),
(3, '3', 'No ocupado'),
(4, '4', 'No ocupado'),
(5, '5', 'No ocupado'),
(6, '6', 'No ocupado'),
(7, '7', 'No ocupado'),
(8, '8', 'No ocupado'),
(9, '9', 'No ocupado'),
(10, '10', 'No ocupado'),
(11, '11', 'No ocupado'),
(12, '12', 'No ocupado'),
(13, '13', 'No ocupado'),
(14, '14', 'No ocupado'),
(15, '15', 'No ocupado'),
(16, '16', 'No ocupado'),
(17, '17', 'No ocupado'),
(18, '18', 'No ocupado'),
(19, '19', 'No ocupado'),
(20, '20', 'No ocupado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL,
  `nomPersona` varchar(45) DEFAULT NULL,
  `apelPersona` varchar(45) DEFAULT NULL,
  `nacPersona` date DEFAULT NULL,
  `telPersona` varchar(45) DEFAULT NULL,
  `dniPersona` int(11) DEFAULT NULL,
  `Domicilio_idDomicilio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idPersona`, `nomPersona`, `apelPersona`, `nacPersona`, `telPersona`, `dniPersona`, `Domicilio_idDomicilio`) VALUES
(1, 'Ricardo', 'Rand', NULL, '2914986632', 33214604, 1),
(2, 'Mariana', 'Rizzo', '0000-00-00', '2915543678', 34554021, 2),
(4, 'Rodrigo Javier', 'Narvaja', '1988-06-02', '2914376891', 32254999, 4),
(5, 'Victor', 'Ramirez', '1987-09-05', '2914569924', 33405106, 5),
(7, 'Javier', 'Sosa', '1986-08-29', '2914520336', 32456009, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idReserva` int(11) NOT NULL,
  `Desde` datetime NOT NULL,
  `Hasta` datetime DEFAULT NULL,
  `Costo` float NOT NULL DEFAULT '50',
  `Est` varchar(150) NOT NULL DEFAULT 'Ocupado',
  `Lugar_idLugar` int(11) NOT NULL,
  `Caja_idCaja` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Vehiculo_idVehiculo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`idReserva`, `Desde`, `Hasta`, `Costo`, `Est`, `Lugar_idLugar`, `Caja_idCaja`, `Usuario_idUsuario`, `Vehiculo_idVehiculo`) VALUES
(12, '2020-06-10 18:42:56', '2020-06-11 18:18:39', 2400, 'No ocupado', 3, 2, 1, 15),
(14, '2020-06-11 17:09:06', '2020-06-11 18:18:51', 150, 'No ocupado', 2, 2, 1, 17),
(16, '2020-06-11 17:49:30', '2020-06-13 17:44:47', 4800, 'No ocupado', 4, 2, 1, 19),
(17, '2020-06-11 18:16:45', '2020-06-11 20:03:23', 200, 'No ocupado', 6, 2, 1, 20),
(18, '2020-06-11 18:17:39', '2020-06-11 20:12:39', 200, 'No ocupado', 1, 2, 1, 21),
(22, '2020-06-13 19:52:40', '2020-06-13 19:52:48', 50, 'No ocupado', 1, 4, 1, 25),
(23, '2020-06-13 19:56:50', '2020-06-16 15:54:39', 6800, 'No ocupado', 1, 4, 1, 26),
(24, '2020-06-15 16:32:37', '2020-06-17 11:55:58', 4350, 'No ocupado', 2, 4, 1, 27),
(26, '2020-06-16 17:38:57', '2020-06-17 12:42:10', 1950, 'No ocupado', 6, 5, 1, 29),
(27, '2020-06-17 11:58:14', '2020-06-18 16:31:29', 2900, 'No ocupado', 7, 7, 1, 30),
(28, '2020-06-17 12:43:27', '2020-06-19 10:32:03', 4600, 'No ocupado', 1, 7, 1, 31),
(29, '2020-06-17 15:32:45', '2020-06-23 01:48:45', 13050, 'No ocupado', 6, 7, 1, 32),
(30, '2020-06-19 10:31:58', '2020-06-19 16:18:17', 600, 'No ocupado', 2, 8, 1, 33),
(31, '2020-06-19 16:16:32', '2020-06-19 16:18:49', 50, 'No ocupado', 1, 8, 1, 34),
(32, '2020-06-19 16:20:34', '2020-06-23 01:49:01', 8150, 'No ocupado', 1, 8, 1, 35),
(35, '2020-06-23 02:08:37', '2020-08-13 22:28:49', 124450, 'No ocupado', 1, 9, 4, 39),
(36, '2020-06-23 02:08:57', '2020-09-07 02:29:51', 182450, 'No ocupado', 3, 9, 4, 40),
(37, '2020-08-13 22:27:59', '2020-08-13 22:28:13', 50, 'No ocupado', 2, 9, 4, 41),
(38, '2020-09-07 02:27:45', '2020-09-07 02:28:13', 50, 'No ocupado', 1, 9, 4, 42),
(39, '2020-09-07 02:29:48', '0000-00-00 00:00:00', 50, 'Ocupado', 1, 10, 4, 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `userName` varchar(45) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `userPriv` varchar(45) DEFAULT NULL,
  `userIngreso` date DEFAULT NULL,
  `Persona_idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `userName`, `userPass`, `userPriv`, `userIngreso`, `Persona_idPersona`) VALUES
(1, 'dleo', '$2y$10$WOIJW0pcQS/6/0VDH9XlA.U9o1/eZT8y7Mjl4We1U3JGZl9N7uYxy', 'Usuario', '2020-06-09', 4),
(2, 'rvictor', '$2y$10$aXAfr.EaR5k8cin18kNqeO3lVZ/ogLk7czqo7ZM9d13SKBm7TPNWq', 'Usuario', '2020-06-16', 5),
(4, 'Admin', '$2y$10$vsjFOlFrDMoNUZjPshrVweyRdivO/sffqssCS8.XorJPxh/3UQfIu', 'Administrador', '2020-06-23', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `idVehiculo` int(11) NOT NULL,
  `patente` varchar(45) NOT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `modelo` varchar(145) DEFAULT NULL,
  `anio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`idVehiculo`, `patente`, `marca`, `modelo`, `anio`) VALUES
(1, 'AAD546', 'Peugeot 208', NULL, NULL),
(2, 'BBC187', 'Fiat 500', NULL, NULL),
(3, 'CCD122', 'Renoult', '2017', 2017),
(7, '', NULL, NULL, NULL),
(8, 'BDS123', NULL, NULL, NULL),
(9, 'BDS504', NULL, NULL, NULL),
(10, 'AAS143', NULL, NULL, NULL),
(11, 'FKA153', NULL, NULL, NULL),
(12, 'AZA007', NULL, NULL, NULL),
(15, 'FFG543', NULL, NULL, NULL),
(16, 'ASS103', NULL, NULL, NULL),
(17, 'BOH456', NULL, NULL, NULL),
(18, 'PPW337', NULL, NULL, NULL),
(19, 'QPO990', NULL, NULL, NULL),
(20, 'AAZ706', NULL, NULL, NULL),
(21, 'LLA123', NULL, NULL, NULL),
(22, 'PPJ890', NULL, NULL, NULL),
(23, 'ZZZ666', NULL, NULL, NULL),
(24, 'ZOP124', NULL, NULL, NULL),
(25, 'PPP472', NULL, NULL, NULL),
(26, 'HGA122', NULL, NULL, NULL),
(27, 'SDF678', NULL, NULL, NULL),
(28, '', NULL, NULL, NULL),
(29, 'HGB123', NULL, NULL, NULL),
(30, 'LOP143', NULL, NULL, NULL),
(31, 'SDF688', NULL, NULL, NULL),
(32, 'HGB103', NULL, NULL, NULL),
(33, 'AAZ519', NULL, NULL, NULL),
(34, 'OPQ757', NULL, NULL, NULL),
(35, 'ASD009', NULL, NULL, NULL),
(36, 'AAS321', NULL, NULL, NULL),
(37, 'FOH123', NULL, NULL, NULL),
(38, 'AAS666', NULL, NULL, NULL),
(39, 'AAS666', NULL, NULL, NULL),
(40, 'HBO777', NULL, NULL, NULL),
(41, 'HGB222', NULL, NULL, NULL),
(42, 'HGB125', NULL, NULL, NULL),
(43, 'PPQ123', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`idCaja`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `fk_Cliente_Vehiculo1_idx` (`Vehiculo_idVehiculo`),
  ADD KEY `fk_Cliente_Persona1_idx` (`Persona_idPersona`);

--
-- Indices de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD PRIMARY KEY (`idDomicilio`);

--
-- Indices de la tabla `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`idLugar`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`),
  ADD KEY `fk_Persona_Domicilio_idx` (`Domicilio_idDomicilio`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `fk_Reserva_Lugar1_idx` (`Lugar_idLugar`),
  ADD KEY `fk_Reserva_Caja1_idx` (`Caja_idCaja`),
  ADD KEY `fk_Reserva_Usuario1_idx` (`Usuario_idUsuario`),
  ADD KEY `fk_Reserva_Vehiculo1_idx` (`Vehiculo_idVehiculo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_Usuario_Persona1_idx` (`Persona_idPersona`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`idVehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `idCaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `domicilio`
--
ALTER TABLE `domicilio`
  MODIFY `idDomicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `idLugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `idVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_Cliente_Persona1` FOREIGN KEY (`Persona_idPersona`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cliente_Vehiculo1` FOREIGN KEY (`Vehiculo_idVehiculo`) REFERENCES `vehiculo` (`idVehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_Persona_Domicilio` FOREIGN KEY (`Domicilio_idDomicilio`) REFERENCES `domicilio` (`idDomicilio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_Reserva_Caja1` FOREIGN KEY (`Caja_idCaja`) REFERENCES `caja` (`idCaja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reserva_Lugar1` FOREIGN KEY (`Lugar_idLugar`) REFERENCES `lugar` (`idLugar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reserva_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reserva_Vehiculo1` FOREIGN KEY (`Vehiculo_idVehiculo`) REFERENCES `vehiculo` (`idVehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Persona1` FOREIGN KEY (`Persona_idPersona`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
