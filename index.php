<?php
include "paginas/cabecera.php";
?>
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html ; charset=utf-8" />
    <meta name="author" content="Javier Rodriguez ,Ignacio Menchaca" />
        
    <title>Fifa-Tournaments</title>
	<link rel="stylesheet" type="text/css" href="slider/engine1/style.css" />
	<script type="text/javascript" src="javascript/jquery.js"></script>
	<link href="estilos/cabecera.css" rel="stylesheet" type="text/css" />
    <link href="estilos/index.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class=cuerpo>
        
            
    <div class=slider>
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
		<li><img src="slider/data1/images/slider2.jpg" alt="Escoge tu equipo" title="Escoge tu equipo" id="wows1_0"/></li>
		<li><img src="slider/data1/images/slider3.jpg" alt="Saca lo mejor de ti" title="Saca lo mejor de ti" id="wows1_1"/></li>
		<li><img src="slider/data1/images/slider4.jpg" alt="Gana a tus rivales" title="Gana a tus rivales" id="wows1_2"/></li>
		<li><img src="slider/data1/images/slider1.jpg" alt="Compite con nosotros" title="Compite con nosotros" id="wows1_3"/></li>
	</ul></div>
	<div class="ws_bullets"><div>
		<a href="#" title="Escoge tu equipo"><span><img src="slider/data1/tooltips/slider2.jpg" alt="Escoge tu equipo"/>1</span></a>
		<a href="#" title="Saca lo mejor de ti"><span><img src="slider/data1/tooltips/slider3.jpg" alt="Saca lo mejor de ti"/>2</span></a>
		<a href="#" title="Gana a tus rivales"><span><img src="slider/data1/tooltips/slider4.jpg" alt="slider4"/>3</span></a>
		<a href="#" title="Compite con nosotros"><span><img src="slider/data1/tooltips/slider1.jpg" alt="Compite con nosotros"/>4</span></a>
	</div></div>
	<div class="ws_shadow"></div>
	</div>
    </div>
	<script type="text/javascript" src="slider/engine1/wowslider.js"></script>
	<script type="text/javascript" src="slider/engine1/script.js"></script>
    <?php
    if(!isset($_SESSION['alias'])){
?>
    <div class=cuadros>
        <iframe width="500" height="385"
src="http://www.youtube.com/embed/peM77Ec_2oM">
</iframe>
    </div>
<?php
}   else {
    
    ?>
    <div class=comprar>
        <a href="https://www.easports.com/es/fifa/comprar/ES"><img src="imagenes/messi.jpg"></a>
    </div>
        <?php
}
?>
    


        
  
<div class=twitter><a class="twitter-timeline" href="https://twitter.com/EASPORTSFIFA" data-widget-id="562923327019556865">Tweets por el @EASPORTSFIFA.</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
    <?php
    if(isset($_SESSION['alias'])){
?>
    <div class=cuadros2>
        <iframe width="720" height="576"
src="http://www.youtube.com/embed/peM77Ec_2oM">
</iframe>
    </div>
        <?php
} ?>
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
    
    
</body>
</html>
