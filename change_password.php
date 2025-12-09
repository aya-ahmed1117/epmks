

<?php

 //include ("pages.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>My Password</title>
  <link rel="icon" href="images/logo_we.jpg">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="css/google_css.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets2/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets2/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets2/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets2/css/style.css" rel="stylesheet">
  <?php 
  require_once("inc/config.inc");

  if($_SESSION['username'] == ''){ header("location: index.php"); }
  if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }
  $self = $_SESSION['id'];
  $role_id = $_SESSION['role_id'];
  $s_username = $_SESSION['username'];
  $unit = $_SESSION['Unit_Name'];

  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2000)) {
// last request was more than 30 minutes ago
session_unset();     // unset $_SESSION variable for the run-time 
session_destroy();   // destroy session data in storage
header("location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();



?>
<style>
  body {
      background-image: url('images/professional-images-for-websit.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      font-family: Arial, sans-serif;
    }

    .signup-form {
      background-color: rgba(70, 66, 143, 0.9);
      border-radius: 20px;
      padding: 40px;
      margin: 50px auto;
      width: 60%;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      color: white;
    }

    .signup-form h2 {
      text-align: center;
      font-weight: bold;
      margin-bottom: 30px;
    }

    .input-group-text {
      background-color: #222;
      color: #fff;
      border: none;
    }

    .form-control:focus {
      border-color: #aa4d9c;
      box-shadow: 0 0 5px #aa4d9c;
    }

    .btn-warning.submit {
      background: linear-gradient(to bottom, #000066 0%, #660066 100%);
      border: none;
      font-weight: bold;
      font-size: 16px;
    }

    .btn-outline-secondary {
      background-color: #fff;
      color: #333;
    }

    .alert {
      margin-top: 100px !important;
      width: 80%;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }

    .input-group {
      margin-bottom: 20px;
    }

    #togglePassword {
      border-radius: 0 5px 5px 0;
    }
  </style>
</style>

</head>
<body>


<!-- Loader -->
<div class="se-pre-con"></div>

<!-- ======= Header & Nav ======= -->
<header id="header" class="header fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="home.php" class="logo d-flex align-items-center">
      <img src="images/Untitled3-removebg-preview.png" style="margin-left: -45%;">
    </a>

    <nav id="navbar" class="navbar">
      <ul>
        <li>
          <a href="#">
            <span class="glyphicon glyphicon-user"></span>
            Login: <?php echo $_SESSION["username"]; ?>
          </a>
        </li>
        <li><a href="?logout"><i class="fa fa-sign-out"></i> Logout</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- Alert -->
<h1 class="alert alert-warning">
  <span class="warn warning">&#9888;</span> As your Password is 123, please change your password and logout then login to continue using the WFT.
</h1>
 <?php 
  if(isset($_POST['username'])){ $username = $_POST['username']; }
  if(isset($_POST['password'])){ $password = $_POST['password']; }
  ?>
<!-- Password Change Form -->
<div class="signup-form">
  <form method="post">
    <h2>Change Password</h2>

    <div class="row mb-4">
      <div class="col-md-4">
        <div class="input-group">
          <input type="text" name="username" class="form-control" value="<?php echo $_SESSION['username']; ?>" readonly>
        </div>
      </div>

      <div class="col-md-8">
        <div class="input-group">
          <span class="input-group-text">Password</span>
          <input type="password" class="form-control" id="passwordField" name="password" placeholder="New Password" required>
          <button class="btn btn-outline-secondary" type="button" id="togglePassword">
            <i class="fa fa-eye"></i>
          </button>
        </div>
      </div>
    </div>

    <center>
      <!-- <button type="submit" name="save" value="Save" class="btn btn-warning submit" style="width: 30%; padding: 10px;">
        Save
      </button> -->
      <center>
          <button type="submit" name="save" value="Save"  class="btn btn-warning submit"style="width: 30%;padding: 10px;color: #fff;font-size: 15px; border-radius: 20px 20px 20px 20px;background: linear-gradient(to bottom, #000066 0%, #660066 100%);">
            Save
          </button>
        </center>

    </center>
  </form>
</div>

 <?php
     //if (isset($_GET['id'])) { $id = $_GET['id']; }
        $s_username = $_SESSION['username'];
        if(isset($_POST['username'])){$username = $_POST['username'];}

        $checks = sqlsrv_query( $con ,"SELECT * FROM [employee] WHERE [username] = '$s_username'");
//$output = $check->fetch_array();
        $output = sqlsrv_fetch_array($checks);
        $orders_num = 1;
        ?>

        <?php

        $s_username = $_SESSION['username'];

        if(isset($_POST['save']))
        {
          if(isset($_POST['username'])){$username = $_POST['username'];}
          if(isset($_POST['password'])){$password = $_POST['password'];}
          if(isset($_POST['role_id'])){$role_id = $_POST['role_id'];}
          if(isset($_POST['manager_id'])){$manager_id = $_POST['manager_id'];}
          $checkme = sqlsrv_query( $con ,"SELECT * FROM [employee] where id = '$self' ");
          $output = sqlsrv_fetch_array($checkme );
          $Unit_Name = $output['Unit_Name'];
          $username_id = $output['id'];
   //echo $username_id ;

// insert 
          $username_update = $_SESSION['username'];
          $creation_time = date ("Y-m-d h:i:s");
  //insert old
          $insertqry = sqlsrv_query( $con ,"INSERT into employee_demo select        
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
           from employee where [id] ='$username_id' )
           ,(select [add_Dtime] from employee where [id] ='$username_id' )
           from employee where [id] ='$username_id'"
         );

 //sqlsrv_query($con ,
  //update new
          // $update_query =sqlsrv_query($con ,"UPDATE employee SET [password] = '$password' , [updated_by] = '$username_update' , 
          //   [creation_time]='$creation_time' WHERE [username] = '$username_update' and id ='$username_id' ");
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
          $update_query = sqlsrv_query($con ,"UPDATE employee SET [password] = '$hashedPassword', [updated_by] = '$username_update', 
            [creation_time]='$creation_time' WHERE [username] = '$username_update' and id ='$username_id'");

          if($update_query){
           echo '"<script>
            
            window.onload = function() {
             swal("Your Password has been Changed").then(function() {
              window.location.href = window.location.href;
            });
           }; 
             </script>"';
             }else{ echo '<script> window.onload = function() {
               swal("Error");}; 
               </script>"';}
             }
             ?>
          

           <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
           <script>
            document.getElementById("togglePassword").addEventListener("click", function () {
              var passwordField = document.getElementById("passwordField");
              var type = passwordField.getAttribute("type") === "password" ? "text" : "password";
              passwordField.setAttribute("type", type);
              this.querySelector('i').classList.toggle("fa-eye");
              this.querySelector('i').classList.toggle("fa-eye-slash");
            });
          </script>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
          <script type="text/javascript"  src="jQuery/jquery-3.6.0.js"></script>
          <script type="text/javascript" src="jQuery/jquery-2.2.4.js"></script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
          <!--script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script!-->
          <script type="text/javascript">
//paste this code under the head tag or in a separate js file.
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
      });
    </script>

    <?php
    include ("footer.html");
    ?>
  </body>
  </html>