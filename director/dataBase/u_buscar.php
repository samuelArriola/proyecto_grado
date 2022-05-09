<?php
  include('../../config/conexion.php');
  
  session_start(); 
  $dep = $_SESSION["DEP"];
  $ide = $_SESSION["IDEN"];
  
    // BUSCAR PERSONA
    $tabla_u= "";
    $query="SELECT * FROM inex_usuarios WHERE  item_dep = '$dep' AND iden_usua != '$ide'" ;

    if (isset($_POST['dato'])) {
     $buscar_u = mysqli_real_Escape_string ($con,$_POST['dato']);
     $query="SELECT * FROM inex_usuarios WHERE    (iden_usua LIKE '%$buscar_u%' OR nomb_usua  LIKE '%$buscar_u%' OR apel_usua LIKE'%$buscar_u%' OR correo LIKE '%$buscar_u%') AND item_dep = '$dep'"; 
   }
   $resul_u=mysqli_query($con,$query);
   $fila =mysqli_num_rows($resul_u); //cuenta los resultados 
   
   if ($fila ) {
      while ($row_u=mysqli_fetch_array($resul_u)) {
         $id_u = $row_u['iden_usua'];
         $eliminar ="<li title='Borrar' class='material-icons '><a href='#eliminaULogico' type='button'  onclick='recibeIDLogico(".$row_u['iden_usua'].")' class='hoverable red-text modal-trigger'>delete</a></li>";
         $restaurar =" <li title='Restaurar' class='material-icons '><a href='#restaurarULogico' type='button'  onclick='recibeIDLogicoREST(".$row_u['iden_usua'].")' class='hoverable orange-text modal-trigger'>restore</a></li>";
         $editar = "<li title='Editar' class='material-icons'><a href='u_editar.php?id_u=".$row_u['iden_usua']."' class='hoverable modal-trigger'>edit</a></li>";  
         $herencia = "<li title='Herencia de proyecto' class='material-icons'><a href='herencia.php?id_u=".$row_u['iden_usua']."' class='hoverable modal-trigger green-text'>swap_horiz</a></li>";  
         
           if($row_u['estado'] ==='ACTIVO' ){
               $restaurar="";
           }else{
               $eliminar="";
               $editar="";
               $herencia="";

           }

        /*  //trae item_roll
         $queryRol = "SELECT r.item_rol, r.iden_usua FROM inex_usuarios u, inex_usuarios_roles r WHERE u.iden_usua = r.iden_usua AND r.iden_usua = '$id_u' order by r.item_rol ";
         $resultadoRol = mysqli_query($con, $queryRol);
         $rol= "";
         while($rowRol = mysqli_fetch_array($resultadoRol)) { 	
            $rol.=' '.$rowRol['item_rol'];	
              <td> ".$rol." </td> //colocar rol en la tabla para resturar los cambios
            <li title='Borrar' class='material-icons '><a href='#eliminaU' type='button'  onclick='recibeID(".$row_u['iden_usua'].")' class='hoverable red-text modal-trigger'>delete</a></li>     //eliminar

         } */
           $tabla_u.="          
               <tr>
                   <td> ".$row_u['iden_usua']." </td>
                   <td> ".$row_u['nomb_usua']." </td>
                   <td> ".$row_u['apel_usua']." </td>
                   <td> ".$row_u['correo']." </td>
                   <td> ".$row_u['estado']." </td>
                   <td>
                        ". $editar ."  
                        ".$herencia."
                        ".$restaurar."
                        ".$eliminar."                
                                         
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