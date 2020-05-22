<!doctype html>
<html lang="en">
  <head>
	<title>PDF</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

  <?php
 ob_start();
	include 'plantilla.php';
	require '../../conexionDB/Conexion.php';
	
	function datos_oficina()
	{
	  $sql = 'SELECT  o.NmOficina,o.Direccion,o.Telefono,c.NmCiudad, o.FcApertura
	  FROM OFICINA1 o, CIUDAD c
	  WHERE c.IdCiudad=o.IdCiudad';
	  return ejecutarConsulta($sql);
	}

	// $query = "SELECT e.estado, m.id_municipio, m.municipio FROM t_municipio AS m INNER JOIN t_estado AS e ON m.id_estado=e.id_estado";
	// $resultado = $mysqli->query($query);
	
	$pdf = new PDF('P', 'mm', 'Letter');
	$pdf->SetMargins(25, 10 , 30);
	$pdf->SetAutoPageBreak(true,25); 
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	// echo "<br>";
	// echo "<br>";
	// $pdf->Ln();

	$pdf->SetFillColor(250,250,250);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(30,8,'OFICINA',1,0,'C',1);
	$pdf->Cell(30,8,'DIRECCION',1,0,'C',1);
	$pdf->Cell(30,8,'TELEFONO',1,0,'C',1);
	$pdf->Cell(30,8,'CIUDAD',1,0,'C',1);
	$pdf->Cell(37,8,'FECHA APERTURA',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);

	$informe= datos_oficina();
	while($row = sqlsrv_fetch_array($informe, SQLSRV_FETCH_ASSOC))
{
	$pdf->Cell(30,6,utf8_decode($row['NmOficina']),1,0,'C');
	$pdf->Cell(30,6,utf8_decode($row['Direccion']),1,0,'C');
	$pdf->Cell(30,6,utf8_decode($row['Telefono']),1,0,'C');
	$pdf->Cell(30,6,utf8_decode($row['NmCiudad']),1,0,'C');
	$fecha=$row['FcApertura'];
	$fecha=$fecha->format('d/m/Y');
	$row['FcApertura']=$fecha;
	$pdf->Cell(37,6,$row['FcApertura'],1,1,'C');
}
	$pdf->Output();
	ob_end_flush(); 
?>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>


