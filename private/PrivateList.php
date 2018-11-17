<?php
class PrivateList {
	
	var $DATABASE_OK		= 1;
	var $TABLE_NAME    		= "PSESSIONS";
	var $TEACHER			= "TEACHER";
	var $STUDENTID 			= "STUDENTID";
	var $DATES 				= "DATES";
	var $SUBJECTS 			= "SUBJECTS";
	var $BEGINNING 			= "BEGINNING";
	var $DELETED 			= "DELETED";
	
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
	
	function getTeacherPrivateSessions_1($teacher, $dates) {
		$lists = array();
		if ($this->DATABASE_OK) {
			$dd = getOrderDate($dates);
			$cond  =  $this->TEACHER. "='" .$teacher."'";
			$cond .= " AND " .$this->DATES. "='" .$dd."'";
			$elems =  $this->connection->get_order_elements_asc($this->TABLE_NAME, $cond, $this->BEGINNING);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$session = new PSessionClass();
					$session->setData($elems[$i]);
					if (!$session->isDeleted()) {
						$lists[] = $session;
					}
				}
			}
		}
		return $lists;
	}
	function getTeacherPrivateSessions($teacher, $dates) {
		$lists = array();
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			$lists = $this->getTeacherPrivateSessions_1($teacher, $dates);
			$exec->close();
		}
		return $lists;
	}
	function getWeekPrivateSessions($wdays) {
		$weeklists = array();
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
						
			for ($j = 0; $j < 7; $j++) {
				$cond = $this->DATES. "='" .$wdays[$j]."'";
				$lists = array();
				
				$sql = "SELECT * FROM " .$this->TABLE_NAME. " WHERE ".$cond." ORDER BY ".$this->TEACHER. " ASC, ".$this->BEGINNING." ASC";
				$p = $exec->get_query($sql);
				if ($p)
				{
					$i = 0;
					while ($data = @mysql_fetch_array($p)) {
						$session = new PSessionClass();
						$session->setData($data);
						if (!$session->isDeleted()) {
							$lists[] = $session;
						}
					}
				}
				$weeklists[] = $lists;
			}
			$this->close();
		}
		return $weeklists;
	}

	function getTeacherWeekPrivateSessions($teacher, $wdays) {
		$weeklists = array();
		if ($this->DATABASE_OK) {
			$exec = $this->connect();
			for ($j = 0; $j < 7; $j++) {
				$lists = $this-> getTeacherPrivateSessions_1($teacher, $wdays[$j]);
				$weeklists[] = $lists;
			}
			$exec->close();
		}
		return $weeklists;
	}
	
	function getTeacherPrivateSessionsDateList($teacher) {

		$lists = array();
		if ($this->DATABASE_OK) {
			$wdays = getWeekDates("");
			
			$exec = $this->connect();
			$cond  =  $this->TEACHER. "='" .$teacher."'";
			$cond .= " AND " .$this->DATES. ">='" .$wdays[0]. "'";

			$sql = "SELECT DISTINCT ".$this->DATES.", " .$this->DELETED. " FROM ".$this->TABLE_NAME." WHERE ".$cond." ORDER BY ".$this->DATES." ASC";
			
			$p = $exec->get_query($sql);
			if ($p)
			{
				$i = 0;
				while ($data = @mysql_fetch_array($p)) {
					/* no deleted */
					if (!$data[1]) { 
						$lists[$i++] = $data[0];
					}
					//$lists[$i++] = $data[0];
				}
			}
			$this->close();
		}
		return $lists;
		
	}

	function getStudentPrivateSessionTeacher($studentid) {
		$psession = "";
		if ($this->DATABASE_OK) {
			$wdays = getWeekDates("");
			
			$exec = $this->connect();
			$cond  =  $this->STUDENTID. "='" .$studentid."'";
			$cond .= " AND " .$this->DATES. ">='" .$wdays[0]. "'";
			
			$sql = "SELECT * FROM ".$this->TABLE_NAME." WHERE ".$cond." ORDER BY ".$this->DATES." ASC";
			$p = $exec->get_query($sql);
			if ($p)
			{
				$i = 0;
				while ($data = @mysql_fetch_array($p)) {
					$ps = new PSessionClass();
					$ps->setData($data);
					if (!$ps->isDeleted()) {
						$psession = $ps;
						break;
					}
				}
			}
			$this->close();
		}
		return $psession;
		
	}
	
}
?>