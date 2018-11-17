<script type="text/javascript" src="../utils/tooltip.js"></script>
<div id="tooltip"></div>


<?php
$curr_url = $_SERVER["PHP_SELF"]; 
$_SESSION['prev_url'] = $curr_url; 

$mois = isset($_GET["mois"]) ? $_GET["mois"] : 0;

$annee = isset($_GET["annee"]) ? $_GET["annee"] : 0;



$fetes  = array(
	array(1, 1, 0, 0, "New year&#039;s Day"),
	array(1, 0, 1, 3,  "Birthday of Martin Luther King, Jr"),
	array(2, 14, 0, 0, "St Valentine&#039;s Day"),
	array(2, 0, 1, 3, "Presidents Day"),
	array(3, 0, 0, 2, "Daylight Saving Time Begins"),
	array(11, 0, 0, 1, "Daylight Saving Time Ends"),
	array(4, 1, 0, 0, "April Fool&#039;s Day"),
	array(4, 8, 0, 0, "Easter"),
	array(5, 0, 0, 2, "Mather&#039;s Day"),
	array(6, 0, 0, 3, "Father&#039;s Day"),
	array(5, 0, 1, 5, "Memorial Day"),
	array(7, 4, 0, 0,  "Independence Day"),
	array(9, 0, 1, 1, "Labor Day"),
	array(10, 0, 1, 2,  "Columbus Day"),
	array(10, 31, 0, 0,  "Halloween"),
	array(11, 11, 0, 0,  "Veterans Day"),
	array(11, 0, 4, 4,  "Thanksgiving Day"),
	array(12, 25, 0, 0,  "Christmas Day")
);

$events_day  = array(
	array(2011, 10, 12, "PSAT"),
);

if ($annee == 0 && $mois == 0) {
	$today = getdate() ;
}
else {
	$mydate  = mktime(0, 0, 0, $mois  , 1, $annee); 
	$today = getdate($mydate); 
}

if ($annee > 0) {
	$a = $annee;
}
else {
	$a = $today['year'];
}
if ($mois > 0) {
	$m = $mois;
}
else {
	$m 	= $today['mon'];
}

$next_a = $a;
$next_m = $m + 1;
$prev_a = $a;
$prev_m = $m - 1;
if ($next_m > 12) {
	$next_m = 1;
	$next_a = $a + 1;
}
if ($prev_m < 1) {
	$prev_m = 12;
	$prev_a = $a - 1;
}

$d = $today['mday'];
$wd = $today['wday'];
$w = $today['weekday'];
$mm = $today['month'];
$mm = getMonth($m);

function isFeteJour($m, $d, $w, $n) {
	global $fetes;
	$ret = 0;
	for ($i = 0; $i < count($fetes); $i++) {
		$mm = $fetes[$i][0];
		$dd = $fetes[$i][1];
		$ww = $fetes[$i][2];
		$nn = $fetes[$i][3];
		if ($m == $mm) {
			if ($d == $dd) {
				$ret = $fetes[$i][4];
				break;
			}
			else if ($dd == 0) {
				if ($ww == $w && $nn == $n) {
					$ret = $fetes[$i][4];
					break;					
				}
			}
		}
	}
	return $ret;
}

function getEventsString($a, $m, $d) {
	global $events_day;
	$events= '';
	for ($i = 0; $i < count($events_day); $i++) {
		$aa = $events_day[$i][0];
		$mm = $events_day[$i][1];
		$dd = $events_day[$i][2];
		if ($a == $aa && $m == $mm && $d == $dd ) {
			$events = $events_day[$i];
			break;
		}
	}
	return($events);
}

function getMonthNumber($a, $m) {
	if ($m == 2) {
		if ($a%4 == 0)
			return 29;
		else
			return 28;
	}
	else if ($m == 4 || $m == 6 || $m == 9 || $m == 11) 
		return 30;
	else
		return 31;
}
function getFirstDayPosition($today, $wday) {
  $d = $today % 7;
  $fwd = 1;
  if ($d == 1)
  	$fwd = $wday - 1;
  else {
  	$fwd = (7 - $d + $wday)%7;
  }
  return $fwd;
}

function getToday() {
	$today = getdate() ;
  	return $today['mday'];
}
function getThisMonth() {
	$today = getdate() ;
  	return $today['mon'];
}

function getMonthTable($a, $m, $d, $wd) {
	$m_nb = getMonthNumber($a, $m);
	$m_nb0 = getMonthNumber($a, ($m-1));
	$firstd  = getFirstDayPosition($d, $wd);
	$t_nb = $m_nb + $firstd + 1;
	$t_line = (int)($t_nb/7);
	if ($t_nb % 7 != 0)
		$t_line++;
	$t_nb = $t_line * 7;
	$aa = array();
	$ab='';
	$n = 1;
	$next = 1;
	for ($i = 0; $i < $t_nb; $i++) {
		if ($i <= $firstd)
			$aa[$i] = $m_nb0-$firstd+$i;
		else if ($n > $m_nb )
			$aa[$i] = $next++;
		else 
			$aa[$i] = $n++;		
	}
	return $aa;
}
function getCellClass($j, $d, $v) {
	
	if ($d == $v && $d == date("j"))
		return("mod_today");
	else if ($j == 0 || $j == 6)
		return("mod_weekend");
	else
		return("mod_weekday");
}
function isThisMonthDay($i, $a) {
	if ((($i < $a[$i]) && ($a[0] > 1)) || (($i > 14) && ($a[$i] < 7)))
		return 0;
	else
		return 1;
}
$curr_month = $m;
if (isset($_POST["curr_month"]))
	$curr_month = $_POST["curr_month"];

?>
<SCRIPT LANGUAGE="JavaScript">
function changemois(input, v) {
	var vv;
	var ret = false;
	if(input.value == null || input.value == "0")
		vv = parseInt(v);
	else
		vv = parseInt(input.value) + parseInt(v);
	if (vv > 12) {
		vv = 1;
		ret = true;
	}
	else if (vv < 1) {
		vv = 12;
		ret = true;
	}
	input.value = vv;
	return ret;
}
</SCRIPT>

<TABLE cellSpacing=0 cellPadding=0 width="90%" align=center border=0>
<TR>
	<TD style="BACKGROUND-REPEAT: repeat-y" vAlign=top background=../images/lb.gif>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
		<TR>
			<TD>
				<TABLE width=100% cellSpacing=0 cellPadding=0 align=center>
				<TR>
					<TD width=20>
						<?php echo("&nbsp;&nbsp;<a href='".$curr_url."?mois=".$prev_m."&annee=".$prev_a."'> &laquo; </a>"); ?>
					</TD>
					<TD class=mod_monthyearname>
						<DIV align=center><?php echo ($mm . " " . $a); ?></DIV>
					</TD>
					
					<TD width=20>
						<?php echo("<a href='".$curr_url."?mois=".$next_m."&annee=".$next_a."'> &raquo; </a>&nbsp;&nbsp;"); ?>
					</TD>
					
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD>
				<TABLE class=mod_table cellSpacing=0 cellPadding=2 align=center>
				<TR>
					<TD class=mod_dayname><FONT color=red>S</FONT></TD>
					<TD class=mod_dayname>M</TD>
					<TD class=mod_dayname>T</TD>
					<TD class=mod_dayname>W</TD>
					<TD class=mod_dayname>T</TD>
					<TD class=mod_dayname>F</TD>
					<TD class=mod_dayname>S</TD>
				</TR>
		<?php 
			$arr = getMonthTable($a, $m, $d, $wd);
			$startday = -1;
			$nweek = 0;
			for ($i = 0; $i < count($arr); $i += 7) {
			echo("<TR>");
				for ($j = 0; $j < 7; $j++) {
					$nn = $i+$j;
					$dd = $arr[$nn];
					if (isThisMonthDay($nn, $arr)) {					
						if ($startday == -1) {
							$startday = $j;
						}
						if ($startday == $j) {
							$nweek++;
						}
						$estr = "no events";
						$hasevents = 0;
						$events = getEventsString($a, $m, $dd);
						$ff = isFeteJour($m, $dd, $j, $nweek);
						if ($events) {
							$estr = $events[3];
							$hasevents = 1;
						}
						if ($ff) {
							echo("<TD class=mod_holiday>"); 
							echo("<div title='".$ff."' onmouseover='tooltip.show(this)' onmouseout='tooltip.hide(this)'>".$dd."</div>");
 							echo("</TD>");
						} else {
							echo("<TD class='".getCellClass($j, $d, $dd)."'>");
							if ($hasevents) {
								echo("<div title='".$estr."' onmouseover='tooltip.show(this)' onmouseout='tooltip.hide(this)'><font color=blue><b>".$dd."</b></font></div>");
							} else {
								echo($dd);
							}
							echo("</TD>");
						} 
					}	else { 
							echo("<TD class='mod_dayoutofmonth'>".$dd."</TD>");
					}
				} 
			echo("</TR>");
			} ?>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD>
				<TABLE width=100% cellSpacing=0 cellPadding=0 align=center>
				<TR>
					<TD>
						<?php echo("<a href='".$curr_url."?mois=".$prev_m."&annee=".$prev_a."'> &laquo; </a>"); ?>
					</TD>
					<TD class=mod_events_thismonth height=15>
					</TD>
					
					<TD>
						<?php echo("<a href='".$curr_url."?mois=".$next_m."&annee=".$next_a."'> &raquo; </a>"); ?>
					</TD>
					
				</TR>
				</TBODY></TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
