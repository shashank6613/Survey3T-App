<?php
$servername = getenv('DB_HOST'); 
$username = getenv('DB_USER');   
$password = getenv('DB_PASSWORD'); 
$dbname = 'survey';             


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$tableCreationSql = "CREATE TABLE IF NOT EXISTS user_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    mobile VARCHAR(20) NOT NULL,
    nationality VARCHAR(100) NOT NULL,
    language VARCHAR(50) NOT NULL,
    pin VARCHAR(10) NOT NULL
)";

if ($conn->query($tableCreationSql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}


$stmt = $conn->prepare("INSERT INTO user_data (name, age, mobile, nationality, language, pin) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sissss", $name, $age, $mobile, $nationality, $language, $pin);


$name = htmlspecialchars($_POST['name']);
$age = (int) $_POST['age'];
$mobile = htmlspecialchars($_POST['mobile']);
$nationality = htmlspecialchars($_POST['nationality']);
$language = htmlspecialchars($_POST['language']);
$pin = htmlspecialchars($_POST['pin']);


if ($stmt->execute()) {
    echo "Data added successfully!";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>

