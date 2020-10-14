<?php
  include("../../config/conexion.php"); 
     
  $id_proy = $_POST['id_proy'];
  $aprobado = $_POST['estado_p'];;

 echo $id_proy;
 echo $aprobado;


  $query="UPDATE inex_proyectos SET esta_proy='$aprobado' WHERE item_proy='$id_proy'";
  $resul=mysqli_query($con,$query);
  if(!$resul){
     echo 'error al actualizar';
  }else{
   echo 'exito';
  }

  mysqli_close($con);
 

?>