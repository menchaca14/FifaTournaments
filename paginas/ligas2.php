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
    <link href="../estilos/ligas.css" rel="stylesheet" type="text/css" />
</head>

<body>
   <div class=cuerpo>
       
        <?php
               if (isset($_POST['enviar'])) {
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');
            // Realizar una consulta MySQL
            $insert = "INSERT INTO participa VALUE('".$_POST['idjugador']."'".","."'".$_POST['idliga']."'".",NULL)";
 $result = mysql_query($insert) or die('Consulta fallida: ' . mysql_error());
            if ($result) {  
            echo "<script> location.replace('ligas.php');</script>";  
            } else {
            echo "Faltan campos por rellenar";    
            }
            
            // Cerrar la conexión
            mysql_close($link);
            
} else {
      if (isset($_GET['cod'])) {
                
    // Conectando, seleccionando la base de datos
    $link = mysql_connect('localhost', USER, PASS)
    or die('No se pudo conectar: ' . mysql_error());
    echo '<h2 class=ligdere1><br>Participantes de la '.$_POST['nombreliga'].":</h2>";
    mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

    // Realizar una consulta MySQL
    $query = 'select jugador.archivo, jugador.alias from jugador, participa, liga where jugador.idjugador=participa.idjugador and liga.idliga=participa.idliga and liga.nombreliga="'.$_POST["nombreliga"].'" order by jugador.alias;';
    $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

    // Imprimir los resultados en HTML
    echo "<table class=ligdere2>\n";
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as  $c => $m) {
        if ($c=="archivo") {
        echo "\t\t<td><img src='../imagenes/upload/$m' height='35' width='35'/>\n";
        } else {
        echo "".$m."</td>";
        }
    }
    echo "\t</tr>\n";
    }
    echo "</table>\n";

    // Liberar resultados
    mysql_free_result($result);

    // Cerrar la conexión
    mysql_close($link);
          
                echo "<h2>Datos de la liga</h2>";
                echo "<form method='post' action='ligas2.php'>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idjugador' value='".$_SESSION['idjugador']."'>";
                echo "<input type='hidden' name='idliga' value='".$_GET['cod']."'>";
                echo "<div><input class=submit type='submit' name='enviar' value='Enviar'><div>";
                echo "</form>";
                echo "</div>";
}
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
    </div>
</body>
</html>