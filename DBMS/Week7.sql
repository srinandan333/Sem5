-- PROBLEM 0
INSERT INTO ticket_596 (Arrival, Arrival_time, compartment, compartment_no, Departure, Departure_time, PNR, Train_no, Train_type, Travel_date, User_id)
VALUES ('Chennai', '20:30:00', 'I Class', 'F01', 'Bengaluru', '16:00:00', 'PNR021', 62621, 'Superfast', '2021-10-22', 'USR_008');
update train_596 set source = trim(source), destination =
trim(destination);

-- PROBLEM 1
(select passenger_596.User_id, User_type, Firstname, Lastname from ticket_596 LEFT OUTER JOIN passenger_596 ON ticket_596.User_id = passenger_596.User_ID
where ticket_596.Departure = 'Bengaluru' and ticket_596.Arrival = 'Chennai' and MONTH(Travel_Date) = 10 and YEAR(Travel_date) = 2021)
UNION
(select passenger_596.User_id, User_type, Firstname, Lastname from ticket_596 LEFT OUTER JOIN passenger_596 ON ticket_596.User_id = passenger_596.User_ID
where ticket_596.Departure = 'Bengaluru' and ticket_596.Arrival = 'Chennai' and MONTH(Travel_Date) = 8 and YEAR(Travel_date) = 2022);

-- PROBLEM 2
select u.User_id, User_type, Firstname, Lastname 
from ticket_596 as t, passenger_596 as u 
where t.User_id = u.User_ID and 
t.departure = 'Bengaluru' and t.Arrival = 'Chennai' and 
exists(select pnr from ticket_596 where t.PNR = pnr and month(travel_date) = 10 and year(travel_date) = 2021) 
AND
exists (select pnr from ticket_596 where t.PNR = pnr and month(travel_date) = 8 and year(travel_date) = 2022);

-- PROBLEM 3
select u.User_id, User_type, Firstname, Lastname 
from ticket_596 as t, passenger_596 as u 
where t.User_id = u.User_ID and 
t.departure = 'Bengaluru' and t.Arrival = 'Chennai' and 
not exists(select pnr from ticket_596 where t.PNR = pnr and month(travel_date) = 10 and year(travel_date) = 2021) 
AND
exists (select pnr from ticket_596 where t.PNR = pnr and month(travel_date) = 8 and year(travel_date) = 2022);

-- PROBLEM 4
select u.User_id, User_type, Firstname, Lastname 
from ticket_596 as t, passenger_596 as u 
where t.User_id = u.User_ID
and t.Departure = 'Bengaluru' and t.Arrival = 'Chennai'
and exists(select pnr from ticket_596 as ti where t.User_id = ti.User_id and ti.Departure = 'Chennai' and ti.Arrival = 'Bengaluru' and (DATEDIFF(ti.Travel_Date,t.Travel_Date) BETWEEN 0 and 7));

-- PROBLEM 5
select u.User_id, User_type, Firstname, Lastname 
from ticket_596 as t, passenger_596 as u 
where t.User_id = u.User_ID
and t.Departure = 'Bengaluru' and t.Arrival = 'Chennai'
and not exists(select pnr from ticket_596 as ti where t.User_id = ti.User_id and ti.Departure = 'Chennai' and ti.Arrival = 'Bengaluru');