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

<div class="teal-text">INFORMACION DEL PROYECTO</div>

<div class="row">
	<div style="overflow-x: auto;"><div>

	<?php if ($row = mysqli_fetch_array($rs)) 
	{  $estado_proyecto = $row["esta_proy"]?> 
	
    <form >
	
	<div class="input-field col s12">
	<b>Nombre del proyecto:</b> 
	   <input  type="hidden" value="<?php echo $item ?>" id="id_pro">
	   <input value = "<?php echo $row["nomb_proy"] ?>" name="nombre_proye" id="nombre_proye" type="text" class="validate">
	<div style="text-align: center; margin-top: -75px; margin-left: 93%;"><?php echo $icon_estado[$row["esta_proy"]] ?><div style="font-size: 0.7em; margin-top: 8px;"> <?php echo $desc_estado[$row["esta_proy"]] ?></div></div></div>
	
	<div class="input-field col s12">
	<b>Descripción del proyecto:</b>
	   <textarea name="descripcion_proye" id="descripcion" class="materialize-textarea"><?php echo $row["desc_proy"]?> </textarea>
	</div>

	<div class="col s12"> 
         <b>Escoja la dependencia a la que pertenece el proyecto</b>
        <select class="browser-default" name="dependencia" id="dependencia">
		 <?php if ( $row["item_dep"]==1) {		
           echo' <option value="1" selected >Investigación</option>
			<option value="2">Proyección Social</option>';
		 }else if( $row["item_dep"]==2){ 
			echo'<option value="1" >Investigación</option>
			<option value="2"selected>Proyección Social</option>';
		  }?>
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
		<th>Fecha Inicial</th>
		<th>Fecha Final</th>
		<th>Valor</th>
		<th>Estado</th>
		<th>Opciones</th>
		
	</tr>
<?php
	while ($row = mysqli_fetch_array($rs)) {

		$id_acti = $row['item_acti'];

		$dura = ''; 
		if($row["dias_acti"] <= 1){
			$dura = $row["dias_acti"] . ' Día';
		}else{
			if($row["dias_acti"] < 7){
				$dura = $row["dias_acti"] . ' Días';	
			}else{
				if($row["dias_acti"] % 7 == 0){
					if($row["dias_acti"]/7 > 1) $dura = $row["dias_acti"]/7 . ' Semanas';
					else $dura = $row["dias_acti"]/7 . ' Semana';
				}else{
					$dura = $row["dias_acti"] . ' Días'; 
				}
			}
		}
		if($row["valo_acti"]=='') $row["valo_acti"] = 0; 
?>

    <tr>
		<td><?php echo $row['nomb_acti'] ?></td>
		<td><?php echo $row['fecha_ia'] ?></td>
		<td><?php echo $row['fecha_fa'] ?></td>
		<td><?php echo $row['valo_acti'] ?></td>
		<td><?php echo $row['esta_acti'] ?></td>

		<?php if($estado_proyecto==1 || $estado_proyecto==2){ ?>	 
		 <td> 
			<li title="Editar" class='material-icons'><a class="hoverable orange-text" disabled='disabled' href="editar_actividad.php?id=<?php echo $item ?>&id_a=<?php echo $id_acti ?>">edit</a></li>
			<li title="Eliminar" class='material-icons'><a class="hoverable  modal-trigger red-text" disabled='disabled' href="#modal1">delete</a>
		</td>
		<?php } else if($estado_proyecto==0 || $estado_proyecto==3){ ?>
		<td>
			<li title="Editar" class='material-icons'><a class="hoverable  orange-text" href="editar_actividad.php?id=<?php echo $item ?>&id_a=<?php echo $id_acti ?>">edit</a></li>
			<li title="Eliminar" class='material-icons'><a class="hoverable  modal-trigger red-text" href="#modal1">delete</a>
		</td> 
		<?php } ?> 
		
	</tr> 
         
<?php } ?> 

	</table></div></div>
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
	   <a href="eliminar_actividad.php?id=<?php echo $id_acti ?>&id_proy=<?php echo $item ?>"class="btn-small red">Si</a>
	   <a href="#!" class="modal-close waves-effect waves-green btn-flat btn-small orange">No</a>
	 </div> 
	</div>
  </div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/funciones.js?t=<?php echo time(); ?>"></script> 
<script src="funciones.js"></script> 
 
</body>

</html>

<?php mysqli_close($con); ?>