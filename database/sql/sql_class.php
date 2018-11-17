<?php
class sql_class 
{
	var $serveur 	= "localhost";
	var $user		= "root";
	var $passwd		= "";
	var $base_name	= "lia.usa";
	
	var $connection 	= '';
	function sql_class($serveur='', $user='', $passwd='', $base_name='')
	{
		global $SQL_SERVER, $SQL_USER, $SQL_PASSWD, $SQL_BASE;
	
		if ($serveur)
			$this->serveur 	= $serveur;
		else
			$this->serveur 	= $SQL_SERVER;
		
		if ($user)
			$this->user 	= $user;
		else
			$this->user 	= $SQL_USER;
		
		if ($passwd)
			$this->passwd 	= $passwd;
		else
			$this->passwd = $SQL_PASSWD;
		
		if ($base_name)
			$this->base_name = $base_name;
		else
			$this->base_name = $SQL_BASE;
		$this->connect();
	}

	
	function connect() 
	{
		if (!$this->connection) {
			$this->connection = @mysql_connect("$this->serveur", "$this->user", "$this->passwd") 
				or die("Error : connect to Mysql server ".$this->serveur. " : " .$this->user. ", " .mysql_error());
			@mysql_select_db("$this->base_name", $this->connection) 
				or die("Impossible to select database ".$this->base_name. ", " .mysql_error());
		}
	}
	
	function close() 
	{
		if ($this->connection) {
			@mysql_close($this->connection);
		}
	}
	
	function get_query($sql) 
	{
		$p = '';
		if (!$this->connection)
			$this->connect();
		$p = @mysql_query($sql, $this->connection) or die("Problem of get connecting " .$sql. ", " .mysql_error());
		return $p;
	}
	
	function exec_query($sql) 
	{
		if (!$this->connection)
			$this->connect();
		@mysql_query($sql) or die("Problem of exection query : " .$sql. ", " .mysql_error());
	}
	
	function get_row_number($p) 
	{
		if (!$this->connection)
			$this->connect();
		$n = @mysql_num_rows($p) or die("Problem of get_row_number : " . mysql_error());
		return $n;
	}
	
	function get_result($p, $nstart, $nend) 
	{
		if (!$this->connection)
			$this->connect();
		$resu = @mysql_result($p, $nstart, $nend) or die("Problem of get_result : " .mysql_error());
		return $resu;
	}
	
	/* delete from tab_name WHERE col=val */
	function delete_element($tab_name, $col, $val)
	{
		$sql = "DELETE FROM $tab_name WHERE $col='$val'";
		$this->exec_query($sql);
	}
	/* INSERT INTO tab_name (column1, column2,...) VALUES (value1, value2,....) */
	function insert_elements($tab_name, $cols='', $vals)
	{
 		$sql="INSERT INTO $tab_name $cols VALUES $vals" ; 
		$this->exec_query($sql);
	}

	function get_element($tab_name, $col, $val)
	{
		global $logging;
		$elems = '';
		$sql = "SELECT * FROM $tab_name WHERE $col='$val'";
		$p = $this->get_query($sql);
		if ($p)
		{
			$elems = @mysql_fetch_array($p);
			$logging->lwrite($sql, "INFO", "database");
		}
		else {
			print_r("Not Found " .$sql);
		}
		return $elems;
	}
	
	function get_element_nolog($tab_name, $col, $val)
	{
		global $logging;
		$elems = '';
		$sql = "SELECT * FROM $tab_name WHERE $col='$val'";
		$p = $this->get_query($sql);
		if ($p)
		{
			$elems = @mysql_fetch_array($p);
		}
		else {
			print_r("Not Found " .$sql);
		}
		return $elems;
	}
	
	function get_element_1($tab_name, $cond)
	{
		global $logging;
		$elems = '';
		$sql = "SELECT * FROM $tab_name WHERE $cond";
		$p = $this->get_query($sql);
		if ($p)
		{
			$elems = @mysql_fetch_array($p);
			$logging->lwrite($sql, "INFO", "database");
		}
		return $elems;
	}
	
	function get_element_2($tab_name, $col1, $val1, $col2, $val2) 
	{
		global $logging;
		$elems = '';
		$sql = "SELECT * from $tab_name WHERE $col1='$val1' AND $col2='$val2'";
		$p = $this->get_query($sql);
		if ($p)
		{
			$elems = @mysql_fetch_array($p);
			$logging->lwrite($sql, "INFO", "database");
		}
		return $elems;
	}

	function get_elements($tab_name, $col, $val)
	{
		$elems = array();
		$sql = "SELECT * from $tab_name WHERE $col='$val'";
		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = @mysql_fetch_row($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}
	function get_elements_array($tab_name, $col, $val)
	{
		$elems = array();
		$sql = "SELECT * from $tab_name WHERE $col='$val'";
		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = @mysql_fetch_array($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}
	
	/* arrs = array(1,2,3,) */
	function get_elements_in($tab_name, $col, $arrs)
	{
		global $logging;
		$elems = array();
		if ($arrs) {
			if (is_array($arrs)) {
				$str = "'" . $arrs[0]. "'";
				for ($i = 1; $i < count($arrs); $i++) {
					$str .= ",'" . $arrs[$i] . "'";
				}
			}
			else
				$str = $arrs;
				
			$sql = "SELECT * FROM $tab_name WHERE $col IN ($str)";
			$p = $this->get_query($sql);
			if ($p) {
				$i = 0;
				while ($data = @mysql_fetch_array($p)) {
					$elems[$i++] = $data;
				}
				$logging->lwrite($sql, "INFO", "database");
			}
		}
		return $elems;
	}

	
	function get_order_elements($tab_name, $col, $val, $col_key)
	{
		$elems  = array();
		$sql = "SELECT * from $tab_name WHERE $col='$val' ORDER BY $col_key DESC";  // ASC DESC
		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = @mysql_fetch_array($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}
	
	function get_order_elements_2($tab_name, $cond, $col_key)
	{
		$elems  = array();
		$sql = "SELECT * from $tab_name WHERE $cond ORDER BY $col_key DESC";  // ASC DESC

		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = @mysql_fetch_array($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}
	function get_order_elements_asc($tab_name, $cond, $col_key)
	{
		$elems  = array();
		if ($cond) {
			$sql = "SELECT * FROM $tab_name WHERE $cond ORDER BY $col_key ASC";
		}
		else {
			$sql = "SELECT * FROM $tab_name ORDER BY $col_key ASC";
		}
		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = @mysql_fetch_array($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}

	function getElements($tab_name, $cond)
	{
		$elems  = array();
		$sql = "SELECT * from $tab_name WHERE $cond";
		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = @mysql_fetch_array($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}
	
	function get_order_elements_asc_22($tab_name, $key1, $key2, $cond="")
	{
		$elems  = array();
		if ($cond) {
			$sql = "SELECT * FROM $tab_name WHERE $cond ORDER BY $key1 ASC, $key2 ASC";
		}
		else  {
			$sql = "SELECT * FROM $tab_name ORDER BY $key1 ASC, $key2 ASC";
		}
		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = @mysql_fetch_array($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}
	function get_all_order_elements($tab_name, $col_key)
	{
		$elems  = array();
		$sql = "SELECT * from $tab_name ORDER BY $col_key DESC"; 
		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = @mysql_fetch_array($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}

	function get_all_elements_array($tab_name)
	{
		$elems  = array();
		$sql = "SELECT * from $tab_name";
		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = @mysql_fetch_array($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}
	
	function get_score_elements($tab_name, $start, $MAX_READ)
	{
		$elems  = array();
		$start_elem = $start;
		$end_elem = $start + $MAX_READ;
		$sql = "SELECT * FROM $tab_name WHERE IDS >= ".$start_elem. " AND IDS < ".$end_elem." ORDER BY IDS ASC";
		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = @mysql_fetch_row($p) ) {
				$elems[$i++] = $data;					
			}
		}		
		return $elems;
	}

	function get_all_elements($tab_name)
	{
		$elems  = array();
		$sql = "SELECT * from $tab_name";
		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = @mysql_fetch_row($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}
	
	function update_element($tab_name, $col_name, $col, $resu_col, $val)
	{
		$sql  = "UPDATE $tab_name set $resu_col='$val' WHERE $col_name='$col'"; 
		$exec = $this->exec_query($sql);
	}

	function update_all_elements($tab_name, $col_name, $col, $vals)
	{
		$sql  = "UPDATE $tab_name set $vals WHERE $col_name='$col'"; 
		$exec = $this->exec_query($sql);
	}

	function get_max_number($tab_name, $col)
	{
		$sql = "SELECT max($col) as maxnb from $tab_name";
		$p = @mysql_query($sql, $this->connection) ;
		//$maxRecord = @mysql_result($p, "0", "maxnb") or die("Problem get max number : " .$sql. ", " .mysql_error());
		$maxRecord = @mysql_result($p, "0", "maxnb");
		if (empty($maxRecord)) { 
			$maxRecord = 1; 
		}	 
		else { 
			$maxRecord++;
		}
		return $maxRecord;
	}

	
	function find_registed_user($tab_name, $colname, $uname, $colpass, $upass) {
		//$dupass = $this->_encode($upass);
		$user = $this->get_element_2($tab_name, $colname, $uname, $colpass, $upass) ;
		return $user;
	}
}
?>