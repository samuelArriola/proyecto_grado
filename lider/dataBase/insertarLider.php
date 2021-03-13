<?php 

 $item_proy=$_POST['id_proy'];
 $iden_usua=$_POST['lideProyecto'];
 $rol="L"; 
 
include '../../config/conexion.php'; 

    $query = "INSERT INTO inex_proyectos_usuarios (item_proy, iden_usua, item_rol) VALUES ('$item_proy','$iden_usua','$rol')";
    $resul=mysqli_query($con,$query);

    if($resul){
        echo 'Lider agregado';
    }else {
        echo 'Error al agregar al lider, contacte a su desarrollador web';
    }

?>