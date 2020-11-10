<?php
session_start(); 
include("../config/conexion.php");
if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "D"){
?>
<!-- <!DOCTYPE html> -->
  <html> 
    <head> 
    <title>PROYECTOS INEX</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- <link rel="shortcut icon" href="https://tic.curn.edu.co:2641/gestion/comun/logo.png" />-->
    <link href="../css/all.css?t=<?php echo time(); ?>" rel="stylesheet"> 

<style>
.optionMenu{
	height: 42px; 
	font-size: 0.9em;
}
</style>
</head>
<body>
<?php include("menu.php"); ?>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/funciones.js?t=<?php echo time(); ?>"></script> 
<!-- <script src="../js/app.js"></script> -->
</html>
<?php
}else{
	session_destroy();
	header('location: ../');
}


?>