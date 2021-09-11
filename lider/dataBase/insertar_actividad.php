<?php
  session_start();
  include('../../config/conexion.php');
  
    
  $nombre_act=$_POST['nombre_a'];
  $nomb_proy = $_POST['nomb_proy'];
  $jefe_proy= $_POST['jefe_proy'];
  $valor=$_POST['valor_a'];
  $id_pro2=$_POST['id_pro2']; 
  $fecha_ia=$_POST['fecha_ia'];
  $fecha_fa=$_POST['fecha_fa'];
  $descripcion_a= $_POST['descripcion_a'];

  // echo $nombre_act;
  // echo $duracion_act;
  // echo $valor;
  // echo $id_pro2;
  // echo $descripcion_a;
  
  //trae el correo    
   $datos="SELECT * FROM inex_usuarios WHERE iden_usua = $jefe_proy  ";
   $resul_d=mysqli_query($con,$datos);
   $row_d=mysqli_fetch_array($resul_d);

  $query="INSERT INTO inex_actividades(nomb_acti,descripcion_a,valo_acti,item_proy,fecha_ia,fecha_fa)VALUES('$nombre_act','$descripcion_a','$valor','$id_pro2','$fecha_ia','$fecha_fa')";
  $resul=mysqli_query($con,$query); 
  if(!$resul){
    echo 'Actividad no registrada';
  }else {
   
     //se envia el correo
    $correo =  $row_d['correo'];
    $asunto = "INEX - NOTIFICA - Crear A ";
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
                   EL USUARIO LIDER <b> '.$_SESSION['NOMB'].' </b> AGREGO UNA NUEVA ACTIVIDAD
                   AL PROYECYO '.$nomb_proy.' ,<BR>  AHORA PUEDES EDITAR Y ELIMINAR LA ACTIVIDADES <b> '.$nombre_act.' </b>
                   
                   <BR><BR> 
                    <center>
                        <a align="" href="http://216.246.112.118/~gproyectos/investigacion/" class="button">INGRESAR</a>
                    <center>
                   
                 </body>
              </html>';
    include('../../config/enviar_email.php');
  }

  // cerra conexion 
  mysqli_close($con);
?>