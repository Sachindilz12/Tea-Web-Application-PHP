<?php
session_start();
ob_start(); // Start output buffering
require 'db.php'; // Ensure this connects to your database

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $company_code = $_POST['company_code'];
    $password = $_POST['password'];

    // Prepare and execute the query for the contact_users table
    $sql = "SELECT * FROM contact_users WHERE username=? AND company_code=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $company_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) { // Use password verification if passwords are hashed
            $_SESSION['user'] = $user['username'];
            header("Location: contact.php"); // Redirect to contact.php after successful login
            exit();
        } else {
            $login_error = "Invalid password.";
        }
    } else {
        $login_error = "No user found with that username and company code.";
    }

    $stmt->close();
}

$conn->close();
ob_end_flush(); // End output buffering and flush the buffer
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Contact - Login</title>
</head>
<body>
    <div class="login-container">
        <h1>Login to Access Contact</h1>
        <?php if ($login_error): ?>
            <p class="error"><?php echo htmlspecialchars($login_error); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="company_code" placeholder="Company Code" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="contact_signup.php">Sign up here</a></p>
    </div>
</body>
</html>
