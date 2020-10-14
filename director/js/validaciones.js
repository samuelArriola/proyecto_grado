console.log('conectado a validaciones.js');

//actualizar la actividades con ajax
$('#actualizar_a').click(function (a) {
    a.preventDefault();

    datos ={
        nombre_a:$('#nombre_act').val(),
        valor_a:$('#valor').val(),
        id_pro2:$('#id_pro2').val(),
        fecha_ia:$('#datepicker3').val(),
        fecha_fa:$('#datepicker4').val(),
        descripcion_a:$('#descripcion_a').val()

       
    }



    if (datos.nombre_a=="") {
        M.toast({html: 'Nombre de Actividad Vacía, por favor, complete el campo', classes: 'rounded'});
    }else if (datos.fecha_ia=="") {
        M.toast({html: 'Fecha Inicial Vacìa, por favor, complete el campos', classes: 'rounded'});
    }else if (datos.fecha_fa=="") {
        M.toast({html: 'Fecha Final Vacìa, por favor, complete el campos', classes: 'rounded'});
    }else if (datos.descripcion_a =="") {
        M.toast({html: 'Descripcción De Actividad Vacìa, por favor, complete el campos', classes: 'rounded'});
    }else if (datos.valor_a=="") {
        M.toast({html: 'Valor de Atividad Vacìa, por favor, complete el campos', classes: 'rounded'});
    } else {
        $.ajax({
            url:'dataBase/insertar_actividad.php',
            type:'POST',
            dataType:'html',
            data:datos,
           })
        .done(function(resultado){
        //  console.log(resultado);
         window.location.href='editar_proyecto.php?id='+datos.id_pro2;   
        })   
    }
    
    
});

//Valida caracteres especiale 
    let cadena_c = document.querySelectorAll(".caracteresEpesiales");
    for (let i = 0; i < cadena_c.length; i++) {
        cadena_c[i].addEventListener('focusout', function(a) {  
            let campo = a.target; //variable.target es similar al this
            let cadena_valor = campo.value;   
            let re = /[%&'"*+^${}()|[\]\\]/g;
            let resultado = cadena_valor.replace(re, '');
            campo.value= resultado;
        });
    }