<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=utf-8" />
    <meta name="author" content="Ignacio Menchaca Recio" />
      
      
<?php if(isset($_SESSION['alias'])){
	echo "<link href='../estilos/".$_SESSION['temapref']."/cabecera.css' rel='stylesheet' type='text/css' />";
    } else { ?>
	<link href="../estilos/1/cabecera.css" rel="stylesheet" type="text/css" />
<?php } ?>
      
      
    <title>Fifa-Tournaments</title>
</head>

<body>
                                                    									  <!--LOGOS--> 
	<div id="panel_logos">
	<div id="facebook">
		<a href="http://www.facebook.es" ></a>
	</div>

	<div id="twit">
		<a href="http://www.twitter.es" ></a>
	</div>

	<div id="youtube">
		<a href="http://www.youtube.es" ></a>
	</div>
	</div>

	<div id="banner">            																			<!--BANNER-->
  		<a href="../../index.php" ><img class="izquierda" src="../../imagenes/bannerpru.jpg"/></a>
         <?php
            session_start();
            if(isset($_SESSION['alias'])){  
                    echo '<ul id="nav">';
                        echo "<li><a href='../perfil.php'>".$_SESSION['alias']."</a>";
                            echo "<ul>";
                                echo "<li><a href='../perfil.php'>Perfil</a>";
                                echo "</li>";
                                echo "<li><a href='../cerrarsesion.php'>Cerrar sesión</a>";
                                echo "</li>";
                            echo "</ul>";
                        echo "</li>";
                    echo "</ul>";
                    echo '<img class="icono" src="../../imagenes/equipos/'.$_SESSION["equipofav"].'.png">';
            } else {
               echo '<br><span id="login"><a href="../login.php">Login</a></span>';
            }
        ?>
	</div>
    <div class=indice>
        <div class=nomindice>
<a href="../../index.php" >INICIO</a>
<a href="../perfil.php" >PERFIL</a>
<a href="../ligas.php" >LIGAS</a>
<a href="../copas.php" >COPAS</a>
        <?php
            if(!isset($_SESSION['alias'])){
                echo '<a href="../registro.php" >REGISTRO</a>';
            }
            if(isset($_SESSION['administrador'])){
                if($_SESSION['administrador']=='1'){
                    echo '<a href="../administracion.php" >ADMIN</a>';
                }
            }
        ?>
        </div>
    </div>
	</body>
</html>