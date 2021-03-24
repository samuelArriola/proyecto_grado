<?php

    session_start(); 

	$_SESSION["IDEN"];
	$_SESSION["NOMB"];
	$_SESSION["ROLE"];
	$_SESSION["DEP"];

	if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "D"){
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Coordinadores</title>
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
        <li class="tab hoverA"><a href="#creaUsuario" class="teal-text hoverable  ">Crear usuario</a></li>
        <li class="tab hoverA"><a href="#mostrarUsuario" class="teal-text hoverable ">Mostrar usuarios</a></li>
      </ul>
    </div>


  <!-- CREAR USUARIO -->
  <div id="creaUsuario" class="col s12">  <br> 

    <div class="">
		<div class="row">
			<div class="col s12 m8 l6 offset-l3 offset-m2">
				<div class="card center-align">
				<div class="section card-image">
				<i class="teal-text lighten-2 large material-icons">person_add</i>
				</div>
				<div class="card-content" id="form" >
					<span class="card-title" style="position:relative; top: -18px">Registrar Usuario </span> 
					<form action="" method="post" id="registra_u"> <br>
					<span style="opacity: 0.5; position:relative; top: -13px" class="left">Los campos señalados con "*" son campos obligatorios</span>  
					 <div class="row">
					    <input type="hidden" id="dep_u" value="<?php echo $_SESSION["DEP"];?>">
						<div class="input-field col m12 s12 ">
							<input name="nombre" id="i1" type="text" class="validate caracteresEpesiales" >
							<label for="i1">*Nombre</label>
						</div>
						<div class="input-field col m12 s12">
							<input name="apellido" id="i2" type="text" class="validate caracteresEpesiales" required>
							<label for="i2">*Apellido</label>
						</div>
						<div class="input-field col m12 s12">
							<input name="cedula" id="i9" type="number" class="validate caracteresEpesiales" min="" max="" required>
							<label for="i9">*Cedula</label>
						</div>
						<div class="input-field col m12 s12">
							<input name="correo" id="i7" type="email" class="validate caracteresEpesiales" required>
							<label for="i7">*Correo</label>
						</div>
						<div class="input-field col s12"  >
						<span>*Tipo de usuario</span> <br><br>
							<p>
							<label>
								<input value="C" name="checkTip" type="checkbox" class="filled-in" />
								<span>COORDINADO &nbsp &nbsp &nbsp</span>
							</label>
							<label>
								<input value="L" name="checkTip" type="checkbox" class="filled-in" />
								<span>LIDER</span>
							</label>				
							</p>
						</div>
					 </div>
						
						<div class="center section">
							<button  class=" btn  waves-effect waves-light" type="button" id="guardar_usuario">Registrar</button> 
						</div>    
					</form>
				</div>
				</div>
			</div>
		</div>
	</div>

   </div>

  <!-- APROBADOS -->
  <div id="mostrarUsuario" class="col s12">
   <div class="container section ">

    <!-- // buscador  -->
    <div class=" section">
        <div class="row ">
        <form action="" method="POST">
        <div class="col m6">
            <div class="input-field col m7 offset-m8">
            <i class="material-icons prefix">search</i> 
            <input name="buscador" id="buscar_u" type="text" class="validate" placeholder="Cedula,nombre,apellido" >
            <label for="buscar">Buscar</label>
            </div>
            </div>
        </form> 
        </div>
    </div>

		<div class="contenedor_tabla responsive-table">
		<table class="" style="" >
			<thead>
			<tr class="card-panel teal lighten-2">
				<th>Cedula</th>		
				<th>Nombre</th>
				<th>Apellido</th>		
				<th>Correo</th>
				<!-- <th>Roles</th> -->
				<th>Estado</th>
				<th>Opciones</th>
			</tr>
			</thead>
			<tbody id="mostrar_usu">
				
			</tbody>  
		</table>
		</div>
	</div>

  </div>

  <!-- Modal EDITAR USUARIO -->
	<div id="modalEdita" class="modal">

	<div class="section">
	<div class="row container ">
		<div class="col s12 m12  offset-s1">
			
			<div class="section card-image">
			<i class="teal-text lighten-2 large material-icons">edit</i>
			</div>

			<div class="card-content " id="form" >
				<span class="card-title">Editar Usuario </span> 
				<form action="" method="post" >

					<div class="row">
					<div class="input-field col m12 s12 ">
						<input name="nombre" id="i1" value="<?php echo $nombre ?>" type="text" class="validate" required>
						<label for="i1">Nombre</label>
					</div>
					<div class="input-field col m12 s12">
						<input name="apellido" id="i2" value="<?php echo $apellido?>" type="text" class="validate" required>
						<label for="i2">Apellido</label>
					</div>
					<div class="input-field col m12 s12">
						<input name="cedula" id="i9" value="<?php echo $cedula?>" type="number" class="validate"  required>
						<label for="i9">Cedula</label>
					</div>
					<div class="input-field col m12 s12">
						<input name="correo" id="i7" value="<?php echo $correo ?>" type="email" class="validate" required>
						<label for="i7">Correo</label>
					</div>

					</div>
					
					<div class="center section">
						<button  class=" btn  waves-effect waves-light" type="submit">Guardar </button>  
					</div>    
				</form>
			</div>
			
		</div>
	</div>
	</div>

    </div>

	<!--  confirmacion eliminar usuario -->
	<div id="eliminaU" class="modal">
		<div class="modal-content">
		<input  id="obtieneID" type="hidden">
		<h5 class="center" >¿Estás seguro de eliminar este usuario?</h5>
			<div class="center">
			<button   id="eliminarUsuarios" type="button" class="btn-small red modal-close">Si</button>
			<a href="#!" class="modal-close waves-effect waves-green btn-flat btn-small orange">No</a>
			</div> 
		</div>
	</div>
	
	<!--  confirmacion eliminado logico de  usuario -->
	<div id="eliminaULogico" class="modal">
		<div class="modal-content">
		<input  id="obtieneIDLogico" type="hidden">
		<h5 class="center" >¿Estás seguro de eliminar este usuario?</h5>
			<div class="center">
			<button   onclick="eliminarUsuariosLogicos('DESACTIVO')" type="button" class="btn-small red modal-close">Si</button>
			<a href="#!" class="modal-close waves-effect waves-green btn-flat btn-small orange">No</a>
			</div> 
		</div>
	</div>

	<!--  confirmacion restaurarULogico logico de  usuario -->
	<div id="restaurarULogico" class="modal">
		<div class="modal-content">
		<input  id="obtieneIDLogicoRestau" type="hidden">
		<h5 class="center" >¿Estás seguro de restaurar este usuario?</h5>
			<div class="center">
			<button   onclick="rstaurarUsuariosLogicos('ACTIVO')" type="button" class="btn-small red modal-close">Si</button>
			<a href="#!" class="modal-close waves-effect waves-green btn-flat btn-small orange">No</a>
			</div> 
		</div>
	</div>

	
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script type="text/javascript" src="../js/funciones.js?t=<?php echo time(); ?>"></script> 
	<script>document.addEventListener('DOMContentLoaded', function() { M.AutoInit();});</script>
	<script src="js/funciones.js"></script> 
	<script src="js/validaciones.js"></script> 
	<script src="js/buscar.js"></script> 
	</body>
</html>

<?php 

}else{
	session_destroy();
	header('location: ../');
}


?>


