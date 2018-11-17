<?php
include_once ("../public/sat_variable.inc");

class SATForm {
	var $SAT_FILENAME = "../public/sat_variable.inc";
	var $SAT_VARNAME = "SATTABLELIST";
	

function getSATListArray() {
	$lists = array();
	$ll = array();
	$ll[] 	= $_POST['title1'];
	$ll[] 	= $_POST['title2'];
	
	
	$tuition 	= $_POST['tuition1'];
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
		
	$nb 		= $_POST['satnumber'];
	for ($i = 1; $i < $nb; $i++) {
		$vdate = "date_".$i;
		$vtime = "time_".$i;
		$vsubj = "subject_".$i;
		$vtime2 = "time2_".$i;
		$vsubj2 = "subject2_".$i;
			
		$dates 		= $_POST[$vdate];
		$times 		= $_POST[$vtime];
		$subjects 	= $_POST[$vsubj];
		$times2 	= $_POST[$vtime2];
		$subjects2 	= $_POST[$vsubj2];
		$ll = array();
		$ll[]	= $dates;
		$ll[] 	= $times;
		$ll[] 	= $subjects;
		if ($times2 && $subjects2) {
			$ll[] = $times2;
			$ll[] = $subjects2;
		}
		$lists [] = $ll;
	}
	return $lists;
}

function WriteSatTable() {

	$lists = $this->getSATListArray();
	$text  = "<?php\n\n"; 
	$text .= "\$SATLIST = array(\n";
	
	$text .= "array(\"" .$lists[0][0]. "\", \"" .$lists[0][1]. "\",\n" ;
	$text .= "\t\t\"" .$lists[0][2]. "\", \"" .$lists[0][3]. "\"),\n" ;

	for ($i = 1; $i < count($lists); $i++) {
		$text .= "array(";
		for ($j = 0; $j < count($lists[$i]); $j++) {
			$text .="\"" .$lists[$i][$j]. "\", ";
		}
		$text .= "),\n" ; 
	}
	$text .= ");\n\n?>\n\n";

	
	
	$fp = fopen($this->SAT_FILENAME, "w");
	fwrite($fp, $text);
	fclose($fp);

	return $text;
}

	
function ShowSATTable($result) 
{
	global $SATLIST;

	if(!empty($_REQUEST['addnewline']))   {
		$lists = $this->getSatListArray();
		$lists[] =  array("date", "time", "title",  "time", "title");
	}
	else {
		$lists = $SATLIST;		
	}
	$nb = count($lists);
?>

<FORM method=post action='admin.php'>
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='sattype'>
<INPUT type=hidden name='action' value='updatesat'>
<INPUT type=hidden name='satnumber' value='<?php echo($nb); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=30><?php echo($result) ?></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  >
		<TR><TD height=50><font color=red size=4><b>SAT Schedule</b></font></TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width='15%' height=30> TITLE : </TD>
					<TD class='listtext' width=85%>
						<input class='fnborder' type='text' size='70' name='title1' value='<?php echo($lists[0][0]); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30> SUBTITLE : </TD>
					<TD class='listtext' >
						<input class='fnborder' type='text' size='80' name='title2' value='<?php echo($lists[0][1]); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30> TUITION : </TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='80' name="tuition1" value="<?php echo($lists[0][2]."; ".$lists[0][3]); ?>">
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
					<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
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
			if (count($elem) > 3) {
				$times2 	= $elem[3];
				$subject2 	= $elem[4];
			}
			else {
				$times2 	= "";
				$subject2 	= "";
			}
			?>
				<TR>
					<TD class='listnum' rowspan=2><div align=center><?php echo($n); ?></div></TD>
					<TD class='listtext' rowspan=2>
						<input class='fnborder' type='text' size='15' name="date_<?php echo($n); ?>" value="<?php echo($dates); ?>">
					</TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='15' name="time_<?php echo($n); ?>" value="<?php echo($times); ?>">
					</TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='75' name="subject_<?php echo($n); ?>" value="<?php echo($subject); ?>">
					</TD>
				</TR>
				<TR>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='25' name="time2_<?php echo($n); ?>" value="<?php echo($times2); ?>">
					</TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='67' name="subject2_<?php echo($n); ?>" value="<?php echo($subject2); ?>">
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
						<INPUT class=button type=submit name="updatesat" value=' Update SAT '>
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