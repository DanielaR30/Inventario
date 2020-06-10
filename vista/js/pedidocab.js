var tabla;


function init() {
    $("#pedidocab").hide();
    $("#card").hide();
    $("#carrito").hide();

    //     mostrarform(false);
    //     listar();

    $.post("../../controlador/pedidocab.php?op=selectTercero", function(r) {
        $("#IdTercero").html(r);
    });

    $.post("../../controlador/producto.php?op=selectClasepro", function(r) {
        $("#IdClase").html(r);
    });

    //     $.post("../controlador/producto.php?op=selectClase", function(r) {
    //         $("#fclase").html(r);
    //     });
    //     $("#imagenmuestra").hide();
}


function mostrarcar(IdProducto) {
    $.post("../../controlador/producto.php?op=mostrarcar", { IdProducto: IdProducto }, function(data, _status) {
        data = JSON.parse(data);
        console.log(data);

        var ImagenProducto = data[0].ImagenProducto;
        var NmProducto = data[0].NmProducto;
        var car = '<tr> <td width="15%"> <img  class="img-fluid" src="../../public/img/' + ImagenProducto + '" alt=""></td><td><h6> ' + NmProducto +
            '</h6></td> <td><input style="width: 30%;" type="number" value="1" class="form-control" name="NuCantidad" id="NuCantidad"></td><td style="width:15px;"><i class="fas fa-times"></i></td></tr>'
        $("#tb tbody").append(car);

    })
}

// function limpiar() {
//     $("#IdProducto").val("");
//     $("#IdClase").val("");
//     $("#NmProducto").val("");
//     $("#Descripcion").val("");
//     $('#CodigoBarras').val("");
//     $('#ImagenProducto').val("");
//     $("#imagenmuestra").hide();

//     $("#imagenpre").empty();
//     $("#imagenmuestra").attr("src", "");
//     $("#imagenactual").val("");
//     $("#print").hide();
//     $("#IdMarca").val("");
//     $('#IdLinea').val("");
//     $('#IdUnidadMedida').val("");
//     $("#IdLocalizacion").val("");
//     // $("#NuExistenciaFisica").val("");
//     // $("#NuExistenciaEnTransito").val("");
//     $("#NuStockMin").val("");
//     $("#NuStockMax").val("");
//     // $("#VlCostoPromedio").val("");
// }


$(document).ready(function() {

    $("#btnnvo").click(function(e) {
        $("#pedidocab").show();
        var f = new Date();
        var factual = f.toLocaleDateString();
        console.log('factual');
        $("#FcOrdenPedido").val(factual);
        $("#btnnvo").hide();

    });


    $("#vercarrito").click(function(e) {
        $("#carrito").show();
        $("#header").hide();
        $("#footer").hide();
        $("#main").hide();

    });

    $("#vercarrit").click(function(e) {
        $("#carrito").show();
        $("#header").hide();
        $("#footer").hide();
        $("#main").hide();

    });

    $("#hidecarrito").click(function(e) {
        $("#carrito").hide();
        $("#header").show();
        $("#footer").show();
        $("#main").show();

    });


    $("#btnGuardar").click(function(e) {
        // guardar(e);
        $('#pedidocab').css("display", "none");
        $('#hed').css("display", "inline");
        $('#card').show();

        // $.ajax({
        //     url: '../controlador/movimientocab.php?op=idlast',
        //     type: 'get',
        //     dataType: 'JSON',
        //     success: function(response) {
        //         //  if ($.trim($("#IdTransaccion").val()).length === 0) {
        //         //      $('#IdTransaccion').val(response);
        //         //  } else {
        //         //      $('#IdTransaccion').val("");
        //         //      $('#IdTransaccion').val(response);
        //         //  }
        //         if (response != undefined || response != null) {
        //             $('#IdTransaccion').val(response);
        //         }
        //     }
        // });

        //  campos();
    });


    $.ajax({
        url: '../../controlador/producto.php?op=card',
        type: 'get',
        dataType: 'JSON',
        success: function(response) {

            console.log('...');
            console.log(response);
            console.log('...');

            var len = response.length;
            console.log(len);

            for (var i = 0; i < len; i++) {
                var IdProducto = response[i].IdProducto;
                var ImagenProducto = response[i].ImagenProducto;
                var NmProducto = response[i].NmProducto;

                // var card = '<div class="col-lg-2 col-md-6 portfolio-item"><img  class="img-fluid" src="../../public/img/' +
                //     ImagenProducto + ' " alt="">' + '<div class="portfolio-info">  <p> ' +
                //     NmProducto + '</p><p>  <form action="" method="post"><input type="text" name="IdProducto" id="IdProducto" value="' +
                //     IdProducto + '"> <input type="text" name="NmProducto" id="NmProducto" value="' +
                //     NmProducto + '"><input type="text" name="NuCantidad" id="NuCantidad" value="' +
                //     1 + '"><button id="addcarrito" data-toggle="tooltip" data-placement="bottom" title="agregar al carrito" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="fas fa-cart-plus"></i></button> <button id="delcarrito" data-toggle="tooltip" data-placement="bottom" title="Eliminar del carrito" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="far fa-trash-alt"></i></button></form></p></div>'

                var card = '<div class="col-lg-2 col-md-6 portfolio-item"><img  class="img-fluid" src="../../public/img/' +
                    ImagenProducto + '" alt="">' + '<div class="portfolio-info"> <p>' +
                    NmProducto + '</p><p><button id="addcarrito" onclick="mostrarcar(' + IdProducto +
                    ')" data-toggle="tooltip" data-placement="bottom" title="agregar al carrito" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="fas fa-cart-plus"></i></button><button id="delcarrito" onclick="delete(' + IdProducto +
                    ')" data-toggle="tooltip" data-placement="bottom" title="Eliminar del carrito" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="far fa-trash-alt"></i></button></p></div>'

                $("#card").append(card);
            }
        }
    });
});

function guardar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]); //
    $.ajax({
        url: '../../controlador/pedidocab.php?op=guardar',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            console.log(datos);
            // swal({
            //     title: 'Success',
            //     type: 'success',
            //     text: datos
            // });
            //  mostrarform(false);
            //  tabla.ajax.reload();
        }
    });
    //  limpiar();
}

init();