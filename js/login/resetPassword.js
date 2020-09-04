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
		  	$("#btnReset").html(div).attr('disabled', true);
		},
		success: function(data) {
			if (data == true) {
				moduleResePassword.sendEmail();
			}else{
				$("#btnReset").html("<strong>Continuar</strong>").prop('disabled', false);
			}
		}
	});
}

$("#oIDx").keyup(function(event){
	if(event.keyCode == 13){
		$("#form1 #btnReset").click();
	}
});

$("#DpSk").keyup(function(event){
	if(event.keyCode == 13){
		$("#form2 #btnReset").click();
	}
});

$("#dIsH,#OrJf").keyup(function(event){
	if(event.keyCode == 13){
		$("#form3 #btnReset").click();
	}
});

'use stritc';
var Interval;
function ModuleResePassword(){
	var self = this;

	self.config = [];
	self.user = "";

	self.init = function(){
		/*self.user = sessionStorage.getItem('user');
		/*if(self.user == null){
			$("#oIDx").attr('disabled', true);
			M.toast({html: "Usuario no encontrado."});
			return false;
		}*/
		$.get('./config/config.json', function(json, textStatus) {
			self.config = json;
		});
	}

	self.validateEmail = function(user){
		self.user = user;
		var oIDx = $("#oIDx");
		if(oIDx.val() == ""){
			oIDx.focus();
			M.toast({html: "Debe digitar su correo personal."});
			return false;
		}
		if(!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(oIDx.val()))){
			oIDx.focus();
			M.toast({html: "Debe digitar correo electrónico."});
			return false;
		}

		if(oIDx.val().indexOf('curn.edu.co') > 0 || oIDx.val().indexOf('curnvirtual.edu.co') > 0){
			oIDx.focus();
			M.toast({html: "Debe digitar correo electrónico personal."});
			return false;
		}

		$("#btnRecaptcha").click();
	}

	self.sendEmail = function(btn){
		$("#msgError").hide('slow');
		$.ajax({
			url: './config/validateEmail.php',
			type: 'POST',
			data: {user: self.user, oIDx: $("#oIDx").val()},
			beforeSend: function(){
				if(btn != undefined){
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
					  	$(btn).html(div).attr('disabled', true);
				}
			},
			success: function(data){
				if(data){
					if(btn != undefined){
						$(btn).html('<i class="material-icons">autorenew</i>').prop('disabled', false);
						clearInterval(Interval);
						self.timeRegresive();
					}else{
						$("#sjIS").text( $("#oIDx").val());
						self.backForm("#form2","#form1");
						self.timeRegresive();
					}					
				}else{
					$("#oIDx").attr('disabled', true);
					$("#msgError").html('<p class="red-text">Correo personal no encontrado. Verifique que la cuenta esté validada en nuestro sistema, si no lo ha hecho no podrá restablecer la contraseña</p>').slideDown('slow');
					$("#btnReset").html('<strong>Volver a intentar</strong>').prop('disabled', false).attr('onclick','moduleResePassword.refresh()');
				}
			}
		});
	}

	self.validateCode = function(){
		var code = $("#DpSk");
		if(code.val() == ""){
			code.focus();
			M.toast({html: "Debe digitar código de verificación."});
			return false;
		}else{
			if(code.val().length != 4){
				code.focus();
				M.toast({html: "Código invalido."});
				return false;
			}
		}

		$.ajax({
			url: './config/validateCode.php',
			type: 'GET',
			data: {code: code.val(), ixDs: true},
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
				$("#form2 #btnReset").html(div).attr('disabled', true);
			},
			success: function(data){
				$("#form2 #btnReset").html('<strong>Continuar</strong>').prop('disabled', false);
				if(data){
					self.backForm('#form3','#form2');
				}else{
					code.focus();
					M.toast({html: "Código invalido."});
					return false;
				}
			}
		});		
	}

	self.resetPass = function(){
		var dIsH = $("#dIsH");
		if(dIsH.val() == ""){
			dIsH.focus();
			M.toast({html: "Debe digitar nueva contraseña."});
			return false;
		}

		var OrJf = $("#OrJf");
		if(OrJf.val() == ""){
			OrJf.focus();
			M.toast({html: "Debe repetir nueva contraseña."});
			return false;
		}

		if(dIsH.val() !== OrJf.val()){
			dIsH.focus();
			M.toast({html: "Contraseñas no coincide."});
			return false;
		}

		if(dIsH.val().length < 8){
			dIsH.focus();
			M.toast({html: "Contraseñas debe tener minimo 8 caracteres."});
			return false;
		}

		var patron = /[A-Z]/g;

		if(dIsH.val().match(patron) == null){
			dIsH.focus();
			M.toast({html: "Contraseña debe tener mayúscula."});
			return false;
		}

		patron = /[a-z]/g;
		if(dIsH.val().match(patron) == null){
			dIsH.focus();
			M.toast({html: "Contraseña debe tener minúscula."});
			return false;
		}
		
		patron = /[0-9]/g;
		if(dIsH.val().match(patron) == null){
			dIsH.focus();
			M.toast({html: "Contraseña debe tener número."});
			return false;
		}

		$.ajax({
			url: './config/resetPassword.php',
			type: 'POST',
			data: {dIsH: dIsH.val()},
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
				$("#form3 #btnReset").html(div).attr('disabled', true);
			},
			success: function(data){ 
				$("#form3 #btnReset").html('<strong>Continuar</strong>').prop('disabled',false);
				if(data){
					var text = '<p>Enhorabuena, ' + data + '. '
							+ 'Ir a <a href="./" class="orange-text text-accent-3"><strong>' + self.config.name_app + '</strong></a></p>';
					sessionStorage.clear();
					$("#form3 #finish").html(text);
				}else{
					M.toast({html: "Se presento un error, volver a intentar mas tarde."});
					return false;
				}
			}
		});
	}

	/******************************/
	self.refresh = function(){
		window.location.href = "./resetpassword.php";
	}

	self.backForm = function(next,back){
		if(back == "#form2"){
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
}

moduleResePassword = new ModuleResePassword();

moduleResePassword.init();