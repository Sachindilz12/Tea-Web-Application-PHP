<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include('db.php');

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        // Add new supply entry
        $date = $_POST['date'];
        $time = $_POST['time'];
        $tea_type = $_POST['tea_type'];
        $sales_proceeds = $_POST['sales_proceeds'];
        $selling_mark = $_POST['selling_mark'];
        $quantity = $_POST['quantity'];
        $weight = $_POST['weight'];
        $total_weight = $_POST['total_weight'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("INSERT INTO supply (date, time, tea_type, sales_proceeds, selling_mark, quantity, weight, total_weight, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssddds", $date, $time, $tea_type, $sales_proceeds, $selling_mark, $quantity, $weight, $total_weight, $price);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['update'])) {
        // Update supply entry
        $id = $_POST['id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $tea_type = $_POST['tea_type'];
        $sales_proceeds = $_POST['sales_proceeds'];
        $selling_mark = $_POST['selling_mark'];
        $quantity = $_POST['quantity'];
        $weight = $_POST['weight'];
        $total_weight = $_POST['total_weight'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("UPDATE supply SET date=?, time=?, tea_type=?, sales_proceeds=?, selling_mark=?, quantity=?, weight=?, total_weight=?, price=? WHERE id=?");
        $stmt->bind_param("sssssdddi", $date, $time, $tea_type, $sales_proceeds, $selling_mark, $quantity, $weight, $total_weight, $price, $id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        // Delete supply entry
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM supply WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch existing supply entries
$result = $conn->query("SELECT * FROM supply");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inventory.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Supply - Tea Quality App</title>
    
</head>
<body>
<header>
        <nav>
        <ul>
        <li><a href="home.php">Home</a></li>
           <li><a href="scan_login.php">Scan</a></li>
           <li><a href="teabook.php">Tea Book</a></li>
           <li><a href="inventory.php">Inventory</a></li>
           <li class="dropdown">
               <a href="javascript:void(0)" class="dropbtn">Prediction</a>
               <div class="dropdown-content">
                   <a href="weight.php">Weight Prediction</a>
                   <a href="sales.php">Sales Prediction</a>
               </div>
           </li>
           <li><a href="tracking.php">Tracking</a></li>
           <li><a href="contact.php">Contact</a></li>
           <li><a href="help.php">Help</a></li>

           <li><a href="logout.php">Logout</a></li>
       </ul>
        </nav>
    </header>
    <main>
        <div class="content">
            <h1>Supply</h1>
            <button id="openFormBtn">Add New Entry</button>

           
            <div id="popupForm" class="modal">
                <div class="modal-content">
                    <span id="closeFormBtn" class="close">&times;</span>
                    <form method="POST" action="">
                        <h2>Add New Entry</h2>
                        <input type="date" name="date" required placeholder="Select Date">
                        <input type="time" name="time" required placeholder="Select Time">
                        <select name="tea_type" required>
                            <option value="">Select Tea Type</option>
                            <option value="BM">BM</option>
                            <option value="BOPIA">BOPIA</option>
                            <option value="FMSG">FMSG</option>
                            <option value="PEKOE">PEKOE</option>
                            <option value="OP">OP</option>
                            <option value="OPI">OPI</option>
                            <option value="OPA">OPA</option>
                            <option value="BOA">BOA</option>
                        </select>
                        <select name="sales_proceeds" required>
                            <option value="">Select Sales Proceeds</option>
                            <option value="CTB">CTB</option>
                            <option value="MCB">MCB</option>
                            <option value="LCBL">LCBL</option>
                        </select>
                        <select name="selling_mark" required>
                            <option value="">Select Selling Mark</option>
                            <option value="BHS">Blue Hills Supper (BHS)</option>
                            <option value="BH">Blue Hills (BH)</option>
                        </select>
                        <input type="number" name="quantity" id="quantity" step="any" required placeholder="Enter Quantity">
    <input type="number" name="weight" id="weight" step="any" required placeholder="Enter Weight">
    <input type="number" name="total_weight" id="total_weight" step="any" required placeholder="Total Weight (Auto-calculated)" readonly>
    <input type="number" name="price" step="any" required placeholder="Enter Price">
    <button type="submit" name="add">Add Entry</button>

                    </form>
                </div>
            </div>

            <!-- Inventory Table -->
            <h2>Current Supply</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Tea Type</th>
                        <th>Sales Proceeds</th>
                        <th>Selling Mark</th>
                        <th>Quantity</th>
                        <th>Weight</th>
                        <th>Total Weight</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['time']); ?></td>
                            <td><?php echo htmlspecialchars($row['tea_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['sales_proceeds']); ?></td>
                            <td><?php echo htmlspecialchars($row['selling_mark']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['weight']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_weight']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11">No inventory entries found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // Get the modal
        var modal = document.getElementById("popupForm");

        // Get the button that opens the modal
        var btn = document.getElementById("openFormBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementById("closeFormBtn");

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


<script>
    // Get input elements
    const quantityInput = document.getElementById("quantity");
    const weightInput = document.getElementById("weight");
    const totalWeightInput = document.getElementById("total_weight");

    // Function to update total weight
    function updateTotalWeight() {
        const quantity = parseFloat(quantityInput.value) || 0; // Default to 0 if empty
        const weight = parseFloat(weightInput.value) || 0; // Default to 0 if empty
        totalWeightInput.value = (quantity * weight).toFixed(2); // Calculate and set total weight
    }

    // Add event listeners to quantity and weight inputs
    quantityInput.addEventListener("input", updateTotalWeight);
    weightInput.addEventListener("input", updateTotalWeight);
</script>

</body>
</html>
