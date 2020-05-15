CREATE TABLE public.lexile
(
	id SMALLINT NOT NULL PRIMARY KEY

);

CREATE TABLE public.genre
(
	id SERIAL NOT NULL PRIMARY KEY,
	genre_name VARCHAR(100) NOT NULL UNIQUE

);

CREATE TABLE public.author
(
	id SERIAL NOT NULL PRIMARY KEY,
	first_name VARCHAR(100),
	middle_name VARCHAR(100),
	last_name VARCHAR(100) NOT NULL 

);

CREATE TABLE public.series
(
	id SERIAL NOT NULL PRIMARY KEY,
	series_name VARCHAR(100),
	author_id INT NOT NULL REFERENCES public.author(id),
	genre_id INT NOT NULL REFERENCES public.genre(id)

);

CREATE TABLE public.book
(
	id SERIAL NOT NULL PRIMARY KEY,
	title VARCHAR(100) NOT NULL,
	series_id INT REFERENCES public.series(id),
	author_id INT NOT NULL REFERENCES public.author(id),
	genre_id INT NOT NULL REFERENCES public.genre(id),
	lexile_id INT NOT NULL REFERENCES public.lexile(id)
);
