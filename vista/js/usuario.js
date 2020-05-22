var tabla;

function init() {
    //listadata();
    mostrarform(false);
    listar();

    $.post("../controlador/usuario.php?op=selectOficina", function(r) {
        $("#IdOficina").html(r);
    });

    //cargar los items al select cargo
    //r: son las opciones que devuelve el archivo controlador/usuario.php con el valor selectCargo
    $.post("../controlador/usuario.php?op=selectCargo", function(r) {
        $("#IdCargo").html(r);
    });
}
// console.log("Hello World!"); 
// throw '';

function limpiar() {
    $("#IdUsuario").val("");
    $("#NmUsuario").val("");
    $("#Clave").val("");
    $("#TipoUsuario").val("");
    $('#FlUsuarioActivo').val("");
    $("#IdOficina").val("");
    $('#IdCargo').val("");
    $(".infoguar").css("display", "none");
    $("br").css("display", "none");
    $("#IdUsuario").css("background-color", "rgb(255, 255, 255)");
    $(".infoid").css("display", "none");
    $(".infoexis").css("display", "none");
    $(".espacio").css("display", "none");
    $("#NmUsuario").css("background-color", "rgb(255, 255, 255)");
    $(".infoN").css("display", "none");
    $("#Clave").css("background-color", "rgb(255, 255, 255)");
    $(".infoC").css("display", "none");
    $(".espacio1").css("display", "none");
    $("#TipoUsuario").css("background-color", "rgb(255, 255, 255)");
    $(".infoT").css("display", "none");
    $("#FlUsuarioActivo").css("background-color", "rgb(255, 255, 255)");
    $(".infoA").css("display", "none");
    $(".espacio2").css("display", "none");
    $("#IdOficina").css("background-color", "rgb(255, 255, 255)");
    $(".infoOfi").css("display", "none");
    $("#IdCargo").css("background-color", "rgb(255, 255, 255)");
    $(".infoCa").css("display", "none");
    // $(".infoid").remove();
}

function mostrarform(flag) {
    limpiar();

    if (flag) {
        $("#titulo1").css("display", "none");
        $("#titulo").css("display", "inline");
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnEditar").hide();
        $("#btnagregar").hide();
        $("#btnborrar").hide();
        $("#nuevo").show();
        $("#mlista").hide();
    } else {
        $("#titulo1").css("display", "inline");
        $("#titulo").css("display", "none");
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
        $("#btnborrar").show();
        $("#nuevo").hide();
        $("#mlista").show();
    }
}

function cancelarform() {
    mostrarform(false);
    limpiar();
}

function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, // activando los procedimientos de datatables
        "aServerSide": true, // paginacion y filtracion
        dom: 'Bfrtip', // definimos los elementos de la tabla
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
            // 'copyHtkml5',
            // 'excelHtml5',
            // 'csvHtml5',
            // 'pdf'            ,
            // {
            //     extend: 'print',
            //     exportOptions: {
            //         columns: ':visible'
            //     }
            // },
            // 'colvis'
        ],
        "ajax": {
            url: '../controlador/usuario.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                // console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 14, // indicamos el numero de paginacion
        "order": [
                [0, "desc"]
            ] // ordernar (columna,orden)
    }).DataTable();
}

$(document).ready(function() {

    $.ajax({
        type: "POST",
        url: "../controlador/usuario.php?op=noreg",
        data: $rspta,
        success: function(data) {
            console.log(data);

            //     if (data.trim() !== "\r\nnull" || data.trim() !== undefined || data.trim() !== null || data.trim() !== "null") {
            //         data = JSON.parse(data);

            //         coonsole.log();

            //         // $('#IdUsuario').val(IdUsuario);
            //         // $('#NmUsuario').val(data.NmUsuario);
            //         // $('#TipoUsuario').val(data.TipoUsuario);
            //         // $('#FlUsuarioActivo').val(data.FlUsuarioActivo);
            //         // $('#IdOficina').val(data.IdOficina);
            //         // $('#IdCargo').val(data.IdCargo);
            //         // $("#btnGuardar").prop('disabled', true);
            //     }
            // },
            // error: function() {
            //     console.log('existió un problema');
        }
    });


    $('#IdUsuario').keyup(function() {
        var IdUsuario = $(this).val();
        var dataString = 'IdUsuario=' + IdUsuario;

        $.ajax({
            type: "POST",
            url: "../controlador/usuario.php?op=datosid",
            data: dataString,
            success: function(data) {
                console.log(data);

                if (data.trim() !== "\r\nnull" || data.trim() !== undefined || data.trim() !== null || data.trim() !== "null") {
                    data = JSON.parse(data);

                    $('#IdUsuario').val(IdUsuario);
                    $('#NmUsuario').val(data.NmUsuario);
                    $('#TipoUsuario').val(data.TipoUsuario);
                    $('#FlUsuarioActivo').val(data.FlUsuarioActivo);
                    $('#IdOficina').val(data.IdOficina);
                    $('#IdCargo').val(data.IdCargo);
                    $("#btnGuardar").prop('disabled', true);
                }
            },
            error: function() {
                console.log('existió un problema');
            }
        });

        $.ajax({
            type: "POST",
            url: "../controlador/usuario.php?op=validarid",
            data: dataString,
            success: function(data) {
                console.log(data);
                if (data.trim() === "\r\nnull" || data.trim() == undefined || data.trim() == null || data.trim() == "null") {
                    $("#NmUsuario").val("");
                    $("#Clave").val("");
                    $("#TipoUsuario").val("");
                    $('#FlUsuarioActivo').val("");
                    $("#IdOficina").val("");
                    $('#IdCargo').val("");
                    $("#btnGuardar").prop('disabled', false);
                }
            },
            error: function() {
                console.log('existió un problema');
            }
        });
    });


    $("#btnGuardar").click(function(e) {
        campos();
        var IdUsuario = $("#IdUsuario").val();
        $.post("../controlador/usuario.php?op=validarid", { "IdUsuario": IdUsuario })
            .done(function(data) {

                if (data.trim() === "\r\nnull" || data.trim() == undefined || data.trim() == null || data.trim() == "null") {
                    console.log(data);
                    console.log('guardar');

                    if ($.trim($("#IdUsuario").val()).length == 0 ||
                        $.trim($("#NmUsuario").val()).length == 0 ||
                        $.trim($("#Clave").val()).length == 0 ||
                        $.trim($("#TipoUsuario").val()).length == 0 ||
                        $.trim($("#FlUsuarioActivo").val()).length == 0 ||
                        $.trim($("#IdOficina").val()).length == 0 ||
                        $.trim($("#IdCargo").val()).length == 0) {
                        console.log('campos vacíos');
                    } else if (!($.trim($("#Clave").val()).match(/^(?=\w*\d)(?=\w*[a-zA-Z])\S{8,20}$/))) {
                        console.log('campos incorrectos');
                    } else {
                        guardar(e);
                    }

                } else {
                    console.log("datos ok");
                    console.log(data);

                    $("#IdUsuario").css("background-color", "rgba(179, 27, 27, 0.096)");
                    $(".infoid").css("display", "none");
                    $(".infoexis").css("display", "inline");
                }
            })
            .fail(function(xhr, status, error) {
                console.log("failed");
                console.log(xhr);
                console.log(status);
                console.log(error);
            });
    })
});

$("#btnEditar").click(function(e) { //Valida que ningun campo esté vacio antes de editar
    campos();
    if ($.trim($("#IdUsuario").val()).length == 0 ||
        $.trim($("#NmUsuario").val()).length == 0 ||
        $.trim($("#Clave").val()).length == 0 ||
        $.trim($("#TipoUsuario").val()).length == 0 || //!($.trim($(this).val()).match(/^A|N+$/)) ||
        $.trim($("#FlUsuarioActivo").val()).length == 0 ||
        $.trim($("#IdOficina").val()).length == 0 ||
        $.trim($("#IdCargo").val()).length == 0) {
        console.log('campos vacíos');
    } else if (!($.trim($("#Clave").val()).match(/^(?=\w*\d)(?=\w*[a-zA-Z])\S{8,20}$/))) {
        console.log('campos incorrectos');
    } else {
        editar(e);
    }
});
// $("#btnGuardar").click(function() {
function campos() {

    if ($.trim($("#IdUsuario").val()).length == 0) {
        console.log('campo Nombre vacío');
        $("#IdUsuario").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoid").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
        $(".infoexis").css("display", "none"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#IdUsuario").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoid").css("display", "none");
    }

    if ($.trim($("#NmUsuario").val()).length == 0) {
        console.log('campo Nombre vacío');
        $("#NmUsuario").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoN").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#NmUsuario").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoN").css("display", "none");
    }

    if ($.trim($("#Clave").val()).length == 0 || !($.trim($("#Clave").val()).match(/^(?=\w*\d)(?=\w*[a-zA-Z])\S{8,20}$/))) {
        console.log('campo Clave  vacío');
        $("#Clave").css("background-color", "rgba(179, 27, 27, 0.096)");
        //   $(this).parent().children('span.infoC');
        $(".infoC").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#Clave").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoC").css("display", "none");
    }

    if ($.trim($("#TipoUsuario").val()).length == 0) { //^[9|6|7][0-9]{8}$ ){
        console.log('campo Tipo Usuario vacío');
        $("#TipoUsuario").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoT").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#TipoUsuario").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoT").css("display", "none");
    }

    if ($.trim($("#FlUsuarioActivo").val()).length == 0) { //|| !($.trim($(this).val()).match(/^S|N+$/)) ){
        console.log('campo Usuario activo  vacío');
        $("#FlUsuarioActivo").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoA").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#FlUsuarioActivo").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoA").css("display", "none");

    }

    if ($.trim($("#IdOficina").val()).length == 0) {
        console.log('campo Usuario activo  vacío');
        $("#IdOficina").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoOfi").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#IdOficina").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoOfi").css("display", "none");
    }

    if ($.trim($("#IdCargo").val()).length == 0) {
        console.log('campo Usuario activo  vacío');
        $("#IdCargo").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoCa").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#IdCargo").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoCa").css("display", "none");
    }
}

function guardar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]); //
    $.ajax({
        url: "../controlador/usuario.php?op=guardar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            console.log(datos);
            swal({
                title: 'Success',
                type: 'success',
                text: datos
            });
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function editar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnEditar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    //console.log(formData);
    $.ajax({
        url: "../controlador/usuario.php?op=editar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            swal({
                title: 'Success',
                type: 'success',
                text: datos
            });
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrarEditar(flag) {
    limpiar();

    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").hide();
        $("#btnEditar").show();
        $("#btnEditar").prop("disabled", false);
        $("#btnagregar").hide();
        $("#btnborrar").hide();
        $("#nuevo").show();
        $("#mlista").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
        $("#btnborrar").show();
        $("#nuevo").hide();
        $("#mlista").show();
    }
}

function mostrar(IdUsuario) {
    $.post("../controlador/usuario.php?op=mostrar", { IdUsuario: IdUsuario }, function(data, _status) {
        data = JSON.parse(data);
        mostrarEditar(true);
        // $('#iduser').css("display","inline");
        $('#IdUsuario').val(IdUsuario);
        $('#NmUsuario').val(data.NmUsuario);
        //$('#Clave').val(data.Clave); 
        $('#TipoUsuario').val(data.TipoUsuario);
        $('#FlUsuarioActivo').val(data.FlUsuarioActivo);
        $('#IdOficina').val(data.IdOficina);
        $('#IdCargo').val(data.IdCargo);
    })
}

function eliminar(IdUsuario) {
    swal({
        title: "¿Eliminar?",
        text: "¿Está Seguro de eliminar el registro?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "No",
        cancelButtonColor: '#FF0000',
        confirmButtonColor: '#008df9',
        confirmButtonText: "Si",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
    }, function(isConfirm) {
        if (isConfirm) {
            $.post("../controlador/usuario.php?op=eliminar", { IdUsuario: IdUsuario }, function(e) {
                swal('!!! Eliminado !!!', e, 'success');
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la Eliminacion", "error");
        }
    });
}
init();