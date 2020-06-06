var tabla;

function init() {

    //     mostrarform(false);
    //     listar();
    //     card();

    $.post("../../controlador/pedidocab.php?op=selectTercero", function(r) {
        $("#IdTercero").html(r);
    });


    //     $.post("../controlador/producto.php?op=selectClase", function(r) {
    //         $("#fclase").html(r);
    //     });

    //     $("#imagenmuestra").hide();
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

                var card = '<div class="col-lg-2 col-md-6 portfolio-item"><img  class="img-fluid" src="../../public/img/' +
                    ImagenProducto + ' " alt="">' + '<div class="portfolio-info">  <p> ' +
                    NmProducto + '</p><p>  <form action="" method="post"><input type="text" name="IdProducto" id="IdProducto" value="' +
                    IdProducto + '"> <input type="text" name="NmProducto" id="NmProducto" value="' +
                    NmProducto + '"><input type="text" name="NuCantidad" id="NuCantidad" value="' +
                    1 + '"><button id="addcarrito" data-toggle="tooltip" data-placement="bottom" title="agregar al carrito" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="fas fa-cart-plus"></i></button> <button id="delcarrito" data-toggle="tooltip" data-placement="bottom" title="Eliminar del carrito" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="far fa-trash-alt"></i></button></form></p></div>'

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
        url: "../controlador/movimientocab.php?op=guardar",
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
            //  mostrarform(false);
            //  tabla.ajax.reload();
        }
    });
    //  limpiar();
}



init();