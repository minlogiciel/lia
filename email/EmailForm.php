<?php

class EmailForm {

function getClassEmailList() 
{
	$classlist = array();
	$nb = getPostValue("classnumber");
	for ($i = 0; $i < $nb; $i++) {
		if (getPostValue("selectclass_".$i)) {
			$classlist[] = getPostValue("classname_".$i);
		}
	}
	return $classlist;
}

function addEmail($title, $messages, $groups, $reportcard, $tolists, $emailid) {
	$eclass = new EmailClass();
	$eclass->setID($emailid);
	$eclass->setTitle($title);
	$eclass->setSubject($messages);
	$eclass->setDate(getCurrentDate());
	$eclass->setGroups($groups);
	$eclass->setReportCard($reportcard);
	$eclass->setReport($tolists);
	$report = array();
	$report[] = $eclass->addEmail(); // email id
	if ($eclass->getSendKO()) {
		$report[] = 0;				// email send ko
	}
	else {
		$report[] = 1;
	}
	
	return $report;
}

function ResendEmailToStudents($title, $messages, $classmaillist, $emaillist, $reportcard, $emailid)  {
	$tolists = array();
	$memberList = new MemberList();
	$mailtoparent = new MailToParent();
	$cls_nb = count($classmaillist);
	for ($i = 0; $i < $cls_nb; $i++) {
		if (trim($classmaillist[$i])) {
			$tolists[] =  $classmaillist[$i];
			$clstudents = array();
			$studentlists 	= $memberList->getStudentLists($classmaillist[$i], 0);
			foreach($studentlists as $st) 
			{
				if ($st->getEmail()) {
					$clstudents[] = $st->getEmail();
					if (strstr($emaillist, $st->getEmail())) {
						$clstudents[] = $mailtoparent->SendToParent($title, $messages, $st, $reportcard);
					}
					else {
						$clstudents[] = 1;
					}
				}
			}
			$tolists[] = $clstudents;
		}
	}
	
	$tolists[] = $this->addEmail($title, $messages, 1, $reportcard, $tolists, $emailid);

	return $tolists;
}

function ResendEmailToGroupStudents($title, $messages, $classmaillist,  $emaillist, $emailid)  {
	$tolists = array();

	$memberList = new MemberList();
	$mailtoparent = new MailToParent();
	
	$cls_nb = count($classmaillist);
	for ($i = 0; $i < $cls_nb; $i++) {
		if (trim($classmaillist[$i])) {
			$tolists[] =  $classmaillist[$i];
			$emailstring = "";
			$clstudents = array();
			$studentlists 	= $memberList->getStudentLists($classmaillist[$i], 0);
			foreach($studentlists as $st) 
			{
				if ($st->getEmail()) {
					if ($emailstring) {
						$emailstring .=", ";
					}
					$emailstring .= $mailtoparent->getStudentEmail($st);
				}
			}
			if ($emailstring) {
				$clstudents[] = $emailstring;
				if (strstr($emaillist, $emailstring)) {
					$clstudents[] = $mailtoparent->SendToGroupParent($title, $messages, $emailstring);
				}
				else {
					$clstudents[] = 1;
				}
			}
			$tolists[] = $clstudents;
		}
	}
	
	$tolists[] = $this->addEmail($title, $messages, 0, 0, $tolists, $emailid);

	return $tolists;
}

function sendEmailToStudents($title, $messages, $classmaillist, $reportcard)  {
	$tolists = array();
	$memberList = new MemberList();
	$mailtoparent = new MailToParent();
	$cls_nb = count($classmaillist);
	$sst = "";
	for ($i = 0; $i < $cls_nb; $i++) {
		$tolists[] =  $classmaillist[$i];
		$clstudents = array();
		$studentlists 	= $memberList->getStudentLists($classmaillist[$i], 0);
		foreach($studentlists as $st) 
		{
			if ($st->getEmail()) {
				$sst = $st;
				$clstudents[] = $st->getEmail();
				$clstudents[] = $mailtoparent->SendToParent($title, $messages, $st, $reportcard);
			}
		}
		$tolists[] = $clstudents;
	}
	
	$toclass = "[";
	for ($i = 0; $i < count($tolists); $i+=2) {
		$toclass .= $tolists[$i]. ", "; 
	}
	$mailtoparent->SendToLIA($title, $messages, $toclass, $sst);

	$tolists[] = $this->addEmail($title, $messages, 1, $reportcard, $tolists, 0);
	
	
	return $tolists;
}

function sendEmailToGroupStudents($title, $messages, $classmaillist)  {
	$tolists = array();

	$memberList = new MemberList();
	$mailtoparent = new MailToParent();
	
	$cls_nb = count($classmaillist);
	$sst = "";
	for ($i = 0; $i < $cls_nb; $i++) {
		$tolists[] =  $classmaillist[$i];
		$emailstring = "";
		$clstudents = array();
		$studentlists 	= $memberList->getStudentLists($classmaillist[$i], 0);
		foreach($studentlists as $st) 
		{
			if ($st->getEmail()) {
				$sst = $st;
				if ($emailstring) {
					$emailstring .=", ";
				}
				$emailstring .= $mailtoparent->getStudentEmail($st);
			}
		}
		if ($emailstring) {
			$clstudents[] = $emailstring;
			$clstudents[] = $mailtoparent->SendToGroupParent($title, $messages, $emailstring);
		}
		$tolists[] = $clstudents;
		
	}

	$toclass = "[";
	for ($i = 0; $i < count($tolists); $i+=2) {
		$toclass .= $tolists[$i]. ", "; 
	}
	$mailtoparent->SendToLIA($title, $messages, $toclass, $sst);
	
	$tolists[] = $this->addEmail($title, $messages, 0, 0, $tolists, 0);
	
	return $tolists;
}


function sendEmailToAllStudent($title, $messages, $sendby, $classmaillist, $reportcard, $resend = 0)  {

	if ($sendby == 1) {
		 return $this->sendEmailToStudents($title, $messages, $classmaillist, $reportcard);
	}
	else {
		return $this->sendEmailToGroupStudents($title, $messages, $classmaillist);
	}
}

function showReSendEmailForm($emailid, $url="")  
{
	$eclass = new EmailClass();
	if ($eclass->getEmailById($emailid)) {
		$messages = $eclass->getSubject();
		$title = $eclass->getTitle();
		$sendby = $eclass->getGroups();
		$reportcard = $eclass->getReportCard(); 
		$classmaillist = explode(",", $eclass->getClasses());
		$emaillist = $eclass->getSendKO();
	}
	else {
		$messages = "message";
		$title = "title";
		$sendby = 1;
		$classmaillist = array();
		$emaillist = "";
		$reportcard = 0;
	}

?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD  class=lcenter>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center >
<TR>
	<TD class=background valign=top>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=30>Sending Email Report	</TD>
		</TR>
		<TR><TD class=email_txt><div class=email_txt>
<?php 
	if ($sendby == 1) {
		$tolists =  $this->ResendEmailToStudents($title, $messages, $classmaillist, $emaillist, $reportcard, $emailid);
	} else {
		$tolists =  $this->ResendEmailToGroupStudents($title, $messages, $classmaillist,  $emaillist, $emailid) ;
	}
	$n_to = count($tolists)-1; /* last element is report */
	for ($i = 0; $i < $n_to; $i+=2) { 
		echo("<p>".($i/2+1). ". " .$tolists[$i]. "</p>");	
		$elem = $tolists[$i+1];
		for ($j = 0; $j < count($elem); $j+=2) {
			if ($elem[$j+1] == 1) {
				echo("<div class=email_txt2>Email to " .$elem[$j]. " <font color=green>OK!</font></div>");
			}
			else {
				echo("<div class=email_txt2>Email to " .$elem[$j]. " <font color=red>Faild!</font></div>");
			}		
		}
	}
	if ($tolists[$n_to][1] == 0) {
		echo("<div align=center><br><br><a href='../admin/admin.php?action=sendtoparents&emailid=".$tolists[$n_to][0]."'>Try to send again</a></div>");
	}
?>
		</div></TD></TR>
		</TABLE>
	</TD>
</TR>

<TR><TD height=20 class=labelleft></TD></TR>
<TR>
	<TD class=background valign=top height=100>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder height=80>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=30>
				Email Message  
			</TD>
		</TR>
	<TR>
		<TD class=email_txt valign=top>
		<div class=email_txt>
		<?php 
			echo("<p>" .$title. "</p>");
			echo("<p>" .$messages. "</p>");
		?>
		</div>
		</TD></TR>
		</TABLE>
	</TD>
</TR>


		<TR><TD height=20 class=labelleft></TD></TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php
}
	
function showSendEmailForm($sendtype, $url="")  
{
	$classmaillist = $this->getClassEmailList();
	
	$messages = getPostValue("messages");
	$title = getPostValue("msgtitle");
	$sendby = getPostValue("sendby");
	$reportcard = getPostValue("reportcard");
	$err = "Error : ";
	$haserr = 0;
	$cls_nb = count($classmaillist);
	if ($cls_nb == 0) {
		$err .= "No Selected Class. ";
		$haserr = 1;
	}
	if (!$title) {
		$err .= "No Title For Email .";
		$haserr = 1;
	}
	else {
		//$title = replace($title);
	}
	if ($messages) {
		$messages = replace($messages);	
	}
if ($haserr) {
	$this->showEmailForm($classmaillist, $title, $messages, $sendby, $reportcard, $err, $url);
}
else {
	
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD  class=lcenter>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center >
<?php if ($sendtype == 0) {	?>
<TR>
	<TD class=background valign=top height=100>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder height=80>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=30>
				Preview Email  
			</TD>
		</TR>
	<TR>
		<TD class=email_txt valign=top>
		<div class=email_txt>
		<?php 
			$mailtoparent = new MailToParent();
			$memberList = new MemberList();
			$studentlists 	= $memberList->getStudentLists($classmaillist[0], 0);
			foreach($studentlists as $st) 
			{
				$mailtext = $mailtoparent->getEmailText($title, $messages, $st, $reportcard);
				echo("<p>" .$mailtext. "</p>");
				break;
			}
		?>
		</div>
		</TD></TR>
		</TABLE>
	</TD>
</TR>
<?php } else { ?>	
<TR>
	<TD class=background valign=top>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=30>
				Sending Email Report  
			</TD>
		</TR>
		<TR><TD class=email_txt><div class=email_txt>
<?php 
	$tolists = $this->sendEmailToAllStudent($title, $messages, $sendby, $classmaillist, $reportcard);
	$n_to = count($tolists)-1; /* last element is report */
?>

<?php for ($i = 0; $i < $n_to; $i+=2) { 
		echo("<p>".($i/2+1). ". " .$tolists[$i]. "</p>");	
		$elem = $tolists[$i+1];
		for ($j = 0; $j < count($elem); $j+=2) {
			if ($elem[$j+1] == 1) {
				echo("<div class=email_txt2>Email to " .$elem[$j]. " <font color=green>OK!</font></div>");
			}
			else {
				echo("<div class=email_txt2>Email to " .$elem[$j]. " <font color=red>Faild!</font></div>");
			}		
		}
	}
	if ($tolists[$n_to][1] == 0) {
		echo("<div align=center><br><br><a href='../admin/admin.php?action=sendtoparents&emailid=".$tolists[$n_to][0]."'>Try to send again</a></div>");
	}
?>
		</div></TD></TR>
		</TABLE>
	</TD>
</TR>
<?php } ?>
<TR><TD height=20 class=labelleft></TD></TR>
<TR>
	<TD>
		<?php $this->showEmailForm($classmaillist, $title, $messages, $sendby, $reportcard, '', $url); ?>
	</TD>
</TR>


		<TR><TD height=20 class=labelleft></TD></TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php
}
}
	

function findClassInList($classlist, $clsname) {
	if ($classlist && $clsname) {
		for ($i = 0; $i < count($classlist); $i++)  {
			if ($classlist[$i] && $classlist[$i] == $clsname) {
				return 1;
			}
		}
	}
	return 0;
}

function showEmailForm($classlists, $msgtitle, $messages, $sendby, $reportcard, $err, $url="")  
{	
	global $CLASS_NAME, $STUDENT_VAR;
	$class_nb = (int) (count($CLASS_NAME) / 2)-1;
	if ($url) {
		$action = $url;
	}
	else {
		$action = "member.php";
	}
?>
<FORM action='<?php echo($action); ?>' method=post>
<INPUT type=hidden name='classnumber' value='<?php echo($class_nb); ?>'>		
<INPUT type=hidden name='action' value='sendtoparents'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD class=error height=30><?php echo($err); ?></TD></TR>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
		<TR>
			<TD width=100% class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=30>
						<b>Select The Classes To Send Email To Students's Parents</b>
					</TD>
				</TR>
				
				<TR>
					<TD class=listtext>
<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
<TR><TD height=10 class=listtext></TD></TR>
<TR>
	<TD class=listtext>
		<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
		<TR><TD height=10 colspan=4 class=listtext></TD></TR>
<?php
	for ($i = 0; $i <$class_nb; $i+=4){ 
		$n = $i;
		$clsname = $CLASS_NAME[$n*2];
?>
		<TR>
			<TD class=listtext width=25% height=20>
				<?php if ($this->findClassInList($classlists, $clsname)) { ?>
				<INPUT class=box type='checkbox' name='selectclass_<?php echo($n); ?>' value='1' checked>
				<?php } else { ?>
				<INPUT class=box type='checkbox' name='selectclass_<?php echo($n); ?>' value='1'>
				<?php  } ?>
				<INPUT NAME='classname_<?php echo($n); ?>' TYPE=HIDDEN VALUE='<?php echo($clsname); ?>' >
				<?php echo($clsname); ?>
			</TD>
			<TD class=listtext width=25%>
<?php
		$n = $i+1;
		if ($n < $class_nb) { 
			$clsname = $CLASS_NAME[$n*2];
			if ($this->findClassInList($classlists, $clsname)) { ?>
				<INPUT class=box type='checkbox' name='selectclass_<?php echo($n); ?>' value='1' checked>
			<?php } else { ?>
				<INPUT class=box type='checkbox' name='selectclass_<?php echo($n); ?>' value='1'>
			<?php  } ?>
				<INPUT NAME='classname_<?php echo($n); ?>' TYPE=HIDDEN VALUE='<?php echo($clsname); ?>' >
			<?php echo("Class " .$clsname); 	}?>
			</TD>
			<TD class=listtext width=25%>
	<?php 
		$n = $i+2;
		if ($n < $class_nb) { 
			$clsname = $CLASS_NAME[$n*2];
					
			if ($this->findClassInList($classlists, $clsname)) { ?>
				<INPUT class=box type='checkbox' name='selectclass_<?php echo($n); ?>' value='1' checked>
			<?php } else { ?>
				<INPUT class=box type='checkbox' name='selectclass_<?php echo($n); ?>' value='1'>
			<?php  } ?>
				<INPUT NAME='classname_<?php echo($n); ?>' TYPE=HIDDEN VALUE='<?php echo($clsname); ?>' >
			<?php echo("Class " .$clsname); 	}?>
			</TD>
			<TD class=listtext width=25%>
	<?php 
		$n = $i+3;
		if ($n < $class_nb) { 
			$clsname = $CLASS_NAME[$n*2];
					
			if ($this->findClassInList($classlists, $clsname)) { ?>
				<INPUT class=box type='checkbox' name='selectclass_<?php echo($n); ?>' value='1' checked>
				<?php } else { ?>
				<INPUT class=box type='checkbox' name='selectclass_<?php echo($n); ?>' value='1'>
				<?php  } ?>
				<INPUT NAME='classname_<?php echo($n); ?>' TYPE=HIDDEN VALUE='<?php echo($clsname); ?>' >
			<?php echo("Class " .$clsname); 	}?>
			</TD>
		</TR>
		<?php } ?>
		<TR><TD height=10 colspan=4 class=listtext></TD></TR>
		</TABLE>

	</TD>
</TR>

<TR><TD height=20 class=listtext></TD></TR>
</TABLE>

					</TD>
				</TR>
				<TR>
					<TD class=listtext>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD height=10 colspan=2 class=listtext></TD></TR>
<TR>
	<TD class=listtext height=30 width=15%><div align=right>Send by : &nbsp;&nbsp;</div></TD>
	<TD class=listtext>
		<?php if ($sendby == 1) { ?>
			<INPUT class=box type='radio' name='sendby' value='0' > Group
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<INPUT class=box type='radio' name='sendby' value='1' checked> Individual
		<?php } else { ?>
			<INPUT class=box type='radio' name='sendby' value='0' checked > Group
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<INPUT class=box type='radio' name='sendby' value='1' > Individual
		<?php  } ?>
	</TD>
</TR>
<TR>
	<TD class=listtext height=30><div align=right>Variables : &nbsp;&nbsp;</div></TD>
	<TD class=listtext>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
		<?php for ($i = 0; $i <count($STUDENT_VAR); $i++) { ?>
			<TD class=listtext height=30 >
				<font color=#008000 size=2><?php echo($STUDENT_VAR[$i]); ?></font>
			</TD>
		<?php } ?>
		</TR>
		</TABLE>
	</TD>
</TR>

<TR>
	<TD class=listtext height=30><div align=right>ReportCard : &nbsp;&nbsp;</div></TD>
	<TD class=listtext>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=listtext height=30 >
			 
				<?php if ($reportcard) { ?>
				<INPUT class=box type='checkbox' name='reportcard' value='1' checked >
				<?php } else { ?>
				<INPUT class=box type='checkbox' name='reportcard' value='1'>
				<?php  } ?> Yes
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>

<TR>
	<TD class=listtext height=20><div align=right>TITLE : &nbsp;&nbsp;</div></TD>
	<TD class=listtext>
		<INPUT class=fields type=text size=80 name="msgtitle" value="<?php echo($msgtitle); ?>">
	</TD>
</TR>


<TR>
	<TD class=listtext valign="top"><div align=right>MESSAGE : &nbsp;&nbsp;</div></TD>
	<TD class=listtext>
		<textarea name="messages" id="messages" cols="70" rows="20" class="area-fields" ><?php echo($messages); ?></textarea>
	</TD>
</TR>
<TR><TD height=10 colspan=2 class=listtext></TD></TR>
</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=20 class=labelleft></TD></TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=40 class=labelright width=100%>
				<div align=center>
				<INPUT class=button type=submit name="sendmail" value=' Send '>
				<INPUT class=button type=submit name="viewmail" value=' View '>
				<INPUT class=button type=submit name="reset" value=' Reset '>
			</div>
			</TD>
		</TR>
		<TR><TD height=15 colspan=2>&nbsp;</TD></TR>
		</TABLE>
	</TD>
</TR>

</TABLE>
</FORM>
	
<?php	
}

function findStudentIDInList($maillist, $email) {
	if ($maillist && $email) {
		for ($i = 0; $i < count($maillist); $i++)  {
			if ($maillist[$i] && $maillist[$i] == $email) {
				return 1;
			}
		}
	}
	return 0;
}

function getSelectedStudents() 
{
	$maillist = array();
	$nb = getPostValue("emailnumber");
	for ($i = 1; $i <= $nb; $i++) {
		if (getPostValue("student_".$i)) {
			$maillist[] = getPostValue("stid_".$i);
		}
	}
	return $maillist;
}

function showSendClassEmailForm($preview, $url="")  
{
	$classname = getPostValue("classname");
	$messages = getPostValue("messages");
	$title = getPostValue("msgtitle");
	$reportcard = getPostValue("reportcard");
	
	$_SESSION['email_title'] 	= $title;
	$_SESSION['email_message'] 	= $messages;
	
	$err = "Error : ";
	$haserr = 0;
	$selectedlist = $this->getSelectedStudents();
	$st_nb = count($selectedlist);
	if ($st_nb == 0) {
		$err .= "No Selected Student. ";
		$haserr = 1;
	}
	if (!$title) {
		$err .= "No Title For Email .";
		$haserr = 1;
	}
	if ($messages) {
		$messages = replace($messages);	
	}
	
if ($haserr) {
	$this->showClassEmailForm($classname, $selectedlist, $title, $messages, $reportcard, $err, $url);
}
else {
	$mailtoparent = new MailToParent();
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<?php if ($preview) {	?>
<TR>
	<TD class=background valign=top height=100>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder height=80>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=30>
				Preview Email  
			</TD>
		</TR>
	<TR>
		<TD class=email_txt valign=top>
		<div class=email_txt>
<?php 
		$student = new StudentClass();
		$student->getUserByID($selectedlist[0]);
		$mailtext = $mailtoparent->getEmailText($title, $messages, $student, $reportcard);
		echo("<p class=email_txt>" .$mailtext. "</p>");
?>
		</div>
		</TD></TR>
		</TABLE>
	</TD>
</TR>
<?php } else { ?>	

<TR>
	<TD class=background valign=top>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=30>
				Sending Email Report  
			</TD>
		</TR>
		<TR><TD class=email_txt><div class=email_txt>
		<?php 	
			$student = new StudentClass();
			$nn = 1;
			foreach($selectedlist as $stid) {
				$student->getUserByID($stid);
				if ($student->getEmail()) {
					echo("<p class=email_txt2>".$nn++. ". Send Email to " .$student->getEmail()); 
					if ($mailtoparent->SendToParent($title, $messages, $student, $reportcard) == 1) {
						echo(" <font color=green>Success</font>!</p>");
					}
					else {
						echo(" <font color=red>Faild</font>!</p>");
					}
				}
			}							
		?>
		</div></TD></TR>
		</TABLE>
	</TD>
</TR>
<?php } ?>
		</TABLE>
	</TD>
</TR>
<TR><TD height=20></TD></TR>
<TR>
	<TD>
		<?php $this->showClassEmailForm($classname, $selectedlist, $title, $messages, $reportcard, '', $url); ?>
	</TD>
</TR>
</TABLE>
	
<?php
}
}
	

function showClassEmailForm($classname, $stidlist, $msgtitle, $messages, $reportcard, $err, $url='')  
{
	global $STUDENT_VAR, $CLASS_NAME;
	$mList = new MemberList();
	$studentlists = $mList->getStudentLists($classname, 0);
	$student_nb = count($studentlists);
	$n_mail = 0;
	if ($url) {
		$action = $url;
	}
	else {
		$action = "member.php";
	}
?>
<FORM action='<?php echo($action); ?>' method=post>
<INPUT type=hidden name='classname' value='<?php echo($classname); ?>'>		
<INPUT type=hidden name='action' value='sendmailtomember'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD class=error height=30><?php echo($err); ?></TD></TR>
<?php if ($url) { ?>
<TR>
	<TD class=labelright height=40><div align=center>
		Select Class :
		<select name="select_class" onChange='window.location="<?php echo($url); ?>?action=sendclassemail&classes=" + this.value;'>
	<?php
		$nb_cls =  count($CLASS_NAME) - 2;
		for ($i = 0; $i < $nb_cls; $i+=2) {
			if ($classname == $CLASS_NAME[$i] || $classname == $i) {
				echo ("<option  value=".$i." selected> " .$CLASS_NAME[$i]." </option>");
			} else {
				echo ("<option value=".$i."> " .$CLASS_NAME[$i]. " </option>");
			}
		}
	?>
		</select> </div>
	</TD>
</TR>
<?php } ?>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
		<TR>
			<TD width=100% class=ITEMS_LINE_TITLE>
				<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=30>
						<b>Select Students From <?php echo(getClassName($classname)); ?> Class To Send Email</b>
					</TD>
				</TR>				
				<TR>
					<TD class=listtext>
<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align=center>
<TR><TD height=10 colspan=2 class=listtext></TD></TR>
<TR>
	<TD class=listtext width=100%>
		<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align=center>
		<TR><TD height=10 colspan=4 class=listtext></TD></TR>
<?php 	$i = 0;
		while ($i < $student_nb) {
?>
		<TR>
<?php 	$n = 0;
		while ($n < 3) {
			if ($i < $student_nb) {
				$st = $studentlists[$i++];
				$email = $st->getEmail();
				$stname = $st->getStudentName();
				$stid = $st->getID();
				if ($email) {
					$n++;
					$n_mail++;
?>
			<TD class=listtext width=33% height=20>
			<?php if ($this->findStudentIDInList($stidlist, $stid)) { ?>
				<INPUT class=box type='checkbox' name='student_<?php echo($n_mail); ?>' value='1' checked>
			<?php } else { ?>
				<INPUT class=box type='checkbox' name='student_<?php echo($n_mail); ?>' value='1'>
			<?php  } echo($stname); ?>
				<INPUT type=hidden name='stid_<?php echo($n_mail); ?>' value='<?php echo($stid); ?>'>	
			</TD>
<?php 
				}
			} else {		$n++;	
?>			
			<TD class=listtext width=33%> </TD>
<?php 
			}
		}
?>
		</TR>
		<?php } ?>
		<TR>
			<TD height=10 colspan=3>
				<INPUT type=hidden name='emailnumber' value='<?php echo($n_mail); ?>'>		
			</TD>
		</TR>
		</TABLE>

	</TD>
</TR>

<TR><TD height=10 colspan=2 class=listtext></TD></TR>
</TABLE>

					</TD>
				</TR>
				<TR>
					<TD class=listtext>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD height=10 colspan=2 class=listtext></TD></TR>
<TR>
	<TD class=listtext height=30><div align=right>Variables : &nbsp;&nbsp;</div></TD>
	<TD class=listtext>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
		<?php for ($i = 0; $i <count($STUDENT_VAR); $i++) { ?>
			<TD class=listtext height=30 >
				<font color=#008000><?php echo($STUDENT_VAR[$i]); ?></font>
			</TD>
		<?php } ?>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD class=listtext height=30><div align=right>ReportCard : &nbsp;&nbsp;</div></TD>
	<TD class=listtext>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=listtext height=30 >
			 
				<?php if ($reportcard) { ?>
				<INPUT class=box type='checkbox' name='reportcard' value='1' checked >
				<?php } else { ?>
				<INPUT class=box type='checkbox' name='reportcard' value='1'>
				<?php  } ?> Yes
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>

<TR>
	<TD class=listtext height=20><div align=right>TITLE : &nbsp;&nbsp;</div></TD>
	<TD class=listtext height=30>
		<INPUT class=fields type=text size=90 name="msgtitle" value="<?php echo($msgtitle); ?>">
	</TD>
</TR>


<TR>
	<TD class=listtext valign="top"><div align=right>MESSAGE : &nbsp;&nbsp;</div></TD>
	<TD class=listtext>
		<textarea name="messages" id="messages" cols="78" rows="20" class="area-fields" ><?php echo($messages); ?></textarea>
	</TD>
</TR>
<TR><TD height=10 colspan=2 class=listtext></TD></TR>
</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=20 class=labelleft></TD></TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=40 class=labelright width=100%>
				<div align=center>
				<INPUT class=button type=submit name="sendmail" value=' Send '>
				<INPUT class=button type=submit name="viewmail" value=' View '>
				<INPUT class=button type=submit name="reset" value=' Reset '>
			</div>
			</TD>
		</TR>
		<TR><TD height=15 colspan=2>&nbsp;</TD></TR>
		</TABLE>
	</TD>
</TR>

</TABLE>
</FORM>
	
<?php	
}

}
?>
