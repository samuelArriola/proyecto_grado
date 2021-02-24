<?php

    include("../config/conexion.php");
    $id_usuario = $_GET['id_u'];  

    $query ="SELECT * FROM inex_usuarios WHERE iden_usua ='$id_usuario'";
    $resultado = mysqli_query($con,$query);
	$datos =mysqli_fetch_array($resultado); 
	
	session_start(); 

	$_SESSION["IDEN"];
	$_SESSION["NOMB"];
	$_SESSION["ROLE"];

	if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "D"){

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
	<link href="../css/all.css?t=<?php echo time(); ?>" rel="stylesheet"> 
    <title>Editar Usuarios</title>
</head>
<body>

<?php include("menu.php"); ?>
  <div class="hide-on-med-and-down" style="margin-top: 65px;"></div>

   <div class="">
		<div class="row">
			<div class="col s12 m8 l6 offset-l3 offset-m2">
				<div class="card center-align">
				<div class="section card-image">
				<i class="teal-text lighten-2 large material-icons">edit</i>
				</div>

				<div class="card-content" id="form" >
					<span class="card-title" style=" position:relative; top: -30px">Editar Usuario </span> 
					<span style="opacity: 0.5; position:relative; top: -15px" class="left">Los campos señalados con "*" son campos obligatorios</span>  

					<form action="" method="post" id="editar_u">
					 <div class="row">
						<div class="input-field col m12 s12 ">
							<input name="nombre" value="<?php echo $datos['nomb_usua'] ?>" id="e1" type="text" class="validate caracteresEpesiales" >
							<label for="e1">*Nombre</label>
						</div>
						<div class="input-field col m12 s12">
							<input name="apellido" value="<?php echo $datos['apel_usua'] ?>" id="e2" type="text" class="validate caracteresEpesiales" required>
							<label for="e2">*Apellido</label>
						</div>
						<div class="input-field col m12 s12">
							<input name="correo" value="<?php echo $datos['correo'] ?>" id="e7" type="email" class="validate caracteresEpesiales" required>
							<label for="e7">*Correo</label>
						</div>
						<input name="cedula" value="<?php echo $datos['iden_usua'] ?>" id="e9" type="hidden" class="validate caracteresEpesiales" required>

					 </div>
						
						<div class="center section">
							<button  class=" btn  waves-effect waves-light" type="button" id="editar_usuario">Editar</button> 
						</div>    
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>

    


	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script>document.addEventListener('DOMContentLoaded', function() { M.AutoInit();});</script>
	<script src="js/funciones.js"></script> 
	<script src="js/validaciones.js"></script> 
</body>
</html>

<?php 
}else{
	session_destroy();
	header('location: ../');
}

mysqli_close($con); 
?>