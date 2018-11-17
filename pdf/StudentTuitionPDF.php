<?php

class StudentTuitionPDF extends FPDF {
	var	$left_offset = 30;
	var	$left_w = 80;
	var	$right_w = 107;
	
	var	$_report_file 	= '';
	var	$_semester 		= '';
	var	$_annee 		= '';
	

	function Header()
	{
		//Logo
		$this->Image('../images/logo.gif',10,8,33);
		//Police Arial gras 15
		$this->SetFont('Arial','B',15);
		//Décalage à droite
		$this->Cell($this->left_w-50);
		//Titre
		$this->Cell($this->right_w, 10,'STUDENT TUITION BILL','',0,'C');
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

	
	function getBillingFileName($studentid, $semester, $annee) {
		$this->_semester 	= $semester;
		$this->_annee 		= $annee;
		$this->_report_file = getReportPath($semester, $annee)."/student_billing_".$studentid. ".pdf";
		return $this->_report_file;
	}
	
	function createPage($student, $tuitionlists)
	{
		if( file_exists($this->_report_file)) {
			//return 0;
		}
		$this->Ln();
		$this->BillingTitle($student);
		$this->Ln();
		$this->TuitionBilling($student, $tuitionlists);
		return 1;
	}

	function BillingTitle($student)
	{
		$name = "(Class : " .$student->getClasses(). " ID : " .$student->getID(). ")";
		
		$this->SetFont('Arial','B',12);

		$this->Cell($this->left_offset, 10, $name,  	'',0,'L');
		$this->Ln();
		$this->Cell($this->left_offset, 10,'',  	'',0,'L');
		$this->Ln();
		$this->Cell($this->left_offset, 10, getTodayString(),  '',0,'L');
		$this->Ln(20);
	}
	
	function TuitionBilling($student, $tuitionClass)
	{

		$otherfee = 0;
		$otherfee_str = "";
		$tuition = $tuitionClass->getTuition();
		$v = $tuitionClass->getBuses();
		if ($v > 0) {
			$otherfee += $v;
			$otherfee_str .= "Bus";
		}
		$v = $tuitionClass->getBooks();
		if ($v > 0) {
			$otherfee += $v;
			if (strlen($otherfee_str) > 0)
				$otherfee_str .= ", ";
			$otherfee_str .= "Book";
		}
		
		$v = $tuitionClass->getTennis();
		if ($v > 0) {
			$otherfee += $v;
			if (strlen($otherfee_str) > 0)
				$otherfee_str .= ", ";
			$otherfee_str .= "Tennis";
		}
		
		$v = $tuitionClass->getOthers();
		if ($v > 0) {
			$otherfee += $v;
			if (strlen($otherfee_str) > 0)
				$otherfee_str .= ", ";
			$otherfee_str .= "Others";
		}
		
		$balance_f = $tuitionClass->getBalanceF();
		$balance_f_s = $tuitionClass->getBalanceFSemester();
		$paid = $tuitionClass->getPaid();
	
		$total = $otherfee + $tuition;
		$balance = $total - $paid;
				
		//Données
		$this->SetFont('Arial','',12);

		
		$this->Cell($this->left_w, 10, "Balance Forwarded : ",  '', 0,'R');
		$this->Cell($this->left_w, 10, getPrice($balance_f). "  (" .$balance_f_s. ")",  '', 0,'L');
		$this->Ln(10);
		
		$this->Cell($this->left_w, 10, "Period : ",  '', 0,'R');
		$this->Cell($this->left_w, 10, getSemesterPeriod($this->_semester, $this->_annee),  '', 0,'L');
		$this->Ln(10);
		
		$this->Cell($this->left_w, 10, "Tuition : ",  '', 0,'R');
		$this->Cell($this->left_w, 10, getPrice($tuition),  '', 0,'L');
		$this->Ln(10);

		$this->Cell($this->left_w, 10, "Other Fee : ",  '', 0,'R');
		if ($otherfee > 0) {
			$this->Cell($this->left_w, 10, (getPrice($otherfee). " ( " .$otherfee_str. " )"),  '', 0,'L');
		}
		$this->Ln(10);

		$this->Cell($this->left_w, 10, "Total : ",  '', 0,'R');
		$this->Cell($this->left_w, 10, getPrice($total),  '', 0,'L');
		$this->Ln(10);

		$this->Cell($this->left_w, 10, "Amount paid : ",  '', 0,'R');
		$this->Cell($this->left_w, 10, getPrice($paid),  '', 0,'L');
		$this->Ln(10);

		$this->Cell($this->left_w, 10, "Balance : ",  '', 0,'R');
		$this->Cell($this->left_w, 10, getPrice($balance),  '', 0,'L');
		$this->Ln(30);
		$this->SetFont('Arial','I',12); 
		$this->Cell($this->left_w+$this->right_w, 10, "Please make check payable to L.I.A. and mail it to : ",  '', 0, 'C');
		$this->Ln();
		$this->SetFont('Arial','',12);
		$this->Cell($this->left_w+$this->right_w, 8, "L.I.A",  '', 0, 'C');
		$this->Ln();
		$this->Cell($this->left_w+$this->right_w, 8, "303 Sunnyside Blvd. Suite 10,",  '', 0, 'C');
		$this->Ln();
		$this->Cell($this->left_w+$this->right_w, 8, "Plainview, NY 11803",  '', 0, 'C');
		$this->Ln();
	}

}

?>
