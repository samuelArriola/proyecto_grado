<?php 
    include("../../config/conexion.php"); 

    $itemProy = $_POST['itemProy'];
    $estado_proyecto = $_POST['EpEstado_proyecto'];
    $tabla="";
    $sql = "select * from inex_actividades as a where a.item_proy = '$itemProy'  ";
	$resul = mysqli_query($con, $sql);
    
    while ($row = mysqli_fetch_array($resul)) {
        $id_acti = $row['item_acti'];
        $nombre_act = $row['nomb_acti'];
        $evidencia = ' <li title="Evidencia " class="material-icons"><a class="hoverable  modal-trigger blue-text" onclick="mostrarEvidenciaA( echo $id_acti );" href="#modal2">attach_file</a>';
        $editar = '<li  title="Editar" class="material-icons" style="pointer-events:none; color:#999999; opacity:0.9;" ><a  class="hoverable grey-text " href="editar_actividad.php?id= '.$itemProy.' &id_a=  '.$id_acti.' ">edit</a></li>';
        $eliminar = '<li  title="Eliminar" class="material-icons" style="pointer-events:none; opacity:0.6;" ><a  class="hoverable  modal-trigger grey-text "  href="#modal1">delete</a></li>';
        
        if($row["valo_acti"]=='') $row["valo_acti"] = 0; 
        if($estado_proyecto==0 || $estado_proyecto==3){ 
            $editar= '<li title="Editar" class="material-icons"><a class="hoverable  orange-text" href="editar_actividad.php?id=  '.$itemProy.' &id_a= '.$id_acti.' ">edit</a></li>';
            $eliminar ='<li title="Eliminar" class="material-icons"><a class="hoverable  modal-trigger red-text" href="#modal1">delete</a></li>';
            $evidencia = '';
        }
    
  
         $tabla.='
            <input  type="hidden" value=" '.$id_acti.' " id="id_actividadA">  <!--id del la consulta de acticidades -->
            <input  type="hidden" value="  '. $nombre_act.' " id="nomb_acti"> 
            <tr>
                <td>  '.$row["nomb_acti"].' </td>
                <td>  '.$row["descripcion_a"].' </td>
                <td>  '.$row["fecha_ia"].' </td>
                <td>  '.$row["fecha_fa"].' </td>
                <td>  '.$row["valo_acti"].' </td>
                <td>  
                    '.$evidencia.'
                    '.$editar.'
                    '.$eliminar.'
                </td>
            </tr>  
           ';     
    }  











     echo  $tabla;
?>