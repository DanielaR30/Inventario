// var tabla;
// function init() {

//     mostrarform(false);
//     listar();

//     $.post("../controlador/tercero.php?op=selectDocumento", function(r) {
//         $("#IdTipoDocumento").html(r);
//     });
//     $.post("../controlador/tercero.php?op=selectCiudad", function(r) {
//         $("#IdCiudad").html(r);
//     });
//     $.post("../controlador/tercero.php?op=selectGenero", function(r) {
//         $("#IdGenero").html(r);
//     });
// }

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
//     $(".infoDi").css("display", "none");
//     $("#NmRazonSocial").css("background-color", "rgb(255, 255, 255)");
//     $(".infoR").css("display", "none");
//     $(".espacio1").css("display", "none");
//     $("#Direccion").css("background-color", "rgb(255, 255, 255)");
//     $(".infoDir").css("display", "none");
//     $("#TelefonoFijo").css("background-color", "rgb(255, 255, 255)");
//     $(".infoTel").css("display", "none");
//     $(".espacio2").css("display", "none");
//     $("#TelefonoMovil").css("background-color", "rgb(255, 255, 255)");
//     $(".infoTelM").css("display", "none");
//     $("#CorreoElectronico").css("background-color", "rgb(255, 255, 255)");
//     $(".infoCor").css("display", "none");
//     $(".espacio3").css("display", "none");
//     $("#IdTipoDocumento").css("background-color", "rgb(255, 255, 255)");
//     $(".infoDocu").css("display", "none");
//     $("#IdCiudad").css("background-color", "rgb(255, 255, 255)");
//     $(".infoCiu").css("display", "none");
//     $(".espacio4").css("display", "none");
//     $("#IdGenero").css("background-color", "rgb(255, 255, 255)");
//     $(".infoGe").css("display", "none");
//     $("#FlActivo").css("background-color", "rgb(255, 255, 255)");
//     $(".infoAc").css("display", "none");
// }

// function mostrarform(flag) {
//     limpiar();

//     if (flag) {
//         $("#titulo1").css("display", "none");
//         $("#titulo").css("display", "inline");
//         $("#listadoregistros").hide();
//         $("#formularioregistros").show();
//         $("#btnGuardar").show();
//         $("#btnGuardar").prop("disabled", false);
//         $("#btnEditar").hide();
//         $("#btnagregar").hide();
//         $("#btnborrar").hide();
//         $("#nuevo").show();
//         $("#mlista").hide();
//     } else {
//         $("#titulo1").css("display", "inline");
//         $("#titulo").css("display", "none");
//         $("#listadoregistros").show();
//         $("#formularioregistros").hide();
//         $("#btnagregar").show();
//         $("#btnborrar").show();
//         $("#nuevo").hide();
//         $("#mlista").show();
//     }
// }

// function cancelarform() {
//     mostrarform(false);
//     limpiar();
// }

// function listar() {
//     // console.log('iniciando............ donde llama esta funcion');
//     tabla = $('#tbllistado').dataTable({
//         "aProcessing": true, // activando los procedimientos de datatables
//         "aServerSide": true, // paginacion y filtracion
//         dom: 'Bfrtip', // definimos los elementos de la tabla
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf'
//             // 'copyHtkml5','excelHtml5', 'csvHtml5', 'pdf'            ,
//             // {
//             //     extend: 'print',
//             //     exportOptions: {
//             //         columns: ':visible'
//             //     }
//             // },
//             // 'colvis'
//         ],
//         "ajax": {
//             url: '../controlador/tercero.php?op=listar',
//             type: "get",
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
// }

// $(document).ready(function() {

//     $('#IdTercero').keyup(function() {
//         var IdTercero = $(this).val();
//         var dataString = 'IdTercero=' + IdTercero;
//         $.ajax({
//             type: "POST",
//             url: "../controlador/tercero.php?op=datosid",
//             data: dataString,
//             success: function(data) {
//                 console.log(data);

//                 if (data.trim() !== "\r\nnull" || data.trim() !== undefined || data.trim() !== null || data.trim() !== "null") {
//                     data = JSON.parse(data);

//                     $('#IdTercero').val(IdTercero);
//                     $('#DigVerificacion').val(data.DigVerificacion);
//                     $('#NmRazonSocial').val(data.NmRazonSocial);
//                     $('#Direccion').val(data.Direccion);
//                     $('#TelefonoFijo').val(data.TelefonoFijo);
//                     $('#TelefonoMovil').val(data.TelefonoMovil);
//                     $('#CorreoElectronico').val(data.CorreoElectronico);
//                     $('#IdTipoDocumento').val(data.IdTipoDocumento);
//                     $('#IdCiudad').val(data.IdCiudad);
//                     $('#IdGenero').val(data.IdGenero);
//                     $('#FlActivo').val(data.FlActivo);
//                     $("#btnGuardar").prop('disabled', true);
//                 }
//             },
//             error: function() {
//                 console.log('Disculpe, existió un problema');
//             }
//         });

//         $.ajax({
//             type: "POST",
//             url: "../controlador/tercero.php?op=validarid",
//             data: dataString,
//             success: function(data) {
//                 console.log(data);
//                 if (data.trim() === "\r\nnull" || data.trim() == undefined || data.trim() == null || data.trim() == "null") {

//                     $("#DigVerificacion").val("");
//                     $("#NmRazonSocial").val("");
//                     $("#Direccion").val("");
//                     $('#TelefonoFijo').val("");
//                     $("#TelefonoMovil").val("");
//                     $('#CorreoElectronico').val("");
//                     $("#IdTipoDocumento").val("");
//                     $("#IdCiudad").val("");
//                     $("#IdGenero").val("");
//                     $("#FlActivo").val("");
//                     $("#btnGuardar").prop('disabled', false);
//                 }
//             },
//             error: function() {
//                 console.log('Disculpe, existió un problema');
//             }
//         });

//     });



//     $("#btnGuardar").click(function(e) {
//         campos();

//         if ($.trim($("#IdTercero").val()).length == 0 ||
//             $.trim($("#DigVerificacion").val()).length == 0 ||
//             $.trim($("#NmRazonSocial").val()).length == 0 ||
//             $.trim($("#Direccion").val()).length == 0 ||
//             $.trim($("#TelefonoFijo").val()).length == 0 ||
//             $.trim($("#TelefonoMovil").val()).length == 0 ||
//             $.trim($("#CorreoElectronico").val()).length == 0 ||
//             $.trim($("#IdTipoDocumento").val()).length == 0 ||
//             $.trim($("#IdCiudad").val()).length == 0 ||
//             $.trim($("#IdGenero").val()).length == 0 ||
//             $.trim($("#FlActivo").val()).length == 0) {
//             console.log('campos vacíos');
//         } else if (!($.trim($("#DigVerificacion").val()).match(/^[0-9]{1}$/)) ||
//             !($.trim($("#TelefonoFijo").val()).match(/^[0-9]{7}$/)) ||
//             !($.trim($("#TelefonoMovil").val()).match(/^[3][0-9]{9}$/)) ||
//             !($.trim($("#CorreoElectronico").val()).match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/))
//         ) {
//             console.log('campos incorrectos');
//         } else {
//             guardar(e);
//         }
//     });


//     $("#btnEditar").click(function(e) { //Valida que ningun campo esté vacio antes de editar
//         campos();

//         if ($.trim($("#IdTercero").val()).length == 0 ||
//             $.trim($("#DigVerificacion").val()).length == 0 ||
//             $.trim($("#NmRazonSocial").val()).length == 0 ||
//             $.trim($("#Direccion").val()).length == 0 ||
//             $.trim($("#TelefonoFijo").val()).length == 0 ||
//             $.trim($("#TelefonoMovil").val()).length == 0 ||
//             $.trim($("#CorreoElectronico").val()).length == 0 ||
//             $.trim($("#IdTipoDocumento").val()).length == 0 ||
//             $.trim($("#IdCiudad").val()).length == 0 ||
//             $.trim($("#IdGenero").val()).length == 0 ||
//             $.trim($("#FlActivo").val()).length == 0) {
//             console.log('campos vacíos');

//         } //si #DigVerificacion es diferente a 1 dígito ó
//         else if (!($.trim($("#DigVerificacion").val()).match(/^[0-9]{1}$/)) ||
//             //#TelefonoFijo es diferente a 7 dígitos  ó
//             !($.trim($("#TelefonoFijo").val()).match(/^[0-9]{7}$/)) ||
//             //#TelefonoMovil es diferente a 10 dígitos iniciando con el 3 ó
//             !($.trim($("#TelefonoMovil").val()).match(/^[3][0-9]{9}$/)) ||
//             //#CorreoElectronico es diferente a  incluir @ .
//             !($.trim($("#CorreoElectronico").val()).match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/))
//         ) {
//             console.log('campos incorrectos');

//         } else {
//             editar(e);
//         }
//     });
// });

// function campos() {

//     if ($.trim($("#IdTercero").val()).length == 0 || !($.trim($("#IdTercero").val()).match(/^[0-9]{1}$/))) {
//         console.log('campo IdTercero vacío');
//         $("#IdTercero").css("background-color", "rgba(179, 27, 27, 0.096)");
//         $(".infoT").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
//     } else {
//         $("#IdTercero").css("background-color", "rgba(255, 255, 255, 0.911)");
//         $(".infoT").css("display", "none");
//     }

//     if ($.trim($("#DigVerificacion").val()).length == 0 || !($.trim($("#DigVerificacion").val()).match(/^[0-9]{1}$/))) {
//         console.log('campo DigVerificacion vacío');
//         $("#DigVerificacion").css("background-color", "rgba(179, 27, 27, 0.096)");
//         $(".infoDi").css("display", "inline"); //.fadeOut(1000); .hiden(2000);

//     } else {
//         $("#DigVerificacion").css("background-color", "rgba(255, 255, 255, 0.911)");
//         $(".infoDi").css("display", "none");
//     }

//     if ($.trim($("#NmRazonSocial").val()).length == 0) {
//         console.log('campo NmRazonSocial vacío');
//         //cambiar el color de fondo de #NmRazonSocial a rojo
//         $("#NmRazonSocial").css("background-color", "rgba(179, 27, 27, 0.096)");
//         // mostrar <span class="infoR"> !campo requerido--- en vista/tercero.php 
//         $(".infoR").css("display", "inline");
//     } else { //si el numero de caracteres en #NmRazonSocial es diferente a 0
//         //cambiar el color de fondo de #NmRazonSocial a blanco
//         $("#NmRazonSocial").css("background-color", "rgba(255, 255, 255, 0.911)");
//         //Ocultar <span class="infoR"> !campo requerido--- en vista/tercero.php 
//         $(".infoR").css("display", "none");
//     }

//     if ($.trim($("#Direccion").val()).length == 0) {
//         console.log('campo Direccion vacío');
//         $("#Direccion").css("background-color", "rgba(179, 27, 27, 0.096)");
//         $(".infoDir").css("display", "inline");
//     } else {
//         $("#Direccion").css("background-color", "rgba(255, 255, 255, 0.911)");
//         $(".infoDir").css("display", "none");
//     }

//     if ($.trim($("#TelefonoFijo").val()).length == 0 || !($.trim($("#TelefonoFijo").val()).match(/^[0-9]{7}$/))) {
//         console.log('campo TelefonoFijo vacío');
//         $("#TelefonoFijo").css("background-color", "rgba(179, 27, 27, 0.096)");
//         $(".infoTel").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
//     } else {
//         $("#TelefonoFijo").css("background-color", "rgba(255, 255, 255, 0.911)");
//         $(".infoTel").css("display", "none");
//     }

//     if ($.trim($("#TelefonoMovil").val()).length == 0 || !($.trim($("#TelefonoMovil").val()).match(/^[3][0-9]{9}$/))) {
//         console.log('campo TelefonoMovil vacío');
//         $("#TelefonoMovil").css("background-color", "rgba(179, 27, 27, 0.096)");
//         $(".infoTelM").css("display", "inline");

//     } else {
//         $("#TelefonoMovil").css("background-color", "rgba(255, 255, 255, 0.911)");
//         $(".infoTelM").css("display", "none");
//     }

//     if ($.trim($("#CorreoElectronico").val()).length == 0 || !($.trim($("#CorreoElectronico").val()).match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/))) {
//         console.log('campo CorreoElectronico vacío');
//         $("#CorreoElectronico").css("background-color", "rgba(179, 27, 27, 0.096)");
//         $(".infoCor").css("display", "inline"); //.fadeOut(1000); .hiden(2000);

//     } else {
//         $("#CorreoElectronico").css("background-color", "rgba(255, 255, 255, 0.911)");
//         $(".infoCor").css("display", "none");
//     }

//     if ($.trim($("#IdTipoDocumento").val()).length == 0) {
//         console.log('campo IdTipoDocumento vacío');
//         $("#IdTipoDocumento").css("background-color", "rgba(179, 27, 27, 0.096)");
//         $(".infoDocu").css("display", "inline"); //.fadeOut(1000); .hiden(2000);      
//     } else {
//         $("#IdTipoDocumento").css("background-color", "rgba(255, 255, 255, 0.911)");
//         $(".infoDocu").css("display", "none");
//     }

//     if ($.trim($("#IdCiudad").val()).length == 0) {
//         console.log('campo IdCiudad vacío');
//         $("#IdCiudad").css("background-color", "rgba(179, 27, 27, 0.096)");
//         $(".infoCiu").css("display", "inline"); //.fadeOut(1000); .hiden(2000);

//     } else {
//         $("#IdCiudad").css("background-color", "rgba(255, 255, 255, 0.911)");
//         $(".infoCiu").css("display", "none");
//     }

//     if ($.trim($("#IdGenero").val()).length == 0) {
//         console.log('campo IdGenero vacío');
//         $("#IdGenero").css("background-color", "rgba(179, 27, 27, 0.096)");
//         $(".infoGe").css("display", "inline"); //.fadeOut(1000); .hiden(2000);
//     } else {
//         $("#IdGenero").css("background-color", "rgba(255, 255, 255, 0.911)");
//         $(".infoGe").css("display", "none");
//     }

//     if ($.trim($("#FlActivo").val()).length == 0) {
//         console.log('campo FlActivo vacío');
//         $("#FlActivo").css("background-color", "rgba(179, 27, 27, 0.096)");
//         $(".infoAc").css("display", "inline");
//     } else {
//         $("#FlActivo").css("background-color", "rgba(255, 255, 255, 0.911)");
//         $(".infoAc").css("display", "none");
//     }
// }

// function guardar(e) {
//     e.preventDefault(); //No se activará la acción predeterminada del evento
//     $("#btnGuardar").prop("disabled", true);
//     var formData = new FormData($("#formulario")[0]); //
//     $.ajax({
//         url: "../controlador/tercero.php?op=guardar",
//         type: "POST",
//         data: formData,
//         contentType: false,
//         processData: false,
//         success: function(datos) {
//             console.log(datos);
//             swal({
//                 title: 'Success',
//                 type: 'success',
//                 text: datos
//             });
//             mostrarform(false);
//             tabla.ajax.reload();
//         }
//     });
//     limpiar();
// }

// function editar(e) {
//     e.preventDefault(); //No se activará la acción predeterminada del evento
//     $("#btnEditar").prop("disabled", true);
//     var formData = new FormData($("#formulario")[0]);
//     //console.log(formData);
//     $.ajax({
//         url: "../controlador/tercero.php?op=editar",
//         type: "POST",
//         data: formData,
//         contentType: false,
//         processData: false,

//         success: function(datos) {
//             swal({
//                 title: 'Success',
//                 type: 'success',
//                 text: datos
//             });
//             mostrarform(false);
//             tabla.ajax.reload();
//         }
//     });
//     limpiar();
// }

// function mostrarEditar(flag) {
//     limpiar();

//     if (flag) {

//         $("#listadoregistros").hide();
//         $("#formularioregistros").show();
//         $("#btnGuardar").hide();
//         $("#btnEditar").show();
//         $("#btnEditar").prop("disabled", false);
//         $("#btnagregar").hide();
//         $("#btnborrar").hide();
//         $("#nuevo").show();
//         $("#mlista").hide();
//     } else {
//         $("#listadoregistros").show();
//         $("#formularioregistros").hide();
//         $("#btnagregar").show();
//         $("#btnborrar").show();
//         $("#nuevo").hide();
//         $("#mlista").show();
//     }

// }

// function mostrar(IdTercero) {
//     //  console.log(idOficina);
//     $.post("../controlador/tercero.php?op=mostrar", { IdTercero: IdTercero }, function(data, _status) {
//         data = JSON.parse(data);
//         mostrarEditar(true);
//         $('#IdTercero').val(IdTercero);
//         $('#DigVerificacion').val(data.DigVerificacion);
//         $('#NmRazonSocial').val(data.NmRazonSocial);
//         $('#Direccion').val(data.Direccion);
//         $('#TelefonoFijo').val(data.TelefonoFijo);
//         // console.log(data.IdCiudad);
//         $('#TelefonoMovil').val(data.TelefonoMovil);
//         $('#CorreoElectronico').val(data.CorreoElectronico);
//         // var dt = new Date (data.FcApertura["date"]);
//         // $('#FcApertura').val(moment(dt).format("YYYY-MM-DDTkk:mm")); 
//         $('#IdTipoDocumento').val(data.IdTipoDocumento);
//         $('#IdCiudad').val(data.IdCiudad);
//         $('#IdGenero').val(data.IdGenero);
//         $('#FlActivo').val(data.FlActivo);
//     })
// }
// // var dt = new Date("30 July 2010 15:05 UTC");
// // document.write(dt.toISOString());              //moment(date).format("YYYY-MM-DDTkk:mm")
// function eliminar(IdTercero) {
//     swal({
//         title: "¿Eliminar?",
//         text: "¿Está Seguro de eliminar el registro?",
//         type: "warning",
//         showCancelButton: true,
//         cancelButtonText: "No",
//         cancelButtonColor: '#FF0000',
//         confirmButtonColor: '#008df9',
//         confirmButtonText: "Si",
//         closeOnConfirm: false,
//         closeOnCancel: false,
//         showLoaderOnConfirm: true
//     }, function(isConfirm) {
//         if (isConfirm) {
//             $.post("../controlador/tercero.php?op=eliminar", { IdTercero: IdTercero }, function(e) {
//                 swal('!!! Eliminado !!!', e, 'success');
//                 tabla.ajax.reload();
//             });
//         } else {
//             swal("! Cancelado ¡", "Se Cancelo la Eliminacion", "error");
//         }
//     });
// }
// init();