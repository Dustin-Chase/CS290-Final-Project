<?php 

/*Database connection */
$mysqli = new mysqli('oniddb.cws.oregonstate.edu'
, 'chased-db', 'XHNdcPTqIvxhcM4f', 'chased-db');

if(!mysqli || $mysqli->connect_errno) {
	//connect_errno holds most recent error number connect_error holds most recent
	//error string. Echo these out if an error occurs for debugging. 
	echo "Connection error " . $mysqli->connect_errno . "" . $mysqli->connect_error; 
}
?>