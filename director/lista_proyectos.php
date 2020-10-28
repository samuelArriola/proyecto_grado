

<?php 
/*

    $icon_estado = array('0' => '<i class="material-icons">edit</i>',
	'1' => '<i class="material-icons">send</i>',
	'2' => '<i class="material-icons">check_circle</i>',
	'3' => '<i class="material-icons">border_color</i>');
	$color_estado = array('0' => 'grey',
	'1' => 'blue',
	'2' => 'teal',
	'3' => 'orange');

	$desc_estado = array('0' => 'Construcción',
	'1' => 'Enviado',
	'2' => 'Aprobado',
	'3' => 'Corregir');

	    

?>

<html> 
<head> 
<title>PROYECTOS INEX</title> 
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- <link rel="shortcut icon" href="https://tic.curn.edu.co:2641/gestion/comun/logo.png" />-->
<link href="../css/all.css?t=<?php echo time(); ?>" rel="stylesheet"> 
</head>
<body>
<?php include("menu.php"); ?>
<div class="hide-on-med-and-down" style="margin-top: 90px;"></div>

<div class="container">

<div class="teal-text">REGISTROS DE PROYECTOS</div>

 <div class="row">
 <label>MOSTRAR:</label>
 <div class="input-field col s12">
  <select class="browser-default" id="buscar">
    <option value="TODOS" selected>TODOS</option>
    <option value="APROBADOS">APROBADOS</option>
    <option value="CONSTRUCCION">CONSTRUCCION</option>
    <option value="CORREGIR">CORREGIR</option>
	<option value="ENVIADOS">ENVIADOS</option>
  </select>
</div>
 </div> 

<div class="row"> 
<div style="overflow-x: auto;">

<table id="tabla">
              
</table>

</div>
</div>

<div class="fixed-action-btn" > 
<a  class="btn-floating btn-large waves-effect waves-light orange  tooltipped"  href="crear_proyecto.php" data-position="left"  data-tooltip="CREAR PROYECTO"  id="flotante" ><i class="material-icons">add</i></a>
</div>
  
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/funciones.js?t=<?php echo time(); ?>"></script> 
<script src="js/funciones.js"></script> 
<script src="js/buscar.js"></script> 
 
</body>

</html>

*/ 
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PROYECTOS</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
	<link href="../css/all.css?t=<?php echo time(); ?>" rel="stylesheet"> 
	<style>
	.hoverA:hover {
		background-color:RGB(255, 160, 0, 0.5);
		}
	</style>
</head>
<body>
  <?php include("menu.php"); ?>
  <div class="hide-on-med-and-down" style="margin-top: 65px;"></div>

 
    <div class="nav-content white">
      <ul class="tabs tabs-transparent" >
        <li class="tab hoverA"><a href="#menuRecibido" class="teal-text hoverable  ">Recibidos</a></li>
        <li class="tab hoverA"><a href="#menuAprobado" class="teal-text hoverable ">Aprobados</a></li>
      </ul>
    </div>


  <!-- RECIBIDOS -->
  <div id="menuRecibido" class="col s12">  <br> 
	<div class="container">
		<div class="teal-text" style="position: relative; right:10px">LISTA DE PROYECTOS</div>
		<div class="row">
		  <label>MOSTRAR:</label>
			<div class="input-field col s12">
				<select class="browser-default" id="buscar">
					<option value="TODOS" selected>TODOS</option>
					<option value="APROBADOS">APROBADOS</option>
					<option value="CONSTRUCCION">CONSTRUCCION</option>
					<option value="CORREGIR">CORREGIR</option>
					<option value="ENVIADOS">ENVIADOS</option>
				</select>
			</div>
		</div> 
		<div class="row"> 
		  <div style="overflow-x: auto;">
			<table id="tabla">
						
			</table>
		  </div>
		</div>
	</div>
   </div>

  <!-- APROBADOS -->
  <div id="menuAprobado" class="col s12">

     <div class="container"> <br>
	 <div class="teal-text">PROYECTOS APROBADOS</div>
		<div class="row"> 
			<div style="overflow-x: auto;">
				<table id="tablaProyA">
							
				</table>
			</div>
		</div>
	  </div>

  </div>


	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script type="text/javascript" src="../js/funciones.js?t=<?php echo time(); ?>"></script> 
	<script>document.addEventListener('DOMContentLoaded', function() { M.AutoInit();});</script>
	<script src="js/funciones.js"></script> 
	<script src="js/buscar.js"></script> 
	</body>
</html>


