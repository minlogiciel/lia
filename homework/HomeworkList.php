<?php


class HomeworkList {
	var $IDS_NAME    	= "IDS";
	var $REG_TABLE_NAME	= "REG_TABLE";
	
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
	
	function getHomeworkClassLists($classes) {
		$lists = array();

		$exec = $this->connect();

		$cond = "CLASSES='" .$classes. "' AND SEMESTER='" .getSemester(). "' AND ANNEE='" .date("Y"). "'";
		//$cond = "CLASSES='" .$classes. "'";
		
		$elems =  $exec->get_order_elements_2("HW_TABLE", $cond, "DATES");
		
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$homework = new HomeworkClass();
				$homework->setData($elems[$i]);
				$lists[] = $homework;
			}
		}
		$this->close();
		return $lists;
	}
	
}
?>
