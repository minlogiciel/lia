<?php
class customer_base  {

	var $PID      		= "PID";
	var $CUSTOMERIP     = "CUSTOMERIP";
	var $PRODUITS       = "PRODUITS";
	var $CREATETIME     = "CREATETIME";
	var $LASTMODIF      = "LASTMODIF";
	
	var	$_id      		= 1;
	var $_customerip    = "";
	var $_produits     	= "";
	var $_createtime    = "";
	var $_lastmodif     = "";

	function setData($data) {
		$this->setID($data[$this->PID]);
		$this->setCustomerIP($data[$this->CUSTOMERIP]);
		$this->setBuyProduits($data[$this->PRODUITS]);
		$this->setCreateTime($data[$this->CREATETIME]);
		$this->setLastModif($data[$this->LASTMODIF]);
	}
	
	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getCustomerIP() . "', ";
		$buf .= "'" . $this->getBuyProduits() . "',";
		$buf .= "'" . $this->getCreateTime() . "',";
		$buf .= "'" . $this->getLastModif() . "'";
		$buf .= ")";
		return $buf;
	}


	function getID() {
		return $this->_id;
	}
	function setID($v) {
		$this->_id = $v;
	}
	
	function getCustomerIP() {
		return $this->_customerip;
	}
	function setCustomerIP($ip) {
		$this->_customerip = $ip;
	}

	function getBuyProduits() {
		return $this->_produits;
	}

	function setBuyProduits($_produits) {
		$this->_produits = $_produits;
	}

	function setCreateTime($d) {
		if ($d)
			$this->_createtime = $d;
		else
			$this->_createtime = time();
			
	}
	function getCreateTime() {
		return $this->_createtime;
	}
	function setLastModif($d) {
		if ($d)
			$this->_lastmodif = $d;
		else
			$this->_lastmodif = time();
			
	}
	function getLastModif() {
		return $this->_lastmodif;
	}

}
?>
