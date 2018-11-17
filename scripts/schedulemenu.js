function setHomePhoto(sel, nn) 
{
	var tphoto = document.getElementById('tphoto_'+nn);
	var nindex = sel.selectedIndex;
	if (nindex > 0){
		tphoto.value  	= CPHOTOLIST[nindex-1][1];
	}
	else {
		tphoto.value  	= "";
	}
} 

function setSchduleTitle3(sel, nn) 
{
	var title = document.getElementById('title_'+nn);
	var tvar = document.getElementById('tvariable_'+nn);
	var tdocfile = document.getElementById('tdocfile_'+nn);
	var tphoto = document.getElementById('tphoto_'+nn);
	var nindex = sel.selectedIndex;
	var vstr = sel.value;
	if (nindex > 0){
		var res = vstr.split("|"); 
		tvar.value 		= res[1];
		title.value  	= res[2].split("*-").join(" ")
		tdocfile.value 	= res[3].split("*-").join(" ")
		tphoto.value 	= res[4].split("*-").join(" ")
	}
	else {
		title.value  = "";	
		tvar.value = "";
		tphoto.value  = "";	
		tdocfile.value = "";
	}
} 

function setSchduleTitle(sel, nn) 
{
	var title = document.getElementById('title_'+nn);
	var tvar = document.getElementById('tvariable_'+nn);
	var tphoto = document.getElementById('tphoto_'+nn);
	var tdocfile = document.getElementById('tdocfile_'+nn);
	var nindex = sel.selectedIndex;
	if (nindex > 0){
		title.value  	= SCHEDULELISTS[nindex-1][1];
		tphoto.value  	= SCHEDULELISTS[nindex-1][3];	
		tdocfile.value 	= SCHEDULELISTS[nindex-1][2];
		tvar.value 		= SCHEDULELISTS[nindex-1][0];
	}
	else {
		title.value  = "";	
		tvar.value = "";
		tphoto.value  = "";	
		tdocfile.value = "";
	}
} 

function setTopPhoto(nn, ff) 
{ 
	if (ff == 0) {
		var tphoto = document.getElementById('tdocfile_'+nn);
		var pathname = document.getElementById('docfile_'+nn).value;
	}
	else {
		var tphoto = document.getElementById('tphoto_'+nn);
		var pathname = document.getElementById('photo_'+nn).value;
	}
	var startIndex = (pathname.indexOf('\\') >= 0 ? pathname.lastIndexOf('\\') : pathname.lastIndexOf('/'));
	var filename = pathname.substring(startIndex);
	if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
		filename = filename.substring(1);
	}
	tphoto.value  = filename;
} 

