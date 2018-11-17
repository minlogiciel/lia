
CREATE TABLE IF NOT EXISTS TEACHERS
(
	IDS				INTEGER				NOT NULL 	auto_increment,
	CIVIL			CHAR(3),
	FIRSTNAME		VARCHAR(128)		NOT NULL,
	LASTNAME		VARCHAR(128)		NOT NULL,
	SUBJECTS		VARCHAR(32)			NOT NULL,
	LOGIN			VARCHAR(32),
	PASSWD			VARCHAR(20),
	EMAIL			VARCHAR(128),
	PHONE			VARCHAR(32),
	MOBILE			VARCHAR(32),
	REGISTDATE      VARCHAR(32),
	LASTLOGIN       VARCHAR(32),
	LASTMODIFY      VARCHAR(32),
	NOTES        	VARCHAR(512),
	DELETED       CHAR(1),
	PRIMARY KEY (IDS),
	UNIQUE(LOGIN)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;

INSERT INTO `TEACHERS` (`IDS`, `CIVIL`, `FIRSTNAME`, `LASTNAME`, `SUBJECTS`, `LOGIN`, `PASSWD`, `EMAIL`, `PHONE`, `MOBILE`, `REGISTDATE`, `LASTLOGIN`, `LASTMODIFY`, `NOTES`, `DELETED`) VALUES
(1, 'Ms.', 'J.', 'Baker', 'English', 'JBAKER', 'JBENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 16:35:55', '11/20/2011 - 00:28:38', NULL, '0'),
(2, 'Mr.', 'M.', 'Baron', 'English', 'MBARON', 'MBENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:57:52', '11/20/2011 - 00:28:38', NULL, '0'),
(3, 'Mr.', 'J.', 'Bosley', 'English', 'JBOSLEY', 'JBENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(4, 'Ms.', 'A.', 'Carlson', 'English', 'ACARLSON', 'ACENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(5, 'Ms.', 'P.', 'Castello', 'English', 'PCASTELLO', 'PCENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(6, 'Mr.', 'M.', 'Chorusey', 'English', 'MCHORUSEY', 'MCENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(7, 'Mr.', 'T.', 'DeVenuti', 'English', 'TDEVENUTI', 'TDENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(8, 'Ms.', 'J.', 'Difranco', 'English', 'JDIFRANCO', 'JDENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:56:26', '11/20/2011 - 00:28:38', NULL, '0'),
(9, 'Ms.', 'F.', 'Fuchs', 'English', 'FFUCHS', 'FFENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(10, 'Mr.', 'M.', 'Holtz', 'English', 'MHOLTZ', 'MHENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(11, 'Ms.', 'C.', 'Lowenthal', 'English', 'CLOWENTHAL', 'CLENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(12, 'Ms.', 'S.', 'Schwarz', 'English', 'SSCHWARZ', 'SSENG', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(13, 'Mr.', 'S.', 'Alper', 'Math', 'SALPER', 'SAMATH', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:59:06', '11/20/2011 - 00:28:38', NULL, '0'),
(14, 'Ms.', 'H.', 'Bloom', 'Math', 'HBLOOM', 'HBMATH', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(15, 'Ms.', 'L.', 'Fanelli', 'Math', 'LFANELLI', 'LFMATH', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(16, 'Mr.', 'J.', 'Fazekas', 'Math', 'JFAZEKAS', 'JFMATH', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(17, 'Mr.', 'A.', 'Mantell', 'Math', 'AMANTELL', 'AMMATH', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(18, 'Mr.', 'D.', 'Ryan', 'Math', 'DRYAN', 'DRMATH', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(19, 'Ms.', 'A.', 'Schaefer', 'Math', 'ASCHAEFER', 'ASMATH', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(20, 'Mr.', 'L.', 'Savelli', 'Math', 'LSAVELLI', 'LSMATH', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(21, 'Mr.', 'J.', 'Schwartz', 'Math', 'JSCHWARTZ', 'JSMATH', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(22, 'Ms.', 'J.', 'Wemssen', 'Math', 'JWEMSSEN', 'JWMATH', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(23, 'Ms.', 'J.', 'Boyed', 'Biology', 'JBOYED', 'JBBIO', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(24, 'Dr.', 'R.', 'Danielowich', 'Biology', 'RDANIELOWICH', 'RDBIO', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(25, 'Mr.', 'D.', 'Strasser', 'Chemistry', 'DSTRASSER', 'DSCHE', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(26, 'Mr.', 'K.', 'McInnes', 'Physics', 'KMCINNES', 'KMPHY', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(27, 'Mr.', 'K.', 'Dugan', 'History', 'KDUGAN', 'KDHIS', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(28, 'Mr.', 'J.', 'Klaff', 'History', 'JKLAFF', 'JKHIS', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(29, 'Mr.', 'D.', 'Matina', 'History', 'DMATINA', 'DMHIS', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(30, 'Mr.', 'N.', 'DAnna', 'Earth-Space', 'NDANNA', 'NDES', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:59:57', '11/20/2011 - 00:28:38', NULL, '0'),
(31, 'Mr.', 'D.', 'Barrett', 'Earth-Space', 'DBARRETT', 'DBES', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(32, 'Mr.', 'C.', 'Medico', 'Economics', 'CMEDICO', 'CMECO', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0'),
(33, 'Ms.', 'K.', 'Fazekas', 'Spanish', 'KFAZEKAS', 'KFSPA', NULL, NULL, NULL, '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', NULL, '0');