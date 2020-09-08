<?php

$item = $_GET['id'];

session_start(); 

$_SESSION["IDEN"] = '1002491546';
$_SESSION["NOMB"] = 'OISMER SEHUANES GUZMAN';
$_SESSION["ROLE"] = 'J';

if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "J"){
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

<div class="hide-on-med-and-down" style="margin-top: 90px;"></div>

<div class="container section">
 
    <div class="teal-text" style="margin-left:10px">AGREGAR ACTIVIDADES</div> 
    
    <div class="row">
        <form class="col s12" action="insertar_actividad.php" method="POST" id="form2">
        <div class="row">
        <div class="input-field col s12">
            <input type="hidden" value=" <?php echo $item ?>" name="id_pro2" id="id_pro2">
            <input placeholder="Ingrese el nombre de la actividad" name="nombre_act" id="nombre_act" type="text" class="validate" required>
            <label for="nombre_act" >* Nombre da la Actividad</label>
        </div>
        <div class="input-field col s12">
            <textarea  placeholder="Describa la actividad" name="descripcion_a" id="descripcion_a" type="text" class="validate materialize-textarea" required></textarea>
            <label for="valor" >Descripción</label>
        </div>
        <div class="input-field col s6">
        <input type="text" name="fecha_ia" class="datepicker validate" id="datepicker3" required>
          <label for="datepicker3">* Fecha Inicial </label>
        </div>
        <div class="input-field col s6">
        <input type="text" name="fecha_fa" class="datepicker validate" id="datepicker4" required>
          <label for="datepicker4">* Fecha Final </label>
        </div>
        <div class="input-field col s12">
            <input placeholder="Ingrese el valor de la actividad" name="valor" id="valor" type="number" class="validate" required>
            <label for="valor" >* Valor da la Actividad</label>
        </div>
        <div class="input-field col s12">
            <button class="btn orange" type="" id="actualizar_a">Agregar</button>
            <a href="editar_proyecto.php?id=<?php echo $item ?>" class="modal-close waves-effect waves-green btn">Atras</a>
        </div> 
        </div>
        </form>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/funciones.js?t=<?php echo time(); ?>"></script> 
<script src="funciones.js"></script> 
<script src="validaciones.js"></script> 

</html>
<?php
}else{
	session_destroy();
	header('location: ../');
}
?>