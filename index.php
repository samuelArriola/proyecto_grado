<?php 
session_start();
if(!isset($_SESSION["IDEN"])){
$config = json_decode(file_get_contents("config/config.json"));
if($config->storage == "session"){
	/*verifiar variable de session
	header("Location: ".$config->redirect);*/
	
	if (isset($_GET['c']) && !empty($_GET['c'])) 
		{
		//Ejecuta conexion a la base de datos
		$con = mysqli_connect("atlas.curn.edu.co","userapp","uninunezmovil","appuninunez");
		if (!$con){ echo "Error: no se pudo conectar a MySQL.". PHP_EOL; exit; } //Verifica si se establecío conexión
		if (!mysqli_set_charset($con, "utf8")) { printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($con)); exit; }
		$sql = "SELECT * FROM sesiones WHERE cookie='". $_GET['c'] ."'"; //Consulta en la base de datos la cookies
		if($rs = mysqli_query($con,$sql)) //Ejecuta y verifica si hay resultados
			{
			if($row = mysqli_fetch_assoc($rs))//Convierte y verifica los resultados en un arreglo
				{
				mysqli_close($con);						//Cierra la conexión a la base de datos activa
				$iden = $row["dni"]; 
				$usua = $row["usuario"];
				$opc="";
				include("config/crear_sessiones.php");
				if(!$resul->error)
					header("location: ./verificar/");
				}
			}
		}
		
}else if($config->storage == "cookie"){
	/*verifiar variable de cookie

	header("Location: ".$config->redirect);*/
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/login/materialize-login.min.css"  media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="css/login/login.css?<?php echo strtotime('now'); ?>">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
</head>
<body>
	<div class="cont-login z-depth-1">
		<div class="cont-progress">
			<div class="progress grey lighten-2 hide">
			    <div class="indeterminate orange darken-1"></div>
			</div>
		</div>
		
		<div id="form1" class="row cont-form">
			<div class="col s12">
				<div class="logo center">
					<img src="img/logo.png">
				</div>
			</div>
			<div class="col s12 center">
				<h1 class="text-subtitle">
					<content>Acceder</content>
				</h1>
				<div id="name_app" class="text-normal">
					<content>Ir a </content>
				</div>
			</div>
			<div class="col s12 form">
				<div class="row">
					<div class="col s12 input-field">
						<input type="text" name="nameuser" id="nameuser">
						<label for="nameuser">Nombre de usuario</label>
					</div>
					<div id="msgError1" class="col error s12 red-text">
					</div>
					<div class="col s12">
						<!--<a href="#" class="text-weight orange-text darken-2">¿Olvidastes el nombre de usuario?</a>-->
					</div>
					<div class="col s12">
						<p class="grey-text"></p>
					</div>
				</div>
			</div>
			<div class="col s12 ">
				<div class="row">
					<div class="col s6 ">
						<!--<a href="./newaccount.php" class="btn-flat truncate btn-text white orange-text text-darken-2 waves-effect waves-block waves-orange waves left">Crear cuenta</a>-->
					</div>
					<div class="col s12 ">
						<button id="btnUID" onclick="moduleLogin.getUID()" class="btn-flat btn-text btn-radius orange darken-2 white-text right">Siguiente</button>
					</div>
				</div>
			</div>
		</div>
		<div id="form2" class="row cont-form hide">
			<div class="col s12">
				<div class="logo center">
					<img src="img/logo.png">
				</div>
			</div>
			<div class="col s12 center">
				<h1 class="text-subtitle">
					<content>Te damos la bienvenida</content>
				</h1>
				<div id="user_app" class="text-normal center">
					<div class="cont-user">
						<a href="#" onclick="moduleLogin.backForm()" class="grey-text text-darken-3">
							<div>
								<i class="material-icons orange-text text-darken-2">account_circle</i>
							</div>						
							<div class="user grey-text text-darken-2">-</div>
							<div>
								<i class="material-icons">keyboard_arrow_down</i>
							</div>	
						</a>					
					</div>
				</div>
			</div>
			<div class="col s12 form">
				<div class="row">
					<div class="col s12 input-field">
						<input type="password" name="passuser" id="passuser">
						<label for="passuser">Ingresa tu contraseña</label>
					</div>
					<div id="msgError2" class="col error s12 red-text">
						
					</div>
					<div class="col s12">
						<!--<a href="#" onclick="moduleLogin.resetPassword()" class="text-weight orange-text darken-2">¿Olvidaste la contraseña?</a>-->
					</div>
					<div class="col s12">
						<p class="grey-text"></p>
					</div>
				</div>
			</div>
			<div class="col s12 ">
				<div class="row">
					<div class="col s6 ">
					</div>
					<div class="col s6 ">
						<button onclick="moduleLogin.autenticarPersona()" id="btnAuth" class="btn-flat btn-text btn-radius orange darken-2 white-text right">Siguiente</button>
					</div>
				</div>
			</div>  
		</div> 
	</div>
	<!--JavaScript at end of body for optimized loading-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/login/materialize-login.min.js"></script>
    <script type="text/javascript" src="js/login/login.js?<?php echo strtotime('now'); ?>"></script>
</body> 
</html>
<?php
}else{
?>
<script type="text/javascript">
	window.location.href = 'verificar/';
</script>
<?php
}
?>