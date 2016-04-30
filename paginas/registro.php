<?php
include "cabecera2.php";
include "../conexion.php";

function validateClave1($clave1){
	//comprobacion caracteres entre 5 y 12 para validar clave
	if(strlen($clave1) < 5 || strlen($clave1) > 12)
		return false;
	// longitud, numeros y letras
	else if(!preg_match("/^[0-9a-zA-Z]+$/", $clave1))
		return false;
	// si todo esta ok
	else
		return true;
}

function validateClave2($clave1, $clave2){
	//comparo las claves
	if($clave1 != $clave2)
		return false;
	else
		return true;
}



//Comprobacion de datos
//variables valores por defecto
$clave1 = "";
$clave2 = "";

//Validacion de datos enviados
if(isset($_POST['enviar'])){
	if(!validateClave1($_POST['clave1']))
		$clave1 = "error";
	if(!validateClave2($_POST['clave1'], $_POST['clave2']))
		$clave2 = "error";	
	//Comprobamos si todo ha ido bien
	if($clave1 != "error" && $clave2 != "error")
		$status = 1;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-ES">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="author" content="Javier Rodriguez ,Ignacio Menchaca" />
    <title>Fifa-Tournaments</title>
	<link rel="stylesheet" href="../estilos/registro.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../javascript/jquery.js"></script>
	<link href="../estilos/cabecera.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class=cuerpo>
	<div class="wrapper">
		<div class="section">
            
            
			<?php if(!isset($status)): ?>
            <h1>Rellena tus datos:</h1>
			<form id="form1" action="registro.php" method="post">
                
     
            <label for="alias">Alias:</label>
          <input class="text" name="alias" value="" required />
	   
            <label for="nombre">Nombre:</label>
      	    <input class="text" name="nombre" value="" required />

            <label for="apellidos">Apellidos:</label>
            <input class="text" name="apellidos" value="" required />

            <label for="fecnac">Fecha de nacimiento</label>
            <input class="text" type="date" name="fecnac" value="" required />

            <label for="email">Email:</label></td>  
            <input class="text" name="email" value="" required />

            <label for="pais">Pais:</label></td>
            <input class="text" name="pais" value="" required />

            <label for="pais">Equipo favorito:</label>
                   <?php
                    $link = mysql_connect('localhost', USER, PASS) or die('No se pudo conectar: ' . mysql_error());
                    mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');
                    $query = 'SELECT * FROM equipo order by nombreequipo';
                    $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                    echo "<select name='nombreequipo'>";
                    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
                        echo "<option value='".$line['nombreequipo']."'>".$line['nombreequipo']."";
                    echo "</option>";
                    }
                    echo "</select>";
                    // Liberar resultados
                    mysql_free_result($result);

                    // Cerrar la conexión
                    mysql_close($link);
                   ?>
        
				<label for="clave1"><br>Clave:
                    <span id="req-password1" class="requisites <?php echo $clave1 ?>"> <img src="../imagenes/correcto.jpg" />
                    </span>
                </label>
				<input tabindex="2" name="clave1" id="password1" type="password" class="text <?php echo $clave1 ?>" value="" />
				<label for="clave2">Repetir clave:
                    <span id="req-password2" class="requisites2 <?php echo $clave2 ?>"> <img src="../imagenes/correcto.jpg" />
                    </span>
                </label>
				<input tabindex="3" name="clave2" id="password2" type="password" class="text <?php echo $clave2 ?>" value="" />
				
				<div>
					<input name="enviar" type="submit" value="Enviar formulario" />
				</div>
			</form>
			<?php else: 
    
        //Compruebo que he recibido el parámetro por la query.
            $link = mysql_connect('localhost', USER, PASS)or die('No se pudo conectar: ' . mysql_error());
            mysql_select_db('fifa') or die('No se pudo seleccionar la base de datos');

// Comprobamos si los datos ya existen
$checkuser = mysql_query("SELECT alias FROM jugador WHERE alias='".$_POST['alias']."'") ;
$username_exist = mysql_num_rows($checkuser);

$checkemail = mysql_query("SELECT email FROM jugador WHERE email='".$_POST['email']."'" ) ;
$email_exist = mysql_num_rows($checkemail);

if ($email_exist>0|$username_exist>0) {
echo "EL nombre de usuario o la cuenta de correo ya están en uso";
            header("refresh:3; url=registro.php");
}else{
            // Realizar una consulta MySQL
            $insert = "INSERT INTO JUGADOR VALUE(null".","."'".$_POST['alias']."'".","."'".$_POST['nombre']."'".","."'".$_POST['apellidos']."'".","."'".$_POST['fecnac']."'".","."'".$_POST['email']."'".","."'".$_POST['pais']."'".",MD5("."'".$_POST['clave1']."'"."),"."'".$_POST['nombreequipo']."'".",'0','pordefecto.jpg')";
    $result = mysql_query($insert) or die('Consulta fallida: ' . mysql_error());
            if ($result) {
            echo "<p>Gracias por registrarte</p><p>ahora puedes iniciar sesión<p>";
            } else {
            echo "Faltan campos por rellenar";    
            }
            
            // Cerrar la conexión
            mysql_close($link);
            
            header("refresh:3; url=login.php");
}
			endif; ?>
		</div>
	</div>
	<script type="text/javascript" src="../javascript/jquery.js"></script> 
	<script type="text/javascript" src="../javascript/formulario.js"></script>
</div>
</body>
</html>