<?php
session_start(); 
include("../config/conexion.php");
//muestra proyectos

 if (!isset( $_GET['id_u'])){
    header("location: ../director/coordinadores.php");
 }
    // UDUARIO
    $usua = $_GET['id_u'];  
    $mostrar_u= "SELECT*  FROM inex_usuarios WHERE  iden_usua = '$usua'";
    $resul_mu = mysqli_query($con,$mostrar_u); 
    $usuario = mysqli_fetch_array($resul_mu);
    $dep = $usuario['item_dep'];

    // COORDINADORE
    $mostrar_c= "SELECT*  FROM inex_usuarios WHERE  item_dep ='$dep' ";
    $resul_mc = mysqli_query($con,$mostrar_c); 

    // PROYECTO
    $mostrar_p= "SELECT *  FROM inex_proyectos WHERE  jefe_proy = '$usua' ORDER BY nomb_proy";
    $resul_mp = mysqli_query($con,$mostrar_p); 
    $nun_proy= mysqli_num_rows($resul_mp);

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
    .border{
    border: 2px solid #EBEDEF;
}


</style>
</head>
<body>
<?php include("menu.php"); ?>
<div class="hide-on-med-and-down" style="margin-top: 65px;"></div>
  

    <div class="section card-image center-align">
        <i class="teal-text lighten-2 large material-icons">swap_horiz</i> <br>
        <h4 class="card-title center-align black-text">Herencia de Proyecto </h4> <br>
    </div> <br>
    <div class="row container section">      
       <div class="col m4 s12">
           <div class="section ">
               
                <div class="border center-align">
                    <h5 class="center-align">
                        <?php echo $usuario['nomb_usua'] ?>
                    </h5>
                    <span style="position: relative; top:-10px ">
                        <?php echo $usuario['apel_usua'] ?>
                    </span>
                </div>  
                <br><br>
                <b>Identificación:</b>
                <p>
                    <?php echo $usuario['iden_usua'] ?>
                </p>
                <b>Correo:</b>
                <p>
                     <?php echo $usuario['correo'] ?>
                </p>
                <b>Proyectos:</b>
                <p>
                     <?php echo $nun_proy?>
                     <input  id="h_old_usua" value="<?php echo $usuario['iden_usua'] ?>" type="hidden">
                </p>
              
           </div>
       </div>  
       <div class=" col s12 m8">
           <div class="row ">
                <div class="col s12 m12">
                    <div class=" section">
                        <div class="teal-text " >SELECCIONAR COORDINADOR</div> <br> 
                            <div class="col s12 black-text " id=''> 
                                <span clas> *Nuevo Coordinador</span> 
                                <select class="browser-default validate " name="" id="h_new_usua" required>
                                    <option value='' disabled selected>Seleccione</option>
                                    <?php while ($row_c=mysqli_fetch_array($resul_mc)) { ?>
                                        <option value="<?php echo $row_c['iden_usua'] ?>"><?php  echo $row_c['nomb_usua'].' '. $row_c['apel_usua'] ?></option>
                                    <?php }?>
                                </select>
                            </div> 

                    </div> 
                </div> 
                <div class="col s12 m12">
                    <div class=" section"> <br>
                        <div class="teal-text " >LISTA DE PROYECTOS</div> <br> 
                        <ul class="collapsible">
                            <?php while ($row_p=mysqli_fetch_array($resul_mp)) { ?>
                                <li>
                                    <div class="collapsible-header"><i class="material-icons">account_balance</i><?php echo $row_p['nomb_proy'] ?></div>
                                    <div class="collapsible-body">
                                        <b>Item:</b>
                                        <p>
                                            <?php echo $row_p['item_proy'] ?>
                                        </p>
                                        <b>Jefe:</b>
                                        <p>
                                            <?php echo $row_p['jefe_proy'] ?>
                                        </p>
        
                                    </div>
                                </li>
                            <?php }?>
                        </ul><BR><BR>

                    </div>
                </div>
                  <!-- GUARDAR CAMBIOS  -->
                <div class="center"> <button class="btn "  id="d_guarda_c" >GUARDAR CAMBIOS</button></div>
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