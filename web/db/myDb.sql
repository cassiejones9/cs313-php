Drop TABLE if exists client;
DROP TABLE if exists session;

CREATE TABLE client (
    clientId SERIAL PRIMARY KEY,
    username VARCHAR(255)  NOT NULL,
    pass VARCHAR(255)  NOT NULL,
    lastName varchar(255)  NOT NULL,
    firstName varchar(255)  NOT NULL,
    phone varchar(255)  NOT NULL,
    city varchar(255)  NOT NULL
);

CREATE TABLE admin (
    adminId SERIAL PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

SELECT clientId FROM client WHERE lastName = 'Jones' AND firstName = 'Cassie';
-- CREATE TABLE client (
--     clientId SERIAL PRIMARY KEY,
--     lastName varchar(255)  NOT NULL,
--     firstName varchar(255)  NOT NULL,
--     phone varchar(255)  NOT NULL,
--     email varchar(255)  NOT NULL
-- );

CREATE TABLE session (
    sessionId SERIAL PRIMARY KEY,
    clientId int NOT NULL,
    numOfPeople smallint NOT NULL,
    constraint fk_client FOREIGN KEY(clientId) REFERENCES client (clientId)
);

INSERT INTO session (clientId, numOfPeople)
VALUES (1, 3);

INSERT INTO session (clientId, numOfPeople)
VALUES (2, 8);

INSERT INTO session (clientId, numOfPeople)
VALUES (3, 1);

INSERT INTO session (clientId, numOfPeople)
VALUES (4, 2);

INSERT INTO session (clientId, numOfPeople)
VALUES (8, 2);

SELECT c.lastName, c.firstName, c.email, s.clientId, s.numOfPeople, d.date
FROM client c 
JOIN session s ON s.clientId=c.clientId
JOIN dates d ON d.clientId=c.clientId
WHERE c.clientid = 2;

CREATE TABLE dates (
    dateId SERIAL PRIMARY KEY,
    date VARCHAR(50) NOT NULL,
    clientId int,
    constraint fk_client FOREIGN KEY(clientId) REFERENCES client (clientId)
);


DELETE FROM client WHERE clientId = 10;


INSERT INTO dates (date)
VALUES ('Jan 2 am');

INSERT INTO dates (date)
VALUES ('Jan 2 pm');

INSERT INTO dates (date)
VALUES ('Jan 9 am');

INSERT INTO dates (date)
VALUES ('Jan 9 pm');

INSERT INTO dates (date)
VALUES ('Jan 16 am');

INSERT INTO dates (date)
VALUES ('Jan 16 pm');

INSERT INTO dates (date)
VALUES ('Jan 23 am');

INSERT INTO dates (date)
VALUES ('Jan 23 pm');

INSERT INTO dates (date)
VALUES ('Jan 30 am');

INSERT INTO dates (date)
VALUES ('Jan 30 pm');

INSERT INTO client (lastName, firstName, phone, city)
VALUES ('Jones', 'John', '123-456-7890', 'Las Vegas');

ALTER TABLE client 
DROP COLUMN city;

ALTER TABLE client
ADD COLUMN email VARCHAR;

UPDATE client
SET email = 'johnjjones@gmail.com'
WHERE username = 'jonesjohn';

INSERT INTO client (lastName, firstName, phone, email)
VALUES ('Johnson', 'Hyrum', '012-345-6789', 'North Las Vegas');

INSERT INTO client (lastName, firstName, phone, email)
VALUES ('Doe', 'Jane', '901-234-5678', 'North Las Vegas');

INSERT INTO client (lastName, firstName, phone, email)
VALUES ('Smith', 'Lucy', '345-678-9012', 'Las Vegas');

INSERT INTO client (lastName, firstName, phone, email)
VALUES ('Smith', 'Lucy', '345-678-9012', 'Las Vegas');

INSERT INTO client (lastName, firstName, phone, email)
VALUES ('Cowdrey', 'Oliver', '455-677-9002', 'oliverc@gmail.com');


UPDATE dates 
SET clientId = 1 WHERE dateId = 1;

SELECT date FROM dates WHERE clientid = 16;

