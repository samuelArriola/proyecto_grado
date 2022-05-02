<?php
  include("../../config/conexion.php"); 
     
  $id_pro = $_POST['id_pro'];
  $id_usua = $_POST['id_usua'];
  $estado = $_POST['estado'];

  $query="UPDATE inex_proyectos_usuarios SET estadoLPV='$estado' WHERE  item_proy='$id_pro' AND iden_usua = '$id_usua' ";
  $resul=mysqli_query($con,$query);
  if(!$resul){
     echo 'error Contacte a su Ingeniro de Sistemas';
  }else{
    echo "OK";
  }

  mysqli_close($con);
 

?>