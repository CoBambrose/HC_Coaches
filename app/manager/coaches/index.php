<?php
  include '../../../connect.php';
  session_start();

  if (!$_SESSION['logged'] || $_SESSION['role'] == 'driver') {
    echo "<script>document.location.href = '../../login/?roleRequest=manager&error=Please log in as a manager before trying to access this page.'</script>";
  }

  $coaches = [];
  $sql = "SELECT * FROM `hccoachapp` WHERE `type` = 'coach'";
  $result = mysqli_query($conn, $sql);
  $result_check = mysqli_num_rows($result);
  if ($result_check > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $newRow = [];
      foreach ($row as $key => $val) {
        if ($key != "coachID") { $newRow[$key] = $val; }
        else {
          $val = explode("|", $val);
          if ($val[0] == "Shuttle") {
            $val = $row['coachStatus']." ".$val[0];
          } else {
            $val = "".join($val);
          }
          $newRow[$key] = $val;
        }
      }
      array_push($coaches, $newRow);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../../css/master.css">
  <link rel="stylesheet" href="../../../css/manager-coaches.css">
  <script src="../../../js/app.js"></script>
  <title>HC Coaches | Manage Coaches | Manager's Area</title>
</head>
<body>
  <form class="manager-coaches" method="post" action="./">
    <h1>Manage Coaches</h1>
    <p>Select Coach:</p>
    <select name="id">
      <option value="">Coach</option>
      <?php foreach ($coaches as $coach) { ?>
        <option value="<?php $coach['id']; ?>"><?php echo $coach['coachID']; ?></option>
      <?php } ?>
    </select>
    <p>Select Action:</p>
    <select name="action">
      <option value="">Action</option>
      <option value="change">Change Coach Data</option>
      <option value="delete">Remove Coach</option>
    </select>
    <button>Submit</button>
  </form>
  <button id="back-button-global" onclick="document.location.href = '../';">Go Back</button>
</body>
</html>
