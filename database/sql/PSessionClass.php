<?php
class PSessionClass {

	var $TABLE_NAME    	= "PSESSIONS";
	var $DATABASE_OK  	= 1;

	var $TABLE  = array(
		"IDS",
		"TEACHER",
		"SUBJECTS",
		"STUDENTID",
		"DATES",
		"BEGINNING",
		"ENDING",
		"REQUEST",
		"GRANTED",
		"CANCEL",
		"CONFIRMC",
		"LASTMODIFY",
		"DELETED"
	);

	var $IDS		= 0;
	var $TEACHER    = 1;
	var $SUBJECTS   = 2;
	var $STUDENTID	= 3;
	var $DATES      = 4;
	var $BEGINNING 	= 5;
	var $ENDING    	= 6;
	var $REQUEST    = 7;
	var $GRANTED   	= 8;
	var $CANCEL   	= 9;
	var $CONFIRMC  	= 10;
	var $LASTMODIFY	= 11;
	var $DELETED  	= 12;
	
	var $_id        = 0;
	var $_teacher   = "";
	var $_subjects  = "English";
	var $_studentid	= "";
	var $_dates     = "";
	var $_beginning	= "";
	var $_ending  	= "";
	var $_request   = "";
	var $_granted  	= "";
	var $_cancel	= "";
	var $_confirmc  = "";
	var $_lastmodify  = 0;
	var $_deleted  	= 0;
	

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

	function getTeacher() {
		return $this->_teacher;
	}
	function setTeacher($teacher) {
		$this->_teacher = $teacher;
	}

	function getSubjects() {
		return $this->_subjects;
	}
	function setSubjects($subjects) {
		$this->_subjects = $subjects;
	}
	
	function getStudentID() {
		return $this->_studentid;
	}
	function setStudentID($studentid) {
		$this->_studentid = $studentid;
	}

	function getDates() {
		return $this->_dates;
	}
	function getOrderDates() {
		return getOrderDate($this->_dates);
	}
	function setDates($dates) {
		$this->_dates = $dates;
	}
	
	function getBeginning() {
		return $this->_beginning;
	}
	function setBeginning($beginning) {
		$this->_beginning = $beginning;
	}
	function getEnding() {
		return $this->_ending;
	}
	function setEnding($ending) {
		$this->_ending = $ending;
	}
	
	
	function getRequest() {
		return $this->_request;
	}
	function setRequest($request) {
		$this->_request = $request;
	}
	
	function setGranted($granted) {
		$this->_granted = $granted;
	}
	function getGranted() {
		return $this->_granted;
	}
	function setCancel($cancel) {
		$this->_cancel = $cancel;
	}
	function getCancel() {
		return $this->_cancel;
	}

	function setConfirmCancel($confirm) {
		$this->_confirmc = $confirm;
	}
	function getConfirmCancel() {
		return $this->_confirmc;
	}
	function setLastModify($lastmodif) {
		$this->_lastmodify = $lastmodif;
	}
	function getLastModify() {
		return $this->_lastmodify;
	}
	
	function setDeleted($deleted) {
		$this->_deleted = $deleted;
	}
	function isDeleted() {
		if ($this->_beginning && $this->_ending )
			return $this->_deleted;
		else 
			return 1;
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
	

	function setData($courses) {
		$this->setID($courses["$this->IDS"]);
		$this->setTeacher($courses["$this->TEACHER"]);
		$this->setSubjects($courses["$this->SUBJECTS"]);
		$this->setStudentID($courses["$this->STUDENTID"]);
		$this->setDates($courses["$this->DATES"]);
		$this->setBeginning($courses["$this->BEGINNING"]);
		$this->setEnding($courses["$this->ENDING"]);
		$this->setRequest($courses["$this->REQUEST"]);
		$this->setGranted($courses["$this->GRANTED"]);
		$this->setCancel($courses["$this->CANCEL"]);
		$this->setConfirmCancel($courses["$this->CONFIRMC"]);
		$this->setLastModify($courses["$this->LASTMODIFY"]);
		$this->setDeleted($courses["$this->DELETED"]);
		
	}
	
	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getTeacher() . "', ";
		$buf .= "'" . $this->getSubjects() . "', ";
		$buf .= "'" . $this->getStudentID() . "', ";
		$buf .= "'" . getOrderDate($this->getDates()) . "', ";
		$buf .= "'" . getOrderTime($this->getBeginning()) . "', ";
		$buf .= "'" . getOrderTime($this->getEnding()) . "', ";
		$buf .= "'" . $this->getRequest() . "', ";
		$buf .= "'" . $this->getGranted() . "', ";
		$buf .= "'" . $this->getCancel() . "', ";
		$buf .= "'" . $this->getConfirmCancel() . "', ";
		$buf .= "'" . $this->getLastModify() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->TEACHER]. 	"='" . $this->getTeacher() . "', ";
		$buf .= $this->TABLE[$this->SUBJECTS]. 	"='" . $this->getSubjects() . "', ";
		$buf .= $this->TABLE[$this->DATES]. 	"='" . getOrderDate($this->getDates()) . "', ";
		$buf .= $this->TABLE[$this->BEGINNING]. "='" . getOrderTime($this->getBeginning()) . "', ";
		$buf .= $this->TABLE[$this->ENDING]. 	"='" . getOrderTime($this->getEnding()) . "', ";
		if ($this->getConfirmCancel()) {
			$buf .= $this->TABLE[$this->STUDENTID]. "='', ";
			$buf .= $this->TABLE[$this->REQUEST]. 	"='', ";
			$buf .= $this->TABLE[$this->GRANTED]. 	"='', ";
			$buf .= $this->TABLE[$this->CANCEL]. 	"='', ";
		}
		else {
			$buf .= $this->TABLE[$this->STUDENTID]. "='" . $this->getStudentID() . "', ";
			$buf .= $this->TABLE[$this->REQUEST]. 	"='" . $this->getRequest() . "', ";
			$buf .= $this->TABLE[$this->GRANTED]. 	"='" . $this->getGranted() . "', ";
			$buf .= $this->TABLE[$this->CANCEL]. 	"='" . $this->getCancel() . "', ";
		}
		$buf .= $this->TABLE[$this->CONFIRMC]. 	"='', ";
		$buf .= $this->TABLE[$this->LASTMODIFY]. "='".time()."'";
		return $buf;
	}
	

	function getSessionByID($id) {
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
	

	function getTableName() {
		return $this->TABLE_NAME;
	}
	
	function getBackupTitle() {
		$text = "INSERT INTO " .$this->TABLE_NAME. " " .$this->buildTableRef(). " VALUES ";
		return $text;
	}
	
	function addSession() {
		$ids = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$ids = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
			$this->setID($ids);
			$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $this->getData());
			$this->close();
		}
		return $ids;
	}

	function updateSession() {
		$ret = 0;
		if ($this->DATABASE_OK) {
			if ($this->_beginning && $this->_ending) {
				$exec = $this->connect();
				$data = $this->getUpdateData();
				$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
				
				$this->close();
			}
			else {
				$this->deleteSession(1);
			}
			$ret = 1;
		}
		return $ret;
	}

	function deleteSession($del) {
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
	
	function getCreatTableString() {
		$buf = "CREATE TABLE IF NOT EXISTS " .$this->TABLE_NAME. "(" ."\n";
		$buf .= $this->TABLE[$this->IDS]. " INTEGER  NOT NULL AUTO_INCREMENT, " ."\n";
		$buf .= $this->TABLE[$this->TEACHER] . " VARCHAR(128) NOT NULL, " ."\n";
		$buf .= $this->TABLE[$this->SUBJECTS] . " VARCHAR(64), " ."\n";
		$buf .= $this->TABLE[$this->STUDENTID] . " INTEGER, " ."\n";
		$buf .= $this->TABLE[$this->DATES] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->BEGINNING] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->ENDING] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->REQUEST] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->GRANTED] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->CANCEL] . " VARCHAR(32), " ."\n";	
		$buf .= $this->TABLE[$this->CONFIRMC] . " VARCHAR(32), " ."\n";	
		$buf .= $this->TABLE[$this->LASTMODIFY] . " INTEGER, " ."\n";
		$buf .= $this->TABLE[$this->DELETED] . " CHAR(1), " ."\n";
		$buf .= "PRIMARY KEY (IDS) " ."\n";
		$buf .= ")ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;" ."\n";
		return $buf;
	}
}
?>
