<?php  

include("../../config/conexion.php");

    $id_u = $_POST['id_ul'];                      
    $estado = $_POST['estado'];                      
     

     $query="UPDATE inex_usuarios SET estado = '$estado' WHERE iden_usua='$id_u' ";
     $resul=mysqli_query($con,$query);

     if(!$resul){
        echo 'no eliminado, CONTACTE A SU INGENIRO DE SISTEMAS';
     }else{
        echo('ok');
     }


     mysqli_close($con);
     
?>