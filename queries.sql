--Query 1: find the names of all the actors in the movie 'Die Another Day'.
SELECT first, last
FROM Actor
WHERE id IN (SELECT aid
			FROM MovieActor
			WHERE mid = (SELECT id
						 FROM Movie
						 WHERE title = "Die Another Day"));

--Query 2: find the count of all the actors who acted in multiple movies
SELECT aid, COUNT(mid)
FROM MovieActor
GROUP BY aid
HAVING COUNT(mid) >= 2;

--Query 3: find the names of all the directors who directed multiple movies
SELECT first, last
FROM Director
WHERE id IN (SELECT did
			FROM MovieDirector
			GROUP BY did
			HAVING COUNT(mid) >= 2);