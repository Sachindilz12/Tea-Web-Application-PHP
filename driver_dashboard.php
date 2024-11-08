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

// Update location if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_location'])) {
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];

    $update_sql = "UPDATE drivers SET longitude = '$longitude', latitude = '$latitude' WHERE username = '$username'";
    if (mysqli_query($conn, $update_sql)) {
        echo "Location updated successfully.";
        // Reload the page to reflect changes
        header("Location: driver_dashboard.php");
        exit();
    } else {
        echo "Error updating location: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Dashboard</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="driver_dashboard.css">

</head>
<body>
<button  onclick="window.location.href='tracking.php'" id="sd">Go Back to Tracking</button>

    
    <h1>Welcome, <?php echo htmlspecialchars($driver_data['driver_name']); ?></h1>
    <h2>Vehicle Information</h2>
    <p><strong>Vehicle Name:</strong> <?php echo htmlspecialchars($driver_data['vehicle_name']); ?></p>
    <p><strong>Vehicle Number:</strong> <?php echo htmlspecialchars($driver_data['vehicle_no']); ?></p>

    <h2>Current Location</h2>
    <p><strong>Longitude:</strong> <?php echo htmlspecialchars($driver_data['longitude']); ?></p>
    <p><strong>Latitude:</strong> <?php echo htmlspecialchars($driver_data['latitude']); ?></p>

    <form method="POST" action="">
        <h3>Update Location</h3>
        Longitude: <input type="text" name="longitude" required><br>
        Latitude: <input type="text" name="latitude" required><br>
        <input type="submit" name="update_location" value="Update Location">
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>
