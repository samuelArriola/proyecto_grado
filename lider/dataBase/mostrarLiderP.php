<?php 
     include("../../config/conexion.php"); 

     $id_proy = $_POST['id_proye'];
     $tabla="";
     $sql="SELECT u.iden_usua, u.nomb_usua, u.apel_usua, d.item_rol, u.correo FROM inex_usuarios u, inex_proyectos_usuarios d WHERE u.iden_usua = d.iden_usua AND d.item_rol ='L' AND d.item_proy ='$id_proy' ";
     $resul=mysqli_query($con,$sql);

     while($row=mysqli_fetch_array($resul)){

          $tabla.="
           <tr>
               <td>".$row['iden_usua']."</td>
               <td>".$row['nomb_usua']."</td>
               <td>".$row['correo']."</td>
              
          </tr> 
          ";
     }; 

     echo $tabla;
?>