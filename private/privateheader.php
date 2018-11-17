<?php 
// Execute un refresh de la page en PHP
$delai=900; 
$url='../private/private.php';
if ($action == "") {
	header("Refresh: $delai;url=$url");
}
?>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="refresh" content="DELAI;url=URL" /> 
<title>Long Island Academy</title>
<link rel="stylesheet" type="text/css" href="../css/calendrier.css">
<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>


<SCRIPT language=JavaScript>
function setfilename(form) {

	document.adminform.filename.value = form.file.value;
}
</SCRIPT>

<BODY>
<TABLE  width=950 cellspacing=2 cellpadding=0 align=center bgColor=#cacaca>
<TR>
	<TD>
		<TABLE  width=950 cellspacing=0 cellpadding=0 align=center bgColor=#FFFFFF>
		<TR>
			<TD><?php include "../admin/admintitle.php"; ?></TD>
		</TR>
		<TR>
			<TD class=background>
