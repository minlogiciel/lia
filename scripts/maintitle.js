
function menu() {
	var MITEM = [
		"Home",				"../home/",
		"About Us",			"../about/",
		"Homework",			"../homework/", 
		"Class Schedule",	"../schedule/",
		"Forum",			"../forum/", 
		"Sign on",			"../member/", 
		"Register",			"../member/register.php", 
	//	"Teacher Account",	"../teacher/", 
		"Logout",			"../member/logout.php", 
	];
	
	var menu = document.querySelector("#mainmenu");
	menu.innerHTML = "";
	var nitem = MITEM.length;
	for (var i = 0; i < nitem; i+= 2) {
		menu.innerHTML += "<A class='SCHEDULE_BAR' href='" + MITEM[i+1] + "'>" +  MITEM[i] + "</A> &nbsp;";
	} 
	var marq = document.querySelector("#marqee");
	marq.innerHTML = "<font color=red>test maque</font>";
	var showdate = document.querySelector("#showdate");
	showdate.innerHTML = new Date();

}
