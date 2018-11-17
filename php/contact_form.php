<?php 

$action = "";
if (isset($_POST["action"])) {
	$action = $_POST["action"];
}
$error = "";
$yourname 		= "";
$email 			= "";
$phone 			= "";
$messages 		= "";
$show_form 		= 1;
$userdata = "";
if ($action == "getcontact") {
	$yourname 		= $_POST["yourname"];
	$email 			= $_POST["email"];
	$phone 			= $_POST["phone"];
	$messages 		= $_POST["messages"];
	
	$show_form = 0;

require ("../email/sendemail.php");
$sendemail = new sendemail();
$sendemail->email = $email;
$sendemail->name = $yourname;
$sendemail->texte = $messages;
$sendemail->sendemail();

}

if ($show_form) {
?>

<FORM action="../php/contact.php" method=post>
<INPUT type=hidden value="getcontact" name="action"> 
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0  align=center>
<TR>
	<TD width=100%>
		<TABLE cellSpacing=0 cellPadding=0 width="98%" border=0 align=center>
		<TR>
			<TD width=100%>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 align=center>
				
				<TR>
					<TD class=error>
						<?php echo($error) ?>
					</TD>
				</TR>
				<TR><TD height=10></TD></TR>
				<TR>
					<TD class=contactsoustitle height=20>
						<em>Use the following form to contact us or to provide us your feedback.</em>
					</TD>
				</TR>
				<TR><TD height=10></TD></TR>
				
				<TR>
					<TD>
						<TABLE cellSpacing=1 cellPadding=0 width="100%" border=0 align=center bgcolor=#aaaaaa>
						<TR>
							<TD bgcolor=#FFFFFF>
								<TABLE cellSpacing=0 cellPadding=0 width="90%" border=0 align=center>
								<TR>
									<TD class=contactsoustitle1 height=20 colspan=2>
										<em>Your Contact Information</em>
									</TD>
								</TR>
								
								<TR>
									<TD class=contacttext width=40%>
										Your Name : 
									</TD>
									<TD class=contacttext width=60%>
										<INPUT class=fields type=text size=40 name="yourname"  value="<?php echo($yourname); ?>">
									</TD>
								</TR>
								<TR><TD height=5 colspan=2></TD></TR>
								<TR>
									<TD class=contacttext>
										E-mail : 
									</TD>
									<TD class=contacttext>
										<INPUT class=fields type=text size=40 name="email"  value="<?php echo($email); ?>">
									</TD>
								</TR>
								<TR>
									<TD class=contacttext>
										Phone : 
									</TD>
									<TD class=contacttext>
										<INPUT class=fields type=text size=40 name="phone"  value="<?php echo($phone); ?>">
									</TD>
								</TR>
								<TR><TD height=5 colspan=2></TD></TR>
								<TR>
									<TD class=contacttext valign="top">
										Messages : 
									</TD>
									<TD class=contacttext>
										<textarea name="messages" id="messages" cols="26" rows="8" class="area-fields" ></textarea>
									</TD>
								</TR>
								<TR>
									<TD class=contacttext height=40 colspan=2>
										<div align=center><input type="submit" class="button_search" value="Send" /></div>
									</TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
<?php
}
else {
?>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0  align=center>
<TR>
	<TD width=100% valign=top>
		<TABLE cellSpacing=0 cellPadding=0 width="90%" border=0  align=center>
		<TR><TD height=10 valign=top></TD></TR>
		<TR>
			<TD class=DIR_TITLE height=20 valign=top>
				<div align=left><em> 
				Thank your messages :
				</em></div>
			</TD>
		</TR>
		<TR>
			<TD class=DIR_TEXT valign=top>
				<div align="justify"><?php echo($messages) ?></div>
			</TD>
		</TR>
		
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}
?>
