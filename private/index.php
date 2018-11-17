<?php
include "../php/allinclude.php";
session_start();



$action 	= isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$studentid 	= isset($_GET["studentid"]) ? $_GET["studentid"] : (isset($_POST["studentid"]) ? $_POST["studentid"] : 0);
$subjects 	= isset($_GET["subjects"]) ? $_GET["subjects"] : (isset($_POST["subjects"]) ? $_POST["subjects"] : "");
$teacher 	= isset($_GET["teacher"]) ? $_GET["teacher"] : (isset($_POST["teacher"]) ? $_POST["teacher"] : "");
$dates 		= isset($_GET["dates"]) ? $_GET["dates"] : (isset($_POST["dates"]) ? $_POST["dates"] : "");
$startdate	= isset($_GET["startdate"]) ? $_GET["startdate"] : (isset($_POST["startdate"]) ? $_POST["startdate"] : "");

$err = '';
$student = '';

if (isset($_SESSION['log_user_id'])) {
	$studentid = $_SESSION['log_user_id'];
	$student = new StudentClass();
	if (!$student->getUserByID($studentid)) {
		$student = "";
	}
}

$sessionform = new PrivateForm();

if ($action == "updateasksession") {
	if(empty($_REQUEST['refresh']))   {
		$err = $sessionform->updateStudentWeekPrivateSesstions();
	}
}



include "../php/header.php";
?>
<script language="JavaScript" type="text/javascript"> 
function loadSession(url, value) 
{ 
	window.open(url+'&dates='+value,'_self');
} 
</script> 



<TABLE width=950 cellspacing=0 cellpadding=0 align=center>
<TR>
	<TD valign=top>
		<table width=100% height=550 cellspacing=0 cellpadding=0 align=center>
		<tr>
			<td width=200 valign=top class=ITEMS_BG><?php include "../private/indexleft.php"; ?></td>
			<td width=750 valign=top>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0  align=center>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  align=center>
						<TR>
							<TD class=formlabel>
							<?php  
								getStudentWeekSessionBar($studentid, $teacher, $subjects, $dates, $startdate);
							?>
							</TD>
						</TR>
						<TR>
							<TD>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center> 
								
								<TR>
									<TD class=error> <?php echo($err); ?> </TD>
								</TR>
								<TR>
									<TD width=100%>
									<?php 
									if ($sessionform) {
										$sessionform->showTeacherPrivateSessionForStudent($teacher, $subjects, $startdate, $studentid);
									}
									?>
									</TD>
								</TR>
								</TABLE>	
							</TD>
						</TR>
						</TABLE>
					</td>
				</TR>
				</TABLE>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<?php 
include "../php/footer.php";
?>

