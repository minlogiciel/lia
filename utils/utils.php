<?php
$LOCAL_TIME =6;

$DOC_ROOT = "";
function HostUrl() {
	global $DOC_ROOT;
	return ("http://" . $_SERVER['SERVER_NAME'] . $DOC_ROOT);
}

function getDocumentRoot()
{
	global $DOC_ROOT;
	$docroot =  $_SERVER['DOCUMENT_ROOT'] . $DOC_ROOT;
	return $docroot;
}

function getGEOIPRoot()
{
	global $DOC_ROOT;
	$docroot =  $_SERVER['DOCUMENT_ROOT'] . "/geoip/";
	return $docroot;
}

$mark = "*";
function showmark($mark="*") {
	echo("<font color=red><b>" . $mark . "</b></font>");
}

function writeAllowIP($ip)
{
	global $ALLOWED_IP;	

	$fname = "../utils/allowedIP.inc";
	$hostname = gethostbyaddr($ip);
	$text  = "<?php\n\$ALLOWED_IP = array(\n";
	for ($i = 0; $i < count($ALLOWED_IP); $i+=2) {
		$item = $ALLOWED_IP[$i];
		$text  .= "\"".$ALLOWED_IP[$i]. "\", \"".$ALLOWED_IP[$i+1]. "\",\n";
	}
	$text  .= "\"".$ip. "\", \"".$hostname. "\",\n";
	$text  .= ");\n\n?>\n";
	$fp = fopen($fname, "w");
	fwrite($fp, $text);
	fclose($fp);
	
}

function isRemoteAddrAllowed($remoteip) {
	global $ALLOWED_IP;
	$hostname = gethostbyaddr($remoteip);
	for ($i = 0; $i < count($ALLOWED_IP); $i+=2) {
		if (($remoteip == $ALLOWED_IP[$i]))
			return 1;
	}
	if (strstr($remoteip, "221.178.200."))
		return 1;
	return 0;
}

function isAdminAllowed($remoteip) {
	$allowed = 0;
	if (isRemoteAddrAllowed($remoteip)) {
		$allowed = 1;
	}
	else {
		if (isset($_SESSION['log_admin'])) {
			$s_login = $_SESSION['log_admin'];
			if ($s_login == "usalia") {
				$allowed = 1;
			}
		}
		else
		{
			$s_login = isset($_GET["login"]) ? $_GET["login"] : (isset($_POST["login"]) ? $_POST["login"] : "");
			if ($s_login == "usalia") {
				$_SESSION['log_admin'] 		= $s_login;
				$allowed = 1;
				writeAllowIP($remoteip);
			}
		}
		
	}
	return $allowed;
}


function getLineClass($n) {
	if (($n%2) == 1)
	echo("line1");
	else
	echo("line2");
}
function command_line_class($n) {
	if ($n%2)
	echo("COMMAND_LINE1");
	else
	echo("COMMAND_LINE2");
}

function getURL() {
	return "../home/";
}


function societe() {
	echo("<b><font color=orange>L.I.A.</font></b>");
}

function schooladdr__() {
	echo ("L.I.A<br>");
	echo ("303 Sunnyside Blvd. Suite 10,<br>");
	echo ("Plainview, NY 11803 <br>");
	echo ("USA<br>");
}

function schooladdr() {
	return ("L.I.A<br>303 Sunnyside Blvd. Suite 10,<br>Plainview, NY 11803 <br>USA<br>");
}

function schooladdrline() {
	echo ("303 Sunnyside Blvd. Suite 10, Plainview, NY 11803, USA");
}

function societefax() {
	echo("09 56 78 62 26");
}
function fax() {
	echo("(516) 364-2121");
}
function telephone() {
	echo("(516) 364-2121");
}

function mobile() {
	echo("(516) 364-2121");
}
function getTodayString()
{
	return (getWeekday(date("w")). ", " .getMonth(date("n")). " " .date("d"). ", " .date("Y"));
}

function showDate()
{
	//$YEAR = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

	//$WEEKS =array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	//echo(date("Y"). "-" . date("n"). "-" . date("d"). " " .$WEEKS[date("w")]);
	echo(getWeekday(date("w")). ", " .getMonth(date("n")). " " .date("d"). ", " .date("Y"));
}

function site() {
	//echo("<a href='http://" . $_SERVER['SERVER_NAME'] . "/home/'>http://longislandacademy.net<a>");
	echo("<a href='http://longislandacademy.net'>http://longislandacademy.net<a>");
}

function liaphone() {
	echo("(516) 364-2121");
}
function email() {
	echo("<a href='mailto:liacademy@aol.com'>liacademy@aol.com</a>");
}
function getDateTime($timestamp) {
	$str = gmdate('n', $timestamp). "/" .gmdate('j', $timestamp). "/" .gmdate('Y', $timestamp). " - " ;
	$str .= gmdate('G', $timestamp). ":" .gmdate('i', $timestamp). ":" .gmdate('s', $timestamp). "  " ;
	return $str;
}

function replace_newline($string, $toHTML) {

	$newstr = $string;
	if ($string) {
		if ($toHTML) {
			$newstr = str_replace("\r\n", "<br>", $newstr);
			$newstr = str_replace("\n", "<br>", $newstr);
		}
		else {
			$newstr = str_replace("<br>", "\n", $string);
		}
	}
	return $newstr;
}

function replace_backslash($string) {
	return (string) str_replace('\\', "", $string);;
}


function replace_areatext($string) {

	return (string)str_replace("\\\'", "\'", $string);
}


function replace($str) {
	$newstr = "";
	if ($str) {
		if (strstr($str, "&quot;") || strstr($str, "&#039;")) {
			$newstr = $str;
			$newstr = str_replace("&quot;", "\"", $newstr);
			$newstr = str_replace("&#039;", "'",  $newstr);
		}
		else {
			$newstr = htmlspecialchars($str, ENT_NOQUOTES);
			$newstr = htmlspecialchars($str, ENT_QUOTES);
			$newstr = str_replace('\"', "&quot;", $newstr);
			$newstr = str_replace("\'", "&#039;", $newstr);
			$newstr = str_replace('\\', "", $newstr);
		}
	}
	return $newstr;
}



function getPostValue($name) {
	$var = '';
	if (isset($_POST[$name]))
	$var = $_POST[$name];

	return $var;
}


function isQuestionLine($line) {
	if (strlen($line) > 1) {
		if (is_numeric($line[0]))
		return 1;
	}
	return 0;
}

function isResponseLine($line) {
	if (strlen($line) > 1) {
		if (($line[0] == 'A') || ($line[0] == 'B') || ($line[0] == 'C') || ($line[0] == 'D') || ($line[0] == 'E') || ($line[0] == 'F'))
		return 1;
	}
	return 0;
}

function getQuestionLine($tab, $cn, $nStart) {
	$elem = array();
	for ($i = 0; $i < $cn; $i++) {
		$elem[$i] = $tab[$i + $nStart];
	}
	return $elem;
}

function fileToTable($fileName) {
	$tab = array();
	$cn = 0;
	$rn = 0;
	$lines = file($fileName);
	foreach($lines as $line)
	{
		$ll = trim($line);
		if (strlen($ll) > 1) {
			$tab[$rn++] = $ll;
			if (isQuestionLine($ll)) {
				$cn = 0;
			}
			$cn++;
		}
	}
	$arr = array();
	if ($rn > 0) {
		for ($i = 0; $i < $rn; $i+= $cn) {
			$arr[] = getQuestionLine($tab, $cn, $i);
		}
	}
	return $arr;
}

function getTextFileList($dirName) {
	$dir = "../public/" .$dirName;
	$files = array();
	if ($handle = opendir($dir)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if(is_file($dir."/".$file) && strpos($file, '.txt',1) ) {
					$files[] = $file;
				}
			}
		}
		closedir($handle);
	}
	return $files;
}

function getMonthSimple($m) {
	$MONTH = array("", "Jan",  "Feb", "Mar", "Apr", "May", "June", "July", "Aug",
	"Sep", "Oct", "Nov", "Dec"); 
	return $MONTH[(int)$m];
}

function getMonth($m) {
	$MONTH = array("", "January",  "February", "March", "April", "May", "June", "July", "August",
	"September", "October", "November", "December"); 
	return $MONTH[(int)$m];
}
function getWeekday($d) {
	$WEEKDAY = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	return $WEEKDAY[$d];
}
function getWeekdayFromYMD($annee, $mois, $jour) {
	$annee = trim($annee);
	$mois = trim($mois);
	$jour = trim($jour);
	$tstamp = mktime(0,0,0,$mois,$jour,$annee);
	$Tdate = getdate($tstamp);
	$ret = getWeekday($Tdate["wday"]);
	return $ret;
}

function getWeekdayFromYear($year) {
	$annee = '';
	$mois = '';
	$jour = '';
	if (strstr($year, "/")) {
		list($mois, $jour, $annee) =  explode("/", $year);
	}
	else if (strstr($year, "-")) {
		list($annee, $mois, $jour) =  explode("-", $year);
	}
	$ret = "";
	if ($annee && $mois && $jour) {
		$ret =getWeekdayFromYMD($annee, $mois, $jour);
	}
	return $ret;
}

function getWeekStartDate($year) {
	$annee = '';
	$mois = '';
	$jour = '';
	if (strstr($year, "/")) {
		list($mois, $jour, $annee) =  explode("/", $year);
	}
	else if (strstr($year, "-")) {
		list($annee, $mois, $jour) =  explode("-", $year);
	}
	$ret = 0;
	if ($annee && $mois && $jour) {
		$annee = trim($annee);
		$mois = trim($mois);
		$jour = trim($jour);
		$tstamp = mktime(0,0,0,$mois,$jour,$annee);
		$Tdate = getdate($tstamp);
		$ret = ($Tdate["wday"]);
	}
	return $ret;
}

function formatDate($year) {
	
	$timestamp = strtotime($year);
	return (date('m/d/Y', $timestamp));

	
}

function formatTime($times) {
	$pm = 0;
	$strtime = strtoupper($times);
	$pos = strpos($strtime, "AM");
	if ($pos) {
		$strtime = substr($times,0,$pos);
	}
	$pos = strpos($strtime, "PM");
	if ($pos) {
		$strtime = substr($times,0,$pos);
		$pm = 12;
	}
	
	if (strstr($strtime, ":")) {
		list($h, $m) = explode(":", $strtime);
		$h = trim($h);
		$m = trim($m);
		if (strlen($m) == 1)
			$m = "0.$m";
	}
	else {
		$h = trim($strtime);
		$m = "00";
	}
	$h = $h + $pm;
	if (strlen($h) == 1)
		$h = "0".$h;
	return $h.":".$m;
}

function getshortLocalDateTime() {
	global $LOCAL_TIME;
	$timestamp = strtotime("-" .$LOCAL_TIME." hours");
	$dt = date("m/d-H:i", $timestamp);
	return $dt;
}


function cmpDate($year1, $year2) {
	if (strstr($year1, "/")) {
		list($m1, $d1, $y1) =  explode("/", $year1);
		$yy1 = $y1."-".$m1."-".$d1;
	}
	else {
		$yy1 = $year1;
	}
	if (strstr($year2, "/")) {
		list($m1, $d1, $y1) =  explode("/", $year2);
		$yy2 = $y1."-".$m1."-".$d1;
	}
	else {
		$yy2 = $year2;
	}
	return strcmp($yy1, $yy2);
}
function canBeCanceled($dates, $beginning) {
	global $LOCAL_TIME; 
	if ($dates) {
		$index = cmpDate($dates, date("Y-m-d"));
		if ($index < 0) {
			return -1;
		}
		else if ($index > 0) {
			return 1;
		}
		else {
			$timestamp = strtotime("-" .$LOCAL_TIME." hours");
			$dt = date("H:i", $timestamp);
			$index= strcmp($beginning, $dt);
			if ($index > 0) {
				$timestamp = strtotime("-". ($LOCAL_TIME-5)." hours");
				$dt = date("H:i", $timestamp);
				$index= strcmp($beginning, $dt);
				if ($index > 0) {
					return 1;
				}
				else {
					return 0;
				}
			}
			else {
				return -1;
			}
		}
	}
	return 1;
}

function canRequest($dates, $beginning) {
	global $LOCAL_TIME;
	if ($dates) {
		$index = cmpDate($dates, date("Y-m-d"));
		if ($index < 0) {
			return -1;
		}
		else if ($index > 0) {
			return 1;
		}
		else {
			$timestamp = strtotime("-" .$LOCAL_TIME." hours");
			$dt = date("H:i", $timestamp);
			
			$index= strcmp($beginning, $dt);
			if ($index > 0) {
				return 1;
			}
			else {
				return 0;
			}
		}
	}
	return 1;
}

function getWeekDates($dates) {
	if ($dates) {
		$num = getWeekStartDate($dates);
		if (strstr($dates, "/")) {
			list($m, $d, $y) =  explode("/", $dates);
		}
		else if (strstr($dates, "-")) {
			list($y, $m, $d) =  explode("-", $dates);
		}
	}
	else {
		$now = time();
		$num = date("w");
		$d = date("d", $now);
		$m = date("m", $now);
		$y = date("Y", $now);
	}
	if ($num == 0) { 
		$sub = 6; 
	}
	else { 
		$sub = $num-1; 
	}
	$d -= $sub;
	
	
	$wlist = array();
	for ($i = 0; $i < 7; $i++) {
		$wd  = mktime(0, 0, 0, $m, $d, $y);
//		$wlist[] = date("m/d/Y", $wd);
		$wlist[] = date("Y-m-d", $wd);
		$d++;
	}
	return  $wlist;
}


function getUSADate($year) {
	$dd = '';
	if (strstr($year, "/")) {
		if (strstr($year, "-")) {
			list($year1, $year2) =  explode("-", $year);
			list($m1, $d1, $y1) =  explode("/", trim($year1));
			list($m2, $d2, $y2) =  explode("/", trim($year2));
			$dd = getMonth($m1). " " .$d1. ", " .$y1. " - " .getMonth($m2). " " .$d2. ", " .$y2;
				
		}
		else {
			list($m1, $d1, $y1) =  explode("/", $year);
			$dd = getMonth($m1). " " .$d1. ", " .$y1;
		}
	}
	else if (strstr($year, "-")) {
		list($m1, $d1, $y1) =  explode("-", $year);
		$dd = getMonth($m1). " " .$d1. ", " .$y1;
	}
	return $dd;
}

function getFullDateSimple($year) {
	$ret = "";
	if (trim($year)) {
		if (strstr($year, "/")) {
			list($m1, $d1, $y1) =  explode("/", $year);
		}
		else if (strstr($year, "-")) {
			list($y1, $m1, $d1) =  explode("-", $year);
		}
		
	    $ret = getWeekdayFromYMD($y1, $m1, $d1). ", " .getMonthSimple($m1). " " .$d1;
	}
    return $ret;	
}
function getFullDateAll($year) {
	$ret = "";
	if (trim($year)) {
		if (strstr($year, "/")) {
			list($m1, $d1, $y1) =  explode("/", $year);
		}
		else if (strstr($year, "-")) {
			list($y1, $m1, $d1) =  explode("-", $year);
		}
	    $ret = getWeekdayFromYMD($y1, $m1, $d1). ", " .getMonthSimple($m1). " " .$d1. ", " .$y1;
	}
	return $ret;	
}

function getFullDate($year) {
	if (strstr($year, "/")) {
		list($m1, $d1, $y1) =  explode("/", $year);
	}
	else if (strstr($year, "-")) {
		list($y1, $m1, $d1) =  explode("-", $year);
	}
	
    $ret = getWeekdayFromYMD($y1, $m1, $d1). ", " .getMonth($m1). " " .$d1;
    return $ret;	
}

function getWeekPeriods($dates) {
	$dd = '';
	if (strstr($dates, "/")) {
		list($m1, $d1, $y1) =  explode("/", $dates);
		$dd = $m1. "/" .$d1;
	}
	else if (strstr($dates, "-")) {
		list($m1, $d1, $y1) =  explode("-", $dates);
		$dd = $m1. "/" .$d1;
	}
	return $dd;
}

function getDisplayDate($dates) {
	$dd = $dates;
	if (strstr($dates, "-")) {
		list($m1, $d1, $y1) =  explode("-", $dates);
		if (strlen($m1) == 4) {
			$mm = $d1;
			$d1 = $y1;
			$y1 = $m1;
			$m1 = $mm;
		}
		if (strlen($d1) == 1) {
			$d1 = "0".$d1;
		}
		if (strlen($m1) == 1) {
			$m1 = "0".$m1;
		}
		$dd = $m1."/".$d1."/".$y1;
	}
	return $dd;
}

function getMenuImageElementByKey($tab, $p, $key) {

	for ($i = 0; $i < count($tab); $i++) {
		$elem = $tab[$i];
		if ($elem[$p] == $key) {
			if ((count($elem) > 4) && ($elem[4][2] || strstr($elem[4][1],".pdf"))) {
				return $elem[4];
			}
			else {
				return "";
			}
		}
	}
	return "";
}

function resize_photo($srcname, $destname, $path, $w) {
	if (strstr(strtoupper($srcname), ".JPG")) {
		$file = $path."/".$srcname; 		
		$o_file = $path."/".$destname; 		
		
		list($width, $height) = getimagesize($file) ; 
		$image = imagecreatefromjpeg($file) ; 
			
		$percent = $w/$width;
		$newwidth = $width * $percent;
		$newheight = $height * $percent;
		$tn = imagecreatetruecolor($newwidth, $newheight) ; 
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
		imagejpeg($tn, $o_file, 75) ; 	
	}
}	

function getOrderDate($dates) {
	$dd = $dates;
	if (strstr($dates, "/")) {
		list($m1, $d1, $y1) =  explode("/", $dates);
		if (strlen($d1) == 1) {
			$d1 = "0".$d1;
		}
		if (strlen($m1) == 1) {
			$m1 = "0".$m1;
		}
		$dd = $y1."-".$m1."-".$d1;
	}
	return $dd;
}

function getDisplayTime($times) {
	$tt = $times;
	if (strlen($times) > 3) {
		$tt = strtoupper($times);
		if(strstr($tt, "AM") || strstr($tt, "PM")) {
			
		}
		else {
			$var = "am";
			list($h1, $m1) =  explode(":", $times);
			$h1 = trim($h1);
			$m1 = trim($m1);
			if ($h1 > 12) {
				$var = "pm";
				$h1 -= 12;
			}
			if (strlen($h1) == 1) {
				$h1 = "0".$h1;
			}
			if (strlen($m1) == 1) {
				$m1 = "0".$m1;
			}
			$tt = $h1.":".$m1. $var;
		}
	}
	return $tt;
}

function getOrderTime($times) {
	$tt = strtoupper($times);
	if (strstr($times,":")) {
		$am = strrpos($tt, "AM");
		if ($am) {
			$st = trim(substr($tt,0,$am));
			list($h1, $m1) =  explode(":", $st);
		}
		else {
			$pm = strrpos($tt, "PM");
			if ($pm) {
				$st = trim(substr($tt,0,$pm));
				list($h1, $m1) =  explode(":", $st);
				$h1 += 12;
			}
			else {
				list($h1, $m1) =  explode(":", $tt);
			}
		}
		if (strlen($h1) == 1) {
			$h1 = "0".$h1;
		}
		if (strlen($m1) == 1) {
			$m1 = "0".$m1;
		}
		$tt = $h1.":".$m1;
	}
	else {
		$tt = "24:00";
	}
	return $tt;
}

$FALL_END_DATE = 22;
$SPRING_END_DATE = 10;
$SUMMER_END_DATE = 19;

function getSemesterYear() {
	global $FALL_END_DATE;
	$y = date("Y");
	$m = date("n");
	$d = date("d");
	if ($m == 1 && $d < $FALL_END_DATE)
		$y--;
	return $y;
}

function isEndSemester() {
	global $FALL_END_DATE;
	$isend = 0;
	$m = date("n");
	$d = date("d");
	switch ($m) {
		case 1 :
			if ($d < $FALL_END_DATE)
				$isend = 1;
			break;
		case 2 :
		case 3 :
		case 4 :
		case 5 :
			break;
		case 6 :
			if ($d > 21)
				$isend = 1;
			break;
		case 7 :
			if ($d < 5)
				$isend = 1;
			break;
		case 8 :
			break;
		case 9 :
			if ($d < 10)
				$isend = 1;
			break;
	}
	return $isend;
}

function getAnnee($year='') {
	if ($year && strlen($year) > 3) {
		if (strstr($year, "/")) {
			list($m, $d, $y) =  explode("/", $year);
		}
		else if (strstr($year, "-")) {
			list($m, $d, $y) =  explode("-", $year);
		}
		else
			$y = $year;
	}
	else {
		$y = getSemesterYear();
	}
	return $y;

}

function getSemesterByString($sem) {
	if ($sem && strlen($sem) > 3)
	return $sem;
	else
	return getSemester();
}

function getYearByString($yy) {
	if ($yy && strlen($yy) == 4)
	$annee = $yy;
	else
	$annee = getAnnee();
	return $annee;
}


function getSemester($year ='') {
	global $FALL_END_DATE, $SPRING_END_DATE, $SUMMER_END_DATE;
	global $SEMESTERS, $SEMESTER_FALL, $SEMESTER_SPRING, $SEMESTER_SUMMER;

	$m = '';
	$d = '';
	$y = '';
	if ($year  && strlen($year) > 6) {
		if (strstr($year, "/")) {
			list($m, $d, $y) =  explode("/", $year);
		}
		else if (strstr($year, "-")) {
			list($m, $d, $y) =  explode("-", $year);
		}
	}
	else {
		$m = date("n");
		$d = date("d");
	}
	switch ($m) {
		case 1:
			if ($d > $FALL_END_DATE)
				$semester = $SEMESTERS[$SEMESTER_SPRING];
			else
				$semester = $SEMESTERS[$SEMESTER_FALL];
			break;
		case 7:
			if ($d < 5)
				$semester = $SEMESTERS[$SEMESTER_SPRING];
			else 
				$semester = $SEMESTERS[$SEMESTER_SUMMER];
			break;
		case 8:
			$semester = $SEMESTERS[$SEMESTER_SUMMER];
			break;
		case 9:
			if ($d < $SUMMER_END_DATE)
				$semester = $SEMESTERS[$SEMESTER_SUMMER];
			else
				$semester = $SEMESTERS[$SEMESTER_FALL];
			break;
		case 10:
		case 11:
		case 12:
			$semester = $SEMESTERS[$SEMESTER_FALL];
			break;
		default :
			$semester = $SEMESTERS[$SEMESTER_SPRING];
			break;
	}
	return $semester;
}

function getSemesterSchoolName() {
	global $SEMESTERS, $SEMESTER_FALL, $SEMESTER_SPRING, $SEMESTER_SUMMER;
	$semester = "";
	$m = date("n");
	switch ($m) {
		case 5:
		case 6:
		case 7:
			$semester = $SEMESTERS[$SEMESTER_SUMMER]. " School";
			break;
		case 8:
		case 9:
		case 10:
		case 11:
			$semester = $SEMESTERS[$SEMESTER_FALL]. " Semester";
			break;
		case 12:
		case 1:
		case 2:
			$semester = $SEMESTERS[$SEMESTER_SPRING]. " Semester";
			break;
	}
	return $semester;
}

function getSemesterSchoolDate() {
	$semester = "";
	$m = date("n");
	switch ($m) {
		case 5:
		case 6:
		case 7:
			$semester = "July 5 - August 18";
			break;
		case 8:
		case 9:
		case 10:
		case 11:
			$semester = "September 20 - December 24";
			break;
		case 12:
		case 1:
		case 2:
			$semester = " January 17 - May 30";
			break;
	}
	return $semester;
}

function getSemesterPeriod($semester, $annee) {
	global $SEMESTERS, $SEMESTER_FALL, $SEMESTER_SPRING, $SEMESTER_SUMMER;
	$ret = "";
	$str = strtolower($semester);
	if ($str == "summer" || $semester == $SEMESTERS[$SEMESTER_SUMMER]) {
		$ret = (getMonth(7). " 5, " .$annee. " - " .getMonth(8). " 20, " .$annee);
	}
	else if ($str == "fall" || $semester == $SEMESTERS[$SEMESTER_FALL]) {
		$ret = (getMonth(9). " 10, " .$annee. " - " .getMonth(12). " 17, " .$annee);
	}
	else if ($str == "spring"  || $semester == $SEMESTERS[$SEMESTER_SPRING]) {
		$ret = (getMonth(1). " 21, " .$annee. " - " .getMonth(6). " 2, " .$annee);
	}
	return $ret;
}

function getCurrentDate() {
	return date("m/d/Y - H:i:s");
}

function writeJSVariable($filename, $varname, $varlist) {

	$text = "var " .$varname. " = [\n";
	$text .= $varlist;

	$text .= "];\n";

	$fp = fopen($filename, "w");

	fwrite($fp, $text);
	fclose($fp);
}

function changeReturnToArray($str) {
	$newstr = $str;
	$newstr = str_replace("\n", "\", \"", $newstr);
	return $newstr;
}

function AreaTextToTable($str) {
	$tab = array();
	$lists  = explode("\n", $str);
	for ($i = 0; $i < count($lists); $i++) {
		if (trim($lists[$i])) {
			$tab[] = str_replace("\r", "", $lists[$i]);
		}
	}
	return $tab;
}

function AnnonceTextToTable($str) {
	$tab = array();
	$lists  = explode("\n", $str);
	$np = 0;
	for ($i = 0; $i < count($lists); $i++) {
		$str = str_replace("\r", "", $lists[$i]);
		$str = str_replace("\'", "&#039;", $str);
		$str = str_replace("'", "&#039;", $str);
		$str = str_replace("\"", "&quot;", $str);
		if (trim($str))
			$np = 0;
		else 
			$np++;
		if ($np < 3)
			$tab[] = trim($str);
	}
	return $tab;
}

function writeVariable($filename, $varname, $varlist) {

	$text  = "<?php\n";

	$text .= "\$" .$varname. " = array(\n";
	$text .= $varlist;

	$text .= ");\n";

	$text .="?>";

	$fp = fopen($filename, "w");

	fwrite($fp, $text);
	fclose($fp);
}

function readVariable($filename) {
	$lists = array();
	if (file_exists($filename)) {
		$arr = array();
		$fp = fopen($filename, "r");
		$text = fread($fp, filesize($filename));
		$len = strlen($text);
		for ($i = 0; $i < $len; $i++) {
			if ($text[$i] == '"') {
				$i++;
				$start = $i;
				while ($i < $len) {
					if ($text[$i] == '"') {
						$lists[] = substr($text, $start, ($i - $start));
						$i++;
						break;
					}
					$i++;
				}
			}
		}
		fclose($fp);
	}
	return $lists;
}

function writeVariable1($filename, $varname, $vartext)
{
	$text  = "<?php\n \$" .$varname. " = \"" .$vartext. "\";\n?>";
	$fp = fopen($filename, "w");
	fwrite($fp, $text);
	fclose($fp);
}

function readVariable1($filename) {
	$vartext = "";
	$stop = 0;
	if (file_exists($filename)) {
		$fp = fopen($filename, "r");
		$text = fread($fp, filesize($filename));
		$vartext = $text. " (" .strlen($text);
		$len = strlen($text);
		$i = 0;
		while (($i < $len) && ($stop == 0)) {
			if ($text[$i] == '"') {
				$start = $i+1;
				while ($i < $len) {
					if ($text[$i] == '"') {
						$vartext = substr($text, $start, ($i - $start));
						$stop = 1;
					}
					$i++;
				}
			}
			$i++;
		}
		fclose($fp);
	}
	return $vartext;
}

function getSctudentScores($id, $scoreslists)
{
	$ns = count($scoreslists);
	for ($i = 0; $i < $ns; $i++)
	{
		$stscores = $scoreslists[$i];
		if ($stscores && $stscores->getStudentID() == $id) {
			return $stscores;
		}
	}
	return 0;
}


function getStudentScoresTable($studentid, $scoreslists, $total_nb, $test_nb, $page)
{
	$slist = array();
	$scoreslist_nb = count($scoreslists);
	$end  = $scoreslist_nb - $page * $total_nb;
	if ($end > 0) {
		for ($i = 0; $i < $end; $i++) {
			$sclists = $scoreslists[$end - $i - 1];
			$slist[] = getSctudentScores($studentid, $sclists);
		}
	}
	return $slist;
}

function hasStudentScores($studentid, $scoreslists)
{
	$nb_list = count($scoreslists);
	for ($i = 0; $i < $nb_list; $i++) {
		$sclists = $scoreslists[$i];
		$score = getSctudentScores($studentid, $sclists);
		if ($score) {
			if ($score->getTotalScores() > 0) {
				return 1;
			}
		}
	}
	return 0;
}

function getStudentDiffScores($studentid, $scoreslists)
{
	
	$list2 = array();
	$ttable = array();
	$htable = array();
	
	
	$nb_list = count($scoreslists);
	
	$nb = 0;
	
	for ($i = 0; $i < $nb_list; $i++) {
		$sclists = $scoreslists[$i];
		$score = getSctudentScores($studentid, $sclists);
		if ($score) {
			if ($score->isExamScores() || $score->isTestScores()) {
				$ttable[] = $score;
			}
			else {
				$htable[] = $score;
			}
			
			if ($score->getTotalScores() > 0) {
				$nb++;
			}
		}
		else {
			$htable[] = "";
		}
	}
	
	$list2[] = $htable;
	$list2[] = $ttable;
	$list2[] = $nb;
	
	return $list2;
}

function getScoreTitleTable($scoreslists,  $total_nb, $test_nb, $page)
{
	
	$list2 = array();
	$ttable = array();
	$htable = array();
	
	
	$nb_list = count($scoreslists);
	
	for ($i = 0; $i < $nb_list; $i++) {
		$sclists = $scoreslists[$i];
		for ($j = 0; $j < $sclists; $j++)
		{
			$stscores = $sclists[$j];
			if ($stscores) {
				$title = $stscores->getDates();
				if ($title) {
					if ($stscores->isExamScores() || $stscores->isTestScores()) {
						$ttable[] = $title;
					}
					else {
						$htable[] = $title;
					}
					break;
				}
			}
		}
	}
	
	$n_h = $total_nb - $test_nb;
	$nhh = count($htable);
	$ntt = count($ttable);
	for ($i = 0; $i < $total_nb; $i++) {
		if ($page != 0) {
			if ($i < $n_h) {
				if (($n_h + $i) < $nhh)
					$list2[] = $htable [$n_h + $i];
				else 
					$list2[] = '';
			}
			else {
				if (($i- $n_h+$test_nb) < $ntt)
					$list2[] = $ttable[$i-$n_h+$test_nb];
				else 
					$list2[] = '';
				
			}
		}
		else {
			if ($i < $n_h) {
				if ($i < $nhh)
					$list2[] = $htable[$i];
				else 
					$list2[] = '';
			}
			else {
				if (($i- $n_h) < $ntt)
					$list2[] = $ttable[$i-$n_h];
				else 
					$list2[] = '';
				
			}
		}
	}
	
	return $list2;
}

function getScorePosition($titletable, $scoredate, $test_nb, $isTest) {
	$nb = count($titletable);
	if ($scoredate) {
		if ($isTest) {
			$start = $nb - $test_nb;
			$end = $nb;
		}
		else {
			$start = 0;
			$end = $nb - $test_nb;
			
		}
		for ($i = $start; $i < $end; $i++) {
			if ($titletable[$i] == $scoredate) {
				return $i;
			}
		}
	}
	return -1;
}

function getStudentSubjectsReportTable($studentlists, $scoresLists, $total_nb, $test_nb, $page)
{
	$allScores = array();

	
	$scoreslist_nb = count($scoresLists);
	
	
	$clsHWScoresList = array();
	$clsTestScoresList = array();
	$NBTTable = array();
	$orderTable = array();
	
	$n_student =  0;
	foreach($studentlists as $st)
	{
		$id = $st->getID();
		$list2 = getStudentDiffScores($id, $scoresLists);
		
		$clsHWScoresList[] = $list2[0];
		$clsTestScoresList[] = $list2[1];
		
		if (isNoNameStudent($st)) {
			$NBTTable[$n_student] = 0;
		}
		else {
			$NBTTable[$n_student] = $list2[2]; // student score nb
		}
		$orderTable[$n_student] = $n_student;
		$n_student++;
	}
	
	/*sort student scores table */
	$nb_st = count($NBTTable);
	for ($i = 0; $i < $nb_st; $i++) {
		for ($j = 0; $j < $nb_st-1-$i; $j++) {
			if ($NBTTable[$j] < $NBTTable[$j+1]) {
				$v = $NBTTable[$j];
				$NBTTable[$j] = $NBTTable[$j+1];
				$NBTTable[$j+1] = $v;
				
				$v = $orderTable[$j]; 
				$orderTable[$j] = $orderTable[$j+1];
				$orderTable[$j+1] = $v;
			}
		}
	}
	
	/* init title table */
	$clsScoresTitle = getScoreTitleTable($scoresLists,  $total_nb, $test_nb, $page);
	
	$moyenTable = array();
	$moyenTable2 = array();
	for ($i = 0; $i < $total_nb; $i++) {
		$moyenTable[]  = "";
		$moyenTable2[]  = "";
	}
	/* home work table */
	for ($i = 0; $i < $nb_st; $i++) {
		$sTable = array();
		for ($j = 0; $j < $total_nb; $j++) 
		{
			$sTable[] = "";
		}
		
		$slist = $clsHWScoresList[$i];
		
		$nn_slist = count($slist);
		
		for ($j = 0; $j < $nn_slist; $j++) 
		{
			$stscores = $slist[$j];
			if ($stscores) {
				$title = $stscores->getDates();
				$moyen = $stscores->getMoyenScores();
			}
			else {
				$title = '';
				$moyen = '';
			}
			$np = getScorePosition($clsScoresTitle, $title, $test_nb, 0) ;
			if ($np != -1) {
				if ($moyen) {
					if ($moyenTable[$np]) {
						if ($moyenTable[$np] != $moyen) {
							$moyenTable2[$np] = $moyen;
						}
					}
					else {
						$moyenTable[$np] = $moyen;
					}
					
				}
				$sTable[$np] = $stscores;
			}
		}
		$allScores[] = $sTable;
	}
	
	for ($i = 0; $i < $total_nb; $i++) {
		if ($moyenTable2[$i]) {
			$moyenTable[$i] = (int) (($moyenTable[$i] + $moyenTable2[$i])/2);
		}
	}
	
	/* test table */
	$ntest = $total_nb - $test_nb;
	for ($i = 0; $i < $nb_st; $i++) {
		
		$slist = $clsTestScoresList[$i];
		$nn_slist = count($slist);
		
		$sTable = $allScores[$i];

		for ($j = 0; $j < $nn_slist; $j++) 
		{
			$stscores = $slist[$j];
			if ($stscores) {
				$title = $stscores->getDates();
				$moyen = $stscores->getMoyenScores();
			}
			else {
				$title = '';
				$moyen = '';
			}
			$np = getScorePosition($clsScoresTitle, $title, $test_nb, 1) ;
			if ($np != -1) {
				if ($moyen) {
					$moyenTable[$np] = $moyen;
				}
				$sTable[$np] = $stscores;
			}
		}
		$allScores[$i] = $sTable;
	}
	
	$allScores[] = $orderTable;
	$allScores[] = $moyenTable;
	$allScores[] = $clsScoresTitle;
	return $allScores;
}

function yygetStudentSubjectsReportTable($studentlists, $scoresLists, $total_nb, $test_nb, $page)
{
	$allScores = array();
	$typeTable = array();
	$clsScoresList = array();
	$scoreslist_nb = count($scoresLists);
	$NBTTable = array();
	$orderTable = array();
	
	for ($i=0; $i < $scoreslist_nb; $i++) {
		$typeTable[] = 0;
		$moyenTable[] = 0;
	}
	$n_student =  0;
	foreach($studentlists as $st)
	{
		$id = $st->getID();
		$slist = getStudentScoresTable($id, $scoresLists, $total_nb, $test_nb, $page);
		$nn_slist = count($slist);
		$nb = 0;
		for ($i = 0; $i < $scoreslist_nb; $i++)
		{
			if ($i < $nn_slist) {
				$stscores = $slist[$i];
			}
			else {
				$stscores = "";
			}
			if ($stscores) 
			{
				if ($stscores->isExamScores()) 
				{
					$typeTable[$i] = 2;
				}
				else if ($stscores->isTestScores()) 
				{
					$typeTable[$i] = 1;
				}
				if ($stscores->getTotalScores() > 0) {
					$nb++;
				}
			}
		}
		$clsScoresList[] = $slist;
		if (isNoNameStudent($st)) {
			$NBTTable[$n_student] = 0;
		}
		else {
			$NBTTable[$n_student] = $nb; // student score nb
		}
		$orderTable[$n_student] = $n_student;
		$n_student++;
	}
	
	/*sort student scores table */
	$nb_st = count($NBTTable);
	for ($i = 0; $i < $nb_st; $i++) {
		for ($j = 0; $j < $nb_st-1-$i; $j++) {
			if ($NBTTable[$j] < $NBTTable[$j+1]) {
				$v = $NBTTable[$j];
				$NBTTable[$j] = $NBTTable[$j+1];
				$NBTTable[$j+1] = $v;
				
				$v = $orderTable[$j]; 
				$orderTable[$j] = $orderTable[$j+1];
				$orderTable[$j+1] = $v;
			}
		}
	}
	/* init title table */
	$clsScoresTitle = array();
	for ($i = 0; $i < $total_nb; $i++)
	{
		$clsScoresTitle[$i] = "";
		$moyenTable[$i] = "";
	}

	/* init table */

	for ($i = 0; $i < count($clsScoresList); $i++) {
		$tn = $total_nb - $test_nb;
		$hn = 0;
		$en = 1;
		$sTable = array();
		for ($j = 0; $j < $total_nb; $j++) {
			$sTable[$j] = '';
		}
		$slist = $clsScoresList[$i];
		$nn_slist = count($slist);
		for ($j = 0; $j < $scoreslist_nb; $j++) 
		{
			if ($j < $nn_slist) {
				$stscores = $slist[$j];
			}
			else {
				$stscores = "";
			}
			if ($stscores) {
				$title = $stscores->getDates();
				$moyen = $stscores->getMoyenScores();
			}
			else {
				$title = '';
				$moyen = '';
			}
			/* test scores */
			if ($typeTable[$j] == 1) {
				if ($title) {
					$clsScoresTitle[$tn] = $title;
					$moyenTable[$tn] = $moyen;
				}
				$sTable[$tn++] = $stscores;
			}
			/* exam scores */
			else if ($typeTable[$j] == 2) {
				if ($title) {
					$clsScoresTitle[$total_nb - $en] = $title;
					$moyenTable[$total_nb - $en] = $moyen;
				}
				$sTable[$total_nb - $en++] = $stscores;
			}
			else {
				if ($title) {
					$clsScoresTitle[$hn] = $title;
					$moyenTable[$hn] = $moyen;
				}
				$sTable[$hn++] = $stscores;
			}
		}
		$allScores[] = $sTable;
	}
	
	$allScores[] = $orderTable;
	$allScores[] = $moyenTable;
	$allScores[] = $clsScoresTitle;
	return $allScores;
}

function getSubjectsTeacherName($scoresLists)
{
	for ($i = 0; $i < count($scoresLists); $i++) {
		$sclists = $scoresLists[$i];
		if ($sclists) {
			for ($j = 0; $j < count($sclists); $j++)
			{
				$stscores = $sclists[$j];
				if ($stscores && $stscores->getTeacher()) {
					return $stscores->getTeacher();
				}
			}
		}
	}
	return "";
}

function getScoresSubjectsName($sclists)
{
	for ($i = 0; $i < count($sclists); $i++)
	{
		$stscores = $sclists[$i];
		if ($stscores && $stscores->getSubjects()) {
			return $stscores->getSubjects();
		}
	}
	return "";
}
function getScoresTypeName($sclists)
{
	for ($i = 0; $i < count($sclists); $i++)
	{
		$stscores = $sclists[$i];
		if ($stscores && $stscores->getTypes()) {
			return $stscores->getTypes();
		}
	}
	return "";
}

function getScoresTitleName($sclists)
{
	for ($i = 0; $i < count($sclists); $i++)
	{
		$stscores = $sclists[$i];
		if ($stscores && $stscores->getTitles()) {
			$title = $stscores->getTitles();
			if (!strstr($title, "/")) {
				$title .= " (" .$stscores->getDates(). ")";
			}
			return $title;
		}
	}
	return "";
}

function getScoresGroupId($sclists)
{
	for ($i = 0; $i < count($sclists); $i++)
	{
		$stscores = $sclists[$i];
		if ($stscores && $stscores->getGroups()) {
			return $stscores->getGroups();
		}
	}
	return 0;
}
function getScoresTest($sclists)
{
	for ($i = 0; $i < count($sclists); $i++)
	{
		$stscores = $sclists[$i];
		if ($stscores && $stscores->getGroups()) {
			if ($stscores->isTestScores() || $stscores->isExamScores() ) {
				return 1;
			}
			else {
				return 0;
			}
		}
	}
	return 0;
}

function getStudentShowID($student) {
	if ($student) {
		$name = strtolower($student->getStudentName());
		if (strstr($name, "zz") && strstr($name, "no") && strstr($name, "name"))
			return "**";
		else 
			return $student->getID();
	}
	return '';
	
}

function isNoNameStudent($student) {
	if ($student) {
		$name = strtolower($student->getStudentName());
		if (strstr($name, "zz") && strstr($name, "no") && strstr($name, "name"))
			return 1;
		else 
			return 0;
	}
	return 1;
	
}

function getStudentNoNameNote() {
	return " Homeworks or Tests without names";
}


function getPrice($sum) {
	return '$' .$sum;
}
function isPSATSubject($subjects) {
	if ($subjects && $subjects == "PSAT")
	return 1;
	else
	return 0;

}

$STUDENT_VAR = array(
	"#studentname",
	"#studentlogin",
	"#studentid",
	"#studentemail",
	"#studentpassword"
);

$SCORE_VAR = array(
	"#enscore",
	"#mathscore",
	"#combined",
);

function hasStudentVariable($texte) {
	global $STUDENT_VAR, $SCORE_VAR;
	for ($i = 0; $i < count($STUDENT_VAR); $i++) {
		if (strstr($texte, $STUDENT_VAR[$i])) {
			return 1;
		}
		if (strstr($texte, strtoupper($STUDENT_VAR[$i]))) {
			return 1;
		}
	}
	for ($i = 0; $i < count($SCORE_VAR); $i++) {
		if (strstr($texte, $SCORE_VAR[$i])) {
			return 1;
		}
		if (strstr($texte, strtoupper($SCORE_VAR[$i]))) {
			return 1;
		}
	}
	return 0;
}
function getAttachedReportText($student) {
	$newstr = '';
	if ($student) {
		$stname 		= $student->getStudentName();
		$classname 		= $student->getClasses();
		$studentid 	= $student->getID();
		$newstr = "See Attached Student Report Card For Class ".$classname. ", ". $stname. " ID Number is : " .$studentid;
	}
	return $newstr;
}

function changeEmailTag($emaillist) {
	$newstr = $emaillist;
	$newstr = str_replace("[", "<", $newstr);
	$newstr = str_replace("]", ">", $newstr);
	return $newstr;
}

function getEmailText($text, $student) {
	global $STUDENT_VAR;
	$newstr = replace_newline($text, 1);
	if ($student) {
		$name 		= $student->getStudentName();
		$login 		= $student->getPseudo();
		$studentid 	= $student->getID();
		$email 		= $student->getEmail();
		$passwd 	= $student->getPassword();
		$newstr = str_replace($STUDENT_VAR[0], $name, $newstr);
		$newstr = str_replace($STUDENT_VAR[1], $login, $newstr);
		$newstr = str_replace($STUDENT_VAR[2], $studentid, $newstr);
		$newstr = str_replace($STUDENT_VAR[3], $email, $newstr);
		$newstr = str_replace($STUDENT_VAR[4], $passwd, $newstr);
		$newstr = str_replace(strtoupper($STUDENT_VAR[0]), $name, $newstr);
		$newstr = str_replace(strtoupper($STUDENT_VAR[1]), $login, $newstr);
		$newstr = str_replace(strtoupper($STUDENT_VAR[2]), $studentid, $newstr);
		$newstr = str_replace(strtoupper($STUDENT_VAR[3]), $email, $newstr);
		$newstr = str_replace(strtoupper($STUDENT_VAR[4]), $passwd, $newstr);
		$newstr = str_replace("&lt;", "<", $newstr);
		$newstr = str_replace("&gt;", ">", $newstr);
	}
	return $newstr;
}

function getEmailTextSimple($text, $student) {
	global $STUDENT_VAR;
	$newstr = replace_newline($text, 1);
	if ($student) {
		$name 		= $student->getStudentName();
		//$studentid 	= $student->getID();
		$studentid 	= $student->getStudentNo();
		$newstr = str_replace($STUDENT_VAR[0], $name, $newstr);
		$newstr = str_replace($STUDENT_VAR[2], $studentid, $newstr);
		$newstr = str_replace(strtoupper($STUDENT_VAR[0]), $name, $newstr);
		$newstr = str_replace(strtoupper($STUDENT_VAR[2]), $studentid, $newstr);
	}
	return $newstr;
}

function getScoreText($text, $score) {
	global $SCORE_VAR;
	$newstr = replace_newline($text, 1);
	if ($score) {
		$en 		= $score->getEnglishScores();
		$math 		= $score->getMathScores();
		$total 		= $score->getTotalScores();
		$newstr = str_replace($SCORE_VAR[0], $en, $newstr);
		$newstr = str_replace($SCORE_VAR[1], $math, $newstr);
		$newstr = str_replace($SCORE_VAR[2], $total, $newstr);
		$newstr = str_replace(strtoupper($SCORE_VAR[0]), $en, $newstr);
		$newstr = str_replace(strtoupper($SCORE_VAR[1]), $math, $newstr);
		$newstr = str_replace(strtoupper($SCORE_VAR[2]), $total, $newstr);
	}
	return $newstr;
}
function getStudentScoreText($text, $st) {
	global $SCORE_VAR;
	$newstr = replace_newline($text, 1);
	$en 	= $st->getEnglish();
	$math 	= $st->getMath();
	$total 	= $st->getTotal();
	$newstr = str_replace($SCORE_VAR[0], $en, $newstr);
	$newstr = str_replace($SCORE_VAR[1], $math, $newstr);
	$newstr = str_replace($SCORE_VAR[2], $total, $newstr);
	$newstr = str_replace(strtoupper($SCORE_VAR[0]), $en, $newstr);
	$newstr = str_replace(strtoupper($SCORE_VAR[1]), $math, $newstr);
	$newstr = str_replace(strtoupper($SCORE_VAR[2]), $total, $newstr);
	return $newstr;
}

function getBackupFileName($table_name, $elem_name='') {
	$semester = getSemester();
	$year = getAnnee();
	$path = "../backupdata/".$semester."_".$year;
	if (!file_exists($path)) {
		mkdir($path, 0777);
	}
	if ($table_name) {
		$path .= "/".$table_name;
	}
	if (!file_exists($path)) {
		mkdir($path, 0777);
	}
	$fname = $path."/".strtolower($table_name). "_";
	if ($elem_name) {
		$fname .= strtolower($elem_name). "_";
	}
	$fname .= date("Y_m_d_H_i").".sql";

	return $fname;
}

function getReportPath($sem="", $yy="") {
	$semester = getSemesterByString($sem);
	$year = getYearByString($yy);

	$path = "../reports/".$semester."_".$year;
	if (!file_exists($path)) {
		mkdir($path, 0777, true);
	}
	return $path;
}

function set_base_changed($flag, $basename) {
	global $BK_DATE, $BK_FLAG;
	if ($flag != $BK_FLAG) {
		$text  = "<?php\n\n"; 
		if ($flag == 0) {
			$text .= "\$BK_FLAG = 0;\n\n";
			$text .= "\$BK_DATE = \"". date("Y-m-d"). "\";\n\n";
		}
		else {
			$text .= "\$BK_FLAG = 1;\n\n";
			$text .= "\$BK_DATE = \"". $BK_DATE. "\";\n\n";
		}
		$text .= "\$BK_BASE = \"". $basename. "\";\n\n";
		$text .= "?>\n\n";

		$filename = "../utils/databaseflag.inc";
		$fp = fopen($filename, "w");
		fwrite($fp, $text);
		fclose($fp);
	}
}

?>
