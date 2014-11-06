<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Start your next web project with Pure.">
 <title>Movie, Actor and Director Database</title>

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">

<!--[if lte IE 8]>
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-old-ie-min.css">
  
<![endif]-->
<!--[if gt IE 8]><!-->
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css">
  
<!--<![endif]-->

    <!--[if lte IE 8]>
        <link rel="stylesheet" href="./pure-release-0.5.0/baby-blue.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="./pure-release-0.5.0/baby-blue.css">
    <!--<![endif]-->
  
<!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
<![endif]-->
</head>
<body>
	<div id="menu">
	    <div class="pure-menu pure-menu-open">
	        <a class="pure-menu-heading" >Add New Content:</a>

	        <ul>
	          
				<li><a href="./addActorDirector.php" target="main">Add Actor/Director</a></li>
			    <li><a href="./addMovieInfo.php" target="main">Add Movie Information</a></li>
		        <li><a href="./addMovieActor.php" target="main">Add Movie / Actor Relation</a></li>
		        <li><a href="./addMovieDirector.php" target="main">Add Movie / Director Relation</a></li>
		         <li><a href="./addReview.php" target="main">Add Movie Comments</a></li>
		       
	        </ul>
	    </div>
		
		<div class="pure-menu pure-menu-open">
	        <a class="pure-menu-heading" >Browsering Content:</a>

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
	    </div>
	    <div class="pure-menu pure-menu-open">
	        <a class="pure-menu-heading" >Search:</a>

	        <ul>
	          
				<li><a href="./search.php" target="main">Search Actor/Movie</a></li>


	        </ul>
	    </div>
	</div>
</body>
</html>