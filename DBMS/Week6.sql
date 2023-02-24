--PROBLEM 1
SELECT AVG(Distance),Train_no FROM route_info_596 WHERE To_Station_No = From_Station_No + 1 GROUP BY Train_no;

--PROBLEM 2
SELECT AVG(Distance),Train_no FROM route_info_596 WHERE To_Station_No = From_Station_No + 1 GROUP BY Train_no order by AVG(Distance) DESC;

--PROBLEM 3
SELECT SUM(Distance),Train_no FROM route_info_596 WHERE To_Station_No = From_Station_No + 1 GROUP BY Train_no order by SUM(Distance) DESC;

--PROBLEM 4
SELECT Train_name, num
FROM
    (
    SELECT Train_name, COUNT(*) AS num
    FROM train_596
    INNER JOIN compartment_596 ON train_596.Train_no = `compartment_596`.`Train_no`
    GROUP BY train_596.Train_no) AS t
    WHERE num =
        (
            SELECT MAX(num)
            FROM
                (
                SELECT Train_name, COUNT(*) AS num
                FROM train_596
                INNER JOIN compartment_596 ON train_596.Train_no = `compartment_596`.`Train_no`
                GROUP BY train_596.Train_no
                ) AS t
        ) 
        OR 
        num =
        (
        SELECT MIN(num)
        FROM
            (
            SELECT Train_name, COUNT(*) AS num
            FROM train_596
            INNER JOIN compartment_596 ON train_596.Train_no = `compartment_596`.`Train_no`
            GROUP BY train_596.Train_no
            ) AS t
        );

--PROBLEM 5

select User_ID, count(`Phone_no`) from `user_phone_596` where User_ID="ADM_001" or User_ID="USR_006" or User_ID="USR_010" group by User_ID;

--PROBLEM 6
SELECT Train_type, AVG(`Fare_per_km`) AS Avg_Fare FROM fare_596 GROUP BY Train_type ORDER BY AVG(`Fare_per_km`) DESC;

--PROBLEM 7

SELECT * FROM `ticket_passenger_596` WHERE Age=(SELECT MAX(Age) FROM `ticket_passenger_596`);

--PROBLEM 8
SELECT COUNT(Name) FROM `ticket_passenger_596` WHERE Name LIKE '%Ullal%';