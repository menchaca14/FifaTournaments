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
    <meta name="author" content="Ignacio Menchaca Recio" />
        
    <title>Fifa-Tournaments</title>
	<link href="../../estilos/cabecera.css" rel="stylesheet" type="text/css" />
	<link href="../../estilos/administracion.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../../javascript/jquery.js"></script>
</head>

<body>
    <div class=cuerpo>
        
        <?php
               if (isset($_POST['enviar'])) {
             
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
$checkuno = mysql_query("SELECT nombreliga FROM liga WHERE nombreliga='".$_POST['nombreliga']."'") ;
$uno_exist = mysql_num_rows($checkuno);


if ($uno_exist>0) {
                
                echo "<p style='text-align:center; color:white;'>El nombre de la copa ya está en uso</p>";
    
                echo "<div class=wrapper>";
                echo "<form method='post' action='crearliga.php'>";
                echo "<label for='nombreliga'>Nombre de la liga: </label><input class='text' name='nombreliga' value='' required>";
                echo "<label for='fecini'>Fecha de inicio:</label><input class='text' type='date' name='fecini'  value='' required>";
                echo "<label for='fecfin'>Fecha de fin:</label><input class='text' type='date' name='fecfin'  value='' required>";
                echo "<label for='premioliga'>Premio de la liga: </label><input class='text' name='premioliga' value='' required>";
                echo "<label for='jornadas'>Numero de jornadas: </label><input class='text' name='jornadas' value='' required>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idliga' value=''>";
                echo "<br><br><input class='submit' type='submit' name='enviar' value='Enviar'>";
                echo "</form>";
                echo "</div>";
}else{
            // Realizar una consulta MySQL
            $insert = "INSERT INTO liga VALUE(null".","."'".$_POST['nombreliga']."'".","."'".$_POST['fecini']."'".","."'".$_POST['fecfin']."'".","."'".$_POST['premioliga']."',"."'".$_POST['jornadas']."',"."'')";
 $result = mysql_query($insert) or die('Consulta fallida: ' . mysql_error());
            if ($result) { 
            } else {
            echo "Faltan campos por rellenar";    
            }
            
            // Cerrar la conexión
            mysql_close($link);
            
}
         } else {
                echo "<div class=wrapper>";
                echo "<form method='post' action='crearliga.php'>";
                echo "<label for='nombreliga'>Nombre de la liga: </label><input class='text' name='nombreliga' value='' required>";
                echo "<label for='fecini'>Fecha de inicio:</label><input class='text' type='date' name='fecini'  value='' required>";
                echo "<label for='fecfin'>Fecha de fin:</label><input class='text' type='date' name='fecfin'  value='' required>";
                echo "<label for='premioliga'>Premio de la liga: </label><input class='text' name='premioliga' value='' required>";
                echo "<label for='jornadas'>Numero de jornadas: </label><input class='text' name='jornadas' value='' required>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idliga' value=''>";
                echo "<br><br><input class='submit' type='submit' name='enviar' value='Enviar'>";
                echo "</form>";
                echo "</div>";
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