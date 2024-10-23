<?php
session_start();
require 'db.php'; // Ensure this file contains your database connection

$signup_error = '';
$signup_success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $company_code = $_POST['company_code'];
    $password = $_POST['password'];

    // Check if username already exists
    $sql = "SELECT * FROM admin_users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $signup_error = "Username already taken.";
    } else {
        // Hash the password
        
        // Insert new user
        $sql = "INSERT INTO admin_users (username, company_code, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $company_code,$password );

        if ($stmt->execute()) {
            $signup_success = "Signup successful. You can now log in.";
            // Optionally, redirect to login after a delay
            // header("refresh:2;url=admin_login.php");
            // exit();
        } else {
            $signup_error = "Error during signup. Please try again.";
        }
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
    <link rel="stylesheet" href="signup.css">
    <title>Admin Signup</title>
</head>
<body>
    <div class="login-container">
        <h1>Admin Signup</h1>
        <?php if ($signup_error): ?>
            <p class="error"><?php echo htmlspecialchars($signup_error); ?></p>
        <?php endif; ?>
        <?php if ($signup_success): ?>
            <p class="success"><?php echo htmlspecialchars($signup_success); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="company_code" placeholder="Company Code" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="signup">Sign Up</button>
        </form>
        <p>Already have an account? <a href="admin_login.php">Login here</a></p>
    </div>
</body>
</html>
