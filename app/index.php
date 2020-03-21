<?php

session_start();

if (!isset($_SESSION['type'])) {
  if (isset($_GET['error'])) {
    $addon = "?error=".$_GET['error'];
  }
  header("Location: ../".$addon);
  echo "<script>document.location.href='../".$addon."'</script>";
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
  <link rel="stylesheet" href="../css/master.css">
  <link rel="stylesheet" href="../css/app.css">
  <link rel="icon" href="../assets/hc_logo.png">
  <script type="text/javascript" src="../js/app.js"></script>
  <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"
  ></script>
  <script type="text/javascript">
    let coachType = <?php echo json_encode($_SESSION['type']); ?>;
  </script>
  <title>HC Coaches | Coach Tables</title>
</head>
<body onload="initApp()">
  <div class="ambr3" onclick="document.location.href='http://ambr3.com';">
    <img src="../assets/ambr3.png" alt="Ambr3 Logo" />
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
    <img src="../assets/hc_logo.png" alt="HC Logo">
    <h1>HC Coaches</h1>
    <h2>Find your coach</h2>
  </div>
  <div class="nav">
    <a href="../">Reselect Coach Type</a>
    <a href="../login?roleRequest=driver">Driver Login</a>
    <a href="../login?roleRequest=manager">Managers Login</a>
  </div>
  <div class="coach-table">

  </div>
</body>
</html>
<?php

session_start();

if (!isset($_SESSION['type'])) {
  if (isset($_GET['error'])) {
    $addon = "?error=".$_GET['error'];
  }
  header("Location: ../".$addon);
  echo "<script>document.location.href='../".$addon."'</script>";
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
  <link rel="stylesheet" href="../css/master.css">
  <link rel="stylesheet" href="../css/app.css">
  <link rel="icon" href="../assets/hc_logo.png">
  <script type="text/javascript" src="../js/app.js"></script>
  <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"
  ></script>
  <script type="text/javascript">
    let coachType = <?php echo json_encode($_SESSION['type']); ?>;
  </script>
  <title>HC Coaches | Coach Tables</title>
</head>
<body onload="initApp()">
  <div class="ambr3" onclick="document.location.href='http://ambr3.com';">
    <img src="../assets/ambr3.png" alt="Ambr3 Logo" />
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
    <img src="../assets/hc_logo.png" alt="HC Logo">
    <h1>HC Coaches</h1>
    <h2>Find your coach</h2>
  </div>
  <div class="nav">
    <a href="../">Reselect Coach Type</a>
    <a href="../login?roleRequest=driver">Driver Login</a>
    <a href="../login?roleRequest=manager">Managers Login</a>
  </div>
  <div class="coach-table">

  </div>
</body>
</html>
