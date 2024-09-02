<?php
// Database configuration
 $host = getenv('DB_HOST');  // Database host, e.g., 'localhost' or IP address
 $dbname = getenv('DB_NAME');  // Your database name
 $username = getenv('DB_USER');  // Your database username
 $password = getenv('DB_PASSWORD');  // Your database password

// Create a new PDO instance
 try {
     $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
// Set the PDO error mode to exception
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch (PDOException $e) {
// Handle connection errors
     die("Database connection failed: " . $e->getMessage());
 }
?>
                     
