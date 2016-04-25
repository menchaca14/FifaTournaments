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
    <meta name="author" content="Javier Rodriguez ,Ignacio Menchaca" />
        
    <title>Fifa-Tournaments</title>
	<link href="../estilos/cabecera.css" rel="stylesheet" type="text/css" />
    <link href="../estilos/copas.css" rel="stylesheet" type="text/css" />
</head>

<body>
   <div class=cuerpo>
       <div>
     <form action="copas.php" class=formulario method="post">
                   <?php
                    $link = mysql_connect('localhost', USER, PASS) or die('No se pudo conectar: ' . mysql_error());
                    mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');
                    $query = 'select nombrecopa from copa order by fechaini';
                    $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                    echo "<select name='nombrecopa'>";
                    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    echo "Elige la copa: <option value='".$line['nombrecopa']."'";
                    if( isset($_POST["nombrecopa"]) )  { 
                           if ($line['nombrecopa']==$_POST["nombrecopa"]) {
                           echo " selected";
                           }
                       } else {
                           if ($line['nombrecopa']=='Copa Konami') {
                           echo " selected";
                           }
                       }
                    echo ">".$line['nombrecopa']."";
                    echo "</option>";
                    }
                    echo "</select>";
                    // Liberar resultados
                    mysql_free_result($result);

                    // Cerrar la conexión
                    mysql_close($link);
                   ?>	
                    <input type="submit" value="enviar" />
		</form>
      <?php
    if( isset($_POST["nombrecopa"]) )  { 
    // Conectando, seleccionando la base de datos
    $link = mysql_connect('localhost', USER, PASS)
    or die('No se pudo conectar: ' . mysql_error());
    echo '<h2 class=copdere1><br>Participantes de la '.$_POST['nombrecopa'].":</h2>";
    mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

    // Realizar una consulta MySQL
    $query = 'select jugador.archivo, jugador.alias from jugador, juega, copa where jugador.idjugador=juega.idjugador and copa.idcopa=juega.idcopa and copa.nombrecopa="'.$_POST["nombrecopa"].'" order by jugador.alias;';
    $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

    // Imprimir los resultados en HTML
    echo "<table class=copdere2>\n";
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
    }

    echo "</div>";
    echo "<div class=partidos>";
$link = mysql_connect('localhost', USER, PASS)
    or die('No se pudo conectar: ' . mysql_error());
    mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');
    echo "<table class=fuentes>\n";
$query55= 'select idpartido from partido';
$result55 =  mysql_query($query55);

    echo "<h2>Ultimos partidos:</h2>";
    while ($line55 = mysql_fetch_array($result55, MYSQL_ASSOC)) {
 foreach ($line55 as $c) {
 $query = 'select copa.nombrecopa, jugador.alias, partido.golesloc, partido.golesvis, 
(select alias from jugador, partido, juega, usa, copa where jugador.idjugador=partido.idvisitante and partido.idcopa=juega.idcopa and partido.idvisitante=juega.idjugador and  usa.idpartido=partido.idpartido and usa.idjugador=partido.idvisitante and copa.idcopa=juega.idcopa and partido.idpartido='.$c.') alias2 from jugador, partido, juega, usa, copa where jugador.idjugador=partido.idlocal and partido.idcopa=juega.idcopa and partido.idlocal=juega.idjugador and  usa.idpartido=partido.idpartido and usa.idjugador=partido.idlocal and copa.idcopa=juega.idcopa and partido.idpartido='.$c;
    $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
    // Imprimir los resultados en HTML
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $c => $m) {
        if ($c=="alias") {
            
            
// Realizar una consulta MySQL
    $query12 = 'select jugador.archivo, jugador.alias from jugador where jugador.alias="'.$m.'"';
    $result12 = mysql_query($query12) or die('Consulta fallida: ' . mysql_error());

    // Imprimir los resultados en HTML
    while ($line12 = mysql_fetch_array($result12, MYSQL_ASSOC)) {
    foreach ($line12 as  $co => $mo) {
        if ($co=="archivo") {
        echo "\t\t<td style='text-align:left;'><img src='../imagenes/upload/$mo' height='35' width='35'/>\n";
        } else {
        echo "".$mo."</td>";
        }
    }
    }

    // Liberar resultados
    mysql_free_result($result12);
    

            
            
    }  elseif ($c=="alias2") {
            
            
                    
// Realizar una consulta MySQL
    $query13 = 'select alias, archivo from jugador where jugador.alias="'.$m.'"';
    $result13 = mysql_query($query13) or die('Consulta fallida: ' . mysql_error());

    // Imprimir los resultados en HTML
    while ($line13 = mysql_fetch_array($result13, MYSQL_ASSOC)) {
    foreach ($line13 as  $col => $mol) {
        if ($col=="alias") {
        echo "\t\t<td style='text-align:right;'>".$mol."\n";
        } else {
        echo "<img src='../imagenes/upload/$mol' height='35' width='35'/></td>";
        }
    }
    }

    // Liberar resultados
    mysql_free_result($result13);
    

            
            
    } else {
        echo "\t\t<td>$m</td>\n";
    }
    }
    echo "\t</tr>\n";
    }
 }
 }
    echo "</table>\n";

    echo "</div>";
    echo "<div>";
    echo "<h2>Listado de copas</h2>";
 $query = 'select nombrecopa, fechaini, premiocopa from copa';
    $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

    // Imprimir los resultados en HTML
    echo "<table class=fuentes>\n";
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $m => $col_value) {
        if ($m=='premiocopa') {
        echo "\t\t<td>".$col_value." €</td>\n";
    } else {
        echo "\t\t<td>$col_value </td>\n";
        }
    }
    echo "\t</tr>\n";
    }
    echo "</table>\n";

    // Liberar resultados
    mysql_free_result($result);

    // Cerrar la conexión
    mysql_close($link);
    echo "</div>";
    ?>
    </div>
</body>
</html>