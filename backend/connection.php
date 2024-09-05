<?php
$servername = "dbs.clushmnnhufs.us-west-2.rds.amazonaws.com"; 
$username = "admin";
$password = "admin1234";
$dbname = "survey";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
}
?>
