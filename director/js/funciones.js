var log = console.log;
log('conectado a la ventana  funciones.js');

 

$(document).ready(function(){
    $('select').formSelect();
    $('.tooltipped').tooltip();
    $('.modal').modal();  
    $('.datepickerE1').datepicker({
        format:'yyyy/mm/dd',

    }); 
    $('.datepickerE2').datepicker({
        format:'yyyy/mm/dd',
        onOpen: function () {
            var fecha_2 = $("#datepickerE1").val();
            var f2 = new Date(fecha_2);
            var y2 =f2.getFullYear();
            var m2 =f2.getMonth();
            var d2= f2.getDate()+1;
            console.log(fecha_2);
            var instance = M.Datepicker.getInstance($('.datepickerE2'));
            instance.options.minDate = new Date(y2,m2,d2);
           
           
        },
    });




   
    //actualizar actividad
    $("#actualizar").click(function(e){
        const datos={
            id:$("#id_pro").val(),
            nombre_proyec:$("#nombre_proye").val(),
            dependencia:$("#dependencia").val(),
            descripcion:$("#descripcion").val(),
            fecha_ipro:$("#datepickerE1").val(),
            fecha_fpro:$("#datepickerE2").val(),

        }
        $.post('database/actualizar_proyecto.php',datos,function(response){
             if(response){
                M.toast({html: 'Proyecto actualizado', classes: 'rounded'});
             }
        });
        e.preventDefault();
    }); 
    
    //GUARDAR USUARIO CON AJAX
    $('#guardar_usuario').click(function (e) {
        e.preventDefault();
    
        const datos_u={
            nombre_u:$('#i1').val(),
            apellido_u:$('#i2').val(),
            cedula_u:$('#i9').val(),
            correo_u:$('#i7').val()
        }
        //  console.log(datos_u.nombre_u,datos_u.apellido_u,datos_u.cedula_u,datos_u.correo_u);
        
        if (isEmpty(datos_u.nombre_u)) {
           return   M.toast({html: 'Nombre de usuario Vacío, por favor Complete todos los campos'});
        } else if (isEmpty(datos_u.apellido_u)) {
           return  M.toast({html: 'Apellido de usuario Vacío, por favor, complete el campo', classes: 'rounded'});
        }else if(isEmpty(datos_u.cedula_u)){
            return M.toast({html: 'Identificación de usuario Vacío, por favor, complete el campo', classes: 'rounded'});
        }else if(isEmpty(datos_u.correo_u)){
            return M.toast({html: 'Correo de usuario Vacío, por favor, complete el campo', classes: 'rounded'});
        }else {
            $.ajax({
                type:"POST",
                url:"dataBase/u_crear.php",
                data:datos_u,
                success: function (response) {
                    console.log(response);
                  M.toast({html: response});
                $('#registra_u')[0].reset(); //limpia las casjas de texto
                $(mostrarU());
                }
            });   
        }
      
    });

   
    //EDITAR USUARIO CON AJAX
    $('#editar_usuario').click(function (e) {
        e.preventDefault();

        const datos_u={
            nombre_u:$('#e1').val(),
            apellido_u:$('#e2').val(),
            cedula_u:$('#e9').val(),
            correo_u:$('#e7').val()
        }
        // console.log(datos_u.nombre_u,datos_u.apellido_u,datos_u.cedula_u,datos_u.correo_u);
        
        if (datos_u.nombre_u=="" || datos_u.apellido_u=="" || datos_u.cedula_u=="" || datos_u.telefono_u=="" ||datos_u.pass_u=="" || datos_u.direccion_u=="" || datos_u.correo_u=="" ) {
            M.toast({html: 'Datos Incompletos, por favor Complete todos los campos'})
        } else {
            $.ajax({
                type:"POST",
                url:"dataBase/u_editar.php",
                data:datos_u,
                success: function (response_e) {
                    console.log(response_e);
                M.toast({html: response_e });
                // $('#editar_u')[0].reset(); //limpia las casjas de texto
                }
            });   
        }
    
    });

    //APROBAR PROYECTOS CON AJAX 
    // $('#aprobar_proy').click(function (e) {
    //     e.preventDefault();
    //     if (confirm('Desea aprobar este proyecto?')) {    
    //         const datos_u={
    //             id_proy:$('#id_pro').val(),
            
    //         }
    //         // console.log(datos_u.nombre_u,datos_u.apellido_u,datos_u.cedula_u,datos_u.correo_u);
            
    //         if (datos_u.nombre_u=="" || datos_u.apellido_u=="" || datos_u.cedula_u=="" || datos_u.telefono_u=="" ||datos_u.pass_u=="" || datos_u.direccion_u=="" || datos_u.correo_u=="" ) {
    //             M.toast({html: 'Datos Incompletos, por favor Complete todos los campos'})
    //         } else {
    //             $.ajax({
    //                 type:"POST",
    //                 url:"dataBase/p_aprobar.php",
    //                 data:datos_u,
    //                 success: function (response) {
    //                     console.log(response);
    //                 M.toast({html: 'PROYECTO APROBADO EXITOSAMENTE'});
    //                 // $('#editar_u')[0].reset(); //limpia las casjas de texto
    //                 }
    //             });   
    //         }
    //     }
    // });


    //LLAMO MOSTRAR USUARIOS CON AJAX
    $(mostrarU());
  


    $('#buscar_u').keyup(function() {
        var buscar = $('#buscar_u').val();
        console.log(buscar);
        if (buscar != "") {
            mostrarU(buscar);
        }else{
            mostrarU();
        }
        
    });


}); 

    //borrar datos con ajax
    function borrarAjax(id_u) {
        if (confirm('¿desea borrarlo?')) {
            $.ajax({
                type: "POST",
                url: "dataBase/u_borrarA.php",
                    data:{id_u} ,
                dataType: "html",
                success: function (response) {
                    mostrarU();
                    M.toast({html: response});
                    console.log(response);  
                
                }
            })
        }
    }

    //MOSTRAR USUARIOS CON AJAX
    function mostrarU(dat){ 
                
        $.ajax({
            type: "POST",
            url: "dataBase/u_buscar.php",
            data:{dato:dat},
            dataType: "html",
        })

        .done(function (respuesta) {  //done: si el ajax es verdadero, hazme esto es para recibir ... o susses 
            $('#mostrar_usu').html(respuesta);
        })
    }

    //CAMBIAR ESTADO        
    
  //  $('#aprobar_proy').click()}
        
    function cambiaEstado (estado) {
        // e.preventDefault();
        if (confirm('¿Desea continuar este proceso?')) {    
            const datos_u={
                id_proy:$('#id_pro').val(),
                estado_p: estado,
            
            }
            // console.log(datos_u.nombre_u,datos_u.apellido_u,datos_u.cedula_u,datos_u.correo_u);
            
            if (datos_u.nombre_u=="" || datos_u.apellido_u=="" || datos_u.cedula_u=="" || datos_u.telefono_u=="" ||datos_u.pass_u=="" || datos_u.direccion_u=="" || datos_u.correo_u=="" ) {
                M.toast({html: 'Datos Incompletos, por favor Complete todos los campos'})
            } else {
                $.ajax({
                    type:"POST",
                    url:"dataBase/p_aprobar.php",
                    data:datos_u,
                    success: function (response) {
                        console.log(response);
                    M.toast({html: 'Cambios guardados correctamente'});
                    // $('#editar_u')[0].reset(); //limpia las casjas de texto
                    }
                });   
            }
        }
    }

//caracteres vacíos 
    function isEmpty(str) {
        return (!str || 0 === str.length);
    }