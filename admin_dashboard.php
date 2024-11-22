<?php
session_start();
include('db.php');


// Handle form submission to add a new driver
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_driver'])) {
    $vehicle_name = mysqli_real_escape_string($conn, $_POST['vehicle_name']);
    $vehicle_no = mysqli_real_escape_string($conn, $_POST['vehicle_no']);
    $driver_name = mysqli_real_escape_string($conn, $_POST['driver_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Plain text password
    $company_code = mysqli_real_escape_string($conn, $_POST['company_code']);
    
    $sql = "INSERT INTO drivers (vehicle_name, vehicle_no, driver_name, username, password, company_code) 
            VALUES ('$vehicle_name', '$vehicle_no', '$driver_name', '$username', '$password', '$company_code')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Driver added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Fetch all drivers from the database
$sql = "SELECT vehicle_name, vehicle_no, driver_name, username, longitude, latitude FROM drivers";
$result = mysqli_query($conn, $sql);
$drivers = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $drivers[] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Geolocation with Google Maps</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="admin_dashboard.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-ykqvBfiFzqHZThbJSEJz-qDWaB3PRu4"></script>
    
    <script>
        var map;
        var infoWindow;
        var drivers = <?php echo json_encode($drivers); ?>;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 7.2931, lng: 80.6350 },
                zoom: 9
            });
            infoWindow = new google.maps.InfoWindow;

            // Add markers for each driver location
            drivers.forEach(function(driver) {
                if (driver.latitude && driver.longitude) {
                    var position = {
                        lat: parseFloat(driver.latitude),
                        lng: parseFloat(driver.longitude)
                    };

                    var marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: driver.driver_name + " (" + driver.vehicle_name + ")"
                    });

                    // Display driver information on marker click
                    google.maps.event.addListener(marker, 'click', function() {
                        infoWindow.setContent('<strong>' + driver.driver_name + '</strong><br>' +
                                              'Vehicle: ' + driver.vehicle_name + '<br>' +
                                              'Vehicle No: ' + driver.vehicle_no);
                        infoWindow.open(map, marker);
                    });
                }
            });
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    infoWindow.setPosition(pos);
                    infoWindow.setContent('Current Location');
                    infoWindow.open(map);
                    map.setCenter(pos);
                }, function(error) {
                    showError(error);
                });
            } else {
                showError({ code: 0 });
            }
        }

        function showError(error) {
            var errorMessage;
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage = "User denied the request for Geolocation.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage = "Location information is unavailable.";
                    break;
                case error.TIMEOUT:
                    errorMessage = "The request to get user location timed out.";
                    break;
                case error.UNKNOWN_ERROR:
                    errorMessage = "An unknown error occurred.";
                    break;
                default:
                    errorMessage = "Geolocation is not supported by this browser.";
            }
            document.getElementById("location").innerHTML = errorMessage;
        }
    </script>


<style>/* Popup Form Overlay */
/* Popup Form Overlay */
.form-popup, .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

/* Popup Form Container */
.form-container, .modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
 font-family: Poppins;
    width: 90%;
}

.close {
            position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    color: #aaa;
    cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: green;
            text-decoration: none;
            cursor: pointer;
        }

/* Input Fields */
input[type="text"], input[type="date"], input[type="time"], input[type="number"],input[type="password"], select {
    width: 50%;
    padding: 10px;
    margin: 5px 0 10px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-sizing: border-box;
}


/* Submit Button */
input[type="submit"] {
    width: 100%;
    background-color: green;
    padding: 10px 20px;
    margin: 5px;
    color: white;
    border: none;
    border-radius: 10px;
    text-align: center;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
input[type="submit"]:hover {
    background-color: #45a049;
}

/* Open Form Button */
#openFormBtn {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
#openFormBtn:hover {
    background-color: #45a049;
}

/* Cancel Button in Form Container */
.form-container .btn.cancel {
    background-color: #dc3545;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    text-align: center;
    font-weight: bold;
}
.form-container .btn.cancel:hover {
    background-color: #c82333;
}

</style>





</head>

<body onload="initMap()">
<button onclick="window.location.href='tracking.php'" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 10px;">
    Go Back to Tracking
</button>


    <h2>Driver Locations</h2>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div id="map" style="height: 700px; width: 700px; border: 2px solid #333; border-radius: 8px;"></div>
</div>
<div id="location" style="text-align: center; margin-top: 10px;"></div>

<h2>Drivers List</h2>


    <!-- Add Driver Button to open the popup -->
<button onclick="openForm()" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin: 50px auto; display: block;">
    Add New Driver
</button>

<!-- Popup Form Container -->


<div id="popupForm" class="form-popup">
    <form method="POST" action="" class="form-container">
        <h2>Add a New Driver</h2>
        Vehicle Name: <input type="text" name="vehicle_name" required><br>
        Vehicle Number: <input type="text" name="vehicle_no" required><br>
        Driver Name: <input type="text" name="driver_name" required><br>
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Company Code: <input type="text" name="company_code" required><br>
        <input type="submit" name="add_driver" value="Add Driver">
        <button type="button" onclick="closeForm()" class="btn cancel">Close</button>
    </form>
</div>


    <table border="1">
        <tr>
            <th>Vehicle Name</th>
            <th>Vehicle Number</th>
            <th>Driver Name</th>
            <th>Username</th>
            <th>Longitude</th>
            <th>Latitude</th>
        </tr>
        <?php foreach ($drivers as $driver): ?>
            <tr>
                <td><?php echo htmlspecialchars($driver['vehicle_name']); ?></td>
                <td><?php echo htmlspecialchars($driver['vehicle_no']); ?></td>
                <td><?php echo htmlspecialchars($driver['driver_name']); ?></td>
                <td><?php echo htmlspecialchars($driver['username']); ?></td>
                <td><?php echo htmlspecialchars($driver['longitude']); ?></td>
                <td><?php echo htmlspecialchars($driver['latitude']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
    function openForm() {
        document.getElementById("popupForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }
</script>


</body>
</html> 