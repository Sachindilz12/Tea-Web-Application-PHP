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
    <meta name="viewport" content="width=device-width, initial-scale=1.8">
    <title>Contact - Login</title>
    <link rel="stylesheet" href="styles.css">

    <!-- Include EmailJS SDK -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    
    <script type="text/javascript">
        // Initialize EmailJS with your public key
        (function() {
            emailjs.init({
                publicKey: "2R6UXBmQUWKGYz2P_" // Your actual EmailJS public key
            });
        })();
        
        // Function to send email
        function sendEmail(e) {
            e.preventDefault(); // Prevent the form from submitting normally
            
            emailjs.sendForm('YOUR_SERVICE_ID', 'YOUR_TEMPLATE_ID', '#contact-form')
                .then(function(response) {
                    alert('Email sent successfully!', response.status, response.text);
                }, function(error) {
                    alert('Failed to send email.', error);
                });
        }
    </script>
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <h1>Your Name</h1>
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <section id="about" class="container">
        <h2>About Me</h2>
        <p>Your introduction and information about yourself goes here.</p>
    </section>

    <section id="contact" class="container">
        <h2>Contact Me</h2>
        
        <form id="contact-form" onsubmit="sendEmail(event)">
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
            
            <button type="submit">Send Message</button>
        </form>
    </section>
</body>
</html>
