<?php
$TIME_OUT = $timeout = 60*60; // Set timeout
$ACTIVE_LOGIN = 0;

/* 
 * change $GENERATE_REPORT = 1
 * "semester=Fall&period=2012";
 */
$GENERATE_REPORT = 0;
function getCreateReportURL() {
	$sem = getSemester();
	$yea = getSemesterYear();
	return "../member/member.php?action=createreport&semester=".$sem."&period=".$yea;
}

$ENGLISH_SUB = array(
	"English",
	"../subject/",
	"Vocabulary/Grammar", 
	"Reading/Writing", 
	"College Application Essay"
); 

$MATH_SUB = array(
		"Math",
		"../subject/",
		"Elementary Math (Grade 2-5)", 
		"Intermediate Math (Grade 6-8)", 
		"Integrated Algebra", 
		"Geometry", 
		"Algebra II & Trigonometry", 
		"Pre-Calculus", 
		"Math Theory",
		"Calculus AB/BC",
		"Multi-variable"
); 

$SOCIAL_SUB = array(
		"Social Studies",
		"../subject/",
		"Social Studies", 
		"World History (Global History)", 
		"European History", 
		"US History", 
		"US Government", 
		"Micro/Macro Economics"
); 

$SCIENCE_SUB = array(
		"Science",
		"../subject/",
		"Life Science", 
		"Physical Science", 
		"Earth Science", 
		"Biology (Living Environment)", 
		"Chemistry", 
		"Physics"
); 

$FOREIGN_SUB = array(
		"Foreign Language",
		"../subject/",
		"Spanish", 
		"French", 
		"Chinese"
); 

$TEST_PREP = array(
		"Test Prep.",
		"../subject/test.php",
		"NY State ElA & Math Tests", 
		"CTY (SCAT & SAT)", 
		"SSAT / ISEE",
		"NY State Regents Exams", 
		"AP / IB", 
		"SAT I / II",
		"ACT", 
		"AMC, AIME & USAMO"
);


$SUBJECTS_LIST = array($ENGLISH_SUB, $MATH_SUB, $SOCIAL_SUB, $SCIENCE_SUB, $FOREIGN_SUB, $TEST_PREP);

$SEMESTERS = array("Spring", "Summer", "Fall");
$SEMESTER_SPRING 	= 0;
$SEMESTER_SUMMER 	= 1;
$SEMESTER_FALL 		= 2;

$PROGRAM_PSAT = "PSAT";

$ENGLISH_TEACHER_NAME =array(
	"Ms. J. Baker",
	"Mr. M. Baron", 
	"Mr. J. Bosley", 
	"Ms. A. Carlson",
	"Ms. P. Castello", 
  	"Mr. M. Chorusey", 
	"Mr. T. DeVenuti", 
	"Ms. J. Difranco",
	"Ms. F. Fuchs", 
	"Mr. M. Holtz",
	"Ms. C. Lowenthal", 
	"Ms. S. Schwarz", 
);

$MATH_TEACHER_NAME =array(
	"Mr. Alper", 
	"Ms. Bloom", 
	"Ms. Fanelli", 
	"Mr. Fazekas", 
	"Mr. Mantell", 
	"Ms. Schaefer",
	"Mr. Savelli", 
	"Mr. Schwartz",
	"Ms. Wemssen", 
);

$BIOL_TEACHER_NAME =array("Ms. Boyed", "Dr. Danielowich");


$CHEM_TEACHER_NAME =array("Mr. Strasser");
$PHY_TEACHER_NAME =array("Mr. McInnes");

$HIST_TEACHER_NAME =array("Mr. Dugan", "Mr. Klaff", "Mr. Matina");

$Earth_TEACHER_NAME =array("Mr. D'Anna", "Mr. Barrett");

$ECON_TEACHER_NAME =array("Mr. Medico");
$SPAN_TEACHER_NAME =array("Ms. Fazekas");

$TEACHER_NAME =array(
	$ENGLISH_TEACHER_NAME, 
	$MATH_TEACHER_NAME, 
	$BIOL_TEACHER_NAME, 
	$CHEM_TEACHER_NAME, 
	$PHY_TEACHER_NAME, 
	$HIST_TEACHER_NAME,
	$Earth_TEACHER_NAME,
	$ECON_TEACHER_NAME,
	$SPAN_TEACHER_NAME
);

function findTeacher($teacher) {
	global $TEACHER_NAME;

	if ($teacher) {
		$tt = strtolower($teacher);
		for ($i = 0; $i < count($TEACHER_NAME); $i++) { 
			$TN = $TEACHER_NAME[$i];
			for ($j=0; $j < count($TN); $j++) {
				$tname = strtolower($TN[$j]);
				if (strstr($tname, $tt)) {
					return $TN[$j];
				}
			}
		}
	}
	return '';
}

$PROGRAMS = array("English", "Math", "Biology", "Chemistry", "Physics", "History", "Earth Science", "Economics", "Spanish");   
$PROGRAMS_2 = array("English", "Math", "Math2", "Biology", "Chemistry", "Physics", "Earth Science");   
$EXAMS = array("Homework", "Test",  "Exam");
$REPORT_SUBJS = array("English", "Math");
$REPORT_SUBJS_M = array("Math", "Math2");

function getClassReportSubject($classname) {
	global $REPORT_SUBJS, $REPORT_SUBJS_M;
	$CLASS_MATH = array(); //array("IS-A1");
	$ismath = 0;
	$clname = getClassName($classname);
	for ($i = 0; $i < count($CLASS_MATH); $i++) {
		if ($clname == $CLASS_MATH[$i]) {
			$ismath = 1;
			break;
		}
	}
	if ($ismath) {
		return $REPORT_SUBJS_M;
	}
	else if ($clname == "PHY") {
		 return array("Physics");
	}
	else if ($clname == "CTY") {
		 return array("CTY");
	}
	else if ($clname == "CHEM") {
		 return array("Chemistry");
	}
	else if ($clname == "BIO") {
		 return array("Biology");
	}
	else if ($clname == "ES") {
		 return array("Earth Science");
	}
	else {
		return $REPORT_SUBJS;
	}
	
}

//$ADDINFOITEMS = array("Administration", "Home",  "SAT", "ACT", "Course Schedule", "Announcement", "Private Session");
//$ADDINFOITEMS = array("Administration", "Course Schedule", "Announcement", "Private Session", "2013 Open House", "2012 Open House");
//$ADDINFOITEMS = array("Administration", "Class Teacher", "Announcement", "Homework", "2013 Open House", "2012 Open House");
$ADDINFOITEMS = array("Class Management", "Administration", "Homework", "Student Management");
$CLASS_TYPE 	= 0;
$ADMIN_TYPE		= 1;
$HOMEWORK_TYPE	= 2;
$STUDENT_TYPE	= 3;


$PSESSION_TYPE	= 33;
$HOME_TYPE 		= 11;
$SAT_TYPE 		= 21;
$ACT_TYPE 		= 31;

$CLASS_NAME2 =array(
	"PS-C", 	"3",
	"PS-B", 	"4",
	"PS-A", 	"5", 	//"PS-A" "PS-CAT"
	"IS-C",		"6", 	//"IS-C" "IS-CAT"
	"IS-A",		"7",	//"IS-A1",	"IS-A",	
	"HS-D1", 	"8",    // "HS-D","HS-D1",
	"HS-D2", 	"8",    // "HS-A2","HS-D2",
	"HS-C1",	"9",  
	"HS-C2",	"9",
	"HS-B",		"10",
	"HS-A1", 	"11",    // "HS-D","HS-D1",
	"HS-A2", 	"11",    // "HS-A2","HS-D2",
	"PHY",		"11",
	"CHEM",		"11",
	"BIO",		"11",
	"ES",		"11",
	"WR-1",		"11",
	"WR-2",		"11",
	"WR-3",		"11",
	"WR-4",		"11",
	"BC",		"11",
	"CA",		"11",
	"TUTO",		"tutoring"
);

$old_name_active = 0; //to change old class name
$OLD_CLASS_NAME =array(
	"PS-A", "PS-CAT", 	
	"IS-C", "IS-CAT",		
	"HS-C", "HS-C1", 
);

$COMBINEDCLASS = array("XXXX");

function isCombinedClass($classname) {
	global $COMBINEDCLASS;
	if ($classname) {
		for ($i = 0; $i < count($COMBINEDCLASS); $i++) {
			if ($classname == $COMBINEDCLASS[$i]) {
				return 1;
			}
		}
	}
	return 0;
}
function getCombinedClass($classname) {
	global $COMBINEDCLASS;
	if ($classname) {
		for ($i = 0; $i < count($COMBINEDCLASS); $i++) {
			if (strstr($classname, $COMBINEDCLASS[$i])) {
				return $COMBINEDCLASS[$i];
			}
		}
	}
	return "";
}

function getClassElementName($classes, $i) {
	$classes1 = '';
	$classes2 = '';
	$classes3 = '';
	$classes4 = '';
	
	$nb = getClassNumber($classes);
	if ($nb < 2) {
		$classes1 = $classes;
	}
	else if ($nb == 2) {
		list($classes1, $classes2) =  explode(";", $classes);
	}
	else if ($nb == 3) {
		list($classes1, $classes2, $classes3 ) =  explode(";", $classes);
	}
	else {
		list($classes1, $classes2, $classes3, $classes4 ) =  explode(";", $classes);
	}
	switch($i) {
		case 2:
			return $classes2;
		case 3:
			return $classes3;
		case 4:
			return $classes4;
	}
	return $classes1;
}

function getClassNumber($classes) {
	$n = 1;
	if ($classes) {
		for ($i = 0; $i < strlen($classes); $i++) {
			if ($classes[$i] == ';') {
				$n++;
			}		
		}
	}
	return $n;
}

function getClassName($classes) {
	global $CLASS_NAME;
	if (is_numeric($classes) && $classes>=0)
		return $CLASS_NAME[$classes];
	else 
		return $classes;
}

function getClassGrade($classes) {
	global $CLASS_TEACHER;
	if (is_numeric($classes) && $classes != -1)
		return $CLASS_TEACHER[$classes/2][3];
	else {
		for ($i = 0; $i < count($CLASS_TEACHER); $i++) {
			if ($CLASS_TEACHER[$i][0] == $classes) {
				return $CLASS_TEACHER[$i][3];
			}
		}
		return 2;
	}
}

$OLD_STUDENT_CLASS = "OLDST";
function isOldStudent($classname) {
	if ($classname && strstr($classname, "OLDST"))
		return 1;
	else 
		return 0;
}

function isTutoringClass($classes) {
	$classname = getClassName($classes);
	if (strstr($classname, "TUTO"))
		return 1;
	else 
		return 0;
}

function replaceOldClassName($oldname) {
	global $OLD_CLASS_NAME;
	$classname = $oldname;
	
	if ($classname) {
		for ($i = 0; $i < count($OLD_CLASS_NAME); $i+=2) {
			$classname = str_replace($OLD_CLASS_NAME[$i+1], $OLD_CLASS_NAME[$i], $classname);
		}
	}	
	return $classname;
}

function isOldClassName($classname) {
	global $OLD_CLASS_NAME, $old_name_active;
	if ($old_name_active && $classname ) {
		for ($i = 0; $i < count($OLD_CLASS_NAME); $i+=2) {
			if ($classname == $OLD_CLASS_NAME[$i] || $classname == $OLD_CLASS_NAME[$i+1] ) {
				return 1;
			}
		}
	}	
	return 0;
}

function getOldClassName($classname) {
	global $OLD_CLASS_NAME;
	$oldname = $classname;
	if ($classname) {
		for ($i = 0; $i < count($OLD_CLASS_NAME); $i+=2) {
			if ($classname == $OLD_CLASS_NAME[$i] || $classname == $OLD_CLASS_NAME[$i+1] ) {
				$oldname = $OLD_CLASS_NAME[$i+1];
				break;
			}
		}
	}	
	return $oldname;
}

function getClassTeacherName($classname, $subjects) {
	global $CLASS_TEACHER, $PROGRAMS;
	$clname = getClassName($classname);
	$teacher = "";
	if ($clname) {
		for ($i = 0; $i < count($CLASS_TEACHER); $i++) {
			$clt = $CLASS_TEACHER[$i];
			if ($clname == $clt[0]) {
				if ($subjects == $PROGRAMS[1] || $subjects == 2) {
					$teacher = $clt[2];
				}
				else {
					$teacher = $clt[1];
				}
				break;
			}
		}
	}
	return $teacher;
}



?>