<?php 

 $nombre_proyec=$_POST['nombre_proyec'];
 $descripcion=$_POST['descripcion'];
 $iden_lider=$_POST['iden_lider'];
 $dependencia=$_POST['dependencia'];
 $fecha_ip=$_POST['fecha_ip'];
 $fecha_fp=$_POST['fecha_fp'];
 $cero = 0;
 $comentario_p ='Proyecto Exitoso';

include '../../config/conexion.php'; 

    $query="INSERT INTO inex_proyectos(nomb_proy,desc_proy,jefe_proy,visto,item_dep,fecha_ip,fecha_fp,comentarios_p)
    VALUES('$nombre_proyec','$descripcion','$iden_lider','$cero','$dependencia','$fecha_ip','$fecha_fp','$comentario_p')"; 

    $resul=mysqli_query($con,$query);

?>