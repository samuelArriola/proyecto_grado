<?php
  include("../../config/conexion.php"); 
     
  $id_proy = $_POST['id_p'];
  $estado = $_POST['estado'];
  $estadoL = $_POST['estadoL'];

  $query="UPDATE inex_proyectos SET visto='$estado', vistoL='$estadoL' WHERE item_proy='$id_proy'";
  $resul=mysqli_query($con,$query);
  if(!$resul){
     echo 'error al actualizar';
  }else{
    echo "Proyecto enviado";
  }

  mysqli_close($con);
 

?>