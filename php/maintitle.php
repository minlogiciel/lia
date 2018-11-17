<?php 

$loguserid = '';
if (isset($_SESSION['log_user_id'])) {
	$loguserid = $_SESSION['log_user_id'];
}


$MITEM = array(
	"Home",				"../home/",
	"About Us",			"../about/",
	"Homework",			"../homework/", 
	"Class Schedule",	"../schedule/",
	"Forum",			"../forum/", 
	"Sign on",			"../member/", 
	"Register",			"../member/register.php", 
//	"Teacher Account",	"../teacher/", 
	"Logout",			"../member/logout.php", 
);

?> 

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR>
			<TD width=280  class=TITLE_LINE>
				<div align=left><A  href="../home/"><IMG src="../images/lia_logo.png" border=0></a></div>
			</TD>
			<TD  class=TITLE_LINE>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" align="center">
						<TR>
							<TD width=10%  height=30 class=TITLE_LINE> </TD>
							<TD  class=TITLE_LINE>
							<div align=right>
								<?php 
									$nitem =  count($MITEM);
									if (!$loguserid) {
										$nitem -= 2; /* should not show logout item */
									}
									for ($i = 0; $i < $nitem; $i+= 2) {
										$menuitem = $MITEM[$i];
										echo("<A  class=SCHEDULE_BAR href='".$MITEM[$i+1]. "'>" .$menuitem. "</A> &nbsp;");
									} 
								?>
							</div>
							</TD>
							<TD width=3%  class=TITLE_LINE>
								
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				<TR>
					<TD class=TITLE_LINE >
						<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
						<TR>
							<TD width=50% class=TITLE_LINE> 
							</TD>
							<TD width=50% class=TITLE_LINE >
								<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
								<TR>
									<TD class=TITLE_LINE height=50>
										<div align=center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Tel. (516) 364-2121</b></div>
									</TD>
								</TR>
								<TR>
									<TD class=TITLE_LINE>
										<div align=center><font color="yellow"><b>303 Sunnyside Blvd. Suite #10, Plainview, NY 11803
										</b></font></div>
									</TD>
								</TR>
								<TR>
									<TD class=TITLE_LINE>
										<div align=center><font color="yellow"><b>&nbsp;
										</b></font></div>
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
<?php 
	$lnews = "";
	for ($l = 0; $l < count($LASTNEWS); $l++) {
		$lnews .= $LASTNEWS[$l]. "&nbsp;&nbsp;";
	}
?>

<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
				<TR>
					<TD class=TITLE_BAR height=20 background=../images/header_barre_fond.gif width=20%>
						<div align=left>&nbsp;&nbsp;<?php showDate(); ?></div>
					</TD>
					<TD class=TITLE_BAR width=60% background="../images/header_barre_fond.gif" width=65%>
						<MARQUEE width=550 onmouseover=this.stop() onmouseout=this.start() trueSpeed scrollAmount=1 scrollDelay=25 direction=left>
						<?php echo("<font color=red>". $lnews. "</font>");	?>
						</MARQUEE>
					</TD>
					<TD  class=TITLE_BAR width=20%  background="../images/header_barre_fond.gif" width=15%>
						<div align=right>
						<A  href='../php/contact.php'>Contact Us</A> &nbsp;
						</div>
					</TD>
				</TR>
				<TR><TD class=TITLE_LINE height=2 colspan=3></TD></TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>

