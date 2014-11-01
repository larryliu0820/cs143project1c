--Every movie has a unique identification number.
--Every movie must have a title.
CREATE TABLE Movie(
	id INT NOT NULL,
	title VARCHAR(100) NOT NULL,
	year INT NOT NULL,
	rating VARCHAR(10),
	company VARCHAR(50),
	PRIMARY KEY (id), 
	UNIQUE(title,year),
	CHECK (id>0 AND year>0 AND title != "")) ENGINE=InnoDB;

--Every actor has a unique identification number.
--Every actor must have a date of birth.
CREATE TABLE Actor(
	id INT NOT NULL,
	last VARCHAR(20) NOT NULL,
	first VARCHAR(20) NOT NULL, 
	sex VARCHAR(6),
	dob DATE NOT NULL,
	dod DATE,
	PRIMARY KEY (id),
	UNIQUE(first,last,dob),
	CHECK (id>0 AND dob != \N)) ENGINE=InnoDB;

--Every director has a unique identification number.
--Every director must have a date of birth.
CREATE TABLE Director(
	id INT NOT NULL,
	last VARCHAR(20) NOT NULL,
	first VARCHAR(20) NOT NULL,
	dob DATE NOT NULL,
	dod DATE,
	PRIMARY KEY (id),
	UNIQUE(first,last,dob),
	CHECK (id>0 AND dob != \N)) ENGINE=InnoDB;

--All mid must be associated with a movie id that is already in the Movie table.
CREATE TABLE MovieGenre(
	mid INT,
	gnere VARCHAR(20),
	FOREIGN KEY (mid) references Movie(id)) ENGINE=InnoDB;

--All mid must be associated with a movie id that is already in the Movie table.
--All did must be associated with a director id that is already in the Director table.
CREATE TABLE MovieDirector(
	mid INT references Movie(id),
	did INT,
	FOREIGN KEY (did) references Director(id)) ENGINE=InnoDB;

--All mid must be associated with a movie id that is already in the Movie table.
--All aid must be associated with an actor id that is already in the Actor table.
CREATE TABLE MovieActor(
	mid INT references Movie(id),
	aid INT,
	role VARCHAR(50),
	FOREIGN KEY (aid) references Actor(id)) ENGINE=InnoDB;

--All mid must be associated with a movie id that is already in the Movie table.
CREATE TABLE Review(
	name VARCHAR(20),
	time TIMESTAMP,
	mid INT,
	rating INT,
	comment VARCHAR(500),
	FOREIGN KEY (mid) references Movie(id)) ENGINE=InnoDB;

CREATE TABLE MaxPersonID(id INT);

CREATE TABLE MaxMovieID(id INT);