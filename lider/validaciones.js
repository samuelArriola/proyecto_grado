console.log('conectado a validaciones.js');

//actualizar la actividades con ajax
$('#actualizar_a').click(function (a) {
    a.preventDefault();

    datos ={
        nombre_a:$('#nombre_act').val(),
        duracion_a:$('#duracion_act').val(),
        valor_a:$('#valor').val(),
        id_pro2:$('#id_pro2').val(),
        fecha_ia:$('#datepicker3').val(),
        fecha_fa:$('#datepicker4').val()
    }

    if (datos.nombre_a=="" || datos.duracion_a=="" || datos.valor_a=="" || datos.fecha_ia=="" || datos.fecha_fa=="") {
        M.toast({html: 'Todos los campos son requeridos, por favor, complete los campos', classes: 'rounded'});
    } else {
        $.ajax({
            url:'insertar_actividad.php',
            type:'POST',
            dataType:'html',
            data:datos,
           })
        .done(function(resultado){
         console.log(resultado);
         window.location.href='editar_proyecto.php?id='+datos.id_pro2;
            
        })   
    }
    
    
});