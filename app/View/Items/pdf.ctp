<?php
	App::import('Vendor','xtcpdf');
	App::import('Vendor','tcpdf/tcpdf_barcodes_1d');

	$tcpdf = new XTCPDF();
	$textfont = 'helvetica';

	$tcpdf->SetAuthor("Flohmarkt Koenigsbach");
	$tcpdf->SetAutoPageBreak(true);

	// add a page (required with recent versions of tcpdf)
	$tcpdf->SetPrintHeader(false);
	$tcpdf->SetPrintFooter(false);
	$tcpdf->AddPage();

	// Now you position and print your page content
	// example:
	$tcpdf->SetTextColor(0, 0, 0);
	$tcpdf->SetFont($textfont,'',10);
	$index = 0;
	$cols = 3;
	$rows = 6;

	// define barcode style
	$style = array(
	    'position' => '',
	    'align' => 'C',
	    'stretch' => false,
	    'fitwidth' => false,
	    'cellfitalign' => 'C',
	    'border' => true,
	    'hpadding' => 'auto',
	    'vpadding' => 'auto',
	    'fgcolor' => array(0,0,0),
	    'bgcolor' => false, //array(255,255,255),
	    'text' => true,
	    'font' => 'helvetica',
	    'fontsize' => 8,
	    'stretchtext' => 4
	);

	$tcpdf->setEqualColumns($cols);
	$margins = $tcpdf->getMargins();
	$width = ($tcpdf->getPageWidth()-$margins['left']-$margins['right']);
	$height = ($tcpdf->getPageHeight()-$margins['top']-$margins['bottom'])/$rows*0.96;

	$leftColWidth = 0.23;

	for ($i = 0; $i<count($reservation["Item"]); $i++) {
		$category = $categories[$reservation["Item"][$i]["category_id"]];
		$tcpdf->SetFont($textfont,'',14);
		$tcpdf->Cell($width/3, 0,
			$reservation["Reservation"]["number"] . "-" . $reservation["Item"][$i]["ReservedItem"]["number"],
			"LTB", 0, 'C');
		$tcpdf->SetFont($textfont,'',10);
		$tcpdf->Cell(0, $tcpdf->getLastH(), $category, 1, 1, 'C');
		$tcpdf->Cell(0, 0, $reservation["Item"][$i]["description"], 1, 1, 'C');

		$tcpdf->Cell(0, 0, ($reservation["Item"][$i]["size"] == null) ? "" : ("Größe: " . $reservation["Item"][$i]["size"]), 1, 1, 'C');

		$tcpdf->SetFont($textfont,'',20);
		$tcpdf->Cell(0, 0, $this->Number->currency($reservation["Item"][$i]["price"], "EUR"), 1, 1, 'C');
		$tcpdf->SetFont($textfont,'',10);

		$tcpdf->write1DBarcode($reservation["Item"][$i]["ReservedItem"]["code"], "C128", '', '', "", 18, 0.4, $style, 'N');

		$tcpdf->Ln();
		if ($i%$rows == ($rows-1)) {
			$tcpdf->Ln();
			$tcpdf->Ln();
		}
	}

	echo $tcpdf->Output('floh.pdf', 'D');
?>