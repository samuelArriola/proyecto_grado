<?php 
include "functions.php";
################################
error_reporting (0);
require_once('nusoap/nusoap.php');
extract($_GET);
session_start();
$_SESSION['AccOunt_EmAiL'] = "";
$_SESSION['AccOunt_PhOnE'] = "";
if(!empty($jHXi) || (!empty($phone) && !empty($email))){
	$code = 0; $rs = false;
	switch ($type) {
		case '1':
			$code = generateCode();
			$_SESSION['code1'] = $code;
			$_SESSION['AccOunt_EmAiL'] = $jHXi;

			$subject = "Código de verificación";
			$message = "Hola,<br><br> Tu código de verificación es: <b>".$code."</b><br><br>Gracias,<br>Corporación Universitaria Rafael Núñez";

			$rs = sendEmail($jHXi, $message, $subject);
			break;
		case '2':
			$code = generateCode();
			$_SESSION['code1'] = $code;
			$_SESSION['AccOunt_PhOnE'] = $jHXi;

			$message = "Tu%20codigo%20es:%20".$code;
			$rs = sendPhone($jHXi, $message);
			break;
		case '0':
			$code = generateCode();
			$_SESSION['code1'] = $code;
			$_SESSION['AccOunt_EmAiL'] = $email;

			$subject = "Código de verificación";
			$message = "Hola,<br><br> Tu código de verificación es: <b>".$code."</b><br><br>Gracias,<br>Corporación Universitaria Rafael Núñez";
			$rs = sendEmail($email, $message, $subject);

			$code = generateCode();
			$_SESSION['code2'] = $code;
			$_SESSION['AccOunt_PhOnE'] = $phone;

			$message = "Tu%20codigo%20es:%20".$code;
			$rs = sendPhone($phone, $message);
			break;
	}


	header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
	header("Content-type: application/json; charset=utf-8");

	if($rs){
		echo true;exit;
	}else{
		echo false;exit;
	}
}


?>