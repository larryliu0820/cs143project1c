<html>
	<html>
	<head>
		<title>Actor Information</title>
		<style type="text/css">
		@import url(cs143style.css);
		</style>
	</head>	
	<body>
				
		-- Show Actor Info --
		<br/>
		<?php
			$aid = $_GET['aid'];
			if($aid == '')
				return;
			//Establish connection with database cs143
			$db_connection = mysql_connect("localhost", "cs143", "");
			mysql_select_db("TEST", $db_connection);//change to CS143 later

			//Get the actor info
			$actorQuery = 'SELECT first, last, sex, dob, dod FROM Actor WHERE id='.$aid.';';
			$result = mysql_query($actorQuery, $db_connection);
			$row = mysql_fetch_row($result);

			$fieldArray = array('Name','Sex','Date of Birth','Date of Death');
			
			$fullName = $row[0].' '.$row[1];
			echo $fieldArray[0].': '.$fullName.'<br/>';
			for($i = 1; $i < 4; $i ++) {
				if($row[$i+1] == '')
					$row[$i+1] = '-- Still Alive --';
				echo $fieldArray[$i].': '.$row[$i+1].'<br/>';
			} 
		?>
		<br/>-- Act in -- 
		<?php
			$roleQuery = 'SELECT mid,role FROM MovieActor WHERE aid ='.$aid.';';
			$result = mysql_query($roleQuery, $db_connection);
			while($row = mysql_fetch_row($result)) {
				$movieQuery = 'SELECT title FROM Movie WHERE id ='.$row[0].';';
				$rs = mysql_query($movieQuery, $db_connection);
				$newRow = mysql_fetch_row($rs);
				echo '<br/>Act "'.$row[1].'" in <a href = "./showMovieInfo.php?mid='.$row[0].'">'.$newRow[0].'</a>';
			}
		?>
		<br/>
		<hr/>		
				<!-- search box -->
                Search for other actors/movies <form action="./search.php" method="GET">
                        Search: <input type="text" name="keyword"></input>
                        <input type="submit" value="Search"/>
                </form>

			</body>
</html>
