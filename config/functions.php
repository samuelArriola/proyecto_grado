<?php 
//funcion para enviar correo electronico
function sendEmail($email, $message, $subject){
	$client = new nusoap_client("https://atlas.curn.edu.co/wsldap/ServiceLDAP.svc?wsdl", true);
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$err = $client->getError();

	if($err){
		echo $err;
		exit;
	}
	
	$rs = $client->call("sendCorreo", array("correo" => $email, 
										"asunto" => $subject, 
										"mensaje" => $message));
	if($rs['sendCorreoResult'] == "Enviado"){
		return true;
	}else{
		return false;
	}
}

//funcion para enviar mensaje de texto a telefono
function sendPhone($phone, $message){
	
	$url = "https://sistemasmasivos.com/itcloud/api/sendsms/send.php?user=atencionalaspirante@curn.edu.co&password=7JlRjIOy5O&GSM=57".$phone."&SMSText=".$message;
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$result = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch); return $result;
	if($result > 0){
		return true;
	}else{
		return false;
	}
}

//funcion para crear cuenta
function addAccount(){
	$client = new nusoap_client("https://atlas.curn.edu.co/wsldap/ServiceLDAP.svc?wsdl", true);
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$err = $client->getError();

	if($err){
		return false;
		exit;
	}

	$rs = $client->call("AddAccount", array("dni" => $_SESSION['AccOUnt_DnI'], 
										"mailalt" => $_SESSION['AccOunt_EmAiL'], 
										"telefono" => $_SESSION['AccOunt_PhOnE'],
										"tipo" => $_SESSION['AccOunt_TiPo'],
										"pathdocente" => (isset($_SESSION['AccOUnt_PaTh'])&&!empty($_SESSION['AccOUnt_PaTh']))?$_SESSION['AccOUnt_PaTh']:""
									));

	return $rs['AddAccountResult'];
}

//function para actualizar datos: correo alternativo y numero de telefono.
function updateAccount(){
	$client = new nusoap_client("https://atlas.curn.edu.co/wsldap/ServiceLDAP.svc?wsdl", true);
	$client->soap_defencoding = 'UTF-8';
	$client->decode_utf8 = false;
	$err = $client->getError();

	if($err){
		return false;
		exit;
	}
	 
	 //se crean variables $bool1 y $bool2 con valor = "1".
	$bool1 = "1";$bool2 = "1";
	//se verifica si la variable AccOunt_EmAiL y AccOunt_UsUaRiO no estan vacia.
	if(!empty($_SESSION['AccOunt_EmAiL']) && !empty($_SESSION['AccOunT_UsUaRiO'])){	
		//se crea array con los datos uid, propiedad, valor
		//en este caso la propiedad es 'physicalDeliveryOfficeName'
		$params = 	array("uid" => $_SESSION['AccOunT_UsUaRiO'] , 
										"propiedad" => "physicalDeliveryOfficeName", 
										"valor" => $_SESSION['AccOunt_EmAiL']
									);
		//se llama el metodo EditAccount3 para actualizar correo alternativo.
		$rs = $client->call("EditAccount3", $params);
		//si campo Msg_info no es vacia se cambia valor a variable $bool1 a = "2".
		if($rs['EditAccount3Result']['Msg_info'] != ""){ $bool1 = "2"; }
	}else{ $bool1 = "3"; }

	//se verifica si la variable AccOunt_PhOnE y AccOunt_UsUaRiO no estan vacia.
	if(!empty($_SESSION['AccOunt_PhOnE']) && !empty($_SESSION['AccOunT_UsUaRiO'])){	
		//se crea array con los datos uid, propiedad, valor
		//en este caso la propiedad es 'telephoneNumber'
		$params = array("uid" => $_SESSION['AccOunT_UsUaRiO'], 
									"propiedad" => "telephoneNumber", 
									"valor" => $_SESSION['AccOunt_PhOnE']
								);
		//se llama el metodo EditAccount3 para actualizar telefono personal.
		$rs = $client->call("EditAccount3", $params);
		//si campo Msg_info no es vacia se cambia valor a variable $bool1 a = "2".
		if($rs['EditAccount3Result']['Msg_info'] != ""){ $bool2 = "2"; }
	}else{ $bool2 = "3"; }

	$result;$result2;
	if($bool1 == "2"){ $result = true; }else if($bool1 == "1"){ $result = true; }else{ $result = false; }
	if($bool2 == "2"){ $result2 = true; }else if($bool2 == "1"){ $result2 = true; }else{ $result2 = false; }

	if(($result && !empty($_SESSION['AccOunt_EmAiL'])) || ($result2 && !empty($_SESSION['AccOunt_PhOnE']))){
		$rs = $client->call("generarPwd");
		$clave = $rs['generarPwdResult'];
		$rs = $client->call("resetPassword", array("uid" => $_SESSION['AccOunT_UsUaRiO'], "newpwd" => $clave));
		$datos = explode(";", $_SESSION['AccOunT_DaToS']);
		$result = array('Nombres' => $datos[0], 'Apel_pers' => $datos[1], 'Email' => $datos[2], 'Clave' => $clave);
	}

	return $result;
}

//funcion para generar codigo
function generateCode(){
	$number = 4;
	$code = rand(pow(10, $number-1), pow(10, $number)-1);
	return $code;
}

?>