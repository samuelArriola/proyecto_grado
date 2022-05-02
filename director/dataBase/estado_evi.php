<?php
  include("../../config/conexion.php"); 
     
  $id_e = $_POST['id_e'];
  $estado_e = 1;

  $query = "UPDATE inex_evidencia SET estado_e='$estado_e'WHERE id_e='$id_e'";
  $resul=mysqli_query($con,$query);
  if(!$resul){
     echo 'error al cambir el estado';
  }
  mysqli_close($con);
 

?>