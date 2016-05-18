<?php
include "../../conexion.php";

session_start();
//definimos la variable html vacía, ésta será la que vaya guardando todo el código que queremos imprimir en pdf al final
$html = ' ';

if (!isset($_SESSION['alias'])){
include "../cabecera3.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=utf-8" />
    <meta name="author" content="Javier Rodriguez ,Ignacio Menchaca" />
        
    <title>Fifa-Tournaments</title>
 <?php if(isset($_SESSION['alias'])){
	echo "<link href='../../estilos/".$_SESSION['temapref']."/cabecera.css' rel='stylesheet' type='text/css' />";
    echo "<link href='../../estilos/".$_SESSION['temapref']."/administracion.css' rel='stylesheet' type='text/css' />";
    echo "<link href='../../estilos/".$_SESSION['temapref']."/perfil.css' rel='stylesheet' type='text/css' />";
    } else { ?>
	<link href="../../estilos/1/cabecera.css" rel="stylesheet" type="text/css" />
    <link href="../../estilos/1/administracion.css" rel="stylesheet" type="text/css" />
    <link href="../../estilos/1/perfil.css" rel="stylesheet" type="text/css" />
 <?php } ?>
</head>

<body>
   <div class=cuerpo>
       <h2 style='color: white; text-align:center;'>Debes ser miembro para acceder a esta sección.</h2>
    </div>
</body>
</html>

<?php 
} else {

$link = mysql_connect(SERVER, USER, PASS);
mysql_select_db(BD) or die('No se pudo seleccionar la base de datos');


//cargamos dompdf
require_once 'lib/dompdf-master/dompdf_config.inc.php';

//Ahora empezamos a almacenar en la variable $html todo lo que queremos imprimir:
    
            
    $html.="<div style='float: left; position: relative;'><table style='text-align: center;'><tr class='fondoalias'><td>".$_SESSION['alias']."</td>";
    $html.="<td><img src='../../imagenes/equipos/".$_SESSION['equipofav'].".png'></td></tr>";
    $html.="<tr><td colspan=2><a href='perfil2.php'><img width='180' height='180' src='../../imagenes/upload/".$_SESSION['avatar']."'></a></td></tr>";       
    $html.="</table></div>";
    
    
    $html.= "<div style='float: left; position: relative;'><h2>Informacion del jugador:</h2>";
    $html.= "<p>Equipo favorito: <b>".$_SESSION['equipofav']."</b></p>";

    $html.= "<p>Nombre del jugador:";
    // Realizar una consulta MySQL
    $query2 = 'select nombre from jugador where alias="'.$_SESSION['alias'].'";';
    $result2 = mysql_query($query2) or die('Consulta fallida: ' . mysql_error());

    // Imprimir los resultados en HTML
    while ($line2 = mysql_fetch_array($result2, MYSQL_ASSOC)) {
      
    foreach ($line2 as  $c2 => $m2) {
                $html.= " <b>$m2</b></p>";
    }}
       
    $html.= "<p>Apellidos:";
    // Realizar una consulta MySQL
    $query3 = 'select apellidos from jugador where alias="'.$_SESSION['alias'].'";';
    $result3 = mysql_query($query3) or die('Consulta fallida: ' . mysql_error());

    // Imprimir los resultados en HTML
    while ($line3 = mysql_fetch_array($result3, MYSQL_ASSOC)) {
      
    foreach ($line3 as  $c3 => $m3) {
                $html.= " <b>$m3</b></p>";
    }}

    $html.= "<p>Email:";
    $html.= "<b>".$_SESSION['email']."</b>";
    
//Creo variable html para cerrar capa donde he centrado todo
    $html.= "</div>";

            


// Así extraemos todo en el pdf
    $dompdf = new DOMPDF();
    $dompdf->load_html(utf8_decode($html) );
    $dompdf->render();
    $dompdf->stream($_SESSION['alias']." user.pdf");
            
            
            
 
    }