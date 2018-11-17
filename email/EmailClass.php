<?php
class EmailClass {

	var $TABLE_NAME    		= "E_TABLE";

	var $_TABLE  = array(
		"IDS",
		"TITLE",
		"SUBJECTS",
		"GROUPS",
		"DATES",
		"SENDOK",
		"SENDKO",
		"CLASSES",
		"REPORTS",
	);

	var $U_ID     			= 0;
	var $U_TITLE     		= 1;
	var $U_SUBJECT     		= 2;
	var $U_GROUPS      		= 3;
	var $U_DATES       		= 4;
	var $U_SENDOK     		= 5;
	var $U_SENDKO     		= 6;
	var $U_CLASS     		= 7;
	var $U_REPORTS     		= 8;
	

	var $_id         		= "";
	var $_date       		= "";
	var $_groups       		= 0;
	var $_title        		= "";
	var $_subject       	= "";
	var $_sendok     		= "";
	var $_sendko     		= "";
	var $_class     		= "";
	var $_report     		= 0;
	
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

	function getTitle() {
		return $this->_title;
	}
	function setTitle($text) {
		$this->_title = $text;
	}
	function getSubject() {
		return $this->_subject;
	}
	function setSubject($text) {
		$this->_subject = $text;
	}

	function getDate() {
		return $this->_date;
	}
	function setDate($dd) {
		$this->_date = $dd;
	}
	function getGroups() {
		return $this->_groups;
	}
	function setGroups($g) {
		$this->_groups = $g;
	}
	function getReportCard() {
		return $this->_report;
	}
	function setReportCard($r) {
		$this->_report = $r;
	}
	
	function setSendOK($ok) {
		$this->_sendok =  $ok;
	}
	function getSendOK() {
		return $this->_sendok;
	}
	function setSendKO($ko) {
		$this->_sendko =  $ko;
	}
	function getSendKO() {
		return $this->_sendko;
	}
	function setClasses($classes) {
		$this->_class =  $classes;
	}
	function getClasses() {
		return $this->_class;
	}
	function setReport($tab) {
		$this->_class = "";
		$this->_sendok = "";
		$this->_sendko = "";
		for ($i = 0; $i < count($tab); $i+=2) {
			$this->_class .= $tab[$i]. ",";
			$elem = $tab[$i+1];
			for ($j = 0; $j < count($elem); $j+=2) {
				if ($elem[$j+1] == 1) {
					$this->_sendok .= $elem[$j]. ",";
				}
				else {
					$this->_sendko .= $elem[$j]. ",";
				}
			}
			
		}
	}
	

	function buildTableRef() {
		$buf = "(";
		for ($i= 0; $i < count($this->_TABLE); $i++) {
			if ($i > 0) {
				$buf .= ", ";
			}
			$buf .= $this->_TABLE[$i];
		}
		$buf .= ")";
		return $buf;
	}

	function setData($anews) {
		$this->setID($anews["$this->U_ID"]);
		$this->setTitle($anews["$this->U_TITLE"]);
		$this->setSubject($anews["$this->U_SUBJECT"]);
		$this->setGroups($anews["$this->U_GROUPS"]);
		$this->setDate($anews["$this->U_DATES"]);
		$this->setSendOK($anews["$this->U_SENDOK"]);
		$this->setSendKO($anews["$this->U_SENDKO"]);
		$this->setClasses($anews["$this->U_CLASS"]);
		$this->setReportCard($anews["$this->U_REPORTS"]);
	}

	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getTitle() . "', ";
		$buf .= "'" . $this->getSubject() . "', ";
		$buf .= "'" . $this->getGroups() . "', ";
		$buf .= "'" . $this->getDate() . "', ";
		$buf .= "'" . $this->getSendOK() . "', ";
		$buf .= "'" . $this->getSendKO() . "', ";
		$buf .= "'" . $this->getClasses() . "', ";
		$buf .= "'" . $this->getReportCard() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->_TABLE[$this->U_TITLE]. "='" . $this->getTitle() . "', ";
		$buf .= $this->_TABLE[$this->U_SUBJECT]. "='" . $this->getSubject() . "', ";
		$buf .= $this->_TABLE[$this->U_GROUPS]. "='" . $this->getGroups() . "', ";
		$buf .= $this->_TABLE[$this->U_DATES]. "='" . $this->getDate() . "', ";
		$buf .= $this->_TABLE[$this->U_SENDOK]. "='" . $this->getSendOK() . "', ";
		$buf .= $this->_TABLE[$this->U_SENDKO]. "='" . $this->getSendKO() . "', ";
		$buf .= $this->_TABLE[$this->U_CLASS]. "='" . $this->getClasses() . "', ";
		$buf .= $this->_TABLE[$this->U_REPORTS]. "='" . $this->getReportCard() . "'";
		return $buf;
	}
	
	function addEmail()
	{
		$exec = $this->connect();
		if ($this->_id > 0) {
			$data = $this->getUpdateData();
			$exec->update_all_elements($this->TABLE_NAME, $this->_TABLE[$this->U_ID], $this->_id, $data);
		}
		else {
			$uid = $exec->get_max_number($this->TABLE_NAME, $this->_TABLE[$this->U_ID]);
			$this->setID($uid);
			$data = $this->getData();
			$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
		}
		$exec->close();
		return $this->getID();
	}
	
	function getEmailById($id) {
		$ret = 0;
		$exec = $this->connect();
		$data = $exec->get_element($this->TABLE_NAME, $this->_TABLE[$this->U_ID], $id);
		if ($data) {
			$this->setData($data);
			$ret = 1;
		}
		$exec->close();
		return $ret;
	}
}

?>