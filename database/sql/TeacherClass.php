<?php
class TeacherClass {

	var $TABLE_NAME    	= "TEACHERS";
	var $DATABASE_OK  	= 1;
	
	var $TABLE  = array(
		"IDS",
		"CIVIL",
		"FIRSTNAME",
		"LASTNAME",
		"SUBJECTS",
		"LOGIN",
		"PASSWD",
		"EMAIL",
		"PHONE",
		"MOBILE",
		"REGISTDATE",
		"LASTLOGIN",
		"LASTMODIFY",
		"NOTES",
		"DELETED",
	);

	var $IDS		= 0;
	var $CIVIL      = 1;
	var $FIRSTNAME  = 2;
	var $LASTNAME   = 3;
	var $SUBJECTS  	= 4;
	var $LOGIN     	= 5;
	var $PASSWD    	= 6;
	var $EMAIL      = 7;
	var $PHONE     	= 8;
	var $MOBILE    	= 9;
	var $REGISTDATE = 10;
	var $LASTLOGIN  = 11;
	var $LASTMODIFY	= 12;
	var $NOTES   	= 13;
	var $DELETED    = 14;


	var $_id         		= 0;
	var $_civil        		= "M";
	var $_firstname    		= "";
	var $_lastname     		= "";
	var $_subjects     		= "";
	var $_login         	= "";
	var $_passwd         	= "";
	var $_email        		= "";
	var $_phone    			= "";
	var $_mobile   			= "";

	var $_registerdate 		= "";
	var $_lastlogin 		= "";
	var $_lastmodify		= "";
	var $_notes				= "";
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
		
	function getID() {
		return $this->_id;
	}
	function setID($id) {
		$this->_id = $id;
	}

	function getCivil() {
		return ($this->_civil);
	}
	function setCivil($civil) {
		$this->_civil = $civil;
	}
	
	function getFirstName() {
		return $this->_firstname;
	}
	function setFirstName($name) {
		$this->_firstname = $name;
	}
	
	function getLastName() {
		return $this->_lastname;
	}
	function setLastName($name) {
		$this->_lastname = $name;
	}
	
	function getTeacherName() {
		return $this->_firstname. " " . $this->_lastname;
	}

	function getTeacherFullName() {
		return $this->_civil. " " .$this->_firstname. " " .$this->_lastname;
	}
	
	function getSubjects() {
		return $this->_subjects;
	}
	function setSubjects($subjects) {
		$this->_subjects = $subjects;
	}
	
	function getLogin() {
		return $this->_login;
	}
	function setLogin($login) {
		$this->_login = $login;
	}

	function getPassword() {
		return $this->_passwd;
	}

	function setPassword($passwd) {
		$this->_passwd = $passwd;
	}

	function getEmail() {
		return $this->_email;
	}
	function setEmail($email) {
		$this->_email = $email;
	}
	
	function getPhone() {
		return $this->_phone;
	}
	function setPhone($phone) {
		$this->_phone = $phone;
	}
	
	function setMobile($mobile) {
		$this->_mobile = $mobile;
	}
	function getMobile() {
		return $this->_mobile;
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
		
	function getNotes() {
		return $this->_notes;
	}
	function setNotes($notes) {
		$this->_notes = $notes;
	}
	
	function isDeleted() {

		return $this->_deleted;
	}
	function setDeleted($deleted) {
		$this->_deleted = $deleted;
	}


	function setData($elem) {
		$this->setID($elem["$this->IDS"]);
		$this->setCivil($elem["$this->CIVIL"]);
		$this->setLastName($elem["$this->LASTNAME"]);
		$this->setFirstName($elem["$this->FIRSTNAME"]);
		$this->setSubjects($elem["$this->SUBJECTS"]);
		$this->setLogin($elem["$this->LOGIN"]);
		$this->setPassword($elem["$this->PASSWD"]);
		$this->setEmail($elem["$this->EMAIL"]);
		$this->setPhone($elem["$this->PHONE"]);
		$this->setMobile($elem["$this->MOBILE"]);
		
		$this->setRegisterDate($elem["$this->REGISTDATE"]);
		$this->setLastLogin($elem["$this->LASTLOGIN"]);
		$this->setLastModify($elem["$this->LASTMODIFY"]);
		$this->setNotes($elem["$this->NOTES"]);
		$this->setDeleted($elem["$this->DELETED"]);
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
		$buf .= "'" . $this->getCivil() . "', ";
		$buf .= "'" . $this->getFirstName() . "', ";
		$buf .= "'" . $this->getLastName() . "', ";
		$buf .= "'" . $this->getSubjects() . "', ";
		$buf .= "'" . $this->getLogin() . "', ";
		$buf .= "'" . $this->getPassword() . "', ";
		$buf .= "'" . $this->getEmail() . "', ";
		$buf .= "'" . $this->getPhone() . "', ";
		$buf .= "'" . $this->getMobile() . "', ";
		$buf .= "'" . $this->getRegisterDate() . "', ";
		$buf .= "'" . $this->getLastLogin() . "', ";
		$buf .= "'" . $this->getLastModify() . "', ";
		$buf .= "'" . $this->getNotes() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}
	
	function findTeacher($teacher) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();

			if (is_numeric($teacher)) {
				$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $teacher);
				if ($elem) {
					$this->setData($elem);
					$ret = 1;
				}
			}
			else {
				$listname  = explode(" ", $teacher);
				$n = count($listname);
				$fname = "";
				$lname = "";
				$civil = strtolower($listname[0]);
				$sn = 0;
				if (strcmp($civil, "mr") == 0 || strcmp($civil, "ms") == 0) {
					$sn = 1;
					$n--;
				}
				if ($n == 1) {
					$lname = $listname[$sn];
				}
				else if ($n == 2) {
					$fname = $listname[$sn];
					$lname = $listname[$sn+1];
				}

				if ($fname) {
					$cond  	=  $this->TABLE[$this->FIRSTNAME]. "='" .$fname. "' AND ";
					$cond  .=  $this->TABLE[$this->LASTNAME].  "='" .$lname. "'";
				}
				else {
					$cond  	= $this->TABLE[$this->LOGIN]. 		"='" .$lname. "' OR ";
					$cond  	= $this->TABLE[$this->FIRSTNAME]. 	"='" .$lname. "' OR ";
					$cond  .= $this->TABLE[$this->LASTNAME].  	"='" .$lname. "'";
				}
				$elem = $exec->get_element_1($this->TABLE_NAME, $cond);
				if ($elem) {
					$this->setData($elem);
					$ret = 1;
				}
			}
			$this->close();
		}
		return $ret;
	}
	
	function getRegistedTeacher($teacher, $passwd) {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			
			$cond  	=  $this->TABLE[$this->LOGIN]. 	"='" .$teacher. "' AND ";
			$cond  .=  $this->TABLE[$this->PASSWD].	"='" .$passwd. "'";
			
			$elem = $exec->get_element_1($this->TABLE_NAME, $cond);
			if ($elem) {
				$this->setData($elem);
				$ret = 1;
				$currDate = getCurrentDate();
				$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->LASTLOGIN], $currDate);
			}
			
			$this->close();
		}
		return $ret;
	}
	
	function getShirtSubject() {
		$str = strtolower($this->_subjects);
		if (strncmp($str, "math", 4)==0)
			$ret = "math";
		else if (strncmp($str, "earth", 5) == 0)
			$ret = "es";
		else {
			$ret = substr($str,0, 3);
		}
		return $ret;
	}
	
	function initLoginAndPassword() {
		
		$login = $this->_firstname[0] . $this->_lastname;
		$this->_login = strtoupper($login);

		$passwd = $this->_firstname[0] . $this->_lastname[0].$this->getShirtSubject();
		$this->_passwd = strtoupper($passwd);; 
	}

	function updateTeacherBase() {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$currDate = getCurrentDate();
			$this->initLoginAndPassword();
			
			$sql = $this->TABLE[$this->LOGIN]. 	"='" . $this->getLogin() . "', ";
			$sql .= $this->TABLE[$this->PASSWD]. 	"='" . $this->getPassword() . "', ";
			$sql .= $this->TABLE[$this->REGISTDATE]. "='" .$currDate."', ";
			$sql .= $this->TABLE[$this->LASTLOGIN]. "='" .$currDate."', ";
			$sql .= $this->TABLE[$this->LASTMODIFY]."='" .$currDate. "'";

			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $sql);
			$this->close();
			$ret = 1;
		}
		return $ret;
	}
	
	function addTeacher() {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
			$this->setID($uid);
			
			$this->initLoginAndPassword();
			
			$currDate = getCurrentDate();
			$this->setRegisterDate($currDate);
			$this->setLastLogin($currDate);
			$this->setLastModify($currDate);
			
			$data = $this->getData();

			$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
			$this->close();
			
			$ret = 1;
		}
		return $ret;
	}
	
	function deleteTeacher($del) {
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

	
	function updateTeacher() {
		$ret = 0;
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$currDate = getCurrentDate();
			$sql = $this->TABLE[$this->EMAIL]. 	"='" . $this->getEmail() . "', ";
			$sql .= $this->TABLE[$this->PHONE]. 	"='" . $this->getPhone() . "', ";
			$sql .= $this->TABLE[$this->MOBILE]. 	"='" . $this->getMobile() ."', ";
			$sql .= $this->TABLE[$this->NOTES]. 	"='" . $this->getNotes() ."', ";
			$sql .= $this->TABLE[$this->LASTMODIFY]."='" .$currDate. "'";

			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $sql);
			$this->close();
			$ret = 1;
		}
		return $ret;
	}
	
	function updatePassword($p1, $p2) {
		$ret = 0;
		if ($p1 == $p2) {
			$exec = $this->connect();
			
			$currDate = getCurrentDate();
			$this->setPassword($p1);
			$sql = $this->TABLE[$this->PASSWD]. 	"='" . $this->getPassword() . "', ";
			$sql .= $this->TABLE[$this->LASTMODIFY]."='" .$currDate. "'";
			
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $sql);
			
			$this->close();

			$ret = 1;
		}
		return $ret;
	}
	
	function getCreatTableString() {
		$buf = "CREATE TABLE IF NOT EXISTS " .$this->TABLE_NAME. "(" ."\n";
		$buf .= $this->TABLE[$this->IDS]. " INTEGER  NOT NULL AUTO_INCREMENT, " ."\n";
		$buf .= $this->TABLE[$this->CIVIL] . " CHAR(3), " ."\n";
		$buf .= $this->TABLE[$this->FIRSTNAME] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->LASTNAME] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->SUBJECTS] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->LOGIN] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->PASSWD] . " VARCHAR(20), " ."\n";
		$buf .= $this->TABLE[$this->EMAIL] . " VARCHAR(128), " ."\n";
		$buf .= $this->TABLE[$this->PHONE] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->MOBILE] . " VARCHAR(32), " ."\n";	
		$buf .= $this->TABLE[$this->REGISTDATE] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->LASTLOGIN] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->LASTMODIFY] . " VARCHAR(32), " ."\n";
		$buf .= $this->TABLE[$this->NOTES] . " VARCHAR(512), " ."\n";
		$buf .= $this->TABLE[$this->DELETED] . " CHAR(1), " ."\n";
		$buf .= "PRIMARY KEY (IDS), " ."\n";
		$buf .= "UNIQUE(LOGIN) " ."\n";
		$buf .= ")ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;" ."\n";
		return $buf;
	}
}
?>
