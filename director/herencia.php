<?php
session_start(); 
include("../config/conexion.php");
//muestra proyectos
$mostrar_p= "SELECT * FROM inex_proyectos ORDER BY nomb_proy";
$resul_mp = mysqli_query($con,$mostrar_p); 


if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "D"){
?>
<!-- <!DOCTYPE html> -->
  <html> 
    <head> 
    <title>PROYECTOS INEX</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <link rel="icon" type="image/png" href="../img/logo.png" />
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
<div class="hide-on-med-and-down" style="margin-top: 65px;"></div>
    <div class="containe section">

        <div class="row">
        <div class="col s12 m8 l6 offset-l3 offset-m2">
        <div class="card">
            <div class="card-content white-text ">
                <div class="section card-image center-align">
				    <i class="teal-text lighten-2 large material-icons">swap_horiz</i>
				</div>
                <div class="row">
                <span class="card-title center-align" style="position:relative; top: -18px; color:black">Registrar Usuario </span> <br>
                    <form action="" method="">
                        <div class="col s12 m6 ">
                            <div class="teal-text " >LISTA DE PROYECTOS</div> <br>
                                <div class="col s12"> 
                                    <span  class="black-text">*Proyecto</span> 
                                    <select class="browser-default" name="dependencia" id="d_proy">
                                    <option value="" disabled selected>Seleccione</option>
                                    <?php 
                                    while($res_mp = mysqli_fetch_array($resul_mp)) {
                                        $resultado="<option value='".$res_mp['item_proy']."'>".$res_mp['nomb_proy']."</option>";
                                        echo $resultado;
                                    }
                                    ?>
                                    </select>
                                    <div id="h_detalle" class="d_coor hide">hola</div>
                                </div>
                        </div>
                        <div class="col s12 m6">
                            <div class="hide-on-med-and-up" style="margin-top: 40px;">  </div>
                            <div class="teal-text" >LISTA DE USUARIOS</div> <br>
                            <div class="col s12 black-text hide d_coor" id='d_coor'> 
                                <span> *Nuevo Coordinador</span> 
                                <select class="browser-default" name="dependencia" id="d_coordinador">
                                </select>
                            </div> 
                        </div>
                      
                    </form>
                </div>
            </div>
            <div class="card-action">
                <div class="center ">
                    <button  class=" btn  waves-effect waves-light" type="button" id="d_guarda_c">Guardar</button> 
                </div>  
            </div>
        </div>
        </div>
    </div>
    </div>



<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/funciones.js?t=<?php echo time(); ?>"></script> 
<script src="js/funciones.js"></script> 
<script src="js/validaciones.js"></script> 
<!-- <script src="../js/app.js"></script> -->
</html>
<?php
}else{
	session_destroy();
	header('location: ../');
}


?>