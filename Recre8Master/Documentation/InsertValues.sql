/* --------------------------------------------------------------------------------------------------
    Group 5
    Members: Hoi Yi Chiu, MySQL Expert
             Pouyan Forouzandeh, MS SQL Server Expert
----------------------------------------------------------------------------------------------------*/
USE G5_Recre8Master;

-- Data for Booker table
INSERT INTO Booker
VALUES (1, 'John Doe', '1990-02-08', 7789876543, 'johndoe@example.com');
INSERT INTO Booker
VALUES (2, 'Jeff Bezos', '1991-01-01', 7781111111, 'jeff@amazon.ca');
INSERT INTO Booker
VALUES (3, 'Bill Gates', '1985-12-24', 1111111111, 'bill@microsoft.com');
INSERT INTO Booker
VALUES (4, 'Elon Musk', '2006-04-23', 6041111111, 'Elon@SpaceX.com');
INSERT INTO Booker
VALUES (5, 'Ada William', '2012-05-18', 2364264811, 'awill@baby.com');
INSERT INTO Booker
VALUES (6, 'Roger Shaw', '2000-02-20', 2369287342, 'rshaw@gmail.com');
INSERT INTO Booker
VALUES (7, 'Koo Telus', '2002-07-11', 2361122111, 'ktelus@gmail.com');

-- Data for Resident table
INSERT INTO Resident
VALUES (1, '2015-07-01', '2023-09-30');
INSERT INTO Resident
VALUES (2, '2020-04-12', '2023-06-21');
INSERT INTO Resident
VALUES (3, '2023-07-01', NULL);
INSERT INTO Resident
VALUES (7, '2015-07-01', NULL);

-- Data for NonResident table
INSERT INTO NonResident
VALUES (4, '123 Main Street');
INSERT INTO NonResident
VALUES (5, '456 Not Main Street');
INSERT INTO NonResident
VALUES (6, '755 West 49th avenue vancouver');

-- Data for Employee table
INSERT INTO Employee
VALUES (100001, 'Manager', 'Jane Doe');
INSERT INTO Employee
VALUES (100002, 'Supervisor', 'Jane Moe');
INSERT INTO Employee
VALUES (100003, 'Staff', 'Taylor Moe');

-- Data for Building table
INSERT INTO Building
VALUES ('Building A', '456 Georgia Street');
INSERT INTO Building
VALUES ('Building B', '457 Georgia Street');
INSERT INTO Building
VALUES ('Building C', '455 Georgia Street');
INSERT INTO Building
VALUES ('Building D', '453 Georgia Street');


-- Data for BuildingFacility table
INSERT INTO BuildingFacility
VALUES ('Building A', 'B-A Gym', 'Gym', 'Floor 1', 'Fully equipped fitness center');
INSERT INTO BuildingFacility
VALUES ('Building A', 'B-A Pool', 'Pool', 'Floor 1', 'Fully equipped pool kids friendly');
INSERT INTO BuildingFacility
VALUES ('Building B', 'B-B Gym', 'Gym', 'Floor 12', 'Fully equipped fitness center');
INSERT INTO BuildingFacility
VALUES ('Building B', 'Tennis Court', 'Tennis', 'Floor -4', 'Fully equipped tennis court');
INSERT INTO BuildingFacility
VALUES ('Building C', 'Namaste', 'Yoga', 'East Entrance', 'Fully equipped yoga center');
INSERT INTO BuildingFacility
VALUES ('Building C', 'B-C Pool', 'Pool', 'Floor 2', 'Fully equipped pool');
INSERT INTO BuildingFacility
VALUES ('Building D', 'Falcons', 'Basketball', 'Main Entrance', 'Basketball Court - Home court for Falcon team');
INSERT INTO BuildingFacility
VALUES ('Building D', 'Messi', 'Football', 'Floor 30', 'A grass football field with exceptional view to the downton');

-- Data for BuildingApartment table
INSERT INTO BuildingApartment
VALUES ('Building A', 101);
INSERT INTO BuildingApartment
VALUES ('Building A', 102);

INSERT INTO BuildingApartment
VALUES ('Building B', 101);
INSERT INTO BuildingApartment
VALUES ('Building B', 201);

INSERT INTO BuildingApartment
VALUES ('Building C', 101);
INSERT INTO BuildingApartment
VALUES ('Building C', 201);
INSERT INTO BuildingApartment
VALUES ('Building C', 301);

INSERT INTO BuildingApartment
VALUES ('Building D', 101);

-- Data for ResidentLivesInApartment table
INSERT INTO ResidentLivesInApartment
VALUES (1, 'Building A', 101);
INSERT INTO ResidentLivesInApartment
VALUES (2, 'Building C', 201);
INSERT INTO ResidentLivesInApartment
VALUES (3, 'Building B', 101);
INSERT INTO ResidentLivesInApartment
VALUES (7, 'Building D', 101);

-- Data for ResidentHasouseholdMember table
INSERT INTO ResidentHasouseholdMember
VALUES (1, 1, 'Sarah Doe');
INSERT INTO ResidentHasouseholdMember
VALUES (1, 2, 'Mary Doe');
INSERT INTO ResidentHasouseholdMember
VALUES (1, 3, 'Sam Doe');
INSERT INTO ResidentHasouseholdMember
VALUES (2, 1, 'Jafar Bezos');

-- Data for Reservation table
INSERT INTO Reservation
VALUES (2023001, 2, 1, 1, '2023-02-11 21:00:00', 'Building A', 'B-A Gym', 100001);
INSERT INTO Reservation
VALUES (2023002, 2, 1, 2, '2023-02-20 18:00:00', 'Building B', 'B-B Gym', 100001);
INSERT INTO Reservation
VALUES (2023003, 2, 0, 1, '2023-03-15 09:00:00', 'Building B', 'Tennis Court', 100002);
INSERT INTO Reservation
VALUES (2023004, 6, 1, 1, '2023-04-01 10:00:00', 'Building C', 'Namaste', 100002);
INSERT INTO Reservation
VALUES (2023005, 12, 1, 2, '2023-04-01 14:00:00', 'Building D', 'Messi', 100001);
INSERT INTO Reservation
VALUES (2023006, 8, 0, 4, '2023-05-02 15:30:00', 'Building D', 'Falcons', 100003);
INSERT INTO Reservation
VALUES (2023007, 9, 1, 2, '2023-05-31 16:30:00', 'Building D', 'Falcons', 100002);
INSERT INTO Reservation
VALUES (2023008, 4, 1, 3, '2023-06-20 19:30:00', 'Building B', 'Tennis Court', 100002);
INSERT INTO Reservation
VALUES (2023009, 1, NULL, 1, '2023-07-29 20:30:00', 'Building B', 'B-B Gym', 100001);
INSERT INTO Reservation
VALUES (2023010, 1, NULL, 1, '2023-08-22 17:30:00', 'Building B', 'B-B Gym', 100003);
INSERT INTO Reservation
VALUES (2023011, 10, NULL, 2, '2023-11-04 17:00:00', 'Building D', 'Messi', 100002);
INSERT INTO Reservation
VALUES (2023012, 10, NULL, 2, '2023-12-10 14:00:00', 'Building D', 'Falcons', 100002);
INSERT INTO Reservation
VALUES (2023013, 1, NULL, 1, '2023-12-11 16:30:00', 'Building B', 'B-B Gym', 100003);

-- Data for NonResidentReservation table
INSERT INTO NonResidentReservation
VALUES (2023001, 4, 1000);
INSERT INTO NonResidentReservation
VALUES (2023002, 5, 1000);
INSERT INTO NonResidentReservation
VALUES (2023009, 6, 1000);
INSERT INTO NonResidentReservation
VALUES (2023012, 5, 1000);

-- Data for ResidentReservation table
INSERT INTO ResidentReservation
VALUES (2023003, 1);
INSERT INTO ResidentReservation
VALUES (2023004, 2);
INSERT INTO ResidentReservation
VALUES (2023005, 3);
INSERT INTO ResidentReservation
VALUES (2023006, 1);
INSERT INTO ResidentReservation
VALUES (2023007, 1);
INSERT INTO ResidentReservation
VALUES (2023008, 1);
INSERT INTO ResidentReservation
VALUES (2023010, 2);
INSERT INTO ResidentReservation
VALUES (2023011, 1);
INSERT INTO ResidentReservation
VALUES (2023013, 3);