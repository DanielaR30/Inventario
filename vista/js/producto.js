var tabla;

function init() {

    mostrarform(false);
    listar();

    $.post("../controlador/producto.php?op=selectClase", function(r) {
        $("#fclase").html(r);
    });

    $.post("../controlador/producto.php?op=selectClase", function(r) {
        $("#IdClase").html(r);
    });

    $.post("../controlador/producto.php?op=selectMarca", function(r) {
        $("#IdMarca").html(r);
    });

    $.post("../controlador/producto.php?op=selectLinea", function(r) {
        $("#IdLinea").html(r);
    });

    $.post("../controlador/producto.php?op=selectUnidad", function(r) {
        $("#IdUnidadMedida").html(r);
    });

    $.post("../controlador/producto.php?op=selectBodega", function(r) {
        $("#IdLocalizacion").html(r);
    });

    $.post("../controlador/producto.php?op=selectEstado", function(r) {
        $("#IdEstadoProducto").html(r);
    });

    $("#imagenmuestra").hide();
}

function limpiar() {
    $("#IdProducto").val("");
    $("#IdClase").val("");
    $("#NmProducto").val("");
    $("#Descripcion").val("");
    $('#CodigoBarras').val("");
    $('#ImagenProducto').val("");
    $("#imagenmuestra").hide();

    $("#imagenpre").empty();
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#print").hide();
    $("#IdMarca").val("");
    $('#IdLinea').val("");
    $('#IdUnidadMedida').val("");
    $("#IdLocalizacion").val("");
    // $("#NuExistenciaFisica").val("");
    // $("#NuExistenciaEnTransito").val("");
    $("#NuStockMin").val("");
    $("#NuStockMax").val("");
    // $("#VlCostoPromedio").val("");
    // $("#PrecioVentaEf").val("");
    // $("#PrecioVentaCr").val("");
    // $("#IdEstadoProducto").val("");
    $("#IdProducto").css("background-color", "rgb(255, 255, 255)");
    $(".infoT").css("display", "none");
    $("#IdClase").css("background-color", "rgb(255, 255, 255)");
    $(".infoCiu").css("display", "none");
    $("#NmProducto").css("background-color", "rgb(255, 255, 255)");
    $(".infoR").css("display", "none");
    $("#Descripcion").css("background-color", "rgb(255, 255, 255)");
    $(".infoDir").css("display", "none");
    $("#CodigoBarras").css("background-color", "rgb(255, 255, 255)");
    $(".infoTel").css("display", "none");
    $("#ImagenProducto").css("background-color", "rgb(255, 255, 255)");
    $(".infoimg").css("display", "none");
    $("#IdMarca").css("background-color", "rgb(255, 255, 255)");
    $(".infomrc").css("display", "none");
    $("#IdLinea").css("background-color", "rgb(255, 255, 255)");
    $(".infoCor").css("display", "none");
    $("#IdUnidadMedida").css("background-color", "rgb(255, 255, 255)");
    $(".infoDocu").css("display", "none");
    $("#IdLocalizacion").css("background-color", "rgb(255, 255, 255)");
    $(".infolo").css("display", "none");
    // $("#NuExistenciaFisica").css("background-color", "rgb(255, 255, 255)");
    // $(".infofi").css("display", "none");
    // $("#NuExistenciaEnTransito").css("background-color", "rgb(255, 255, 255)");
    // $(".infotra").css("display", "none");
    $("#NuStockMin").css("background-color", "rgb(255, 255, 255)");
    $(".infomi").css("display", "none");
    $("#NuStockMax").css("background-color", "rgb(255, 255, 255)");
    $(".infoma").css("display", "none");
    // $("#VlCostoPromedio").css("background-color", "rgb(255, 255, 255)");
    // $(".infocosto").css("display", "none");
    // $("#PrecioVentaEf").css("background-color", "rgb(255, 255, 255)");
    // $(".infoef").css("display", "none");
    // $("#PrecioVentaCr").css("background-color", "rgb(255, 255, 255)");
    // $(".infocr").css("display", "none");
    // $("#IdEstadoProducto").css("background-color", "rgb(255, 255, 255)");
    // $(".infoes").css("display", "none");
    // $("#barcode").css("display", "none");

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
            url: '../controlador/producto.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            },
        },
        /*         "columns": [
                    { "data": 0 },
                    { "data": 1 },
                    { "data": 2 },
                    { "data": 3 },
                    { "data": 4 },
                    { "data": 5 },
                    { "data": 6 },
                    { "data": 7 },
                    { "data": 8 },
                    { "data": 9 },
                    { "data": 10 },
                    { "data": 11 },
                    { "data": 12 },
                    { "data": 13 },
                    { "data": 14 },
                    { "data": 15 },
                    { "data": 16 },
                    { "data": 17 },
                    { "data": 18 }
                ], */
        initComplete: function() {
            this.api().columns([2]).every(function() {
                var column = this;
                var select = $('<select><option value="">All</option></select>')
                    // .appendTo($(column.footer()))
                    .appendTo($(column.header()))
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.cells('', column[0]).render('display').sort().unique().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        },
        "bDestroy": true,
        "iDisplayLength": 10, // indicamos el numero de paginacion
        "order": [
                [0, "desc"]
            ] // ordernar (columna,orden)
    }).DataTable();

}

// function listarfclase() {
// }


$(document).ready(function() {

    // $('#fclase').change(function() {

    //     $("#tbllistado").css("display", "none");
    //     $("#tblfclase").css("display", "inline");
    //     // console.log('iniciando............ donde llama esta funcion');
    //     var IdClase = $(this).val();
    //     var dataString = 'IdClase=' + IdClase;
    //     // console.log(dataString);
    //     tabla = $('#tblfclase').dataTable({
    //         select: true,
    //         // scrollY: "550px",
    //         // scrollX: true,
    //         // scrollCollapse: true,
    //         // paging: false,
    //         // fixedColumns: true,
    //         // columnDefs: [
    //         //     { width: 70, targets: 0 },
    //         // ],
    //         "aProcessing": true, // activando los procedimientos de datatables
    //         "aServerSide": true, // paginacion y filtracion
    //         dom: 'Bfrtip', // definimos los elementos de la tabla
    //         buttons: [
    //             'copy', 'csv', 'excel', 'pdf'
    //         ],
    //         "ajax": {
    //             type: "POST",
    //             url: '../controlador/producto.php?op=listarfclase',
    //             data: dataString,
    //             dataType: "json",
    //             error: function(e) {
    //                 console.log(e.responseText);
    //             }
    //         },
    //         "bDestroy": true,
    //         "iDisplayLength": 14, // indicamos el numero de paginacion
    //         "order": [
    //                 [0, "desc"]
    //             ] // ordernar (columna,orden)
    //     }).DataTable();
    //     // var IdClase = $(this).val();
    //     // var dataString = 'IdClase=' + IdClase;
    //     //mostrar el id de producto, autoincremental según familia, segmento y clase.
    //     // $.ajax({
    //     //     type: "POST",
    //     //     url: "../controlador/producto.php?op=listarfclase",
    //     //     data: dataString,
    //     //     success: function(data) {
    //     //         console.log(data);
    //     //     },
    //     // });
    // });


    $('#IdClase').click(function() {
        var IdClase = $(this).val();
        var dataString = 'IdClase=' + IdClase;

        //mostrar el id de producto, autoincremental según familia, segmento y clase.
        $.ajax({
            type: "POST",
            url: "../controlador/producto.php?op=mostrarid",
            data: dataString,
            success: function(data) {
                console.log(data);

                if (data.trim() !== "\r\nnull" || data.trim() !== undefined || data.trim() !== null || data.trim() !== "null") {
                    data = JSON.parse(data);

                    $('#IdProducto').val(data);

                    generarbarcode();
                    $("#barcode").css("display", "inline");
                }
            },
            error: function() {
                console.log('Disculpe, existió un problema');
            }
        });
    });


    //mostrar los datos según el id existente
    $('#IdProducto').keyup(function() {
        var IdProducto = $(this).val();
        var dataString = 'IdProducto=' + IdProducto;
        $.ajax({
            type: "POST",
            url: "../controlador/producto.php?op=datosid",
            data: dataString,
            success: function(data) {
                console.log(data);

                if (data.trim() !== "\r\nnull" || data.trim() !== undefined || data.trim() !== null || data.trim() !== "null") {
                    data = JSON.parse(data);

                    $('#IdProducto').val(IdProducto);
                    $('#IdClase').val(data.IdClase);
                    $('#NmProducto').val(data.NmProducto);
                    $('#Descripcion').val(data.Descripcion);
                    $('#CodigoBarras').val(data.CodigoBarras);
                    // $('#ImagenProducto').val(data.ImagenProducto);
                    $("#imagenmuestra").show();
                    $("#imagenmuestra").attr("src", "../public/img/" + data.ImagenProducto);
                    $("#imagenactual").val(data.ImagenProducto);
                    $('#IdMarca').val(data.IdMarca);
                    $('#IdLinea').val(data.IdLinea);
                    $('#IdUnidadMedida').val(data.IdUnidadMedida);
                    $('#IdLocalizacion').val(data.IdLocalizacion);
                    // $('#NuExistenciaFisica').val(data.NuExistenciaFisica);
                    // $('#NuExistenciaEnTransito').val(data.NuExistenciaEnTransito);
                    $('#NuStockMin').val(data.NuStockMin);
                    $('#NuStockMax').val(data.NuStockMax);
                    // $('#VlCostoPromedio').val(data.VlCostoPromedio);
                    // $('#PrecioVentaEf').val(data.PrecioVentaEf);
                    // $('#PrecioVentaCr').val(data.PrecioVentaCr);
                    // $('#IdEstadoProducto').val(data.IdEstadoProducto);
                    //desabilitar el boton de guardar
                    $("#btnGuardar").prop('disabled', true);
                }
            },
            error: function() {
                console.log('Disculpe, existió un problema');
            }
        });

        $.ajax({
            type: "POST",
            url: "../controlador/producto.php?op=validarid",
            data: dataString,
            success: function(data) {
                console.log(data);
                if (data.trim() === "\r\nnull" || data.trim() == undefined || data.trim() == null || data.trim() == "null") {

                    // $('#IdProducto').val("");
                    $('#IdClase').val("");
                    $('#NmProducto').val("");
                    $('#Descripcion').val("");
                    $('#CodigoBarras').val("");
                    // $('#ImagenProducto').val("");
                    // $("#imagenmuestra").hide();
                    $("#imagenmuestra").attr("src", "");
                    $("#imagenactual").val("");
                    $('#IdMarca').val("");
                    $('#IdLinea').val("");
                    $('#IdUnidadMedida').val("");
                    $('#IdLocalizacion').val("");
                    // $('#NuExistenciaFisica').val("");
                    // $('#NuExistenciaEnTransito').val("");
                    $('#NuStockMin').val("");
                    $('#NuStockMax').val("");
                    // $('#VlCostoPromedio').val("");
                    // $('#PrecioVentaEf').val("");
                    // $('#PrecioVentaCr').val("");
                    // $('#IdEstadoProducto').val("");
                    $("#btnGuardar").prop('disabled', false);
                }
            },
            error: function() {
                console.log('Disculpe, existió un problema');
            }
        });
    });


    $("#ImagenProducto").on('change', function() {
        $("#imagenmuestra").hide();
        $("#imagenmuestra").attr("src", "");
        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#imagenpre");
        image_holder.empty();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image"

                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
            } else {
                // alert("This browser does not support FileReader.");
                console.log("This browser does not support FileReader.");
            }
        } else {
            consol.log("elect only images");
            // alert("Pls select only images");
        }

    });

    // $("#imagenactual").change(function() {
    //     //obtener referencia al input y a la imagen
    //     //selecarchivos
    //     let imgactual = $("#imagenactual").val();
    //     let imagenmuestra = $("#imagenmuestra").val();

    //     let objectURL = URL.createObjectURL(imgactual);
    //     imagenmuestra.src = objectURL;

    //     $("#imagenmuestra").show();
    //     $("#imagenmuestra").attr(imagenmuestra.src);
    // });

    // document.getElementById("ImagenProducto").onchange = function(e) {
    //     // Creamos el objeto de la clase FileReader
    //     let reader = new FileReader();

    //     // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    //     reader.readAsDataURL(e.target.files[0]);

    //     // Le decimos que cuando este listo ejecute el código interno
    //     reader.onload = function() {
    //         let preview = document.getElementById('imagenmuestra'),
    //             image = document.createElement('img');

    //         image.src = reader.result;

    //         preview.innerHTML = '';
    //         preview.append(image);
    //     };
    // }



    // Obtener referencia al input y a la imagen

    // const $seleccionArchivos = document.querySelector("#ImagenProducto"),
    //     $imagenPrevisualizacion = document.querySelector("#imagenmuestra");

    // // Escuchar cuando cambie
    // $seleccionArchivos.addEventListener("change", () => {
    //     // Los archivos seleccionados, pueden ser muchos o uno
    //     const archivos = $seleccionArchivos.files;
    //     // Si no hay archivos salimos de la función y quitamos la imagen
    //     if (!archivos || !archivos.length) {
    //         $imagenPrevisualizacion.src = "";
    //         return;
    //     }
    //     // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    //     const primerArchivo = archivos[0];
    //     // Lo convertimos a un objeto de tipo objectURL
    //     const objectURL = URL.createObjectURL(primerArchivo);
    //     // Y a la fuente de la imagen le ponemos el objectURL
    //     $imagenPrevisualizacion.src = objectURL;
    // });


});

// previewFile();

// function previewFile(e) {

//     // console.log("entrooooooooooooooo");
//     // var preview = document.querySelector('img');
//     var preview = $("#imagenmuestra");
//     preview.css('display', 'none');
//     // var file = document.querySelector('input[type=file]').files[];
//     var file = $("#ImagenProducto").files;
//     var reader = new FileReader();

//     reader.onloadend = function() {
//         preview.attr('src', reader.result);
//         preview.css('display', 'block');

//         // preview.src = reader.result;
//     }

//     if (file) {
//         reader.readAsDataURL(file);
//     } else {
//         // preview.src = "";
//         preview.css('display', 'none');
//         preview.attr('src', '');
//     }

//     reader.onloadend = function(e) {
//         preview.attr('src', reader.result);
//         preview.css('display', 'block');
//     }

// }



// $(window).load(function() {
// $(function() {
//     $('#ImagenProducto').change(function(e) {
//         addImage(e);
//     });

//     function addImage(e) {
//         var file = e.target.files[0],
//             imageType = /image.*/;

//         if (!file.type.match(imageType))
//             return;

//         var reader = new FileReader();
//         reader.onload = fileOnload;
//         reader.readAsDataURL(file);
//     }

//     function fileOnload(e) {
//         var result = e.target.result;
//         $('#imagenmuestra').attr("src", result);
//     }
// });
// });


$("#btnGuardar").click(function(e) {
    campos();

    if (
        $.trim($("#IdProducto").val()).length == 0 ||
        $.trim($("#IdClase").val()).length == 0 ||
        $.trim($("#NmProducto").val()).length == 0 ||
        // $.trim($("#Descripcion").val()).length == 0 ||
        // $.trim($("#CodigoBarras").val()).length == 0 ||
        // $.trim($("#ImagenProducto").val()).length == 0 ||
        $.trim($("#IdMarca").val()).length == 0 ||
        $.trim($("#IdLinea").val()).length == 0 ||
        $.trim($("#IdUnidadMedida").val()).length == 0 ||
        $.trim($("#IdLocalizacion").val()).length == 0 ||
        // $.trim($("#NuExistenciaFisica").val()).length == 0 ||
        // $.trim($("#NuExistenciaEnTransito").val()).length == 0 ||
        $.trim($("#NuStockMin").val()).length == 0 ||
        $.trim($("#NuStockMax").val()).length == 0
        // $.trim($("#VlCostoPromedio").val()).length == 0 ||
        // $.trim($("#PrecioVentaEf").val()).length == 0 ||
        // $.trim($("#PrecioVentaCr").val()).length == 0 ||
        // $.trim($("#IdEstadoProducto").val()).length == 0
    ) {
        console.log('campos vacíos');
    } else {
        guardar(e);
    }

});

$("#btnEditar").click(function(e) { //Valida que ningun campo esté vacio antes de editar
    campos();

    if ($.trim($("#IdProducto").val()).length == 0 ||
        $.trim($("#IdClase").val()).length == 0 ||
        $.trim($("#NmProducto").val()).length == 0 ||
        // $.trim($("#Descripcion").val()).length == 0 ||
        // $.trim($("#CodigoBarras").val()).length == 0 ||
        // $.trim($("#ImagenProducto").val()).length == 0 ||
        $.trim($("#IdMarca").val()).length == 0 ||
        $.trim($("#IdLinea").val()).length == 0 ||
        $.trim($("#IdUnidadMedida").val()).length == 0 ||
        $.trim($("#IdLocalizacion").val()).length == 0 ||
        // $.trim($("#NuExistenciaFisica").val()).length == 0 ||
        // $.trim($("#NuExistenciaEnTransito").val()).length == 0 ||
        $.trim($("#NuStockMin").val()).length == 0 ||
        $.trim($("#NuStockMax").val()).length == 0
        // $.trim($("#VlCostoPromedio").val()).length == 0 ||
        // $.trim($("#PrecioVentaEf").val()).length == 0 ||
        // $.trim($("#PrecioVentaCr").val()).length == 0 ||
        // $.trim($("#IdEstadoProducto").val()).length == 0
    ) {
        console.log('campos vacíos');
    } else {
        editar(e);
    }
});


function generarbarcode() {
    codigo = $("#IdProducto").val();
    JsBarcode("#barcode", codigo, {
        formato: " EAN13 ",
        width: 1,
        height: 30,
        fontSize: 13,
        flat: false
    });
    $("#print").show();
}

function imprimir() {
    $("#print").printArea();
}


//valida que ningún campo esté vacío
function campos() {

    if ($.trim($("#IdProducto").val()).length == 0) {
        console.log('campo IdProducto vacío');
        $("#IdProducto").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoT").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#IdProducto").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoT").css("display", "none");
    }

    if ($.trim($("#IdClase").val()).length == 0) {
        console.log('campo IdClase vacío');
        $("#IdClase").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoCiu").css("display", "inline"); //.fadeOut(1000); .hiden(2000);

    } else {
        $("#IdClase").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoCiu").css("display", "none");
    }

    if ($.trim($("#NmProducto").val()).length == 0) {
        console.log('campo NmProducto vacío');
        $("#NmProducto").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoR").css("display", "inline");
    } else {
        $("#NmProducto").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoR").css("display", "none");
    }

    if ($.trim($("#Descripcion").val()).length == 0) {
        console.log('campo Descripcion vacío');
        $("#Descripcion").css("background-color", "rgba(179, 27, 27, 0.096)");
        // $(".infoDir").css("display", "inline");
    } else {
        $("#Descripcion").css("background-color", "rgba(255, 255, 255, 0.911)");
        // $(".infoDir").css("display", "none");
    }

    if ($.trim($("#CodigoBarras").val()).length == 0) {
        console.log('campo CodigoBarras vacío');
        $("#CodigoBarras").css("background-color", "rgba(179, 27, 27, 0.096)");
        // $(".infoTel").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#CodigoBarras").css("background-color", "rgba(255, 255, 255, 0.911)");
        // $(".infoTel").css("display", "none");
    }

    if ($.trim($("#ImagenProducto").val()).length == 0) {
        console.log('campo CodigoBarras vacío');
        $("#ImagenProducto").css("background-color", "rgba(179, 27, 27, 0.096)");
        // $(".infoimg").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#ImagenProducto").css("background-color", "rgba(255, 255, 255, 0.911)");
        // $(".infoimg").css("display", "none");
    }

    if ($.trim($("#IdMarca").val()).length == 0) {
        console.log('campo IdMarca vacío');
        $("#IdMarca").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infomrc").css("display", "inline");

    } else {
        $("#IdMarca").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infomrc").css("display", "none");
    }

    if ($.trim($("#IdLinea").val()).length == 0) {
        console.log('campo IdLinea vacío');
        $("#IdLinea").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoCor").css("display", "inline");

    } else {
        $("#IdLinea").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoCor").css("display", "none");
    }

    if ($.trim($("#IdUnidadMedida").val()).length == 0) {
        console.log('campo IdUnidadMedida vacío');
        $("#IdUnidadMedida").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoDocu").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#IdUnidadMedida").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoDocu").css("display", "none");
    }

    if ($.trim($("#IdLocalizacion").val()).length == 0) {
        console.log('campo IdUnidadMedida vacío');
        $("#IdLocalizacion").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infolo").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#IdLocalizacion").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infolo").css("display", "none");
    }

    // if ($.trim($("#NuExistenciaFisica").val()).length == 0) {
    //     console.log('campo IdUnidadMedida vacío');
    //     $("#NuExistenciaFisica").css("background-color", "rgba(179, 27, 27, 0.096)");
    //     $(".infofi").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    // } else {
    //     $("#NuExistenciaFisica").css("background-color", "rgba(255, 255, 255, 0.911)");
    //     $(".infofi").css("display", "none");
    // }

    // if ($.trim($("#NuExistenciaEnTransito").val()).length == 0) {
    //     console.log('campo IdUnidadMedida vacío');
    //     $("#NuExistenciaEnTransito").css("background-color", "rgba(179, 27, 27, 0.096)");
    //     $(".infotra").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    // } else {
    //     $("#NuExistenciaEnTransito").css("background-color", "rgba(255, 255, 255, 0.911)");
    //     $(".infotra").css("display", "none");
    // }

    if ($.trim($("#NuStockMin").val()).length == 0) {
        console.log('campo NuStockMin vacío');
        $("#NuStockMin").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infomi").css("display", "inline"); //.fadeOut(1000); .hiden(2000);

    } else {
        $("#NuStockMin").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infomi").css("display", "none");
    }

    if ($.trim($("#NuStockMax").val()).length == 0) {
        console.log('campo NuStockMax vacío');
        $("#NuStockMax").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infoma").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#NuStockMax").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infoma").css("display", "none");
    }

    // if ($.trim($("#VlCostoPromedio").val()).length == 0) {
    //     console.log('campo VlUltimoCosto vacío');
    //     $("#VlCostoPromedio").css("background-color", "rgba(179, 27, 27, 0.096)");
    //     $(".infocosto").css("display", "inline");
    // } else {
    //     $("#VlCostoPromedio").css("background-color", "rgba(255, 255, 255, 0.911)");
    //     $(".infocosto").css("display", "none");
    // }

    // if ($.trim($("#PrecioVentaEf").val()).length == 0) {
    //     console.log('campo precioVef vacío');
    //     $("#PrecioVentaEf").css("background-color", "rgba(179, 27, 27, 0.096)");
    //     $(".infoef").css("display", "inline");
    // } else {
    //     $("#PrecioVentaEf").css("background-color", "rgba(255, 255, 255, 0.911)");
    //     $(".infoef").css("display", "none");
    // }

    // if ($.trim($("#PrecioVentaCr").val()).length == 0) {
    //     console.log('campo VlUltimoCosto vacío');
    //     $("#PrecioVentaCr").css("background-color", "rgba(179, 27, 27, 0.096)");
    //     $(".infopv").css("display", "inline");
    // } else {
    //     $("#PrecioVentaCr").css("background-color", "rgba(255, 255, 255, 0.911)");
    //     $(".infopv").css("display", "none");
    // }

    // if ($.trim($("#IdEstadoProducto").val()).length == 0) {
    //     console.log('campo VlUltimoCosto vacío');
    //     $("#IdEstadoProducto").css("background-color", "rgba(179, 27, 27, 0.096)");
    //     $(".infoes").css("display", "inline");
    // } else {
    //     $("#IdEstadoProducto").css("background-color", "rgba(255, 255, 255, 0.911)");
    //     $(".infoes").css("display", "none");
    // }
}

function guardar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]); //
    $.ajax({
        url: "../controlador/producto.php?op=guardar",
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
        url: "../controlador/producto.php?op=editar",
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

function mostrar(IdProducto) {
    //  console.log(idOficina);
    $.post("../controlador/producto.php?op=mostrar", { IdProducto: IdProducto }, function(data, _status) {
        data = JSON.parse(data);
        console.log(data);
        console.log(data.VlCostoPromedio);
        mostrarEditar(true);
        $('#IdProducto').val(IdProducto);
        $('#IdClase').val(data.IdClase);
        $('#NmProducto').val(data.NmProducto);
        $('#Descripcion').val(data.Descripcion);
        $('#CodigoBarras').val(data.CodigoBarras);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../public/img/" + data.ImagenProducto);
        $("#imagenactual").val(data.ImagenProducto);
        // $('#ImagenProducto').val(data.ImagenProducto);
        $('#IdMarca').val(data.IdMarca);
        $('#IdLinea').val(data.IdLinea);
        $('#IdUnidadMedida').val(data.IdUnidadMedida);
        $('#IdLocalizacion').val(data.IdLocalizacion);
        // $('#NuExistenciaFisica').val(data.NuExistenciaFisica);
        // $('#NuExistenciaEnTransito').val(data.NuExistenciaEnTransito);
        $('#NuStockMin').val(data.NuStockMin);
        $('#NuStockMax').val(data.NuStockMax);
        // $('#VlCostoPromedio').val(data.VlCostoPromedio);
        // $('#PrecioVentaEf').val(data.PrecioVentaEf);
        // $('#PrecioVentaCr').val(data.PrecioVentaCr);
        // $('#IdEstadoProducto').val(data.IdEstadoProducto);
        generarbarcode();
        $("#barcode").css("display", "inline");
    })
}

function eliminar(IdProducto) {
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
            $.post("../controlador/producto.php?op=eliminar", { IdProducto: IdProducto }, function(e) {
                swal('!!! Eliminado !!!', e, 'success');
                tabla.ajax.reload();
            });
        } else {
            swal("! Cancelado ¡", "Se Cancelo la Eliminacion", "error");
        }
    });
}
init();