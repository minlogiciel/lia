
INSERT INTO NEWS_V20 (UTITLE, UTEXT, UAUTOR, UTIME, UGROUP, UPARENT, ULEVEL, UREAD, URESP, UTYPES) 
VALUES (
	'About Long Island Academy', 'Founded in 1990 in Syosset, ', 'LIA', 1315229963, 1, 0, 1, 0, 0, '1');

INSERT INTO SSCORES (STUDENTID, GRADE) 
VALUES (0, 0); 

INSERT INTO SCORES_REF (IDS, GRADE, GROUPS, SUBJECTS, SEMESTER, PERIODS) 
VALUES (1, 0, 0, 'English', 'Fall', 2011); 

INSERT INTO STUDENTS (PSEUDO, PASSWD, LASTNAME, FIRSTNAME, GRADE, ISDELETED) 
VALUES ('ADMIN', '0000', 'M', 'LIA', 'USA', 0); 
