<?php
session_start();
include('db.php');

if (isset($_SESSION['username']) && isset($_POST['longitude']) && isset($_POST['latitude'])) {
    $username = $_SESSION['username'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];

    // Update the location in the drivers table
    $sql = "UPDATE drivers SET longitude = '$longitude', latitude = '$latitude' WHERE username = '$username'";
    if (mysqli_query($conn, $sql)) {
        echo "Location updated successfully.";
    } else {
        echo "Error updating location: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
