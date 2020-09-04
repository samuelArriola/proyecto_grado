<?php


//session_start();

$_SESSION["IDEN"] = '1002491546';
$_SESSION["NOMB"] = 'OISMER SEHUANES GUZMAN';

if(isset($_SESSION["ROLE"]) && $_SESSION["ROLE"] == "A"){
?>
<!DOCTYPE html>
  <html>
    <head>
    <title>ADMINISTRADOR - INEX</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
	  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="https://tic.curn.edu.co:2641/gestion/comun/logo.png" />
    <link href="../css/all.css" rel="stylesheet">
<style>
.dropdown-menu{
    position: absolute;
    top: -64px;
  }
 .dropdown-menu li>a{
    color: black;
  }
.dropdown-menu li>a>i{
    font-size: 1.3em;
    padding-left: 20px;
  }
  
.sidenav-close i{
	font-size: 1.4em;
    padding-left: 20px;
}

  .dropdown-menuV{
    position: absolute;
    top: -48px;
  }
  .boton{
    min-width: 100px;
  }
</style>
</head>
<body>
<?php include("body_cabecera.php"); ?>

<div class="container" id="contenido" align="center">

</div>

</body>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/funciones.js?t=<?php echo time(); ?>"></script>
<script type="text/javascript">
  function enlace(opcion){
    var archivo = ''; 
    if(opcion==1){
      archivo = 'formulario.php';
    }
    if(opcion==2){
      archivo = 'otro.php';
    }
    $.ajax({
      url: archivo,
      beforeSend: function(){
        
      },
      success: function(data){
          $('#contenido').html(data);
      }
    });
  }
</script>
</html>
<?php
}else{
	session_destroy();
	header('location: ../');
}
?>