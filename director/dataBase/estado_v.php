<?php
  include("../../config/conexion.php"); 
     
  $id_proy = $_POST['id_p'];
  $uno = $_POST['uno'];

  $query="UPDATE inex_proyectos SET visto='$uno' WHERE item_proy='$id_proy'";
  $resul=mysqli_query($con,$query);
  if(!$resul){
     echo 'error al actualizar';
  }else{
   echo 'Cambios guardados correctamente';
  }

  mysqli_close($con);
 

?>