<?php 
session_start();
####################################
include "functions.php";
##########################
header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
header("Content-type: application/json; charset=utf-8");
if(isset($_SESSION['ReSeT_KeY'])){
	##########################
	error_reporting(0);
	require_once('nusoap/nusoap.php');

	$client = new nusoap_client("https://atlas.curn.edu.co/wsldap/ServiceLDAP.svc?wsdl", true);
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$err = $client->getError();

	if($err){
		echo $err;
		exit;
	}

	$rs = $client->call("resetPassword", array("uid" => $_SESSION['ReSeT_UiD'], "newpwd" => $_POST['dIsH']));

	if(!empty($rs['resetPasswordResult']['Email'])){
		$subject = "La contraseña del la cuenta institucional ha cambiado";
		$message = "Su contraseña de la cuenta ha cambiado recientemente.<br>";
		$message .= "Si usted no solicitó el cambio de contraseña, póngase en contacto con el equipo de asistencia del departamento TIC.<br>";
		$message .="<br><br>Bienvenido,<br>Corporación Universitaria Rafael Núñez.";
		$message .="<br><a href='https://www.curn.edu.co/'>www.curn.edu.co</a>";
		$result = sendEmail($_SESSION['ReSeT_EmAiL'], $message, $subject);

		$_SESSION['ReSeT_code'] = "";
		$_SESSION['ReSeT_UiD'] = "";
		$_SESSION['ReSeT_KeY'] = "";
		$_SESSION['ReSeT_EmAiL'] = "";
		session_destroy();
		echo json_encode($rs['resetPasswordResult']['Msg_info']);
	}else{
		$_SESSION['ReSeT_code'] = "";
		$_SESSION['ReSeT_UiD'] = "";
		$_SESSION['ReSeT_KeY'] = "";
		$_SESSION['ReSeT_EmAiL'] = "";
		session_destroy();
		echo json_encode(false);
	}
}else{
	$_SESSION['ReSeT_code'] = "";
	$_SESSION['ReSeT_UiD'] = "";
	$_SESSION['ReSeT_KeY'] = "";
	$_SESSION['ReSeT_EmAiL'] = "";
	$_SESSION['ReSeT_KeY'] = "";
	session_destroy();
	echo json_encode(false);
}

 ?>