<?php
require 'db.php'; // Make sure this connects to your database

$signup_error = '';
$success_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $company_code = $_POST['company_code'];
    $password = $_POST['password'];

    // Check if the username already exists in the contact_users table
    $sql = "SELECT * FROM contact_users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $signup_error = "Username already taken.";
    } else {
        // Insert the new user into contact_users table
        $sql = "INSERT INTO contact_users (username, company_code, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $company_code, $password); // Use password hashing if needed
        if ($stmt->execute()) {
            $success_msg = "Signup successful! Please log in.";
        } else {
            $signup_error = "Signup failed. Please try again.";
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
    <link rel="stylesheet" href="contact.css">
    <title>Contact - Signup</title>
</head>
<body>
    <div class="login-container">
        <h1>Sign Up for Contact</h1>
        <?php if ($signup_error): ?>
            <p class="error"><?php echo htmlspecialchars($signup_error); ?></p>
        <?php endif; ?>
        <?php if ($success_msg): ?>
            <p class="success"><?php echo htmlspecialchars($success_msg); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="company_code" placeholder="Company Code" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="signup">Sign Up</button>
        </form>
        <p>Already have an account? <a href="contact_login.php">Log in here</a></p>
    </div>
</body>
</html>
