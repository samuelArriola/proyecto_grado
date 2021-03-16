<?php 

 $item_proy=$_POST['id_proy'];
 $iden_usua=$_POST['lideProyecto'];
 $rol="L"; 
 $estado = 0;
include '../../config/conexion.php'; 

    $usuarios="SELECT u.iden_usua, u.nomb_usua, u.apel_usua, d.item_rol, u.correo FROM inex_usuarios u, inex_proyectos_usuarios d 
                WHERE u.iden_usua = d.iden_usua AND d.item_rol ='L' AND d.item_proy ='$item_proy' AND u.iden_usua = '$iden_usua' ";
    $resul_u=mysqli_query($con,$usuarios);
   
    if ( $row=mysqli_fetch_array($resul_u) ) {
         echo 'Usuario ya agregado';
    } else {
        $query = "INSERT INTO inex_proyectos_usuarios (item_proy, iden_usua, item_rol, estadoLPV) VALUES ('$item_proy','$iden_usua','$rol','$estado')";
        $resul=mysqli_query($con,$query);
        
        if($resul){
            echo 'Lider agregado';
        }else {
            echo 'Error al agregar al lider, contacte a su desarrollador web';
        }
    }



?>