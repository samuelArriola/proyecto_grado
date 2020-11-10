<?php 
     include("../../config/conexion.php"); 

     $id_acti = $_POST['id_actividad'];
     $tabla="";
     $sql="SELECT * FROM inex_evidencia WHERE item_acti = '$id_acti'";
     $resul=mysqli_query($con,$sql);

     while($row=mysqli_fetch_array($resul)){
          $tabla.="
           <tr>
               <td>".$row['nombre_e']."</td>
               <td>".$row['ruta_e']."</td>
               <td>
               <li title='Descargar' class='material-icons'><a href='dataBase/".$row['ruta_e']."' download='".$row['ruta_e']."'>file_download</a></li>
               <li title='Eliminar' class='material-icons'><a class='hoverable  modal-trigger  red-text' href='#eliminarEvidencia' onclick=\"recibeIdEvi('".$row['id_e']."','".$row['ruta_e']."')\" >delete</a></li>
               </td>
          </tr> 
          ";
     }; 

     echo $tabla;


   
    

         
     

?>