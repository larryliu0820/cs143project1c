
<html>
	<html>
	<head>
		<title>add review</title>
		<style type="text/css">
		@import url(cs143style.css);
		</style>
	</head>	
	<body>
				Add your comments: <br/>
		<form action="./addReview.php" method="GET">
			
			Name:	<input type="text" name="name" maxlength="20"><br/>
			
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
			MPAA Rating : <select name="mpaarating">
					<option value="G">G</option>
					<option value="NC-17">NC-17</option>
					<option value="PG">PG</option>
					<option value="PG-13">PG-13</option>
					<option value="R">R</option>
					<option value="surrendere">surrendere</option>
					</select>
			<br/>
			<p>Your comment:	<br/>
			<textarea name="comment" cols="60" rows="8" maxlength="500"></textarea></p>
			<br/>
			
			<input type="submit" value="add it!!"/>
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
			$name = getField('name');
			$comment = getField('comment');
			$mid = getField('mid');
			$rate = getField('mpaarating');

			
			if($name == '\N')
				return;			
			else {
				
				//Get current time from database
				$getTime = "SELECT NOW();";
				$result = mysql_query($getTime, $db_connection);
				$row = mysql_fetch_row($result);
				$mysqldate = $row[0];
				
				// query to insert review
				$insertReview = 'INSERT INTO Review VALUES ('.$name.', "'.$mysqldate.'", '.$mid.', '.$rate.', '.$comment.')';
				
				$result = mysql_query($insertReview, $db_connection);
				
				if($result == TRUE)
					echo "<b>Add Success!!Thank you ".$name."!</b>";
				else
					die(mysql_error()); 
				// close database	
				mysql_close($db_connection);
			}
		?>
	</body>
</html>
