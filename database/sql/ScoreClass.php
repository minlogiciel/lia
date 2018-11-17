<?php
class ScoreClass {

	var $TABLE_NAME    	= "SSCORES";
	var $DATABASE_OK  	= 1;

	var $TABLE  = array(
		"IDS",
		"STUDENTID",
		"CLASSES",
		"TEACHER",
		"TITLES",
		"SUBJECTS",
		"TYPES",
		"MATH",
		"READING",
		"WRITING",
		"TOTAL",
		"MSCORES",
		"LSCORES",
		"HSCORES",
		"DATES",
		"SEMESTER",
		"PERIODS",
		"COMMENTS",
		"GROUPS",
		"DELETED",
	);

	var $IDS		= 0;
	var $STUDENTID	= 1;
	var $CLASSES  	= 2;
	var $TEACHER    = 3;
	var $TITLES    	= 4;
	var $SUBJECTS   = 5;
	var $TYPES      = 6;
	var $MATH   	= 7;
	var $READING   	= 8;
	var $WRITING   	= 9;
	var $TOTAL   	= 10;
	var $MSCORES  	= 11;
	var $LSCORES    = 12;
	var $HSCORES   	= 13;
	var $DATES      = 14;
	var $SEMESTER  	= 15;
	var $PERIODS  	= 16;
	var $COMMENTS  	= 17;
	var $GROUPS 	= 18;
	var $DELETED 	= 19;
	
	var $_id        = 0;
	var $_studentid = 0;
	var $_classes	= "";
	var $_teacher   = "";
	var $_titles  	= "";
	var $_subjects  = "PSAT";
	var $_types     = "";
	var $_math    	= "";
	var $_reading   = "";
	var $_writing   = "";
	var $_total    	= "";
	var $_mscores   = "";
	var $_lscores   = "";
	var $_hscores   = "";
	var $_dates     = "";
	var $_semester  = "";
	var $_periods  	= 2011;
	var $_groups	= 1;
	var $_comments	= "";
	var $_deleted	= 0;
	

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
		
	function getID() {
		return $this->_id;
	}
	function setID($id) {
		$this->_id = $id;
	}

	function getStudentID() {
		return $this->_studentid;
	}
	function setStudentID($studentid) {
		$this->_studentid = $studentid;
	}
	
	
	function getClasses() {
		return $this->_classes;
	}
	function setClasses($classes) {
		$this->_classes = $classes;
	}
	
	function getTeacher() {
		return $this->_teacher;
	}
	function setTeacher($teacher) {
		$this->_teacher = $teacher;
	}

	function getTitles() {
		return $this->_titles;
	}
	function setTitles($titles) {
		$this->_titles = $titles;
	}
	function getSubjects() {
		return $this->_subjects;
	}
	function setSubjects($subjects) {
		$this->_subjects = $subjects;
	}
	
	function getTypes() {
		return $this->_types;
	}
	function setTypes($types) {
		$this->_types = $types;
	}
	
	function isTestScores() {
		$str = strtolower(trim($this->_types));
		if($str && strstr($str,"test"))
			return 1;
		else
			return 0;
	}
	function isHomeworkScores() {
		$str = strtolower(trim($this->_types));
		if($str && strstr($str,"homework"))
			return 1;
		else
			return 0;
	}
	function isExamScores() {
		$str = strtolower(trim($this->_types));
		if($str && strstr($str,"exam"))
			return 1;
		else
			return 0;
	}
	function getMathScores() {
		return $this->_math;
	}
	function setMathScores($scores) {
		$this->_math = $scores;
	}
	function getReadingScores() {
		return $this->_reading;
	}
	function setReadingScores($scores) {
		$this->_reading = $scores;
	}
	function getWritingScores() {
		return $this->_writing;
	}
	function setWritingScores($scores) {
		$this->_writing = $scores;
	}
	function getTotalScores() {
		return $this->_total;
	}
	function setTotalScores($scores) {
		$this->_total = $scores;
	}
	
	function getScores() {
		return $this->_total;
	}
	function setScores($scores) {
		$this->_total = $scores;
	}
	
	function getMoyenScores() {
		return (int)$this->_mscores;
	}
	function setMoyenScores($scores) {
		$this->_mscores = $scores;
	}

	function getLowScores() {
		return $this->_lscores;
	}
	function setLowScores($scores) {
		$this->_lscores = $scores;
	}
	
	function getHighScores() {
		return $this->_hscores;
	}
	function setHighScores($scores) {
		$this->_hscores = $scores;
	}
	

	function getDates() {
		return $this->_dates;
	}
	function setDates($dates) {
		$this->_dates = $dates;
	}
	
	function getSemester() {
		return $this->_semester;
	}
	function setSemester($semester) {
		$this->_semester = $semester;
	}
	function getPeriods() {
		return $this->_periods;
	}
	function setPeriods($periods) {
		$this->_periods = $periods;
	}
	
	
	function getComments() {
		return $this->_comments;
	}
	function setComments($comment) {
		$this->_comments = $comment;
	}
	
	function setGroups($group) {
		$this->_group = $group;
	}
	function getGroups() {
		return $this->_group;
	}
	function setDeleted($deleted) {
		$this->_deleted = $deleted;
	}
	function isDeleted() {
		return $this->_deleted;
	}
	

	function setScoresData($scores) {
		$this->setID($scores["$this->IDS"]);
		$this->setStudentID($scores["$this->STUDENTID"]);
		$this->setClasses($scores["$this->CLASSES"]);
		$this->setTeacher($scores["$this->TEACHER"]);
		$this->setTitles($scores["$this->TITLES"]);
		$this->setSubjects($scores["$this->SUBJECTS"]);
		$this->setTypes($scores["$this->TYPES"]);
		$this->setMathScores($scores["$this->MATH"]);
		$this->setReadingScores($scores["$this->READING"]);
		$this->setWritingScores($scores["$this->WRITING"]);
		$this->setTotalScores($scores["$this->TOTAL"]);
		$this->setMoyenScores($scores["$this->MSCORES"]);
		$this->setHighScores($scores["$this->HSCORES"]);
		$this->setLowScores($scores["$this->LSCORES"]);
		$this->setDates($scores["$this->DATES"]);
		$this->setSemester($scores["$this->SEMESTER"]);
		$this->setPeriods($scores["$this->PERIODS"]);
		$this->setComments($scores["$this->COMMENTS"]);
		$this->setGroups($scores["$this->GROUPS"]);
		$this->setDeleted($scores["$this->DELETED"]);
	}
	function buildTableRef() {
		$buf = "(";
		for ($i= 0; $i < count($this->TABLE); $i++) {
			if ($i > 0)
				$buf .= ", ";
			$buf .= $this->TABLE[$i];
		}
		$buf .= ")";
		return $buf;
	}
	
	function getScoresData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getStudentID() . "', ";
		$buf .= "'" . $this->getClasses() . "', ";
		$buf .= "'" . $this->getTeacher() . "', ";
		$buf .= "'" . $this->getTitles() . "', ";
		$buf .= "'" . $this->getSubjects() . "', ";
		$buf .= "'" . $this->getTypes() . "', ";
		$buf .= "'" . $this->getMathScores() . "', ";
		$buf .= "'" . $this->getReadingScores() . "', ";
		$buf .= "'" . $this->getWritingScores() . "', ";
		$buf .= "'" . $this->getTotalScores() . "', ";
		$buf .= "'" . $this->getMoyenScores() . "', ";
		$buf .= "'" . $this->getLowScores() . "', ";
		$buf .= "'" . $this->getHighScores() . "', ";
		$buf .= "'" . $this->getDates() . "', ";
		$buf .= "'" . $this->getSemester() . "', ";
		$buf .= "'" . $this->getPeriods() . "', ";
		$buf .= "'" . $this->getComments() . "', ";
		$buf .= "'" . $this->getGroups() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateScoresData() {
		$buf = "";
		$buf .= $this->TABLE[$this->STUDENTID]. "='" . $this->getStudentID() . "', ";
		$buf .= $this->TABLE[$this->CLASSES]. 	"='" . $this->getClasses() . "', ";
		$buf .= $this->TABLE[$this->TEACHER]. 	"='" . $this->getTeacher() . "', ";
		$buf .= $this->TABLE[$this->TITLES]. 	"='" . $this->getTitles() . "', ";
		$buf .= $this->TABLE[$this->SUBJECTS]. 	"='" . $this->getSubjects() . "', ";
		$buf .= $this->TABLE[$this->TYPES]. 	"='" . $this->getTypes() . "', ";
		$buf .= $this->TABLE[$this->MATH]. 		"='" . $this->getMathScores() . "', ";
		$buf .= $this->TABLE[$this->READING]. 	"='" . $this->getReadingScores() . "', ";
		$buf .= $this->TABLE[$this->WRITING]. 	"='" . $this->getWritingScores() . "', ";
		$buf .= $this->TABLE[$this->TOTAL]. 	"='" . $this->getTotalScores() . "', ";
		
		$buf .= $this->TABLE[$this->MSCORES]. 	"='" . $this->getMoyenScores() . "', ";
		$buf .= $this->TABLE[$this->LSCORES]. 	"='" . $this->getLowScores() . "', ";
		$buf .= $this->TABLE[$this->HSCORES]. 	"='" . $this->getHighScores() . "', ";
		
			
		$buf .= $this->TABLE[$this->DATES]. 	"='" . $this->getDates() . "', ";
		$buf .= $this->TABLE[$this->SEMESTER]. 	"='" . $this->getSemester() . "', ";
		$buf .= $this->TABLE[$this->PERIODS]. 	"='" . $this->getPeriods() . "', ";
		$buf .= $this->TABLE[$this->COMMENTS]. 	"='" . $this->getComments() . "', ";
		$buf .= $this->TABLE[$this->GROUPS]. 	"='" . $this->getGroups() . "'";

		
		return $buf;

	}
	

	function getScoresByID($id) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id);
			if ($elem) {
				$this->setScoresData($elem);
				$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}
	
	function getStudentScores($studentid, $subjects='', $semester='', $period='') {
		$lists = array();
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			
			$cond =  $this->TABLE[$this->STUDENTID]."='".$studentid."'";

			if ($subjects && strlen($subjects) > 1) {
				$cond .= " AND " .$this->TABLE[$this->SUBJECTS]. "='".$subjects."'";
			}
			if ($semester && strlen($semester) > 2 ) {
				$cond .= " AND " .$this->TABLE[$this->SEMESTER]. "='".$semester."'";
				
			}
			if ($period && strlen($period) == 4 ) {
				$cond .= " AND " .$this->TABLE[$this->PERIODS]. "='".$period."'";
			}

////			$elems =  $exec->get_order_elements_2($this->TABLE_NAME, $cond, $this->TABLE[$this->IDS]);
			$elems =  $exec->get_order_elements_2($this->TABLE_NAME, $cond, $this->TABLE[$this->DATES]);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$scores = new ScoreClass();
					$scores->setScoresData($elems[$i]);
					if (!$scores->isDeleted())
						$lists[] = $scores;
				}
			}
			$this->close();
		}
		return $lists;
	}

	function getTableName() {
		return $this->TABLE_NAME;
	}
	function getBackupTitle() {
		$text = "INSERT INTO " .$this->TABLE_NAME. " " .$this->buildTableRef(). " VALUES ";
		return $text;
	}
	
	function addStudentScores() {
		$ret = 0;
		if ($this->DATABASE_OK) {
			if ($this->_total) {
				$exec = $this->connect();
				if ($this->getID()) {
					$data = $this->getUpdateScoresData();
					$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
				}
				else {
					$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
					$this->setID($uid);
					
					$data = $this->getScoresData();
		
					$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
				}
				$this->close();
			}
			$ret = 1;
		}
		return $ret;
	}

	function updateStudentScores() {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			
			$data = $this->getUpdateScoresData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
			
			$this->close();
			
			$ret = 1;
		}
		return $ret;
	}

	function deleteStudentScores($del) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$this->setDeleted($del);
			$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->DELETED], $del);
			$this->close();
			
			$ret = 1;
		}
		return $ret;
	}	

	function updateScoresClassName() {
		$oldname =  $this->getClasses();
		$classname =  replaceOldClassName($oldname);
		if ($oldname != $classname) {
			$this->setClasses($classname);
			$exec = $this->connect();
			$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->CLASSES], $classname);
			$this->close();
		}
	}
	
	function getCreatTableString() {
		$buf = "CREATE TABLE IF NOT EXISTS " .$this->TABLE_NAME. "(" ."\n";
		$buf .= $this->TABLE[$this->IDS]. " INTEGER  NOT NULL AUTO_INCREMENT, " ."\n";
		$buf .= $this->TABLE[$this->STUDENTID] . " INTEGER NOT NULL, " ."\n";
		$buf .= $this->TABLE[$this->CLASSES] . " VARCHAR(64) NOT NULL, " ."\n";
		$buf .= $this->TABLE[$this->TEACHER] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->TITLES] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->SUBJECTS] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->TYPES] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->MATH] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->READING] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->WRITING] . " VARCHAR(32), " ."\n";	
		$buf .= $this->TABLE[$this->TOTAL] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->MSCORES] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->LSCORES] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->HSCORES] . " VARCHAR(32), " ."\n";	
		$buf .= $this->TABLE[$this->DATES] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->SEMESTER] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->PERIODS] . " INTEGER, " ."\n";
		$buf .= $this->TABLE[$this->COMMENTS] . " VARCHAR(512), " ."\n";
		$buf .= $this->TABLE[$this->GROUPS] . " INTEGER, " ."\n";	
		$buf .= $this->TABLE[$this->DELETED] . " CHAR(1), " ."\n";
		$buf .= "PRIMARY KEY (IDS) " ."\n";
		$buf .= ")ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;" ."\n";
		return $buf;
	}
}
?>
