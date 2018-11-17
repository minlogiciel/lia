<?php 
include "../php/allinclude.php";
session_start();

$subj_id = isset($_POST["subject"]) ? $_POST["subject"] : (isset($_GET["subject"]) ? $_GET["subject"] : 2);
$cour_id = isset($_POST["courses"]) ? $_POST["courses"] : (isset($_GET["courses"]) ? $_GET["courses"] : 0);

$testlevel  = isset($_POST["testlevel"]) ? $_POST["testlevel"] : (isset($_GET["testlevel"]) ? $_GET["testlevel"] : 1);
$action = isset($_POST["action"]) ? $_POST["action"] : (isset($_GET["action"]) ? $_GET["action"] : "");

$SUBJ_COURSES = $SUBJECTS_LIST[$cour_id];

$Questions = array();
$Results = '';

$testform = new TestForm();


$lfc = new LiaFileClass();
if ($subj_id == 2) {
	$files = $lfc->getPublicTextFileList("math", $subj_id);
}
else {
	$files = $lfc->getPublicTextFileList("test", $subj_id);
}
$nfile = count($files);
if ($nfile > 0) {
	if (($testlevel > 0) && ($testlevel <= $nfile)) {
		$fname = $files[$testlevel];
		if ($fname && strlen($fname) > 1) {
			$Questions = $lfc->getTestFileQuestions($fname);
			if ($action == "getresult") {
				$Results = $testform->getResults($Questions);
			}
		}
	}
}


include "../php/header.php"; 

?>
<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td width=200 valign=top class=ITEMS_BG> <?php include "../subject/courseleft.php" ?> </td>
	<td width=750 valign=top>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR vAlign=top>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD class=PAGE_TITLE width=50% height=25>
								&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($SUBJ_COURSES[$subj_id]); ?>
							</TD>
							<TD class=PAGE_TITLE width=50% height=25>
								<div align=right><font color=green> Level : </font> 
								<?php 
								for ($i = 1; $i < 11; $i++) {
									if ($i == $testlevel) {
										echo("&nbsp;" .$i);
									}
									else {
										echo("&nbsp;<a href='" .$SUBJ_COURSES[1]. "?subject=" .$subj_id. "&courses=" .$cour_id."&testlevel=".$i. "'>" .$i. "</a>");
									}
								}
								?>
								&nbsp;&nbsp;&nbsp;&nbsp;</div>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				<TR>
					<TD>
						<?php $testform->QuestionForm($Questions, $Results, $testlevel, $subj_id, $cour_id); ?>
					</TD>
				</TR>
				</TABLE>
		  	</TD>
		</TR>
		</TABLE>
	</TD>
</TR>		
</table>
<?php 
include "../php/footer.php"; 
?>
