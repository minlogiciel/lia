<?php
class StudentTestClass {

	var $TABLE_NAME    	= "TESTSTUDENTS";
	
	var $TABLE  = array(
		"IDS",
		"PSEUDO",
		"EMAIL",
		"PASSWD",
		"CIVIL",
		"LASTNAME",
		"FIRSTNAME",
		"STREET1",
		"STREET2",
		"CITY",
		"POSTCODE",
		"DEPARTEMENT",
		"COUNTRY",
		"PHONE",
		"MOBILE",
		"BIRTHDAY",
		"CLASSES",
		"RM",
		"GRADE",
		"CURRGRADE",
		"REGISTDATE",
		"LASTLOGIN",
		"LASTMODIFY",
		"COMMENTS",
		"ISDELETED",
	);

	var $IDS		= 0;
	var $PSEUDO     = 1;
	var $EMAIL      = 2;
	var $PASSWD    	= 3;
	var $CIVIL      = 4;
	var $LASTNAME   = 5;
	var $FIRSTNAME  = 6;
	var $STREET1    = 7;
	var $STREET2   	= 8;
	var $CITY      	= 9;
	var $POSTCODE  	= 10;
	var $PROVENCE  	= 11;
	var $COUNTRY   	= 12;
	var $PHONE     	= 13;
	var $MOBILE    	= 14;

	var $BIRTHDAY   = 15;
	var $CLASSES  	= 16;
	var $STUDENTNO  = 17;
	var $GRADE    	= 18;
	var $CURRGRADE	= 19;
	
	var $REGISTDATE = 20;
	var $LASTLOGIN  = 21;
	var $LASTMODIFY	= 22;
	var $COMMENTS   = 23;
	var $DELETED    = 24;


	var $_id         		= 0;
	var $_pseudo         	= "";
	var $_email        		= "";
	var $_passwd         	= "";

	var $_civil        		= "M";
	var $_lastname     		= "";
	var $_firstname    		= "";
	var $_street1      		= "";
	var $_street2       	= "";
	var $_postcode     		= "";
	var $_city         		= "";
	var $_provence 			= "";
	var $_country      		= "";
	var $_phone    			= "";
	var $_mobile   			= "";

	var $_birthday     		= "";
	var $_classes     		= "";
	var $_studentno    		= "";
	var $_grade     		= 1;
	var $_currgrade			= 1;
	
	var $_registerdate 		= "";
	var $_lastlogin 		= "";
	var $_lastmodify		= "";
	var $_comments			= "";
	var $_deleted			= 0;

	var $connection			= '';

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
	
	function getStudentNo() {
		return $this->_studentno;
	}
	function setStudentNo($studentno) {
		$this->_studentno = $studentno;
	}
	
	function getPseudo() {
		return $this->_pseudo;
	}
	function setPseudo($pseudo) {
		$this->_pseudo = $pseudo;
	}

	function getEmail() {
		return $this->_email;
	}
	function setEmail($email) {
		$this->_email = $email;
	}

	function getPassword() {
		return $this->_passwd;
	}

	function setPassword($passwd) {
		$this->_passwd = $passwd;
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
	
	function getStudentName() {
		return $this->_firstname. " " . $this->_lastname;
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
	
	function getGrade() {
		return $this->_grade;
	}
	function setGrade($grade) {
		$this->_grade = $grade;
	}

	function getClasses() {
		return $this->_classes;
	}
	function setClasses($classes) {
		$this->_classes = $classes;
	}
	
	function initPseudoAndPassword($uid) {
		
		$pseudo = "";
		if ($this->_firstname)
			$pseudo .= $this->_firstname[0];
		if ($this->_lastname && $this->_lastname[0] != '?')
			$pseudo .= $this->_lastname[0];
		if ($this->_grade < 10) {
			$pseudo .= "0";
		}
		$pseudo .= $this->_grade.$uid;
		$pseudo = strtoupper($pseudo);
		$this->_pseudo = $pseudo; 
		$this->_passwd = $pseudo; 
	}
	
	function setStudentData($auser) {
		$this->setID($auser["$this->IDS"]);
		$this->setPseudo($auser["$this->PSEUDO"]);
		$this->setEmail($auser["$this->EMAIL"]);
		$this->setPassword($auser["$this->PASSWD"]);
		$this->setCivil($auser["$this->CIVIL"]);
		$this->setLastName($auser["$this->LASTNAME"]);
		$this->setFirstName($auser["$this->FIRSTNAME"]);
		$this->setStudentNo($auser["$this->STUDENTNO"]);
		$this->setGrade($auser["$this->GRADE"]);
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
	
	function getStudentData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getPseudo() . "', ";
		$buf .= "'" . $this->getEmail() . "', ";
		$buf .= "'" . $this->getPassword() . "', ";
		$buf .= "'" . $this->getCivil() . "', ";
		$buf .= "'" . $this->getLastName() . "', ";
		$buf .= "'" . $this->getFirstName() . "', ";
		$buf .= "'" . $this->_street1 . "', ";
		$buf .= "'" . $this->_street2. "', ";
		$buf .= "'" . $this->_city . "', ";
		$buf .= "'" . $this->_postcode . "', ";
		$buf .= "'" . $this->_provence . "', ";
		$buf .= "'" . $this->_country . "', ";
		$buf .= "'" . $this->_phone . "', ";
		$buf .= "'" . $this->_mobile . "', ";
		
		$buf .= "'" . $this->_birthday . "', ";
		$buf .= "'" . $this->_classes . "', ";
		$buf .= "'" . $this->getStudentNo() . "', ";
		$buf .= "'" . $this->getGrade() . "', ";
		$buf .= "'" . $this->_currgrade . "', ";
		
		$buf .= "'" . $this->_registerdate . "', ";
		$buf .= "'" . $this->_lastlogin . "', ";
		$buf .= "'" . $this->_lastmodify . "', ";
		$buf .= "'" . $this->_comments . "', ";
		$buf .= "'" . $this->_deleted . "'";
		$buf .= ")";
		return $buf;
	}
	
	function findUser($uname) {
		$ret = 0;
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->PSEUDO], $uname);
		if ($elem) {
			$ret = 1;
		}
		$this->close();
		return $ret;
	}
	
	function getUserByID($id) {
		$ret = 0;
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id);
		if ($elem) {
			$this->setStudentData($elem);
			$ret = 1;
		}
		$this->close();
		return $ret;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->PSEUDO]. 	"='" . $this->getPseudo() . "', ";
		$buf .= $this->TABLE[$this->EMAIL]. 	"='" . $this->getEmail() . "', ";
		$buf .= $this->TABLE[$this->PASSWD]. 	"='" . $this->getPassword() . "', ";
		$buf .= $this->TABLE[$this->CIVIL]. 	"='" . $this->getCivil() . "', ";
		$buf .= $this->TABLE[$this->LASTNAME]. 	"='" . $this->getLastName() . "', ";
		$buf .= $this->TABLE[$this->FIRSTNAME]. "='" . $this->getFirstName() . "', ";
		$buf .= $this->TABLE[$this->GRADE]. 	"='" . $this->getGrade() . "', ";
		$buf .= $this->TABLE[$this->STUDENTNO]. "='" . $this->getStudentNo() . "', ";
		$buf .= $this->TABLE[$this->DELETED]. 	"='0'";
		
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
			$this->initPseudoAndPassword($uid);
			$data = $this->getStudentData();
			$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
		}
		else {
			$this->initPseudoAndPassword($uid);
			$data = $this->getUpdateData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $uid, $data);
		}
		$this->close();
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
		$buf .= $this->TABLE[$this->IDS]. " INTEGER  NOT NULL AUTO_INCREMENT, " ."\n";
		$buf .= $this->TABLE[$this->PSEUDO] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->EMAIL] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->PASSWD] . " VARCHAR(10), " ."\n";
		$buf .= $this->TABLE[$this->CIVIL] . " CHAR(1), " ."\n";
		$buf .= $this->TABLE[$this->LASTNAME] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->FIRSTNAME] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->STREET1] . " VARCHAR(512), " ."\n";
		$buf .= $this->TABLE[$this->STREET2] . " VARCHAR(512), " ."\n";
		$buf .= $this->TABLE[$this->CITY] . " VARCHAR(256), " ."\n";
		$buf .= $this->TABLE[$this->POSTCODE] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->PROVENCE] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->COUNTRY] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->PHONE] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->MOBILE] . " VARCHAR(32), " ."\n";	
		$buf .= $this->TABLE[$this->BIRTHDAY] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->CLASSES] . 	"  VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->STUDENTNO]. "  VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->GRADE] . 	" TINYINT, " ."\n";
		$buf .= $this->TABLE[$this->CURRGRADE] . 	" TINYINT, " ."\n";
		$buf .= $this->TABLE[$this->REGISTDATE] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->LASTLOGIN] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->LASTMODIFY] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->COMMENTS] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->DELETED] . " CHAR(1), " ."\n";
		$buf .= "PRIMARY KEY (IDS), " ."\n";
		$buf .= "UNIQUE(PSEUDO) " ."\n";
		$buf .= ")ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;" ."\n\n";
		return $buf;
	}
}
?>
