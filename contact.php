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
            header("Location: messege.php"); // Redirect to the message page
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
    <title>Contact - Login</title>
    <link rel="stylesheet" href="contact.css">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
       (function(){
          emailjs.init("2R6UXBmQUWKGYz2P_"); // Initialize with your public key
       })();
    </script>

    <script src="script.js"></script>    
</head>
<body>
  

    <section id="about" class="container">
        <h2>Messege </h2>
        <p>Send the Messeges through Form.</p>
    </section>

    <section id="contact" class="container">
        <h2>Contact Me</h2>

        <form id="contact-form">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            
            <button type="submit" onclick="sendMail()">Send Message</button>
        </form>
    </section>
</body>
</html>
