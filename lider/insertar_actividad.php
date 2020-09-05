<?php
  include('../config/conexion.php');
  
    
  $nombre_act=$_POST['nombre_a'];
  $duracion_act=$_POST['duracion_a'];
  $valor=$_POST['valor_a'];
  $id_pro2=$_POST['id_pro2']; 

  // echo $nombre_act;
  // echo $duracion_act;
  // echo $valor;
  // echo $id_pro2;

  $query="INSERT INTO inex_actividades(nomb_acti,dias_acti,valo_acti,item_proy)VALUES('$nombre_act','$duracion_act','$valor','$id_pro2')";
  $resul=mysqli_query($con,$query); 
  if(!$resul){
    echo 'actividad no registrada';
  }

?>