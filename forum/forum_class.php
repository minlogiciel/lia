<?php
class forum_class {

	var $table_name 	= "NEWS_V20";
	var $PID     		= "PID";
	var $UREAD      	= "UREAD";
	var $URESP      	= "URESP";
	var $UGROUP    		= "UGROUP";
	var $UPARENT   		= "UPARENT";

	var $connection			= '';
	var $max_page			= 1;

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

   	function updateReadNumber($pid) {
  		$exec = $this->connect();
 		$msg = $exec->get_element($this->table_name, $this->PID, $pid);
 		if ($msg) {
			$n_read = $msg[$this->UREAD] + 1;
			$exec->update_element($this->table_name, $this->PID, $pid, $this->UREAD, $n_read); 
		}
		$this->close();
  	}
  	
   	function updateResponseNumber($pid) {
  		$exec = $this->connect();
		$msg = $exec->get_element($this->table_name, $this->PID, $pid);
		if ($msg) {
			$n_resp = $msg[$this->URESP] + 1;
			$exec->update_element($this->table_name, $this->PID, $pid, $this->URESP, $n_resp); 
		}
 		$this->close();
 	}

	function addMessage($msg)
	{
		$exec = $this->connect();
		$uid = $exec->get_max_number($this->table_name, $this->PID);

		$msg->setID($uid);
		$msg->setCreateTime("");
		$group = $msg->getGroup();
		if (!$group) {
			$msg->setGroup($uid);
		} 
		if (!$msg->getError()) {
			//$exec->insert_elements($this->table_name, '', $msg->getNewsData());
			$exec->insert_elements($this->table_name, $msg->buildTableRef(), $msg->getNewsData());
			if ($group) {
				$this->updateResponseNumber($group);
			}
		}
		
		$this->close();
		return $uid;
	}


	function getSujectChildrenNews($uid) {
		$newslist = array();
		$elems = $this->connection->get_order_elements($this->table_name, $this->UPARENT,  $uid, $this->PID);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$news = new forum_base();
				$news->setNewsData($elems[$i]);
				$cchild = $this->getSujectChildrenNews($news->getID());
				$news->setChildren($cchild);
				$newslist[] = $news;
			}
		}
		return $newslist;
	}
	
	function getSujectNews($uid) {
		$exec = $this->connect();
		$elem = $exec->get_element($this->table_name, $this->PID,  $uid);
		$news = '';
		if ($elem) {
			$news = new forum_base();
			$news->setNewsData($elem);
			$children = $this->getSujectChildrenNews($uid);
			$news->setChildren($children);
		}
		$this->close();
		return $news;
	}

	function getAllSujectNews() {
		$exec = $this->connect();
		$elems = $exec->get_order_elements($this->table_name, $this->UPARENT,  0, $this->PID);
		$newslist = array();
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$news = new forum_base();
				$news->setNewsData($elems[$i]);
				$newslist[] = $news;
			}
		}
		$this->close();
		return $newslist;
	}
	function getNewsFrom($nStart, $nTotal) {
		$this->max_page = 1;
		$lists = array();
		$exec = $this->connect();
		$elems = $exec->get_order_elements($this->table_name, $this->UPARENT,  0, $this->PID);
		if ($elems) {
			$nb = count($elems);
			$this->max_page = ceil($nb/$nTotal);
			if ($nStart > $nb) {
				$nn = floor($nb/$nTotal);
				$start_nb = $nn*$nTotal;
			}
			else {
				$start_nb 	= $nStart;		
			}
			$end_nb = $start_nb + $nTotal;
			if ($end_nb > $nb) {
				$end_nb = $nb;
			}
			$j = 0;
			for ($i = $start_nb; $i < $end_nb; $i++) {
				$news = new forum_base();
				$news->setNewsData($elems[$i]);
				$lists[$j++] = $news;
			}
		}
		$this->close();
		return $lists;
	}
	function getMaxPageNumber() {
		return $this->max_page;
	}
	function getGroupNews($group) {
		$exec = $this->connect();
		$elems = $exec->get_order_elements($this->table_name, $this->UGROUP,  $group, $this->PID);
		$newslist = array();
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$news = new forum_base();
				$news->setNewsData($elems[$i]);
				$newslist[] = $news;
			}
		}
		$this->close();
		return $newslist;
	}

	function getAllNews() {
		$exec = $this->connect();
		$elems = $exec->get_all_elements_array($this->table_name);
		$newslist = array();
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$news = new forum_base();
				$news->setNewsData($elems[$i]);
				$newslist[] = $news;
			}
		}
		$this->close();
		return $newslist;
	}

}
?>
