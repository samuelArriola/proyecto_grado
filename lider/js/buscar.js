console.log('conectago a buscar.js');
(obtenerDAt());

function obtenerDAt(datos) {
    let a = $('#loar');
    a.removeClass('hide');

    $.ajax({
        url: 'dataBase/buscar_proyecto.php',
        type: 'POST',
        dataType: 'html',
        data: { dato: datos },
    })

    .done(function(resultado) {
        a.addClass('hide');
        $("#tabla").html(resultado);
    })

}

$("#buscar").change(function() {
    var valorBusqueda;
    if ($('select[id=buscar]').val() == 'APROBADOS') {
        valorBusqueda = 2;
    } else if ($('select[id=buscar]').val() == 'CONSTRUCCION') {
        valorBusqueda = 0;
    } else if ($('select[id=buscar]').val() == 'CORREGIR') {
        valorBusqueda = 3;
    } else if ($('select[id=buscar]').val() == 'ENVIADOS') {
        valorBusqueda = 1;
    } else if ($('select[id=buscar]').val() == 'TODOS') {
        valorBusqueda = 4;
    }

    obtenerDAt(valorBusqueda);
    // console.log($('select[id=buscar]').val());
    // console.log(valorBusqueda);
});

/*$(document).on('keyup','#buscar',function(){
    var valorBusqueda=$(this).val();
    if(valorBusqueda!=""){
        obtenerDAt(valorBusqueda);   
    }else{
         obtenerDAt();
    }
})*/

/*$("#buscar").keyup(function(){
    if($("#buscar").val()){
     var valorBusqueda=$("#buscar").val();
     $.ajax({
       url:'buscar_proyecto.php',
       type:'POST',
       dataType:'html',
       data:{busca:valorBusqueda},
       success:function(response){
        $("#tabla").html(response)
       }
     })
   
  }
});*/