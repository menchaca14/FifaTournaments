<?php
include "cabecera2.php";
include "../conexion.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=utf-8" />
    <meta name="author" content="Javier Rodriguez ,Ignacio Menchaca" />
        
    <title>Fifa-Tournaments</title>
 <?php if(isset($_SESSION['alias'])){
	echo "<link href='../estilos/".$_SESSION['temapref']."/cabecera.css' rel='stylesheet' type='text/css' />";
    echo "<link href='../estilos/".$_SESSION['temapref']."/perfil.css' rel='stylesheet' type='text/css' />";
    echo "<link href='../estilos/".$_SESSION['temapref']."/administracion.css' rel='stylesheet' type='text/css' />";
    } else { ?>
	<link href="../estilos/original/cabecera.css" rel="stylesheet" type="text/css" />
    <link href="../estilos/original/perfil.css" rel="stylesheet" type="text/css" />
    <link href="../estilos/original/administracion.css" rel="stylesheet" type="text/css" />
 <?php } ?>
</head>

<body>
    <div class=cuerpo>
        <div class=fondoavatar>
    
    <?php
            $link = mysqli_connect(SERVER, USER, PASS)or die('No se pudo conectar: ' . mysqli_error($link));
            mysqli_select_db($link, BD) or die('No se pudo seleccionar la base de datos');

            $query = "SELECT * FROM jugador WHERE alias='".$_SESSION['alias']."';";
            $result = mysqli_query($link, $query) or die('Consulta fallida: ' . mysqli_error($link));
            while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            echo "<form class='formulario' method='post' action='modificartema.php?cod=".$line['alias']."'></span>";
                
                echo "<br><span class=centro>Cambiar tema favorito: ";

                $tema = $_SESSION['temapref'];
                echo "<select name='temapref'>";
                        echo "<option value='1'";
                        if ($tema=="1") {
                            echo " selected";
                        }
                        echo ">Default</option>";
                        echo "<option value='2'";
                        if ($tema=="2") {
                            echo " selected";
                        }
                        echo ">Dos</option>";
                        echo "<option value='3'";
                        if ($tema=="3") {
                            echo " selected";
                        }
                        echo ">Tres</option>";
                echo "</select>";
                
                

                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idjugador' value='".$line['idjugador']."'><br>";
                echo "<br><input class=centro type='submit' name='enviar' value='Enviar'><br><br>";
            echo "</form>";
            }
            // Liberar resultados
            mysqli_free_result($result);
            // Cerrar la conexión
            mysqli_close($link);
            

        //VENGO DE UNA PETICION POST
        if (isset($_POST['enviar'])) {
            $link = mysqli_connect(SERVER, USER, PASS)or die('No se pudo conectar: ' . mysqli_error($link));
            mysqli_select_db($link, BD) or die('No se pudo seleccionar la base de datos');

            
            //CONSTRUYO LA CONSULTA DE ACTUALIZACIÓN
            $query="UPDATE jugador SET temapref='".
                $_POST['temapref']."' WHERE idjugador='".$_POST['idjugador']."';";
            
            $result = mysqli_query($link, $query) or die('Consulta fallida: ' . mysqli_error($link));
            
            if ($_SESSION['alias']== $_GET['cod']){
            $_SESSION['temapref'] = $_POST['temapref'];
            }
            
            // Cerrar la conexión
            mysqli_close($link);
            
            echo "<script> location.replace('perfil.php');</script>";
            
        }
    ?>
        </div>
    </div>
</body>
</html>