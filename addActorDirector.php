
<html>
	<html>
	<head>
		<title>add actor / director</title>
		<style type="text/css">
		@import url(cs143style.css);
		</style>
	</head>	
	<body>
				Add new actor/director: <br/>
		<form action="./addActorDirector.php" method="GET">
			Identity:	<input type="radio" name="identity" value="Actor" checked="true">Actor
						<input type="radio" name="identity" value="Director">Director<br/>
			<hr/>
			First Name:	<input type="text" name="first" maxlength="20"><br/>
			Last Name:	<input type="text" name="last" maxlength="20"><br/>
			Sex:		<input type="radio" name="sex" value="Male" checked="true">Male
						<input type="radio" name="sex" value="Female">Female<br/>
						
			Date of Birth:	<input type="text" name="dob"><br/>
			Date of Die:	<input type="text" name="dod"> (leave blank if alive now)<br/>
			<input type="submit" value="add it!!"/>
		</form>
		<hr/>
		
		<?php
			function getField($fieldName) {
				$result = $_GET[$fieldName];
				if($result == '')
					$result = '\N';
				else if($fieldName != 'identity')
					$result = '"'.$result.'"';

				return $result;
			}
			$identity = getField('identity');
			$sex = getField('sex');
			$first = getField('first');
			$last = getField('last');
			$dob = getField('dob');
			$dod = getField('dod');
			if($identity == '\N')
				return;
			//Establish connection with database cs143
			$db_connection = mysql_connect("localhost", "cs143", "");
			mysql_select_db("TEST", $db_connection);//change to CS143 later

			$updateMaxPersonID = 'UPDATE MaxPersonID SET id = id + 1;';
			$result = mysql_query($updateMaxPersonID, $db_connection);

			$getMaxPersonID = 'SELECT id FROM MaxPersonID;';
			$result = mysql_query($getMaxPersonID, $db_connection);

			$row = mysql_fetch_row($result);

			$maxPersonID = $row[0];
			$query = 'INSERT INTO '.$identity.' VALUES('.$maxPersonID.','.$last.','.$first.','.$sex.','.$dob.','.$dod.');';
			$result = mysql_query($query, $db_connection);
			if($result == TRUE)
				echo "<font color='Red'><b>Add Success!!</b></font><br/>";
			else
				die(mysql_error()); 
		?>
	</body>
</html>
