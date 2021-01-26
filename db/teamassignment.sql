Drop TABLE if exists Notes;

CREATE TABLE Notes (
    NotesID INT NOT NULL IDENTITY PRIMARY KEY,
    PersonID INT NOT NULL,
    SpeakerID INT NOT NULL,
    ConferenceID INT NOT NULL,
    Note VARCHAR(255) NOT NULL

);

INSERT INTO Notes(NotesID, PersonID, SpeakerID, ConferenceID, Note)
VALUES ()