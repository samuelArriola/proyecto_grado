<?php 
session_start();
###############################
//se incluye archivo functions.php
include "functions.php";
###############################
header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
header("Content-type: application/json; charset=utf-8");
###############################
extract($_GET);
//se verifica si existe variable $ixDs y si tiene valor booleano true.
if(isset($ixDs) && $ixDs == true){
	header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
	header("Content-type: application/json; charset=utf-8");
	//se verifica si codigo es igual a la variable ReSeT_code.
	if($code == $_SESSION['ReSeT_code']){
		//Se crea variable ReSeT_KeY y se genera codigo.
		$_SESSION['ReSeT_KeY'] = generateCode(); 
		//se da como respuesta verdadero.
		echo json_encode(true); 
	}else{
		//se da como respuesta falso.
		echo json_encode(false);
	}
	//terminamo procedimiento.
	exit;
}
###############################
error_reporting(0);
require_once('nusoap/nusoap.php');
//se inicializa variable rs y result = false.
$rs;
$result = false;
//se verifica que las variables $fOgH, $phone y $email no esten vacia.
if(!empty($fOgH) || (!empty($phone) && !empty($email))){
	//se verifica si variable $type es igual 0.
	//0 => valida correo alternativo y telefono.
	//otro valor, solo valida el correo alternativo o telefono personal.
	if($type == 0){
		//se verifica que el codigo registrado es igual al codigo almacenado.		
		if($email == $_SESSION['code1'] && $phone == $_SESSION['code2']){
			//se verifica si existe variable AccOunt_UpDaTe y si es verdadero
			//esto define si se actualiza o se crea cuenta institucional.
			if(isset($_SESSION['AccOunT_UpDaTe']) && $_SESSION['AccOunT_UpDaTe']){
				$rs = updateAccount();
			}else{
				$rs = addAccount();
			}			
		}else{
			echo json_encode(false); exit;
		}
	}else{
		if($fOgH == $_SESSION['code1']){
			if(isset($_SESSION['AccOunT_UpDaTe']) && $_SESSION['AccOunT_UpDaTe']){
				$rs = updateAccount();
			}else{
				$rs = addAccount();
			}
		}else{
			echo json_encode(false); exit;
		}
	}
} 

//la variable $rs recibe la respuesta de la funciones updateAccount() o addAccount().
//se verifica que la variable no sea igual false.
if($rs != false){
	//se verifica si variable de session AccOunt_EmAiL no esta vacia.
	//se envia mensaje al correo.
	//si esta vacia envia mensaje de texto al telefono.
	//el contenido del mensaje es informacion del usuario y contraseña.
	if(!empty($_SESSION['AccOunt_EmAiL'])){
		$subject = "Cuenta institucional";
		$message = "<h3>Felicidades, <strong>".$rs["Nombres"]." ".$rs["Apel_pers"]."</strong></h3>";
		$message .= "Has creado tu cuenta institucional.<br><br>";
		$message .= "Usuario: ".$rs["Email"]."<br>Contraseña: ".$rs["Clave"]."<br>";
		if(isset($_SESSION['AccOUnt_PaTh']) && !empty($_SESSION['AccOUnt_PaTh'])){
			$message .= "Esta cuenta se sincroniza con Google Suites y con nuestro sistema académico Universitas Internacional.<br> Este proceso puede tardar hasta 4 horas en aprovisionarse.<br>Después de este tiempo puede disfrutar los servicios de Google Suite y Universitas Internacional.";
			$message .= "<br>Lo invitamos a revisar las <a href='https://unicurn.sharepoint.com/sites/public/_layouts/15/guestaccess.aspx?docid=0395524714ede4c5f92ebcc66d2e1bd93&authkey=AcWqGLb4FYRN5vT9WEf6iy0'>Normas de uso del correo institucional</a>.";
		}else{
			$message .= "Esta cuenta se sincroniza con nuestro sistema académico Universitas Internacional. <br>Este proceso puede tardar hasta 4 horas en aprovisionarse.<br> Después de este tiempo puede utilizar los servicios de Universitas Internacional.";
		}
		$message .= "<br><br>Puede utilizar nuestro <a href='http://auth.curnvirtual.edu.co/'>autoservicio para cambiar la contraseña</a> disponible en nuestro <a href='https://portal.curn.edu.co/'>Portal</a>.";
		
		$message .="<br><br>Cordialmente,<br>Equipo TIC<br>Corporación Universitaria Rafael Núñez.";
		
		$result = sendEmail($_SESSION['AccOunt_EmAiL'], $message, $subject);
	}else{
		$message = "Usuario:%20".$rs['Email']."%20Clave:%20".$rs['Clave'];
		$result = sendPhone($_SESSION['AccOunt_PhOnE'], $message);
	}
}

//se crea la variable $enviado y se almacena a donde se envio la informacion de la cuenta institucional.
$enviado = (!empty($_SESSION['AccOunt_EmAiL']))? $_SESSION['AccOunt_EmAiL']:$_SESSION['AccOunt_PhOnE'];
session_destroy();

//la variable $result recibe la respuesta de la funciones sendEmailt() o sendPhone().
//se verifica que la variable sea verdadera.
//se muestra como resultado:
//verdadero => json con los datos nombre,email,clave,enviado.
//falso => json con dato false.
if($result){
	echo json_encode(array("nombre" => $rs['Nombres']." ".$rs['Apel_pers'], 
							"email" => $rs['Email'],
							"clave" => $rs['Clave'],
							"enviado" => $enviado));
}else{
	echo json_encode($result);
} 

?>
