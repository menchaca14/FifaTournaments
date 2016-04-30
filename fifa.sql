-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2015 a las 18:34:04
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `fifa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `copa`
--

CREATE TABLE IF NOT EXISTS `copa` (
`idcopa` int(4) NOT NULL,
  `nombrecopa` varchar(25) NOT NULL,
  `fechaini` date NOT NULL,
  `fechafin` date NOT NULL,
  `premiocopa` int(6) DEFAULT NULL,
  `ganadorcopa` varchar(8) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `copa`
--

INSERT INTO `copa` (`idcopa`, `nombrecopa`, `fechaini`, `fechafin`, `premiocopa`, `ganadorcopa`) VALUES
(2, 'Copa Halloween', '2014-01-01', '2016-02-01', 150, ''),
(3, 'Copa Navidad', '2015-03-01', '2015-04-01', 50, NULL),
(4, 'Copa Balon de Oro', '2014-12-01', '2014-12-31', 60, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE IF NOT EXISTS `equipo` (
`idequipo` int(4) NOT NULL,
  `nombreequipo` varchar(25) NOT NULL,
  `liga` varchar(25) NOT NULL,
  `valoracion` decimal(2,1) DEFAULT NULL,
  `imagenequipo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

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
(39, 'Real Betis', 'Adelante', '2.8', 'Real Betis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juega`
--

CREATE TABLE IF NOT EXISTS `juega` (
  `idjugador` int(4) DEFAULT NULL,
  `idcopa` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `juega`
--

INSERT INTO `juega` (`idjugador`, `idcopa`) VALUES
(2, 2),
(6, 2),
(9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE IF NOT EXISTS `jugador` (
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
  `archivo` varchar(50) NOT NULL DEFAULT 'pordefecto.jpg'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`idjugador`, `alias`, `nombre`, `apellidos`, `fecnac`, `email`, `pais`, `clave`, `equipofav`, `administrador`, `archivo`) VALUES
(2, 'klunk', 'Pablo', 'Rodriguez Gallego', '2013-10-16', 'klunk@email.com', 'Spain', '4297f44b13955235245b2497399d7a93', 'Real Madrid', 1, 'pordefecto.jpg'),
(6, 'hola', 'hola', 'hola', '2015-02-11', 'hola', 'hola', '123123', 'Borussia Dortmund', 0, 'pordefecto.jpg'),
(7, 'javier', 'rodr', 'gal', '2012-12-31', 'ja@gm.c', 'spain', '4297f44b13955235245b2497399d7a93', 'Schalke 04', 1, 'pordefecto.jpg'),
(9, 'heinther', 'javi', 'rodriguez gallego', '1991-10-30', 'heinther2@gmail.com', 'Spain', '4297f44b13955235245b2497399d7a93', 'Real Betis', 1, '9.jpg'),
(13, 'hein', 'hen', 'eh', '2015-12-31', 'he', 'Ej', '4297f44b13955235245b2497399d7a93', 'Almeria', 0, 'pordefecto.jpg'),
(14, 'hei', 'nx', 'mns', '2015-12-31', 'dwdas', '12s', '4297f44b13955235245b2497399d7a93', 'Almeria', 0, 'pordefecto.jpg'),
(15, 'awsxw', 'awsaws', 'sawsaw', '2015-12-31', 'edcede', 'wadwd', '4297f44b13955235245b2497399d7a93', 'Inter', 0, 'pordefecto.jpg'),
(16, 'heibt', 'jaows', 'mas', '2015-12-31', 'jasd', 'wds', '4297f44b13955235245b2497399d7a93', 'Fiorentina', 0, 'pordefecto.jpg'),
(17, 'awsaws', 'awsaw', 'awxaws', '2015-12-31', 'awsaws', 'awsaws', '0acf03f408f90ea0dcba786d300620db', 'Granada', 1, 'pordefecto.jpg'),
(18, 'cw3qdq', 'as2s', 'a2s2as', '2015-12-31', 'd3a', 'aw2s2a', '0acf03f408f90ea0dcba786d300620db', 'Granada', 1, 'pordefecto.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liga`
--

CREATE TABLE IF NOT EXISTS `liga` (
`idliga` int(4) NOT NULL,
  `nombreliga` varchar(25) NOT NULL,
  `fecini` date NOT NULL,
  `fecfin` date NOT NULL,
  `premioliga` int(6) DEFAULT NULL,
  `jornadas` int(2) NOT NULL,
  `aliasganador` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `liga`
--

INSERT INTO `liga` (`idliga`, `nombreliga`, `fecini`, `fecfin`, `premioliga`, `jornadas`, `aliasganador`) VALUES
(1, 'Liga Primavera', '2015-03-21', '2015-06-21', 1000, 20, ''),
(2, 'Liga Veraniega', '2015-06-22', '2015-09-22', 500, 20, ''),
(3, 'Liga Otonio', '2015-09-23', '2015-12-17', 1200, 20, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participa`
--

CREATE TABLE IF NOT EXISTS `participa` (
  `idjugador` int(4) NOT NULL,
  `idliga` int(4) NOT NULL,
  `puntos` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `participa`
--

INSERT INTO `participa` (`idjugador`, `idliga`, `puntos`) VALUES
(2, 1, 9),
(6, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE IF NOT EXISTS `partido` (
`idpartido` int(4) NOT NULL,
  `fecpartido` datetime NOT NULL,
  `idlocal` int(4) NOT NULL,
  `idvisitante` int(4) NOT NULL,
  `golesloc` int(11) DEFAULT NULL,
  `golesvis` int(11) DEFAULT NULL,
  `ganadorpartido` varchar(20) DEFAULT NULL,
  `idcopa` varchar(8) DEFAULT NULL,
  `idliga` varchar(8) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`idpartido`, `fecpartido`, `idlocal`, `idvisitante`, `golesloc`, `golesvis`, `ganadorpartido`, `idcopa`, `idliga`) VALUES
(5, '2015-03-09 00:00:00', 2, 7, 4, 0, '2', '2', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usa`
--

CREATE TABLE IF NOT EXISTS `usa` (
  `idjugador` int(4) NOT NULL DEFAULT '0',
  `idequipo` int(4) NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usa`
--

INSERT INTO `usa` (`idjugador`, `idequipo`, `fecha`) VALUES
(6, 2, '2015-03-11 00:00:00'),
(9, 2, '2015-03-25 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `copa`
--
ALTER TABLE `copa`
 ADD PRIMARY KEY (`idcopa`), ADD UNIQUE KEY `nombrecopa` (`nombrecopa`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
 ADD PRIMARY KEY (`idequipo`), ADD UNIQUE KEY `nombreequipo` (`nombreequipo`), ADD UNIQUE KEY `imagenequipo` (`imagenequipo`);

--
-- Indices de la tabla `juega`
--
ALTER TABLE `juega`
 ADD UNIQUE KEY `idjugador` (`idjugador`,`idcopa`), ADD KEY `idcopa` (`idcopa`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
 ADD PRIMARY KEY (`idjugador`), ADD UNIQUE KEY `alias` (`alias`,`email`), ADD UNIQUE KEY `ALIAS_2` (`alias`);

--
-- Indices de la tabla `liga`
--
ALTER TABLE `liga`
 ADD PRIMARY KEY (`idliga`), ADD UNIQUE KEY `nombreliga` (`nombreliga`);

--
-- Indices de la tabla `participa`
--
ALTER TABLE `participa`
 ADD UNIQUE KEY `idjugador` (`idjugador`,`idliga`), ADD KEY `idliga` (`idliga`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
 ADD PRIMARY KEY (`idpartido`);

--
-- Indices de la tabla `usa`
--
ALTER TABLE `usa`
 ADD PRIMARY KEY (`idjugador`,`idequipo`,`fecha`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `copa`
--
ALTER TABLE `copa`
MODIFY `idcopa` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
MODIFY `idequipo` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
MODIFY `idjugador` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `liga`
--
ALTER TABLE `liga`
MODIFY `idliga` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
MODIFY `idpartido` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `juega`
--
ALTER TABLE `juega`
ADD CONSTRAINT `juega_ibfk_1` FOREIGN KEY (`idjugador`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `juega_ibfk_2` FOREIGN KEY (`idcopa`) REFERENCES `copa` (`idcopa`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
