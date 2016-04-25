-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2016 a las 23:19:53
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fifa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `copa`
--

CREATE TABLE `copa` (
  `idcopa` int(4) NOT NULL,
  `nombrecopa` varchar(25) NOT NULL,
  `fechaini` date NOT NULL,
  `fechafin` date NOT NULL,
  `premiocopa` int(6) DEFAULT NULL,
  `ganadorcopa` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `copa`
--

INSERT INTO `copa` (`idcopa`, `nombrecopa`, `fechaini`, `fechafin`, `premiocopa`, `ganadorcopa`) VALUES
(2, 'Copa 1', '2016-01-02', '2016-03-02', 100, ''),
(3, 'Copa 2', '2016-03-01', '2016-04-01', 50, ''),
(4, 'Copa 3', '2016-12-01', '2016-12-31', 60, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idequipo` int(4) NOT NULL,
  `nombreequipo` varchar(25) NOT NULL,
  `liga` varchar(25) NOT NULL,
  `valoracion` decimal(2,1) DEFAULT NULL,
  `imagenequipo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idequipo`, `nombreequipo`, `liga`, `valoracion`, `imagenequipo`) VALUES
(1, 'Real Madrid', 'BBVA', '5.0', 'Real Madrid'),
(2, 'Barcelona', 'BBVA', '5.0', 'Barcelona'),
(3, 'Valencia', 'BBVA', '3.8', 'Valencia'),
(4, 'Sevilla', 'BBVA', '4.0', 'Sevilla'),
(5, 'Atletico', 'BBVA', '4.5', 'Atletico'),
(6, 'Almeria', 'BBVA', '2.5', 'Almeria'),
(7, 'Cordoba', 'BBVA', '2.0', 'Cordoba'),
(8, 'Athletic', 'BBVA', '3.5', 'Athletic'),
(9, 'Real Sociedad', 'BBVA', '3.5', 'Real Sociedad'),
(10, 'Malaga', 'BBVA', '1.5', 'Malaga'),
(11, 'Levante', 'BBVA', '3.6', 'Levante'),
(12, 'Eibar', 'BBVA', '2.0', 'Eibar'),
(13, 'Elche', 'BBVA', '2.0', 'Elche'),
(14, 'Getafe', 'BBVA', '3.0', 'Getafe'),
(15, 'Granada', 'BBVA', '2.8', 'Granada'),
(16, 'Celta', 'BBVA', '3.0', 'Celta'),
(17, 'Espanyol', 'BBVA', '2.8', 'Espanyol'),
(18, 'Deportivo', 'BBVA', '3.0', 'Deportivo'),
(19, 'Rayo', 'BBVA', '2.0', 'Rayo'),
(20, 'Villarreal', 'BBVA', '3.9', 'Villarreal'),
(21, 'Arsenal', 'Premier League', '4.5', 'Arsenal'),
(22, 'Chelsea', 'Premier League', '5.0', 'Chelsea'),
(23, 'Manchester United', 'Premier League', '4.2', 'Manchester United'),
(24, 'Manchester City', 'Premier League', '5.0', 'Manchester City'),
(25, 'Liverpool', 'Premier League', '4.2', 'Liverpool'),
(26, 'Southampton', 'Premier League', '3.8', 'Southampton'),
(27, 'Bayern', 'Bundesliga', '5.0', 'Bayern'),
(28, 'Borussia Dortmund', 'Bundesliga', '4.0', 'Borussia Dortmund'),
(29, 'Werder Bremen', 'Bundesliga', '3.0', 'Werder Bremen'),
(30, 'Schalke 04', 'Bundesliga', '3.0', 'Schalke 04'),
(31, 'Hamburgo', 'Bundesliga', '3.2', 'Hamburgo'),
(32, 'Milan', 'Serie A', '4.0', 'Milan'),
(33, 'Roma', 'Serie A', '3.8', 'Roma'),
(34, 'Inter', 'Serie A', '3.8', 'Inter'),
(35, 'Juventus', 'Serie A', '4.8', 'Juventus'),
(36, 'Lazio', 'Serie A', '3.5', 'Lazio'),
(37, 'Fiorentina', 'Serie A', '3.2', 'Fiorentina'),
(38, 'Real Betis', 'Adelante', '2.8', 'Real Betis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juega`
--

CREATE TABLE `juega` (
  `idjugador` int(4) DEFAULT NULL,
  `idcopa` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `juega`
--

INSERT INTO `juega` (`idjugador`, `idcopa`) VALUES
(19, 2),
(20, 2),
(20, 3),
(20, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `idjugador` int(4) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `apellidos` varchar(25) DEFAULT NULL,
  `fecnac` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `pais` varchar(15) DEFAULT NULL,
  `clave` varchar(40) NOT NULL,
  `equipofav` varchar(25) DEFAULT NULL,
  `administrador` tinyint(1) DEFAULT '0',
  `archivo` varchar(50) NOT NULL DEFAULT 'pordefecto.jpg',
  `temapref` varchar(10) NOT NULL DEFAULT 'original'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`idjugador`, `alias`, `nombre`, `apellidos`, `fecnac`, `email`, `pais`, `clave`, `equipofav`, `administrador`, `archivo`, `temapref`) VALUES
(19, 'admin', 'admin', 'admin', '2015-05-11', 'admin@email.com', 'Spain', '21232f297a57a5a743894a0e4a801fc3', 'Real Betis', 1, '19.jpg', 'original'),
(20, 'trianalolo', 'trianalolo', 'trianalolo', '2015-12-31', 'trianalolo@email.com', 'Triana', 'fd6408fa4296a98135c24e674e5abb73', 'Juventus', 0, '20.jpg', 'original'),
(61, 'menchaca14', 'Ignacio', 'Menchaca Recio', '1992-08-03', 'menchacaignacio@gmail.com', 'Spain', 'e10adc3949ba59abbe56e057f20f883e', 'Sevilla', 1, 'pordefecto.jpg', 'original');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador_temp`
--

CREATE TABLE `jugador_temp` (
  `alias` varchar(20) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `apellidos` varchar(25) DEFAULT NULL,
  `fecnac` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `pais` varchar(15) DEFAULT NULL,
  `clave` varchar(40) NOT NULL,
  `equipofav` varchar(25) DEFAULT NULL,
  `administrador` tinyint(1) DEFAULT '0',
  `archivo` varchar(50) NOT NULL,
  `text_Activ` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jugador_temp`
--

INSERT INTO `jugador_temp` (`alias`, `nombre`, `apellidos`, `fecnac`, `email`, `pais`, `clave`, `equipofav`, `administrador`, `archivo`, `text_Activ`) VALUES
('admin', 'admin2', 'admin', '2015-12-31', 'admin@email.com', 'Spain', '21232f297a57a5a743894a0e4a801fc3', 'Manchester City', 1, '19.jpg', '1'),
('ganondorfoc', 'Feder', 'Ortega Cabrera', '1992-03-30', 'fedeortegacabrera@gmail.com', 'Spain', 'beeb6de877344eb0cab91cdaa186070e', 'Sevilla', 0, 'pordefecto.jpg', '6v1dL05A4EiH5UaINa09'),
('heinther', 'hei', 'nther', '2015-05-20', 'heinther@gmail.com', 'Spain', '427572e1c91dc1ae8c81248d72d85655', 'Almeria', 0, 'pordefecto.jpg', '7d839M3p3eK2I0Xorc2q'),
('javier', 'Javier', 'Rodriguez', '1992-08-21', 'javier21roga@gmail.com', 'Spain', '3c9c03d6008a5adf42c2a55dd4a1a9f2', 'Real Betis', 0, 'pordefecto.jpg', 'e806x8wWeROWu3wqu5WU'),
('klunk', 'klunk', 'klunk', '2015-12-31', 'klunk@email.com', 'Metropolis', 'fd6408fa4296a98135c24e674e5abb73', 'Werder Bremen', 0, '20.jpg', '2'),
('naxo14', 'Ignacio', 'Menchaca Recio', '1992-08-03', 'menchacaignacio@gmail.com', 'Spain', 'e10adc3949ba59abbe56e057f20f883e', 'Sevilla', 0, 'pordefecto.jpg', 'gi6O08IWici7e2BSTIuw'),
('prueba1000', 'prueba', '1992', '1992-12-31', 'prueba1992@email.com', 'Spain', 'df995f049c64984013000f6ef6446387', 'Chelsea', 0, 'pordefecto.jpg', 'prueba'),
('usuario1', 'usuario', 'uno', '2015-12-31', 'usuario1@email.com', 'Spain', '122b738600a0f74f7c331c0ef59bc34c', 'Barcelona', 0, '21.jpg', '3'),
('usuario2', 'usuario', 'dos', '2015-12-31', 'usuario2@email.com', 'Spain', '2fb6c8d2f3842a5ceaa9bf320e649ff0', 'Borussia Dortmund', 0, '22.jpg', '4'),
('usuario3', 'usuario', 'tres', '2015-12-31', 'usuario3@email.com', 'Spain', '5a54c609c08a0ab3f7f8eef1365bfda6', 'Juventus', 0, '22.jpg', '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liga`
--

CREATE TABLE `liga` (
  `idliga` int(4) NOT NULL,
  `nombreliga` varchar(25) NOT NULL,
  `fecini` date NOT NULL,
  `fecfin` date NOT NULL,
  `premioliga` int(6) DEFAULT NULL,
  `jornadas` int(2) NOT NULL,
  `aliasganador` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `liga`
--

INSERT INTO `liga` (`idliga`, `nombreliga`, `fecini`, `fecfin`, `premioliga`, `jornadas`, `aliasganador`) VALUES
(1, 'Liga 1', '2016-03-21', '2016-06-21', 1259, 20, ''),
(2, 'Liga 2', '2016-06-22', '2016-09-22', 570, 20, ''),
(3, 'Liga 3', '2016-09-23', '2016-12-17', 689, 20, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participa`
--

CREATE TABLE `participa` (
  `idjugador` int(4) NOT NULL,
  `idliga` int(4) NOT NULL,
  `puntos` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `participa`
--

INSERT INTO `participa` (`idjugador`, `idliga`, `puntos`) VALUES
(19, 1, 0),
(20, 1, 7),
(20, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `idpartido` int(4) NOT NULL,
  `fecpartido` datetime NOT NULL,
  `idlocal` int(4) NOT NULL,
  `idvisitante` int(4) NOT NULL,
  `golesloc` int(11) DEFAULT NULL,
  `golesvis` int(11) DEFAULT NULL,
  `ganadorpartido` int(4) DEFAULT NULL,
  `idcopa` int(4) DEFAULT NULL,
  `idliga` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`idpartido`, `fecpartido`, `idlocal`, `idvisitante`, `golesloc`, `golesvis`, `ganadorpartido`, `idcopa`, `idliga`) VALUES
(41, '2016-08-03 10:00:00', 19, 20, 8, 0, 20, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usa`
--

CREATE TABLE `usa` (
  `idjugador` int(4) NOT NULL DEFAULT '0',
  `idequipo` int(4) NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL,
  `idpartido` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usa`
--

INSERT INTO `usa` (`idjugador`, `idequipo`, `fecha`, `idpartido`) VALUES
(19, 1, '0000-00-00 00:00:00', 41),
(20, 2, '0000-00-00 00:00:00', 41);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `copa`
--
ALTER TABLE `copa`
  ADD PRIMARY KEY (`idcopa`),
  ADD UNIQUE KEY `nombrecopa` (`nombrecopa`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idequipo`),
  ADD UNIQUE KEY `nombreequipo` (`nombreequipo`),
  ADD UNIQUE KEY `imagenequipo` (`imagenequipo`);

--
-- Indices de la tabla `juega`
--
ALTER TABLE `juega`
  ADD UNIQUE KEY `idjugador` (`idjugador`,`idcopa`),
  ADD KEY `idcopa` (`idcopa`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`idjugador`),
  ADD UNIQUE KEY `alias` (`alias`,`email`),
  ADD UNIQUE KEY `ALIAS_2` (`alias`),
  ADD KEY `equipofav` (`equipofav`),
  ADD KEY `email` (`email`);

--
-- Indices de la tabla `jugador_temp`
--
ALTER TABLE `jugador_temp`
  ADD PRIMARY KEY (`alias`),
  ADD UNIQUE KEY `alias` (`alias`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `equipofav` (`equipofav`);

--
-- Indices de la tabla `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`idliga`),
  ADD UNIQUE KEY `nombreliga` (`nombreliga`);

--
-- Indices de la tabla `participa`
--
ALTER TABLE `participa`
  ADD UNIQUE KEY `idjugador` (`idjugador`,`idliga`),
  ADD KEY `idliga` (`idliga`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`idpartido`),
  ADD KEY `idlocal` (`idlocal`),
  ADD KEY `idvisitante` (`idvisitante`),
  ADD KEY `ganadorpartido` (`ganadorpartido`),
  ADD KEY `ganadorpartido_2` (`ganadorpartido`),
  ADD KEY `idcopa` (`idcopa`),
  ADD KEY `idliga` (`idliga`);

--
-- Indices de la tabla `usa`
--
ALTER TABLE `usa`
  ADD PRIMARY KEY (`idjugador`,`idequipo`,`fecha`),
  ADD KEY `idequipo` (`idequipo`),
  ADD KEY `idpartido` (`idpartido`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `copa`
--
ALTER TABLE `copa`
  MODIFY `idcopa` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequipo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `idjugador` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `liga`
--
ALTER TABLE `liga`
  MODIFY `idliga` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `idpartido` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `juega`
--
ALTER TABLE `juega`
  ADD CONSTRAINT `juega_ibfk_1` FOREIGN KEY (`idjugador`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `juega_ibfk_2` FOREIGN KEY (`idcopa`) REFERENCES `copa` (`idcopa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD CONSTRAINT `jugador_ibfk_1` FOREIGN KEY (`equipofav`) REFERENCES `equipo` (`nombreequipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugador_temp`
--
ALTER TABLE `jugador_temp`
  ADD CONSTRAINT `jugador_temp_ibfk_1` FOREIGN KEY (`equipofav`) REFERENCES `equipo` (`nombreequipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `participa`
--
ALTER TABLE `participa`
  ADD CONSTRAINT `participa_ibfk_1` FOREIGN KEY (`idjugador`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participa_ibfk_2` FOREIGN KEY (`idliga`) REFERENCES `liga` (`idliga`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partido`
--
ALTER TABLE `partido`
  ADD CONSTRAINT `partido_ibfk_1` FOREIGN KEY (`idlocal`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partido_ibfk_2` FOREIGN KEY (`idvisitante`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partido_ibfk_3` FOREIGN KEY (`ganadorpartido`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partido_ibfk_4` FOREIGN KEY (`idcopa`) REFERENCES `copa` (`idcopa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partido_ibfk_5` FOREIGN KEY (`idliga`) REFERENCES `liga` (`idliga`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usa`
--
ALTER TABLE `usa`
  ADD CONSTRAINT `usa_ibfk_1` FOREIGN KEY (`idjugador`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usa_ibfk_2` FOREIGN KEY (`idequipo`) REFERENCES `equipo` (`idequipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usa_ibfk_3` FOREIGN KEY (`idpartido`) REFERENCES `partido` (`idpartido`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
