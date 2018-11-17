<?php

class ClassRecordPSATPDF extends FPDF {
	var	$record_w = 15;
	var	$student_w = 22;
	var	$number_w = 8;

	var	$_classes = '';
	var	$_record_file = '';
	

	function Header()
	{
		//Logo
		$this->Image('../images/logo.gif',10,8,33);
		//Police Arial gras 15
		$this->SetFont('Arial','B',15);
		//Décalage à droite
		$this->Cell(100);
		//Titre
		$this->Cell(100, 10,'THE LAST RECORES FOR CLASS ' .getClassName($this->_classes). ' STUDENTS','',0,'C');
		//Saut de ligne
		$this->Ln();
	}

	//Pied de page
	function Footer()
	{
		//Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		//Police Arial italique 8
		$this->SetFont('Arial','I',8);
		//Numéro de page
		$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}
	
	function getRecordFileName($classes, $subjects) {
		$this->_classes = $classes;
		
		$this->_record_file = getReportPath()."/" .$classes;
		if ($subjects) {
			$this->_record_file .= "_".$subjects;
		}
		$this->_record_file .= ".pdf";
		return $this->_record_file;
	}
		
	function createPage($students, $slists, $titles)
	{
		if( file_exists($this->_record_file)) {
			//return 0;
		}
		$show_cn = count($titles);
		$this->Ln();
		$this->ScoresTableTitle($titles, $show_cn);
		$this->Ln();
		$this->ScoresTable($students, $slists, $show_cn);
		return 1;
	}

	function ScoresTableTitle($titles, $show_cn)
	{
		//En-tête
		$this->SetFont('Arial','B',10);
		$this->Cell($this->record_w*2, 7, 'STUDENT',  1,0,'C');
		$col_w_4 = $this->record_w*4;
		for ($cn = 0; $cn < $show_cn; $cn++) { 
			$this->Cell($col_w_4, 7, $titles[$cn],  1,0,'C');
		}
		$this->Ln();

		$this->Cell($this->number_w, 7, ' ',  1, 0,'C');
		$this->Cell($this->student_w, 7, 'ID',  1, 0,'C');
		for ($cn = 0; $cn < $show_cn; $cn++) { 
			$this->Cell($this->record_w, 7, 'M',  1,0,'C');
			$this->Cell($this->record_w, 7, 'R',  1,0,'C');
			$this->Cell($this->record_w, 7, 'W',  1,0,'C');
			$this->Cell($this->record_w, 7, 'T',  1,0,'C');
		}
	}
	
	function ScoresTable($students, $slists, $show_cn)
	{
		//Données
		$rn = 0;
		$n_test = 0;
		if ($slists) {
			$n_test = count($slists);
		}
		if ($n_test > $show_cn) {
			$n_test = $show_cn;
		}
		$this->SetFont('Arial','',9);
		
		foreach($students as $student)
		{
			$rn++;
			$id 		= $student->getID();
			$this->Cell($this->number_w, 6, $rn,'LR',0,'C');
			$this->Cell($this->student_w, 6, $id,'LR',0,'C');
			
			for ($cn = 0; $cn < $show_cn; $cn++) {
				if ($cn < $n_test) {
					$scoreslists = $slists[$n_test-$cn-1];
					$stscores = getSctudentScores($id, $scoreslists);
				}
				else {
					$stscores = 0;
				}
				$total = 0;
				if ($stscores) {
					$math = $stscores->getMathScores();
					$reading = $stscores->getReadingScores();
					$writing = $stscores->getWritingScores();
					$total = $stscores->getTotalScores();
					if ($math == 0)
						$math = "-";
					if ($reading == 0)
						$reading = "-";
					if ($writing == 0)
						$writing = "-";
				}
				if (!$total ) {
					$total = "-";
					$math = "-";
					$reading = "-";
					$writing = "-";
				}
				$this->Cell($this->record_w, 6, $math,  'LR',0,'C');
				$this->Cell($this->record_w, 6, $reading,  'LR',0,'C');
				$this->Cell($this->record_w, 6, $writing,  'LR',0,'C');
				$this->Cell($this->record_w, 6, $total,  'LR',0,'C');
			}
			$this->Ln();
		}
		$sum = $this->record_w * ($show_cn * 4+2);
		$this->Cell($sum, 0,'','T');
	}

}

?>
