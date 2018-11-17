<?php

$server_name = $_SERVER['SERVER_NAME'];
$SQL_BASE	= "lia_usa";
if (strstr($server_name, "localhost") || strstr($server_name, "127.0.0.1")) {
	$SQL_SERVER = "127.0.0.1";
	//$SQL_SERVER = "localhost";
	$SQL_USER	= "root";
	$SQL_PASSWD	= "";
}
else if (strstr($server_name, "free")) {
	$SQL_SERVER 		= "sql.free.fr";
	$SQL_USER			= "daimin";
	$SQL_PASSWD			= "622608";
}
else if (strstr($server_name, "longisland")) {
	$SQL_SERVER 		= "mysql";
	$SQL_USER			= "lia";
	$SQL_PASSWD			= "lia";
	$SQL_BASE			= "lia_usa";
}
else {
	$SQL_SERVER = "localhost";
	$SQL_USER	= "root";
	$SQL_PASSWD	= "";
}

?>