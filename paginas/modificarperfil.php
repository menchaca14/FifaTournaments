<?php
include "cabecera2.php";
include "../conexion.php";
?>
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=utf-8" />
    <meta name="author" content="Ignacio Menchaca Recio" />
        
    <title>Fifa-Tournaments</title>
	<link href="../estilos/cabecera.css" rel="stylesheet" type="text/css" />
	<link href="../estilos/administracion.css" rel="stylesheet" type="text/css" />
	<link href="../estilos/perfil.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class=cuerpo>
    
    <?php
        //Peticion GET de clientes.php
        //Compruebo que he recibido el parámetro por la query.
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

            // Realizar una consulta MySQL. OBTENGO LOS DATOS DEL CLIENTE
            //IMPORTANTE: ESTOY BUSCANDO POR CLAVE. Si no tendría que 
            //usar mysql_num_rows
            $query = "SELECT * FROM jugador WHERE alias='".$_SESSION['alias']."';";
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
            while ($line = mysql_fetch_array($result)) {
            echo "<form class='fondomodificarperfil' method='post' action='modificarperfil.php?cod=".$line['alias']."'></span>";
                echo "<br><span class=centro>Alias: <input type='text' name='alias' value='".$line['alias']."' required></span><br>";
                echo "<br><span class=centro>Nombre: <input type='text' name='nombre'  value='".$line['nombre']."' required></span><br>";
                echo "<br><span class=centro>Apellidos: <input type='text' name='apellidos' value='".$line['apellidos']."' required></span><br>";
                echo "<br><span class=centro>Fecha de Nacimiento: <input type='date' name='fecnac' value='".$line['fecnac']."' required></span><br>";
                echo "<br><span class=centro>Email: <input type='text' name='email' value='".$line['email']."' required></span><br>";
                echo "<br><span class=centro>Pais: <input type='text' name='pais' value='".$line['pais']."' required></span><br>";
                echo "<br><span class=centro>Clave: <input type='password' name='clave' required><br>";
                echo "<br><span class=centro>Cambiar equipo favorito: ";
                
                $consulta = 'SELECT nombreequipo FROM equipo order by nombreequipo';
                $result2 = mysql_query($consulta) or die('Consulta fallida: ' . mysql_error());
                echo "<select name='nombreequipo'>";
                    while ($linea = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                        $equipo = $_SESSION['equipofav'];
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
                

                //Este campos no se va a modificar, se ocultan
                echo "<input type='hidden' name='idjugador' value='".$line['idjugador']."'><br>";
                echo "<br><input class=centro type='submit' name='enviar' value='Enviar'><br><br>";
            echo "</form>";
            }
            // Liberar resultados
            mysql_free_result($result);
            // Cerrar la conexión
            mysql_close($link);
            

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
                $_POST['pais']."',clave='".MD5(
                $_POST['clave'])."',equipofav='".
                $_POST['nombreequipo']."' WHERE idjugador='".$_POST['idjugador']."';";
            
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
            
            if ($_SESSION['alias']== $_GET['cod']){
            $_SESSION['alias'] = $_POST['alias'];
            $_SESSION['equipofav'] = $_POST['nombreequipo'];
            }
            
            // Cerrar la conexión
            mysql_close($link);
            
            echo "<script> location.replace('perfil.php');</script>";
            
        }
    ?>
    </div>
</body>
</html>