
<html>
	<html>
	<head>
		<title>Search Actor / Movie</title>
		<style type="text/css">
		@import url(cs143style.css);
		</style>
	</head>	
	<body>
		Search for actors/movies
		<form action="./search.php" method="GET">		
			Search: <input type="text" name="keyword"></input>
			<input type="submit" value="Search"/>
		</form>
		<hr/>
		<?php
			function printRow($dbName, $row, $numCol) {
				echo $dbName.': ';
				if($dbName=="Actor")
					echo "<a href=\"./show".$dbName."Info.php?aid=".$row[0]."\">";
				else
					echo "<a href=\"./show".$dbName."Info.php?mid=".$row[0]."\">";
				for($i = 1; $i < $numCol-1; $i++) {
					echo $row[$i].' ';
				}
				echo '('.$row[$numCol-1].')';
				echo "</a> <br/>";
			}
			$keyword = $_GET['keyword'];
			if(!isset($keyword))
				return;
			echo 'You are searching ['.$keyword.'] results...<br/>';
			//Establish connection with database cs143
			$db_connection = mysql_connect("localhost", "cs143", "");
			mysql_select_db("TEST", $db_connection);//change to CS143 later
			//Search in Actor database
			echo 'Searching in Actor database...<br/>';

			$actorQuery = "SELECT id, first, last, dob FROM Actor 
				WHERE first LIKE '%".$keyword."%' OR last LIKE '%".$keyword."%';";
			$result = mysql_query($actorQuery, $db_connection);

			while($row = mysql_fetch_row($result)) {
				printRow('Actor', $row, 4);
			}
			//Search in Movie database
			echo '<br/>Searching in Movie database...<br/>';

			$movieQuery = "SELECT id, title, year FROM Movie
				WHERE title LIKE '%".$keyword."%';";
			$result = mysql_query($movieQuery, $db_connection);

			while($row = mysql_fetch_row($result)) {
				printRow('Movie', $row, 3);
			}
		?>
	</body>
</html>
