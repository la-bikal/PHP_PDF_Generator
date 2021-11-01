<?php

	require('./fpdf.php');
    
    $img = $_POST['image'];
    $name = $_POST['name'];
    $vID = $_POST['vID'];
    $age = $_POST['age'];
    $dept = $_POST['dept'];

    $folderPath = "upload/";
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.jpg';
  
    // $file = $folderPath . $fileName;
    // file_put_contents($file, $image_base64);

    $pdf = new FPDF();
  
	//Add a new page
	$pdf->AddPage();	  

	$pdf->Image($file, 80,10,50,50);
	  
	// return the generated output

	// Set the font for the text
	$pdf->SetFont('Arial', 'B', 18);
	  
	// Prints a cell with given text 
	$pdf->Cell(60,20, '', 0, 1);
	$pdf->Cell(60,20, '', 0, 1);
	$pdf->Cell(60,20, '', 0, 1);

	$pdf->Cell(50,20, 'Name ', 1, 0, 'C');
	$pdf->Cell(130,20, $name, 1, 1, 'C');

	$pdf->Cell(50,20, 'Villanova ID ', 1, 0, 'C');
	$pdf->Cell(130,20, $vID, 1, 1, 'C');

	$pdf->Cell(50,20, 'Age ', 1, 0, 'C');
	$pdf->Cell(130,20, $age, 1, 1, 'C');

	$pdf->Cell(50,20, 'Department ', 1, 0, 'C');
	$pdf->Cell(130,20, $dept, 1, 1, 'C');
	

	$pdf->Output();

  
?>