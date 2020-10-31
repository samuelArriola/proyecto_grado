<?php 
 include('../../config/conexion.php');  

 $nombre = $_POST['nombre_u'];
 $apellido = $_POST['apellido_u'];
 $cedula = $_POST['cedula_u'];
 $correo = $_POST['correo_u'];
 $dep_u = $_POST['dep_u'];
 
  
  $query="INSERT INTO inex_usuarios(iden_usua, nomb_usua, apel_usua, correo, item_dep ) 
  VALUES ('$cedula','$nombre','$apellido','$correo','$dep_u')";
  $resul=mysqli_query($con,$query); 


  if(!$resul){
      echo 'Error: Numero de identificación ya existente, vuelva a intentar';
  }else{
      echo('Usuario registrado exitosamente');
  }


  mysqli_close($con);

?>