/* --------------------------------------------------------------------------------------------------
    Group 5
    Members: Hoi Yi Chiu, MySQL Expert
             Pouyan Forouzandeh, MS SQL Server Expert
----------------------------------------------------------------------------------------------------*/
CREATE DATABASE G5_Recre8Master;

USE G5_Recre8Master;

CREATE TABLE Booker(
    BookerID INT,
    BookerName VARCHAR(25) NOT NULL,
    DateOfBirth DATE NOT NULL,
    PhoneNumber BIGINT NOT NULL,
    Email VARCHAR(35) NOT NULL,
    PRIMARY KEY (BookerID)
);

CREATE TABLE Resident(
    BookerID INT,
    StartDate DATE NOT NULL,
    EndDate DATE,
    PRIMARY KEY (BookerID),
    FOREIGN KEY (BookerID) REFERENCES Booker(BookerID) ON DELETE CASCADE
);

CREATE TABLE NonResident(
    BookerID INT,
    NonResidentAddress VARCHAR(50) NOT NULL,
    PRIMARY KEY (BookerID),
    FOREIGN KEY (BookerID) REFERENCES Booker(BookerID) ON DELETE CASCADE
);

CREATE TABLE Employee(
    StaffID INT,
    Title CHAR(20) NOT NULL,
    StaffName VARCHAR(35) NOT NULL,
    PRIMARY KEY (StaffID)
);

CREATE TABLE Building(
    BuildingName CHAR(15),
    BuildingAddress VARCHAR(50) NOT NULL,
    PRIMARY KEY (BuildingName)
);

CREATE TABLE BuildingFacility(
    BuildingName CHAR(15),
    FacilityName CHAR(15),
    FacilityType CHAR(20) NOT NULL,
    FacilityLocation CHAR(20) NOT NULL,
    FacilityDescription VARCHAR(200),
    PRIMARY KEY (FacilityName, BuildingName),
    FOREIGN KEY (BuildingName) REFERENCES Building(BuildingName) ON DELETE CASCADE
);

CREATE TABLE BuildingApartment(
    BuildingName CHAR(15),
    ApartmentNumber SMALLINT,
    PRIMARY KEY (ApartmentNumber,BuildingName),
    FOREIGN KEY (BuildingName) REFERENCES Building(BuildingName) ON DELETE CASCADE
);

CREATE TABLE ResidentLivesInApartment(
    ResidentBookerID INT,
    BuildingName CHAR(15),
    ApartmentNumber SMALLINT,
    PRIMARY KEY (ResidentBookerID, BuildingName, ApartmentNumber),
    FOREIGN KEY (ResidentBookerID) REFERENCES Resident(BookerID) ON DELETE CASCADE,
    FOREIGN KEY (ApartmentNumber, BuildingName) REFERENCES BuildingApartment(ApartmentNumber, BuildingName)
);

CREATE TABLE ResidentHasouseholdMember(
    ResidentBookerID INT ,
    Household_MemberID SMALLINT,
    HouseholdMemberName CHAR(35) NOT NULL,
    PRIMARY KEY (ResidentBookerID, Household_MemberID),
    FOREIGN KEY (ResidentBookerID) REFERENCES Resident(BookerID) ON DELETE CASCADE
);


CREATE TABLE Reservation(
    ReservationID INT,
    NoOfGuest SMALLINT NOT NULL,
    ShowingUp TINYINT,
    TimeInterval SMALLINT NOT NULL,
    ReservationDate DATETIME NOT NULL,
    BuildingName CHAR(15) NOT NULL,
    FacilityName CHAR(15) NOT NULL,
    StaffID INT NOT NULL,
    PRIMARY KEY (ReservationID),
    FOREIGN KEY (BuildingName) REFERENCES Building(BuildingName),
    FOREIGN KEY (FacilityName, BuildingName) REFERENCES BuildingFacility(FacilityName, BuildingName),
    FOREIGN KEY (StaffID) REFERENCES Employee(StaffID) 
);

CREATE TABLE NonResidentReservation(
    ReservationID INT,
    NonResidentBookerID INT ,
    DepositAmount INT NOT NULL,
    PRIMARY KEY (ReservationID),
    FOREIGN KEY (NonResidentBookerID) REFERENCES NonResident(BookerID) ON DELETE CASCADE,
    FOREIGN KEY (ReservationID) REFERENCES Reservation(ReservationID) ON DELETE CASCADE
);

CREATE TABLE ResidentReservation(
    ReservationID INT,
    ResidentBookerID INT,
    PRIMARY KEY (ReservationID),
    FOREIGN KEY (ResidentBookerID) REFERENCES Resident(BookerID) ON DELETE CASCADE,
    FOREIGN KEY (ReservationID) REFERENCES Reservation(ReservationID) ON DELETE CASCADE
);
