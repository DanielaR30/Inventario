    <?php
    require '../vista/header.php';
    ?>

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                  <div class="col-md-12">
                      <div class="box">
                        <div class="box-header with-border">

                        <form action="datosImport.php" method="POST" enctype="multipart/form-data">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <label for="">Importar Excel</label>
                              <input type="file" class="form-control" name="controlador" id="filename" aria-describedby="helpId" placeholder="">
                              <small id="helpId" class="form-text text-muted"></small>
                            </div>
                            <br><br>
                            <button type="submit" id="submit" name="submit">Importar</button>
                        </form>
              
                        </div>
                      </div><!-- /.box -->
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </section><!-- /.content -->

        </div><!-- /.content-wrapper -->

        
    <?php
    require '../vista/footer.php';
    ?>









