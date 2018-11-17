<?php
class user_base {
	var $MIN_PASS_LEN = 4;
	var $MAX_PASS_LEN = 10;
	var $CARD_LEN = 16;

	// column names of user table
	var $USERID      	= "USERID";
	var $LOGIN  		= "LOGIN";
	var $PASSWORD    	= "PASSWORD";
	var $COMPANY       	= "COMPANY";
	var $CIVIL       	= "CIVIL";
	var $LASTNAME    	= "LASTNAME";
	var $FIRSTNAME   	= "FIRSTNAME";
	var $STAGE      	= "STAGE";
	var $STREET      	= "STREET";
	var $CITY        	= "CITY";
	var $POSTAL      	= "POSTAL";
	var $PROVENCE    	= "PROVENCE";
	var $COUNTRY     	= "COUNTRY";
	var $PHONE      	= "PHONE";
	var $JOUR    		= "JOUR";
	var $MOIS    		= "MOIS";
	var $ANNEE  		= "ANNEE";
	var $USERGROUPID   	= "USERGROUPID";
	var $CREATETIME   	= "CREATETIME";
	var $LASTLOGIN    	= "LASTLOGIN";
	var $ISDELETED    	= "ISDELETED";

	var $_userid       	= 1;
	var $_login        	= "";
	var $_password     	= "";
  	var $_password1     = "";
	var $_company      	= "";
	var $_civil        	= 'M';
	var $_lastname     	= "";
	var $_firstname    	= "";
	var $_stage       	= "";
	var $_street       	= "";
	var $_postal       	= "";
	var $_city         	= "";
	var $_provence  	= "";
	var $_country      	= "";
	var $_phone      	= "";
	var $_usergroupe 	= 0;
	var $_createtime 	= "";
	var $_lastlogin		= "";
	var $_isdeleted		= 'F';
	var $_day		= 0;
	var $_month		= 0;
	var $_year		= 0;
		
  	var $_trace 		= "";

	function setTrace($trace) {
	  $this->_trace = $trace;
	}
	function getTrace() {
	  return $this->_trace;
	}
	function addTrace($trace) {
	  $this->_trace .= $trace . "<br>";
	}

	function analyseEmail() {
		return valideEmail($this->_login);
	}

	function validePassword($p1, $p2) {
		$mess = "";
		if (strlen($p1) < $this->MIN_PASS_LEN || strlen($p1) > $this->MAX_PASS_LEN ||
		    strlen($p2) < $this->MIN_PASS_LEN || strlen($p2) >$this-> MAX_PASS_LEN) {
		    $mess .= ("Veuillez entrer un mot de passe du 4 au 10 caractères.");
		}
		if ($p1 != $p2) {
		    $mess .= ("Les mots de passe ne sont pas identiques");
		}
		return $mess;
	}
	function analysePassword() {
		return $this->validePassword($this->_password, $this->_password1);
	}

	function analyse() {
		$mess = $this->analysePassword();
		if ($mess)
			$this->addTrace($mess);

		$mess = $this->analyseEmail();
		if ($mess)
			$this->addTrace($mess);
		return $this->isOK();
	}

	function isOK() {
		if ($this->_trace)
			return 0;
		else
			return 1;
	}


	function getUserID() {
		return $this->_userid;
	}
	function setUserID($id) {
		$this->_userid = $id;
	}

	function getLogin() {
	  return $this->_login;
	}
	function setLogin($login) {
	  $this->_login = $login;
	}
	function getPassword() {
	  	return $this->_password;
	}
	
	function setPassword($pass) {
	  	$this->_password = $pass;
	}
	function getPassword1() {
	  	return $this->_password1;
	}
	function setPassword1($pass) {
	  	$this->_password1 = $pass;
	}

	function getCompany() {
		return $this->_company;
	}
	function setCompany($company) {
		$this->_company = $company;	
	}
	
	function getCivil() {
		return ($this->_civil);
	}
	function setCivil($civil) {
		$this->_civil = $civil;
	}

	function getFirstName() {
		return ($this->_firstname);
	}
	function setFirstName($name) {
		if (!$name) 
  			$this->addTrace("Veuillez entrer votre prénom");
  		else
 			$this->_firstname = replace($name);	
	}

	function getLastName() {
		return ($this->_lastname);
	}
	
	function setLastName($name) {
		if (!$name)
  			$this->addTrace("Veuillez entrer votre nom");	
  		else
			$this->_lastname = replace($name);	
	}
	
	function getStage() {
		return $this->_stage;
	}
	function setStage($stage) {
		$this->_stage = $stage;	
	}
	function getStreet() {
		return ($this->_street);
	}
	function setStreet($street) {
		if (!$street)
  			$this->addTrace("Veuillez entrer votre adresse");
  		else
 			$this->_street = replace($street);	
	}
	
	function getCity() {
		return ($this->_city);
	}
	function setCity($city) {
		if (!$city)
  			$this->addTrace("Veuillez entrer votre ville");
  		else
 			$this->_city = replace($city);
	}

	function getPostal() {
  		return ($this->_postal);
	}
	function setPostal($postal) {
  		if (!$postal)
  			$this->addTrace("Veuillez entrer votre code postal");
  		else 
 			$this->_postal = replace($postal);
 	}
 	
	function getProvence() {
    	return ($this->_provence);
	}
	function setProvence($provence) {
		$this->_provence = replace($provence);
	}

	function getCountry() {
    	return ($this->_country);
	}
	function setCountry($country) {
		if (!$country)
  			$this->addTrace("Veuillez entrer votre pays");	
  		else
			$this->_country = replace($country);
	}
	
	function getPhone() {
    	return ($this->_phone);
	}

	function setPhone($phone) {
		if (!$phone)
  			$this->addTrace("Veuillez entrer votre numero de telephone");	
  		else
 			$this->_phone = $phone;
	}
	
	function getBirthDay() {
    	return ($this->_day);
	}

	function setBirthDay($d) {
		$this->_day = $d;
	}
	function getBirthMonth() {
    	return ($this->_month);
	}

	function setBirthMonth($m) {
		$this->_month = $m;
	}
	function getBirthYear() {
    	return ($this->_year);
	}

	function setBirthYear($y) {
		$this->_year = $y;
	}
	
	function getUserGroupe() {
		return $this->_usergroupe;
	}
	function setUserGroupe($groupe) {
		$this->_usergroupe = $groupe;
	}
	function getCreateTime() {
		if (!$this->_createtime)
			$this->_createtime = time();
	  	return $this->_createtime;
	}
	function setCreateTime($date) {
	  	$this->_createtime = $date;
	}
	function getLastLogin() {
		if (!$this->_lastlogin)
			$this->_lastlogin = time();
		return $this->_lastlogin;
	}
	function setLastLogin($login) {
	   	$this->_lastlogin = $login;
	}
	function isDeleted() {
		return $this->_isdeleted;
	}
	function setDeleted($isdeleted) {
		$this->_isdeleted = $isdeleted;
	}

	function setNewUserData($id, $login, $pass, $civil, $lastname, $firstname, $company, 
		$stage, $addr, $city, $postal, $provance, $country, $phone, $jour, $mois, $annee, $groups) {
		$this->setUserID($id);
		$this->setLogin($login);
		$this->setPassword($pass);
		$this->setPassword1($pass);
		$this->setCompany($company);
		$this->setCivil($civil);
		$this->setLastName($lastname);
		$this->setFirstName($firstname);
		$this->setStage($stage);
		$this->setStreet($addr);
		$this->setCity($city);
		$this->setPostal($postal);
		$this->setProvence($provance);
		$this->setCountry($country);
		$this->setPhone($phone);
		$this->setBirthDay($jour);
		$this->setBirthMonth($mois);
		$this->setBirthYear($annee);
		$this->setUserGroupe($groups);
	}
	function setUserData($auser) {
		$this->setUserID($auser[$this->USERID]);
		$this->setLogin($auser[$this->LOGIN]);
		$this->setPassword($auser[$this->PASSWORD]);
		$this->setPassword1($auser[$this->PASSWORD]);
		$this->setCompany($auser[$this->COMPANY]);
		$this->setCivil($auser[$this->CIVIL]);
		$this->setLastName($auser[$this->LASTNAME]);
		$this->setFirstName($auser[$this->FIRSTNAME]);
		$this->setStage($auser[$this->STAGE]);
		$this->setStreet($auser[$this->STREET]);
		$this->setCity($auser[$this->CITY]);
		$this->setPostal($auser[$this->POSTAL]);
		$this->setProvence($auser[$this->PROVENCE]);
		$this->setCountry($auser[$this->COUNTRY]);
		$this->setPhone($auser[$this->PHONE]);
		$this->setBirthDay($auser[$this->JOUR]);
		$this->setBirthMonth($auser[$this->MOIS]);
		$this->setBirthYear($auser[$this->ANNEE]);
		$this->setUserGroupe($auser[$this->USERGROUPID]);
		$this->setCreateTime($auser[$this->CREATETIME]);
		$this->setLastLogin($auser[$this->LASTLOGIN]);
		$this->setDeleted($auser[$this->ISDELETED]);
	}
	
	function getUserData() {
		$buf = "(";
		$buf .= "'" . $this->getUserID() . "', ";
		$buf .= "'" . $this->getLogin() . "', ";
		$buf .= "'" . $this->getPassword() . "', ";
		$buf .= "'" . $this->getCompany() . "', ";
		$buf .= "'" . $this->getCivil() . "', ";
		$buf .= "'" . $this->getLastName() . "', ";
		$buf .= "'" . $this->getFirstName() . "', ";
		$buf .= "'" . $this->getStage() . "', ";
		$buf .= "'" . $this->getStreet() . "', ";
		$buf .= "'" . $this->getCity() . "', ";
		$buf .= "'" . $this->getPostal() . "', ";
		$buf .= "'" . $this->getProvence() . "', ";
		$buf .= "'" . $this->getCountry() . "', ";
		$buf .= "'" . $this->getPhone() . "', ";
		$buf .= "'" . $this->getBirthDay() . "', ";
		$buf .= "'" . $this->getBirthMonth() . "', ";
		$buf .= "'" . $this->getBirthYear() . "', ";
		$buf .= "'" . $this->getUserGroupe() . "', ";
		$buf .= "'" . $this->getCreateTime() . "', ";
		$buf .= "'" . $this->getLastLogin() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}
	
	function resetAddressData($newaddr) {
		$this->_civil        	= $newaddr->getCivil();
		$this->_lastname     	= $newaddr->getLastName();
		$this->_firstname    	= $newaddr->getFirstName();
		$this->_stage      		= $newaddr->getStage();
		$this->_street       	= $newaddr->getStreet();
		$this->_city       		= $newaddr->getCity();
		$this->_postal         	= $newaddr->getPostal();
		$this->_provence  		= $newaddr->getProvence();
		$this->_country      	= $newaddr->getCountry();
		$this->_phone      		= $newaddr->getPhone();
	}

	function copy() {
		$copyuser = new user_base();
		$copyuser->setLogin("copy".$this->getLogin());
		$copyuser->setPassword($this->getPassword());
		$copyuser->setCompany($this->getCompany());
		$copyuser->setCivil($this->getCivil());
		$copyuser->setLastName($this->getLastName());
		$copyuser->setFirstName($this->getFirstName());
		$copyuser->setStage($this->getStage());
		$copyuser->setStreet($this->getStreet());
		$copyuser->setCity($this->getCity());
		$copyuser->setPostal($this->getPostal());
		$copyuser->setProvence($this->getProvence());
		$copyuser->setCountry($this->getCountry());
		$copyuser->setPhone($this->getPhone());
		return $copyuser;
	}
 
	function getUpdateAddressData() {
		$buf = "";
		$buf .= $this->CIVIL. "='" . $this->getCivil() . "', ";
		$buf .= $this->LASTNAME. "='" . $this->getLastName() . "', ";
		$buf .= $this->FIRSTNAME. "='" . $this->getFirstName() . "', ";
		$buf .= $this->STAGE. "='" . $this->getStage() . "', ";
		$buf .= $this->STREET. "='" . $this->getStreet() . "', ";
		$buf .= $this->CITY. "='" . $this->getCity() . "', ";
		$buf .= $this->POSTAL. "='" . $this->getPostal() . "', ";
		$buf .= $this->PROVENCE. "='" . $this->getProvence() . "', ";
		$buf .= $this->COUNTRY. "='" . $this->getCountry() . "', ";
		$buf .= $this->PHONE. "='" . $this->getPhone() . "'";
		return $buf;
	}
}
?>