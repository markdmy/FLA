<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("models/authAdmin_model.php");
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    if (authenticate_admin($entered_username, $entered_password)) {
        $_SESSION["admin_authenticated"] = true;
        echo "<script>window.location.href='event.php';</script>";
        // header("Location: event.php");
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
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
    <link rel="icon" href="assets/images/apple-touch-icon-120x120.png" />
</head>

<body>

    <?php include('components/header.php'); ?>

    <section class="container log-in-container">
        <form action="admin_login.php" method="post" id="admin-login-form" class="form">
            <div class="form-container">
                <div class="input-box">
                    <label for="username">Username(or email):</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-box">
                    <label for="password">Password:</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" required>
                        <span id="toggle_password3"><img class="pw-eye" src="assets/images/eye-solid.svg"
                                alt="password-see-eye" /></span>
                    </div>
                </div>

            </div>
            <?php if (isset($error_message)): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
            <?php endif; ?>
            <div class="signup-box">
                <p><span id="signup_link" class="underline-text"><a href="event_admin_signup.php" target="_blank">Create
                            an
                            account</a></span>(for
                    volunteers/staff)</p>
            </div>

            <button type="submit" id="adminSubmit" class="btn-container" onclick="">
                <div class="btn btn-login">
                    <span>LOG IN</span>
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