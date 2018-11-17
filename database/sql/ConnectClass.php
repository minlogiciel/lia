<?php

class ConnectClass {
	var $TABLE_NAME		= "CONNECT_LIA";

 	var $TABLE = array(
		  "IDS",
		  "USERIP",
		  "HOSTNAME",
		  "NUMBER",
		  "FIRSTCONNECT",
		  "LASTCONNECT",
		  "COUNTRY",
		  "DIVERS"
	);
	var $IDS			= 0;
	var $USERIP			= 1;
	var $HOSTNAME		= 2;
	var $CONNECTNB		= 3;
	var $FIRSTCONNECT	= 4;
	var $LASTCONNECT	= 5;
	var $COUNTRY		= 6;
	var $DIVERS			= 7;
	
	var $_ids   			= 0;
	var $_userip   			= "";
	var $_hostname 			= "";
	var $_number   			= "";
	var $_firstconnect		= "";
	var $_lastconnect		= "";
	var $_country  			= "";
	var $_divers  			= "";
	
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
	
	function getUserIP() {
	  	return $this->_userip;
	}
	function setUserIP($ip) {
		$this->_userip = $ip;
	}

	function getFirstConnect() {
	  	return $this->_firstconnect;
	}
	function getLastConnect() {
	  	return $this->_lastconnect;
	}
	function getCurrentDate() {
		return date("m/d/Y - H:i:s");
	}

	function getDivers() {
	  	return $this->_divers;
	}
	function setDivers($divers) {
		$this->_divers = $divers;
	}
	

	function buildTableRef() {
		$buf = "(";
		for ($i= 1; $i < count($this->TABLE); $i++) {
			if ($i > 1)
				$buf .= ", ";
			$buf .= $this->TABLE[$i];
		}
		$buf .= ")";
		return $buf;
	}

	function setUserData($data) {
		$this->_ids 		= ($data["$this->IDS"]);
		$this->_userip 		= ($data["$this->USERIP"]);
		$this->_hostname	= ($data["$this->HOSTNAME"]);
		$this->_number		= ($data["$this->CONNECTNB"]);
		$this->_firstconnect= ($data["$this->FIRSTCONNECT"]);
		$this->_lastconnect = ($data["$this->LASTCONNECT"]);
		$this->_country		= ($data["$this->COUNTRY"]);
		$this->_divers		= ($data["$this->DIVERS"]);
	}
	function getUserData() {
		$buf = "(";
		$buf .= "'" . $this->_userip. "', ";
		$buf .= "'" . $this->_hostname. "', ";
		$buf .= "'" . $this->_number . "', ";
		$buf .= "'" . $this->_firstconnect . "', ";
		$buf .= "'" . $this->_lastconnect . "', ";
		$buf .= "'" . $this->_country . "', ";
		$buf .= "'" . $this->_divers . "'";
		$buf .= ")";
		return $buf;
	}
	
	
	function findUserIP($ip) {
		$ret = 0;
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->USERIP], $ip);
		if ($elem) {
			$ret = 1;
		}
		$this->close();
		return $ret;
	}
	
	function findUserIPCountry($ip) {
		$gi = geoip_open(getDocumentRoot() . "/geoip/GeoIP.dat", GEOIP_STANDARD);	

		$this->_country = geoip_country_name_by_addr($gi, $ip);
		/*
		$record = geoip_record_by_addr($gi,$ip);
		$this->_country = $record->country_name;
		$this->_divers  = "Country : " 	.$record->country_name. " Region : " .$GEOIP_REGION_NAME[$record->country_code][$record->region];
		$this->_divers .= " City : " 		.$record->city. " ZipCode " .$record->postal_code;		
		*/
		geoip_close($gi);
	}
	
	function getHostName($ip) {
		$name = gethostbyaddr($ip);
		if (!$name)
			$name = "no hostname";
		return $name;
	}
	
	function addUserIP($ip, $curr_page='') {
		$this->_userip = $ip;

		/* find user ip, do update only */
		$exec = $this->connect();
		$elem = $exec->get_element_nolog($this->TABLE_NAME, $this->TABLE[$this->USERIP], $ip);
		if ($elem) {
			$this->_number = $elem[$this->CONNECTNB] + 1;
			$this->_lastconnect 	= $this->getCurrentDate();
			$vals = $this->TABLE[$this->CONNECTNB]. "='" .$this->_number. "', ";
			$vals .= $this->TABLE[$this->LASTCONNECT]. "='" .$this->_lastconnect. "', ";
			$vals .= $this->TABLE[$this->DIVERS]. "='" .$curr_page. "' ";
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->USERIP], $ip, $vals);
		}
		else {
			$this->_number 			= 1;			
			$this->_hostname 		= $this->getHostName($ip);
			$this->_firstconnect 	= $this->getCurrentDate();
			$this->_lastconnect 	= $this->_firstconnect;
			$this->_divers 			= $curr_page;
			$this->findUserIPCountry($ip);
			$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $this->getUserData());
		}
		$this->close();
	}
}
?>