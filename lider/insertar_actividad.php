<?php
  include('../config/conexion.php');
  
    
  $nombre_act=$_POST['nombre_a'];
  $duracion_act=$_POST['duracion_a'];
  $valor=$_POST['valor_a'];
  $id_pro2=$_POST['id_pro2']; 
  $fecha_ia=$_POST['fecha_ia'];
  $fecha_fa=$_POST['fecha_fa'];

  // echo $nombre_act;
  // echo $duracion_act;
  // echo $valor;
  // echo $id_pro2;

  $query="INSERT INTO inex_actividades(nomb_acti,dias_acti,valo_acti,item_proy,fecha_ia,fecha_fa)VALUES('$nombre_act','$duracion_act','$valor','$id_pro2','$fecha_ia','$fecha_fa')";
  $resul=mysqli_query($con,$query); 
  if(!$resul){
    echo 'actividad no registrada';
  }

  // cerra conexion 
  mysqli_close($con);
?>