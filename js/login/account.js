//validar recaptch para el aprovicionamiento de cuenta de estudiante.
function recaptch(token){
	$.ajax({
		url: './config/recaptcha.php',
		type: 'GET',
		data: {token: token},
		beforeSend: function(){
			var div = '<div style="height: 20px; width: 20px; margin-top: 8px;" class="preloader-wrapper small active">'
		    +'<div style="border-color: #616161;" class="spinner-layer spinner-blue-only">'
		    +'<div class="circle-clipper left">'
		    +'<div class="circle"></div>'
		    +'</div><div class="gap-patch">'
		    +'<div class="circle"></div>'
		    +'</div><div class="circle-clipper right">'
		    +'<div class="circle"></div>'
		    +'</div>'
		   	+'</div>'
		  	+'</div>';
		  	$("#btnCuenta").html(div).attr('disabled', true);
		},
		success: function(data) {
			if (data == true) {
				//se llama la function valAprovicionCuenta
				moduleaccount.valAprovicionCuenta();
			}else{
				$("#btnCuenta").html("<strong>Continuar</strong>").prop('disabled', false);
			}
		}
	});
}

//validar recaptch para el aprovicionamiento de cuenta de docente.
function recaptch2(token){
	$.ajax({
		url: './config/recaptcha.php',
		type: 'GET',
		data: {token: token},
		beforeSend: function(){
			var div = '<div style="height: 20px; width: 20px; margin-top: 8px;" class="preloader-wrapper small active">'
		    +'<div style="border-color: #616161;" class="spinner-layer spinner-blue-only">'
		    +'<div class="circle-clipper left">'
		    +'<div class="circle"></div>'
		    +'</div><div class="gap-patch">'
		    +'<div class="circle"></div>'
		    +'</div><div class="circle-clipper right">'
		    +'<div class="circle"></div>'
		    +'</div>'
		   	+'</div>'
		  	+'</div>';
		  	$("#btnCuenta").html(div).attr('disabled', true);
		},
		success: function(data) {
			if (data == true) {
				//se llama la function valAprovicionCuenta
				moduleaccount.valAprovicionCuentaDoc();
			}else{
				$("#btnCuenta").html("<strong>Continuar</strong>").prop('disabled', false);
			}
		}
	});
}

//se utiliza funcion keyup para utilizar funcion click al presionar la tecla 'enter'
//en los siguientes elementos utilizado.
$("#Xdsz").keyup(function(event){
	if(event.keyCode == 13){
		$("#btnCuenta").click();
	}
});

$("#okFK").keyup(function(event){
	if(event.keyCode == 13){
		$("#auth #btnNext").click();
	}
});

$("#form3 input[name=tipo]").keyup(function(event){
	if(event.keyCode == 13){
		$("#form3 #btnNext").click();
	}
});

$("#form4").on('keyup',"#jHXi,#email,#phone", function(event){
	if(event.keyCode == 13){
		$("#form4 #btnNext").click();
	}
});

$("#form5").on('keyup',"#fOgH,#email,#phone", function(event){
	if(event.keyCode == 13){
		$("#form5 #btnNext").click();
	}
});

'use strict';
//se inicializa variable Interval.
var Interval;

//se crea funcion 'moduleAccount'.
function moduleAccount(){
	self = this;

	self.config = [];
	self.xWSo = "xAweDQw";
	self.correAlt = false;

	self.init = function(){
		$.get('./config/config.json', function(json, textStatus) {
			self.config = json;
			$("#name_app").html("<strong>"+json.name_app+"</strong>");
		});
	}

	self.validateDni = function(type){
		var dni = $("#Xdsz");
		if(dni.val() == ""){
			dni.focus();
			M.toast({html: "Debe digitar numero de identificación."});
			return false;
		}else{
			if(isNaN(parseInt(dni.val()))){
				dni.focus();
				M.toast({html: "Campo solo numerico."});
				return false;
			}
			if(dni.val().indexOf(".") > -1 || dni.val().indexOf(",") > -1){
				dni.focus();
				M.toast({html: "Numero de telefono no puede contener puntos ni comas."});
				return false;
			}
		}
		if (type == '1') {
			$("#btnRecaptcha").click();
		}else if(type == '2'){
			$("#btnRecaptcha2").click();
		}	
	}

	self.valAprovicionCuenta = function(){
		$("#msgError").hide('slow');
		var dni = $("#Xdsz").val();

		$.ajax({
			url: './config/valAprovicionCuenta.php',
			type: 'POST',
			data: {dni: dni},
			success: function(data){
				if(data.status == "1"){
					$("#form2 #nomb_user").text(data.nombre);
					self.backForm("#auth","#form1");
				}else if(data.status == "2"){
					if(data.emailalt == "true" && data.phone == "true"){
						$("#form2 #nomb_user").text(data.nombre);
						self.backForm("#auth","#form1");
					}else{
						$("#Xdsz").attr("disabled", true);
						$("#btnCuenta").html("<strong>volver a intentarlo</strong>").prop('disabled', false).attr('onclick','location.reload();');
						$("#msgError").css("font-size","1.1rem").html(data.msg).show('slow');
					}
				}else{
					$("#Xdsz").attr("disabled", true);
					$("#btnCuenta").html("<strong>volver a intentarlo</strong>").prop('disabled', false).attr('onclick','location.reload();');
					$("#msgError").css("font-size","1.1rem").html(data.msg).show('slow');
				}				
			}
		});		
	}

	self.valAprovicionCuentaDoc = function(){
		$("#msgError").hide('slow');
		var dni = $("#Xdsz").val();

		$.ajax({
			url: './config/valAprovicionCuentaDoc.php',
			type: 'POST',
			data: {dni: dni},
			success: function(data){	
				if(data.status == "1"){
					$("#form2 #nomb_user").text(data.nombre);
					self.backForm("#auth","#form1");
				}else{
					$("#Xdsz").attr("disabled", true);
					$("#btnCuenta").html("<strong>volver a intentarlo</strong>").prop('disabled', false).attr('onclick','location.reload();');
					$("#msgError").css("font-size","1.1rem").html(data.msg).show('slow');
				}				
			}
		});		
	}

	self.authorization = function(type){
		var	okFK = $("#okFK:checked").val();
		if(okFK == undefined){
			M.toast({html: "Debe aceptar el uso y tratamiento de los datos personales."});
			return false;
		}
		$.ajax({
			url: './config/authorization.php',
			type: 'POST',
			data: {okFK: okFK,bd: "1"},
			beforeSend: function(){
				var div = '<div style="height: 20px; width: 20px; margin-top: 8px;" class="preloader-wrapper small active">'
				    +'<div style="border-color: #616161;" class="spinner-layer spinner-blue-only">'
				    +'<div class="circle-clipper left">'
				    +'<div class="circle"></div>'
				    +'</div><div class="gap-patch">'
				    +'<div class="circle"></div>'
				    +'</div><div class="circle-clipper right">'
				    +'<div class="circle"></div>'
				    +'</div>'
				   	+'</div>'
				  	+'</div>';
			  	$("#auth #btnNext").html(div).attr('disabled', true);
			},
			success: function(data){
				$("#auth #btnNext").html("aceptar").prop('disabled', false);
				if(data){
					var f = new Date();
					if(f.getHours() >= 11 && f.getHours() <=20){
						if(type=='1'){
							self.backForm("#form2","#auth");
						}else{
							self.generateInputs(null,0,null,true);
							self.backForm("#form2,#form4","#auth,#form3");
						}						
					}else{
						self.generateInputs("Correo personal",1,"email",true);
						self.backForm("#form2,#form4","#auth,#form3");
					}
					
				}else{
					M.toast({html: "Se presento un error, vuelca a intentarlo."});
				}
			}
		});	
	}

	self.typeValidate = function(){
		var tipo = $("input[name='tipo']:checked");
		if(tipo.val() == undefined){
			tipo.focus();
			M.toast({html: "Debe elegir una opcion."});
			return false;
		}
		var name= "",texto = "";
		$("#form4 .box").empty();
		switch(tipo.val()){
			case '1':
				name = "Correo personal";				
				self.generateInputs(name,1,"email");
				break;
			case '2':
				name = "Numero de telefono";
				self.generateInputs(name,2,"phone");
				break;
			case '3':
				self.generateInputs(name,0);
				break;
		}
		self.backForm("#form4","#form3");
		//console.log(tipo);
	}

	self.sendCode = function(tipo){
		var phone = "",email = "", jHXi = "";
		if($("#form4 #email").length > 0){
			email = $("#form4 #email").val();
			if(email == ""){
				$("#form4 #email").focus();
				M.toast({html: "Debe digitar su correo personal."});
				return false;
			}
			if(!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email))){
				$("#form4 #email").focus();
				M.toast({html: "Debe digitar correo electronico."});
				return false;
			}
		}
		if($("#form4 #phone").length > 0){
			phone = $("#form4 #phone").val();
			if (phone == "") {
				$("#form4 #phone").focus();
				M.toast({html: "Debe digitar su numero de telefono movil."});
				return false;
			}else{
				if(isNaN(parseInt(phone))){
					$("#form4 #phone").focus();
					M.toast({html: "Campo solo numerico."});
					return false;
				}
				if(phone.indexOf(".") > -1 || phone.indexOf(",") > -1){
					$("#form4 #phone").focus();
					M.toast({html: "Numero de telefono no puede contener puntos ni comas."});
					return false;
				}
				if(phone.length < 10){
					$("#form4 #phone").focus();
					M.toast({html: "Numero de telefono invalido."});
					return false;
				}
			}
		}

		if($("#form4 #jHXi").length > 0){
			jHXi = $("#form4 #jHXi").val();
			if(jHXi == ""){
				$("#form4 #jHXi").focus();
				var msg = "";
				if(tipo == 1) msg = "correo personal."; 
				if(tipo == 2) msg = "numero de telefono movil.";
				M.toast({html: "Debe digitar su "+msg});
				return false;
			}else{
				if(tipo == 1){
					if(!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(jHXi))){
						$("#form4 #email").focus();
						M.toast({html: "Debe digitar correo electronico."});
						return false;
					}
				}
				if(tipo == 2){
					if(isNaN(parseInt(jHXi))){
						$("#form4 #jHXi").focus();
						M.toast({html: "Campo solo numerico."});
						return false;
					}
					if(jHXi.indexOf(".") > -1 || jHXi.indexOf(",") > -1){
						$("#form4 #jHXi").focus();
						M.toast({html: "Numero de telefono no puede contener puntos ni comas."});
						return false;
					}
					if(jHXi.length < 10){
						$("#form4 #jHXi").focus();
						M.toast({html: "Numero de telefono invalido."});
						return false;
					}
				}			
			}
		}

		$.ajax({
			url: './config/sendCode.php',
			type: 'GET',
			data: {phone: phone, email: email, jHXi: jHXi, type: tipo},
			beforeSend: function(){
				var div = '<div style="height: 20px; width: 20px; margin-top: 8px;" class="preloader-wrapper small active">'
			    +'<div style="border-color: #616161;" class="spinner-layer spinner-blue-only">'
			    +'<div class="circle-clipper left">'
			    +'<div class="circle"></div>'
			    +'</div><div class="gap-patch">'
			    +'<div class="circle"></div>'
			    +'</div><div class="circle-clipper right">'
			    +'<div class="circle"></div>'
			    +'</div>'
			   	+'</div>'
			  	+'</div>';
			  	$("#form4 #btnBack").attr('disabled', true);
			  	$("#form4 #btnNext").html(div).attr('disabled', true);
			},
			success: function(data){
				$("#form4 #btnBack").prop('disabled', false);
				$("#form4 #btnNext").html("<strong>Continuar</strong>").prop('disabled', false);
				if(data){					
					self.generateInputCode(tipo);
					self.timeRegresive();
					//$("#form5 #btnBack").attr('disabled', true);
					self.backForm('#form5','#form4');
				}
			}
		});
	}

	self.validateCode = function(tipo){
		var phone = "",email = "", fOgH = "";
		if($("#form5 #email").length > 0){
			email = $("#form5 #email").val();
			if(email == ""){
				$("#form5 #email").focus();
				M.toast({html: "Debe digitar codigo."});
				return false;
			}else if(email.length != 4){
				$("#form5 #email").focus();
				M.toast({html: "Codigo invalido."});
				return false;
			}
		}

		if($("#form5 #phone").length > 0){
			phone = $("#form5 #phone").val();
			if(phone == ""){
				$("#form5 #phone").focus();
				M.toast({html: "Debe digitar codigo."});
				return false;
			}else if(phone.length != 4 ){
				$("#form5 #phone").focus();
				M.toast({html: "Codigo invalido."});
				return false;
			}
		}

		if($("#form5 #fOgH").length > 0){
			fOgH = $("#form5 #fOgH").val();
			if(fOgH == ""){
				$("#form5 #fOgH").focus();
				M.toast({html: "Debe digitar codigo."});
				return false;
			}else if(fOgH.length != 4 ){
				$("#form5 #fOgH").focus();
				M.toast({html: "Codigo invalido."});
				return false;
			}
		}

		$.ajax({
			url: './config/validateCode.php',
			type: 'GET',
			data: {phone: phone, email: email, fOgH: fOgH, type: tipo},
			beforeSend: function(){
				var div = '<div style="height: 20px; width: 20px; margin-top: 8px;" class="preloader-wrapper small active">'
			    +'<div style="border-color: #616161;" class="spinner-layer spinner-blue-only">'
			    +'<div class="circle-clipper left">'
			    +'<div class="circle"></div>'
			    +'</div><div class="gap-patch">'
			    +'<div class="circle"></div>'
			    +'</div><div class="circle-clipper right">'
			    +'<div class="circle"></div>'
			    +'</div>'
			   	+'</div>'
			  	+'</div>';
			  	$("#form5 #btnBack").attr('disabled', true);
			  	$("#form5 #btnNext").html(div).attr('disabled', true);
			},
			success: function(data){
				if(data == false){
					$("#form5 #btnBack").prop('disabled', false);
					$("#form5 #btnNext").html("<strong>Continuar</strong>").prop('disabled', false);
					M.toast({html: "Codigo invalido."});
				}else{
					$("#form6 #nomb_user").text(data.nombre);
					$("#form6 #oFdj").val(data.email);
					$("#form6 #sendTipo").text(data.enviado);
					self.xWSo = data.clave;
					self.backForm("#form6","#form2");
				}
			}
		});	
	}

	/*********************************************/
	self.generateInputs = function(name,tipo,icon,back){
		var input = '';
		if(tipo == 0){
			input = '<p style="font-size: 1.1rem;">Escribe tu correo personal y numero de telefono movil para continuar.</p>'
				+'<div style="display: block;" class="input-field col s12 m6">'+ '<input type="text" name="email" id="email" autocomplete="off">'
				+ '<label for="email">Correo personal</label>'
				+ '</div>'
				+ '<div class="col s12 m6">'
				+ '<div class="input-field">'+ '<input type="number" min="0" name="phone" id="phone" autocomplete="off">'
				+ '<label for="phone">Numero de telefono</label>'
				+ '</div>'
				+ '</div>';
		}else{
			input = '<p style="font-size: 1.1rem;">Escribe tu '+((tipo==1)? 'correo personal':'numero de telefono movil')+' para continuar.</p>'
				+ '<div class=" col s12 m6">'+ '<div '+((tipo != 2)? 'style="display: block;"':'')+ ' class="input-field">'				
				+ '<input name="jHXi" id="jHXi" '+((tipo==2)?'type="number" min="0"':'type="text"')+' autocomplete="off">'
				+ '<label for="jHXi">'+name+'</label>'
				+ '</div>'
				+ '</div>';
		}

		input += '<div class="input-field col s12 m12 center">';
		if(back == undefined){
			input += '<button id="btnBack" onclick="moduleaccount.backForm('+ "'" + '#form3' + "'" +','+"'" + '#form4' + "'"+')" class="btn-flat btn-text grey lighten-2 grey-text text-darken-1"><b>Regresar</b></button>';
		}
		input += '<button id="btnNext" onclick="moduleaccount.sendCode('+ tipo +')" class="btn-flat btn-text orange accent-2 white-text"><strong>Continuar</strong></button>'
				+ '</div>';
		
		$("#form4 .box").html(input);
	}

	self.generateInputCode = function(tipo){
		var input = '';
		if(tipo == 0){
			input = '<div class="col s12">'
			 		+ '<p style="font-size: 1.1rem;float: left">Para finalizar digite los codigo de verificacion.</p>'
			 		+ '</div>'
			 		+ '<div class="col s12">'
					+ '<img src="img/orig.gif" width="130px;">'
					+ '</div>'
					+ '<div class="col s12 m6 l6">'
					+ '<p>Codigo enviado a <br> <strong>'+$("#form4 #email").val()+'</strong>:</p>'
					+ '<div class="col s8 codigo">'
					+ '<input type="number" class="center" min="0" max="9999"  name="email" id="email" autocomplete="off">'
					+ '<label for="email">Escribir codigo</label>'
					+ '</div>'
					+ '</div>'
					+ '<div class="col s12 m6 l6">'
					+ '<p>Codigo enviado a<br> <strong>'+$("#form4 #phone").val()+'</strong>:</p>'
					+ '<div class=" col s8 codigo">'
					+ '<input type="number" class="center" min="0" max="9999"  name="phone" id="phone" autocomplete="off">'
					+ '<label for="phone">Escribir codigo</label>'
					+ '</div>'
					+ '</div>'
					+ '<div class="col s12">'
					+ '<strong id="timeRegresive"></strong>'
					+ '</div>';
		}else{
			input = '<div class="col s12">'
					+'<p style="font-size: 1.1rem;float:left">Para finalizar digite el codigo de verificacion.</p>'
					+ '</div>'
					+ '<div class="col s12">'
					+ '<img src="img/orig.gif" width="130px;">'
					+ '</div>'
					+ '<div class="col s12 m6 l3 codigo">'
					+ '<p>Codigo enviado a <br><strong>'+$("#form4 #jHXi").val()+'</strong>:</p>'
					+ '<input type="number" class="center"  min="0" max="9999" name="fOgH" id="fOgH" autocomplete="off">'
					+ '<label for="fOgH">Escribir codigo</label>'
					+ '</div>'
					+ '<div class="col s12">'
					+ '<strong id="timeRegresive"></strong>'
					+ '</div>';
		}
		input += '<div class="input-field col s12 m12">' 
				//+'<div class="input-field col s12 m6">'
				+ '<button id="btnBack" onclick="moduleaccount.backForm('+ "'" + '#form4' + "'" +','+"'" + '#form5' + "'"+')" class="btn-flat btn-text grey lighten-2 grey-text text-darken-1"><b>Regresar</b></button>'
				//+ '</div>'
				//+ '<div class="input-field col s12 m6">'
				+ '<button id="btnNext" onclick="moduleaccount.validateCode('+ tipo +')" class="btn-flat btn-text orange accent-2 white-text"><strong>Continuar</strong></button>'
				+ '</div>';
		$("#form5 .box").html(input);
	}

	self.backForm = function(next,back){
		if(back == "#form5"){
			clearInterval(Interval);
		}
		$(back).addClass("hide");
		$(next).removeClass("hide");
	}

	self.timeRegresive = function(){
		var minute = 5;
		var second = 0;
		var finish = false;
		$("#timeRegresive").text("0"+minute+":0"+second);
		Interval = setInterval(function(){
			if(!finish){
				if(minute == 0 && second == 0){
					$.get('./config/deleteCode.php', function(data) {
						if(data){ 
							clearInterval(Interval);
							finish= true; 
							//$("#form5 #btnBack").prop('disabled', false);
						}
					});
					return false;
				}

				if(second==0){
					minute--; 
					second = 60;
				}

				second--;
				
				var time = ((minute <10)? "0"+minute:minute)+":"+((second < 10)? "0"+second:second);
				$("#timeRegresive").text(time);
			}
		}, 1000);
	}

	self.showPassword = function(){
		if($("#showPassword .material-icons").text() == "visibility"){
			$("#UtfJ").val("**********").removeClass('active');
			$("#showPassword .material-icons").text('visibility_off');
		}else{
			$("#UtfJ").val(self.xWSo).addClass('active');
			$("#showPassword .material-icons").text('visibility');
		}	
	}

	self.getTextAuth = function(){
		$.ajax({
			url: './config/getAuth.php',
			type: 'GET',
			data: {bd: "1"},
			success: function(data){
				$("#auth #texto").append(data);
			}
		});	
	}
}

var moduleaccount = new moduleAccount();

moduleaccount.init();
moduleaccount.getTextAuth();