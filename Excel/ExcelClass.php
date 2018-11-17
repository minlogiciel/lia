<?php

class ExcelClass {

	var $TABLE  = array(
		"STUDENT NAME",
		"STUDENTID",
		"TOTAL",
		"ID NUMBER",
		"%",
	);

	var $STUDENT	= 0;
	var $STUDENTID	= 1;
	var $TOTAL   	= 2;
	var $STUDENTID2	= 3;
	var $TOTAL2   	= 4;
	
	
	var $_student	= array();
	var $_studentid	= array();
	var $_classes   = "";
	var $_teacher   = "";
	var $_subjects  = "";
	var $_types     = "Test";
	var $_total		= array();
	var $_dates     = "";
	var $_titles  	= "TEST #";
	var $_mscores   = 0;
	var $_lscores   = 100;
	var $_hscores   = 0;
	var $_scorelist	= array();
	

	function getColumnPosition($val) {
		if ($val) {
			for ($i = 0; $i < count($this->TABLE); $i++) {
				if (strtoupper($val) ==  ($this->TABLE[$i])) {
					return $i;
				}	
			}
		}
		return -1;
	}
	
	function getScoreValue($v) {
		$newv = $v;
		if ($v) {
			if (strstr($v,"%")) {
				$newv = str_replace("%", "", $newv);
			}
			if ($newv < 1) {
				$newv = $newv*100;
			}
		}
		return (int)$newv;
	}

	function parserInfo() {
		if (count($this->_studentid)) {
			$st = new StudentClass();
			for ($i = 0; $i < count($this->_studentid); $i++) {
				$stid = $this->_studentid[$i];
				if ($st->getUserByID($stid)) {
					$cl = $st->getClasses();
					if ($cl && !strstr($cl, ";")) {
						$this->_classes = $cl;
						$this->_subjects = "English";
						break;
					}
				}
			}
		}
	}
	
	function parser($sheetData) {
		$p = array();
		/* first line is column name */
		$elem = $sheetData[1];
		foreach($elem as $val) {
			$p[] = $this->getColumnPosition($val);
		}
		
		$nscore = 0;
		$ntotal = 0;
		for ($i = 2; $i <= count($sheetData); $i++) {
			$elem = $sheetData[$i];
			$j = 0;
			foreach($elem as $val) {
				$n = $p[$j++];
				switch ($n) {
					case $this->STUDENT :
						$this->_student[] = $val;
						break;
					case $this->STUDENTID :
					case $this->STUDENTID2 :
						$this->_studentid[] = $val;
						break;
					case $this->TOTAL :
					case $this->TOTAL2 :
						$vv = $this->getScoreValue($val);
						$this->_total[] = $vv;
						if ($vv) {
							$ntotal += $vv;
							$nscore++;
							if ($this->_hscores < $vv) {
								$this->_hscores = $vv;
							}
							if ($this->_lscores > $vv) {
								$this->_lscores = $vv;
							}
						}
						break;
				}
			}
		}
		if ($nscore > 0) {
			$this->_mscores = (int)($ntotal / $nscore);
		}
		
		$this->parserInfo();
	}
	
	function parserTest($sheetData) {
		$p = array();
		/* first line is column name */
		$elem = $sheetData[1];
		foreach($elem as $val) {
			$p[] = $this->getColumnPosition($val);
		}
		
		for ($i = 2; $i <= count($sheetData); $i++) {
			$elem = $sheetData[$i];
			$j = 0;
			foreach($elem as $val) {
				$n = $p[$j++];
				switch ($n) {
					case $this->STUDENT :
						$this->_student[] = $val;
						break;
					case $this->STUDENTID :
					case $this->STUDENTID2 :
						$this->_studentid[] = $val;
						break;
					case $this->TOTAL :
					case $this->TOTAL2 :
						$vv = $this->getScoreValue($val);
						$this->_total[] = $vv;
						break;
				}
			}
		}
	}

	function getTestScoresList($subjects) {
		$lists = array();
		if (count($this->_studentid)) {
			$mlists = new MemberList();
			$slists = $mlists->getTTStudentLists();
			
			for ($i = 0; $i < count($this->_studentid); $i++) {
				$stid = $this->_studentid[$i];
				for ($j = 0; $j < count($slists); $j++) {
					if ($slists[$j]->getStudentId() == $stid) {
						if ($subjects == "English" || $subjects == "0") {
							$slists[$j]->setEnglish($this->_total[$i]);
						}
						else {
							$slists[$j]->setMath($this->_total[$i]);
						}
						$lists[] = $slists[$j];
						break;
					}
				}
			}
		}
		return $lists;
	}
	
	function parserScoresList() {
		for ($i = 0; $i < count($this->_studentid); $i++) {
			$studentid = $this->_studentid[$i];
			$total = $this->_total[$i];
			if ($total && $studentid) {
				$studentscores = new ScoreClass();
				$studentscores->setStudentID($studentid);
				$studentscores->setTeacher($this->getTeacher());
				$studentscores->setTitles($this->getTitle());
				$studentscores->setSubjects($this->getSubjects());
				$studentscores->setTypes($this->getTypes());
	
				$studentscores->setMathScores("");
				$studentscores->setReadingScores("");
				$studentscores->setWritingScores("");
				$studentscores->setTotalScores($total);
				$studentscores->setMoyenScores($this->getMoyenScores());
				$studentscores->setLowScores($this->getLowScores());
				$studentscores->setHighScores($this->getHighScores());
				
				$studentscores->setDates($this->getDates());
				$studentscores->setSemester(getSemester());
				$studentscores->setPeriods(getAnnee());
				
				$studentscores->setClasses($this->getClasses());
				$studentscores->setComments("");
				$this->_scorelist[] = $studentscores;
			}
		}
	}
	
	function getScoresList() {
		if ($this->isOK()) {
			if (count($this->_scorelist) == 0) {
				$this->parserScoresList();
			}
		}
		return $this->_scorelist;
	}
	
	function addNewScoresList() {
		$scoreslists = $this->getScoreslist();
		$nb = count($scoreslists);
		if ($nb > 0) {
			$studentscores = $scoreslists[0];
			$scoresRef = new ScoreRefClass();
		
			$scoresRef->setClasses($studentscores->getClasses());
			$scoresRef->setSubjects($studentscores->getSubjects());
			$scoresRef->setTypes($studentscores->getTypes());
			$scoresRef->setSemester($studentscores->getSemester());
			$scoresRef->setPeriods($studentscores->getPeriods());
			$scoresRef->setDates($studentscores->getDates());
		
			$groups = $scoresRef->addScoresRef();
		
			for ($i = 0; $i < $nb; $i++) {
				$studentscores = $scoreslists[$i];
				$studentscores->setGroups($groups);
				$studentscores->addStudentScores();
			}

		}
		return $scoreslists;
	}
	
	
	function isOK() {
		if ($this->_subjects && count($this->_studentid) && count($this->_total)) {
			return 1;
		}
		else { 
			return 0;
		}
	}
	function getTeacher() {
		return $this->_teacher;
	}
	function getClasses() {
		return $this->_classes;
	}
	
	function getTitle() {
		return $this->_titles;
	}
	function setTitle($title) {
		$this->_titles = $title;
	}
	
	function getSubjects() {
		return $this->_subjects;
	}
	function setSubjects($subject) {
		$this->_subjects = $subject;
		$this->_teacher = getClassTeacherName($this->_classes, $this->_subjects);
	}
	
	function getTypes() {
		return $this->_types;
	}
	
	function getDates() {
		return $this->_dates;
	}
	function setDates($d) {
		return $this->_dates = $d;
	}
	
	function getScores() {
		return $this->_total;
	}
	
	function getMoyenScores() {
		return (int)$this->_mscores;
	}

	function getLowScores() {
		return $this->_lscores;
	}
	
	function getHighScores() {
		return $this->_hscores;
	}
	
	function getStudents() {
		return $this->_student;
	}
	function getStudentIDs() {
		return $this->_studentid;
	}
	
}
?>
