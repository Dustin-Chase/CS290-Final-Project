<?php
include('config.php');
ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start(); 
if (isset($_POST['submit'])) {
	$userName = $_POST['username'];
	$getComics = "SELECT * FROM usersComics WHERE username=?";
	$insertBook = "INSERT INTO usersComics (username, password) VALUES (?, ?)"; 
	$comicArray = array();
	
		$checkExist = $mysqli->prepare($getComics); 
		if(!$checkExist){
			echo "Error: " . $mysqli->error; 
		}
		if(!($checkExist->bind_param("s", $userName))){
			echo "Error: " . $checkExist->error; 
		}
			
		if(!$checkExist->execute()) {
			echo "Execute failed: (" . $checkExist->errno . ") " . $checkExist->error;
		}
		
		if (!$checkExist->bind_result($id, $user, $issuenum, $title, $date, $coverURL, $publisher, $era, $notes)) {
			echo "Binding result failed: (" . $checkExist->errno . ") " . $checkExist->error;
		}
		
		while($checkExist->fetch()){
			$tempArr = array();  
			array_push($tempArr, $id, $user, $issuenum, $title, $date, $coverURL, $publisher, $era, $notes);
			array_push($comicArray, $tempArr);
		}
		$myData = json_encode($comicArray); 
		echo $myData; 
		$checkExist->close(); 
		$mysqli->close();
	}
else {
	echo "Submit variable is not set."; 
	#header("Location: http://web.engr.oregonstate.edu/~chased/comics_database/register.html");
}
 
?>