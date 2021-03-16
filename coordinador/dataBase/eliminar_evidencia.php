<?php 
include("../../config/conexion.php");
    $id_e=$_POST['id_e'];
    $ruta_e=$_POST['ruta_e'];

    $query="DELETE FROM inex_evidencia WHERE id_e='$id_e'";
    $resul=mysqli_query($con,$query);

    if(!$resul){
    echo 'no eliminado';
    }else{
        unlink($ruta_e); //borra la imagen de la carpeta (storage)
        echo 'Evidencia eliminada correctamente';   
    }
    mysqli_close($con);
?>