<?php
session_start();
include('db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $company_code = $_POST['company_code'];
    $password = $_POST['password'];

    // Query to check if the credentials match in the driver_users table
    // Make sure to use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM drivers WHERE username = ? AND company_code = ? AND password = ?");
    $stmt->bind_param("sss", $username, $company_code, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Credentials match, start a session
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['company_code'] = $row['company_code'];
        header("Location: driver_dashboard.php");
        exit();
    } else {
        echo "Invalid username, company code, or password.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Login</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="login.css">

</head>
<body>
    <div class="login-container">
        <h1>Driver Login</h1>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="company_code" placeholder="Company Code" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="error">
            <!-- Display error message here if needed -->
        </div>
    </div>
</body>
</html>

