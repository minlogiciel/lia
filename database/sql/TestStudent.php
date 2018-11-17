<?php
class TestStudent {

	var $TABLE_NAME    	= "TTSTUDENTS";
	
	var $TABLE  = array(
		"IDS",
		"STUDENTID",
		"CIVIL",
		"LASTNAME",
		"FIRSTNAME",
		"EMAIL",
		"GRADE",
		"CLASSES",
		"PHONE",
		"MOBILE",
		"ANNEE",
		"MATH",
		"ENGLISH",
		"TOTAL",
		"COMMENTS",
		"DELETED",
	);

	var $IDS		= 0;
	var $STUDENTID  = 1;
	var $CIVIL      = 2;
	var $LASTNAME   = 3;
	var $FIRSTNAME  = 4;
	var $EMAIL      = 5;
	var $GRADE  	= 6;
	var $CLASSES  	= 7;
	var $PHONE     	= 8;
	var $MOBILE    	= 9;	
	var $ANNEE    	= 10;	
	var $MATH 		= 11;
	var $ENGLISH  	= 12;
	var $TOTAL		= 13;
	var $COMMENTS   = 14;
	var $DELETED    = 15;


	var $_id        = 0;
	var $_studentid	= "";
	var $_civil		= "M";
	var $_lastname	= "";
	var $_firstname	= "";
	var $_email     = "";
	var $_grade		= 2;
	var $_classes	= "";
	var $_phone		= "";
	var $_mobile	= "";	
	var $_anneee	= 2013;
	var $_math		= 0;
	var $_english	= 0;
	var $_total		= 0;
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

	function replace($str) {
		$newstr = "";
		if ($str) {
			$newstr = htmlspecialchars($str, ENT_NOQUOTES);
			$newstr = str_replace ('\"', "&quot;", $newstr);
			$newstr = str_replace ("\'", "&#039", $newstr);
		}
		return $newstr;
	}
		
	function getID() {
		return $this->_id;
	}
	function setID($id) {
		$this->_id = $id;
	}
	
	function getStudentId() {
		return $this->_studentid;
	}
	function getStudentNo() {
		return $this->_studentid;
	}
	function setStudentId($studentid) {
		$this->_studentid = $studentid;
	}
	
	function getCivil() {
		return $this->_civil;
	}
	function setCivil($civil) {
		$this->_civil = $civil;
	}
	
	function getFirstName() {
		return $this->_firstname;
	}
	function setFirstName($name) {
		$this->_firstname = $this->replace($name);
	}
	
	function getLastName() {
		return $this->_lastname;
	}
	function setLastName($name) {
		$this->_lastname = $this->replace($name);
	}
		
	function getEmail() {
		return $this->_email;
	}
	function setEmail($email) {
		$this->_email = $email;
	}

	function getClasses() {
		return $this->_classes;
	}
	function setClasses($classes) {
		$this->_classes = $classes;
	}
	function getGrade() {
		return $this->_grade;
	}
	function setGrade($grade) {
		$this->_grade = $grade;
	}

	function getPhone() {
		return $this->_phone;
	}
	function setPhone($phone) {
		$this->_phone = $phone;
	}

	function getMobile() {
		return $this->_mobile;
	}
	function setMobile($mobile) {
		$this->_mobile = $mobile;
	}
	
	function getAnnee() {
		return $this->_annee;
	}
	function setAnnee($annee) {
		$this->_annee = $annee;
	}
	
	function getMath() {
		return $this->_math;
	}
	function setMath($math) {
		$this->_math = $math;
	}
	
	function getEnglish() {
		return $this->_english;
	}
	function setEnglish($english) {
		$this->_english = $english;
	}

	function getTotal() {
		return (int)($this->_english + $this->_math);
	}
		
	function getComments() {
		return $this->_comments;
	}
	function setComments($comments) {
		$this->_comments = $comments;
	}
	
	function isDeleted() {
		if ($this->_grade > 12 || $this->_grade < 2)
			$this->_deleted = 1;
		return $this->_deleted;
	}
	function setDeleted($deleted) {
		$this->_deleted = $deleted;
	}
	
	function getShortStudentName() {
		if (strlen($this->_firstname) > 5)
			$str = substr($this->_firstname,0,5);
		else 
			$str = $this->_firstname;
		if ($this->_lastname && $this->_lastname[0] != '?')
			$str .= " " .$this->_lastname[0]. ".";
		return $str;
	}
	
	function getStudentName() {
		return $this->_firstname. " " . $this->_lastname;
	}

	function isTestStudent() {
		return 1;
	}
	
	function findStudent($name) {
		$ret = 0;

		$listname  = explode(" ", $name);
		$nn = count($listname)-1;
		$cond  	=  "ANNEE='".date('Y')."' AND ";
		if (count($listname) > 0) {
			$cond  .=  $this->TABLE[$this->FIRSTNAME]. "='" .$listname[0]. 	"' AND ";
			$cond  .=  $this->TABLE[$this->LASTNAME]. 	"='" .$listname[$nn]. 	"'";
		}
		else {
			$cond  .= $this->TABLE[$this->FIRSTNAME]. "='" .$listname[0]. 	"' OR ";
			$cond  .= $this->TABLE[$this->LASTNAME]. 	"='" .$listname[0]. 	"'";
		}
		$exec = $this->connect();
		$elem = $exec->get_element_1($this->TABLE_NAME, $cond);
		if ($elem) {
			$this->setStudentData($elem);
			$ret = 1;
		}
		$this->close();
		
		return $ret;
	}
	
	
	function setStudentData($auser) {
		$this->setID($auser["$this->IDS"]);
		$this->setStudentId($auser["$this->STUDENTID"]);
		$this->setCivil($auser["$this->CIVIL"]);
		$this->setLastName($auser["$this->LASTNAME"]);
		$this->setFirstName($auser["$this->FIRSTNAME"]);
		$this->setEmail($auser["$this->EMAIL"]);
		$this->setGrade($auser["$this->GRADE"]);
		$this->setClasses($auser["$this->CLASSES"]);
		$this->setPhone($auser["$this->PHONE"]);
		$this->setMobile($auser["$this->MOBILE"]);
		$this->setAnnee($auser["$this->ANNEE"]);
		$this->setMath($auser["$this->MATH"]);
		$this->setEnglish($auser["$this->ENGLISH"]);
		$this->setComments($auser["$this->COMMENTS"]);
		$this->setDeleted($auser["$this->DELETED"]);
	}
	
	
	function getStudentData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getStudentId() . "', ";
		$buf .= "'" . $this->getCivil() . "', ";
		$buf .= "'" . $this->getLastName() . "', ";
		$buf .= "'" . $this->getFirstName() . "', ";
		$buf .= "'" . $this->getEmail() . "', ";
		$buf .= "'" . $this->getGrade() . "', ";
		$buf .= "'" . $this->getClasses() . "', ";
		$buf .= "'" . $this->getPhone() . "', ";
		$buf .= "'" . $this->getMobile() . "', ";
		$buf .= "'" . $this->getAnnee() . "', ";		
		$buf .= "'" . $this->getMath() . "', ";
		$buf .= "'" . $this->getEnglish() . "', ";
		$buf .= "'" . $this->getTotal() . "', ";
		$buf .= "'" . $this->getComments() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
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
	
	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->STUDENTID]. "='" . $this->getStudentId() . "', ";
		$buf .= $this->TABLE[$this->CIVIL]. 	"='" . $this->getCivil() . "', ";
		$buf .= $this->TABLE[$this->LASTNAME]. 	"='" . $this->getLastName() . "', ";
		$buf .= $this->TABLE[$this->FIRSTNAME]. "='" . $this->getFirstName() . "', ";
		$buf .= $this->TABLE[$this->EMAIL]. 	"='" . $this->getEmail() . "', ";
		$buf .= $this->TABLE[$this->GRADE]. 	"='" . $this->getGrade() . "', ";
		$buf .= $this->TABLE[$this->CLASSES]. 	"='" . $this->getClasses() . "', ";
		$buf .= $this->TABLE[$this->PHONE]. 	"='" . $this->getPhone() . "', ";
		$buf .= $this->TABLE[$this->MOBILE]. 	"='" . $this->getMobile() . "', ";
		$buf .= $this->TABLE[$this->COMMENTS]. 	"='" . $this->getComments() . "'";	
		return $buf;
	}

	function getUpdateScoresData() {
		$buf = "";
		$buf .= $this->TABLE[$this->MATH]. 		"='" . $this->getMath() . "', ";
		$buf .= $this->TABLE[$this->ENGLISH]. 	"='" . $this->getEnglish() . "'";
		return $buf;
	}
	function getUpdateClassesData() {
		$buf = "";
		$buf .= $this->TABLE[$this->CLASSES]. 	"='" . $this->getClasses() . "', ";
		$buf .= $this->TABLE[$this->GRADE]."='" .$this->getGrade(). "'";
		return $buf;
	}
	
	function addStudent() {
		$exec = $this->connect();
		$uid = $this->getID();
		if ($uid  == 0) {
			$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
			if ($uid < 100)
				$uid = 100;
			$this->setID($uid);
			$this->setAnnee(date("Y"));
			$data = $this->getStudentData();
			$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
		}
		else {
			$data = $this->getUpdateData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $uid, $data);
		}
		$this->close();
	}

	function updateScores() {
		$exec = $this->connect();
		$uid = $this->getID();
		if ($uid) {
			$data = $this->getUpdateScoresData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $uid, $data);
		}
		$this->close();
	}
	function updateClasses() {
		$exec = $this->connect();
		$uid = $this->getID();
		if ($uid) {
			$data = $this->getUpdateClassesData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $uid, $data);
		}
		$this->close();
	}
	
	function getStudent($studentid) {
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->STUDENTID], $studentid);
		if ($elem) {
			$this->setStudentData($elem);
		}
		$this->close();
		return $elem;
	}
	
	function getStudentByID($id) {
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id);
		if ($elem) {
			$this->setStudentData($elem);
		}
		$this->close();
		return $elem;
	}

	
	function getTableName() {
		return $this->TABLE_NAME;
	}

	function getBackupTitle() {
		$text = "INSERT INTO " .$this->TABLE_NAME. " " .$this->buildTableRef(). " VALUES \n";
		return $text;
	}
	
	function getCreatTableString() {
		$buf = "CREATE TABLE IF NOT EXISTS " .$this->TABLE_NAME. "(" ."\n";
		$buf .= $this->TABLE[$this->IDS]. 		" INTEGER  NOT NULL AUTO_INCREMENT, " ."\n";
		$buf .= $this->TABLE[$this->STUDENTID] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->CIVIL] . 	" CHAR(1), " ."\n";
		$buf .= $this->TABLE[$this->LASTNAME] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->FIRSTNAME] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->EMAIL] . 	" VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->GRADE] . 	" INTEGER, " ."\n";
		$buf .= $this->TABLE[$this->CLASSES] . 	" VARCHAR(16), " ."\n";
		$buf .= $this->TABLE[$this->PHONE] . 	" VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->MOBILE] . 	" VARCHAR(32), " ."\n";	
		$buf .= $this->TABLE[$this->ANNEE] . 	" INTEGER, " ."\n";
		$buf .= $this->TABLE[$this->MATH]. 		" INTEGER, " ."\n";
		$buf .= $this->TABLE[$this->ENGLISH] . 	" INTEGER, " ."\n";
		$buf .= $this->TABLE[$this->TOTAL] . 	" INTEGER, " ."\n";
		$buf .= $this->TABLE[$this->COMMENTS] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->DELETED] . 	" CHAR(1), " ."\n";
		$buf .= "PRIMARY KEY (IDS) 			" ."\n";
		$buf .= ")ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;" ."\n\n";
		return $buf;
	}
}
?>
