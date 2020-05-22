<?php
 session_start();
 //print_r($_SESSION);die();
 if (!isset($_SESSION["nombre"])) 
 {
  //  print_r('holaaaaaa'); die();
   header("location: login.html");
 }
 else 
 {  
 require 'header.php';
?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12 ">
                  <div class="box">
                    <div class="box-header with-border">

                    <div class="col-lg-6">
                    <h1 class="box-title">Oficina   
                    <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                    </h1>
                    </div>
                        <div class="box-tools pull-right">
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro --> 
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="tbllistado" href="../exportar-phpexcel/createExcel.php" target="_blank"><span>Excel</span></a>
                        <a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="tbllistado" href="../exportar-phpexcel/pdf/index.php" target="_blank"><span>PDF</span></a>
                          <thead>
                            <th>Opciones</th>
                            <!-- <th>idOficina</th> -->
                            <th>Oficina</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Ciudad</th>
                            <th>Punto de Atención</th>
                            <th>Zona</th>
                            <th>Fecha Apertura</th>
                            <th>FlSedePropia</th>
                            <th>Empleados</th>
                            <th>Habitantes</th>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                    </div>
                  
                    <div class="panel-body" style="height: 600px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="post">

                         <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>idOficina</label>
                            <input type="text" class="form-control" name="idOficina" id="idOficina" required>
                         </div> 

                         <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Oficina</label>
                            <input type="text" class="form-control" name="NmOficina" id="NmOficina" required>
                          </div>

                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Dirección</label>
                            <input type="text" class="form-control" name="Direccion" id="Direccion" required>
                          </div>

                        
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Teléfono</label>
                            <input type="number" class="form-control" name="Telefono" id="Telefono" required>
                          </div>

                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Zona</label>
                            <select name="IdZona" id="IdZona" class="form-control" required>
                            </select>
                          </div>
                         
                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Punto de Atención</label>
                            <input type="text" class="form-control" name="FlPuntodeAtencion" id="FlPuntodeAtencion" required>
                          </div>

                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Ciudad</label>
                            <select name="IdCiudad" id="IdCiudad" class="form-control" required>
                            <!-- <select name="IdCiudad" id="IdCiudad" class="form-control  selectcity"  onchange="selecCity()" > -->
                            </select>
                          </div>

                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha Apertura</label>
                            <input type="datetime-local" class="form-control" name="FcApertura" id="FcApertura" required="">
                          </div>

                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>FlSedePropia</label>
                            <input type="text" class="form-control" name="FlSedePropia" id="FlSedePropia" required="">
                          </div>

                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Empleados</label>
                            <input type="text" class="form-control" name="NuEmpleados" id="NuEmpleados" required="">
                          </div>

                          <div class="inputWithIcon form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Habitantes</label>
                            <input type="text" class="form-control" name="NuHabitantes" id="NuHabitantes" required="">
                          </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <button class="btn btn-primary" type="button" onclick="guardar();" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button> 
                             <button class="btn btn-primary" type="button" onclick="editar();" id="btnEditar"><i class="fa fa-save"></i> Editar</button>
                             <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<script src="js/oficina.js"></script>

<?php
}
?>
