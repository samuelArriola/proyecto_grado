<?php 
include("../../config/conexion.php");

 $item_acty= $_POST['item_acty'];
 $fecha_e = date('Y-m-d',strtotime("-1 days"));
 $nombreE = $_POST['nombre_a']; // se usa con 'name' porque se estan mandando desde un formulario 
 $fechaC =  $fechaC = date('Y-m-d H-i-s',strtotime("+1 days +31h"));
 
 $nombre =$fechaC.$_FILES['archivo_a']['name'];
 $ruta="../evidencias/".$nombre;
 $subir=move_uploaded_file($_FILES['archivo_a']['tmp_name'], $ruta);

 $evidencia_a="INSERT INTO inex_evidencia(item_acti, nombre_e, ruta_e, fecha_e) VALUES('$item_acty','$nombreE','$ruta','$fecha_e')";
 $resul_e=mysqli_query($con,$evidencia_a);


 if ($resul_e) {
    echo 'Evidencia subida correctamente';
} else {
    echo 'Evidencia existente <br> Renombre el nombre la imagen y vuelva a intentar, sino contacte a su ingeniero de software';
}

?>