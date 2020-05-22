var tabla;

function init() {
    mostrarform(false);
    listar();
}
// function selecCity() {
//     var x = document.getElementById("IdCiudad").value;
//     console.log(x);
// }
// reinicia el select como sino hubiera seleccionado nada

function limpiar() {
    $("#IdSegmento").val("");
    $("#NmSegmento").val("");
    $(".infoguar").css("display", "none");
    $("br").css("display", "none");
    $("#NmSegmento").css("background-color", "rgb(255, 255, 255)");
    $(".infoC").css("display", "none");
    $(".infoA").css("display", "none");
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
    //   console.log('iniciando............ donde llama esta funcion');
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, // activando los procedimientos de datatables
        "aServerSide": true, // paginacion y filtracion
        dom: 'Bfrtip', // definimos los elementos de la tabla
        buttons: [
            'copy', 'csv', 'excel', 'pdf'

        ],
        "ajax": {
            url: '../controlador/segmento.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {}
        },
        "bDestroy": true,
        "iDisplayLength": 14, // indicamos el numero de paginacion
        "order": [
                [0, "desc"]
            ] // ordernar (columna,orden)
    }).DataTable();
}

$(document).ready(function() {

    $('#IdSegmento').keyup(function() {

        var IdSegmento = $(this).val();
        var dataString = 'IdSegmento=' + IdSegmento;

        $.ajax({
            type: "POST",
            url: "../controlador/segmento.php?op=datosid",
            data: dataString,
            success: function(data) {
                console.log(data);

                if (data.trim() !== "\r\nnull" || data.trim() !== undefined || data.trim() !== null || data.trim() !== "null") {
                    data = JSON.parse(data);

                    $('#IdSegmento').val(IdSegmento);
                    $('#NmSegmento').val(data.NmSegmento);
                    $("#btnGuardar").prop('disabled', true);
                }
            },
            error: function() {
                console.log('Disculpe, existió un problema');
            }
        });

        $.ajax({
            type: "POST",
            url: "../controlador/segmento.php?op=validarid",
            data: dataString,
            success: function(data) {
                console.log(data);
                if (data.trim() === "\r\nnull" || data.trim() == undefined || data.trim() == null || data.trim() == "null") {
                    $("#NmSegmento").val("");
                    $("#btnGuardar").prop('disabled', false);
                }
            },
            error: function() {
                console.log('Disculpe, existió un problema');
            }
        });
    });

    $("#btnGuardar").click(function(e) { //Valida que ningun campo esté vacio antes de guardar
        campos();
        var IdSegmento = $("#IdSegmento").val();
        $.post("../controlador/segmento.php?op=validarid", { "IdSegmento": IdSegmento })
            .done(function(data) {

                if (data.trim() === "\r\nnull" || data.trim() == undefined || data.trim() == null || data.trim() == "null") {
                    console.log(data);
                    console.log('guardar');

                    //   if ($.trim(inputs.val()).length == 0 ){ //validar inputs == 0
                    if ($.trim($("#IdSegmento").val()).length == 0 ||
                        $.trim($("#NmSegmento").val()).length == 0) {
                        console.log('campos vacíos');
                    } else {
                        guardar(e);
                    }
                } else {
                    console.log("datos ok");
                    console.log(data);
                    $("#IdSegmento").css("background-color", "rgba(179, 27, 27, 0.096)");
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
    });

    $("#btnEditar").click(function(e) { //Valida que ningun campo esté vacio antes de editar
        campos();
        if ($.trim($("#IdSegmento").val()).length == 0 ||
            $.trim($("#NmSegmento").val()).length == 0) {
            console.log('campos vacíos');
        } else {
            editar(e);
        }
    });
});

function campos() {
    if ($.trim($("#IdSegmento").val()).length == 0) {
        console.log('campo IdSegmento vacío');
        $("#IdSegmento").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoseg").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#IdSegmento").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoseg").css("display", "none");
    }

    if ($.trim($("#NmSegmento").val()).length == 0) {
        console.log('campo NmSegmento vacío');
        $("#NmSegmento").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoC").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        // $("#IdUsuario").focus(function(){
        $("#NmSegmento").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoC").css("display", "none");
        // });
    }
}

function guardar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]); //
    // console.log(formData);
    $.ajax({
        url: "../controlador/segmento.php?op=guardar",
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

function editar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnEditar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    //console.log(formData);
    $.ajax({
        url: "../controlador/segmento.php?op=editar",
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

function mostrar(IdSegmento) {
    $.post("../controlador/segmento.php?op=mostrar", { IdSegmento: IdSegmento }, function(data, _status) {
        data = JSON.parse(data);
        mostrarEditar(true);
        $('#IdSegmento').val(IdSegmento);
        $('#NmSegmento').val(data.NmSegmento);
    })
}

function eliminar(IdSegmento) {
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
            $.post("../controlador/segmento.php?op=eliminar", { IdSegmento: IdSegmento }, function(e) {
                swal('!!! Eliminado !!!', e, 'success');
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la Eliminacion", "error");
        }
    });
}

init();