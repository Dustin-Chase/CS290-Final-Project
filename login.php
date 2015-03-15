<?php
session_start(); 
/*
* File Name: login.php
* Author: Dustin Chase
* Assignment Number: Final Project
* Due Date: 3/15/15
* Email: chased@onid.oregonstate.edu
*/
include('config.php');
ini_set('display_errors', '1');
error_reporting(E_ALL);
$error=""; #holds error message if login fails
$notFound = true; 
/*
* If the user is not logged in, re-direct to log-in page. 
* If the login form was not correctly filled out, show an error 
* and display a link back to the login page. 
* 
*/
if(!isset($_SESSION['username'])) {
	if (empty($_POST)) {
		#redirect to login page
		header("Location: http://web.engr.oregonstate.edu/~chased/comics_database/login.html");
		die();
	}
	else {
		$userName = $_POST['username']; 
		$password = $_POST['password'];
		$checkLogIn = "SELECT * FROM usersTable";
		
		if(empty($userName) || empty($password)) {
			$error = "ERROR: Please enter both a user name and password.";
			header("Location: http://web.engr.oregonstate.edu/~chased/comics_database/login.html");
			die();
		}
		else {	
			$query = $mysqli->prepare($checkLogIn);
			$query->execute();
			$query->bind_result($ID, $name, $word); 
			while($query->fetch()) {
				if ($name == $userName && $word == $password) {
					$error = "Login Successful!"; #indicates successful login
					$notFound = false; 
					$_SESSION['username'] = $name;
					#header("Location: http://web.engr.oregonstate.edu/~chased/comics_database/my_books.html");
				}
					
			}			
			
			if ($notFound) {
				$error = "ERROR: No matches found for that user name/password combination."; 
				#header("Location: http://web.engr.oregonstate.edu/~chased/comics_database/login.html"); 
			}
		
			$query->close(); 
			
		}		
		
	}
	echo $error; 
}
else {
	#header("Location: http://web.engr.oregonstate.edu/~chased/comics_database/my_books.html");
	echo "You are already logged in. "; 
}
?>
