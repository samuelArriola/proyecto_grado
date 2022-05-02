<?php 
     include("../../config/conexion.php"); 
     $id_acti = $_POST['id_actividad'];
     $tabla="";
     $sql="SELECT * FROM inex_evidencia WHERE item_acti = '$id_acti'";
     $resul=mysqli_query($con,$sql);
     while($row=mysqli_fetch_array($resul)){
          $estado_e = $row['estado_e'];
          $res = "<li title='' class='material-icons '>done</li>";
          
          if ($estado_e == 1) {
               $res = "<li title='visto' class='material-icons green-text '>done_all</li>";
          }
          $tabla.="
           <tr>
               <td>".$row['nombre_e']."</td>
               <td>".$row['ruta_e']."</td>                                                                                                                                       
               <td>
                    <li title='Descargar' class='material-icons'><a href='../coordinador/dataBase/".$row['ruta_e']."' download='".$row['ruta_e']."'  onclick='estado_evi(".$row['id_e'].",".$id_acti.")'>file_download</a></li>
                    ".$res."
               </td>
          </tr> 
          ";
     }; 
     echo $tabla;
?>