<?php
    session_start();
    include("../../config/conexion.php"); 
    
    $id_p=$_POST['id_pro2'];
    $id_a=$_POST['id_a2'];
    $jefe_proy = $_POST['jefe_proy'];
    $nomb_proy = $_POST['nomb_proy'];
    $nombre_act=$_POST['nombre_a'];
    $descripcion_a=$_POST['descripcion_a'];
    $valor=$_POST['valor_a'];
    $fecha_ia=$_POST['fecha_ia'];
    $fecha_fa=$_POST['fecha_fa'];

    // echo $jefe_proy;
    // echo $nomb_proy;
    // echo $_SESSION['NOMB'];

    //trae el correo    
   $datos="SELECT * FROM inex_usuarios WHERE iden_usua = $jefe_proy  ";
   $resul_d=mysqli_query($con,$datos);
   $row_d=mysqli_fetch_array($resul_d);
   echo  $row_d['correo'];

   $query="UPDATE inex_actividades SET nomb_acti = '$nombre_act', descripcion_a='$descripcion_a',  valo_acti = '$valor', fecha_ia = '$fecha_ia', fecha_fa= '$fecha_fa' WHERE item_acti = '$id_a'";

    $resul=mysqli_query($con,$query); 
    if(!$resul){
      echo 'Actividad no actualizada';
    }else{
<<<<<<< HEAD
      echo'Actividad actualizada';
    }

=======
     
     //se envia el correo
     $correo =  $row_d['correo'];
     $asunto = "INEX - NOTIFICA - Editar A ";
     $mensaje ='<html>
                    <head> 
                        <style>
                            .button {
                                    color: white;
                                    background-color: orange;
                                    border: none;
                                    border-radius : 23px;
                                    padding: 10px 20px;
                                    text-align: center;
                                    text-decoration: none;
                                    display: inline-block;
                                    font-size: 16px;
                                    margin: 4px 2px;
                                    cursor: pointer;
                                    transition-duration: 0.4s;
                            }
                            .button:hover {
                                    background-color: #F7DC6F;
                                    color: white;
                            }
                        </style>
                    </head> 
                 <body>
                   EL USUARIO LIDER <b> '.$_SESSION['NOMB'].' </b> HIZO MODIFICACIONES A  LA ACTIVIDAD <b> '.$nombre_act.' </b>
                   DEL PROYECYO '.$nomb_proy.' ,<BR>  ENTRA A LA PLATAFORMA PARA OBSERVA LOS CAMBIOS.
                   
                   <BR><BR> 
                    <center>
                        <a align="" href="http://216.246.112.118/~gproyectos/investigacion/" class="button">INGRESAR</a>
                    <center>
                   
                 </body>
              </html>';
     include('../../config/enviar_email.php');
    } 
 
>>>>>>> 08f137702f8b9a5b19ec697c84494b530dc8d3d6
     // cerra conexion 
    mysqli_close($con);

?>