<?php
  session_start();
  include("../../config/conexion.php"); 
     
  $dep = $_SESSION["DEP"];
  $id_proy = $_POST['id_proy'];
  $aprobado = $_POST['estado_p'];
  $nomb_proy = $_POST['nomb_proy'];
  

  $query="UPDATE inex_proyectos SET esta_proy='$aprobado', visto = 0 WHERE item_proy='$id_proy'";
  $resul=mysqli_query($con,$query);
  if(!$resul) {
    echo 'error al actualizar, contacte a su ingeniero de sistemas';
  }else{

      //trae el correo    
    $datos=" SELECT inex_usuarios.correo AS correo FROM inex_usuarios_roles INNER JOIN inex_usuarios ON inex_usuarios_roles.iden_usua = inex_usuarios.iden_usua 
    WHERE inex_usuarios_roles.item_rol = 'D' AND (inex_usuarios.item_dep = '$dep' OR inex_usuarios.item_dep = 3) ";
    $resul_d=mysqli_query($con,$datos); 
    
    while($row_d=mysqli_fetch_array($resul_d)){
  
      //se envia el correo
      $correo =  $row_d['correo'];
      $asunto = "INEX - NOTIFICA - ENVIADO ";
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
                    EL USUARIO COORDINADOR <b> '.$_SESSION['NOMB'].' </b> A ENVIADO EL PROYECYO  <b> '.$nomb_proy.'  </b> 
                    ,<BR>  AHORA LO PUEDES APROBAR O MARDARLO A CORRECCIÓN </b>
                    
                    <BR><BR> 
                      <center>
                          <a align="" href="http://216.246.112.118/~gproyectos/investigacion/" class="button">INGRESAR</a>
                      <center>
                    
                  </body>
                </html>';
        include('../../config/enviar_email.php');
    }
 
  } 

  mysqli_close($con);
 

?>