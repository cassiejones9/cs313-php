Drop TABLE if exists note_user;
DROP TABLE if exists note;

CREATE TABLE note_user (
    id SERIAL,
    username varchar(255),
    password varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE note (
id SERIAL,
userId INT NOT NULL,
content TEXT,
PRIMARY KEY (id),
FOREIGN KEY (userId) REFERENCES note_user (id)
);

INSERT INTO note_user (username, passord)
VALUES ('John', 'pass');

INSERT INTO note_user (username, passord)
VALUES ('Jane', 'byui');

INSERT INTO note (userId, content)
VALUES (1, 'A note for John');

INSERT INTO note (userId, content)
VALUES (1, 'Another note for John');

INSERT INTO note (userId, content)
VALUES (2, 'And this is a note for Jane');

SELECT * FROM note_user;

SELECT username FROM note_user;

SELECT password, username FROM note_user;

SELECT * FROM note_user WHERE username = 'John';

SELECT * FROM note_user WHERE id > 1;
SELECT * FROM note_user ORDER BY username;
SELECT * FROM note_user ORDER BY username DESC;

SELECT * FROM note WHERE userId = 1;

SELECT * FROM note_user AS u 
JOIN note AS n 
ON u.id = n.userId;

SELECT * FROM note_user AS u 
JOIN note AS n 
ON u.id = n.userId
WHERE u.username = 'John';

SELECT n.content FROM note_user AS u 
JOIN note AS n 
ON u.id = n.userId
WHERE u.username = 'John';

