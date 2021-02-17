<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Expired</title>
    <link rel="icon" href="./styles/icon.png" type="image/icon type">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/urlExpired.css">
    <script src="./scripts/count.js"></script>
</head>

<body>
    <h1>This URL has expired or has been disabled! Redirecting you to homepage in <span class="countdown">3</span>.</h1>
</body>

</html>
<?php
header("Refresh: 3; http://localhost/smd/index.php");
?>