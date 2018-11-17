<?php

class StudentReportPDF extends FPDF {
	var	$title_h = 30;
	var	$col_w = 10;
	var	$left_w = 80;
	var	$center_w = 67;
	var	$right_w = 40;
	
	var	$_report_file 	= '';
	var	$_semester 		= '';
	var	$_annee 		= '';
	var	$_subjects 		= '';
	

	function Header()
	{
		//Logo
		$this->Image('../images/logo.gif',10,8,33);
		//Police Arial gras 15
		$this->SetFont('Arial','B',15);
		//Décalage à droite
		$this->Cell(60);
		//Titre
		$this->Cell($this->center_w, 10, strtoupper($this->_subjects). " REPORT CARD",'',0,'C');
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

	function Rotate($angle,$x=-1,$y=-1) { 

        if($x==-1) 
            $x=$this->x; 
        if($y==-1) 
            $y=$this->y; 
        if($this->angle!=0) 
            $this->_out('Q'); 
        $this->angle=$angle; 
        if($angle!=0) 

        { 
            $angle*=M_PI/180; 
            $c=cos($angle); 
            $s=sin($angle); 
            $cx=$x*$this->k; 
            $cy=($this->h-$y)*$this->k; 
             
            $this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy)); 
        } 
    } 
	
	function getReportFileName($studentid, $semester, $annee, $subjects, $classes) {
		$this->_semester = $semester;
		$this->_annee = $annee;
		$this->_subjects = $subjects;
		$this->_report_file = getReportPath($semester, $annee)."/".$classes;
		if ($subjects) {
			$this->_report_file .= $subjects. "_";
		}
		$this->_report_file .= $studentid. "_" .$semester. "_" .$annee. ".pdf";
		return $this->_report_file;
	}
	
	function createPage($students, $slists, $student, $classes, $teacher, $all_nb, $all_test_nb)
	{
		if( file_exists($this->_report_file)) {
			//return 0;
		}
		$this->Ln();
		$this->ReportTitle($student, $teacher, $classes);
		$this->Ln();
		$this->ReportTable($students, $slists, $all_nb, $all_test_nb, $student->getID());
		return 1;
	}

	function ReportTitle($student, $teacher, $classes)
	{
		$studentid = $student->getID();
		if (isNoNameStudent($student)) {
			$name = $student->getFirstName(). " ( Class : " .$classes. " )";
		}
		else {
			$name = $student->getStudentName(). " ( Class : " .$classes. ", ID : ".$studentid. " )";
		}
		$sem_str = $this->_semester. ' ' .$this->_annee;
		
		$this->SetFont('Arial','B',10);

		$this->Cell($this->left_w, 7, $name,  '',0,'L');
		if ($teacher)
			$this->Cell($this->center_w, 7, 	(' Teacher : ' .$teacher),  '',0, 'L');
		else 
			$this->Cell($this->center_w, 7, 	'',  '',0,'L');
			
		$this->Cell($this->right_w , 7, 	$sem_str,  '',0, 'R');
		$this->Ln();
		$sum = $this->left_w + $this->right_w + $this->center_w;
		$this->Cell($sum,0,'','T');
		$this->Ln();
		$this->Cell($sum,5,'');
	}
	
	function ReportTable($students, $scoreslists, $all_nb, $all_test_nb, $studentid)
	{
		$total_nb 	= $all_nb;
		$session_nb = $all_nb - $all_test_nb;
		$test_nb = $all_test_nb;
		$page_nb = 1;
		if ($all_nb > 28) {
			$page_nb = 2;
			$total_nb = $total_nb / $page_nb;
			$session_nb = $session_nb/$page_nb;
			$test_nb = $all_test_nb / $page_nb;
		}
		
		$scoreslist_nb = count($scoreslists);

		$this->col_w = 187 / ($total_nb+1);
		
		$hasnoname = '';
		
		for ($p = 0; $p < $page_nb; $p++) {
		
			$this->SetFont('Arial','B',10);
			$this->SetTextColor(0,0,0);
			//En-tête	
			$this->Cell($this->col_w, 21, 'ID',  1, 0, 'C');
			
			$this->Cell(($this->col_w*$session_nb), 7, 'Homework',  1, 0, 'C');
			$this->Cell(($this->col_w*$test_nb), 7, 'Test',  1, 0, 'C');
			$this->Ln();
			$this->Cell($this->col_w, 0, '',  '', 0, 'C');
			for ($cn = 0; $cn < $session_nb; $cn++) { 
				$this->Cell($this->col_w, 7, ($cn+1+$p*$session_nb),  1,0,'C');
			}
	
			for ($cn = 1; $cn < $test_nb; $cn++) { 
				$this->Cell($this->col_w, 7, $cn + $p*$test_nb,  1, 0,'C');
			}
			if ($page_nb == 1 || $p == 1)
				$this->Cell($this->col_w, 7, "FE",  1,0,'C');
			else 
				$this->Cell($this->col_w, 7, $test_nb,  1,0,'C');
			$this->Ln();
			
			$reportTable = getStudentSubjectsReportTable($students, $scoreslists, $total_nb, $test_nb, $p);
			$reportTitle = $reportTable[count($reportTable)-1];
			$reportMoyen = $reportTable[count($reportTable)-2];
			$orderTable = $reportTable[count($reportTable)-3];
			
			$this->SetFont('Arial','',8);
			$this->Cell($this->col_w, 0, '',  '', 0, 'C');
			for ($cn = 0; $cn < $total_nb; $cn++) { 
				$this->Cell($this->col_w, 7, $reportTitle[$cn],  1, 0,'C');
			}
			
			$this->Ln();
			$this->SetFont('Arial','B',10);
			$this->SetTextColor(0,0,144);
			$this->Cell($this->col_w, 7, 'AVG',  1, 0, 'C');
			for ($cn = 0; $cn < $total_nb; $cn++) { 
				$this->Cell($this->col_w, 7, $reportMoyen[$cn],  1, 0,'C');
			}
			$this->Ln();
			
			//Données
			$this->SetFont('Arial','',9);
			for($ns = 0; $ns < count($students); $ns++)
			{
				$rn = $orderTable[$ns];
				$st = $students[$rn];
				$id 		= $st->getID();
				$showid = getStudentShowID($st);
				$r = 0;
				$g = 0;
				$b = 0;
				if ($id == $studentid) {
					$r = 255;
				}

				if ($showid == "**") {
					$hasnoname = $showid;
					$this->SetTextColor(255, 128, 0);
				}
				else {
					$this->SetTextColor($r, $g, $b);
				}
				
				$this->Cell($this->col_w, 6, $showid, 1,0,'C'); 
				$this->SetTextColor($r, $g, $b);
				for ($cn = 0; $cn < $total_nb; $cn++) {
					$stscores = $reportTable[$rn][$cn];
					$total = 0;
					$setHigh = 0;
					if ($stscores) {
						$total = $stscores->getTotalScores();
						if ($total == $stscores->getHighScores()) {
							/* set highist scores color */
							//$this->SetTextColor(0,0,255);
							$setHigh = 1;
						}
					}
					if (!$total) {
						$total = "-";
					}
					$this->Cell($this->col_w, 6, $total,  1, 0,'C');
					if ($setHigh) {
						/* back norm color */
						//$this->SetTextColor($r, $g, $b);
					}
				}
				$this->Ln();
			}
			$this->Ln(5);
		}
		if ($hasnoname) {
			$this->SetFont('Arial','I',10); 
			$this->SetTextColor(255, 128, 0);
			$this->Cell($this->col_w, 6, $hasnoname, '',0,'R'); 
			$this->SetTextColor(0,0,0);
			$this->Cell(100, 6, " " .getStudentNoNameNote(), '',0,'L'); 
			$this->Ln();
		}
		
		$this->SetTextColor(0,0,0);
	}
	
}

?>
