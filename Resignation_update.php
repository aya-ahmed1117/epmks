<?php
require_once("inc/config.inc");
include("pages.php");

$self = $_SESSION['id'];
$role_id = $_SESSION['role_id'];
$id_leave = isset($_POST['Request_ID']) ? $_POST['Request_ID'] : '';
?>
<!DOCTYPE html>
<html>

<head>
  <title>Resignation update</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .alert-success {
      text-align: center;
      font-size: 18px;
      padding: 15px;
    }
  </style>
</head>

<body>
<div class="signup-form">
  <div class="mb-3 d-flex justify-content-between align-items-center">
    <h4 class="text-primary"><img src="images/helpdesk-icon-png-11.jpg" style="width:40px;"> Request type: <em>Resignation</em></h4>
    <a href="ticketing_updates.php" class="btn btn-outline-secondary">
      <i class="fas fa-ticket-alt"></i> Go Back
    </a>
  </div>

  <form method="post">
    <div class="mb-3">
      <label>Select ID number:</label>
      <div class="d-flex gap-2">
        <input list="browser" name="Request_ID" value="<?= htmlspecialchars($id_leave) ?>" class="form-control w-50" placeholder="Select ID number..."required autocomplete="off"/>
     
              <button type="submit" name="get_data" class="btn btn-success">Get Data</button>
 </div>
      <datalist id="browser">
        <?php
        $gogo = sqlsrv_query($con, "SELECT Request_ID FROM tbl_Ticketing_system WHERE Request_Type = 'Resign employees' AND Request_status <> 'closed'");
        if ($gogo && sqlsrv_has_rows($gogo)) {
          while($index = sqlsrv_fetch_array($gogo)) {
            echo '<option value="'.$index['Request_ID'].'">';
          }
        }
        ?>
      </datalist>
    </div>
  </form>

  <?php
  if (isset($_POST['get_data']) && !empty($id_leave)) {
    $id_leave_safe = intval($id_leave); 
        $stmt2 = sqlsrv_query($con, "
      SELECT T.[Request_ID], T.[Request_Type], T.[Employee_Username],
             T.[Last_working_date], T.[Reason_of_leave],
             P.UserName, P.ID as Employee_ID
      FROM tbl_Ticketing_system T
      LEFT JOIN [Employess_DB].[dbo].[tbl_Personal_info] P
        ON T.Employee_Username = P.UserName
      WHERE T.Request_ID = $id_leave_safe    ");

    if ($stmt2 === false) {
      echo "<div class='alert alert-danger'>Query failed: " . print_r(sqlsrv_errors(), true) . "</div>";
    } else {
      $data = [];
      while ($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
      }

      if (!empty($data)) {
        echo "<div class='table-responsive'><table class='table table-bordered'>";
        echo "<thead><tr>";
        foreach ($data[0] as $col => $val) {
          echo "<th>$col</th>";
        }
        echo "</tr></thead><tbody>";

        foreach ($data as $row) {
          echo "<tr>";
          foreach ($row as $val) {
            echo "<td>" . (is_a($val, 'DateTime') ? $val->format("Y-m-d H:i:s") : $val) . "</td>";
          }
          echo "</tr>";
        }

        echo "</tbody></table></div>";
      } else {
        echo "<div class='alert alert-warning'>No data found for this Request ID.</div>";
      }
    }
  }
  ?>

  <form>
    <div class="mb-3">
      <label>Employee ID</label>
      <input type="number" name="Employee_ID" required class="form-control Employee_ID" />
    </div>

    <div class="mb-3">
      <label>Last working date</label>
      <input type="date" name="Last_working_day" required class="form-control Last_working_day" />
    </div>

    <div class="mb-3">
      <label>Reason of leave</label>
      <select name="Reason_of_leave" class="form-control Reason_of_leave" required>
        <option value="">- Select -</option>
        <option value="Relationship With the Boss">Relationship With the Boss</option>
        <option value="Bored and Unchallenged by the Work Itself">Bored and Unchallenged by the Work Itself</option>
        <option value="Relationships With Coworkers">Relationships With Coworkers</option>
        <option value="Opportunities to Use Their Skills and Abilities">Opportunities to Use Their Skills and Abilities</option>
        <option value="Contribution of Their Work to the Organizations Business Goals">Contribution of Their Work to the Organization’s Business Goals</option>
        <option value="Autonomy and Independence on the Job">Autonomy and Independence on the Job</option>
        <option value="Meaningfulness of the Employees Job">Meaningfulness of the Employee's Job</option>
        <option value="Knowledge About Your Organizations Financial Stability">Knowledge About Your Organization’s Financial Stability</option>
        <option value="Overall Corporate Culture">Overall Corporate Culture</option>
        <option value="Managements Recognition of Employee Job Performance">Management's Recognition of Employee Job Performance</option>
        <option value="No appreciation and motivation">No appreciation and motivation</option>
        <option value="Offer with higher salary">Offer with higher salary</option>
        <option value="Attitude issue">Attitude issue</option>
        <option value="Change career">Change career</option>
        <option value="Low performance">Low performance</option>
        <option value="termination">Termination</option>
      </select>
    </div>

    <button type="button" id="mySubmit" class="btn btn-primary save">Update Ticket</button>
  </form>
</div>
<div id="result"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function() {
    $('#mySubmit').on('click', function(e) {
      e.preventDefault();

      let Last_working_day = $('.Last_working_day').val().trim();
      let Reason_of_leave = $('.Reason_of_leave').val().trim();
      let Employee_ID = $('.Employee_ID').val().trim();

      if (Employee_ID === '') {
        Swal.fire({
          icon: 'warning',
          title: 'Missing ID',
          text: 'Please enter or select an employee ID.'
        });
        return;
      }

      $.ajax({
        url: 'ajax_Resignation.php',
        type: 'POST',
        data: {
          Last_working_day,
          Reason_of_leave,
          Employee_ID
        },
        success: function(data) {
          console.log("Server response:", data);
          let parts = data.split('|');
          let mainMessage = parts[0]?.trim();
          //let scheduleMessage = parts[1]?.trim();

          if (mainMessage === 'exists') {
            Swal.fire('Warning', 'Data already exists. Please recheck.', 'warning')
              .then(() => location.reload());
          } else if (mainMessage === 'success') {
            Swal.fire('Success', 'Data added successfully.', 'success')
              .then(() => location.reload());
          } else if (mainMessage === 'no_user') {
            Swal.fire('Error', 'No such user found.', 'error')
              .then(() => location.reload());
          } else if (mainMessage === 'insert_error') {
            Swal.fire('Error', 'Failed to insert resignation data.', 'error')
              .then(() => location.reload());
          }

          // if (scheduleMessage === 'schedule_success') {
          //   $('#result').html('<div class="popup"><h2>Schedule insert done</h2></div>');
          // } else if (scheduleMessage === 'schedule_error') {
          //   Swal.fire('Schedule Error', 'Schedule insert failed.', 'error')
          //     .then(() => location.reload());
          // }
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', error);
          Swal.fire('Error', 'An error occurred while processing the request.', 'error')
            .then(() => location.reload());
        }
      });
    });
  });
</script>

<?php include("footer.html"); ?>
</body>
</html>
