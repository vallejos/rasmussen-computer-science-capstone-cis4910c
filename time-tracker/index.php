<?php

session_start();

include_once("inc/db.php");
include_once("inc/util.php");

$username = $_POST["username"];
$password = $_POST["password"];
$errorMessage = "";

if ($_GET["action"] == "logout") {
    session_unset(); 
    session_destroy();
    $errorMessage = "Successfully logged out.";
    $msgClass = "success";
} else if ($username && $password) {
    $user = getUser($username, $password);

    if ($user) {
        // all good

        // save user information to session
        $_SESSION['user'] = $user;

        // go to dashboard
        header("location: dashboard.php");
    } else {
        // error
        $errorMessage = "Incorrect credentials. Please try again.";
        $msgClass = "danger";
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- custom css -->
    <link rel="stylesheet" href="app.css">

    <title>Time-Tracker</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-2 col-sm-12 col-sm-12"></div>
        <div class="col-lg-6 col-md-8 col-sm-12 col-sm-12">
            <div class="card mx-auto" style="margin-top: 20%;">
                <img src="img/logo.png" class="card-img-top" alt="Time-Tracker Logo" style="margin: 30px auto; width: 90% !important;">
                <div class="card-body">
                    <div class="alert alert-<?=$msgClass?>" role="alert">
                        <?php echo $errorMessage;?>
                    </div>
                    <h5 class="card-title">Sign In</h5>
                    <form action="index.php" method="post">
                        <div class="form-group">
                            <label for="inputUsername">Username</label>
                            <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-2 col-sm-12 col-sm-12"></div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
