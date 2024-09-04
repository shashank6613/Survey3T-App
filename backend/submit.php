<?php
header("Access-Control-Allow-Origin: *"); // Adjust as needed
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$dbHost = getenv('DB_HOST');
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');


if (!$dbHost || !$dbName || !$dbUser || !$dbPassword) {
	    die("Database environment variables are not set.");
}

try {
     $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $createTableSQL = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        age INT,
        mobile VARCHAR(20),
        nationality VARCHAR(100),
        language VARCHAR(50),
        pin VARCHAR(10)
    );
    ";
    $pdo->exec($createTableSQL);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $_POST['name'];
	$age = $_POST['age'];
	$mobile = $_POST['mobile'];
	$nationality = $_POST['nationality'];
	$language = $_POST['language'];
	$pin = $_POST['pin'];

	$insertSQL = "
        INSERT INTO users (name, age, mobile, nationality, language, pin) 
        VALUES (:name, :age, :mobile, :nationality, :language, :pin)
        ";

	$stmt = $pdo->prepare($insertSQL);
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':age', $age);
	$stmt->bindParam(':mobile', $mobile);
	$stmt->bindParam(':nationality', $nationality);
        $stmt->bindParam(':language', $language);
	$stmt->bindParam(':pin', $pin);
	$stmt->execute();
 echo "Data saved successfully.";						}
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

