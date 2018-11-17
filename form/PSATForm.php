<?php
include ("../public/psat.inc");

class PSATForm {
	var $PSAT_FILENAME = "../public/psat.inc";

function getPSATListArray() {
	$lists = array();
	$ll = array();
	$ll[] 	= $_POST['title1'];
	$ll[] 	= $_POST['title2'];
	
	
	$tuition 	= $_POST['tuition1'];
	if (strstr($tuition,";;")) {
		list($tuition1, $tuition2) =  explode(";", $tuition);
		$ll[] 	= $tuition1;
		$ll[] 	= $tuition2;
	}
	else {
		$ll[] 	= $tuition;
		$ll[] 	= "";
	}
	$lists[] = $ll;
		
	$nb = $_POST['psatnumber'];
	for ($i = 1; $i < $nb; $i++) {
		$vtitle = "title_".$i;
		$vsubject = "subject_".$i;
			
		$title 		= $_POST[$vtitle];
		$subject 	= $_POST[$vsubject];
		$ll = array();
		$ll[]	= $title;
		$ll[] 	= $subject;
		$lists [] = $ll;
	}
	return $lists;
}

function WritePSATTable() {

	$lists = $this->getPSATListArray();
	$text  = "<?php\n\n"; 
	$text .= "\$PSATLIST = array(\n";
	
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

	
	$fp = fopen($this->PSAT_FILENAME, "w");
	fwrite($fp, $text);
	fclose($fp);

	return $text;
}

	
function ShowPSATTable($result) {
	global $PSATLIST;
	if(!empty($_REQUEST['addnewline']))   {

	}
	else {
		$lists = $PSATLIST;		
	}
	$nb = count($lists);
?>

<FORM method=post action='admin.php'>
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='sattype'>
<INPUT type=hidden name='psatnumber' value='<?php echo($nb); ?>'>
<INPUT type=hidden name='action' value='updatepsat'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=30><?php echo($result) ?></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  >
		<TR><TD height=50><font color=red size=4><b>PSAT Schedule</b></font></TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width='15%' height=30> TITLE : </TD>
					<TD class='listtext' width=85%>
						<input class='fnborder' type='text' size='80' name='title1' value='<?php echo($lists[0][0]); ?>'>
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
						<?php 
						$tuition = $lists[0][2];
						for ($p = 3; $p < count($lists[0]); $p++) {
							$tuition .= ";".$lists[0][$p];
						}
						?>
						<input class='fnborder' type='text' size='80' name="tuition1" value="<?php echo($tuition); ?>">
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
					<TD class=ITEMS_LINE_TITLE width='20%'>Title</TD>
					<TD class=ITEMS_LINE_TITLE width='75%'>Subject  </TD>
				</TR>
					
<?php 
		for ($i = 1; $i < $nb; $i++) {
			$elem = $lists[$i];
			$label 	= $elem[0];
			$subject = $elem[1];
			for ($p = 2; $p < count($elem); $p++) {
				$subject .= ";".$elem[$p];
			}
?>
			
				<TR>
					<TD class='listnum' height=30><div align=center><?php echo($i); ?></div></TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='25' name='title_<?php echo($i); ?>' value='<?php echo($label); ?>'>
					</TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='90' name='subject_<?php echo($i); ?>' value='<?php echo($subject); ?>'>
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
			<TD height=30 class=formlabel>
				<div align=center><INPUT class=button type=submit value=' Update PSAT '></div>
			</TD>
		</TR>
		<TR><TD height=15></TD></TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
<?php 
	}

}

?>