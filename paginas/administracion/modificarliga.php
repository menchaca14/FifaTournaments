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
            $query = "SELECT * FROM liga WHERE idliga='".$_GET['cod']."';";
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
            while ($line = mysql_fetch_array($result)) {
                echo "<div class=wrapper>";
                echo "<form method='post' action='modificarliga.php'>";
                echo "<label for='Nombre'>Nombre de la liga:</label><input class='text' name='nombreliga' value='".$line['nombreliga']."' required>";
                echo "<label for='fecini'>Fecha de inicio:</label><input class='text' type='date' name='fecini'  value='".$line['fecini']."' required>";
                echo "<label for='fecfin'>Fecha de fin:</label><input class='text' type='date' name='fecfin' value='".$line['fecfin']."' required>";
                echo "<label for='premioliga'>Premio de la liga:</label><input class='text' name='premioliga' value='".$line['premioliga']."'>";
                echo "<label for='jornadas'>Numero de jornadas:</label><input class='text' name='jornadas' value='".$line['jornadas']."'>";
                echo "<label for='aliasganador'>Ganador de la liga:</label>";
                $consulta = 'SELECT alias FROM jugador order by alias';
                $result2 = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='aliasganador'>";
                echo "<option value=''></option>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        $equipo = $line['aliasganador'];
                        echo "<option value='".$linea['alias']."'";
                        if ($equipo==$linea['alias']) {
                            echo " selected";
                        }
                        echo ">".$linea['alias']."";
                    echo "</option>";
                    }
                echo "</select>";

                // Liberar resultados
                mysql_free_result($result2);
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idliga' value='".$line['idliga']."'>";
                echo "<br><br><div><input class=submit type='submit' name='enviar' value='Enviar'><div>";
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
            $query="UPDATE liga SET idliga='".
                $_POST['idliga']."',nombreliga='".
                $_POST['nombreliga']."',fecini='".
                $_POST['fecini']."',fecfin='".
                $_POST['fecfin']."',premioliga='".
                $_POST['premioliga']."',jornadas='".
                $_POST['jornadas']."',aliasganador='".
                $_POST['aliasganador']."' WHERE idliga='".$_POST['idliga']."';";
            
            
            
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