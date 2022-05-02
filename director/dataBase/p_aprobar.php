<?php
  session_start();
  include("../../config/conexion.php"); 
     
  $nomb_proy = $_POST['nomb_proy'];
  $id_proy = $_POST['id_proy'];
  $aprobado = $_POST['estado_p'];;


  $query="UPDATE inex_proyectos SET esta_proy='$aprobado', visto = 0 WHERE item_proy='$id_proy'";
  $resul=mysqli_query($con,$query);
  if(!$resul){
     echo "Error al aprobar proyecto consulta no  \$query ejecurada ";
  }else{
    
    $resul2 =mysqli_query($con,"UPDATE inex_proyectos_usuarios SET estadoLPV= 0 WHERE item_proy = '$id_proy' ");
    if (!$resul2) {
      echo 'error al actualizar, contacte a su ingeniero de sistemas';
    }

    //trae el correo    
    $datos=" SELECT inex_usuarios.correo AS correo, inex_usuarios.nomb_usua FROM inex_proyectos 
    INNER JOIN inex_usuarios ON inex_usuarios.iden_usua = inex_proyectos.`jefe_proy` WHERE inex_proyectos.item_proy = '$id_proy' "; 
    $resul_d=mysqli_query($con,$datos); 
    $row_d=mysqli_fetch_array($resul_d);
      //se envia el correo
      $correo =  $row_d['correo'];
      $asunto = "INEX - NOTIFICA - APROBADO P ";
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
                    EL USUARIO DIRECTOR <b> '.$_SESSION['NOMB'].' </b> HA APROBADO EL PROYECYO  <b> '.$nomb_proy.'  </b> 
                    ,<BR>  A PARTIR DE AHORA PUEDES SUBIR EVIDENCIAS.
                    
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