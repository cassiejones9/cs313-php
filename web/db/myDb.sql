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

INSERT INTO client (username, pass, lastName, firstName, phone, city)
VALUES ('jonesjohn', 'password', 'Jones', 'John', '123-456-7890', 'Las Vegas');

ALTER TABLE client 
DROP COLUMN city;

ALTER TABLE client
ADD COLUMN email VARCHAR;

UPDATE client
SET email = 'johnjjones@gmail.com'
WHERE username = 'jonesjohn';

INSERT INTO client (username, pass, lastName, firstName, phone, email)
VALUES ('smithH', 'pa$$word', 'Johnson', 'Hyrum', '012-345-6789', 'North Las Vegas');

INSERT INTO client (username, pass, lastName, firstName, phone, email)
VALUES ('jdnlv9', 'passWoRd', 'Doe', 'Jane', '901-234-5678', 'North Las Vegas');

INSERT INTO client (username, pass, lastName, firstName, phone, email)
VALUES ('motherofjoseph', 'passworDDdd', 'Smith', 'Lucy', '345-678-9012', 'Las Vegas');

INSERT INTO client (username, pass, lastName, firstName, phone, email)
VALUES ('motherofjoseph', 'passworDDdd', 'Smith', 'Lucy', '345-678-9012', 'Las Vegas');

INSERT INTO client (username, pass, lastName, firstName, phone, email)
VALUES ('oliverc', 'paswrd', 'Cowdry', 'Oliver', '455-677-9002', 'oliverc@gmail.com');

CREATE TABLE session (
    sessionId SERIAL PRIMARY KEY,
    clientId int NOT NULL,
    sessionDate DATE NOT NULL,
    numOfPeople smallint NOT NULL,
    constraint fk_client FOREIGN KEY(clientId) REFERENCES client (clientId)
);

INSERT INTO session (clientId, sessionDate, numOfPeople)
VALUES (1, '2021-02-06', 3);

INSERT INTO session (clientId, sessionDate, numOfPeople)
VALUES (2, '2021-02-10', 8);

INSERT INTO session (clientId, sessionDate, numOfPeople)
VALUES (3, '2021-03-18', 1);

SELECT c.lastName, c.firstName, c.email, s.clientId, s.sessionDate, s.numOfPeople
FROM client c JOIN session s ON s.clientId=c.clientId;


