<?php

include "../../connect.php";

session_start();

$coachData = [];

$sql = "SELECT * FROM `hccoachapp` WHERE `hccoachapp`.`type`='coach'";
$result = mysqli_query($conn, $sql);
$result_check = mysqli_num_rows($result);
if ($result_check > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $coachID = $row['coachID'];
    $coachID = explode("|", $coachID);
    if ($coachID[0] == $_SESSION['type'] || $_SESSION['type'] == "all") {
      $positions = ["First", "Second", "Third", "Fourth"];
      $capacities = ["Empty", "Not Full", "Full"];
      if ($coachID[0] != "Shuttle") { $data['coachID'] = join("", $coachID); } else { $data['coachID'] = $coachID[0]; }
      $data['coachPosition'] = $positions[$row['coachPosition']];
      $data['coachCapacity'] = $capacities[$row['coachCapacity']];
      $data['coachStatus'] = $row['coachStatus'];
      $data['coachRelTime'] = $row['coachRelTime'];

      if ($data['coachStatus'] != "On Standby") {
        array_push($coachData, $data);
      }
    }
  }
}

if (sizeof($coachData) > 0) {
  if ($_SESSION['type'] != "all") {
    echo "<h3>Here are all of the ".$_SESSION['type']." Coaches</h3>";
  } else {
    echo "<h3>Here are all of the coaches</h3>";
  }
?>
  <div class="table-container">
    <table>
      <tr>
        <th>Coach ID</th>
        <th>Coach Position</th>
        <th>Coach Capacity</th>
        <th>Coach Direction</th>
        <th>Coach Status</th>
      </tr>
      <?php
        foreach ($coachData as $key => $value) {
      ?>
        <tr>
          <?php
            foreach ($value as $key => $value) {
          ?>
            <td><?php echo $value; ?></td>
          <?php
            }
          ?>
        </tr>
      <?php
        }
      ?>
    </table>
  </div>
<?php } else {
  echo "<h3>There are no active ".$_SESSION['type']." Coaches</h3>";
}

?>
<?php

include "../../connect.php";

session_start();

$coachData = [];

$sql = "SELECT * FROM `hccoachapp` WHERE `hccoachapp`.`type`='coach'";
$result = mysqli_query($conn, $sql);
$result_check = mysqli_num_rows($result);
if ($result_check > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $coachID = $row['coachID'];
    $coachID = explode("|", $coachID);
    if ($coachID[0] == $_SESSION['type'] || $_SESSION['type'] == "all") {
      $positions = ["First", "Second", "Third", "Fourth"];
      $capacities = ["Empty", "Not Full", "Full"];
      if ($coachID[0] != "Shuttle") { $data['coachID'] = join("", $coachID); } else { $data['coachID'] = $coachID[0]; }
      $data['coachPosition'] = $positions[$row['coachPosition']];
      $data['coachCapacity'] = $capacities[$row['coachCapacity']];
      $data['coachStatus'] = $row['coachStatus'];
      $data['coachRelTime'] = $row['coachRelTime'];

      if ($data['coachStatus'] != "On Standby") {
        array_push($coachData, $data);
      }
    }
  }
}

if (sizeof($coachData) > 0) {
  if ($_SESSION['type'] != "all") {
    echo "<h3>Here are all of the ".$_SESSION['type']." Coaches</h3>";
  } else {
    echo "<h3>Here are all of the coaches</h3>";
  }
?>
  <div class="table-container">
    <table>
      <tr>
        <th>Coach ID</th>
        <th>Coach Position</th>
        <th>Coach Capacity</th>
        <th>Coach Direction</th>
        <th>Coach Status</th>
      </tr>
      <?php
        foreach ($coachData as $key => $value) {
      ?>
        <tr>
          <?php
            foreach ($value as $key => $value) {
          ?>
            <td><?php echo $value; ?></td>
          <?php
            }
          ?>
        </tr>
      <?php
        }
      ?>
    </table>
  </div>
<?php } else {
  echo "<h3>There are no active ".$_SESSION['type']." Coaches</h3>";
}

?>
