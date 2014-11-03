
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
			Movie : <select name="mid">
				<?php
					//Establish connection with database cs143
					$db_connection = mysql_connect("localhost", "cs143", "");
					mysql_select_db("TEST", $db_connection);//change to CS143 later
					$mid = $_GET['mid'];
					if($mid == '') {
						$movieQuery = "SELECT title, year FROM Movie";
						$selectMovie = 'SELECT id,title FROM Movie LIMIT 1';
						$result = mysql_query($selectMovie,$db_connection);
						$row = mysql_fetch_row($result);
						$mid = $row[0];
					}
					else
						$movieQuery = "SELECT title, year FROM Movie WHERE id=".$mid;

					$result = mysql_query($movieQuery, $db_connection);

					while($row = mysql_fetch_row($result)) {
						echo '<option value="'.$mid.'" selected="selected">'.$row[0].'('.$row[1].')</option>';
					}
				?>
					</select>
			<br/>
			Your Name:	<input type="text" name="name" value="Mr. Anonymous" maxlength="20"><br/>		
			Rating : <select name="rating">
						<option value="5"> 5 - Excellent </option>
						<option value="4"> 4 - Good </option>
						<option value="3"> 3 - It's ok~ </option>
						<option value="2"> 2 - Not worth </option>
						<option value="1"> 1 - I hate it </option>
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
				return '"'.$result.'"';
			}
			$name = getField('name');
			$comment = getField('comment');
			$rate = $_GET['rating'];

			
			if($comment == '""')
				return;			
			else {
				
				//Get current time from database
				$getTime = "SELECT NOW();";
				$result = mysql_query($getTime, $db_connection);
				$row = mysql_fetch_row($result);
				$mysqldate = '"'.$row[0].'"';
				
				// query to insert review
				$insertReview = 'INSERT INTO Review VALUES ('.$name.','.$mysqldate.','.$mid.','.$rate.','.$comment.')';
				
				$result = mysql_query($insertReview, $db_connection);
				
				if($result == TRUE) {
					echo "<font color='Red'><b>Add Success!!Thank you ".$_GET['name']."!</b></font>";
					echo "<br/><a href = './showMovieInfo.php?mid=".$mid."'>See Movie Info (including others' reviews)</a><hr/>";
				}else
					die(mysql_error()); 
				// close database	
				mysql_close($db_connection);
			}
		?>
	</body>
</html>
