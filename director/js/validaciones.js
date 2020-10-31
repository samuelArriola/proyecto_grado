console.log('conectado a validaciones.js');

//Valida caracteres especiale 
    let cadena_c = document.querySelectorAll(".caracteresEpesiales");
    for (let i = 0; i < cadena_c.length; i++) {
        cadena_c[i].addEventListener('focusout', function(a) {  
            let campo = a.target; //variable.target es similar al this
            let cadena_valor = campo.value;   
            let re = /[%&'"*+^$`{}()|[\]\\]/g;
            let resultado = cadena_valor.replace(re, '');
            campo.value= resultado;
        });
    }