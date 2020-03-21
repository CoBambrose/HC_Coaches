<?php

session_start();

if (isset($_GET['coachType'])) {
  $_SESSION['type']=$_GET['coachType'];
  header("Location: ./app/");
}

$_SESSION['logged'] = false;
$_SESSION['uid'] = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./css/master.css">
  <link rel="stylesheet" href="./css/portal.css">
  <link rel="icon" href="./assets/hc_logo.png">
  <script type="text/javascript" src="./js/app.js"></script>
  <title>HC Coaches | Portal</title>
</head>
<body>
  <div class="ambr3" onclick="document.location.href='http://ambr3.com';">
    <img src="./assets/ambr3.png" alt="Ambr3 Logo" />
    <p>Developed By <strong>Ambr3 Ltd</strong></p>
  </div>
  <?php
  if (isset($_GET['error'])) {
  ?>
  <div class="error">
    <h3>Error</h3>
    <p><?php echo $_GET['error']; ?></p>
    <span onclick="document.getElementsByClassName('error')[0].style.animation = 'slide-up ease-out forwards 500ms';">X</span>
  </div>
  <?php } ?>
  <div class="header">
    <img src="./assets/hc_logo.png" alt="HC Logo">
    <h1>HC Coaches</h1>
    <h2>Portal</h2>
  </div>
  <div class="content">
    <button onclick="document.location.href='./?coachType=F'">Furnace Ln</button>
    <button onclick="document.location.href='./?coachType=W'">Whittingham Rd</button>
    <button onclick="document.location.href='./?coachType=Shuttle'">Campus Shuttles</button>
  </div>
</body>
</html>
<?php

session_start();

if (isset($_GET['coachType'])) {
  $_SESSION['type']=$_GET['coachType'];
  header("Location: ./app/");
}

$_SESSION['logged'] = false;
$_SESSION['uid'] = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./css/master.css">
  <link rel="stylesheet" href="./css/portal.css">
  <link rel="icon" href="./assets/hc_logo.png">
  <script type="text/javascript" src="./js/app.js"></script>
  <title>HC Coaches | Portal</title>
</head>
<body>
  <div class="ambr3" onclick="document.location.href='http://ambr3.com';">
    <img src="./assets/ambr3.png" alt="Ambr3 Logo" />
    <p>Developed By <strong>Ambr3 Ltd</strong></p>
  </div>
  <?php
  if (isset($_GET['error'])) {
  ?>
  <div class="error">
    <h3>Error</h3>
    <p><?php echo $_GET['error']; ?></p>
    <span onclick="document.getElementsByClassName('error')[0].style.animation = 'slide-up ease-out forwards 500ms';">X</span>
  </div>
  <?php } ?>
  <div class="header">
    <img src="./assets/hc_logo.png" alt="HC Logo">
    <h1>HC Coaches</h1>
    <h2>Portal</h2>
  </div>
  <div class="content">
    <button onclick="document.location.href='./?coachType=F'">Furnace Ln</button>
    <button onclick="document.location.href='./?coachType=W'">Whittingham Rd</button>
    <button onclick="document.location.href='./?coachType=Shuttle'">Campus Shuttles</button>
  </div>
</body>
</html>
