<?php 
     include("../../config/conexion.php"); 

     $id_proy = $_POST['id_proye'];
     $tabla="";
     $sql="SELECT u.iden_usua, u.nomb_usua, u.apel_usua, u.apel_usua, d.item_rol, u.correo, (SELECT esta_proy FROM `inex_proyectos` WHERE item_proy = '$id_proy') as estado_p FROM inex_usuarios u, inex_proyectos_usuarios d WHERE u.estado = 'ACTIVO' AND u.iden_usua = d.iden_usua AND d.item_rol ='L' AND d.item_proy ='$id_proy' ";
     $resul=mysqli_query($con,$sql);

     while($row=mysqli_fetch_array($resul)){
          $estado_p =$row['estado_p'];
          $res2="<li title='Eliminar' onclick='recibeIDLider(".$row['iden_usua'].")' class='material-icons'><a class='hoverable  modal-trigger  red-text' href='#eliminarLiderP' >delete</a></li>";

          if ($estado_p == 1 || $estado_p == 2 ) {
               $res2="<li title='Eliminar'  onclick='recibeIDLider(".$row['iden_usua'].")' class='material-icons'><a style='pointer-events:none; color:#999999; opacity:0.5;' class='hoverable  modal-trigger  red-text' href='#eliminarLiderP' >delete</a></li>";
          }

          $tabla.="
           <tr>
               <td>".$row['iden_usua']."</td>
               <td>".$row['nomb_usua']." ".$row['apel_usua']."</td>
               <td>".$row['correo']."</td>
               <td>
               ".$res2."
               </td>
          </tr> 
          ";
     }; 

     echo $tabla;
?>