<?php 

$MAX_DETAIL_ITEM = 10;

$G_DETAIL_2 = array(
array(	"Following directions", "Phonics", "Words in context", "Spelling", "Synonyms, antonyms & compound words",  	        		         		       	
		"More difficult words", "Grammar & usage", "Capitalization & punctuation", "Verbal reasoning", "Reading comprehension"),           	        		         		                                    
array(	"Cardinal, ordinal number & number pattern", "Place value, comparing, ordering & rounding", "'+' & '-' facts & operation without regrouping",
		"'+' & '-' with regrouping", "'x' & '÷' concepts", "Fractional parts", "Time & money", "Graph", "Shapes & measurement", "Problem solving")
);

$G_DETAIL_3 = array(
array(	"Vocabulary", "Spelling", "Capitalization", "Punctuation", "Usage", "Reading Comprehension"),           	        		         		                                    
array(	"Numeration", " Number property", "3 or 4 digit '+' & '-'",
		"2 or 3 digit 'x' & '÷'", "Decimal & fraction", "Time & money", "Geometry & measurement", "Graph", "Problem solving")
);


$G_DETAIL_4 = array(
array(	"Vocabulary", "Spelling", "Capitalization", "Punctuation", "Usage", " Reading comprehension I", "Reading comprehension II"),           	        		         		                                    
array(	"Number theory", "Addition & subtraction", "Multiplication & division",
		"Fraction", "Decimal", "Average & probability", "Time & money","Measurement & geometry", "Problem solving")
);

                                                    			               
$G_DETAIL_5 = array(
array(	"Vocabulary", "Spelling", "Capitalization & punctuation", "Grammar & usage", "Reading Comprehension"),           	        		         		                                    
array(	"Number theory", "Addition & subtraction", "Multiplication & division", "Exponents",
		"Fraction", "Decimal", " Probability & statistics", "Measurement & geometry", "Problem solving")
);



$G_DETAIL_6 = array(
array(	"Vocabulary", "Spelling", "Capitalization", "Punctuation", "Usage", "Reading Comprehension"),           	        		         		                                    
array(	"Number theory", "Fundamental operations", "Fraction & decimal", "Exponents & scientific notation",
		"Percent & ratio", "Integer & equation", " Probability", "Measurement", "Geometry", "Problem solving")
);


$G_DETAIL_7 = array(
array(	"Vocabulary", "Capitalization", "Punctuation", "Usage", "Reading Comprehension"),           	        		         		                                    
array(	"Number theory", "Fraction & decimal", "Percent & ratio", "Order of operation & properties",
		"Integers", "Algebra", "Probability & statistics ", "Measurement & geometry", "Problem solving")
);


$G_DETAIL_8 = array(
array(	"Vocabulary", "Capitalization", "Punctuation", "Usage", "Language expression", "Reading Comprehension"),           	        		         		                                    
array(	"Number & pattern", "Ratio, proportion & percent", "Algebra", "Geometry & measurement",
		"Probability & statistics", " Problem solving", "Regents - Integrated Algebr")
);


$G_DETAIL_9 = array(
array(	"Vocabulary - synonyms", "Vocabulary - sentence completion", "Language mechanics", "Language expression", "Reading Comprehension"),           	        		         		                                    
array(	"Number theory & property", "Fraction, decimal & percent", "Ratio & proportion", "Algebra",
		"Probability & statistics", " Measurement & geometry", "Problem solving", "Regents - Integrated Algebra", " Regents - Geometry")
);


$G_DETAIL_10 = array(
array(	"Sentence completion", "Regular reading", "Paired reading", "Identifying sentence error", "Improving sentence", "Improving paragraphs"),           	        		         		                                    
array(	"PSAT regular math", "Algebra II", "Trigonometry",
		"Identifying sentence error", "Improving sentence ", "Improving paragraphs")
);


$G_DETAIL_11 = array(
array(	"Sentence completion", "Short reading", "Long reading", "Pared reading", "Improving sentence", "Identifying sentence error",
		"Improving paragraph", "Easy questions", "Medium difficult questions", "Hard questions"),           	        		         		                                    
array(	"Numeration", "Algebra", "Geometry", "Data analysis", "Easy questions", 
		"Medium difficult question", "Hard questions", "Multiple choice questions", "Student-produced response questions")
);


function getGradeSubjectItems($grade) {
	global $G_DETAIL_2, $G_DETAIL_3, $G_DETAIL_4, $G_DETAIL_5, $G_DETAIL_6, $G_DETAIL_7, $G_DETAIL_8, $G_DETAIL_9, $G_DETAIL_10, $G_DETAIL_11;

	switch ($grade) {
		case 2:
			return $G_DETAIL_2;
		case 3:
			return $G_DETAIL_3;
		case 4:
			return $G_DETAIL_4;
		case 5:
			return $G_DETAIL_5;
		case 6:
			return $G_DETAIL_6;
		case 7:
			return $G_DETAIL_7;
		case 8:
			return $G_DETAIL_8;
		case 9:
			return $G_DETAIL_9;
		case 10:
			return $G_DETAIL_10;
		case 11:
			return $G_DETAIL_11;
		default :
			return $G_DETAIL_2;
	}
}


?>