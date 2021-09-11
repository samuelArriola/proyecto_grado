<?php    
       $icon_estado = array('0' => '<i class="material-icons">edit</i>',
       '1' => '<i class="material-icons">send</i>',
       '2' => '<i class="material-icons">check_circle</i>',
       '3' => '<i class="material-icons">border_color</i>');
       $color_estado = array('0' => 'grey',
       '1' => 'blue', 
       '2' => 'teal',
       '3' => 'orange');
   
       $desc_estado = array('0' => 'Construcci¨®n',
       '1' => 'Enviado',
       '2' => 'Aprobado',
       '3' => 'Corregir');



       include("../../config/conexion.php");
       $salida="";
       $q=4;
       $cero = 0;
       $uno = 1;
       $dos  = 2;
       $tres=3;

       session_start();
       $iden = $_SESSION["IDEN"];
       $role = $_SESSION["ROLE"];

       $sql = "SELECT * FROM inex_proyectos p, inex_proyectos_usuarios r WHERE p.item_proy = r.item_proy AND r.iden_usua = '$iden' AND (p.esta_proy = '$cero' OR p.esta_proy = '$tres' OR p.esta_proy = '$dos') ORDER BY r.estadoLPV ASC , p.item_proy DESC  "; 
       
       if(isset($_POST['dato'])){
          $q=mysqli_real_Escape_string($con,$_POST['dato']);
          $sql = "SELECT * FROM inex_proyectos p, inex_proyectos_usuarios r WHERE p.esta_proy LIKE '%$q%' AND p.item_proy = r.item_proy  AND r.iden_usua = '$iden' ORDER BY p.vistoL ASC ,p.item_proy DESC"; 
         };
         
         if($q==4){
            $sql = "SELECT * FROM inex_proyectos p, inex_proyectos_usuarios r WHERE p.item_proy = r.item_proy AND r.iden_usua = '$iden' AND (p.esta_proy = '$cero' OR p.esta_proy = '$tres' OR p.esta_proy = '$dos') ORDER BY r.estadoLPV ASC , p.item_proy DESC  ";   
         };

         /*  if($role == "L"){
            $sql = "SELECT * FROM inex_proyectos  WHERE esta_proy ='$cero' AND liderAcargo ='$iden'  ORDER BY vistoL ASC ,item_proy DESC "; 
         };  */
         
         //$fila=mysqli_fetch_row($resul);
       $resul=mysqli_query($con,$sql);
         
       if($resul){
            while($row=mysqli_fetch_array($resul)){
               // $visto = $row['visto'];
               $estadoLPV = $row['estadoLPV'];
               $estado = $row['esta_proy'];

               if ($estadoLPV == $cero && $estado ==$cero ) {
                $salida.="<tr>
                <td>".$row['item_proy']. '.'. $row['nomb_proy']. " <span class='new badge red' data-badge-caption='Nuevo'></span></td>
                   <td style='text-align: center;'>
                   <a onclick='estadoLPVvisto(".$row['item_proy'].",".$row['iden_usua'].",".$uno.")' class='btn-floating waves-effect waves-light' ".$color_estado[$row['esta_proy']]."  href='editar_proyecto.php?id=".$row['item_proy']."'>
                   ".$icon_estado[$row['esta_proy']]."</a> 
                   <div style='font-size: 0.8em;'>".$desc_estado[$row['esta_proy']]."</div></td>
                  </tr>";
               }else if ($estadoLPV == $cero && $estado ==$dos ) {
                  $salida.="<tr>
                  <td>".$row['item_proy']. '.'. $row['nomb_proy']. " <span class='new badge red' data-badge-caption='Aprobar'></span></td>
                     <td style='text-align: center;'>
                     <a onclick='estadoLPVvisto(".$row['item_proy'].",".$row['iden_usua'].",".$uno.")' class='btn-floating waves-effect waves-light' ".$color_estado[$row['esta_proy']]."  href='editar_proyecto.php?id=".$row['item_proy']."'>
                     ".$icon_estado[$row['esta_proy']]."</a> 
                     <div style='font-size: 0.8em;'>".$desc_estado[$row['esta_proy']]."</div></td>
                    </tr>";
               } else if ($estadoLPV == $cero && $estado ==$tres ) {
                  $salida.="<tr>
                  <td>".$row['item_proy']. '.'. $row['nomb_proy']. " <span class='new badge red' data-badge-caption='Corregir'></span></td>
                     <td style='text-align: center;'>
                     <a onclick='estadoLPVvisto(".$row['item_proy'].",".$row['iden_usua'].",".$uno.")' class='btn-floating waves-effect waves-light' ".$color_estado[$row['esta_proy']]."  href='editar_proyecto.php?id=".$row['item_proy']."'>
                     ".$icon_estado[$row['esta_proy']]."</a> 
                     <div style='font-size: 0.8em;'>".$desc_estado[$row['esta_proy']]."</div></td>
                    </tr>";
               }else {
                  $salida.="<tr>
                  <td>".$row['item_proy']. '.'. $row['nomb_proy']. "</td>
                  <td style='text-align: center;'>
                  <a class='btn-floating waves-effect waves-light' ".$color_estado[$row['esta_proy']]."  href='editar_proyecto.php?id=".$row['item_proy']."'>
                  ".$icon_estado[$row['esta_proy']]."</a> 
                  <div style='font-size: 0.8em;'>".$desc_estado[$row['esta_proy']]."</div></td>
                 </tr>";
               }   

            }
       }
       else{
          $salida.="No se encontro proyectos con este nombre ";
       } 

       echo $salida;
      
      mysqli_close($con);
?>
 