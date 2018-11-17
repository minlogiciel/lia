<?php
class ACTClass {

	var $TABLE_NAME    		= "ACT";
	var $DATA_BASE = 1;
	var $S_REMOVED = 1;

	var $_TABLE  = array(
		"ID",
		"SDATE",
		"STIME",
		"TITLE",
		"SUBJECT",
		"DELETED",    	/* 1 = removed */
		"ISTITLE"    	/* 1 = SCHEDULE TITLE */
	);

	var $U_ID     			= 0;
	var $U_DATE        		= 1;
	var $U_TIME        		= 2;
	var $U_TITLE     		= 3;
	var $U_SUBJECT     		= 4;
	var $U_DELETED     		= 5;
	var $U_ISTITLE     		= 6;
	

	var $_id         		= "";
	var $_date       		= "";
	var $_time       		= "";
	var $_title        		= "";
	var $_subject       	= "";
	var $_deleted     		= 0;
	
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
		$this->_title = $this->replace($text);
	}
	function getSubject() {
		return $this->_subject;
	}
	function setSubject($text) {
		$this->_subject = $this->replace($text);
	}

	function getDate() {
		return $this->_date;
	}
	function setDate($dd) {
		if ($dd)
		$this->_date = $dd;
	}
	function getTime() {
		return $this->_time;
	}
	function setTime($tt) {
		if ($tt)
		$this->_time = $tt;
	}
	
	function getFullDate() {
		list($annee, $mois, $jour) =  explode("-", $this->_date);
		$tstamp=mktime(0,0,0,$mois,$jour,$annee); 
        $Tdate = getdate($tstamp); 
        $ret = getWeekday($Tdate["wday"]). ", " .getMonth($mois). " " .$jour;
        if ($this->_time && strlen($this->_time) > 4)
        	$ret = $ret. ", " .$this->_time;
        return $ret;
		
	}

	function setDeleted($deleted) {
		$this->_deleted =  $deleted;
	}
	function isDeleted() {
		return $this->_deleted;
	}

	function isTitle() {
		if ($this->_title)
			return 1;
		else
			return 0;
	}
	
	function replace($str) {
		$newstr = "";
		if ($str) {
			if (strstr($str, "&quot;") || strstr($str, "&#039;") || strstr($str, "&lt;") || strstr($str, "&gt;")) {
				$newstr = $str;
				$newstr = str_replace("&quot;", "\"", $newstr);
				$newstr = str_replace("&#039;", "'",  $newstr);
				$newstr = str_replace("&lt;", "<",  $newstr);
				$newstr = str_replace("&gt;", ">",  $newstr);
			}
			else {
				$newstr = htmlspecialchars($str, ENT_NOQUOTES);
				$newstr = htmlspecialchars($str, ENT_QUOTES);
				$newstr = str_replace('\"', "&quot;", $newstr);
				$newstr = str_replace("\'", "&#039;", $newstr);
			}
		}
		return $newstr;
	}

	function buildActTableRef() {
		$buf = "(";
		for ($i= 1; $i < count($this->_TABLE); $i++) {
			if ($i > 1)
			$buf .= ", ";
			$buf .= $this->_TABLE[$i];
		}
		$buf .= ")";
		return $buf;
	}

	function setActData($anews) {
		$this->setID($anews["$this->U_ID"]);
		$this->setDate($anews["$this->U_DATE"]);
		$this->setTime($anews["$this->U_TIME"]);
		$this->setTitle($anews["$this->U_TITLE"]);
		$this->setSubject($anews["$this->U_SUBJECT"]);
		$this->setDeleted($anews["$this->U_DELETED"]);
	}

	function setAct($id, $dates, $times, $subject, $isdelete)
	{
		$this->setID($id);
		$this->setDate($dates);
		$this->setTime($times);
		$this->setTitle1("");
		$this->setSubject1($subject);
		$this->setDeleted($isdelete);		
	}

	function setActTitle($id, $title)
	{
		$this->setID($id);
		$this->setTitle($title);		
	}
	
	function getActData() {
		$buf = "(";
		$buf .= "'" . $this->getDate() . "', ";
		$buf .= "'" . $this->getTime() . "', ";
		$buf .= "'" . $this->getTitle() . "', ";
		$buf .= "'" . $this->getSubject() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->_TABLE[$this->U_DATE]. "='" . $this->getDate() . "', ";
		$buf .= $this->_TABLE[$this->U_TIME]. "='" . $this->getTime() . "', ";
		$buf .= $this->_TABLE[$this->U_TITLE]. "='" . $this->getTitle() . "', ";
		$buf .= $this->_TABLE[$this->U_SUBJECT]. "='" . $this->getSubject() . "', ";
		$buf .= $this->_TABLE[$this->U_ISTITLE]. "='" . $this->isDeleted() . "'";
		return $buf;
	}

	function addAct()
	{
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			if ($this->_id > 0) {
				if ($this->isDeleted()) {
					$exec->update_element($this->TABLE_NAME, $this->_TABLE[$this->U_ID], $this->_id, $this->_TABLE[$this->U_DELETED], $this->S_REMOVED);
				}
				else {
					$data = $this->getUpdateData();
					$exec->update_all_elements($this->TABLE_NAME, $this->_TABLE[$this->U_ID], $this->_id, $data);
				}

			}
			else {
				$data = $this->getScheduleData();
				$exec->insert_elements($this->TABLE_NAME, $this->buildActTableRef(), $data);
			}
			$exec->close();
		}
	}
	
	function updateActTitle()
	{
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			if ($this->_id > 0) {
				$data = $this->getUpdateData();
				$exec->update_all_elements($this->TABLE_NAME, $this->_TABLE[$this->U_ID], $this->_id, $data);
			}
			$exec->close();
		}
	}
	
	function getActById($id) {
		if ($this->DATA_BASE) {

			$exec = $this->connect();
			$data = $exec->get_element($this->TABLE_NAME, $this->_TABLE[$this->U_ID], $id);
			if ($data) {
				$this->setScheduleData($data);
			}
			else {
				print_r ("not found id " .$id );
			}
			$exec->close();
		}
	}
}

?>