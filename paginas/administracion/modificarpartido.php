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
            $query = "SELECT * FROM partido WHERE idpartido='".$_GET['cod']."';";
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
            while ($line = mysql_fetch_array($result)) {
                echo "<div class=wrapper>";
                echo "<form method='post' action='modificarpartido.php'>";
                echo "<label for='fecpartido'>Fecha del partido:</label><input class='text' name='fecpartido' value='".$line['fecpartido']."'>";
                echo "<label for='idlocal'>Id Local:</label>";
                $consulta = 'SELECT idjugador FROM jugador order by idjugador';
                $result2 = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='idlocal'>";
                echo "<option value=''></option>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        $idlocal = $line['idlocal'];
                        echo "<option value='".$linea['idjugador']."'";
                        if ($idlocal==$linea['idjugador']) {
                            echo " selected";
                        }
                        echo ">".$linea['idjugador']."";
                    echo "</option>";
                    }
                echo "</select><br><br>";
                // Liberar resultados
                mysql_free_result($result2);
                echo "<label for='idvisitante'>Id Visitante:</label>";
                $result2 = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='idvisitante'>";
                echo "<option value=''></option>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        $idlocal = $line['idvisitante'];
                        echo "<option value='".$linea['idjugador']."'";
                        if ($idlocal==$linea['idjugador']) {
                            echo " selected";
                        }
                        echo ">".$linea['idjugador']."";
                    echo "</option>";
                    }
                echo "</select><br><br>";
                // Liberar resultados
                mysql_free_result($result2);
                echo "<label for='golesloc'>Goles Locales:</label><input class='text' name='golesloc' value='".$line['golesloc']."'>";
                echo "<label for='golesvis'>Goles Visitantes:</label><input class='text' name='golesvis' value='".$line['golesvis']."'>";
                echo "<label for='ganadorpartido'>Ganador del partido:</label><input class='text' name='ganadorpartido' value='".$line['ganadorpartido']."'>";
                echo "<label for='idcopa'>Id de la copa:</label>";
                $consulta2 = 'SELECT idcopa FROM copa order by idcopa';
                $result2 = mysql_query($consulta2) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='idcopa'>";
                echo "<option value=''></option>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        $idlocal = $line['idcopa'];
                        echo "<option value='".$linea['idcopa']."'";
                        if ($idlocal==$linea['idcopa']) {
                            echo " selected";
                        }
                        echo ">".$linea['idcopa']."";
                    echo "</option>";
                    }
                echo "</select><br><br>";
                // Liberar resultados
                mysql_free_result($result2);
                echo "<label for='idliga'>Id de la liga:</label>";
                $consulta3 = 'SELECT idliga FROM liga order by idliga';
                $result2 = mysql_query($consulta3) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='idliga'>";
                echo "<option value=''></option>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        $idlocal = $line['idliga'];
                        echo "<option value='".$linea['idliga']."'";
                        if ($idlocal==$linea['idliga']) {
                            echo " selected";
                        }
                        echo ">".$linea['idliga']."";
                    echo "</option>";
                    }
                echo "</select><br><br>";
                // Liberar resultados
                mysql_free_result($result2);
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idpartido' value='".$line['idpartido']."'>";
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
            $query="UPDATE partido SET idpartido='".
                $_POST['idpartido']."',fecpartido='".
                $_POST['fecpartido']."',idlocal='".
                $_POST['idlocal']."',idvisitante='".
                $_POST['idvisitante']."',golesloc='".
                $_POST['golesloc']."',golesvis='".
                $_POST['golesvis']."',ganadorpartido='".
                $_POST['ganadorpartido']."',idcopa='".
                $_POST['idcopa']."' ,idliga='".
                $_POST['idliga']."' WHERE idpartido='".$_POST['idpartido']."';";
            
            
            
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
            
      
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