<?php 
class TestForm {

function getVariableName($i) {
	return ("option_" .$i);
}

function getResults($Questions) 
{
	$ST=array("", "A","B","C","D","E","F","G");
	$resp = array();
	$nb = count($Questions);
	for ($i = 0; $i < $nb; $i++) {
		$var = $this->getVariableName($i);
		$r = isset($_POST[$var]) ? $_POST[$var] : -1;
		$Q = $Questions[$i];
		$cn = count($Q)-1;
		$arr = array();
		$arr[0] = $r;
		$arr[1] = $Q[$cn-1];
		if (($Q[$cn] == $ST[intval($r)]) || ($Q[$cn] == $r))
			$arr[2] = 1;
		else 
			$arr[2] = 0; 
		$resp[$i] = $arr;
	}
	return $resp;
}

function showQuestionAndResponse($question, $subject) {
	if ($subject == 2) {
		echo(mathfilter($question, 12,"../phpmath/img/"));
	}
	else {
		echo($question);
	}
}

function QuestionForm($Questions, $Results, $testlevel, $subject, $courses) {
?>					    

<FORM action="../subject/test.php" method=post>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD>
 		<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
<?php 
		for ($i = 0; $i < count($Questions); $i++) { 
			$Q = $Questions[$i];
			$cn = count($Q)-1;
?>
		<TR>
			<TD height=20 class=formlabel >
				<div align=left>&nbsp;&nbsp; <?php $this->showQuestionAndResponse($Q[0], $subject); ?></div>
			</TD>
		</TR>
		
<?php 
		for ($j = 1; $j < $cn; $j++) {
?>
		<TR>
			<TD class=formlabel>
				<div align=left>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
			if ($Results) {
				$arr = $Results[$i];
				if ($arr[0] == $j) { ?>
					<input type='radio' name="<?php echo($this->getVariableName($i)); ?>" value="<?php echo($j); ?>" checked>&nbsp;&nbsp;
<?php  				if ($arr[2] != 1) { ?>
						<font color=red><?php $this->showQuestionAndResponse($Q[$j], $subject); ?></font>
<?php 				} else { ?>
						<font color=green><?php $this->showQuestionAndResponse($Q[$j], $subject); ?></font>
<?php  				} 
				} else { ?>
					<input type='radio' name="<?php echo($this->getVariableName($i)); ?>" value="<?php echo($j); ?>">&nbsp;&nbsp;
		 				<font color=black><?php echo($Q[$j]); ?></font>
<?php 
				}
			}
			else { ?>
				<input type='radio' name="<?php echo($this->getVariableName($i)); ?>" value="<?php echo($j); ?>">&nbsp;&nbsp;
		 		<font color=black><?php $this->showQuestionAndResponse($Q[$j], $subject); ?></font>
<?php 
			}
?>
				</div>
			</TD>
		</TR>
<?php 
			}
?>
		<TR><TD height=15 width=100% class=formlabel></TD></TR>
<?php 
		}
?>
		</TABLE>
    </TD>
</TR>
<TR>
	<TD class=formlabel>
	<?php if (count($Questions) > 0){?>
    	<DIV align=center>
    		<INPUT type=hidden name="action" value="getresult"> 
    		<INPUT type=hidden name="testlevel" value="<?php echo($testlevel);?>"> 
    		<INPUT type=hidden name="subject" value="<?php echo($subject);?>"> 
    		<INPUT type=hidden name="courses" value="<?php echo($courses);?>"> 
    		<INPUT class=button type=submit value="Get Result">
    	</DIV>
    <?php } ?>
    </TD>
    </TR>
</TABLE>
</FORM>

<?php }
}
?>
