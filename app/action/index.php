<?php

include '../../connect.php';
session_start();

function redirectScript($redirectURL) {
  echo "<script>document.location.href = '".$redirectURL."';</script>";
}

// exit conditions
if (
  !isset($_SESSION['logged']) ||
  !$_SESSION['logged'] ||
  !isset($_GET['action']) ||
  ($_GET['action'] == 'load' || $_GET['action'] == 'remove') && !isset($_GET['id'])
) {
  redirectScript("../?error=An error occurred when trying to perform the desired action. Please use the GUI provided in order to perform these actions");
}

if ($_SESSION['role'] == 'driver') {
  $sql = "SELECT (`coachDriver`) FROM `hccoachapp` WHERE `id` LIKE ".$_GET['id'];
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['coachDriver'] != $_SESSION['uid']) {
        redirectScript("../driver/?error=The desired action cannot be performed due to insufficient permission.");
      }
    }
  }
}

// driver actions

if ($_SESSION['role'] == 'driver') {

  if ($_GET['action'] == "add") {
    redirectScript("../driver/add/");
  }

  if ($_GET['action'] == "load") {
    redirectScript("../driver/manage/?id=".$_GET['id']);
  }

  if ($_GET['action'] == "remove") {
    $sql = "DELETE FROM `hccoachapp` WHERE `id` = ".$_GET['id'];
    $result = mysqli_query($conn, $sql);

    redirectScript("../driver/");
  }

}
<?php

include '../../connect.php';
session_start();

function redirectScript($redirectURL) {
  echo "<script>document.location.href = '".$redirectURL."';</script>";
}

// exit conditions
if (
  !isset($_SESSION['logged']) ||
  !$_SESSION['logged'] ||
  !isset($_GET['action']) ||
  ($_GET['action'] == 'load' || $_GET['action'] == 'remove') && !isset($_GET['id'])
) {
  redirectScript("../?error=An error occurred when trying to perform the desired action. Please use the GUI provided in order to perform these actions");
}

if ($_SESSION['role'] == 'driver') {
  $sql = "SELECT (`coachDriver`) FROM `hccoachapp` WHERE `id` LIKE ".$_GET['id'];
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['coachDriver'] != $_SESSION['uid']) {
        redirectScript("../driver/?error=The desired action cannot be performed due to insufficient permission.");
      }
    }
  }
}

// driver actions

if ($_SESSION['role'] == 'driver') {

  if ($_GET['action'] == "add") {
    redirectScript("../driver/add/");
  }

  if ($_GET['action'] == "load") {
    redirectScript("../driver/manage/?id=".$_GET['id']);
  }

  if ($_GET['action'] == "remove") {
    $sql = "DELETE FROM `hccoachapp` WHERE `id` = ".$_GET['id'];
    $result = mysqli_query($conn, $sql);

    redirectScript("../driver/");
  }

}
