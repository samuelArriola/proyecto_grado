<?php 
session_start();
session_destroy();
session_start();
//se usa la funcion extract() para estraer todas las variables recibidas por el metodo POST
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
//se verifica si existe cuenta de estudiante, con el metodo valAproicionCuenta.
//se manda los parametrosd dni y el tipo, en este caso 1 = estudiante.
$rs = $client->call("valAprovicionCuenta", array("dni"=> $dni,
										"tipo" => "1"));

$msg = "";
//switch case para verificar estado de la cuenta del estudiante.
//0: no se encontro
//1: estudiante adminito, pero no tiene cuenta.
//2: existe cuenta institucional.
//3: expediente bloqueado.
//default: mensaje por defecto: estudiante no admitido.
switch ($rs['valAprovicionCuentaResult']['Msg_info']) {
	case '0':
		$msg = "Identificación no encontrada, verifique e intente nuevamente.";
		break;
	case '1':		
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
}	

//se guarda nombre y apellido
//usuario
//correo
//se inicializa variable de correo alternativo y telefono personal.
$nombre = $rs['valAprovicionCuentaResult']['Nombres']." ".$rs['valAprovicionCuentaResult']['Apel_pers'];
$usuario = explode("@", $rs['valAprovicionCuentaResult']['Email']);
$usuario = $usuario[0];
$correo = $rs['valAprovicionCuentaResult']['Email'];
$emailalt = "";$phone = "";

//se verifica si existe cuenta institucional, buscar si tiene registrado correo alternativo y telefono personal
if($rs['valAprovicionCuentaResult']['Msg_info'] == "2"){
	//buscamos correo alternativo.
	$emailalt = $client->call("getEmailAlt", array("uid"=> $usuario,
										"emailalt" => "0"));
	//buscamos numero de telefono personal.
	$phone = $client->call("getTelephone", array("uid"=> $usuario,
										"tele" => "0"));
	//si la cuenta no tiene registrado ninguno de los dos campos,
	//se crea variable de session para guardar:
	//usuario
	//datos => se almazena en una cadena de texto, nombre;apellido;correo.
	//update => se crea para indicar que se va a realizar actualizacion de la cuenta.
	if($emailalt['getEmailAltResult'] && $phone['getTelephoneResult']){
		$_SESSION['AccOunT_UsUaRiO'] = $usuario;
		$_SESSION['AccOunT_DaToS'] = $rs['valAprovicionCuentaResult']['Nombres'].";".$rs['valAprovicionCuentaResult']['Apel_pers'].";".$rs['valAprovicionCuentaResult']['Email'];
		$_SESSION['AccOunT_UpDaTe'] = true;
	}	
}
//se crea variable de session tipo = 1, indica que la cuenta que se va a crear es de estudiantes.
$_SESSION['AccOunt_TiPo'] = "1";

header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
header("Content-type: application/json; charset=utf-8");


//se muestra json con los datos
//msg => mensaje a mostrar.
//nombre => nombre del estudiante.
//usuario => usuario del estudiante.
//phone => valor booleano de la respuesta al buscar telefono.
//emailalt => valor booleano de la respuesta al buscar telefono alternativo.
//status => estado de la verificacion del aprovicionamiento de la cuenta.
echo json_encode(array("error" => false, 
				"msg" => $msg,
				"nombre" => $nombre,
				"usuario" => $usuario,
				"phone" => $phone['getTelephoneResult'],
				"emailalt" => $emailalt['getEmailAltResult'],
				"status" => $rs['valAprovicionCuentaResult']['Msg_info']));





?>