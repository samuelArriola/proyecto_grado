$(document).ready(function() {
    $('#tarjeta').hide();
    //BOTON PARA GUARDAR ACTIVIDADES
    $('#guardar').click(function() {
        $('#todo').hide();
        $('#tarjeta').show();
    });
    $('#tarjeta2').hide();
    //BOTON PARA ENVIAR ACTIVIDDES
    $('#enviar').click(function() {
        $('#todo').hide();
        $('#tarjeta2').show();
    });
    //BOTON PARA ACTIVIDADES PENDIENTES
    $('#tarjeta_acp').hide();
    $('#envira_acp').click(function() {
        $('#todo2').hide();
        $('#tarjeta_acp').show();
    });
    //BOTON PARA ACTUALIZAR O AÑADIR ACTIVIDADES EN CONSTRUCCION
    $('#tarjeta3').hide();
    $('#guardar2').click(function() {
        $('#subgrupo').hide();
        $('#titulo').hide();
        $('#tarjeta3').show();
    });
    //BOTON PARA ACTUALIZAR O AÑADIR ACTIVIDADES DIRECTAS
    $('#tarjeta4').hide();
    $('#guardar3').click(function() {
        $('#subgrupo2').hide();
        $('#titulo2').hide();
        $('#tarjeta4').show();
    });

    //VALIDAR CAMPOS VACIOS

    $('.tooltipped').tooltip();
    $('#crear_proyecto').hide();
    //LLAMA ALA PAGINA CREAR PROYECTO

    $('#flotante').click(function() {
        $('#contenido').hide();
        $('#crear_proyecto').show();
    });

    $('#mnuProy').click(function() {
        $('#crear_proyecto').hide();
        $('#contenido').show();
    });

    //AJAX 
    mostrar();
    $("#form").submit(function(e) {

        const datos = {
            nombre_proyecto: $("#nombre_proye").val(),
            descripcion_proyecto: $("#descripcion").val(),
            id_pro: $("#id_pro").val()
        }
        $.post('actualizar_proyecto.php', datos, function(response) {
            console.log(response);
        });
        e.preventDefault();
    });

    //MODAL
    $('.modal').modal();

    //AGREGAR ACTIVIDAD AJAX 

    $("#form2").submit(function(e) {
        const datosAC = {
            nombre_act: $("#nombre_act").val(),
            duracion_act: $("#duracion_act").val(),
            valor: $("#valor").val(),
            id_pro2: $("#id_pro2").val()
        }
        $.post('insertar_actividad.php', datosAC, function(response) {
            console.log(response);
            $("#form2").trigger('reset');
        });
        e.preventDefault();
    });



    $(".eliminar").click(function() {
        const datt = {
            id: $(this).parents("tr").find("td").eq(0).html()
        }
        $.post('eliminar_actividad.php', datt, function(response) {
            console.log(response);
            mostrar();
        });

    });

    $(".seleccionar").click(function() {

        var id = $(this).parents("tr").find("td").eq(0).html();
        var duracion = $(this).parents("tr").find("td").eq(1).html();
        var nombre = $(this).parents("tr").find("td").eq(2).html();
        var valor = $(this).parents("tr").find("td").eq(3).html();

        $("#editar0").val(id);
        $("#editar1").val(nombre);
        $("#editar2").val(duracion);
        $("#editar3").val(valor);


    });

    $("#editar").click(function(e) {
        const datosEDI = {
            id: $('#editar0').val(),
            nombre_ac: $('#editar1').val(),
            duracion_ac: $('#editar2').val(),
            valor: $('#editar3').val()
        }
        $.post('editar_actividad.php', datosEDI, function(response) {
            console.log(response);
        });
        e.preventDefault();

    });

    function mostrar() {
        $.ajax({
            url: 'mostrar_actividades.php',
            type: 'GET',
            success: function(response) {
                let datos_ac = JSON.parse(response)
                console.log(datos_ac);
                let template = '';
                datos_ac.forEach(item => {
                    template = `
                 
              <td>${item.duracion}</td>
              <td>${item.nombre_ac}</td>
              <td>${item.valor_ac}</td>
              <td>${item.valor_ac}</td>
              <td><button data-target="modal2" class="seleccionar  btn modal-trigger orange">Editar</button></td>
              <td><button class="eliminar  btn red" >Eliminar</button></td>   
            `
                });
                $("#obtener").html(template);
            }
        });
    }


});