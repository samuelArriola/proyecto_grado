$(document).ready(function(){
    $(".dropdown-trigger").dropdown({
      constrainWidth: false
    });
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.modal').modal();

    $("#mnuProy").on("click",function(){
      proyectos();
    });

  });

function proyectos(limite=0){
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
        url: 'proyectos.php',
        type: 'get',
        data: {limite:limite},
        success: function(response){
            $("#contenido").html(response);
        }
    });
}

function proyectos_editar(item){
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
        url: 'proyectos_editar.php',
        type: 'get',
        data: {item: item},
        success: function(response){
            $("#contenido").html(response);
            //$('.modal').modal();
        }
    });
}

function ver_formulario(codi_conv){
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
        url: 'pendientes_formulario.php',
        type: 'get',
        data: {codi_conv: codi_conv},
        success: function(response){
            $("#contenido").html(response);
            $('select').formSelect();
            $('.modal').modal();
            //autoHeight();
        }
    });
}

function notificar(codi_conv){
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
        url: 'sendNotificar.php',
        type: 'get',
        data: {codi_conv: codi_conv},
        success: function(response){
          $("#contenido").html(response);
        }
    });
}

function estado_modal(codi_conv){
var html = '<div class="m12 center" style="padding: 20px;"><div class="preloader-wrapper small active">' + 
'<div class="spinner-layer spinner-teal-only">' +
      '<div class="circle-clipper left">' + 
        '<div class="circle"></div>' +
      '</div><div class="gap-patch">' + 
        '<div class="circle"></div>' +
      '</div><div class="circle-clipper right">' + 
      '<div class="circle"></div></div></div></div><br>Espere un momento</div>';
 $("#modal_contenido").html(html);
 $('#btnAceptar').attr("disabled", true);
 $.ajax({
        url: 'estado.php',
        type: 'get',
        data: {codi_conv: codi_conv},
        success: function(response){
          $("#modal_contenido").html(response);
          $('#btnAceptar').attr("disabled", false);
          $('select').formSelect();
        }
    });
}

function actualizar(){
var codi_conv = $('#codi_conv').val();
var conv_uxxi = $('#conv_uxxi').val();
var codi_docu = $('#codi_docu').val();
var observacion = $('#observacion').val();
var chequeo = $('#chequeo').val();
if ( $("#chequeo").val() == null) 
    {
    M.toast({html:'Seleccione un clasificación del <br>documento distinta a verificar.', displayLength: 3000});
    return;
    }
if ( chequeo == 2) 
    {
	if(observacion == "")
		{
		M.toast({html:'Se requiere ingresar observaciones<br>para corregir el documento.', displayLength: 3000});
		return;
		}
    }
 $.ajax({
        url: 'pendientes_documentos_update.php',
        type: 'post',
        data: {codi_conv:codi_conv, codi_docu:codi_docu, chequeo:chequeo, observacion:observacion},
        success: function(response){
            //console.log(response);
             $('.modal').modal('close');
            ver_documentos(codi_conv);
        }
    });
}

function actualizar_formulario(item_cues,item_preg,codi_conv,chec_resp){
$.ajax({
        url: 'pendientes_formulario_update.php',
        type: 'post',
        data: {item_cues:item_cues, item_preg:item_preg, codi_conv:codi_conv, chec_resp:chec_resp},
        success: function(response){
            //console.log(response);
            ver_formulario(codi_conv);
        }
    });
}

function ver_anexo(url,doc,texto,chequeo,codi_docu,obse_docu,req_docu){
var modal2 = document.querySelector('#modal2');
  modal2.innerHTML = '<div id="modal_contenido" class="modal-content">'+
  '</div>'+
  '<div class="modal-footer">'+
  '    <a href="javascript: actualizar();" class="btn-small">Actualizar</a>'+
  '    <a class="btn modal-close waves-effect waves-light white black-text btn-small">Cancelar</a>'+
  '</div>';

  var container = document.querySelector('#modal_contenido');
  container.innerHTML = '';
  var arrayDoc = url.split(".");
  var extension = arrayDoc[arrayDoc.length-1].toLowerCase();
  
  //url = '' + url.trim();
  /*
  if(url.length > 0){
      var char = url.charAt(url.length - 1);
      if(char != '/') url = url + '/';
    }
  */  
  var sele = '<div class="row"><form name="formModal" id ="formModal" class="col s12">' + 
    '<input type="hidden" name="codi_docu" id="codi_docu" value="'+codi_docu+'">';

  var str = '<div class="input-field col s12 m6">' + 
        '<i class="material-icons prefix">assignment_turned_in</i>' + 
        '  <select name="chequeo" id="chequeo" OnChange="observaciones(this.value)">' + 
        '  <option value="0" disabled>Verificar</option>'+
        '  <option value="1">Correcto</option>'+
        '  <option value="2">Corregir</option>'+
        '  </select>'+
        '  <label for="chequeo">Clasificación del documento</label>' + 
        '</div>'; 
        str = str.replace('value="'+chequeo+'"','value="'+chequeo+'" selected');

        if(chequeo == 2){
        str = str + '<div class="input-field col s12 m6">' + 
        '<i id="lblobser" class="material-icons prefix black-text">assignment</i>' + 
        '  <input type="text" name="observacion" id="observacion" value="'+obse_docu+'">'+
        '  <label for="observacion" class="active">Observaciones</label>' + 
        '</div></form></div>';
        }else{
        str = str + '<div class="input-field col s12 m6">' + 
        '<i id="lblobser" class="material-icons prefix grey-text">assignment</i>' + 
        '  <input type="text" name="observacion" id="observacion" value="'+obse_docu+'" readonly>'+
        '  <label for="observacion" class="active">Observaciones</label>' + 
        '</div></form></div>';}

        sele = sele + str;

var option = ' <a class="btn-floating btn-small" href="descargar.php?url='+url+'"><i class="material-icons">cloud_download</i></a>';
if(req_docu == '0'){
  option = option + '  <a class="btn-floating btn-small black" href="javascript: eliminar(\''+doc+'\')">'+
  '<i class="material-icons">delete</i></a>';
}
  if(extension == "pdf"){
    container.innerHTML = '<p>'+texto+' '+option+'</p>' + sele +  
    '<div id="portaDoc" style="height: 100%">'+
    '<object data="'+url+'" type="application/pdf" width="100%" height="100%"></object>'+
    '</div>';
    }
  else{
    if(extension == "jpg" || extension == "jpeg" || extension == "png" || extension == "gif"){
      container.innerHTML = '<p>'+texto+' '+option+'</p>' + sele + 
      '<a href="javascript: zoom(100)">1.0x</a> | ' + 
      '<a href="javascript: zoom(150)">1.5x</a> | ' + 
      '<a href="javascript: zoom(200)">2.0x</a>' + 
      '<div id="portaDoc">' + 
      '<img id="imagen" src="'+url+'" width="100%" height="100%">' + 
      '</div>';
      }
    else{
      if(extension == "doc" || extension == "docx" || extension == "odt" || extension == "rtf") {
      container.innerHTML = '<p>'+texto+' '+option+'</p>' + sele + 
      '<div id="portaDoc">' +
      '<iframe id="miIframe" src="https://docs.google.com/gview?url='+url+'&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>' + 
       '</div>';
       setTimeout(function(){
          document.getElementById("miIframe").src='https://docs.google.com/gview?url='+url+'&embedded=true';
       },1000);
      
        }
      else{
        container.innerHTML = '<p>'+texto+' '+option+'</p>' + sele +
        '<div id="portaDoc">' + 
        'El documento requeridos son los formatos (png, jpg, jpeg, gif, doc, docx, odt, rtf)' + 
        '</div>';
        }
      }
    }
    $('select').formSelect();

}

function zoom(valor){
var imagen = document.querySelector('#imagen');
imagen.style.width = valor + '%';
imagen.style.height = valor + '%';
}

function observaciones(valor){
  if(valor == 2){
      //$('#observacion').val('Escriba aqui');
      $('#observacion').attr('disabled', false);
      $('#observacion').attr('readonly', false);
      $('#lblobser').addClass('black-text');
      $('#lblobser').removeClass('grey-text');
  }
  else {
      $('#observacion').attr('disabled', true);
      $('#observacion').attr('readonly', true);
      $('#lblobser').addClass('grey-text');
      $('#lblobser').removeClass('black-text');
      $('#observacion').val('');
    }
}

function autoHeight(){
  var elements = document.getElementsByTagName("textarea");
for (var i = 0; i < elements.length; i++)
  {
    if(elements[i].value.trim() != "")
      elements[i].style.cssText = 'height:' + elements[i].scrollHeight + 'px; font-size: 1em;';
  }
}

function admision_estado(){
var estado = '';
var tipo = $("#tipo").val();
var codi_conv = $("#c").val();
if ( $("#estado").length > 0 )
  {
  if ( $("#estado").val() == null) 
    {
    M.toast({html:'Seleccione un estado de admisión', displayLength: 2000});
    return;
    }
  estado = $("#estado").val();
  }
var formularioEstado = $( "#formEstado" ).serialize();

var html = '<div class="m12 center" style="padding: 20px;"><div class="preloader-wrapper small active">' + 
'<div class="spinner-layer spinner-teal-only">' +
      '<div class="circle-clipper left">' + 
        '<div class="circle"></div>' +
      '</div><div class="gap-patch">' + 
        '<div class="circle"></div>' +
      '</div><div class="circle-clipper right">' + 
      '<div class="circle"></div></div></div></div><br>Espere un momento</div>';
 $("#mensajeModal").html(html);

$('#btnAceptar').attr("disabled", true);
 $.ajax({
        url: 'admision_estado.php',
        type: 'post',
        data: formularioEstado,
        success: function(response){
            //console.log(response);
            $("#mensajeModal").html(response);
            //M.toast({html: response, displayLength: 3000, completeCallback: function(){$('#btnAceptar').attr("disabled", false); $('#modalEnviar').modal('close'); if(estado != '') pendientes();}});
			if(tipo == 1)
            setTimeout(function(){
              $('#btnAceptar').attr("disabled", false);
              $('#modalEnviar').modal('close'); 
              if(estado != '') pendientes();}, 4000);
        }
    });
}

function eliminar(path){
  var codi_conv = $('#codi_conv').val();
  var codi_docu = $('#codi_docu').val();
/*
var html = '<div class="m12 center" style="padding: 20px;"><div class="preloader-wrapper small active">' + 
'<div class="spinner-layer spinner-teal-only">' +
      '<div class="circle-clipper left">' + 
        '<div class="circle"></div>' +
      '</div><div class="gap-patch">' + 
        '<div class="circle"></div>' +
      '</div><div class="circle-clipper right">' + 
      '<div class="circle"></div></div></div></div><br>Espere un momento</div>';
 $("#mensajeModal").html(html);
*/
 $.ajax({
        url: 'eliminar.php',
        type: 'post',
        data: {path: path, codi_conv:codi_conv, codi_docu: codi_docu},
        success: function(response){
            //console.log(response);
            M.toast({html:response, displayLength: 2000});
            //$("#mensajeModal").html(response);
            $('.modal').modal('close');
            ver_documentos(codi_conv);
        }
    });
}

function quitar_filtro(filtro,valor,iden_usua){
var html = '<div class="m12 center" style="padding: 20px;"><div class="preloader-wrapper small active">' + 
'<div class="spinner-layer spinner-orange-only">' +
      '<div class="circle-clipper left">' + 
        '<div class="circle"></div>' +
      '</div><div class="gap-patch">' + 
        '<div class="circle"></div>' +
      '</div><div class="circle-clipper right">' + 
      '<div class="circle"></div></div></div></div><br>Espere un momento</div>';
 $("#contenido").html(html);

 $.ajax({
        url: 'filtros_del.php',
        type: 'post',
        data: {iden_usua:iden_usua, filtro:filtro, valor: valor},
        success: function(response){
          pendientes();
        }
    });
}

function formFiltros(iden_usua){
  var container = document.querySelector('#modal_contenido_usuario');
  container.innerHTML = '';
  $('#btnUsuAceptar').attr("disabled", false);
  var str = '<form name="formValores" id="formValores">'+
        '<input type="hidden" name="iden_usua" value="'+iden_usua+'">' + 
        '<div class="row"><div class="input-field col s12 m12">' + 
        '<i class="material-icons prefix">assignment_turned_in</i>' + 
        '  <select name="filtro" id="filtro" Onchange="getFiltros(\''+iden_usua+'\',this.value)">' + 
        '  <option value="" disabled selected>Seleccione</option>'+
        '  <option value="conv_uxxi">Convocatorias</option>'+
        '  <option value="plan">Centro de costo</option>'+
        '  </select>'+
        '  <label for="filtro">Tipo de filtro</label>' + 
        '</div></div>' + 
        '<div id="modal_listas" class="row">' +
        '<div class="hoverable" style="font-size: 0.9em;">'+
        'Los tipos de filtros son por convocatoria o por centro de costos (Planes de estudios), '+
        'este ultimo muestra los planes en donde los aspirantes se han postulado. Además, solamente los '+
        'filtros que no están asociados al usuario actual.</div></div></form>'; 
        container.innerHTML = str;
    $('select').formSelect();
}

function getFiltros(iden_usua,filtro){
  var container = document.querySelector('#modal_listas');
  
var html = '<div class="m12 center" style="padding: 20px;"><div class="preloader-wrapper small active">' + 
'<div class="spinner-layer spinner-teal-only">' +
      '<div class="circle-clipper left">' + 
        '<div class="circle"></div>' +
      '</div><div class="gap-patch">' + 
        '<div class="circle"></div>' +
      '</div><div class="circle-clipper right">' + 
      '<div class="circle"></div></div></div></div><br>Espere un momento</div>';
 container.innerHTML = html;

  $.ajax({
        url: 'filtros_get.php',
        type: 'post',
        data: {iden_usua:iden_usua,filtro:filtro},
        success: function(response){
          container.innerHTML = response;
        }
    });
}

function addFiltros(){
  //var container = document.querySelector('#modal_listas');
  $('#btnUsuAceptar').attr("disabled", true);
  $.ajax({
        url: 'filtros_add.php',
        type: 'post',
        data: $( "#formValores" ).serialize(),
        success: function(response){
          //container.innerHTML = response;
          $('#btnUsuAceptar').attr("disabled", false);
          $('.modal').modal('close');
          pendientes();
        }
    });
}