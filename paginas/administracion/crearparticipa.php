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
            // Realizar una consulta MySQL
            $insert = "INSERT INTO participa VALUE('".$_POST['idjugador']."'".","."'".$_POST['idliga']."'".","."'".$_POST['puntos']."')";
 $result = mysql_query($insert) or die('Consulta fallida: ' . mysql_error());
            if ($result) {  
            echo "<script> location.replace('../administracion.php');</script>";  
            } else {
            echo "Faltan campos por rellenar";    
            }
            
            // Cerrar la conexión
            mysql_close($link);
            
} else {
                echo "<div class=wrapper>";
                echo "<form method='post' action='crearparticipa.php'>";
                echo "<label for='idjugador'>Id del jugador:</label>";
                $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
                mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');
                $consulta = 'SELECT idjugador FROM jugador order by idjugador';
                $result2 = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='idjugador'>";
                echo "<option value=''></option>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        echo "<option value='".$linea['idjugador']."'>".$linea['idjugador']."</option>";
                    }
                echo "</select><br><br>";
                // Liberar resultados
                mysql_free_result($result2);
                $consulta = 'SELECT idliga FROM liga order by idliga';
                $result2 = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
                echo "<label for='idliga'>Id de la liga:</label>";
                $result2 = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='idliga'>";
                echo "<option value=''></option>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        echo "<option value='".$linea['idliga']."'>".$linea['idliga']."</option>";
                    }
                echo "</select><br><br>";
                // Liberar resultados
                mysql_free_result($result2);

                echo "<label for='puntos'>Puntos:</label><input class='text' name='puntos' value=''>";


                echo "<div><input class=submit type='submit' name='enviar' value='Enviar'><div>";
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