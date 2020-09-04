$(obtenerDAt());

function obtenerDAt(datos){
    $.ajax({
        url:'buscar_proyecto.php',
        type:'POST',
        dataType:'html',
        data:{dato:datos},
       })
    .done(function(resultado){
        $("#tabla").html(resultado)
    })    
    
}

$("#buscar").change(function(){
    var valorBusqueda;
    if($('select[id=buscar]').val()=='APROBADOS'){
         valorBusqueda = 2;    
    }else if($('select[id=buscar]').val()=='CONSTRUCCION'){
         valorBusqueda = 0;   
    }else if($('select[id=buscar]').val()=='CORREGIR'){
          valorBusqueda = 3;
    }else if($('select[id=buscar]').val()=='ENVIADOS'){
         valorBusqueda = 1;
    }else if($('select[id=buscar]').val()=='TODOS'){
         valorBusqueda = 4;
    }

    obtenerDAt(valorBusqueda);
    //alert($('select[id=buscar]').val());
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