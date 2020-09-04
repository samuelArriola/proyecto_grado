<?php 
session_start();
if(isset($_POST['okFK']) && !empty($_POST['okFK'])){
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

	$rs = $client->call("setAutorizacion", array("bd" => $_POST["bd"],
												"usuario" => $_SESSION['AccOUnt_DnI'],
												"source" => "appCuenta", "ip" => ""));

	header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
	header("Content-type: application/json; charset=utf-8");

	if($rs['setAutorizacionResult'] == 1){
		echo json_encode(true);
	}else{
		echo json_encode(false);
	}
}
?>