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

     $("#btnGuardarc").click(function(e) {
         guardar(e);
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


     $('#agregar').click(function() {
         $(this).css("display", "none");
         $('#IdProducto').css("display", "inline");
         $('#NmProducto').css("display", "inline");
         $('#NuCantidad').css("display", "inline");
         $('#VlUnitario').css("display", "inline");
         $('#guardar').css("display", "inline");
         $('#volver').css("display", "inline");
     });

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

 });


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
             //  mostrarform(false);
             //  tabla.ajax.reload();
         }
     });
     //  limpiar();
 }

 init();