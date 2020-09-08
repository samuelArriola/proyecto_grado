console.log('conectado a funciones.js');

   

$(document).ready(function(){
    $('select').formSelect();
    $('.tooltipped').tooltip();
    $('.modal').modal(); 
    $('.datepicker').datepicker({
        format:'yyyy/mm/dd'

        }
    );
  
     
    //actualizar actividad
    $("#actualizar").click(function(e){
        const datos={
            id:$("#id_pro").val(),
            nombre_proyec:$("#nombre_proye").val(),
            dependencia:$("#dependencia").val(),
            descripcion:$("#descripcion").val()
        }
        $.post('actualizar_proyecto.php',datos,function(response){
             if(response){
                M.toast({html: 'Proyecto actualizado', classes: 'rounded'});
             }
        });
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

    if( datos.nombre_proyec==null || datos.nombre_proyec =='', datos.descripcion==null || datos.descripcion=='' || datos.fecha_ip=='' || datos.fecha_fp=='' ){
        M.toast({html: 'Todos los campos son requeridos, por favor, complete los campos', classes: 'rounded'});
    }else{
        $.ajax({
            url:'insertar_proyecto.php',
            method:'POST',
            data:datos,
            success:(response) => {
                window.location.href='lista_proyectos.php'
            }
        })
    }
    
})

