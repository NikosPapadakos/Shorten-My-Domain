<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Panel</title>
    <link rel="icon" href="./styles/icon.png" type="image/icon type">
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/login.css">
</head>

<body class=>
    <div class="d-flex">
        <a class="nav-link active" id="back" href="http://localhost/smd/index.php">Back to home page</a>
    </div>
    <main class="container text-center">
        <img class="mb-2" src="./styles/admin.png" alt="" width="130" height="157">
        <h1 class=" mb-3 ">Please sign in</h1>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <label for="inputUsername" class="visually-hidden">Username</label>
                <input type="text" id="inputUsername" class="form-control"
                    value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"
                    placeholder="Username" name="username" autofocus>
                <div id="userFeed" class="bg-warning">
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-4">
                <label for="inputPassword" class="visually-hidden">Password</label>
                <input type="password" id="inputPassword" class="form-control"
                    value="<?php if(isset($_COOKIE["password"])) { echo base64_decode($_COOKIE["password"]); } ?>"
                    placeholder="Password" name="password">
                <div id="passFeed">
                </div>
            </div>
        </div>

        <div class="checkbox mt-2 mb-3">
            <label>
                <input type="checkbox" id="remember" <?= isset($_COOKIE["check"]) ?  $_COOKIE["check"] : ''; ?>>
                Remember me
            </label>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <button class="w-100 btn btn-lg btn-primary" id="btn-log">Sign in</button>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-4" id="message">

            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="./scripts/login.js"></script>
</body>

</html>