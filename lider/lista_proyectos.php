<?php

	include("../config/conexion.php");

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

	session_start(); 

	$_SESSION["IDEN"];
	$_SESSION["NOMB"];
	$_SESSION["ROLE"];

	if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "L"){    

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

<div class="teal-text">REGISTROS DE PROYECTOS</div> <br>

 <div class="row">
 <label>MOSTRAR:</label> 
 <div class="input-field col s12">
  <select class="browser-default" id="buscar" style="position: relative; left :-15px">
    <option value="TODOS" selected>TODOS</option>
    <option value="APROBADOS">APROBADOS</option>
    <option value="CONSTRUCCION">CONSTRUCCION</option>
    <option value="CORREGIR">CORREGIR</option>
	<option value="ENVIADOS">ENVIADOS</option>
  </select>
</div>
 </div> 

	


<div class="row" style="position: relative; top: -40px"> 
<div style="overflow-x: auto;">

	<table id="tabla">	
		<!-- PRELOAD -->
		<div class="center hide" id="loar" type="" style="margin-top: 50px">
			<div class="preloader-wrapper small active">
				<div class="spinner-layer spinner-green-only">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div><div class="gap-patch">
					<div class="circle"></div>
				</div><div class="circle-clipper right">
					<div class="circle"></div>
				</div>
				</div>
			</div>
		</div> 

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

<?php   

}else{
	session_destroy();
	header('location: ../');
}

mysqli_close($con); 

?>