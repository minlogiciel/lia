<?php
class AdmissionForm {

function getAdmissionList() {
	$lists 	= array();
	$title0 	= getPostValue("title_0");
	$title1 	= getPostValue("title_1");
	if (!$title0)
		$title0 = $title1;
	if (!$title1)
		$title1 = $title0;
		
	$lists[] 	= $title0;
	$lists[] 	= $title1;
	
	$nb 	= $_POST['actnumber'];
	for ($i = 1; $i < $nb; $i++) {
		$vschool  	= "school_".$i;
		$vstudent 	= "student_".$i;
		$school = getPostValue($vschool);
		$student =  getPostValue($vstudent);
		if (trim($school) && trim($student)) {
			$lists[] 	= $school;
			$lists[] 	= $student;
		}
	}

	return $lists;
}

function getAdmissionListString($lists) {
	$text 	= "";
	for ($i = 0; $i < count($lists); $i+=2) {
		$school  	= $lists[$i];
		$student  	= $lists[$i+1];
		if ($school || $student) {
			$text .= "\"" .$school. "\", \"" .$student. "\", \n" ;
		}
	}
	
	return $text;
}

function WriteIncludeFile($key, $varname) {
	global $ADMISSION_VAR_NAME;
	$text = "";
	$found = 0;

	$filename = "../public/admission.inc";
	$lines = file($filename);
	foreach ($lines as $line_num => $line) {
		if (strstr($line, "ADMISSION_VAR") || strstr($line, "?>") || !$line) {
			
		}
		else {
			if (strstr($line, $key)) {
				$found = 1;
			}
			else {
				$text .= $line;
			}
			if (strstr($line, "<?php")) {
	    		$text .= "include_once(\"" .$key. "\");\n";
	    	}
		}
	}

	$text .= "\$ADMISSION_VAR = array("; 
	$text .= "\$" .$varname. ", ";
	for ($i = 0; $i < count($ADMISSION_VAR_NAME); $i++) {
		if ($ADMISSION_VAR_NAME[$i] == $varname) {
			$found++;
		}
		else {
			$text .= "\$" .$ADMISSION_VAR_NAME[$i]. ", ";
		}
	}
	$text .= ");\n\n";
		
	$text .= "\$ADMISSION_VAR_NAME = array("; 
	$text .= "\"" .$varname. "\", ";
	for ($i = 0; $i < count($ADMISSION_VAR_NAME); $i++) {
		if ($ADMISSION_VAR_NAME[$i] == $varname) {
			$found++;
		}
		else {
			$text .= "\"" .$ADMISSION_VAR_NAME[$i]. "\", ";
		}
	}
	$text .= ");\n\n?>\n";
	if ($found < 3) {
		$fp = fopen($filename, "w");
		fwrite($fp, $text);
		fclose($fp);
	}
	return $found;
}



function writeAdmission() 
{
	global $ADMISSION_VAR_NAME;
	$path = "../public/";
	$nb = count($ADMISSION_VAR_NAME);
	$nindex 	= getPostValue("nindex");

	$title 	= getPostValue("title_0");
	$title1 	= getPostValue("title_1");
	if (!$title) {
		$title 	= $title1;
	}
	if  (!$title1) {
		$title1 = $title;
	}
	
	if ($nindex > 0 && $nindex <= $nb) {
		$varname = $ADMISSION_VAR_NAME[$nindex -1];
		$varfile = "admission/".strtolower($varname).".inc";
	}
	else {
		$varname = "ADMI".date("Y")."_".$nb;
		$varfile = "admission/".strtolower($varname).".inc";
	}
	$ll = $this->getAdmissionList();
	if ($title) {
		writeVariable($path.$varfile, $varname,  $this->getAdmissionListString($ll));
	
		$this->WriteIncludeFile($varfile, $varname);
	}
	
	return $ll;
	
}

function ShowAdmissionTable1($nindex, $result, $ll) {
	global $ADMISSION_VAR;
	
	if ($ll) {
		$lists = $ll;
	}
	else {
		if ($nindex > 0) {
			$lists = $ADMISSION_VAR[$nindex - 1];
		}
		else {
			for ($i = 0; $i < 8; $i++) {
				$lists[] = "";
			}
		}
	}
	$cn = 2;
	if(!empty($_REQUEST['addnewline'])) {
		$addnb = $_POST['actnumber'];
		$addnb = ($addnb + 1) * $cn;
		$lists = $this->getAdmissionList();
		for ($i = count($lists); $i < $addnb; $i++)
			$lists[] = "";
	}
	if (count($lists) > 0) {
		$nb = count($lists) / $cn;
	}
	else {
		$nb = 4;
		for ($i = 0; $i < $nb*$cn; $i++)
			$lists[] = "";
	}
	?>

<FORM method=post action='admin.php'>
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='admissiontype'>
<INPUT type=hidden name='actnumber' value='<?php echo($nb); ?>'>
<INPUT type=hidden name='action' value='updateadmission'>
<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php  if ($ll) { ?>
		<TR><TD height=50 class=listtext> </TD></TR>
		<TR>
			<TD height=50>
				<font color=red size=3><b>
<?php 			if ($nindex < 0) {
					echo($ll[1]. " has been added."); 
				}
				else {
					echo($ll[1]. " has been modify.");
				} 
?>
				</b></font>
			</TD>	
		</TR>
		<TR><TD height=20></TD></TR>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center class=registerborder>
<?php 
		for ($i = 1; $i < $nb; $i++) {
			$school 		= $lists[$i*$cn];
			$student 		= $lists[$i*$cn+1];
?>
				<TR>
					<TD class='listtext' width=5% height=25><div align=center><?php echo($i); ?>. </div></TD>
					<TD class='listtext' width=20%>
						<?php echo($school); ?> :
					</TD>
					<TD class='listtext' width=75%>
						<?php echo($student); ?>
					</TD>
				</TR>
<?php 	} ?>
				</TABLE>
			</TD>
		</TR>
		
		<TR>
			<TD height=50 class=listtext><div align=center>
				<A href="../admin/admin.php?actiontype=homepagetype">Go to modify Home Page Items</A></div>
			</TD>
		</TR>
<?php } else { ?>
		<TR><TD height=30 class=error><?php echo($result); ?></TD></TR>
		<TR><TD height=50><font color=red size=3><b>Congratulations and College Admission</b></font></TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width='20%'> TITLE : </TD>
					<TD class='listtext' width=80%>
						<input type='text' size='70' name='title_1' value='<?php echo($lists[1]); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright width='20%'> SUBTITLE : </TD>
					<TD class='listtext' width=80%>
						<input type='text' size='70' name='title_0' value='<?php echo($lists[0]); ?>'>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=20></TD></TR>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder>
				<TR>
					<TD class='ITEMS_LINE_TITLE' width=3% height=30><div align=center></div></TD>
					<TD class='ITEMS_LINE_TITLE' width=20%> University
					</TD>
					<TD class='ITEMS_LINE_TITLE' width=75%> Students
					</TD>
				</TR>
				
<?php 
		for ($i = 1; $i < $nb; $i++) {
			$school 		= $lists[$i*$cn];
			$student 		= $lists[$i*$cn+1];
?>
				<TR>
					<TD class='listnum' width=3% height=25><div align=center><?php echo($i); ?></div></TD>
					<TD class='listtext' width=20%>
						<input type='text' size='18' name='school_<?php echo($i); ?>' value='<?php echo($school); ?>'>
					</TD>
					<TD class='listtext' width=77%>
						<input type='text' size='80' name='student_<?php echo($i); ?>' value='<?php echo($student); ?>'>
					</TD>
				</TR>
<?php 	} ?>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=25>&nbsp;</TD></TR>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=30 width=50% class=formlabel>
						<div align=right>
					<?php if ($nindex > 0) { ?>
						<INPUT class=button type=submit name="<?php echo($action); ?>" value=' Update Admission '>
					<?php } else { ?>
						<INPUT class=button type=submit name="<?php echo($action); ?>" value=' Add Admission '>
					<?php } ?>
						</div>
					</TD>
					<TD height=30 class=formlabel width=50%>
						<div align=left>&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name="addnewline" VALUE=' New Line  '>
						</div>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
<?php } ?>
		<TR><TD height=15>&nbsp;</TD></TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
<?php 
}

function ShowAdmissionTable($nindex, $result, $ll) {
	global $ADMISSION_VAR;
	
	if ($ll) {
		$lists = $ll;
	}
	else {
		if ($nindex > 0) {
			$lists = $ADMISSION_VAR[$nindex - 1];
		}
		else {
			for ($i = 0; $i < 8; $i++) {
				$lists[] = "";
			}
		}
	}
	$cn = 2;
	if(!empty($_REQUEST['addnewline'])) {
		$addnb = $_POST['actnumber'];
		$addnb = ($addnb + 1) * $cn;
		$lists = $this->getAdmissionList();
		for ($i = count($lists); $i < $addnb; $i++)
			$lists[] = "";
	}
	if (count($lists) > 0) {
		$nb = count($lists) / $cn;
	}
	else {
		$nb = 4;
		for ($i = 0; $i < $nb*$cn; $i++)
			$lists[] = "";
	}
	$action ="toto";
	echo("<FORM id='formAdmission' method='post' action='admin.php'>");
	echo("<INPUT type='hidden' name='actiontype' VALUE='admissiontype'>");
	echo("<INPUT type='hidden' name='actnumber' value='".$nb."'>");
	echo("<INPUT type='hidden' name='action' value='updateadmission'>");
	echo("<INPUT type='hidden' name='nindex' value='".$nindex."'>");

if ($ll) {
	echo("<font color=red size=3><b>");
	if ($nindex < 0) {
		echo($ll[1]. " has been added."); 
	}
	else {
		echo($ll[1]. " has been modify.");
	} 
	echo("</b></font>");
	for ($i = 1; $i < $nb; $i++) {
		$school 		= $lists[$i*$cn];
		$student 		= $lists[$i*$cn+1];
		echo("<label> " .$i. " " .$school. " : </label>");
		echo("<label> " .$student. " : </label>");
	} 
	echo("<div><A href='../admin/admin.php?actiontype=homepagetype'>Go to modify Home Page Items</A></div>");
} else {
	echo("<div class=error>" .$result. "</div>");
	echo("<div class=title>Congratulations and College Admission</div>");
	echo("<label> TITLE : </label>");
	echo("<input type='text' name='title_1' value='" .$lists[1]. "'>");
	echo("<label> SUBTITLE : </label>");
	echo("<input type='text' name='title_0' value='".$lists[0]. "'>");
	echo("<label> University </label>");
	echo("<label> Students </label>");
	for ($i = 1; $i < $nb; $i++) {
		$school 		= $lists[$i*$cn];
		$student 		= $lists[$i*$cn+1];
		echo("<label> " .$i. "</label>");
		echo("<input type='text' size='18' name='school_" .$i. "' value='" .$school. "'>");
		echo("<input type='text' size='80' name='student_" .$i. "' value='" .$student."'>");
	} 
	if ($nindex > 0) { 
		echo("<INPUT class=button type=submit name='".$action."' value='Update Admission'>");
	} else { 
		echo("<INPUT class=button type=submit name='".$action."' value='Add Admission'>");
	}
	echo("<INPUT class=button TYPE='submit' name='addnewline' VALUE='New Line'>");
}

echo("</FORM>");
}

}

?>