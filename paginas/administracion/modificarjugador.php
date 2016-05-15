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
            $query = "SELECT * FROM jugador WHERE idjugador='".$_GET['cod']."';";
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
            while ($line = mysql_fetch_array($result)) {
                echo "<div class=wrapper>";
                echo "<form method='post' action='modificarjugador.php?cod=".$line['alias']."'>";
                echo "<label for='Alias'>Alias:</label><input class='text' name='alias' value='".$line['alias']."' required>";
                echo "<label for='Nombre'>Nombre:</label><input class='text' name='nombre'  value='".$line['nombre']."' required>";
                echo "<label for='Apellidos'>Apellidos:</label><input class='text' name='apellidos' value='".$line['apellidos']."' required>";
                echo "<label for='Fecha'>Fecha de Nacimiento:</label><input class='text' type='date' name='fecnac' value='".$line['fecnac']."' required>";
                echo "<label for='Email'>Email:</label><input class='text' name='email' value='".$line['email']."' required>";
                echo "<label for='Pais'>Pais:</label><input class='text' name='pais' value='".$line['pais']."' required>";
                echo "<label for='Avatar'>Avatar:</label><input class='text' name='archivo' value='".$line['archivo']."' required>";
                echo "<label for='favorito'>Cambiar equipo favorito:</label>";
                
                $consulta = 'SELECT nombreequipo FROM equipo order by nombreequipo';
                $result2 = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='nombreequipo'>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        $equipo = $line['equipofav'];
                        echo "Elige tu equipo favorito: <option value='".$linea['nombreequipo']."'";
                        if ($equipo==$linea['nombreequipo']) {
                            echo " selected";
                        }
                        echo ">".$linea['nombreequipo']."";
                    echo "</option>";
                    }
                echo "</select>";

                // Liberar resultados
                mysql_free_result($result2);
                

                echo "<br><br><label for='Administrador'>Administrador:</label>";
                echo "<select name='administrador'>";
                echo "<option value='0'";
                if (0==$line['administrador']) {
                            echo " selected";
                        }
                echo ">0</option>";
                echo "<option value='1'";
                if (1==$line['administrador']) {
                            echo " selected";
                        }
                echo ">1</option>";
                echo "</select>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idjugador' value='".$line['idjugador']."'>";
                echo "<br><br><input class='submit' type='submit' name='enviar' value='Enviar'>";
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
            $query="UPDATE jugador SET idjugador='".
                $_POST['idjugador']."',alias='".
                $_POST['alias']."',nombre='".
                $_POST['nombre']."',apellidos='".
                $_POST['apellidos']."',fecnac='".
                $_POST['fecnac']."',email='".
                $_POST['email']."',pais='".
                $_POST['pais']."',equipofav='".
                $_POST['nombreequipo']."',administrador='".
                $_POST['administrador']."',archivo='".
                $_POST['archivo']."' WHERE idjugador='".$_POST['idjugador']."';";
            
            
            
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
            
            if ($_SESSION['alias']== $_GET['cod']){
            $_SESSION['alias'] = $_POST['alias'];
            $_SESSION['equipofav'] = $_POST['nombreequipo'];
            $_SESSION['avatar'] = $_POST['archivo'];
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