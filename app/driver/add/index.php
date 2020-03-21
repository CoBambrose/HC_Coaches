<?php

include '../../../connect.php';
session_start();

function redirectScript($redirectURL) {
  echo "<script>document.location.href = '".$redirectURL."';</script>";
}

if (
  !isset($_SESSION['logged']) ||
  !$_SESSION['logged'] ||
  !isset($_SESSION['role']) ||
  ($_SESSION['role'] != 'driver' && !$_SESSION['driverSim'])
) {
  redirectScript("../?error=An error occurred when trying to perform the desired action. Please use the GUI provided in order to perform these actions");
}

if (isset($_POST['submit'])) {
  $sql = "INSERT INTO `hccoachapp` (`type`, `coachID`, `coachDriver`, `coachPosition`, `coachCapacity`, `coachStatus`, `coachRelTime`) VALUES ('coach', ".json_encode($_POST['coachID']).", ".json_encode($_SESSION['uid']).", ".$_POST['coachPosition'].", ".$_POST['coachCapacity'].", ".json_encode($_POST['coachStatus']).", ".json_encode($_POST['coachRelTime']).");";
  $result = mysqli_query($conn, $sql);
  redirectScript("../");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="../../../assets/hc_logo.png">
  <link rel="stylesheet" href="../../../css/driver-add.css">
  <script src="../../../js/app.js"></script>
  <title>HC Coaches | Add Coach</title>
</head>
<body>
  <div class="content">
    <h1>Add New Coach</h1>
    <form action="./" method="post">

      <p>Driver (You): </p>
      <span><?php echo $_SESSION['uid']; ?></span>

      <p>Coach ID</p>
      <select name="coachID">
        <option value="W|1">W 1</option>
        <option value="W|2">W 2</option>
        <option value="W|3">W 3</option>
        <option value="W|4">W 4</option>
        <option value="W|5">W 5</option>
        <option value="W|6">W 6</option>
        <option value="W|7">W 7</option>
        <option value="W|8">W 8</option>
        <option value="W|9">W 9</option>
        <option value="W|10">W 10</option>
        <option value="W|11">W 11</option>
        <option value="W|12">W 12</option>
        <option value="W|13">W 13</option>
        <option value="W|14">W 14</option>
        <option value="F|1">F 1</option>
        <option value="F|2">F 2</option>
        <option value="F|3">F 3</option>
        <option value="F|4">F 4</option>
        <option value="F|5">F 5</option>
        <option value="F|6">F 6</option>
        <option value="F|7">F 7</option>
        <option value="F|8">F 8</option>
        <option value="F|9">F 9</option>
        <option value="F|10">F 10</option>
        <option value="Shuttle">Shuttle</option>
      </select>

      <p>Ordinal Position:</p>
      <select name="coachPosition">
        <option value="0" selected>First</option>
        <option value="1">Second</option>
        <option value="2">Third</option>
        <option value="3">Fourth</option>
      </select>

      <p>Capacity Status:</p>
      <select name="coachCapacity">
        <option value="0">Empty</option>
        <option value="1" selected>Partially Full</option>
        <option value="2">Full</option>
      </select>

      <p>Coach Direction:</p>
      <select name="coachStatus">
        <option value="Outbound">Outbound</option>
        <option value="Inbound" selected>Inbound</option>
        <option value="On Standby">On Standby</option>
      </select>

      <p>Time Status:</p>
      <select name="coachRelTime">
        <option value="Early">Early</option>
        <option value="On Time" selected>On Time</option>
        <option value="Late">Late</option>
        <option value="Cancelled">Cancelled</option>
      </select>

      <input type="submit" name="submit" value="Add Coach" />

    </form>
  </div>
  <button onclick="document.location.href='../'">Go Back</button>
</body>
</html>
