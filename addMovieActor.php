
<html>
	<html>
	<head>
		<title>add actor's role in a movie</title>
		<style type="text/css">
		@import url(cs143style.css);
		</style>
	</head>	
	<body>
				Add new actor in a movie: <br/>
		<form action="./addMovieActor.php" method="GET">
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
			Actor : <select name="aid">
				<?php
					$actorQuery = "SELECT id, first, last, dob FROM Actor";
					$result = mysql_query($actorQuery, $db_connection);

					while($row = mysql_fetch_row($result)) {
						echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'('.$row[3].')</option>';
					}
				?>
					</select>
			<br/>	
			Role: <input type="text" name="role" maxlength="50">
			<br/>
			
			<input type="submit" value="Add it!!"/>
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
			$aid = getField('aid');
			$role = getField('role');
			if($mid == '\N' || $aid == '\N')
				return;
			
			//Add this new movie
			$query = 'INSERT INTO MovieActor VALUES('.$mid.','.$aid.','.$role.');';
			echo $query;
			$result = mysql_query($query, $db_connection);
			if($result == TRUE) {
				echo "<font color='Red'><b>Add Success!!</b></font><br/>";
			}else
				die(mysql_error()); 
			
		?>
				
	</body>
</html>
