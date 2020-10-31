<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
</head>
<body>
			<form>
						<label for="nameuser">Identificacion de usuario</label>
						<input type="text" name="iden" id="iden">
						<a href="javascript: iniciar_sesion()">Ingresar</a>
						<br>
						<div id="capa_resultados"></div>
			</form>
			
	<!--JavaScript at end of body for optimized loading-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	//O-O-O-O-O-O-O-O-O-O-O-O-O-O-O-O-O-O-O-O-O-O-O-O
function iniciar_sesion(){
	var id = $("#iden").val();
 $('#capa_resultados').html("Espere un momento");
 $.ajax({
        url: './config/crear_sessiones.php',
        dataType: "json",
        type: 'get',
        data: {iden:id},//Aqui se especifica el parametro a enviar
        success: function(response){
          //Aqui muestra los resultados
          if(response.error == true)
              {
            	$('#capa_resultados').html(response.msg);
            	}
            else{
            	$('#capa_resultados').html('Nombre:'+response.nomb + ', Role:' + response.role);
            	if(response.role == 'D'){
            		location.href = 'director/index.php';
            	}else if (response.role == 'L') {
					location.href = 'lider/index.php';
				}
            }
        }
    });
}
</script>
</body>
</html>