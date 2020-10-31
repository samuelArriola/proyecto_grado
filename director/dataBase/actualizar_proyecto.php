<?php
     include("../../config/conexion.php"); 
     
     $id=$_POST['id'];
     $fecha_ipro=$_POST['fecha_ipro'];
     $fecha_fpro=$_POST['fecha_fpro'];

     $query="UPDATE inex_proyectos SET  fecha_ip='$fecha_ipro',fecha_fp='$fecha_fpro' WHERE item_proy = '$id' ";
     $resul=mysqli_query($con,$query);
     if(!$resul){
        echo 'Error al actualizar';
     }else{
        echo 'Fecha actualizada con exito';
     }

?>