--This update modification set movie id which is less than 10 the same, violating the uniqueness of movie id
UPDATE Movie
SET id = 100
WHERE id < 10;

--This insert modification set the movie id to be negative and no title, which violates the check constrain 
INSERT INTO Movie
VALUE (-2,"",1879,"R","Beauty");

--This update modification set actor id which is less than 20 the same, violating the uniqueness of actor id
UPDATE Actor
SET id = 6
WHERE id < 20;

--This insert modification set the actor id to be negative and dob to be NULL, which violates the check constrain 
INSERT INTO Actor
VALUE (-9,"Bob","Mary","Female",\N,\N);

--This update modification set director id which is less than or equal to 100 the same, violating the uniqueness of director id
UPDATE Director
SET id = 100
WHERE id <= 100;

--This insert modification set the director id to be negative and dob to be NULL, which violates the check constrain 
INSERT INTO Director
VALUE (-67,"Bob","Sugar",\N,\N);

--This modification update a movie id in MovieGenre table, but the new id doesn't show up in referenced table (Movie table), which violates referential integrity
UPDATE MovieGenre
SET mid=10000
WHERE mid=200;

--This modification insert a movie id and a director id to MovieDirector table which doesn't show up in referenced tables (Movie table and Director table), which violates referential integrity
INSERT INTO MovieDirector
VALUE (9999,999);

--This modification insert a movie id and an actor id to MovieActor table which doesn't show up in referenced tables (Movie table and Actor table), which violates referential integrity
INSERT INTO MovieActor
VALUE (1,9999,"Captain");

--This modification insert a movie id to Review table which doesn't show up in referenced tables (Movie table), which violates referential integrity
INSERT INTO Review
VALUE ("Bob",'1000-01-01 00:00:00',10001,10,"Captain");