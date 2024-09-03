<?php
// Include the configuration file
$config = include('/var/www/html/db_config.php');

// Retrieve credentials from configuration
$dbHost = getenv('DB_HOST');
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD')

// Create a new PDO instance for database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    $pdo->exec("USE $dbname");  

// Create table if it doesn't exist
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
    // Insert user data into the table
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $mobile = $_POST['mobile'];
        $nationality = $_POST['nationality'];
        $language = $_POST['language'];
        $pin = $_POST['pin'];

        $insertSQL = "
        INSERT INTO users (name, age, mobile, nationality, language, pin)                                                                                                       VALUES (:name, :age, :mobile, :nationality, :language, :pin)                                                                                                            ";
        
	$stmt = $pdo->prepare($insertSQL);                                                                                                                                      $stmt->bindParam(':name', $name);                                                                                                                                       $stmt->bindParam(':age', $age);                                                                                                                                         $stmt->bindParam(':mobile', $mobile);
	$stmt->bindParam(':nationality', $nationality);                                                                                                                         $stmt->bindParam(':language', $language);                                                                                                                               $stmt->bindParam(':pin', $pin);
	$stmt->execute();
                                                                                                                                                                                echo "Data saved successfully.";                                                                                                                                    }
} catch (PDOException $e) {                                                                                                                                                 echo "Error: " . $e->getMessage();                                                                                                                                  }
?>
