<?php

include '../../connect.php';
session_start();

if (!$_SESSION['logged']) {
  echo "<script>document.location.href = '../../login/?error=Please log in before trying to access this page.'</script>";
} else if ($_SESSION['role'] == "manager") {
  echo "<script>document.location.href = '../../login/?error=You are logged in as a manager, please relog as a driver before accessing this page.'</script>";
}

$openCoaches = [];

$sql = "SELECT * FROM `hccoachapp` WHERE `coachDriver` LIKE '".$_SESSION['uid']."'";
$result = mysqli_query($conn, $sql);
$result_check = mysqli_num_rows($result);
if ($result_check > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $newRow = [];

    $id = $row['id'];
    if (explode("|", $row['coachID'])[0] == "W" || explode("|", $row['coachID'])[0] == "F") {
      $coachID = join("", explode("|", $row['coachID']));
    } else {
      $coachID = explode("|", $row['coachID']);
      $coachID = $row['coachStatus']." ".$coachID[0];
    }
    $coachDriver = $row['coachDriver'];
    $coachStatus = $row['coachStatus'];
    $coachPosition = ($row['coachPosition']+1).substr(date('jS', mktime(0,0,0,1,($row['coachPosition']+1%10==0?9:($row['coachPosition']+1%100>20?$row['coachPosition']+1%10:$row['coachPosition']+1%100)),2000)),-2);
    $coachCapacity = $row['coachCapacity'];
    $coachRelTime = $row['coachRelTime'];

    $newCoach = [
      'id' => $id,
      'coachID' => $coachID,
      'coachDriver' => $coachDriver,
      'coachStatus' => $coachStatus,
      'coachPosition' => $coachPosition,
      'coachCapacity' => $coachCapacity,
      'coachRelTime' => $coachRelTime
    ];

    array_push($openCoaches, $newCoach);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../css/master.css">
  <link rel="stylesheet" href="../../css/driver.css">
  <link rel="icon" href="../../assets/hc_logo.png">
  <script type="text/javascript" src="../../js/app.js"></script>
  <title>HC Coaches | Drivers</title>
</head>
<body>
  <div class="ambr3" onclick="document.location.href='http://ambr3.com';">
    <img src="../../assets/ambr3.png" alt="Ambr3 Logo" />
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
    <img src="../../assets/hc_logo.png" alt="HC Logo">
    <h1>HC Coaches</h1>
    <h2>Driver Area</h2>
  </div>
  <div class="content">
    <button onclick="driverAction('add');">Add new coach</button>
    <button onclick="driverAction('load');">Load coach</button>
    <button onclick="driverAction('remove');">Remove coach</button>
    <button onclick="driverAction('logout');">Log Out</button>
    <select name="loadCoach" size="10">
      <option value="" default>Select the coach that you wish to load</option>
      <?php for ($i = 0; $i < sizeof($openCoaches); $i++) { $c = $openCoaches[$i]; ?>
        <option value="<?php echo $c['id'] ?>">
          <?php echo $c['coachID']." (".$c['coachPosition'].")".": ".$c['coachStatus'] ?>
        </option>
      <?php } ?>
    </select>
  </div>
</body>
</html>
