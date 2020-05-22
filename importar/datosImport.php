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
 require '../vista/header.php';
?>
<!-- date_default_timezone_set('America/Bogota'); -->

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
            require '../conexionDB/Conexion.php';


            $inputfilename = $_FILES['controlador']['tmp_name'];
            $exceldata = array();
            $conexion = sqlsrv_connect($serverName, $connectionInfo);

            if (isset($_POST['submit'])) {
              if (!$conexion) {
                die("Connection failed:" . sqlsrv_errors());
              }
            }

            try {
              $inputfiletype = PHPExcel_IOFactory::identify($inputfilename);
              $objReader = PHPExcel_IOFactory::createReader($inputfiletype);
              $objPHPExcel = $objReader->load($inputfilename);
            } catch (Exception $e) {
              die('Error loading file "' .pathinfo($inputfilename, PATHINFO_BASENAME). '": ' . $e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();


            for ($row = 2; $row <= $highestRow; $row++) {

              $rowData = $sheet->rangeToArray('A' . $row . ':' .  $highestColumn . $row, NULL, TRUE, FALSE);

              $timestamp = PHPExcel_Shared_Date::ExcelToPHP($rowData[0][4]);
              (isset($rowData[0][4])) ? $rowData[0][4] = date("Y-m-d",$timestamp) : "";

//
              $fingreso = date('d-m-Y H:i:s', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][5]));
              $fechaI = new DateTime($fingreso);
              $fechaI->modify('-2 hours');
              $rowData[0][5] = $fechaI->format('d-m-Y H:i:s');

              (isset($rowData[0][6])) ? $rowData[0][6] = number_format($rowData[0][6]) : "";
              // echo 'COP: ', $formatter->formatCurrency($rowData[0][6], 'COP'), PHP_EOL;
              // echo number_format("1000000",2) pruebe
              $sql = "INSERT INTO CARGUE_DATOS (idRegistro,identificacion,apellidos,nombres,fcNacimiento,fcIngreso,valor,observaciones)
                VALUES ('" . $rowData[0][0] . "',
                        '" . $rowData[0][1] . "',
                        '" . $rowData[0][2] . "',
                        '" . $rowData[0][3] . "',
                        '" . $rowData[0][4] . "',
                        '" . $rowData[0][5] . "',
                        '" . $rowData[0][6] . "',
                        '" . $rowData[0][7] . "')";

              $exceldata[] = $rowData[0];
              ejecutarConsulta($sql);
            }
            echo '<table class="table table-bordered table-striped"><thead class="thead-dark thead-dark"><tr><th>ID</th><th>IDENTIFICACIÓN</th><th>APELLIDO</th><th>NOMBRE</th><th>FECHA DE NACIMIENTO</th><th>FECHA DE INGRESO</th><th>VALOR</th><th>OBSERVACIONES</th></tr></thead>';
            foreach ($exceldata as $index => $excelraw) {
              echo "<tr>";
              foreach ($excelraw as $excelcolumn) {
                echo "<td>" . $excelcolumn . "</td>";
              }
              echo "</tr>";
            }
            echo "</table>";
            sqlsrv_close($conexion);

            ?>


          </div>
          <!-- /.box-header -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php
require '../vista/footer.php';
?>

<?php
}
?>