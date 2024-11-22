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
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="weight.css">

    <title>Weight Prediction - Tea Quality App</title>
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="js/charts.js"></script>
  
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
    <div class="weight_chart">
    <h1>Weight Prediction Yearly </h1>
    <div id="weight2019" style="width: 100%; height: 500px;"></div>
    <div id="weight2020" style="width: 100%; height: 500px;"></div>
    <div id="weight2021" style="width: 100%; height: 500px;"></div>
    <div id="weight2022" style="width: 100%; height: 500px;"></div>
    <div id="weight2023" style="width: 100%; height: 500px;"></div>
    </div>

    <div class="weight_chart">
    <h1>Weight Prediction Monthly </h1>
    <div id="weightjan" style="width: 100%; height: 500px;"></div>
    <div id="weightfeb" style="width: 100%; height: 500px;"></div>
    <div id="weightmar" style="width: 100%; height: 500px;"></div>
    <div id="weightapr" style="width: 100%; height: 500px;"></div>
    <div id="weightmay" style="width: 100%; height: 500px;"></div>
    <div id="weightjun" style="width: 100%; height: 500px;"></div>
    <div id="weightjul" style="width: 100%; height: 500px;"></div>
    <div id="weightaug" style="width: 100%; height: 500px;"></div>
    <div id="weightsept" style="width: 100%; height: 500px;"></div>
    <div id="weightoct" style="width: 100%; height: 500px;"></div>
    <div id="weightnov" style="width: 100%; height: 500px;"></div>
    <div id="weightdec" style="width: 100%; height: 500px;"></div>
    </div>
    
    <div class="gross_weight">
    <h1>Weight Prediction Yearly </h1>
    <div id="weight_gross" style="width: 100%; height: 500px;"></div>
    </div>

    
    <div class="weight_predict">
        <h1>Weight Prediction</h1>
        <form method="POST" action="weight.php">
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
            // Get the input year and month from the form
            $year_to_predict = (int)$_POST['year'];
            $month_to_predict = $_POST['month'];

            // Historical data for each month
            $months = [
                'Jan' => [198668, 251803, 245225, 170558],
                'Feb' => [165580, 244732, 226112, 222985],
                'Mar' => [92268, 412895, 277044, 199176],
                'Apr' => [114227, 458762, 311290, 296054],
                'May' => [233724, 352618, 331191, 284596],
                'Jun' => [228603, 277965, 223981, 278157],
                'Jul' => [376232, 323093, 193836, 237389],
                'Aug' => [447104, 254739, 179871, 63410],
                'Sept' => [504566, 206573, 241699, 86353],
                'Oct' => [525167, 238209, 204484, 305817],
                'Nov' => [391139, 324915, 258903, 148203],
                'Dec' => [482416, 257922, 128595, 128595]
            ];

            // Years corresponding to the data points
            $years = [2020, 2021, 2022, 2023];

            // Function to calculate linear regression prediction
            function predict_weight($x, $y, $year_to_predict) {
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
                $predicted_weight = predict_weight($years, $months[$month_to_predict], $year_to_predict);
                echo "<h2>Predicted Gross Weight for $month_to_predict $year_to_predict: " . number_format($predicted_weight) . " kg</h2>";
            } else {
                echo "<h2>Invalid month selected.</h2>";
            }
        }
        ?>
    </div>

  </body>
</html>
