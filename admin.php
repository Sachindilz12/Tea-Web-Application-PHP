<?php
include('db.php');

// Initialize an empty array for storing driver data
$drivers = [];

// Query to fetch data from the drivers table
$sql = "SELECT * FROM drivers";
$result = mysqli_query($conn, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $drivers[] = $row;
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Check if the form is submitted to add a new driver
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_driver'])) {
    // Get form data
    $vehicle_name = $_POST['vehicle_name'];
    $vehicle_no = $_POST['vehicle_no'];
    $driver_name = $_POST['driver_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert the new driver into the database
    $insert_sql = "INSERT INTO drivers (vehicle_name, vehicle_no, driver_name, username, password)
                   VALUES ('$vehicle_name', '$vehicle_no', '$driver_name', '$username', '$password')";

    try {
        if (mysqli_query($conn, $insert_sql)) {
            echo "New driver added successfully.";
            header("Location: admin.php"); // Refresh to see the new data
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            echo "Error: The username '$username' already exists. Please choose a different username.";
        } else {
            echo "Error adding driver: " . $e->getMessage();
        }
    }
}

// Check if the delete action is triggered
if (isset($_GET['delete'])) {
    $username_to_delete = $_GET['delete'];

    // Query to delete the driver based on the username
    $delete_sql = "DELETE FROM drivers WHERE username = '$username_to_delete'";
    
    if (mysqli_query($conn, $delete_sql)) {
        echo "Driver deleted successfully.";
        header("Location: admin.php"); // Refresh to see the updated list
        exit();
    } else {
        echo "Error deleting driver: " . mysqli_error($conn);
    }
}

// Close the connection when done
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="main.css">

</head>
<body>
    <h2>Admin Dashboard</h2>
    <form method="POST" action="">
        Vehicle Name: <input type="text" name="vehicle_name" required><br>
        Vehicle Number: <input type="text" name="vehicle_no" required><br>
        Driver Name: <input type="text" name="driver_name" required><br>
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" name="add_driver" value="Add Driver">
    </form>

    <h3>Driver List</h3>
    <table border="1">
        <tr>
            <th>Vehicle Name</th>
            <th>Vehicle Number</th>
            <th>Driver Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Action</th>
        </tr>
        <?php foreach ($drivers as $row) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['vehicle_name']); ?></td>
            <td><?php echo htmlspecialchars($row['vehicle_no']); ?></td>
            <td><?php echo htmlspecialchars($row['driver_name']); ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['password']); ?></td>
            <td><?php echo htmlspecialchars($row['longitude']); ?></td>
            <td><?php echo htmlspecialchars($row['latitude']); ?></td>
            <td>
                <!-- Delete button -->
                <a href="admin.php?delete=<?php echo urlencode($row['username']); ?>" onclick="return confirm('Are you sure you want to delete this driver?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
