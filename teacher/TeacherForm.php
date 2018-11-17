<?php
class TeacherForm {

	var $SHIRT_SUBJECT = array("ENG", "MATH", "HIS", "BIO", "CHM", "PHY", "ES", "ECO", "SPA");
	var $LOGIN_PRE = "LIATEACHER"; 		// LIATEACHER + FL
	var $PASSWORD_PRE = "LIA"; 			// FL+LIA+SUB
	
function updateTeacherBase() {
	$memList = new MemberList();
	$teacherclass = new TeacherClass();
	if ($teacherclass->findTeacher(10)) {
		if (!$teacherclass->getLogin()) {
			$tlists = $memList->getTeacherLists(1);
			for ($i = 0; $i < count($tlists); $i++) {
				$tlists[$i]->updateTeacherBase();
			}
		}
	}
}
	
function getAvailableTimes() {
	$timelists = array();
	$teacher	= getPostValue('teacher');
	$dates = array();
	for ($cn = 0; $cn < 7; $cn++) {
		$var = "dates_".$cn;
		$dates[$cn] = getPostValue($var);
	}
	
	$nb = getPostValue('linenb');
	for ($cn = 0; $cn < 7; $cn++) {
		$lists = array();
		for ($i = 0; $i < $nb; $i++) {
			$beginning = getHoureMinute("start_".$i, $cn);
			$ending = getHoureMinute("end_".$i, $cn);
			
			$seplist = '';
			if ($beginning && $ending) {
				list($sh, $sm) = explode(":", $beginning);
				list($eh, $em) = explode(":", $ending);
				$diff = $eh - $sh;
				if (($diff < 2 ) || ($diff == 2) && ($em < $sm)) {

				}
				else {
					$backending = $ending;
					$sh++;
					$ending = $sh. ":" .$sm;

					$seplist = array();
					$diff = $eh - $sh;
					while ($diff > 0) {
						$seplist[] = $sh.":".$sm;
						$sh++;
						if (($diff == 1) || ($diff == 2) && ($em < $sm))  {
							$diff = 0;
							$seplist[] = $backending;
						}
						else {
							$seplist[] = $sh.":".$sm;
							$diff = $eh - $sh;
						}
					}
				}
			}
			$var = "sessionid_".$i.$cn;
			$sessionid = getPostValue($var);
			
			$psession = new PSessionClass();
			if ($sessionid && $psession->getSessionByID($sessionid)) {
				$psession->setBeginning($beginning);
				$psession->setEnding($ending);
				$lists[] = $psession;
			}
			else if ($beginning && $ending) {
				$psession->setTeacher($teacher);
				$psession->setDates($dates[$cn]);
				$psession->setBeginning($beginning);
				$psession->setEnding($ending);
				$lists[] = $psession;
			}
			if ($seplist) {
				for ($nn = 0; $nn < count($seplist); $nn +=2) {
					$psession = new PSessionClass();
					$psession->setTeacher($teacher);
					$psession->setDates($dates[$cn]);
					$psession->setBeginning($seplist[$nn]);
					$psession->setEnding($seplist[$nn+1]);
					$lists[] = $psession;
				}
			}
		}
		$timelists[$cn] = $lists;
	}
	
	return $timelists;
}
function updateAvailableTime() {
	$timelists = $this->getAvailableTimes();
	for ($cn = 0; $cn < 7; $cn++) {
		$lists = $timelists[$cn];
		for ($i = 0; $i < count($lists); $i++) {
			$psession = $lists[$i];
			if ($psession->getID() > 0) {
				$psession->updateSession();
			}
			else {
				$psession->addSession();
			}
		}	
	}
}


function listWeekTeacherAvailableTable($teacher, $startdate) {
	$LINE_NB = 6;
	$wdays = getWeekDates($startdate);

	$privateList = new PrivateList();

	
	$sessionlists = $privateList->getTeacherWeekPrivateSessions($teacher, $wdays);

	$start_cn = 0;
	
?>

<FORM action='index.php' method=post>
<INPUT NAME='action' TYPE=HIDDEN VALUE='updateteacheravailable'>
<INPUT TYPE='HIDDEN' NAME='linenb'  VALUE='<?php echo($LINE_NB); ?>'>
<INPUT type='HIDDEN' name="startdate" value="<?php echo($startdate); ?>">
<INPUT type='HIDDEN' name="teacher" value="<?php echo($teacher); ?>">
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD height=25 colspan=6 class=TABLE_FTITLE>
				<div align=center><font color=blue size=2><?php echo($teacher); ?> INPUT YOUR AVAILABLE TIMES FOR PRIVATE LESSON</font></div>
			</TD>
		</TR>

		<TR>
			<TD height=20 colspan=3 class=ITEMS_LINE_TITLE width='50%'>
				<?php $cn = $start_cn; echo(getDisplayDate($wdays[$cn]). " (" .getWeekday($cn+1).")"); ?>
				<input type='HIDDEN' name="dates_<?php echo($cn); ?>" value="<?php echo($wdays[$cn]); ?>">
			</TD>

			<TD colspan=3  class=ITEMS_LINE_TITLE width='50%'>
				<?php $cn++; echo(getDisplayDate($wdays[$cn]). " (" .getWeekday($cn+1).")"); ?>
				<input type='HIDDEN' name="dates_<?php echo($cn); ?>" value="<?php echo($wdays[$cn]); ?>">
			</TD>
		</TR>
		<TR>
			<TD height=20 class='SESSION-TITLE' width=16%>BEGINNING</TD>
			<TD  class='SESSION-TITLE'  width=16%>ENDING</TD>
			<TD  class='SESSION-TITLE'  width=18%>STUDENT</TD>
			<TD height=20 class='SESSION-TITLE' width=16%>BEGINNING</TD>
			<TD  class='SESSION-TITLE'  width=16%>ENDING</TD>
			<TD  class='SESSION-TITLE'  width=18%>STUDENT</TD>
		</TR>
<?php 
	for ($i = 0; $i < $LINE_NB; $i++) { ?>
		<TR>
<?php 	for ($cn = $start_cn; $cn < ($start_cn+2); $cn++) {
			$slists = $sessionlists[$cn];
			$starttime = "";
			$endtime = "";
			$sessionid = 0;
			$request = "";
			if (count($slists) > $i) {
				$starttime 	= $slists[$i]->getBeginning();
				$endtime 	= $slists[$i]->getEnding();
				$sessionid 	= $slists[$i]->getID();
				$request 	= $slists[$i]->getRequest();
			}
?>
			<TD height=20 class='listtext'>
				<div align=center>
				<?php HoureMinuteForm($starttime, ("start_".$i), $cn); ?>
				</div>
			</TD>
			<TD  class='listtext'>
				<div align=center>
				<?php HoureMinuteForm($endtime, ("end_".$i), $cn); ?>
				</div>
			</TD>
			<TD  class='listtext'>
				<div align=center>
				<input type='HIDDEN' name="sessionid_<?php echo($i); ?><?php echo($cn); ?>" value="<?php echo($sessionid); ?>">
				<?php echo($request); ?>
				</div>
			</TD>
<?php 	} ?>
		</TR>
<?php } 
	$start_cn = 2;
?>
		<TR>
			<TD height=20 colspan=3 class=ITEMS_LINE_TITLE>
				<?php $cn=$start_cn; echo(getDisplayDate($wdays[$cn]). " (" .getWeekday($cn+1).")"); ?>
				<input type='HIDDEN' name="dates_<?php echo($cn); ?>" value="<?php echo($wdays[$cn]); ?>">
			</TD>

			<TD colspan=3  class=ITEMS_LINE_TITLE>
				<?php $cn++; echo(getDisplayDate($wdays[$cn]). " (" .getWeekday($cn+1).")"); ?>
				<input type='HIDDEN' name="dates_<?php echo($cn); ?>" value="<?php echo($wdays[$cn]); ?>">
			</TD>
		</TR>
		<TR>
			<TD height=20 class='SESSION-TITLE' width=16%>BEGINNING</TD>
			<TD  class='SESSION-TITLE'  width=16%>ENDING</TD>
			<TD  class='SESSION-TITLE'  width=18%>STUDENT</TD>
			<TD height=20 class='SESSION-TITLE' width=16%>BEGINNING</TD>
			<TD  class='SESSION-TITLE'  width=16%>ENDING</TD>
			<TD  class='SESSION-TITLE'  width=18%>STUDENT</TD>
		</TR>
<?php 
	for ($i = 0; $i < $LINE_NB; $i++) { ?>
		<TR>
<?php 	for ($cn = $start_cn; $cn < ($start_cn+2); $cn++) {
			$slists = $sessionlists[$cn];
			$starttime = "";
			$endtime = "";
			$sessionid = 0;
			$request = "";
			if (count($slists) > $i) {
				$starttime 	= $slists[$i]->getBeginning();
				$endtime 	= $slists[$i]->getEnding();
				$sessionid 	= $slists[$i]->getID();
				$request = $slists[$i]->getRequest();
			}
?>
			<TD height=20 class='listtext'>
				<div align=center>
				<?php HoureMinuteForm($starttime, ("start_".$i), $cn); ?>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<?php HoureMinuteForm($endtime, ("end_".$i), $cn); ?>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<input type='HIDDEN' name="sessionid_<?php echo($i); ?><?php echo($cn); ?>" value="<?php echo($sessionid); ?>">
				<?php echo($request); ?>
				</div>
			</TD>
<?php 	} ?>
		</TR>
<?php }

	$start_cn = 4;
?>
		<TR>
			<TD height=20 colspan=3 class=ITEMS_LINE_TITLE>
				<?php $cn=$start_cn; echo(getDisplayDate($wdays[$cn]). " (" .getWeekday($cn+1).")"); ?>
				<input type='HIDDEN' name="dates_<?php echo($cn); ?>" value="<?php echo($wdays[$cn]); ?>">
			</TD>

			<TD colspan=3  class=ITEMS_LINE_TITLE>
				<?php $cn++; echo(getDisplayDate($wdays[$cn]). " (" .getWeekday($cn+1).")"); ?>
				<input type='HIDDEN' name="dates_<?php echo($cn); ?>" value="<?php echo($wdays[$cn]); ?>">
			</TD>
		</TR>
		<TR>
			<TD height=20 class='SESSION-TITLE' width=16%>BEGINNING</TD>
			<TD  class='SESSION-TITLE'  width=16%>ENDING</TD>
			<TD  class='SESSION-TITLE'  width=18%>STUDENT</TD>
			<TD height=20 class='SESSION-TITLE' width=16%>BEGINNING</TD>
			<TD  class='SESSION-TITLE'  width=16%>ENDING</TD>
			<TD  class='SESSION-TITLE'  width=18%>STUDENT</TD>
		</TR>
<?php 
	for ($i = 0; $i < $LINE_NB; $i++) {
?>
		<TR>
<?php
		for ($cn = $start_cn; $cn < ($start_cn+2); $cn++) {
			$slists = $sessionlists[$cn];
			$starttime = "";
			$endtime = "";
			$sessionid = 0;
			$request = "";
			if (count($slists) > $i) {
				$starttime 	= $slists[$i]->getBeginning();
				$endtime 	= $slists[$i]->getEnding();
				$sessionid 	= $slists[$i]->getID();
				$request = $slists[$i]->getRequest();
			}
?>
			<TD height=20 class='listtext'>
				<div align=center>
				<?php HoureMinuteForm($starttime, ("start_".$i), $cn); ?>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<?php HoureMinuteForm($endtime, ("end_".$i), $cn); ?>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center>
				<input type='HIDDEN' name="sessionid_<?php echo($i); ?><?php echo($cn); ?>" value="<?php echo($sessionid); ?>">
				<?php echo($request); ?>
				</div>
			</TD>
 <?php 
		}
		echo("</TR>");
 	} 
?>

		</TABLE>
	</TD>
</TR>
<TR><TD height=15></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=formlabel>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=30 width=50% class=formlabel>
						<div align=right>
						<INPUT class=button type=submit value=' Update Times '>
						</div>
					</TD>
					<TD height=30 class=formlabel width=50%>
						<div align=left>&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name="reset" VALUE=' Reset  '>
						</div>
					</TD>
				</TR>
				<TR>
					<TD height=40 colspan=2 class=formlabel>
					<div align=center>
					<font color=red>To delete a period, select BEGINNING and ENDING to --, then click "Update Times"</font>
					</div>
					</TD>
				</TR>
				
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=20></TD></TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=15>&nbsp;</TD></TR>
</TABLE>
</FORM>
<?php 
}


	function getTeacherData() 
	{
		$civil = getPostValue("civil");
		$firstname = getPostValue("firstname");
		$lastname = getPostValue("lastname");
		$subjects = getPostValue("subjects");
		$email = getPostValue("email");
		$phone = getPostValue("phone");
		$mobile = getPostValue("mobile");
		$notes = getPostValue("notes");
		
		$teacher = new TeacherClass();
		$teacher->setCivil($civil);
		$teacher->setFirstName($firstname);
		$teacher->setLastName($lastname);
		$teacher->setSubjects($subjects);
		$teacher->setEmail($email);
		$teacher->setPhone($phone);
		$teacher->setMobile($mobile);
		$teacher->setNotes($notes);
		$teacher->setDeleted(0);
		return $teacher;
	}
	
	/*********   add student ****************/
	function addNewTeacher($teacher) 
	{
		$teacher->addTeacher();
	}


function showTeacherForm($teacher) {
		$civil 		= 'M';
		$lastname 	= "";
		$firstname 	= "";
		$subjects 	= "";
		$email 		= "";
		$phone 		= "";
		$mobile 	= "";
		$notes 		= "";
		$deleted = 0;
		if ($teacher) {	
			$civil 		= $teacher->getCivil();
			$firstname 	= $teacher->getFirstName();
			$lastname 	= $teacher->getLastName();
			$subjects 	= $teacher->getSubjects();
			$email 		= $teacher->getEmail();
			$phone 		= $teacher->getPhone();
			$mobile 	= $teacher->getMobile();
			$notes 		= $teacher->getNotes();
			$deleted 	= $teacher->isDeleted();
		}
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 style="MARGIN: 10px 3px 10px 10px">
<TR>
	<TD>
		<?php FormTitle("Add New Teacher"); ?>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=520 border=0  class=registerborder>
<TR>
	<TD class=background>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD width=100%>
		<FORM action='../member/member.php' method=post>
		<INPUT type=hidden name='action' value='addnewteacher'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=10 colspan=2></TD></TR>
		<TR>
			<TD class=labelright width=30%><?php showmark( ); ?> Gender : </TD>
			<TD class=labelleft width=70%>
				<?php if ($civil == "Mr.") { ?>
					<INPUT type=radio name="civil" value="Mr." CHECKED>Mr.
				<?php } else { ?>
					<INPUT type=radio name="civil" value="Mr.">Mr.
				<?php } ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php if ($civil == "Ms.") { ?>
					<INPUT type=radio name="civil" value="Ms." CHECKED>Ms.
				<?php } else { ?>
					<INPUT type=radio name="civil" value="Ms.">Ms.
				<?php } ?>
			</TD>
		</TR>
		
		<TR>
			<TD class=labelright><?php showmark( ); ?> First Name : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="firstname"  value="<?php echo($firstname); ?>"  onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright><?php showmark( ); ?> Last Name : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="lastname"  value="<?php echo($lastname); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright><?php showmark( ); ?> Subjects : </TD>
			<TD class=labelleft>
				<select name="subjects"  onclick="active_save();">
				<?php global $PROGRAMS;
				for ($i = 0; $i < count($PROGRAMS); $i++) {
					$prog = $PROGRAMS[$i];
					if ($subjects == $prog)
						echo ("<option value='".$prog."' selected>" .$prog. "</option>");
					else
						echo ("<option value='".$prog."'>" .$prog. "</option>");
				}
				?>
				</select>			
			</TD>
		</TR>
		<TR>
			<TD class=labelright> Email : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="email"  value="<?php echo($email); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright>Phone : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="phone"  value="<?php echo($phone); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright>Mobile : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="mobile"  value="<?php echo($mobile); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR>
			<TD class=labelright>Notes : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="notes"  value="<?php echo($notes); ?>" onclick="active_save();">
			</TD>
		</TR>
		<TR><TD height=30 colspan=2>All <?php showmark( ); ?> lines should be filled.</TD></TR>
		<TR>
			<TD colspan=2 class=labelright>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=30 class=formlabel width=50%>
						<div align=right>
						<INPUT class=button type=submit value=' Add Teacher ' id="savebuttonid" disabled="disabled">
						</div>
					</TD>
					<TD height=30 class=formlabel width=50%>
						<div align=left>&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name='reset' VALUE=' Reset '>
						</div>
					</TD>
				</TR>
				<TR><TD height=15 colspan=2>&nbsp;</TD></TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
	</TD>
</TR>
</TABLE>
	</TD>
</TR>
</TABLE>

<?php 
}


function getLoginForm() {
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 style="MARGIN: 10px 3px 10px 10px">
<TR>
	<TD>
		<?php FormTitle("Connect To Teacher Account"); ?>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=520 border=0  class=registerborder>
		<TR>
			<TD bgcolor="#FFFFFF">
				<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
				<TR>
					<TD height=25 class=formlabel2>
					</TD>
				</TR>
				<TR>
					<TD>
					<FORM method=post action="index.php">
					<INPUT NAME=action TYPE=HIDDEN VALUE="login">
					<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align=center>
					<TR>
						<TD>
							<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
							<TR>
								<TD class=formlabel width=45%>
									<DIV align=right>
									Login Name : &nbsp;&nbsp;&nbsp;&nbsp;
									</DIV>
								</TD>
								<TD class=formlabel width=55%>
									<DIV align=left>
									<INPUT type=text class=fields size=25 name="login_name" value="">
									</DIV>
								</TD>
							</TR>
							<TR><TD height=10 colspan=2></TD></TR>
							<TR>
								<TD class=formlabel>
									<DIV align=right>Your Password : &nbsp;&nbsp;&nbsp;&nbsp;</DIV>
								</TD>
								<TD class=formlabel>
									<DIV align=left>
									<INPUT type=password class=fields size=25 name="login_passwd" value="">
									</DIV>
								</TD>
							</TR>
							<TR><TD height=20 colspan=2>&nbsp;</TD></TR>
							<TR>
								<TD class=formlabel colspan=2 height=30>
									<div align=center>
										<INPUT type="submit" class=button size=10 value="Login">
									</div>
								</TD>
							</tr>
							</TABLE>
						</TD>
					</TR>
					</TABLE>
					</FORM>	
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD class=formlabel height=30></TD></TR>
</TABLE>
<?php 
}

function getEmailLink($email) {
	if ($email)
		return ("<a href='mailto:"  .$email. "'>"  .$email. "</a>");
	else 
		return "";
}

function getTeacherProfilLink($id, $name) {
	return ("<a href='../member/member.php?action=teacherprofil&teacherid="  .$id."'>"  .$name. "</a>");
}

function deleteTeacher() {
	$nb =  getPostValue("teachernb");
	for ($i = 0; $i < $nb; $i++) {
		$teacherid = getPostValue("teacherid_".$i);
		$teacher = new TeacherClass();
		if ($teacher->findTeacher($teacherid)) {
			if (getPostValue("delteacher_".$i)) {
				$teacher->deleteTeacher(1);
			}
			else {
				$teacher->deleteTeacher(0);
			}
		}
	}
}

function listAllTeachers($loaddel) {
	$mlists = new MemberList();
	$lists = $mlists->getTeacherLists($loaddel);
	$nbmember = count($lists);
?>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=25 width=50% class=TABLE_FTITLE>
				<div align=left><font color=blue>&nbsp;&nbsp;All Teachers</font></div>
			</TD>
			<TD height=25 width=50%  class=TABLE_FTITLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
		
<TR>
	<TD class=background>
		<FORM action='member.php' method=post>
		<INPUT NAME='action' TYPE=HIDDEN VALUE='delteachers'>
		<INPUT NAME='teachernb' TYPE=HIDDEN VALUE='<?php echo($nbmember); ?>'>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
			<TD class=ITEMS_LINE_TITLE width='20%'> Name </TD>
			<TD class=ITEMS_LINE_TITLE width='17%'> Subjects </TD>
			<TD class=ITEMS_LINE_TITLE width='17%'> Phone </TD>
			<TD class=ITEMS_LINE_TITLE width='17%'> Cell </TD>
			<TD class=ITEMS_LINE_TITLE width='20%'> Email  </TD>
			<TD class=ITEMS_LINE_TITLE width='5%'> DEL  </TD>
		</TR>
<?php 		
		for ($i = 0; $i < $nbmember; $i++) {
			$id 		= $lists[$i]->getID();
			$name		= $lists[$i]->getTeacherFullName();
			$subjects	= $lists[$i]->getSubjects();
			$email 		= $lists[$i]->getEmail();
			$phone 		= $lists[$i]->getPhone();
			$cell		= $lists[$i]->getMobile();
?>			
		<TR>
			<TD class='listnum'><div align=center><?php echo(($i+1)); ?></div></TD>
			<TD class='listtext'><div align=left>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($this->getTeacherProfilLink($id, $name)); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($subjects); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($phone); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($cell); ?></div></TD>
			<TD class='listtext'><div align=center><?php echo($this->getEmailLink($email)); ?></div></TD>
			<TD class='listtext'>
				<div align=center>
				<?php if ($lists[$i]->isDeleted()) { ?>
					<INPUT class=box type='checkbox' name='delteacher_<?php echo($i); ?>' value='1' CHECKED>
				<?php } else { ?>
					<INPUT class=box type='checkbox' name='delteacher_<?php echo($i); ?>' value='1'>
				<?php } ?>
				<INPUT NAME='teacherid_<?php echo($i); ?>' TYPE=HIDDEN VALUE='<?php echo($id); ?>'>
				</div>
			</TD>
		</TR>
<?php 
		}
?>		
		<TR>
			<TD height=20 class='listnum'></TD>
			<TD colspan=5 class=formlabel></TD>
			<TD class=formlabel>
				<div align=center>
				<INPUT class=button TYPE='submit' name="delete" VALUE='GO'>
				</div>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
<!-- TR>
	<TD class=background>
		<FORM action='member.php' method=post>
		<INPUT NAME='action' TYPE=HIDDEN VALUE='showdelmember'>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=formlabel>
				<div align=right>
				<INPUT class=button TYPE='submit' name="showdelete" VALUE='Show Including Deleted Student'>
				</div>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR -->
</TABLE>
<?php 
}




function getTeacherProfileForm($teacherid) 
{
	$teacherClass = new TeacherClass();
	$teacherClass->findTeacher($teacherid);
?>	
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 style="MARGIN: 10px 3px 10px 10px">
<TR>
	<TD>
		<?php $this->getProfilTitleForm("Teacher Profile"); ?>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=520 border=0  class=registerborder>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
				<TR>
					<TD>
						<FORM method="post" action="member.php">
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
								
						<TR>
							<TD height=25 class=formlabel2>
								
							</TD>
						</TR>
		        		<TR>
							<TD>
								<?php $this->teacherInfomationForm($teacherClass); ?>
							</TD>
		        		</TR>
						<TR>
							<TD class=background height=50>
								<div align=center>
									<INPUT NAME=action TYPE=HIDDEN VALUE="changeteacherprofil">
									<INPUT type="submit" class=button NAME="update" value=" Update " id="savebuttonid" disabled="disabled">
									<INPUT type="submit" class=button NAME="reset" value=" Reset ">
								</div>
							</TD>
						</TR>
						</TABLE>
						</FORM>
					</TD>
				</TR>
        		<TR><TD height=20>&nbsp;</TD></TR>

				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD class=formlabel height=30></TD></TR>
</TABLE>
<?php 
}

function getProfilTitleForm($title) {
?>

<TABLE cellSpacing=0 cellPadding=0 width=520 border=0>
<TR>
	<TD width=12 height=24 class=registerborder>
		<IMG height=24 src="../images/left.gif" width=12 border=0>
	</TD>
	<TD width=500 class=registerbar>
		<?php echo($title); ?>
	</TD>
	<TD width=14 height=24 class=registerborder>
		<IMG height=24 src="../images/right.gif" width=14 border=0>
	</TD>
</TR>
</TABLE>
<?php 		
}

function teacherInfomationForm($teacher) 
{
	$id = 0;
	$name 	= "";
	$login 	= "";
	$email 	= "";
	$mobile	= "";
	$phone 	= "";
	$notes 	= "";
	if ($teacher) {
		$id 	= $teacher->getID();
		$name 	= $teacher->getTeacherFullName();
		if ($teacher->getSubjects()) {
			$name .= " (" .$teacher->getSubjects(). ")";
		}
		$login 	= $teacher->getLogin();
		$email 	= $teacher->getEmail();
		$phone 	= $teacher->getPhone();
		$mobile = $teacher->getMobile();
		$notes 	= $teacher->getNotes();		
	}
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Teacher Name :</TD>
	<TD class=formlabel><?php echo($name); ?></TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Teacher ID :</TD>
	<TD class=formlabel><?php echo($id); ?>
		<INPUT TYPE=HIDDEN name="teacherid" value="<?php echo($id); ?>" >
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Login Name : </TD>
	<TD class=formlabel><?php echo($login); ?></TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Email : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="email" value="<?php echo($email); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Phone : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="phone"  value="<?php echo($phone); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Cell : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="mobile"  value="<?php echo($mobile); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Notes : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=50 name="notes" value="<?php echo($notes); ?>" onclick="active_save();">
	</TD>
</TR>
</TABLE>
<?php
}
	
function changeTeacherProfil() {

	$teacher = '';
	
	$email = getPostValue('email');
	$phone = getPostValue('phone');
	$mobile = getPostValue('mobile');
	$notes = getPostValue('notes');
		
	$teacherid = getPostValue('teacherid');
	if ($teacherid) {
		$teacher = new TeacherClass();
		if ($teacher->findTeacher($teacherid)) {
			$teacher->setEmail($email);
			$teacher->setPhone($phone);
			$teacher->setMobile($mobile);
			$teacher->setNotes($notes);
			
			$teacher->updateTeacher();
		}
	}
	return $teacher;
}



}
?>