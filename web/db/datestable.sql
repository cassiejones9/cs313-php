Drop TABLE if exists dates;

-- SELECT c.lastName, c.firstName, c.email, s.clientId, s.numOfPeople, d.date
-- FROM client c 
-- JOIN session s ON s.clientId=c.clientId
-- JOIN dates d ON d.clientId=c.clientId;

CREATE TABLE dates (
    dateId SERIAL PRIMARY KEY,
    date VARCHAR(50) NOT NULL,
    clientId int,
    constraint fk_client FOREIGN KEY(clientId) REFERENCES client (clientId)
);

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
