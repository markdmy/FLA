<?php
include("db_conn.php");

function authenticate_admin($username, $password) {
    global $db;

    // First, try to authenticate from auth_admin table
    $authAdminResult = authenticate_admin_from_table($username, $password, 'auth_admin');
    
    // If authentication fails in auth_admin table, try auth_others table
    if (!$authAdminResult) {
        $authOthersResult = authenticate_admin_from_table($username, $password, 'auth_others');
        
        // Return the result of authentication from auth_others table
        return $authOthersResult;
    }
    
    // Return the result of authentication from auth_admin table
    return $authAdminResult;
}





function authenticate_admin_from_table($username, $password, $table) {
    global $db;

    $usernameColumn = ($table === 'auth_admin') ? 'username' : 'useremail';
    $passwordColumn = ($table === 'auth_admin') ? 'password' : 'userpassword';

    try {
        // Prepare a query to fetch the hashed password based on the provided username/useremail from the specified table
        $query = $db->prepare("SELECT $passwordColumn FROM $table WHERE $usernameColumn = :username");
        $query->bindParam(':username', $username);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return false; // Username/useremail not found in the specified table
        }
        
        if (password_verify($password, $row[$passwordColumn])) {
            return true; // Authentication succeeded
        } else {
            return false; // Authentication failed
        }
    } catch (PDOException $e) {
        // Handle any database query errors here
        error_log("Database error: " . $e->getMessage());
        return false; // Authentication failed due to a database error
    }
}



?>