 var tabla;

 function init() {
     //     mostrarform(false);
     //     listar();
     $.post("../controlador/compra.php?op=selectTercero", function(r) {
         $("#IdTercero").html(r);
     });
     //     $.post("../controlador/tercero.php?op=selectCiudad", function(r) {
     //         $("#IdCiudad").html(r);
     //     });
     //     $.post("../controlador/tercero.php?op=selectGenero", function(r) {
     //         $("#IdGenero").html(r);
     //     });
 }

 // function limpiar() {
 //     $("#IdTercero").val("");
 //     $("#DigVerificacion").val("");
 //     $("#NmRazonSocial").val("");
 //     $("#Direccion").val("");
 //     $('#TelefonoFijo').val("");
 //     $("#TelefonoMovil").val("");
 //     $('#CorreoElectronico').val("");
 //     $("#IdTipoDocumento").val("");
 //     $("#IdCiudad").val("");
 //     $("#IdGenero").val("");
 //     $("#FlActivo").val("");
 //     $(".infoguar").css("display", "none");
 //     $("br").css("display", "none");
 //     $("#IdTercero").css("background-color", "rgb(255, 255, 255)");
 //     $(".infoT").css("display", "none");
 //     $(".espacio").css("display", "none");
 //     $("#DigVerificacion").css("background-color", "rgb(255, 255, 255)");
 // }

 $(document).ready(function() {

     //GUARDAR DETALLE
     $("#btnGuardarc").click(function(e) {

         //VALIDAR QUE LOS CAMPOS NO ESTEN VACÍOS
         if (
             $.trim($("#FcTransaccion").val()).length == 0 ||
             $.trim($("#IdTercero").val()).length == 0 ||
             $.trim($("#NuDocumento").val()).length == 0 ||
             $.trim($("#FcDocumento").val()).length == 0
         ) {
             console.log('campos vacíos');
         } else {
             guardar(e);
         }

         //LEER ULTIMO ID CAB
         $.ajax({
             url: '../controlador/compra.php?op=idlast',
             type: 'get',
             dataType: 'JSON',
             success: function(response) {

                 //  if ($.trim($("#IdTransaccion").val()).length === 0) {
                 //      $('#IdTransaccion').val(response);
                 //  } else {
                 //      $('#IdTransaccion').val("");
                 //      $('#IdTransaccion').val(response);
                 //  }

                 if (response != undefined || response != null) {
                     $('#IdTransaccionCab').val(response);
                 }
             }
         });
         //  campos();
     });

     // MOSTRAR INPUTS Y GUARDAR O VOLVER
     $('#agregar').click(function() {
         $(this).css("display", "none");
         $('#IdProducto').css("display", "inline");
         $('#NmProducto').css("display", "inline");
         $('#NuCantidad').css("display", "inline");
         $('#VlUnitario').css("display", "inline");
         $('#guardar').css("display", "inline");
         $('#volver').css("display", "inline");
     });

     // MOSTRAR AGREGAR, ESCONDER INPUTS 
     $('#volver').click(function() {
         $(this).css("display", "none");
         $('#agregar').css("display", "inline");
         $('#IdProducto').val("");
         $('#IdProducto').css("display", "none");
         $('#NmProducto').val("");
         $('#NmProducto').css("display", "none");
         $('#NuCantidad').val("");
         $('#NuCantidad').css("display", "none");
         $('#VlUnitario').val("");
         $('#VlUnitario').css("display", "none");

         $('#guardar').css("display", "none");
         $('#volver').css("display", "none");
     });

     //  AGREGAR FILAS A DETALLE
     $('#guardar').click(function() {
         var IdProducto = $('#IdProducto').val();
         var NmProducto = $('#NmProducto').val();
         var NuCantidad = $('#NuCantidad').val();
         var VlUnitario = $('#VlUnitario').val();
         //  CALCULAR TOTAL
         var Total = NuCantidad * VlUnitario;

         var compradet = '<tr><td style="width: 20px;">' + IdProducto +
             '</td><td style="width: 20px;">' + NmProducto +
             '</td><td style="width: 20px;">' + NuCantidad +
             '</td><td style="width: 20px;">' + VlUnitario +
             '</td><td style= "width: 15px;">' + Total +
             '</td><td style= "width: 5px;"><button data-toggle="tooltip" data-placement="bottom" title="Eliminar" style="border: none;" class="deletedet btn btn-default btn-xs" type="button"><i class="fas fa-times"></i></button></td></tr>'
         $("#tbcompra tbody").append(compradet);

         //  CALCULAR SUBTOTAL
         var sum = 0;
         $('#tbcompra tbody tr').each(function() {
             sum += parseFloat($(this).find('td').eq(4).text());
         });
         $("#VlSubtotal").val(sum);

         // DESPUES DE AGREGAR FILA, LIMPIAR INPUTS 
         $('#IdProducto').val("");
         $('#NmProducto').val("");
         $('#NuCantidad').val("");
         $('#VlUnitario').val("");
     });

     //ELIMINAR ITEMS DE DETALLE
     $('body').on('click', 'button.deletedet', function() {
         $(this).parents('tr').remove();
     });

     $("#btGuardar").click(function(e) {
         //RECORRER TABLA
         var filas = [];
         var IdTransaccionCab = $('#IdTransaccionCab').val();
         $('#tbcompra tbody tr').each(function() {
             var IdProducto = $(this).find('td').eq(0).text();
             var NmProducto = $(this).find('td').eq(1).text();
             var NuCantidad = $(this).find('td').eq(2).text();
             var VlUnitario = $(this).find('td').eq(3).text();
             var Total = $(this).find('td').eq(4).text();

             var fila = {
                 IdTransaccionCab,
                 IdProducto,
                 NmProducto,
                 NuCantidad,
                 VlUnitario,
                 Total
             };
             filas.push(fila);
         });
         console.log(filas);
         //  alert(JSON.stringify(filas));

         //GUARDAR ARRAY EN TABLA DETALLE
         $.ajax({
             type: "POST",
             url: '../controlador/compra.php?op=guardardet',
             data: { valores: JSON.stringify(filas) }, // stringify CONVERTIR OBJ EN STRING
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

 });

 //GUADAR CAB
 function guardar(e) {
     e.preventDefault(); //No se activará la acción predeterminada del evento
     $("#btnGuardar").prop("disabled", true);
     var formData = new FormData($("#formulario")[0]); //
     $.ajax({
         url: "../controlador/compra.php?op=guardar",
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

         }
     });
     //  limpiar();
 }

 init();
 init();