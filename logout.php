<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start(); 
if(isset($_SESSION['username'])) {
	$_SESSION = array(); 
	session_destroy();
	$filepath = explode('/', $_SERVER['PHP_SELF'], -1);
	$filepath = implode('/', $filepath);
	$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filepath;
	header("Location: {$redirect}/login.php", true);
	die(); 
}

else {
	header("Location: http://web.engr.oregonstate.edu/~chased/comics_database/login.html");
}
?>