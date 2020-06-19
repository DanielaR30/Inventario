var tabla;

function init() {
    $("#pedidocab").hide();
    $("#card").hide();
    $("#carrito").hide();
    //   mostrarform(false);
    //   listar();

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


//AGREGAR ITEMS AL CARRITO
function mostrarcar(IdProducto) {
    $.post("../../controlador/producto.php?op=mostrarcar", { IdProducto: IdProducto }, function(data, _status) {
            data = JSON.parse(data);
            console.log(data);

            var IdProducto = data[0].IdProducto;
            var ImagenProducto = data[0].ImagenProducto;
            var NmProducto = data[0].NmProducto;

            var car = '<tr><td style="display:none;">' + IdProducto +
                '</td><td style="width: 30px;"><img  class="img-fluid" src="../../public/img/' + ImagenProducto +
                '" alt=""></td><td style="width: 30px;"><h6> ' + NmProducto +
                '</h6></td><td style="width: 30px;"><input style="width: 20%;" type="number" value="1" class="form-control cantidad"></td><td style="width: 10px;"> <button onclick="eliminaritem(' + IdProducto +
                ')" data-toggle="tooltip" data-placement="bottom" title="Eliminar" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="fas fa-times"></i></button></td></tr>'

            $("#tb tbody").append(car);
        })
        // $("#addcarrito").ccs("display", "none");
}

//ELIMINAR ITEMS DEL CARRITO
function eliminaritem(IdProducto) {

    var filas = [];
    $('#tb tbody tr').each(function() {
        var Producto = $(this).find('td').eq(0).text();
        var ImagenProducto = $(this).find('td').eq(1).text();
        var NmProducto = $(this).find('td').eq(2).text();
        var cantidad = $(this).find('td').eq(3).text();

        var fila = {
            Producto,
            ImagenProducto,
            NmProducto,
            cantidad
        };
        filas.push(fila);

        var car = '<tr><td style="display:none;">' + Producto +
            '</td><td style="width: 30px;"><img  class="img-fluid" src="../../public/img/' + ImagenProducto +
            '" alt=""></td><td style="width: 30px;"><h6> ' + NmProducto +
            '</h6></td><td style="width: 30px;"><input style="width: 20%;" type="number" value="1" class="form-control cantidad"></td><td style="width: 10px;"> <button id="' + ida + '" onclick="eliminaritem(' + IdProducto +
            ')" data-toggle="tooltip" data-placement="bottom" title="Eliminar" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="fas fa-times"></i></button></td></tr>'

        if (Producto == IdProducto) {
            $("#tb tbody").remove(car); //LIMPIAR CARD
        }
        // var ImagenProducto = $(this).find('td').eq(1).text();
        // var NmProducto = $(this).find('td').eq(2).text();
        // var cantidad = $(".cantidad").val();
    });
    console.log(filas);


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
// }

$(document).ready(function() {

    //TOMAR HR FECHA ACTUAL
    $("#btnnvo").click(function(e) {
        $("#pedidocab").show();
        var f = new Date();
        var factual = f.toLocaleDateString();
        console.log('factual');
        $("#FcOrdenPedido").val(factual);
        $("#btnnvo").hide();
    });

    //MOSTRAR CARRITO ICON
    $("#vercarrito").click(function(e) {
        $("#carrito").show();
        $("#header").hide();
        $("#footer").hide();
        $("#main").hide();
    });

    //MOSTRAR CARRITO ALERT
    $("#vercarrit").click(function(e) {
        $("#carrito").show();
        $("#header").hide();
        $("#footer").hide();
        $("#main").hide();
    });

    //OCULTAR CARRITO
    $("#hidecarrito").click(function(e) {
        $("#carrito").hide();
        $("#header").show();
        $("#footer").show();
        $("#main").show();
    });

    $("#ingresar").click(function(e) {
        //RECORRER TABLA CARRITO
        var filas = [];
        $('#tb tbody tr').each(function() {
            var imagen = $(this).find('td').eq(0).text();
            var nombre = $(this).find('td').eq(1).text();
            var cantidad = $(".cantidad").val();

            var fila = {
                imagen,
                nombre,
                cantidad
            };
            filas.push(fila);
        });
        console.log(filas);
        alert(JSON.stringify(filas));
    });

    //GUARDAR CAB
    $("#btnGuardar").click(function(e) {
        // guardar(e);
        $('#pedidocab').css("display", "none");
        $('#hed').css("display", "inline");
        $('#card').show();
    });


    // FILTRAR PRODUCTOS 
    $('#IdClase').change(function() {
        var IdClase = $(this).val();
        var dataString = 'IdClase=' + IdClase;

        $.ajax({
            type: "POST",
            url: "../../controlador/producto.php?op=filtropro",
            data: dataString,
            success: function(data) {

                $(".portfolio-item").remove(card); //LIMPIAR CARD

                console.log(data);
                if (data.trim() !== "\r\nnull" || data.trim() !== undefined || data.trim() !== null || data.trim() !== "null") {
                    data = JSON.parse(data);

                    console.log(data);
                    console.log(data[0]);

                    var len = data.length;
                    console.log(len);

                    //CREAR CARD POR PRODUCTO
                    for (var i = 0; i < len; i++) {

                        var IdProducto = data[i].IdProducto;
                        var ImagenProducto = data[i].ImagenProducto;
                        var NmProducto = data[i].NmProducto;
                        var ida = "addcarrito" + i;
                        var idd = "deltcarrito" + i;
                        console.log(idd);

                        var card = '<div class="col-lg-2 col-md-6 portfolio-item" ><img class="img-fluid" src="../../public/img/' +
                            ImagenProducto + '" alt="">' + '<div class="portfolio-info"> <p>' +
                            NmProducto + '</p><p><button id="' + ida + '" onclick="mostrarcar(' + IdProducto +
                            ')" data-toggle="tooltip" data-placement="bottom" title="agregar al carrito" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="fas fa-cart-plus"></i></button> <button id="' + idd + '" onclick="delete(' + IdProducto +
                            ')" data-toggle="tooltip" data-placement="bottom" title="Eliminar del carrito" style="border: none; display:none;" class="btn btn-outline-light btn-sm" type="button"><i class="far fa-trash-alt"></i></button></p></div>'

                        $("#card").append(card);

                        // $('#' + ida).click(function(e) {
                        //     $(this).css("display", "none");
                        //     $("#" + idd).css("display", "inline");

                        // });
                        // $('#' + idd).click(function(e) {
                        //     $(this).css("display", "none");
                        //     $('#' + ida).css("display", "inline");
                        // });

                    }


                }
            },
            error: function() {
                console.log('existió un problema');
            }
        });
    });


    //MOSTRAR TODOS LOS PRODUCTOS
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
                var ida = "addcarrito" + i;
                var idd = "deltcarrito" + i;

                console.log(idd);

                // var card = '<div class="col-lg-2 col-md-6 portfolio-item"><img  class="img-fluid" src="../../public/img/' +
                //     ImagenProducto + ' " alt="">' + '<div class="portfolio-info">  <p> ' +
                //     NmProducto + '</p><p>  <form action="" method="post"><input type="text" name="IdProducto" id="IdProducto" value="' +
                //     IdProducto + '"> <input type="text" name="NmProducto" id="NmProducto" value="' +
                //     NmProducto + '"><input type="text" name="NuCantidad" id="NuCantidad" value="' +
                //     1 + '"><button id="addcarrito" data-toggle="tooltip" data-placement="bottom" title="agregar al carrito" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="fas fa-cart-plus"></i></button> <button id="delcarrito" data-toggle="tooltip" data-placement="bottom" title="Eliminar del carrito" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="far fa-trash-alt"></i></button></form></p></div>'

                var card = '<div class="col-lg-2 col-md-6 portfolio-item"><img  class="img-fluid" src="../../public/img/' +
                    ImagenProducto + '" alt="">' + '<div class="portfolio-info"> <p>' +
                    NmProducto + '</p><p><button id="' + ida + '" onclick="mostrarcar(' + IdProducto +
                    ')" data-toggle="tooltip" data-placement="bottom" title="agregar al carrito" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="fas fa-cart-plus"></i></button> <button id="' + idd + '" onclick="delete(' + IdProducto +
                    ')" data-toggle="tooltip" data-placement="bottom" title="Eliminar del carrito" style="border: none; display:none;" class="btn btn-outline-light btn-sm" type="button"><i class="far fa-trash-alt"></i></button></p></div>'

                $("#card").append(card);

                $('#' + ida).click(function(e) {
                    $(this).css("display", "none");
                    $("#" + idd).css("display", "inline");

                });

                $('#' + idd).click(function(e) {
                    $(this).css("display", "none");
                    $('#' + ida).css("display", "inline");
                });

            }
        }
    });

});

//GUARDAR CAB PEDIDO
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