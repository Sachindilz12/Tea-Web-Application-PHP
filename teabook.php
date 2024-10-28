<?php
// Database connection
include 'db.php';

// Handle customer form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_customer'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $route = $_POST['route'];
    $year = $_POST['year'];
    $month = $_POST['month'];

    $stmt = $conn->prepare("INSERT INTO customers (name, address, phone_number, route, year, month) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssii", $name, $address, $phone, $route, $year, $month);
    $stmt->execute();
    $stmt->close();
}

// Handle tea book form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_tea_book'])) {
    $customer_id = $_POST['customer_id'];
    $entry_date = $_POST['entry_date'];
    $bags = $_POST['bags'];
    $gross_weight = $_POST['gross_weight'];
    $net_weight = $_POST['net_weight'];
    $lorry_driver = $_POST['lorry_driver'];
    $factory_supervisor = $_POST['factory_supervisor'];
    $factory_manager = $_POST['factory_manager'];

    $stmt = $conn->prepare("INSERT INTO tea_book (customer_id, entry_date, bags, gross_weight, net_weight, lorry_driver, factory_supervisor, factory_manager) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiddsss", $customer_id, $entry_date, $bags, $gross_weight, $net_weight, $lorry_driver, $factory_supervisor, $factory_manager);
    $stmt->execute();
    $stmt->close();
}

// Handle delete actions
if (isset($_GET['delete_customer'])) {
    $customer_id = $_GET['delete_customer'];
    $conn->query("DELETE FROM customers WHERE customer_id = $customer_id");
}

if (isset($_GET['delete_entry'])) {
    $entry_id = $_GET['delete_entry'];
    $conn->query("DELETE FROM tea_book WHERE entry_id = $entry_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teabook Management</title>
    <link rel="stylesheet" href="teabook.css">
    <link rel="stylesheet" href="main.css">

</head>
<body>
<header>
        <nav>
        <ul>
        <li><a href="home.php">Home</a></li>

           <li><a href="scan_login.php">Scan</a></li>
           <li><a href="inventory.php">Inventory</a></li>
           <li><a href="supply.php">Supply</a></li>
           <li class="dropdown">
               <a href="javascript:void(0)" class="dropbtn">Prediction</a>
               <div class="dropdown-content">
                   <a href="weight.php">Weight Prediction</a>
                   <a href="sales.php">Sales Prediction</a>
               </div>
           </li>
           <li><a href="tracking.php">Tracking</a></li>
           <li><a href="contact.php">Contact</a></li>
           <li><a href="logout.php">Logout</a></li>
       </ul>
        </nav>
    </header>
    <div class="container">
        <!-- Customer Table Section -->
        <div class="table-section">
            <h2>Customer Information</h2>
            <button onclick="openModal('customerModal')" class="open-modal-btn">Add Customer</button>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Route</th>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM customers");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['customer_id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['phone_number']}</td>
                                <td>{$row['route']}</td>
                                <td>{$row['year']}</td>
                                <td>{$row['month']}</td>
                                <td><a href='?delete_customer={$row['customer_id']}'>Delete</a></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tea Book Table Section -->
        <div class="table-section">
            <h2>Tea Book Entries</h2>
            <button onclick="openModal('teaBookModal')" class="open-modal-btn">Add Tea Book Entry</button>
            <table>
                <thead>
                    <tr>
                        <th>Entry ID</th>
                        <th>Customer ID</th>
                        <th>Date</th>
                        <th>Bags</th>
                        <th>Gross Weight</th>
                        <th>Net Weight</th>
                        <th>Driver</th>
                        <th>Supervisor</th>
                        <th>Manager</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM tea_book");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['entry_id']}</td>
                                <td>{$row['customer_id']}</td>
                                <td>{$row['entry_date']}</td>
                                <td>{$row['bags']}</td>
                                <td>{$row['gross_weight']}</td>
                                <td>{$row['net_weight']}</td>
                                <td>{$row['lorry_driver']}</td>
                                <td>{$row['factory_supervisor']}</td>
                                <td>{$row['factory_manager']}</td>
                                <td><a href='?delete_entry={$row['entry_id']}'>Delete</a></td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Customer Modal Form -->
    <div id="customerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('customerModal')">&times;</span>
            <form method="POST">
                <h2>Add Customer</h2>
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="address" placeholder="Address" required>
                <input type="text" name="phone" placeholder="Phone Number" required>
                <input type="text" name="route" placeholder="Route" required>
                <input type="number" name="year" placeholder="Year" required>
                <input type="text" name="month" placeholder="Month" required>
                <button type="submit" name="add_customer">Add Customer</button>
            </form>
        </div>
    </div>

    <!-- Tea Book Modal Form -->
    <div id="teaBookModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('teaBookModal')">&times;</span>
            <form method="POST">
                <h2>Add Tea Book Entry</h2>
                <input type="number" name="customer_id" placeholder="Customer ID" required>
                <input type="date" name="entry_date" required>
                <input type="number" name="bags" placeholder="No. of Bags" required>
                <input type="number" name="gross_weight" placeholder="Gross Weight" required>
                <input type="number" name="net_weight" placeholder="Net Weight" required>
                <select name="lorry_driver" required>
                    <option value="">Select Lorry Driver</option>
                    <option value="Driver1">Driver1</option>
                    <option value="Driver2">Driver2</option>
                    <option value="Driver3">Driver3</option>
                </select>
                <select name="factory_supervisor" required>
                    <option value="">Select Supervisor</option>
                    <option value="Supervisor1">Supervisor1</option>
                    <option value="Supervisor2">Supervisor2</option>
                    <option value="Supervisor3">Supervisor3</option>
                </select>
                <select name="factory_manager" required>
                    <option value="">Select Manager</option>
                    <option value="Manager1">Manager1</option>
                    <option value="Manager2">Manager2</option>
                    <option value="Manager3">Manager3</option>
                </select>
                <button type="submit" name="add_tea_book">Add Entry</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                closeModal(event.target.id);
            }
        }
    </script>
</body>
</html>
