<html>
	<html>
	<head>
		<title>Establish relationship between a director and a movie</title>
		<style type="text/css">
		@import url(cs143style.css);
		</style>
	</head>	
	<body>
				Establish relationship between a director and a movie: <br/>
		<form action="./addMovieDirector.php" method="GET">
			Movie : <select name="mid">
				<?php
					//Establish connection with database cs143
					$db_connection = mysql_connect("localhost", "cs143", "");
					mysql_select_db("TEST", $db_connection);//change to CS143 later

					$movieQuery = "SELECT id, title, year FROM Movie";
					$result = mysql_query($movieQuery, $db_connection);

					while($row = mysql_fetch_row($result)) {
						echo '<option value="'.$row[0].'">'.$row[1].'('.$row[2].')</option>';
					}
				?>
					</select>
			<br/>		
			Director : <select name="did">
				<?php
					$directorQuery = "SELECT id, first, last, dob FROM Director";
					$result = mysql_query($directorQuery, $db_connection);

					while($row = mysql_fetch_row($result)) {
						echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'('.$row[3].')</option>';
					}
				?>
					</select>
			<br/>
			<input type="submit" value="Set a relation!"/>
			</form>
		<hr/>

		<?php
			function getField($fieldName) {
				$result = $_GET[$fieldName];
				if($result == '')
					$result = '\N';
				else
					$result = '"'.$result.'"';
		
				return $result;
			}

			$mid = getField('mid');
			$did = getField('did');
			if($mid == '\N' || $did == '\N')
				return;
			
			//Add this new relation into MovieDirector table
			$query = 'INSERT INTO MovieDirector VALUES('.$mid.','.$did.');';
			echo $query;
			echo "<br/>";
			$result = mysql_query($query, $db_connection);
			if($result == TRUE) {
				echo "<font color='Red'><b>Add Success!!</b></font><br/>";
			}else
				die(mysql_error()); 
			mysql_close($db_connection);
			
		?>
				
	</body>
</html>