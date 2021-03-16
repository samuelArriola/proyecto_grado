<?php
session_start();
$item_p = $_GET['id'];
$item_a = $_GET['id_a'];
include("../config/conexion.php");
$sql = "select item_acti, nomb_acti, descripcion_a, valo_acti, esta_acti,  DATE_FORMAT(fecha_ia, '%Y/%m/%d') as fecha_ia ,DATE_FORMAT(fecha_fa, '%Y/%m/%d') as fecha_fa
from inex_actividades as a where a.item_acti = '".$item_a."'";
$rs = mysqli_query($con, $sql);

//esxtrae la fecha del proyeco 
$query = "SELECT item_proy, nomb_proy, desc_proy, jefe_proy, esta_proy, visto, item_dep,DATE_FORMAT(fecha_ip, '%Y/%m/%d') as fecha_ip,DATE_FORMAT(fecha_fp, '%Y/%m/%d') as fecha_fp, comentarios_p  FROM inex_proyectos WHERE item_proy='$item_p'";
$resultado = mysqli_query($con,$query);
$rw = mysqli_fetch_array($resultado);
$fecha_ip= $rw['fecha_ip'];
$fecha_fp=$rw['fecha_fp'];

while ($row = mysqli_fetch_array($rs)) {
    $nombre_a = $row['nomb_acti'];
    $descripcion_a = $row['descripcion_a'];
    $valor_a = $row['valo_acti'];
    $fecha_ia= $row['fecha_ia'];
    $fecha_fa= $row['fecha_fa'];
} 
if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "C"){
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
    
    <div class="teal-text" style="margin-left:10px">EDITAR ACTIVIDADES</div> <br>
    <span style="opacity: 0.5; position:relative; top: -12px" > &nbsp;&nbsp;&nbsp;Los campos señalados con "*" son campos obligatorios</span>
    <div class="row">
        <!-- <form class="col s12" action="dataBase/actualizar_actividad.php?id_a=<?php echo $item_a?>&id_p=<?php echo $item_p?>" method="POST" id="form2"> -->
        <form class="col s12" action="" method="" id="form2">
        <div class="row">
        <div class="input-field col s12">
            <input type="hidden" value=" <?php echo $item_p ?>" name="id_pro2" id="id_pro2">
            <input type="hidden" value=" <?php echo $item_a?>" name="" id="id_a2">
            <input value = "<?php echo $nombre_a ?>" maxlength="240" name="nombre_act" id="nombre_act" type="text" class="caracteresEpesiales validate" >
            <label for="nombre_act" >* Nombre de la Actividad</label>
        </div>
        <div class="input-field col s12">
            <textarea  placeholder="Describa la actividad" name="descripcion_a" id="descripcion_a" type="text" class="caracteresEpesiales validate materialize-textarea" required> <?php echo $descripcion_a ?></textarea>
            <label for="valor" >Descripción</label>
        </div>
        <div class="input-field col s6">
        <input value = "<?php echo $fecha_ia ?>" type="text" name="fecha_ia"  class="datepickerE3 validate" id="datepickerE3" required>
          <label for="datepickerE3">* Fecha Inicial </label>
        </div>
        <input value = "<?php echo $fecha_ip ?>" type="hidden" name="fecha_ia"  class="" id="ep_fechaip" required>
        <input value = "<?php echo $fecha_fp ?>" type="hidden" name="fecha_ia"  class="" id="ep_fechafp" required>
        <div class="input-field col s6">
        <input value = "<?php echo $fecha_fa ?>" type="text" name="fecha_fa" class="datepickerE4 validate" id="datepickerE4"  required>
          <label for="datepickerE4">* Fecha Final </label>
        </div>
        <div class="input-field col s12">
            <input value = "<?php echo $valor_a ?>" name="valor" id="valor" type="number" class="caracteresEpesiales validate">
            <label for="valor" >* Valor de la actividad</label>
        </div>
        <div class="input-field col s12">
            <button class="btn orange" type="button" id="editar_acti">Actualizar</button>
            <a href="editar_proyecto.php?id=<?php echo $item_p ?>" class="modal-close waves-effect waves-green btn">Atras</a>
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