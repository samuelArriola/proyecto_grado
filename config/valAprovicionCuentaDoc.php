<?php 
extract($_POST);
error_reporting (0);
require_once('nusoap/nusoap.php');
$client = new nusoap_client("https://atlas.curn.edu.co/wsldap/ServiceLDAP.svc?wsdl", true);
$client->soap_defencoding = 'UTF-8';
$client->decode_utf8 = false;
$err = $client->getError();

if($err){
	echo $err;
	exit;
}

$rs = $client->call("valAprovicionCuenta", array("dni"=> $dni,
										"tipo" => "2"));

$msg = "";
switch ($rs['valAprovicionCuentaResult']['Msg_info']) {
	case '0':
		$msg = "Identificación no encontrada, verifique e intente nuevamente.";
		break;
	case '1':
		session_start();
		$_SESSION['AccOUnt_DnI'] = $dni;
		break;
	case '2':
		$msg = "Existe una cuenta, <strong>".$rs['valAprovicionCuentaResult']['Email']."</strong>";
		break;
	case '3':
		$msg = "Expediente bloqueado, comuníquese con el departamento de cartera.";
		break;
	default:
		$msg = $rs['valAprovicionCuentaResult']['Msg_info'];
		break;
}

session_start();	
$nombre = $rs['valAprovicionCuentaResult']['Nombres']." ".$rs['valAprovicionCuentaResult']['Apel_pers']." ".$rs['valAprovicionCuentaResult']['Apel2_pers'];
$usuario = explode("@", $rs['valAprovicionCuentaResult']['Email']);
$usuario = $usuario[0];
$correo = $rs['valAprovicionCuentaResult']['Email'];
$_SESSION['AccOUnt_PaTh'] = $rs['valAprovicionCuentaResult']['Dominio'];
$_SESSION['AccOunt_TiPo'] = "2";

header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
header("Content-type: application/json; charset=utf-8");

echo json_encode(array("error" => false, 
				"msg" => $msg,
				"nombre" => $nombre,
				"usuario" => $usuario,
				"correo" => $correo,
				"status" => $rs['valAprovicionCuentaResult']['Msg_info']));





?>