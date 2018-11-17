<?php
class forum_base {

	var $TABLE     = array (
			"PID", 
			"UTITLE",
			"USUBJECT",
			"UTEXT",
			"UIMAGE",
			"UAUTOR",
			"UAUTORID",
			"UTIME",
			"UGROUP",
			"UPARENT",
			"ULEVEL",
			"UREAD",
			"URESP",
			"UTYPES");

	var $PID_I     		= 0;
	var $UTITLE_I     	= 1;
	var $USUBJECT_I     = 2;
	var $UTEXT_I      	= 3;
	var $UIMAGE_I       = 4;
	var $UAUTOR_I       = 5;
	var $UAUTORID_I     = 6;
	var $UTIME_I      	= 7;
	var $UGROUP_I    	= 8;
	var $UPARENT_I   	= 9;
	var $ULEVEL_I      	= 10;
	var $UREAD_I     	= 11;
	var $URESP_I      	= 12;
	var $UTYPES_I      	= 13;
	
	var $PID     		= "PID";
	var $UTITLE     	= "UTITLE";
	var $USUBJECT       = "USUBJECT";
	var $UTEXT      	= "UTEXT";
	var $UIMAGE       	= "UIMAGE";
	var $UAUTOR        	= "UAUTOR";
	var $UAUTORID       = "UAUTORID";
	var $UTIME      	= "UTIME";
	var $UGROUP    		= "UGROUP";
	var $UPARENT   		= "UPARENT";
	var $ULEVEL      	= "ULEVEL";
	var $UREAD      	= "UREAD";
	var $URESP      	= "URESP";
	var $UTYPES      	= "UTYPES";

	
	var $_id         		= "";
	var $_title        		= "";
	var $_subject        	= "";
	var $_text     			= "";
	var $_images    		= "";
	var $_autor       		= "";
	var $_autorid     		= "";
	var $_time       		= "";
	var $_group         	= 0;
	var $_parent      		= 0;
	var $_level      		= 1;
	var $_read      		= 0;
	var $_resp        		= 0;
	var $_types        		= "";

	var $_trace				= "";

	var $children			= '';

	function setError($trace) {
	  	$this->_trace = $trace;
	}
	function getError() {
	  	return $this->_trace;
	}
	
	function addError($trace) {
	  	$this->_trace .= $trace . "<br>";
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
		if (!$title) {
			$this->addError("You should input a title.") ;
		}
		else {
			$this->_title = replace($title);
		}
	}
	function getSubject() {
		return $this->_subject;
	}
	function setSubject($subject) {
		$this->_subject = replace($subject);
	}
	function getText() {
		return $this->_text;
	}
	function setText($text) {
		$this->_text = replace($text);
	}
	function getImages() {
		return $this->_images;
	}
	function setImages($images) {
		$this->_iamges = replace($images);
	}
	
	function getAutor() {
		return $this->_autor;
	}
	function setAutor($text) {
		if (!$text)
			$this->addError("You should input your name.") ;
		else
			$this->_autor = replace($text);
	}
	function getAutorID() {
		return $this->_autorid;
	}
	function setAutorID($n) {
		$this->_autorid = $n;
	}
	function getCreateTime() {
		return $this->_time;
	}
	function setCreateTime($t) {
		if ($t)
			$this->_time = $t;
		else
			$this->_time = time();
	}
	function getGroup() {
		return $this->_group;
	}
	function setGroup($n) {
		$this->_group = $n;
	}
	function getParent() {
		return $this->_parent;
	}
	function setParent($n) {
		$this->_parent = $n;
	}
	function getLevel() {
		return $this->_level;
	}
	function setLevel($n) {
		$this->_level = $n;
	}
	function getRead() {
		return $this->_read;
	}
	function setRead($n) {
		$this->_read = $n;
	}
	function getResponse() {
		return $this->_resp;
	}
	function setResponse($n) {
	  	$this->_resp = $n;
	}
	function getTypes() {
		return $this->_types;
	}
	function setTypes($text) {
		$this->_types =  $text;
	}
	function getChildren() {
		return $this->children;
	}
	function setChildren($children) {
		$this->children = $children;
	}

	
  	function setNewsData($anews) {
    	$this->setID($anews["$this->PID_I"]);
    	$this->setTitle($anews["$this->UTITLE_I"]);
    	$this->setSubject($anews["$this->USUBJECT_I"]);
    	$this->setText($anews["$this->UTEXT_I"]);
   		$this->setImages($anews["$this->UIMAGE_I"]);
     	$this->setAutor($anews["$this->UAUTOR_I"]);
     	$this->setAutorID($anews["$this->UAUTORID_I"]);
    	$this->setCreateTime($anews["$this->UTIME_I"]);
    	$this->setGroup($anews["$this->UGROUP_I"]);
    	$this->setParent($anews["$this->UPARENT_I"]);
     	$this->setLevel($anews["$this->ULEVEL_I"]);
    	$this->setRead($anews["$this->UREAD_I"]);
    	$this->setResponse($anews["$this->URESP_I"]);
    	$this->setTypes($anews["$this->UTYPES_I"]);
  	}

  	function getNewsData() {
    	$buf = "(";
    	$buf .= "'" . $this->getID(). "', ";
    	$buf .= "'" . $this->getTitle() . "', ";
    	$buf .= "'" . $this->getSubject() . "', ";
     	$buf .= "'" . $this->getText() . "', ";
    	$buf .= "'" . $this->getImages() . "', ";
    	$buf .= "'" . $this->getAutor() . "', ";
    	$buf .= "'" . $this->getAutorID() . "', ";
    	$buf .= "'" . $this->getCreateTime() . "', ";
    	$buf .= "'" . $this->getGroup() . "', ";
    	$buf .= "'" . $this->getParent() . "', ";
    	$buf .= "'" . $this->getLevel() . "', ";
    	$buf .= "'" . $this->getread() . "', ";
    	$buf .= "'" . $this->getResponse() . "', ";
    	$buf .= "'" . $this->getTypes() . "'";
    	$buf .= ")";
    	return $buf;
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
  	
	function setNewNews($uid, $title, $subject, $text, $img, $autor, $group, $parent, $level, $types)
	{
    	$this->setID($uid);
    	$this->setTitle($title);
    	$this->setSubject($subject);
    	$this->setText($text);
   		$this->setImages($img);
     	$this->setAutor($autor);
     	$this->setAutorID($autor);
    	$this->setCreateTime("");
    	$this->setGroup($group);
     	$this->setParent($parent);
     	$this->setLevel($level);
    	$this->setTypes($types);
	}
	
	function setMessageElement($title, $text, $autor, $group, $parent, $level)
	{
    	$this->setTitle($title);
    	$this->setSubject($title);
    	$this->setText($text);
     	$this->setAutor($autor);
     	$this->setAutorID($autor);
     	$this->setGroup($group);
     	$this->setParent($parent);
     	$this->setLevel($level);
 	}
}
?>