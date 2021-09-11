<?php 

 $item_proy=$_POST['id_proy'];
 $iden_usua=$_POST['lideProyecto'];
 $rol="L"; 
 $estado = 0;
include '../../config/conexion.php'; 

$datos="SELECT * FROM inex_usuarios WHERE iden_usua = '$iden_usua' ";
$resul_d=mysqli_query($con,$datos);
$row_d=mysqli_fetch_array($resul_d);
echo  $row_d['correo'];

include('../../config/enviar_email.php');


//validamos si ya el usuario existe
    $usuarios="SELECT u.iden_usua, u.nomb_usua, u.apel_usua, d.item_rol, u.correo as correo FROM inex_usuarios u, inex_proyectos_usuarios d 
                WHERE u.iden_usua = d.iden_usua AND d.item_rol ='L' AND d.item_proy ='$item_proy' AND u.iden_usua = '$iden_usua' ";
    $resul_u=mysqli_query($con,$usuarios);


   
    if ( $row=mysqli_fetch_array($resul_u) ) {
         echo 'Usuario ya agregado';
         
        } else {
            $query = "INSERT INTO inex_proyectos_usuarios (item_proy, iden_usua, item_rol, estadoLPV) VALUES ('$item_proy','$iden_usua','$rol','$estado')";
            $resul=mysqli_query($con,$query);
            
            if($resul){
                echo 'Lider agregado';
                echo $correo_usu;
            //coloca la notificACION

        }else {
            echo 'Error al agregar al lider, contacte a su desarrollador web';
        }
    }



?>