<?php
session_start();
if (!isset($_SESSION['driver'])) {
    header('Location: driver_login.php'); // Redirect to login if not logged in
    exit;
}
include('db.php'); // Database connection

$driver_username = $_SESSION['driver'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['longitude']) && isset($_POST['latitude'])) {
    $longitude = $_POST['longitude']; // Get longitude from form input
    $latitude = $_POST['latitude'];   // Get latitude from form input

    // Update the driver's location in the database
    $sql = "UPDATE drivers SET longitude='$longitude', latitude='$latitude' WHERE username='$driver_username'";
    if (mysqli_query($conn, $sql)) {
        echo "Location updated successfully!";
    } else {
        echo "Error updating location: " . mysqli_error($conn);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard</title>
    <script>
        // Function to get the current location using the Geolocation API and send it to the server
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(sendPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        // Function to handle the successful retrieval of the position
        function sendPosition(position) {
            const longitude = position.coords.longitude;
            const latitude = position.coords.latitude;

            // Send the coordinates to the server using AJAX (without form submission)
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "", true); // POST request to the current page
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("longitude=" + longitude + "&latitude=" + latitude);
        }

        // Function to handle geolocation errors
        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }

        // Update location every 10 seconds (10000 ms)
        setInterval(getLocation, 10000);
    </script>
</head>
<body>
    <h2>Driver Dashboard</h2>
    <p>Your location is being updated every 10 seconds.</p>
</body>
</html>
