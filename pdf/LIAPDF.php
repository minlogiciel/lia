<?php


class LIAPDF extends FPDF {
	var	$LIALOGO = "../images/logo.gif";
	var	$TITLE_NAME = "STUDENT RECORD";
	var $TITLE 		= array(' ', 'DATE','SUBJECTS','TEACHER','TYPE','MATH','RD','WR','SCORE','AVG','LS','HS');
	var $TITLE_W 	= array(5,	 20,     20,        24,       20,     14,   14,  14,  14,     14,   14,  14);
	var	$col_w 		= 10;
	var	$left_w 	= 80;
	var	$center_w 	= 67;
	var	$right_w 	= 40;
	
	var	$_semester = '';
	var	$_annee = 0;
	var	$_record_file = '';
	
	function Header()
	{
		//Logo
		$this->Image($this->LIALOGO,10,8,33);
		//Police Arial gras 15
		$this->SetFont('Arial','B',15);
		//D�calage � droite
		$this->Cell(60);
		//Titre
		$this->Cell($this->center_w, 10, $this->TITLE_NAME,'',0,'C');
		//Saut de ligne
		//$this->Ln(20);
		$this->Ln();
	}
	
	//Pied de page
	function Footer()
	{
		//Positionnement � 1,5 cm du bas
		$this->SetY(-15);
		//Police Arial italique 8
		$this->SetFont('Arial','I',8);
		//Num�ro de page
		$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}

	function ReportTitle($student, $teacher, $classes, $subject, $stinfo)
	{
		$this->Ln();
		$studentid = $student->getID();
		if ($stinfo)
			$name = $student->getStudentName(). " ( Class : " .$classes. ", ID : ".$studentid. " )";
		else 
			$name = "( Class : " .$classes. " )";
		$sem_str = $this->_semester. ' ' .$this->_year;
		
		$this->SetFont('Arial','B',10);

		$this->Cell($this->left_w, 7, $name,  '',0,'L');
		if ($teacher)
			$this->Cell($this->center_w, 7, 	(' ' .$subject. ' Teacher : ' .$teacher),  '',0, 'L');
		else 
			$this->Cell($this->center_w, 7, 	'',  '',0,'L');
			
		$this->Cell($this->right_w , 7, 	$sem_str,  '',0, 'R');
		$this->Ln();
		$sum = $this->left_w + $this->right_w + $this->center_w;
		$this->Cell($sum,0,'','T');
		$this->Ln();
		$this->Cell($sum,5,'');
	}
	
	//Tableau simple
	function ReportTable($student, $slists)
	{
		$this->Ln();
		//En-t�te
		$this->SetFont('Arial','',9);
		for($i = 0; $i < count($this->TITLE); $i++) {
			$this->Cell($this->TITLE_W[$i], 7, $this->TITLE[$i], 1, 0, 'C');
		}
		$this->Ln();

		//Donn�es
		$rn = 1;
		$this->SetFont('Arial','',9);
		foreach($slists as $record)
		{
			$cn = 0;

			$total		= $record->getTotalScores() ;
			if ($total) {
				$dates		= $record->getDates();
				$semester	= $record->getSemester();
				$teacher	= $record->getTeacher();
				$titles		= $record->getTitles() ;
				$subjects	= $record->getSubjects();
				$types		= $record->getTypes() ;
				$math		= $record->getMathScores() ;
				$reading	= $record->getReadingScores() ;
				$writing	= $record->getWritingScores() ;
				$hscores	= $record->getHighScores() ;
				$lscores	= $record->getLowScores() ;
				$mscores	= $record->getMoyenScores() ;
				
				$this->Cell($this->TITLE_W[$cn++],6,$rn++,'LR',0,'C');
				$this->Cell($this->TITLE_W[$cn++],6,$dates,'LR',0,'C');
				$this->Cell($this->TITLE_W[$cn++],6,$subjects,'LR',0,'C');
				$this->Cell($this->TITLE_W[$cn++],6,$teacher,'LR',0,'C');
				$this->Cell($this->TITLE_W[$cn++],6,$types,'LR',0,'C');
				$this->Cell($this->TITLE_W[$cn++],6,$math,'LR',0,'C');
				$this->Cell($this->TITLE_W[$cn++],6,$reading,'LR',0,'C');
				$this->Cell($this->TITLE_W[$cn++],6,$writing,'LR',0,'C');
				$this->Cell($this->TITLE_W[$cn++],6,$total,'LR',0,'C');
				$this->Cell($this->TITLE_W[$cn++],6,$mscores,'LR',0,'C');
				$this->Cell($this->TITLE_W[$cn++],6,$lscores,'LR',0,'C');
				$this->Cell($this->TITLE_W[$cn++],6,$hscores,'LR',0,'C');
				$this->Ln();
			}
		}

		$this->Cell(array_sum($this->TITLE_W),0,'','T');
	}

	function ReportClassTable($students, $scoreslists, $studentid)
	{
		$total_nb 	= $this->_session_nb + $this->_test_nb;
		$test_nb 	= $this->_test_nb;
		$session_nb = $this->_session_nb;
		$page_nb = 1;
		if ($total_nb > 28) {
			$page_nb = 2;
			$total_nb = $total_nb / $page_nb;
			$session_nb = $this->_session_nb/$page_nb;
			$test_nb = $this->_test_nb / $page_nb;
		}
		
		$scoreslist_nb = count($scoreslists);
		if ($scoreslist_nb < $total_nb)
			$page_nb = 1;
			
		$this->col_w = 187 / ($total_nb+1);
		
		$hasnoname = '';
		
		for ($p = 0; $p < $page_nb; $p++) {
		
			$this->SetFont('Arial','B',10);
			$this->SetTextColor(0,0,0);
			//En-t�te	
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
			
			//Donn�es
			$this->SetFont('Arial','',9);
			for($ns = 0; $ns < count($students); $ns++)
			{
				$rn = $orderTable[$ns];
				if ($this->hasValideScores($reportTable[$rn]) == 0) {
					continue;
				}
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
