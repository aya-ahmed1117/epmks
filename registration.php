<!DOCTYPE html> 
<html>
<head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php 
    include ("pages.php");
  
    $role_id = $_SESSION['role_id'];

    $username = $_SESSION['username'];
    if (isset($_GET['id'])){$idd = $_GET['id']; }
    $check = sqlsrv_query( $con ,"SELECT * FROM [employee] ");
//$output = $check->fetch_array();
    $output = sqlsrv_fetch_array($check );
    $orders_num = 1;

    $username_id = $output['username_id'];

    ?>
    <title>Register Page</title>


    <?php 
    if($_SESSION['role_id'] == 1){
      ?>
      
        <style>
            body {
                background: #f0f2f5;
            }
            .form-container {
                max-width: 900px;
                margin: 50px auto;
                background: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 15px 25px rgba(0,0,0,0.1);
            }
            h2 {
                color: #0d6efd;
            }
        </style>
    </head>
    <body>

        <div class="container" >
            <div class="form-container">
                <h2 class="text-center mb-4">Register</h2>
                <form id="registerForm" >
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" placeholder="Enter Username" required>
                        </div>
                        <div class="col-md-4">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="col-md-4">
                            <label>Confirm Password</label>
                            <input class="form-control" type="password" name="repassword" placeholder="Confirm Password" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Role ID</label>
                            <input class="form-control" type="number" name="role_id" placeholder="Enter Role ID">
                        </div>
                        <div class="col-md-4">
                            <label>Senior</label>
                            <select class="form-select" name="manager_id">
                                <option action="none" value="" selected>- Select Senior -</option>

                                <?php
$checks = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 2 order by 2 ");
//while($outputs = $checks->fetch_array()){
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
  $rows .= $output['manager_id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['id'].'">'.$outputs['username'].'</option>';
  echo $rows;}?> 
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Unit</label>
                            <select class="form-select" name="Unit_Name">
                                <option action="none" value="" selected>* Select Unit *</option>
                                <?php
                               $gogo = sqlsrv_query( $con1 ,"SELECT  
      [Units] , [Units_ID]
  FROM [Employess_DB].[dbo].[Tbl_Units]");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['Unit_Name'] == $index['Units_ID'] ? "selected" : "";;
  $rows .= 'value="'.$index['Units'].'">'.$index['Units'].'</option>';
  echo $rows;}
                                  ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label>User ID</label>
                            <input class="form-control" type="number" name="username_id" placeholder="Enter ID">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2 sendDate" name="signup" value="Sign Up">
    Submit <i class="fa fa-paper-plane"></i> 
</button>

                        <input type="reset" class="btn btn-outline-secondary" value="Reset">
                    </div>

                </form>
            </div>
        </div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $(document).on('click', '.sendDate', function (e) {
        e.preventDefault();

        // Get form values manually
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();
        var repassword = $('input[name="repassword"]').val();
        var role_id = $('input[name="role_id"]').val();
        var manager_id = $('select[name="manager_id"]').val();
        var Unit_Name = $('select[name="Unit_Name"]').val();
        var username_id = $('input[name="username_id"]').val();

        // Basic validation
        if (username === "" || password === "" || repassword === "") {
            swal("Warning", "Please fill in all required fields.", "warning");
            return false;
        }

        if (password !== repassword) {
            swal("Error", "Passwords do not match.", "error");
            return false;
        }

        // Prepare data string
        var dataString =
            'username=' + encodeURIComponent(username) +
            '&password=' + encodeURIComponent(password) +
            '&repassword=' + encodeURIComponent(repassword) +
            '&role_id=' + encodeURIComponent(role_id) +
            '&manager_id=' + encodeURIComponent(manager_id) +
            '&Unit_Name=' + encodeURIComponent(Unit_Name) +
            '&username_id=' + encodeURIComponent(username_id);

        $.ajax({
            url: 'register_ajax.php',
            type: 'POST',
            data: dataString,
            success: function (response) {
                response = response.trim();
                if (response === 'success') {
                    swal({
                        title: "Success",
                        text: "User registered successfully.",
                        icon: "success"
                    }).then(function () {
                        window.location.reload();
                    });
                } else {
                    swal("Error", response, "error");
                }
            },
            error: function () {
                swal("Error", "Something went wrong. Please try again.", "error");
            }
        });

        return false;
    });
});
</script>

<!-- <script>
$(document).ready(function () {
    $(document).on('click', '.sendDate', function () {
        var formData = $('#registerForm').serialize();

        $.ajax({
            url: 'register_ajax.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                response = response.trim();
                if (response === 'success') {
                    swal({
                        title: "Success",
                        text: "User registered successfully.",
                        icon: "success"
                    }).then(function () {
                        window.location.reload();
                    });
                } else {
                    swal("Error", response, "error");
                }
            },
            error: function () {
                swal("Error", "Something went wrong. Please try again.", "error");
            }
        });

        return false;
    });
});
</script> -->

<script type="text/javascript" src="jQuery/sweetalert.min.js"></script> 
</body>

</html>

<?php 
}
include ("footer.html");
?>





