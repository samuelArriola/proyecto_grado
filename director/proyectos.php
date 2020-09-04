	<?php
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
	$sql = "select * from inex_proyectos";
	$rs = mysqli_query($con, $sql);
	$html = '<div class="container">
	<div class="teal-text">REGISTROS DE PROYECTOS</div>
	<div class="row"><div style="overflow-x: auto;"><table>';
	while ($row = mysqli_fetch_array($rs)) {
		$html = $html . '<tr>';
		$html = $html . '<td>'.$row["item_proy"].'. '.$row["nomb_proy"].'</td>';
		$html = $html . '<td style="text-align: center;">
		<a class="btn-floating waves-effect waves-light '.$color_estado[$row["esta_proy"]].'" href="javascript: proyectos_editar(\''.$row["item_proy"].'\')">
		'.$icon_estado[$row["esta_proy"]].'</a>
		<div style="font-size: 0.8em;">'.$desc_estado[$row["esta_proy"]].'</div></td>';
		$html = $html . '</tr>';
	}
	$html = $html . '<table></div></div></div>';
	echo $html;
	mysqli_close($con);
	?>