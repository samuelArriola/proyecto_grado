 
 
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/login/materialize-login.min.css"  media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="css/login/login.css?">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
</head>
<body>
	<div class="cont-login z-depth-1">
		<div class="cont-progress" id="loarU">
			<div class="progress grey lighten-2 ">
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
					<content>INEX</content>
				</div>
			</div>
			<div class="col s12 form">
				<div class="row">
					<div id="divnameuser">
						<div class="col s12 input-field" >
							<input type="text" name="nameuser" id="nameuser" class="validate" required>
							<label for="nameuser">Nombre de usuario</label>
						</div>
						<div id="msgError1" class="col error s12 red-text">
						</div>
					</div>	
				</div>
			</div>
			<div class="col s12 " style="position: relative; top: -18px">
				<div class="center">
					<button id="btnUID"  class="btn-flat btn-text btn-radius orange darken-2 white-text ">Siguiente</button>
				</div>
			</div>
		</div>
		<div id="form2" class="row cont-form">
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
					<content>INEX </content>
				</div>
			</div>
			<div class="col s12 form">
				<div class="row">	
					<div id="divpassU">
						<div class="col s12 input-field " >
							<input type="password" name="nameuser" id="passU">
							<label for="passU">Contraseña</label>
						</div>
						<div id="msgErrorpss" class="col error s12 red-text">
						</div>
					</div>	
				</div>
			</div>
			<div class="col s12 " style="position: relative; top: -18px">
				<div class="center">
					<button id="btnPass"  class="btn-flat btn-text btn-radius orange darken-2 white-text ">Siguiente</button>
				</div>
			</div>
		</div>
	
	</div>
	<!--JavaScript at end of body for optimized loading-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/login/materialize-login.min.js"></script>
  <script src="js/login/app.js"></script>
</body> 
</html>
