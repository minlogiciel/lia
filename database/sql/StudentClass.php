<?php
class StudentClass {

	var $TABLE_NAME    		= "STUDENTS";
	var $DATABASE_OK  	= 1;
	var $MIN_PASS_LEN 	= 4;
	var $MAX_PASS_LEN 	= 10;
	
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
		//"CURRGRADE",
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
	var $RM  		= 17;
	var $GRADE    	= 18;
	var $CURRGRADE  = 19;
	
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
	var $_rm     			= "";
	var $_grade     		= 1;
	var $_currgrade    		= 1;
	
	var $_registerdate 		= "";
	var $_lastlogin 		= "";
	var $_lastmodify		= "";
	var $_comments			= "";
	var $_deleted			= 0;

	var $_trace 			= "";

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
		
	function setTrace($trace) {
		$this->_trace = $trace;
	}
	function getTrace() {
		return $this->_trace;
	}
	function addTrace($trace) {
		$this->_trace .= $trace . "<br>";
	}

	function getID() {
		return $this->_id;
	}
	function setID($id) {
		$this->_id = $id;
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

	
	function isEmailValide($email) {
		if($email !== "") {
			if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
			//if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,8})$", $email))
			{
				$this->addTrace("Email is not valide");
				return 0;
			}
		}
		return 1;
	}

	function findUserEmail($email) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->EMAIL], $email);
			if ($elem) {
				$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}
	
	function isUsedEmail($email) {
		if ($this->findUserEmail($email)) {
			$this->addTrace("Email (" .$email. ") is used!");
			return 1;
		}
		return 0;
	}
	
	function findUser($uname) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->PSEUDO], $uname);
			if ($elem) {
				$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}
	
	function isUsedPseudo() {
		if ($this->_pseudo) {
			if (strlen($this->_pseudo) < $this->MIN_PASS_LEN || strlen($this->_pseudo) > $this->MAX_PASS_LEN) {
				$this->addTrace("Login name is too short or too long!");
				return 1;
			}
			else if ($this->findUser($this->_pseudo)) {
				$this->addTrace("Login name (" .$this->_pseudo. ") is used!");
				return 1;
			}
		}
		return 0;
	}

	function isOK() {
		if ($this->_trace)
			return 0;
		else
			return 1;
	}
	
	function isTestStudent() {
		return 0;
	}
	
	function isUserDataOK() {
		
		$this->isEmailValide($this->_email);

		$this->isUsedPseudo();
		if ($this->findStudent()) {
			$this->addTrace("Student Name (".$this->_firstname. " " .$this->_lastname. ") is used!");
		}
		
		return $this->isOK();
	}
	
	function getReturnValue($val) {
		if ($val)
			return $val;
		else
			return "";
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
	
	function getCivil() {
		return $this->getReturnValue($this->_civil);
	}
	function setCivil($civil) {
		$this->_civil = $civil;
	}
	
	function getFirstName() {
		return $this->getReturnValue($this->_firstname);
	}
	function setFirstName($name) {
		$this->_firstname = $this->replace($name);
	}
	
	function getLastName() {
		return $this->getReturnValue($this->_lastname);
	}
	function setLastName($name) {
		$this->_lastname = $this->replace($name);
	}
	
	function getStudentName() {
		return $this->_firstname. " " . $this->_lastname;
	}
	
	function getBirthDay() {
		return $this->_birthday;
	}
	function setBirthDay($day) {
		$this->_birthday = $day;
	}

	function getPhone() {
		return $this->getReturnValue($this->_phone);
	}
	function setPhone($phone) {
		$this->_phone = $phone;
	}
	
	function setMobile($mobile) {
		$this->_mobile = $mobile;
	}
	function getMobile() {
		return $this->getReturnValue($this->_mobile);
	}
	
	function getStreet1() {
		return $this->getReturnValue($this->_street1);
	}
	function setStreet1($street) {
		$this->_street1 = $this->replace($street);
	}
	
	function getStreet2() {
		return $this->getReturnValue($this->_street2);
	}
	function setStreet2($street) {
		$this->_street2 = $this->replace($street);
	}
	
	function getCity() {
		return $this->getReturnValue($this->_city);
	}
	function setCity($city) {
		$this->_city = $this->replace($city);
	}

	function getPostCode() {
		return $this->getReturnValue($this->_postcode);
	}
	function setPostCode($postcode) {
		$this->_postcode = $this->replace($postcode);
	}

	function getStudentAddress() {
		return $this->_street1. " " . $this->_street2. "<br>" .$this->_city. " " .$this->_postcode;
	}
	
	function getProvence() {
		return $this->getReturnValue($this->_provence);
	}
	function setProvence($provence) {
		$this->_provence = $this->replace($provence);
	}
	function getCountry() {
		return $this->getReturnValue($this->_country);
	}
	function setCountry($country) {
		$this->_country = $this->replace($country);
	}
	
	function getRegisterDate() {
		return $this->_registerdate;
	}
	function setRegisterDate($date) {
		$this->_registerdate = $date;
	}
	
	function getLastLogin() {
		return $this->_lastlogin;
	}
	function setLastLogin($login) {
		$this->_lastlogin = $login;
	}

	function getLastModify() {
		return $this->_lastmodify;
	}
	function setLastModify($modify) {
		$this->_lastmodify = $modify;
	}
	
	function getGrade() {
		return $this->_grade;
	}
	function setGrade($grade) {
		$this->_grade = $grade;
	}

	function getCurrentGrade() {
		return $this->_currgrade;
	}
	
	function setCurrentGrade($grade) {
		$this->_currgrade = $grade;
	}
	
	function getRM() {
		return $this->_rm;
	}
	function setRM($rm) {
		$this->_rm = $rm;
	}

	function getStudentNo() {
		return $this->getRM();
	}
	function setStudentNo($studentNo) {
		$this->setRM($studentNo);
	}
	
	function getClasses() {
		return $this->_classes;
	}
	function setClasses($classes) {
		$this->_classes = $classes;
	}
	
	function getComments() {
		return $this->_comments;
	}
	function setComments($comment) {
		$this->_comments = $comment;
	}
	
	function isDeleted() {

		return $this->_deleted;
	}
	function setDeleted($deleted) {
		$this->_deleted = $deleted;
	}

	function isValideStudent() {
		if ($this->_deleted) {
			return 0;
		}
		else {
			$name = strtolower($this->getStudentName());
			if (strstr($name, "noname") || strstr($name, "no name") || strstr($name, "unknown") ||  strstr($name, "zz") || (strstr($name, "lia") && strstr($name, "usa")) ) {
				return 0;
			}
		}
		return 1;
	}
	
	function setStudentData($auser) {
		$this->setID($auser["$this->IDS"]);
		$this->setPseudo($auser["$this->PSEUDO"]);
		$this->setEmail($auser["$this->EMAIL"]);
		$this->setPassword($auser["$this->PASSWD"]);

		$this->setCivil($auser["$this->CIVIL"]);
		$this->setLastName($auser["$this->LASTNAME"]);
		$this->setFirstName($auser["$this->FIRSTNAME"]);
		$this->setStreet1($auser["$this->STREET1"]);
		$this->setStreet2($auser["$this->STREET2"]);
		$this->setCity($auser["$this->CITY"]);
		$this->setPostCode($auser["$this->POSTCODE"]);
		$this->setProvence($auser["$this->PROVENCE"]);
		$this->setCountry($auser["$this->COUNTRY"]);
		$this->setPhone($auser["$this->PHONE"]);
		$this->setMobile($auser["$this->MOBILE"]);
		
		$this->setBirthDay($auser["$this->BIRTHDAY"]);
		$this->setClasses($auser["$this->CLASSES"]);
		$this->setRM($auser["$this->RM"]);
		$this->setGrade($auser["$this->GRADE"]);
		$this->setCurrentGrade($auser["$this->CURRGRADE"]);
		
		$this->setRegisterDate($auser["$this->REGISTDATE"]);
		$this->setLastLogin($auser["$this->LASTLOGIN"]);
		$this->setLastModify($auser["$this->LASTMODIFY"]);
		$this->setComments($auser["$this->COMMENTS"]);
		$this->setDeleted($auser["$this->DELETED"]);
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
		$buf .= "'" . $this->getStreet1() . "', ";
		$buf .= "'" . $this->getStreet2() . "', ";
		$buf .= "'" . $this->getCity() . "', ";
		$buf .= "'" . $this->getPostCode() . "', ";
		$buf .= "'" . $this->getProvence() . "', ";
		$buf .= "'" . $this->getCountry() . "', ";
		$buf .= "'" . $this->getPhone() . "', ";
		$buf .= "'" . $this->getMobile() . "', ";
		
		$buf .= "'" . $this->getBirthDay() . "', ";
		$buf .= "'" . $this->getClasses() . "', ";
		$buf .= "'" . $this->getRM() . "', ";
		$buf .= "'" . $this->getGrade() . "', ";
		$buf .= "'" . $this->getCurrentGrade() . "', ";
		
		$buf .= "'" . $this->getRegisterDate() . "', ";
		$buf .= "'" . $this->getLastLogin() . "', ";
		$buf .= "'" . $this->getLastModify() . "', ";
		$buf .= "'" . $this->getComments() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}
	function buildValideTableRef1() {
		$buf = "(";
		for ($i= 1; $i < count($this->TABLE); $i++) {
			if ($i > 1)
				$buf .= ", ";
			$buf .= $this->TABLE[$i];
		}
		$buf .= ")";
		return $buf;
	}
	function getValideStudentData1() {
		$buf = "(";
		$buf .= "'" . $this->getPseudo() . "', ";
		$buf .= "'" . $this->getEmail() . "', ";
		$buf .= "'" . $this->getPassword() . "', ";
		$buf .= "'" . $this->getCivil() . "', ";
		$buf .= "'" . $this->getLastName() . "', ";
		$buf .= "'" . $this->getFirstName() . "', ";
		$buf .= "'" . $this->getStreet1() . "', ";
		$buf .= "'" . $this->getStreet2() . "', ";
		$buf .= "'" . $this->getCity() . "', ";
		$buf .= "'" . $this->getPostCode() . "', ";
		$buf .= "'" . $this->getProvence() . "', ";
		$buf .= "'" . $this->getCountry() . "', ";
		$buf .= "'" . $this->getPhone() . "', ";
		$buf .= "'" . $this->getMobile() . "', ";
		
		$buf .= "'" . $this->getBirthDay() . "', ";
		$buf .= "'" . $this->getClasses() . "', ";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getGrade() . "', ";
		$buf .= "'" . $this->getCurrentGrade() . "', ";
		
		$buf .= "'" . $this->getRegisterDate() . "', ";
		$buf .= "'" . $this->getLastLogin() . "', ";
		$buf .= "'" . $this->getLastModify() . "', ";
		$buf .= "'" . $this->getComments() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}

	function buildValideTableRef() {
		$buf = "(";
		$buf .= $this->TABLE[$this->IDS]. ", ";
		$buf .= $this->TABLE[$this->CLASSES]. ", ";
		$buf .= $this->TABLE[$this->GRADE]. ", ";
		$buf .= $this->TABLE[$this->CIVIL]. ", ";
		$buf .= $this->TABLE[$this->FIRSTNAME]. ", ";
		$buf .= $this->TABLE[$this->LASTNAME]. ", ";
		$buf .= $this->TABLE[$this->EMAIL]. ", ";
		$buf .= $this->TABLE[$this->STREET1]. ", ";
		$buf .= $this->TABLE[$this->CITY]. ", ";
		$buf .= $this->TABLE[$this->POSTCODE]. ", ";
		$buf .= $this->TABLE[$this->PHONE]. ", ";
		$buf .= $this->TABLE[$this->MOBILE]. ", ";
		$buf .= $this->TABLE[$this->COMMENTS];
		$buf .= ")";
		return $buf;
	}
	function getValideStudentData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getClasses() . "', ";
		$buf .= "'" . $this->getGrade() . "', ";
		$buf .= "'" . $this->getCivil() . "', ";
		$buf .= "'" . $this->getFirstName() . "', ";
		$buf .= "'" . $this->getLastName() . "', ";
		$buf .= "'" . $this->getEmail() . "', ";
		$buf .= "'" . $this->getStreet1() . "', ";
		$buf .= "'" . $this->getCity() . "', ";
		$buf .= "'" . $this->getPostCode() . "', ";
		$buf .= "'" . $this->getPhone() . "', ";
		$buf .= "'" . $this->getMobile() . "', ";
		$buf .= "'" . $this->getComments() . "'";
		$buf .= ")";
		return $buf;
	}
	
	function getUserByEmail($email) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->EMAIL], $email);
			if ($elem) {
				$this->setStudentData($elem);
				$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}
	
	function findStudent($name="") {
		$ret = 0;
		if ($name) {
			if (is_numeric($name)) {
				$ret = $this->getUserByID($name);
			}
			else {
				$listname  = explode(" ", $name);
				$nn = count($listname)-1;
				if (count($listname) > 0) {
					$cond  	=  $this->TABLE[$this->FIRSTNAME]. "='" .$listname[0]. 	"' AND ";
					$cond  .=  $this->TABLE[$this->LASTNAME]. 	"='" .$listname[$nn]. 	"'";
				}
				else {
					$cond  	= $this->TABLE[$this->FIRSTNAME]. "='" .$listname[0]. 	"' OR ";
					$cond  .= $this->TABLE[$this->LASTNAME]. 	"='" .$listname[0]. 	"'";
				}
				$exec = $this->connect();
				$elem = $exec->get_element_1($this->TABLE_NAME, $cond);
				if ($elem) {
					$this->setStudentData($elem);
					$ret = 1;
				}
				$this->close();
			}
		}
		else {
			$cond  	=  $this->TABLE[$this->FIRSTNAME]. "='" .$this->_firstname. 	"' AND ";
			$cond  .=  $this->TABLE[$this->LASTNAME]. 	"='" .$this->_lastname. 	"'";
			$exec = $this->connect();
			$elem = $exec->get_element_1($this->TABLE_NAME, $cond);
			if ($elem) {
				$this->setStudentData($elem);
				$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}
	function getUserByName($uname) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->PSEUDO], $uname);
			if ($elem) {
				$this->setStudentData($elem);
				$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}

	function getUserByID($id) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id);
			if ($elem) {
				$this->setStudentData($elem);
				$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}

	function getRegistedUser($uname, $upass) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$elem = $exec->get_element_2($this->TABLE_NAME, $this->TABLE[$this->PSEUDO], $uname, $this->TABLE[$this->PASSWD], $upass);
			if (!$elem) {
				$elem = $exec->get_element_2($this->TABLE_NAME, $this->TABLE[$this->EMAIL], $uname, $this->TABLE[$this->PASSWD], $upass);
			}
			if ($elem) {
				$this->setStudentData($elem);
				
				$currDate = getCurrentDate();
				$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->LASTLOGIN], $currDate);
		
				$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}

	function initPseudoAndPassword($uid) {
		
		$pseudo = $this->_firstname[0] . $this->_lastname[0];
		if ($this->_grade < 10) {
			$pseudo .= "0";
		}
		$pseudo .= $this->_grade.$uid;
		$pseudo = strtoupper($pseudo);
		$this->_pseudo = $pseudo; 
		$this->_passwd = $pseudo; 
	}
	
	function addStudent() {
		$uid = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
			$this->setID($uid);
			
			$this->initPseudoAndPassword($uid);
			
			$currDate = getCurrentDate();
			$this->setRegisterDate($currDate);
			$this->setLastLogin($currDate);
			$this->setLastModify($currDate);
			
			$data = $this->getStudentData();

			$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
			$this->close();
		}
		return $uid;
	}
	function addStudentFromTest($ttstudent) {
		$this->setCivil($ttstudent->getCivil());
		$this->setLastName($ttstudent->getLastName());
		$this->setFirstName($ttstudent->getFirstName());
		$this->setEmail($ttstudent->getEmail());
		$this->setGrade($ttstudent->getGrade());
		$this->setClasses($ttstudent->getClasses());
		$this->setPhone($ttstudent->getPhone());
		$this->setMobile($ttstudent->getMobile());
		$this->setComments($ttstudent->getComments());
		$this->setDeleted(0);
		
		return $this->addStudent();

	}
	function addUnknownNameStudent() {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
			$this->setID($uid);
			
			$this->setLastName("ZZ".$uid);
			$this->setFirstName("Unknown");

			$this->initPseudoAndPassword($uid);
			
			$currDate = getCurrentDate();
			$this->setRegisterDate($currDate);
			$this->setLastLogin($currDate);
			$this->setLastModify($currDate);
			
			$data = $this->getStudentData();

			$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);

			$this->close();
			
			$ret = 1;
		}
		return $ret;
	}
	
	function deleteStudent($del) {
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

	function getUpdateClassGradeData() {
		$buf = "";
		$buf .= $this->TABLE[$this->CLASSES]. 	"='" . $this->getClasses() . "', ";
		$buf .= $this->TABLE[$this->GRADE]."='" .$this->getGrade(). "'";
		return $buf;
	}
	function updateStudentClassGrade($classname, $grade) {
		if (($this->getClasses() != $classname) || ($this->getGrade() != $grade)) {
			$exec = $this->connect();
	
			$this->setClasses($classname);			
			$this->setGrade($grade);
			$data = $this->getUpdateClassGradeData();
	
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
				
			$this->close();	
		}	
	}
	function isPasswordValide($p1, $p2) {
		if ($p1 && $p2 && (strlen($p1) > 3) && (strlen($p2) > 3) && ($p1 == $p2)) {
			return 1;
		}
		else { 
			$this->addTrace("Password is not correct");
			return 0;
		}
	}

	function getUpdatePasswordData($passwd) {
		$buf = "";
		$buf .= $this->TABLE[$this->PASSWD]. 	"='" . $this->getPassword() . "', ";
		$currDate = getCurrentDate();
		$buf .= $this->TABLE[$this->LASTMODIFY]."='" .$currDate. "'";
		return $buf;
	}
	
	
	function getUpdateAddressData() {
		$buf = "";
		$buf .= $this->TABLE[$this->EMAIL]. 	"='" . $this->getEmail() . "', ";
		$buf .= $this->TABLE[$this->STREET1]. 	"='" . $this->getStreet1() . "', ";
		$buf .= $this->TABLE[$this->STREET2]. 	"='" . $this->getStreet2() . "', ";
		$buf .= $this->TABLE[$this->CITY]. 		"='" . $this->getCity() . "', ";
		$buf .= $this->TABLE[$this->POSTCODE]. 	"='" . $this->getPostCode() . "', ";
		$buf .= $this->TABLE[$this->PROVENCE]. 	"='" . $this->getProvence() . "', ";
		$buf .= $this->TABLE[$this->COUNTRY]. 	"='" . $this->getCountry() . "', ";
		$buf .= $this->TABLE[$this->PHONE]. 	"='" . $this->getPhone() . "', ";
		$buf .= $this->TABLE[$this->MOBILE]. 	"='" . $this->getMobile() ."', ";

		$currDate = getCurrentDate();
		$buf .= $this->TABLE[$this->LASTMODIFY]."='" .$currDate. "'";
		
		return $buf;
	}
	
	function getUpdateProfilData() {
		$buf = "";
		$passwd = $this->getPassword();
		if (!$passwd || $passwd == "NULL") {
			$buf .= $this->TABLE[$this->PASSWD]. 	"='0000', ";	
		}
		$civil = $this->getCivil();
		if (!$civil || $civil == "NULL") {
			$buf .= $this->TABLE[$this->CIVIL]. 	"='M', ";	
		}
		$buf .= $this->TABLE[$this->PSEUDO]. 	"='" . $this->getPseudo() . "', ";
		$buf .= $this->TABLE[$this->CIVIL]. 	"='" . $this->getCivil() . "', ";
		$buf .= $this->TABLE[$this->LASTNAME]. 	"='" . $this->getLastName() . "', ";
		$buf .= $this->TABLE[$this->FIRSTNAME]. "='" . $this->getFirstName() . "', ";
		$buf .= $this->TABLE[$this->GRADE]. 	"='" . $this->getGrade() . "', ";
		$buf .= $this->TABLE[$this->EMAIL]. 	"='" . $this->getEmail() . "', ";
		$buf .= $this->TABLE[$this->STREET1]. 	"='" . $this->getStreet1() . "', ";
		$buf .= $this->TABLE[$this->STREET2]. 	"='" . $this->getStreet2() . "', ";
		$buf .= $this->TABLE[$this->CITY]. 		"='" . $this->getCity() . "', ";
		$buf .= $this->TABLE[$this->POSTCODE]. 	"='" . $this->getPostCode() . "', ";
		$buf .= $this->TABLE[$this->PROVENCE]. 	"='" . $this->getProvence() . "', ";
		$buf .= $this->TABLE[$this->COUNTRY]. 	"='" . $this->getCountry() . "', ";
		$buf .= $this->TABLE[$this->PHONE]. 	"='" . $this->getPhone() . "', ";
		$buf .= $this->TABLE[$this->MOBILE]. 	"='" . $this->getMobile() . "', ";
		
		$buf .= $this->TABLE[$this->BIRTHDAY]. 	"='" . $this->getBirthDay() . "', ";
		
			
		$buf .= $this->TABLE[$this->CLASSES]. 	"='" . $this->getClasses() . "', ";
		$buf .= $this->TABLE[$this->RM]. 		"='" . $this->getRM() . "', ";
		$buf .= $this->TABLE[$this->GRADE]. 	"='" . $this->getGrade() . "', ";
		$buf .= $this->TABLE[$this->CURRGRADE]. 	"='" . $this->getCurrentGrade() . "', ";

		$currDate = getCurrentDate();
		
		$ldate = $this->getRegisterDate();
		if (!$ldate || $ldate == "NULL") {
			$buf .= $this->TABLE[$this->REGISTDATE]. 	"='" .$currDate. "', ";
		}

		$ldate = $this->getLastLogin();
		if (!$ldate || $ldate == "NULL") {
			$buf .= $this->TABLE[$this->LASTLOGIN]. 	"='" .$currDate. "', ";
		}
		$buf .= $this->TABLE[$this->LASTMODIFY]."='" .$currDate. "', ";
		$buf .= $this->TABLE[$this->COMMENTS]. 	"='" . $this->getComments() . "', ";

		$buf .= $this->TABLE[$this->DELETED]. 	"='" .$this->isDeleted(). "'";
		
		return $buf;
	}
	
	function updatePassword($p1, $p2) {
		$ret = 0;
		if ($this->isPasswordValide($p1, $p2)) {
			$this->setPassword($p1);
			
			$exec = $this->connect();
			$data = $this->getUpdatePasswordData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
			
			$this->close();

			$ret = 1;
		}
		return $ret;
	}
	
	function updateAddress() {
		$ret = 1;
		if ($this->isOK()) {
			$exec = $this->connect();
			$data = $this->getUpdateAddressData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);

			$this->backup();

			$this->close();
		}
		else {
			$ret = 0;
		}
		return $ret;
	}

	function updateStudentClassName() {
		$oldname =  $this->getClasses();
		$classname =  replaceOldClassName($oldname);
		if ($oldname != $classname) {
			$exec = $this->connect();
			$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->CLASSES], $classname);
			$this->close();
		}
	}
	
	function updateProfile() {
		$ret = 1;
		if ($this->isOK()) {
			$exec = $this->connect();
			$data = $this->getUpdateProfilData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
			$this->close();
		}
		else {
			$ret = 0;
		}
		return $ret;
	}
	
	function resetAddressData($auser) {
		$this->_email       = $auser->getEmail();
		$this->_street1     = $auser->getStreet1();
		$this->_street2     = $auser->getStreet2();
		$this->_city       	= $auser->getCity();
		$this->_postal      = $auser->getPostal();
		$this->_provence  	= $auser->getProvence();
		$this->_country     = $auser->getCountry();
		$this->_phone      	= $auser->getPhone();
		$this->_mobile      = $auser->getMobile();
	}

	function backup() {
		$fname = getBackupFileName($this->TABLE_NAME, $this->getID());
		$fp = fopen($fname, "w");
		$text = "INSERT INTO " .$this->TABLE_NAME. " " .$this->buildTableRef(). " VALUES \n";
		fwrite($fp, $text);
		$text = $this->getStudentData(). ";\n";
		fwrite($fp, $text);
		fclose($fp);
		set_base_changed(1, $this->TABLE_NAME);
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
		$buf .= $this->TABLE[$this->RM] . 		"  VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->GRADE] . 	" TINYINT, " ."\n";
		$buf .= $this->TABLE[$this->CURRGRADE] . 	" TINYINT, " ."\n";
		$buf .= $this->TABLE[$this->REGISTDATE] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->LASTLOGIN] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->LASTMODIFY] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->COMMENTS] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->DELETED] . " CHAR(1), " ."\n";
		$buf .= "PRIMARY KEY (IDS), " ."\n";
		$buf .= "UNIQUE(PSEUDO) " ."\n";
		$buf .= ")ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;" ."\n";
		return $buf;
	}
}
?>
