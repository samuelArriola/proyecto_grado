<?php
    include("../../config/conexion.php"); 
    
    $id_p=$_POST['id_pro2'];
    $id_a=$_POST['id_a2'];
    $nombre_act=$_POST['nombre_a'];
    $descripcion_a=$_POST['descripcion_a'];
    $valor=$_POST['valor_a'];
    $fecha_ia=$_POST['fecha_ia'];
    $fecha_fa=$_POST['fecha_fa'];

    $query="UPDATE inex_actividades SET nomb_acti = '$nombre_act', descripcion_a='$descripcion_a',  valo_acti = '$valor', fecha_ia = '$fecha_ia', fecha_fa= '$fecha_fa' WHERE item_acti = '$id_a'";

    $resul=mysqli_query($con,$query); 
    if(!$resul){
      echo 'Actividad no actualizada';
    }else{
      echo'Actividad actualizada';
    }

     // cerra conexion 
    mysqli_close($con);

?>