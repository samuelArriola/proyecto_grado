<?php
     session_start();
     include("../../config/conexion.php");

     $id=$_POST['id'];
     $id_p=$_POST['id_proy'];
     $jefe_proy= $_POST['jefe_proy'];
     $nomb_proy = $_POST['nomb_proy'];
     $nombre_act = $_POST['nombre_act'];

     
     //trae el correo    
       $datos="SELECT * FROM inex_usuarios WHERE iden_usua = $jefe_proy  ";
       $resul_d=mysqli_query($con,$datos);
       $row_d=mysqli_fetch_array($resul_d);

     $query="DELETE FROM inex_actividades WHERE item_acti='$id'";
     $resul=mysqli_query($con,$query);

     if(!$resul){
        echo 'no eliminado';
     }else{
         
         //envia correo
           //se envia el correo
    $correo =  $row_d['correo'];
    $asunto = "INEX - NOTIFICA - Eliminar A";
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
                   EL USUARIO LIDER <b> '.$_SESSION['NOMB'].' </b> ELIMINO LA  ACTIVIDAD '.$nombre_act.' DEL PROYECTO '.$nomb_proy.'
                   
                   
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