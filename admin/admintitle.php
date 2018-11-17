<?php 
$mtype = isset($_POST["mtype"]) ? $_POST["mtype"] : (isset($_GET["mtype"]) ? $_GET["mtype"] : 0);
$curr_url = $_SERVER["PHP_SELF"]; 
$_SESSION['prev_url'] = $curr_url; 
$loginok = 0;
$loguser = '';
if (isset($_SESSION['log_user_name'])) {
	$loguser = $_SESSION['log_user_name'];
}


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
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
					<TD class=TITLE_LINE>
					</TD>
				</TR>
				<TR>
					<TD class=TITLE_LINE height=40>
						<div align=left></div>
					</TD>
				</TR>
				<TR>
					<TD class=TITLE_LINE height=20 >
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width="100%">
				<TR>
					<TD class=TITLE_BAR width=100% background=../images/header_barre_fond.gif height=20>
						<div align=center> 
							<?php
								for ($i = 0; $i < count($ADDINFOITEMS); $i++) {
									$types = $i;
									if ($types == $CLASS_TYPE) {
										echo("<A  href='../member/member.php'>$ADDINFOITEMS[$i]</A>&nbsp;&nbsp;&nbsp;&nbsp;");
									}
									else if ($types == $STUDENT_TYPE) {
										echo("<A  href='../member/student.php'>$ADDINFOITEMS[$i]</A>&nbsp;&nbsp;&nbsp;&nbsp;");
									}
									else if ($types == $PSESSION_TYPE) {
										echo("<A  href='../private/private.php'>$ADDINFOITEMS[$i]</A>&nbsp;&nbsp;&nbsp;&nbsp;");
									}
									else if ($mtype == $types) {
										echo($ADDINFOITEMS[$i]."&nbsp;&nbsp;&nbsp;&nbsp;");
									}
									else {
										echo("<A  href='../admin/admin.php?mtype=$types'>$ADDINFOITEMS[$i]</A>&nbsp;&nbsp;&nbsp;&nbsp;");
									}
								} 
							?>
						</div>
					</TD>
				</TR>
				<TR><TD class=TITLE_LINE height=2></TD></TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>

