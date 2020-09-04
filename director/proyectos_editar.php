<?php
extract($_GET);
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
	,(select concat(nomb_usua,' ',apel_usua) from inex_usuarios where iden_usua = a.jefe_proy) AS responsable
	 from inex_proyectos as a where a.item_proy = '".$item."'";
	$rs = mysqli_query($con, $sql);
	$html = '<div class="container">
	<div class="teal-text">INFORMACION DEL PROYECTO</div>';
	$html = $html . '<div class="row">
	<div style="overflow-x: auto;"><table>';
	if ($row = mysqli_fetch_array($rs)) {
		$html = $html . '<tr>';
		$html = $html . '<td><b>Nombre del proyecto:</b> '.$row["nomb_proy"].'</td>';
		$html = $html . '<td style="text-align: center;">
		'.$icon_estado[$row["esta_proy"]].'
		<div style="font-size: 0.7em; margin-top: 8px;">'.$desc_estado[$row["esta_proy"]].'</div></td>';
		$html = $html . '</tr>';
		$html = $html . '<tr>';
		$html = $html . '<td colspan="2"><b>Descripción del proyecto:</b> '.$row["desc_proy"].'</td>';
		$html = $html . '</tr>';
		$html = $html . '<tr>';
		$html = $html . '<td colspan="2"><b>Responsable del proyecto:</b> '.$row["responsable"].'</td>';
		$html = $html . '</tr>';
	}
	$html = $html . '</table></div>
	</div>';
	echo $html;

	$sql = "select *
	 from inex_actividades as a where a.item_proy = '".$item."'";
	$rs = mysqli_query($con, $sql);

	$html = '<div class="row">
	<div class="teal-text">INFORMACIÓN DEL ACTIVIDADES</div>
	<div style="overflow-x: auto;"><table>';
	$html = $html . '<tr>';
		$html = $html . '<th>Duración</th>';
		$html = $html . '<th>Actividad</th>';
		$html = $html . '<th>Valor</th>';
		$html = $html . '<th>Estado</th>';
		$html = $html . '</tr>';
	while ($row = mysqli_fetch_array($rs)) {
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
		$html = $html . '<tr>';
		$html = $html . '<td>'.$dura.'</td>';
		$html = $html . '<td>'.$row["nomb_acti"].'</td>';
		$html = $html . '<td>$ '.number_format($row["valo_acti"],2,',','.').'</td>';
		$html = $html . '<td>'.$row["esta_acti"].'</td>';
		$html = $html . '</tr>';
	}
	$html = $html . '</table></div></div>
	</div>';
	echo $html;

	mysqli_close($con);
	?>
