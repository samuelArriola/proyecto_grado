<?php
	
	
	$item = $_GET['id'];


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
	$sql = "select *
	,(select concat(nomb_usua,' ',apel_usua) from inex_usuarios where iden_usua = a.jefe_proy) AS responsable, a.esta_proy
	 from inex_proyectos as a where a.item_proy = '".$item."'";
	$rs = mysqli_query($con, $sql); 

	
	
	//muestra las independencias
	$mostrar_i = "SELECT * FROM inex_dependencias";
	$resul_mi = mysqli_query($con,$mostrar_i);

	
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

<div class="teal-text">INFORMACION DEL PROYECTO</div> <br>
<div class="row">
	<div style="overflow-x: auto;"><div>

	<?php if ($row = mysqli_fetch_array($rs)) 
	{  $estado_proyecto = $row["esta_proy"]; 	?> 

	<!-- Modal cometarios  -->
	<div id="cometariosP" class="modal"> <br><br>
		<div class="center"><i class="large material-icons red-text">email</i></div>
		<br><div class="center"><h4 class="">COMENTARIOS</h4></div>
    <div class="modal-content">
		<div class="row">
			<div class="input-field col s12">
			<textarea  class="materialize-textarea caracteresEpesiales validate" maxlength="1100"><?php echo $row['comentarios_p'] ?></textarea>
			<label for="comentarioProyecto">Comentarios</label>
			</div> <br> <br><br>
		</div>
	</div>
    </div>
	
    <form id="">
	<span style="opacity: 0.5;" >Los campos señalados con "*" son campos obligatorios</span> 
	<div class="input-field col s12">
	<b>Nombre del proyecto:</b> 
	   <input  type="hidden" value="<?php echo $item ?>" id="id_pro">
	   <input value = "<?php echo $row["nomb_proy"] ?>" name="nombre_proye" id="nombre_proye" type="text" class="validate caracteresEpesiales"> 
		<div style="text-align: center; margin-top: -75px; margin-left: 93%;"><?php echo $icon_estado[$row["esta_proy"]] ?><div style="font-size: 0.7em; margin-top: 8px;"> <?php echo $desc_estado[$row["esta_proy"]] ?></div></div>
		<?php if($estado_proyecto==3){ ?>	
			<div style="text-align: center; margin-top: -49px; margin-left: 75%;">
			 <li title="COMETARIOS" class='material-icons'><a class="hoverable  modal-trigger red-text" href="#cometariosP">comment</a></li>
			<div style="font-size: 0.7em; margin-top: 10px;"> Comentarios</div></div>			
		<?php } ?>
	</div>

	<div class="input-field col s12">
	<b>Descripción del proyecto:</b>
	   <textarea name="descripcion_proye" id="descripcion" class="materialize-textarea caracteresEpesiales"><?php echo $row["desc_proy"]?> </textarea>
	</div>

	<div class="input-field col s6">
        <input type="text" value = "<?php echo $row['fecha_ip'] ?>" class="datepickerE1 validate" name="fecha_ip"  id="datepickerE1" required >
          <label for="datepicker1">* Fecha Inicial </label>
        </div>
        <div class="input-field col s6">
        <input type="text" value = "<?php echo $row['fecha_fp'] ?>" class="datepickerE2 validate" name="fecha_fp"  id="datepickerE2"  required>
          <label for="datepicker2">* Fecha Final </label>
        </div>

	<div class="col s12"> 
         <b>Escoja la dependencia a la que pertenece el proyecto</b>
        <select class="browser-default" name="dependencia" id="dependencia">
		<?php while ($row_mi=mysqli_fetch_array($resul_mi)) {?>
			<option value="<?php echo $row_mi['item_dep']?>"><?php echo $row_mi['nombre_dep'] ?></option>
			<?php if ($row["item_dep"]==$row_mi['item_dep']) { ?>
				 <option value="<?php echo $row_mi['item_dep']?>"selected ><?php echo $row_mi['nombre_dep'] ?></option>
			<?php }?>
         <?php } ?>
		
        </select>

		
    </div>
	
	<div class="input-field col s12">
	<b>Lider a Cargo:</b> 
	   <input disabled value = "<?php echo $row["responsable"] ?>" name="lider_proye" id="lider_proye" type="text" class="validate">
	</div>
	
	<div class="input-field col s12">
	<div class="center">
        <?php if($estado_proyecto==1 || $estado_proyecto==2){ ?>	 
		  <button class="btn orange" id="actualizar" disabled='disabled' >Actualizar</button> 
		  <?php } else if($estado_proyecto==0 || $estado_proyecto==3){ ?>
			   <button class="btn orange" id="actualizar" >Actualizar</button>
			   <?php if($estado_proyecto==0){ ?>	
				 <a class="btn red modal-trigger " id="eliminar_p" href="#modal3">eliminar</a> 

				<?php } ?> 
		  <?php } ?> 
	</div>
    </div>
	</form>
  <?php	} ?>
</div>

</div>

<div id="container_actividades">
<?php
	$sql = "select *
	 from inex_actividades as a where a.item_proy = '".$item."'";
	$rs = mysqli_query($con, $sql);
?>
	<div class="row">
	<div class="teal-text">INFORMACIÓN DEL ACTIVIDADES</div>
	<div style="overflow-x: auto;"><table>
	<tr>
		<th>Actividad</th>
		<th>Descripción</th>
		<th>Fecha Inicial</th>
		<th>Fecha Final</th>
		<th>Valor</th>
		<th>Opciones</th>
		
	</tr>
<?php
	while ($row = mysqli_fetch_array($rs)) {

		$id_acti = $row['item_acti'];

		if($row["valo_acti"]=='') $row["valo_acti"] = 0; 
?>
	 <input  type="hidden" value="<?php echo $id_acti ?>" id="id_actividadA">  <!--id del la consulta de acticidades -->
    <tr>
		<td><?php echo $row['nomb_acti'] ?></td>
		<td><?php echo $row['descripcion_a'] ?></td>
		<td><?php echo $row['fecha_ia'] ?></td>
		<td><?php echo $row['fecha_fa'] ?></td>
		<td><?php echo $row['valo_acti'] ?></td>

		<?php if($estado_proyecto==1 || $estado_proyecto==2){ ?>	 
		 <td >  
		   <?php if($estado_proyecto==2){ ?>	
	   	    <li title="Evidencia " class='material-icons'><a class="hoverable  modal-trigger blue-text" onclick="mostrarEvidenciaA();" href="#modal2">attach_file</a>
			<?php } ?>
			<li  title="Editar" class='material-icons ' style="pointer-events:none; color:#999999; opacity:0.9;" ><a  class="hoverable grey-text " href="editar_actividad.php?id=<?php echo $item ?>&id_a=<?php echo $id_acti ?>">edit</a></li>
			<li  title="Eliminar" class='material-icons' style="pointer-events:none; opacity:0.6;" ><a  class="hoverable  modal-trigger grey-text "  href="#modal1">delete</a></li>
		</td>
		<?php } else if($estado_proyecto==0 || $estado_proyecto==3){ ?>
		<td>
			<li title="Editar" class='material-icons'><a class="hoverable  orange-text" href="editar_actividad.php?id=<?php echo $item ?>&id_a=<?php echo $id_acti ?>">edit</a></li>
			<li title="Eliminar" class='material-icons'><a class="hoverable  modal-trigger red-text" href="#modal1">delete</a></li>
		</td> 
		<?php } ?> 
		
	</tr> 
         
<?php } ?> 

	</table></div></div>
	</div>

	 <!-- botton enviar proyectos -->
	<div class="center">
		<?php if($estado_proyecto==1 || $estado_proyecto==2){ ?>	 
			<button class="btn disabled" id=""  onclick="cambiaEstado(1)" >Enviar Proyecto</button> 
		<?php } else if($estado_proyecto==0 || $estado_proyecto==3){ ?>
				<button class="btn orange" id="" onclick="cambiaEstado(1)" >Enviar Proyecto</button> 
		<?php } ?> 		
	</div>

	
    <?php if($estado_proyecto==1 || $estado_proyecto==2){ ?>	 
		<div class="fixed-action-btn" > 
	<a  class="btn-floating btn-large waves-effect waves-light orange  tooltipped  modal-trigger" disabled='disabled' href="crear_actividad.php?id=<?php echo $item ?>"  data-position="top"  data-tooltip="AGREGAR ACTIVIDAD"  id="flotante2" ><i class="material-icons">add</i></a>
		  <?php } else if($estado_proyecto==0 || $estado_proyecto==3){ ?>
			<div class="fixed-action-btn" > 
	<a  class="btn-floating btn-large waves-effect waves-light orange  tooltipped  modal-trigger" href="crear_actividad.php?id=<?php echo $item ?>"  data-position="left"  data-tooltip="AGREGAR ACTIVIDAD"  id="flotante2" ><i class="material-icons">add</i></a>
		  <?php } ?> 
		  

 

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
		<div class="modal-content" >
		 <div class="center"><h4 class="">Subir evidencias</h4></div> <br>
		<form action="" method="" enctype="multipart/form-data" id="subirEvidencia" >
			<div class="row">  
			<span style="opacity: 0.5;" >Los campos señalados con "*" son campos obligatorios</span>  <br>
				<div class="input-field col s6">
					<input placeholder="Ingrese el nombre de la evidencia" name="nombre_a" id="first_name_e" type="text" class="validate" required>
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
					<input value="<?php echo $id_acti ?>" name="item_acty" type="hidden" class="validate" type="text" required>
				</div>
			</div>
			  <div class="center"><button class="btn orange"  type="button" onclick="subirEvidenciaA()">Subir </button></div>
		</form>
		</div> <br><br>

		<div class="center"><h4 class="">Descargar evidencias</h4></div>

		<div class="container section">
		<table class="responsive-table">
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
 
</body>

</html>

<?php mysqli_close($con); ?>