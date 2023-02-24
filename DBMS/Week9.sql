----------------------------------------------------------------------------------------------------------------------------------------

-- Name: Srinandan A
-- SRN: PES1UG20CS596
-- Class: 5 J

------------------------------------------------------------PROBLEM 1--------------------------------------------------------------------

-- Creating trigger
DELIMITER $$ 
CREATE OR REPLACE TRIGGER check_compartment_count
BEFORE INSERT ON compartment_596
FOR EACH ROW
BEGIN
  IF (SELECT COUNT(*) FROM compartment_596 WHERE train_no = NEW.train_no) >= 4 THEN
     SIGNAL SQLSTATE '50001' SET MESSAGE_TEXT = 'Cannot add more than 4 compartments to a train';
  END IF;
END;$$
DELIMITER ;

-- Error case
INSERT INTO compartment_596 
VALUES("F01","CLASS I","12","8","62621");

-- Normal case
INSERT INTO compartment_596 
VALUES("F01","CLASS I","12","8","25260");

-------------------------------------------------------------PROBLEM 2------------------------------------------------------------------

-- Creating backup table
CREATE table backup_596 
(pnr varchar(10),train_no int(11), travel_date date,departure varchar(30), arrival varchar(30),departure_time time,arrival_time time, 
passenger_id varchar(20),train_type varchar(20), compartment_type varchar(10), compartment_no varchar(10),seat_no varchar(10),name varchar(30),age int(11), transaction_no int(11),bank varchar(20),card_no varchar(20),price INT);

-- Adding necessary constraints
ALTER TABLE ticket_passenger_596 
ADD CONSTRAINT dt FOREIGN KEY (pnr) REFERENCES ticket_596(pnr) ON DELETE CASCADE;
ALTER TABLE payment_info_596 
ADD CONSTRAINT dp FOREIGN KEY (pnr) REFERENCES ticket_596(pnr) ON DELETE CASCADE;

-- Creating trigger
DELIMITER $$ 
CREATE TRIGGER DELETE_ticket
BEFORE DELETE
ON ticket_596 FOR EACH ROW
BEGIN
	INSERT INTO backup_596 
    (SELECT * FROM 
    (ticket_596 NATURAL JOIN(ticket_passenger_596 NATURAL JOIN payment_info_596)) 
    WHERE pnr=old.pnr);
END;$$
DELIMITER ;

-- Deleting a row from the table
DELETE FROM ticket_596 where pnr="PNR005";

-- Checking the backup table
SELECT * FROM backup_596;

----------------------------------------------------------------------------------------------------------------------------------------