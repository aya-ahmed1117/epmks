
<?php
require_once("inc/config.inc");
include("pages.php");

$self = $_SESSION['id'];
$role_id = $_SESSION['role_id'];
$username_update = $_SESSION['username'];
$creation_time = date ("Y-m-d h:i:s");


$ticket_table ="";
$id_leave ="";
if(isset($_POST['ticket_table'])){$ticket_table = $_POST['ticket_table'];}
if (isset($_POST['Request_ID'])) { $id_leave = $_POST['Request_ID'];}


?>
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" href="imag/logo.jpg">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OutSource to Staff</title>

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
<div class="signup-form">
  <div class="mb-3 d-flex justify-content-between align-items-center">
    <h4 class="text-primary"><img src="images/helpdesk-icon-png-11.jpg" style="width:40px;"> Request type: <em>Outsource to Staff</em></h4>
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
        $gogo = sqlsrv_query($con, "SELECT Request_ID FROM tbl_Ticketing_system 
          WHERE Request_Type = 'Change from OutSource to Staff' AND Request_status <> 'closed'");
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
      SELECT T.[Request_ID], T.[Request_Type], T.[Employee_Username] as username,
      T.[Last_working_date] ,Employee_new_id as [New ID],
      P.UserName, P.ID as [Employee old id]
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
            echo "<td>" . (is_a($val, 'DateTime') ? $val->format("Y-m-d") : $val) . "</td>";
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
  <hr>
  <form method="post">

    <div class="mb-3">
      <label>Last working date</label>
      <input type="date" name="Effectivity_date" required class="form-control Effectivity_date" />
    </div>

    <div class="mb-3">
      <label>Employee new id</label>
      <input type="number" name="Employee_ID" required class="form-control Employee_ID" />
    </div>

    <div class="mb-3">
      <label> Outsource ID</label>
      <input type="number" name="Outsource_ID" required class="form-control Outsource_ID" />
    </div>

    <div class="mb-3">
      <label>New username</label>
      <input type="text" name="New_username" required class="form-control New_username" />
    </div>

    <div class="mb-3">
      <label>Outsource username</label>
      <input type="text" name="Username" required class="form-control Username" />
    </div>

        <input name="save" value="Update ticket" type="submit" class="btn btn-primary save" />
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <?php
  $gogo = sqlsrv_query( $con ,"SELECT [name]
FROM SYSOBJECTS WHERE xtype = 'U'");
while($index = sqlsrv_fetch_array($gogo)){
$tables =$index['name'];
 $tables.'<br>';}
 

if (isset($_POST['save'])) {
    $s_username = $_SESSION['username'] ?? '';
    $engineer_id = $_SESSION['id'] ?? '';
    $Creation_time = date("Y-m-d H:i:s");
    $getdate = date("Y-m-d");

    $Employee_new_id = $_POST['Employee_ID'] ?? '';
    $Employee_Username = $_POST['Username'] ?? '';
    $Last_working_date = $_POST['Effectivity_date'] ?? '';
    $Employee_old_id = $_POST['Outsource_ID'] ?? '';
    $New_username = $_POST['New_username'] ?? '';

    // Insert into Outsource_Staff
    $insert_query = "INSERT INTO [Employess_DB].[dbo].[Outsource_Staff]
        ([Employee_ID], [Username], [Effectivity_date], [Outsource_ID], [update_user], [date_time], [New_username])
        VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = [$Employee_new_id, $Employee_Username, $Last_working_date, $Employee_old_id, $s_username, $Creation_time, $New_username];
    $result = sqlsrv_query($con1, $insert_query, $params);

    if ($result) {
        echo "<script>Swal.fire('Success', 'Insert into Outsource_Staff completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Insert failed: $errors', 'error');</script>";
    }

    // Insert into employee_demo
    if ($tables === 'employee') {
      $insertqry = sqlsrv_query( $con , "INSERT into employee_demo select        
             [id]
             ,[username]
             ,[password]
             ,[role_id]
             ,[manager_id]
             ,[super_id]
             ,[section_id]
             ,[UnitManager_id]
             ,[Unit_Name]
             ,[username_id]
             ,[updated_by]
             ,[creation_time] 
             ,'$username_update'
             ,'$creation_time'
             ,(select [creator_user]
             from employee where username = '$Employee_Username')
             ,(select [add_Dtime] from employee where username = '$Employee_Username')
             from employee where  username = '$Employee_Username'  ");


        if ($insertqry) {
            echo "<script>Swal.fire('Success', 'Insert into employee_demo completed successfully!', 'success');</script>";
        } else {
            $errors = print_r(sqlsrv_errors(), true);
            echo "<script>Swal.fire('Error', 'Insert into employee_demo failed: $errors', 'error');</script>";
        }
    }

    // Update queries
    $updateQuery1 = sqlsrv_query($con1, "UPDATE [dbo].[internal_transfer] SET Employee_ID = ? WHERE Employee_ID = ?", [$Employee_new_id, $Employee_old_id]);
    if ($updateQuery1) {
        echo "<script>Swal.fire('Success', 'Update 1 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 1 failed: $errors', 'error');</script>";
    }

    $updateQuery9 = sqlsrv_query($con1, "UPDATE [dbo].[Tbl_manager_structure] SET id = ? WHERE id = ?", [$Employee_new_id, $Employee_old_id]);
    if ($updateQuery9) {
        echo "<script>Swal.fire('Success', 'Update 2 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 2 failed: $errors', 'error');</script>";
    }

    $updateQuery10 = sqlsrv_query($con1, "UPDATE [dbo].[tbl_Personal_info] SET id = ?, [Employee_Type] = 'Staff', [UserName] = ?, [E-mail] = ? WHERE id = ?", [$Employee_new_id, $New_username, $New_username . '@te.eg', $Employee_old_id]);
    if ($updateQuery10) {
        echo "<script>Swal.fire('Success', 'Update 3 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 3 failed: $errors', 'error');</script>";
    }

    $updateQuery14 = sqlsrv_query($con, "UPDATE [Aya_Web_APP].[dbo].[employee] SET [username_id] = ?, [username] = ?, [updated_by] = ?, [creation_time] = ? WHERE [username_id] = ?", [$Employee_new_id, $New_username, $s_username, $Creation_time, $Employee_old_id]);
    if ($updateQuery14) {
        echo "<script>Swal.fire('Success', 'Update 4 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 4 failed: $errors', 'error');</script>";
    }

    $updateQuery15 = sqlsrv_query($con, "UPDATE [Aya_Web_APP].[dbo].[schedule_table] SET [username] = ?, engineer_id = ? WHERE engineer_id = ? AND [schedule_date] >= (CASE WHEN ? > ? THEN ? ELSE ? END)", [$New_username, $Employee_new_id, $Employee_old_id, $Last_working_date, $getdate, $Last_working_date, $getdate]);
    if ($updateQuery15) {
        echo "<script>Swal.fire('Success', 'Update 5 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 5 failed: $errors', 'error');</script>";
    }

    // Restore second SYSOBJECTS query
    $gogo = sqlsrv_query($con, "SELECT [name] FROM SYSOBJECTS WHERE xtype = 'U'");
    while ($index = sqlsrv_fetch_array($gogo)) {
        $tables = $index['name'];
         $tables . '<br>';
    }

    if ($tables === 'schedule_table' && $updateQuery15) {
        $insertqry2 = sqlsrv_query($con, "INSERT INTO [Aya_Web_APP].[dbo].[schedule_demo] SELECT *, ?, ?, ?, ' ' FROM schedule_table WHERE username = ?", [$Creation_time, $engineer_id, $s_username, $Employee_Username]);
        if ($insertqry2) {
            echo "<script>Swal.fire('Success', 'Insert into schedule_demo completed successfully!', 'success');</script>";
        } else {
            $errors = print_r(sqlsrv_errors(), true);
            echo "<script>Swal.fire('Error', 'Insert into schedule_demo failed: $errors', 'error');</script>";
        }
    }

    $updateQuery11 = sqlsrv_query($con1, "UPDATE [dbo].[tbl_Promotion] SET Employee_ID = ? WHERE Employee_ID = ?", [$Employee_new_id, $Employee_old_id]);
    if ($updateQuery11) {
        echo "<script>Swal.fire('Success', 'Update 6 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 6 failed: $errors', 'error');</script>";
    }

    $updateQuery12 = sqlsrv_query($con1, "UPDATE [dbo].[Tbl_Promotions_duration] SET id = ? WHERE id = ?", [$Employee_new_id, $Employee_old_id]);
    if ($updateQuery12) {
        echo "<script>Swal.fire('Success', 'Update 7 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 7 failed: $errors', 'error');</script>";
    }

    $updateQuery13 = sqlsrv_query($con1, "UPDATE [dbo].[Tbl_TE_Entry_Permit] SET ID = ? WHERE ID = ?", [$Employee_new_id, $Employee_old_id]);
    if ($updateQuery13) {
        echo "<script>Swal.fire('Success', 'Update 8 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 8 failed: $errors', 'error');</script>";
    }

    $updateQuery2 = sqlsrv_query($con1, "UPDATE [dbo].[Resignation_Table] SET Employee_ID = ? WHERE Employee_ID = ?", [$Employee_new_id, $Employee_old_id]);
    if ($updateQuery2) {
        echo "<script>Swal.fire('Success', 'Update 9 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 9 failed: $errors', 'error');</script>";
    }

    $updateQuery3 = sqlsrv_query($con1, "UPDATE [dbo].[Staff_old_user] SET Employee_ID = ? WHERE Employee_ID = ?", [$Employee_new_id, $Employee_old_id]);
    if ($updateQuery3) {
        echo "<script>Swal.fire('Success', 'Update 10 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 10 failed: $errors', 'error');</script>";
    }

    $updateQuery4 = sqlsrv_query($con1, "UPDATE [dbo].[Tbl_Applications_user] SET id = ? WHERE id = ?", [$Employee_new_id, $Employee_old_id]);
    if ($updateQuery4) {
        echo "<script>Swal.fire('Success', 'Update 11 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 11 failed: $errors', 'error');</script>";
    }

    $updateQuery5 = sqlsrv_query($con1, "UPDATE [dbo].[tbl_attended_cources] SET id = ? WHERE id = ?", [$Employee_new_id, $Employee_old_id]);
    if ($updateQuery5) {
        echo "<script>Swal.fire('Success', 'Update 12 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 12 failed: $errors', 'error');</script>";
    }

    $updateQuery6 = sqlsrv_query($con1, "UPDATE [dbo].[Tbl_certification] SET id = ? WHERE id = ?", [$Employee_new_id, $Employee_old_id]);
    if ($updateQuery6) {
        echo "<script>Swal.fire('Success', 'Update 13 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 13 failed: $errors', 'error');</script>";
    }

    $updateQuery7 = sqlsrv_query($con1, "UPDATE [dbo].[Tbl_Computers] SET id = ?, [DomainUserName] = ? WHERE id = ?", [$Employee_new_id, $New_username, $Employee_old_id]);
    if ($updateQuery7) {
        echo "<script>Swal.fire('Success', 'Update 14 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 14 failed: $errors', 'error');</script>";
    }

    $updateQuery8 = sqlsrv_query($con1, "UPDATE [dbo].[Tbl_Internal_Transfer_history] SET id = ? WHERE id = ?", [$Employee_new_id, $Employee_old_id]);
    if ($updateQuery8) {
        echo "<script>Swal.fire('Success', 'Update 15 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 15 failed: $errors', 'error');</script>";
    }

    $updateQuery16 = sqlsrv_query($con1, "UPDATE [dbo].[Avaya_LoginID_username] SET [username] = ? WHERE username = ?", [$New_username, $Employee_Username]);
    if ($updateQuery16) {
        echo "<script>Swal.fire('Success', 'Update 16 completed successfully!', 'success');</script>";
    } else {
        $errors = print_r(sqlsrv_errors(), true);
        echo "<script>Swal.fire('Error', 'Update 16 failed: $errors', 'error');</script>";
    }
}

sqlsrv_close($con);
sqlsrv_close($con1);
    ?>
     
</html>

<?php include("footer.html"); ?>
