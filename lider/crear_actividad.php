<?php

include("../config/conexion.php");

$item = $_GET['id'];
    $query = "SELECT fecha_fp, fecha_ip FROM inex_proyectos WHERE item_proy ='$item'";
    $result = mysqli_query($con,$query); 


    while ($row = mysqli_fetch_array($result)) {
        $fecha_i= $row['fecha_ip'];
        $fecha_f= $row['fecha_fp'];
    }
    

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
 
    <div class="teal-text" style="margin-left:10px">&nbsp;&nbsp;AGREGAR ACTIVIDADES</div> 
    <span style="opacity: 0.5;" style="position:relative; top: -15px;"> &nbsp;&nbsp;&nbsp; Los campos señalados con "*" son campos obligatorios</span>  <br><br>
    <div class="row">
        <form class="col s12" action="dataBase/insertar_actividad.php" method="POST" id="form2">
        <div class="row">
        <div class="input-field col s12">
            <input type="hidden" value=" <?php echo $item ?>" name="id_pro2" id="id_pro2">
            <input placeholder="Ingrese el nombre de la actividad" name="nombre_act" id="nombre_act"   maxlength="240" autofocus type="text" class="validate caracteresEpesiales" required >
            <label for="nombre_act" >* Nombre da la Actividad</label>
        </div>
        <div class="input-field col s12">
            <textarea  placeholder="Describa la actividad" name="descripcion_a" id="descripcion_a" type="text" class="caracteresEpesiales validate materialize-textarea" required></textarea>
            <label for="valor" >Descripción</label>
        </div>
        <div class="input-field col s6">
        <input type="text" name="fecha_ia" class="datepicker4 validate" id="datepicker3" required>
          <label for="datepicker3">* Fecha Inicial </label>
        </div>
        <input type="hidden" name="fecha_fa" class="datepicker validate" id="fecha_iproy" value="<?php echo $fecha_i ?>">        <!--para mandar el la fecha por id -->
        <div class="input-field col s6">
        <input type="text" name="fecha_fa" class="datepicker3 validate" id="datepicker4" value="<?php echo $fecha_f ?>"disabled required title="seleccione la fecha inicial para poder habilitar este opción">
          <label for="datepicker4">* Fecha Final </label>
        </div>
        <div class="input-field col s12">
            <input placeholder="Ingrese el valor de la actividad" name="valor" id="valor" type="number" class="validate caracteresEpesiales" required>
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
<script src="js/funciones.js"></script> 
<script src="js/validaciones.js"></script> 

</html>
<?php
}else{
	session_destroy();
	header('location: ../');
}
?>