<?php
  include '../../../connect.php';
  session_start();

  if (!$_SESSION['logged'] || $_SESSION['role'] == 'driver') {
    echo "<script>document.location.href = '../../login/?roleRequest=manager&error=Please log in as a manager before trying to access this page.'</script>";
  }

  $drivers = [];
  $sql = "SELECT * FROM `hccoachapp` WHERE `type` = 'driver'";
  $result = mysqli_query($conn, $sql);
  $result_check = mysqli_num_rows($result);
  if ($result_check > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      array_push($drivers, [
        "id" => $row['id'],
        "uid" => $row['uid'],
        "pwd" => $row['pwd']
      ]);
    }
  }

  if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $driverID = $_POST['id'];
    $newPWD = $_POST['newPWD'];
    $currentPWD = $_POST['currentPWD'];
    $newUID = $_POST['newUID'];
    $driverData = [];
    foreach ($drivers as $driver) {
      if ($driver['id'] == $driverID) {
        $driverData = $driver;
      }
    }

    if ($action == "verify") {
      if ($driverData['pwd'] == md5($currentPWD)) {
        echo "<script>alert('That is the correct password.');</script>";
      } else {
        echo "<script>alert('That is not the correct password.');</script>";
      }
    } else if ($action == "change") {
      $sql = "UPDATE `hccoachapp` SET `pwd` = '".md5($newPWD)."' WHERE `id` = ".$driverData['id'];
      $result = mysqli_query($conn, $sql);
    } else if ($action == "delete") {
      $coachIDs = [$driverData['id']];
      $sql = "SELECT * FROM `hccoachapp` WHERE `type`='coach' AND `coachDriver`='".$driverData['uid']."'";
      $result = mysqli_query($conn, $sql);
      $result_check = mysqli_num_rows($result);
      if ($result_check > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          array_push($coachIDs, $row['id']);
        }
      }
      foreach ($coachIDs as $coachID) {
        $sql = "DELETE FROM `hccoachapp` WHERE `id`=".$coachID;
        $result = mysqli_query($conn, $sql);
      }
    } else if ($action == "changeUID") {
      $sql = "UPDATE `hccoachapp` SET `uid` = '".$newUID."' WHERE `id` = ".$driverData['id'];
      $result = mysqli_query($conn, $sql);
    }
    header("Location: ./");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../../css/master.css">
  <link rel="stylesheet" href="../../../css/manager-drivers.css">
  <script src="../../../js/app.js"></script>
  <title>HC Coaches | Manage Driver Logins | Manager's Area</title>
</head>
<body>
  <form class="manager-drivers" method="post" action="./">
    <h1>Manage Drivers</h1>
    <p>Driver's Username: </p>
    <select name="id">
      <option value="">Username</option>
      <?php foreach ($drivers as $driver) { ?>
        <option value="<?php echo $driver['id']; ?>"><?php echo $driver['uid'] ?></option>
      <?php } ?>
    </select>
    <p>Your Action: </p>
    <select name="action" onchange="managerDriversAction()">
      <option value="">Action</option>
      <option value="verify">Verify Driver Password</option>
      <option value="change">Change Driver Password</option>
      <option value="delete">Delete Account (and assoc. coaches)</option>
      <option value="changeUID">Change Username</option>
    </select>
    <p style="display:none">Current Password: </p>
    <input style="display:none" type="text" name="currentPWD" placeholder="Password">
    <p style="display:none">New Password: </p>
    <input style="display:none" type="text" name="newPWD" placeholder="Password">
    <p style="display:none">New Username: </p>
    <input style="display:none" type="text" name="newUID" placeholder="Username">
    <button>Submit</button>
  </form>
  <button id="back-button-global" onclick="document.location.href = '../';">Go Back</button>
</body>
</html>
