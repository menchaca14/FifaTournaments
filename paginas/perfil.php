<?php
include "cabecera2.php";
include "../conexion.php";
?>
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=utf-8" />
    <meta name="author" content="Ignacio Menchaca Recio" />
        
    <title>Fifa-Tournaments</title>
	<link href="../estilos/cabecera.css" rel="stylesheet" type="text/css" />
    <link href="../estilos/perfil.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class=cuerpo>
<?php
    
 if(isset($_SESSION['alias'])){  
echo "<div class=fondoperfil>";
echo "<table class='cuadroperfil'><tr class='fondoalias'><td>".$_SESSION['alias']."</td>";
 if(isset($_SESSION['equipofav'])){  
$link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');
$checkequipofav = mysql_query("SELECT equipofav FROM jugador WHERE alias='".$_SESSION['alias']."'" ) ;
$equipofav_exist = mysql_num_rows($checkequipofav);

if ($equipofav_exist>0) {
echo "<td><img src='../imagenes/equipos/".$_SESSION['equipofav'].".png'></td></tr>";
} else {
echo "Aún no tienes equipo favorito, elige tu equipo favorito ahora";
}
}

$link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');
$checkavatar = mysql_query("SELECT archivo FROM jugador WHERE alias='".$_SESSION['alias']."'" ) ;
$avatar_exist = mysql_num_rows($checkavatar);
if ($avatar_exist>0) {
echo "<tr><td colspan=2><a href='perfil2.php'><img width='180' height='180' src='../imagenes/upload/".$_SESSION['avatar']."'></a></td></tr>";
} else {
echo "Aún no tienes avatar, sube tu avatar <a href='perfil2.php'>aquí</a>";
}
echo "</table>";
echo "<span class='modificarperfil'>";
echo "<a href='modificarperfil.php'>Modificar perfil</a>";
echo "</span>";
echo "</div>";
} else {
    echo "<div class='fondoperfil2'>";
    echo "<br><p>Loguéate <a href='login.php'>aquí</a> para poder acceder a tu perfil.</p>";
    echo "<p>Si aun no tienes cuenta puedes registrarte <a href='registro.php'>aquí</a></p>";
    echo "</div>";
}
?>
    </div>
</body>
</html>
