
CREATE TABLE scriptures (
  id SERIAL NOT NULL PRIMARY KEY,
  book VARCHAR(50) NOT NULL,
  chapter SMALLINT NOT NULL,
  verse SMALLINT NOT NULL,
  content TEXT NOT NULL
);

INSERT INTO scriptures (book, chapter, verse, content)
VALUES ('John', 1, 5, 'And the light shineth in darkness; and the darkness comprehended it not.');

INSERT INTO scriptures (book, chapter, verse, content)
VALUES ('Doctrine and Covenants', 93, 28, 'He that keepeth his commandments receiveth truth and light, until he is glorified in truth and knoweth all things.');


INSERT INTO scriptures (book, chapter, verse, content)
VALUES ('Mosiah', 16, 9, 'He is the light and the life of the world; yea, a light that is endless, that can never be darkened; yea, and also a life which is endless, that there can be no more death.');


CREATE TABLE topic (
  id SERIAL NOT NULL PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);

INSERT INTO topic (name) 
VALUES ('Faith'), 
('Sacrifice'), 
('Charity');

CREATE TABLE linking (
id SERIAL NOT NULL PRIMARY KEY,
scripture_id INT NOT NULL,
topic_id INT NOT NULL, 
FOREIGN KEY (scripture_id) REFERENCES scriptures(id), 
FOREIGN KEY (topic_id) REFERENCES topic(id)
);