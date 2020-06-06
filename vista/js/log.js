$(document).ready(function() {
    // $("#log")
    var formInputs = $('input[type="text"],input[type="password"]');
    formInputs.focus(function() {
        $(this).parent().children('p.formLabel').addClass('formTop');
        $('div#formWrapper').addClass('darken-bg');
        $('div.logo').addClass('logo-active');
    });

    formInputs.focusout(function() {
        if ($.trim($(this).val()).length == 0) {
            $(this).parent().children('p.formLabel').removeClass('formTop');
        }
        $('div#formWrapper').removeClass('darken-bg');
        $('div.logo').removeClass('logo-active');
    });

    $('p.formLabel').click(function() {
        $(this).parent().children('.form-style').focus();
    });

    $("#acceder").click(function() {
        if ($.trim($(this).val()).length == 0) {
            $(":text").css("background-color", "rgba(179, 27, 27, 0.096)");
        } else {
            $(":text").css("background-color", "rgba(255, 255, 255, 0.596)");
        }
        if ($.trim($(this).val()).length == 0) {
            $(":password").css("background-color", "rgba(179, 27, 27, 0.096)");
        } else {
            $(":password").css("background-color", "rgba(255, 255, 255, 0.596)");
        }
    });

    $("#acceder").click(function(e) {
        e.preventDefault();
        var formData = new FormData($("#formulario")[0]);
        $.ajax({
                type: "POST",
                url: '../controlador/log.php?op=usuariohas',
                data: formData,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                // successFunction(data);
                console.log(data);

                if (data.trim() == "\r\nnull" || data.trim() == undefined || data.trim() == null || data.trim() == "null") {

                    data = JSON.parse(data);
                    console.log('usuario inexistente');
                    $("#NmUsuario").css("background-color", "rgba(179, 27, 27, 0.096)");
                    $("#NmUsuario").popover('show');
                } else {
                    $("#NmUsuario").css("background-color", "rgba(255, 255, 255, 0.596)");
                    $("#NmUsuario").popover('hide');

                    console.log(".............");
                    console.log(data.trim());

                    if (data.trim() === "false") {
                        console.log('contraseña incorrecta');
                        $("#Clave").css("background-color", "rgba(179, 27, 27, 0.096)");
                        $("#Clave").popover('show');
                    } else {

                        $("#Clave").css("background-color", "rgba(255, 255, 255, 0.596)");
                        $("#Clave").popover('hide');

                        console.log('entró');
                        window.location.replace("Index/index.php");
                    }
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                serrorFunction();
                console.log('existió un problema');
                alert('Error!!');
            });
    });

});



//...........Evento dentro de fcus nombre usuario
let NmUsuario = document.querySelector('#NmUsuario');
let mensaje = document.querySelector('#etiqueta');
NmUsuario.onfocus = function() {
    console.log('Este es el evento focus');
    NmUsuario.style.background = 'rgba(7, 7, 7, 0.075)';
    $("#log").css("color", "#3b8156");
}

//............Evento fuera de foco nombre usuario
NmUsuario.onblur = function() {
    console.log('estoy fuera de foco');
    NmUsuario.style.background = 'rgba(255, 255, 255, 0.596)';
    $("#log").css("color", "#4e5b6d");
    // if (NmUsuario.value.trim()==="") {
    //     // NmUsuario.style.background='rgba(179, 27, 27, 0.096)';
    //     // mensaje.innerHTML='<i class="fas fa-exclamation-circle"></i>  Este campo es obligatorio.';
    //     // mensaje.style.color='red';
    // }else{
    //     mensaje.style.display='none';
    // }
}

//............Evento dentro de fcus CLAVE
let Clave = document.querySelector('#Clave');
let mensaj = document.querySelector('#etiquet');
Clave.onfocus = function() {
    console.log('Este es el evento focus');
    Clave.style.background = 'rgba(7, 7, 7, 0.075)';
    $("#log").css("color", "#3b8156");
}

//............Evento fuera de foco clave
Clave.onblur = function() {
    console.log('estoy fuera de foco');
    Clave.style.background = 'rgba(255, 255, 255, 0.596)';
    $("#log").css("color", "#4e5b6d");
    // if (Clave.value.trim()==="") {
    //     // Clave.style.background='rgba(179, 27, 27, 0.096)';
    //     // mensaj.innerHTML='<i class="fas fa-exclamation-circle"></i> Este campo es obligatorio.';
    //     // mensaj.style.color='red';
    // }else{
    //     mensaj.style.display='none';
    // }
}