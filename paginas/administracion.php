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
	<link href="../estilos/administracion.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class=cuerpo>
             <form action="administracion.php" method="post">
                   <?php
                    $link = mysql_connect('localhost', USER, PASS) or die('No se pudo conectar: ' . mysql_error());
                    mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');
                    $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = 'fifa'";
                    $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                    echo "<select name='tabla'>";
                    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                        echo "<option value='".$line['TABLE_NAME']."'";   
                        if( isset($_POST["tabla"]) )  { 
                            if ($line['TABLE_NAME']==$_POST["tabla"]) {
                            echo " selected";
                            }
                        } else {
                            if ($line['TABLE_NAME']=='jugador') {
                            echo " selected";
                            }
                        }
                        echo ">".$line['TABLE_NAME']."";
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
    if( isset($_POST["tabla"]) )  { 
    // Conectando, seleccionando la base de datos
$link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

// Realizar una consulta MySQL
$query = "select * from ".$_POST['tabla'];
$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
$query2 = "SELECT COUNT(*)FROM information_schema.columns WHERE table_name ='".$_POST['tabla']."'";
$result2 = mysql_query($query2);
$linea2 = mysql_fetch_array($result2, MYSQL_ASSOC);
        
        
   
// Imprimir los resultados en HTML
echo "<table class=blanco border='1'>\n";

$linea = mysql_fetch_array($result, MYSQL_ASSOC);
echo "<tr>";
    foreach ($linea as $c => $m) {
        
        echo "<th>".$c."</th>";
        
    }
    if ($_POST["tabla"]  != "juega" and $_POST["tabla"]  != "usa" and $_POST["tabla"]  != "participa") {
    echo "<th>Editar</th>";
    }
    echo "<th>Borrar</th>";
echo "</tr>";

mysql_data_seek($result, 0);
        
while ($linea = mysql_fetch_array($result, MYSQL_ASSOC)) {
    
    echo "<tr>";
    foreach ($linea as $c => $m) {
        if ($c=="idjugador") {
        echo "<td class=celeste><a href='./administracion/modificarjugador.php?cod=".$linea['idjugador']."'>".$m."</a></td>";
        } 
        elseif ($c=="idlocal") {
        echo "<td class=celeste><a href='./administracion/modificarjugador.php?cod=".$linea['idlocal']."'>".$m."</a></td>";
        } 
        elseif ($c=="idvisitante") {
        echo "<td class=celeste><a href='./administracion/modificarjugador.php?cod=".$linea['idvisitante']."'>".$m."</a></td>";
        } 
        elseif ($c=="idcopa") {
        echo "<td class=celeste><a href='./administracion/modificarcopa.php?cod=".$linea['idcopa']."'>".$m."</a></td>";
        } 
        elseif ($c=="idequipo") {
        echo "<td class=celeste><a href='./administracion/modificarequipo.php?cod=".$linea['idequipo']."'>".$m."</a></td>";
        }
        elseif ($c=="idliga") {
        echo "<td class=celeste><a href='./administracion/modificarliga.php?cod=".$linea['idliga']."'>".$m."</a></td>";
        }
        elseif ($c=="idpartido") {
        echo "<td class=celeste><a href='./administracion/modificarpartido.php?cod=".$linea['idpartido']."'>".$m."</a></td>";
        }
        elseif ($c=="clave") {
        echo "<td> ******** </td>";
        } else {
        echo "<td>$m</td>";
        }
    }
    if ($_POST['tabla'] == "jugador") {
    echo "<td><a href='./administracion/modificarjugador.php?cod=".$linea['idjugador']."'><img width='30' height='30' src='../imagenes/file_edit.png'></a></td>";
    echo "<td><a href='./administracion/borrarjugador.php?cod=".$linea['idjugador']."'><img width='30' height='30' src='../imagenes/borrar.png'></a></td>";
    }
    elseif ($_POST['tabla'] == "copa") {
    echo "<td><a href='./administracion/modificarcopa.php?cod=".$linea['idcopa']."'><img width='30' height='30' src='../imagenes/file_edit.png'></a></td>";
    echo "<td><a href='./administracion/borrarcopa.php?cod=".$linea['idcopa']."'><img width='30' height='30' src='../imagenes/borrar.png'></a></td>";
    }
    elseif ($_POST['tabla'] == "liga") {
    echo "<td><a href='./administracion/modificarliga.php?cod=".$linea['idliga']."'><img width='30' height='30' src='../imagenes/file_edit.png'></a></td>";
    echo "<td><a href='./administracion/borrarliga.php?cod=".$linea['idliga']."'><img width='30' height='30' src='../imagenes/borrar.png'></a></td>";
    }
    elseif ($_POST['tabla'] == "partido") {
    echo "<td><a href='./administracion/modificarpartido.php?cod=".$linea['idpartido']."'><img width='30' height='30' src='../imagenes/file_edit.png'></a></td>";
    echo "<td><a href='./administracion/borrarpartido.php?cod=".$linea['idpartido']."'><img width='30' height='30' src='../imagenes/borrar.png'></a></td>";
    }
    elseif ($_POST['tabla'] == "equipo") {
    echo "<td><a href='./administracion/modificarequipo.php?cod=".$linea['idequipo']."'><img width='30' height='30' src='../imagenes/file_edit.png'></a></td>";
    echo "<td><a href='./administracion/borrarequipo.php?cod=".$linea['idequipo']."'><img width='30' height='30' src='../imagenes/borrar.png'></a></td>";
    }
    elseif ($_POST['tabla'] == "participa") {
    echo "<td><a href='./administracion/borrarparticipa.php?cod=".$linea['idjugador']."&cod2=".$linea['idliga']."'><img width='30' height='30' src='../imagenes/borrar.png'></a></td>";
    }
    elseif ($_POST['tabla'] == "juega") {
    echo "<td><a href='./administracion/borrarjuega.php?cod=".$linea['idjugador']."&cod2=".$linea['idcopa']."'><img width='30' height='30' src='../imagenes/borrar.png'></a></td>";
    }
    elseif ($_POST['tabla'] == "usa") {
    echo "<td><a href='./administracion/borrarusa.php?cod=".$linea['idjugador']."&cod2=".$linea['idequipo']."&cod3=".$linea['fecha']."'><img width='30' height='30' src='../imagenes/borrar.png'></a></td>";
    }
    echo "</tr>";
} 
        
    foreach ($linea2 as $e => $j) {
        
    echo "<tr><td colspan=".($j+2)."><a href='./administracion/crear".$_POST["tabla"].".php'><img width='30' height='30' src='../imagenes/añadir.png'></a></td></tr>";
        
    }
    
echo "</table>\n";

// Liberar resultados
mysql_free_result($result);

// Cerrar la conexión
mysql_close($link);
    } else {
        echo "<h1>seleccione la tabla que desea modificar</h1>";
    }

?>
        
    </div>
</body>
</html>