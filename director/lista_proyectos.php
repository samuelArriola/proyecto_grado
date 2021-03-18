<?php
session_start();  
include("../config/conexion.php");
if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "D"){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PROYECTOS</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
	<link href="../css/all.css?t=<?php echo time(); ?>" rel="stylesheet"> 
	<style>
	.hoverA:hover {
		background-color:RGB(255, 160, 0, 0.5);
		}
	</style>
</head>
<body>
  <?php include("menu.php"); ?>
  <div class="hide-on-med-and-down" style="margin-top: 65px;"></div>

 
    <div class="nav-content white">
      <ul class="tabs tabs-transparent" >
        <li class="tab hoverA"><a href="#menuRecibido" class="teal-text hoverable  ">Recibidos</a></li>
        <li class="tab hoverA"><a href="#menuAprobado" class="teal-text hoverable ">Aprobados</a></li>
      </ul>
    </div>


  <!-- RECIBIDOS -->
  <div id="menuRecibido" class="col s12">  <br>
	<div class="container">
		<div class="teal-text" style="position: relative; right:10px">LISTA DE PROYECTOS</div>
		<div class="row"> 

		<!-- buscador	 -->
		<div class=" section">
        <div class="row ">
        <form action="" method="POST">
        <div class="col m6">
            <div class="input-field col m7 offset-m8">
            <i class="material-icons prefix">search</i> 
            <input name="buscador" id="buscar_p" type="text" class="validate" placeholder="Nombre del proyecto" >
            <label for="buscar_p">Buscar proyecto</label>
            </div>
        </div>
        </form> 
        </div>
		</div>
    	</div>
			
		<section style="position: relative; top: -60px;">
			<div class="row"> 
			<div style="overflow-x: auto;">
				<table id="tabla" >
				<div class="center hide" id="lis_load" type="" style="margin-top: 50px">
					<?php include("../include/preloader.php"); ?> 
				</div> 
							
				</table>
			</div>
			</div>
		</section>

		<div class="fixed-action-btn" > 
 			<a  onclick="obtenerDAt();" class='btn-floating btn-large waves-effect waves-light orange  tooltipped' data-position='left'  data-tooltip='ACTUALIZAR LISTA'  id='' ><i class='material-icons'>refresh</i></a>
 		</div>

	</div>
   </div>

  <!-- APROBADOS -->
  <div id="menuAprobado" class="col s12">
     <div class="container"> <br>

	    <div class="teal-text">PROYECTOS APROBADOS </div>

		<!-- buscador	 -->
		<div class=" section">
        <div class="row ">
        <form action="" method="POST">
        <div class="col m6">
            <div class="input-field col m7 offset-m8">
            <i class="material-icons prefix">search</i> 
            <input name="buscador" id="buscar_pA" type="text" class="validate" placeholder="Nombre del proyecto" >
            <label for="buscar_pA">Buscar proyecto</label>
            </div>
        </div>
        </form> 
        </div>
		</div>

		<section style="position: relative; top: -60px;">
			<div class="row"> 
				<div style="overflow-x: auto;">
					<table id="tablaProyA">
								
					</table>
				</div>
			</div>
		</section>
	  </div>

  </div>

  


	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script type="text/javascript" src="../js/funciones.js?t=<?php echo time(); ?>"></script> 
	<script>document.addEventListener('DOMContentLoaded', function() { M.AutoInit();});</script>
	<script src="js/funciones.js"></script> 
	<script src="js/buscar.js"></script> 
	</body>
</html>

<?php
}else{
	session_destroy();
	header('location: ../');
}

mysqli_close($con);

?>


