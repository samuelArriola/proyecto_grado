<?php
extract($_GET);
include("dbadmisiones.php");
$sql = "SELECT * FROM usuarios WHERE iden_usua = '".$iden."' AND esta_usua = 1";
$rs = mysqli_query($con,$sql);
if($fila = mysqli_fetch_array($rs))
	{
	session_start();
	$_SESSION["IDEN"]=$iden;
	$_SESSION["NOMB"]=$usua;
	$_SESSION["ROLE"]=$fila["role_usua"];
	$resul = array("error" => false);
	}
else{
	$resul = array("error" => true, "msg" => "Error: Su cuenta no posee los privilegios para acceder.");
	}
if(!isset($opc)) echo json_encode($resul);
mysqli_close($con);
?>