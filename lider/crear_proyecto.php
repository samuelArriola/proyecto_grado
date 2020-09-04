<?php
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
 
    <div class="teal-text" style="margin-left:10px">CREAR PROYECTOS</div> 
    <div class="row">
      <form class="col s12 " action="insertar_proyecto.php" method="POST" style="margin-top:30px">
       <div class="row">
         <div class="input-field col s12">
           <input placeholder="Ingrese nombre del proyecto" name="nombre_proye" id="nombre_proye" type="text" class="validate"  required>
           <label for="nombre_proye">*(este campo es requerido)</label>
         </div>                   
         <div class="input-field col s12">
          <textarea placeholder="Ingrese descripcion del proyecto" name="descripcion_proye" id="descripcion" class="materialize-textarea validate" required></textarea>
          <label for="textarea1">Descripcion</label>
        </div>
        <div class="col s12"> 
         <label>Escoja la dependencia a la que pertenece el proyecto</label>
             <select class="browser-default" name="dependencia" id="dependencia">
                <option value="" disabled selected>Seleccione</option>
                  <option value="1">Investigacion</option>
                  <option value="2">Proyeccion social</option>
              </select>
          </div>
         <div class="input-field col s12" >
           <input disabled value="<?php echo $_SESSION["NOMB"] ?>" name="lider_proye" id="nombre" type="text" class="validate">
           <input value="<?php echo $_SESSION["IDEN"] ?>" name="iden_lider" id="iden_lider" type="hidden" class="validate">
           <label for="nombre">Nombre</label>
         </div>
         <div class="input-field col s12">
          <div class="center"> 
             <button id="btn_create_p" class="btn orange">Continuar</button>
          </div>
        </div>
       </div>
      </form>
    </div>  
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/funciones.js?t=<?php echo time(); ?>"></script> 
<script src="funciones.js"></script>

</html>
<?php
}else{
	session_destroy();
	header('location: ../');
}
?>