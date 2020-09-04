$("#nameuser").keyup(function(event){
	if(event.keyCode == 13){
		moduleLogin.getUID();
	}
});
$("#passuser").keyup(function(event){
	if(event.keyCode == 13){
		moduleLogin.autenticarPersona();
	}
});

'use strict';

function ModuleLogin(){
	var self = this;

	self.config = [];

	self.init = function(){
		sessionStorage.clear();
		$.get('./config/config.json', function(json, textStatus) {
			$("#name_app").html("<content>" + json.name_app + "</content>");
			self.config = json;
			if(json.background != false){
				$("body").css({
					/*"background-image": "url("+json.background+")",*/
					"background-repeat": "no-repeat",
					"background-position": "center",
					"background-size": "cover",
					"width": "100vw",
					"height": "100vh",
					"display": "-webkit-box",
				    "display": "-webkit-flex",
				    "display": "-ms-flexbox",
				    "display": "flex",
				    "-webkit-box-pack": "center",
				    "-webkit-justify-content": "center",
				    "-ms-flex-pack": "center",
				    "justify-content": "center",
				});
			}
			if(json.css.length > 0){
				for(let i in json.css){
					$(".cont-login").css(json.css[i][0],json.css[i][1]);
				}			
			}
		});
		$("#form1 #nameuser").focus();
	}

	self.getUID = function(){
		$("#msgError1").hide('slow');
		var user = $("#nameuser");
		if(user.val() == ""){
			user.focus();
			M.toast({html:"Dege digitar usuario."});
			return false;
		}
		user = user.val().split('@');
		user = self.getTypeDomain(user[0]);
		var cn ="";
		if(self.config.cn != false && self.config.dc != false){
			cn = "cn="+self.config.cn+"," ;
		}

		var data = {
			usuario: user,
			cn: cn,
			denied: self.config.denied
		}

		$.ajax({
			url: './config/BuscarUID.php',
			type: 'POST',
			data: data,
			beforeSend: function(){
				$(".cont-progress .progress").removeClass('hide');
			    $("#btnUID").attr('disabled',true);
			},
			success: function (data){
				$(".cont-progress .progress").addClass('hide');
				$("#btnUID").prop('disabled',false);
				if(data.denied && data.denied != undefined){
					$("#msgError1").text(data.msg).show('slow');
					$("#form1 #nameuser").addClass('active').focus();
					$("#form1 label[for='nameuser']").addClass('active');
					return false;
				}
				if(data.error && data.error != undefined){
					$("#msgError1").text(data.msg).show('slow');
					$("#form1 #nameuser").addClass('active').focus();
					$("#form1 label[for='nameuser']").addClass('active');
					return false;					
				}else{
					$("#form2 .user").text(data.email);
					$("#form1").addClass('hide');
					$("#form2").removeClass('hide');
					$("#form2 #passuser").focus();
					return false;
				} 
			}
		});
	}

	self.autenticarPersona = function(){
		$("#msgError2").hide('slow');
		var clave = $("#passuser");
		if(clave.val() == ""){
			clave.focus();
			M.toast({html: "Debe digitar contraseña."});
			return false;
		}

		$.ajax({
			url: './config/AutenticarPersona.php',
			type: 'POST',
			data: {clave: clave.val()},
			beforeSend: function(){
				$(".cont-progress .progress").removeClass('hide');
			    $("#btnAuth").attr('disabled',true);
			},
			success: function(data){
			    if(data.error){
			    	$(".cont-progress .progress").addClass('hide');
			  		$("#btnAuth").prop('disabled',false);
			    	$("#msgError2").text(data.msg).show('slow');
					$("#form1 #nameuser").addClass('active').focus();
					$("#form1 label[for='nameuser']").addClass('active')
					return false;		
			    }else{
			    	//window.location.replace(self.config.redirect);
			    	//window.location.replace('verificar/');
			    	window.location.href = 'verificar/';
			    }
			}
		});
	}

	self.getTypeDomain = function(user){
		switch(self.config.dc){
			case "curn":
				user += "@curn.edu.co";
				break;
			case "curnvirtual":
				user += "@curnvirtual.edu.co";
				break;
			default:
				user = user;
		}
		return user;
	}

	self.backForm = function(){
		$("#msgError1").hide();
		$("#msgError2").hide();
		$("#passuser").val("");
		$("#form1").removeClass('hide');
		$("#form2").addClass('hide');
	}

	self.resetPassword = function(){		
		var user = $("#nameuser").val();
		window.location.href = "./resetpassword.php?user=" + user;
	}
}

var moduleLogin = new ModuleLogin();

moduleLogin.init();