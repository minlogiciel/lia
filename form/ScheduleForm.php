<?php
class ScheduleForm {

function getScheduleListArray() {
	$lists = array();
	
	$title 		= $_POST['title'];
	$subtitle 	= $_POST['subtitle'];
	$tuition 	= $_POST['tuition'];
	$lists[]	= array($title, $subtitle, $tuition);
		
	$nb 	= $_POST['schedulenumber'];
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
	$text .= ");\n" ; 
	return $text;
}

function WriteScheduleTable($STable) {

	$text  = "<?php\n\n"; 
	$text .= "\$".$STable[3]." = ";
	
	$text .= $this->getScheduleListString();
	$text .= "?>\n\n";

	$fp = fopen("../public/".$STable[4], "w");
	fwrite($fp, $text);
	fclose($fp);

	return $text;
}
	
function ShowScheduleTable($STable, $result) {
	if(!empty($_REQUEST['addnewline']))   {
		$lists = $this->getScheduleListArray();
		$lists[] = array("", "", "");
	}
	else {
		$lists = $STable[0];		
	}
	$nb = count($lists);
	$title = $lists[0][0];
	$subtitle = $lists[0][1];
	$tuition = $lists[0][2];
	for ($i = 3; $i < count($lists[0]); $i++)  {
		$tuition .= "; " .$lists[0][$i];
	}
?>

<FORM method=post action='admin.php'>
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='<?php echo($STable[2]); ?>'>
<INPUT type=hidden name='action' value='updateschedule'>
<INPUT type=hidden name='schedulenumber' value='<?php echo($nb); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=30><?php echo($result) ?></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  >
		<TR><TD height=50><font color=red size=4><b><?php echo($STable[1]) ?> Table</b></font></TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width='15%' height=30> TITLE : </TD>
					<TD class='listtext' width=85%>
						<input class='fnborder' type='text' size='70' name='title' value='<?php echo($title); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30> SUBTITLE : </TD>
					<TD class='listtext' >
						<input class='fnborder' type='text' size='80' name='subtitle' value='<?php echo($subtitle); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30> TUITION : </TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='80' name="tuition" value="<?php echo($tuition); ?>">
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
					<TD class=ITEMS_LINE_TITLE height=30 width='4%'></TD>
					<TD class=ITEMS_LINE_TITLE width='18%'> Date </TD>
					<TD class=ITEMS_LINE_TITLE width='18%'> Time </TD>
					<TD class=ITEMS_LINE_TITLE width='60%'> Subject </TD>
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
						<input id="date_<?php echo($n); ?>" class="date_input" type='text' size='15' name="date_<?php echo($n); ?>" value="<?php echo($dates); ?>">
					</TD>
					<TD class='listtext'>
						<input type='text' size='15' name="time_<?php echo($n); ?>" value="<?php echo($times); ?>">
					</TD>
					<TD class='listtext'>
						<input type='text' size='70' name="subject_<?php echo($n); ?>" value="<?php echo($subject); ?>">
					</TD>
				</TR>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery.datepicker.setDefaults($.datepicker.regional['']);
    jQuery('#date_'+<?php echo($i); ?>).mousedown(function(){
        jQuery('#date_'+<?php echo($i); ?>).datepicker({minDate:'-36500', maxDate:'+36500', dateFormat: 'mm/dd/yy', firstDay:1, cgangeFirstDay : false }).attr("readonly","readonly");
    });
});
</script>

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
						<INPUT class=button type=submit name="updateschedule" value=' Update <?php echo($STable[1]); ?> '>
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