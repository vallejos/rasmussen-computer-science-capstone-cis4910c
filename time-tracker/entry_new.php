<?php

session_start();

// check session
if (!$_SESSION) {
    header("location: index.php");
}

include_once("inc/db.php");
include_once("inc/util.php");

$userId = $_SESSION['user']['id'];

if (!$userId) {
    $errorMessage = "There was an error. Please try again.";
}

if ($_POST) {
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $projectId = $_POST['project'];
    $notes = $_POST['notes'];

    if (addEntry($userId, $date, $duration, $notes, $projectId)) {
        header("location: dashboard.php");
    } else {
        $errorMessage = "There was an error. Please try again.";
    }

} else {
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

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <img src="img/logo.png" class="card-img-top" alt="Time-Tracker Logo" style="width: 300px;">

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
        <div class="col-lg-12 col-md-12 col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New Time Entry</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="alert alert-<?=$msgClass?>" role="alert">
        <?php echo $errorMessage;?>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form action="entry_new.php" method="post">
                <div class="form-group">
                    <label for="inputDate">Date</label>
                    <input type="text" class="form-control" id="inputDate" name="date" placeholder="Enter a Name YYYY-MM-DD" required="true">
                </div>
                <div class="form-group">
                    <label for="inputDuration">Duration</label>
                    <input type="text" class="form-control" id="inputDuration" name="duration" placeholder="Enter Duration (in minutes)" required="true">
                </div>
                <div class="form-group">
                    <label for="inputProject">Project</label>
                    <select id="inputProject" name="project" class="form-control">
                        <option value="">No Project</option>
<?php
$rows = getProjects($userId);
while($row = $rows->fetch_assoc()) {
    echo '
        <option value="'. $row['id'] .'">'. $row['name'] .'</option>
    ';
}
?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputNote">Notes</label>
                    <input type="text" class="form-control" id="inputNote" name="notes" placeholder="Enter any Note" maxlength="200">
                </div>
                <button onclick='window.open("dashboard.php", "_top");'  type="button" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>

        </div>
    </div>

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
