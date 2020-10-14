console.log('conectado a validaciones.js ya');

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
        return M.toast({html: 'Nombre de Actividad Vacía, por favor, complete el campo', classes: 'rounded'});
    }else if (datos.fecha_ia=="") {
        return M.toast({html: 'Fecha Inicial Vacìa, por favor, complete el campos', classes: 'rounded'});
    }else if (datos.fecha_fa=="") {
        return M.toast({html: 'Fecha Final Vacìa, por favor, complete el campos', classes: 'rounded'});
    }else if (datos.descripcion_a =="") {
        return M.toast({html: 'Descripcción De Actividad Vacìa, por favor, complete el campos', classes: 'rounded'});
    }else if (datos.valor_a=="") {
        return M.toast({html: 'Valor de Atividad Vacìa, por favor, complete el campos', classes: 'rounded'});
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
            let re = /[@%&.'"*+^${}()|[\]\\]/g;
            let resultado = cadena_valor.replace(re, '');
            campo.value= resultado;
        });
    }

    //SUBIR EVIDENCIA CON AJAX
    function subirEvidenciaA(e) {
        let datoE = new FormData($('#subirEvidencia')[0]); 
        $.ajax({
            url:'dataBase/subirEvidenciaA.php',
            type:'POST',
            data:datoE,
            contentType:false,
            processData: false,
            success:(response) => {
                M.toast({html: response, classes: 'rounded'});
                 $('#subirEvidencia')[0].reset(); //limpia las casjas de texto
                 mostrarEvidenciaA();
            }
        })
    }

//MOSTRAR EVIDENCIA CON AJAX
mostrarEvidenciaA();
    function mostrarEvidenciaA() {
       let id_actividad = document.getElementById('id_actividadA').value;
       console.log(id_actividad);
        $.ajax({
            url:'dataBase/mostrarEvidenciaA.php',
            type:'POST',
            data:{id_actividad},
            success:(response) => {
                document.getElementById('mostrarEvidenciaA').innerHTML =response ;
                
            }
        })
        
    } 
  