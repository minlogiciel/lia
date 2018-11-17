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
('230', 'PS-B', '230', 'Math', 'Spring', '2013', '01/26', '0'),
('231', 'PS-A', '231', 'English', 'Spring', '2013', '01/26', '0'),
('232', 'HS-C', '232', 'English', 'Spring', '2013', '01/26', '0'),
('233', 'HS-D1', '233', 'English', 'Spring', '2013', '01/26', '0'),
('234', 'HS-D2', '234', 'English', 'Spring', '2013', '01/26', '0'),
('235', 'HS-B', '235', 'English', 'Spring', '2013', '01/26', '0'),
('236', 'HS-B', '236', 'Math', 'Spring', '2013', '01/26', '0'),
('237', 'HS-C', '237', 'Math', 'Spring', '2013', '01/26', '0'),
('238', 'HS-D1', '238', 'Math', 'Spring', '2013', '01/26', '0'),
('239', 'HS-D2', '239', 'Math', 'Spring', '2013', '01/26', '0'),
('240', 'PS-B', '240', 'English', 'Spring', '2013', '01/26', '0'),
('241', 'IS-A', '241', 'English', 'Spring', '2013', '01/26', '0'),
('242', 'IS-C', '242', 'English', 'Spring', '2013', '01/26', '0'),
('243', 'IS-C', '243', 'Math', 'Spring', '2013', '01/26', '0'),
('244', 'PS-A', '244', 'Math', 'Spring', '2013', '01/26', '0'),
('245', 'IS-A', '245', 'Math', 'Spring', '2013', '01/26', '0'),
('246', 'PS-B', '246', 'Math', 'Spring', '2013', '02/02', '0'),
('247', 'IS-C', '247', 'Math', 'Spring', '2013', '02/02', '0'),
('248', 'HS-C', '248', 'Math', 'Spring', '2013', '02/02', '0'),
('249', 'HS-D2', '249', 'Math', 'Spring', '2013', '02/02', '0'),
('250', 'HS-B', '250', 'Math', 'Spring', '2013', '02/02', '0'),
('251', 'IS-C', '251', 'English', 'Spring', '2013', '02/02', '0'),
('252', 'IS-C', '252', 'English', 'Spring', '2013', '02/09', '0'),
('253', 'PS-A', '253', 'English', 'Spring', '2013', '02/02', '0'),
('254', 'IS-A', '254', 'Math', 'Spring', '2013', '02/02', '0'),
('255', 'PS-A', '255', 'Math', 'Spring', '2013', '02/02', '0'),
('256', 'HS-D1', '256', 'Math', 'Spring', '2013', '02/02', '0'),
('257', 'HS-B', '257', 'English', 'Spring', '2013', '02/02', '0'),
('258', 'HS-C', '258', 'English', 'Spring', '2013', '02/02', '0'),
('259', 'IS-A', '259', 'English', 'Spring', '2013', '02/02', '0'),
('260', 'HS-D1', '260', 'English', 'Spring', '2013', '02/02', '0'),
('261', 'HS-D2', '261', 'English', 'Spring', '2013', '02/02', '0'),
('262', 'PS-B', '262', 'English', 'Spring', '2013', '02/02', '0'),
('263', 'PS-A', '263', 'English', 'Spring', '2013', '02/23', '0'),
('264', 'HS-D1', '264', 'English', 'Spring', '2013', '02/23', '0'),
('265', 'HS-D2', '265', 'English', 'Spring', '2013', '02/23', '0'),
('266', 'IS-A', '266', 'English', 'Spring', '2013', '02/23', '0'),
('267', 'IS-C', '267', 'English', 'Spring', '2013', '02/28', '0'),
('268', 'PS-B', '268', 'English', 'Spring', '2013', '02/23', '0'),
('269', 'HS-B', '269', 'English', 'Spring', '2013', '02/23', '0'),
('270', 'HS-D1', '270', 'Math', 'Spring', '2013', '02/23', '0'),
('271', 'IS-A', '271', 'Math', 'Spring', '2013', '02/23', '0'),
('272', 'IS-C', '272', 'Math', 'Spring', '2013', '02/23', '0'),
('273', 'PS-B', '273', 'Math', 'Spring', '2013', '02/23', '0'),
('274', 'PS-A', '274', 'Math', 'Spring', '2013', '02/23', '0'),
('275', 'IS-A', '275', 'English', 'Spring', '2013', '02/28', '0'),
('276', 'HS-D1', '276', 'Math', 'Spring', '2013', '02/23', '0'),
('277', 'HS-B', '277', 'Math', 'Spring', '2013', '02/23', '0'),
('278', 'HS-C', '278', 'English', 'Spring', '2013', '02/23', '0'),
('279', 'HS-C', '279', 'Math', 'Spring', '2013', '02/23', '0'),
('280', 'HS-D2', '280', 'Math', 'Spring', '2013', '02/23', '0'),
('281', 'HS-B', '281', 'English', 'Spring', '2013', '03/02', '0'),
('282', 'HS-D1', '282', 'English', 'Spring', '2013', '03/02', '0'),
('283', 'HS-D2', '283', 'English', 'Spring', '2013', '03/02', '0'),
('284', 'PS-A', '284', 'English', 'Spring', '2013', '03/02', '0'),
('285', 'IS-C', '285', 'Math', 'Spring', '2013', '03/02', '0'),
('286', 'IS-A', '286', 'English', 'Spring', '2013', '03/02', '0'),
('287', 'IS-C', '287', 'English', 'Spring', '2013', '03/02', '0'),
('288', 'PS-B', '288', 'English', 'Spring', '2013', '03/02', '0'),
('289', 'HS-C', '289', 'English', 'Spring', '2013', '03/02', '0'),
('290', 'PS-A', '290', 'Math', 'Spring', '2013', '03/02', '0'),
('291', 'IS-A', '291', 'Math', 'Spring', '2013', '03/02', '0'),
('292', 'PS-B', '292', 'Math', 'Spring', '2013', '03/02', '0'),
('293', 'HS-D1', '293', 'Math', 'Spring', '2013', '03/02', '0'),
('294', 'HS-D2', '294', 'Math', 'Spring', '2013', '03/02', '0'),
('295', 'HS-B', '295', 'Math', 'Spring', '2013', '03/02', '0'),
('296', 'HS-C', '296', 'Math', 'Spring', '2013', '03/02', '0'),
('297', 'PS-A', '297', 'Math', 'Spring', '2013', '03/09', '0'),
('298', 'PS-A', '298', 'English', 'Spring', '2013', '03/09', '0'),
('299', 'PS-B', '299', 'Math', 'Spring', '2013', '03/09', '0'),
('300', 'IS-C', '300', 'Math', 'Spring', '2013', '03/09', '0'),
('301', 'IS-C', '301', 'English', 'Spring', '2013', '03/09', '0'),
('302', 'IS-A', '302', 'Math', 'Spring', '2013', '03/09', '0'),
('303', 'IS-A', '303', 'English', 'Spring', '2013', '03/09', '0'),
('304', 'HS-C', '304', 'English', 'Spring', '2013', '03/09', '0'),
('305', 'HS-C', '305', 'Math', 'Spring', '2013', '03/09', '0'),
('306', 'HS-B', '306', 'English', 'Spring', '2013', '03/09', '0'),
('307', 'HS-B', '307', 'Math', 'Spring', '2013', '03/09', '0'),
('308', 'PS-B', '308', 'English', 'Spring', '2013', '03/09', '0'),
('309', 'HS-D1', '309', 'English', 'Spring', '2013', '03/09', '0'),
('310', 'HS-D2', '310', 'English', 'Spring', '2013', '03/09', '0'),
('311', 'HS-D2', '311', 'Math', 'Spring', '2013', '03/09', '0'),
('312', 'HS-D1', '312', 'Math', 'Spring', '2013', '03/09', '0'),
('313', 'HS-B', '313', 'Math', 'Spring', '2013', '03/09', '0'),
('314', 'HS-D2', '314', 'Math', 'Spring', '2013', '03/09', '0'),
('315', 'HS-D1', '315', 'Math', 'Spring', '2013', '03/09', '0'),
('316', 'HS-C', '316', 'Math', 'Spring', '2013', '03/09', '0'),
('317', 'PS-A', '317', 'Math', 'Spring', '2013', '03/09', '0'),
('318', 'PS-B', '318', 'Math', 'Spring', '2013', '03/09', '0'),
('319', 'IS-A', '319', 'Math', 'Spring', '2013', '03/09', '0'),
('320', 'IS-C', '320', 'Math', 'Spring', '2013', '03/09', '0'),
('321', 'PS-A', '321', 'English', 'Spring', '2013', '03/09', '0'),
('322', 'PS-B', '322', 'English', 'Spring', '2013', '03/09', '0'),
('323', 'IS-C', '323', 'English', 'Spring', '2013', '03/09', '0'),
('324', 'IS-A', '324', 'English', 'Spring', '2013', '03/09', '0'),
('325', 'HS-B', '325', 'English', 'Spring', '2013', '03/09', '0'),
('326', 'HS-C', '326', 'English', 'Spring', '2013', '03/09', '0'),
('327', 'HS-D1', '327', 'English', 'Spring', '2013', '03/09', '0'),
('328', 'HS-D2', '328', 'English', 'Spring', '2013', '03/09', '0'),
('329', 'IS-A', '329', 'English', 'Spring', '2013', '03/16', '0'),
('330', 'PS-A', '330', 'English', 'Spring', '2013', '03/16', '0'),
('331', 'PS-B', '331', 'English', 'Spring', '2013', '03/16', '0'),
('332', 'PS-B', '332', 'Math', 'Spring', '2013', '03/16', '0'),
('333', 'IS-A', '333', 'Math', 'Spring', '2013', '03/16', '0'),
('334', 'HS-D2', '334', 'Math', 'Spring', '2013', '03/16', '0'),
('335', 'IS-C', '335', 'Math', 'Spring', '2013', '03/16', '0'),
('336', 'IS-C', '336', 'English', 'Spring', '2013', '03/16', '0'),
('337', 'HS-B', '337', 'English', 'Spring', '2013', '03/16', '0'),
('338', 'HS-C', '338', 'English', 'Spring', '2013', '03/16', '0'),
('339', 'HS-D1', '339', 'Math', 'Spring', '2013', '03/16', '0'),
('340', 'HS-B', '340', 'Math', 'Spring', '2013', '03/16', '0'),
('341', 'HS-C', '341', 'Math', 'Spring', '2013', '03/16', '0'),
('342', 'HS-D1', '342', 'English', 'Spring', '2013', '03/16', '0'),
('343', 'PS-A', '343', 'Math', 'Spring', '2013', '03/16', '0'),
('344', 'HS-D2', '344', 'English', 'Spring', '2013', '03/16', '0'),
('345', 'IS-C', '345', 'English', 'Spring', '2013', '03/23', '0'),
('346', 'IS-A', '346', 'English', 'Spring', '2013', '03/23', '0'),
('347', 'HS-D1', '347', 'English', 'Spring', '2013', '03/23', '0'),
('348', 'HS-D2', '348', 'English', 'Spring', '2013', '03/23', '0'),
('349', 'HS-C', '349', 'English', 'Spring', '2013', '03/23', '0'),
('350', 'PS-A', '350', 'English', 'Spring', '2013', '03/23', '0'),
('351', 'PS-B', '351', 'English', 'Spring', '2013', '03/23', '0'),
('352', 'HS-D2', '352', 'Math', 'Spring', '2013', '03/23', '0'),
('353', 'HS-D1', '353', 'Math', 'Spring', '2013', '03/23', '0'),
('354', 'HS-C', '354', 'Math', 'Spring', '2013', '03/23', '0'),
('355', 'PS-B', '355', 'Math', 'Spring', '2013', '03/23', '0'),
('356', 'PS-A', '356', 'Math', 'Spring', '2013', '03/23', '0'),
('357', 'IS-A', '357', 'Math', 'Spring', '2013', '03/23', '0'),
('358', 'HS-B', '358', 'Math', 'Spring', '2013', '03/23', '0'),
('359', 'IS-C', '359', 'Math', 'Spring', '2013', '03/23', '0'),
('360', 'PS-B', '360', 'Math', 'Spring', '2013', '03/30', '0'),
('361', 'HS-B', '361', 'English', 'Spring', '2013', '03/30', '0'),
('362', 'HS-C', '362', 'English', 'Spring', '2013', '03/30', '0'),
('363', 'HS-D1', '363', 'English', 'Spring', '2013', '03/30', '0'),
('364', 'HS-D2', '364', 'English', 'Spring', '2013', '03/30', '0'),
('365', 'IS-A', '365', 'English', 'Spring', '2013', '03/30', '0'),
('366', 'IS-C', '366', 'English', 'Spring', '2013', '03/30', '0'),
('367', 'PS-A', '367', 'English', 'Spring', '2013', '03/30', '0'),
('368', 'PS-B', '368', 'English', 'Spring', '2013', '03/30', '0'),
('369', 'HS-B', '369', 'Math', 'Spring', '2013', '03/30', '0'),
('370', 'HS-D1', '370', 'Math', 'Spring', '2013', '03/30', '0'),
('371', 'HS-D2', '371', 'Math', 'Spring', '2013', '03/30', '0'),
('372', 'HS-C', '372', 'Math', 'Spring', '2013', '03/30', '0'),
('373', 'IS-A', '373', 'Math', 'Spring', '2013', '03/30', '0'),
('374', 'PS-A', '374', 'Math', 'Spring', '2013', '03/30', '0'),
('375', 'IS-C', '375', 'Math', 'Spring', '2013', '03/30', '0'),
('376', 'HS-C', '376', 'Math', 'Spring', '2013', '04/06', '0'),
('377', 'HS-B', '377', 'English', 'Spring', '2013', '03/23', '0'),
('378', 'IS-A', '378', 'English', 'Spring', '2013', '04/06', '0'),
('379', 'IS-A', '379', 'Math', 'Spring', '2013', '04/06', '0'),
('380', 'HS-B', '380', 'English', 'Spring', '2013', '04/06', '0'),
('381', 'HS-B', '381', 'Math', 'Spring', '2013', '04/06', '0'),
('382', 'HS-C', '382', 'English', 'Spring', '2013', '04/06', '0'),
('383', 'IS-C', '383', 'English', 'Spring', '2013', '04/06', '0'),
('384', 'IS-C', '384', 'Math', 'Spring', '2013', '04/06', '0'),
('385', 'HS-D1', '385', 'English', 'Spring', '2013', '04/06', '0'),
('386', 'HS-D1', '386', 'Math', 'Spring', '2013', '04/06', '0'),
('387', 'HS-D2', '387', 'English', 'Spring', '2013', '04/06', '0'),
('388', 'HS-D2', '388', 'Math', 'Spring', '2013', '04/06', '0'),
('389', 'PS-A', '389', 'English', 'Spring', '2013', '04/06', '0'),
('390', 'PS-A', '390', 'Math', 'Spring', '2013', '04/06', '0'),
('391', 'PS-B', '391', 'English', 'Spring', '2013', '04/06', '0'),
('392', 'PS-B', '392', 'Math', 'Spring', '2013', '04/06', '0'),
('393', 'HS-B', '393', 'English', 'Spring', '2013', '04/13', '0'),
('394', 'HS-C', '394', 'English', 'Spring', '2013', '04/13', '0'),
('395', 'HS-D1', '395', 'English', 'Spring', '2013', '04/13', '0'),
('396', 'HS-D2', '396', 'English', 'Spring', '2013', '04/13', '0'),
('397', 'IS-C', '397', 'English', 'Spring', '2013', '04/13', '0'),
('398', 'PS-A', '398', 'English', 'Spring', '2013', '04/13', '0'),
('399', 'PS-B', '399', 'English', 'Spring', '2013', '04/13', '0'),
('400', 'HS-D2', '400', 'Math', 'Spring', '2013', '04/13', '0'),
('401', 'IS-A', '401', 'English', 'Spring', '2013', '04/13', '0'),
('402', 'HS-B', '402', 'Math', 'Spring', '2013', '04/13', '0'),
('403', 'HS-C', '403', 'Math', 'Spring', '2013', '04/13', '0'),
('404', 'HS-D1', '404', 'Math', 'Spring', '2013', '04/13', '0'),
('405', 'IS-A', '405', 'Math', 'Spring', '2013', '04/13', '0'),
('406', 'PS-B', '406', 'Math', 'Spring', '2013', '04/13', '0'),
('407', 'PS-A', '407', 'Math', 'Spring', '2013', '04/13', '0'),
('408', 'HS-D2', '408', 'Math', 'Spring', '2013', '04/13', '0'),
('409', 'IS-C', '409', 'Math', 'Spring', '2013', '04/13', '0'),
('410', 'IS-A', '410', 'Math', 'Spring', '2013', '04/20', '0'),
('411', 'PS-A', '411', 'Math', 'Spring', '2013', '04/20', '0'),
('412', 'PS-B', '412', 'Math', 'Spring', '2013', '04/20', '0'),
('413', 'PS-B', '413', 'English', 'Spring', '2013', '04/20', '0'),
('508', 'IS-C', '508', 'Math', 'Spring', '2013', '05/25', '0'),
('415', 'HS-D1', '415', 'English', 'Spring', '2013', '04/20', '0'),
('416', 'HS-D2', '416', 'English', 'Spring', '2013', '04/20', '0'),
('417', 'IS-A', '417', 'English', 'Spring', '2013', '04/20', '0'),
('418', 'IS-C', '418', 'English', 'Spring', '2013', '04/20', '0'),
('419', 'IS-A', '419', 'Math', 'Spring', '2013', '05/25', '0'),
('420', 'HS-B', '420', 'English', 'Spring', '2013', '04/20', '0'),
('421', 'HS-C', '421', 'Math', 'Spring', '2013', '04/20', '0'),
('422', 'PS-B', '422', 'English', 'Spring', '2013', '04/20', '0'),
('423', 'PS-B', '423', 'Math', 'Spring', '2013', '04/20', '0'),
('424', 'PS-A', '424', 'English', 'Spring', '2013', '04/20', '0'),
('425', 'HS-C', '425', 'English', 'Spring', '2013', '04/20', '0'),
('426', 'IS-C', '426', 'Math', 'Spring', '2013', '04/20', '0'),
('427', 'PS-A', '427', 'English', 'Spring', '2013', '04/20', '0'),
('428', 'PS-A', '428', 'Math', 'Spring', '2013', '04/20', '0'),
('429', 'IS-C', '429', 'English', 'Spring', '2013', '04/20', '0'),
('430', 'IS-C', '430', 'Math', 'Spring', '2013', '04/20', '0'),
('431', 'IS-A', '431', 'English', 'Spring', '2013', '04/20', '0'),
('432', 'IS-A', '432', 'Math', 'Spring', '2013', '04/20', '0'),
('433', 'HS-D1', '433', 'English', 'Spring', '2013', '04/20', '0'),
('434', 'HS-D2', '434', 'English', 'Spring', '2013', '04/20', '0'),
('435', 'HS-C', '435', 'English', 'Spring', '2013', '04/20', '0'),
('436', 'HS-D1', '436', 'Math', 'Spring', '2013', '04/20', '0'),
('437', 'HS-D2', '437', 'Math', 'Spring', '2013', '04/20', '0'),
('438', 'HS-D1', '438', 'Math', 'Spring', '2013', '04/20', '0'),
('439', 'HS-C', '439', 'Math', 'Spring', '2013', '04/20', '0'),
('440', 'HS-D2', '440', 'Math', 'Spring', '2013', '04/20', '0'),
('441', 'HS-B', '441', 'Math', 'Spring', '2013', '04/20', '0'),
('442', 'IS-A', '442', 'Math', 'Spring', '2013', '04/27', '0'),
('443', 'PS-A', '443', 'Math', 'Spring', '2013', '04/27', '0'),
('444', 'HS-B', '444', 'Math', 'Spring', '2013', '04/27', '0'),
('445', 'HS-C', '445', 'Math', 'Spring', '2013', '04/27', '0'),
('446', 'HS-D1', '446', 'English', 'Spring', '2013', '04/27', '0'),
('447', 'HS-D2', '447', 'English', 'Spring', '2013', '04/27', '0'),
('448', 'HS-D1', '448', 'Math', 'Spring', '2013', '04/27', '0'),
('449', 'HS-D2', '449', 'Math', 'Spring', '2013', '04/27', '0'),
('450', 'IS-C', '450', 'Math', 'Spring', '2013', '04/27', '0'),
('451', 'PS-B', '451', 'Math', 'Spring', '2013', '04/27', '0'),
('452', 'PS-B', '452', 'English', 'Spring', '2013', '04/27', '0'),
('453', 'PS-A', '453', 'English', 'Spring', '2013', '04/27', '0'),
('454', 'IS-C', '454', 'English', 'Spring', '2013', '04/27', '0'),
('455', 'IS-A', '455', 'English', 'Spring', '2013', '04/27', '0'),
('456', 'HS-C', '456', 'English', 'Spring', '2013', '04/27', '0'),
('457', 'HS-B', '457', 'English', 'Spring', '2013', '04/27', '0'),
('458', 'HS-D1', '458', 'Math', 'Spring', '2013', '05/04', '0'),
('459', 'HS-B', '459', 'Math', 'Spring', '2013', '05/04', '0'),
('460', 'HS-D2', '460', 'Math', 'Spring', '2013', '05/04', '0'),
('461', 'IS-C', '461', 'Math', 'Spring', '2013', '05/04', '0'),
('462', 'HS-B', '462', 'English', 'Spring', '2013', '05/04', '0'),
('463', 'HS-C', '463', 'English', 'Spring', '2013', '05/04', '0'),
('464', 'HS-C', '464', 'Math', 'Spring', '2013', '05/04', '0'),
('465', 'HS-D1', '465', 'English', 'Spring', '2013', '05/04', '0'),
('466', 'HS-D2', '466', 'English', 'Spring', '2013', '05/04', '0'),
('467', 'IS-A', '467', 'English', 'Spring', '2013', '05/04', '0'),
('468', 'IS-A', '468', 'Math', 'Spring', '2013', '05/04', '0'),
('469', 'IS-C', '469', 'English', 'Spring', '2013', '05/04', '0'),
('470', 'PS-A', '470', 'English', 'Spring', '2013', '05/04', '0'),
('471', 'PS-A', '471', 'Math', 'Spring', '2013', '05/04', '0'),
('472', 'PS-B', '472', 'Math', 'Spring', '2013', '05/04', '0'),
('473', 'PS-B', '473', 'English', 'Spring', '2013', '05/04', '0'),
('474', 'IS-A', '474', 'Math', 'Spring', '2013', '05/11', '0'),
('475', 'PS-B', '475', 'Math', 'Spring', '2013', '05/11', '0'),
('476', 'PS-A', '476', 'Math', 'Spring', '2013', '05/11', '0'),
('477', 'IS-C', '477', 'Math', 'Spring', '2013', '05/11', '0'),
('478', 'HS-B', '478', 'Math', 'Spring', '2013', '05/15', '0'),
('479', 'HS-D1', '479', 'English', 'Spring', '2013', '05/18', '0'),
('480', 'HS-D1', '480', 'Math', 'Spring', '2013', '05/11', '0'),
('481', 'HS-D2', '481', 'Math', 'Spring', '2013', '05/11', '0'),
('482', 'HS-B', '482', 'English', 'Spring', '2013', '05/11', '0'),
('483', 'HS-C', '483', 'English', 'Spring', '2013', '05/11', '0'),
('484', 'HS-D1', '484', 'English', 'Spring', '2013', '05/11', '0'),
('485', 'HS-D2', '485', 'English', 'Spring', '2013', '05/11', '0'),
('486', 'PS-B', '486', 'English', 'Spring', '2013', '05/11', '0'),
('487', 'PS-A', '487', 'English', 'Spring', '2013', '05/11', '0'),
('488', 'IS-A', '488', 'English', 'Spring', '2013', '05/11', '0'),
('489', 'IS-C', '489', 'English', 'Spring', '2013', '05/11', '0'),
('490', 'HS-C', '490', 'Math', 'Spring', '2013', '05/11', '0'),
('491', 'IS-A', '491', 'Math', 'Spring', '2013', '05/18', '0'),
('492', 'IS-A', '492', 'English', 'Spring', '2013', '05/18', '0'),
('493', 'PS-B', '493', 'Math', 'Spring', '2013', '05/18', '0'),
('494', 'IS-C', '494', 'Math', 'Spring', '2013', '05/18', '0'),
('495', 'PS-A', '495', 'Math', 'Spring', '2013', '05/18', '0'),
('496', 'HS-B', '496', 'English', 'Spring', '2013', '05/18', '0'),
('497', 'HS-C', '497', 'English', 'Spring', '2013', '05/18', '0'),
('498', 'HS-C', '498', 'Math', 'Spring', '2013', '05/18', '0'),
('499', 'HS-D2', '499', 'English', 'Spring', '2013', '05/18', '0'),
('500', 'HS-D1', '500', 'English', 'Spring', '2013', '05/18', '0'),
('501', 'IS-C', '501', 'English', 'Spring', '2013', '05/18', '0'),
('502', 'PS-A', '502', 'English', 'Spring', '2013', '05/18', '0'),
('503', 'PS-B', '503', 'English', 'Spring', '2013', '05/18', '0'),
('504', 'HS-B', '504', 'Math', 'Spring', '2013', '05/18', '0'),
('505', 'HS-D1', '505', 'Math', 'Spring', '2013', '05/18', '0'),
('506', 'HS-D2', '506', 'Math', 'Spring', '2013', '05/18', '0'),
('507', 'IS-C', '507', 'Math', 'Spring', '2013', '05/18', '0'),
('509', 'PS-B', '509', 'English', 'Spring', '2013', '05/25', '0'),
('510', 'PS-B', '510', 'Math', 'Spring', '2013', '05/25', '0'),
('511', 'PS-A', '511', 'Math', 'Spring', '2013', '05/25', '0'),
('512', 'PS-A', '512', 'English', 'Spring', '2013', '05/25', '0'),
('513', 'IS-C', '513', 'English', 'Spring', '2013', '05/25', '0'),
('514', 'IS-A', '514', 'English', 'Spring', '2013', '05/25', '0'),
('515', 'HS-D2', '515', 'Math', 'Spring', '2013', '05/25', '0'),
('516', 'HS-D1', '516', 'Math', 'Spring', '2013', '05/25', '0'),
('517', 'HS-B', '517', 'Math', 'Spring', '2013', '05/25', '0'),
('518', 'HS-B', '518', 'English', 'Spring', '2013', '05/25', '0'),
('519', 'HS-C', '519', 'English', 'Spring', '2013', '05/25', '0'),
('520', 'HS-C', '520', 'Math', 'Spring', '2013', '05/25', '0'),
('521', 'HS-D1', '521', 'English', 'Spring', '2013', '05/25', '0'),
('522', 'HS-D2', '522', 'English', 'Spring', '2013', '05/25', '0');
