<?php
     include("../../config/conexion.php"); 
     
     $id=$_POST['id'];
     $nombre_proyec=$_POST['nombre_proyec'];
     $descripcion=$_POST['descripcion']; 
     $dependencia= $_POST['dependencia'];
     $fecha_ipro=$_POST['fecha_ipro'];
     $fecha_fpro=$_POST['fecha_fpro'];

     $query="UPDATE inex_proyectos SET  nomb_proy='$nombre_proyec', desc_proy='$descripcion', item_dep='$dependencia',fecha_ip='$fecha_ipro',fecha_fp='$fecha_fpro' WHERE item_proy = '$id' ";
     $resul=mysqli_query($con,$query);
     if(!$resul){
        echo 'error al actualizar';
     }else{
        echo 'proyecto actualizado';
     }

?>