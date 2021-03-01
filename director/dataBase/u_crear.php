<?php 
 include('../../config/conexion.php');  

 $nombre = $_POST['nombre_u'];
 $apellido = $_POST['apellido_u'];
 $type_usersc = $_POST['type_users'];  
 $cedula = $_POST['cedula_u']; 
 $correo = $_POST['correo_u'];
 $dep_u = $_POST['dep_u'];
 
  
  $query="INSERT INTO inex_usuarios(iden_usua, nomb_usua, apel_usua, correo, role_usua, item_dep ) 
  VALUES ('$cedula','$nombre','$apellido','$correo','$type_usersc','$dep_u')";
  $resul=mysqli_query($con,$query); 


  if(!$resul){
      echo 'Error: Numero de identificación ya existente, vuelva a intentar';
  }else{
      echo('Usuario registrado exitosamente');
  }


  mysqli_close($con);

?>