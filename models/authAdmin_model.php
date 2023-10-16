<?php
include("db_conn.php");

function authenticate_admin($username, $password) {
    global $db;

    try {
        // Prepare a query to fetch the hashed password based on the provided username
        $query = $db->prepare("SELECT password FROM auth_admin WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return false; // Username not found in the database
        }
        
        if (password_verify($password, $row['password'])) {
            return true; 
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        // Handle any database query errors here
        error_log("Database error: " . $e->getMessage());
        return false; // Authentication failed due to a database error
    }
}

?>