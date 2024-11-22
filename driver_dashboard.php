<?php
session_start();
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['company_code'])) {
    header("Location: driver_login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch the current location of the logged-in driver
$sql = "SELECT vehicle_name, vehicle_no, driver_name, longitude, latitude FROM drivers WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$driver_data = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Dashboard</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="driver_dashboard.css">
    <script>
        // Function to get and update location
        function updateLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var longitude = position.coords.longitude;
                    var latitude = position.coords.latitude;

                    // Send location data to update_location.php via AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "update_location.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            document.getElementById("status").innerHTML = "Location updated successfully.";
                        }
                    };
                    xhr.send("longitude=" + longitude + "&latitude=" + latitude);
                });
            } else {
                document.getElementById("status").innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        // Automatically update location when the page loads
        window.onload = updateLocation;
    </script>
</head>
<body>
    <button onclick="window.location.href='tracking.php'" id="sd">Go Back to Tracking</button>

    <h1>Welcome, <?php echo htmlspecialchars($driver_data['driver_name']); ?></h1>
    <h2>Vehicle Information</h2>
    <p><strong>Vehicle Name:</strong> <?php echo htmlspecialchars($driver_data['vehicle_name']); ?></p>
    <p><strong>Vehicle Number:</strong> <?php echo htmlspecialchars($driver_data['vehicle_no']); ?></p>

    <h2>Current Location</h2>
    <p><strong>Longitude:</strong> <?php echo htmlspecialchars($driver_data['longitude']); ?></p>
    <p><strong>Latitude:</strong> <?php echo htmlspecialchars($driver_data['latitude']); ?></p>

    <p id="status"></p> <!-- Status message for location update -->

    <a href="logout.php">Logout</a>
</body>
</html>
