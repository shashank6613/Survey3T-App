<?php

$userId = $_GET['id'];
$userName = $_GET['name'];
$userAge = $_GET['age'];
$userNationality = $_GET['nationality'];
$userMobile = $_GET['mobile'];
$userLanguage = $_GET['language'];
$userPin = $_GET['pin'];


$servername = 'dbs.clushmnnhufs.us-west-2.rds.amazonaws.com';
$username = 'admin';
$password = 'admon1234';
$database = 'survey';


$link = mysqli_connect($servername, $username, $password, $database);


if (mysqli_connect_errno()) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if (mysqli_ping($link)) {
	echo "Connection is ok!\n";
} else {
	die("Error: " . mysqli_error($link));
}


$tableCreationQuery = "CREATE TABLE IF NOT EXISTS user_data (
	    id INT AUTO_INCREMENT PRIMARY KEY,
	    name VARCHAR(100),
	    age INT,
	    nationality VARCHAR(50),
            mobile VARCHAR(15),
	    language VARCHAR(50),
	    pin VARCHAR(10)
)";

if (!mysqli_query($link, $tableCreationQuery)) {
	    die("Error creating table: " . mysqli_error($link));
}

$stmt = mysqli_prepare($link, "INSERT INTO user_data (name, age, nationality, mobile, language, pin) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'sissss', $userName, $userAge, $userNationality, $userMobile, $userLanguage, $userPin);


if (mysqli_stmt_execute($stmt)) {
     echo "Entered data successfully\n";
} else {
     die("Error inserting data: " . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);
mysqli_close($link);

?>
