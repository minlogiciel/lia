<?php
class TestDetailClass {

	var $TABLE_NAME    	= "TESTDETAILS";
	var $MAX_DETAIL_ITEM = 20; /* =10*2 */
	var $OTHER_ITEM = 6;
	
	var $TABLE  = array(
		"IDS",
		"STUDENTID",
		"QUESTIONS",
		"ROWSCORES",
		"PERSCORES",
		"TESTDATE"
	);
	var $ITEMS_NAME  = "ITEMS_";
	var $DELETED_STR  = "DELETED";
	
	var $IDS			= 0;
	var $STUDENTID		= 1;
	var $QUESTIONS		= 2;
	var $ROWSCORE		= 3;
	var $PERSCORE		= 4;
	var $TESTDATE		= 5;
	
	var $_id        	= 0;
	var $_studentid 	= 0;
	var $_questions		= "";
	var $_rowscore		= "";
	var $_perscore		= "";
	var $_testdate 		= "";
	var $_items 		= array();
	var $_deleted 		= 0;
	
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
	function getQuestions() {
		return $this->_questions;
	}
	function setQuestions($questions) {
		$this->_questions = $questions;
	}
	function getRowScore() {
		return $this->_rowscore;
	}
	function setRowScore($rowscore) {
		$this->_rowscore = $rowscore;
	}
	function getPerScore() {
		return $this->_perscore;
	}
	function setPerScore($perscore) {
		$this->_perscore = $perscore;
	}

	function getTestDate() {
		return $this->_testdate;
	}
	function setTestDate($testdate) {
		$this->_testdate = $testdate;
	}

	function isDeleted() {
		return $this->_deleted;
	}
	function setDeleted($deleted) {
		$this->_deleted = $deleted;
	}
	

	function getDetailItems() {
		return $this->_items;
	}
	
	function setDetailItems($items) {
		$this->_items = $items;
	}
	
	function setScoresData($scores) {
		$this->setID($scores["$this->IDS"]);
		$this->setStudentID($scores["$this->STUDENTID"]);
		$this->setQuestions($scores["$this->QUESTIONS"]);
		$this->setRowScore($scores["$this->ROWSCORE"]);
		$this->setPerScore($scores["$this->PERSCORE"]);
		$this->setTestDate($scores["$this->TESTDATE"]);
		
		$this->_items = array();
		for ($i = 0; $i < $this->MAX_DETAIL_ITEM; $i++) {
			$n = $this->OTHER_ITEM + $i;
			$this->_items[$i] = $scores["$n"];
		}
	}
	
	function getScoresData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getStudentID() . "', ";
		$buf .= "'" . $this->getQuestions() . "', ";
		$buf .= "'" . $this->getRowScore() . "', ";
		$buf .= "'" . $this->getPerScore() . "', ";
		$buf .= "'" . $this->getTestDate() . "', ";

		for ($i = 0; $i < $this->MAX_DETAIL_ITEM; $i++) {
			$buf .= "'" . $this->_items[$i] . "', ";
		}
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateScoresData() {
		$buf = "";
		$buf .= $this->TABLE[$this->STUDENTID]. "='" . $this->getStudentID() . "', ";
		$buf .= $this->TABLE[$this->QUESTIONS]. "='" . $this->getQuestions() . "', ";
		$buf .= $this->TABLE[$this->ROWSCORE]. 	"='" . $this->getRowScore() . "', ";
		$buf .= $this->TABLE[$this->PERSCORE]. 	"='" . $this->getPerScore() . "', ";
		$buf .= $this->TABLE[$this->TESTDATE]. 	"='" . $this->getTestDate() . "', ";

		for ($i = 0; $i < $this->MAX_DETAIL_ITEM; $i++) {
			$buf .= $this->ITEMS_NAME.$i. "='" . $this->_items[$i] . "', ";
		}
		$buf .= $this->DELETED_STR. 	"='" . $this->isDeleted() . "'";
	
		return $buf;
	}
	

	function getTestDetailByID($id) {
		$ret = 0;
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id);
		if ($elem) {
			$this->setScoresData($elem);
			$ret = 1;
		}
		$this->close();
		return $ret;
	}
	
	function getStudentTestDetail($studentid) {
		$exec = $this->connect();
		$ret = 0;
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->STUDENTID], $studentid);
		if ($elem) {
			$this->setScoresData($elem);
			$ret = 1;
		}
		$this->close();
		return $ret;
	}

	function buildTableRef() {
		$buf = "(";
		for ($i= 0; $i < count($this->TABLE); $i++) {
			$buf .= $this->TABLE[$i] . ", ";
		}
		
		for ($i = 0; $i < $this->MAX_DETAIL_ITEM; $i++) {
			$buf .= $this->ITEMS_NAME.$i. ", ";
		}
		$buf .= $this->DELETED_STR;
		$buf .= ")";
		return $buf;
	}
	
	
	function addStudentTestDetails() {
		$exec = $this->connect();
		$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
		$this->setID($uid);
				
		$data = $this->getScoresData();
	
		$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
				
		$this->close();
	}

	function updateStudentTestDetails() {
		$exec = $this->connect();
			
		$data = $this->getUpdateScoresData();
		$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
			
		$this->close();
	}

	function deleteStudentTestDetails($del) {
		$exec = $this->connect();
		$this->setDeleted($del);
		$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->DELETED], $del);
		$this->close();
		return $ret;
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
		$buf .= $this->TABLE[$this->SCORES] . " VARCHAR(64) NOT NULL, " ."\n";
		$buf .= $this->TABLE[$this->VOCABULARY] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->SPELLING] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->CAPITALIZATION] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->PUNCTUATION] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->USAGE] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->READING] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->DELETED] . " CHAR(1), " ."\n";
		$buf .= "PRIMARY KEY (IDS) " ."\n";
		$buf .= ")ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;" ."\n";
		return $buf;
	}
}
?>
