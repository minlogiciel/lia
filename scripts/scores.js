
function get_class_scores_teacher(clname, prog) 
{ 
/* should copy to classvar.php */
/*
var CLASS_TEACHER_NAME = [
["PS-B", 	"Mr. Holtz", 					"Mr. Holtz"],
["PS-A", 	"Ms. Schwarz/Mr Holtz", 		"Ms. Tweeddale"],
["IS-C",	"Ms. Schwarz/Mr Holtz" ,		"Ms. Fanelli"	],
["IS-A", 	"Ms. Carlson / Mr. Mechanic", 	"Ms. Tweeddale"],
["HS-D1",	"Ms. Carlson / Mr. Mechanic", 	"Mr. Echausse"],
["HS-D2", 	"Ms. Carlson / Mr. Mechanic", 	"Ms. Echausse"],
["HS-C",	"Ms. Carlson / Mr. Mechanic", 	"Ms. Fanelli"],
["HS-B",	"Ms. Difranco / Ms. Loizides", 	"Mr. Park"],
["HS-A1", 	"Ms. Difranco / Ms. Loizides",  "Mr. Park"],
["HS-A2", 	"Ms. Difranco / Ms. Loizides", 	"Mr. Park"],
];
*/
/*
var CLASS_TEACHER_NAME = [
	["PS-B", "Mr. Holtz", "Mr. D", 4],
	["PS-A", "Mr. Holtz", "Mr. Rubin", 5],
	["IS-C", "Mr. Schmidt", "Dr. Link", 6],
	["IS-A", "Mr. Kirchenberg", "Mr. Marini", 7],
	["HS-D1", "Mr. Storck", "Dr. Link", 8],
	["HS-D2", "Mr. Storck", "Mr. Marini", 8],
	["HS-C1", "Mr. Storck", "Mr. Rubin", 9],
	["HS-C2", "Mr. Storck", "Ms. Paddock", 9],
	["HS-B", "Mr. Kirchenberg", "Ms. Paddock", 10],
	["TUTO", "", "", "12"]
];

*/	
	for (i=0; i < CLASS_TEACHER_NAME.length; i++) { 
		var cln = CLASS_TEACHER_NAME[i];
		if (cln[0] == clname )
		{ 
			return cln[prog+1];
		} 
		if (clname == i*2 )
		{ 
			return cln[prog+1];
		} 
	} 
	return " ";
} 


function change_title() 
{ 
	 var subj = document.getElementById("subjects");
	 var neng = document.getElementById("nenglish");
	 var nmath = document.getElementById("nmath");
	 var teng = document.getElementById("tenglish");
	 var tmath = document.getElementById("tmath");
	 var ty = document.getElementById("types");
	 var lab = document.getElementById("titles");
	 var titles = "";
	 if (ty.selectedIndex == 1) { 
		 if (subj.selectedIndex == 0) { 
			 titles =  "TEST #" + teng.value;
		 } else { 
			 titles =  "TEST #" + tmath.value;
		 }
	 }
	 else if (ty.selectedIndex == 2) { 
		 if (subj.selectedIndex == 0) { 
			 titles =  "EXAM";
		 } else { 
			 titles =  "EXAM";
		 }
	 }
	 else { 
		 if (subj.selectedIndex == 0) { 
			 titles =  "HW #" + neng.value;
		 } else { 
			 titles =  "HW #" + nmath.value;
		 }
	 }
	lab.value = titles;
	document.getElementById("savebuttonid").disabled='';
} 

function change_teacher() 
{ 
	 var subj = document.getElementById("subjects");
	 var cls = document.getElementById("classname");
	 var lab = document.getElementById("teacher");

	 lab.value = get_class_scores_teacher(cls.value, subj.selectedIndex);
	 change_title();

} 
