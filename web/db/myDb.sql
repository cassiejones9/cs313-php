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


-- CREATE TABLE client (
--     clientId SERIAL PRIMARY KEY,
--     lastName varchar(255)  NOT NULL,
--     firstName varchar(255)  NOT NULL,
--     phone varchar(255)  NOT NULL,
--     email varchar(255)  NOT NULL
-- );

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

CREATE TABLE session (
    sessionId SERIAL PRIMARY KEY,
    clientId int NOT NULL,
    sessionDate varchar(25) NOT NULL,
    numOfPeople smallint NOT NULL,
    constraint fk_client FOREIGN KEY(clientId) REFERENCES client (clientId)
);

INSERT INTO session (clientId, sessionDate, numOfPeople)
VALUES (1, 'jan2pm', 3);

INSERT INTO session (clientId, sessionDate, numOfPeople)
VALUES (2, 'jan9am', 8);

INSERT INTO session (clientId, sessionDate, numOfPeople)
VALUES (3, 'jan30pm', 1);

SELECT c.lastName, c.firstName, c.email, s.clientId, s.sessionDate, s.numOfPeople
FROM client c JOIN session s ON s.clientId=c.clientId;

