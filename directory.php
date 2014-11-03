
<html>
	<html>
<head>
<title>Navigation</title>
</head>	
	<body bgcolor="#FFFFFF">
    Add New Content :
<ul>
    	<li><a href="./addActorDirector.php" target="main">Add Actor/Director</a></li>
	    <li><a href="./addMovieInfo.php" target="main">Add Movie Information</a></li>
        <li><a href="./addMovieActor.php" target="main">Add Movie / Actor Relation</a></li>
        <li><a href="./addMovieDirector.php" target="main">Add Movie / Director Relation</a></li>
         <li><a href="./addReview.php" target="main">Add Movie Comments</a></li>
    </ul>
	Browsering Content :
	<ul>
        <?php
          //Establish connection with database cs143
          $db_connection = mysql_connect("localhost", "cs143", "");
          mysql_select_db("TEST", $db_connection);//change to CS143 later

          //Get an actor
          $actorQuery = 'SELECT id,first,last FROM Actor LIMIT 1;';
          $result = mysql_query($actorQuery, $db_connection);
          $row = mysql_fetch_row($result);

          echo '<li><a href="./showActorInfo.php?aid='.$row[0].'" target="main">Show Actor Information</a></li>';

          //Get a movie
          $movieQuery = 'SELECT id,title FROM Movie LIMIT 1;';
          $result = mysql_query($movieQuery,$db_connection);
          $row = mysql_fetch_row($result);

          echo '<li><a href="./showMovieInfo.php?mid='.$row[0].'" target="main">Show Movie Information</a></li>'
        ?>

      	    
    </ul>
    Search Interface :
	<ul>
    	<li><a href="./search.php" target="main">Search Actor/Movie</a></li>
    </ul>
    <br/>    <br/>    <br/>
<!--
    <div align="center">Demo page of project 1C<br/> 
-->

<br/>
	</div>
    Declariation:
    <ul>
      <li>This is just a simple demo site created by Chu-Cheng long long time ago.</li>
      <li>This demo site may not "fully satisfy" 
      all the requirments assigned in the spec. The only purpose of this site is to give
      you a sense. Whenever there is a conflict, the official project spec always prevails.</li>
      <li>Copycat is strongly discouraged. Feel free to beat this demo site.</li>
    </ul>
 
</body>
</html>
