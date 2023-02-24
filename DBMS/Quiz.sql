--1
(SELECT name, major
FROM student_596 NATURAL JOIN grade_report_596)
EXCEPT
(SELECT name, major
FROM student_596 NATURAL JOIN grade_report_596
WHERE grade = "A")

--2
DELIMITER $$
CREATE OR REPLACE FUNCTION marks(GRADE char(1))
RETURNS INTEGER
DETERMINISTIC
BEGIN
 IF GRADE = "A" THEN
 RETURN 100;
 ELSEIF GRADE = "B" THEN
 RETURN 90;
 ELSEIF GRADE = "C" THEN
 RETURN 80;
 ELSEIF GRADE = "D" THEN
 RETURN 70;
 END IF;
END$$
DELIMITER ;
CREATE OR REPLACE VIEW Student_report_596 AS
select G.StudentNumber, G.SectionIdentifier, S.Instructor, marks(G.Grade)
from grade_report_596 G INNER JOIN section_596 S ON G.SectionIdentifier=S.SectionIdentifier;
Select * from Student_report_596;

--3
DELIMITER $$
CREATE OR REPLACE TRIGGER remark
BEFORE INSERT ON grade_report_596
FOR EACH ROW
BEGIN
    IF new.grade = "A" THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Excellent';
    END IF;
    IF new.grade = "B" THEN
    	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Very good';
    END IF;   
    IF new.grade = "C" THEN
    	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Fair';
    END IF;
END; 
$$ DELIMITER ;

INSERT into GRADE_REPORT_596 
VALUES (154,4,'A');

INSERT into GRADE_REPORT_596 
VALUES (154,4,'B');

INSERT into GRADE_REPORT_596 
VALUES (154,4,'C');