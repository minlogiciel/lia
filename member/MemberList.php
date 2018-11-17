<?php
class MemberList {
	
	var $DATA_BASE 				= 1;
	var $ST_TEST_NAME 			= "TESTSTUDENTS";
	var $TT_ST_NAME 			= "TTSTUDENTS";
	var $ST_TABLE_NAME 			= "STUDENTS";
	var $TH_TABLE_NAME 			= "TEACHERS";
	var $SC_TABLE_NAME 			= "SSCORES";
	var $SC_REF_TABLE_NAME 		= "SCORES_REF";
	var $STUDENTID 				= "STUDENTID";
	var $IDS 					= "IDS";
	var $GRADE 					= "GRADE";
	var $STUDENTNO				= "RM";
	var $REG_ST_NAME 			= "REGSTUDENTS";
	
	var $CLASS_COL				= "CLASSES";
	var $GROUPS					= "GROUPS";
	var $LASTNAME				= "LASTNAME";
	var $FIRSTNAME				= "FIRSTNAME";
	
	var $connection	= '';

	function connect() {
		if (!$this->connection)
			$this->connection = new sql_class();
		return $this->connection;
	}

	function close() {
		if ($this->connection) {
			$this->connection->close();
			$this->connection = '';
		}
	}
	
	function getStudentLists($classes, $loaddel) {
		global $CLASS_NAME, $OLD_STUDENT_CLASS;
		$lists = array();
		if ($this->DATA_BASE) {
			$classname = $classes;
			$exec = $this->connect();
			$cond  = "";
			if ($classes != -1) {
				$classname = getClassName($classes);
				/* can not use LIKE 2014 10 07 */
				if (1) {
					$cond  = "(" .$this->CLASS_COL. 	"='" .$classname. 	"' OR ";
					$cond  .= $this->CLASS_COL. 	" LIKE '%;" .$classname. 	"%' OR ";
					$cond  .= $this->CLASS_COL. 	" LIKE '%" .$classname. 	";%')";
				}
				else 
					$cond  = $this->CLASS_COL. 	" LIKE '%" .$classname. 	"%' ";
			}
			if ($cond)
				$elems =  $exec->get_order_elements_asc($this->ST_TABLE_NAME, $cond, $this->FIRSTNAME);
			else
				$elems =  $exec->get_order_elements_asc($this->ST_TABLE_NAME, $cond, $this->LASTNAME);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$student = new StudentClass();
					$student->setStudentData($elems[$i]);
					if ($classes == -1 && $student->getClasses() == $OLD_STUDENT_CLASS) {
						continue;
					}
					if ($loaddel || !($student->isDeleted()))
						$lists[] = $student;
				}
			}
			$this->close();
		
			if (isOldClassName($classname)) {
				$nn = getOldClassName($classname);
				$this->updateScoresOldClassName($nn);
				$this->updateStudentOldClassName($nn);
			}
		}
		return $lists;
	}
	
	function getAllStudentLists() {
		global $CLASS_NAME, $OLD_STUDENT_CLASS;
		$lists = array();
		if ($this->DATA_BASE) {
			$exec = $this->connect();

			$elems =  $exec->get_order_elements_asc_22($this->ST_TABLE_NAME, $this->CLASS_COL, $this->FIRSTNAME);

			//$elems =  $exec->get_order_elements_asc_22($this->ST_TABLE_NAME, $this->CLASS_COL, $this->LASTNAME);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$student = new StudentClass();
					$student->setStudentData($elems[$i]);
					if ($student->getClasses() == $OLD_STUDENT_CLASS) {
						continue;
					}
					
					if (!($student->isDeleted()))
						$lists[] = $student;
				}
			}
			$this->close();
		}
		return $lists;
	}
	
	function getFullStudents() {
		$lists = array();
		$exec = $this->connect();
		$elems =  $exec->get_order_elements_asc_22($this->ST_TABLE_NAME, $this->FIRSTNAME, $this->LASTNAME);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new StudentClass();
				$student->setStudentData($elems[$i]);
				if (!($student->isDeleted())) {
					$lists[] = $student;
				}
			}
		}
		$this->close();
		return $lists;
	}
	
	function getSummerTestStudentLists() {
		$lists = array();
		$exec = $this->connect();
		//$elems =  $exec->get_order_elements_asc($this->ST_TEST_NAME, '',  $this->GRADE. " AND " .$this->STUDENTNO);
		$elems =  $exec->get_order_elements_asc_22($this->ST_TEST_NAME, $this->GRADE, $this->STUDENTNO);
		
		//$elems =  $exec->get_order_elements_asc($this->ST_TEST_NAME, '', $this->GRADE);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new StudentTestClass();
				$student->setStudentData($elems[$i]);
				$lists[] = $student;
			}
		}
		$this->close();
		return $lists;
	}

	function getRegisteStudentLists() {
		$lists = array();
		$exec = $this->connect();

		$cond = "LASTMODIFY='" .date("Y"). "' AND LASTLOGIN ='" .getSemesterSchoolName()."'";

		$elems =  $exec->get_order_elements_asc_22($this->REG_ST_NAME, $this->GRADE, $this->FIRSTNAME, $cond);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new RegStudentClass();
				$student->setStudentData($elems[$i]);
				if (!($student->isDeleted()))
					$lists[] = $student;
			}
		}
		$this->close();
		return $lists;
	}
	

	function getTTStudentLists($testyear="") {
		$lists = array();
		$exec = $this->connect();
		
		if (!$testyear)  {
			$tyear = date("Y");
		}
		else {
			$tyear = $testyear;
		}
		$cond = "ANNEE='" .$tyear. "' ORDER BY ".$this->GRADE. " ASC, ".$this->FIRSTNAME. " ASC,  " .$this->STUDENTID. " ASC";
		
		$elems =  $exec->getElements($this->TT_ST_NAME, $cond);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new TestStudent();
				$student->setStudentData($elems[$i]);
				if (!$student->isDeleted())
					$lists[] = $student;
			}
		}
		$this->close();
		return $lists;
	}

	function getTTStudentLists__($testyear="") {
		$lists = array();
		$exec = $this->connect();
		
		if (!$testyear)  {
			$tyear = date("Y");
		}
		else {
			$tyear = $testyear;
		}
		$cond = "ANNEE='" .$tyear. "'";
		
		//$elems =  $exec->get_order_elements_asc_22($this->TT_ST_NAME, $this->GRADE, $this->STUDENTID, $cond);
		$elems =  $exec->get_order_elements_asc_22($this->TT_ST_NAME, $this->GRADE, $this->FIRSTNAME, $cond);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new TestStudent();
				$student->setStudentData($elems[$i]);
				if (!$student->isDeleted())
					$lists[] = $student;
			}
		}
		$this->close();
		return $lists;
	}
	
	function old_getTTClassStudentLists() {
		$lists = array();
		$exec = $this->connect();

		$elems =  $exec->get_order_elements_asc_22($this->TT_ST_NAME, $this->GRADE, $this->STUDENTID);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new TestStudent();
				$student->setStudentData($elems[$i]);
				if (!$student->isDeleted()) {
					$st = new StudentClass();
					if ($st->findStudent($student->getStudentName())) {
						$lists[] = $st;
					}
					else
						$lists[] = $student;
				}
			}
		}
		$this->close();
		return $lists;
	}

	function getTTClassStudentLists() {
		$lists = array();
		$exec = $this->connect();
		$elems =  $exec->get_order_elements_asc_22($this->ST_TABLE_NAME, $this->GRADE, $this->IDS);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new StudentClass ();
				$student->setStudentData($elems[$i]);
				if (!$student->isDeleted()) {
					$st = new TestStudent();
					if ($st->findStudent($student->getStudentName())) {
						$lists[] = $st;
					}
					else
						$lists[] = $student;
				}
			}
		}
		$this->close();
		return $lists;
	}
	function getTTClassStudentLists_1() {
		$lists = array();
		$exec = $this->connect();
		$elems =  $exec->get_order_elements_asc_22($this->ST_TABLE_NAME, $this->GRADE, $this->FIRSTNAME);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new StudentClass ();
				$student->setStudentData($elems[$i]);
				if (!$student->isDeleted()) {
					$st = new TestStudent();
					if ($st->findStudent($student->getStudentName())) {
						$lists[] = $st;
					}
					else
						$lists[] = $student;
				}
			}
		}
		$this->close();
		return $lists;
	}
	function getCurrentStudentLists() {
		$lists = array();
		$exec = $this->connect();
		$elems =  $exec->get_order_elements_asc_22($this->ST_TABLE_NAME, $this->GRADE, $this->FIRSTNAME, "CLASSES!='OLDST'");
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new StudentClass ();
				$student->setStudentData($elems[$i]);
				if (!$student->isDeleted()) {
					$st = new TestStudent();
					if ($st->findStudent($student->getStudentName())) {
						$lists[] = $st;
					}
					else
						$lists[] = $student;
				}
			}
		}
		$this->close();
		return $lists;
	}
	
	function getSummerTestGradeStudentLists($gradelist) {
		$lists = array();
		$exec = $this->connect();
		$nn = count($gradelist);
		$cond = "";
		$found = 0;
		for ($i = 0; $i <$nn; $i++) {
			if ($gradelist[$i] > 0) {
				if ($found)
					$cond .= " OR ";	
				$cond .= $this->GRADE. "='" .$gradelist[$i]."'";
				$found = 1;
			}
		}
		if ($found) {
			$cond = "ANNEE='" .date("Y"). "' AND (" .$cond. ")";
			$elems =  $exec->get_order_elements_2($this->TT_ST_NAME, $cond, $this->STUDENTID);
		}
		else {
			$cond = "ANNEE='" .date("Y"). "'";
			$elems =  $exec->get_order_elements_asc_22($this->TT_ST_NAME, $this->GRADE, $this->STUDENTID, $cond);
		}
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new TestStudent();
				$student->setStudentData($elems[$i]);
				if (!$student->isDeleted()) {
					$lists[] = $student;
				}
			}
		}
		$this->close();
		return $lists;
	}
	
	function sortScoresTable($lists) {
		$nb = count($lists)-1;
		$table = array();
		for ($i = 0; $i <= $nb; $i++) {
			$table[$i] = $lists[$i];
		}
		for ($i = 0; $i < $nb; $i++) {
			for ($j = 0; $j < $nb-$i; $j++) {
				if ($table[$j][0] < $table[$j+1][0]) {
					$v = $table[$j];
					$table[$j] = $table[$j+1];
					$table[$j+1] = $v;
				}
			}
		}
		return $table;
	}
	
	function getTTGradeStudentScores($grade, $testyear, $fullname = 0) {
		$lists = array();

		$s_math = 0;
		$s_english = 0;
		$s_total = 0;
		$m_math = 0;
		$m_en = 0;
		$m_total = 0;
		$nb_math = 0;
		$nb_en = 0;
		$nb_total = 0;
		if (!$testyear)  {
			$tyear = date("Y");
		}
		else {
			$tyear = $testyear;
		}
		$exec = $this->connect();
		
		$cond = "ANNEE='" .$tyear. "' AND ";
		if ($grade == 11) {
			$cond .= "(".$this->GRADE. "='" .$grade."' OR ".$this->GRADE. "='12')";
		}
		else {
			$cond .= $this->GRADE. "='" .$grade."'";
		}
		
		$elems =  $exec->get_order_elements_2($this->TT_ST_NAME, $cond, $this->IDS);
		if ($elems) {
			$maths = array();
			$englishs = array();
			$totals = array();
			
			for ($i = 0; $i < count($elems); $i++) {
				$student = new TestStudent();
				$student->setStudentData($elems[$i]);
				
				$studentno = $student->getStudentId();
				
				if ($fullname)
					$studentname = $student->getStudentName();
				else
					$studentname = $student->getShortStudentName();
					

				$scores = array();
				$s_math = $student->getMath();
				$scores[] = $s_math;
				$scores[] = $studentno;
				$scores[] = $studentname;
				$maths[] = $scores;
					
				$scores = array();
				$s_english = $student->getEnglish();
				$scores[] = $s_english;
				$scores[] = $studentno;
				$scores[] = $studentname;
				$englishs[] = $scores;
					
				$scores = array();
				$s_total = $student->getTotal();
				$scores[] = $s_total;
				$scores[] = $studentno;
				$scores[] = $studentname;
				$totals[] = $scores;
					
				if ($s_math > 0) {
					$m_math += $s_math;
					$nb_math++;
				}
				if ($s_english > 0) {
					$m_en += $s_english;
					$nb_en++;
				}
				if ($s_total > 0) {
					$m_total += $s_total;
					$nb_total++;
				}
				
			}
			
			$ss = array();
			if ($nb_math)
				$ss[] = (int)($m_math / $nb_math);
			else 
				$ss[] = 0;
			if ($nb_en)
				$ss[] = (int)($m_en / $nb_en);
			else 
				$ss[] = 0;
			if ($nb_total)
				$ss[] = (int)($m_total / $nb_total);
			else 
				$ss[] = 0;
			
			$lists[] = $ss;
			$maths = $this->sortScoresTable($maths);
			$englishs = $this->sortScoresTable($englishs);
			$totals = $this->sortScoresTable($totals);
			
			for ($i = 0; $i < count($maths); $i++) {
				$ss = array();
				$ss[] = $maths[$i];
				$ss[] = $englishs[$i];
				$ss[] = $totals[$i];
				$lists[] = $ss;
			}
			
		}
		$this->close();
		
		return $lists;
	}
	
	function getSummerGradeStudentScores($grade) {
		$lists = array();
		$stlists = array();
		$exec = $this->connect();
		
		$cond = $this->GRADE. "='" .$grade."'";
		if ($grade == 11) {
			$cond .= " OR ". $this->GRADE. "='12'";
		}
		
		$elems =  $exec->get_order_elements_2($this->ST_TEST_NAME, $cond, $this->IDS);

		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new StudentTestClass();
				$student->setStudentData($elems[$i]);
				
				$stlists[] = $student;
			}
			$this->close();
			$maths = array();
			$englishs = array();
			$totals = array();
			
			$s_math = 0;
			$s_english = 0;
			$s_total = 0;
			$m_math = 0;
			$m_en = 0;
			$m_total = 0;
			$nb_math = 0;
			$nb_en = 0;
			$nb_total = 0;
			
			for ($i = 0; $i < count($stlists); $i++) {
				$student = $stlists[$i];
				$studentid = $student->getID();
				$studentno = $student->getStudentNo();
				$lastname = $student->getLastName();
				$studentname = $student->getShortStudentName();
				$score = new TestScoreClass();
				if ($score->getScores($studentid)) {
					$scores = array();
					$s_math = $score->getMathScores();
					$scores[] = $s_math;
					$scores[] = $studentno;
					$scores[] = $studentname;
					$maths[] = $scores;
					
					$scores = array();
					$s_english = $score->getEnglishScores();
					$scores[] = $s_english;
					$scores[] = $studentno;
					$scores[] = $studentname;
					$englishs[] = $scores;
					
					$scores = array();
					$s_total = $score->getTotalScores();
					$scores[] = $s_total;
					$scores[] = $studentno;
					$scores[] = $studentname;
					$totals[] = $scores;
					
					if ($s_math > 0) {
						$m_math += $s_math;
						$nb_math++;
					}
					if ($s_english > 0) {
						$m_en += $s_english;
						$nb_en++;
					}
					if ($s_total > 0) {
						$m_total += $s_total;
						$nb_total++;
					}
					
				}
			}
			$ss = array();
			$ss[] = (int)($m_math / $nb_math);
			$ss[] = (int)($m_en / $nb_en);
			$ss[] = (int)($m_total / $nb_total);
			$lists[] = $ss;
			$maths = $this->sortScoresTable($maths);
			$englishs = $this->sortScoresTable($englishs);
			$totals = $this->sortScoresTable($totals);
			
			for ($i = 0; $i < count($maths); $i++) {
				$ss = array();
				$ss[] = $maths[$i];
				$ss[] = $englishs[$i];
				$ss[] = $totals[$i];
				$lists[] = $ss;
			}
			
		}
		else {
			$this->close();
		}
		
		
		return $lists;
	}
	
	function getTeacherLists($loaddel) {
		$lists = array();
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			$elems =  $exec->get_order_elements_asc($this->TH_TABLE_NAME, '', $this->LASTNAME);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$teacher = new TeacherClass();
					$teacher->setData($elems[$i]);
					if ($loaddel || !($teacher->isDeleted()))
						$lists[] = $teacher;
				}
			}
			$this->close();
		}
		return $lists;
	}

	function getTeacherSubjectsLists($loaddel) {
		global $PROGRAMS;
		$lists = $this->getTeacherLists($loaddel);
		
		$teacherlist = array();
		if ($lists) {
			for ($i = 0; $i < count($PROGRAMS); $i++) {
				$teacherlist[] = array();
			}
			for ($i = 0; $i < count($lists); $i++) {
				$teacher = $lists[$i];
				for ($j = 0; $j < count($PROGRAMS); $j++) {
					if ($teacher->getSubjects() == $PROGRAMS[$j]) {
						$teacherlist[$j][] = $teacher;
						break;
					}
				}
			}

		}
		return $teacherlist;
	}
	
	
	function deleteMemberss() {
		$delmember 	= $_POST['delmember'];
		$nb = 0;
		if(empty($delmember)) {
			
		}
		else {
			$nb = count($delmember);  
		}
		for ($i = 0; $i < $nb; $i++) {
			$studentid = $delmember[$i];
			$student = new StudentClass();
			if ($student->getUserByID($studentid)) {
				
				$student->deleteStudent();
			}
		}
	}

	function deleteMember() {
		$nb =  getPostValue("studentnb");
		for ($i = 0; $i < $nb; $i++) {
			$studentid = getPostValue("studentid_".$i);
			$student = new StudentClass();
			if ($student->getUserByID($studentid)) {
				if (getPostValue("delmember_".$i)) {
				
					$student->deleteStudent(1);
				}
				else {
					$student->deleteStudent(0);
				}
			}
		}
	}

	function updateAllStudentClassName() {
		$nb =  getPostValue("studentnb");
		for ($i = 0; $i < $nb; $i++) {
			$studentid = getPostValue("studentid_".$i);
			$classes = getPostValue("classes_".$i);
			$grade = getPostValue("grade_".$i);
			$student = new StudentClass();
			if ($student->getUserByID($studentid)) {
				if (($student->getClasses() != $classes) || ($student->getGrade() != $grade))
					$student->updateStudentClassGrade($classes, $grade);
			}
		}
	}

	function manageStudentClassName() {
		$nb =  getPostValue("studentnb");
		for ($i = 0; $i < $nb; $i++) {
			$studentid = getPostValue("studentid_".$i);
			$classes = getPostValue("classes_".$i);
			$grade = getPostValue("grade_".$i);
			$delete = getPostValue("delete_".$i);
			$student = new StudentClass();
			if ($student->getUserByID($studentid)) {
				if ($delete) {
					$student->deleteStudent(1);
				}
				else if (($student->getClasses() != $classes) || ($student->getGrade() != $grade)) {
					$student->updateStudentClassGrade($classes, $grade);
				}
			}
		}
	}
	
	function updateAllTestStudentClassName() {
		$nb =  getPostValue("studentnb");
		$annee = date('Y');
		for ($i = 0; $i < $nb; $i++) {
			
			$civil = getPostValue("civil_".$i);
			$firstname = getPostValue("firstname_".$i);
			$lastname = getPostValue("lastname_".$i);
			$grade = getPostValue("grade_".$i);
			$email = getPostValue("email_".$i);
			$phone = getPostValue("phone_".$i);
			$cell = getPostValue("cell_".$i);
			$totest = getPostValue("totest_".$i);
			if ($totest) {
				$student = new TestStudent();
				$student->setCivil($civil);
				$student->setFirstName($firstname);
				$student->setLastName($lastname);
				$student->setGrade($grade);
				$student->setPhone($phone);
				$student->setMobile($cell);
				$student->setEmail($email);
				$student->setDeleted(0);
				$student->addStudent();
			}
		}
	}
	
	function getStudent($studentid) {
		$student = '';
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->ST_TABLE_NAME, $this->IDS,  $studentid);
			if ($elem) {
				$student = new StudentClass();
				$student->setStudentData($elem);
			}
			$this->close();
		}
		return $student;
	}
	function getStudentScores($studentid) {
		$lists = array();
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			$elems = $exec->get_order_elements($this->SC_TABLE_NAME, $this->STUDENTID,  $studentid);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$scores = new ScoreClass();
					$scores->setScoresData($elems[$i]);
					$lists[] = $scores;
				}
			}
			$this->close();
		}
		return $lists;
	}
	
	function getClassStudentScoresLists($classes, $subjects, $semester, $period) {
		$lists = array();
		$scoresRef = new ScoreRefClass();
		
		$refs = $scoresRef->readScoresRef($classes, $subjects, $semester, $period);
		if ($refs && count($refs) > 0) {
			$exec = $this->connect();
			for ($i = 0; $i < count($refs); $i++) {
				$groups = $refs[$i]->getGroups();
				$elems = $exec->get_elements($this->SC_TABLE_NAME, $this->GROUPS,  $groups);
				if ($elems) {
					$scoreslists = array();
					$hasScore = 0;
					for ($j = 0; $j < count($elems); $j++) {
						$scores = new ScoreClass();
						$scores->setScoresData($elems[$j]);
						if ($subjects || isPSATSubject($scores->getSubjects()) == 0) {
							$scoreslists[] = $scores;
							if ($scores->getTotalScores()) {
								$hasScore = 1;
							}
						}
					}
					if ($hasScore)
						$lists[] = $scoreslists;
				}
			}
			$this->close();			
		}
		return $lists;
	}

	function getClassStudentScoresNumber($classes, $semester, $period) {
		global $EXAMS;
		$lists = array(0,0,0,0);
		$scoresRef = new ScoreRefClass();
		$refs = $scoresRef->readScoresRef($classes, "", $semester, $period);
		if ($refs && count($refs) > 0) {
			$nenglish = 0;
			$tenglish = 0;
			$nmath = 0;
			$tmath = 0;
			$programlist = getClassReportSubject($classes);
			
			for ($i = 0; $i < count($refs); $i++) {
				$subjs = $refs[$i]->getSubjects();
				$types = $refs[$i]->getTypes();
				if (!$subjs || $subjs == $programlist[0]) {
				 	if (!$types || $types == $EXAMS[0]) {
				 		$nenglish++;
				 	}
				 	else {
				 		$tenglish++;
				 	}
				}
				else {
				 	if (!$types || $types == $EXAMS[0]) {
				 		$nmath++;
				 	}
				 	else {
				 		$tmath++;
				 	}
				}
			}
			$lists[0] = $nenglish;
			$lists[1] = $nmath;
			$lists[2] = $tenglish;
			$lists[3] = $tmath;
			
		}
		return $lists;
	}
	
	function getClassStudentGroupsScoresLists($groups) {
		$lists = array();
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			$elems = $exec->get_elements($this->SC_TABLE_NAME, $this->GROUPS,  $groups);
			if ($elems) {
				for ($j = 0; $j < count($elems); $j++) {
					$scores = new ScoreClass();
					$scores->setScoresData($elems[$j]);
					$lists[] = $scores;
				}
			}
			$this->close();
		}
		return $lists;
	}

	function updateScoresOldClassName($classname) {
		$lists = array();
		$scoresRef = new ScoreRefClass();
		
		$refs = $scoresRef->readScoresRef($classname, '', '', '');
		if ($refs && count($refs) > 0) {
			$exec = $this->connect();
			for ($i = 0; $i < count($refs); $i++) {
				$groups = $refs[$i]->getGroups();
				$elems = $exec->get_elements($this->SC_TABLE_NAME, $this->GROUPS,  $groups);
				if ($elems) {
					$scoreslists = array();
					$hasScore = 0;
					for ($j = 0; $j < count($elems); $j++) {
						$scores = new ScoreClass();
						$scores->setScoresData($elems[$j]);
						$scoreslists[] = $scores;
						$hasScore = 1;
					}
					if ($hasScore)
						$lists[] = $scoreslists;
				}
			}
			$this->close();			
		
			/* change score ref old class name */
			for ($i=0; $i< count($refs); $i++) {
				$refs[$i]->updateScoresRefClassName();
			}

			for ($i = 0; $i < count($lists); $i++) {
				$scoreslists = $lists[$i];
				for ($j = 0; $j < count($scoreslists); $j++) {
					$scores = $scoreslists[$j];
					$scores->updateScoresClassName();
				}
			}
		}
	}
	
	function updateStudentOldClassName($classname) {
		if ($this->DATA_BASE) {
			$cond  = $this->CLASS_COL. 	" LIKE '%" .$classname. 	"%' ";
			$exec = $this->connect();
			$elems =  $exec->get_order_elements_asc($this->ST_TABLE_NAME, $cond, $this->LASTNAME);
			if ($elems) {
				for ($j = 0; $j < count($elems); $j++) {
					$student = new StudentClass();
					$student->setStudentData($elems[$j]);
					$student->updateStudentClassName();
				}
			}
			$this->close();
		}
	}
}
?>
