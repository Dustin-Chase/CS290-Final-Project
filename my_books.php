<?php
	session_start();
	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username']; 
	}
	
	else {
		#header("Location: http://web.engr.oregonstate.edu/~chased/comics_database/register.html");
		echo("You are not logged in!"); 
		die(); 
	}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="style.css">
			<script type="text/javascript" src="mybooks.js"></script>
		<title>My Books - My Comics Database</title>		
	</head>
	<img src="logo.png" height="150" width="500"></img>
	<div id="topMenu">
	<ul>
		  <li><a href="index.html">Home</a></li>
		  <li><a href="login.html">Login</a></li>
		  <li><a href="register.html">Register</a></li>
		  <li><a href="my_books.php">>My Books</a></li>
		   <li><a href="logout.php">Log Out</a></li>
	</ul>
	</div>
	<body>
	<p id="breadCrumb"><a href="index.html">Home</a>> My Books</p>
	<p id="user">Welcome, <?php echo $username; ?>!</p>
	<div id="mybooks">
	<p id="heading"></p>
	</div>
	</body>
</html>
