<?php
	
	require 'fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{
			// // Logo
			// $image_file = K_PATH_IMAGES.'lg.jpg';
			// $this->Image($image_file, 15, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			// // Set font
			// $this->SetFont('times', 'B', 20);
			// // Title
			// $this->Cell(120, 10, 'Reporte Oficina ', 0, false, 'C', 0, '', 0, false, 'M', 'M');

			$this->Image('images/lg.png', 25, 10, 25 );
			$this->SetFont('times','B',20);
			$this->Cell(30);
			$this->Cell(95, 20, 'REPORTE OFICINA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
			$this->Ln(28);
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>