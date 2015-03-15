<?php
include('config.php');
ini_set('display_errors', '1');
error_reporting(E_ALL);
$valid = true;
session_start(); 
if (isset($_POST['submit'])) {
	$userName = $_POST['username'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$checkLogIn = "SELECT * FROM usersTable WHERE username=?";
	$insertUser = "INSERT INTO usersTable (username, password) VALUES (?, ?)"; 
	if($password1 != $password2) {
		echo "Passwords do not match. <br>"; 
		$valid = false;  
	}
	else {
		$checkExist = $mysqli->prepare($checkLogIn); 
		if(!$checkExist){
			echo "Error: " . $mysqli->error; 
		}
		if(!($checkExist->bind_param("s", $userName))){
			echo "Error: " . $checkExist->error; 
		}
			
		$checkExist->execute();
		$checkExist->bind_result($ID, $name, $word);		
	
		while($checkExist->fetch()) {
			if ($name == $userName) {
				$valid = false;  
				echo "User already exists. Please choose a different user name.";
				
			}
		}
		$checkExist->close(); 
		if($valid) {
			$insert = $mysqli->prepare($insertUser);
			if (!$insert) {
				echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
			}

			if (!($insert->bind_param("ss", $userName, $password1))) {
				echo "Binding parameters failed: (" . $insert->errno . ") " . $insert->error;
			}
			
			if (!$insert->execute()) {
				echo "Execute failed: (" . $insert->errno . ") " . $insert->error;
			}			
			$insert->close(); 
			echo "You have successfully registered. Please login to view your books."; 
		}
		
		
	}
	
$mysqli->close(); 	
}
else {
	echo "Submit variable is not set."; 
	#header("Location: http://web.engr.oregonstate.edu/~chased/comics_database/register.html");
}
?>