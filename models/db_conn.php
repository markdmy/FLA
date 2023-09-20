<?php

$dsn = 'mysql:host=localhost;dbname=freelaundryaccess';
$dbname = 'freelaundryaccess';
$host = 'localhost';
$username = 'cookAdmin';
$password = '12341234';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
} catch (PDOException $e) {
    // Connection failed, display error message
    $error_message = $e->getMessage();
    echo "Database connection failed: " . $error_message;
    exit();
}
?>