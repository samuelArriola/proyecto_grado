console.log('conectado a validaciones.js ya');

//insertar la actividades con ajax
$('#insertar_a').click(function(a) {
    a.preventDefault();

    datos = {
        nombre_a: $('#nombre_act').val(),
        nomb_proy: $('#nomb_proy').val(),
        jefe_proy: $('#id_jefeProy').val(),
        valor_a: $('#valor').val(),
        id_pro2: $('#id_pro2').val(),
        fecha_ia: $('#datepicker3').val(),
        fecha_fa: $('#datepicker4').val(),
        descripcion_a: $('#descripcion_a').val()


    }
    if (datos.nombre_a === "") {
        return M.toast({ html: 'Nombre de actividad vacia, por favor complete el campo', classes: 'rounded' });
    } else if (datos.fecha_ia === "") {
        return M.toast({ html: 'Fecha inicial vacia, por favor complete el campo', classes: 'rounded' });
    } else if (datos.fecha_fa === "") {
        return M.toast({ html: 'Fecha final vacia, por favor, complete el campo', classes: 'rounded' });
    } else if (datos.descripcion_a === "") {
        return M.toast({ html: 'Descripcción de actividad vacia, por favor complete el campo', classes: 'rounded' });
    } else if (datos.valor_a === "") {
        return M.toast({ html: 'Valor de actividad vacia, por favor complete el campo', classes: 'rounded' });
    } else if (datos.fecha_ia > datos.fecha_fa) {
        return M.toast({ html: 'Corregir fecha inicial: La fecha inicial no puede ser mayor a la fecha final', classes: 'rounded' });
    } else {
        $.ajax({
            url: 'dataBase/insertar_actividad.php',
            type: 'POST',
            dataType: 'html',
            data: datos,

            success: (resultado) => {
                M.toast({ html: resultado, classes: 'rounded' });

                setTimeout(tiempo, 1000);

                function tiempo() {
                    window.location.href = 'editar_proyecto.php?id=' + datos.id_pro2;
                }
            }
        })

    }


});

//actualizar la actividades con ajax
$('#editar_acti').click(function(a) {
    a.preventDefault();

    datos = {
        nombre_a: $('#nombre_act').val(),
        nomb_proy: $('#Eanomb_proy').val(),
        jefe_proy: $('#Eajefe_proy').val(),
        valor_a: $('#valor').val(),
        id_pro2: $('#id_pro2').val(),
        id_a2: $('#id_a2').val(),
        fecha_ia: $('#datepickerE3').val(),
        fecha_fa: $('#datepickerE4').val(),
        descripcion_a: $('#descripcion_a').val()
    }

    // console.log(datos.nombre_a+datos.valor_a+datos.id_pro2+datos.id_a2+datos.fecha_fa+datos.fecha_ia+datos.descripcion_a);
    if (datos.nombre_a === "") {
        return M.toast({ html: 'Nombre de actividad vacia, por favor complete el campo', classes: 'rounded' });
    } else if (datos.fecha_ia === "") {
        return M.toast({ html: 'Fecha inicial vacia, por favor seleccione una', classes: 'rounded' });
    } else if (datos.fecha_fa === "") {
        return M.toast({ html: 'Fecha final vacia, por favor seleccione una', classes: 'rounded' });
    } else if (datos.descripcion_a === "") {
        return M.toast({ html: 'Descripción de actividad vacia, por favor complete el campo', classes: 'rounded' });
    } else if (datos.valor_a === "") {
        return M.toast({ html: 'Valor de actividad vacia, por favor complete el campo', classes: 'rounded' });
    } else if (datos.fecha_ia > datos.fecha_fa) {
        return M.toast({ html: 'Corregir fecha inicial: La fecha inicial no puede ser mayor a la fecha final', classes: 'rounded' });
    } else {
        $.ajax({
                url: 'dataBase/actualizar_actividad.php',
                type: 'POST',
                dataType: 'html',
                data: datos,
            })
            .done(function(resultado) {
                M.toast({ html: resultado, classes: 'rounded' });
                setTimeout(tiempo, 1000);

                function tiempo() {
                    window.location.href = 'editar_proyecto.php?id=' + datos.id_pro2;
                }


            })
    }


});


//Valida caracteres especiale 
let cadena_c = document.querySelectorAll(".caracteresEpesiales");
for (let i = 0; i < cadena_c.length; i++) {
    cadena_c[i].addEventListener('focusout', function(a) {
        let campo = a.target; //variable.target es similar al this
        let cadena_valor = campo.value;
        let re = /[@%&.'"*+^${}()|[\]\\]/g;
        let resultado = cadena_valor.replace(re, '');
        campo.value = resultado;
    });
}