<?php
include "../php/allinclude.php";
session_start();


$remoteip = $_SERVER['REMOTE_ADDR'];
if (isAdminAllowed($remoteip))
{

$action 	= isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$subjects 	= isset($_GET["subjects"]) ? $_GET["subjects"] : (isset($_POST["subjects"]) ? $_POST["subjects"] : "");
$teacher 	= isset($_GET["teacher"]) ? $_GET["teacher"] : (isset($_POST["teacher"]) ? $_POST["teacher"] : "");
$dates 		= isset($_GET["dates"]) ? $_GET["dates"] : (isset($_POST["dates"]) ? $_POST["dates"] : "");
$startdate	= isset($_GET["startdate"]) ? $_GET["startdate"] : (isset($_POST["startdate"]) ? $_POST["startdate"] : "");
$changeweek	= isset($_GET["changeweek"]) ? $_GET["changeweek"] : (isset($_POST["changeweek"]) ? $_POST["changeweek"] : 0);
$beginweek	= isset($_GET["beginweek"]) ? $_GET["beginweek"] : (isset($_POST["beginweek"]) ? $_POST["beginweek"] : "");

$err = "";

$show_teacher = 0;
$sessionform = new PrivateForm();
if (($action=="teachersession") || ($action=="updatesession")) {
	$show_teacher =1;
}

if ($action == "updatesession") {
	if(empty($_REQUEST['refresh']))   {
		$err = $sessionform->updateTeacherWeekPrivateSesstions();
		$startdate 	= getPostValue("dates_0");	
	}
}

else if ($action == "updatesessiontable") {
	if(empty($_REQUEST['refresh']))   {
		$err = $sessionform->updatPrivateSesstionTable();
	}
}


include "../private/privateheader.php";
?>
<script language="JavaScript" type="text/javascript"> 
function setSessionDate(url, value) 
{ 
	window.open(url+'&dates='+value,'_self');
} 
</script> 



<TABLE width=950 cellspacing=0 cellpadding=0 align=center>
<TR>
	<TD valign=top>
		<table width=100% height=550 cellspacing=0 cellpadding=0 align=center>
		<tr>
			<td width=180 valign=top class=ITEMS_BG><?php include "../private/privateleft.php"; ?></td>
			<td width=770 valign=top>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0  align=center>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  align=center>
						<TR>
							<TD class=formlabel>
							<?php  
								if ($show_teacher) {
									getTeacherWeekSessionBar($teacher, $dates, $startdate);
								} 
								else {
									getWeekBar($teacher, $dates, $startdate, $beginweek, $changeweek);
								}
							?>
							</TD>
						</TR>
						<TR>
							<TD>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
								<TR>
									<TD valign=top>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
										<?php if ($err) { ?>
										<TR>
											<TD class=error height=30><?php echo($err); ?> </TD>
										</TR>
										<?php } ?>
										<TR>
											<TD width=100%>
										<?php 
											if ($show_teacher) {
												if (!$startdate)
													$startdate = $dates;
												$sessionform->showTeacherWeekPrivateSession($teacher, $subjects, $startdate);
											} 
											else {
												$sessionform->listWeekPrivateSessionTable($startdate);
											}
											?>
											</TD>
										</TR>
										<TR><TD height=10></TD></TR>
										
										</TABLE>
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

}
else {
include "../php/header.php"; 
?>
<table  width=100% height=500 cellspacing=0 cellpadding=0 align=center>
<tr>
	<td width=100% valign=middle>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR>
			<TD>
				<IMG SRC=../images/Picture_020-758x300.jpg height=300>
			</TD>
		</TR>
		</TABLE>
	</td>

</TR>		
</table>
<?php 
}
include "../php/footer.php";
?>

