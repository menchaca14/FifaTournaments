<?php
include "cabecera2.php";
include "../conexion.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=utf-8" />
    <meta name="author" content="Ignacio Menchaca Recio" />
        
    <title>Fifa-Tournaments</title>
 <?php if(isset($_SESSION['alias'])){
	echo "<link href='../estilos/".$_SESSION['temapref']."/cabecera.css' rel='stylesheet' type='text/css' />";
    echo "<link href='../estilos/".$_SESSION['temapref']."/ligas.css' rel='stylesheet' type='text/css' />";
    } else { ?>
	<link href="../estilos/1/cabecera.css" rel="stylesheet" type="text/css" />
    <link href="../estilos/1/ligas.css" rel="stylesheet" type="text/css" />
 <?php } ?>
      
      
   
</head>

<body>
   <div class=cuerpo>
       
       <?php
    
               if (isset($_POST['crear2'])) {
             
            $link = mysql_connect(SERVER, USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db(BD) or die('No se pudo seleccionar la base de datos');

// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
$checkuno = mysql_query("SELECT nombreliga FROM liga WHERE nombreliga='".$_POST['nombreliga']."'") ;
$uno_exist = mysql_num_rows($checkuno);


if ($uno_exist>0) {
                
                echo "<p style='text-align:center; color:white;'>El nombre de la liga ya está en uso</p>";
    
                echo "<div class=wrapper>";
                echo "<form method='post' action='ligas.php'>";
                echo "<label for='nombreliga'>Nombre de la liga: </label><input class='text' name='nombreliga' value='' required>";
                echo "<label for='fecini'>Fecha de inicio:</label><input class='text' type='date' name='fecini'  value='' required>";
                echo "<label for='fecfin'>Fecha de fin:</label><input class='text' type='date' name='fecfin'  value='' required>";
                echo "<label for='premioliga'>Premio de la liga: </label><input class='text' name='premioliga' value='' required>";
                echo "<label for='jornadas'>Numero de jornadas: </label><input class='text' name='jornadas' value='' required>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idliga' value=''>";
                echo "<br><br><input class='submit' type='submit' name='crear2' value='Enviar'>";
                echo "</form>";
                echo "</div>";
}else{
            // Realizar una consulta MySQL
            $insert = "INSERT INTO liga VALUE(null".","."'".$_POST['nombreliga']."'".","."'".$_POST['fecini']."'".","."'".$_POST['fecfin']."'".","."'".$_POST['premioliga']."',"."'".$_POST['jornadas']."',"."'')";
 $result = mysql_query($insert) or die('Consulta fallida: ' . mysql_error());
            if ($result) { 
            echo "<script> location.replace('ligas.php');</script>";  
            } else {
            echo "Faltan campos por rellenar";    
            }
            
            // Cerrar la conexión
            mysql_close();
            
}
         } elseif(isset($_POST["crear"]) )  { 
    
    
                echo "<div class=wrapper>";
                echo "<form method='post' action='ligas.php'>";
                echo "<label for='nombreliga'>Nombre de la liga: </label><input class='text' name='nombreliga' value='' required>";
                echo "<label for='fecini'>Fecha de inicio:</label><input class='text' type='date' name='fecini'  value='' required>";
                echo "<label for='fecfin'>Fecha de fin:</label><input class='text' type='date' name='fecfin'  value='' required>";
                echo "<label for='premioliga'>Premio de la liga: </label><input class='text' name='premioliga' value='' required>";
                echo "<label for='jornadas'>Numero de jornadas: </label><input class='text' name='jornadas' value='' required>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idliga' value=''>";
                echo "<br><br><input class='submit' type='submit' name='crear2' value='Enviar'>";
                echo "</form>";
                echo "</div>";
    
} else {
     if(isset($_SESSION['alias'])){  
       ?>
       
                    <form action="ligas.php" class=crear method="post">
                        <input type="submit" name="crear" value="Crea tu liga" />
                    </form>
       <?php
     }
         ?>
       <div>
     <form action="ligas.php" class=formulario method="post">
                   <?php
                    $link = mysql_connect(SERVER, USER, PASS) or die('No se pudo conectar: ' . mysql_error());
                    mysql_select_db(BD) or die('No se pudo seleccionar la base de datos');
                    $query = 'select nombreliga from liga order by fecini';
                    $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                    echo "<select name='nombreliga'>";
                    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    echo "Elige la liga: <option value='".$line['nombreliga']."'";
                    if( isset($_POST["nombreliga"]) )  { 
                           if ($line['nombreliga']==$_POST["nombreliga"]) {
                           echo " selected";
                           }
                       } else {
                           if ($line['nombreliga']=='Liga primavera') {
                           echo " selected";
                           }
                       }
                    echo ">".$line['nombreliga']."";
                    echo "</option>";
                    }
                    echo "</select>";
                    // Liberar resultados
                    mysql_free_result($result);

                    // Cerrar la conexión
                    mysql_close();
                   ?>	
                    <input type="submit" value="enviar" />
		</form>
      <?php
    if( isset($_POST["nombreliga"]) )  { 
    // Conectando, seleccionando la base de datos
    $link = mysql_connect(SERVER, USER, PASS)
    or die('No se pudo conectar: ' . mysql_error());
    echo '<h2 class=ligdere1><br>Participantes de la '.$_POST['nombreliga'].":</h2>";
    mysql_select_db(BD) or die('No se pudo seleccionar la base de datos');

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
    $query12 = 'select idjugador from jugador where alias="'.$m.'";';
    $result12 = mysql_query($query12);
            
            
        echo $m."</td>";
        }
    }
    echo "\t</tr>\n";
    }
    echo "</table>\n";

    // Liberar resultados
    mysql_free_result($result);

    // Cerrar la conexión
    mysql_close();
    }

    echo "</div>";
    echo "<div class=partidos>";
$link = mysql_connect(SERVER, USER, PASS)
    or die('No se pudo conectar: ' . mysql_error());
    mysql_select_db(BD) or die('No se pudo seleccionar la base de datos');
    echo "<table class=fuentes>\n";
$query55= 'select idpartido from partido';
$result55 =  mysql_query($query55);

    echo "<h2>Ultimos partidos:</h2>";
    while ($line55 = mysql_fetch_array($result55, MYSQL_ASSOC)) {
 foreach ($line55 as $c) {
 $query = 'select liga.nombreliga, jugador.alias, partido.golesloc, partido.golesvis, 
(select alias from jugador, partido, participa, usa, liga where jugador.idjugador=partido.idvisitante and partido.idliga=participa.idliga and partido.idvisitante=participa.idjugador and  usa.idpartido=partido.idpartido and usa.idjugador=partido.idvisitante and liga.idliga=participa.idliga and partido.idpartido='.$c.') alias2 from jugador, partido, participa, usa, liga where jugador.idjugador=partido.idlocal and partido.idliga=participa.idliga and partido.idlocal=participa.idjugador and  usa.idpartido=partido.idpartido and usa.idjugador=partido.idlocal and liga.idliga=participa.idliga and partido.idpartido='.$c;
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
    $query13 = 'select idjugador from jugador where alias="'.$m.'";';
    $result13 = mysql_query($query13);
                    
        echo $mo."</td>";
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
    $query14 = 'select idjugador from jugador where alias="'.$m.'";';
    $result14 = mysql_query($query14);
            
        echo "\t\t<td style='text-align:right;'>".$mol."</a>\n";
        } else {
        echo "<img src='../imagenes/upload/$mol' height='35' width='35'/></td>";
        }
    }
    }

    // Liberar resultados
    mysql_free_result($result13);
      
    } elseif ($c=="golesloc") {
        echo "\t\t<td>$m ";
    } elseif ($c=="golesvis") {
        echo "- $m</td>\n";
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
    echo "<h2>Listado de ligas</h2>";
    $query = 'select nombreliga, fecini, premioliga from liga';
    $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

    // Imprimir los resultados en HTML
    echo "<table class=fuentes>\n";
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $m => $col_value) {
        if ($m=='premioliga') {
        echo "<td>".$col_value." €</td>";
    } elseif ($m=='nombreliga') {
            
            
    $query2 = 'select idliga from liga where nombreliga="'.$col_value.'"';
    $result2 = mysql_query($query2) or die('Consulta fallida: ' . mysql_error());
            
    while ($line2 = mysql_fetch_array($result2, MYSQL_ASSOC)) {
        
    foreach ($line2 as $m2 => $col_value2) {
        echo "<td>$col_value</td>";
        
    }
    }
        
    } else {
        echo "<td> $col_value </td>";
        }
    }
    echo "\t</tr>\n";
    }
    echo "</table>\n";

    // Liberar resultados
    mysql_free_result($result);

    // Cerrar la conexión
    mysql_close();
    echo "</div>";
    ?>


<br><br><br>
    </div>
       
       <?php
}
    
       ?></div>
</body>
</html>