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
else if (isset($_POST['delete'])) {
	$bookID = $_POST['bookid'];
	$delete = "DELETE FROM usersComics WHERE id=?";
	
		$checkDelete = $mysqli->prepare($delete); 
		if(!$checkDelete){
			echo "Error: " . $mysqli->error; 
		}
		if(!($checkDelete->bind_param("s", $bookID))){
			echo "Error: " . $checkDelete->error; 
		}
			
		if(!$checkDelete->execute()) {
			echo "Execute failed: (" . $checkDelete->errno . ") " . $checkDelete->error;
		}
		
		$checkDelete->close(); 
		$mysqli->close();
	}
else if (isset($_POST['add'])) {
	$username = $_POST['username']; 
	$issuenum = $_POST['issuenum'];
	$title= $_POST['title'];
	$date = $_POST['dateofpub'];
	$coverURL = $_POST['coverURL'];
	$publisher = $_POST['publisher'];
	$era = $_POST['era'];
	$notes = $_POST['notes'];
	$insertBook = "INSERT INTO usersComics (username, issuenum, title, date, coverURL, publisher, era, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; 
	
		$insert = $mysqli->prepare($insertBook); 
		if(!$insert){
			echo "Error: " . $mysqli->error; 
		}
		if(!($insert->bind_param("ssssssss", $username, $issuenum, $title, $date, $coverURL, $publisher, $era, $notes))){
			echo "Error: " . $insert->error; 
		}
			
		if(!$insert->execute()) {
			echo "Execute failed: (" . $insert->errno . ") " . $checkExist->error;
		}
	
		$insert->close(); 
		$mysqli->close();
}
	
else {
	echo "Submit variable is not set."; 
	#header("Location: http://web.engr.oregonstate.edu/~chased/comics_database/register.html");
}
 
?>