<?php
 session_start();
 if (!isset($_SESSION["NmUsuario"])) 
 {
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
                        
                        
                        <?php
                        //si el usuario es tipo Admin, entonces agregar opcines de configuración general.
                    if ($_SESSION["TipoUsuario"] === 'A' ) {       
                      ?>  
                             <!-- <li class="treeview cong"> -->
                             <li class="treeview" >
                                    <a href="#">
                                    <i class="fas fa-wrench"></i>&nbsp; <span>Configuración General</span>
                                      <!-- <small class="label pull-right bg-yellow">AvideaIT</small>  -->
                                      <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                   <ul class="treeview-menu">     
                                     <li><a href="usuario.php"><i class="fas fa-user-edit"></i>&nbsp; Usuarios</a></li>
                                     <li><a href="cargo.php"><i class="fas fa-user-tie"></i>&nbsp; Cargos</a></li>
                                     <li><a href="oficina.php"><i class="far fa-building"></i>&nbsp; Oficinas</a></li>
                                     <li><a href="tercero.php"><i class="fas fa-users-cog"></i>&nbsp;  Terceros</a></li>              
                                   </ul>
                             </li>                           
                     <?php 
                     }   
                     ?>     
                   
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
                               <li><a href="estadoproducto.php"><i class="fas fa-toggle-on"></i>&nbsp; Estado de los Productos</a></li>    
                               <li><a href="marca.php"><i class="fas fa-tag"></i>&nbsp; Marcas</a></li>    
                               <li ><a href="linea.php"><i class="fas fa-clipboard"></i>&nbsp; líneas</a></li>
                               <li ><a href="area.php"><i class="far fa-building"></i>&nbsp; Áreas</a></li>  
                               <li ><a href="unidadmedida.php"><i class="fas fa-boxes"></i>&nbsp; Unidades de Medida</a></li>                                
                               <li ><a href="bodega.php"><i class="fas fa-warehouse"></i>&nbsp; Bodega</a></li>    
                               <li class="active"><a href="#"><i class="fas fa-barcode"></i>&nbsp; Productos</a></li> 
                               <li ><a href="tipotransaccion.php"><i class="fas fa-store"></i>&nbsp; Tipo de transacción</a></li> 
                               <li ><a href="movimiento.php"><i class="fas fa-credit-card"></i>&nbsp; Compras</a></li>
                               <li ><a href="estadopedido.php"><i class="fas fa-clipboard-check"></i>&nbsp; Estado de los Pedidos</a></li>
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
         Tabla de datos
         <!-- <small>advanced tables</small> -->
       </h1>
       <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#">Configuración del sistema</a></li>
         <li class="breadcrumb-item"><a href="tercero.php">Productos</a></li>       
       </ol>
   </section>



<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12 ">
                  <div class="box" >
                    <div class="box-header with-border">

                    <div class="col-lg-6">
                    <h1 class="box-title" style="display:none; font-family: 'Sawarabi Gothic', sans-serif;" id="titulo1">Productos</h1>
                    <h1 class="box-title" style="display:none; font-family: 'Sawarabi Gothic', sans-serif;" id="titulo">Codificación de Productos</h1>  
                    <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)" data-toggle="tooltip" data-placement="right" title="Nuevo registro"><i class="far fa-edit"></i> Agregar</button>
                  
                    </div>
                        <div class="box-tools pull-right">
                    </div>
                    
                    </div>
                    <!-- /.box-header -->
                    <!-- centro --> 
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover display">
                        <!-- <a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="tbllistado" href="../exportar-phpexcel/createExcel.php" target="_blank"><span>Excel</span></a>
                        <a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="tbllistado" href="../exportar-phpexcel/pdf/index.php" target="_blank"><span>PDF</span></a> -->
                     
                          <thead >                            
                            <th>Opciones</th>
                            <th>Código</th>
                            <!-- <th>Clase</th> -->
                            <th></th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Código de barrras</th>
                            <th>Imagen</th>
                            <th>Marca</th>
                            <th>Línea</th>
                            <th>Unidad de medida</th>
                            <th>Localización</th>
                            <th>Existencias Físicas</th>
                            <th>Stock Mínimo</th>
                            <th>Stock Máximo</th>
                            <th>Costo Promedio</th>
                            <th>Gravado Iva</th>
                            <th>Porcentaje IVA</th>
                            <th>Estado Activo/Inactivo</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
		                   			<tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                				  	</tr>
			                  	</tfoot>
                        </table>
                        
                    </div>
                     
                    <div class="panel-body"   id="formularioregistros">
                      <form name="formulario" id="formulario" method="post">
                        <div class="row">     
                        <div class="col-lg-12">
                         <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-6">
                              <label for="">Código</label>
                              <!-- readonly -->
                              <input type="number" class="form-control align-self-end bg-gray"  name="IdProducto" id="IdProducto"  readonly>
                                <span class="infoT" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                    <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                                </span>
                          </div> 
                         
                         <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="IdClase">Clase</label>
                            <select name="IdClase" id="IdClase" class="form-control">
                            </select>
                            <span class="infoCiu" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                             </span>
                          </div>
                                                     
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="NmProducto">Nombre</label>
                            <input type="text" class="form-control" name="NmProducto" id="NmProducto" required>
                            <span class="infoR" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                            </span>
                          </div> 
                          
                          <div class="inputWithIcon form-group col-lg-12 col-md-8 col-sm-8 col-xs-8">
                            <label for="Descripcion">Descripción</label>  
                            <textarea class="form-control" name="Descripcion" id="Descripcion" maxlength="255" rows="2" cols="159" style="resize: none;"></textarea>   
                            <!-- <input type="text" class="form-control" name="Descripcion" id="Descripcion" required> -->
                            <span class="infoDir" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido. Ingrese máximo 255 caracteres.</i> 
                              </span>
                        </div>                                                                      
                       </div>
                                                
                                                
                        <div class="col col-lg-6">                       
                        
                        <div class="inputWithIcon form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                        <label for="barcode">Código de Barras</label>
                        <input type="text" class="form-control" name="CodigoBarras" id="CodigoBarras"> 
                        <!-- <button class="btn btn-success" type="button" onclick="generarbarcode()">Generar</button> -->
                        <!-- <button class="btn btn-info" type="button" onclick="imprimir()">Imprimir</button> -->
                        <!-- <div id="print"><svg id="barcode" name="barcode"></svg></div> -->
                        <span class="infoTel" style="display:none; color:rgba(230, 35, 18, 0.952);">
                              <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                         </span>                             
                      </div>    
                      
                      
                      <div class="inputWithIcon form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                <label for="IdLinea">Línea</label>
                                <select name="IdLinea" id="IdLinea" class="form-control">
                                </select>
                                <span class="infoCor" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                      <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                                 </span>
                             </div> 
                        
                        <div class="inputWithIcon form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                  <label for="IdLocalizacion">Localización</label>
                                  <select name="IdLocalizacion" id="IdLocalizacion" class="form-control select2" style="width: 100%;">
                                  </select>
                                  <span class="infolo" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                        <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                                  </span>
                              </div>  
                              <div class="inputWithIcon form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                  <label for="NuStockMin">Stock mínimo</label>
                                  <input type="number" class="form-control" name="NuStockMin" id="NuStockMin" required>
                                  <span class="infomi" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                        <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                                   </span>
                              </div>
                              
                              <div class="inputWithIcon form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                  <label for="GravadoIVA">Gravado IVA</label>
                                  <input type="text" class="form-control" maxlength="1" name="GravadoIVA" id="GravadoIVA" required>
                                  <span class="infogi" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                        <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                                   </span>
                              </div>
                              
                              <div class="inputWithIcon form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                  <label for="PorcentajeIVA">Porcentaje IVA</label>
                                  <input type="number" class="form-control" name="PorcentajeIVA" id="PorcentajeIVA" required>
                                  <span class="infoiv" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                        <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                                   </span>
                              </div>
                           
                        </div>
                        
                        <div class="col col-lg-6">
                        
                        <div class="inputWithIcon form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                            <label for="IdMarca">Marca</label>
                            <select name="IdMarca" id="IdMarca" class="form-control">
                            </select>
                            <span class="infomrc" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                             </span>
                        </div>  
                      
                      
                        <div class="inputWithIcon form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                              <label for="IdUnidadMedida">Unidades de medida</label>
                              <select name="IdUnidadMedida" id="IdUnidadMedida" class="form-control">
                              </select>
                              <span class="infoDocu" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                    <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                               </span>
                        </div>
                      
                        <div class="inputWithIcon form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                  <label for="NuStockMax">Stock máximo</label>
                                  <input type="number" class="form-control" name="NuStockMax" id="NuStockMax" required>
                                  <span class="infoma" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                        <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                                   </span>
                             </div> 
                      
                         <div class="inputWithIcon form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">
                                <label for="ImagenProducto">Imagen</label>
                                <input type="file" class="form-control-file" name="ImagenProducto" id="ImagenProducto">
                                <input type="hidden" name="imagenactual" id="imagenactual">
                               
                                <img src="" width="155px" height="155px" id="imagenmuestra" class="justify-content-center">
                                <div id="imagenpre"></div>
                                <span class="infoimg" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                      <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                                 </span>                             
                              </div> 
                         </div>                                                 
                </div>                         
                 
 
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <button class="btn btn-primary" type="button"  id="btnGuardar"><i class="fa fa-save"> Guardar</i></button> 
                             <button class="btn btn-primary" type="button"  id="btnEditar"><i class="fa fa-save"> Editar</i></button>
                             <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"> Cancelar</i></button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  <!-- Fin modal -->
  
<?php
require 'footer.php';
?>
<script src="js/producto.js"></script>

<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>

<?php
}
?>