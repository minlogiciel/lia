<?php
class ExportClass {

	var $TT_STUDENT_BASE_NAME 	= "TTSTUDENTS";
	var $STUDENT_BASE_NAME 		= "STUDENTS";
	var $TEACHER_BASE_NAME 		= "TEACHERS";
	var $SCORES_BASE_NAME   	= "SSCORES";
	var $SCORESREF_BASE_NAME   	= "SCORES_REF";
	var $TUITION_BASE_NAME   	= "STUITION";
	var $CONNECT_BASE_NAME   	= "CONNECT_LIA";
	var $NEWS_BASE_NAME   		= "NEWS_V20";
	var $SCHEDULE_BASE_NAME   	= "SCHEDULE";
	var $PSESSIONS_BASE_NAME   	= "PSESSIONS";

	var $LASTNAME   			= "LASTNAME";
	var $GRADE   				= "GRADE";
	var $CLASS_COL				= "CLASSES";
	var $IDS_COL				= "IDS";
	
	var $DATABASE_OK  	= 1;


	var $connection	= '';

	function connect() {
		if (!$this->connection)
			$this->connection = new sql_class();
		return $this->connection;
	}

	function close() {
		if ($this->connection) {
			$this->connection->close();
			$this->connection = '';
		}
	}

	function ExportConnectBase($fp) {
		$elems = $this->connection->get_all_elements($this->CONNECT_BASE_NAME);
		if ($elems && count($elems) > 0) {
			$stClass = new ConnectClass();
			$text = "INSERT INTO " .$this->CONNECT_BASE_NAME. " " .$stClass->buildTableRef(). " VALUES \n";
			fwrite($fp, $text);
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setUserData($elems[$i]);
					
				$text = $stClass->getUserData();
				if ($i == $nb-1) {
					$text .= ";\n\n";
				}
				else {
					$text .= ",\n";
				}
				fwrite($fp, $text);
			}
		}
	}
	
	function ExportNewsBase($fp) {
		$elems = $this->connection->get_all_elements($this->NEWS_BASE_NAME);
		if ($elems && count($elems) > 0) {
			$stClass = new forum_base();
			$text = "INSERT INTO " .$this->NEWS_BASE_NAME. " " .$stClass->buildTableRef(). " VALUES \n";
			//$text = "INSERT INTO " .$this->NEWS_BASE_NAME. " ' ' VALUES \n";
			fwrite($fp, $text);
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setNewsData($elems[$i]);
					
				$text = $stClass->getNewsData();
				if ($i == $nb-1) {
					$text .= ";\n\n";
				}
				else {
					$text .= ",\n";
				}
				fwrite($fp, $text);
			}
		}
	}

	function ExportScheduleBase($fp) {
		$elems = $this->connection->get_all_elements($this->SCHEDULE_BASE_NAME);
		if ($elems && count($elems) > 0) {
			$stClass = new ScheduleClass();
			$text = "INSERT INTO " .$this->SCHEDULE_BASE_NAME. " " .$stClass->buildScheduleTableRef(). " VALUES \n";
			fwrite($fp, $text);
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setScheduleData($elems[$i]);
					
				$text = $stClass->getScheduleData();
				if ($i == $nb-1) {
					$text .= ";\n\n";
				}
				else {
					$text .= ",\n";
				}
				fwrite($fp, $text);
			}
		}
	}
	
	function ExportStudentBase($fp) {
		$elems = $this->connection->get_all_elements($this->STUDENT_BASE_NAME);
		if ($elems && count($elems) > 0) {
	
			$stClass = new StudentClass();
			$text = $stClass->getCreatTableString(). " \n";
			fwrite($fp, $text);

			$text = "INSERT INTO " .$this->STUDENT_BASE_NAME. " " .$stClass->buildTableRef(). " VALUES \n";
			fwrite($fp, $text);
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setStudentData($elems[$i]);
					
				$text = $stClass->getStudentData();
				if ($i == $nb-1) {
					$text .= ";\n\n";
				}
				else {
					$text .= ",\n";
				}
				fwrite($fp, $text);
			}
		}
	}
	
	function ExportValideStudentBase($fp) {
		//$elems = $this->connection->get_all_elements($this->STUDENT_BASE_NAME);
		$elems = $this->connection->get_order_elements_asc($this->STUDENT_BASE_NAME, "", $this->IDS_COL);
		if ($elems && count($elems) > 0) {
	
			$stClass = new StudentClass();
			$text = "INSERT INTO " .$this->STUDENT_BASE_NAME. " " .$stClass->buildValideTableRef(). " VALUES \n";
			fwrite($fp, $text);
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setStudentData($elems[$i]);
				if ($stClass->isValideStudent()) {
					$text = $stClass->getValideStudentData();
					if ($i == $nb-1) {
						$text .= ";\n\n";
					}
					else {
						$text .= ",\n";
					}
					fwrite($fp, $text);
				}
			}
		}
	}
		
	function ExportOKStudentBase($fp) {
		$OK_CLASS_NAME =array("PS-D", "IS-C", "IS-A1", "IS-A2");
		
		$stClass = new StudentClass();
		$text = "INSERT INTO " .$this->STUDENT_BASE_NAME. " " .$stClass->buildTableRef(). " VALUES \n";
		fwrite($fp, $text);
		
		$cond = "";
		for ($i = 0; $i < count($OK_CLASS_NAME); $i++) {
			$classname = $OK_CLASS_NAME[$i];
			if ($i > 0) {
				$cond .= " OR ";
			}
			$cond  .= $this->CLASS_COL. 	"='" .$classname. 	"' ";
		}
		$elems =  $this->connection->get_order_elements_asc($this->STUDENT_BASE_NAME, $cond, $this->IDS_COL);
		if ($elems) {
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setStudentData($elems[$i]);
				if ($stClass->isValideStudent()) {
					$text = $stClass->getStudentData();
					if ($i == $nb-1) {
						$text .= ";\n\n";
					}
					else {
						$text .= ",\n";
					}
					fwrite($fp, $text);
				}
			}
		}
	}
		
	function ExportOpenHouseTestBase($fp) {
		$stClass = new StudentTestClass();
		fwrite($fp, $stClass->getCreatTableString()."\n\n");
		
		$elems = $this->connection->get_all_elements($stClass->getTableName());
		if ($elems && count($elems) > 0) {
			fwrite($fp, $stClass->getBackupTitle());
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setStudentData($elems[$i]);
					
				$text = $stClass->getStudentData();
				if ($i == $nb-1) {
					$text .= ";\n\n\n\n";
				}
				else {
					$text .= ",\n";
				}
				fwrite($fp, $text);
			}
		}
		
		$scoreClass = new TestScoreClass();
		fwrite($fp, $scoreClass->getCreatTableString()."\n\n");
	
		$elems = $this->connection->get_all_elements($scoreClass->getTableName());
		if ($elems && count($elems) > 0) {
			fwrite($fp, $scoreClass->getBackupTitle());
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$scoreClass->setScoresData($elems[$i]);
					
				$text = $scoreClass->getScoresData();
				if ($i == $nb-1) {
					$text .= ";\n\n";
				}
				else {
					$text .= ",\n";
				}
				fwrite($fp, $text);
			}
		}
		
	}

	function ExportTestStudentBase($fp) {
		$elems = $this->connection->get_all_elements($this->TT_STUDENT_BASE_NAME);
		if ($elems && count($elems) > 0) {	
			$stClass = new TestStudent();
			$text = $stClass->getCreatTableString(). " \n";
			fwrite($fp, $text);

			fwrite($fp, $stClass->getBackupTitle());
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setStudentData($elems[$i]);
					
				$text = $stClass->getStudentData();
				if ($i == $nb-1) {
					$text .= ";\n\n";
				}
				else {
					$text .= ",\n";
				}
				fwrite($fp, $text);
			}
		}
	}
	
	
	function ExportTeacherBase($fp) {
		$elems = $this->connection->get_all_elements($this->TEACHER_BASE_NAME);
		if ($elems && count($elems) > 0) {
	
			$stClass = new TeacherClass();
			$text = $stClass->getCreatTableString(). " \n";
			fwrite($fp, $text);

			$text = "INSERT INTO " .$this->TEACHER_BASE_NAME. " " .$stClass->buildTableRef(). " VALUES \n";
			fwrite($fp, $text);
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setData($elems[$i]);
					
				$text = $stClass->getData();
				if ($i == $nb-1) {
					$text .= ";\n\n";
				}
				else {
					$text .= ",\n";
				}
				fwrite($fp, $text);
			}
		}
	}
	
	function ExportPrivateSessionBase($fp) {
		$elems = $this->connection->get_all_elements($this->PSESSIONS_BASE_NAME);
		if ($elems && count($elems) > 0) {
	
			$stClass = new PSessionClass();

			$text = $stClass->getCreatTableString(). " \n";
			fwrite($fp, $text);
			
			$text = "INSERT INTO " .$this->PSESSIONS_BASE_NAME. " " .$stClass->buildTableRef(). " VALUES \n";
			fwrite($fp, $text);
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setData($elems[$i]);
					
				$text = $stClass->getData();
				if ($i == $nb-1) {
					$text .= ";\n\n";
				}
				else {
					$text .= ",\n";
				}
				fwrite($fp, $text);
			}
		}
	}
	
	function ExportScoresBase() {
		$d = date('n');
		if ($d == 7 || $d == 8)
			$issummer = 1;
		else 
			$issummer = 0;
		$stClass = new ScoreClass();
		$stop = 0;
		$MAX_ELEM = 4000;
		$start = 0;
		$n = 1;
		do {
			if ($n > 1)
				$MAX_ELEM = 1000;
			if ($issummer)
				$elems = $this->connection->get_score_elements($this->SCORES_BASE_NAME, $start, $MAX_ELEM);
			else
				$elems = $this->connection->get_all_elements_array($this->SCORES_BASE_NAME);
			$nb = count($elems);
			if ($nb > 0) {
				$fname = $this->getExportFileName("scores".$n);
				$fp = fopen($fname, "w");
				if ($n == 1) {
					$text = $stClass->getCreatTableString(). " \n";
					fwrite($fp, $text);
				}
				$text = "INSERT INTO " .$this->SCORES_BASE_NAME. " " .$stClass->buildTableRef(). " VALUES \n";
				fwrite($fp, $text);

				
				for ($i = 0; $i < $nb; $i++) {
					$stClass->setScoresData($elems[$i]);
					
					$text = $stClass->getScoresData();
					if ($i == $nb -1) {
						$text .= ";\n\n";
					}
					else {
						$text .= ",\n";
					}
					fwrite($fp, $text);
				}
				fclose($fp);
				$start += $MAX_ELEM;
				if ($issummer == 0)
					$stop = 1;
			}
			else {
				$stop = 1;
			}
			$n++;
		} while ($stop != 1 && $n < 20);
		
	}

	function ExportScoresRefBase($fp) {
		$elems = $this->connection->get_all_elements($this->SCORESREF_BASE_NAME);
		if ($elems && count($elems) > 0) {
			$stClass = new ScoreRefClass();
			
			$text = $stClass->getCreatTableString(). " \n";
			fwrite($fp, $text);
			
			$text = "INSERT INTO " .$this->SCORESREF_BASE_NAME. " " .$stClass->buildTableRef(). " VALUES \n";
			fwrite($fp, $text);
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setData($elems[$i]);
					
				$text = $stClass->getData();
				if ($i == $nb-1) {
					$text .= ";\n\n";
				}
				else {
					$text .= ",\n";
				}
				fwrite($fp, $text);
			}
		}
	}
	
	function ExportTuitionBase($fp) {
		$elems = $this->connection->get_all_elements($this->TUITION_BASE_NAME);
		if ($elems && count($elems) > 0) {
			$stClass = new TuitionClass();
			$text = "INSERT INTO " .$this->TUITION_BASE_NAME. " " .$stClass->buildTableRef(). " VALUES \n";
			fwrite($fp, $text);
			
			$nb = count($elems);
			for ($i = 0; $i < $nb; $i++) {
				$stClass->setData($elems[$i]);
					
				$text = $stClass->getData();
				if ($i == $nb-1) {
					$text .= ";\n\n";
				}
				else {
					$text .= ",\n";
				}
				fwrite($fp, $text);
			}
		}
	}

	
	function getExportFileName($basename) {
		return getBackupFileName($basename);
	}
				
	function shouldExport() {
		global $BK_FLAG, $BK_DATE;
		if (($BK_FLAG == 1) && ($BK_DATE != date("Y-m-d"))) {
			return 1;
		}
		return 0;
	}

	function ExportBase() {
		if ($this->DATABASE_OK) {
			$this->connect();
			
			$fname = $this->getExportFileName("students");
			$fp = fopen($fname, "w");
			$this->ExportStudentBase($fp);
			fclose($fp);
					
			$this->ExportScoresBase();

			$fname = $this->getExportFileName("scoresref");
			$fp = fopen($fname, "w");
			$this->ExportScoresRefBase($fp);
			fclose($fp);

/*			
			$fname = $this->getExportFileName("privatesession");
			$fp = fopen($fname, "w");
			$this->ExportPrivateSessionBase($fp);
			fclose($fp);
*/
			
/*
			$fname = $this->getExportFileName("students_valide");
			$fp = fopen($fname, "w");
			$this->ExportValideStudentBase($fp);
			fclose($fp);

			$fname = $this->getExportFileName("students_ok");
			$fp = fopen($fname, "w");
			$this->ExportOKStudentBase($fp);
			fclose($fp);
*/
/*
			$fname = $this->getExportFileName("openhousetest");
			$fp = fopen($fname, "w");
			$this->ExportOpenHouseTestBase($fp);
			fclose($fp);
						
			$fname = $this->getExportFileName("teststudent");
			$fp = fopen($fname, "w");
			$this->ExportTestStudentBase($fp);
			fclose($fp);
*/			
			
			$fname = $this->getExportFileName("divers");
			$fp = fopen($fname, "w");

//			$this->ExportTuitionBase($fp);
			
			$this->ExportConnectBase($fp);
//			$this->ExportScheduleBase($fp);
			//$this->ExportNewsBase($fp);
			
			fclose($fp);
			$this->close();
			set_base_changed(0, "Export");
		}
	}
	
	function ExportFullBase() {
		if ($this->DATABASE_OK) {
			$this->connect();
				
			$fname = $this->getExportFileName("full");
			$fp = fopen($fname, "w");

			$this->ExportPrivateSessionBase($fp);
			$this->ExportStudentBase($fp);
			$this->ExportOpenHouseTestBase($fp);
			$this->ExportTeacherBase($fp);
			$this->ExportScoresBase($fp);
			$this->ExportScoresRefBase($fp);
			$this->ExportTuitionBase($fp);
			$this->ExportConnectBase($fp);
			$this->ExportScheduleBase($fp);
			//$this->ExportNewsBase($fp);
			
			fclose($fp);
			
			$this->close();
		
		}
	}
	
}
?>
