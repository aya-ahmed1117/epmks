<?php
require_once("inc/config.inc");
include("pages.php");

$self = $_SESSION['id'];
$role_id = $_SESSION['role_id'];
$s_username = $_SESSION['username'];
$sqltime = date("Y-m-d H:i:s");

$name = isset($_POST['name']) ? $_POST['name'] : "";
$id_leave = isset($_POST['Request_ID']) ? $_POST['Request_ID'] : "";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Delete Record</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <style>
    .signup-form {
      width: 70%;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      border-radius: 10px;
    }
    .signup-form input,
    .signup-form select,
    .signup-form button {
      margin-bottom: 20px;
    }
    .table thead th {
      background-color: #3b6879;
      color: white;
      font-size: 14px;
    }
    .table tbody td {
      font-size: 14px;
    }
  </style>
</head>
<body>

<div class="signup-form">
  <div class="mb-3 d-flex justify-content-between align-items-center">
    <h4 class="text-primary"><img src="imag/helpdesk-icon-png-11.jpg" style="width:40px;"> Delete Record</h4>
    <a href="ticketing_updates.php" class="btn btn-outline-secondary">
      <i class="fas fa-ticket-alt"></i> Go Back
    </a>
  </div>
  <form method="post">
    <div class="mb-3">
      <label>Select Table and ID:</label>
      <div class="d-flex gap-2">
        <input list="browser" name="name" class="form-control w-50 mr-2" placeholder="Select Table..." value="<?php echo htmlspecialchars($name); ?>" required>
        <input list="browsers" name="Request_ID" class="form-control w-50" placeholder="Select ID..." value="<?php echo htmlspecialchars($id_leave); ?>" required>
        <button type="submit" name="datalist" class="btn btn-success ml-2">Get Data</button>
      </div>
      <datalist id="browser">
        <?php
        $tables = sqlsrv_query($con, "SELECT [name] FROM SYSOBJECTS WHERE xtype = 'U' AND name IN ('leaves', 'employee')");
        while ($table = sqlsrv_fetch_array($tables)) {
          echo '<option value="' . $table['name'] . '">';
        }
        ?>
      </datalist>
    </div>
  </form>
  <?php
  if (isset($_POST['datalist']) && $name && $id_leave) {
    $stmt = sqlsrv_query($con, "SELECT TOP 1 * FROM $name WHERE '$name' <> 'leaves_demo'");
    $stmt2 = sqlsrv_query($con, "SELECT * FROM $name WHERE id = '$id_leave' AND '$name' <> 'leaves_demo'");
    if ($stmt && $stmt2) {
      echo '<div class="table-responsive"><table class="table table-bordered table-striped">';
      while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo '<thead><tr>';
        foreach ($row as $col => $val) {
          echo "<th>$col</th>";
        }
        echo '</tr></thead>';
      }
      echo '<tbody>';
      while ($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
        echo '<tr>';
        foreach ($row2 as $val) {
          if ($val instanceof DateTime) {
            echo '<td>' . $val->format('Y-m-d H:i:s') . '</td>';
          } else {
            echo '<td>' . htmlspecialchars($val) . '</td>';
          }
        }
        echo '</tr>';
      }
      echo '</tbody></table></div>';
    }
  }
  ?>
  <form method="post">
    <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
    <input type="hidden" name="Request_ID" value="<?php echo htmlspecialchars($id_leave); ?>">
    <button type="submit" name="DeleteR" class="btn btn-danger btn-block mt-3">Delete Record</button>
  </form>
</div>
<?php
if (isset($_POST['DeleteR']) && $name && $id_leave) {
  $success = false;
  if ($name === 'employee') {
    $employee_insertqry = sqlsrv_query($con, "INSERT INTO employee_demo SELECT [id],[username],[password],[role_id],[manager_id],[super_id],[section_id],[UnitManager_id],[Unit_Name],[username_id],[updated_by],[creation_time],'$s_username','$sqltime',(SELECT [creator_user] FROM employee WHERE id = '$id_leave'),(SELECT [add_Dtime] FROM employee WHERE id = '$id_leave') FROM $name WHERE id = '$id_leave'");
    $success = $employee_insertqry ? true : false;
  }
  if ($name === 'leaves') {
    $insertqry = sqlsrv_query($con, "INSERT INTO leaves_demo SELECT *,'$s_username','$sqltime' FROM $name WHERE id = '$id_leave'");
    $success = $insertqry ? true : false;
  }
  if ($name !== 'leaves_demo' && $name !== 'schedule_demo') {
    $deleteqry = sqlsrv_query($con, "DELETE FROM $name WHERE id = '$id_leave'");
    $success = $success && $deleteqry;
  }
  echo "<script>
    Swal.fire({
      icon: '" . ($success ? "success" : "error") . "',
      title: '" . ($success ? "Deleted Successfully" : "Error occurred") . "',
      showConfirmButton: false,
      timer: 2000
    });
  </script>";
}
?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
<?php include("footer.html"); ?>