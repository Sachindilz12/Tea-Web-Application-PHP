<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/sales.css">

    <title>Sales Prediction - Tea Quality App</title>
   

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="js/sales.js"></script>


</head>
<body>
    <header>
        <nav>
        <ul>
        <li><a href="home.php">Home</a></li>

           <li><a href="scan_login.php">Scan</a></li>
           <li><a href="inventory.php">Inventory</a></li>
           <li><a href="teabook.php">Tea Book</a></li>

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
           <li><a href="help.php">Help</a></li>

           <li><a href="logout.php">Logout</a></li>
       </ul>
        </nav>
    </header>


   
    <div class="sales_chart">
    <h1>Sales Prediction Yearly </h1>
    <div id="sales2019" style="width: 100%; height: 500px;"></div>
    <div id="sales2020" style="width: 100%; height: 500px;"></div>
    <div id="sales2021" style="width: 100%; height: 500px;"></div>
    <div id="sales2022" style="width: 100%; height: 500px;"></div>
    <div id="sales2023" style="width: 100%; height: 500px;"></div>
    
    <div class="sales_chart">
    <h1>Sales Prediction Monthly </h1>
    <div id="salesjan" style="width: 100%; height: 500px;"></div>
    <div id="salesfeb" style="width: 100%; height: 500px;"></div>
    <div id="salesmar" style="width: 100%; height: 500px;"></div>
    <div id="salesapr" style="width: 100%; height: 500px;"></div>
    <div id="salesmay" style="width: 100%; height: 500px;"></div>
    <div id="salesjun" style="width: 100%; height: 500px;"></div>
    <div id="salesjul" style="width: 100%; height: 500px;"></div>
    <div id="salesaug" style="width: 100%; height: 500px;"></div>
    <div id="salessept" style="width: 100%; height: 500px;"></div>
    <div id="salesoct" style="width: 100%; height: 500px;"></div>
    <div id="salesnov" style="width: 100%; height: 500px;"></div>
    <div id="salesdec" style="width: 100%; height: 500px;"></div>
    </div>

    <div class="sales_gross">
    <h1>Sales Prediction Yearly </h1>
    <div id="sales_gross" style="width: 100%; height: 500px;"></div>
    </div>
</div>
    
    
<div class="sales_predict">
        <h1>Sales Prediction</h1>

       
        <form method="POST" action="sales.php">
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" min="2024" required>
            <label for="month">Month:</label>
            <select id="month" name="month" required>
                <option value="Jan">January</option>
                <option value="Feb">February</option>
                <option value="Mar">March</option>
                <option value="Apr">April</option>
                <option value="May">May</option>
                <option value="Jun">June</option>
                <option value="Jul">July</option>
                <option value="Aug">August</option>
                <option value="Sept">September</option>
                <option value="Oct">October</option>
                <option value="Nov">November</option>
                <option value="Dec">December</option>
            </select>
            <button type="submit">Predict</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
            $year_to_predict = (int)$_POST['year'];
            $month_to_predict = $_POST['month'];

            
            $months = [
                'Jan' => [26987800, 54337540, 37443150,60606820],
                'Feb' => [23189210, 31413470, 34158880, 42381140],
                'Mar' => [17759250, 40283020, 45042370, 43002080],
                'Apr' => [20094895, 35178500, 43362550, 26360200],
                'May' => [14227390, 21011580, 72740910, 54703680],
                'Jun' => [25003610, 28574350, 68717080, 56953610],
                'Jul' => [28955660, 28198770, 72311780, 45875390],
                'Aug' => [36938130, 38634910, 54974770, 46365020],
                'Sept' => [59309280, 25048970, 52065230, 18841960],
                'Oct' => [49369700, 21754480, 58273320, 24260870],
                'Nov' => [57404750, 32836390, 53919830, 44255710],
                'Dec' => [50918540, 22539450, 47805410, 27808450]
            ];

            // Years corresponding to the data points
            $years = [2020, 2021, 2022, 2023];

            // Function to calculate linear regression prediction
            function predict_sales($x, $y, $year_to_predict) {
                $mean_x = array_sum($x) / count($x);
                $mean_y = array_sum($y) / count($y);

                $numerator = 0;
                $denominator = 0;
                for ($i = 0; $i < count($x); $i++) {
                    $numerator += ($x[$i] - $mean_x) * ($y[$i] - $mean_y);
                    $denominator += pow($x[$i] - $mean_x, 2);
                }

                $m = $numerator / $denominator;  // Slope
                $b = $mean_y - ($m * $mean_x);  // Intercept

                return $m * $year_to_predict + $b;
            }

            // Predict the weight for the selected month and year
            if (array_key_exists($month_to_predict, $months)) {
                $predicted_weight = predict_sales($years, $months[$month_to_predict], $year_to_predict);
                echo "<h2>Predicted Gross Sales for $month_to_predict $year_to_predict: " . number_format($predicted_weight) . " /=</h2>";
            } else {
                echo "<h2>Invalid month selected.</h2>";
            }
        }
        ?>
    </div>
    
    


</body>
</html>

