<?php
     include("../../config/conexion.php"); 
     
  $nombre = $_POST['nombre_u'];
   $apellido = $_POST['apellido_u'];
   $cedula = $_POST['cedula_u'];
   $correo = $_POST['correo_u'];
   $rol_u = $_POST['rol_u'];
 
   //  echo $nombre;
   //  echo $apellido;
   //  echo $cedula;
   //  echo $correo;

     $query="UPDATE inex_usuarios SET  nomb_usua='$nombre',apel_usua='$apellido',correo='$correo' WHERE iden_usua= '$cedula'";
     $resul=mysqli_query($con,$query);
     if(!$resul){
        echo 'error al editar, contacte a su ingeniero de sistemas';
     }else{

      mysqli_query($con,"DELETE FROM inex_usuarios_roles WHERE iden_usua= '$cedula' ");
      foreach ($rol_u as $value){
         $query2="INSERT INTO `inex_usuarios_roles`(`iden_usua`, `item_rol`) VALUES ('$cedula','$value')"; 
         $resul2=mysqli_query($con,$query2); 
       }

      echo 'Usuario editado exitosamente';
     }

     mysqli_close($con);

?>