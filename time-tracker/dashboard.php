<?php

session_start();

// check session
if (!$_SESSION) {
    header("location: index.php");
}

include_once("inc/db.php");
include_once("inc/util.php");

$userId = $_SESSION['user']['id'];
$rows = getEntriesByUser($userId);

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
        <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12">
            <img src="img/logo.png" class="card-img-top" alt="Time-Tracker Logo" style="width: 300px;">
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link disabled" href="dashboard.php" tabindex="1">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="projects.php" tabindex="2">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=logout" tabindex="3">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="row" style="padding: 10px;">
        <div class="col-lg-8 col-md-8 col-sm-8 pull-left"><h3>Dashboard</h3></div>
        <div class="col-lg-4 col-md-4 col-sm-4 pull-right"><button type="button" class="btn btn-primary">Add New Entry</button></div>
    </div>

<?php

if (!$rows) {

?>
    <div class="row" style="padding: 10px;">
        <div class="col-lg-12 col-md-12 col-sm-12">No time entries found! <button type="button" class="btn btn-link">Add New Entry</button></div>
    </div>
<?php

} else {

?>
    <div class="row list border-top" style="padding: 10px;">
        <div class="col-lg-1 col-md-1 col-sm-2"><strong>#</strong></div>
        <div class="col-lg-2 col-md-2 col-sm-5"><strong>Date</strong></div>
        <div class="col-lg-1 col-md-1 col-sm-5"><strong>Duration</strong></div>
        <div class="col-lg-4 col-md-4 col-sm-12"><strong>Notes</strong></div>
        <div class="col-lg-4 col-md-4 col-sm-12"><strong>Project</strong></div>
    </div>
<?php

while($row = $rows->fetch_assoc()) {
    $projectName = $row['project_name'] ? $row['project_name'] : 'No project';
    echo '
    <div class="row list border-top" style="padding: 0 10px;">
        <div class="col-lg-1 col-md-1 col-sm-2">'. $row['id'] .'</div>
        <div class="col-lg-2 col-md-2 col-sm-5">'. $row['date'] .'</div>
        <div class="col-lg-1 col-md-1 col-sm-5">'. $row['duration'] .'m</div>
        <div class="col-lg-4 col-md-4 col-sm-12">'. $row['notes'] .'</div>
        <div class="col-lg-4 col-md-4 col-sm-12">'. $projectName .'</div>
    </div>
        ';
    }
}
?>
    <!-- footer -->
    <div class="row footer border-top">
            <div class="col-lg-12 col-md-12 col-sm-12 text-center">Time-Tracker App, by Leo Vallejos - 2019</div>
    </div>
    <!-- /footer -->
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
