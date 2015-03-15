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
	<p id="heading"></p>
	<div id="mybooks">
	</div>
	<br>
	<form id="addForm" action="" method="POST">
		<fieldset>
			<legend>Input a New Comic Book</legend>
			Issue Number: <br>
			<input type="number" min="0" max="1000" id="issuenum">
			<br>
			Title: <br>
			<input type="text" id="title">
			<br>
			Date of Publication: <br>
			<input type="date" id="date"><br>
			Cover URL: <br>
			<input type="text" id="coverurl"><br>
			Publisher: <br>
			<input type="text" id="publisher"><br>
			Era: <br>
			<input type="text" id="era"><br>
			Notes: <br>
			<input type="text" id="notes"><br>
			<button onclick="javascript:addNewBook();return false">Add</button>
		</fieldset>
	</form>
	<p id="addError"></p>
	</body>
</html>
