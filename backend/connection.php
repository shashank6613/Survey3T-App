<?php
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$dbname = 'survey';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
}
?>
