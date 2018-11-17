<?php
class PrivateForm {

	var $SYNC_ERR = "Error : Private session table bas been modified, you should click Refresh first.";
	

/************************* student week private session ******/
function getStrudentWeekPrivateSessions() {
	$memberList = new MemberList();
	$lists = array();
	$teacher	= getPostValue('teacher');
	$subjects	= getPostValue('subjects');
	for ($w= 0; $w < 6; $w++) {
		$var 	= "sessionnb_".$w;
		$nb 	= getPostValue($var);
		for ($i = 0; $i < $nb; $i++) {
			$vv = $i."_".$w;
			$var = "sessionid_".$vv;
			$id = getPostValue($var);
			$psession = new PSessionClass();
			if ($psession->getSessionByID($id)) {
				$var = "lastmodify_".$vv;
				$lastmodify = getPostValue($var);
				if ($psession->getLastModify() > $lastmodify) {
					return "";
				}
				
				$var = "request_".$vv;
				$request = getPostValue($var);
				if ($request) {
					$var = "studentid_".$vv;
					$studentid = getPostValue($var);
					if ($request == "1") {
						$student 	= $memberList->getStudent($studentid);
						if ($student) {
							$request = $student->getStudentName();
						}
					}
				}
				else  {
		 			$studentid = 0;
				}
				$var = "cancel_".$vv;
				$cancel = getPostValue($var);
				if ($cancel && $cancel == "1") {
					$cancel = getshortLocalDateTime();
				}
				$psession->setStudentID($studentid);
				$psession->setRequest($request);
				$psession->setCancel($cancel);
				$lists[] = $psession;
			}
		}
	}
	
	return $lists;
}
function updateStudentWeekPrivateSesstions() {
	$lists = $this->getStrudentWeekPrivateSessions();
	if ($lists && count($lists) > 0) {
		for ($i =0; $i < count($lists); $i++) {
			$psession = $lists[$i];
			if ($psession->getID() > 0) {
				$psession->updateSession();
			}
		}	
	}
	else {
		return $this->SYNC_ERR;
	}
	return "";
}

function showTeacherPrivateSessionForStudent($teacherN, $subjs, $dd, $st_id) {
	$memberList = new MemberList();
	$privateList = new PrivateList();
	
	$teacher = $teacherN;
	$subjects = $subjs;
	$dates = $dd;
	if (!$teacherN && $st_id) {
		$psession = $privateList->getStudentPrivateSessionTeacher($st_id);
		if ($psession) {
			$teacher = $psession->getTeacher();
			$subjects = $psession->getSubjects();
			$dates = $psession->getDates();
		}
	}
		
	$wdays = getWeekDates($dates);
	
	$sessionlists = $privateList->getTeacherWeekPrivateSessions($teacher, $wdays);
		
?>
<FORM action='../private/index.php' method=post>
<INPUT NAME='action' TYPE=HIDDEN VALUE='updateasksession'>
<INPUT NAME='teacher' TYPE=HIDDEN VALUE='<?php echo($teacher); ?>'>
<INPUT NAME='subjects' TYPE=HIDDEN VALUE='<?php echo($subjects); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD height=25 colspan=2 class=TABLE_FTITLE>
				<div align=center><font color=blue size=2>
				<?php echo($teacher); ?> PRIVATE SESSION TABLE</font>
				</div>
			</TD>
		</TR>
		<?php for ($k = 0; $k < 6; $k+=2) {?>
		<TR>
			<TD class=session-title height=25 width='50%'>
				<?php echo(getDisplayDate($wdays[$k]). " (" .getWeekday($k+1).")"); ?>
			</TD>
			<TD class=session-title width='50%'>
				<?php echo(getDisplayDate($wdays[$k+1]). " (" .getWeekday($k+2).")"); ?>
			</TD>
		</TR>
		<?php 
			if (count($sessionlists[$k]) > count($sessionlists[$k+1]))
				$rn = count($sessionlists[$k]);
			else 
				$rn = count($sessionlists[$k+1]);
		?>
		<TR>
			<TD class='listtext'  valign=top>
				<?php $this->showTeacherDailyPrivateSession($sessionlists[$k], $st_id, $wdays[$k], $k, $rn); ?>
			</TD>
			<TD class='listtext' valign=top>
				<?php $this->showTeacherDailyPrivateSession($sessionlists[$k+1], $st_id, $wdays[$k+1], ($k+1), $rn); ?>
			</TD>
		</TR>
		<?php } ?>
		</TABLE>
	</TD>
</TR>
<TR><TD height=15></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=formlabel>
			<?php if ($teacher) {?>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=30 width=50% class=formlabel>
						<div align=right>
						<INPUT class=button type=submit name="updateasksession" value=' Update '>
						</div>
					</TD>
					<TD height=30 class=formlabel width=50%>
						<div align=left>&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name="refresh" VALUE=' Refresh  '>
						</div>
					</TD>
				</TR>
				</TABLE>
			<?php } ?>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=15>&nbsp;</TD></TR>
</TABLE>
</FORM>
<?php 
}

function showTeacherDailyPrivateSession($slists, $st_id, $dates, $index, $rn) {
	$memberList = new MemberList();
	$list_nb = count($slists);
	if ($list_nb == 0) {
		if ($rn == 0)
			$height = 40;
		else 
			$height = $rn*22;
	} 
?>

<INPUT type='HIDDEN' name='sessionnb_<?php echo($index); ?>' value='<?php echo($list_nb); ?>'>
<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder >
<TR>
	<TD class=ITEMS_LINE_TITLE width='35%'> TIME </TD>
	<TD class=ITEMS_LINE_TITLE width='35%'> REQUEST </TD>
	<TD class=ITEMS_LINE_TITLE width='15%'> Grant </TD>
	<TD class=ITEMS_LINE_TITLE width='15%'> Cancel </TD>
</TR>
<?php 

if ($list_nb == 0) { 
?>
<TR>
	<TD class='formlabel' colspan=4 height=<?php echo($height); ?>>
		<div align=center><font color=orange>
			Not available this day. 
		</font></div>
	</TD>
</TR>
<?php 
} else {
	for ($i = 0; $i < $list_nb; $i++) {
		$ssession	= $slists[$i];
		$sessionid 	= $ssession->getID();
		$beginning 	= $ssession->getBeginning();
		$ending 	= $ssession->getEnding();
		$lastmodify = $ssession->getLastModify();
		$granted 	= $ssession->getGranted();
		$cancel		= $ssession->getCancel();
		$studentid 	= $ssession->getStudentID();
		$taken = "";
		
		$canreq = canRequest($dates, $beginning);
		
		$student 	= $memberList->getStudent($studentid);
		if ($student) {
			$stname = $student->getStudentName();
		}
		else {
			$stname = $ssession->getRequest();
		}
		if ($studentid && $studentid == $st_id) {
			$color = "red";
			$taken = $stname;
		}
		else {
			if ($stname) {
				$taken = "Taken";
				$color = "blue";
			}
			else {
				$color = "black";
			}
		}
		$cancancel = 1;
		if ($cancel) {
			$canceltips = "Canceled : <br>" .$cancel;
		}
		else {
			$canceltips = "Apply only 5 hrs prior";
			$cancancel = canBeCanceled($dates, $beginning);
		}
		$var_nam = $i."_".$index; 
?>
<TR>
	<TD class=labeltime height=20>
		<div align=center><font color=<?php echo($color); ?>>
		<?php echo(getDisplayTime($beginning). " - " .getDisplayTime($ending)); ?>
		<input type='HIDDEN' name='sessionid_<?php echo($var_nam); ?>' value='<?php echo($sessionid); ?>'>			
		<input type='HIDDEN' name='lastmodify_<?php echo($var_nam); ?>' value='<?php echo($lastmodify); ?>'>			
		</font>	</div>
	</TD>
	<TD class='listtext'> <div align=left><font color=<?php echo($color); ?>>
	<?php if ($stname) {
			echo("&nbsp;&nbsp;&nbsp;&nbsp;" .$taken); ?>
		<input type='HIDDEN' name="studentid_<?php echo($var_nam); ?>" value="<?php echo($studentid); ?>">
		<input type='HIDDEN' name="request_<?php echo($var_nam); ?>" value="<?php echo($stname); ?>">
	<?php } else { 
		if ($canreq > 0) { ?>
		<INPUT class=box type='checkbox' name="request_<?php echo($var_nam); ?>" value='1'> Available
		<input type='HIDDEN' name="studentid_<?php echo($var_nam); ?>" value="<?php echo($st_id); ?>">
		<?php } ?>
	<?php }?>
		</font></div>
	</TD>
	<TD class=listtext  width=5%><div align=center><font color=<?php echo($color); ?>>
<?php if ($stname && $granted) { ?>
			<IMG height=9 src=../images/ok.gif width=8>
<?php  } ?>
		</font></div>
	</TD>
	
	<TD class='listtext'>
		<div title='<?php echo($canceltips); ?>' onmouseover='tooltip.show(this)' onmouseout='tooltip.hide(this)' align=center>
		<font color=<?php echo($color); ?>>
<?php 
	if ($cancel) {
		if ($studentid == $st_id) {  ?>
			<INPUT class=box type='checkbox' name="cancel_<?php echo($var_nam); ?>" value='1' checked>
<?php 	} else { ?>
			<INPUT type='HIDDEN' name="cancel_<?php echo($var_nam); ?>" value="<?php echo($cancel); ?>">
<?php 	} 
	} else {
		if ($studentid == $st_id) {  
			if ($cancancel > 0) { ?>
			<INPUT class=box type='checkbox' name="cancel_<?php echo($var_nam); ?>" value='1'>
		<?php } else { ?>
			<INPUT type='HIDDEN' name="cancel_<?php echo($var_nam); ?>" value="0">
			<?php if ($cancancel == 0) { ?>
			<font color=red size=2>!</font>
		<?php } } ?>
<?php 	} else { ?>
			<INPUT type='HIDDEN' name="cancel_<?php echo($var_nam); ?>" value="0">
<?php 	} 
 	}?>
		</font></div>
	</TD>
<?php 

	}
?>
</TR>
<?php 
	for ($i = $list_nb; $i < $rn; $i++) {
?>
<TR>
	<TD class=labeltime height=20></TD>
	<TD class=labeltime height=20></TD>
	<TD class=labeltime height=20></TD>
	<TD class=labeltime height=20></TD>
</TR>
<?php 		
	}
}
?>
</TABLE>
<?php 
}


/**************************************************************/

function getTeacherWeekPrivateSessions() {
	$memberList = new MemberList();
	$lists = array();
	$teacher	= getPostValue('teacher');
	$subjects	= getPostValue('subjects');
	for ($w= 0; $w < 6; $w++) {
		$var 	= "sessionnb_".$w;
		$nb 	= getPostValue($var);
		$var 	= "dates_".$w;
		$dates 	= getPostValue($var);
		for ($i = 0; $i < $nb; $i++) {
			$vv = $i."_".$w;

			$beginning = getHoureMinute("begin_".$i, $w);
			$ending = getHoureMinute("end_$i", $w);

			$var = "granted_".$vv;
			$granted = getPostValue($var);
			if ($granted && $granted == 1) {
				$granted = getshortLocalDateTime();
			}
			$studentid = 0;
			$var = "request_".$vv;
			$request = getPostValue($var);
			if ($request) {
				$student = new StudentClass();
				if ($student->findStudent($request)) {
					$studentid = $student->getID();	
					$request = $student->getStudentName();
				}
			}

			$var = "sessionid_".$vv;
			$id = getPostValue($var);
			
			$psession = new PSessionClass();
			if ($psession->getSessionByID($id)) {
				$var = "lastmodify_".$vv;
				$lastmodify = getPostValue($var);
				
				if ($psession->getLastModify() > $lastmodify)
					return '';
				$psession->setDates($dates);
				$psession->setBeginning($beginning);
				$psession->setEnding($ending);
				if ($beginning && $ending) {
					$psession->setStudentID($studentid);
					$psession->setRequest($request);
					if (!$request) {
						$psession->setGranted("");
						$psession->setCancel("");
					}
					else {
						$psession->setGranted($granted);
					}
					$psession->setConfirmCancel("");
				}
				else {
					$psession->setStudentID("");
					$psession->setRequest("");
					$psession->setGranted("");
					$psession->setCancel("");
					$psession->setConfirmCancel("");
				}
				$lists[] = $psession;
			}
			else if ($beginning && $ending) {
				$psession->setTeacher($teacher);
				$psession->setSubjects($subjects);
				$psession->setDates($dates);
				$psession->setBeginning($beginning);
				$psession->setEnding($ending);
				$psession->setStudentID($studentid);
				$psession->setRequest($request);
				$psession->setGranted($granted);
				$psession->setCancel("");
				$psession->setConfirmCancel("");
				$lists[] = $psession;
			}
		}
	}
	return $lists;
}
function updateTeacherWeekPrivateSesstions() {
	$lists = $this->getTeacherWeekPrivateSessions();
	if ($lists && count($lists) > 0) {
		for ($i =0; $i < count($lists); $i++) {
			$psession = $lists[$i];
			if ($psession->getID() > 0) {
				$psession->updateSession();
			}
			else {
				$psession->addSession();
			}
		}	
	}
	else {
		return $this->SYNC_ERR;
	}
	return "";
}



function showTeacherWeekPrivateSession($teacher, $subjects, $dates) {
	$memberList = new MemberList();
	$privateList = new PrivateList();
	
	$wdays = getWeekDates($dates);
	
	$sessionlists = $privateList->getTeacherWeekPrivateSessions($teacher, $wdays);
		
?>
<FORM action='private.php' method=post>
<INPUT NAME='action' TYPE=HIDDEN VALUE='updatesession'>
<INPUT NAME='teacher' TYPE=HIDDEN VALUE='<?php echo($teacher); ?>'>
<INPUT NAME='subjects' TYPE=HIDDEN VALUE='<?php echo($subjects); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD height=25 colspan=2 class=TABLE_FTITLE>
				<div align=center><font color=blue size=2>
				<?php echo($teacher); ?> PRIVATE SESSION TABLE</font>
				</div>
			</TD>
		</TR>
		<?php for ($k = 0; $k < 6; $k+=2) {?>
		<TR>
			<TD class=session-title height=25 width='50%'>
				<?php echo(getDisplayDate($wdays[$k]). " (" .getWeekday($k+1).")"); ?>
			</TD>
			<TD class=session-title width='50%'>
				<?php echo(getDisplayDate($wdays[$k+1]). " (" .getWeekday($k+2).")"); ?>
			</TD>
		</TR>
		<?php 
			if (count($sessionlists[$k]) > count($sessionlists[$k+1]))
				$rn = count($sessionlists[$k]);
			else 
				$rn = count($sessionlists[$k+1]);
		?>
		<TR>
			<TD class='listtext'  valign=top>
				<?php $this->showTeacherDailyPrivateSessionOnly($sessionlists[$k], $wdays[$k], $k, $rn); ?>
			</TD>
			<TD class='listtext' valign=top>
				<?php $this->showTeacherDailyPrivateSessionOnly($sessionlists[$k+1], $wdays[$k+1], ($k+1), $rn); ?>
			</TD>
		</TR>
		<?php } ?>
		</TABLE>
	</TD>
</TR>
<TR><TD height=15></TD></TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=formlabel>
			<?php if ($teacher) {?>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=30 width=50% class=formlabel>
						<div align=right>
						<INPUT class=button type=submit name="updateasksession" value=' Update '>
						</div>
					</TD>
					<TD height=30 class=formlabel width=50%>
						<div align=left>&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name="refresh" VALUE=' Refresh  '>
						</div>
					</TD>
				</TR>
				<TR>
					<TD height=40 colspan=2 class=formlabel>
					<div align=center>
					<font color=red>You can input student's ID or their Firstname Lastname</font>
					</div>
					</TD>
				</TR>
				</TABLE>
			<?php } ?>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=15>&nbsp;</TD></TR>
</TABLE>
</FORM>
<?php 
}

function showTeacherDailyPrivateSessionOnly($slists, $dates, $index, $rn) {
	$MAX_SESSION = 8;
	$memberList = new MemberList();
	$nbsession = count($slists);
	if ($rn < $MAX_SESSION)
		$n_max = $MAX_SESSION;
	else 
		$n_max  = $rn + 1; 
	while ($nbsession < $n_max) {
		$slists[] = new PsessionClass();
		$nbsession++;
	}	
?>

<INPUT type='HIDDEN' name='sessionnb_<?php echo($index); ?>' value='<?php echo($nbsession); ?>'>
<INPUT type='HIDDEN' name='dates_<?php echo($index); ?>' value='<?php echo($dates); ?>'>
<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder >
<TR>
	<TD class=ITEMS_LINE_TITLE width='35%'> BEGINNING </TD>
	<TD class=ITEMS_LINE_TITLE width='35%'> ENDING </TD>
	<TD class=ITEMS_LINE_TITLE width='25%'> REQUEST </TD>
	<TD class=ITEMS_LINE_TITLE width='5%'> G. </TD>
</TR>
<?php 
	
for ($i = 0; $i < $nbsession; $i++) 
{
	$ssession	= $slists[$i];
	$sessionid 	= $ssession->getID();
	$beginning 	= $ssession->getBeginning();
	$ending 	= $ssession->getEnding();
	$lastmodify = $ssession->getLastModify();
	$granted 	= $ssession->getGranted();
	$cancel		= $ssession->getCancel();
	$studentid 	= $ssession->getStudentID();
	$student 	= $memberList->getStudent($studentid);
	if ($student) {
		$stname = $student->getStudentName();
	}
	else {
		$stname = $ssession->getRequest();
		$studentid = 0;
	}
	if ($beginning && $ending)
		$showlist = 1;
	else 
		$showlist = 0;
	$tips = $this->getStudentTips($ssession, $student);
	
	$var_nam = $i."_".$index; 
?>
<TR>
	<TD class='listtext'>
		<input type='HIDDEN' name='sessionid_<?php echo($var_nam); ?>' value='<?php echo($sessionid); ?>'>			
		<input type='HIDDEN' name='lastmodify_<?php echo($var_nam); ?>' value='<?php echo($lastmodify); ?>'>			
		<?php HoureMinuteForm($beginning, "begin_".$i, $index); ?>	
	</TD>
	<TD class='listtext'>
		<?php HoureMinuteForm($ending, "end_".$i, $index); ?>	
	</TD>


	<TD class='listtext'>
		<input class='fields' type='text' size='12' name="request_<?php echo($var_nam); ?>" value="<?php echo($stname)?>">
		<INPUT type='HIDDEN' name="studentid_<?php echo($var_nam); ?>" value='<?php echo($studentid); ?>'> 
	</TD>
	<TD class='listtext'>
<?php if ($stname) { ?>
		<div title='<?php echo($tips); ?>' onmouseover='tooltip.show(this)' onmouseout='tooltip.hide(this)' align=center>
<?php } else { ?>
		<div align=center>
<?php 
	}
	if ($cancel) { ?>
		<font color=red size=2>X</font>
<?php 
	}
	else {		
		if ($granted) 
		{
?> 
		<IMG height=9 src=../images/ok.gif width=8>
		<INPUT type='HIDDEN' name='granted_<?php echo($var_nam); ?>' value='<?php echo($granted); ?>'>
<?php 	
		} 
		else 
		{ 
?>
		<INPUT class=box type='checkbox' name='granted_<?php echo($var_nam); ?>' value='1'>
<?php 	} 
	}
?>
		</div>
	</TD>
</TR>
<?php 
}
?>
</TABLE>
<?php 
}


/**********************************************/
function getTeacherSessionLink($teacher, $subs, $dates) {
	
	$url = "<a href='../private/private.php?action=teachersession&teacher=".$teacher."&subjects=".$subs."&dates=".$dates."'>".$teacher."</a>";
	return $url;
}


function getUpdatePrivateSessionsTable() {
	$lists = array();
	for ($cn = 0; $cn < 3; $cn++) {
		$var = 'teachernb_'.$cn;
		$t_nb =  getPostValue($var);

		if ($t_nb) {
			for ($t = 1; $t <= $t_nb; $t++) {
				$var = "teacher_".$t. "_".$cn;
				$teacher = getPostValue($var);
				$var = "teacher_datenb_".$t. "_".$cn;
				$t_date_nb =  getPostValue($var);
				if ($t_date_nb) {
					for ($td = 0; $td < $t_date_nb; $td++) {
						$studentid ='';
						$var_name = $t."_".$td. "_".$cn;
						
						$var = "request_".$var_name;
						$request = getPostValue($var);
						if ($request) {
							$student = new StudentClass();
							if ($student->findStudent($request)) {
								$studentid = $student->getID();	
								$request = $student->getStudentName();
							}
						}
						$var = "lastmodify_".$var_name;
						$lastmodify = getPostValue($var);
						
						$var = "sessionid_".$var_name;
						$sessionid = getPostValue($var);
						$psession = new PSessionClass();
						if ($psession->getSessionByID($sessionid)) {
							if ($psession->getLastModify() > $lastmodify) {
								return "";
							}
							else {
								$psession->setStudentID($studentid);
								$psession->setRequest($request);
								if ($request) {
									$var = "granted_".$var_name;
									$granted = getPostValue($var);
									if ($granted == 1)
										$granted = getshortLocalDateTime();
									$psession->setGranted($granted);
								}
								else {
									$psession->setGranted("");
									$psession->setCancel("");
								}
								$lists[] = $psession;
							}
						}
					}
				}
				
			}
		}
	}	
	return $lists;
}

function updatPrivateSesstionTable() {
	$lists = $this->getUpdatePrivateSessionsTable();
	if ($lists && count($lists) > 0) {
		for ($i =0; $i < count($lists); $i++) {
			$psession = $lists[$i];
			if ($psession->getID() > 0) {
				$psession->updateSession();
			}
		}
	}
	else {
		return $this->SYNC_ERR;
	}
	return "";
}

function getStudentTips($ssession, $student) {
	$tips = "";
	if ($student) {
		$stname = $student->getStudentName();
		if ($student->getPhone()) {
			$tips .= "H : ". $student->getPhone();
		}
		if ($student->getMobile()) {
			$tips .= "<br>M : ". $student->getMobile();
		}
		if (strlen(trim($tips)) == 0)
			$tips = "no phone number";
	}
	else {
		$stname =  $ssession->getRequest();
		$tips = "not found in database";
	}
		
	if ($ssession->getCancel()) {
		$tips = "Canceled : <br>".$ssession->getCancel(). "<br><br>".$tips;
	}
	else {
	 	if ($ssession->getGranted()) {
			$tips = "Granted : <br>" .$ssession->getGranted()."<br><br>" .$tips;
	 	}
	 	else {
			$tips = "No Granted<br>" .$tips;
	 	}
	}
	return $tips;	
}

function showDayPrivateSession($slists, $dates, $cn) {

	$memberList = new MemberList();
	
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php 
$t1 = "";
$t_n = 0;
$t_d_n = 0;
if ($slists && count($slists)) 
{
	for ($i = 0; $i < count($slists); $i++) {
		$ssession = $slists[$i];
		$sessionid = $ssession->getID();
		$teacher = $ssession->getTeacher();
		$lastmodify = $ssession->getLastModify();
		$studentid = $ssession->getStudentID();
		$student = $memberList->getStudent($studentid);
		$tips = $this->getStudentTips($ssession, $student);
		$granted = $ssession->getGranted();
		if ($student) {
			$stname = $student->getStudentName();
		}
		else {
			$stname =  $ssession->getRequest();
		}
		if ($ssession->getCancel()) {
			$color = "red";
		}
		else {
			if ($granted)
				$color = "black";
			else  {
				$color = "orange";
			}
		}
		if ($t1 == "" || $teacher != $t1) 
		{
			if ($t1) {
				echo("<input type='HIDDEN' name='teacher_datenb_".$t_n. "_".$cn. "' value='".$t_d_n."'>");				
			}
			$t_n++;
			$t_d_n = 0;
?>
<TR>
	<TD class=session-title colspan=3 height=20><div align=center>
		<input type='HIDDEN' name='teacher_<?php echo($t_n. "_".$cn); ?>' value='<?php echo($tecaher); ?>'>				
		<?php $t1 = $teacher;
			echo($this->getTeacherSessionLink($teacher, $ssession->getSubjects(), $dates));  
		?>
		</div>
	</TD>
</TR>
<?php 	
		} 
$var_nam = $t_n."_".$t_d_n."_".$cn; 
?>
<TR>
	<?php 
		?>
	<TD class=labeltime height=18 width=45%><div align=center>
		<?php echo(getDisplayTime($ssession->getBeginning()). " - " .getDisplayTime($ssession->getEnding())); ?>
		<input type='HIDDEN' name='sessionid_<?php echo($var_nam); ?>' value='<?php echo($sessionid); ?>'>			
		<input type='HIDDEN' name='lastmodify_<?php echo($var_nam); ?>' value='<?php echo($lastmodify); ?>'>			
	</div>
	</TD>
	<TD class=listtext  width=50%>
		<input class='fields' type='text' size='17' name="request_<?php echo($var_nam); ?>" value="<?php echo($stname)?>">
	</TD>
	<TD class=listtext  width=5%>
		<?php if ($stname){ ?>
		<div  title='<?php echo($tips); ?>' onmouseover='tooltip.show(this)' onmouseout='tooltip.hide(this)' align=center>
		<?php if($color == "orange") { ?>
			<INPUT class=box type='checkbox' name="granted_<?php echo($var_nam); ?>" value='1'>
		<?php } else if ($color == "red") { ?>
			<font color=red size=2>X</font>
			<input type='HIDDEN' name='granted_<?php echo($var_nam); ?>' value='<?php echo($granted); ?>'>
		<?php } else { ?>
			<IMG height=9 src=../images/ok.gif width=8>
			<input type='HIDDEN' name='granted_<?php echo($var_nam); ?>' value='<?php echo($granted); ?>'>
		<?php } ?>
		</div>
		<?php } ?>
	</TD>
</TR>
<?php 
	$t_d_n++;
	} 
	echo("<input type='HIDDEN' name='teacher_datenb_".$t_n. "_".$cn. "' value='".$t_d_n."'>");				
	echo("<input type='HIDDEN' name='teachernb_".$cn. "' value='".$t_n."'>");				
}
?>
</TABLE>

<?php
}

function listWeekPrivateSessionTable($startdate) {

	$privateList = new PrivateList();

	$wdays = getWeekDates($startdate);
	
	$k = 0;
	if (!$startdate) {
		$sd = date("Y-m-d");
	}
	else {
		$sd = $startdate;
	}
	
	$cmp = cmpDate($sd, $wdays[3]);
	 if ($cmp >= 0) {
	 	$k = 3;
	}

	$sessionlists = $privateList->getWeekPrivateSessions($wdays);
	
?>

<FORM action='private.php' method=post>
<INPUT NAME='action' TYPE=HIDDEN VALUE='updatesessiontable'>
<INPUT NAME='startdate' TYPE=HIDDEN VALUE='<?php echo($startdate); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD height=25 colspan=3 class=TABLE_FTITLE>
				<div align=center><font color=blue size=3>PRIVATE SESSION TABLE</font></div>
			</TD>
		</TR>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='33%'>
				<?php echo(getDisplayDate($wdays[$k]). " (" .getWeekday($k+1).")"); ?>
			</TD>
			<TD class=ITEMS_LINE_TITLE  width='33%'>
				<?php echo(getDisplayDate($wdays[$k+1]). " (" .getWeekday($k+2).")"); ?>
			</TD>
			<TD class=ITEMS_LINE_TITLE width='33%'>
				<?php echo(getDisplayDate($wdays[$k+2]). " (" .getWeekday($k+3).")"); ?>
			</TD>
		</TR>
		<TR>
			<TD class='listtext' valign=top>
				<?php $this->showDayPrivateSession($sessionlists[$k], $wdays[$k], 0); ?>
			</TD>
			<TD class='listtext' valign=top>
				<?php $this->showDayPrivateSession($sessionlists[$k+1], $wdays[$k+1], 1); ?>
			</TD>
			<TD class='listtext'  valign=top>
				<?php $this->showDayPrivateSession($sessionlists[$k+2], $wdays[$k+2], 2); ?>
			</TD>
		</TR>
		
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
						<INPUT class=button type=submit name="updatesessiontable" value=' Update '>
						</div>
					</TD>
					<TD height=30 class=formlabel width=50%>
						<div align=left>&nbsp;&nbsp;
						<INPUT class=button TYPE='submit' name="refresh" VALUE=' Refresh  '>
						</div>
					</TD>
				</TR>
				<TR>
					<TD height=40 colspan=2 class=formlabel>
					<div align=center>
					<font color=red>You can input student's ID or their Firstname Lastname</font>
					</div>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR><TD height=15></TD></TR>
</TABLE>
</FORM>
<?php 
}

}
?>