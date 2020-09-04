<?php 	
if (isset($_GET["bd"]) && !empty($_GET['bd'])) {
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

	$rs = $client->call("getPermiso", array("bd" => $_GET["bd"]));

	echo $rs['getPermisoResult'];
}
?>