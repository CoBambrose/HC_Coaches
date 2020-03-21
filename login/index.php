<?php

include '../connect.php';
session_start();

$_SESSION['logged'] = false;
$_SESSION['uid'] = '';

if (isset($_GET['roleRequest'])) {
  $_SESSION['roleRequest'] = $_GET['roleRequest'];
  $displayRole = ucfirst($_SESSION['roleRequest']);
} else if (isset($_SESSION['roleRequest'])) {
  $displayRole = ucfirst($_SESSION['roleRequest']);
} else {
  header("Location: ../app/");
  echo "<script>document.location.href = '../app/';";
} if (isset($_POST['uid'])) {
  $valid = false;
  $sql = "SELECT * FROM `hccoachapp` WHERE `hccoachapp`.`type` = '".$_SESSION['roleRequest']."';";
  $result = mysqli_query($conn, $sql);
  $result_check = mysqli_num_rows($result);
  if ($result_check > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['uid'] == $_POST['uid'] && $row['pwd'] == md5($_POST['pwd'])) {
        $valid = true;
        $_SESSION['logged'] = true;
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['role'] = $_SESSION['roleRequest'];
      }
    }
  }
  if ($valid) {
    echo "<script>document.location.href = '../app/".$_SESSION['role']."/'</script>";
  } else {
    echo "<script>document.location.href = './?role=".$_SESSION['roleRequest']."&error=Wrong username or password.'</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/master.css">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="icon" href="../assets/hc_logo.png">
  <script type="text/javascript" src="../js/app.js"></script>
  <title>HC Coaches | Login</title>
</head>
<body>
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
    <h2>Log In as <?php echo $displayRole; ?></h2>
  </div>
  <form action="./" method="post">
    <input type="text" name="uid" placeholder="Your Username" />
    <input type="password" name="pwd" placeholder="Your Password" />
    <input type="submit" value="Log In" />
    <button type="button" name="button" onclick="document.location.href = '../app/'">Go Back</button>
  </form>
</body>
</html>
<?php

include '../connect.php';
session_start();

$_SESSION['logged'] = false;
$_SESSION['uid'] = '';

if (isset($_GET['roleRequest'])) {
  $_SESSION['roleRequest'] = $_GET['roleRequest'];
  $displayRole = ucfirst($_SESSION['roleRequest']);
} else if (isset($_SESSION['roleRequest'])) {
  $displayRole = ucfirst($_SESSION['roleRequest']);
} else {
  header("Location: ../app/");
  echo "<script>document.location.href = '../app/';";
} if (isset($_POST['uid'])) {
  $valid = false;
  $sql = "SELECT * FROM `hccoachapp` WHERE `hccoachapp`.`type` = '".$_SESSION['roleRequest']."';";
  $result = mysqli_query($conn, $sql);
  $result_check = mysqli_num_rows($result);
  if ($result_check > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['uid'] == $_POST['uid'] && $row['pwd'] == md5($_POST['pwd'])) {
        $valid = true;
        $_SESSION['logged'] = true;
        $_SESSION['uid'] = $row['uid'];
        $_SESSION['role'] = $_SESSION['roleRequest'];
      }
    }
  }
  if ($valid) {
    echo "<script>document.location.href = '../app/".$_SESSION['role']."/'</script>";
  } else {
    echo "<script>document.location.href = './?role=".$_SESSION['roleRequest']."&error=Wrong username or password.'</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/master.css">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="icon" href="../assets/hc_logo.png">
  <script type="text/javascript" src="../js/app.js"></script>
  <title>HC Coaches | Login</title>
</head>
<body>
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
    <h2>Log In as <?php echo $displayRole; ?></h2>
  </div>
  <form action="./" method="post">
    <input type="text" name="uid" placeholder="Your Username" />
    <input type="password" name="pwd" placeholder="Your Password" />
    <input type="submit" value="Log In" />
    <button type="button" name="button" onclick="document.location.href = '../app/'">Go Back</button>
  </form>
</body>
</html>
