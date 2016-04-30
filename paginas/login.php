<?php
include "cabecera2.php";
include "../conexion.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=utf-8" />
    <meta name="author" content="Ignacio Menchaca Recio" />
        
    <title>Fifa-Tournaments</title>
	<link href="../estilos/cabecera.css" rel="stylesheet" type="text/css" />
	<link href="../estilos/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class=cuerpo>
        <?php
    if( isset($_POST["iniciar"]) )  {
   $alias = $_POST["alias"];
   $clave = $_POST["clave"];
   if(validarUsuario($alias,$clave) == true){
      $_SESSION['alias']=$alias;
      header("refresh:2; url=../index.php");
      echo "<h1>Bienvenido ".$_SESSION['alias']."</h1>";
   } else {
     echo "<h1 color=white>Verifica tu nombre de usuario y contraseña</h1>";
     echo "<h1>Si todavía no estás registrado puedes hacerlo <a href='registro.php'> Aquí</a></h1>";
   }
}
else {
?>
        <form class="centrado" action="login.php" method="post"><div class=textoinicio>
                <br>Usuario:<br>
                <input type="text" name="alias" /><br />
                Clave:<br>
                <input type="password" name="clave" /><br /><br />
                <input type="submit" name="iniciar" value="Conectar" />
        </div></form>
<?php
}
function validarUsuario($a, $b)    {
   $conexion = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');
   $consulta = "select clave from jugador where alias = '$a' and clave = MD5('".$_POST['clave']."');";
   $result = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
   if(mysql_num_rows($result) == 1)  {
      $line = mysql_fetch_array($result, MYSQL_ASSOC);
         return true;
   } else
         return false;
  
}
    ?>
       
        <?php


            if(isset($_SESSION['alias'])){  
        // Conectando, seleccionando la base de datos
$link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

// Realizar una consulta MySQL
$query = 'SELECT equipo.imagenequipo FROM jugador, equipo where jugador.equipofav=equipo.nombreequipo and alias="'.$_SESSION['alias'].'"';
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());


// Imprimir los resultados en HTML
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    foreach ($line as $col_value) {
        $_SESSION['equipofav'] = $col_value;
    }
}
                
// Realizar una consulta MySQL
$query = 'SELECT archivo FROM jugador where alias="'.$_SESSION['alias'].'"';
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());


// Imprimir los resultados en HTML
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    foreach ($line as $col_value) {
        $_SESSION['avatar'] = $col_value;
    }
}
                
// Realizar una consulta MySQL
$query = 'SELECT administrador FROM jugador where alias="'.$_SESSION['alias'].'"';
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());


// Imprimir los resultados en HTML
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    foreach ($line as $col_value) {
        $_SESSION['administrador'] = $col_value;
    }
}
                
// Realizar una consulta MySQL
$query = 'SELECT idjugador FROM jugador where alias="'.$_SESSION['alias'].'"';
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());


// Imprimir los resultados en HTML
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    foreach ($line as $col_value) {
        $_SESSION['idjugador'] = $col_value;
    }
}  
            }

?>

    </div>
    
</body>
</html>
