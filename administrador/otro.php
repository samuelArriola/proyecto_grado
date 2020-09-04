<?php
include("../config/conexion.php");
$sql = "SELECT * FROM curn.usuarios_roles";
$rs = mysqli_query($con,$sql);
echo '<table class="highlight">';
while($fila = mysqli_fetch_array($rs))
  {
    echo '<tr><td>',$fila["nombre"].'</td></tr>';
  } 
echo '</table>'; 
mysqli_close($con);
?>