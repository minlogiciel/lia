<?php 
include ("../php/title.php"); 

if ($ACTIVE_LOGIN)
	$_SESSION['start_time'] = time();

?>
<BODY>
<CENTER>
<TABLE  width=950 cellspacing=0 cellpadding=0 align=center>
<TR>
	<TD>
		<TABLE  width=100% cellspacing=0 cellpadding=0 align=center >
		<TR>
			<TD><?php include "../php/maintitle.php"; ?></TD>
		</TR>
		<TR>
			<TD class=background>
