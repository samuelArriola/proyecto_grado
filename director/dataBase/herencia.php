<?php
   include("../../config/conexion.php"); 
   $item_proy = $_POST['item_proy'];
   $iden_usua = $_POST['iden_usua'];

     $query="UPDATE inex_proyectos SET jefe_proy = '$iden_usua' WHERE inex_proyectos.item_proy = '$item_proy'";
     $resul=mysqli_query($con,$query);
     if(!$resul){
        echo 'error al editar, contacte a su ingeniero de sistemas';
     }else{
      echo 'Cambios guardados exitosamente';
     }

     mysqli_close($con);

?>