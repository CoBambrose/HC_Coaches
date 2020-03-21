<?php
  session_start();

  if (!$_SESSION['logged'] || $_SESSION['role'] == 'driver') {
    echo "<script>document.location.href = '../../login/?roleRequest=manager&error=Please log in as a manager before trying to access this page.'</script>";
  }

  $_SESSION['type']="all";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../css/master.css">
  <link rel="stylesheet" href="../../css/manager.css">
  <script src="../../js/app.js"></script>
  <title>HC Coaches | Manager's Area</title>
</head>
<body>
  <div class="actions">
    <button onclick="managerAction('drivers')">Manage Driver Logins</button>
    <button onclick="managerAction('coaches')">Manage Coaches</button>
    <button onclick="managerAction('spectate')">Spectate Coaches</button>
    <button onclick="managerAction('logout')">Log Out</button>
  </div>
</body>
</html>
