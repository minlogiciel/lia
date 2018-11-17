<?php 
function getSemesterBar($flink, $action, $studentid, $classes, $semester_str, $period, $subjects) 
{
	global $SEMESTERS;
	$semester = getSemesterByString($semester_str);

	$thisyear = getSemesterYear();
	$thissemester = getSemester();
	$sem_tab 	= array();
	$year_tab 	= array();
	
	$n = 6;
	$found = 0;
	for ($i = count($SEMESTERS); $i > 0; $i--) {
		$sem = $SEMESTERS[$i-1];
		if ($found || $sem == $thissemester) {
			$found = 1;
			$sem_tab[$n-1] = $sem;
			$year_tab[$n-1] =  $thisyear;
			$n--;
		}
	}
	$ny = 1;
	while ($n > 0) {
		for ($i = count($SEMESTERS); $i > 0; $i--) {
			$sem_tab[$n-1] = $SEMESTERS[$i-1];
			$year_tab[$n-1] =  $thisyear - $ny;
			$n--;
			if ($n < 1) {
				break;
			}
		}
		$ny++;
	}
	
	$url = "../member/";
	if ($flink) {
		$url .= $flink;
	}
	$url = "?action=".$action."&classes=".$classes;
	if ($studentid) {
		$url .= "&studentid=".$studentid;
	}
	if ($subjects) {
		$url .= "&subjects=".$subjects;
	}
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
<?php
for ($i = 0; $i < count($sem_tab); $i++) {
	$sem = $sem_tab[$i];
	$annee = $year_tab[$i];;
	$name = $sem. "-" .$annee;
?>
	<TD width=17% height=25 class=TITLE_BAR background='../images/header_barre_fond.gif'>
		<div align=center>
		<?php 
			if ($period && $period == $annee && $semester == $sem) {
				echo("<font color=red>" .$name. "</font>");
			}
			else {
				echo("<a href='" .$url. "&period=" .$annee. "&semester=" .$sem. "'>" .$name."</a>");
			}
		?>
		</div>
	</TD>
<?php 
}
?>
</TR>
</TABLE>									 
<?php 
}


function getWeekBar($teacher, $dates, $startdate, $beginweek, $changeweek) 
{
	$BAR_ELEM_NB = 6;
	
	$semaine_tab 	= array();

	if ($beginweek) {
		$num = getWeekStartDate($beginweek);
		if (strstr($beginweek, "/")) {
			list($m, $d, $y) =  explode("/", $beginweek);
		}
		else if (strstr($beginweek, "-")) {
			list($y, $m, $d) =  explode("-", $beginweek);
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
		$sub = ($num-1); 
	}
	$d = $d-$sub;
	if ($changeweek) {
		$d += ($changeweek)*7;
	}
	for ($n =0; $n < $BAR_ELEM_NB; $n++) {
		for ($j = 0; $j < 2; $j++) {
			$wlist = array();
			for ($i = 0; $i < 3; $i++) {
				$wd  = mktime(0, 0, 0, $m, $d, $y);
				$wlist[] = date("m/d/Y", $wd);
				$d++;
			}
			$semaine_tab[] = $wlist;
		}
		$d++;
	}
	$url = "../private/private.php?teacher=".$teacher."&dates=".$dates."&beginweek=".$semaine_tab[0][0];

	$width = (int) (100/$BAR_ELEM_NB);
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD width=20 class=TITLE_BAR background='../images/header_barre_fond.gif'>&nbsp;&nbsp;
		<a href='<?php echo($url."&startdate=" .$semaine_tab[0][0]."&changeweek=-1"); ?>'> &laquo; </a>
	</TD>
<?php
for ($i = 0; $i < $BAR_ELEM_NB; $i++) {
	$sd = $semaine_tab[$i];
	$name = getWeekPeriods($sd[0]) . "-" .getWeekPeriods($sd[count($sd)-1]);
?>
	<TD width=<?php echo($width."%"); ?> height=25 class=TITLE_BAR background='../images/header_barre_fond.gif'>
		<div align=center>
		<?php 
			if ($startdate == $sd[0]) {
				echo("<font color=red>" .$name. "</font>");
			}
			else {
				echo("<a href='" .$url. "&startdate=" .$sd[0]. "'>" .$name."</a>");
			}
		?>
		</div>
	</TD>
<?php 
}
?>
	<TD width=20 class=TITLE_BAR background='../images/header_barre_fond.gif'>
		<a href='<?php echo($url."&startdate=" .$semaine_tab[$BAR_ELEM_NB-1][0]."&changeweek=1"); ?>'> &raquo; </a>
	</TD>
</TR>
</TABLE>									 
<?php 
}


function getTeacherWeekSessionBar($teacher, $dates, $startdate) 
{
	$BAR_ELEM_NB = 4;
	
	$semaine_tab 	= array();

	$now = time();
	$num = date("w");
	
	if ($num == 0) { 
		$sub = 6; 
	}
	else { 
		$sub = ($num-1); 
	}
	$d = date("d", $now)-$sub;
	$m = date("m", $now);
	$y = date("Y", $now);

	$d -= 7;
	for ($n =0; $n < $BAR_ELEM_NB; $n++) {
		$wlist = array();
		for ($i = 0; $i < 7; $i++) {
			$wd  = mktime(0, 0, 0, $m, $d, $y);
			$wlist[] = date("m/d/Y", $wd);
			$d++;
		}
		$semaine_tab[] = $wlist;
	}
	
	$url = "../private/private.php?teacher=".$teacher."&action=teachersession&dates=".$dates;
	
	$width = (int) (100/$BAR_ELEM_NB);
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
<?php
for ($i = 0; $i < $BAR_ELEM_NB; $i++) {
	$sd = $semaine_tab[$i];
	$name = getWeekPeriods($sd[0]) . "-" .getWeekPeriods($sd[count($sd)-1]);
?>
	<TD width=<?php echo($width."%"); ?> height=25 class=TITLE_BAR background='../images/header_barre_fond.gif'>
		<div align=center>
		<?php 
			if ($startdate == $sd[0]) {
				echo("<font color=red>" .$name. "</font>");
			}
			else {
				echo("<a href='" .$url. "&startdate=" .$sd[0]. "'>" .$name."</a>");
			}
		?>
		</div>
	</TD>
<?php 
}
?>
</TR>
</TABLE>									 
<?php 
}

function getStudentWeekSessionBar($studentid, $teacher, $subjects, $dates, $startdate) 
{
	$BAR_ELEM_NB = 4;
	
	$semaine_tab 	= array();

	$now = time();
	$num = date("w");
	
	if ($num == 0) { 
		$sub = 6; 
	}
	else { 
		$sub = ($num-1); 
	}
	$d = date("d", $now)-$sub;
	$m = date("m", $now);
	$y = date("Y", $now);

	$d -= 7;
	for ($n =0; $n < $BAR_ELEM_NB; $n++) {
		$wlist = array();
		for ($i = 0; $i < 7; $i++) {
			$wd  = mktime(0, 0, 0, $m, $d, $y);
			$wlist[] = date("m/d/Y", $wd);
			$d++;
		}
		$semaine_tab[] = $wlist;
	}
	
	$url = "../private/?teacher=".$teacher."&subjects=".$subjects."&dates=".$dates;
	
	$width = (int) (100/$BAR_ELEM_NB);
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
<?php
for ($i = 0; $i < $BAR_ELEM_NB; $i++) {
	$sd = $semaine_tab[$i];
	$name = getWeekPeriods($sd[0]) . "-" .getWeekPeriods($sd[count($sd)-1]);
?>
	<TD width=<?php echo($width."%"); ?> height=25 class=TITLE_BAR background='../images/header_barre_fond.gif'>
		<div align=center>
		<?php 
			if ($startdate == $sd[0]) {
				echo("<font color=red>" .$name. "</font>");
			}
			else {
				echo("<a href='" .$url. "&startdate=" .$sd[0]. "'>" .$name."</a>");
			}
		?>
		</div>
	</TD>
<?php 
}
?>
</TR>
</TABLE>									 
<?php 
}


function getTeacherWeekBar($teacher, $startdate) 
{
	$BAR_ELEM_NB = 4;
	
	$semaine_tab 	= array();

	$now = time();
	$num = date("w");
	
	if ($num == 0) { 
		$sub = 6; 
	}
	else { 
		$sub = ($num-1); 
	}
	$d = date("d", $now)-$sub;
	$m = date("m", $now);
	$y = date("Y", $now);

	$d -= 7;
	for ($n =0; $n < $BAR_ELEM_NB; $n++) {
		$wlist = array();
		for ($i = 0; $i < 7; $i++) {
			$wd  = mktime(0, 0, 0, $m, $d, $y);
			$wlist[] = date("m/d/Y", $wd);
			$d++;
		}
		$semaine_tab[] = $wlist;
	}
	$url = "../teacher/?teacher=".$teacher;

	$width = (int) (100/$BAR_ELEM_NB);
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
<?php
for ($i = 0; $i < $BAR_ELEM_NB; $i++) {
	$sd = $semaine_tab[$i];
	$name = getWeekPeriods($sd[0]) . "-" .getWeekPeriods($sd[count($sd)-1]);
?>
	<TD width=<?php echo($width."%"); ?> height=25 class=TITLE_BAR background='../images/header_barre_fond.gif'>
		<div align=center>
		<?php 
			if ($startdate == $sd[0]) {
				echo("<font color=red>" .$name. "</font>");
			}
			else {
				echo("<a href='" .$url. "&startdate=" .$sd[0]. "'>" .$name."</a>");
			}
		?>
		</div>
	</TD>
<?php 
}
?>
</TR>
</TABLE>									 
<?php 
}

function getHoureMinute($name, $n) {
	$var = 'min_'.$name.'_'.$n;
	$m = getPostValue($var);

	$var = 'h_'.$name.'_'.$n;
	$h = getPostValue($var);

	if ($h) {
		if ($h < 10)
			$h = "0".$h;
		if ($m < 10)
			$m = "0".$m;
		return ($h.":".$m);
	}
	return "";
	
}
function HoureMinuteForm($hm, $name, $n) {
	$h = 0;
	$m = 0;
	if ($hm) {
		$timestr = formatTime($hm);
		list($h, $m) = explode(":", $timestr);
	}
	$p0 = "0";
	$found_h = 0;
	$pm = "am";
	$hname = "h_".$name."_".$n;
?>
<select name="<?php  echo($hname); ?>" STYLE="width:60; color:blue">
<option  value=''> -- </option>
<?php 
for ($i = 7; $i < 25; $i ++) {
	$nh = $i;
	if ($i>12) {
		$nh = $i-12;
		$pm = "pm";
	}
	if ($nh < 10)
		$p0="0";
	else 
		$p0="";

	if ($h == $i) {
		echo ("<option value=".$i." selected> " .$p0.$nh.$pm. "</option>");
		$found_h = 1;
	}
	else
		echo ("<option  value=".$i."> " .$p0.$nh.$pm. "</option>");
}
?>
</select> : 
<?php $mname = "min_".$name."_".$n; ?>
<select name="<?php echo($mname); ?>" STYLE="width:50; color:blue">
<option value=0> -- </option>
<?php 
for ($i = 0; $i < 60; $i +=5) {
	if ($i < 10)
		$p0="0";
	else 
		$p0="";
	if ($found_h && ($m == $i))
		echo ("<option value=".$i." selected> " .$p0.$i. " </option>");
	else
		echo ("<option  value=".$i."> " .$p0.$i. " </option>");
}
?>
</select>
<?php 
}


function getDateFromForm($name) {
	$m = getPostValue('m_'.$name);
	$d = getPostValue('d_'.$name);
	$y = getPostValue('y_'.$name);
	if ($d < 10)
		$d = "0".$d;
	if ($m < 10)
		$m = "0".$m;
	return ($m."/".$d."/".$y);
	
}

function showDateForm($year, $name) {
$thisyear = date("Y");
$datestr = formatDate($year);

list($m, $d, $y) = explode("/", $datestr);

echo("<select name='m_".$name."' STYLE='width:40; color:blue; align: center'>");
for ($i = 1; $i < 13; $i++) {
	if ($i < 10)
		$p0="0";
	else 
		$p0="";
	if (($m == $i))
		echo ("<option value=".$i." selected> " .$p0.$i. " </option>");
	else
		echo ("<option  value=".$i."> " .$p0.$i. " </option>");
}
echo("</select>/");
echo("<select name='d_".$name."' STYLE='width:40; color:blue; align: center'>");
for ($i = 1; $i < 32; $i++) {
	if ($i < 10)
		$p0="0";
	else 
		$p0="";
	if ($d == $i)
		echo ("<option value=".$i." selected> " .$p0.$i. " </option>");
	else
		echo ("<option  value=".$i."> " .$p0.$i. " </option>");
}
echo("</select>/");
echo("<select name='y_".$name."' STYLE='width:60; color:blue; align: center'>");
for ($i = $thisyear; $i < $thisyear+5; $i++) {
	if ($y == $i)
		echo ("<option value=".$i." selected> " .$i. " </option>");
	else
		echo ("<option  value=".$i."> " .$i. " </option>");
}
echo("</select> ");
}

function FormTitle($title) {
?>

<TABLE cellSpacing=0 cellPadding=0 width=520 border=0>
<TR>
	<TD width=12 height=24 class=registerborder>
		<IMG height=24 src="../images/left.gif" width=12 border=0>
	</TD>
	<TD width=500 class=registerbar>
		<?php echo($title); ?>
	</TD>
	<TD width=14 height=24 class=registerborder>
		<IMG height=24 src="../images/right.gif" width=14 border=0>
	</TD>
</TR>
</TABLE>
<?php 		
}

?>