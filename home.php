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
             
            <ul>
            <div class="langform">
                <form method="get" id="lang-form" action="">
                    <select name="lang" onchange="document.getElementById('lang-form').submit();">
                        <option value="en" <?php if ($_SESSION['lang'] == 'en') echo 'selected'; ?>>English</option>
                        <option value="si" <?php if ($_SESSION['lang'] == 'si') echo 'selected'; ?>>Sinhala</option>
                        <option value="ta" <?php if ($_SESSION['lang'] == 'ta') echo 'selected'; ?>>Tamil</option>
                    </select>
                </form>
            </div>
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


        <div class="datetime">
            <p id="clock"></p>
            <p id="date"></p>
        </div>

        <div class="calendar">
            <header>
                <h3></h3>
                <nav>
                    <button id="prev"></button>
                    <button id="next"></button>
                </nav>
            </header>
            <section>
                <ul class="days">
                    <li>Sun</li>
                    <li>Mon</li>
                    <li>Tue</li>
                    <li>Wed</li>
                    <li>Thu</li>
                    <li>Fri</li>
                    <li>Sat</li>
                </ul>
                <ul class="dates"></ul>
            </section>
        </div>


     
    </main>

    <script>
        function updateTime() {
            const now = new Date();
            const time = now.toLocaleTimeString();
            const date = now.toLocaleDateString();
            document.getElementById('clock').textContent = time;
            document.getElementById('date').textContent = date;
        }
        setInterval(updateTime, 1000); // Update every second
        updateTime(); // Initial call

        const header = document.querySelector(".calendar h3");
        const dates = document.querySelector(".dates");
        const navs = document.querySelectorAll("#prev, #next");

        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        let date = new Date();
        let month = date.getMonth();
        let year = date.getFullYear();

        function renderCalendar() {
            const start = new Date(year, month, 1).getDay();
            const endDate = new Date(year, month + 1, 0).getDate();
            const end = new Date(year, month, endDate).getDay();
            const endDatePrev = new Date(year, month, 0).getDate();

            let datesHtml = "";

            for (let i = start; i > 0; i--) {
                datesHtml += `<li class="inactive">${endDatePrev - i + 1}</li>`;
            }

            for (let i = 1; i <= endDate; i++) {
                let className =
                    i === date.getDate() &&
                    month === new Date().getMonth() &&
                    year === new Date().getFullYear()
                        ? ' class="today"'
                        : "";
                datesHtml += `<li${className}>${i}</li>`;
            }

            for (let i = end; i < 6; i++) {
                datesHtml += `<li class="inactive">${i - end + 1}</li>`;
            }

            dates.innerHTML = datesHtml;
            header.textContent = `${months[month]} ${year}`;
        }

        navs.forEach((nav) => {
            nav.addEventListener("click", (e) => {
                const btnId = e.target.id;

                if (btnId === "prev" && month === 0) {
                    year--;
                    month = 11;
                } else if (btnId === "next" && month === 11) {
                    year++;
                    month = 0;
                } else {
                    month = btnId === "next" ? month + 1 : month - 1;
                }

                date = new Date(year, month, new Date().getDate());
                year = date.getFullYear();
                month = date.getMonth();

                renderCalendar();
            });
        });

        renderCalendar();
    </script>
</body>
</html>
