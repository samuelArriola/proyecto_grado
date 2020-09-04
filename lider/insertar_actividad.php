<?php
  include('../config/conexion.php');
  
    
  $nombre_act=$_POST['nombre_act'];
  $duracion_act=$_POST['duracion_act'];
  $valor=$_POST['valor'];
  $id_pro2=$_POST['id_pro2']; 

  $query="INSERT INTO inex_actividades(nomb_acti,dias_acti,valo_acti,item_proy)VALUES('$nombre_act','$duracion_act','$valor','$id_pro2')";
  $resul=mysqli_query($con,$query); 
  if(!$resul){
    echo 'actividad no registrada';
  }else{
    header('location:editar_proyecto.php?id='.$id_pro2);
  }

?>