<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" href="./styles/icon.png" type="image/icon type">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/admin.css">
</head>
<div class="bg"></div>
<body>
    <nav class="navbar navbar-dark bg-dark" aria-label="First navbar example">
        <div class="container-fluid">
            <a class="navbar-brand"><img src="./styles/shorten.png" alt="">Admin Panel</a>
            <nav class="main">
                <li class="nav-item sumA "><span class="first">Active: <span class="countA"> </span><img
                            src="./styles/green.png"></span></li>
                <li class="nav-item sumC"><span class="third">Renewable: <span class="countC"></span><img
                            src="./styles/blue.png"></span></li>
                <li class="nav-item sumB "><span class="second">Inactive: <span class="countB"></span><img
                            src="./styles/red.png"></span></li>
            </nav>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01"
                aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample01">
                <ul class="navbar-nav me-auto mb-2">
                    <li class="nav-item active">
                        <a class="nav-link" id="show-all">Show All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" id="show-active">Show Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" id="show-disabled">Show Expired or Disabled</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="http://localhost/smd/login.php">Logout</a>
                    </li>
                </ul>
                <form>
                    <input id="search" class="form-control" type="text" placeholder="Type anything to search"
                        aria-label="Search">
                </form>
            </div>
        </div>
    </nav>
    <form>
        <table class="table table-striped urls">
            <tr class="color">
                <th>id</th>
                <th>Original URL</th>
                <th>Shortened Code</th>
                <th>Creation Date</th>
                <th>Expiry Date</th>
                <th>Renewable</th>
                <th>Enabled</th>
                <th>Actions</th>
                <tbody id="table">
                </tbody>
            </tr>
        </table>
    </form>



    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Warning!</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this id from the database?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modalDeleteBtn" class="btn btn-danger"
                        data-bs-dismiss="modal">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div id="delModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Success!</h4>
                </div>
                <div class="modal-body">
                    <p>This id has successfully been deleted.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Warning!</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to disable this id?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modalDisBtn" class="btn btn-danger"
                        data-bs-dismiss="modal">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div id="disModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Success!</h4>
                </div>
                <div class="modal-body">
                    <p>This id has successfully been disabled.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Warning!</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to enable this id?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="modalEnBtn" class="btn btn-danger"
                        data-bs-dismiss="modal">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div id="enModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Success!</h4>
                </div>
                <div class="modal-body">
                    <p>This id has successfully been enabled.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="./scripts/admin.js"></script>
</body>

</html>