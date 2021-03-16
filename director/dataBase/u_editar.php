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
      echo 'Usuario editado exitosamente';
     }

     mysqli_close($con);

?>