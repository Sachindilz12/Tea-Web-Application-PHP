<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Login</title>
    <link rel="stylesheet" href="css/contact.css">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
       (function(){
          emailjs.init("2R6UXBmQUWKGYz2P_"); // Initialize with your public key
       })();
    </script>

    <script>
    function sendMail(event) {
        event.preventDefault(); // Prevent form from submitting

        let params = {
            name: document.getElementById("name").value,
            email: document.getElementById("email").value,
            subject: document.getElementById("subject").value,
            message: document.getElementById("message").value,
        };

        emailjs.send("service_6in75cr", "template_savbokr", params)
            .then(function(response) {
                console.log("SUCCESS!", response.status, response.text);
                alert("Email Sent Successfully!");
            }, function(error) {
                console.log("FAILED...", error);
                alert("Failed to send email.");
            });
    }
    </script>
</head>
<body>
    <section id="about" class="container">
        <h2>Message</h2>
        <p>Send the message through the form below.</p>
    </section>

    <section id="contact" class="container">
        <h2>Message Section</h2>

        <form id="contact-form" onsubmit="sendMail(event)">
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
    <textarea id="message" name="message" rows="6" required>
Route: 
Customer ID: 
Customer Name: 
Tea Bag: 
Weight: 
Water: 
Tea Quality: 
    </textarea>
</div>

            
            <button type="submit">Send Message</button>
        </form>
    </section>
</body>
</html>
