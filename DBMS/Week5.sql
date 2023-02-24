-- SRINANDAN A
-- PES1UG20CS596
-- SEC 5J ROLL 32

-- PROBLEM 1
CREATE VIEW price_comp AS SELECT
    ticket_596.PNR,
    ticket_596.Train_no,
    ticket_596.Departure,
    ticket_596.Arrival,
    route_info_596.Distance,
    fare_596.fare_per_km
FROM
    ticket_596,
    route_info_596,
    fare_596
WHERE
    (
        ticket_596.Train_no = route_info_596.Train_no AND ticket_596.Departure = route_info_596.From_station_Name AND ticket_596.Arrival = route_info_596.To_station_Name AND fare_596.Train_type = ticket_596.Train_type AND fare_596.compartment_596_Type = ticket_596.compartment_596_type
    );

CREATE VIEW pass_num AS SELECT PNR, COUNT(PNR) AS number FROM ticket_passenger GROUP BY PNR;

UPDATE
    payment_info_596 AS payment
INNER JOIN price_comp AS price
ON
    payment.PNR = price.PNR
INNER JOIN pass_num AS num
ON
    price.PNR = payment.PNR
SET
    payment.Price = price.Distance * price.fare_per_km * num.number;

-- PROBLEM 2
SELECT * FROM train_596 NATURAL JOIN route_info_596;

-- PROBLEM 3
SELECT
    route_info_596.`Train_no`
FROM
    route_info_596
JOIN compartment_596 ON route_info_596.Train_no = compartment_596.Train_no
WHERE
    compartment_596.Availability > 10 AND route_info_596.From_station_Name = 'Bengaluru' AND route_info_596.To_station_Name = 'Chennai';

-- PROBLEM 4
SELECT
    Firstname,
    Lastname
FROM
    passenger_596
JOIN ticket_596 AS T
ON
    passenger_596.User_Id = T.User_Id
JOIN payment_info_596 ON payment_info_596.PNR = T.PNR
WHERE
    payment_info_596.Price > 500;

-- PROBLEM 5
SELECT
    Firstname,
    Lastname,
    DOB,
    PNR
FROM
    passenger_596
LEFT OUTER JOIN ticket_596 ON passenger_596.User_Id = ticket_596.passenger_id
WHERE
    ticket_596.PNR IS NOT NULL;

-- PROBLEM 6
SELECT
    Firstname,
    Lastname
FROM
    passenger_596
LEFT OUTER JOIN ticket_596 ON passenger_596.User_Id = ticket_596.passenger_id
WHERE
    ticket_596.PNR IS NULL;

-- PROBLEM 7
SELECT
    Firstname,
    Lastname,
	Train_no,
    Travel,
    PNR
FROM
    passenger_596
RIGHT OUTER JOIN ticket_596 ON passenger_596.User_Id = ticket_596.passenger_id
WHERE
    passenger_596.User_Id IS NOT NULL;

-- PROBLEM 8
SELECT
    User_Id,
    Train_Name,
    train_596.Train_no
FROM
    ticket_596
RIGHT OUTER JOIN train_596 ON train_596.Train_no = ticket_596.Train_no;

-- PROBLEM 9
SELECT Train_no FROM train_596 WHERE Destination != 'Mangaluru';

-- PROBLEM 10
SELECT
    ticket_596.passenger_id
FROM
    ticket_596
JOIN payment_info_596 ON payment_info_596.PNR = ticket_596.PNR
WHERE
    payment_info_596.Price >
(
    SELECT
        AVG(Price)
    FROM
        payment_info_596
);