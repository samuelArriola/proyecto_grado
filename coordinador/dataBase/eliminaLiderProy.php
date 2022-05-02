<?php 
include("../../config/conexion.php");
    $id_lider=$_POST['id_lider'];
    $id_proye = $_POST['id_proye'];

    $query="DELETE FROM inex_proyectos_usuarios WHERE  item_proy='$id_proye' AND iden_usua = '$id_lider' ";
    $resul=mysqli_query($con,$query);

    if(!$resul){
        echo 'No eliminada, Contacte a su ingeniero de sistema';   
    }else{
        echo 'Eliminado Correctamente';
    }
    mysqli_close($con);
?>