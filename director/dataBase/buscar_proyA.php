<?php  
      session_start(); 

       $dep_u = $_SESSION["DEP"];  
       $icon_estado = array('0' => '<i class="material-icons">edit</i>',
       '1' => '<i class="material-icons">send</i>',
       '2' => '<i class="material-icons">check_circle</i>',
       '3' => '<i class="material-icons">border_color</i>');
       $color_estado = array('0' => 'grey',
       '1' => 'blue', 
       '2' => 'teal',
       '3' => 'orange');
   
       $desc_estado = array('0' => 'Construcción',
       '1' => 'Enviado',
       '2' => 'Aprobado',
       '3' => 'Corregir');



       include("../../config/conexion.php");
       $salida="";
    //    $q=4;
       $dos = 2;
    
       $sql = "SELECT * FROM inex_proyectos WHERE esta_proy ='$dos' AND (item_dep = '$dep_u' OR item_dep = '3')  ORDER BY item_proy DESC "; 

       if(isset($_POST['dato'])){
          $bucador=mysqli_real_Escape_string($con ,$_POST['dato']);
         $sql = "SELECT * FROM inex_proyectos WHERE  esta_proy ='$dos' AND	nomb_proy LIKE '%$bucador%' AND (item_dep = '$dep_u' OR item_dep = '3') ORDER BY item_proy DESC "; 
       }
       $resul=mysqli_query($con,$sql);

       //$fila=mysqli_fetch_row($resul);
       
       if($resul){
            while($row=mysqli_fetch_array($resul)){
                $salida.="<tr>
                   <td>".$row['item_proy']. '.'. $row['nomb_proy']. " </td>
                   <td style='text-align: center;'>
                   <a class='btn-floating waves-effect waves-light' ".$color_estado[$row['esta_proy']]."  href='editar_proyecto.php?id=".$row['item_proy']."'>
                   ".$icon_estado[$row['esta_proy']]."</a> 
                   <div style='font-size: 0.8em;'>".$desc_estado[$row['esta_proy']]."</div></td>
                </tr>";
            }
       }
       else{
          $salida.="No se encontro proyectos con este nombre";
       } 

       echo $salida;
      
      mysqli_close($con);
?>
 