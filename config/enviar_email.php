<?php

error_reporting(E_ALL);
extract($_POST);

if(!isset($asunto)) $asunto = 'NOTIFICACIÓN INEX';

$curl = curl_init();
$data = array(
'asunto' => $asunto,
'correo' => $correo,
'mensaje' => $mensaje
);
curl_setopt_array($curl,array(
CURLOPT_URL => 'https://axis.curn.edu.co/apinotify/api/notifymail/notificabasica',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS => json_encode($data),
CURLOPT_HTTPHEADER => array('Content-Type: application/json')
)); 
$result = curl_exec($curl);
echo $result;
//close cURL resource
curl_close($curl);
?>
