<?php
// Database connection
include 'db.php';

// Handle filter form submission
$filterResults = [];
$sumResults = [];  // To hold sum results
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter'])) {
    $customer_id = !empty($_POST['filter_customer_id']) ? $_POST['filter_customer_id'] : null;
    $year = !empty($_POST['filter_year']) ? $_POST['filter_year'] : null;
    $month = !empty($_POST['filter_month']) ? $_POST['filter_month'] : null;

    // Build SQL query for filtered results
    $query = "SELECT customers.name, tea_book.* 
              FROM tea_book 
              JOIN customers ON tea_book.customer_id = customers.customer_id 
              WHERE 1=1";

    if ($customer_id) {
        $query .= " AND tea_book.customer_id = ?";
    }
    if ($year) {
        $query .= " AND YEAR(tea_book.entry_date) = ?";
    }
    if ($month) {
        $query .= " AND MONTH(tea_book.entry_date) = ?";
    }

    $stmt = $conn->prepare($query);

    // Bind parameters conditionally
    $params = [];
    if ($customer_id) $params[] = &$customer_id;
    if ($year) $params[] = &$year;
    if ($month) $params[] = &$month;

    if ($params) {
        $stmt->bind_param(str_repeat("i", count($params)), ...$params);
    }

    $stmt->execute();
    $filterResults = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Query for calculating the sums
    $sumQuery = "SELECT 
                    SUM(tea_book.bags) AS total_bags, 
                    SUM(tea_book.gross_weight) AS total_gross_weight, 
                    SUM(tea_book.net_weight) AS total_net_weight
                  FROM tea_book 
                  WHERE 1=1";

    if ($customer_id) {
        $sumQuery .= " AND tea_book.customer_id = ?";
    }
    if ($year) {
        $sumQuery .= " AND YEAR(tea_book.entry_date) = ?";
    }
    if ($month) {
        $sumQuery .= " AND MONTH(tea_book.entry_date) = ?";
    }

    $stmt = $conn->prepare($sumQuery);

    // Bind parameters for sum query
    $sumParams = [];
    if ($customer_id) $sumParams[] = &$customer_id;
    if ($year) $sumParams[] = &$year;
    if ($month) $sumParams[] = &$month;

    if ($sumParams) {
        $stmt->bind_param(str_repeat("i", count($sumParams)), ...$sumParams);
    }

    $stmt->execute();
    $sumResults = $stmt->get_result()->fetch_assoc(); // Fetch the sum results
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Tea Book Entries</title>
    <link rel="stylesheet" href="filter_teabook.css">
    <link rel="stylesheet" href="main.css">
    <button onclick="window.location.href='teabook.php'" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin: 20px; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#45a049'" onmouseout="this.style.backgroundColor='#4CAF50'">
    Go Back to Teabook
</button>
</head>
<body>

<div class="filter_panel">
    <!-- Filter Section -->
    <div class="filter-section">
        <h2>Filter Tea Book Entries</h2>
        <form method="POST">
            <input type="number" name="filter_customer_id" placeholder="Customer ID">
            <input type="number" name="filter_year" placeholder="Year">
            <input type="number" name="filter_month" placeholder="Month">
            <button type="submit" name="filter">Filter</button>
        </form>

        <?php if ($filterResults): ?>
            <div class="filter-result">
                <h3>Filtered Results</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Entry ID</th>
                            <th>Date</th>
                            <th>Bags</th>
                            <th>Gross Weight</th>
                            <th>Net Weight</th>
                            <th>Driver</th>
                            <th>Supervisor</th>
                            <th>Manager</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filterResults as $row): ?>
                            <tr>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['entry_id'] ?></td>
                                <td><?= $row['entry_date'] ?></td>
                                <td><?= $row['bags'] ?></td>
                                <td><?= $row['gross_weight'] ?></td>
                                <td><?= $row['net_weight'] ?></td>
                                <td><?= $row['lorry_driver'] ?></td>
                                <td><?= $row['factory_supervisor'] ?></td>
                                <td><?= $row['factory_manager'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h4>Sum of Filtered Results</h4>
                <ul>
                    <li><strong>Total Bags:</strong> <?= isset($sumResults['total_bags']) ? $sumResults['total_bags'] : 0 ?></li>
                    <li><strong>Total Gross Weight:</strong> <?= isset($sumResults['total_gross_weight']) ? $sumResults['total_gross_weight'] : 0 ?></li>
                    <li><strong>Total Net Weight:</strong> <?= isset($sumResults['total_net_weight']) ? $sumResults['total_net_weight'] : 0 ?></li>
                </ul>
            </div>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter'])): ?>
            <p>No results found for the selected filters.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
