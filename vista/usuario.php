<?php
 session_start();
 //print_r($_SESSION);die();
 if (!isset($_SESSION["NmUsuario"]))
 {
// print_r('holaaaaaa'); die();
   header("location:log.php");
 }
 else
 {
 require 'header.php';
?>

      <ul class="sidebar-menu" data-widget="tree">          
         <li class="header">MENÚ PRINCIPAL</li>
                        <li class="treeview">
                          <!-- <a href="bootstrap/cardscopy.html"> -->
                          <a href="Dashboard/index.php">
                          <i class="fa fa-dashboard"></i> <span>Panel de Control</span>
                            <!-- <small class="label pull-right bg-blue">CONFIGURACION</small> -->
                          </a>
                        </li> 
                        
                   <li class="treeview active">
                          <a href="#">
                          <i class="fas fa-wrench"></i>&nbsp; <span>Configuración General</span>
                            <!-- <small class="label pull-right bg-yellow">AvideaIT</small>  -->
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>
                         <ul class="treeview-menu">                                           
                                  
                           <li class="active"><a href="usuario.php"><i class="fas fa-user-edit"></i>&nbsp; Usuarios</a></li>
                           <li><a href="cargo.php"><i class="fas fa-user-tie"></i>&nbsp; Cargos</a></li>
                           <li><a href="oficina.php"><i class="far fa-building"></i>&nbsp; Oficinas</a></li>
                           <li><a href="tercero.php"><i class="fas fa-users-cog"></i>&nbsp;  Terceros</a></li>              
                         </ul>
                   </li> 
                   
                   <li class="treeview">
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
         <li class="breadcrumb-item"  id="general"><a href="#">Configuración General</a></li>
         <li class="breadcrumb-item"  id="usuario"><a href="usuario.php">Usuarios</a></li> 
   </section>



<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12 ">
                  <div class="box">
                    <div class="box-header with-border">

                    <div class="col-lg-6 mt-2">
                    <h1 class="box-title" style="display:none; font-family: 'Sawarabi Gothic', sans-serif;" id="titulo1">Usuarios</h1>
                    <h1 class="box-title" style="display:none; font-family: 'Sawarabi Gothic', sans-serif;" id="titulo">Codificación de usuario</h1>
                    &nbsp;
                    <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)" data-toggle="tooltip" data-placement="right" title="Nuevo registro"><i class="far fa-edit"></i> Agregar</button>
                  
                    </div>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <!-- <a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="tbllistado" href="../exportar-phpexcel/createExcel.php" target="_blank"><span>Excel</span></a>
                        <a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="tbllistado" href="../exportar-phpexcel/pdf/index.php" target="_blank"><span>PDF</span></a> -->
                          <thead>
                            <th>Opciones</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Contraseña</th>
                            <th>Tipo Admin/Normal</th>
                            <th>Activo Si/No</th>
                            <th>Oficina</th>
                            <th>Cargo</th>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 600px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="post">
                                                                     
                        <div class="row">  
                          <div class="inputWithIcon form-group  col-lg-6  col-md-6 col-sm-6 col-xs-12" id="iduser" >  <!-- style="display:none;"-->
                              <label>Código</label>
                               <input type="number" class="form-control" name="IdUsuario" id="IdUsuario" required >  <!--readonly -->
                                <span class="infoid" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                                </span> 
                                <span class="infoexis" style="display:none; color:rgba(230, 35, 18, 0.952);">
                                  <i class="fas fa-exclamation-circle"> Ingrese un código inexistente</i> 
                                </span>
                           </div>  
                           <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="FlUsuarioActivo">Estado</label>
                              <select class="form-control" class="form-control" name="FlUsuarioActivo" id="FlUsuarioActivo">
                                <option value="" selected disabled>Seleccione el estado del usuario</option>
                                <option Value="S">ACTIVO</option>
                                <option value="N">INACTIVO</option>
                              </select>
                              <span class="infoA" style="display:none; color:rgba(230, 35, 18, 0.952);">
                              <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                              </span>
                            </div>                           
                        </div>                          
                        <div class="row">
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="NmUsuario">Nombre</label>
                              <input type="text" class="form-control" name="NmUsuario" id="NmUsuario"  required>
                              <span class="infoN" style="display:none; color:rgba(230, 35, 18, 0.952);">
                              <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                              </span>
                            </div>
                            
                            <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="IdOficina">Oficina</label>
                            <!-- <select name="IdOficina" id="IdOficina" class="form-control selectpicker" data-live-search="true" required> -->
                            <!-- <select name="IdCiudad" id="IdCiudad" class="form-control  selectcity"  onchange="selecCity()" > -->
                            <select name="IdOficina" id="IdOficina" class="form-control" required>
                            </select>
                            <span class="infoOfi" style="display:none; color:rgba(230, 35, 18, 0.952);">
                            <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                            </span>
                            
                          </div>
                        </div>    
                        
                        <div class="row"> 
                        <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="Clave">Contraseña</label>
                            <input type="password" class="form-control" name="Clave" id="Clave" required>
                            <span class="infoC" style="display:none; color:rgba(230, 35, 18, 0.952);">
                            <i class="fas fa-exclamation-circle"> Campo requerido, Incluya min 8 caracteres, letras y números.</i> 
                            </span>
                          </div>
                          
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="IdCargo">Cargo</label>
                            <select name="IdCargo" id="IdCargo" class="form-control" required>
                            <!-- <select name="IdCiudad" id="IdCiudad" class="form-control  selectcity"  onchange="selecCity()" > -->
                            </select>
                            <span class="infoCa" style="display:none; color:rgba(230, 35, 18, 0.952);">
                            <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                            </span>
                          </div>
                        </div>

                        <div class="row">
                        <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="TipoUsuario">Tipo de usuario</label>
                            <select class="form-control" class="form-control" name="TipoUsuario" id="TipoUsuario">
                              <option value="" selected disabled>Seleccione el tipo de usuario</option>
                              <option value="A">ADMIN</option>
                              <option value="N">NORMAL</option>
                            </select>
                            <span class="infoT" style="display:none; color:rgba(230, 35, 18, 0.952);">
                            <i class="fas fa-exclamation-circle"> Campo requerido.</i> 
                            </span>
                            
                          </div>
                        </div>
                <br>
                      <div class="row">
                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <!-- <button class="btn btn-primary" type="button" onclick="guardar();" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>  -->
                             <!-- <button class="btn btn-primary" type="button" onclick="editar();" id="btnEditar"><i class="fa fa-save"></i> Editar</button> -->

                             <button class="btn btn-primary" type="button" id="btnGuardar"><i class="fa fa-save"> Guardar</i></button> 
                             <button class="btn btn-primary" type="button" id="btnEditar"><i class="fa fa-save"> Editar</i></button> &nbsp;
                             <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"> Cancelar</i></button>
                          </div>
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
<script src="js/usuario.js"></script>

<?php
}
?>