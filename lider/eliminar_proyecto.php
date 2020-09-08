<?php  

include("../config/conexion.php");

    $item = $_GET['id_p'];
     

     $query="DELETE FROM inex_proyectos WHERE  item_proy='$item'";

     $resul=mysqli_query($con,$query);

     if(!$resul){
        echo 'no eliminado';
     }else{
        header('location: lista_proyectos.php');
     }
?>



?>