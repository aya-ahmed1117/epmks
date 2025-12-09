<!DOCTYPE html> 
<html>
<head>
    <link rel="icon" href="imag/logo.jpg">
    <?php 
    //require_once("inc/config.inc");
        require_once("inc/config.inc");?>
        <?php
    $role_id = $_SESSION['role_id'];
if($role_id == 1){
    $username = $_SESSION['username'];
if (isset($_GET['id'])){$idd = $_GET['id']; }
$check = sqlsrv_query( $con ,"SELECT * FROM [employee] ");
//$output = $check->fetch_array();
$output = sqlsrv_fetch_array($check );
$orders_num = 1;}
$username_id = $output['username_id'];

?>
        <title>Register Page</title>
          <?php 
  if($_SESSION['username'] == '' || $_SESSION['username'] == null ){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php");}
     // session_unset();
if(empty($_SESSION['id'])){header("location: index.php");}
  if (isset($_GET['logout'])) {
    session_destroy();
    header("location: index.php");}?>
         <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="/TEDataResources/images/te.ico" rel="shortcut icon" type="image/x-icon" />

<link rel="stylesheet" href="css/font-awesome.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap2.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>

    </head>

        <?php 
        if($_SESSION['role_id'] == 1){
    echo'<style type="text/css">
   /* body{
        color: #fff;
        background: #63738a;
        font-family: "Roboto", sans-serif;
    }*/

    body {
 background-image:   url(imag/wallpaper.jpg);
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background-repeat:no-repeat;
    background-size: cover;
    
}

    .form-control{
        height: 40px;
        color: #969fa4;
    }
    .form-control:focus{
        border-color: #5cb85c;
        box-shadow: 0 15px 25px #8a7f8d;

    }
    .form-control, .btn{        
        border-radius: 3px;
        box-shadow: 0 15px 25px #8a7f8d;

    }
    .signup-form{
        width: 580px;
        margin: 0 auto;
        padding: 30px 0 ;
    }
    .signup-form h2{
        color: #636363;
        margin: 0 0 15px;
        position: relative;
        text-align: center;
    }
    .signup-form h2:before, .signup-form h2:after{
        content: "";
        height: 2px;
        width: 30%;
        background: #d4d4d4;
        position: absolute;
        top: 50%;
        z-index: 2;
    }   
    .signup-form h2:before{
        left: 0;
    }
    .signup-form h2:after{
        right: 0;
    }
    .signup-form .hint-text{
        color: #999;
        margin-bottom: 30px;
        text-align: center;
        box-shadow: 0 15px 25px #8a7f8d;

    }
    .signup-form form{
        color: #999;
        border-radius: 3px;
        margin-bottom: 15px;
        background: #eee;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .signup-form .form-group{
        margin-bottom: 20px;
    }
    .signup-form input[type="checkbox"]{
        margin-top: 3px;
    }
    .signup-form .btn{        
        font-size: 16px;
        font-weight: bold;      
        min-width: 140px;
        outline: none !important;
    }
    .signup-form .row div:first-child{
        padding-right: 10px;

    }
    .signup-form .row div:last-child{
        padding-left: 10px;
    }       
    .signup-form a{
        color: #fff;
        text-decoration: underline;
    }
    .signup-form a:hover{
        text-decoration: none;
    }
    .signup-form form a{
        color: #5cb85c;
        text-decoration: none;
    }   
    .signup-form form a:hover{
        text-decoration: underline;
    } 
</style>

<body>
<nav class="navbar navbar-inverse"style="background-image: url(imag/purple_chat.jpg);" >
  
  <div class="container-fluid">
    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
        <span class="icon-bar"></span>                        
        <span class="icon-bar"></span>                        
      </button>
<ul class="nav navbar-nav"><img src="imag/logo.jpg" style="margin-left:-3px ;padding: 1px; padding-bottom: 1px; margin-right: 1px;padding-left: 1px; width: 22px; margin-bottom: 20px; "><span style="font-size:15px;font-family: Century Gothic; margin-right: 1px; color: #eee;">WorkForce Managment Tool</span></ul> </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li> <a class="nav-link" href="theme.php" style="color: #eee;">Home<span class="sr-only">(current)</span></a></li>
        <li><a class="nav-link" href="employee.php" style="color: #eee;">Employee</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">';}?>

<li ><a  style="color: #f6aa51;" href="edit_password.php"  ><span class="glyphicon glyphicon-user"></span>Change Password</a></li>
      <li ><a href="#" style="color: #eee;"><span class="glyphicon glyphicon-user"></span> login as <samp>:</samp>
        <?php echo $_SESSION["username"];  ?> <br>Unit:<?php echo $output["Unit_Name"];?></a></li>

      <li ><a href="?logout" style="color: #eee;"><span  class="glyphicon glyphicon-log-in navbar-right" style="color: #eee;"></span> Logout</a></li>

      </ul>
    </div>
  </div>

</nav>

 <?php 
        if($_SESSION['role_id'] == 1){
            echo'
<div class="signup-form">
        
    <form  method="post" style="box-shadow: 0 15px 25px #ffe6e6;width:150%;margin-left:-32%;padding-bottom: 3px;padding-left:-30px;">
        <h2>Register</h2>
        <p class="hint-text">Create your account. It only takes a minute.</p>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-4">
        <input class="form-control" type="text" name="username" placeholder="Enter Username"  required="required">

        </div>
        <br>
        <br>
        <br>
        <div class="form-group col-xs-4">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <br>
        <br>
        <br>

        <div class="form-group col-xs-4">
            <input type="password" class="form-control" name="repassword" placeholder="Confirm Password" required="required">
        </div>  
        <br>
        <br>
        <br>

<div class="form-group col-xs-4" >
    <label style="padding: 8px; font-size:15px;">role_id</label>
        <input type="number"  name="role_id" value="0" placeholder="Enter 0" style="padding: 8px; font-size:15px;width:50%;">
                 </div>

<div class="form-group col-xs-4" style="transform: translate(46%,-120px);">
   <label>Select senior</label>
<select  name="manager_id" style="padding: 8px; font-size:15px;">
  <option value="0">- Select senior</option> ';}?>
  <br>
  <br>
<?php
$checks = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 2 order by 2 ");
//while($outputs = $checks->fetch_array()){
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
  $rows .= $output['manager_id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['id'].'">'.$outputs['username'].'</option>';
  echo $rows;}
  echo'</select></div>';?> 
 <br>
<div class="form-group col-md-4"style="transform: translate(-55%,-210px);" >
   <label >Select Unite</label>
   <br>
<select name="Unit_Name" style="padding: 4px; font-size:15px;">
  <option value="">* Select Unit</option> 
<?php
if($role_id == 1){
  date_default_timezone_set('Africa/Cairo');
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );

$gogo = sqlsrv_query( $con1 ,"SELECT  
      [Units] , [Units_ID]
  FROM [Employess_DB].[dbo].[Tbl_Units]");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['Unit_Name'] == $index['Units_ID'] ? "selected" : "";;
  $rows .= 'value="'.$index['Units'].'">'.$index['Units'].'</option>';
  echo $rows;}}?> 
</select></div>

<br>
<?php 
 if($_SESSION['role_id'] == 1){
    echo'
<div class="form-group" >
            <div class="row">
                <div class="col-xs-4" style="transform: translate(146%,-120px);">
        <input class="form-control" type="number" name="username_id" placeholder="Enter ID"  ">

        </div>
<hr>
     <div class="form-group">
    <input type="submit" class="btn btn-success btn-lg btn-block btn-login" name="signup" value="Sign UP" style="margin-left:65%;width:33%;transform: translate(20px,25px);"></input>
        </div>
<div class="form-group">
          <input  type="reset" value="reset" style=" background: transparent;
    border: none;margin-left:85%;
    outline: none;box-shadow: 0 15px 25px #eee;
    color: #fff;transform: translate(30px,20px);
    background: orange;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 10px;">
        </div>
    </form>
    </div>';}?>
         <?php 
 
        if(isset($_POST['username'])){ $username = $_POST['username']; }
        if(isset($_POST['password'])){ $password = $_POST['password']; }
        if(isset($_POST['repassword'])){ $repassword = $_POST['repassword']; }
        if(isset($_POST['role_id'])){$role_id = $_POST['role_id'];}
        if(isset($_POST['manager_id'])){$manager_id = $_POST['manager_id'];}
        if(isset($_POST['Unit_Name'])){$Unit_Name = $_POST['Unit_Name'];}
        if(isset($_POST['username_id'])){$username_id = $_POST['username_id'];}


        if (isset($_POST['signup'])) {
            if ($password !== "" && $username !== "" && $role_id !== "" && $manager_id !== "" && $repassword !== "") {
                if ($password == $repassword)
{sqlsrv_query( $con ,"INSERT INTO employee ([username], [password], [role_id], [manager_id] , [Unit_Name] , 
  [username_id]) VALUES ('$username', '$password', '$role_id', '$manager_id' ,'$Unit_Name' , '$username_id')");

    echo "<h3 style='background-color:#63738a; color:black; text-align: center ; border-radius: 0px 20px 0px 20px;
  border: 5px solid ; margin: 0px auto;
  width: 50%; padding:30px;'> Done...</h3>";}
                } else { echo 'password input fields donot match.'; }
            } //else { echo 'required field mustnot be empty.'; }
        
//$con->query("INSERT INTO employee (username, passwor) VALUES ('$username', '$password')");

        ?>     
    </body>
    
</html>







