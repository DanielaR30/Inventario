<?php
 session_start();
 //print_r($_SESSION);die();
 if (!isset($_SESSION["NmUsuario"]))
 {
  //  print_r('holaaaaaa'); die();
   header("location:log.php");
 }
 else
 {
 require 'header.php';
?>
    <ul class="sidebar-menu" data-widget="tree">

         <li class="header">MENÚ PRINCIPAL</li>
         <li class=""><a href="Index/index.php"><i class="fas fa-home"></i><span>&nbsp; Inicio</span></a></li> 
         
                        <li>
                          <!-- <a href="bootstrap/cardscopy.html"> -->
                          <a href="Dashboard/index.php">
                          <i class="fa fa-dashboard"></i> <span>Panel de Control</span>
                            <!-- <small class="label pull-right bg-blue">CONFIGURACION</small> -->
                          </a>
                        </li>

                   <li class="nav-item dropdown">
                          <a href="#">
                          <i class="fas fa-wrench"></i>&nbsp; <span>Configuración General</span>
                            <!-- <small class="label pull-right bg-yellow">AvideaIT</small>  -->
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>
                         <ul class="treeview-menu">

                           <li ><a href="usuario.php"><i class="fas fa-user-edit"></i>&nbsp; Usuarios</a></li>
                           <li ><a href="cargo.php"><i class="fas fa-user-tie"></i>&nbsp; Cargos</a></li>
                           <li ><a href="oficina.php"><i class="far fa-building"></i>&nbsp; Oficinas</a></li>
                           <li ><a href="tercero.php"><i class="fas fa-users-cog"></i>&nbsp;  Terceros</a></li>
                         </ul>
                   </li>

                   <li class="treeview active">
                          <a href="#">
                          <i class="fas fa-cog fa-spin"></i>&nbsp; <span>Configuración del Sistema</span>
                            <!-- <small class="label pull-right bg-yellow">AvideaIT</small>  -->
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>
                          <ul class="treeview-menu">
                               <li ><a href="segmento.php"><i class="far fa-file"></i>&nbsp; Segmentos</a></li>
                               <li ><a href="familia.php"><i class="fas fa-sitemap"></i>&nbsp; Familias</a></li>
                               <li ><a href="clase.php"><i class="far fa-folder-open"></i>&nbsp; Clases</a></li>
                               <li ><a href="estadoproducto.php"><i class="fas fa-toggle-on"></i>&nbsp; Estado de los Productos</a></li>
                               <li ><a href="marca.php"><i class="fas fa-tag"></i>&nbsp; Marcas</a></li>
                               <li ><a href="linea.php"><i class="fas fa-clipboard"></i>&nbsp; líneas</a></li>
                               <li ><a href="area.php"><i class="far fa-building"></i>&nbsp; Áreas</a></li>
                               <li ><a href="unidadmedida.php"><i class="fas fa-boxes"></i>&nbsp; Unidades de Medida</a></li>
                               <li ><a href="bodega.php"><i class="fas fa-warehouse"></i>&nbsp; Bodega</a></li>
                               <li ><a href="producto.php"><i class="fas fa-barcode"></i>&nbsp; Productos</a></li>
                               <li ><a href="tipotransaccion.php"><i class="fas fa-store"></i>&nbsp; Tipo de transacción</a></li> 
                               <li class="active"><a href="#"><i class="fas fa-credit-card"></i>&nbsp; Compras</a></li>
                               <li ><a href="pedido.php"><i class="fas fa-shopping-cart"></i>&nbsp; Pedidos</a></li>
                          </ul>
                   </li>
         </ul>
       </section>
       <!-- /.sidebar -->
     </aside>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
       <h1>
         Compra
         <!-- <small>advanced tables</small> -->
       </h1>
       <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#">Configuración General</a></li>
         <li class="breadcrumb-item"><a href="tercero.php">compra</a></li>
       </ol>
     </section>


<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12 ">
              <div class="box box-default">
            <div class="box-header with-border">
              <!-- <h1 class="box-title" style="font-family: 'Sawarabi Gothic', sans-serif;">Compra</h1> -->

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" name="formulario" id="formulario" method="post">
              <div class="box-body">

              <div class="row">
              <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
              <div class="col-lg-2"></div>
              <div class="col-lg-10"></div>
              </div>
         
              <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                          <label for="IdTransaccionCab" class="col-lg-2 control-label">Código</label>
                          <!-- readonly -->
                        <div class="col-sm-10">
                          <input type="number" class="form-control align-self-end" name="IdTransaccionCab" id="IdTransaccionCab"  readonly>
                            <span class="infoT" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                <i class="fas fa-exclamation-circle"> Campo requerido.</i>
                            </span>
                        </div>
              </div>
              </div>

              <div class="row">
                <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <label for="FcTransaccion" class="col-sm-2 control-label">Fecha</label>
                      <div class="col-sm-10">
                      <input data-toggle="datepicker" type="datetime-local" class="form-control" name="FcTransaccion" id="FcTransaccion" required>
                       <span class="infot" style="display:none; color:rgba(230, 35, 18, 0.952);">
                            <i class="fas fa-exclamation-circle"> Campo requerido </i>
                        </span>
                      </div>
                    </div>
              </div>

              <div class="row">
                    <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="IdTercero" class="col-sm-2 control-label">Proveedor</label>
                            <div class="col-lg-10">
                            <!-- <input type="text" list="IdTercero" class="form-control" name="IdTercero" id="IdTercero" required>
                            <datalist id="IdTercero" name="IdTercero"></datalist> -->
                            <select class="form-control select2" style="width: 100%;" name="IdTercero" id="IdTercero"></select>
                            <span class="infopro" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido.</i>
                             </span>
                            </div>
                      </div>
               </div>

                <div class="row">
                    <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label for="NuDocumento" class="col-sm-2 control-label">Numero Documento</label>
                          <div class="col-lg-10">
                          <input type="number" class="form-control" name="NuDocumento" id="NuDocumento" required>
                          <span class="infoDoc" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                <i class="fas fa-exclamation-circle"> Campo requerido.</i>
                            </span>
                          </div>
                        </div>
                    <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="FcDocumento" class="col-sm-2 control-label">Fecha Documento</label>
                            <div class="col-lg-10">
                            <input type="datetime-local" class="form-control" name="FcDocumento" id="FcDocumento" required>
                            <span class="infofech" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido.</i>
                             </span>
                            </div>
                      </div>
                  </div>

                <div class="row">
                      <div class="inputWithIcon form-group col-lg-12 col-md-8 col-sm-8 col-xs-8">
                            <label for="Observaciones" class="col-lg-1 control-label">Observaciones</label>
                            <div class="col-lg-11" style="width: 89%;">
                              <textarea class="form-control" name="Observaciones" id="Observaciones" maxlength="255" rows="2" cols="50" style="resize: none;"></textarea>
                            <!-- <input type="text" class="form-control" name="Descripcion" id="Descripcion" required> -->
                            <span class="infoDir" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido. Ingrese máximo 255 caracteres.</i>
                              </span>
                            </div>
                        </div>
                </div>
                
        <!-- --------------------btn Guardar compra---------------------------- -->
                <div class="box-footer">
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <!-- <button id="btnap" class="btn btn-primary pull-right" type="button"><i class="far fa-list-alt"> Agregar Productos</i></button> -->
                <button class="btn btn-primary pull-right" style="margin-right: 4px" type="button"  id="btnGuardarc">Ingresar productos </button> 
                </div>
                </div>

    <div id="detalle" style="display:none;"> 
          <h4 class="box-title" style="font-family:'Sawarabi Gothic', sans-serif; text-align:center;">Detalles de los productos</h4> 
                 
                 <div class="col col-6 bg-info" id="nr" style="visibility: hidden;">
                 &nbsp;&nbsp; <span id="nro"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="nro1"></span>
                 </div>
                
               <div class="box">
                            <div class="box-header">
                       <div class="box-body no-padding">
                                <table id="tbcompra" class="table table-striped">
                                <thead class="border">
                                    <tr>
                                        <!-- <th style="width: 10px">#</th> -->
                                        <th style="width:17px;">Código</th>
                                        <th style="width:17px;">Producto</th>
                                        <th style="width:17px;">Cantidad</th>
                                        <th style="width:17px;">Valor Unitario</th>
                                        <th style="width:16px;">Iva</th>
                                        <th style="width:16px;" colspan="2">Total</th>
                                    </tr>
                                </thead>
                            <tbody>
                            <!-- <tr>
                            <td style="width: 20px;">1</td>
                            <td style="width: 20px;">cocacola</td>
                            <td style="width: 20px;">10</td>
                            <td style="width: 20px;">3000</td>
                            <td style="width: 15px;">30000</td>
                            <td style="width: 5px;"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-times"></i></button></td>
                            </tr> -->
                            </tbody>
                                <tfoot>
                                  <tr>
                                      <td style="width:17px;">
                                      <button type="button" id="agregar" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Agregar producto"><i class="fas fa-plus"></i></button> 
                                      <input style="display: none;" type="text" class="form-control" name="IdProducto" id="IdProducto" readonly>
                                      <button type="button" id="guardar" style="margin-top: 7px; display: none;" class="btn btn-primary btn-sm m-1"  data-toggle="tooltip" data-placement="bottom" title="Guardar producto"><i class="fas fa-save"></i></button>
                                      <button type="button" id="volver" style="margin-top: 7px; display: none;" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Volver"><i class="fas fa-backspace"></i></button> 
                                      </td>
                                      
                                      <td style="width:17px; visibility: hidden;" id="nombre">
                                      <select style="width: 100%;" class="form-control"  name="NmProducto" id="NmProducto"></select>
                                      <!-- <input style="display: none;" type="text" class="form-control" name="NmProducto" id="NmProducto"> -->
                                      <span class="infonm" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                      <i class="fas fa-exclamation-circle"> Campo requerido.</i></span>
                                      </td>
                                      
                                      <td style="width:17px;"><input style="display: none;" type="number" class="form-control" name="NuCantidad" id="NuCantidad">
                                      <span class="infocant" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                      <i class="fas fa-exclamation-circle"> Campo requerido.</i></span>
                                      </td>
                                      
                                      <td style="width:17px;"><input style="display: none;" type="number" class="form-control" name="VlUnitario" id="VlUnitario">
                                      <span class="infoval" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                      <i class="fas fa-exclamation-circle"> Campo requerido.</i></span>
                                      </td>
                                      
                                      <td style="width:16px;"><input style="display: none;" type="text" class="form-control" name="VlIVA" id="VlIVA" readonly></td>
                                      <td style="width:16px;"></td>
                                  </tr>
                                  <tr> 
                                   <td colspan="4"></td>
                                   <td style="width:16px;"><b>Subtotal</b></td>
                                   <td style="width:16px; font-weight:600;"><input type="number" class="form-control align-self-end"  name="VlSubtotal" id="VlSubtotal" readonly></td>
                                  </tr>
                                  <tr>
                                   <td colspan="4"></td>  
                                   <td style="width:16px;"><b>Iva</b></td>
                                   <td style="width:16px; font-weight:600;"><input type="number" class="form-control align-self-end"  name="Iva" id="Iva" readonly></td>
                                  </tr>
                                  <tr>
                                   <td colspan="4"></td>  
                                   <td style="width:16px;"><b>Total</b></td>
                                   <td style="width:16px; font-weight:600;"><input type="number" class="form-control align-self-end"  name="Total" id="Total" readonly></td>
                                  </tr>
                                </tfoot>
                                </table>  
                            </div> 
                            </div> 
                            </div> 
</div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer" id="foot" style="display:none;">
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button class="btn btn-primary pull-right" style="margin-left: 4px" type="button"  id="btGuardar"><i class="fa fa-save"> Guardar</i></button> 
                </div>
                <!-- <button type="button" class="btn btn-primary pull-right">Sign in</button> -->
              </div>
              
              <!-- /.box-footer -->
            </form>
          </div>
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  <!-- Fin modal -->
  
<?php
require 'footer.php';
?>
<script src="js/compra.js"></script>

<?php
}
?>