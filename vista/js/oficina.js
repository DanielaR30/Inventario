var tabla;

function init() {

    //listadata();
    mostrarform(false);
    listar();

    $.post("../controlador/oficina.php?op=selectCiudad", function(r) {
        $("#IdCiudad").html(r);
    });
    // var x = document.getElementById("IdCiudad").value;
    // console.log(x);
}

// function selecCity() {
//     var x = document.getElementById("IdCiudad").value;
//     console.log(x);
// }
// reinicia el select como sino hubiera seleccionado nada

function limpiar() {
    $("#idOficina").val("");
    $("#NmOficina").val("");
    $("#Direccion").val("");
    $("#Telefono").val("");
    $('#IdCiudad').val("");
    $(".infoguar").css("display", "none");
    $("br").css("display", "none");
    $("#idOficina").css("background-color", "rgb(255, 255, 255)");
    $(".inforid").css("display", "none");
    $(".espacio").css("display", "none");
    $("#NmOficina").css("background-color", "rgb(255, 255, 255)");
    $(".infoOf").css("display", "none");
    $("#Direccion").css("background-color", "rgb(255, 255, 255)");
    $(".infoDir").css("display", "none");
    $(".espacio1").css("display", "none");
    $("#Telefono").css("background-color", "rgb(255, 255, 255)");
    $(".infoTe").css("display", "none");
    $("#IdCiudad").css("background-color", "rgb(255, 255, 255)");
    $(".infoCi").css("display", "none");
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
    // console.log('iniciando............ donde llama esta funcion');
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, // activando los procedimientos de datatables
        "aServerSide": true, // paginacion y filtracion
        dom: 'Bfrtip', // definimos los elementos de la tabla
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
            // 'copyHtkml5','excelHtml5','csvHtml5', 'pdf',
            // {
            //     extend: 'print',
            //     exportOptions: {
            //         columns: ':visible'
            //     }
            // },
            // 'colvis'
        ],
        "ajax": {
            url: '../controlador/oficina.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
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

    $('#idOficina').keyup(function() {
        var idOficina = $(this).val();
        var dataString = 'idOficina=' + idOficina;

        $.ajax({
            type: "POST",
            url: "../controlador/oficina.php?op=datosid",
            data: dataString,
            success: function(data) {
                console.log(data);

                if (data.trim() !== "\r\nnull" || data.trim() !== undefined || data.trim() !== null || data.trim() !== "null") {
                    data = JSON.parse(data);

                    $('#idOficina').val(idOficina);
                    $('#NmOficina').val(data.NmOficina);
                    $('#Direccion').val(data.Direccion);
                    $('#Telefono').val(data.Telefono);
                    $('#IdCiudad').val(data.IdCiudad);
                    $("#btnGuardar").prop('disabled', true);
                }
            },
            error: function() {
                console.log('Disculpe, existió un problema');
            }
        });

        $.ajax({
            type: "POST",
            url: "../controlador/oficina.php?op=validarid",
            data: dataString,
            success: function(data) {
                console.log(data);
                if (data.trim() === "\r\nnull" || data.trim() == undefined || data.trim() == null || data.trim() == "null") {
                    $("#NmOficina").val("");
                    $("#Direccion").val("");
                    $("#Telefono").val("");
                    $('#IdCiudad').val("");
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
        var idOficina = $("#idOficina").val();
        $.post("../controlador/oficina.php?op=validarid", { "idOficina": idOficina })
            .done(function(data) {

                if (data.trim() === "\r\nnull" || data.trim() == undefined || data.trim() == null || data.trim() == "null") {
                    console.log(data);
                    console.log('guardar');

                    if ($.trim($("#idOficina").val()).length == 0 ||
                        $.trim($("#NmOficina").val()).length == 0 ||
                        $.trim($("#Direccion").val()).length == 0 ||
                        $.trim($("#Telefono").val()).length == 0 ||
                        $.trim($("#IdCiudad").val()).length == 0) {
                        console.log('campos vacíos');

                    } else if (!($.trim($("#Telefono").val()).match(/^[0-9]{7}$/))) {
                        console.log('campos incorrectos');
                    } else {
                        guardar(e);
                    }
                } else {
                    console.log("datos ok");
                    console.log(data);
                    $("#idOficina").css("background-color", "rgba(179, 27, 27, 0.096)");
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
        if ($.trim($("#idOficina").val()).length == 0 ||
            $.trim($("#NmOficina").val()).length == 0 ||
            $.trim($("#Direccion").val()).length == 0 ||
            $.trim($("#Telefono").val()).length == 0 ||
            $.trim($("#IdCiudad").val()).length == 0) {
            console.log('campos vacíos');
            $(".infoguar").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
            $("br").css("display", "inline"); //.fadeOut(1000); .hiden(2000);

        } else if (!($.trim($("#Telefono").val()).match(/^[0-9]{7}$/))) {
            console.log('campos incorrectos');
        } else {
            editar(e);
        }
    });
});

function campos() {
    if ($.trim($("#idOficina").val()).length == 0) {
        console.log('campo idOficina vacío');
        $("#idOficina").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".inforid").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#idOficina").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".inforid").css("display", "none");
    }

    if ($.trim($("#NmOficina").val()).length == 0) {
        console.log('campo NmOficina vacío');
        $("#NmOficina").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoOf").css("display", "inline");

    } else {
        $("#NmOficina").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoOf").css("display", "none");
    }

    if ($.trim($("#Direccion").val()).length == 0) {
        console.log('campo Direccion vacío');
        $("#Direccion").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoDir").css("display", "inline");

    } else {
        $("#Direccion").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoDir").css("display", "none");
    }

    if ($.trim($("#Telefono").val()).length == 0 || !($.trim($("#Telefono").val()).match(/^[0-9]{7}$/))) {
        console.log('campo Telefono vacío');
        $("#Telefono").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoTe").css("display", "inline");
    } else {
        $("#Telefono").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoTe").css("display", "none");
    }

    if ($.trim($("#IdCiudad").val()).length == 0) {
        console.log('campo IdCiudad vacío');
        $("#IdCiudad").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoCi").css("display", "inline");
    } else {
        $("#IdCiudad").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoCi").css("display", "none");
    }
}

function guardar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]); //
    $.ajax({
        url: "../controlador/oficina.php?op=guardar",
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
        url: "../controlador/oficina.php?op=editar",
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

function mostrar(idOficina) {
    //  console.log(idOficina);
    $.post("../controlador/oficina.php?op=mostrar", { idOficina: idOficina }, function(data, _status) {
        data = JSON.parse(data);
        mostrarEditar(true);
        $('#idOficina').val(idOficina);
        $('#NmOficina').val(data.NmOficina);
        $('#Direccion').val(data.Direccion);
        $('#Telefono').val(data.Telefono);
        $('#IdCiudad').val(data.IdCiudad);
        console.log(data.IdCiudad);


    })
}

// var dt = new Date("30 July 2010 15:05 UTC");
// document.write(dt.toISOString());              //moment(date).format("YYYY-MM-DDTkk:mm")

function eliminar(idOficina) {
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
            $.post("../controlador/oficina.php?op=eliminar", { idOficina: idOficina }, function(e) {
                swal('!!! Eliminado !!!', e, 'success');
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la Eliminacion", "error");
        }
    });
}

init();