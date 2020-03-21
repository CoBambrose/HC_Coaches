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

if (isset($_GET['mode']) && $_GET['mode'] == 'update') {
  $sql = "UPDATE `hccoachapp` SET `".$_GET['field']."` = '".$_GET['data']."' WHERE `hccoachapp`.`id` = ".$_GET['id'].";";
  $result = mysqli_query($conn, $sql);
  redirectScript("./?id=".$_GET['id']);
}

$coachData = [];
$sql = "SELECT * FROM `hccoachapp` WHERE `id` = ".$_GET['id'];
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    if ($row['coachDriver'] != $_SESSION['uid']) {
      redirectScript("../driver/?error=The desired action cannot be performed due to insufficient permission.");
    } else {
      $coachData = $row;
    }
  }
}
$capacities = ["Empty", "Partially full", "Full"];
$positions = ["First", "Second", "Third", "Fourth"];
$coachData['coachCapacity'] = $capacities[$coachData['coachCapacity']];
$coachData['coachPosition'] = $positions[$coachData['coachPosition']];

$coachData['coachID'] = explode("|", $coachData['coachID']);
if ($coachData['coachID'][0] == "W" || $coachData['coachID'][0] == "F") {
  $coachData['coachID'] = join(" ", $coachData['coachID']);
} else {
  $coachData['coachID'] = $coachData['coachStatus']." ".$coachData['coachID'][0];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="../../../assets/hc_logo.png">
  <link rel="stylesheet" href="../../../css/driver-manage.css">
  <script src="../../../js/app.js"></script>
  <script type="text/javascript">
    let id=<?php echo $_GET['id']; ?>;
  </script>
  <title>HC Coaches | Manage Coach</title>
</head>
<body>
  <button onclick="document.location.href='../'">Go Back</button>
  <div class="content">
    <h1>Manage Coach: <?php echo $coachData['coachID']; ?></h1>

    <p>Driver (You):</p>
      <span id="first"><?php echo $coachData['coachDriver'] ?></span>
    <p>Ordinal Position:</p>
      <span><?php echo $coachData['coachPosition'] ?></span>
      <button onclick="updateData('coachPosition')">Change</button>
    <p>Capacity Status:</p>
      <span><?php echo $coachData['coachCapacity'] ?></span>
      <button onclick="updateData('coachCapacity')">Change</button>
    <p>Coach Direction:</p>
      <span><?php echo $coachData['coachStatus'] ?></span>
      <button onclick="updateData('coachStatus')">Change</button>
    <p>Time Status:</p>
      <span><?php echo $coachData['coachRelTime'] ?></span>
      <button onclick="updateData('coachRelTime')">Change</button>

    <div class="change">
      <div class="coachPosition">
        <h2>Change Ordinal Position</h2>
        <select name="coachPosition">
          <option value="0">First</option>
          <option value="1">Second</option>
          <option value="2">Third</option>
          <option value="3">Fourth</option>
        </select>
        <button onclick="submitUpdateData()">Change</button>
      </div>
      <div class="coachCapacity">
        <h2>Change Capacity Status</h2>
        <select name="coachCapacity">
          <option value="0">Empty</option>
          <option value="1">Partially Full</option>
          <option value="2">Full</option>
        </select>
        <button onclick="submitUpdateData()">Change</button>
      </div>
      <div class="coachStatus">
        <h2>Change Coach Direction</h2>
        <select name="coachStatus">
          <option value="Outbound">Outbound</option>
          <option value="Inbound">Inbound</option>
          <option value="On Standby">On Standby</option>
        </select>
        <button onclick="submitUpdateData()">Change</button>
      </div>
      <div class="coachRelTime">
        <h2>Change Time Status</h2>
        <select name="coachRelTime">
          <option value="Early">Early</option>
          <option value="On Time">On Time</option>
          <option value="Late">Late</option>
          <option value="Cancelled">Cancelled</option>
        </select>
        <button onclick="submitUpdateData()">Change</button>
      </div>
    </div>
  </div>
</body>
</html>
