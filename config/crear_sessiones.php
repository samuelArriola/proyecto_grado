<?php
extract($_GET);
include("conexion.php");
//$sql = "SELECT * FROM inex_usuarios WHERE iden_usua = '".$iden."'";
$sql ="SELECT * FROM inex_usuarios u, inex_dependencias d WHERE u.item_dep = d.item_dep AND iden_usua = '".$iden."' ";
$rs = mysqli_query($con,$sql);
if($fila = mysqli_fetch_array($rs))
	{
	session_start();
	$_SESSION["IDEN"]=$fila["iden_usua"];
	$_SESSION["NOMB"]=$fila["nomb_usua"].' '.$fila["apel_usua"];
	$_SESSION["ROLE"]=$fila["role_usua"];
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