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
        //VENGO DE CLIENTES.PHP. PETICIÓN GET
        //Compruebo que he recibido el parámetro por la query.
        if (isset($_GET['cod'])) {
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

            // Realizar una consulta MySQL. OBTENGO LOS DATOS DEL CLIENTE
            //IMPORTANTE: ESTOY BUSCANDO POR CLAVE. Si no tendría que 
            //usar mysql_num_rows
            $query = "SELECT * FROM equipo WHERE idequipo='".$_GET['cod']."';";
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
            while ($line = mysql_fetch_array($result)) {
                echo "<div class=wrapper>";
                echo "<form method='post' action='modificarequipo.php?cod=".$line['imagenequipo']."'>";
                echo "<label for='Nombre'>Nombre del equipo:</label><input class='text' name='nombreequipo' value='".$line['nombreequipo']."' required>";
                echo "<label for='Liga'>Liga:</label><input class='text' name='liga'  value='".$line['liga']."' required>";
                echo "<label for='Valoracion'>Valoración:</label><input class='text' name='valoracion' value='".$line['valoracion']."' required>";
                echo "<label for='Imagen'>Imagen del equipo:</label><input class='text' name='imagenequipo' value='".$line['imagenequipo']."' required>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idequipo' value='".$line['idequipo']."'>";
                echo "<div><input class=submit type='submit' name='enviar' value='Enviar'><div>";
                echo "</form>";
                echo "</div>";
            }
            // Liberar resultados
            mysql_free_result($result);
            // Cerrar la conexión
            mysql_close($link);
            
        }

        //VENGO DE UNA PETICION POST
        if (isset($_POST['enviar'])) {
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

            
            //CONSTRUYO LA CONSULTA DE ACTUALIZACIÓN
            $query="UPDATE equipo SET idequipo='".
                $_POST['idequipo']."',nombreequipo='".
                $_POST['nombreequipo']."',liga='".
                $_POST['liga']."',valoracion='".
                $_POST['valoracion']."',imagenequipo='".
                $_POST['imagenequipo']."' WHERE idequipo='".$_POST['idequipo']."';";
            
            
            
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
            
            if ($_SESSION['equipofav']== $_GET['cod']){
            $_SESSION['equipofav'] = $_POST['imagenequipo'];
            }
            
            // Cerrar la conexión
            mysql_close($link);
            echo "<script> location.replace('../administracion.php');</script>";         
            
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