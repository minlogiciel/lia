CREATE TABLE IF NOT EXISTS SCORES_REF(
IDS INTEGER  NOT NULL AUTO_INCREMENT, 
CLASSES VARCHAR(64) NOT NULL, 
GROUPS VARCHAR(128), 
SUBJECTS VARCHAR(32), 
SEMESTER VARCHAR(32), 
PERIODS INTEGER, 
DATES VARCHAR(512), 
DELETED CHAR(1), 
PRIMARY KEY (IDS) 
)ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;
 
INSERT INTO SCORES_REF (IDS, CLASSES, GROUPS, SUBJECTS, SEMESTER, PERIODS, DATES, DELETED) VALUES 
('1', 'IS-CAT', '1', 'English', 'Fall', '2012', '09/29', '0'),
('2', 'IS-A', '2', 'English', 'Fall', '2012', '09/29', '0'),
('3', 'HS-D1', '3', 'English', 'Fall', '2012', '09/29', '0'),
('4', 'HS-D2', '4', 'English', 'Fall', '2012', '09/29', '0'),
('5', 'HS-C1', '5', 'English', 'Fall', '2012', '09/29', '0'),
('6', 'HS-C2', '6', 'English', 'Fall', '2012', '09/29', '0'),
('7', 'PS-CAT', '7', 'English', 'Fall', '2012', '09/29', '0'),
('8', 'PS-CAT', '8', 'Math', 'Fall', '2012', '09/29', '0'),
('9', 'PS-B', '9', 'English', 'Fall', '2012', '09/29', '0'),
('10', 'PS-B', '10', 'Math', 'Fall', '2012', '09/29', '0'),
('11', 'IS-CAT', '11', 'Math', 'Fall', '2012', '09/29', '0'),
('12', 'HS-C1', '12', 'Math', 'Fall', '2012', '09/29', '0'),
('13', 'HS-C2', '13', 'Math', 'Fall', '2012', '09/29', '0'),
('14', 'IS-A', '14', 'Math', 'Fall', '2012', '09/29', '0'),
('15', 'HS-D1', '15', 'Math', 'Fall', '2012', '09/29', '0'),
('16', 'HS-D2', '16', 'Math', 'Fall', '2012', '09/29', '0'),
('17', 'PS-B', '17', 'English', 'Fall', '2012', '10/13', '0'),
('18', 'PS-CAT', '18', 'English', 'Fall', '2012', '10/13', '0'),
('19', 'IS-CAT', '19', 'English', 'Fall', '2012', '10/13', '0'),
('20', 'HS-D1', '20', 'English', 'Fall', '2012', '10/13', '0'),
('21', 'HS-D2', '21', 'English', 'Fall', '2012', '10/13', '0'),
('22', 'PS-B', '22', 'Math', 'Fall', '2012', '10/13', '0'),
('23', 'HS-C1', '23', 'English', 'Fall', '2012', '10/13', '0'),
('24', 'HS-C2', '24', 'English', 'Fall', '2012', '10/13', '0'),
('25', 'IS-A', '25', 'English', 'Fall', '2012', '10/13', '0'),
('26', 'PS-CAT', '26', 'Math', 'Fall', '2012', '10/13', '0'),
('27', 'IS-CAT', '27', 'Math', 'Fall', '2012', '10/13', '0'),
('28', 'PS-B', '28', 'English', 'Fall', '2012', '10/20', '0'),
('29', 'PS-B', '29', 'Math', 'Fall', '2012', '10/20', '0'),
('30', 'PS-CAT', '30', 'English', 'Fall', '2012', '10/20', '0'),
('31', 'PS-CAT', '31', 'Math', 'Fall', '2012', '10/20', '0'),
('32', 'IS-CAT', '32', 'English', 'Fall', '2012', '10/20', '0'),
('33', 'IS-CAT', '33', 'Math', 'Fall', '2012', '10/20', '0'),
('34', 'IS-A', '34', 'English', 'Fall', '2012', '10/20', '0'),
('35', 'IS-A', '35', 'Math', 'Fall', '2012', '10/20', '0'),
('36', 'IS-A', '36', 'Math', 'Fall', '2012', '10/13', '0'),
('37', 'HS-D1', '37', 'English', 'Fall', '2012', '10/20', '0'),
('38', 'HS-D1', '38', 'English', 'Fall', '2012', '10/23', '0'),
('39', 'HS-D1', '39', 'English', 'Fall', '2012', '10/20', '0'),
('40', 'HS-D1', '40', 'Math', 'Fall', '2012', '10/13', '0'),
('41', 'HS-D2', '41', 'English', 'Fall', '2012', '10/20', '0'),
('42', 'HS-D1', '42', 'Math', 'Fall', '2012', '10/20', '0'),
('43', 'HS-D2', '43', 'Math', 'Fall', '2012', '10/20', '0'),
('44', 'HS-C2', '44', 'Math', 'Fall', '2012', '10/20', '0'),
('45', 'HS-C2', '45', 'Math', 'Fall', '2012', '10/20', '0'),
('46', 'HS-C1', '46', 'Math', 'Fall', '2012', '10/13', '0'),
('47', 'HS-C1', '47', 'Math', 'Fall', '2012', '10/20', '0'),
('48', 'HS-C1', '48', 'English', 'Fall', '2012', '10/20', '0'),
('49', 'HS-C2', '49', 'English', 'Fall', '2012', '10/20', '0'),
('50', 'IS-CAT', '50', 'English', 'Fall', '2012', '10/20', '0'),
('51', 'IS-A', '51', 'English', 'Fall', '2012', '10/20', '0'),
('52', 'PS-CAT', '52', 'Math', 'Fall', '2012', '10/20', '0'),
('53', 'IS-CAT', '53', 'Math', 'Fall', '2012', '10/20', '0'),
('54', 'IS-A', '54', 'Math', 'Fall', '2012', '10/20', '0'),
('55', 'HS-D1', '55', 'Math', 'Fall', '2012', '10/20', '0'),
('56', 'HS-C1', '56', 'Math', 'Fall', '2012', '10/20', '0'),
('57', 'HS-D2', '57', 'Math', 'Fall', '2012', '10/20', '0'),
('58', 'PS-B', '58', 'Math', 'Fall', '2012', '10/20', '0'),
('59', 'HS-C2', '59', 'Math', 'Fall', '2012', '10/20', '0'),
('60', 'PS-B', '60', 'English', 'Fall', '2012', '10/20', '0'),
('61', 'HS-C1', '61', 'English', 'Fall', '2012', '10/20', '0'),
('62', 'HS-C2', '62', 'English', 'Fall', '2012', '10/20', '0'),
('63', 'PS-CAT', '63', 'English', 'Fall', '2012', '10/20', '0'),
('64', 'HS-D1', '64', 'English', 'Fall', '2012', '10/20', '0'),
('65', 'HS-D2', '65', 'English', 'Fall', '2012', '10/20', '0'),
('66', 'IS-CAT', '66', 'Math', 'Fall', '2012', '10/27', '0'),
('67', 'HS-C1', '67', 'English', 'Fall', '2012', '10/27', '0'),
('68', 'HS-C2', '68', 'English', 'Fall', '2012', '10/27', '0'),
('69', 'PS-CAT', '69', 'English', 'Fall', '2012', '10/27', '0'),
('70', 'HS-D2', '70', 'Math', 'Fall', '2012', '10/27', '0'),
('71', 'HS-D1', '71', 'Math', 'Fall', '2012', '10/27', '0'),
('72', 'HS-C1', '72', 'Math', 'Fall', '2012', '10/27', '0'),
('73', 'HS-D2', '73', 'Math', 'Fall', '2012', '10/13', '0'),
('74', 'IS-A', '74', 'Math', 'Fall', '2012', '10/27', '0'),
('75', 'PS-B', '75', 'Math', 'Fall', '2012', '10/27', '0'),
('76', 'PS-B', '76', 'English', 'Fall', '2012', '10/27', '0'),
('77', 'HS-C2', '77', 'Math', 'Fall', '2012', '10/27', '0'),
('78', 'PS-CAT', '78', 'Math', 'Fall', '2012', '10/27', '0'),
('79', 'HS-D1', '79', 'English', 'Fall', '2012', '10/27', '0'),
('80', 'HS-D2', '80', 'English', 'Fall', '2012', '10/27', '0'),
('81', 'IS-A', '81', 'English', 'Fall', '2012', '10/27', '0'),
('82', 'IS-CAT', '82', 'English', 'Fall', '2012', '10/27', '0'),
('83', 'IS-CAT', '83', 'English', 'Fall', '2012', '11/03', '0'),
('84', 'HS-B', '84', 'English', 'Fall', '2012', '11/03', '0'),
('85', 'PS-B', '85', 'Math', 'Fall', '2012', '11/03', '0'),
('86', 'IS-CAT', '86', 'Math', 'Fall', '2012', '11/03', '0'),
('87', 'PS-CAT', '87', 'Math', 'Fall', '2012', '11/03', '0'),
('88', 'HS-C1', '88', 'Math', 'Fall', '2012', '11/03', '0'),
('89', 'HS-C2', '89', 'Math', 'Fall', '2012', '11/03', '0'),
('90', 'HS-D2', '90', 'Math', 'Fall', '2012', '11/03', '0'),
('91', 'HS-D1', '91', 'Math', 'Fall', '2012', '11/03', '0'),
('92', 'HS-B', '92', 'Math', 'Fall', '2012', '11/03', '0'),
('93', 'IS-A', '93', 'Math', 'Fall', '2012', '11/03', '0'),
('94', 'PS-CAT', '94', 'English', 'Fall', '2012', '11/03', '0'),
('95', 'IS-A', '95', 'English', 'Fall', '2012', '11/03', '0'),
('96', 'PS-B', '96', 'English', 'Fall', '2012', '11/03', '0'),
('97', 'HS-D1', '97', 'English', 'Fall', '2012', '11/03', '0'),
('98', 'HS-D2', '98', 'English', 'Fall', '2012', '11/03', '0'),
('99', 'HS-C1', '99', 'English', 'Fall', '2012', '11/03', '0'),
('100', 'HS-C2', '100', 'English', 'Fall', '2012', '11/03', '0'),
('101', 'PS-B', '101', 'Math', 'Fall', '2012', '11/10', '0'),
('102', 'PS-B', '102', 'English', 'Fall', '2012', '11/10', '0'),
('103', 'PS-CAT', '103', 'Math', 'Fall', '2012', '11/10', '0'),
('104', 'PS-CAT', '104', 'English', 'Fall', '2012', '11/10', '0'),
('105', 'IS-CAT', '105', 'Math', 'Fall', '2012', '11/10', '0'),
('106', 'IS-CAT', '106', 'English', 'Fall', '2012', '11/10', '0'),
('107', 'IS-A', '107', 'Math', 'Fall', '2012', '11/10', '0'),
('108', 'IS-A', '108', 'English', 'Fall', '2012', '11/10', '0'),
('109', 'HS-D1', '109', 'Math', 'Fall', '2012', '11/10', '0'),
('110', 'HS-D2', '110', 'Math', 'Fall', '2012', '11/10', '0'),
('111', 'HS-D1', '111', 'English', 'Fall', '2012', '11/10', '0'),
('112', 'HS-D2', '112', 'English', 'Fall', '2012', '11/10', '0'),
('113', 'HS-C2', '113', 'Math', 'Fall', '2012', '11/10', '0'),
('114', 'HS-C1', '114', 'Math', 'Fall', '2012', '11/10', '0'),
('115', 'HS-C1', '115', 'English', 'Fall', '2012', '11/10', '0'),
('116', 'HS-C2', '116', 'English', 'Fall', '2012', '11/10', '0'),
('117', 'HS-C2', '117', 'English', 'Fall', '2012', '11/10', '0'),
('118', 'HS-B', '118', 'Math', 'Fall', '2012', '11/10', '0'),
('119', 'HS-B', '119', 'English', 'Fall', '2012', '11/10', '0'),
('120', 'PS-CAT', '120', 'Math', 'Fall', '2012', '11/17', '0'),
('121', 'PS-CAT', '121', 'English', 'Fall', '2012', '11/17', '0'),
('122', 'IS-CAT', '122', 'English', 'Fall', '2012', '11/17', '0'),
('123', 'IS-CAT', '123', 'Math', 'Fall', '2012', '11/17', '0'),
('124', 'IS-A', '124', 'English', 'Fall', '2012', '11/17', '0'),
('125', 'HS-D1', '125', 'Math', 'Fall', '2012', '11/17', '0'),
('126', 'HS-D1', '126', 'English', 'Fall', '2012', '11/17', '0'),
('127', 'HS-D2', '127', 'English', 'Fall', '2012', '11/17', '0'),
('128', 'HS-D2', '128', 'Math', 'Fall', '2012', '11/17', '0'),
('129', 'HS-C1', '129', 'English', 'Fall', '2012', '11/17', '0'),
('130', 'HS-C2', '130', 'English', 'Fall', '2012', '11/17', '0'),
('131', 'HS-C1', '131', 'Math', 'Fall', '2012', '11/17', '0'),
('132', 'HS-C2', '132', 'Math', 'Fall', '2012', '11/17', '0'),
('133', 'HS-B', '133', 'English', 'Fall', '2012', '11/17', '0'),
('134', 'HS-B', '134', 'Math', 'Fall', '2012', '11/17', '0'),
('135', 'PS-B', '135', 'Math', 'Fall', '2012', '11/17', '0'),
('139', 'PS-B', '139', 'Math', 'Fall', '2012', '11/17', '0'),
('137', 'IS-A', '137', 'Math', 'Fall', '2012', '11/17', '0'),
('138', 'PS-B', '138', 'English', 'Fall', '2012', '11/17', '0'),
('140', 'IS-CAT', '140', 'Math', 'Fall', '2012', '11/17', '0'),
('141', 'HS-D1', '141', 'Math', 'Fall', '2012', '11/17', '0'),
('142', 'HS-C1', '142', 'Math', 'Fall', '2012', '11/17', '0'),
('143', 'HS-B', '143', 'Math', 'Fall', '2012', '11/17', '0'),
('144', 'HS-C2', '144', 'Math', 'Fall', '2012', '11/17', '0'),
('145', 'HS-D2', '145', 'Math', 'Fall', '2012', '11/17', '0'),
('146', 'HS-D1', '146', 'English', 'Fall', '2012', '11/17', '0'),
('147', 'HS-D2', '147', 'English', 'Fall', '2012', '11/17', '0'),
('148', 'PS-CAT', '148', 'English', 'Fall', '2012', '11/17', '0'),
('149', 'IS-CAT', '149', 'English', 'Fall', '2012', '11/17', '0'),
('150', 'HS-C1', '150', 'English', 'Fall', '2012', '11/17', '0'),
('151', 'HS-C2', '151', 'English', 'Fall', '2012', '12/01', '0'),
('152', 'IS-A', '152', 'English', 'Fall', '2012', '11/17', '0'),
('153', 'IS-A', '153', 'Math', 'Fall', '2012', '11/17', '0'),
('154', 'HS-B', '154', 'English', 'Fall', '2012', '11/17', '0'),
('155', 'PS-B', '155', 'English', 'Fall', '2012', '11/17', '0'),
('156', 'PS-CAT', '156', 'Math', 'Fall', '2012', '11/17', '0'),
('157', 'IS-CAT', '157', 'Math', 'Fall', '2012', '12/01', '0'),
('158', 'IS-A', '158', 'Math', 'Fall', '2012', '12/01', '0'),
('159', 'HS-B', '159', 'English', 'Fall', '2012', '12/01', '0'),
('160', 'PS-CAT', '160', 'English', 'Fall', '2012', '12/01', '0'),
('161', 'HS-B', '161', 'Math', 'Fall', '2012', '12/01', '0'),
('162', 'HS-C2', '162', 'Math', 'Fall', '2012', '12/01', '0'),
('163', 'HS-D2', '163', 'Math', 'Fall', '2012', '12/01', '0'),
('164', 'HS-D1', '164', 'Math', 'Fall', '2012', '12/01', '0'),
('165', 'HS-C1', '165', 'Math', 'Fall', '2012', '12/01', '0'),
('166', 'PS-B', '166', 'Math', 'Fall', '2012', '12/01', '0'),
('167', 'HS-C1', '167', 'English', 'Fall', '2012', '12/01', '0'),
('168', 'HS-C2', '168', 'English', 'Fall', '2012', '12/01', '0'),
('169', 'PS-CAT', '169', 'Math', 'Fall', '2012', '12/01', '0'),
('170', 'IS-A', '170', 'English', 'Fall', '2012', '12/01', '0'),
('171', 'PS-B', '171', 'English', 'Fall', '2012', '12/01', '0'),
('172', 'IS-CAT', '172', 'English', 'Fall', '2012', '12/01', '0'),
('173', 'IS-CAT', '173', 'English', 'Fall', '2012', '12/01', '0'),
('174', 'HS-D1', '174', 'English', 'Fall', '2012', '12/01', '0'),
('175', 'HS-D2', '175', 'English', 'Fall', '2012', '12/01', '0'),
('176', 'HS-B', '176', 'English', 'Fall', '2012', '12/08', '0'),
('177', 'PS-CAT', '177', 'English', 'Fall', '2012', '12/08', '0'),
('178', 'IS-A', '178', 'English', 'Fall', '2012', '12/08', '0'),
('179', 'PS-B', '179', 'English', 'Fall', '2012', '12/08', '0'),
('180', 'HS-C1', '180', 'English', 'Fall', '2012', '12/08', '0'),
('181', 'HS-C2', '181', 'English', 'Fall', '2012', '12/08', '0'),
('182', 'IS-CAT', '182', 'English', 'Fall', '2012', '12/08', '0'),
('183', 'HS-D1', '183', 'English', 'Fall', '2012', '12/08', '0'),
('184', 'HS-D2', '184', 'English', 'Fall', '2012', '12/08', '0'),
('185', 'PS-CAT', '185', 'Math', 'Fall', '2012', '12/08', '0'),
('186', 'PS-B', '186', 'Math', 'Fall', '2012', '12/08', '0'),
('187', 'IS-A', '187', 'Math', 'Fall', '2012', '12/08', '0'),
('188', 'IS-CAT', '188', 'Math', 'Fall', '2012', '12/08', '0'),
('189', 'HS-B', '189', 'Math', 'Fall', '2012', '12/08', '0'),
('190', 'HS-D2', '190', 'Math', 'Fall', '2012', '12/08', '0'),
('191', 'HS-D1', '191', 'Math', 'Fall', '2012', '12/08', '0'),
('192', 'HS-C1', '192', 'Math', 'Fall', '2012', '12/08', '0'),
('193', 'HS-C2', '193', 'Math', 'Fall', '2012', '12/08', '0'),
('194', 'HS-C1', '194', 'Math', 'Fall', '2012', '12/15', '0'),
('195', 'HS-C2', '195', 'Math', 'Fall', '2012', '12/15', '0'),
('196', 'HS-D1', '196', 'Math', 'Fall', '2012', '12/15', '0'),
('197', 'HS-D2', '197', 'Math', 'Fall', '2012', '12/15', '0'),
('198', 'HS-C1', '198', 'English', 'Fall', '2012', '12/15', '0'),
('199', 'HS-C2', '199', 'English', 'Fall', '2012', '12/15', '0'),
('200', 'HS-D1', '200', 'English', 'Fall', '2012', '12/15', '0'),
('201', 'HS-D2', '201', 'English', 'Fall', '2012', '12/15', '0'),
('202', 'HS-B', '202', 'English', 'Fall', '2012', '12/15', '0'),
('203', 'IS-CAT', '203', 'English', 'Fall', '2012', '12/18', '0'),
('204', 'HS-B', '204', 'Math', 'Fall', '2012', '12/15', '0'),
('205', 'IS-A', '205', 'English', 'Fall', '2012', '12/15', '0'),
('206', 'IS-CAT', '206', 'Math', 'Fall', '2012', '12/15', '0'),
('207', 'PS-CAT', '207', 'English', 'Fall', '2012', '12/15', '0'),
('208', 'PS-B', '208', 'English', 'Fall', '2012', '12/15', '0'),
('209', 'PS-B', '209', 'Math', 'Fall', '2012', '12/15', '0'),
('210', 'PS-CAT', '210', 'Math', 'Fall', '2012', '12/15', '0'),
('211', 'IS-A', '211', 'Math', 'Fall', '2012', '12/15', '0'),
('212', 'PS-CAT', '212', 'Math', 'Fall', '2012', '12/22', '0'),
('213', 'PS-B', '213', 'Math', 'Fall', '2012', '12/22', '0'),
('214', 'PS-B', '214', 'English', 'Fall', '2012', '12/22', '0'),
('215', 'IS-A', '215', 'English', 'Fall', '2012', '12/22', '0'),
('216', 'IS-A', '216', 'Math', 'Fall', '2012', '12/22', '0'),
('217', 'HS-D2', '217', 'Math', 'Fall', '2012', '12/22', '0'),
('218', 'HS-D1', '218', 'Math', 'Fall', '2012', '12/22', '0'),
('219', 'HS-D2', '219', 'English', 'Fall', '2012', '12/22', '0'),
('220', 'HS-D1', '220', 'English', 'Fall', '2012', '12/22', '0'),
('221', 'HS-C1', '221', 'Math', 'Fall', '2012', '12/22', '0'),
('222', 'HS-C2', '222', 'Math', 'Fall', '2012', '12/22', '0'),
('223', 'HS-C1', '223', 'English', 'Fall', '2012', '12/22', '0'),
('224', 'HS-C2', '224', 'English', 'Fall', '2012', '12/22', '0'),
('225', 'PS-CAT', '225', 'English', 'Fall', '2012', '12/22', '0'),
('226', 'IS-CAT', '226', 'English', 'Fall', '2012', '12/22', '0'),
('227', 'IS-CAT', '227', 'Math', 'Fall', '2012', '12/22', '0'),
('228', 'HS-B', '228', 'Math', 'Fall', '2012', '12/22', '0'),
('229', 'HS-B', '229', 'English', 'Fall', '2012', '12/22', '0');
