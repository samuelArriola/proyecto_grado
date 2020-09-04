<?php
extract($_GET);
if(!isset($iden))
	{
	session_start();
	$_SESSION["IDEN"]='73429694';
	$_SESSION["NOMB"]='JOAQUIN SEGUNDO SILVA ROMERO';
	$_SESSION["ROLE"]='A';
	header('location: ../contenido/');
	}
else
	{
	include("conexion.php");
	$sql = "SELECT * FROM curn.usuarios_roles WHERE iden = '".$iden."' AND estado = 1";
	$rs = mysqli_query($con,$sql);
	if($fila = mysqli_fetch_array($rs))
		{
		session_start();
		$_SESSION["IDEN"]=$fila["iden"];
		$_SESSION["NOMB"]=$fila["nombre"];
		$_SESSION["ROLE"]=$fila["rol"];
		header('location: ../contenido/');
		}
	else{
		echo "Error: Su cuenta no posee los privilegios para acceder.";
		}
	mysqli_close($con);
	}
?>