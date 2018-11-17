<?php 
class LoginForm {

function getLoginTitleForm($title) {
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
	
	
function getLoginForm() {
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR><TD height=40></TD></TR>
<TR><TD height=40><H1> Connect To Student Account </H1></TD></TR>
<TR><TD height=40></TD></TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=90% border=0  align=center>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
				<TR>
					<TD height=25 class=formlabel2>
						<img src="../images/puce_red.gif" border=0>&nbsp;&nbsp;Connect to your account
					</TD>
				</TR>
				<TR>
					<TD>
					<FORM method=post action="../member/login.php">
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
									<INPUT type=text class=fields size=20 name="log_name" value="">
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
									<INPUT type=password class=fields maxLength=20 size=20 name="log_passwd" value="">
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
				
				<TR>
					<TD height=40 class=formlabel2>
						<img src="../images/puce_red.gif" border=0>&nbsp;&nbsp;Forgot your password
					</TD>
				</TR>
				<TR>
					<TD>
						<FORM method=post action="../member/login.php">
						<INPUT NAME=action TYPE=HIDDEN VALUE="getpasswd">
						<TABLE cellSpacing=0 cellPadding=0 width=90% border=0 align=center>
						<TR>
							<TD class=formlabel width=45%>
								<DIV align=right>Your Email : &nbsp;&nbsp;&nbsp;&nbsp;</DIV>
							</TD>
							<TD class=formlabel width=55%>
								<DIV align=left><INPUT type=text class=fields size=40 name="your_email" value=""></DIV>
							</TD>
						</TR>
						<TR>
							<TD class=formlabel colspan=2 height=50>
								<div align=center><INPUT type="submit" class=button size=10 value=" Get Password "></div>
							</TD>
						</TR>
						<TR><TD height=20 colspan=2 class=formlabel>&nbsp;</TD></tr>
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

function showResultForm($title, $result) 
{
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR><TD height=40></TD></TR>
<TR><TD height=40><H1> <?php echo($title); ?> </H1></TD></TR>
<TR><TD height=40></TD></TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=90% border=0  align=center>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
				<TR>
					<TD height=100>
						<div align=center>
							<font color="blue" size=3><b><?php echo($result)?></b></font>
						</div>
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

function getAccountForm($student) 
{
	if ($student) {
		$studentid = $student->getID();
	}
	else {
		$studentid = 0;
	}
?>	
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR><TD height=40></TD></TR>
<TR><TD height=40><H1> My Account </H1></TD></TR>
<TR><TD height=40></TD></TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=90% border=0  align=center>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
				<TR>
					<TD>
						<FORM method="post" action="login.php">
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
								
						<TR>
							<TD height=25 class=formlabel2>
								<img src="../images/puce_red.gif" border=0>&nbsp;&nbsp;Change my infomation
							</TD>
						</TR>
		        		<TR>
							<TD>
								<?php $this->changeInfomationForm($student); ?>
							</TD>
		        		</TR>
						<TR>
							<TD class=background height=50>
								<div align=center>
									<INPUT NAME=studentid TYPE=HIDDEN VALUE="<?php echo($studentid); ?>">
									<INPUT NAME=action TYPE=HIDDEN VALUE="changeinfo">
									<INPUT type="submit" class=button NAME="update" value=" Update " id="saveinofid" disabled="disabled">
									<INPUT type="submit" class=button NAME="reset" value=" Reset ">
								</div>
							</TD>
						</TR>
						</TABLE>
						</FORM>
					</TD>
				</TR>
        		<TR><TD height=20>&nbsp;</TD></TR>

				<TR>
					<TD>
						<FORM method=post action="../member/login.php">
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
							
						<TR>
							<TD height=25 class=formlabel2>
								<img src="../images/puce_red.gif" border=0>&nbsp;&nbsp;Change my password
							</TD>
						</TR>
		        		<TR>
							<TD>
								<?php $this->change_mypassword_from($student); ?>
							</TD>
		        		</TR>
						<TR>
							<TD class=background height=50>
								<div align=center>
									<INPUT NAME=studentid TYPE=HIDDEN VALUE="<?php echo($studentid); ?>">
									<INPUT NAME=action TYPE=HIDDEN VALUE="changepass">
									<INPUT type="submit" class=button name="update" value=" Update " id="savepasswdid" disabled="disabled">
									<INPUT type="submit" class=button name="reset" value=" Reset ">
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

function showMyAccountDetailForm($student) 
{
	$pseudo 		= "";
	$user_email 	= "";
	$user_name 		= "";
	$user_street1 	= "";
	$user_street2 	= "";
	$user_city 		= "";
	$user_postcode 	= "";
	$user_department 	= "";
	$user_country 	= "";
	$user_phone 	= "";
	$user_class		= "";
	$user_grade		= "";
	$user_rm		= "";
	$user_birthday 	= "";
	$notes 			= "";
	if ($student) {
		$pseudo 		= $student->getPseudo();
		$user_email 	= $student->getEmail();
		$civil = $student->getCivil();
		if ($civil == 'F')
			$civil = "Ms.";
		else 
			$civil = "Mr.";
		
		$user_name 		= $civil." ".$student->getFirstName()." ".$student->getLastName();
		$user_birthday 	= $student->getBirthDay();
		$user_class 	= $student->getClasses();
		$user_grade 	= $student->getGrade();
		$user_rm 		= $student->getRM();
		
		$user_street1 	= $student->getStreet1();
		$user_street2 	= $student->getStreet2();
		$user_city  	= $student->getCity();
		$user_postcode 	= $student->getPostCode();
		$user_department = $student->getProvence();
		$user_country 	= $student->getCountry();
		$user_phone 	= $student->getPhone();
		$user_mobile 	= $student->getMobile();
		$notes 			= $student->getComments();
	}

?>	
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR><TD height=40></TD></TR>
<TR><TD height=40><H1> My Account Detail </H1></TD></TR>
<TR><TD height=40></TD></TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=90% border=0  align=center>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		        		<TR>
							<TD>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
								<TR><TD colspan=2 height=20></TD></TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;Name :</TD>
									<TD class=LIST_LINE2><?php echo($user_name); ?></TD>
								</TR>
								<TR>
									<TD class=labelright width=30% height=25>&nbsp;&nbsp;Login Name : </TD>
									<TD class=LIST_LINE2  width=70%><?php echo($pseudo); ?></TD>
								</TR>
								<TR>
									<TD class=labelright width=30% height=25>&nbsp;&nbsp;Birthday : </TD>
									<TD class=LIST_LINE2  width=70%><?php echo($user_birthday); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;Grade : </TD>
									<TD class=LIST_LINE2><?php echo($user_grade); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;Class : </TD>
									<TD class=LIST_LINE2><?php echo($user_class); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;RM : </TD>
									<TD class=LIST_LINE2><?php echo($user_rm); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;Email : </TD>
									<TD class=LIST_LINE2><?php echo($user_email); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;Street : </TD>
									<TD class=LIST_LINE2><?php echo($user_street1. " " .$user_street2); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;City :</TD>
									<TD class=LIST_LINE2><?php echo($user_city); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;Zip Code : </TD>
									<TD class=LIST_LINE2><?php echo($user_postcode); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;State : </TD>
									<TD class=LIST_LINE2><?php echo($user_department); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;Country : </TD>
									<TD class=LIST_LINE2><?php echo($user_country); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;Phone : </TD>
									<TD class=LIST_LINE2><?php echo($user_phone); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;Cell : </TD>
									<TD class=LIST_LINE2><?php echo($user_mobile); ?></TD>
								</TR>
								<TR>
									<TD class=labelright height=25>&nbsp;&nbsp;Notes : </TD>
									<TD class=LIST_LINE2><?php echo($notes); ?></TD>
								</TR>
								</TABLE>
							</TD>
		        		</TR>
		        		</TABLE>
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

function changeInfomationForm($student) 
{
	
	$pseudo 		= "";
	$user_email 	= "";
	$user_name 		= "";
	$user_street1 	= "";
	$user_street2 	= "";
	$user_city 		= "";
	$user_postcode 	= "";
	$user_department 	= "";
	$user_country 	= "";
	$user_phone 	= "";
	
	if ($student) {
		$pseudo 		= $student->getPseudo();
		$user_email 	= $student->getEmail();
		$civil = $student->getCivil();
		if ($civil == 'F')
			$civil = "Ms.";
		else 
			$civil = "Mr.";
		
		$user_name 		= $civil." ".$student->getFirstName()." ".$student->getLastName();
		
		$user_class 	= $student->getClasses();
		
		$user_street1 	= $student->getStreet1();
		$user_street2 	= $student->getStreet2();
		$user_city  	= $student->getCity();
		$user_postcode 	= $student->getPostCode();
		$user_department 	= $student->getProvence();
		$user_country 	= $student->getCountry();
		$user_phone 	= $student->getPhone();
		$user_mobile 	= $student->getMobile();
	}
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Your Name :</TD>
	<TD class=LIST_LINE2><?php echo($user_name); ?></TD>
</TR>
<TR>
	<TD class=labelright width=30% height=25>&nbsp;&nbsp;Login Name : </TD>
	<TD class=LIST_LINE2  width=70%><?php echo($pseudo); ?></TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Your Class : </TD>
	<TD class=LIST_LINE2><?php echo($user_class); ?> </TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Email : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=40 name="email" value="<?php echo($user_email); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Street : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=40 name="street" value="<?php echo($user_street1. " " .$user_street2); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;City :</TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=40 name="city" value="<?php echo($user_city); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Zip Code : </TD>
	<TD class=formlabel>
		<INPUT size=20 class=fields type=text name="postcode" value="<?php echo($user_postcode); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;State : </TD>
	<TD class=formlabel>
		<INPUT size=20 class=fields type=text name="department" value="<?php echo($user_department); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Phone : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=40 name="phone"  value="<?php echo($user_phone); ?>" onclick="active_save();">
	</TD>
</TR>
<TR>
	<TD class=labelright height=25>&nbsp;&nbsp;Cell : </TD>
	<TD class=formlabel>
		<INPUT class=fields type=text size=40 name="mobile"  value="<?php echo($user_mobile); ?>" onclick="active_save();">
	</TD>
</TR>
</TABLE>
<?php
}

function change_mypassword_from($student) 
{
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=labelright height=25 width=45%>Old Password : </TD>
	<TD class=formlabel width=55%><INPUT type=password maxLength=20 size=20 name="passwd" value="" onclick="active_savepasswd();"></TD>
</TR>
<TR>
	<TD class=labelright height=25>New Password : </TD>
	<TD class=formlabel><INPUT type=password maxLength=20 size=20 name="new_pass" value="" onclick="active_savepasswd();"></TD>
</TR>
<TR>
	<TD class=labelright height=25>Re-type New Password : </TD>
	<TD class=formlabel><INPUT type=password maxLength=20 size=20 name="new_pass1" value="" onclick="active_savepasswd();"></TD>
</TR>
</TABLE>
<?php
}


}
?>