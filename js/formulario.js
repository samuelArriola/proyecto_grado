$(document).ready(function(){
    
  });

function formulario(codi_conv){
var html = '<div class="m12 center" style="padding: 20px;"><div class="preloader-wrapper small active">' + 
'<div class="spinner-layer spinner-teal-only">' +
      '<div class="circle-clipper left">' + 
        '<div class="circle"></div>' +
      '</div><div class="gap-patch">' + 
        '<div class="circle"></div>' +
      '</div><div class="circle-clipper right">' + 
      '<div class="circle"></div></div></div></div><br>Espere un momento</div>';
 $("#contenido").html(html);
 $.ajax({
        url: 'formulario.php',
        type: 'get',
        data: {codi_conv: codi_conv},
        success: function(response){
           
            $('#contenido').html(response);
            $('.modal').modal();
            autoHeight();
            //console.log(response);
        }
    });
}
function autoHeight(){
  var elements = document.getElementsByTagName("textarea");
for (var i = 0; i < elements.length; i++)
  {
    if(elements[i].value.trim() != "")
      elements[i].style.cssText = 'height:' + elements[i].scrollHeight + 'px; font-size: 1em;';
  }
}
function verificar_respuestas(){
var elements = document.getElementsByTagName("textarea");
var band = true;
for (var i = 0; i < elements.length; i++)
  {
  //console.log("tamaño:" + elements[i].value.trim().length);
  $("#p"+(i+1)).css("color", "teal");
  if(elements[i].value.trim() == "" || elements[i].value.trim().length < 2)
    {
    $("#p"+(i+1)).css("color", "orange");
    band = false;
    }
  }
if(band == false)
  {
  M.toast({html: 'Faltan preguntas por diligenciar', displayLength: 3000});
  return;
  }
  $('#modal1').modal('open');
}

function guardar_respuestas(){
var codi_conv = $('#codi_conv').val();
 $.ajax({
        url: 'guardar.php',
        type: 'post',
        data: $( "#formPre" ).serialize(),
        success: function(response){
            //console.log(response);
            $('#modal1').modal('close');
            M.toast({html: 'Operación ejecutada!!!', displayLength: 3000});
            formulario(codi_conv);
        }
    });
}

function color(i){
  $("#p"+i).css("color", "teal");
  /*
  var elements = document.getElementsByTagName("textarea");
  elements[i-1].style.cssText = 'height: auto';
  elements[i-1].style.cssText = 'height:' + elements[i-1].scrollHeight + 'px; font-size: 1em;';
  */
}
