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
	
    <form id="">
	<span style="opacity: 0.5;" >Los campos señalados con "*" son campos obligatorios</span> 
	<div class="input-field col s12">
	<b>Nombre del proyecto:</b> 
	   <input  type="hidden" value="<?php echo $item ?>" id="id_pro">
	   <input disabled value = "<?php echo $row["nomb_proy"] ?>" name="nombre_proye" id="nombre_proye" type="text" class="validate caracteresEpesiales">
	<div style="text-align: center; margin-top: -75px; margin-left: 93%;"><?php echo $icon_estado[$row["esta_proy"]] ?><div style="font-size: 0.7em; margin-top: 8px;"> <?php echo $desc_estado[$row["esta_proy"]] ?></div></div></div>
	
	<div class="input-field col s12">
	<b>Descripción del proyecto:</b>
	   <textarea name="descripcion_proye" id="descripcion" disabled class="materialize-textarea caracteresEpesiales"><?php echo $row["desc_proy"]?> </textarea>
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
	   <div class="center"><button class="btn orange" id="actualizar" >Actualizar</button></div>
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
?><br>
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
		 <td >  
	   	    <li title="Evidencia " class='material-icons'><a class="hoverable  modal-trigger blue-text"  href="#modal2">attach_file</a>
			<li  title="Editar" class='material-icons ' style="pointer-events:none; color:#999999; opacity:0.9;" ><a  class="hoverable grey-text " href="editar_actividad.php?id=<?php echo $item ?>&id_a=<?php echo $id_acti ?>">edit</a></li>
			<li  title="Eliminar" class='material-icons' style="pointer-events:none; opacity:0.6;" ><a  class="hoverable  modal-trigger grey-text "  href="#modal1">delete</a></li>
		</td>
	</tr> 
         
<?php } ?> 

	</table></div></div>
	</div>

	 <!-- botton aprobar corrregir proyectos;  2: estado al que cambiara el proyecto-->
	 <div class="center">
	   	<?php if($estado_proyecto==2){ ?>	 
			<button disabled class="btn green" type="button" onclick="cambiaEstado(2)"  id="aprobar_proy" href="">Aprobar Proyecto</button> 
	 		<a disabled class="btn red hoverable modal-trigger" id="" href="#corregirProyecto"  >Corregir Proyecto</a> 
		<?php }else{ ?>
			<button class="btn green" type="button" onclick="cambiaEstado(2)"  id="aprobar_proy" href="">Aprobar Proyecto</button> 
	 		<a class="btn red hoverable modal-trigger" id="" href="#corregirProyecto"  >Corregir Proyecto</a> 
		<?php } ?>
		</div>
	

	<!-- Modal enviar cometarios  -->
	<div id="corregirProyecto" class="modal">
		<br><br><div class="center"><h4 class="">COMENTARIOS</h4></div>
    <div class="modal-content">
		<div class="row">
		<form class="col s12" id="formCorregir">
		<div class="row">
			<div class="input-field col s12">
			<textarea  required id="comentarioProyecto" class="materialize-textarea caracteresEpesiales validate" maxlength="1100"></textarea>
			<label for="comentarioProyecto">ingresar comentarios * </label>
			</div>
		</div>
		</form>
	</div>
	 <div class="center">
	 <button class="btn red" id="" onclick="corregirProyecto(3)"  >Corregir Proyecto</button> 
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
		   <tbody>
			<?php while ($row_e= mysqli_fetch_array($ver_e)) 
			{ ?>

				<tr>
					<td><?php echo $row_e['nombre_e'];?></td>
					<td><?php echo $row_e['ruta_e'];?></td>
					<td>
					 <li title="Descargar" class='material-icons'><a href="../lider/dataBase/<?php echo $row_e['ruta_e'];?>" download="<?php echo $row_e['ruta_e'];?>">file_download</a></li>
				     <!-- <li title="Editar" class='material-icons'><a class="hoverable  orange-text" href="editar_actividad.php?id=<?php echo $item ?>&id_a=<?php echo $id_acti ?>">edit</a></li>
					 <li title="Eliminar" class='material-icons'><a class="hoverable  red-text" href="dataBase/eliminar_evidencia.php?id_e=<?php echo $row_e['id_e']?>&ruta_e=<?php echo  $row_e['ruta_e'] ?>" >delete</a></li> -->
					</td>
				</tr>
			<?php }?>
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