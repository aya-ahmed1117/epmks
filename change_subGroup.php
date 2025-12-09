<?php
require_once("inc/config.inc");
include ("pages.php");

if($_SESSION['username'] == ''){ header("location: index.php"); }
if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }

$self = $_SESSION['id'];
$role_id = $_SESSION['role_id'];

$ticket_table = "";
$id_leave = "";
if(isset($_POST['ticket_table'])){$ticket_table = $_POST['ticket_table'];}
if (isset($_POST['Request_ID'])) { $id_leave = $_POST['Request_ID'];}
?>

<head>
  <title>Change SubGroup</title>
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
<div class="signup-form">
  <div class="mb-3 d-flex justify-content-between align-items-center">
    <h4 class="text-primary"><img src="imag/helpdesk-icon-png-11.jpg" style="width:40px;"> Request type: <em>Change Management</em></h4>
    <a href="ticketing_updates.php.php" class="btn btn-outline-secondary">
      <i class="fas fa-ticket-alt"></i> Go Back
    </a>
  </div>

  <form method="post">
    <div class="mb-3">
      <label>Select ID number:</label>
      <div class="d-flex gap-2">
        <input list="browser" name="Request_ID" value="<?= $id_leave ?>" class="form-control w-50" placeholder="Select ID number..." />
        <button type="submit" name="datalist" class="btn btn-success">Get Data</button>
      </div>
      <datalist id="browser">
        <?php
        $gogo = sqlsrv_query($con, "SELECT * FROM tbl_Ticketing_system WHERE Request_Type = 'Change sub_group' AND Request_status <> 'closed'");
        while($index = sqlsrv_fetch_array($gogo)){
          echo '<option value="'.$index['Request_ID'].'">'.$index['Request_ID'].'</option>';
        }
        ?>
      </datalist>
    </div>
  </form>

  <?php if(isset($_POST['datalist']) && !empty($id_leave)): ?>
  <div class="table-responsive">
    <table class="table table-bordered">
      <?php
      $stmt = sqlsrv_query($con, "SELECT TOP 1 * FROM tbl_Ticketing_system");
      $stmt2 = sqlsrv_query($con, "SELECT * FROM tbl_Ticketing_system WHERE Request_ID = '$id_leave'");

      if ($header = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "<thead><tr>";
        foreach ($header as $col => $val) {
          echo "<th>$col</th>";
        }
        echo "</tr></thead>";
      }

      while ($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
        echo "<tbody><tr>";
        foreach ($row as $col => $val) {
          if ($val instanceof DateTime) {
            echo "<td>" . $val->format("Y-m-d H:i:s") . "</td>";
          } else {
            echo "<td>$val</td>";
          }
        }
        echo "</tr></tbody>";
      }
      ?>
    </table>
  </div>
<?php endif; ?>

<form >
  <div class="mb-3">
    <label>Last working date</label>
    <input type="date" name="Last_working_day" class="form-control Last_working_day" />
  </div>

  <div class="mb-3">
    <label>Username</label>
    <input list="browsers" name="username" class="form-control username" placeholder="Select/write username" required>
    <datalist id="browsers">
      <?php
      $checks = sqlsrv_query($con, "SELECT * FROM employee WHERE role_id != 1");
      while($outputs = sqlsrv_fetch_array($checks)){
        echo '<option value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
      }
      ?>
    </datalist>
  </div>

  <div class="mb-3">
    <label>Sub group</label>
    <input list="browsers_sub" name="SubGroups" class="form-control SubGroups" placeholder="Select/write SubGroups" required>
    <datalist id="browsers_sub">
      <?php
      $checks = sqlsrv_query($con, "SELECT * FROM [Employess_DB].[dbo].[Tbl_SubGroups]");
      while($outputs = sqlsrv_fetch_array($checks)){
        echo '<option value="'.$outputs['SubGroup_ID'].'">'.$outputs['SubGroups'].'</option>';
      }
      ?>
    </datalist>
  </div>
<button type="button" class="btn btn-primary save">Update Ticket</button>

</form>
</div>
<div id="result"></div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function(){
  $('.save').on('click', function(e){
    e.preventDefault();

    let Last_working_day = $('.Last_working_day').val().trim();
    let username = $('.username').val().trim();
    let SubGroups = $('.SubGroups').val().trim();

    if(username){
      $.ajax({
        url: 'ajax_subGroup.php',
        type: 'POST',
        data: 'Last_working_day='+Last_working_day+'&username='+username+'&SubGroups='+SubGroups, 
        success: function(response){
          // Inject response (script tag) into the page so Swal.fire can execute
          $('body').append(response);
           const div = document.createElement('div');
        div.innerHTML = response;
        document.body.appendChild(div);
        },
        error: function(xhr, status, error){
          console.error('AJAX Error:', error);
        }
      });
    } else {
      Swal.fire({
        icon: 'warning',
        title: 'Missing Username',
        text: 'Please enter or select a username.'
      });
    }
  });
});
</script>




<?php include("footer.html"); ?>
