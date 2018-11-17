CREATE TABLE IF NOT EXISTS TEACHERS(
IDS INTEGER  NOT NULL AUTO_INCREMENT, 
CIVIL CHAR(3), 
FIRSTNAME VARCHAR(128), 
LASTNAME VARCHAR(128), 
SUBJECTS VARCHAR(128), 
LOGIN VARCHAR(32), 
PASSWD VARCHAR(20), 
EMAIL VARCHAR(128), 
PHONE VARCHAR(32), 
MOBILE VARCHAR(32), 
REGISTDATE VARCHAR(32), 
LASTLOGIN VARCHAR(32), 
LASTMODIFY VARCHAR(32), 
NOTES VARCHAR(512), 
DELETED CHAR(1), 
PRIMARY KEY (IDS), 
UNIQUE(LOGIN) 
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;
 
INSERT INTO TEACHERS (IDS, CIVIL, FIRSTNAME, LASTNAME, SUBJECTS, LOGIN, PASSWD, EMAIL, PHONE, MOBILE, REGISTDATE, LASTLOGIN, LASTMODIFY, NOTES, DELETED) VALUES 
('1', 'Ms.', 'J.', 'Baker', 'English', 'JBAKER', 'JBENG', '', '', '', '11/20/2011 - 00:28:38', '11/27/2011 - 22:02:02', '11/20/2011 - 00:28:38', '', '0'),
('2', 'Mr.', 'M.', 'Baron', 'English', 'MBARON', 'MBENG', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:57:52', '11/20/2011 - 00:28:38', '', '0'),
('3', 'Mr.', 'J.', 'Bosley', 'English', 'JBOSLEY', 'JBENG', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('4', 'Ms.', 'A.', 'Carlson', 'English', 'ACARLSON', 'ACENG', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('5', 'Ms.', 'P.', 'Castello', 'English', 'PCASTELLO', 'PCENG', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('6', 'Mr.', 'M.', 'Chorusey', 'English', 'MCHORUSEY', 'MCENG', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('7', 'Mr.', 'T.', 'DeVenuti', 'English', 'TDEVENUTI', 'TDENG', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('8', 'Ms.', 'J.', 'Difranco', 'English', 'JDIFRANCO', 'JDENG', '', '', '', '11/20/2011 - 00:28:38', '11/30/2011 - 23:40:30', '11/20/2011 - 00:28:38', '', '0'),
('9', 'Ms.', 'F.', 'Fuchs', 'English', 'FFUCHS', 'FFENG', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('10', 'Mr.', 'M.', 'Holtz', 'English', 'MHOLTZ', 'MHENG', '', '', '', '11/20/2011 - 00:28:38', '11/24/2011 - 09:38:49', '11/20/2011 - 00:28:38', '', '0'),
('11', 'Ms.', 'C.', 'Lowenthal', 'English', 'CLOWENTHAL', 'CLENG', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('12', 'Ms.', 'S.', 'Schwarz', 'English', 'SSCHWARZ', 'SSENG', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('13', 'Mr.', 'S.', 'Alper', 'Math', 'SALPER', 'SAMATH', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:59:06', '11/20/2011 - 00:28:38', '', '0'),
('14', 'Ms.', 'H.', 'Bloom', 'Math', 'HBLOOM', 'HBMATH', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('15', 'Ms.', 'L.', 'Fanelli', 'Math', 'LFANELLI', 'LFMATH', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('16', 'Mr.', 'J.', 'Fazekas', 'Math', 'JFAZEKAS', 'JFMATH', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('17', 'Mr.', 'A.', 'Mantell', 'Math', 'AMANTELL', 'AMMATH', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('18', 'Mr.', 'D.', 'Ryan', 'Math', 'DRYAN', 'DRMATH', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('19', 'Ms.', 'A.', 'Schaefer', 'Math', 'ASCHAEFER', 'ASMATH', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('20', 'Mr.', 'L.', 'Savelli', 'Math', 'LSAVELLI', 'LSMATH', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('21', 'Mr.', 'J.', 'Schwartz', 'Math', 'JSCHWARTZ', 'JSMATH', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('22', 'Ms.', 'J.', 'Wemssen', 'Math', 'JWEMSSEN', 'JWMATH', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('23', 'Ms.', 'J.', 'Boyed', 'Biology', 'JBOYED', 'JBBIO', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('24', 'Dr.', 'R.', 'Danielowich', 'Biology', 'RDANIELOWICH', 'RDBIO', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('25', 'Mr.', 'D.', 'Strasser', 'Chemistry', 'DSTRASSER', 'DSCHE', '', '', '', '11/20/2011 - 00:28:38', '12/08/2011 - 22:33:18', '11/20/2011 - 00:28:38', '', '0'),
('26', 'Mr.', 'K.', 'McInnes', 'Physics', 'KMCINNES', 'KMPHY', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('27', 'Mr.', 'K.', 'Dugan', 'History', 'KDUGAN', 'KDHIS', '', '', '', '11/20/2011 - 00:28:38', '12/08/2011 - 22:25:41', '11/20/2011 - 00:28:38', '', '0'),
('28', 'Mr.', 'J.', 'Klaff', 'History', 'JKLAFF', 'JKHIS', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('29', 'Mr.', 'D.', 'Matina', 'History', 'DMATINA', 'DMHIS', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('30', 'Mr.', 'N.', 'DAnna', 'Earth-Space', 'NDANNA', 'NDES', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:59:57', '11/20/2011 - 00:28:38', '', '0'),
('31', 'Mr.', 'D.', 'Barrett', 'Earth-Space', 'DBARRETT', 'DBES', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('32', 'Mr.', 'C.', 'Medico', 'Economics', 'CMEDICO', 'CMECO', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0'),
('33', 'Ms.', 'K.', 'Fazekas', 'Spanish', 'KFAZEKAS', 'KFSPA', '', '', '', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '11/20/2011 - 00:28:38', '', '0');

