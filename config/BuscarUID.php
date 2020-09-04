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
//se busca si existe usuario.
//
$rs = $client->call("BuscarUID", array("usuario" => $usuario,"cn" => $cn));

header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
header("Content-type: application/json; charset=utf-8");

//se verifica si campo Email es vacio.
if(empty($rs['BuscarUIDResult']['Email'])){
	//se muestra como respuesta json con los datos error = true y msg.
	echo json_encode(array("error" => true, "msg" => $rs['BuscarUIDResult']['Msg_info']));
}else{
	//se verifica si la variable denied no es vacia.
	if (!empty($denied)) {
		//se valida si la direccion del usuario buscado es igual a los de la variable denied.
		//si son iguales es un usuario sin privilegios.
		//se muestra como respuesta json con los datos denied = true y msg = 'usuaruis sin privilegios'.
		$direccion = $rs['BuscarUIDResult']['Direccion'];
		foreach ($denied as $cn) {
			if($pos = strpos($direccion, $cn)){
				echo json_encode(array("denied" => true, "msg" => "Usuario sin privilegios."));
				exit;
			}
		}
	}	
	//se crea las variables de session EMAIL y DIRECCION
	//se muestra como respuesta json los datos error = false y email.
	session_start();
	$_SESSION['EMAIL'] = $rs['BuscarUIDResult']['Email'];
	$_SESSION['DIRECCION'] = $rs['BuscarUIDResult']['Direccion'];
	echo json_encode(array("error" => false, "email" => $rs['BuscarUIDResult']['Email']));
}
?>