<?php 

class LiaFileClass {
	var $PublicFilePath = "../public";
	var $TextFileExt = ".txt";
	
	function isQuestionLine($line) {
		if (strlen($line) > 1) {
			if (is_numeric($line[0]))
				return 1;
		}
		return 0;
	}

	function isResponseLine($line) {
		if (strlen($line) > 1) {
			if (($line[0] == 'A') || ($line[0] == 'B') || ($line[0] == 'C') || ($line[0] == 'D') || ($line[0] == 'E') || ($line[0] == 'F'))
				return 1;
		}
		return 0;
	}

	function getQuestionLine($tab, $cn, $nStart) {
		$elem = array();
		for ($i = 0; $i < $cn; $i++) {
			$elem[$i] = $tab[$i + $nStart];
		}
		return $elem;
	}

	function getTestFileQuestions($fileName) {
		$tab = array();
		$cn = 0;
		$rn = 0;
		$lines = file($fileName);
		foreach($lines as $line)
		{
			$line = trim($line);
			if (strlen($line) > 0) {
				$tab[$rn++] = $line;
				if ($this->isQuestionLine($line)) {
					$cn = 0;
				}
				$cn++;		
			}
		}
		
		$arr = array();
		if ($rn > 0) {
			for ($i = 0; $i < $rn; $i+= $cn) {
				$arr[] = $this->getQuestionLine($tab, $cn, $i);
			}
		}
		return $arr;
	}

	function ffgetTestFileQuestions($fileName) {
		$tab = array();
		$cn = 0;
		$rn = 0;
		$lines = file($fileName);
		foreach($lines as $line)
		{
			$line = trim($line);
			if (strlen($line) > 0) {
				if ($this->isQuestionLine($line)) {
					$cn = 0;
					$elem = array();
					$elem[$cn++] = $line;
					foreach($lines as $line)
					{
						$line = trim($line);
						$len = strlen($line);
						if ($len > 0) {
							$elem[$cn++] = $line;
							if ($len == 1) {
								break;
							}
						}
					}
					$tab[$rn++] = $elem;
				}
			}
		}
		return $tab;
	}
	
	function getGradeLevel($filename) {
		$n = 11;
		list($suject, $subsuj, $grade, $level, $numero) = explode("_", $filename);
		if ($level && (strlen($level) > 0) && is_numeric($level)) {
			$n = intval($level);
		}
		return $n;
	}
	function getPublicTextFileList($dirName, $type) {
		$dir = $this->PublicFilePath. "/" .$dirName;
		$files = array("","","","","","","","","","","","",""); 
		$nf = 0;
		if ($handle = opendir($dir)) { 
			while (false !== ($file = readdir($handle))) { 
				if ($file != "." && $file != ".." && strstr($file, $this->TextFileExt)) { 
					$level = $this->getGradeLevel($file);
					if ($level > 0)
						$files[$level] = $dir. "/" .$file; 
					else
						$files[$nf++] = $dir. "/" .$file;
				} 
			}
			closedir($handle); 
		} 
		return $files;
	}
}
?>
