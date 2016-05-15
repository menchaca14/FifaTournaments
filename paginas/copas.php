<?php
include "cabecera2.php";
include "../conexion.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=utf-8" />
    <meta name="author" content="Ignacio Menchaca" />
        
    <title>Fifa-Tournaments</title>
      
 <?php if(isset($_SESSION['alias'])){
	echo "<link href='../estilos/".$_SESSION['temapref']."/cabecera.css' rel='stylesheet' type='text/css' />";
    echo "<link href='../estilos/".$_SESSION['temapref']."/copas.css' rel='stylesheet' type='text/css' />";
    } else { ?>
	<link href="../estilos/1/cabecera.css" rel="stylesheet" type="text/css" />
    <link href="../estilos/1/copas.css" rel="stylesheet" type="text/css" />
 <?php } ?>
      
      
</head>

<body>
   <div class=cuerpo>
       
       <?php
    
               if (isset($_POST['crear2'])) {
             
            $link = mysqli_connect(SERVER, USER, PASS)or die('No se pudo conectar: ' . mysqli_error($link));
            mysqli_select_db($link, BD) or die('No se pudo seleccionar la base de datos');

// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
$checkuno = mysqli_query($link, "SELECT nombrecopa FROM copa WHERE nombrecopa='".$_POST['nombrecopa']."'") ;
$uno_exist = mysqli_num_rows($checkuno);


if ($uno_exist>0) {
                
                echo "<p style='text-align:center; color:white;'>El nombre de la copa ya está en uso</p>";
    
                echo "<div class=wrapper>";
                echo "<form method='post' action='copas.php'>";
                echo "<label for='nombrecopa'>Nombre de la copa: </label><input class='text' name='nombrecopa' value='' required>";
                echo "<label for='fechaini'>Fecha de inicio:</label><input class='text' type='date' name='fechaini'  value='' required>";
                echo "<label for='fechafin'>Fecha de fin:</label><input class='text' type='date' name='fechafin'  value='' required>";
                echo "<label for='premiocopa'>Premio de la copa: </label><input class='text' name='premiocopa' value='' required>";
                //Este campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idcopa' value=''>";
                echo "<br><br><input class='submit' type='submit' name='crear2' value='Enviar'>";
                echo "</form>";
                echo "</div>";
}else{
            // Realizar una consulta MySQL
            $insert = "INSERT INTO copa VALUE(null".","."'".$_POST['nombrecopa']."'".","."'".$_POST['fechaini']."'".","."'".$_POST['fechafin']."'".","."'".$_POST['premiocopa']."',"."'')";
 $result = mysqli_query($link, $insert) or die('Consulta fallida: ' . mysqli_error($link));
            if ($result) {
            echo "<script> location.replace('copas.php');</script>";  
            } else {
            echo "Faltan campos por rellenar";    
            }
            
            // Cerrar la conexión
            mysqli_close($link);
            
}
         } elseif(isset($_POST["crear"]) )  { 
    
    
                echo "<div class=wrapper>";
                echo "<form method='post' action='copas.php'>";
                echo "<label for='nombrecopa'>Nombre de la copa: </label><input class='text' name='nombrecopa' value='' required>";
                echo "<label for='fechaini'>Fecha de inicio:</label><input class='text' type='date' name='fechaini'  value='' required>";
                echo "<label for='fechafin'>Fecha de fin:</label><input class='text' type='date' name='fechafin'  value='' required>";
                echo "<label for='premiocopa'>Premio de la copa: </label><input class='text' name='premiocopa' value='' required>";
                //Estos campos no se va a modificar, lo muestro oculto
                echo "<input type='hidden' name='idcopa' value=''>";
                echo "<br><br><input class='submit' type='submit' name='crear2' value='Enviar'>";
                echo "</form>";
                echo "</div>";
    
} else {
    
     if(isset($_SESSION['alias'])){ 
       ?>
       
                    <form action="copas.php" class=crear method="post">
                        <input type="submit" name="crear" value="Crea tu copa" />
                    </form>
              <?php
     }
         ?>
       <div>
     <form action="copas.php" class=formulario method="post">
                   <?php
                    $link = mysqli_connect(SERVER, USER, PASS) or die('No se pudo conectar: ' . mysqli_error($link));
                    mysqli_select_db($link, BD) or die('No se pudo seleccionar la base de datos');
                    $query = 'select nombrecopa from copa order by idcopa';
                    $result = mysqli_query($link, $query) or die('Consulta fallida: ' . mysqli_error($link));
                    echo "<select name='nombrecopa'>";
                    while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                    echo "Elige la copa: <option value='".$line['nombrecopa']."'";
                    if( isset($_POST["nombrecopa"]) )  { 
                           if ($line['nombrecopa']==$_POST["nombrecopa"]) {
                           echo " selected";
                           }
                       } else {
                           if ($line['nombrecopa']=='Copa Navidad') {
                           echo " selected";
                           }
                       }
                    echo ">".$line['nombrecopa']."";
                    echo "</option>";
                    }
                    echo "</select>";
                    // Liberar resultados
                    mysqli_free_result($result);

                    // Cerrar la conexión
                    mysqli_close($link);
                   ?>	
                    <input type="submit" value="enviar" />
		</form>
      <?php
    if( isset($_POST["nombrecopa"]) )  { 
    // Conectando, seleccionando la base de datos
    $link = mysqli_connect(SERVER, USER, PASS)
    or die('No se pudo conectar: ' . mysqli_error($link));
    echo '<h2 class=copdere1><br>Participantes de la '.$_POST['nombrecopa'].":</h2>";
    mysqli_select_db($link, BD) or die('No se pudo seleccionar la base de datos');

    // Realizar una consulta MySQL
    $query = 'select jugador.archivo, jugador.alias from jugador, juega, copa where jugador.idjugador=juega.idjugador and copa.idcopa=juega.idcopa and copa.nombrecopa="'.$_POST["nombrecopa"].'" order by jugador.alias;';
    $result = mysqli_query($link, $query) or die('Consulta fallida: ' . mysqli_error($link));

    // Imprimir los resultados en HTML
    echo "<table class=copdere2>\n";
    while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as  $c => $m) {
        if ($c=="archivo") {
        echo "\t\t<td><img src='../imagenes/upload/$m' height='35' width='35'/>\n";
        } else {
            
    $query12 = 'select idjugador from jugador where alias="'.$m.'";';
    $result12 = mysqli_query($link, $query12);
            
            
        echo $m."</td>";
            
            
        }
    }
    echo "\t</tr>\n";
    }
    echo "</table>\n";

    // Liberar resultados
    mysqli_free_result($result);

    // Cerrar la conexión
    mysqli_close($link);
    }

    echo "</div>";
    echo "<div class=partidos>";
$link = mysqli_connect(SERVER, USER, PASS)
    or die('No se pudo conectar: ' . mysqli_error($link));
    mysqli_select_db($link, BD) or die('No se pudo seleccionar la base de datos');
    echo "<table class=fuentes>\n";
$query55= 'select idpartido from partido';
$result55 =  mysqli_query($link, $query55);

    echo "<h2>Ultimos partidos:</h2>";
    while ($line55 = mysqli_fetch_array($result55, MYSQL_ASSOC)) {
 foreach ($line55 as $c) {
 $query = 'select copa.nombrecopa, jugador.alias, partido.golesloc, partido.golesvis, 
(select alias from jugador, partido, juega, usa, copa where jugador.idjugador=partido.idvisitante and partido.idcopa=juega.idcopa and partido.idvisitante=juega.idjugador and  usa.idpartido=partido.idpartido and usa.idjugador=partido.idvisitante and copa.idcopa=juega.idcopa and partido.idpartido='.$c.') alias2 from jugador, partido, juega, usa, copa where jugador.idjugador=partido.idlocal and partido.idcopa=juega.idcopa and partido.idlocal=juega.idjugador and  usa.idpartido=partido.idpartido and usa.idjugador=partido.idlocal and copa.idcopa=juega.idcopa and partido.idpartido='.$c;
    $result = mysqli_query($link, $query) or die('Consulta fallida: ' . mysqli_error($link));
    // Imprimir los resultados en HTML
    while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $c => $m) {
        if ($c=="alias") {
            
            
// Realizar una consulta MySQL
    $query12 = 'select jugador.archivo, jugador.alias from jugador where jugador.alias="'.$m.'"';
    $result12 = mysqli_query($link, $query12) or die('Consulta fallida: ' . mysqli_error($link));

    // Imprimir los resultados en HTML
    while ($line12 = mysqli_fetch_array($result12, MYSQL_ASSOC)) {
    foreach ($line12 as  $co => $mo) {
        if ($co=="archivo") {
        echo "\t\t<td style='text-align:left;'><img src='../imagenes/upload/$mo' height='35' width='35'/>\n";
        } else {
    $query13 = 'select idjugador from jugador where alias="'.$m.'";';
    $result13 = mysqli_query($link, $query13);
                        
        echo $mo."</td>";
        }
    }
    }

    // Liberar resultados
    mysqli_free_result($result12);
    

            
            
    }  elseif ($c=="alias2") {
                              
// Realizar una consulta MySQL
    $query13 = 'select alias, archivo from jugador where jugador.alias="'.$m.'"';
    $result13 = mysqli_query($link, $query13) or die('Consulta fallida: ' . mysqli_error($link));

    // Imprimir los resultados en HTML
    while ($line13 = mysqli_fetch_array($result13, MYSQL_ASSOC)) {
    foreach ($line13 as  $col => $mol) {
        if ($col=="alias") {
        echo "\t\t<td style='text-align:right;'>".$mol."</a>\n";
        } else {
        echo "<img src='../imagenes/upload/$mol' height='35' width='35'/></td>";
        }
    }
    }

    // Liberar resultados
    mysqli_free_result($result13);
    

            
            
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
    echo "<h2>Listado de copas</h2>";
    $query = 'select nombrecopa, fechaini, premiocopa from copa';
    $result = mysqli_query($link, $query) or die('Consulta fallida: ' . mysqli_error($link));

    // Imprimir los resultados en HTML
    echo "<table class=fuentes>\n";
    while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $m => $col_value) {
        if ($m=='premiocopa') {
        echo "<td>".$col_value." €</td>";
    } elseif ($m=='nombrecopa') {
            
            
    $query2 = 'select idcopa from copa where nombrecopa="'.$col_value.'"';
    $result2 = mysqli_query($link, $query2) or die('Consulta fallida: ' . mysqli_error($link));
            
    while ($line2 = mysqli_fetch_array($result2, MYSQL_ASSOC)) {
        
    foreach ($line2 as $m2 => $col_value2) {
        echo "<td>".$col_value."</td>";
        
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
    mysqli_free_result($result);

    // Cerrar la conexión
    mysqli_close($link);
    echo "</div>";
    ?>
<br><br><br>

    </div>
       
       <?php
}
    
        ?></div>
</body>
</html>