<?php
     include("../config/conexion.php");

     $id=$_GET['id'];
     $id_p=$_GET['id_proy'];

     $query="DELETE FROM inex_actividades WHERE item_acti='$id'";

     $resul=mysqli_query($con,$query);

     if(!$resul){
        echo 'no eliminado';
     }else{
        header('location: editar_proyecto.php?id='.$id_p);
     }
?>