<?php 
session_start();
//se separa correo usuario del dominio.
$usuario = explode("@", $_SESSION['EMAIL']);
//se guarda la direccion del usuario => cn=...
$direccion = $_SESSION['DIRECCION'];
//se destruye session, para evitar error en el proceso para iniciar sesion.
session_destroy();
//se inicializa las sessiones.
session_start();
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

//se realiza la autenticacion del usuario
//las variables enviadas son:
//*direccion
//*usuario
//*clave
$rs = $client->call("AutenticarPersona", array("direccion"=> $direccion,
										"usuario" => $usuario[0],
										"clave" => $clave));

header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
header("Content-type: application/json; charset=utf-8");
//si el campo Email esta vacia, contraseña incorrecta.
if(empty($rs['AutenticarPersonaResult']['Email'])){
	//se crean de nuevo las variable de session DIRECCION y EMAIL para que el usuario puede volver a intentar iniciar sesion.
	$_SESSION['DIRECCION'] = $direccion;
	$_SESSION['EMAIL'] = $usuario[0];
	//se muestra como respuesta json con los datos error = true y msg = 'Contraseña incorrecta'.
	echo json_encode(array("error" => true, "msg" => "Contraseña incorrecta."));
}else{
		$_SESSION['DIRECCION'] = $direccion;
		$_SESSION['EMAIL'] = $usuario[0];
		$iden = $rs['AutenticarPersonaResult']['Dni'];
		$usua = $usuario[0];
		//echo json_encode(array("error" => true, "msg" => $iden));
		//crear variable de session o cookie, depende de aplicacion en la que se implementa el login.
		include("crear_sessiones.php");
	}
?>