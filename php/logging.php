<?php
class Logging {
	// define log file
	var $log_file = "../log/lia";
	// define file pointer
	var $fp = null;
	// write message to the log file
	function lwrite($message, $type, $domain) {
		// if file pointer doesn't exist, then open log file
		if (!$this->fp) $this->lopen();
		// define current time
		$time = date('Y-m-d H:i:s');
		// write current time, type and domain name and message to the log file
		fwrite($this->fp, "$time [$type] [$domain] $message\n");
	}
	// open log file
	function lopen(){
		// define log file path and name
		$lfile = $this->log_file;
		// define the current date (it will be appended to the log file name)
		$lfile .= '_' .date('Ymd'). '.log';
		// open log file for writing only; place the file pointer at the end of the file
		// if the file does not exist, attempt to create it
		$this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
	}
}

$logging = new Logging();

?>