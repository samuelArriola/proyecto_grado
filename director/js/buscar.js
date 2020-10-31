console.log('conectago a buscar.js');
(obtenerDAt());

function obtenerDAt(datos){
    $.ajax({
        url:'dataBase/buscar_proyecto.php',
        type:'POST',
        dataType:'html',
        data:{dato:datos},
       })
    .done(function(resultado){
        $("#tabla").html(resultado)
    })    
}

//BUSCAR PROYECTOS
$('#buscar_p').keyup(function() {
    var buscar = $('#buscar_p').val();
    if (buscar != "") {
        obtenerDAt(buscar);
    }else{
        obtenerDAt();
    }
    
});

mostrar_tabla();
function mostrar_tabla(datos) {
    $.ajax({
        type:"POST",
        url:"dataBase/buscar_proyA.php",
        data:{dato:datos},

        success: function (response) {
            $('#tablaProyA').html(response);
        }
    });
}

//BUSCAR PROYECTOS APROBADOS
$('#buscar_pA').keyup(function() {
    var buscarA = $('#buscar_pA').val();
    if (buscarA != "") {
        mostrar_tabla(buscarA);
    }else{
        mostrar_tabla();
    }
    
});
