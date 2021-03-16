<?php
  include("../../config/conexion.php"); 
     
  $id_proy = $_POST['id_proy'];
  $aprobado = $_POST['estado_p'];;

 

  $query="UPDATE inex_proyectos SET esta_proy='$aprobado',visto = 0 WHERE item_proy='$id_proy'";
  $resul=mysqli_query($con,$query);
  if(!$resul){
     echo 'error al actualizar, contacte a su ingeniero de sistemas';
  }else{
   echo 'Cambios guardados correctamente';
  }

  mysqli_close($con);
 

?>