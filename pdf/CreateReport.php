<?php

class CreateReport {
	
	var $_semester 		= "Fall";
	var $_year 			= 2011;
	var $_session_nb 	= 12;
	var $_test_nb 		= 3;
	var $_title			= array();
	var $_memberList;
	var $_report_file	= "";
	var $_report_class	= "";
	
function init($semester, $year) {
	$this->_memberList = new MemberList();
	$this->_semester = getSemesterByString($semester);
	$this->_year = getYearByString($year);
	if ($this->_semester == "Spring") {
		$this->_session_nb = 18;
		$this->_test_nb = 3;
	}
	else if ($this->_semester == "Summer") {
		$this->_session_nb = 28;
		$this->_test_nb = 6;
	}
	else {
		$this->_session_nb = 12;
		$this->_test_nb = 3;
	}
	$this->_title = array();
	for ($i = 1; $i <= $this->_session_nb; $i++) {
		$this->_titles[] = "HW " .$i;
	}
	for ($i = 1; $i < $this->_test_nb; $i++) {
		$this->_titles[] = "TEST " .$i;
	}
	$this->_titles[] = "Final Exam";

	$this->_report_file = $this->ReportFileName();

}

function setClassReportFileName($classname) {
	$this->_report_class = $classname;
	$this->_report_file = $this->ReportFileName();
}

function setClassReportFileNameClass($classname) {
	$this->_report_class = $classname;
	$this->_report_file = $this->ReportFileName("", 1);
}

function ReportFileName($student='', $num=0) {
	
	$path = getReportPath($this->_semester ,$this->_year);
	$filename = $path. "/student_report_".$this->_semester. "_" .$this->_year;
	if ($student) {
		$filename .= "_" .$student->getID();
	}
	else {
		if ($this->_report_class) {
			$filename = $path. "/".$this->_report_class."_Students_Report_".$this->_semester. "_" .$this->_year;
		}
		$filename .= date("_m_d");
		if ($num) {
			//$filename .= "_class";
		}
	}
	$filename .= ".pdf";
	return $filename;
}

function createStudentReportById($studentid) 
{
	$student = new StudentClass();
	$student->getUserByID($studentid);
	$this->createStudentReport($student);
}

function createStudentReport($student) 
{
		
	$filename = $this->ReportFileName($student);

	/* create report pdf */
	$pdf = new ReportPDF();
	/* should call first */
	$pdf->init($this->_semester, $this->_year, $this->_session_nb, $this->_test_nb);

	$this->createStudentReportPage($student, $pdf, "");

	$pdf->Output($filename);
	
	return $filename;
	
}

function createStudentClassReport($student) 
{
	$classname = $student->getClasses();
	$class_nb = getClassNumber($classname);

	for ($nc = 1; $nc <= $class_nb; $nc++) {
		$classes = getClassElementName($classname, $nc);
		$this->setClassReportFileNameClass($classes);
		$filename = $this->_report_file;
		
		if (file_exists($filename)) {
		}
		else {
			/* create report pdf */
			$pdf = new ReportPDF();
			/* should call first */
			$pdf->init($this->_semester, $this->_year, $this->_session_nb, $this->_test_nb);

			$subs = getClassReportSubject($classes);
			for ($i = 0; $i < count($subs); $i++) {
				$studentlists 	= $this->_memberList->getStudentLists($classes, 0);
				$subject = $subs[$i];
				$scoreslists 	= $this->_memberList->getClassStudentScoresLists($classes, $subject, $this->_semester, $this->_year);
	
				if (count($scoreslists) > 0) {
					$teacher = getSubjectsTeacherName($scoreslists);
					$pdf->AddPage();
					$pdf->createPage($studentlists, $scoreslists, $student, $classes, $teacher, $subject, 0);
				} 
			}
			$pdf->Output($filename);
		}
	}
}

function createStudentReportPage($student, $pdf, $clname) 
{
		
	$classname = $student->getClasses();
	$class_nb = getClassNumber($classname);

	for ($nc = 1; $nc <= $class_nb; $nc++) {
		$classes = getClassElementName($classname, $nc);
		if (!$clname || $clname == $classes) {
			$subs = getClassReportSubject($classes);
			for ($i = 0; $i < count($subs); $i++) {
				$studentlists 	= $this->_memberList->getStudentLists($classes, 0);
				$subject = $subs[$i];
				$scoreslists 	= $this->_memberList->getClassStudentScoresLists($classes, $subject, $this->_semester, $this->_year);
	
				if (count($scoreslists) > 0) {
					$teacher = getSubjectsTeacherName($scoreslists);
					$pdf->AddPage();
					$pdf->createPage($studentlists, $scoreslists, $student, $classes, $teacher, $subject, 1);
				} 
			}
		}
	}
}

function getCreateReportFile($semester, $year) {
	$this->init($semester, $year);
	if (file_exists($this->_report_file)) {
		return $this->_report_file;
	}
	else {
		return "";
	}
}

function createAllStudentReport() 
{ 
	global $CLASS_NAME;
	
	for ($i = 0; $i < count($CLASS_NAME); $i+=2) {
		/* create report pdf */
		$pdf = new ReportPDF();
	
		/* should call first */
		$pdf->init($this->_semester, $this->_year, $this->_session_nb, $this->_test_nb);
		
		$this->setClassReportFileName($CLASS_NAME[$i]);
		
		$studentlists 	= $this->_memberList->getStudentLists($CLASS_NAME[$i], 0);
		foreach($studentlists as $student) {
			if (isNoNameStudent($student) || isTutoringClass($student->getClasses())) {
			
			}
			else {
				$this->createStudentReportPage($student, $pdf, $CLASS_NAME[$i]);
			}
		}
		$pdf->Output($this->_report_file);
	}
}


function createAllStudentReport1() 
{ 
	/* create report pdf */
	$pdf = new ReportPDF();
	/* should call first */
	$pdf->init($this->_semester, $this->_year, $this->_session_nb, $this->_test_nb);
	
	$studentlists 	= $this->_memberList->getStudentLists(-1, 0);
	foreach($studentlists as $student) {
		if (isNoNameStudent($student) || isTutoringClass($student->getClasses())) {
			
		}
		else {
			$this->createStudentReportPage($student, $pdf, "");
		}
	}
	$pdf->Output($this->_report_file);
}


function createClassStudentsReports($classname) 
{ 

	$pdf = new ReportPDF();
	
	/* should call first */
	$pdf->init($this->_semester, $this->_year, $this->_session_nb, $this->_test_nb);
		
	$studentlists 	= $this->_memberList->getStudentLists($classname, 0);
	foreach($studentlists as $student) {
		if (!isNoNameStudent($student)) {
			$this->createStudentReportPage($student, $pdf, $classname);
		}
	}
	$pdf->Output($this->_report_file);
	return $this->_report_file;
}


}
?>
