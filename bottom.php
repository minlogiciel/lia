<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<style type=text/css>
.C01 {	
	COLOR:#fffffe; BACKGROUND-COLOR: #000033; FONT-SIZE: 12px; text-align : center; FONT-WEIGHT: bold;
}
</style>
<body bgColor="#000033" text="#fffffe" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">

<?php 

$ip = $_SERVER['REMOTE_ADDR'];
include_once("./geoip/geo_include.php");
include_once("./database/sql/ConnectClass.php");
include_once("./utils/utils.php");
include_once("./database/sql/sql_server.php");
include_once("./database/sql/sql_class.php");
include_once("./php/logging.php");

$con_addr = new ConnectClass();
$con_addr->addUserIP($ip, "home");

?>

<table width=100% border="0" cellspacing="0" cellpadding="0">
<tr> 
	<td class=C01 width=15% valign=bottom>
		<?php 
			include "counter.php"; 
			$hits = get_hits();
			print_hits($hits); 
		?>
	</td>
	<td class=C01 width=70% valign=bottom>
		Copyright &nbsp;&#169;&nbsp;&nbsp; - 2011 <font color=red><em>L.I.A.</em></font> - All rights reserved.
	</td>
	<td class=C01  width=15% valign=bottom>
	</td>
</tr>
</table>

</body>

</html>
