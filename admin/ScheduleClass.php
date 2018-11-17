<?php
class ScheduleClass {

	var $TABLE_NAME    		= "SCHEDULE";
	var $DATA_BASE = 1;
	var $S_REMOVED = 1;

	var $SCHEDULE_TABLE  = array(
		"ID",
		"SDATE",
		"STIME",
		"TITLE1",
		"SUBJECT1",
		"TITLE2",
		"SUBJECT2",
		"TITLE3",
		"SUBJECT3",
		"DIVERS",
		"DELETED",    	/* 1 = removed */
		"ISTITLE"    	/* 1 = SCHEDULE TITLE */
	);

	var $U_ID     			= 0;
	var $U_DATE        		= 1;
	var $U_TIME        		= 2;
	var $U_TITLE1     		= 3;
	var $U_SUBJECT1     	= 4;
	var $U_TITLE2     		= 5;
	var $U_SUBJECT2     	= 6;
	var $U_TITLE3     		= 7;
	var $U_SUBJECT3     	= 8;
	var $U_DIVERS     		= 9;
	var $U_DELETED     		= 10;
	var $U_ISTITLE     		= 11;
	

	var $_id         		= "";
	var $_date       		= "";
	var $_time       		= "";
	var $_title1        	= "";
	var $_subject1       	= "";
	var $_title2        	= "";
	var $_subject2       	= "";
	var $_title3        	= "";
	var $_subject3       	= "";
	var $_divers   			= "";
	var $_deleted     		= 0;
	var $istitle     		= 0;
	
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

	function getTitle1() {
		return $this->_title1;
	}
	function setTitle1($text) {
		$this->_title1 = $this->replace($text);
	}
	function getSubject1() {
		return $this->_subject1;
	}
	function setSubject1($text) {
		$this->_subject1 = $this->replace($text);
	}

	function getTitle2() {
		return $this->_title2;
	}
	function setTitle2($text) {
		$this->_title2 = $this->replace($text);
	}
	function getSubject2() {
		return $this->_subject2;
	}
	function setSubject2($text) {
		$this->_subject2 = $this->replace($text);
	}

	function getTitle3() {
		return $this->_title3;
	}
	function setTitle3($text) {
		$this->_title3 = $this->replace($text);
	}
	function getSubject3() {
		return $this->_subject3;
	}
	function setSubject3($text) {
		$this->_subject3 = $this->replace($text);
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
        $ret = getWeekdayFromYear($this->_date). ", " .getMonth($mois). " " .$jour;
        if ($this->_time && strlen($this->_time) > 4)
        	$ret = $ret. ", " .$this->_time;
        return $ret;
		
	}
	function getDivers() {
		return $this->_divers;
	}
	function setDivers($divers) {
		$this->_divers =  $divers;
	}

	function setDeleted($deleted) {
		$this->_deleted =  $deleted;
	}
	function isDeleted() {
		return $this->_deleted;
	}

	function setIsTitle($istitle) {
		$this->istitle =  $istitle;
	}
	function isTitle() {
		return $this->istitle;
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

	function buildScheduleTableRef() {
		$buf = "(";
		for ($i= 1; $i < count($this->SCHEDULE_TABLE); $i++) {
			if ($i > 1)
			$buf .= ", ";
			$buf .= $this->SCHEDULE_TABLE[$i];
		}
		$buf .= ")";
		return $buf;
	}

	function setScheduleData($anews) {
		$this->setID($anews["$this->U_ID"]);
		$this->setDate($anews["$this->U_DATE"]);
		$this->setTime($anews["$this->U_TIME"]);
		$this->setTitle1($anews["$this->U_TITLE1"]);
		$this->setSubject1($anews["$this->U_SUBJECT1"]);
		$this->setTitle2($anews["$this->U_TITLE2"]);
		$this->setSubject2($anews["$this->U_SUBJECT2"]);
		$this->setTitle3($anews["$this->U_TITLE3"]);
		$this->setSubject3($anews["$this->U_SUBJECT3"]);
		$this->setDivers($anews["$this->U_DIVERS"]);
		$this->setDeleted($anews["$this->U_DELETED"]);
		$this->setIsTitle($anews["$this->U_ISTITLE"]);
	}

	function setSchedule($id, $dates, $times, $title1, $subject1, $title2, $subject2, $title3, $subject3, $divers, $isdelete)
	{
		$this->setID($id);
		$this->setDate($dates);
		$this->setTime($times);
		$this->setTitle1($title1);
		$this->setSubject1($subject1);
		$this->setTitle2($title2);
		$this->setSubject2($subject2);
		$this->setTitle3($title3);
		$this->setSubject3($subject3);
		$this->setDivers($divers);
		$this->setDeleted($isdelete);
		
	}

	function setScheduleTitle($id, $subject1, $subject2)
	{
		$this->setID($id);
		$this->setSubject1($subject1);
		$this->setSubject2($subject2);
		$this->setDeleted(1);
		$this->setIsTitle(1);
		
	}
	
	function getScheduleData() {
		$buf = "(";
		$buf .= "'" . $this->getDate() . "', ";
		$buf .= "'" . $this->getTime() . "', ";
		$buf .= "'" . $this->getTitle1() . "', ";
		$buf .= "'" . $this->getSubject1() . "', ";
		$buf .= "'" . $this->getTitle2() . "', ";
		$buf .= "'" . $this->getSubject2() . "', ";
		$buf .= "'" . $this->getTitle3() . "', ";
		$buf .= "'" . $this->getSubject3() . "', ";
		$buf .= "'" . $this->getDivers() . "', ";
		$buf .= "'" . $this->isDeleted() . "', ";
		$buf .= "'" . $this->isTitle() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->SCHEDULE_TABLE[$this->U_DATE]. "='" . $this->getDate() . "', ";
		$buf .= $this->SCHEDULE_TABLE[$this->U_TIME]. "='" . $this->getTime() . "', ";
		$buf .= $this->SCHEDULE_TABLE[$this->U_TITLE1]. "='" . $this->getTitle1() . "', ";
		$buf .= $this->SCHEDULE_TABLE[$this->U_SUBJECT1]. "='" . $this->getSubject1() . "', ";
		$buf .= $this->SCHEDULE_TABLE[$this->U_TITLE2]. "='" . $this->getTitle2() . "', ";
		$buf .= $this->SCHEDULE_TABLE[$this->U_SUBJECT2]. "='" . $this->getSubject2() . "', ";
		$buf .= $this->SCHEDULE_TABLE[$this->U_TITLE3]. "='" . $this->getTitle3() . "', ";
		$buf .= $this->SCHEDULE_TABLE[$this->U_SUBJECT3]. "='" . $this->getSubject3() . "', ";
		$buf .= $this->SCHEDULE_TABLE[$this->U_DIVERS]. "='" . $this->getDivers() . "', ";
		$buf .= $this->SCHEDULE_TABLE[$this->U_DELETED]. "='" . $this->isDeleted() . "', ";
		$buf .= $this->SCHEDULE_TABLE[$this->U_ISTITLE]. "='" . $this->isTitle() . "'";
		return $buf;
	}

	function addSchedule()
	{
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			if ($this->_id > 0) {
				if ($this->isDeleted()) {
					$exec->update_element($this->TABLE_NAME, $this->SCHEDULE_TABLE[$this->U_ID], $this->_id, $this->SCHEDULE_TABLE[$this->U_DELETED], $this->S_REMOVED);
				}
				else {
					$data = $this->getUpdateData();
					$exec->update_all_elements($this->TABLE_NAME, $this->SCHEDULE_TABLE[$this->U_ID], $this->_id, $data);
				}

			}
			else {
				$data = $this->getScheduleData();
				$exec->insert_elements($this->TABLE_NAME, $this->buildScheduleTableRef(), $data);
			}
			$exec->close();
		}
	}
	
	function updateScheduleTitle()
	{
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			if ($this->_id > 0) {
				$data = $this->getUpdateData();
				$exec->update_all_elements($this->TABLE_NAME, $this->SCHEDULE_TABLE[$this->U_ID], $this->_id, $data);
			}
			$exec->close();
		}
	}
	
	function getScheduleById($id) {
		if ($this->DATA_BASE) {

			$exec = $this->connect();
			$data = $exec->get_element($this->TABLE_NAME, $this->SCHEDULE_TABLE[$this->U_ID], $id);
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