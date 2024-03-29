<?php
	$item = $_GET['id'];
	$visto=0;
	$vistoL=0;
	
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

	include("../config/conexion.php");
	$sql = "select item_proy, nomb_proy, desc_proy, jefe_proy, esta_proy, visto, item_dep, liderAcargo, DATE_FORMAT(fecha_ip, '%Y/%m/%d') as fecha_ip , DATE_FORMAT(fecha_fp, '%Y/%m/%d') as fecha_fp, comentarios_p
	,(select concat(nomb_usua,' ',apel_usua) from inex_usuarios where iden_usua = a.jefe_proy) AS responsable, a.esta_proy
	from inex_proyectos as a where a.item_proy = '".$item."'";
	$rs = mysqli_query($con, $sql); 

	//muestra las independencias
	$mostrar_i = "SELECT * FROM inex_dependencias";
	$resul_mi = mysqli_query($con,$mostrar_i); 

	//Muestras todos los lideres
	$queryLider = "SELECT u.iden_usua, u.nomb_usua, u.apel_usua, d.item_rol, u.item_dep, u.correo ,(SELECT nombre_dep FROM inex_dependencias WHERE item_dep = u.item_dep) as nombre_dep
	FROM inex_usuarios u, inex_usuarios_roles d WHERE u.iden_usua = d.iden_usua AND d.item_rol ='L'";
	$resul_lider = mysqli_query($con,$queryLider);

	// $query = "SELECT  * FROM inex_usuarios as a, inex_proyectos_usuarios as b WHERE a.iden_usua = b.iden_usua AND b.item_proy = '".$item."'";
  	 $query= "SELECT u.iden_usua, u.nomb_usua, u.apel_usua, d.item_rol, u.correo FROM inex_usuarios u, inex_proyectos_usuarios d WHERE u.iden_usua = d.iden_usua AND d.item_rol ='L' AND d.item_proy ='$item' ";
	$resul_correo = mysqli_query($con,$query);  

	session_start(); 

	$_SESSION["IDEN"];
	$_SESSION["NOMB"];
	$_SESSION["ROLE"];

	//botones modificables 
	$eviarProyecto = "<a class='btn orange modal-trigger' href='#confirmP' >Enviar Proyecto</a>";
	$editarProyecto = "<button class='btn orange' id='actualizar' >Actualizar</button>";
	$eliminarProyecto = "<a class='btn red modal-trigger ' id='eliminar_p' href='#modal3'>eliminar</a>";

	if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "L"){ 

?>

<html> 
<head> 
<title>PROYECTOS INEX</title> 
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="icon" type="../image/png" href="../img/logo.png" />
<link href="../css/all.css?t=<?php echo time(); ?>" rel="stylesheet"> 

</head>

<body>
<?php include("menu.php"); ?>
<div class="hide-on-med-and-down" style="margin-top: 90px;"></div>

<div class="container">

<div class="teal-text">&nbsp;&nbsp;&nbsp;INFORMACION DEL PROYECTO</div> <br>
<div class="row">
	<div style="overflow-x: auto;"><div>

	<?php if ($row = mysqli_fetch_array($rs)) 
	{  $estado_proyecto = $row["esta_proy"]; 	
	    $jefe_proy = $row['jefe_proy'];
	    $nomb_proy = $row['nomb_proy'];
	?> 

	<!-- Modal cometarios  -->
	<div id="cometariosP" class="modal"> <br><br>
		<div class="center"><i class="large material-icons red-text">email</i></div>
		<br><div class="center"><h4 class="">COMENTARIOS</h4></div>
    <div class="modal-content">
		<div class="row">
			<div class="input-field col s12">
			<span class="container" maxlength="1100"><?php echo $row['comentarios_p'] ?></span>
			</div> <br> <br><br>
		</div>
	</div>
    </div>
	
    <form id=""> 
	<div class="input-field col s12">
	<b>Nombre del proyecto:</b> 
	   <input  type="hidden" value="<?php echo $row["jefe_proy"] ?>" id="coordinador_proye">
	   <input  type="hidden" value="<?php echo $item ?>" id="id_pro">
	   <input  type="hidden" value="<?php echo $estado_proyecto ?>" id="EpEstado_proyecto">
	   <input value = "<?php echo $row["nomb_proy"] ?>" name="nombre_proye" id="nombre_proye" type="text" class="validate caracteresEpesiales"> 
		<div style="text-align: center; margin-top: -95px; margin-left: 93%;"><?php echo $icon_estado[$row["esta_proy"]] ?><div style="font-size: 0.7em; margin-top: 8px;"> <?php echo $desc_estado[$row["esta_proy"]] ?></div></div>
		<?php if($estado_proyecto==3){ ?>	
			<div style="text-align: center; margin-top: -49px; margin-left: 75%;" class="hide-on-small-only">
			 <li title="COMETARIOS" class='material-icons'><a class="hoverable  modal-trigger red-text" href="#cometariosP">comment</a></li>
			<div style="font-size: 0.7em; margin-top: 10px;"> Comentarios</div></div>			
		<?php } ?>
	</div>

	<div class="input-field col s12"> <br>
	<b>Descripción del proyecto:</b>
	   <textarea name="descripcion_proye" id="descripcion" class="materialize-textarea caracteresEpesiales"><?php echo $row["desc_proy"]?> </textarea>
	</div>

	<div class="input-field col s6">
        <input type="text" value = "<?php echo $row['fecha_ip'] ?>" class="datepickerE1 validate" name="fecha_ip"  id="datepickerE1" required >
          <label for="datepicker1"><b style = "color: black">* Fecha Inicial </b></label>
        </div>
        <div class="input-field col s6">
        <input type="text" value = "<?php echo $row['fecha_fp'] ?>" class="datepickerE2 validate" name="fecha_fp"  id="datepickerE2"  required>
          <label for="datepicker2"><b style = "color: black">* Fecha Final</b></label>
        </div>

	  <div class="col s12"> 
         <b>Escoja la dependencia a la que pertenece el proyecto</b>
        <select class="browser-default" name="dependencia" id="dependencia">
		<?php 
		while ($row_mi=mysqli_fetch_array($resul_mi)) {
			$resultado="<option value='".$row_mi['item_dep']."' > ".$row_mi['nombre_dep']."</option>";
            
			if ($row["item_dep"]==$row_mi['item_dep']) { 
			 $resultado="<option value='".$row_mi['item_dep']."' selected > ".$row_mi['nombre_dep']."</option>";
			}
			echo $resultado;
		}
		?>
        </select>
    </div> 

	<div class="col s12"> 
       <br><br>
		<div class="teal-text">LIDERES A CARGO</div>

		<div class=" section">
		<table class="container responsive-table">
			<thead>
				<tr>
					<th>Cedula</th>
					<th>Nombre</th>
					<th>Correo</th>		
				</tr>
		   </thead>
		   <tbody id="mostrarLiderP">
			
		  </tbody>
		</table>	 
		</div> <br> 
		
     </div>
	
	<div class="input-field col s12">
	<b>Coordinador a cargo:</b> 
	   <input disabled value = "<?php echo $row["responsable"] ?>" name="lider_proye" id="lider_proye" type="text" class="validate">
	</div>
	
	
	</form>
  <?php	} ?>
</div>

</div>


		<?php
		$sql = "select *
		from inex_actividades as a where a.item_proy = '".$item."'";
		$rs = mysqli_query($con, $sql);
		?>
	<div id="container_actividades">
		<div class="row">
		 <div class="teal-text">INFORMACIÓN DE LAS ACTIVIDADES</div>
			<div style="overflow-x: auto;">
				<table>
					<thead>
						<tr>
							<th>Actividad</th>
							<th>Descripción</th>
							<th>Fecha Inicial</th>
							<th>Fecha Final</th>
							<th>Valor</th>
							<th>Opciones</th>
							
						</tr>
					</thead>
					<tbody id="mostrarActividadA">
					</tbody>
				</table>
			</div>
		</div>
	</div>


	
    <?php if($estado_proyecto==1 || $estado_proyecto==2){ ?>	 
		<div class="fixed-action-btn" > 
	<a  class="btn-floating btn-large waves-effect waves-light orange  tooltipped  modal-trigger" disabled='disabled' href="crear_actividad.php?id=<?php echo $item ?>"  data-position="top"  data-tooltip="AGREGAR ACTIVIDAD"  id="flotante2" ><i class="material-icons">add</i></a>
		  <?php } else if($estado_proyecto==0 || $estado_proyecto==3){ ?>
			<div class="fixed-action-btn" > 
	<a  class="btn-floating btn-large waves-effect waves-light orange  tooltipped  modal-trigger" href="crear_actividad.php?id=<?php echo $item ?>"  data-position="left"  data-tooltip="AGREGAR ACTIVIDAD"  id="flotante2" ><i class="material-icons">add</i></a>
		  <?php } ?> 
		  

 

	<!-- Modal Structure eliminar -->
	<div id="modal1" class="modal">
    <div class="modal-content">
       <h5 class="center" >¿Estás seguro de eliminar esta actividad?</h5>
	 <div class="center">
	   <button   id="eliminarActividadA" type="button" class="btn-small red modal-close">Si</button> 
	   <a href="#!" class="modal-close waves-effect waves-green btn-flat btn-small orange">No</a>
	 </div> 
	</div>
    </div>

	

	
   <!-- Modal Structure elimina Evidencia  -->
	<div id="eliminarEvidencia" class="modal">
		<div class="modal-content">
			<input  id="IdEvi" type="hidden">
			<input  id="IdRuta" type="hidden">
			<h5 class="center" >¿Estás seguro de eliminar esta Evidencia?</h5>
				<div class="center">
					<button   id="eliminarEvidenciasA" type="button" class="btn-small red modal-close">Si</button>
					<a href="#!" class="modal-close waves-effect waves-green btn-flat btn-small orange">No</a>
				</div> 
		</div>
    </div>
	
		
	<!-- Modal para agregar arcivos -->
	<div id="modal2" class="modal ">
		<div class="modal-content" >
		 <div class="center"><i class="large material-icons teal-text">file_upload</i></div>
		 <div class="center"><h4 class="">SUBIR EVIDENCIAS</h4></div> <br> 
		<form action="" method="" enctype="multipart/form-data" id="subirEvidencia" >
			<div class="row" id="edi_escondeForm">  
			<span class="center-align" style="opacity: 0.5; position:relative; top: -15px" >&nbsp;&nbsp;&nbsp;&nbsp;Los campos señalados con "*" son campos obligatorios</span> <br>
				<div class="input-field col s6">
					<input placeholder="Ingrese el nombre de la evidencia" name="nombre_a" id="first_name_e" type="text" class="validate caracteresEpesiales" required>
					<label for="first_name_e">* Nombre</label>
				</div>
				<div class="col s6">
					<div class="file-field input-field">
					<div class="btn">
						<span>File</span>
						<input type="file" name="archivo_a" class="validate " required>
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
					</div>
					<input value="" id="idActiEvidencia" name="item_acty" type="hidden" class="validate" type="text" required>
				</div>
			</div>
			 
			 <div class="center hide" id="edi_load" type="" style="margin-top: 50px">
				<?php include("../include/preloader.php"); ?>
			</div>
			 
			  <div class="center">
			  	  <button class="btn orange"  type="button" onclick="subirEvidenciaA()">Subir </button>
				  <a href="#!" class=" modal-close waves-effect waves-green btn-flat white-text red ">Atras</a>
			  </div>
		</form>
		</div> <br><br> 

      <!-- DESCARGAR LAS ACTIVIDADES -->
		<div class="center"><h4 class="">DESCARGAR EVIDENCIAS</h4></div>

		<div class=" section">
			<table class="container responsive-table">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Archivo</th>
						<th>Lista  de Opciones</th>			
					</tr>
				</thead>
			<tbody id="mostrarEvidenciaA">
				
			</tbody>
			</table>	 
		</div> <br> <br>
    </div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/funciones.js?t=<?php echo time(); ?>"></script> 
<script src="js/funciones.js"></script> 
<script src="js/validaciones.js"></script>
<script>
	mostrarLiderP( <?php echo $item ?>);
	// mostrarActividadA(<?php echo $item ?>);
	
</script>
 
</body>

</html>

<?php 

}else{
	session_destroy();
	header('location: ../');
}

mysqli_close($con); ?>