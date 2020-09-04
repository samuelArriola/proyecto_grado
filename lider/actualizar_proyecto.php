<?php
     include("../config/conexion.php"); 
     
     $id=$_POST['id'];
     $nombre_proyec=$_POST['nombre_proyec'];
     $descripcion=$_POST['descripcion']; 
     
     $query="UPDATE inex_proyectos SET  nomb_proy='$nombre_proyec', desc_proy='$descripcion' WHERE item_proy = '$id' ";
     $resul=mysqli_query($con,$query);
     if(!$resul){
        echo 'error al actualizar';
     }else{
        echo 'proyecto actualizado';
     }

?>