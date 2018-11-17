<?php


class StudentRecordPDF extends FPDF {
	var $TITLE = array(' ', 'DATE','SUBJECTS','TEACHER','TYPE','MATH','RD','WR','SCORE','AVG','LS','HS');
	var $TITLE_W = array(5,20,20,24,20, 14,14,14,14,14,14,14);
	var	$right_w = 57;
	var	$left_w = 130;

	var	$_student_id = 0;
	var	$_semester = '';
	var	$_annee = 0;
	var	$_record_file = '';
	
	function Header()
	{
		//Logo
		$this->Image('../images/logo.gif',10,8,33);
		//Police Arial gras 15
		$this->SetFont('Arial','B',15);
		//Décalage à droite
		$this->Cell(70);
		//Titre
		$this->Cell(50, 10, "STUDENT RECORD",'',0,'C');
		//Saut de ligne
		//$this->Ln(20);
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
	
	function getRecordFileName($studentid, $semester, $annee) {
		$this->_student_id = $studentid;
		$this->_semester = $semester;
		$this->_annee = $annee;
		$this->_record_file = getReportPath($semester, $annee)."/student_scores_" .$studentid;
		$this->_record_file .= ".pdf";
		return $this->_record_file;
	}

	function createPage($studentid, $student, $slists)
	{
		if( file_exists($this->_record_file)) {
			//return 0;
		}
		$this->Ln();
		$this->RecordStudent($student);
		$this->Ln();
		$this->RecordTable($slists);
		return 1;
	}

	function RecordStudent($student)
	{
		
		$name = "";
		if ($student) {
			$name = $student->getStudentName(). " ( Class : " .$student->getClasses(). ", Student ID : ".$student->getID(). " )";
			$period = $this->_semester. '-' .$this->_annee;
		}


		$this->SetFont('Arial','B',10);

		$this->Cell($this->left_w, 7, $name,  '',0,'L');
		$this->Cell($this->right_w, 7, $period,  '',0,'R');
		$this->Ln();
		$this->Cell(($this->left_w+$this->right_w),0,'','T');
		$this->Ln();
		$this->Cell(($this->left_w+$this->right_w),5,'');
	}
	
	//Tableau simple
	function RecordTable($slists)
	{
		//En-tête
		$this->SetFont('Arial','',9);
		for($i = 0; $i < count($this->TITLE); $i++) {
			$this->Cell($this->TITLE_W[$i], 7, $this->TITLE[$i], 1, 0, 'C');
		}
		$this->Ln();

		//Données
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

}

?>
