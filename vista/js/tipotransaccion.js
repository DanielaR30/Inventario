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
    // $("#idOficina").val("");
    $("#NmTipoTransaccion").val("");
    $("#CdNaturaleza").val("");
    $(".infoguar").css("display", "none");
    $("br").css("display", "none");
    $("#NmTipoTransaccion").css("background-color", "rgb(255, 255, 255)");
    $(".infoC").css("display", "none");
    $("#CdNaturaleza").css("background-color", "rgb(255, 255, 255)");
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
            // {
            //     extend: 'print',
            //     exportOptions: {
            //         columns: ':visible'
            //     }
            // },
            // 'colvis'
        ],
        // buttons: ['copy', 'excel', 'pdf', 'colvis'],
        "ajax": {
            url: '../controlador/tipotransaccion.php?op=listar',
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


    $('#IdTipoTransaccion').keyup(function() {

        var IdTipoTransaccion = $(this).val();
        var dataString = 'IdTipoTransaccion=' + IdTipoTransaccion;

        $.ajax({
            type: "POST",
            url: "../controlador/tipotransaccion.php?op=datosid",
            data: dataString,
            success: function(data) {
                console.log(data);

                if (data.trim() !== "\r\nnull" || data.trim() !== undefined || data.trim() !== null || data.trim() !== "null") {
                    data = JSON.parse(data);

                    $('#IdTipoTransaccion').val(IdTipoTransaccion);
                    $('#NmTipoTransaccion').val(data.NmTipoTransaccion);
                    $('#CdNaturaleza').val(data.CdNaturaleza);
                    $("#btnGuardar").prop('disabled', true);
                }
            },
            error: function() {
                console.log('Disculpe, existió un problema');
            }
        });

        $.ajax({
            type: "POST",
            url: "../controlador/tipotransaccion.php?op=validarid",
            data: dataString,
            success: function(data) {
                console.log(data);
                if (data.trim() === "\r\nnull" || data.trim() == undefined || data.trim() == null || data.trim() == "null") {
                    $("#NmTipoTransaccion").val("");
                    $('#CdNaturaleza').val("");
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

        //   if ($.trim(inputs.val()).length == 0 ){ //validar inputs == 0
        if ($.trim($("#NmTipoTransaccion").val()).length == 0 || $.trim($("#CdNaturaleza").val()).length == 0) {
            console.log('campos vacíos');
        } else {
            guardar(e);
        }
    });

    $("#btnEditar").click(function(e) { //Valida que ningun campo esté vacio antes de editar
        campos();
        //   if ($.trim(inputs.val()).length == 0 ){ //validar inputs == 0
        if ($.trim($("#NmTipoTransaccion").val()).length == 0 || $.trim($("#CdNaturaleza").val()).length == 0) {
            console.log('campos vacíos');
        } else {
            editar(e);
        }
    });
});


function campos() {

    if ($.trim($("#NmTipoTransaccion").val()).length == 0) {
        console.log('campo NmTipoTransaccion vacío');
        $("#NmTipoTransaccion").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoC").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#NmTipoTransaccion").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoC").css("display", "none");
    }

    if ($.trim($("#CdNaturaleza").val()).length == 0) {
        console.log('campo CdNaturaleza vacío');
        $("#CdNaturaleza").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoA").css("display", "inline");
    } else {
        $("#CdNaturaleza").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoA").css("display", "none");
    }

}


function guardar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]); //
    // console.log(formData);
    $.ajax({
        url: "../controlador/tipotransaccion.php?op=guardar",
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
        url: "../controlador/tipotransaccion.php?op=editar",
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

function mostrar(IdTipoTransaccion) {
    $.post("../controlador/tipotransaccion.php?op=mostrar", { IdTipoTransaccion: IdTipoTransaccion }, function(data, _status) {
        data = JSON.parse(data);
        mostrarEditar(true);
        $('#IdTipoTransaccion').val(IdTipoTransaccion);
        $('#NmTipoTransaccion').val(data.NmTipoTransaccion);
        $('#CdNaturaleza').val(data.CdNaturaleza);
    })
}

function eliminar(IdTipoTransaccion) {
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
            $.post("../controlador/tipotransaccion.php?op=eliminar", { IdTipoTransaccion: IdTipoTransaccion }, function(e) {
                swal('!!! Eliminado !!!', e, 'success');
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la Eliminacion", "error");
        }
    });
}

init();