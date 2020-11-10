console.log('conectado a app.js');

$('#form2').hide();
$('#loarU').hide();


$(document).ready(function(){
    let nombre;
    let id;
    // confirma usuario
    $('#btnUID').click(function(){
        $('#loarU').show();
         nombre = $('#nameuser').val().split('@');
        let usuario = nombre[0];
        let dominio = nombre[1];
        let dominio2 = "curnvirtual.edu.co";
        let dominio3="curn.edu.co";
        console.log(dominio);
        $.get("https://axis.curn.edu.co/apildap/api/ldap/account/"+usuario).then(resp => {
            $('#loarU').hide();
            var obj = $.parseJSON(resp); 
            var nombreO = obj['msg'];
            if (nombreO=="ERROR" || dominio!=dominio2 ) {
                $("#msgError1").show();
                $('#msgError1').html('Usuario no existente'); 
            } else if(nombreO == "OK") {
                $('#form1').hide();
                $('#form2').show(); 
                id = obj.data.entidad['EmployeeNumber'];
            }
            
        })    

    });  

    // confirma contraseña
    $('#btnPass').click(function(){
        $('#loarU').show();
        let usuPass = nombre[0];
        let pass = $('#passU').val();
       
        $.ajax({
            method: "post",
            url: "https://axis.curn.edu.co/apildap/api/ldap/account/auth",
            contentType: "application/json",
            data: JSON.stringify({
              correo: usuPass+"@curnvirtual.edu.co",
              clave: pass,
            })
          }).then(resp2 => {
            $('#loarU').hide();
            var obj2 = $.parseJSON(resp2); 
            var nombreO2 = obj2['msg'];
            console.log({ resp2 });

            if (nombreO2== "ERROR") {
                $('#msgErrorpss').html('Contraseña Incorrecta'); 
            } else if(nombreO2 == "OK") {
                //validació de base de datos nativa 
                $('#capa_resultados').html("Espere un momento");
                $.ajax({
                    url: 'config/crear_sessiones.php',
                    dataType: "json",   
                    type: 'POST',
                    data: {iden:id},//Aqui se especifica el parametro a enviar
                    success: function(response){
                        console.log(response);
                        // Aqui muestra los resultados
                        if(response.error == true)
                            {
                            $('#capa_resultados').html(response.msg);
                            }
                        else{
                            $('#capa_resultados').html('Nombre:'+response.nomb + ', Role:' + response.role);
                            if(response.role == 'D'){
                                console.log('director');
                                location.href = 'director/index.php';
                            }else if (response.role == 'L') {
                                console.log('lider');
                                location.href = 'lider/index.php';
                            }
                        }
                    }
                });
            }
          })
         
    })   
})