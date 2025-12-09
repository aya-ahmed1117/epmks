

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

</head>
<body>


  <style type="text/css">
  section {
  padding: 70px 0 0 0;
  display: block;
  overflow: hidden;
}
body{
  background-image: url('images/professional-images-for-websit.jpg');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: auto;
 }
     .home {
    width: 100%;
    height: 60vh;
    background-image: url('images/Pipeline.jpg');
    background-position: center top;
  background-size:cover;
}

.notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  position: relative;
  border-radius: 50%;
  top: -14px;
  right: 10%;
  font-weight: bold;
  font-size: 15px;
}

.notification:hover {
  background: blue;
}

footer {
  display: block;
}

.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url(images/niceee.gif) center no-repeat #0E0E15;

}

#myDIV {
  -webkit-animation: mymove 5s infinite;
  animation: mymove 4s infinite;
}

@keyframes mymove {
  60% {text-shadow:10px 10px 20px yellow;}
  50% {color: red;}

}
  </style>

  <div class="se-pre-con"></div>
<div>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="home.php" class="logo d-flex align-items-center">
<img src="images/Untitled3-removebg-preview.png" 
style="margin-left: -45%;">
      </a>

    <nav id="navbar" class="navbar">
      <ul>
      <li >
          <a href="#" style="font-size:10px;">
          <span  class="glyphicon glyphicon-user"></span>
          Login<samp>:</samp>
          <?php echo $_SESSION["username"];?></a>
            </li>
          <li><a href="?logout"><span style="font-size:10px;">
            <i class="fa fa-sign-out"></i>
          </span>log out</a></li>

        </ul>
      </li>
        <i class="bi bi-list mobile-nav-toggle"></i>

        </li></ul> 
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
</div>

 
 <section >
       <!--div class="home" style="width: 100%;
    height:60vh;
    background-position: center top;
  background-size:cover;">
    </div-->
    </section>
  <br>
     <div id="content">


<?php 
         if(isset($_POST['username'])){ $username = $_POST['username']; }
        if(isset($_POST['password'])){ $password = $_POST['password']; }
?>
  <h1 class="alert alert-warning" style="font-size:23px;border-radius: 20px 20px 20px 20px;
 border:1px solid gray;width:100%;">
  <span class="warn warning">&#9888;</span> As your Password is 123

  please change your password and logout then login to continue  using the WFT</h1>

<br>
<div class="signup-form">
        
    <form  method="post"style="box-shadow: 10px 10px 5px #aa4d9c;
    width:70%;margin-left:12%;padding-bottom: 23px;padding-left:-30px; border-radius: 20px 20px 20px 20px;
     background-color:#46428f;opacity:0.6;">
        <h2 style="padding-top:3.5%; color:white;font-size:25px; margin-left:20px; font-weight:bold;">Change Password</h2>
        <br>
         <div class="row mb-4">

    <div class="col-md-4">
      <div class="input-group">
        <input type="text" id="form6Example1" name="username" class="form-control username" placeholder="username" value="<?php echo $_SESSION["username"];?>" readonly="true" />
        <label class="form-label" for="form6Example1"></label>
      </div>
    </div>

    <div class="col-md-8">
    <div class="input-group">
  <span class="input-group-text" id="dates basic-addon1">Password</span>
  <input type="text" class="form-control" name="password" placeholder="Password" required 
    value="<?php echo $_SESSION["password"];?>"
    aria-describedby="basic-addon1" required/>
</div>
 </div>
  </div>

         <!--input type="submit" name="save" value="Save" style=" 
         background: linear-gradient(to bottom, #000066 0%, #660066 100%);margin-left:10%;
         border-radius: 50%; width:100px;height:100px; color:white; margin-top:-30px;font-size:16px; font-weight:bold;"-->

         <center>
<button type="submit" name="save" value="Save"  class="btn btn-warning submit"style="width: 30%;padding: 10px;color: #fff;font-size: 15px; border-radius: 20px 20px 20px 20px;background: linear-gradient(to bottom, #000066 0%, #660066 100%);">
  Save
</button>
</center>


  <br>
  <br>

  <!-- test >
  <div class="row g-3 align-items-center">
  <div class="form-outline col-auto">
    <input
      type="password"
      id="formTextExample2"
      class="form-control"
      aria-describedby="textExample2"
    />
    <label class="form-label" for="formTextExample2">Password</label>
  </div>
  <div class="col-auto">
    <span id="textExample2" class="form-text"> Must be 8-20 characters long. </span>
  </div>
</div>
  <test -->

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
$update_query =sqlsrv_query($con ,"UPDATE employee SET [password] = '$password' , [updated_by] = '$username_update' , 
    [creation_time]='$creation_time' WHERE [username] = '$username_update' and id ='$username_id' ");
  if($update_query){
     echo '"<script> window.onload = function() {
     swal("Your Password has been Changed");}; 
 </script>"';
  }else{ echo '<script> window.onload = function() {
     swal("Error");}; 
 </script>"';}
}
?>
  </form>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  //swal("Sign done");

 /* swal({
  title: "Good job!",
  text: "You clicked the button!",
  icon: "success",
  button: "Aww yiss!",
});*/
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