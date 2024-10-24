function sendMail(event) {
    event.preventDefault(); // Prevent form from reloading the page

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
