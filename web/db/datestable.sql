Drop TABLE dates;

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
VALUES ('Jan 2 am'),
('Jan 2 pm'),
('Jan 9 am'),
('Jan 9 pm'),
('Jan 16 am'),
('Jan 16 pm'),
('Jan 23 am'),
('Jan 23 pm'),
('Jan 30 am'),
('Jan 30 pm');

