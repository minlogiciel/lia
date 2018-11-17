<?php
class ScheduleList {
	
	var $TABLE_NAME = "SCHEDULE";
	var $DATA_BASE 	= 1;
	
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
	
	function getScheduleTitle() {
		$schedule = '';
		
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->TABLE_NAME, 'ISTITLE', 1);
			if ($elem) {
				$schedule = new ScheduleClass();
				$schedule->setScheduleData($elem);
			}
			$this->close();
		}
		return $schedule;
	}
	
	function getScheduleList() {
		$lists = array();
		
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			$elems = $exec->get_all_elements_array($this->TABLE_NAME);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$schedule = new ScheduleClass();
					$schedule->setScheduleData($elems[$i]);
					if (!($schedule->isDeleted()))
						$lists[] = $schedule;
				}
			}
			$this->close();
		}
		return $lists;
	}
}
?>
