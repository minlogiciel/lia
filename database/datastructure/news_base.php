<?php
class news_base {

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
			$this->addError("You should input your subject title.") ;
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
    	$this->setID($anews[$this->PID]);
    	$this->setTitle($anews[$this->UTITLE]);
    	$this->setSubject($anews[$this->USUBJECT]);
    	$this->setText($anews[$this->UTEXT]);
   		$this->setImages($anews[$this->UIMAGE]);
     	$this->setAutor($anews[$this->UAUTOR]);
     	$this->setAutorID($anews[$this->UAUTORID]);
    	$this->setCreateTime($anews[$this->UTIME]);
    	$this->setGroup($anews[$this->UGROUP]);
    	$this->setParent($anews[$this->UPARENT]);
     	$this->setLevel($anews[$this->ULEVEL]);
    	$this->setRead($anews[$this->UREAD]);
    	$this->setResponse($anews[$this->URESP]);
    	$this->setTypes($anews[$this->UTYPES]);
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
}
?>
