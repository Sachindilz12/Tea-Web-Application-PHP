function sendMail(event) {
    event.preventDefault(); // Prevent form from reloading the page

    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let subject = document.getElementById("subject").value;
    let message = document.getElementById("message").value;

    if (name && email && subject && message) {
        let params = { name, email, subject, message };

        emailjs.send("service_6in75cr", "template_savbokr", params)
            .then(function(response) {
                console.log("SUCCESS!", response.status, response.text);
                alert("Email Sent Successfully!");
                document.getElementById("contact-form").reset(); // Clear form
            }, function(error) {
                console.error("FAILED...", error);
                alert("Failed to send email. Please try again later.");
            });
    } else {
        alert("Please fill out all fields.");
    }
}
