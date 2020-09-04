$(document).ready(function(){
    $('select').formSelect();
    $('.tooltipped').tooltip();
    $('.modal').modal(); 
     
    //actualizar actividad
    $("#actualizar").click(function(e){
        const datos={
            id:$("#id_pro").val(),
            nombre_proyec:$("#nombre_proye").val(),
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

document.querySelector('#btn_create_p').addEventListener('click', (e) => {
    e.preventDefault(); 
     
    const datos= {
        nombre_proyec:document.querySelector('#nombre_proye').value,
        descripcion:document.querySelector('#descripcion').value,
        dependencia:document.querySelector('#dependencia').value,
        iden_lider:document.querySelector('#iden_lider').value
    }

    if( datos.nombre_proyec==null || datos.nombre_proyec =='', datos.descripcion==null || datos.descripcion==''){
        M.toast({html: 'Los campos son requeridos', classes: 'rounded'});
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