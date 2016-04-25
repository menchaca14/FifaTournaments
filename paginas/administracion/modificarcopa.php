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
        //VENGO DE CLIENTES.PHP. PETICIÓN GET
        //Compruebo que he recibido el parámetro por la query.
        if (isset($_GET['cod'])) {
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

            // Realizar una consulta MySQL. OBTENGO LOS DATOS DEL CLIENTE
            //IMPORTANTE: ESTOY BUSCANDO POR CLAVE. Si no tendría que 
            //usar mysql_num_rows
            $query = "SELECT * FROM copa WHERE idcopa='".$_GET['cod']."';";
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
            while ($line = mysql_fetch_array($result)) {
                echo "<div class=wrapper>";
                echo "<form method='post' action='modificarcopa.php'>";
                echo "<label for='Nombre'>Nombre de la copa:</label><input class='text' name='nombrecopa' value='".$line['nombrecopa']."' required>";
                echo "<label for='fechaini'>Fecha de inicio:</label><input class='text' type='date' name='fechaini'  value='".$line['fechaini']."' required>";
                echo "<label for='fechafin'>Fecha de fin:</label><input class='text' type='date' name='fechafin' value='".$line['fechafin']."' required>";
                echo "<label for='premio'>Premio de la copa:</label><input class='text' name='premiocopa' value='".$line['premiocopa']."'>";      
                echo "<label for='ganadorcopa'>Ganador de la Copa:</label>";
                $consulta = 'SELECT alias FROM jugador order by alias';
                $result2 = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='ganadorcopa'>";
                echo "<option value=''></option>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        $equipo = $line['ganadorcopa'];
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
                echo "<input type='hidden' name='idcopa' value='".$line['idcopa']."'>";
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
            $query="UPDATE copa SET idcopa='".
                $_POST['idcopa']."',nombrecopa='".
                $_POST['nombrecopa']."',fechaini='".
                $_POST['fechaini']."',fechafin='".
                $_POST['fechafin']."',premiocopa='".
                $_POST['premiocopa']."',ganadorcopa='".
                $_POST['ganadorcopa']."' WHERE idcopa='".$_POST['idcopa']."';";
            
            
            
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