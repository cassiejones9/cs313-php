Drop TABLE if exists Persons;

CREATE TABLE Persons (
    PersonID int,
    LastName varchar(255),
    FirstName varchar(255),
    Add varchar(255),
    City varchar(255)
);

INSERT INTO Persons (personid, lastname, firstname, add, city)
VALUES (1, 'Jones', 'Cassie', '1234 Main Street', 'Las Vegas');