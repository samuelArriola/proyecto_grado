<?php
  include("../../config/conexion.php"); 
     
  $id_proy = $_POST['id_p'];
  $estado = $_POST['estado'];

  $query="UPDATE inex_proyectos SET visto='$estado' WHERE item_proy='$id_proy'";
  $resul=mysqli_query($con,$query);
  if(!$resul){
     echo 'error al actualizar';
  }
  mysqli_close($con);
 

?>