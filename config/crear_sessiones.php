<?php

include_once("conexion.php");
$iden = $_POST['iden'];
$role = $_POST['role']; 

// $sql = "SELECT * FROM inex_usuarios WHERE iden_usua = '$iden' ";
$sql ="SELECT u.iden_usua, u.nomb_usua, u.apel_usua, d.item_rol, d.item_dep
,(SELECT nombre_dep FROM inex_dependencias WHERE item_dep = d.item_dep) as nombre_dep 
FROM inex_usuarios u, inex_usuarios_roles d WHERE u.iden_usua = d.iden_usua AND u.iden_usua = '$iden' AND d.item_rol ='$role' ";
$rs = mysqli_query($con,$sql);

if($fila = mysqli_fetch_array($rs))
	{
	session_start();
	$_SESSION["IDEN"]=$fila["iden_usua"];
	$_SESSION["NOMB"]=$fila["nomb_usua"].' '.$fila["apel_usua"];
	$_SESSION["ROLE"]=$fila["item_rol"];
	$_SESSION["DEP"]=$fila["item_dep"];
	$_SESSION["NOM_D"]=$fila["nombre_dep"];

	$resul = array("error" => false,"nomb" => $_SESSION["NOMB"],"role" => $_SESSION["ROLE"]);
	}
else{
	$resul = array("error" => true, "msg" => "Su cuenta no posee los privilegios para acceder.");
	}
if(!isset($opc)) echo json_encode($resul);
mysqli_close($con);
?>