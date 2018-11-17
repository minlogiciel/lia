<?php
class TuitionClass {

	var $TABLE_NAME    	= "STUITION";
	var $DATABASE_OK  	= 1;

	var $TABLE  = array(
		"IDS",
		"STUDENTID",
		"SEMESTER",
		"PERIODS",
		"TUITION",
		"BUSES",
		"BOOKS",
		"TENNIS",
		"OTHERS",
		"PAID",
		"BALANCE_F",
		"BALANCE_F_S",
	);

	var $IDS		= 0;
	var $STUDENTID	= 1;
	var $SEMESTER  	= 2;
	var $PERIODS  	= 3;
	var $TUITION    = 4;
	var $BUSES  	= 5;
	var $BOOKS  	= 6;
	var $TENNIS 	= 7;
	var $OTHERS 	= 8;
	var $PAID 		= 9;
	var $BALANCE_F 	= 10;
	var $BALANCE_F_S= 11;
	
	var $_id        = 0;
	var $_studentid = 0;
	var $_semester  = "";
	var $_periods  	= 2011;
	var $_tuition  	= 0;
	var $_buses    	= 0;
	var $_books		= 0;
	var $_tennis	= 0;
	var $_others	= 0;
	var $_paid		= 0;
	var $_balance_f	= 0;
	var $_balance_f_s	= "";
	

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
	
	function getTuition() {
		return $this->_tuition;
	}
	function setTuition($tuition) {
		$this->_tuition = $tuition;
	}
	function getPaid() {
		return $this->_paid;
	}
	function setPaid($paid) {
		$this->_paid = $paid;
	}
	
	function getBuses() {
		return $this->_buses;
	}
	function setBuses($buses) {
		$this->_buses = $buses;
	}
	
	
	function getBooks() {
		return $this->_books;
	}
	function setBooks($books) {
		$this->_books = $books;
	}
	
	function setTennis($tennis) {
		$this->_tennis = $tennis;
	}
	function getTennis() {
		return $this->_tennis;
	}
	
	function setOthers($others) {
		$this->_others = $others;
	}
	function getOthers() {
		return $this->_others;
	}
	
	function setBalanceF($balance) {
		$this->_balance_f = $balance;
	}
	function getBalanceF() {
		return $this->_balance_f;
	}
	
	function setBalanceFSemester($bfsemester) {
		$this->_balance_f_s = $bfsemester;
	}
	function getBalanceFSemester() {
		return $this->_balance_f_s;
	}
	
	
	function setData($elem) {
		$this->setID($elem["$this->IDS"]);
		$this->setStudentID($elem["$this->STUDENTID"]);
		$this->setSemester($elem["$this->SEMESTER"]);
		$this->setPeriods($elem["$this->PERIODS"]);
		$this->setTuition($elem["$this->TUITION"]);
		$this->setBuses($elem["$this->BUSES"]);
		$this->setBooks($elem["$this->BOOKS"]);
		$this->setTennis($elem["$this->TENNIS"]);
		$this->setPaid($elem["$this->PAID"]);
		$this->setOthers($elem["$this->OTHERS"]);
		$this->setBalanceF($elem["$this->BALANCE_F"]);
		$this->setBalanceFSemester($elem["$this->BALANCE_F_S"]);
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
		$buf .= "'" . $this->getStudentID() . "', ";
		$buf .= "'" . $this->getSemester() . "', ";
		$buf .= "'" . $this->getPeriods() . "', ";
		$buf .= "'" . $this->getTuition() . "', ";
		$buf .= "'" . $this->getBuses() . "', ";
		$buf .= "'" . $this->getBooks() . "', ";
		$buf .= "'" . $this->getTennis() . "', ";
		$buf .= "'" . $this->getOthers() . "', ";
		$buf .= "'" . $this->getPaid() . "', ";
		$buf .= "'" . $this->getBalanceF() . "', ";
		$buf .= "'" . $this->getBalanceFSemester() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->STUDENTID]. "='" . $this->getStudentID() . "', ";
		$buf .= $this->TABLE[$this->SEMESTER]. 	"='" . $this->getSemester() . "', ";
		$buf .= $this->TABLE[$this->PERIODS]. 	"='" . $this->getPeriods() . "', ";
		$buf .= $this->TABLE[$this->TUITION]. 	"='" . $this->getTuition() . "', ";
		$buf .= $this->TABLE[$this->BUSES]. 	"='" . $this->getBuses() . "', ";
		$buf .= $this->TABLE[$this->BOOKS]. 	"='" . $this->getBooks() . "', ";
		$buf .= $this->TABLE[$this->TENNIS]. 	"='" . $this->getTennis() . "', ";
		$buf .= $this->TABLE[$this->OTHERS]. 	"='" . $this->getOthers() . "', ";
		$buf .= $this->TABLE[$this->PAID]. 	"='" . $this->getPaid() . "', ";
		$buf .= $this->TABLE[$this->BALANCE_F]. 	"='" . $this->getBalanceF() . "', ";
		$buf .= $this->TABLE[$this->BALANCE_F_S]. 	"='" . $this->getBalanceFSemester() . "'";
		return $buf;
	}
	
	function getStudentTuition($studentid, $semester, $period) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			
			$cond =  $this->TABLE[$this->STUDENTID]."='".$studentid."'";
			$cond .= " AND " .$this->TABLE[$this->SEMESTER]. "='".$semester."'";
			$cond .= " AND " .$this->TABLE[$this->PERIODS]. "='".$period."'";
			
			$elem =  $exec->get_element_1($this->TABLE_NAME, $cond);
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
	
	function addStudentTuition() {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
			$this->setID($uid);
			
			$data = $this->getData();

			$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
			
			$this->close();
			
			$ret = 1;
		}
		return $ret;
	}

	function updateStudentTuition() {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			
			$data = $this->getUpdateData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);

		
			$this->close();
			
			$ret = 1;
		}
		return $ret;
	}
}
?>
