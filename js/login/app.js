$('#form2').hide();
$('#loarU').hide();


$(document).ready(function() {
    let rol;
    let nombre;
    let id;
    let dominio;
    // confirma usuario
    $('#btnUID').click(function() {
        $('#loarU').show();
        nombre = $('#nameuser').val().split('@');
        let users = $('#nameuser').val();
        let usuario = nombre[0];
        dominio = nombre[1];
        let dominio2 = "curnvirtual.edu.co";
        let dominio3 = "curn.edu.co";
        console.log(nombre);

        if (isEmpty(users)) {
            $('#msgError1').html('Complete el campo');
            $('#loarU').hide();

        } else {
            $.get("https://axis.curn.edu.co/apildap/api/ldap/account/" + users).then(resp => {
                $('#loarU').hide();
                var obj = $.parseJSON(resp);
                var nombreO = obj['msg'];


                if (nombreO == "ERROR" || (dominio != dominio2 && dominio != dominio3)) {
                    $("#msgError1").show();
                    $('#msgError1').html('Usuario no existente');
                } else if (nombreO == "OK") {
                    $('#form1').hide();
                    $('#form2').show();
                    id = obj.data.entidad['EmployeeNumber'];
                    $("#passU").focus();

                }

            })
        }

    });

    $("#nameuser").keyup(function(event) {
        if (event.keyCode == 13) {
            $("#btnUID").click();
        }
    });

    // confirma contraseña
    $('#btnPass').click(function() {
        $('#loarU').show();
        let usuPass = nombre[0];
        let pass = $('#passU').val();
        rol = $('#Tdependencia').val();
        if (isEmpty(pass)) {
            $('#msgErrorpss').html('Complete el campo');
            $('#loarU').hide();

        } else {

            $.ajax({
                method: "post",
                url: "https://axis.curn.edu.co/apildap/api/ldap/account/auth",
                contentType: "application/json",
                data: JSON.stringify({
                    correo: usuPass + "@" + dominio,
                    clave: pass,
                })
            }).then(resp2 => {
                $('#loarU').hide();
                var obj2 = $.parseJSON(resp2);
                var nombreO2 = obj2['msg'];
                console.log({ resp2 });

                if (nombreO2 == "ERROR") {
                    $('#msgErrorpss').html('Contraseña Incorrecta');
                } else if (nombreO2 == "OK") {
                    //validació de base de datos nativa 
                    $.ajax({
                        url: 'config/crear_sessiones.php',
                        dataType: "json",
                        type: 'POST',
                        data: {
                            iden: id,
                            role: rol
                        }, //Aqui se especifica el parametro a enviar
                        success: function(response) {
                            console.log(response);

                            // Aqui muestra los resultados
                            if (response.error === true) {
                                let btnBack = `<button onclick=" $('#form1').show(); $('#form2').hide(); $('#msgErrorpss').html('');"  class="btn-flat btn-text btn-radius orange darken-2 white-text">Atras</button>`;
                                $('#msgErrorpss').html(response.msg);
                                $('#confirPass').html(btnBack);
                            } else {
                                if (response.role == 'D') {
                                    console.log('director');
                                    location.href = 'director/index.php';
                                } else if (response.role == 'C') {
                                    console.log('lider');
                                    location.href = 'coordinador/index.php';
                                } else if (response.role == 'L') {
                                    location.href = 'lider/index.php';
                                }
                            }
                        }
                    });
                }
            })
        }
    })

    $("#passU").keyup(function(event) {
        if (event.keyCode == 13) {
            $("#btnPass").click();
        }
    });

})

//caracteres vacíos 
function isEmpty(str) {
    return (!str || 0 === str.length);
}