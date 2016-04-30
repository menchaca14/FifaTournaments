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
$checkuser = mysql_query("SELECT alias FROM jugador WHERE alias='".$_POST['alias']."'") ;
$username_exist = mysql_num_rows($checkuser);

$checkemail = mysql_query("SELECT email FROM jugador WHERE email='".$_POST['email']."'" ) ;
$email_exist = mysql_num_rows($checkemail);

if ($email_exist>0|$username_exist>0) {
                
                echo "<p style='text-align:center; color:white;'>EL nombre de usuario o la cuenta de correo ya están en uso</p>";
    
                echo "<div class=wrapper>";
                echo "<form method='post' action='crearjugador.php'>";
                echo "<label for='Alias'>Alias: </label><input class='text' name='alias' value='' required>";
                echo "<label for='Nombre'>Nombre: </label><input class='text' name='nombre'  value='' required>";
                echo "<label for='Apellidos'>Apellidos: </label><input class='text' name='apellidos' value='' required>";
                echo "<label for='fecnac'>Fecha de Nacimiento: </label><input class='text' type='date' name='fecnac' value='' required>";
                echo "<label for='Email'>Email: </label><input class='text' name='email' value='' required>";
                echo "<label for='Pais'>Pais: </label><input class='text' name='pais' value='' required>";
                echo "<label for='clave1'>Clave: </label><input class='text' type='password' name='clave1' value='' required>";
                echo "<label for='favorito'>Equipo favorito: </label>";
                
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

                $consulta = 'SELECT nombreequipo FROM equipo order by nombreequipo';
                $result2 = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='nombreequipo'>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        echo "Elige tu equipo favorito: <option value='".$linea['nombreequipo']."'>".$linea['nombreequipo']."</option>";
                    }
                echo "</select>";

                // Liberar resultados
                mysql_free_result($result2);
                

                echo "<br><br><label for='Administrador'>Administrador:</label>";
                echo "<select name='administrador'>";
                echo "<option value='0'>0</option>";
                echo "<option value='1'>1</option>";
                echo "</select>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idjugador' value=''>";
                echo "<br><br><input class='submit' type='submit' name='enviar' value='Enviar'>";
                echo "</form>";
                echo "</div>";
}else{
            // Realizar una consulta MySQL
            $insert = "INSERT INTO JUGADOR VALUE(null".","."'".$_POST['alias']."'".","."'".$_POST['nombre']."'".","."'".$_POST['apellidos']."'".","."'".$_POST['fecnac']."'".","."'".$_POST['email']."'".","."'".$_POST['pais']."'".",MD5("."'".$_POST['clave1']."'"."),"."'".$_POST['nombreequipo']."'".","."'".$_POST['administrador']."'".",'pordefecto.jpg')";
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
                echo "<form method='post' action='crearjugador.php'>";
                echo "<label for='Alias'>Alias: </label><input class='text' name='alias' value='' required>";
                echo "<label for='Nombre'>Nombre: </label><input class='text' name='nombre'  value='' required>";
                echo "<label for='Apellidos'>Apellidos: </label><input class='text' name='apellidos' value='' required>";
                echo "<label for='fecnac'>Fecha de Nacimiento: </label><input class='text' type='date' name='fecnac' value='' required>";
                echo "<label for='Email'>Email: </label><input class='text' name='email' value='' required>";
                echo "<label for='Pais'>Pais: </label><input class='text' name='pais' value='' required>";
                echo "<label for='clave1'>Clave: </label><input class='text' type='password' name='clave1' value='' required>";
                echo "<label for='favorito'>Equipo favorito: </label>";
                
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

                $consulta = 'SELECT nombreequipo FROM equipo order by nombreequipo';
                $result2 = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='nombreequipo'>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        echo "Elige tu equipo favorito: <option value='".$linea['nombreequipo']."'>".$linea['nombreequipo']."</option>";
                    }
                echo "</select>";

                // Liberar resultados
                mysql_free_result($result2);
                

                echo "<br><br><label for='Administrador'>Administrador:</label>";
                echo "<select name='administrador'>";
                echo "<option value='0'>0</option>";
                echo "<option value='1'>1</option>";
                echo "</select>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idjugador' value=''>";
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