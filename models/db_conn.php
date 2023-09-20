<?php

$dsn = 'mysql:host=localhost;dbname=freelaundryaccess';
$dbname='freelaundryaccess';
$host='localhost';
$username='cookAdmin';
$password='12341234';


try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    $error_message = $e->getMessage();
    include('models/db_error.php');
    exit();
}

?>