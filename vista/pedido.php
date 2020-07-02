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
                               <li ><a href="movimiento.php"><i class="fas fa-credit-card"></i>&nbsp; Compras</a></li>
                               <li ><a href="estadopedido.php"><i class="fas fa-clipboard-check"></i>&nbsp; Estado de los Pedidos</a></li>
                               <li class="active"><a href="#"><i class="fas fa-shopping-cart"></i>&nbsp; Pedidos</a></li>
                         
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
         Tabla de datos
         <!-- <small>advanced tables</small> -->
       </h1>
       <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#">Configuración General</a></li>
         <li class="breadcrumb-item"><a href="tercero.php">Movimiento</a></li>
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
              <h1 class="box-title" style="font-family: 'Sawarabi Gothic', sans-serif;">Pedido</h1>

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
                          <label for="IdOrdenPedido" class="col-lg-2 control-label">Código</label>
                          <!-- readonly -->
                          <div class="col-sm-10">
                          <input type="number" class="form-control align-self-end bg-gray "  name="IdOrdenPedido" id="IdOrdenPedido"  readonly>
                            <span class="infoT" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                <i class="fas fa-exclamation-circle"> Campo requerido.</i>
                            </span>
                          </div>
                </div>
              </div>
              

              <div class="row">
              <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label for="FcOrdenPedido" class="col-sm-2 control-label">Fecha</label>
                                <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" name="FcOrdenPedido" id="FcOrdenPedido" readonly>
                                 <span class="infoDi" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                      <i class="fas fa-exclamation-circle"> Campo requerido, Ingrese 1 dígito.</i>
                                  </span>
                                </div>
                              </div>
              </div>

              <div class="row">
                    <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="IdTercero" class="col-sm-2 control-label">Tercero</label>
                            <div class="col-lg-10">
                            <select class="form-control select2" style="width: 100%;" name="IdTercero" id="IdTercero"></select>
                            <span class="infoCor" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido.</i>
                             </span>
                            </div>
                      </div>
                  
               </div>

                <div class="row">
                    <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label for="IdUsuario" class="col-sm-2 control-label">Usuario</label>
                          <div class="col-lg-10">
                          <input type="text" class="form-control" name="IdUsuario" id="IdUsuario" required>
                          <span class="infoDir" style="display:none; color:rgba(230, 35, 18, 0.952);">
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
                
    <!-- -------------------------------------------btn Guardar compra------------------------------------------------------------ -->
         

                <h4 class="box-title" style="font-family: 'Sawarabi Gothic', sans-serif; position:center;">Detalles del pedido</h4>
               <div class="box">
                            <div class="box-header">
                <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                        <!-- <th style="width: 10px">#</th> -->
                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Valor Unitario</th>
                                        <th>Total</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Vasos</td>
                                        <td>10</td>
                                        <td>2000</td>
                                        <td>20000</td>
                                    </tr>
                                  
                                </table>
                            </div> 
                            </div> 
                            </div> 
                          
              <div class="row">
              <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
              <div class="col-lg-2"></div>
              <div class="col-lg-10"></div>
              </div>
              <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                          <label for="total" class="col-lg-5 control-label">Total</label>
                          <!-- readonly -->
                          <div class="col-lg-7">
                          <input type="number" class="form-control align-self-end"  name="total" id="total"  >
                            <span class="infoT" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                <i class="fas fa-exclamation-circle"> Campo requerido.</i>
                            </span>
                  </div>
                </div>
              </div> 


              </div>
              <!-- /.box-body -->
              <div class="box-footer">
              
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

<script src="js/pedidocab.js"></script>

<?php
}
?>