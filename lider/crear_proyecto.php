<?php
session_start(); 
include("../config/conexion.php");
//muestra las independencias
$mostrar_i = "SELECT * FROM inex_dependencias";
$resul_mi = mysqli_query($con,$mostrar_i);

  
if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "L"){
?>
<!-- <!DOCTYPE html> -->
  <html> 
    <head> 
    <title>PROYECTOS INEX</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="../image/png" href="../img/logo.png" />
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
    <span style="opacity: 0.5; position:relative; top: 12px" > &nbsp;&nbsp;&nbsp;Los campos señalados con "*" son campos obligatorios</span>  

    <div class="row">
      <form class="col s12 " action="dataDase/insertar_proyecto.php" method="POST" style="margin-top:30px" id="form1">
       <div class="row">
         <div class="input-field col s12">
           <input placeholder="Ingrese nombre del proyecto"   name="nombre_proye" id="nombre_proye" type="text" class="validate caracteresEpesiales"  required>
           <label for="nombre_proye">* Nombre</label>
         </div>                   
         <div class="input-field col s12">
          <textarea placeholder="Ingrese descripción del proyecto" name="descripcion_proye" id="descripcion" class="caracteresEpesiales materialize-textarea validate caracteresEpesiales" required></textarea>
          <label for="textarea1">* Descripción </label>
        </div>
        <div class="input-field col s6">
        <input type="text" class="datepicker1 validate " id="datepicker1" required >
          <label for="datepicker1">* Fecha Inicial </label>
        </div>
        <div class="input-field col s6">
        <input type="text" class="datepicker2 validate " id="datepicker2"  disabled required title="seleccione la fecha inicial para poder habilitar este opción">
          <label for="datepicker2">* Fecha Final</label>
        </div>
        <div class="col s12"> 
         <label>* Escoja la dependencia a la que pertenece el proyecto</label>
             <select class="browser-default"  name="dependencia" id="dependencia">
                <option value="" disabled selected>Seleccione</option>
                <?php while ($row_mi=mysqli_fetch_array($resul_mi)) {?>
                  <option value="<?php echo $row_mi['item_dep']?>"><?php echo $row_mi['nombre_dep'] ?></option>
                <?php } ?>    
              </select>
          </div>  <br>
         <div class="input-field col s12" style="position:relative; top:15px" >
           <input disabled value="<?php echo $_SESSION["NOMB"] ?>" name="lider_proye" id="nombre" type="text" class="validate">
           <input value="<?php echo $_SESSION["IDEN"] ?>" name="iden_lider" id="iden_lider" type="hidden" class="validate">
           <label for="nombre">Nombre</label>
         </div>
         <div class="input-field col s12">
          <div class="center"> 
             <button id="btn_create_p" class="btn orange">Registrar proyecto</button>
          </div>
        </div>
       </div>
      </form>
    </div>  
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
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