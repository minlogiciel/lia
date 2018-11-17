<?php

class ForumForm {
	var $SHOW_MESSAGE_NB =10;
	
function espases($level) {
	for ($i = 1; $i < $level; $i++)
	echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
}
function lineclass($n) {
	if (($n % 2) == 0)
	echo("forum-line1");
	else
	echo("forum-line2");
}
	
function getForumMessage() {
	$subject 	= $_POST['forum_subject'];
	$title 		= $_POST['forum_subject'];
	$autor 		= $_POST['forum_autor'];
	$text 		= $_POST['forum_text'];
	$level 		= $_POST['forum_level'];

	if (isset($_POST['forum_parent'])) {
		$parent = $_POST['forum_parent'];
	}
	else {
		$parent = 0;
	}
	
	if (isset($_POST['groups'])) {
		$groups = $_POST['groups'];
	}
	else {
		$groups = 0;
	}

	$msg = new forum_base();
	$msg->setMessageElement($title, $text, $autor, $groups, $parent, $level);
	return $msg;
	
}
	
function showSubject($mess_id, $msg, $err) {
	$groups = getMessageGroup();
	$levle 	= 1;
	$title 	= "";
	$sujet 	= "";
	$mess 	= '';
	if ($groups) {
		$forum_class 	= new forum_class;
		$g_mess  		= $forum_class->getSujectNews($groups);
		$mess  			= getCurrentMessage($mess_id, $g_mess);
		if ($mess) {
			$level = $mess->getLevel() + 1;
			$title = $mess->getTitle();
			$sujet = $mess->getSubject();
		}
	}
?>
<TABLE border=0 cellPadding=0 cellSpacing=0 width=100%  align=center>
<tr><td width=100% valign=top height=10></td></tr>
<TR>
	<TD width=100% valign=top>
		<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% align=center>
		<TR>
			<TD width=100% valign=top>
				<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% align=center>
				<TR>
					<TD><?php $this->show_message_details($mess); ?></TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<tr><td width=100% valign=top height=20></td></tr>
		<tr>
			<td class=error><?php echo($err); ?></td>
		</tr>
		<tr>
			<td width=100% valign=top>
				<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% align=center>
				<TR>
					<td class=forum-border height=1 width=100%></td>
				</TR>
				<TR>
					<TD>
					<TABLE border=0 cellPadding=0 cellSpacing=0 width=100% align=center>
					<?php
					$children = $g_mess->getChildren();
					if ($children) {
						$this->show_children_messages($g_mess, $mess_id, $children);
					}
					else {
						$this->show_messages_line($g_mess);
					}
					?>
					</TABLE>
					</TD>
				</TR>
				<TR>
					<td class=forum-border height=2 width=100%></td>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<tr>
			<td width=100% valign=top height=20></td>
		</tr>
		<tr>
			<td width=100% valign=top>
				<FORM action="../forum/index.php" method=post>
				<INPUT type=hidden value="addresponse" name="action"> 
				<INPUT type=hidden value="<?php echo ($level); ?>" name=forum_level>
				<INPUT type=hidden value=<?php echo ($mess_id); ?> name=forum_parent> 
				<INPUT type=hidden value=<?php echo ($groups); ?> name="groups">
				<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
				<TR>
					<TD><?php $this->addmessageform("RP : " . $title, $msg); ?></TD>
				</TR>
				</TABLE>
				</FORM>
			</td>
		</tr>
		<tr>
			<td width=100% height=20></td>
		</tr>
		</table>
	</TD>
</TR>
</TABLE>
<?php 
}


function addSubject($msg, $err) {
?>

<TABLE border=0 cellPadding=0 cellSpacing=2 width=100% class=forumbar align=center>
	<tr>
		<td class=error><?php echo($err); ?></td>
	</tr>
	<tr><td height=10></td></tr>
	<tr>
		<td width=100% valign=top>
		<TABLE border=0 cellPadding=0 cellSpacing=2 width=100% class=forumbar>
			<tr>
				<td width=100% valign=top>
				<FORM action="../forum/index.php" method=post>
				<INPUT type=hidden value="addsubject" name="action"> 
				<INPUT type=hidden value="1" name="forum_level">
				<TABLE cellSpacing=0 cellPadding=0 width=100% align=center border=0>
					<TR>
						<TD><?php $this->addmessageform('', $msg); ?></TD>
					</TR>
				</TABLE>
				</FORM>
				</td>
			</tr>
		</TABLE>
		</td>
	</tr>
</TABLE>
<?php 
}

function showList() {
	$curr_page = getCurrentPage();
	$start_nb = ($curr_page-1) * $this->SHOW_MESSAGE_NB;

	$forum_class = new forum_class;
	$lists 	= $forum_class->getNewsFrom($start_nb, $this->SHOW_MESSAGE_NB);
	$max_page 	= $forum_class->getMaxPageNumber();

?>

<TABLE border=0 cellPadding=0 cellSpacing=0 width=100%>
<tr> <td height=5></td> </tr>
<tr>
	<td width=100%>
		<TABLE border=0 cellPadding=0 cellSpacing=1 width=100%>
			<tr>
				<td width=100% valign=top>
				<TABLE border=0 cellPadding=0 cellSpacing=2 width=100%>
					<TR>
						<TD width=100% valign=top>
						<TABLE border=0 cellPadding=0 cellSpacing=1 width=100%>
							<TR>
								<td width=60% class=forum-list-title height=25 colspan=2>TITLE</td>
								<td width=5% class=forum-list-title>RESP</td>
								<td width=15% class=forum-list-title>NAME</td>
								<td width=20% class=forum-list-title>DATE</td>
							</TR>
							<?php
							if ($lists) {
								for ($i = 0; $i < count($lists); $i++) {
									$mid	 	= $lists[$i]->getID();
									$title 		= $lists[$i]->getTitle();
									$autor 		= $lists[$i]->getAutor();
									$times 		= getDateTime($lists[$i]->getCreateTime());
									$level 		= $lists[$i]->getLevel();
									$number 	= $lists[$i]->getResponse();
									$groups		= $lists[$i]->getGroup();
									?>
							<TR>
								<td valign=top class=<?php $this->lineclass($i); ?> width=50>
									<IMG src="../images/forum_g2.gif">
								</td>
								<td valign=top class=<?php $this->lineclass($i); ?> width=56%><div align=left>
									<a href='../forum/index.php?action=showmessage&<?php echo("groups=$groups&mid=$mid&level=$level");?>'>
									<font size=2><b><?php echo($title); ?></b></font></a></div>
								</td>
								<td class=<?php $this->lineclass($i); ?>>
									<div align=center><?php echo($number); ?>&nbsp;&nbsp;</div>
								</td>
								<td class=<?php $this->lineclass($i); ?>>
									<div align=right><font size=1 color=black><?php echo($autor); ?>&nbsp;&nbsp;</font></div>
								</td>
								<td class=<?php $this->lineclass($i); ?>>
									<div align=right><font size=1><?php echo($times); ?>&nbsp;&nbsp;</font></div>
								</td>
							</TR>
							<?php
								}
							}
							?>
						</TABLE>
						</TD>
					</TR>
					<tr>
						<td width=100% valign=top height=20></td>
					</tr>
				</TABLE>
				</td>
			</tr>
		</TABLE>
		</td>
	</tr>
</table>

<?php 
}

function addmessageform($title, $mess) {
	$autor = "";
	$text = "";
	if ($mess) {
		$title 	= $mess->getTitle();
		$autor 	= $mess->getAutor();
		$text 	= $mess->getText();
	}
?>
<TABLE cellSpacing=1 cellPadding=0 width=100% align=center border=0 class=forum-border>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
		<TR>
			<TD class=white>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
				<TR>
					<TD colSpan=4 height=10></TD>
				</TR>
				<TR>
					<TD>
						<div align=right><B>TITLE :&nbsp;&nbsp;</B></div>
					</TD>
					<TD colSpan=3>
						<div align=left><INPUT maxLength=60 size=60 name=forum_subject	value="<?php echo($title); ?>"></div>
					</TD>
				</TR>
				<TR>
					<TD colSpan=4 height=5></TD>
				</TR>
				<TR>
					<TD width=15%>
						<div align=right><B>YOUR NAME :&nbsp;&nbsp;</B></div>
					</TD>
					<TD width=35%>
						<div align=left><INPUT maxLength=20 size=15 name=forum_autor value="<?php echo($autor); ?>"></div>
					</TD>
					<TD width=25%></TD>
					<TD width=25%></TD>
				</TR>
				<TR>
					<TD colSpan=4 height=5></TD>
				</TR>
				<!-- TR>
					<TD>
						<div align=right><B>EMAIL :&nbsp;&nbsp;</B></div>
					</TD>
					<TD colSpan=3>
						<div align=left><INPUT maxLength=60 size=60 name=forum_email></div>
					</TD>
				</TR>
				<TR>
					<TD colSpan=4 height=15></TD>
				</TR -->

				<TR>
					<TD valign=top>
						<div align=right><B>MESSAGE :&nbsp;&nbsp;</B></div>
					</TD>
					<TD colspan=3>
						<div align=left><TEXTAREA name=forum_text rows=10 wrap=virtual	cols="60"><?php echo($text); ?></TEXTAREA></div>
					</TD>
				</TR>
				<TR>
					<TD colSpan=4 height=15></TD>
				</TR>
				<TR>
					<TD vAlign=top align=right height=30 colspan=4>
						<INPUT class=button type=submit value=" Send "> 
						<input class=button type=reset name="cancel" value="Reset">
					</TD>
				</TR>
				<TR>
					<TD colSpan=4 height=10></TD>
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
function forum_bar($showmenu) { 
	
	$curr_page = getCurrentPage();
	$start_nb = ($curr_page-1) * $this->SHOW_MESSAGE_NB;
	
	$forum_class = new forum_class;
	$lists 	= $forum_class->getNewsFrom($start_nb, $this->SHOW_MESSAGE_NB);
	$max_page 	= $forum_class->getMaxPageNumber();
		
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD width=5%  height=25 class=TITLE_BAR background='../images/header_barre_fond.gif'>&nbsp;</TD>
	<td width=60% height=25 class=TITLE_BAR background='../images/header_barre_fond.gif'>
	<?php if ($showmenu) {
		$prev_page = $curr_page-1;
		$next_page = $curr_page+1;
		if ($curr_page > 1) {
			echo("<a href='../forum/?pages=".$prev_page."'><b> &laquo; Previous</b></a>&nbsp;&nbsp;&nbsp;");
		} else {
			echo("&laquo; Previous &nbsp;&nbsp;&nbsp;");
		} 
	?> 
		<select	STYLE='width: 50; align: center' onchange="window.open('../forum/?pages='+this.value,'_self')">
	<?php 
		for ($i = 1; $i <= $max_page; $i++) {
			if ($i == $curr_page) {
				echo ("<option value=". $i ." selected>" .$i . "</option>");
			}
			else {
				echo ("<option value=". $i .">" .$i . "</option>");
			}
		} 
	?>
		</select> 
	<?php 
		if ($curr_page < $max_page) {
			echo("&nbsp;&nbsp;&nbsp;<a href='../forum/?pages=".$next_page."'> <b>Next &raquo;</b></a>&nbsp");
		}
		else {
			echo("&nbsp;&nbsp;&nbsp;Next &raquo; &nbsp;");
		}
	}
	?>
	</td>
	<td width=10% class=TITLE_BAR background='../images/header_barre_fond.gif'></td>
	<td width=15% class=TITLE_BAR background='../images/header_barre_fond.gif'>
		<div align=center>
			<a href="../forum/?action=newsubject">New Message</a>
		</div>
	</td>
	<td width=15% class=TITLE_BAR background='../images/header_barre_fond.gif'>
		<div align=center>
			<a href="../forum/">Back</a>
		</div>
	</td>
</TR>
</TABLE>									 
<?php 
}


function show_message_details($mess) { 
	
	$createTime = $mess->getCreateTime();
	$title = $mess->getTitle();
	$text = $mess->getText();
?>
<TABLE border=0 cellPadding=0 cellSpacing=1 width=100% class=forum-border>
<TR>
	<TD>
		<TABLE border=0 cellPadding=0 cellSpacing=0 width=100%>
		<TR>
			<td class=forum height=10 colspan=3></td>
		</TR>
		<TR>
			<td width=3% class=forum height=20></td>
			<td class=forum-time valign=top>
				<?php echo( getDateTime($createTime) ); ?>
			</td>
			<td width=3% class=forum></td>
		</TR>
		<TR>
			<td class=forum height=30></td>
			<td class=forum-title valign=top>
				<?php echo($title); ?>
			</td>
			<td class=forum></td>
		</TR>
		<TR>
			<td class=forum height=100></td>
			<td class=forum-text valign=top>
				<?php echo(str_replace("\n","<br>",$text)); ?>
			</td>
			<td class=forum></td>
		</TR>
		<TR>
			<td class=forum height=20 colspan=3></td>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}

function show_messages_line($mess) {
	$mid 	= $mess->getID();
	$title 	= $mess->getTitle();
	$autor 	= $mess->getAutor();
	$dates 	= $mess->getCreateTime();
?>

<TR>
	<td width=80% class=forum-line2><?php 	$this->espases(1); ?> &nbsp;&nbsp;
		<IMG src='../images/forum_g1.gif'>&nbsp;&nbsp;&nbsp; 
		<font size=2 color=#888888><b> <?php echo($title); ?></b></font>&nbsp;&nbsp;&nbsp;&nbsp;
		<font size=1 color=navy><?php echo(getDateTime($dates)); ?></font>
	</td>
	<td width=20% class=forum-line2>
		<div align=right><font size=1 color=navy><?php echo($autor); ?>ss</font>&nbsp;&nbsp;&nbsp;&nbsp;</div>
	</td>
</TR>

<?php 
}

function show_children_messages($mess, $mess_id, $children, $nn=0) {
if ($mess) {
	$mid 	= $mess->getID();
	$title 	= $mess->getTitle();
	$autor 	= $mess->getAutor();
	$dates 	= $mess->getCreateTime();
?>

<TR>
	<td width=80% class=forum-line2><?php 	$this->espases(1); ?> &nbsp;&nbsp;
		<IMG src='../images/forum_g1.gif'>&nbsp;&nbsp;&nbsp; 
		<?php 
			if ($mess_id==$mid) {
				echo("<font color=#888888 size=2>" . $title . "</font>");
			} else {
				echo("<a href='../forum/index.php?action=showmessage&groups=$mid&mid=$mid&level=1'>");
				echo("<font size=2><b>" . $title . "</b></font></a>");
			}	
			echo("&nbsp;&nbsp;&nbsp;&nbsp;<font size=1 color=navy>".getDateTime($dates)."</font>"); 
		?>
	</td>
	<td width=20% class=forum-line2>
		<div align=right><font size=1 color=navy><?php echo($autor); ?></font>&nbsp;&nbsp;&nbsp;&nbsp;</div>
	</td>
</TR>

<?php
}

$len = 0;
$hasChild = 0;
if ($children)   {
	$len = count($children);
}
for ($i=0; $i < $len; $i++) {
	$level 	= $children[$i]->getLevel();
	$mid 	= $children[$i]->getID();
	$sujet 	= $children[$i]->getSubject();
	$title 	= $children[$i]->getTitle();
	$autor 	= $children[$i]->getAutor();
	$dates 	= $children[$i]->getCreateTime();
	$groups = $children[$i]->getGroup();
	$n_line = $i + $nn;

	$c_list = $children[$i]->getChildren();
	if ($c_list && count($c_list) > 0)
		$hasChild = 1;
	else
		$hasChild = 0;
?>
<TR>
	<td width=80% class=<?php $this->lineclass($n_line); ?>><?php 	$this->espases($level); ?>&nbsp;&nbsp;
	<?php 
		if ($hasChild) { 
			if ($mess_id==$mid) 
				echo("<IMG src='../images/forum_g1.gif'>");
			else
				echo("<IMG src='../images/forum_g2.gif'>");
		}
		else { 
			echo("<IMG src='../images/forum_g4.gif'>");	
		} 
		echo("&nbsp;&nbsp;&nbsp;"); 
		if ($mess_id==$mid) {
			echo("<font color=#888888 size=2>" . $title . "</font>");
		} else {
			echo("<a href='../forum/index.php?action=showmessage&groups=$groups&mid=$mid&level=$level'>");
			echo("<font size=2><b>" . $title . "</b></font></a>");
		}
		echo("&nbsp;&nbsp;&nbsp;&nbsp;<font size=1 color=navy>".getDateTime($dates)."</font>"); 
	?>
	</td>
	<td width=20% class=<?php $this->lineclass($n_line); ?>>
		<div align=right><font size=1 color=navy><?php echo($autor); ?></font>&nbsp;&nbsp;&nbsp;&nbsp;</div>
	</td>
</TR>

<?php
	if ($c_list) {
		$n_line += show_children_messages('', $mess_id, $c_list, ($n_line+1));
	}
}
return $n_line;
}

}
?>