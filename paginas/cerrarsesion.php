<?php
include "cabecera2.php";
?>
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=utf-8" />
    <meta name="author" content="Javier Rodriguez ,Ignacio Menchaca" />
    <link href="../estilos/cabecera.css" rel="stylesheet" type="text/css" />
    <link href="../estilos/cerrarsesion.css" rel="stylesheet" type="text/css" />
    <title>Fifa-Tournaments</title>
</head>

<body>
    <div class=cuerpo>
    <?php
    if(isset($_SESSION['alias'])){
    echo "<h2>Hasta pronto</h2>";
    session_destroy();
}    
 header("refresh:2; url=../index.php");
    ?>

    </div>
</body>
</html>