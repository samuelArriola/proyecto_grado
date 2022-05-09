<?php
   include("../../config/conexion.php"); 
   $old_usua = $_POST['old_usua'];
   $new_usua = $_POST['new_usua'];

   $mostrar_p= "SELECT *  FROM inex_proyectos WHERE  jefe_proy = '$old_usua' ORDER BY nomb_proy";
   $resul_mp = mysqli_query($con,$mostrar_p); 
   if(!$resul_mp) {
      echo 'error al actualizar, contacte a su ingeniero de sistemas';
   }else{

      while($row_d=mysqli_fetch_array($resul_mp)){
         $query="UPDATE inex_proyectos SET jefe_proy = '$new_usua' WHERE jefe_proy = '$old_usua'";
         $resul=mysqli_query($con,$query);
         if(!$resul){
            echo 'error al editar, contacte a su ingeniero de sistemas';
         }
      }
      echo 'ok';
   }
     mysqli_close($con);

?>