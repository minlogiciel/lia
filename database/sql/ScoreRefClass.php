<?php
class ScoreRefClass {

	var $TABLE_NAME    	= "SCORES_REF";
	var $DATABASE_OK  	= 1;

	var $TABLE  = array(
		"IDS",
		"CLASSES",
		"GROUPS",
		"SUBJECTS",
		"TYPES",
		"SEMESTER",
		"PERIODS",
		"DATES",
		"DELETED",
	);

	var $IDS		= 0;
	var $CLASSES  	= 1;
	var $GROUPS 	= 2;
	var $SUBJECTS   = 3;
	var $TYPES      = 4;
	var $SEMESTER  	= 5;
	var $PERIODS  	= 6;
	var $DATES  	= 7;
	var $DELETED  	= 8;
	
	var $_id        = 0;
	var $_classes	= 10;
	var $_groups	= 1;
	var $_subjects  = "";
	var $_types  	= "";
	var $_semester 	= "";
	var $_periods 	= 2010;
	var $_dates 	= '';
	var $_deleted 	= 0;
	

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

	function getClasses() {
		return $this->_classes;
	}
	function setClasses($classes) {
		$this->_classes = $classes;
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
	
	function setGroups($group) {
		$this->_groups = $group;
	}
	function getGroups() {
		return $this->_groups;
	}

	function setDates($dates) {
		$this->_dates = $dates;
	}
	
	function getDates() {
		if(!$this->_dates)
			$this->_dates = date("m/d");
		return $this->_dates;
		
	}
	function setDeleted($deleted) {
		$this->_deleted = $deleted;
	}
	function isDeleted() {
		return $this->_deleted;
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
	
	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getClasses() . "', ";
		$buf .= "'" . $this->getGroups() . "', ";
		$buf .= "'" . $this->getSubjects() . "', ";
		$buf .= "'" . $this->getTypes() . "', ";
		$buf .= "'" . $this->getSemester() . "', ";
		$buf .= "'" . $this->getPeriods() . "', ";
		$buf .= "'" . $this->getDates() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}

	function setData($elem) {
		$this->setID($elem["$this->IDS"]);
		$this->setClasses($elem["$this->CLASSES"]);
		$this->setGroups($elem["$this->GROUPS"]);
		$this->setSubjects($elem["$this->SUBJECTS"]);
		$this->setTypes($elem["$this->TYPES"]);
		$this->setSemester($elem["$this->SEMESTER"]);
		$this->setPeriods($elem["$this->PERIODS"]);
		$this->setDates($elem["$this->DATES"]);
		$this->setDeleted($elem["$this->DELETED"]);
	}
	
	
	function rrreadScoresRef($classes, $subjects, $semester, $period) {
		$lists = array();
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			
			$classname 	= getClassName($classes);
			$cond  = $this->TABLE[$this->CLASSES]. 	"='" .$classname. 	"'" ;
			if ($subjects) {
				$cond .= " AND " .$this->TABLE[$this->SUBJECTS]. "='" .$subjects."'";	
			}
			if ($semester) {
				$cond .= " AND " .$this->TABLE[$this->SEMESTER]. 	"='" .$semester.	"'";
			}
			if ($period) {
				$cond .= " AND " .$this->TABLE[$this->PERIODS]. 	"='" .$period.	"'";
			}

			$sql = "SELECT * FROM " .$this->TABLE_NAME. " WHERE ".$cond." ORDER BY ".$this->TABLE[$this->SUBJECTS]. " DESC, ".$this->TABLE[$this->DATES]." DESC";
			$p = $exec->get_query($sql);
			if ($p)
			{
				while ($data = @mysql_fetch_array($p)) {
					$ref = new ScoreRefClass();
					$ref->setData($data);
					if (!$ref->isDeleted()) {
						$lists[] = $ref;
					}
				}
			}
			$this->close();
		}
		return $lists;
	}
	function readScoresRef($classes, $subjects, $semester, $period) {
		$lists = array();
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			
			$classname 	= getClassName($classes);
			if (isCombinedClass($classname)) {
				$cond  = $this->TABLE[$this->CLASSES]. 	" LIKE'%" .$classname. 	"%' " ;
			}
			else {
				$cond  = $this->TABLE[$this->CLASSES]. 	"='" .$classname. 	"'" ;
			}
			if ($subjects) {
				if (strstr($subjects, "Earth")) {
					$cond .= " AND (" .$this->TABLE[$this->SUBJECTS]. "='" .$subjects."' OR " .$this->TABLE[$this->SUBJECTS]. "='Earth')";
				}
				else {
					$cond .= " AND " .$this->TABLE[$this->SUBJECTS]. "='" .$subjects."'";	
				}
			}
			if ($semester) {
				$cond .= " AND " .$this->TABLE[$this->SEMESTER]. 	"='" .$semester.	"'";
			}
			if ($period) {
				$cond .= " AND " .$this->TABLE[$this->PERIODS]. 	"='" .$period.	"'";
			}

//			$elems =  $exec->get_order_elements_2($this->TABLE_NAME, $cond, $this->TABLE[$this->IDS]);
//			$elems =  $exec->get_order_elements_2($this->TABLE_NAME, $cond, $this->TABLE[$this->DATES]);
			$elems =  $exec->get_order_elements_asc($this->TABLE_NAME, $cond, $this->TABLE[$this->DATES]);
			
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$ref = new ScoreRefClass();
					$ref->setData($elems[$i]);
					if (!$ref->isDeleted()) {
						$lists[] = $ref;
					}
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

	function getScoresRefByID($id) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id);
			if ($elem) {
				$this->setData($elem);
				$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}
	
	function updateScoresRefDate($dates, $group) {
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$sql  = "UPDATE " .$this->TABLE_NAME. " SET " .$this->TABLE[$this->DATES]. "='" .$dates. "' ";
			$sql .= " WHERE " .$this->TABLE[$this->GROUPS]. "='" .$group. "'"; 
			$exec->exec_query($sql);
			$this->close();			
		}
	}
	
	/* change old class name */
	function updateScoresRefClassName() {
		$oldname =  $this->getClasses();
		$classname =  replaceOldClassName($oldname);
		if ($oldname != $classname) {
			$this->setClasses($classname);
			$exec = $this->connect();
			$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->CLASSES], $classname);
			$this->close();
		}
	}
	
	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->SUBJECTS]. 	"='" . $this->getSubjects() . "', ";
		$buf .= $this->TABLE[$this->TYPES]. 	"='" . $this->getTypes() . "', ";
		$buf .= $this->TABLE[$this->SEMESTER]. 	"='" . $this->getSemester() . "', ";
		$buf .= $this->TABLE[$this->PERIODS]. 	"='" . $this->getPeriods() . "', ";
		$buf .= $this->TABLE[$this->DATES]. 	"='" . $this->getDates() . "'";
		return $buf;
	}
	
	
	function updateScoresRef() {
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			
			$data = $this->getUpdateData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
			
			$this->close();
			set_base_changed(1, $this->TABLE_NAME);
		}
	}
	
	function deleteScores($id ) {
		if ($this->DATABASE_OK) {
			$exec = $this->connect();

			$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id, $this->TABLE[$this->DELETED], 1);

			$this->close();
			
		}
	}
	
	function addScoresRef() {
		$uid = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			if ($this->getID()) {
				$uid = $this->getID();
				$data = $this->getUpdateData();
				$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
			}
			else {
				$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
				$this->setID($uid);
				$this->setGroups($uid);
				$data = $this->getData();
				$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
			}
			$this->close();
			set_base_changed(1, $this->TABLE_NAME);
		}
		return $uid;
	}
	
	function getCreatTableString() {
		$buf = "CREATE TABLE IF NOT EXISTS " .$this->TABLE_NAME. "(" ."\n";
		$buf .= $this->TABLE[$this->IDS]. " INTEGER  NOT NULL AUTO_INCREMENT, " ."\n";
		$buf .= $this->TABLE[$this->CLASSES] . " VARCHAR(64) NOT NULL, " ."\n";
		$buf .= $this->TABLE[$this->GROUPS] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->SUBJECTS] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->TYPES] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->SEMESTER] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->PERIODS] . " INTEGER, " ."\n";
		$buf .= $this->TABLE[$this->DATES] . " VARCHAR(512), " ."\n";
		$buf .= $this->TABLE[$this->DELETED] . " CHAR(1), " ."\n";
		$buf .= "PRIMARY KEY (IDS) " ."\n";
		$buf .= ")ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;" ."\n";
		return $buf;
	}
	
}
?>
