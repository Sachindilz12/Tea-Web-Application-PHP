<?php
require 'db.php'; // Ensure this file contains your database connection

$signup_error = '';
$signup_success = '';

// Allowed company codes specifically for drivers
$allowed_company_codes = ['driver1', 'driver2', 'driver3'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $company_code = $_POST['company_code'];
    $password = $_POST['password'];

    if (!in_array($company_code, $allowed_company_codes)) {
        $signup_error = "Invalid company code.";
    } else {
        // Check if username already exists
        $sql = "SELECT * FROM driver_users WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $signup_error = "Username already taken.";
        } else {
            // Insert new user (plain text password)
            $sql = "INSERT INTO driver_users (username, company_code, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $company_code, $password);

            if ($stmt->execute()) {
                $signup_success = "Signup successful. Redirecting to login page...";
                header("refresh:2;url=driver_login.php");
                exit();
            } else {
                $signup_error = "Error during signup. Please try again.";
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="signup.css">
    <title>Driver Signup</title>
</head>
<body>
    <div class="signup-container">
        <h1>Driver Signup</h1>
        <?php if ($signup_error): ?>
            <p class="error"><?php echo htmlspecialchars($signup_error); ?></p>
        <?php endif; ?>
        <?php if ($signup_success): ?>
            <p class="success"><?php echo htmlspecialchars($signup_success); ?></p>
        <?php endif; ?>
        <form method="POST" action="driver_signup.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="company_code" placeholder="Driver Company Code" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="signup">Signup</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
