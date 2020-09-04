<?php 

echo $nombre_proyec=$_POST['nombre_proyec'];
echo $descripcion=$_POST['descripcion'];
echo $iden_lider=$_POST['iden_lider'];
echo $dependencia=$_POST['dependencia'];

include '../config/conexion.php'; 

    $query="INSERT INTO inex_proyectos(nomb_proy,desc_proy,jefe_proy,item_dep)
    VALUES('$nombre_proyec','$descripcion','$iden_lider','$dependencia')"; 

    $resul=mysqli_query($con,$query);

?>