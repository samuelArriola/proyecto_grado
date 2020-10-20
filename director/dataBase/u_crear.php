<?php 
 include('../../config/conexion.php');  

 $nombre = $_POST['nombre_u'];
 $apellido = $_POST['apellido_u'];
 $cedula = $_POST['cedula_u'];
 $correo = $_POST['correo_u'];
 
    // echo $nombre;
    // echo $apellido;
    // echo $cedula;
    // echo $correo;
  
  $query="INSERT INTO inex_usuarios(iden_usua, nomb_usua, apel_usua, correo) 
  VALUES ('$cedula','$nombre','$apellido','$correo')";
  $resul=mysqli_query($con,$query); 


  if(!$resul){
      echo 'Error:Numero de identificación ya existente, vuelva a intentar';
  }else{
      echo('Usuario guardado exitosamente');
  }


  mysqli_close($con);

?>