<?php 

session_start(); 

if(!isset($_SESSION['css'])) 
{ 
    $_SESSION['css'] = 'blanco'; 
} 

if(isset($_POST['estilo'])) 
{ 
    $_SESSION['css'] = $_POST['estilo']; 
} 

?>  

<html> 
<head> 
    <link rel="stylesheet" href="<?=$_SESSION['css']?>.css" type="text/css" /> 
</head> 
<body> 
<form action="<?=$_SERVER['PHP_SELF']?>" method="post"> VAMOS A CAMBIAR EL ESTILO
    <select name="estilo"> 
        <option value="blanco">blanco</option> 
        <option value="negro">Negro</option> 
    </select> 
    <input type="submit" value="cambiar" /> 
</form> 
</body> 
</html>