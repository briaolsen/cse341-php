DROP TABLE IF EXISTS book;
DROP TABLE IF EXISTS series;
DROP TABLE IF EXISTS author;


CREATE TABLE author
(
	id SERIAL NOT NULL PRIMARY KEY,
	first_name VARCHAR(32),
	middle_name VARCHAR(32),
	last_name VARCHAR(32) NOT NULL 

);

CREATE TABLE series
(
	id SERIAL NOT NULL PRIMARY KEY,
	series_name VARCHAR(100),
	author_id INT NOT NULL REFERENCES public.author(id)

);

CREATE TABLE book
(
	id SERIAL NOT NULL PRIMARY KEY,
	title VARCHAR(100) NOT NULL,
	lexile SMALLINT NOT NULL,
	genre VARCHAR(32) NOT NULL,
	series_id INT REFERENCES public.series(id),
	author_id INT NOT NULL REFERENCES public.author(id)
);

INSERT INTO author (first_name, last_name)
	VALUES ('Gary', 'Paulsen');

INSERT INTO series (series_name, author_id)
	VALUES ('Brian''s Saga', '1');

INSERT INTO book (title, lexile, genre, series_id, author_id)
 	VALUES ('Hatchet', '1020', 'Fiction', '1', '1');