<!--coded by Eunji--->

<?php
//local connection in eunji's phpmyadmin for testing purpose
//$dsn = 'mysql:host=localhost;dbname=freelaundryaccess';
//$username = 'cookAdmin';
//$password = '12341234';

//live connection ; once Nancy give eunji the credentails these can be updated and tested.
$dsn = 'mysql:host=connorjpierceflap.netfirmsmysql.com;dbname=freelaundryaccess';
$username = 'eunjip'; 
$password = 'Database2023eunji'; 

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connected.";
    
} catch (PDOException $e) {
    // Connection failed, display error message
    $error_message = $e->getMessage();
    echo "Database connection failed: " . $error_message;
    exit();
}
?>