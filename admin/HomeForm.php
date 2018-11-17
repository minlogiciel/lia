<?php
class HomeForm {
	var $HOME_TYPE = 1;

	/******************* admission *******************************/
	var $ADMI_FILENAME = "../public/admission.inc";
	var $ADMI_VARNAME = "ADMISSIONLIST";
	function writeAdmission() 
	{
		writeVariable($this->ADMI_FILENAME, $this->ADMI_VARNAME,  $this->getVariableListString());
	}
	
	function readAdmission() 
	{
		$lists = readVariable($this->ADMI_FILENAME);
		if (!$lists)
			$lists = array();
		return $lists;
	}

	function listAdmissionTable() {
		$cn = 2;
		if(!empty($_REQUEST['addlineadmissiont'])) {
			$addnb = $_POST['actnumber'];
			$addnb = ($addnb + 1) * $cn;
			$lists = $this->getVariableList();	
			for ($i = count($lists); $i < $addnb; $i++)
				$lists[] = "";
		}
		else {
			$lists = $this->readAdmission();		
		}
		if (count($lists) > 0) {
			$nb = count($lists) / $cn;
		}
		else {
			$nb = 4;
			for ($i = 0; $i < $nb*$cn; $i++)
				$lists[] = "";
		}
		$this->showFormTable($lists, "updateadmission", "addlineadmissiont");
	}

	/********************* SAT high  Score ******************************/
	var $SATSCORE_FILENAME = "../public/satscore.inc";
	var $SATSCORE_VARNAME = "SATHIGHSCORE";
	function writeSATScore() 
	{
		writeVariable($this->SATSCORE_FILENAME, $this->SATSCORE_VARNAME,  $this->getVariableListString());
	}
	
	function readSATScore() 
	{
		$lists = readVariable($this->SATSCORE_FILENAME);
		if (!$lists)
			$lists = array();
		return $lists;
	}

	function listSATSCoreTable() {
		$cn = 2;
		if(!empty($_REQUEST['addlinesatscore'])) {
			$addnb = $_POST['actnumber'];
			$addnb = ($addnb + 1) * $cn;

			$lists = $this->getVariableList();
			for ($i = count($lists); $i < $addnb; $i++)
				$lists[] = "";
		}
		else {
			$lists = $this->readSATScore();		
		}
		if (count($lists) > 0) {
			$nb = count($lists) / $cn;
		}
		else {
			$nb = 4;
			for ($i = 0; $i < $nb*$cn; $i++)
				$lists[] = "";
		}
		$this->showFormTable($lists, "updatesatscore", "addlinesatscore");
	}
	
	/********************* PSAT high  Score ******************************/
	var $PSATSCORE_FILENAME = "../public/psatscore.inc";
	var $PSATSCORE_VARNAME = "PSATHIGHSCORE";
	function writePSATScore() 
	{
		writeVariable($this->PSATSCORE_FILENAME, $this->PSATSCORE_VARNAME,  $this->getVariableListString());
	}
	
	function readPSATScore() 
	{
		$lists = readVariable($this->PSATSCORE_FILENAME);
		if (!$lists)
			$lists = array();
		return $lists;
	}

	function listPSATScoreTable() {
		$cn = 2;
		if(!empty($_REQUEST['addlinepsatscore'])) {
			$addnb = $_POST['actnumber'];
			$addnb = ($addnb + 1) * $cn;
			$lists = $this->getVariableList();		
			for ($i = count($lists); $i < $addnb; $i++)
				$lists[] = "";
		}
		else {
			$lists = $this->readPSATScore();		
		}
		if (count($lists) > 0) {
			$nb = count($lists) / $cn;
		}
		else {
			$nb = 4;
			for ($i = 0; $i < $nb*$cn; $i++)
				$lists[] = "";
		}
		$this->showFormTable($lists, "updatepsatscore", "addlinepsatscore");
	}
	
	
	/********************* Congratulation ******************************/
	var $CONGRAT_FILENAME = "../public/congratulation.inc";
	var $CONGRAT_VARNAME = "CONGRAT";
	function writeCongratulation() 
	{
		writeVariable($this->CONGRAT_FILENAME, $this->CONGRAT_VARNAME,  $this->getVariableListString());
	}
	
	function readCongratulation() 
	{
		$lists = readVariable($this->CONGRAT_FILENAME);
		if (!$lists)
			$lists = array();
		return $lists;
	}

	function listCongratulationTable() {
		$cn = 2;
		if(!empty($_REQUEST['addlinecongrat'])) {
			$addnb = $_POST['actnumber'];
			$addnb = ($addnb + 1) * $cn;
			$lists = $this->getVariableList();	
			for ($i = count($lists); $i < $addnb; $i++)
				$lists[] = "";
		}
		else {
			$lists = $this->readCongratulation();		
		}
		if (count($lists) > 0) {
			$nb = count($lists) / $cn;
		}
		else {
			$nb = 4;
			for ($i = 0; $i < $nb*$cn; $i++)
				$lists[] = "";
		}
		$this->showFormTable($lists, "updatecongrat", "addlinecongrat");
	}
	
	
	function getVariableListString() {
		$text 	= "";
		$nb 	= $_POST['actnumber'];
		for ($i = 1; $i <= $nb; $i++) {
			$vschool  	= "school_".$i;
			$vstudent 	= "student_".$i;
			$school 	= $_POST[$vschool];
			$student 	= $_POST[$vstudent];
			if ($school && $student) {
				if ($i == $nb)
					$text .= "\"" .$school. "\", \"" .$student. "\" \n" ;
				else 
					$text .= "\"" .$school. "\", \"" .$student. "\", \n" ;
			}
		}
		
		return $text;
	}
	
	function getVariableList() {
		$lists 	= array();
		$nb 	= $_POST['actnumber'];
		for ($i = 1; $i <= $nb; $i++) {
			$vschool  	= "school_".$i;
			$vstudent 	= "student_".$i;
			$lists[] 	= $_POST[$vschool];
			$lists[] 	= $_POST[$vstudent];
		}
		
		return $lists;
	}
	
function showFormTable($lists, $action, $addaction) {
		$cn = 2;
		$nb = count($lists) / $cn;
?>		
<FORM method=post action='admin.php'>
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='homepagetype'>
<INPUT type=hidden name='actnumber' value='<?php echo($nb); ?>'>
<INPUT type=hidden name='action' value='<?php echo($action); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD height=15></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=25 width='5%'></TD>
					<TD class=ITEMS_LINE_TITLE width='20%'> TITLE </TD>
					<TD class='listtext' width=75%>
						<INPUT type=hidden name='school_1' value=' '>
						<input class='ftitle' type='text' size='85' name='student_1' value='<?php echo($lists[1]); ?>'>
					</TD>
				</TR>
<?php 
		for ($i = 1; $i < $nb; $i++) {
			$n = $i + 1;
			$school 		= $lists[$i*$cn];
			$student 		= $lists[$i*$cn+1];
?>
				<TR>
					<TD class='listnum'><div align=center><?php echo($i); ?></div></TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='25' name='school_<?php echo($n); ?>' value='<?php echo($school); ?>'>
					</TD>
					<TD class='listtext'>
						<input class='fnborder' type='text' size='105' name='student_<?php echo($n); ?>' value='<?php echo($student); ?>'>
					</TD>
				</TR>
<?php 
		}
?>
				</TABLE>
			</TD>
		</TR>

		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=30 width=50% class=formlabel>
						<div align=right>
						<INPUT class=button type=submit name="<?php echo($action); ?>" value=' Update '>
						</div>
					</TD>
					<TD height=30 class=formlabel width=50%>
						<div align=left>&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name="<?php echo($addaction); ?>" VALUE=' Add Line  '>
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