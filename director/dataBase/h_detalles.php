<?php
  include('../../config/conexion.php');
    $item_proy = $_POST['item_proy'];
    $tabla_u= "";
    
    $query_proy = "SELECT p.item_proy, p.nomb_proy, p.fecha_ip, CONCAT(u.nomb_usua, u.apel_usua) AS nombre  FROM inex_proyectos p INNER JOIN inex_usuarios u ON p.jefe_proy = u.iden_usua WHERE item_proy='$item_proy'";
    $resul_proy = mysqli_query($con, $query_proy);    
    if($row=mysqli_fetch_array($resul_proy)) {
        $tabla_u.="       
        <ul class='black-text'>
        <li >
            <b>Item : </b><p>".$row['item_proy']."</p> 
        </li>        
        <li>
            <b>Nombre : </b><p>".$row['nomb_proy']."</p>
        </li>        
        <li>
            <b>Jefe : </b><p>".$row['nombre']."</p>
        </li>        
        <li>
            <b>Fecha</b><p>".$row['fecha_ip']."</p>
        </li>        
    </ul>
        ";
    }     
    echo $tabla_u;

  

// cerra conexion 
mysqli_close($con);


?>