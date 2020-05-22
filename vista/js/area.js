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
    $("#IdArea").val("");
    $("#NmArea").val("");
    $(".infoguar").css("display", "none");
    $("br").css("display", "none");
    $("#NmArea").css("background-color", "rgb(255, 255, 255)");
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
            url: '../controlador/area.php?op=listar',
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

    $("#btnGuardar").click(function(e) { //Valida que ningun campo esté vacio antes de guardar
        // campos();

        if ($.trim($("#NmArea").val()).length == 0) {
            console.log('campos vacíos');
            $("#NmArea").css("background-color", "rgba(179, 27, 27, 0.096)");
            $(".infoC").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
        } else {
            $("#NmArea").css("background-color", "rgba(255, 255, 255, 0.911)");
            $(".infoC").css("display", "none");
            guardar(e);
        }
    });

    $("#btnEditar").click(function(e) { //Valida que ningun campo esté vacio antes de editar
        // campos();

        if ($.trim($("#NmArea").val()).length == 0) {
            console.log('campos vacíos');
            $("#NmArea").css("background-color", "rgba(179, 27, 27, 0.096)");
            $(".infoC").css("display", "inline"); //.fadeOut(1000); .hiden(2000);

        } else {
            $("#NmArea").css("background-color", "rgba(255, 255, 255, 0.911)");
            $(".infoC").css("display", "none");
            editar(e);
        }
    });
});

// function campos() {
//     if ($.trim($("#NmArea").val()).length == 0) {
//         console.log('campo NmArea vacío');
//     } else {
//         // $("#IdUsuario").focus(function(){
//         // });
//     }
// }

function guardar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]); //
    // console.log(formData);
    $.ajax({
        url: "../controlador/area.php?op=guardar",
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
        url: "../controlador/area.php?op=editar",
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

function mostrar(IdArea) {
    $.post("../controlador/area.php?op=mostrar", { IdArea: IdArea }, function(data, _status) {
        data = JSON.parse(data);
        mostrarEditar(true);
        $('#IdArea').val(IdArea);
        $('#NmArea').val(data.NmArea);
    })
}

function eliminar(IdArea) {
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
            $.post("../controlador/area.php?op=eliminar", { IdArea: IdArea }, function(e) {
                swal('!!! Eliminado !!!', e, 'success');
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la Eliminacion", "error");
        }
    });
}
init();