<?php
class TestScoreClass {

	var $TABLE_NAME    	= "TESTSCORES";

	var $TABLE  = array(
		"IDS",
		"STUDENTID",
		"MATH",
		"ENGLISH",
		"TOTAL",
	);

	var $IDS		= 0;
	var $STUDENTID	= 1;
	var $MATH    	= 2;
	var $ENGLISH   	= 3;
	var $TOTAL   	= 4;
	
	var $_id        = 0;
	var $_studentid = 0;
	var $_english   = 0;
	var $_math  	= 0;
	var $_total  	= 0;

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
	
	function getMathScores() {
		return $this->_math;
	}
	function setMathScores($scores) {
		$this->_math = $scores;
	}
	function getEnglishScores() {
		return $this->_english;
	}
	function setEnglishScores($scores) {
		$this->_english = $scores;
	}
	function getTotalScores() {
		return $this->_total;
	}
	function setTotalScores($scores) {
		$this->_total = $scores;
	}

	function setScoresData($scores) {
		$this->setID($scores["$this->IDS"]);
		$this->setStudentID($scores["$this->STUDENTID"]);
		$this->setMathScores($scores["$this->MATH"]);
		$this->setEnglishScores($scores["$this->ENGLISH"]);
		$this->setTotalScores($scores["$this->TOTAL"]);
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
		$buf .= "'" . $this->getMathScores() . "', ";
		$buf .= "'" . $this->getEnglishScores() . "', ";
		$buf .= "'" . $this->getTotalScores() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateScoresData() {
		$buf = "";
		$buf .= $this->TABLE[$this->STUDENTID]. "='" . $this->getStudentID() . "', ";
		$buf .= $this->TABLE[$this->MATH]. 		"='" . $this->getMathScores() . "', ";
		$buf .= $this->TABLE[$this->ENGLISH]. 	"='" . $this->getEnglishScores(). "', ";
		$buf .= $this->TABLE[$this->TOTAL]. 	"='" . $this->getTotalScores() . "'";
		return $buf;
	}
	
	function getScores($studentid) {
		$ret = 0;
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->STUDENTID], $studentid);
		if ($elem) {
			$this->setScoresData($elem);
			$ret = 1;
		}
		$this->close();
		return $ret;
	}

	
	function addScores() {
		$exec = $this->connect();
		$uid = $this->getID();
		if ($uid == 0) {
			$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
			$this->setID($uid);
			$data = $this->getScoresData();
			$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
		}
		else {
			$data = $this->getUpdateScoresData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		}			
		$this->close();
	}

	function getTableName() {
		return $this->TABLE_NAME;
	}
	function getBackupTitle() {
		$text = "INSERT INTO " .$this->TABLE_NAME. " " .$this->buildTableRef(). " VALUES ";
		return $text;
	}
	function getCreatTableString() {
		$buf = "CREATE TABLE IF NOT EXISTS " .$this->TABLE_NAME. "(" ."\n";
		$buf .= $this->TABLE[$this->IDS]. " INTEGER  NOT NULL AUTO_INCREMENT, " ."\n";
		$buf .= $this->TABLE[$this->STUDENTID] . " INTEGER NOT NULL, " ."\n";
		$buf .= $this->TABLE[$this->MATH] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->ENGLISH] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->TOTAL] . " VARCHAR(32), " ."\n";
		$buf .= "PRIMARY KEY (IDS), " ."\n";
		$buf .= "UNIQUE(STUDENTID) " ."\n";
		$buf .= ")ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;" ."\n";
		return $buf;
	}
}
?>
