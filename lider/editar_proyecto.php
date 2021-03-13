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
	$queryLider = "SELECT u.iden_usua, u.nomb_usua, u.apel_usua, d.item_rol, d.item_dep, u.correo ,(SELECT nombre_dep FROM inex_dependencias WHERE item_dep = d.item_dep) as nombre_dep
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

	if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "C" || $_SESSION["ROLE"] == "L"){ 
		if ($_SESSION["ROLE"] == "L") {
			$eviarProyecto = "";
			$editarProyecto = "";
			$eliminarProyecto = "";
		}
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

<div class="teal-text">&nbsp;&nbsp;&nbsp;INFORMACION DEL PROYECTO</div> <br>
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
			<span class="container" maxlength="1100"><?php echo $row['comentarios_p'] ?></span>
			</div> <br> <br><br>
		</div>
	</div>
    </div>
	
    <form id="">
	<span style="opacity: 0.5;" >&nbsp;&nbsp;&nbsp;Los campos señalados con "*" son campos obligatorios</span> 
	<div class="input-field col s12">
	<b>Nombre del proyecto:</b> 
	   <input  type="hidden" value="<?php echo $item ?>" id="id_pro">
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
        <br> <b>* Lider a carga</b> <BR></BR>
		 <div class="center">
			 <a class='btn orange modal-trigger' href='#aggLider' onclick = "mostrarLiderP(<?php echo $item ?>)" >AGG LIDER</a>
		 </div>
            <select class="browser-default"  name="" id="liderAcargoA">
               	<?php 
                  while($row_co=mysqli_fetch_array($resul_correo)){
					$resultado="<option value='".$row_co['iden_usua']."' > ".$row_co['correo']."</option>";
					if($row['liderAcargo'] == $row_co['iden_usua']){
					  $resultado="<option value='".$row_co['iden_usua']."' selected > ".$row_co['correo']."</option>";
					}
					echo $resultado;
				  }    
               ?>
            </select>
     </div>
	
	<div class="input-field col s12">
	<b>Coordinador a cargo:</b> 
	   <input disabled value = "<?php echo $row["responsable"] ?>" name="lider_proye" id="lider_proye" type="text" class="validate">
	</div>
	
	<div class="input-field col s12">
	<div class="center">
        <?php if($estado_proyecto==1 || $estado_proyecto==2){ ?>	 
		  <button class="btn orange" id="actualizar" disabled='disabled' >Actualizar</button> 
		  <?php } else if($estado_proyecto==0 || $estado_proyecto==3){ 
			  	  echo $editarProyecto ;
			  ?>  
			   <?php if($estado_proyecto==0){	
				  echo $eliminarProyecto;
				} ?> 
			  <?php } ?> 
		  <?php if($estado_proyecto==3){ ?>	
			<a class="hoverable  modal-trigger red btn hide-on-med-and-up" href="#cometariosP">COMENTARIO</a>			
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
	<div class="teal-text">INFORMACIÓN DE LAS ACTIVIDADES</div>
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
	   	    <li title="Evidencia " class='material-icons'><a class="hoverable  modal-trigger blue-text" onclick="mostrarEvidenciaA(<?php echo $id_acti ?>);" href="#modal2">attach_file</a>
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
			<a class="btn disabled modal-trigger" href="#confirmP"   >Enviar Proyecto</a> 
		<?php } else if($estado_proyecto==0 || $estado_proyecto==3){ 
			 echo $eviarProyecto ;
		} ?> 		
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

	<!--  confirmacion enviar proyecto -->
	<div id="confirmP" class="modal">
    <div class="modal-content">
       <h5 class="center" >¿Estás seguro de enviar este proyecto?</h5>
	 <div class="center">
	   <a onclick="visto(<?php echo $item?>, <?php echo $visto?>, <?php echo $vistoL?> ); cambiaEstado(1)" class="btn-small red">Si</a>
	   <a href="#!" class="modal-close waves-effect waves-green btn-flat btn-small orange">No</a>
	 </div> 
	</div>
    </div>


	<!-- Modal Structure -->
	<div id="modal3" class="modal">
    <div class="modal-content">
       <h5 class="center" >¿Estás seguro de eliminar este proyecto?</h5>
	 <div class="center">
	   <a href="dataBase/eliminar_proyecto.php?id_p=<?php echo $item ?>" class="btn-small red">Si</a>
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
	
	<!-- Modal Structure elimina Evidencia  -->
	<div id="eliminarLiderP" class="modal">
		<div class="modal-content">
		<input  id="IdEvi" type="hidden">
		<input  id="IdRuta" type="hidden">
		<h5 class="center" >¿Estás seguro de eliminar este lider?</h5>
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
			<div class="row">  
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
			  <div class="center">
			  	  <button class="btn orange"  type="button" onclick="subirEvidenciaA()">Subir </button>
				  <a href="#!" class=" modal-close waves-effect waves-green btn-flat white-text red ">Atras</a>
			  </div>
		</form>
		</div> <br><br> 

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

	<!-- Agregar los lideres  -->
	<div id="aggLider" class="modal ">
		<div class="modal-content" >
		<div class="center"><i class="large material-icons teal-text">add</i></div>
		 <div class="center"><h4 class="">AGREGAR LIDERES</h4></div> <br> 
		<form action="" method="" enctype="multipart/form-data" id="" >
			<div class="row">  
			<span class="center-align" style="opacity: 0.5; position:relative; top: -15px" >&nbsp;&nbsp;&nbsp;&nbsp;Los campos señalados con "*" son campos obligatorios</span> <br>
				<div class="input-field col s6 offset-s3">
				<select class="browser-default"  name="" id="lideProyecto">
					<option value="" disabled selected>Seleccione</option>
					<?php while ($row_li=mysqli_fetch_array($resul_lider)) {?>
					<option value="<?php echo $row_li['iden_usua']?>"><?php echo $row_li['correo'] ?></option>
					<?php } ?>    
				</select>
				</div>
			</div>
			  <div class="center">
			  	  <button class="btn orange" id="aggLiderP"  type="button" onclick="">Agregar</button>
				  <a href="#!" onclick="" class=" modal-close waves-effect waves-green btn-flat white-text red ">Atras</a>
			  </div>
		</form>
		</div> <br><br> 


		<div class="center"><h4 class="">LIDERES A CARGO</h4></div>

		<div class=" section">
		<table class="container responsive-table">
			<thead>
				<tr>
					<th>Cedula</th>
					<th>Nombre</th>
					<th>Correo</th>
					<th>Lista  de Opciones</th>			
				</tr>
		   </thead>
		   <tbody id="mostrarLiderP">
			
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

<?php 

}else{
	session_destroy();
	header('location: ../');
}

mysqli_close($con); ?>