/* --------------------------------------------------------------------------------------------------
    Group 5
    Members: Hoi Yi Chiu, MySQL Expert
             Pouyan Forouzandeh, MS SQL Server Expert
----------------------------------------------------------------------------------------------------*/
USE G5_Recre8Master;

/* --------------------------------------------------------------------------------------------------
	1.Occupied Hours of Building B Tennis Court
----------------------------------------------------------------------------------------------------*/
SELECT SUM(TimeInterval) TotalBookingHoursInBuildingBTennisCourt
FROM (SELECT *
    FROM Reservation
    WHERE FacilityName ='Tennis Court' AND BuildingName = 'Building B') tCourt;


/* --------------------------------------------------------------------------------------------------
	2.Show facility that has no reservation at 2023-04-01
----------------------------------------------------------------------------------------------------*/
SELECT B.BuildingName, B.FacilityName
FROM (SELECT *
    FROM Reservation
    WHERE ReservationDate = '2023-04-01'
      )R RIGHT JOIN BuildingFacility B
    ON R.FacilityName = B.FacilityName;


/* --------------------------------------------------------------------------------------------------
	3.Update Resident EndDate of living
----------------------------------------------------------------------------------------------------*/
UPDATE Resident
SET EndDate='2023-07-21'
WHERE BookerID = (SELECT BookerID
FROM Booker
WHERE BookerName = 'Koo Telus');


/* --------------------------------------------------------------------------------------------------
	4.Update Reservation information
----------------------------------------------------------------------------------------------------*/
UPDATE Reservation
SET ReservationDate='2023-12-11 17:00:00'
WHERE ReservationDate ='2023-11-04 17:00:00'
    AND BuildingName = 'Building D'
    AND FacilityName = 'Messi';


/* --------------------------------------------------------------------------------------------------
    5.Deletes the reservation from a specific facility and specific time
----------------------------------------------------------------------------------------------------*/
DELETE 
FROM Reservation 
WHERE FacilityName = 'B-B Gym'
    AND ReservationDate = '2023-08-22 17:30:00';


/* --------------------------------------------------------------------------------------------------
    6.Deleting a Facility from a building
----------------------------------------------------------------------------------------------------*/
DELETE 
FROM BuildingFacility
WHERE FacilityType = 'Pool' AND BuildingName = 'Building A';


/* --------------------------------------------------------------------------------------------------
    7.Shows all the reservations based on the phone number of booker
----------------------------------------------------------------------------------------------------*/
SELECT R.ReservationID, R.ReservationDate, R.BuildingName, R.FacilityName
FROM Reservation R
    LEFT JOIN ResidentReservation RR ON R.ReservationID = RR.ReservationID
    LEFT JOIN NonResidentReservation NRR ON R.ReservationID = NRR.ReservationID
    LEFT JOIN Booker B ON (RR.ResidentBookerID = B.BookerID OR NRR.NonResidentBookerID = B.BookerID)
WHERE B.PhoneNumber = 7789876543;


/* --------------------------------------------------------------------------------------------------
    8.showing bookers and their emails
----------------------------------------------------------------------------------------------------*/
SELECT ReservationID, ReservationDate, NoOfGuest, B.BuildingName, B.FacilityName, B.FacilityDescription
FROM Reservation R INNER JOIN BuildingFacility B
    ON R.FacilityName = B.FacilityName
WHERE R.ReservationDate >= NOW()
    AND FacilityType = 'Gym';

-- This is the different version for MS SQL SERVER Since it does not have NOW() as built in function
--       SELECT ReservationID, ReservationDate, NoOfGuest, B.BuildingName, B.FacilityName, B.FacilityDescription
-- FROM Reservation R
-- INNER JOIN BuildingFacility B ON R.FacilityName = B.FacilityName
-- WHERE R.ReservationDate >= CONVERT(DATETIME, GETDATE())
--       AND FacilityType = 'Gym';


/* --------------------------------------------------------------------------------------------------
	9.Count total number of booking for facility after 18:00:00 and booked for more than 3 hours
----------------------------------------------------------------------------------------------------*/
CREATE VIEW NonResidentBookingsCount
AS
    SELECT RF.ReservationDate, COUNT(DISTINCT NRR.NonResidentBookerID) AS NumberOfNonResidents
    FROM Reservation RF
        LEFT JOIN NonResidentReservation NRR ON RF.ReservationID = NRR.ReservationID
    GROUP BY RF.ReservationDate;

CREATE VIEW ResidentBookingsCount
AS
    SELECT RF.ReservationDate, COUNT(DISTINCT RR.ResidentBookerID) AS NumberOfResidents
    FROM Reservation RF
        LEFT JOIN ResidentReservation RR ON RF.ReservationID = RR.ReservationID
    GROUP BY RF.ReservationDate;

SELECT NR.ReservationDate, NR.NumberOfNonResidents AS NonResidentBookings,
    RB.NumberOfResidents AS ResidentBookings,
    NR.NumberOfNonResidents + RB.NumberOfResidents AS TotalBookings
FROM NonResidentBookingsCount NR
    JOIN ResidentBookingsCount RB ON NR.ReservationDate = RB.ReservationDate;


/* --------------------------------------------------------------------------------------------------
    10.Sort faciilities based on their popularity
----------------------------------------------------------------------------------------------------*/
SELECT BF.FacilityName, COUNT(*) AS BookingCount
FROM BuildingFacility BF
    JOIN Reservation R ON BF.BuildingName = R.BuildingName AND BF.FacilityName = R.FacilityName
GROUP BY BF.FacilityName
ORDER BY BookingCount DESC;


/* --------------------------------------------------------------------------------------------------
    11.Shows all reservation details that an specific staff has booked
----------------------------------------------------------------------------------------------------*/
SELECT ReservationID, NoOfGuest, ReservationDate, TimeInterval
FROM Reservation
WHERE StaffID = 100001;


/* --------------------------------------------------------------------------------------------------
    12.facility name, facility type, and building address for a specific building (Ex. Building A)
----------------------------------------------------------------------------------------------------*/
SELECT BF.FacilityName, BF.FacilityType, B.BuildingAddress
FROM BuildingFacility BF
    JOIN Building B ON BF.BuildingName = B.BuildingName
WHERE B.BuildingName = 'Building A';


/* --------------------------------------------------------------------------------------------------
	13. #of non residents and the average they deposit and total deposit amount
----------------------------------------------------------------------------------------------------*/
SELECT COUNT(NonResidentBookerID) AS TotalNumOfNonResidents , AVG(DepositAmount) AS AverageDepositByNonResidents , SUM(DepositAmount) AS TotalDesposit
FROM NonResidentReservation;


/* --------------------------------------------------------------------------------------------------
    14.Summary of Bulding, Facilities and all the booking assosiated to the buidling
----------------------------------------------------------------------------------------------------*/
CREATE VIEW BuildingReservationSummary
AS
    SELECT B.BuildingName, BF.FacilityName, R.ReservationID, R.ReservationDate, E.StaffName
    FROM Reservation R
        JOIN Building B ON R.BuildingName = B.BuildingName
        JOIN BuildingFacility BF ON R.BuildingName = BF.BuildingName AND R.FacilityName = BF.FacilityName
        JOIN Employee E ON R.StaffID = E.StaffID;

SELECT *
FROM BuildingReservationSummary
ORDER BY BuildingName;


/* --------------------------------------------------------------------------------------------------
    15.Total reservation made by each booker
----------------------------------------------------------------------------------------------------*/
SELECT B.BookerID, B.BookerName, COUNT(*) AS TotalReservations
FROM Booker B
    JOIN ResidentReservation RR ON B.BookerID = RR.ResidentBookerID
GROUP BY B.BookerID, B.BookerName;


/* --------------------------------------------------------------------------------------------------
    16.List bookers who have booked more than once
----------------------------------------------------------------------------------------------------*/
SELECT B.BookerID, B.BookerName, COUNT(R.ReservationID) AS NumBookings
FROM Booker B
    JOIN ResidentReservation RR ON B.BookerID = RR.ResidentBookerID
    JOIN Reservation R ON RR.ReservationID = R.ReservationID
GROUP BY B.BookerID, B.BookerName
HAVING COUNT(R.ReservationID) > 1;


/* --------------------------------------------------------------------------------------------------
    17.List of facilities that has never been booked
----------------------------------------------------------------------------------------------------*/
SELECT B.BuildingName, BF.FacilityName
FROM Building B
    JOIN BuildingFacility BF ON B.BuildingName = BF.BuildingName
    LEFT JOIN Reservation R ON B.BuildingName = R.BuildingName AND BF.FacilityName = R.FacilityName
WHERE R.ReservationID IS NULL;


/* --------------------------------------------------------------------------------------------------
    18.number of reservations for each day
----------------------------------------------------------------------------------------------------*/
SELECT ReservationDate, COUNT(*) AS NumberOfBookings
FROM Reservation
GROUP BY ReservationDate;


/* --------------------------------------------------------------------------------------------------
    19.list of bookers who did not show up
----------------------------------------------------------------------------------------------------*/
SELECT B.BookerName, B.PhoneNumber, B.Email
FROM Booker B
    JOIN ResidentReservation RR ON B.BookerID = RR.ResidentBookerID
    JOIN Reservation R ON RR.ReservationID = R.ReservationID
WHERE R.ShowingUp = 0;


/* --------------------------------------------------------------------------------------------------
    20.Employee with highest bookings
----------------------------------------------------------------------------------------------------*/
SELECT StaffID, StaffName, BookingCount
FROM (
    SELECT E.StaffID, E.StaffName, COUNT(*) AS BookingCount
    FROM Employee E
        JOIN Reservation R ON E.StaffID = R.StaffID
    GROUP BY E.StaffID, E.StaffName
) AS EmployeeBookings
WHERE BookingCount = (
    SELECT MAX(BookingCount)
FROM (
        SELECT COUNT(*) AS BookingCount
    FROM Reservation
    GROUP BY StaffID
    ) AS CountTable);

/* --------------------------------------------------------------------------------------------------
	                                *** THE END ***
----------------------------------------------------------------------------------------------------*/