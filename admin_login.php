<?php
session_start();
require 'db.php'; // Ensure this file contains your database connection

$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $company_code = $_POST['company_code'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $sql = "SELECT * FROM admin_users WHERE username=? AND company_code=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $company_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) { // Replace with password verification if using hashed passwords
            $_SESSION['admin_user'] = $user['username'];
            header("Location: admin_dashboard.php"); // Redirect to admin dashboard
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="login.css"> <!-- Update to your CSS file for styling -->
    <title>Admin Login - Scan</title>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login to Access Scan</h1>
        <?php if ($login_error): ?>
            <p class="error"><?php echo htmlspecialchars($login_error); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="company_code" placeholder="Company Code" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="admin_signup.php">Sign up here</a></p>
    </div>
</body>
</html>
