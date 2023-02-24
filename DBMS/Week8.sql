Function:
DELIMITER $$
CREATE FUNCTION count_ticket(ticket int)
RETURNS VARCHAR(50)
DETERMINISTIC
BEGIN
DECLARE VALUE varchar(50);
IF ticket>3 then
set VALUE="Not Eligible";
 ELSE
set VALUE ="Eligible";
 end if;
 return value;
END;
$$
DELIMITER ;
with t as (Select User_ID,count(PNR) as count from ticket_596 group by User_ID )
select User_ID,count_ticket(count) as Validate,count as ticket_purchased from t;

Stored Procedure:
DELIMITER $$
CREATE procedure age_updation(
IN UID varchar(30),IN DB date, OUT msg varchar(30))
BEGIN
DECLARE Age int;
IF DB>sysdate() THEN
set msg= 'Invalid DoB';
ELSE
update passenger_596
set Age=(datediff(sysdate(),DB))/365
where User_ID= UID;
update passenger_596
set DOB=DB
where User_ID=UID;
set msg='Age updated Successfully';
END IF;
END;$$
DELIMITER ;
CALL age_updation('USR_001','2002-08-26',@A);
SELECT @A;
select * from passenger_596 where User_ID='USR_001';