<!--coded by eunji-->

<?php
include("models/authAdmin_model.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];
    
    if (authenticate_admin($entered_username, $entered_password)) {
        $_SESSION["admin_authenticated"] = true;
        echo "<script>window.location.href='event.php';</script>";
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}

if (session_status() === PHP_SESSION_NONE) {
session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Admin login page for data inputs." />
    <meta name="keywords" content="free laundry access, admin login form, administrator authentication page" />
    <link rel="stylesheet" href="css/registration.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Admin Login</title>
</head>

<body>

    <?php include('components/header.php'); ?>

    <section class="container">
        <form action="admin_login.php" method="post" id="admin-login-form" class="form">
            <div class="form-container">
                <div class="input-box">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-box">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

            </div>

            <button type="submit" id="adminSubmit" class="btn-container" onclick="">
                <div class="btn btn-submit">
                    <span>SUBMIT</span>
                </div>
            </button>
        </form>
    </section>

    <?php
include('components/footer.php'); 

?>

    <script src="js/app.js"></script>


</body>

</html>