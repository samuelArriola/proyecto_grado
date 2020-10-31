<?php 

 $nombre_proyec=$_POST['nombre_proyec'];
 $descripcion=$_POST['descripcion'];
 $iden_lider=$_POST['iden_lider'];
 $dependencia=$_POST['dependencia'];
 $fecha_ip=$_POST['fecha_ip'];
 $fecha_fp=$_POST['fecha_fp'];
 $cero= 0;
 $uno = 1;
 $comentario_p ='Proyecto Exitoso';

include '../../config/conexion.php'; 

    $query="INSERT INTO inex_proyectos(nomb_proy,desc_proy,jefe_proy,visto,vistoL,item_dep,fecha_ip,fecha_fp,comentarios_p)
    VALUES('$nombre_proyec','$descripcion','$iden_lider','$cero','$uno','$dependencia','$fecha_ip','$fecha_fp','$comentario_p')"; 

    $resul=mysqli_query($con,$query);

    if($resul){
        echo 'Proyecto registrado';
    }else {
        echo 'Error al registrar proyecto';
    }

?>