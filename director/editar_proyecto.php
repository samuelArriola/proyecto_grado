<?php
	
	
	$item = $_GET['id'];
	$cero = 0;

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

	session_start(); 

	$_SESSION["IDEN"];
	$_SESSION["NOMB"];
	$_SESSION["ROLE"];
	$_SESSION["NOM_D"];


	if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "D"){

	
?>

<html> 
<head> 
<title>PROYECTOS INEX</title> 
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
	<link rel="icon" type="image/png" href="../img/logo.png" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- <link rel="shortcut icon" href="https://tic.curn.edu.co:2641/gestion/comun/logo.png" />-->
<link href="../css/all.css?t=<?php echo time(); ?>" rel="stylesheet"> 
</head>

<body>
<?php include("menu.php"); ?>
<div class="hide-on-med-and-down" style="margin-top: 90px;"></div>

<div class="container">

<div class="teal-text">&nbsp;&nbsp;INFORMACION DEL PROYECTO</div>
<div class="row">
	<div style="overflow-x: auto;"><div>

	<?php if ($row = mysqli_fetch_array($rs)) 
	{  $estado_proyecto = $row["esta_proy"]; 
	   $dep_proy = $row["item_dep"];
	 	?> 
	
    <form id="">
	<div class="input-field col s12">
	<b>Nombre del proyecto:</b> 
	   <input  type="hidden" value="<?php echo $item ?>" id="id_pro"><br>
	   <input  type="hidden" value="<?php echo $row["nomb_proy"] ?>" id="EpNombreProy"><br>
	   <h6><?php echo $row["nomb_proy"] ?></h6>
	<div style="text-align: center; margin-top: -75px; margin-left: 93%;"><?php echo $icon_estado[$row["esta_proy"]] ?><div style="font-size: 0.7em; margin-top: 8px;"> <?php echo $desc_estado[$row["esta_proy"]] ?></div></div></div>
	
	<div class="input-field col s12">
	<b>Descripción del proyecto:</b>
	   <h6><?php echo $row["desc_proy"]?> </h6>
	</div>
     
	
	<div class="input-field col s6">
        <input type="text" value = "<?php echo $row['fecha_ip'] ?>" class="datepickerE1 validate" name="fecha_ip"  id="datepickerE1" required >
          <label for="datepicker1"><b style = "color: black">Fecha Inicial </b></label>
        </div>
        <div class="input-field col s6">
        <input type="text" value = "<?php echo $row['fecha_fp'] ?>" class="datepickerE2 validate" name="fecha_fp"  id="datepickerE2"  required>
          <label for="datepicker2"><b style = "color: black">Fecha Final </b></label>
        </div>

	<div class="col s12"> 
        <b>Dependencia a la que pertenece el proyecto</b><br>
		<?php while ($row2 = mysqli_fetch_array($resul_mi)) {  
				 if($row2["item_dep"] == $dep_proy)	{ ?>
				  <h6><?php echo $row2["nombre_dep"];?></h6>
				 <?php }?>		  
		<?php } ?> 

			
    </div>
	
	<div class="input-field col s12">
	<b>Coordinador a cargo:</b> 
	   <h6><?php echo $row["responsable"] ?></h6>
	</div>
	<div class="input-field col s12">
	
				<div class="teal-text">LIDERES DE APOYO</div>

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
			</div> <br> <br>



	</div>

		<?php if($estado_proyecto==2){ ?>
		<div class="input-field col s12">
	    	<div class="center"><button disabled class="btn orange"  id="actualizar" >Actualizar fechas</button></div>
		</div>
		<?php }else{ ?>
		<div class="input-field col s12">
    		<div class="center" ><button  class="btn orange red"  id="actualizar" >Actualizar fechas </button></div>
		</div>
		<?php } ?>

	</form>
  <?php	} ?>
</div>
</div>

<div id="container_actividades">
<?php
	$sql = "select * from inex_actividades as a where a.item_proy = '".$item."'";
	$rs = mysqli_query($con, $sql);
?><br>
	<div class="row">
	<div class="teal-text">INFORMACIÓN DEL ACTIVIDADES</div>
	<div style="overflow-x: auto;"><table>
	<tr>
		<th>Actividad</th>
		<th>Descripción</th>
		<th>Fecha inicial</th>
		<th>Fecha final</th>
		<th>Valor</th>
		<?php if($estado_proyecto==2){ ?>	
		<th>Evidencias</th>
		<?php }?>
	</tr>
<?php
	while ($row = mysqli_fetch_array($rs)) {

		$id_acti = $row['item_acti'];
		//muestra las evidencias en una tabla 
		$mostrar_e ="SELECT * FROM inex_evidencia WHERE item_acti ='$id_acti'";
		$ver_e =mysqli_query($con,$mostrar_e);
		if($row["valo_acti"]=='') $row["valo_acti"] = 0; 
?>

    <tr>
		<td><?php echo $row['nomb_acti'] ?></td>
		<td><?php echo $row['descripcion_a'] ?></td>
		<td><?php echo $row['fecha_ia'] ?></td>
		<td><?php echo $row['fecha_fa'] ?></td>
		<td><?php echo $row['valo_acti'] ?></td>
		<?php if($estado_proyecto==2){ ?>	 
		<td>  
	   	    <li title="Evidencia " class='material-icons'><a class="hoverable  modal-trigger blue-text" onclick="mostrarEvidenciaA(<?php echo $row['item_acti'] ?>)" href="#modal2">attach_file</a>
		</td>
		<?php }?>
	</tr> 
         
<?php } ?> 

	</table></div></div>
	</div>

	 <!-- botton aprobar corrregir proyectos;  2: estado al que cambiara el proyecto-->
	 <div class="center">
	   	<?php if($estado_proyecto==2){ ?>	 
			<a style = "display: none" class="btn green modal-trigger" type=""  href="#confirmPrueba">Aprobar Proyecto</a> 
	 		<a style = "display: none" class="btn red hoverable modal-trigger" id="" href="#corregirProyecto"  >Corregir Proyecto</a> 
		<?php }else{ ?>
			<a class="btn green modal-trigger" type=""  href="#confirmPrueba">Aprobar Proyecto</a> 
	 		<a class="btn red hoverable modal-trigger" id="" href="#corregirProyecto"  >Corregir Proyecto</a> 
		<?php } ?>
		</div>
	

	<!-- Modal enviar cometarios  -->
	<div id="corregirProyecto" class="modal"><br>
	<div class="center"><i class="large material-icons red-text">email</i></div>
		<br><br><div class="center"><h4 class="">COMENTARIOS</h4></div>
    <div class="modal-content">
	<span style="opacity: 0.5; " class="left">&nbsp;&nbsp;&nbsp;&nbsp;Los campos señalados con "*" son campos obligatorios</span>  
		<div class="row">
		<form class="col s12" id="formCorregir">
		<div class="row">
			<div class="input-field col s12">
			<textarea  required id="comentarioProyecto" class="materialize-textarea caracteresEpesiales validate" maxlength="1100"></textarea>
			<label for="comentarioProyecto">* Ingresar comentarios  </label>
			</div>
		</div>
		</form>
	</div>
	 <div class="center">
	 <button class="btn red" id="" onclick="visto(<?php echo $item?>, <?php echo $cero?>); corregirProyecto(3); ">Corregir Proyecto</button> 
	 </div> 
	</div>
    </div>

	<!-- Modal Structure -->
	<div id="modal1" class="modal">
    <div class="modal-content">
       <h5 class="center" >¿Estás seguro de eliminar esta actividad?</h5>
	 <div class="center">
	   <a href="dataBase/eliminar_actividad.php?id=<?php echo $id_acti ?>&id_proy=<?php echo $item ?>"class="btn-small red">Si</a>
	   <a href="#!" class="modal-close waves-effect waves-green btn-flat btn-small orange">No</a>
	 </div> 
	</div>
    </div>

	<!--  confirmacion enviar proyecto -->
	<div id="confirmPrueba" class="modal">
    <div class="modal-content">
       <h5 class="center" >¿Estás seguro de aprobar este proyecto?</h5>
	 <div class="center">
	   <button onclick="cambiaEstado(2)"  id="aprobar_proy" type="button" class="btn-small red">Si</button>
	   <a href="#!" class="modal-close waves-effect waves-green btn-flat btn-small orange">No</a>
	 </div> 
	</div>
    </div>

	<!-- Modal Structure -->
	<div id="modal3" class="modal">
    <div class="modal-content">
       <h5 class="center" >¿Estás seguro de eliminar esta actividad?</h5>
	 <div class="center">
	   <a href="dataBase/eliminar_proyecto.php?id_p=<?php echo $item ?>" class="btn-small red">Si</a>
	   <a href="#!" class="modal-close waves-effect waves-green btn-flat btn-small orange">No</a>
	 </div> 
	</div>
    </div>

	<!-- Modal para agregar arcivos -->
	<div id="modal2" class="modal ">
		<br><br>
		<div class="center"><i class="large material-icons teal-text">download</i></div>
		<div class="center"><h4 class="">DESCARGAR EVIDENCIAS</h4></div>

		<div class="container section">
		<table class="responsive-table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Archivo</th>
					<th>Lista  de Opciones</th>			
				</tr>
		   </thead>
		   <tbody id="mostrarEvidenciaA2">
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
</script>
 
</body>

</html>

<?php 

}else{
	session_destroy();
	header('location: ../');
}

mysqli_close($con); 
?>