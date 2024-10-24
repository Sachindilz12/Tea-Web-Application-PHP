<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Set default language to English
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// Check if language is changed by user
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Include the corresponding language file based on user selection
include "languages/" . $_SESSION['lang'] . ".php";
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="main.css">
    <title>Home - Tea Quality App</title>
</head>
<body>
    <header>
        
        <nav>
        <div class="langform">
        <form method="get" id="lang-form" action="">
            <select name="lang" onchange="document.getElementById('lang-form').submit();">
                <option value="en" <?php if ($_SESSION['lang'] == 'en') echo 'selected'; ?>>English</option>
                <option value="si" <?php if ($_SESSION['lang'] == 'si') echo 'selected'; ?>>Sinhala</option>
                <option value="ta" <?php if ($_SESSION['lang'] == 'ta') echo 'selected'; ?>>Tamil</option>
            </select>
        </form>
        </div>  
            <ul>
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
    
    <main>
        
        <div class="content">
            <h1><?php echo $lang['welcome']; ?></h1>
            <p><?php echo $lang['instruction']; ?></p>
            <button onclick="location.href='scan_login.php'"><?php echo $lang['scan_button']; ?></button>
        </div>
    </main>

   
</body>
</html>
