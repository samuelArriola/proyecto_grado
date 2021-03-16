<?php
  include('../../config/conexion.php');
  
  session_start(); 
  $dep = $_SESSION["DEP"];
  $ide = $_SESSION["IDEN"];

     
      
    // BUSCAR PERSONA
    $tabla_u= "";
    $query="SELECT * FROM inex_usuarios WHERE item_dep = '$dep' AND iden_usua != '$ide'" ;

    if (isset($_POST['dato'])) {
     $buscar_u = $_POST['dato'];
      $query="SELECT * FROM inex_usuarios WHERE  (iden_usua LIKE '%$buscar_u%' OR nomb_usua  LIKE '%$buscar_u%' OR apel_usua LIKE'%$buscar_u%' OR correo LIKE '%$buscar_u%') AND item_dep = '$dep' AND iden_usua != '$ide'"; 
   }
      $resul_u=mysqli_query($con,$query);
       $fila =mysqli_num_rows($resul_u); //cuenta los resultados 
   
    if ($fila ) {
        while ($row_u=mysqli_fetch_array($resul_u)) {
           $id_u = $row_u['iden_usua'];
         //trae item_roll
         $queryRol = "SELECT r.item_rol, r.iden_usua FROM inex_usuarios u, inex_usuarios_roles r WHERE u.iden_usua = r.iden_usua AND r.iden_usua = '$id_u' order by r.item_rol ";
         $resultadoRol = mysqli_query($con, $queryRol);
         $rol= "";
         while($rowRol = mysqli_fetch_array($resultadoRol)) { 	
            $rol.=' '.$rowRol['item_rol'];	
         }

           $tabla_u.="          
               <tr>
                   <td> ".$row_u['iden_usua']." </td>
                   <td> ".$row_u['nomb_usua']." </td>
                   <td> ".$row_u['apel_usua']." </td>
                   <td> ".$row_u['correo']." </td>
                   <td> ".$rol." </td>
                   <td>
                       <li title='Editar' class='material-icons'><a href='u_editar.php?id_u=".$row_u['iden_usua']."' class='hoverable modal-trigger'>create</a></li>
                       <li title='Borrar' class='material-icons '><a href='#eliminaU' type='button'  onclick='recibeID(".$row_u['iden_usua'].")' class='hoverable red-text modal-trigger'>delete</a></li>                  
                    </td>
               </tr>     
       ";
        }
       
    } else {
       $tabla_u.="NO HAY RESULTADO DE BUSQUEDA...";
    }
    
    echo $tabla_u;

  
// cerra conexion 
mysqli_close($con);


?>