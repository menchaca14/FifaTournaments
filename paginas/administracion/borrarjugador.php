<?php
include "../cabecera3.php";
include "../../conexion.php";
?>
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=utf-8" />
    <meta name="author" content="Javier Rodriguez ,Ignacio Menchaca" />
        
    <title>Fifa-Tournaments</title>
	<link href="../../estilos/cabecera.css" rel="stylesheet" type="text/css" />
	<link href="../../estilos/administracion.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../../javascript/jquery.js"></script>
</head>

<body>
    <div class=cuerpo>
    
    <?php
        //Compruebo que he recibido el parámetro por la query.
        if (isset($_GET['cod'])) {
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

            // Realizar una consulta MySQL
            $query = "DELETE FROM partido WHERE idlocal='".$_GET['cod']."';";
            $result = mysql_query($query); //or die('Consulta fallida: ' . mysql_error());
            $query = "DELETE FROM partido WHERE idvisitante='".$_GET['cod']."';";
            $result = mysql_query($query); //or die('Consulta fallida: ' . mysql_error());
            $query = "DELETE FROM usa WHERE idjugador='".$_GET['cod']."';";
            $result = mysql_query($query); //or die('Consulta fallida: ' . mysql_error());
            $query = "DELETE FROM participa WHERE idjugador='".$_GET['cod']."';";
            $result = mysql_query($query); //or die('Consulta fallida: ' . mysql_error());
            $query = "DELETE FROM juega WHERE idjugador='".$_GET['cod']."';";
            $result = mysql_query($query); //or die('Consulta fallida: ' . mysql_error());
            $query = "DELETE FROM jugador  WHERE idjugador='".$_GET['cod']."';";
            $result = mysql_query($query); //or die('Consulta fallida: ' . mysql_error());
            if ($result) {
            echo "<script> location.replace('../administracion.php');</script>";   
            } else {
            echo "Tiene dependencias";    
            }
            
            // Cerrar la conexión
            mysql_close($link);
              
        }
    ?>
    </div>
    <span class="boton-top">▲</span>

	<script lang="javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script>
	$(window).scroll(function(){
	    if ($(this).scrollTop() > 0) {
	        $('.boton-top').fadeIn();
	    } else {
	        $('.boton-top').fadeOut();
	    }
	});

	$('.boton-top').click(function(){
	    $(document.body).animate({scrollTop : 0}, 500);
	    return false;
	});
	</script>
</body>
</html>