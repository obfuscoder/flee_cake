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
	$rows = 5;

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

	for ($i = 0; $i<count($items); $i++) {
		$number = sprintf("02%03d%02d8", $items[$i]["Item"]["seller_id"], $i);
		$tcpdf->Cell(0, 0, $items[$i]["Item"]["description"], 1, 1, 'L');

		$tcpdf->Cell($width*$leftColWidth, 0, "Kat.:", "L", 0, 'L');
		$tcpdf->Cell(0, 0, $items[$i]["Category"]["name"], "LR", 1, 'L');

		$tcpdf->Cell($width*$leftColWidth, 0, "Größe:", "L", 0, 'L');
		$tcpdf->Cell(0, 0, $items[$i]["Item"]["size"], "LR", 1, 'L');

		$tcpdf->SetFont($textfont,'',14);
		$tcpdf->Cell($width*$leftColWidth, 0, "Preis:", "LB", 0, 'L');
		$tcpdf->SetFont($textfont,'B',14);
		$tcpdf->Cell(0, 0, $this->Number->currency($items[$i]["Item"]["price"], "EUR"), "LRB", 1, 'L');
		$tcpdf->SetFont($textfont,'',10);

		$tcpdf->write1DBarcode($number, "C128", '', '', "", 18, 0.4, $style, 'N');

		$tcpdf->Ln();
	}

	echo $tcpdf->Output('floh.pdf', 'D');
?>