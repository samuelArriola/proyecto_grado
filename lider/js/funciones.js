var log = console.log;
log('conectado a la ventana  funciones.js');

var f = new Date();
var y = f.getFullYear();
var m = f.getMonth();
var d = f.getDate();

$(document).ready(function() {
    $('select').formSelect();
    $('.tooltipped').tooltip();
    $('.modal').modal();

    $('.datepicker').datepicker({
        format: 'yyyy/mm/dd',
    });

    // crear proyecto
    $('.datepicker1').datepicker({
        format: 'yyyy/mm/dd',
        // minDate: new Date(y,m,d),
        onSelect: function() {
            $('#datepicker2').prop('disabled', false);
        },
        onOpen: function() {
            var fecha_f = $("#datepicker2").val();
            var f2 = new Date(fecha_f);
            var y2 = f2.getFullYear();
            var m2 = f2.getMonth();
            var d2 = f2.getDate();

            var instance = M.Datepicker.getInstance($('.datepicker1'));
            instance.options.maxDate = new Date(y2, m2, d2);

        },
    });
    $('.datepicker2').datepicker({
        format: 'yyyy/mm/dd',
        onOpen: function() {
            var fecha = $("#datepicker1").val();
            var f = new Date(fecha);
            var y = f.getFullYear();
            var m = f.getMonth();
            var d = f.getDate();

            var instance = M.Datepicker.getInstance($('.datepicker2'));
            instance.options.minDate = new Date(y, m, d);


        },

    });
    //editar   
    $('.datepickerE1').datepicker({
        format: 'yyyy/mm/dd',
        onOpen: function() {
            var fecha_f = $("#datepickerE2").val();
            var f2 = new Date(fecha_f);
            var y2 = f2.getFullYear();
            var m2 = f2.getMonth();
            var d2 = f2.getDate();

            var instance = M.Datepicker.getInstance($('.datepickerE1'));
            instance.options.maxDate = new Date(y2, m2, d2);

        },

    });
    $('.datepickerE2').datepicker({
        format: 'yyyy/mm/dd',
        onOpen: function() {
            var fecha_2 = $("#datepickerE1").val();
            var f2 = new Date(fecha_2);
            var y2 = f2.getFullYear();
            var m2 = f2.getMonth();
            var d2 = f2.getDate();
            console.log(fecha_2);
            var instance = M.Datepicker.getInstance($('.datepickerE2'));
            instance.options.minDate = new Date(y2, m2, d2);


        },
    });

    //crear actividades
    $('.datepicker4').datepicker({
        format: 'yyyy/mm/dd',
        minDate: new Date(y, m, d),
        onSelect: function() {
            $('#datepicker4').prop('disabled', false);
        },
        onOpen: function() {
            var fecha_i = $("#fecha_iproy").val();
            var fi = new Date(fecha_i);
            var yi = fi.getFullYear();
            var mi = fi.getMonth();
            var di = fi.getDate();

            var fecha_f = $("#datepicker44").val();
            var f2 = new Date(fecha_f);
            var y2 = f2.getFullYear();
            var m2 = f2.getMonth();
            var d2 = f2.getDate();
            console.log(fecha_i + 'estoy aqui');
            var instance = M.Datepicker.getInstance($('.datepicker4'));
            instance.options.maxDate = new Date(y2, m2, d2);
            instance.options.minDate = new Date(yi, mi, di);


        },
    });
    $('.datepicker3').datepicker({
        format: 'yyyy/mm/dd',
        onOpen: function() {

            var fecha = $("#datepicker3").val();
            var f = new Date(fecha);
            var yia = f.getFullYear();
            var mia = f.getMonth();
            var dia = f.getDate();

            var fecha_f = $("#datepicker44").val();
            var fa = new Date(fecha_f);
            var yf = fa.getFullYear();
            var mf = fa.getMonth();
            var df = fa.getDate();

            var instance = M.Datepicker.getInstance($('.datepicker3'));
            instance.options.minDate = new Date(yia, mia, dia);
            instance.options.maxDate = new Date(yf, mf, df);

        },

    });

    // editar
    $('.datepickerE3').datepicker({
        format: 'yyyy/mm/dd',

        onOpen: function() {

            var fecha_e = $("#ep_fechaip").val(); //  e: editable
            var fe = new Date(fecha_e);
            var ye = fe.getFullYear();
            var me = fe.getMonth();
            var de = fe.getDate();


            var fecha_ef = $("#ep_fechafp").val(); //  ef: editable final
            var fef = new Date(fecha_ef);
            var yef = fef.getFullYear();
            var mef = fef.getMonth();
            var def = fef.getDate();
            console.log(fecha_ef);

            var instance = M.Datepicker.getInstance($('.datepickerE3'));
            instance.options.minDate = new Date(ye, me, de);
            instance.options.maxDate = new Date(yef, mef, def);
        },
    });
    $('.datepickerE4').datepicker({
        format: 'yyyy/mm/dd',

        onOpen: function() {

            var fecha_e = $("#datepickerE3").val(); //  e: editable
            var fe = new Date(fecha_e);
            var ye = fe.getFullYear();
            var me = fe.getMonth();
            var de = fe.getDate();


            var fecha_ef = $("#ep_fechafp").val(); //  ef: editable final
            var fef = new Date(fecha_ef);
            var yef = fef.getFullYear();
            var mef = fef.getMonth();
            var def = fef.getDate();
            console.log(fecha_ef);

            var instance = M.Datepicker.getInstance($('.datepickerE4'));
            instance.options.minDate = new Date(ye, me, de);
            instance.options.maxDate = new Date(yef, mef, def);
        },
    });


    //ELIMINAR ACTIVIDADES
    $('#eliminarActividadA').click(function() {

        let id = $('#id_actividadA').val();
        let id_proy = $('#id_pro').val();
        let jefe_proy = $('#coordinador_proye').val();
        let nomb_proy = $('#nombre_proye').val();
        let nombre_act = $('#nomb_acti').val();

        $.ajax({
            type: "POST",
            url: "dataBase/eliminar_actividad.php",
            data: {
                id,
                id_proy,
                jefe_proy,
                nomb_proy,
                nombre_act,
            },
            dataType: "html",
            success: function(response) {
                M.toast({ html: response });
                window.location.href = 'editar_proyecto.php?id=' + id_proy;
            }
        })
    })



});


function mostrarLiderP(id_proy) {
    let id_proye = id_proy;
    $.ajax({
        url: 'dataBase/mostrarLiderP.php',
        type: 'POST',
        data: { id_proye },
        success: (response) => {
            let mostrarLiderP = document.getElementById('mostrarLiderP');
            mostrarLiderP.innerHTML = response;

        }
    })
}





//FUNCION VISTO PROYECTOS EN CONSTRUCCIÓN 
function visto(id_p, estado, estadoL) {
    $.ajax({
        type: "POST",
        url: "dataBase/estado_v.php",
        data: {
            id_p,
            estado,
            estadoL
        },
        success: function(response) {
            console.log(response);
            // $('#editar_u')[0].reset(); //limpia las casjas de texto
        }
    });
}

function cambiaEstado(estado) {
    // e.preventDefault();  
    const datos_u = {
            id_proy: $('#id_pro').val(),
            estado_p: estado,

        }
        // console.log(datos_u.nombre_u,datos_u.apellido_u,datos_u.cedula_u,datos_u.correo_u);

    if (datos_u.nombre_u == "" || datos_u.apellido_u == "" || datos_u.cedula_u == "" || datos_u.telefono_u == "" || datos_u.pass_u == "" || datos_u.direccion_u == "" || datos_u.correo_u == "") {
        M.toast({ html: 'Datos incompletos, por favor complete todos los campos' })
    } else {
        $.ajax({
            type: "POST",
            url: "dataBase/p_aprobar.php",
            data: datos_u,
            success: function(response) {
                console.log(response);

                setTimeout(tiempo, 1000);

                function tiempo() {
                    window.location.href = 'lista_proyectos.php';
                }

            }
        });
    }
}

//CAMBIAR EL ESTADO A VISTO DE LOS PROYECTOS ASIGNADO A LOS LIDERES 
function estadoLPVvisto(id_pro, id_usua, estado) {
    console.log(id_pro, id_usua, estado);
    $.ajax({
        type: "POST",
        url: "dataBase/estadoLPVvisto.php",
        data: {
            id_pro,
            id_usua,
            estado
        },
        success: function(response) {
            console.log(response);
            // $('#editar_u')[0].reset(); //limpia las casjas de texto
        }
    });
}


//SUBIR EVIDENCIA CON AJAX
function subirEvidenciaA(e) {
    let datoE = new FormData($('#subirEvidencia')[0]);
    $('#edi_escondeForm').hide();
    let edi_load = $('#edi_load');
    edi_load.removeClass('hide');

    $.ajax({
        url: 'dataBase/subirEvidenciaA.php',
        type: 'POST',
        data: datoE,
        contentType: false,
        processData: false,
        success: (response) => {
            M.toast({ html: response, classes: 'rounded' });
            $('#subirEvidencia')[0].reset(); //limpia las casjas de texto
            mostrarEvidenciaA(datoE.get("item_acty"));
            edi_load.addClass('hide');
            $('#edi_escondeForm').show();
        }
    })
}


//MOSTRAR EVIDENCIA CON AJAX
function mostrarEvidenciaA(id_acti) {

    let id_actividad = id_acti;
    $('#idActiEvidencia').val(id_actividad);
    console.log(id_actividad);
    $.ajax({
        url: 'dataBase/mostrarEvidenciaA.php',
        type: 'POST',
        data: { id_actividad },
        success: (response) => {
            let evidencia_proy = document.getElementById('mostrarEvidenciaA');
            evidencia_proy.innerHTML = response;

        }
    })
}


//MOSTRAR Actividades  CON AJAX

function mostrarActividadA(itemProy) {
    let EpEstado_proyecto = $('#EpEstado_proyecto').val();
    $.ajax({
        url: 'dataBase/mostrarActividad.php',
        type: 'POST',
        data: {
            itemProy,
            EpEstado_proyecto
        },
        success: (response) => {
            let evidencia_proy = document.getElementById('mostrarActividadA');
            evidencia_proy.innerHTML = response;

        }
    })
}



//borrar las evidencias con ajax con ajax
$('#eliminarEvidenciasA').click(function() {
    let datoE2 = new FormData($('#subirEvidencia')[0]);
    let IdEvi = $('#IdEvi').val();
    let IdRuta = $('#IdRuta').val();
    $.ajax({
        type: "POST",
        url: "dataBase/eliminar_evidencia.php",
        data: {
            id_e: IdEvi,
            ruta_e: IdRuta
        },
        dataType: "html",
        success: function(response) {
            mostrarEvidenciaA(datoE2.get("item_acty"));
            M.toast({ html: response });
            console.log(response);
        }
    })
})

//trae id y laruta para camdarlo a la ventana confirm eliminar usuario
function recibeIdEvi(id_e, id_ruta) {
    $('#IdEvi').val(id_e);
    $('#IdRuta').val(id_ruta);

}