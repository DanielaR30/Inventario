 var tabla;

 function init() {
     //     mostrarform(false);
     //     listar();
     $.post("../controlador/compra.php?op=selectTercero", function(r) {
         $("#IdTercero").html(r);
     });
     $.post("../controlador/compra.php?op=selectNmProducto", function(r) {
         $("#NmProducto").html(r);
     });
     //     $.post("../controlador/tercero.php?op=selectGenero", function(r) {
     //         $("#IdGenero").html(r);
     //     });
 }

 function limpiar() {
     $("#FcTransaccion").val("");
     $("#FcTransaccion").css("background-color", "rgb(255, 255, 255)");
     $(".infot").css("display", "none");
     $("#IdTercero").val("");
     $("#IdTercero").css("background-color", "rgb(255, 255, 255)");
     $(".infopro").css("display", "none");
     $("#NuDocumento").val("");
     $("#NuDocumento").css("background-color", "rgb(255, 255, 255)");
     $(".infoDoc").css("display", "none");
     $("#FcDocumento").val("");
     $("#FcDocumento").css("background-color", "rgb(255, 255, 255)");
     $(".infofech").css("display", "none");
     $('#Observaciones').val("");
 }

 $(document).ready(function() {

     //  $("#NmProducto").remove();
     $('#IdTercero').select2({
         placeholder: 'Seleccionar proveedor',
         theme: 'bootstrap4',
     });

     $('#NmProducto').select2({
         placeholder: 'Seleccionar producto',
         theme: 'bootstrap4',
     });
     //BUSCAR CODIGO,IVA,EXISTENCIAS SEGUN NOMBRE PRODUCTO
     $('#NmProducto').change(function() {
         // SI NOMBRE PRODUCTO ESTA VACÍO, LIMPIAR INPUTS, INFO
         //  if ($.trim($("#NmProducto").val()).length == 0) {
         //      $('#IdProducto').val("");
         //      $('#VlIVA').val("");
         //      $('#nr').css("visibility", "hidden");
         //      $('#nro').text("");
         //      $('#nro1').text("");
         //  } else {
         var NmProducto = $(this).val();
         //  alert(NmProducto);
         var dataString = ({ NmProducto: NmProducto });
         //  alert(JSON.stringify(dataString));

         $.ajax({
             type: "POST",
             url: "../controlador/compra.php?op=search",
             data: { NmProducto: JSON.stringify(dataString) },
             success: function(data) {
                 data = JSON.parse(data);
                 console.log(data);

                 var IdProducto = data.IdProducto;
                 var PorcentajeIVA = data.PorcentajeIVA;
                 var NuExistenciaFisica = data.NuExistenciaFisica;
                 var NuStockMin = data.NuStockMin;
                 var NuStockMax = data.NuStockMax;
                 var Existencia = "Existencia: " + NuExistenciaFisica;
                 var Existencia1 = "Stock: " + NuStockMin + " - " + NuStockMax;

                 $('#IdProducto').val(IdProducto);
                 $('#VlIVA').val(PorcentajeIVA);
                 $('#nr').css("visibility", "visible");
                 $('#nro').text(Existencia);
                 $('#nro1').text(Existencia1);
                 //  $('#nro1').text(Existencia1);
             },
             error: function() {
                 console.log('existió un problema');
             }
         });
         //  }
     });

     //VALIDAR QUE NO SE REPITA NOMBRE PRODUCTO
     $('#NmProducto').change(function() {

         $("#guardar").prop('disabled', false);
         var NomPro = $(this).val();
         $('#tbcompra tbody tr').each(function() {
             var Nombrep = $(this).find('td').eq(1).text();
             console.log(Nombrep);

             if (Nombrep.includes(NomPro) === true) {
                 console.log("Si se encuentra");
                 $("#guardar").prop('disabled', true);
             }
         });
     });

     //GUARDAR CABECERA
     $("#btnGuardarc").click(function(e) {
         campos();
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

                 if (response != undefined || response != null) {
                     $('#IdTransaccionCab').val(response);
                 }
             }
         });
         //  campos();
     });

     // MOSTRAR INPUTS, BTN GUARDAR y BTN VOLVER
     $('#agregar').click(function() {
         $(this).css("display", "none");
         $('#IdProducto').css("display", "inline");
         $('#nombre').css("visibility", "visible");
         $('#NuCantidad').css("display", "inline");
         $('#VlUnitario').css("display", "inline");
         $('#VlIVA').css("display", "inline");
         $('#guardar').css("display", "inline");
         $('#volver').css("display", "inline");
     });

     // MOSTRAR BTN AGREGAR, ESCONDER INPUTS 
     $('#volver').click(function() {
         $(this).css("display", "none");
         $('#nr').css("visibility", "hidden");
         $('#agregar').css("display", "inline");
         $('#IdProducto').val("");
         $('#IdProducto').css("display", "none");
         $('#NmProducto').val(null).trigger('change');
         $('#nombre').css("visibility", "hidden");
         $('#NuCantidad').val("");
         $('#NuCantidad').css("display", "none");
         $('#VlUnitario').val("");
         $('#VlUnitario').css("display", "none");
         $('#VlIVA').val("");
         $('#VlIVA').css("display", "none");
         $('#guardar').css("display", "none");
         $('#volver').css("display", "none");
     });


     //VALIDAR INPUTS DETALLE, AGREGAR FILAS
     $('#guardar').click(function() {
         camposdet();
         //VALIDAR QUE LOS CAMPOS NO ESTEN VACÍOS
         if (
             $.trim($("#IdProducto").val()).length == 0 ||
             $.trim($("#NmProducto").val()).length == 0 ||
             $.trim($("#NuCantidad").val()).length == 0 ||
             $.trim($("#VlUnitario").val()).length == 0 ||
             $.trim($("#VlIVA").val()).length == 0
         ) {
             console.log('campos vacíos');
         } else {
             agregar();
         }

     });

     //ELIMINAR ITEMS DE DETALLE
     $('body').on('click', 'button.deletedet', function() {
         $(this).parents('tr').remove();

         // CALCULAR SUBTOTAL, IVA; TOTAL
         var Subtotal = 0;
         var Iva = 0;
         var Total = 0;
         $('#tbcompra tbody tr').each(function() {
             NuCantidad = parseFloat($(this).find('td').eq(2).text());
             VlUnitario = parseFloat($(this).find('td').eq(3).text());
             Subtotal += NuCantidad * VlUnitario;
             colIva = parseFloat($(this).find('td').eq(4).text());
             Iva += NuCantidad * colIva;
             Total = Subtotal + Iva;
         });
         $("#VlSubtotal").val(Subtotal);
         $("#Iva").val(Iva);
         $("#Total").val(Total);
     });

     //GUARDAR DETALLES DE LOS PRODUCTOS
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


         //VALIDAR QUE TABLA DETALLE NO ESTÉ VACÍA
         if (filas.length > 0) {

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
             //ACTUALIZAR CANTIDAD DE PRODUCTO
             $.ajax({
                 type: "POST",
                 url: '../controlador/compra.php?op=existencias',
                 data: { valores: JSON.stringify(filas) }, // stringify CONVERTIR OBJ EN STRING
                 success: function(data) {
                     console.log(data);
                     //  swal({
                     //      title: 'Success',
                     //      type: 'success',
                     //      text: data
                     //  });
                 }
             });
             //LIMPIAR TABLA DETALLE
             $(".removeRow").remove();
             $('#volver').css("display", "none");
             $('#nr').css("visibility", "hidden");
             $('#agregar').css("display", "inline");
             $('#IdProducto').val("");
             $("#IdProducto").css("background-color", "rgb(255, 255, 255)");
             $('#IdProducto').css("display", "none");
             $('#NmProducto').val("");
             $("#NmProducto").css("background-color", "rgb(255, 255, 255)");
             $(".infonm").css("display", "none");
             $('#NmProducto').css("display", "none");
             $('#NuCantidad').val("");
             $("#NuCantidad").css("background-color", "rgb(255, 255, 255)");
             $(".infocant").css("display", "none");
             $('#NuCantidad').css("display", "none");
             $('#VlUnitario').val("");
             $("#VlUnitario").css("background-color", "rgb(255, 255, 255)");
             $(".infoval").css("display", "none");
             $('#VlUnitario').css("display", "none");
             $('#VlIVA').val("");
             $("#VlIVA").css("background-color", "rgb(255, 255, 255)");
             $('#VlIVA').css("display", "none");
             $('#guardar').css("display", "none");
             $('#volver').css("display", "none");
             $('#VlSubtotal').val("");
             $('#Iva').val("");
             $('#Total').val("");
             $('#IdTransaccionCab').val(""); //LIMPIAR IDTRANSACCIONCAB
             limpiar();
         } else {
             alert('Tabla detalle vacía');
         }
     });
 });

 function camposdet() {

     if ($.trim($("#IdProducto").val()).length == 0) {
         console.log('campo IdTercero vacío');
         $("#IdProducto").css("background-color", "rgba(179, 27, 27, 0.096)");
     } else {
         $("#IdProducto").css("background-color", "rgba(255, 255, 255, 0.911)");
     }

     if ($.trim($("#NmProducto").val()).length == 0) {
         console.log('campo DigVerificacion vacío');
         $("#NmProducto").css("background-color", "rgba(179, 27, 27, 0.096)");
         $(".infonm").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
     } else {
         $("#NmProducto").css("background-color", "rgba(255, 255, 255, 0.911)");
         $(".infonm").css("display", "none");
     }

     if ($.trim($("#NuCantidad").val()).length == 0) {
         console.log('campo NuDocumento vacío');
         $("#NuCantidad").css("background-color", "rgba(179, 27, 27, 0.096)");
         $(".infocant").css("display", "inline");
     } else {
         $("#NuCantidad").css("background-color", "rgba(255, 255, 255, 0.911)");
         $(".infocant").css("display", "none");
     }

     if ($.trim($("#VlUnitario").val()).length == 0) {
         console.log('campo TelefonoFijo vacío');
         $("#VlUnitario").css("background-color", "rgba(179, 27, 27, 0.096)");
         $(".infoval").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
     } else {
         $("#VlUnitario").css("background-color", "rgba(255, 255, 255, 0.911)");
         $(".infoval").css("display", "none");
     }

     if ($.trim($("#VlIVA").val()).length == 0) {
         console.log('campo IdTercero vacío');
         $("#VlIVA").css("background-color", "rgba(179, 27, 27, 0.096)");
     } else {
         $("#VlIVA").css("background-color", "rgba(255, 255, 255, 0.911)");
     }
 }

 function campos() {

     if ($.trim($("#FcTransaccion").val()).length == 0) {
         console.log('campo IdTercero vacío');
         $("#FcTransaccion").css("background-color", "rgba(179, 27, 27, 0.096)");
         $(".infot").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
     } else {
         $("#FcTransaccion").css("background-color", "rgba(255, 255, 255, 0.911)");
         $(".infot").css("display", "none");
     }

     if ($.trim($("#IdTercero").val()).length == 0) {
         console.log('campo DigVerificacion vacío');
         $("#IdTercero").css("background-color", "rgba(179, 27, 27, 0.096)");
         $(".infopro").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
     } else {
         $("#IdTercero").css("background-color", "rgba(255, 255, 255, 0.911)");
         $(".infopro").css("display", "none");
     }

     if ($.trim($("#NuDocumento").val()).length == 0) {
         console.log('campo NuDocumento vacío');
         $("#NuDocumento").css("background-color", "rgba(179, 27, 27, 0.096)");
         $(".infoDoc").css("display", "inline");
     } else {
         $("#NuDocumento").css("background-color", "rgba(255, 255, 255, 0.911)");
         $(".infoDoc").css("display", "none");
     }

     if ($.trim($("#FcDocumento").val()).length == 0) {
         console.log('campo TelefonoFijo vacío');
         $("#FcDocumento").css("background-color", "rgba(179, 27, 27, 0.096)");
         $(".infofech").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
     } else {
         $("#FcDocumento").css("background-color", "rgba(255, 255, 255, 0.911)");
         $(".infofech").css("display", "none");
     }
 }

 //FUNCION GUARDAR CABECERA 
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
         }
     });
 }

 // AGREGAR FILAS A DETALLE
 function agregar() {
     $('#nr').css("visibility", "hidden");
     var IdProducto = $('#IdProducto').val();
     var NmProducto = $('#NmProducto').val();
     var NuCantidad = parseFloat($('#NuCantidad').val());
     var VlUnitario = parseFloat($('#VlUnitario').val());
     var VlIVA = parseFloat($('#VlIVA').val());
     VlIVA = VlUnitario * VlIVA / 100;

     // CALCULAR TOTAL
     var Total = 0;
     var Total = (VlIVA + VlUnitario) * NuCantidad;

     var compradet = '<tr class="removeRow"><td style="width:17%;">' + IdProducto +
         '</td><td style="width:17%;">' + NmProducto +
         '</td><td style="width:17%;">' + NuCantidad +
         '</td><td style="width:17%;">' + VlUnitario +
         '</td><td style="width:16%;">' + VlIVA +
         '</td><td style="width:11%;">' + Total +
         '</td><td style="width:5%;"><button data-toggle="tooltip" data-placement="bottom" title="Eliminar" style="border: none;" class="deletedet btn btn-default btn-xs" type="button"><i class="fas fa-times"></i></button></td></tr>'
     $("#tbcompra tbody").append(compradet);

     // CALCULAR SUBTOTAL, IVA; TOTAL
     var Subtotal = 0;
     var Iva = 0;
     var Total = 0;
     $('#tbcompra tbody tr').each(function() {
         NuCantidad = parseFloat($(this).find('td').eq(2).text());
         VlUnitario = parseFloat($(this).find('td').eq(3).text());
         Subtotal += NuCantidad * VlUnitario;
         colIva = parseFloat($(this).find('td').eq(4).text());
         Iva += NuCantidad * colIva;
         Total = Subtotal + Iva;
     });
     $("#VlSubtotal").val(Subtotal);
     $("#Iva").val(Iva);
     $("#Total").val(Total);

     // DESPUES DE AGREGAR FILA, LIMPIAR INPUTS 
     $('#IdProducto').val("");
     $('#NmProducto').val("");
     $('#NuCantidad').val("");
     $('#VlUnitario').val("");
     $('#VlIVA').val("");
 }

 init();