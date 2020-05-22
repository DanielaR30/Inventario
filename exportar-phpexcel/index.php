<?php 
// require_once 'functions/conexion.php';
require_once '../conexionDB/Conexion.php';
require_once 'functions/datos_oficina.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Exportar informe Excel</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <div class="page-header text-left">
    <h1>Exportar informe <small>PHPExcel</small></h1>
  </div>
  <a href="createExcel.php" target="_blank">Descargar informe en excel</a>
  <div class="row">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Oficina</th>
          <th>Dirección</th>
          <th>Teléfono</th>
          <th>Ciudad</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      $informe = datos_oficina();
      // while($row = $informe->fetch_array(MYSQLI_ASSOC))
      while($row = sqlsrv_fetch_array($informe, SQLSRV_FETCH_ASSOC))
      {
        echo '<tr>';
        echo "<td>$row[NmOficina]</td>";
        echo "<td>$row[Direccion]</td>";
        echo "<td>$row[Telefono]</td>";
        echo "<td>$row[IdCiudad]</td>";
        echo '</tr>';
      }
      ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>