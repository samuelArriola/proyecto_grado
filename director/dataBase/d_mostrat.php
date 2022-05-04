<?php
  include('../../config/conexion.php');
    $id_proy = $_POST['id_proy'];
    $tabla_u= "<option value='' disabled selected>Seleccione</option>";
    
    // Traer dep
    $query_dep = "SELECT * FROM inex_proyectos WHERE item_proy = '$id_proy'";
    $resul_dep = mysqli_query($con, $query_dep);
    if ($row = mysqli_fetch_array($resul_dep)){
        $query="SELECT * FROM inex_usuarios WHERE (item_dep = ".$row['item_dep']."  OR  item_dep = 3 ) ORDER BY nomb_usua" ;
        $resul_u=mysqli_query($con,$query);
      
        while ($row_u=mysqli_fetch_array($resul_u)) {
            $tabla_u.="       
            <option value=".$row_u['iden_usua'].">".$row_u['nomb_usua']." ".$row_u['apel_usua']."</option>";
        }     
        echo $tabla_u;

    }else{
      echo 'No se encontraron resultados';
    }  

// cerra conexion 
mysqli_close($con);


?>