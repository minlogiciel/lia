<?php
require ("../php/allinclude.php");
session_start();
require ("forum_include.php");
$err = '';

$forum = new ForumForm();
$action = getAction();
$mess_id = getMessageID();
$mess = "";
$showmenu = 1;
if (isset($action)) {
	if (($action == "addsubject") || ($action == "addresponse")) {
		$showmenu = 0;
		$mess = $forum->getForumMessage();
		if ($mess->getError()) {
			$err = $mess->getError();
			$mess_id = $mess->getParent();
		}
		else {
			$forum_class = new forum_class();
			$mess_id = $forum_class->addMessage($mess);
			$mess = '';
			//$mess_id = addForumMessage($action);
			$showmenu = 1;
		}
	}
	else if (($action == "newsubject")  ||  ($action == "showmessage")) {
		$showmenu = 0;
	}
}


include ("../php/header.php");

?>
<TABLE width=950 cellspacing=0 cellpadding=0 align=center>
	<TR>
		<TD valign=top>
		<table width=100% height=550 cellspacing=0 cellpadding=0 align=center>
			<tr>
				<td width=200 valign=top class=ITEMS_BG><?php include "../forum/forum_left.php"; ?></td>
				<td width=750 valign=top>
				<table width=98% cellspacing=0 cellpadding=0 align=center>
					<tr>
						<td height=10></td>
					</tr>
					<tr>
						<td><?php $forum->forum_bar($showmenu); ?></td>
					</tr>
					<tr>
						<td width=100%>
						<TABLE border=0 cellPadding=0 cellSpacing=0 width=100%>
							<tr>
								<td width=100% valign=top>
<?php
if ($action == "addsubject") {
	if ($err) {
		$forum->addSubject($mess, $err);
	}
	else {
		$forum->showList();
	}
}
else if ($action == "newsubject") {
	$forum->addSubject('', '');
}
else if ($action == "addresponse") {
	$forum->showSubject($mess_id, $mess, $err);
}
else if ($action == "showmessage") {
	
	$forum->showSubject($mess_id, $mess, $err);
}
else {
	$forum->showList();
}
?>
								</td>
							</tr>
						</TABLE>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<TR>
				<td colspan=2 class=forum-border height=2></td>
			</TR>
		</table>
		</td>
	</tr>
</TABLE>
<?php 
include "../php/footer.php"; 
?>
