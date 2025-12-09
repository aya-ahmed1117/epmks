<!DOCTYPE html>
<html lang="en">
<head>
	  <link rel="icon" href="images/logo_we.jpg">

  <title>Home</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">
<!--   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 -->  
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
	<?php
     ob_start();
 ?>
 <?php require_once("inc/config.inc");
//ini_set('session.gc_maxlifetime', 315360000);    //# 3 hours
       ?>
<link href="https://fonts.googleapis.com/css?family=Fira+Sans:900|Merriweather&display=swap" rel="stylesheet">
<link rel="stylesheet"type="text/css"href="fonts/iconic/css/material-design-iconic-font.min.css">
<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!-- <link rel="stylesheet" type="text/css" href="css/util.css">
 -->
 <link rel="stylesheet" type="text/css" href="css/mainlog.css">
<script type="text/javascript" src="jQuery/jquery-3.6.0.js"></script>
<script type="text/javascript" src="jQuery/package/dist/sweetalert.min.js"></script>
</head>
<body>
	<style type="text/css">
		* {
    padding:0;
    margin:0;

}
.iconDetails {
    margin:0 2%;
    /*float:left;*/
    width:15%;
}
  /*.container2 {
    width:100%;
    height:auto;
    padding:1%;
}*/
.text {
    align-items: center;
    text-indent: 30px;
}

.text h4, .text p {

  width:5%;
  font-size:20px;
  margin:0px;
  line-height:1.5em;
  color:white;
  text-indent: 30px;
}
/*h4{
margin:0px;
margin-top:3%;
margin-left:50px;
color:white;
font-size: 15px;
}*/
.text p span {
    color:#666;
}
.image-txt-container {
  margin-left: 20px;
  display: flex;
  align-items: center;
  flex-direction: row;
}
.vl {
 border-left: 4px solid #fff;
  height: 100px;
  margin-left: 15px;
}
	</style>

	<div class="limiter">
		<div class="container-login100" 
		style="background-image: url('images/Adosize_restricted.gif');
          background-size: cover;background-repeat: no-repeat;
          background-position: center center;">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title p-b-34 p-t-27">
	<!--background-image: url('images/Adosize_restricted.gif');
    div class="img-circle" >
      <img src="images/logo.jpg"style="width:15%;font-size:9px;">WorkForce Managment Tool
 </div>
    
 </span-->
 <div class="image-txt-container">
  <img src="images/logo_we.jpg" class='iconDetails'>
<div class="vl"></div>
   <div class="text">
        <p>WorkForce</p>
        <p>Managment</p>
        <p>Tool</p>
    </div>
 
</div>
	<!--div class='container2'>
    <img src="images/logo.jpg"  class='iconDetails' />

    <div class="text">
        <h4>WorkForce Managment Tool</h4>
    
    </div>
</div-->
</span>
			<br/>		
		

<div class="wrap-input100 validate-input" data-validate ="Enter username">
		<input class="input100" type="text" name="username" placeholder="Username"style="background-color:transparent;padding: 8%; text-align: center;"required>
		<span class="focus-input100" data-placeholder="&#xf207;"></span>
	</div>

	<div class="wrap-input100 validate-input" data-validate="Enter password">
		<input class="input100" type="password" name="password" placeholder="Password"style="background-color:transparent;padding: 8%; text-align: center;"required>
		<span class="focus-input100" data-placeholder="&#xf191;"></span>
	</div>

    <div class="txt-container" >If you don`t have Account click hear to add new 
         <a href="add_info.php" style="text-decoration: underline; color: orange;">Add Info</a>
    </div>
    <hr>
    <br>

		<div class="container-login100-form-btn">
			<button  title="Login" class="login100-form-btn"type="submit"name="submit">
				Login
			</button>
		</div>
				</br>
			<div class="container-login100-form-btn">
              <button type="reset" title="Resert" class="login100-form-btn">Reset</button>
            </div>
					<!--div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div-->
<?php
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Aya_Web_APP";
  
  $connectionInfo = array( "Database"=>"Aya_Web_APP" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con = sqlsrv_connect($DBhost, $connectionInfo);
    
sqlsrv_query( $con , "SET NAMES 'utf8'"); 
sqlsrv_query( $con ,'SET CHARACTER SET utf8' );?>


       <?php 
        if(isset($_POST['username'])){ $username = $_POST['username']; }
        if(isset($_POST['password'])){ $password = $_POST['password']; }

        if (isset($_POST['submit'])) {
            if ($password !== "" && $username !== "") {
            $check_user_sql = sqlsrv_query( $con ,"SELECT * FROM employee WHERE username = '$username'" );
            $count_results  = 1 ;// sqlsrv_num_rows($check_user_sql);
              while( $extract_data2 = sqlsrv_fetch_array( $check_user_sql , SQLSRV_FETCH_ASSOC))
              {

                $extract_data  = (object) $extract_data2 ;
                
                  if ($count_results !== 0) {
                      if ($password == $extract_data->password) {
                      $user_id                = $extract_data->id; 
                      $usern                  = $extract_data->username; 
                      $pass                   = $extract_data->password; 
                      $role_id                = $extract_data->role_id; 
                      $unit                   = $extract_data->Unit_Name;
if (!isset($_SESSION)) {
  session_start();
}                     $_SESSION['id']              = $user_id; 
                      $_SESSION['username']        = $usern;
                      $_SESSION['password']        = $pass;
                      $_SESSION['role_id']         = $role_id;
                      $_SESSION['Unit_Name']       = $unit;

                        header('location: home.php');
                      } if ($password == '123'){
                        header('location: change_password.php');
                      }
         else { echo '<script>
    swal({
    title: "wrong password.",
  icon: "error",
  })
     </script>'; }

                  } else { echo '<script>
    swal({
    title: "wrong username.",
  icon: "error",
  })
     </script>'; }
              }

            } else { echo '
            <script>
    swal({
    title: "username & password field mustnot be empity.",
  icon: "error",
  })
     </script>'; }
        }

        ?>
				</form>
			</div>
		</div>
	</div>
	

	<!--div id="dropDownSelect1"></div-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
    <script src="vendor/jquery/jquery-3.2.1.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
    <script src="vendor/bootstrap/js/popper.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
    <script src="vendor/select2/select2.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
    <script src="vendor/tilt/tilt.jquery.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
    <script src="js/mainlog.js"></script>
</body>
</html>