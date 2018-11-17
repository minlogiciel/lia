<?php
include_once ("../public/act_variable.inc");

class ACTForm {
	var $ACT_FILENAME = "../public/act_variable1.inc";
	var $ACT_VARNAME = "ACTLIST";
	
	
function getACTListArray() {
	$lists = array();
	$ll = array();
	$ll[] 	= $_POST['title'];
	$ll[] 	= $_POST['subtitle'];
	
	
	$tuition 	= $_POST['tuition'];
	if (strstr($tuition,";")) {
		list($tuition1, $tuition2) =  explode(";", $tuition);
		$ll[] 	= $tuition1;
		$ll[] 	= $tuition2;
	}
	else {
		$ll[] 	= $tuition;
		$ll[] 	= "";
	}
	$lists[] = $ll;
	$nb 		= $_POST['actnumber'];
	for ($i = 1; $i < $nb; $i++) {
		$vdate = "date_".$i;
		$vtime = "time_".$i;
		$vsubj = "subject_".$i;
		$dates 		= $_POST[$vdate];
		$times 		= $_POST[$vtime];
		$subjects 	= $_POST[$vsubj];
		$lists[] = array($dates, $times, $subjects);
	}
	return $lists;
}

function getScheduleListArray() {
	$lists = array();
	
	$title 		= $_POST['title'];
	$subtitle 	= $_POST['subtitle'];
	$tuition 	= $_POST['tuition'];
	$lists[]	= array($title, $subtitle, $tuition);
		
	$nb 	= $_POST['actnumber'];
	for ($i = 1; $i < $nb; $i++) {
		$vdate = "date_".$i;
		$vtime = "time_".$i;
		$vsubj = "subject_".$i;
		
		$dates 		= $_POST[$vdate];
		$times 		= $_POST[$vtime];
		$subjects 	= $_POST[$vsubj];
		$lists[]	= array($dates, $times, $subjects);
	}
	return $lists;
}

function getScheduleListString() 
{
	$lists = $this->getScheduleListArray();
	$text = "array(\n";
	$nb = count($lists);
	for ($i = 0; $i < $nb; $i++) {
		$elem = $lists[$i];
		$text .= "\tarray(";
		$nb_e = count($elem);
		for ($j = 0; $j < $nb_e; $j++) {
			$text .= "\"" .$elem[$j]. "\"";
			if ($j < $nb_e-1) {
				$text .= ", ";
			}
		}
		if ($i < ($nb -1)) {
			$text .= "),\n";
		}
		else {
			$text .= ")\n";
		}
	}
	$text .= ");\n\n" ; 
	return $text;
}

function WriteACTTable() {

	$lists = $this->getACTListArray();
	$text  = "<?php\n\n"; 
	$text .= "\$".$this->ACT_VARNAME." = ";
	
	$text .= $this->getScheduleListString();
	
/*	$text .= "array(\n";
	
	$text .= "array(\"" .$lists[0][0]. "\", \"" .$lists[0][1]. "\",\n" ;
	$text .= "\t\t\"" .$lists[0][2]. "\", \"" .$lists[0][3]. "\"),\n" ;

	for ($i = 1; $i < count($lists); $i++) {
		$text .= "array(";
		for ($j = 0; $j < count($lists[$i]); $j++) {
			$text .="\"" .$lists[$i][$j]. "\", ";
		}
		$text .= "),\n" ; 
	}
	$text .= ");\n\n";
*/
		
	$text .= "?>\n\n";

	$fp = fopen($this->ACT_FILENAME, "w");
	fwrite($fp, $text);
	fclose($fp);

	return $text;
}

	
function ShowACTTable($result) {
	global $ACTLIST;
	if(!empty($_REQUEST['addnewline']))   {
		$lists = $this->getActListArray();
		$lists[] = array("", "", "");
	}
	else {
		$lists = $ACTLIST;		
	}
	$nb = count($lists);
?>

<FORM method=post action='admin.php'>
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='acttype'>
<INPUT type=hidden name='action' value='updateact'>
<INPUT type=hidden name='actnumber' value='<?php echo($nb); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=30><?php echo($result) ?></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  >
		<TR><TD height=50><font color=red size=4><b>ACT Schedule</b></font></TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width='15%' height=30> TITLE : </TD>
					<TD class='listtext' width=85%>
						<input class='fnborder' type='text' size='70' name='title' value='<?php echo($lists[0][0]); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30> SUBTITLE : </TD>
					<TD class='listtext' >
						<input class='fnborder' type='text' size='80' name='subtitle' value='<?php echo($lists[0][1]); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30> TUITION : </TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='80' name="tuition" value="<?php echo($lists[0][2]."; ".$lists[0][3]); ?>">
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=20></TD></TR>

		<TR>
			<TD class=background valign=top>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=30 width='3%'></TD>
					<TD class=ITEMS_LINE_TITLE width='15%'> Date </TD>
					<TD class=ITEMS_LINE_TITLE width='15%'> Time </TD>
					<TD class=ITEMS_LINE_TITLE width='50%'> Subject </TD>
				</TR>
<?php 
		for ($i = 1; $i < $nb; $i++) {
			$n = $i;
			$elem 		= $lists[$i];
			$dates 		= $elem[0];
			$times 		= $elem[1];
			$subject 	= $elem[2];
?>
				<TR>
					<TD class='listnum' height=30><div align=center><?php echo($i); ?></div></TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='15' name="date_<?php echo($n); ?>" value="<?php echo($dates); ?>">
					</TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='15' name="time_<?php echo($n); ?>" value="<?php echo($times); ?>">
					</TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='75' name="subject_<?php echo($n); ?>" value="<?php echo($subject); ?>">
					</TD>
				</TR>
<?php 	
		}
?>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=15></TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=30 width=50% class=formlabel>
						<div align=right>
						<INPUT class=button type=submit name="updateact" value=' Update ACT '>
						</div>
					</TD>
					<TD height=30 class=formlabel width=50%>
						<div align=left>&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name="addnewline" VALUE=' Add Line  '>
						</div>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=15>&nbsp;</TD></TR>
		</TABLE>

	</TD>
</TR>
</TABLE>
</FORM>
<?php 
}
	
}

?>