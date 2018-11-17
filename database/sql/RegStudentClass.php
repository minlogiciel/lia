<?php
class RegStudentClass {

	var $TABLE_NAME    	= "REGSTUDENTS";
	
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
		"COURSES",
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
	var $COURSES   	= 14;

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
	var $_courses  			= "";

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

	function getStudentAddress() {
		return $this->_street1. "<br>" .$this->_city. " " .$this->_postcode;
	}

	
	function isEmailValide($email) {
		if($email == "") {
			$this->addTrace("please fill in a valid e-mail address!");
			return 0;
		}
		else {
			if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
			//if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,8})$", $email))
			{
				$this->addTrace("please fill in a valid e-mail address!");
				return 0;
			}
		}
		return 1;
	}
	
	function isPhoneValide($phone) {
		if (!$phone) {
			$this->addTrace("please fill in a valid phone number1!");
			return 0;
		}
		else {
			$tab = $pieces = explode("-", $phone);
			$n = count($tab);
			if ($n == 2 || $n == 3) {
				if ($n == 3) {
					if (strlen($tab[0]) != 3 || strlen($tab[1]) != 3 || strlen($tab[2]) != 4) {
						$this->addTrace("please fill in a valid phone number2!");
						return 0;
					}
				}
				else if ($n == 2) {
					if (strlen($tab[0]) != 3 || strlen($tab[1]) != 4 ) {
						$this->addTrace("please fill in a valid phone number3!");
						return 0;
					}
				}
			}
			else {
				$this->addTrace("please fill in a valid phone number4!");
			}
		}
		return 1;
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
	

	function isOK() {
		if ($this->_trace)
			return 0;
		else
			return 1;
	}
	
	function isUserDataOK() {
		
		$this->isEmailValide($this->_email);
		$this->isPhoneValide($this->_phone);
		return $this->isOK();
	}
	
	function getReturnValue($val) {
		if ($val)
			return $val;
		else
			return "";
	}
	
	function replace($str) {
		$newstr = $str;
		if ($str) {
			$newstr = htmlspecialchars($str, ENT_NOQUOTES);
			$newstr = str_replace ('\"', "&quot;", $newstr);
			$newstr = str_replace ("\'", "&#039", $newstr);
			$newstr = str_replace ('"', "&quot;", $newstr);
			$newstr = str_replace ("'", "&#039", $newstr);
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
	
	function setCourses($courses) {
		$this->_courses = $courses;
	}
	function getCourses() {
		return $this->getReturnValue($this->_courses);
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
		$this->setCourses($auser["$this->COURSES"]);
		
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
		$buf .= "'" . $this->getCourses() . "', ";
		
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

	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->STREET1]. 	"='" . $this->getStreet1().		"', ";
		$buf .= $this->TABLE[$this->CITY]. 		"='" . $this->getCity(). 		"', ";
		$buf .= $this->TABLE[$this->POSTCODE]. 	"='" . $this->getPostCode(). 	"', ";
		$buf .= $this->TABLE[$this->PROVENCE]. 	"='" . $this->getProvence(). 	"', ";
		$buf .= $this->TABLE[$this->EMAIL]. 	"='" . $this->getEmail() . 		"', ";
		$buf .= $this->TABLE[$this->PHONE]. 	"='" . $this->getPhone() . 		"', ";
		$buf .= $this->TABLE[$this->COURSES]. 	"='" . $this->getCourses() .		"', ";
		$buf .= $this->TABLE[$this->CLASSES]. 	"='" . $this->getClasses() . 	"', ";
		$buf .= $this->TABLE[$this->GRADE].		"='" .$this->getGrade(). 		"', ";
		$buf .= $this->TABLE[$this->LASTMODIFY]."='" .$this->getLastModify(). 	"', ";
		$buf .= $this->TABLE[$this->COMMENTS].	"='" .$this->getComments(). 	"', ";
		$buf .= $this->TABLE[$this->DELETED].	"='" .$this->isDeleted(). 		"'";
		return $buf;
	}
	

	function getStudentByID($id) {
		$ret = 0;
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id);
		if ($elem) {
			$this->setStudentData($elem);
			if (!$this->isDeleted())
				$ret = 1;
		}
		$this->close();
		return $ret;
	}

	function addStudent() {
		$exec = $this->connect();
		$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
		$this->setID($uid);
			
		$currDate = getCurrentDate();
		$this->setRegisterDate($currDate);
		
		
		$this->setLastModify(date("Y"));
		$this->setLastLogin(getSemesterSchoolName());
		
		$data = $this->getStudentData();
		$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
		$this->close();
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
	
	function copyRegisterStudent() {
		$student = new StudentClass();
		$student->setGrade($this->getGrade());
		$student->setCurrentGrade($this->getGrade());
		$student->setClasses($this->getClasses());
		$student->setCivil($this->getCivil());
		$student->setFirstName($this->getFirstName());
		$student->setLastName($this->getLastName());
		$student->setStreet1($this->getStreet1());
		$student->setCity($this->getCity());
		$student->setPostCode($this->getPostCode());
		$student->setProvence($this->getProvence());
		$student->setEmail($this->getEmail());
		$student->setPhone($this->getPhone());
		$student->setComments($this->getComments());
		return $student;
	}
	function toSemesterSchool() {
		$err = '';
		$st = $this->copyRegisterStudent();
				
		if ($st->isUserDataOK())  {
			$st->addStudent();
			$this->deleteStudent(1);
		}
		else {
			$err = $st->getTrace();
		}
		return $err;
	}
	
	function deleteStudent($del) {
		$exec = $this->connect();
		$this->setDeleted($del);
		$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->DELETED], $del);
		$this->close();
	}


	
	function updateStudent() {
		$exec = $this->connect();
		$currDate = getCurrentDate();
		$this->setLastModify($currDate);
		$data = $this->getUpdateData();
		$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		$this->close();
	}

}
?>
