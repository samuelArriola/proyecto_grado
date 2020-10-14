<?php  

include("../../config/conexion.php");

    $id_u = $_POST['id_u'];
     

     $query="DELETE FROM inex_usuarios WHERE iden_usua='$id_u' ";
     $resul=mysqli_query($con,$query);

     if(!$resul){
        echo 'no eliminado, CONTACTE A SU INGENIRO DE SISTEMAS';
     }else{
        echo('Usuario borrado exitosamente');
     }


     mysqli_close($con);
     
?>
