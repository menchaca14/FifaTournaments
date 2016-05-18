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

	<script type="text/javascript" src="../../javascript/jquery.js"></script>

<?php if(isset($_SESSION['alias'])){
	echo "<link href='../../estilos/".$_SESSION['temapref']."/cabecera.css' rel='stylesheet' type='text/css' />";
	echo "<link href='../../estilos/".$_SESSION['temapref']."/administracion.css' rel='stylesheet' type='text/css' />";
    
//SI NO HAY SESIÓN ACTIVA, USO EL CSS POR DEFECTO
    
    } else {
    
    echo "<link href='../../estilos/1/cabecera.css' rel='stylesheet' type='text/css' />";
    echo "<link href='../../estilos/1/administracion.css' rel='stylesheet' type='text/css' />";
      
 } ?>     

</head>

<body>
    <div class=cuerpo>
        
        <?php
               if (isset($_POST['enviar'])) {
             
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
$checkuno = mysql_query("SELECT nombreequipo FROM equipo WHERE nombreequipo='".$_POST['nombreequipo']."'") ;
$uno_exist = mysql_num_rows($checkuno);

$checkdos = mysql_query("SELECT imagenequipo FROM equipo WHERE imagenequipo='".$_POST['imagenequipo']."'" ) ;
$dos_exist = mysql_num_rows($checkdos);

if ($uno_exist>0|$dos_exist>0) {
                
                echo "<p style='text-align:center; color:white;'>EL nombre del equipo o el nombre de la imagen del equipo ya están en uso</p>";
    
                echo "<div class=wrapper>";
                echo "<form method='post' action='crearequipo.php'>";
                echo "<label for='nombreequipo'>Nombre del equipo: </label><input class='text' name='nombreequipo' value='' required>";
                echo "<label for='liga'>Liga: </label><input class='text' name='liga'  value='' required>";
                echo "<label for='valoracion'>Valoracion: </label><input class='text' name='valoracion' value='' required>";
                echo "<label for='imagenequipo'>Imagen del equipo: </label><input class='text' name='imagenequipo' value='' required>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idequipo' value=''>";
                echo "<br><br><input class='submit' type='submit' name='enviar' value='Enviar'>";
                echo "</form>";
                echo "</div>";
}else{
            // Realizar una consulta MySQL
            $insert = "INSERT INTO equipo VALUE(null".","."'".$_POST['nombreequipo']."'".","."'".$_POST['liga']."'".","."'".$_POST['valoracion']."'".","."'".$_POST['imagenequipo']."')";
 $result = mysql_query($insert) or die('Consulta fallida: ' . mysql_error());
            if ($result) {
            echo "<script> location.replace('../administracion.php');</script>";  
            } else {
            echo "Faltan campos por rellenar";    
            }
            
            // Cerrar la conexión
            mysql_close($link);
            
}
         } else {
                echo "<div class=wrapper>";
                echo "<form method='post' action='crearequipo.php'>";
                echo "<label for='nombreequipo'>Nombre del equipo: </label><input class='text' name='nombreequipo' value='' required>";
                echo "<label for='liga'>Liga: </label><input class='text' name='liga'  value='' required>";
                echo "<label for='valoracion'>Valoracion: </label><input class='text' name='valoracion' value='' required>";
                echo "<label for='imagenequipo'>Imagen del equipo: </label><input class='text' name='imagenequipo' value='' required>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idequipo' value=''>";
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