var log = console.log;
log('conectado a la ventana  funciones.js');

var f = new Date();
 var y =f.getFullYear();
 var m =f.getMonth();
 var d= f.getDate();

   
$(document).ready(function(){
    $('select').formSelect();
    $('.tooltipped').tooltip();
    $('.modal').modal();

    $('.datepicker').datepicker({
        format:'yyyy/mm/dd',
        }  
    );

  
    
    // crear proyecto
    $('.datepicker1').datepicker({
        format:'yyyy/mm/dd',
        // minDate: new Date(y,m,d),
        onSelect: function () {
          $('#datepicker2').prop('disabled', false);
        },
        onOpen: function () {
            var fecha_f = $("#datepicker2").val();
            var f2 = new Date(fecha_f);
            var y2 =f2.getFullYear();
            var m2 =f2.getMonth();
            var d2= f2.getDate();
        
            var instance = M.Datepicker.getInstance($('.datepicker1'));
            instance.options.maxDate = new Date(y2,m2,d2);
           
        },
    });
    $('.datepicker2').datepicker({
        format:'yyyy/mm/dd',
        onOpen: function () {
            var fecha = $("#datepicker1").val();
            var f = new Date(fecha);
            var y =f.getFullYear();
            var m =f.getMonth();
            var d= f.getDate();
            
            var instance = M.Datepicker.getInstance($('.datepicker2'));
            instance.options.minDate = new Date(y,m,d);
           
           
        },
        
    });
    //editar   
    $('.datepickerE1').datepicker({
        format:'yyyy/mm/dd',
        onOpen: function () {
            var fecha_f = $("#datepickerE2").val();
            var f2 = new Date(fecha_f);
            var y2 =f2.getFullYear();
            var m2 =f2.getMonth();
            var d2= f2.getDate();
        
            var instance = M.Datepicker.getInstance($('.datepickerE1'));
            instance.options.maxDate = new Date(y2,m2,d2);
           
        },

    }); 
    $('.datepickerE2').datepicker({
        format:'yyyy/mm/dd',
        onOpen: function () {
            var fecha_2 = $("#datepickerE1").val();
            var f2 = new Date(fecha_2);
            var y2 =f2.getFullYear();
            var m2 =f2.getMonth();
            var d2= f2.getDate();
            console.log(fecha_2);
            var instance = M.Datepicker.getInstance($('.datepickerE2'));
            instance.options.minDate = new Date(y2,m2,d2);
           
           
        },
    });

    //crear actividades
    $('.datepicker4').datepicker({
        format:'yyyy/mm/dd',
        minDate: new Date(y,m,d),
        onSelect: function () {
            $('#datepicker4').prop('disabled', false);
        },
        onOpen: function () {
            var fecha_i = $("#fecha_iproy").val();
            var fi = new Date(fecha_i);
            var yi =fi.getFullYear();
            var mi =fi.getMonth();
            var di= fi.getDate();

            var fecha_f = $("#datepicker44").val();
            var f2 = new Date(fecha_f);
            var y2 =f2.getFullYear();
            var m2 =f2.getMonth();
            var d2= f2.getDate();
        console.log(fecha_i+'estoy aqui');
            var instance = M.Datepicker.getInstance($('.datepicker4'));
            instance.options.maxDate = new Date(y2,m2,d2);
            instance.options.minDate = new Date(yi,mi,di);
           
           
        },   
    });
    $('.datepicker3').datepicker({
        format:'yyyy/mm/dd',
        onOpen: function () {
           
            var fecha = $("#datepicker3").val();
            var f = new Date(fecha);
            var yia =f.getFullYear();
            var mia =f.getMonth();
            var dia= f.getDate();

            var fecha_f =$("#datepicker44").val();
            var fa = new Date(fecha_f);
            var yf =fa.getFullYear();
            var mf =fa.getMonth();
            var df= fa.getDate();

            var instance = M.Datepicker.getInstance($('.datepicker3'));
            instance.options.minDate = new Date(yia,mia,dia);
            instance.options.maxDate = new Date(yf,mf,df);
            
        },
        
    });
 
    // editar
    $('.datepickerE3').datepicker({
        format:'yyyy/mm/dd',

        onOpen: function () {
      
            var fecha_e = $("#ep_fechaip").val();   //  e: editable
            var fe = new Date(fecha_e);
            var ye =fe.getFullYear();
            var me =fe.getMonth();
            var de= fe.getDate();
            

            var fecha_ef = $("#ep_fechafp").val();   //  ef: editable final
            var fef = new Date(fecha_ef);
            var yef =fef.getFullYear();
            var mef =fef.getMonth();
            var def= fef.getDate();
            console.log(fecha_ef);

            var instance = M.Datepicker.getInstance($('.datepickerE3'));
            instance.options.minDate = new Date(ye,me,de);
            instance.options.maxDate = new Date(yef,mef,def);
        },
    }); 
    $('.datepickerE4').datepicker({
        format:'yyyy/mm/dd',

        onOpen: function () {
      
            var fecha_e = $("#datepickerE3").val();   //  e: editable
            var fe = new Date(fecha_e);
            var ye =fe.getFullYear();
            var me =fe.getMonth();
            var de= fe.getDate();
            

            var fecha_ef = $("#ep_fechafp").val();   //  ef: editable final
            var fef = new Date(fecha_ef);
            var yef =fef.getFullYear();
            var mef =fef.getMonth();
            var def= fef.getDate();
            console.log(fecha_ef);

            var instance = M.Datepicker.getInstance($('.datepickerE4'));
            instance.options.minDate = new Date(ye,me,de);
            instance.options.maxDate = new Date(yef,mef,def);
        },
    }); 
  
    //actualizar PROYECTO
    $("#actualizar").click(function(e){
        const datos={
            id:$("#id_pro").val(),
            nombre_proyec:$("#nombre_proye").val(),
            dependencia:$("#dependencia").val(),
            descripcion:$("#descripcion").val(),
            fecha_ipro:$("#datepickerE1").val(),
            fecha_fpro:$("#datepickerE2").val(),

        }

        if (datos.fecha_ipro>datos.fecha_fpro) { 
             M.toast({html: 'Corregir fecha inicial: La fecha inicial no puede ser mayor a la fecha final', classes: 'rounded'});
             console.log(datos.fecha_ipro+"  "+datos.fecha_fpro);
        }else{
            $.post('database/actualizar_proyecto.php',datos,function(response){
                if(response){
                    M.toast({html: 'Proyecto actualizado', classes: 'rounded'});
                }
            });
        }

        e.preventDefault();
    }); 
    

}); 

$('#btn_create_p').click((e) => {
    e.preventDefault(); 
     
    const datos= {
        nombre_proyec:document.querySelector('#nombre_proye').value,
        descripcion:document.querySelector('#descripcion').value,
        dependencia:document.querySelector('#dependencia').value,
        iden_lider:document.querySelector('#iden_lider').value,
        fecha_ip:document.querySelector('#datepicker1').value,
        fecha_fp:document.querySelector('#datepicker2').value
    }

    if( datos.nombre_proyec==null || datos.nombre_proyec =='' ){
        return  M.toast({html: 'Nombre del proyecto vacio, por favor complete el campo', classes: 'rounded'});
    }else if(datos.descripcion==null || datos.descripcion=='' ) {
        return M.toast({html: 'Descripcion de proyecto  vacia, por favor complete el campo', classes: 'rounded'});
    }else if (datos.fecha_ip=='' || datos.fecha_ip==null ) {
        return M.toast({html: 'Fecha inicial de proyecto vacia, por favor seleccione una', classes: 'rounded'});
    }else if (datos.fecha_fp=='' || datos.fecha_fp==null ) {
        return M.toast({html: 'Fecha final de proyecto vacia, por favor seleccione una', classes: 'rounded'});
   }else if (datos.dependencia =="" || datos.dependencia ==null) {
        return M.toast({html: 'No se ha seleccionado dependencia, por favor seleccione una', classes: 'rounded'});
    } else if (datos.fecha_ip>datos.fecha_fp) {
        return M.toast({html: 'Corregir fecha inicial: La fecha inicial no puede ser mayor a la fecha final', classes: 'rounded'});
    }else{
        $.ajax({
            url:'dataBase/insertar_proyecto.php',
            method:'POST',
            data:datos,
            success:(response) => {
                M.toast({html: response});

                setTimeout(tiempo,1000);
                function tiempo(){
                    window.location.href='lista_proyectos.php';
                }
                
            }
        })
    }
    
})


//FUNCION VISTO PROYECTOS EN CONSTRUCCIÓN 
function visto(id_p, estado,estadoL) {
    $.ajax({
        type:"POST",
        url:"dataBase/estado_v.php",
        data:{
            id_p,
            estado,
            estadoL
        },
        success: function (response) {
        M.toast({html: response});
        // $('#editar_u')[0].reset(); //limpia las casjas de texto
        }
    });   
}
 
function cambiaEstado (estado) {
    // e.preventDefault();  
        const datos_u={
            id_proy:$('#id_pro').val(),
            estado_p: estado,
        
        }
        // console.log(datos_u.nombre_u,datos_u.apellido_u,datos_u.cedula_u,datos_u.correo_u);
        
        if (datos_u.nombre_u=="" || datos_u.apellido_u=="" || datos_u.cedula_u=="" || datos_u.telefono_u=="" ||datos_u.pass_u=="" || datos_u.direccion_u=="" || datos_u.correo_u=="" ) {
            M.toast({html: 'Datos incompletos, por favor complete todos los campos'})
        } else {
            $.ajax({
                type:"POST",
                url:"dataBase/p_aprobar.php",
                data:datos_u,
                success: function (response) {
                    console.log(response);
                    
                    setTimeout(tiempo,1000);
                    function tiempo(){
                        window.location.href='lista_proyectos.php';
                    }
                    
                }
            });   
        }
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
    function mostrarEvidenciaA() {
       let id_actividad =$('#id_actividadA').val();
       console.log(id_actividad);
        $.ajax({
            url:'dataBase/mostrarEvidenciaA.php',
            type:'POST',
            data:{id_actividad},
            success:(response) => {
             let evidencia_proy= document.getElementById('mostrarEvidenciaA');
             evidencia_proy.innerHTML  = response ;
                
            }
        })
        
    } 