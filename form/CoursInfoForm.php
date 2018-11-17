<?php
include_once ("../home/cours_information.inc");
include_once ("../home/apsat_information.inc");

class CoursInfoForm {
	var $COURS_FILENAME = "../home/cours_information.inc";
	var $APSAT_FILENAME = "../home/apsat_information.inc";
	var $APSAT_VARNAME = "APSAT_INFOS";
	var $COURS_VARNAME = "COURS_INFOS";
	

function getAPSATListArray() {
	$lists = array();
	$ll = array();
	$ll[] 	= getPostValue('title');
	$notes 	= getPostValue('notes');
	if (trim($notes)) {
		$nlist =  explode(";", $notes);
		for ($i = 0; $i < count($nlist); $i++) {
			$ll[] = $nlist[$i];
		}
	}
	else {
		$ll[] 	= "";
	}
	$lists[] = $ll;
		
	$nb 		= $_POST['itemnumber'];
	for ($i = 1; $i < $nb; $i++) {
		$vtitle = "title_".$i;
		$vnote = "note_".$i;
		
		$title 		= getPostValue($vtitle);
		$note 		= getPostValue($vnote);
		if ($title) {
			$ll = array();
			$ll[] = $title;
			$ll[] = $note;
			$lists [] = $ll;
		}
	}
	return $lists;
}

function WriteAPSATTable() {

	$lists = $this->getAPSATListArray();

	if(empty($_REQUEST['addnewline']))   {
		$text  = "<?php\n\n"; 
		$text .= "\$".$this->APSAT_VARNAME." = array(\n";
		
		for ($i = 0; $i < count($lists); $i++) {
			$text .= "array(";
			for ($j = 0; $j < count($lists[$i]); $j++) {
				$text .="\"" .$lists[$i][$j]. "\", ";
			}
			$text .= "),\n" ; 
		}
		$text .= ");\n\n?>\n\n";
	
		
		
		$fp = fopen($this->APSAT_FILENAME, "w");
		fwrite($fp, $text);
		fclose($fp);
	}
	else {
		$lists[] =  array("title", "Note");
	}
	return $lists;
}

	
function ShowAPSATTable($newtab, $result) 
{
	global $APSAT_INFOS;

	if($newtab)   {
		$lists = $newtab;
	}
	else {
		$lists = $APSAT_INFOS;		
	}
	$nb = count($lists);
?>

<FORM method=post action='admin.php'>
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='apsatinfotype'>
<INPUT type=hidden name='action' value='updateapsat'>
<INPUT type=hidden name='itemnumber' value='<?php echo($nb); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=30><?php echo($result) ?></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  >
		<TR><TD height=50><font color=red size=4><b>AP SAT Cours Information</b></font></TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width='15%' height=30> TITLE : </TD>
					<TD class='listtext' width=85%>
						<input  type='text' size='80' name='title' value='<?php echo($lists[0][0]); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30> NOTES : </TD>
					<TD class='listtext'>
					<?php 
						$notes = "";
						for ($i = 1; $i < count($lists[0]); $i++) { 
							if ($i > 1)
								$notes .= ";";
							$notes .= $lists[0][$i];
						}
					
					?>
						<input  type='text' size='80' name="notes" value="<?php echo($notes); ?>">
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
					<TD class=ITEMS_LINE_TITLE width='40%'> Title  </TD>
					<TD class=ITEMS_LINE_TITLE width='57%'> Description </TD>
				</TR>
<?php 
		for ($i = 1; $i < $nb; $i++) {
			$elem 		= $lists[$i];
			$title 		= $elem[0];
			$note		= $elem[1];
?>
				<TR>
					<TD class='listnum' height=30><div align=center><?php echo($i); ?></div></TD>
					<TD class='listtext'>
						<input  type='text' size='38' name="title_<?php echo($i); ?>" value="<?php echo($title); ?>">
					</TD>
					<TD class='listtext'>
						<input  type='text' size='55' name="note_<?php echo($i); ?>" value="<?php echo($note); ?>">
					</TD>
				</TR>
<?php 	}
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
						<INPUT class=button type=submit name="updatesat" value=' Update '>
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


function getCoursListArray() {
	$lists = array();
	$ll = array();
	$ll[] 	= getPostValue('title');
	$notes 	= getPostValue('notes');
	if (trim($notes)) {
		$nlist =  explode(";", $notes);
		for ($i = 0; $i < count($nlist); $i++) {
			$ll[] = $nlist[$i];
		}
	}
	else {
		$ll[] 	= "";
	}
	$lists[] = $ll;
		
	$nb 		= $_POST['itemnumber'];
	for ($i = 1; $i < $nb; $i++) {
		$vtitle = "title_".$i;
		$vgrade = "grade_".$i;
		$vnote = "note_".$i;
		
		$title 		= getPostValue($vtitle);
		$grade 		= getPostValue($vgrade);
		$note 		= getPostValue($vnote);
		if ($title) {
			$ll = array();
			$ll[] = $title;
			$ll[] = $grade;
			$ll[] = AreaTextToTable($note);
			$lists [] = $ll;
		}
	}
	return $lists;
}

function WriteCoursTable() {

	$lists = $this->getCoursListArray();

	if(empty($_REQUEST['addnewline']))   {
		$text  = "<?php\n\n"; 
		$text .= "\$".$this->COURS_VARNAME." = array(\n";
		
		$text .= "array(";
		for ($j = 0; $j < count($lists[0]); $j++) {
			$text .="\"" .$lists[0][$j]. "\", ";
		}
		$text .= "),\n" ; 

		for ($i = 1; $i < count($lists); $i++) {
			$text .= "array(\"" .$lists[$i][0]. "\", \"" .$lists[$i][1]. "\", " ;
			$text .= "array(" ;
			$elem = $lists[$i][2];
			for ($j = 0; $j < count($elem); $j++) {
				$text .="\"" .$elem[$j]. "\"";
				if ($j < count($elem)-1){
					$text .=", ";
				}
			}
			$text .= "))" ; 
			if ($i < count($lists)-1){
				$text .=",";
			}
			$text .="\n";
		}
		$text .= ");\n\n?>\n\n";
	
		
		
		$fp = fopen($this->COURS_FILENAME, "w");
		fwrite($fp, $text);
		fclose($fp);
	}
	else {
		$lists[] =  array("title", "Note", array());
	}
	return $lists;
}



function ShowCoursInformationTable($newtab, $result) 
{
	global $COURS_INFOS;

	if($newtab)   {
		$lists = $newtab;
	}
	else {
		$lists = $COURS_INFOS;		
	}
	$nb = count($lists);
?>

<FORM method=post action='admin.php'>
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='coursinfotype'>
<INPUT type=hidden name='action' value='updatecours'>
<INPUT type=hidden name='itemnumber' value='<?php echo($nb); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=30><?php echo($result) ?></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  >
		<TR><TD height=50><font color=red size=4><b>Saturday Cours Information</b></font></TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width='15%' height=30> TITLE : </TD>
					<TD class='listtext' width=85%>
						<input class='fields' type='text' size='80' name='title' value='<?php echo($lists[0][0]); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30> NOTES : </TD>
					<TD class='listtext'>
					<?php 
						$notes = "";
						for ($i = 1; $i < count($lists[0]); $i++) { 
							if ($i > 1)
								$notes .= ";";
							$notes .= $lists[0][$i];
						}
					
					?>
						<input class='fields' type='text' size='80' name="notes" value="<?php echo($notes); ?>">
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
					<TD class=ITEMS_LINE_TITLE width='30%'> Title  </TD>
					<TD class=ITEMS_LINE_TITLE width='10%'> Grade  </TD>
					<TD class=ITEMS_LINE_TITLE width='57%'> Description </TD>
				</TR>
<?php 
		for ($i = 1; $i < $nb; $i++) {
			$elem 		= $lists[$i];
			$title 		= $elem[0];
			$grade		= $elem[1];
			$note		= $elem[2];
			$notes = "";
			for ($j = 0; $j < count($note); $j++) {
				$notes .= $note[$j]. "\n";
			}
				
?>
				<TR>
					<TD class='listnum' height=30><div align=center><?php echo($i); ?></div></TD>
					<TD class='listtext'>
						<input type='text' size='30' name="title_<?php echo($i); ?>" value="<?php echo($title); ?>">
					</TD>
					<TD class='listtext'>
						<input  type='text' size='10' name="grade_<?php echo($i); ?>" value="<?php echo($grade); ?>">
					</TD>
					<TD class='listtext'>
						<textarea name="note_<?php echo($i); ?>" cols="50" rows="4"><?php echo($notes); ?></textarea>
					</TD>
				</TR>
<?php 	}
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
						<INPUT class=button type=submit name="updatesat" value=' Update '>
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