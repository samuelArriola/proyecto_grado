var log = console.log;
log('conectado a la ventana  funciones.js');



$(document).ready(function() {
    $('select').formSelect();
    $('.tooltipped').tooltip();
    $('.modal').modal();
    $('.datepickerE1').datepicker({
        format: 'yyyy/mm/dd',

    });
    $('.datepickerE2').datepicker({
        format: 'yyyy/mm/dd',
        onOpen: function() {
            var fecha_2 = $("#datepickerE1").val();
            var f2 = new Date(fecha_2);
            var y2 = f2.getFullYear();
            var m2 = f2.getMonth();
            var d2 = f2.getDate() + 1;
            console.log(fecha_2);
            var instance = M.Datepicker.getInstance($('.datepickerE2'));
            instance.options.minDate = new Date(y2, m2, d2);


        },
    });


    //GUARDAR USUARIO CON AJAX
    $('#guardar_usuario').click(function(e) {
        e.preventDefault();

        var checked = [];
        $("input[name='checkTip']:checked").each(function() {
            checked.push(($(this).attr("value")));
        });

        console.log(checked);

        const datos_u = {
                nombre_u: $('#i1').val(),
                apellido_u: $('#i2').val(),
                cedula_u: $('#i9').val(),
                correo_u: $('#i7').val(),
                dep_u: $('#dep_u').val(),
                rol_u: checked

            }
            //  console.log(datos_u.nombre_u,datos_u.apellido_u,datos_u.cedula_u,datos_u.correo_u);
        if (isEmpty(datos_u.nombre_u)) {
            return M.toast({ html: 'Nombre de usuario vacío, por favor complete todos los campos' });
        } else if (isEmpty(datos_u.apellido_u)) {
            return M.toast({ html: 'Apellido de usuario vacío, por favor complete el campo', classes: 'rounded' });
        } else if (isEmpty(datos_u.cedula_u)) {
            return M.toast({ html: 'Cedula de usuario vacío, por favor complete el campo', classes: 'rounded' });
        } else if (isEmpty(datos_u.correo_u)) {
            return M.toast({ html: 'Correo de usuario vacío, por favor complete el campo', classes: 'rounded' });
        } else {
            $.ajax({
                type: "POST",
                url: "dataBase/u_crear.php",
                data: datos_u,
                success: function(response) {
                    console.log(response);

                    M.toast({ html: response });
                    $('#registra_u')[0].reset(); //limpia las casjas de texto
                    $(mostrarU());

                }
            });
        }


    });


    //EDITAR USUARIO CON AJAX
    $('#editar_usuario').click(function(e) {
        e.preventDefault();
        var checkedE = [];
        $("input[name='checkTipE']:checked").each(function() {
            checked.push(($(this).attr("value")));
        });

        const datos_u = {
                nombre_u: $('#e1').val(),
                apellido_u: $('#e2').val(),
                cedula_u: $('#e9').val(),
                correo_u: $('#e7').val(),
                rol_u: checkedE
            }
            // console.log(datos_u.nombre_u,datos_u.apellido_u,datos_u.cedula_u,datos_u.correo_u);

        if (datos_u.nombre_u == "" || datos_u.apellido_u == "" || datos_u.cedula_u == "" || datos_u.telefono_u == "" || datos_u.pass_u == "" || datos_u.direccion_u == "" || datos_u.correo_u == "") {
            M.toast({ html: 'Datos Incompletos, por favor Complete todos los campos' })
        } else {
            $.ajax({
                type: "POST",
                url: "dataBase/u_editar.php",
                data: datos_u,
                success: function(response_e) {
                    M.toast({ html: response_e });
                    // $('#editar_u')[0].reset(); //limpia las casjas de texto

                    setTimeout(tiempo, 1000);

                    function tiempo() {
                        window.location.href = 'coordinadores.php#mostrarUsuario';
                    }

                }
            });
        }

    });

    //LLAMO MOSTRAR USUARIOS CON AJAX
    $(mostrarU());

    //BUSCAR USUARIOS
    $('#buscar_u').keyup(function() {
        var buscar = $('#buscar_u').val();
        console.log(buscar);
        if (buscar != "") {
            mostrarU(buscar);
        } else {
            mostrarU();
        }
    });
});

//borrar datos con ajax
$('#eliminarUsuarios').click(function() {
    let id_u = $('#obtieneID').val();
    $.ajax({
        type: "POST",
        url: "dataBase/u_borrarA.php",
        data: { id_u },
        dataType: "html",
        success: function(response) {
            mostrarU();
            M.toast({ html: response });
            console.log(response);
        }
    })
})

//trae id para camdarlo a la ventana confirm eliminar usuario
function recibeID(id_u) {
    $('#obtieneID').val(id_u);

}

//MOSTRAR USUARIOS CON AJAX
function mostrarU(dat) {

    $.ajax({
        type: "POST",
        url: "dataBase/u_buscar.php",
        data: { dato: dat },
        dataType: "html",
    })

    .done(function(respuesta) { //done: si el ajax es verdadero, hazme esto es para recibir ... o susses 
        $('#mostrar_usu').html(respuesta);
    })
}

//CAMBIAR ESTADO            
function cambiaEstado(estado) {
    // e.preventDefault();  
    const datos_u = {
            id_proy: $('#id_pro').val(),
            estado_p: estado,

        }
        // console.log(datos_u.nombre_u,datos_u.apellido_u,datos_u.cedula_u,datos_u.correo_u); 
    if (datos_u.nombre_u == "" || datos_u.apellido_u == "" || datos_u.cedula_u == "" || datos_u.telefono_u == "" || datos_u.pass_u == "" || datos_u.direccion_u == "" || datos_u.correo_u == "") {
        M.toast({ html: 'Datos Incompletos, por favor Complete todos los campos' })
    } else {
        $.ajax({
            type: "POST",
            url: "dataBase/p_aprobar.php",
            data: datos_u,
            success: function(response) {
                console.log(response);
                M.toast({ html: response });

                setTimeout(tiempo, 1000);

                function tiempo() {
                    console.log("esta entrando");
                    window.location.href = 'lista_proyectos.php';
                }
            }
        });
    }
}

//actualizar PROYECTO

$("#actualizar").click(function(e) {
    const datos = {
        id: $("#id_pro").val(),
        fecha_ipro: $("#datepickerE1").val(),
        fecha_fpro: $("#datepickerE2").val(),
    }

    if (datos.fecha_ipro > datos.fecha_fpro) {
        M.toast({ html: 'Corregir fecha inicial:La fecha inicial no puede ser mayor a la fecha final', classes: 'rounded' });
        console.log(datos.fecha_ipro + "  " + datos.fecha_fpro);
    } else {

        $.post('database/actualizar_proyecto.php', datos, function(response) {
            if (response) {
                M.toast({ html: response, classes: 'rounded' });
            }
        });
    }
    e.preventDefault();
});

//INGRESA COMENTARIOS MANDA A CORRECION LOS PROYECTOS
function corregirProyecto(estado) {
    // e.preventDefault();
    const datos_c = {
        id_proy: $('#id_pro').val(),
        estado_p: estado,
        comentario_p: $('#comentarioProyecto').val()
    }

    if (isEmpty(datos_c.comentario_p)) {
        M.toast({ html: 'Comentarios Vacío, por favor Complete el campos' })
    } else {
        $.ajax({
            type: "POST",
            url: "dataBase/corregir_p.php",
            data: datos_c,
            success: function(response) {
                M.toast({ html: response });
                // $('#formCorregir')[0].reset(); 
                setTimeout(tiempo, 1000);

                function tiempo() {
                    window.location.href = 'lista_proyectos.php';
                }


            }
        });
    }
}

//FUNCION VISTO
function visto(id_p, estado) {

    $.ajax({
        type: "POST",
        url: "dataBase/estado_v.php",
        data: {
            id_p,
            estado
        },
        success: function(response) {
            console.log(response);
            // M.toast({html: response});
            // $('#editar_u')[0].reset(); //limpia las casjas de texto
        }
    });
}

//MOSTRAR EVIDENCIA CON AJAX
function mostrarEvidenciaA(id_acti) {
    let id_actividad = id_acti;
    // $('#idActiEvidencia').val(id_actividad);
    console.log(id_actividad);
    $.ajax({
        url: 'dataBase/mostrarEvidenciaA.php',
        type: 'POST',
        data: { id_actividad },
        success: (response) => {
            let evidencia_proy = document.getElementById('mostrarEvidenciaA2');
            evidencia_proy.innerHTML = response;

        }
    })
}

function estado_evi(id_e, id_acti) {
    console.log(id_e);
    console.log(id_acti);
    $.ajax({
        type: "POST",
        url: "dataBase/estado_evi.php",
        data: {
            id_e
        },
        success: function(response) {
            console.log(response);
            console.log('editado correctamente');
            mostrarEvidenciaA(id_acti)
                // M.toast({html: response});
        }
    });
}

//caracteres vacíos 
function isEmpty(str) {
    return (!str || 0 === str.length);
}