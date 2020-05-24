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
	VALUES('Gary', 'Paulsen');
;

INSERT INTO series (series_name, author_id)
	VALUES ('Brian''s Saga', '1');

INSERT INTO book (title, lexile, genre, series_id, author_id)
 	VALUES ('Hatchet', '1020', 'Fiction', '1', '1');


INSERT INTO author (first_name, middle_name, last_name)
	VALUES 
	('J', 'K', 'Rowling'),
	('C', 'S', 'Lewis'),
	('Beverly', '', 'Cleary'),
	('Lewis', '', 'Sachar')
;

INSERT INTO series (series_name, author_id)
	VALUES 
	('Harry Potter', '2'),
	('Chronicles of Narnia', '3'),
	('Ramona Quimby', '4'),
	('Ralph S. Mouse', '4')
;

INSERT INTO book (title, lexile, genre, series_id, author_id)
 	VALUES 
	('Harry Potter and the Sorcerer''s Stone', '880', 'Fantasy', '2', '2'),
	('Harry Potter and the Chamber of Secrets', '940', 'Fantasy', '2', '2'),
	('Harry Potter and the Prisoner of Azkaban', '880', 'Fantasy', '2', '2'),
	('Harry Potter and the Goblet of Fire', '880', 'Fantasy', '2', '2'),
	('Harry Potter and the Order of the Phoenix', '950', 'Fantasy', '2', '2'),
	('Harry Potter and the Half-Blood Prince', '1030', 'Fantasy', '2', '2'),
	('Harry Potter and the Deathly Hallows', '980', 'Fantasy', '2', '2'),
	('The Magician''s Newphew', '790', 'Fantasy', '3', '3'),
	('The Lion, The Witch and the Wardrobe', '940', 'Fantasy', '3', '3'),
	('The Horse and His Boy', '970', 'Fantasy', '3', '3'),
	('Prince Caspian: The Return to Narnia', '870', 'Fantasy', '3', '3'),
	('The Voyage of the Dawn Treader', '970', 'Fantasy', '3', '3'),
	('The Silver Chair', '840', 'Fantasy', '3', '3'),
	('The Last Battle', '890', 'Fantasy', '3', '3'),
	('Beezus and Ramona', '780', 'Realistic Fiction', '4', '4'),
	('Ramona the Pest', '850', 'Realistic Fiction', '4', '4'),
	('Ramona the Brave', '820', 'Realistic Fiction', '4', '4'),
	('Ramona and Her Father', '840', 'Realistic Fiction', '4', '4'),
	('Ramona and Her Mother', '860', 'Realistic Fiction', '4', '4'),
	('Ramona Quimby, Age 8', '860', 'Realistic Fiction', '4', '4'),
	('The Mouse and the Motorcycle', '860', 'Fantasy', '5', '4'),
	('Runaway Ralph', '890', 'Fantasy', '5', '4'),
	('Ralph S. Mouse', '860', 'Fantasy', '5', '4')	
;

INSERT INTO book (title, lexile, genre, author_id)
 	VALUES 
('Holes', '660', 'Realistic Fiction', '5');