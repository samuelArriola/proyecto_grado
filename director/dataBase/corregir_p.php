<?php
  session_start();
  include("../../config/conexion.php"); 
     
  $nomb_proy = $_POST['nomb_proy'];
  $id_proy = $_POST['id_proy'];
  $aprobado = $_POST['estado_p'];
  $comentario_p = $_POST['comentario_p'];

  $query="UPDATE inex_proyectos SET esta_proy='$aprobado', comentarios_p ='$comentario_p' WHERE item_proy='$id_proy'";
  $resul=mysqli_query($con,$query);
  if(!$resul){
     echo 'error al actualizar';
  }else{

      //trae el correo    
      $datos=" SELECT inex_usuarios.correo AS correo, inex_usuarios.nomb_usua FROM inex_proyectos 
      INNER JOIN inex_usuarios ON inex_usuarios.iden_usua = inex_proyectos.`jefe_proy` WHERE inex_proyectos.item_proy = '$id_proy' ";
      $resul_d=mysqli_query($con,$datos); 
      $row_d=mysqli_fetch_array($resul_d);
  
        //se envia el correo
        $correo =  $row_d['correo'];
        $asunto = "INEX - NOTIFICA - CORREGIR P ";
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
                      EL USUARIO DIRECTOR <b> '.$_SESSION['NOMB'].' </b> HA ENVIADO A CORRECIÓN EL PROYECYO  <b> '.$nomb_proy.'  </b> 
                      ,<BR>  POR FAVOR DIREIJASE A LA PLATAFORMA Y HAGA LOS RESPECTIVOS CAMBIOS.
                      
                      <BR><BR> 
                        <center>
                            <a align="" href="http://216.246.112.118/~gproyectos/investigacion/" class="button">INGRESAR</a>
                        <center>
                      
                    </body>
                  </html>';
          include('../../config/enviar_email.php');
      


   
  }

  mysqli_close($con);
 

?>