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
    <link rel="stylesheet" href="quality.css">
    <link rel="stylesheet" href="main.css">
    <title>Quality Check - Tea Quality App</title>

</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="inventory.php">Inventory</a></li>
                <li><a href="supply.php">Supply</a></li>
                <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Prediction</a>
                <div class="dropdown-content">
                    <a href="weight.php">Weight Prediction</a>
                    <a href="sales.php">Sales Prediction</a>
                </div>
            </li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="content">
            <h1>Tea Leaf Quality Check</h1>
            <p>Scan the tea leaf to check its quality:</p>
            <div id="webcam-container"></div>
            <div id="label-container"></div>
            <button type="button" onclick="initQualityModel()">Start Quality Check</button>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
    <script type="text/javascript">
        const QUALITY_MODEL_URL = "./quality_model/";
        
        let model, webcam, labelContainer, maxPredictions;

        async function initQualityModel() {
            const modelURL = QUALITY_MODEL_URL + "model.json";
            const metadataURL = QUALITY_MODEL_URL + "metadata.json";

            model = await tmImage.load(modelURL, metadataURL);
            maxPredictions = model.getTotalClasses();

            const flip = true; // whether to flip the webcam
            webcam = new tmImage.Webcam(500, 500, flip); // width, height, flip
            await webcam.setup(); // request access to the webcam
            await webcam.play();
            window.requestAnimationFrame(loop);

            document.getElementById("webcam-container").appendChild(webcam.canvas);
            labelContainer = document.getElementById("label-container");
            for (let i = 0; i < maxPredictions; i++) {
                labelContainer.appendChild(document.createElement("div"));
            }
        }

        async function loop() {
            webcam.update(); // update the webcam frame
            await predict();
            window.requestAnimationFrame(loop);
        }

        async function predict() {
            const prediction = await model.predict(webcam.canvas);
            for (let i = 0; i < maxPredictions; i++) {
                const classPrediction = prediction[i].className + ": " + prediction[i].probability.toFixed(2);
                labelContainer.childNodes[i].innerHTML = classPrediction;
            }
        }
    </script>
</body>
</html>
