var tabla;

function init() {
    // $("#card").hide();
    $("#carrito").hide();
    //   mostrarform(false);
    //   listar();

    $.post("../../controlador/pedido.php?op=selectTercero", function(r) {
        $("#IdTercero").html(r);
    });

    $.post("../../controlador/producto.php?op=selectClasepro", function(r) {
        $("#IdClase").html(r);
    });

    $(document).ready(function() {

        $("#IdClase").change(function() {
            $("#IdClase option:selected").each(function() {
                IdClase = $(this).val();
                $.post("../../controlador/producto.php?op=selectprono", { IdClase: IdClase }, function(data) {
                    $("#NmProducto").html(data);
                });
            });
        });

    });

    // $.post("../../controlador/producto.php?op=selectnmpro", function(r) {
    //     $("#NmProducto").html(r);
    // });
    //     $.post("../controlador/producto.php?op=selectClase", function(r) {
    //         $("#fclase").html(r);
    //     });
    //     $("#imagenmuestra").hide();
}


//GUARDAR CAB PEDIDO
function guardar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]); //
    $.ajax({
        url: '../../controlador/pedido.php?op=guardar',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            console.log(datos);
            //  mostrarform(false);
            //  tabla.ajax.reload();
        }
    });
    //  limpiar();
}


//AGREGAR ITEMS AL CARRITO
function mostrarcar(IdProducto) {

    $("#alertcarr").css("display", "inline");
    $.post("../../controlador/producto.php?op=mostrarcar", { IdProducto: IdProducto }, function(data, _status) {
        data = JSON.parse(data);
        console.log(data);

        var Id = data[0].IdProducto;
        var ImagenProducto = data[0].ImagenProducto;
        var NmProducto = data[0].NmProducto;
        console.log(IdProducto);
        console.log(Id);

        var car = '<tr><td style="display:none;">' + Id +
            '</td><td style="width:10%;"><img  class="img-fluid" src="../../public/img/' + ImagenProducto +
            '" alt=""></td><td style="width: 25%;"><h8> ' + NmProducto +
            '</h8></td><td style="width:20%;"><input style="width:80%;" type="number" value="1" class="form-control"></td>' +
            '<td style="width:45%;">' +
            '<button data-toggle="tooltip" data-placement="bottom" title="Eliminar" ' +
            'style="border: none;" class="deletepro btn btn-outline-dark btn-sm" type="button"><i class="fas fa-times"></i></button></td></tr>';

        $("#tbpedido tbody").append(car);

        //VALIDAR QUE NO SE REPITA ID PRODUCTO
        // $('#tbpedido tbody tr').each(function() {
        //     var Idp = $(this).find('td').eq(0).text();
        //     var NuCantidad = parseFloat($(this).find('input').val());
        //     console.log(Idp);

        //     if (Idp.includes(IdProducto) === true) {
        //         console.log("Si se encuentra");
        //         NuCantidad += NuCantidad;
        //         $(this).find('input').val(NuCantidad);
        //     } else {
        //         var car = '<tr><td style="display:none;">' + Id +
        //             '</td><td style="width:10%;"><img  class="img-fluid" src="../../public/img/' + ImagenProducto +
        //             '" alt=""></td><td style="width: 25%;"><h8> ' + NmProducto +
        //             '</h8></td><td style="width:20%;"><input style="width:80%;" type="number" value="1" class="form-control"></td>' +
        //             '<td style="width:45%;">' +
        //             '<button data-toggle="tooltip" data-placement="bottom" title="Eliminar" style="border: none;" class="deletepro btn btn-outline-dark btn-sm" type="button"><i class="fas fa-times"></i></button></td></tr>'

        //         $("#tbpedido tbody").append(car);
        //     }
        // });
    })
}

$(document).ready(function() {
    // $('[data-toggle="datepicker"]').datepicker();

    //aplicar pluggin  
    $('#IdTercero').select2({
        placeholder: 'Seleccionar tercero',
        theme: 'bootstrap4',
    });

    $('#IdClase').select2({
        placeholder: 'Seleccionar clase de producto',
        theme: 'bootstrap4',
    });

    $('#NmProducto').select2({
        placeholder: 'Buscar producto',
        theme: 'bootstrap4',
    });

    //TOMAR HR FECHA ACTUAL
    // $("#btnnvo").click(function(e) {
    //     var f = new Date();
    //     var factual = f.toLocaleDateString();
    //     console.log('factual');
    //     $("#FcOrdenPedido").val(factual);
    // });

    //GUARDAR CAB
    $("#btnGuardar").click(function(e) {
        camposcab();
        if (
            $.trim($("#FcOrdenPedido").val()).length == 0 ||
            $.trim($("#IdTercero").val()).length == 0
        ) {
            console.log('campos vacíos');
        } else {
            guardar(e);
            $('#btnGuardar').hide();
            $('#cls').css("display", "inline");
            $('#nmprod').css("display", "inline");
            $('#card').show();
        }

        //LEER ULTIMO ID CAB
        $.ajax({
            url: '../../controlador/pedido.php?op=idlast',
            type: 'get',
            dataType: 'JSON',
            success: function(response) {

                if (response != undefined || response != null) {
                    $('#IdOrdenPedidoCab').val(response);
                }
            }
        });
    });

    //FILTRAR PRODUCTOS POR CLASE
    $('#IdClase').change(function() {
        var IdClase = $(this).val();
        var dataString = 'IdClase=' + IdClase;

        $.ajax({
            type: "POST",
            url: "../../controlador/producto.php?op=filtropro",
            data: dataString,
            success: function(data) {

                $(".portfolio-item").remove(card); //LIMPIAR CARD
                // $("#NmProducto").empty(opt); //LIMPIAR SELECT


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
                        var addcar = "addcar" + i;
                        var delcar = "delcar" + i;

                        // var opt = '<option value="">' + NmProducto + '</option>';
                        // $("#NmProducto").find(opt);

                        var card = '<div class="col-lg-2 col-md-6 portfolio-item" >' +
                            '<img class="img-fluid" src="../../public/img/' + ImagenProducto + '" alt="">' +
                            '<div class="portfolio-info"> ' +
                            '<p>' + NmProducto + '</p><p><button onclick="mostrarcar(' + IdProducto + ')"' +
                            ' data-toggle="tooltip" data-placement="bottom"' +
                            'title="agregar al carrito" style="border:none;" id="' + addcar + '" class="a btn btn-outline-light btn-sm" ' +
                            'type="button"> <i class="fas fa-cart-plus"></i></button>' +
                            '<button onclick="delet(' + IdProducto + ')"' +
                            'data-toggle="tooltip" data-placement="bottom" title="Eliminar del carrito" style="border:none; display:none;"' +
                            ' id="' + delcar + '" class="d btn btn-outline-light btn-sm" type="button"><i class="far fa-trash-alt"></i></button>' +
                            '</p></div>';

                        $("#card").append(card);
                        //AGREGAR PRODUCTO ++
                        // $('body').on('click', 'button.a', function() {
                        // // $(this).prop('disabled', true);
                        // });
                    }
                }
            },
            error: function() {
                console.log('existió un problema');
            }
        });
    });


    //FILTRAR PRODUCTOS POR NOMBRE
    $('#NmProducto').change(function() {
        var NmProducto = $(this).val();
        var dataString = 'IdClase=' + NmProducto;

        $.ajax({
            type: "POST",
            url: "../../controlador/producto.php?op=filtronmpro",
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
                        var addcar = "addcar" + i;
                        var delcar = "delcar" + i;

                        var opt = '<option>' + NmProducto + '</option>';
                        $("#NmProducto").append(opt);

                        var card = '<div class="col-lg-2 col-md-6 portfolio-item" >' +
                            '<img class="img-fluid" src="../../public/img/' + ImagenProducto + '" alt="">' +
                            '<div class="portfolio-info"> ' +
                            '<p>' + NmProducto + '</p><p><button onclick="mostrarcar(' + IdProducto + ')"' +
                            ' data-toggle="tooltip" data-placement="bottom"' +
                            'title="agregar al carrito" style="border:none;" id="' + addcar + '" class="a btn btn-outline-light btn-sm" ' +
                            'type="button"> <i class="fas fa-cart-plus"></i></button>' +
                            '<button onclick="delet(' + IdProducto + ')"' +
                            'data-toggle="tooltip" data-placement="bottom" title="Eliminar del carrito" style="border:none; display:none;"' +
                            ' id="' + delcar + '" class="d btn btn-outline-light btn-sm" type="button"><i class="far fa-trash-alt"></i></button>' +
                            '</p></div>';

                        $("#card").append(card);
                        //AGREGAR PRODUCTO ++
                        // $('body').on('click', 'button.a', function() {
                        // // $(this).prop('disabled', true);
                        // });
                    }
                }
            },
            error: function() {
                console.log('existió un problema');
            }
        });
    });



    //ELIMINAR ITEMS DEL CARRITO
    $('body').on('click', 'button.deletepro', function() {
        $(this).parents('tr').remove();
        // $('button.a').prop('disabled', false);
    });

    //MOSTRAR CARRITO ICON
    $("#vercarrito").click(function(e) {
        $("#carrito").show();
        $("#header").hide();
        $("#footer").hide();
        $("#main").hide();
        $('#hero').remove();
    });

    //MOSTRAR CARRITO ALERT
    $("#vercarrit").click(function(e) {
        $("#carrito").show();
        $("#header").hide();
        $("#footer").hide();
        $("#main").hide();
        $('#hero').remove();
    });

    //OCULTAR CARRITO
    $("#hidecarrito").click(function(e) {
        $("#carrito").hide();
        $("#header").show();
        $("#footer").show();
        $("#main").show();
        var hero = '<section id="hero" class="d-flex flex-column justify-content-center">' +
            '<div class="container"><div class="row justify-content-center">' +
            '<div class="col-xl-8"><h1>Inventario</h1><h2>Coeducadores Boyacá</h2></div></div></div></section>';
        $('#header').after(hero);
        // $('#hero').addClass("visibility", "visible");
    });

    //GUARDAR DETALLE
    $("#btnpedido").click(function(e) {
        //RECORRER TABLA
        var filas = [];
        var IdOrdenPedidoCab = $('#IdOrdenPedidoCab').val();
        $('#tbpedido tbody tr').each(function() {
            var IdProducto = $(this).find('td').eq(0).text();
            var NuCantidad = $(this).find('input').val();

            var fila = {
                IdOrdenPedidoCab,
                IdProducto,
                NuCantidad,
            };
            filas.push(fila);
        });
        console.log(filas);
        //  alert(JSON.stringify(filas));

        //GUARDAR ARRAY EN TABLA DETALLE
        $.ajax({
            type: "POST",
            url: '../../controlador/pedido.php?op=guardardet',
            data: { valores: JSON.stringify(filas) }, //stringify CONVERTIR OBJ EN STRING
            success: function(data) {
                console.log(data);
                swal({
                    title: 'Success',
                    type: 'success',
                    text: data
                });
            }
        });
    });


    //MOSTRAR TODOS LOS PRODUCTOS
    // $.ajax({
    //     url: '../../controlador/producto.php?op=card',
    //     type: 'get',
    //     dataType: 'JSON',
    //     success: function(response) {
    //         console.log(response);
    //         var len = response.length;

    //         for (var i = 0; i < len; i++) {
    //             var IdProducto = response[i].IdProducto;
    //             var ImagenProducto = response[i].ImagenProducto;
    //             var NmProducto = response[i].NmProducto;
    //             var ida = "addcarrito" + i;
    //             var idd = "deltcarrito" + i;

    //             console.log(idd);

    //             var card = '<div class="col-lg-2 col-md-6 portfolio-item"><img  class="img-fluid" src="../../public/img/' +
    //                 ImagenProducto + '" alt="">' + '<div class="portfolio-info"> <p>' +
    //                 NmProducto + '</p><p><button id="' + ida + '" onclick="mostrarcar(' + IdProducto +
    //                 ')" data-toggle="tooltip" data-placement="bottom" title="agregar al carrito" style="border: none;" class="btn btn-outline-light btn-sm" type="button"><i class="fas fa-cart-plus"></i></button> <button id="' + idd + '" onclick="delete(' + IdProducto +
    //                 ')" data-toggle="tooltip" data-placement="bottom" title="Eliminar del carrito" style="border: none; display:none;" class="btn btn-outline-light btn-sm" type="button"><i class="far fa-trash-alt"></i></button></p></div>'

    //             $("#card").append(card);

    //             $('#' + ida).click(function(e) {
    //                 $(this).css("display", "none");
    //                 $("#" + idd).css("display", "inline");
    //             });

    //             $('#' + idd).click(function(e) {
    //                 $(this).css("display", "none");
    //                 $('#' + ida).css("display", "inline");
    //             });

    //         }
    //     }
    // });

});

function camposcab() {

    if ($.trim($("#FcOrdenPedido").val()).length == 0) {
        console.log('campo IdTercero vacío');
        $("#FcOrdenPedido").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infofc").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#FcOrdenPedido").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infofc").css("display", "none");
    }

    if ($.trim($("#IdTercero").val()).length == 0) {
        console.log('campo DigVerificacion vacío');
        $("#IdTercero").css("background-color", "rgba(179, 27, 27, 0.096)");
        $(".infotr").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
    } else {
        $("#IdTercero").css("background-color", "rgba(255, 255, 255, 0.911)");
        $(".infotr").css("display", "none");
    }
}

init();