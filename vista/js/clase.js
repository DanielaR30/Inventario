var tabla;

function init() {

    //listadata();
    mostrarform(false);
    listar();

    $.post("../controlador/clase.php?op=selectFamilia", function(r) {
        $("#IDFamilia").html(r);
    });
    // var x = document.getElementById("IDFamilia").value;
    // console.log(x);
}

// function selecCity() {
//     var x = document.getElementById("IDFamilia").value;
//     console.log(x);
// }
// reinicia el select como sino hubiera seleccionado nada

function limpiar() {
    $("#IdClase").val("");
    $("#NmClase").val("");
    $('#IDFamilia').val("");

    $("#IdClase").css("background-color", "rgb(255, 255, 255)");
    $(".inforid").css("display", "none");
    $("#NmClase").css("background-color", "rgb(255, 255, 255)");
    $(".infoOf").css("display", "none");
    $("#IDFamilia").css("background-color", "rgb(255, 255, 255)");
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
        ],
        "ajax": {
            url: '../controlador/clase.php?op=listar',
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

    $('#IdClase').keyup(function() {
        var IdClase = $(this).val();
        var dataString = 'IdClase=' + IdClase;

        $.ajax({
            type: "POST",
            url: "../controlador/clase.php?op=datosid",
            data: dataString,
            success: function(data) {
                console.log(data);

                if (data.trim() !== "\r\nnull" || data.trim() !== undefined || data.trim() !== null || data.trim() !== "null") {
                    data = JSON.parse(data);

                    $('#IdClase').val(IdClase);
                    $('#NmClase').val(data.NmClase);
                    $('#IDFamilia').val(data.IDFamilia);
                    $("#btnGuardar").prop('disabled', true);
                }
            },
            error: function() {
                console.log('Disculpe, existió un problema');
            }
        });

        $.ajax({
            type: "POST",
            url: "../controlador/clase.php?op=validarid",
            data: dataString,
            success: function(data) {
                console.log(data);
                if (data.trim() === "\r\nnull" || data.trim() == undefined || data.trim() == null || data.trim() == "null") {
                    $("#NmClase").val("");
                    $('#IDFamilia').val("");
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
        if ($.trim($("#IdClase").val()).length == 0 ||
            $.trim($("#NmClase").val()).length == 0 ||
            $.trim($("#IDFamilia").val()).length == 0) {
            console.log('campos vacíos');
        } else {
            guardar(e);
        }
    });

    $("#btnEditar").click(function(e) { //Valida que ningun campo esté vacio antes de editar
        campos();
        if ($.trim($("#IdClase").val()).length == 0 ||
            $.trim($("#NmClase").val()).length == 0 ||
            $.trim($("#IDFamilia").val()).length == 0) {
            console.log('campos vacíos');
        } else {
            editar(e);
        }
    });
});

function campos() {

    if ($.trim($("#IdClase").val()).length == 0) {
        console.log('campo NmClase vacío');
        $("#IdClase").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".inforid").css("display", "inline");
    } else {
        $("#IdClase").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".inforid").css("display", "none");
    }

    if ($.trim($("#NmClase").val()).length == 0) {
        console.log('campo NmClase vacío');
        $("#NmClase").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoOf").css("display", "inline");
    } else {
        $("#NmClase").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoOf").css("display", "none");
    }

    if ($.trim($("#IDFamilia").val()).length == 0) {
        console.log('campo IDFamilia vacío');
        $("#IDFamilia").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoCi").css("display", "inline");
    } else {
        $("#IDFamilia").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoCi").css("display", "none");
    }
}

function guardar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]); //
    $.ajax({
        url: "../controlador/clase.php?op=guardar",
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
        url: "../controlador/clase.php?op=editar",
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

function mostrar(IdClase) {
    //  console.log(IdClase);
    $.post("../controlador/clase.php?op=mostrar", { IdClase: IdClase }, function(data, _status) {
        data = JSON.parse(data);
        mostrarEditar(true);
        $('#IdClase').val(IdClase);
        $('#NmClase').val(data.NmClase);
        $('#IDFamilia').val(data.IDFamilia);
        console.log(data.IDFamilia);


    })
}

// var dt = new Date("30 July 2010 15:05 UTC");
// document.write(dt.toISOString());              //moment(date).format("YYYY-MM-DDTkk:mm")

function eliminar(IdClase) {
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
            $.post("../controlador/clase.php?op=eliminar", { IdClase: IdClase }, function(e) {
                swal('!!! Eliminado !!!', e, 'success');
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la Eliminacion", "error");
        }
    });
}

init();