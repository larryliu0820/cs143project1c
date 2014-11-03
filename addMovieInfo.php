
<html>
	<html>
	<head>
		<title>add new movie</title>
		<style type="text/css">
		@import url(cs143style.css);
		</style>
	</head>	
	<body>
				Add new movie: <br/>
		<form action="./addMovieInfo.php" method="GET">			
			Title : <input type="text" name="title" maxlength="20"><br/>
			Compnay: <input type="text" name="company" maxlength="50"><br/>
			Year : <input type="text" name="year" maxlength="4"><br/>	<!-- Todo: validation-->	
			MPAA Rating : <select name="mpaarating">
					<option value="G">G</option>
					<option value="NC-17">NC-17</option>
					<option value="PG">PG</option>
					<option value="PG-13">PG-13</option>
					<option value="R">R</option>
					<option value="surrendere">surrendere</option>
					</select>
			<br/>
			Genre : 
			<input type="checkbox" name="genre[]" value="Action">Action</input>
			<input type="checkbox" name="genre[]" value="Adult">Adult</input>
			<input type="checkbox" name="genre[]" value="Adventure">Adventure</input>
			<input type="checkbox" name="genre[]" value="Animation">Animation</input>
			<input type="checkbox" name="genre[]" value="Comedy">Comedy</input>
			<input type="checkbox" name="genre[]" value="Crime">Crime</input>
			<input type="checkbox" name="genre[]" value="Documentary">Documentary</input>
			<input type="checkbox" name="genre[]" value="Drama">Drama</input>
			<input type="checkbox" name="genre[]" value="Family">Family</input>
			<input type="checkbox" name="genre[]" value="Fantasy">Fantasy</input>
			<input type="checkbox" name="genre[]" value="Horror">Horror</input>
			<input type="checkbox" name="genre[]" value="Musical">Musical</input>
			<input type="checkbox" name="genre[]" value="Mystery">Mystery</input>
			<input type="checkbox" name="genre[]" value="Romance">Romance</input>
			<input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi</input>
			<input type="checkbox" name="genre[]" value="Short">Short</input>
			<input type="checkbox" name="genre[]" value="Thriller">Thriller</input>
			<input type="checkbox" name="genre[]" value="War">War</input>
			<input type="checkbox" name="genre[]" value="Western">Western</input>
					
			<br/>
			
			<input type="submit" value="Add it!!"/>
					</form>
		<hr/>
		<?php
			function getField($fieldName) {
				$result = $_GET[$fieldName];
				if($fieldName == 'genre') {
					return $result;
				}
				if($result == '') {
					if($fieldName == 'year')
						return 0;
					$result = '\N';
				} else
					$result = '"'.$result.'"';

				return $result;
			}
			function insertMovieGenre($mid, $genre, $db_connection) {
				$genre = '"'.$genre.'"';
				$updateGenreQuery = 'INSERT INTO MovieGenre VALUES('.$mid.','.$genre.')';
				// echo $updateGenreQuery.'<br/>';
				$result = mysql_query($updateGenreQuery, $db_connection);
				if($result == FALSE)
					die(mysql_error());
			}

			$title = getField('title');
			$company = getField('company');
			$year = getField('year');
			$mpaarating = getField('mpaarating');
			$genre = getField('genre');

			if($title == '\N')
				return;
			//Establish connection with database cs143
			$db_connection = mysql_connect("localhost", "cs143", "");
			mysql_select_db("TEST", $db_connection);//change to CS143 later

			//Update MaxMovieID
			$updateMaxMovieID = 'UPDATE MaxMovieID SET id = id + 1;';
			$result = mysql_query($updateMaxMovieID, $db_connection);

			$getMaxMovieID = 'SELECT id FROM MaxMovieID;';
			$result = mysql_query($getMaxMovieID, $db_connection);

			$row = mysql_fetch_row($result);

			$maxMovieID = $row[0];
			
			//Add this new movie
			$query = 'INSERT INTO Movie VALUES('.$maxMovieID.','.$title.','.$year.','.$mpaarating.','.$company.');';
			$result = mysql_query($query, $db_connection);
			if($result == TRUE) {
				echo "<font color='Red'><b>Add Success!!</b></font><br/>";
				echo "<a href=\"./addMovieActor.php?title=".$_GET['title']."&mid=".$maxMovieID."\" target=\"main\">Add Actor/Role Relation</a>";
			}else
				die(mysql_error()); 
			//Update MovieGenre table
			if(count($genre) != 0) {
				foreach($genre as &$singleGenre) {
					insertMovieGenre($maxMovieID, $singleGenre, $db_connection);
				}
			}
		?>
	</body>
</html>
