<?php



if(isset($_POST['enviar'])){
$user = $_POST['USER'];
$server = $_POST['SERVER'];
$pass = $_POST['PASS'];
$bd = $_POST['BD'];
$link = mysql_connect($server, $user, $pass); 
if (!$link) { 
    die('No se ha establecido la conexión con el servidor de base de datos : ' . mysql_error()); 
} 
$db_selected2 = mysql_query ("CREATE DATABASE IF NOT EXISTS $bd;") or die(mysql_error()); 
$db_selected = mysql_select_db($bd); 
if (!$db_selected) {
    echo 'No existe la base de datos',$db_selected,'<br/>'; 
    die (mysql_error()); 
} else {
    echo "<h2>La base de datos <b>$bd</b> ha sido importada con éxito.</h2>";
$db_selected = mysql_query ("CREATE TABLE IF NOT EXISTS `copa` (
  `idcopa` int(4) NOT NULL AUTO_INCREMENT,
  `nombrecopa` varchar(25) NOT NULL,
  `fechaini` date NOT NULL,
  `fechafin` date NOT NULL,
  `premiocopa` int(6) DEFAULT NULL,
  `ganadorcopa` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`idcopa`),
  UNIQUE KEY `nombrecopa` (`nombrecopa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;") or die(mysql_error()); 
$db_selected = mysql_query ("INSERT INTO `copa` (`idcopa`, `nombrecopa`, `fechaini`, `fechafin`, `premiocopa`, `ganadorcopa`) VALUES
(2, 'Copa Halloween', '2014-01-01', '2016-02-01', 150, ''),
(3, 'Copa Navidad', '2015-03-01', '2015-04-01', 50, ''),
(4, 'Copa Balon de Oro', '2014-12-01', '2014-12-31', 60, '');") or die(mysql_error()); 
    
$db_selected = mysql_query ("CREATE TABLE IF NOT EXISTS `equipo` (
  `idequipo` int(4) NOT NULL AUTO_INCREMENT,
  `nombreequipo` varchar(25) NOT NULL,
  `liga` varchar(25) NOT NULL,
  `valoracion` decimal(2,1) DEFAULT NULL,
  `imagenequipo` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idequipo`),
  UNIQUE KEY `nombreequipo` (`nombreequipo`),
  UNIQUE KEY `imagenequipo` (`imagenequipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;") or die(mysql_error()); 
$db_selected = mysql_query ("INSERT INTO `equipo` (`idequipo`, `nombreequipo`, `liga`, `valoracion`, `imagenequipo`) VALUES
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
(38, 'Real Betis', 'Adelante', '2.8', 'Real Betis');") or die(mysql_error()); 
    
$db_selected = mysql_query ("CREATE TABLE IF NOT EXISTS `juega` (
  `idjugador` int(4) DEFAULT NULL,
  `idcopa` int(4) DEFAULT NULL,
  UNIQUE KEY `idjugador` (`idjugador`,`idcopa`),
  KEY `idcopa` (`idcopa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die(mysql_error()); 
$db_selected = mysql_query ("INSERT INTO `juega` (`idjugador`, `idcopa`) VALUES
(19, 2),
(20, 2),
(20, 3),
(20, 4),
(21, 3),
(21, 4),
(22, 2),
(22, 3),
(23, 2),
(23, 3),
(23, 4);") or die(mysql_error()); 
    
$db_selected = mysql_query ("CREATE TABLE IF NOT EXISTS `jugador` (
  `idjugador` int(4) NOT NULL AUTO_INCREMENT,
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
  `temapref` varchar(10) NOT NULL DEFAULT 'original',
  PRIMARY KEY (`idjugador`),
  UNIQUE KEY `alias` (`alias`,`email`),
  UNIQUE KEY `ALIAS_2` (`alias`),
  KEY `equipofav` (`equipofav`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;") or die(mysql_error()); 
$db_selected = mysql_query ("INSERT INTO `jugador` (`idjugador`, `alias`, `nombre`, `apellidos`, `fecnac`, `email`, `pais`, `clave`, `equipofav`, `administrador`, `archivo`, `temapref`) VALUES
(19, 'admin', 'admin', 'admin', '2015-05-11', 'admin@email.com', 'Spain', '21232f297a57a5a743894a0e4a801fc3', 'Real Betis', 1, '19.jpg', '1'),
(20, 'klunk', 'klunk', 'klunk', '2015-12-31', 'klunk@email.com', 'Metropolis', 'fd6408fa4296a98135c24e674e5abb73', 'Werder Bremen', 0, '20.jpg', '1'),
(21, 'usuario1', 'usuario', 'uno', '2015-12-31', 'usuario1@email.com', 'Spain', '122b738600a0f74f7c331c0ef59bc34c', 'Barcelona', 0, '21.jpg', '1'),
(22, 'usuario2', 'usuario', 'dos', '2015-12-31', 'usuario2@email.com', 'Spain', '2fb6c8d2f3842a5ceaa9bf320e649ff0', 'Borussia Dortmund', 0, '22.jpg', '1'),
(23, 'usuario3', 'usuario', 'tres', '2015-12-31', 'usuario3@email.com', 'Spain', '5a54c609c08a0ab3f7f8eef1365bfda6', 'Juventus', 0, '23.jpg', '1'),
(49, 'heinther', 'hei', 'n', '2015-05-20', 'heinther@gmail.com', 'Spain', '427572e1c91dc1ae8c81248d72d85655', 'Almeria', 0, '49.jpg', '2'),
(52, 'javier', 'Javier', 'Rodriguez', '1992-08-21', 'javier21roga@gmail.com', 'Spain', '3c9c03d6008a5adf42c2a55dd4a1a9f2', 'Real Betis', 0, '52.jpg', '1'),
(54, 'ganondorfoc', 'Feder', 'Ortega Cabrera', '1992-03-30', 'fedeortegacabrera@gmail.com', 'Spain', 'beeb6de877344eb0cab91cdaa186070e', 'Sevilla', 0, 'pordefecto.jpg', '1'),
(59, 'prueba1000', 'prueba', '1991', '1992-12-31', 'prueba1000@email.com', 'Spain', 'df995f049c64984013000f6ef6446387', 'Chelsea', 0, 'pordefecto.jpg', '1'),
(60, 'prueba1001', 'prueba', '1000', '1000-12-31', 'prueba1001@email.com', 'Spain', '29be9498bdee81e54aed63230ec53b5f', 'Hamburgo', 0, 'pordefecto.jpg', '3'),
(61, 'naxo14', 'Ignacio', 'Menchaca Recio', '1992-08-03', 'menchacaignacio@gmail.com', 'Spain', 'e10adc3949ba59abbe56e057f20f883e', 'Sevilla', 1, 'pordefecto.jpg', '1');") or die(mysql_error()); 
    
$db_selected = mysql_query ("CREATE TABLE IF NOT EXISTS `jugador_temp` (
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
  `text_Activ` varchar(20) NOT NULL,
  PRIMARY KEY (`alias`),
  UNIQUE KEY `alias` (`alias`),
  UNIQUE KEY `email` (`email`),
  KEY `equipofav` (`equipofav`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die(mysql_error()); 
$db_selected = mysql_query ("INSERT INTO `jugador_temp` (`alias`, `nombre`, `apellidos`, `fecnac`, `email`, `pais`, `clave`, `equipofav`, `administrador`, `archivo`, `text_Activ`) VALUES
('admin', 'admin2', 'admin', '2015-12-31', 'admin@email.com', 'Spain', '21232f297a57a5a743894a0e4a801fc3', 'Manchester City', 1, '19.jpg', '1'),
('ganondorfoc', 'Feder', 'Ortega Cabrera', '1992-03-30', 'fedeortegacabrera@gmail.com', 'Spain', 'beeb6de877344eb0cab91cdaa186070e', 'Sevilla', 0, 'pordefecto.jpg', '6v1dL05A4EiH5UaINa09'),
('heinther', 'hei', 'nther', '2015-05-20', 'heinther@gmail.com', 'Spain', '427572e1c91dc1ae8c81248d72d85655', 'Almeria', 0, 'pordefecto.jpg', '7d839M3p3eK2I0Xorc2q'),
('javier', 'Javier', 'Rodriguez', '1992-08-21', 'javier21roga@gmail.com', 'Spain', '3c9c03d6008a5adf42c2a55dd4a1a9f2', 'Real Betis', 0, 'pordefecto.jpg', 'e806x8wWeROWu3wqu5WU'),
('klunk', 'klunk', 'klunk', '2015-12-31', 'klunk@email.com', 'Metropolis', 'fd6408fa4296a98135c24e674e5abb73', 'Werder Bremen', 0, '20.jpg', '2'),
('naxo14', 'Ignacio', 'Menchaca Recio', '1992-08-03', 'menchacaignacio@gmail.com', 'Spain', 'e10adc3949ba59abbe56e057f20f883e', 'Sevilla', 0, 'pordefecto.jpg', 'gi6O08IWici7e2BSTIuw'),
('prueba1000', 'prueba', '1992', '1992-12-31', 'prueba1992@email.com', 'Spain', 'df995f049c64984013000f6ef6446387', 'Chelsea', 0, 'pordefecto.jpg', 'prueba'),
('usuario1', 'usuario', 'uno', '2015-12-31', 'usuario1@email.com', 'Spain', '122b738600a0f74f7c331c0ef59bc34c', 'Barcelona', 0, '21.jpg', '3'),
('usuario2', 'usuario', 'dos', '2015-12-31', 'usuario2@email.com', 'Spain', '2fb6c8d2f3842a5ceaa9bf320e649ff0', 'Borussia Dortmund', 0, '22.jpg', '4'),
('usuario3', 'usuario', 'tres', '2015-12-31', 'usuario3@email.com', 'Spain', '5a54c609c08a0ab3f7f8eef1365bfda6', 'Juventus', 0, '22.jpg', '5');") or die(mysql_error()); 
    
$db_selected = mysql_query ("CREATE TABLE IF NOT EXISTS `liga` (
  `idliga` int(4) NOT NULL AUTO_INCREMENT,
  `nombreliga` varchar(25) NOT NULL,
  `fecini` date NOT NULL,
  `fecfin` date NOT NULL,
  `premioliga` int(6) DEFAULT NULL,
  `jornadas` int(2) NOT NULL,
  `aliasganador` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idliga`),
  UNIQUE KEY `nombreliga` (`nombreliga`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;") or die(mysql_error()); 
$db_selected = mysql_query ("INSERT INTO `liga` (`idliga`, `nombreliga`, `fecini`, `fecfin`, `premioliga`, `jornadas`, `aliasganador`) VALUES
(1, 'Liga Primavera', '2015-03-21', '2015-06-21', 1000, 20, ''),
(2, 'Liga Veraniega', '2015-06-22', '2015-09-22', 500, 20, ''),
(3, 'Liga Otonio', '2015-09-23', '2015-12-17', 1200, 20, '');") or die(mysql_error()); 
    
$db_selected = mysql_query ("CREATE TABLE IF NOT EXISTS `participa` (
  `idjugador` int(4) NOT NULL,
  `idliga` int(4) NOT NULL,
  `puntos` int(4) DEFAULT NULL,
  UNIQUE KEY `idjugador` (`idjugador`,`idliga`),
  KEY `idliga` (`idliga`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die(mysql_error()); 
$db_selected = mysql_query ("INSERT INTO `participa` (`idjugador`, `idliga`, `puntos`) VALUES
(19, 1, 0),
(20, 1, 7),
(20, 2, NULL),
(21, 1, 4),
(21, 2, NULL),
(21, 3, NULL),
(22, 1, 17),
(22, 2, NULL),
(22, 3, NULL),
(23, 2, NULL);") or die(mysql_error()); 
    
$db_selected = mysql_query ("CREATE TABLE IF NOT EXISTS `partido` (
  `idpartido` int(4) NOT NULL AUTO_INCREMENT,
  `fecpartido` datetime NOT NULL,
  `idlocal` int(4) NOT NULL,
  `idvisitante` int(4) NOT NULL,
  `golesloc` int(11) DEFAULT NULL,
  `golesvis` int(11) DEFAULT NULL,
  `ganadorpartido` int(4) DEFAULT NULL,
  `idcopa` int(4) DEFAULT NULL,
  `idliga` int(4) DEFAULT NULL,
  PRIMARY KEY (`idpartido`),
  KEY `idlocal` (`idlocal`),
  KEY `idvisitante` (`idvisitante`),
  KEY `ganadorpartido` (`ganadorpartido`),
  KEY `ganadorpartido_2` (`ganadorpartido`),
  KEY `idcopa` (`idcopa`),
  KEY `idliga` (`idliga`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;") or die(mysql_error()); 
$db_selected = mysql_query ("INSERT INTO `partido` (`idpartido`, `fecpartido`, `idlocal`, `idvisitante`, `golesloc`, `golesvis`, `ganadorpartido`, `idcopa`, `idliga`) VALUES
(11, '2015-03-05 00:00:00', 22, 20, 2, 3, 20, NULL, 1),
(13, '2015-03-07 00:00:00', 22, 21, 2, 3, 21, NULL, 1),
(41, '2014-02-02 10:10:00', 19, 20, 6, 5, 20, 2, NULL),
(42, '2015-02-12 14:05:00', 21, 22, 3, 4, 22, NULL, 1),
(43, '2015-02-12 12:12:00', 22, 23, 1, 3, 23, 2, NULL);") or die(mysql_error()); 
    
$db_selected = mysql_query ("CREATE TABLE IF NOT EXISTS `usa` (
  `idjugador` int(4) NOT NULL DEFAULT '0',
  `idequipo` int(4) NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL,
  `idpartido` int(4) NOT NULL,
  PRIMARY KEY (`idjugador`,`idequipo`,`fecha`),
  KEY `idequipo` (`idequipo`),
  KEY `idpartido` (`idpartido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die(mysql_error()); 
$db_selected = mysql_query ("INSERT INTO `usa` (`idjugador`, `idequipo`, `fecha`, `idpartido`) VALUES
(20, 1, '2015-03-05 00:00:00', 11),
(22, 8, '2015-03-05 00:00:00', 11),
(21, 19, '2015-03-07 00:00:00', 13),
(22, 18, '2015-03-07 00:00:00', 13),
(19, 1, '0000-00-00 00:00:00', 41),
(20, 2, '0000-00-00 00:00:00', 41),
(21, 2, '0000-00-00 00:00:00', 42),
(22, 4, '0000-00-00 00:00:00', 42),
(22, 5, '0000-00-00 00:00:00', 43),
(23, 10, '0000-00-00 00:00:00', 43);") or die(mysql_error()); 
    
$db_selected = mysql_query ("ALTER TABLE `juega`
  ADD CONSTRAINT `juega_ibfk_1` FOREIGN KEY (`idjugador`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `juega_ibfk_2` FOREIGN KEY (`idcopa`) REFERENCES `copa` (`idcopa`) ON DELETE CASCADE ON UPDATE CASCADE;") or die(mysql_error()); 
    
$db_selected = mysql_query ("ALTER TABLE `jugador`
  ADD CONSTRAINT `jugador_ibfk_1` FOREIGN KEY (`equipofav`) REFERENCES `equipo` (`nombreequipo`) ON DELETE CASCADE ON UPDATE CASCADE;") or die(mysql_error()); 
    
$db_selected = mysql_query ("ALTER TABLE `jugador_temp`
  ADD CONSTRAINT `jugador_temp_ibfk_1` FOREIGN KEY (`equipofav`) REFERENCES `equipo` (`nombreequipo`) ON DELETE CASCADE ON UPDATE CASCADE;") or die(mysql_error()); 
    
$db_selected = mysql_query ("ALTER TABLE `participa`
  ADD CONSTRAINT `participa_ibfk_1` FOREIGN KEY (`idjugador`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participa_ibfk_2` FOREIGN KEY (`idliga`) REFERENCES `liga` (`idliga`) ON DELETE CASCADE ON UPDATE CASCADE;") or die(mysql_error());
    
$db_selected = mysql_query ("ALTER TABLE `partido`
  ADD CONSTRAINT `partido_ibfk_1` FOREIGN KEY (`idlocal`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partido_ibfk_2` FOREIGN KEY (`idvisitante`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partido_ibfk_3` FOREIGN KEY (`ganadorpartido`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partido_ibfk_4` FOREIGN KEY (`idcopa`) REFERENCES `copa` (`idcopa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partido_ibfk_5` FOREIGN KEY (`idliga`) REFERENCES `liga` (`idliga`) ON DELETE CASCADE ON UPDATE CASCADE;") or die(mysql_error());
     
$db_selected = mysql_query ("ALTER TABLE `usa`
  ADD CONSTRAINT `usa_ibfk_1` FOREIGN KEY (`idjugador`) REFERENCES `jugador` (`idjugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usa_ibfk_2` FOREIGN KEY (`idequipo`) REFERENCES `equipo` (`idequipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usa_ibfk_3` FOREIGN KEY (`idpartido`) REFERENCES `partido` (`idpartido`) ON DELETE CASCADE ON UPDATE CASCADE;") or die(mysql_error());
}
// Con el comando fopen vamos a crear un archivo llamado conexion.php que contendrá los datos de la conexión que hemos rellenado en el formulario.
$fp = fopen("conexion.php", "w");
fputs($fp, '<?php
define("SERVER", "'.$_POST['SERVER'].'");
define("USER", "'.$_POST['USER'].'");
define("PASS", "'.$_POST['PASS'].'");
define("BD", "'.$_POST['BD'].'");
?>');
fclose($fp);
//Borrar fichero una vez terminada la instalacion
unlink('instalador.php');
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ES">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="author" content="Javier Rodriguez" />
    <title>Fifa-Tournaments</title>
	<link href="./estilos/1/cabecera.css" rel="stylesheet" type="text/css" />
    <link href="./estilos/1/registro.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="../javascript/jquery.js"></script>
</head>
<body>
    <div class=cuerpo style="padding-bottom: 0px; margin-bottom: 30px;">
            <h1 style="text-align:center;">Bienvenidos al instalador de FifaTournaments</h1>
	<div class="wrapper">
		<div class="section">
<form id="form1" action="instalador.php" method="post">
            <label for="nombre">Usuario:</label>
      	    <input class="text" name="USER" value="" maxlength="25" size="30" />

            <label for="apellidos">Contraseña:</label>
            <input class="text" name="PASS" value="" type="password" maxlength="25" size="30" />
    
            <label for="apellidos">Servidor:</label>
            <input class="text" name="SERVER" value="" maxlength="25" size="30" />
    
            <label for="apellidos">Base de datos:</label>
            <input class="text" name="BD" value="" maxlength="25" size="30" />

            <input name="enviar" type="submit" value="Instalar" />
</form>
		</div>
	</div>
	<script type="text/javascript" src="../javascript/jquery.js"></script> 
	<script type="text/javascript" src="../javascript/formulario.js"></script>
</div>
</body>
</html>
<?php
}
?>