<?php
    include("../config/conexion.php"); 
    
    $id_p=$_GET['id_p'];
    $id_a=$_GET['id_a'];
    $nombre_act=$_POST['nombre_act'];
    $descripcion_a=$_POST['descripcion_a'];
    $valor=$_POST['valor'];
    $fecha_ia=$_POST['fecha_ia'];
    $fecha_fa=$_POST['fecha_fa'];

    
    $query="UPDATE inex_actividades SET nomb_acti = '$nombre_act', descripcion_a='$descripcion_a',  valo_acti = '$valor', fecha_ia = '$fecha_ia', fecha_fa= '$fecha_fa' WHERE item_acti = '$id_a'";

    $resul=mysqli_query($con,$query); 
    if(!$resul){
      echo 'actividad no registrada';
    }else{
      header('location:editar_proyecto.php?id='.$id_p);
    }

     // cerra conexion 
    mysqli_close($con);

?>