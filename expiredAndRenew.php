<?php
session_start();
$origin = $_SESSION['original'];
$newDate = $_SESSION['expiration_date'];
session_unset();
session_destroy();
 
 header("Refresh: 3;".$origin);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="./styles/icon.png" type="image/icon type">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/urlExpired.css">
    <script src="./scripts/count.js"></script>
</head>

<body>

    <div>
        <h1>This url has expired , but was automatically renewed until <?=$newDate;?> </h1>
        <br>
        <h3>Redirecting you to your original destination in <span class="countdown">3</span>.</h2>
    </div>
    
</body>

</html>