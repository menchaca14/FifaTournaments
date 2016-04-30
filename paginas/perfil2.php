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
	<link href="../estilos/perfil.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class=cuerpo>
    <div class=fondoavatar>
<?php
 if(isset($_SESSION['alias'])){
?>
<?php 
if( isset($_POST["subir"]) )  {
    $_FILES['archivo']['name']=$_SESSION['idjugador'].".jpg";
    $target_path = "../imagenes/upload/";
    $target_path = $target_path . basename( $_FILES['archivo']['name']); 
    if(move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) 
        { 
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');   
            $checkalias = mysql_query("SELECT alias FROM jugador WHERE alias='".$_SESSION['alias']."'") ;
            $alias_exist = mysql_num_rows($checkalias);
            if ($alias_exist>0) {
                $update = "UPDATE jugador set archivo='".$_FILES['archivo']['name']."' where alias='".$_SESSION['alias']."';";
                $result = mysql_query($update) or die('Consulta fallida: ' . mysql_error());
                if ($result) {
                    echo "<br><span style='color:green;'>Tu avatar ha sido actualizado</span>";
                     $_SESSION['avatar'] = $_FILES['archivo']['name'];
                    header("refresh:3; url=perfil.php");
                }  else {
                        echo "<br>Ha ocurrido un error en la base de datos, trate de intentarlo de nuevo.";  
                    header("refresh:3; url=perfil2.php"); 
                    }
            }else{
                    $insert = "update jugador set archivo='".$_FILES['archivo']['name']."'";
                    $result = mysql_query($insert) or die('Consulta fallida: ' . mysql_error());
                    if ($result) {
                        echo "<br><span style='color:green;'>Tu avatar ha sido actualizado</span><br>";
                    $_SESSION['avatar'] = $_FILES['archivo']['name'];
                    header("refresh:3; url=perfil.php");
                    } else {
                        echo "<br>Ha ocurrido un error en la base de datos, trate de intentarlo de nuevo."; 
                    header("refresh:3; url=perfil2.php");  
                    }
                } 
            }else{
                    echo "<br>Ha ocurrido un error, trate de intentarlo de nuevo.";
                    header("refresh:3; url=perfil2.php");
    }
               
} else {
    
   
?> 
<form enctype='multipart/form-data' action='' method='post'>
<input class=formulario name='archivo' type='file' required><br>
<input type='submit' value='subir' name='subir'>
</form>
   
<?php 
        }
}else {
        echo "<h1>Loguéate <a href='login.php'>aquí</a> para poder acceder a tu perfil.</h1>";
        echo "<h1>Si aun no tienes cuenta puedes registrarte <a href='registro.php'>aquí</a></h1>";
    
}
?>
        </div>
    </div>
</body>
</html>
