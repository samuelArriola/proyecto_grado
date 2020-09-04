<?php
    include("../config/conexion.php"); 
    
    $id_p=$_GET['id_p'];
    $id_a=$_GET['id_a'];
    $nombre_act=$_POST['nombre_act'];
    $duracion_act=$_POST['duracion_act'];
    $valor=$_POST['valor'];

    $query="UPDATE inex_actividades SET nomb_acti = '$nombre_act', dias_acti = '$duracion_act', valo_acti = '$valor' WHERE item_acti = '$id_a'";

    $resul=mysqli_query($con,$query); 
    if(!$resul){
      echo 'actividad no registrada';
    }else{
      header('location:editar_proyecto.php?id='.$id_p);
    }


?>