<?php 
session_start();
$_SESSION['ReSeT_code'] = "";
$_SESSION['ReSeT_UiD'] = "";
$_SESSION['ReSeT_EmAiL'] = "";
###########################
include "functions.php";
###########################
error_reporting(0);
require_once('nusoap/nusoap.php');
extract($_POST);
$rs;

$client = new nusoap_client("https://atlas.curn.edu.co/wsldap/ServiceLDAP.svc?wsdl", true);
$client->soap_defencoding = 'UTF-8';
$client->decode_utf8 = false;
$err = $client->getError();

if($err){
	echo $err;
	exit;
}

$rs = $client->call("getEmailAlt", array("uid" => $_POST["user"], "emailalt" => $_POST['oIDx']));

header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
header("Content-type: application/json; charset=utf-8");

if($rs['getEmailAltResult']){
	$_SESSION['ReSeT_code'] = generateCode();
	$_SESSION['ReSeT_UiD'] = $_POST['user'];
	$_SESSION['ReSeT_EmAiL'] = $_POST['oIDx'];

	$subject = "Código de verificación para restablecer cuenta";
	$message = "Hola,<br><br> Tu código de verificación es: <b>" . $_SESSION['ReSeT_code'] . "</b><br><br>Gracias,<br>Corporación Universitaria Rafael Núñez";

	$rs = sendEmail($_POST['oIDx'], $message, $subject);
	if($rs){ 
		echo json_encode(true);
	}else{
		$_SESSION['ReSeT_code'] = "";
		$_SESSION['ReSeT_UiD'] = "";
		$_SESSION['ReSeT_EmAiL'] = "";
		session_destroy();
		echo json_encode(false);
	}
}else{
	echo json_encode(false);
}	
 ?>

