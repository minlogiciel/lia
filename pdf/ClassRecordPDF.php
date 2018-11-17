<?php

class ClassRecordPDF extends FPDF {
	var	$title_h = 30;
	var	$col_w = 10;
	var	$left_w = 90;
	var	$center_w = 40;
	var	$right_w = 57;
	var	$angle;
	var	$_classes = 2;
	var	$_record_file = '';
	

	function Header()
	{
		//Logo
		$this->Image('../images/logo.gif',10,8,33);
		//Police Arial gras 15
		$this->SetFont('Arial','B',15);
		//Décalage à droite
		$this->Cell(60);
		//Titre
		$this->Cell(100, 10,'SCORES FOR CLASS ' .getClassName($this->_classes). ' STUDENTS','',0,'C');
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
	
	function getRecordFileName($classes, $subjects) {
		$this->_classes = $classes;
		$this->_record_file = getReportPath()."/" .$classes;
		if ($subjects) {
			$this->_record_file .= "_".$subjects;
		}
		$this->_record_file .= ".pdf";
		return $this->_record_file;
	}
	
	function createPage($students, $classscoreslist, $titles)
	{
		if( file_exists($this->_record_file)) {
			//return 0;
		}
		$max_show_nb = count($titles);
		$this->col_w = 187 / ($max_show_nb+1);
		$list_nb 		= 0;
	
		if ($classscoreslist ) {
			$list_nb = count($classscoreslist);
		}

		$titles = array();
		for ($i = 0; $i < $max_show_nb; $i++) {
			$titles[] = "";
		}
		$nb_table = $list_nb/$max_show_nb;
		$nn = 0;
		for ($nt = 0; $nt < $nb_table; $nt++) {
			$sliste = array();
			for ($i = 0; $i < $max_show_nb; $i++) {
				if ($nn  < $list_nb) {
					$scoreslist = $classscoreslist[$list_nb-$nn-1];
					$sliste[$i] = $scoreslist;
					
					$titles[$i] = getScoresTitleName($scoreslist);	
				}
				else {
					$sliste[$i] = array();
					$titles[$i] = ""; 
				}
				$nn++;
			}
				
			$this->Ln();
			$this->ScoresSubjectsTable($students, $sliste, $titles);
			$this->Ln();
		}
		
		return 1;
	}

	function ScoresSubjectsTable($students, $slists, $titles)
	{
		$show_cn = count($titles);
		//En-tête
		$this->SetFont('Arial','B',10);
		$this->Cell($this->col_w);
		$this->Rotate(270);
		$this->Cell($this->title_h, $this->col_w, 'STUDENT ID',  1, 0, 'C');
		$this->Rotate(0);
		for ($cn = 0; $cn < $show_cn; $cn++) { 
			$this->Cell($this->col_w-$this->title_h);
			$this->Rotate(270);
			$this->Cell($this->title_h, $this->col_w, $titles[$cn],  1,0,'C');
			$this->Rotate(0);
			//$this->Cell($this->col_w);
		}
		$this->Ln($this->title_h);
		
		$this->Rotate(0); 	

		//Données
		$rn = 0;
		$this->SetFont('Arial','',9);
		$firsttime = 1;
		foreach($students as $student)
		{
			$id 		= $student->getID();
			if ($firsttime) {
				$this->Cell($this->col_w, 6, '', 1,0,'C');
			
				for ($cn = 0; $cn < $show_cn; $cn++) {
					
					$sub = getScoresSubjectsName($slists[$cn]);
					$ty = getScoresTypeName($slists[$cn]);
					if ($sub && $ty) {
						$subjects = strtoupper($ty[0]. " " .$sub[0]);
					}
					else {
						$subjects = "";
					} 

					$this->SetTextColor(0,0,153);
					$this->Cell($this->col_w, 6, $subjects,  1, 0,'C');
					$this->SetTextColor(0,0,0);
				}
				$this->Ln();
				$firsttime = 0;
			}
			$this->SetTextColor(0,0,153);
			$this->Cell($this->col_w, 6, $id, 1,0,'C'); // use $id or $rn ??
			$this->SetTextColor(0,0,0);
			for ($cn = 0; $cn < $show_cn; $cn++) {
				
				$stscores = getSctudentScores($id, $slists[$cn]);
				$total = 0;
				if ($stscores) {
					$total = $stscores->getTotalScores();
				}
				if (!$total) {
					$total = "-";
				}
				$this->Cell($this->col_w, 6, $total,  1, 0,'C');
			}
			$this->Ln();
		}
		$this->SetTextColor(0,0,0);
		$sum = $this->left_w + $this->right_w + $this->center_w;
		$this->Cell($sum, 0,'','T');
		
		
	}

}

?>
