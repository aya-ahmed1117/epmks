<?php
require_once("inc/config.inc");
include("pages.php");

$self = $_SESSION['id'];
$s_username = $_SESSION['username'];
$role_id = $_SESSION['role_id'];
$Creation_time = date ("Y-m-d H:i:s");
$id_leave = isset($_POST['Request_ID']) ? $_POST['Request_ID'] : '';
?>
<!DOCTYPE html>
<html>

<head>
  <title> Change Management </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
      <h4 class="text-primary"><img src="images/helpdesk-icon-png-11.jpg" style="width:40px;"> Request type: <em>Change Management</em></h4>
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
          $gogo = sqlsrv_query($con1, "SELECT Request_ID FROM tbl_Ticketing_system 
            WHERE Request_Type = 'Change Management' and Employee_Username = 'x_test'  ");
          echo "SELECT Request_ID FROM tbl_Ticketing_system 
            WHERE Request_Type = 'Change Management' and Employee_Username = 'x_test'  ";
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
      T.[Last_working_date], T.Employee_new_manager,
      P.Note, P.ID as Employee_ID , T.Creation_time
      FROM tbl_Ticketing_system T
      LEFT JOIN [Employess_DB].[dbo].[tbl_Personal_info] P
      ON T.Employee_Username = P.UserName
      WHERE T.Request_ID = $id_leave_safe    ");
    echo "
      SELECT T.[Request_ID], T.[Request_Type], T.[Employee_Username],
      T.[Last_working_date], T.Employee_new_manager,
      P.Note, P.ID as Employee_ID , T.Creation_time
      FROM tbl_Ticketing_system T
      LEFT JOIN [Employess_DB].[dbo].[tbl_Personal_info] P
      ON T.Employee_Username = P.UserName
      WHERE T.Request_ID = $id_leave_safe    ";

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
      <input type="date" name="Last_working_day" required class="form-control Last_working_day" />
    </div>

    <div class="mb-3">
      <label>Username</label>
        <select name="username" class="form-control username" required>
          <?php
          $checks = sqlsrv_query( $con ,"SELECT * from  employee  where role_id != 1 order by username asc ");
          while($outputs = sqlsrv_fetch_array($checks)){
            $rows = '<option ';
            $rows .= $outputs['id'] ? "selected" : " ";;
            $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
            echo $rows;
          }
          ?>
        </select>
      </div>

    <div class="mb-3">
      <label>Employee ID</label>
      <input type="number" name="Employee_ID" required class="form-control Employee_ID" />
    </div>


    <div class="mb-3">
      <label>New Manager</label>
      <select name="Employee_Manager" class="form-control Employee_Manager" required>

       <?php
     //
       $checks = sqlsrv_query( $con ,"SELECT * from  employee  where role_id > 1 order by username asc");
       while($outputs = sqlsrv_fetch_array($checks)){
        $rows = '<option ';
        $rows .= $outputs['id'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
        echo $rows;
      }
      ?>
    </select>
  </div>

        <button type="submit" class="btn btn-primary save" name="save">Update Ticket</button>
   </form>
 </div>


    <?php
    $gogo = sqlsrv_query( $con ,"SELECT [name]
      FROM SYSOBJECTS WHERE xtype = 'U'");
    while($index = sqlsrv_fetch_array($gogo)){
      $tables =$index['name'];
      $tables.'<br>';}

      ?>
      <div>
        <?php 
         if(isset($_POST['save'])){

        $Creation_time = date ("Y-m-d H:i:s");

        if(isset($_POST['Employee_ID'])){$Employee_new_id = $_POST['Employee_ID'];}
        if(isset($_POST['Last_working_day'])){$Last_working_day = $_POST['Last_working_day'];}
        if(isset($_POST['Employee_Manager'])){$Employee_Manager = $_POST['Employee_Manager'];}
        if(isset($_POST['username'])){$usernames = $_POST['username'];}

       

         $insertqry2 =sqlsrv_query( $con ,"INSERT INTO [Aya_Web_APP].[dbo].[schedule_demo] SELECT  [id]
          ,[engineer_id]
          ,[username]
          ,[shift_start]
          ,[shift_end]
          ,[schedule_date]
          ,[senior]
          ,[super]
          ,[section] ,'$Creation_time','$self',
          '$s_username',' ' 
          from schedule_table 
          where schedule_table.engineer_id = '$Employee_new_id' and schedule_date > '$Last_working_day'" ); 
       }
       if(isset($_POST['save'])){
      
        $Group= sqlsrv_query($con1,"SELECT [Group] FROM [tbl_Personal_info] where UserName = '$Employee_Manager'");
        $unit= sqlsrv_query($con1,"SELECT [Unit] FROM [tbl_Personal_info] where UserName = '$Employee_Manager'");
   
        $insert_query = sqlsrv_query( $con1 ,"INSERT INTO [internal_transfer]
          ([Employee_ID] , [User_Name] , [Hiring_date] , [Employee_Type] , [Last_working_day] , 
          [Effective_Date] ,[Employee_Manager],[Department],[unit],[Created_User],[Date_time],[Group] )

          VALUES
          ('$Employee_new_id', (SELECT username from tbl_Personal_info where id = '$Employee_new_id'), 
          (SELECT Hiring_Date from tbl_Personal_info where id = '$Employee_new_id'),
          (SELECT Employee_Type from tbl_Personal_info where id = '$Employee_new_id'),
          '$Last_working_day',DATEADD(day,1,'$Last_working_day'),
          (SELECT Manager_Name from tbl_Personal_info where id = '$Employee_new_id'),
          (SELECT Tbl_departments.Department from tbl_Personal_info join Tbl_departments on 
          Department_ID = tbl_Personal_info.Department where id = '$Employee_new_id'),
          (SELECT Units from tbl_Personal_info join Tbl_Units on Unit = Units_ID 
          where id = '$Employee_new_id'),
          '$s_username','$Creation_time',
          (SELECT [Group] from tbl_Personal_info where id = '$Employee_new_id') )");

        $update_manager_id = sqlsrv_query($con, "UPDATE e1
                  SET e1.manager_id = e2.id
                  FROM employee e1
                  JOIN tbl_Personal_info p ON e1.username = p.username
                  JOIN employee e2 ON p.Manager_Name = e2.username
                  WHERE p.Manager_Name = '$Employee_Manager'
                    AND e1.username_id = '$Employee_new_id'");
        echo "UPDATE e1
                  SET e1.manager_id = e2.id
                  FROM employee e1
                  JOIN tbl_Personal_info p ON e1.username = p.username
                  JOIN employee e2 ON p.Manager_Name = e2.username
                  WHERE p.Manager_Name = '$Employee_Manager'
                    AND e1.username_id = '$Employee_new_id' and  ID = '$Employee_new_id' ";

        $update3=sqlsrv_query( $con1 ,"UPDATE [tbl_Personal_info]

          set [Group] = (SELECT [Group] from [tbl_Personal_info] where UserName  = '$Employee_Manager')

          where ID = '$Employee_new_id' ");

        $update3=sqlsrv_query( $con1 ,"UPDATE [tbl_Personal_info]

          set [Unit] = (SELECT [Unit] from [tbl_Personal_info] where UserName  = '$Employee_Manager')

          where ID = '$Employee_new_id' ");

        $update3=sqlsrv_query( $con1 ,"UPDATE [tbl_Personal_info]
          set [Manager_Name] = '$Employee_Manager',
          [update_by] ='$s_username',
          [update_time] = '$Creation_time'
          where ID = '$Employee_new_id' ");

        $update3=sqlsrv_query( $con1 ," UPDATE [Tbl_manager_structure]
          set  Manager_Name_L7 = '$Employee_Manager'
          where ID = '$Employee_new_id'");

        $update2=sqlsrv_query( $con," UPDATE [Aya_Web_APP].[dbo].[schedule_table]
          set senior = '$Employee_Manager'
          where username = '$usernames' and schedule_date > '$Last_working_day' ");

       if ($insert_query) {
  echo "
    <script>
      Swal.fire({
        title: 'Done',
        icon: 'success'
      }).then(function() {
        window.location.href = window.location.href;
      });
    </script>
  ";
}



    
      }

      ?>
      <?php include("footer.html"); ?>
    </body>
    </html>
