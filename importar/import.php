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

    <?php

      require '../public/Classes/PHPExcel/IOFactory.php';
      require '../public/Classes/PHPExcel.php';
      
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "cursoalumnodb";

      $inputfilename = $_FILES['controlador']['tmp_name'];

      $exceldata = array();

      $conn = mysqli_connect($servername, $username, $password, $dbname);

      if (isset($_POST['submit']))
      {

      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      }

      try
      {
      $inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
      $objReader = PHPExcel_IOFactory::createReader($inputfiletype);
      $objPHPExcel = $objReader->load($inputfilename);
      }
      catch(Exception $e)
      {
      die('Error loading file "'.pathinfo($inputfilename,PATHINFO_BASENAME).'": '.$e->getMessage());
      }

      $sheet = $objPHPExcel->getSheet(0);
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();



      for ($row = 2; $row <= $highestRow; $row++)
      {
      $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
      $sql = "INSERT INTO alumno (iddistrito, nombre, apellido)
        VALUES ('".$rowData[0][0]."', '".$rowData[0][1]."', '".$rowData[0][2]."')";

        if (mysqli_query($conn, $sql)) {
        $exceldata[] = $rowData[0];
        }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
            
      
      echo '<table  class="table table-bordered table-striped" ><thead class="thead-dark thead-dark"><tr><th>Distrito</th><th>Nombre</th><th>Apellido</th></tr></thead>';
      foreach ($exceldata as $index => $excelraw) 
      {
      echo "<tr>";
      foreach ($excelraw as $excelcolumn) {
        echo "<td>".$excelcolumn."</td>";
      }
      echo "</tr>";
      }
      echo "</table>";

        mysqli_close($conn);

      ?>


      <a class="btn btn-danger" href="../vista/alumno.php" role="button"><i class="fa fa-arrow-circle-left"></i>Listar</a>
                            
                        </div><!-- /.box-header -->
                      </div><!-- /.box -->
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </section><!-- /.content -->

        </div><!-- /.content-wrapper -->

    <?php
    require '../vista/footer.php';
    ?>









