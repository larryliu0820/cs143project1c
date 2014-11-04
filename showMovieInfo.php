<html>
	<html>
	<head>
		<title>Movie Information</title>
		<style type="text/css">
		@import url(cs143style.css);
		</style>
	</head>	
	<body>
				
		-- Show Movie Info -- <br/>
		<?php
			$mid = $_GET['mid'];
			if($mid == '')
				return;
			//Establish connection with database cs143
			$db_connection = mysql_connect("localhost", "cs143", "");
			mysql_select_db("TEST", $db_connection);//change to CS143 later

			//Get the movie info
			$movieQuery = 'SELECT title,year,company,rating FROM Movie WHERE id='.$mid.';';
			$result = mysql_query($movieQuery, $db_connection);
			$row = mysql_fetch_row($result);

			$fieldArray = array('Title','Producer','MPAA Rating');

			$title = $row[0].'('.$row[1].')';
			echo $fieldArray[0].': '.$title.'<br/>';
			for($i = 1; $i < 3; $i++) {
				if($row[$i+1] == '')
					$row[$i+1] = 'N/A';
				echo $fieldArray[$i].': '.$row[$i+1].'<br/>';
			}
			//Get the director info of the movie
			$directorQuery = 'SELECT did FROM MovieDirector WHERE mid='.$mid.';';
			$result = mysql_query($directorQuery, $db_connection);
			echo "Director: <font color='Green'>";
			while($row = mysql_fetch_row($result)) {
				//echo $row[0].'<br/>';
				$directorNameQuery = 'SELECT first,last,dob FROM Director WHERE id ='.$row[0].';';
				//echo $directorNameQuery.'<br/>';
				$rs = mysql_query($directorNameQuery,$db_connection);
				$row = mysql_fetch_row($rs);
				echo $row[0].' '.$row[1].'('.$row[2].'),';
			}
			echo '</font><br/>';
			//Get the genre info of the movie
			$genreQuery = 'SELECT gnere FROM MovieGenre WHERE mid='.$mid.';';
			$result = mysql_query($genreQuery,$db_connection);
			echo "Genre: <font color='Brown'>";
			$genre = '';
			while($row = mysql_fetch_row($result)) {
				$genre = $genre.$row[0].',';
			}
			echo rtrim($genre, ',');
			echo '</font><br/>';
		?>
		<br/>
		-- Actor in this movie -- <br/>
		<?php
			$prefix = '<a href="./showActorInfo.php?aid=';
			//Get the actors of the movie
			$actorQuery = 'SELECT aid,role FROM MovieActor WHERE mid='.$mid.';';
			$result = mysql_query($actorQuery,$db_connection);
			while($row = mysql_fetch_row($result)) {
				$actorNameQuery = 'SELECT first,last FROM Actor WHERE id='.$row[0].';';
				$rs = mysql_query($actorNameQuery,$db_connection);
				$name = mysql_fetch_row($rs);
				$fullName = $name[0].' '.$name[1];
				echo $prefix.$row[0].'">'.$fullName.'</a> act as "'.$row[1].'"<br/>';
			}
		?>
		<br/>
		-- User Review -- <br/>
		Average Score: 
		<?php
			$ratingQuery = 'SELECT AVG(rating),COUNT(rating) FROM Review WHERE mid='.$mid.';';
			$result = mysql_query($ratingQuery,$db_connection);
			$rating = mysql_fetch_row($result);
			if($rating[1] == 0)
				echo "(Sorry, none review this movie)";
			else
				echo $rating[0]."/5 (5.0 is best) by ".$rating[1]." reviews(s).";
			echo "<a href='./addReview.php?mid=".$mid."'>  Add your review now!!</a><br/>";
		?>
		
		All Comments in Details:<br/>
		<?php
			$reviewQuery = 'SELECT name,time,rating,comment FROM Review WHERE mid='.$mid.';';
			$result = mysql_query($reviewQuery,$db_connection);
			while($row = mysql_fetch_row($result)) {
				echo "<font color='Blue'>".$row[1].",<font color='Red'>".$row[0];
				echo "</font> said: I rate this movie for <font color='Red'>".$row[2];
				echo "</font> star(s), here is my comment.</font><br/>";
				echo $row[3]."<br/><br/>";
			}
		?>
		<hr/>
		
		<!-- Search Box -->
                Search for other actors/movies <form action="./search.php" method="GET">
                        Search: <input type="text" name="keyword"></input>
                        <input type="submit" value="Search"/>
                </form>


			</body>
</html>
