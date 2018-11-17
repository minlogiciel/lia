<?php
class ReportClass {

	var $TABLE_NAME    		= "REPORT_TABLE";

	var $_TABLE  = array(
		"IDS",
		"TITLE",
		"CLASSES",
		"YEARS",
		"SEMESTERS",
		"DATES",
		"PATHS",
		"REPORTS",
		"DIVERS",
	);

	var $U_ID     			= 0;
	var $U_TITLE     		= 1;
	var $U_CLASS     		= 2;
	var $U_YEAR     		= 3;
	var $U_SEMESTER      	= 4;
	var $U_DATES       		= 5;
	var $U_PATH     		= 6;
	var $U_REPORTS     		= 7;
	var $U_DIVERS     		= 8;
	

	var $_id         		= "";
	var $_date       		= "";
	var $_year       		= 0;
	var $_title        		= "";
	var $_semester       	= "";
	var $_path     			= "";
	var $_divers     		= "";
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
	function setTitle($title) {
		$this->_title = $title;
	}
	function getYear() {
		return $this->_year;
	}
	function setYear($y) {
		$this->_year = $y;
	}

	function getDate() {
		return $this->_date;
	}
	function setDate($dd) {
		$this->_date = $dd;
	}
	function getSemester() {
		return $this->_semester;
	}
	function setSemester($semester) {
		$this->_semester = $semester;
	}
	function getReport() {
		return $this->_report;
	}
	function setReport($report) {
		$this->_report = $report;
	}
	
	function setPath($path) {
		$this->_path =  $path;
	}
	function getPath() {
		return $this->_path;
	}
	function setDivers($divers) {
		$this->_divers =  $divers;
	}
	function getDivers() {
		return $this->_divers;
	}
	function setClasses($classes) {
		$this->_class =  $classes;
	}
	function getClasses() {
		return $this->_class;
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
		$this->setYear($anews["$this->U_YEAR"]);
		$this->setSemester($anews["$this->U_SEMESTER"]);
		$this->setDate($anews["$this->U_DATES"]);
		$this->setPath($anews["$this->U_PATH"]);
		$this->setDivers($anews["$this->U_DIVERS"]);
		$this->setClasses($anews["$this->U_CLASS"]);
		$this->setReport($anews["$this->U_REPORTS"]);
	}

	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getTitle() . "', ";
		$buf .= "'" . $this->getClasses() . "', ";
		$buf .= "'" . $this->getYear() . "', ";
		$buf .= "'" . $this->getSemester() . "', ";
		$buf .= "'" . $this->getDate() . "', ";
		$buf .= "'" . $this->getPath() . "', ";
		$buf .= "'" . $this->getReport() . "', ";
		$buf .= "'" . $this->getDivers() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->_TABLE[$this->U_DATES]. "='" . $this->getDate() . "', ";
		$buf .= $this->_TABLE[$this->U_PATH]. "='" . $this->getPath() . "', ";
		$buf .= $this->_TABLE[$this->U_REPORTS]. "='" . $this->getReport() . "', ";
		$buf .= $this->_TABLE[$this->U_DIVERS]. "='" . $this->getDivers() . "'";
		return $buf;
	}
	
	function addReport()
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

	function getClassReport($classes, $period, $semester) {
		$ret = 0;
		$exec = $this->connect();
		$classname 	= getClassName($classes);
		$sem = getSemesterByString($semester);
		$year = getYearByString($period);

		$cond  = $this->_TABLE[$this->U_CLASS]. 	"='" .$classname. 	"'" ;
		$cond .= " AND " .$this->_TABLE[$this->U_YEAR]. 	"='" .$year.	"'";
		$cond .= " AND " .$this->_TABLE[$this->U_SEMESTER]. 	"='" .$sem.	"'";
		$data =  $exec->get_element_1($this->TABLE_NAME, $cond);
		if ($data) {
			$this->setData($data);
			$ret = 1;
		}
		$this->close();
		return $ret;
	}
}

?>