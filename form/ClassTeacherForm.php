<?php
class ClassTeacherForm {

var $_FILENAME = "../public/classvar.php";
var $_VARNAME  = "CLASS_TEACHER";
var $_JSFILENAME = "../scripts/classvar.js";
var $_JSVARNAME  = "CLASS_TEACHER_NAME";
var $NB_TEACHER_ADD = 5;
	
function getClassTeacherArray() {
	global $CLASS_TEACHER;

	$lists = array();

	$nb = $_POST["nbteacher"] + $this->NB_TEACHER_ADD;
	
	$tuto = array("TUTO", "", "", "12");
	$n = 1;
	$n_class = 0;
	for ($i = 0; $i < $nb; $i++) {
		$venglish 	= "english_".$n;
		$vmath 		= "math_".$n;
		$vclasses 	= "classes_".$n;
		$vgrade 	= "grade_".$n;
		
		$grade 		= $_POST[$vgrade];
		$classes 	= $_POST[$vclasses];
		$english 	= $_POST[$venglish];
		$math 		= $_POST[$vmath];
		$classes 	= trim($classes);
		$math 		= replace($math);
		$english 	= replace($english);
		if ($classes && ($classes != "TUTO")) {
			$ll = array();
			$ll[]	= $classes;
			$ll[] 	= $english;
			$ll[] 	= $math;
			$ll[]	= $grade;
			$lists[] = $ll;
			$n_class++;
		}
		$n++;
	}
	for ($i = 0; $i < ($n_class-2); $i++) {
		for ($j = 0; $j < ($n_class-1); $j++) {
			if ($lists[$j][3] > $lists[$j+1][3]) {
				$l = $lists[$j];
				$lists[$j] = $lists[$j+1];
				$lists[$j+1] = $l;
			}
		}
	}
	$lists[] = $tuto;
	return $lists;
}

function getClassTeacherNameString($lists) 
{
	$text = "" ;
	$tuto;	
	$nb = count($lists);
	for ($i = 0; $i < $nb; $i++) {
		$classes 		= $lists[$i][0];
		if ($classes == "TUTO") {
			$tuto = $lists[$i];
		}
		else {
			$english 	= $lists[$i][1];
			$math 		= $lists[$i][2];
			$grade 		= $lists[$i][3];
			$text .= "\tarray(\"" .$classes. "\", \"" .$english. "\", \"" .$math. "\", " .$grade. "),\n" ;
		}
	}
	
	$classes 	= $tuto[0];
	$english 	= $tuto[1];
	$math 		= $tuto[2];
	$grade 		= $tuto[3];
	$text .= "\tarray(\"" .$classes. "\", \"" .$english. "\", \"" .$math. "\", \"" .$grade. "\")\n" ;
	return $text;
}

function getClassNameString($lists) 
{
	$text = "" ;
	$tuto;	
	$nb = count($lists);
	for ($i = 0; $i < $nb; $i++) {
		$classes 		= $lists[$i][0];
		if ($classes == "TUTO") {
			$tuto = $lists[$i];
		}
		else {
			$grade 		= $lists[$i][3];
			$text .= "\t\"" .$classes. "\", \"" .$grade. "\",\n" ;
		}
	}
	
	$classes 	= $tuto[0];
	$grade 		= $tuto[3];
	$text .= "\t\"" .$classes. "\", \"" .$grade. "\"\n" ;
	return $text;
}

function writeTeacher() 
{
	
	
	$lists = $this->getClassTeacherArray();

	$str =  $this->getClassTeacherNameString($lists);

	/* write javascript variable */
	$jsstr = str_replace("array(", "[", $str);
	$jsstr = str_replace(")", "]", $jsstr);
	$text = "var CLASS_TEACHER_NAME = [\n" . $jsstr. "];\n";
	$fp = fopen($this->_JSFILENAME, "w");
	fwrite($fp, $text);
	fclose($fp);
	

	$text  = "<?php\n";
	$text .= "\$CLASS_TEACHER = array(\n" .$str. ");\n\n\n";
	
	$str =  $this->getClassNameString($lists);
	$text .= "\$CLASS_NAME = array(\n" .$str. ");\n\n";
	
	$text .="?>\n\n";

	$fp = fopen($this->_FILENAME, "w");
	fwrite($fp, $text);
	fclose($fp);
	

	return $lists;
	
}

function showClassTeacherTable($clteacher, $result, $url='') 
{
	global $CLASS_TEACHER;
	if ($clteacher) {
		$tab = $clteacher;
	}
	else {
		$tab = $CLASS_TEACHER;
	}
	$nb = count($tab);
	if ($url) {
		$action = $url;
	}
	else {
		$action = "admin.php";
	}
?>

<FORM method=post action='<?php echo($action); ?>'>
<INPUT NAME='actiontype' TYPE=HIDDEN VALUE='classteacher'>
<INPUT type=hidden name='action' value='updateclassteacher'>
<INPUT type=hidden name='nbteacher' value='<?php echo($nb); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD height=30 class=error><?php echo($result); ?></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=30></TD></TR>
		<TR><TD height=30><H2><font color=red>Change Class Name and Teachers</font></H2></TD></TR>
		<TR><TD height=30><H4>(Removing class name will delete this class)</H4></TD></TR>
		<TR><TD height=30><H4>(Order class by grade number)</H4></TD></TR>
		<TR><TD height=30></TD></TR>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=25 width='4%'></TD>
					<TD class=ITEMS_LINE_TITLE width='20%'> Class </TD>
					<TD class=ITEMS_LINE_TITLE width='8%'> Grade </TD>
					<TD class=ITEMS_LINE_TITLE width='30%'> English Teacher </TD>
					<TD class=ITEMS_LINE_TITLE width='30%'> Math Teacher</TD>
				</TR>
		<?php 
				$n = 0;
				for ($i = 0; $i < ($nb+$this->NB_TEACHER_ADD); $i++) {
					if ($i < $nb) {
						$elem = $tab[$i];
						$classes 	= $elem[0];
						$english	= $elem[1];
						$math 		= $elem[2];
						$grade 		= $elem[3];
					}
					else {
						$classes 	= "";
						$grade 		= 2;
						$english 	= "";
						$math 		= "";
					}
					$n++;
				?>
				<TR>
					<TD class='listnum'><div align=center><?php echo($n); ?></div></TD>
					<TD class='listtext'>
						<div align=center>
						<input class='fnborder' type='text' size='20' name="classes_<?php echo($n); ?>" value="<?php echo($classes); ?>">
						</div>
					</TD>
					<TD class='listtext'>
						<select STYLE='width: 50; align: center' name="grade_<?php echo($n); ?>">
						<?php
						for ($j = 2; $j < 13; $j++) {
							if ($j == $grade) {
								echo ("<option value=". $j ." selected>" .$j . "</option>");
							}
							else {
								echo ("<option value=". $j .">" .$j . "</option>");
							}
						}
						?>
						</select> 
					</TD>
					<TD class='listtext'><div align=center>
						<input class='fnborder' type='text' size='30' name="english_<?php echo($n); ?>" value="<?php echo($english); ?>">
						</div>
					</TD>
					<TD class='listtext'><div align=center>
						<input class='fnborder' type='text' size='30' name="math_<?php echo($n); ?>" value="<?php echo($math); ?>">
						</div>
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
					<TD height=30 width=50% class=formlabel colspan=2>
						<div align=center>
						<INPUT class=button type=submit name="updateclassteacher" value=' Update Teachers '>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name="reset" VALUE=' Reset '>
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