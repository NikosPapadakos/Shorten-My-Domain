<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shorten My Domain</title>
    <link rel="icon" href="./styles/icon.png" type="image/icon type">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <ul class="nav">
        <li class="nav-item p-3">
            <a class="nav-link active" id="admin" href="http://localhost/smd/login.php">Are you an Admin? Log in!</a>
        </li>
    </ul>
    <main>
        <div class="container-fluid">
            <header>
                <div class="row ">
                    <div class="col-md-12 mb-5">
                        <h1 id="head">Shorten My Domain</h1>
                    </div>
                </div>
            </header>
            <div class="row justify-content-center ">
                <div class="col-8">
                    <div class="input-group" id="delete-msg">
                        <div class="input-group-prepend">
                            <div class="input-group-text btn btn-primary">URL</div>
                        </div>
                        <input type="text" class="form-control" id="url" placeholder="Enter URL to be shortened ">
                        <div class="input-group-append">
                            <button id="create" class="btn btn-primary" type="button" id="shorten">Shorten!</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center text-center mt-5">
                <div class="col-5 " id="expiry">
                    <label class="form-label" id="range" for="slider">Available for:</label>
                    <div class="range">
                        <input type="range" class="form-range" min="0" max="4" value="2" id="slider" />
                        <h1 class="output">1 day</h1>
                        <div class="btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary">
                                <input type="checkbox" id="renew" checked autocomplete="off"> Renewable
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-6" id="message">

                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 text-center ">
                    <h3>Active Links:</h3>
                    <h1 id='active' class="text-success"></h1>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src=".\scripts\index.js"></script>

</body>

</html>