<?php

class HomeworkClass {

	var $TABLE_NAME    		= "HW_TABLE";
	var $TABLE  = array(
		"IDS",
		"TITLE",
		"SUBJECTS",
		"CLASSES",
		"ANNEE",
		"SEMESTER",
		"DATES",
		"FILES",
		"COMMENTS",
		"DELETED",
	);

	var $IDS		= 0;
	var $TITLE		= 1;
	var $SUBJECT   	= 2;
	var $CLASSES	= 3;
	var $ANNEE  	= 4;
	var $SEMESTER  	= 5;
	var $DATES   	= 6;
	var $FILES   	= 7;
	var $COMMENTS  	= 8;
	var $DELETED   	= 9;
	
	var $_ids		= 0;	
	var $_classes   = "";
	var $_annee  	= 2014;
	var $_semester  = "";
	var $_subjects  = "";
	var $_dates     = "";
	var $_titles  	= "";
	var $_files  	= "";
	var $_comments 	= "";
	var $_deleted  	= 0;

	var $_err  		= "";
	
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
	
	function getError() {
		return $this->_err;
	}
	function setError($err) {
		$this->_err = $err;
	}
	
	function getID() {
		return $this->_ids;
	}
	function setID($ids) {
		$this->_ids = $ids;
	}
	
	function getYear() {
		return $this->_annee;
	}
	function setYear($annee) {
		$this->_annee = $annee;
	}
	
	function getSemester() {
		return $this->_semester;
	}
	function setSemester($semester) {
		$this->_semester = $semester;
	}
	
	function getClasses() {
		return $this->_classes;
	}
	
	function setClasses($classes) {
		$this->_classes = $classes;
	}
	
	function getTitle() {
		return $this->_titles;
	}
	function setTitle($title) {
		$this->_titles = $title;
	}
	
	function getSubjects() {
		return $this->_subjects;
	}
	function setSubjects($subject) {
		$this->_subjects = $subject;
	}
	
	function getDates() {
		return $this->_dates;
	}
	function setDates($d) {
		return $this->_dates = $d;
	}
	function getFiles() {
		return $this->_files;
	}
	function setFiles($files) {
		return $this->_files = $files;
	}
	function getComments() {
		return $this->_comments;
	}
	function setComments($comments) {
		return $this->_comments = $comments;
	}
	
	function isDeleted() {
		return $this->_deleted;
	}
	function setDeleted($deleted) {
		return $this->_deleted = $deleted;
	}
	
	function setData($elem) {
		$this->setID($elem["$this->IDS"]);
		$this->setTitle($elem["$this->TITLE"]);
		$this->setSubjects($elem["$this->SUBJECT"]);
		$this->setClasses($elem["$this->CLASSES"]);
		$this->setYear($elem["$this->ANNEE"]);
		$this->setSemester($elem["$this->SEMESTER"]);
		$this->setDates($elem["$this->DATES"]);
		$this->setFiles($elem["$this->FILES"]);
		$this->setComments($elem["$this->COMMENTS"]);
		$this->setDeleted($elem["$this->DELETED"]);
	}

	function getHomework($id) {
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id);
		if ($elem) {
			$this->setData($elem);
			return 1;
		}
		return 0;
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
		$buf .= "'" . $this->getTitle() . "', ";
		$buf .= "'" . $this->getSubjects() . "', ";
		$buf .= "'" . $this->getClasses() . "', ";
		$buf .= "'" . $this->getYear() . "', ";
		$buf .= "'" . $this->getSemester() . "', ";
		$buf .= "'" . $this->getDates() . "', ";
		$buf .= "'" . $this->getFiles() . "', ";
		$buf .= "'" . $this->getComments() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}
	
	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->TITLE]. 	"='" . $this->getTitle() . "', ";
		$buf .= $this->TABLE[$this->SUBJECT]. 	"='" . $this->getSubjects() . "', ";
		$buf .= $this->TABLE[$this->CLASSES]. 	"='" . $this->getClasses() . "', ";
		$buf .= $this->TABLE[$this->ANNEE]. 	"='" . $this->getYear() . "', ";
		$buf .= $this->TABLE[$this->SEMESTER]. 	"='" . $this->getSemester() . "', ";
		$buf .= $this->TABLE[$this->DATES]. 	"='" . $this->getDates() . "', ";
		$buf .= $this->TABLE[$this->FILES]. 	"='" . $this->getFiles() . "', ";
		$buf .= $this->TABLE[$this->COMMENTS]. 	"='" . $this->getComments() . "', ";
		$buf .= $this->TABLE[$this->DELETED]. 	"='" . $this->isDeleted() ."'";
		return $buf;
	}
		
	
	function addNewHomework() {
		$exec = $this->connect();
		if ($this->getID() > 0) {
			$data = $this->getUpdateData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		}
		else {
			$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
			$this->setID($uid);
			$data = $this->getData();
			$exec->insert_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
		}
		$this->close();
	}
			
}
?>
