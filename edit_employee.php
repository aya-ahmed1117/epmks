<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="imag/logo.jpg">
  <?php //require_once("inc/config.inc");
    require_once("inc/config.inc");
    $role_id = $_SESSION['role_id'];?>
  <title>Employee edit page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap2.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap2.min.js"></script>

  <meta http-equiv="x-ua-compatible" content="IE=edge"/>
<meta property="og:image" content="http://te.eg/images/TE-Logo.jpg" />

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <?php 
 // require_once("inc/config.inc");
  if(empty($_SESSION['id'])){header("location: index.php");}
  if (isset($_GET['logout'])) {
    session_destroy();
    header("location: index.php");}
  ?> 
</head>
<body style="background-color:  rgb(100, 50, 90)  ;">
    <?php
if($_SESSION['role_id'] == 1){
  echo '
<body style="background-image:  url(imag/bg9.jpg);" class="col-m-10">

   <nav class="navbar navbar-expand-lg navbar-light bg-light" style="font-size: 15px; backface-visibility: hidden; border-radius: 10px 10px 20px 20px;">

 <!-- <a href="##" target="_blank"
         style="font-size: 15px; backface-visibility: hidden; border-radius: 10px 10px 20px 20px; width: 40px 0px 10px 0px;">
<button type="button"  class="btn btn-outline-warning">Dark</button></a>
<a href="##" target="_blank">
<button type="button" class="btn btn-outline-info">Info</button></a>-->

 <ul><img src="imag/logo.jpg" alt="logo.jpg"  style="padding: 1px; padding-bottom: 1px; margin-right: 1px; padding-top: 1px; padding-left: 1px; width: 25px; margin-bottom: 3px; "><span style="font-size:15px;font-family: Century Gothic; margin-right: 1px; ">WorkForce Managment Tool</span></ul> 

 <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

<li class="nav-item active">
        <a class="nav-link" href="home.php" target=""><i class="glyphicon glyphicon-home"></i> Go home <span class="sr-only">(current)</span></a>
      </li>

    <li class="nav-item active">
              <a class="nav-link" href="allstatus.php" target="">All status<span class="sr-only">(current)</span></a>
      </li>

    <li class="nav-item active">
           <a class="nav-link" href="welcomeadmin.php" target="">All views</a>
      </li>
      
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          View History
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="font-size: 15px;">
       <a class="dropdown-item" href="in&outadmin.php" target="">Sign Log History view</a>
          <a class="dropdown-item" href="utilizationadmin.php" target="">Utilization</a>
         <a class="dropdown-item" href="alldeduction.php" target="">Deduction History view</a>
          <a class="dropdown-item" href="scheduleadmin.php" target="">Schedule view</a>

    </ul>  
</li>

  </div>';}
    ?>
   <ul class="nav navbar-nav navbar-right">
<li ><a  style="color: #008882;" href="edit_password2.php"  target="_blank"><span class="glyphicon glyphicon-user"></span>Change Password</a></li>
      <li><a href="#" ><span class="glyphicon glyphicon-user"></span> login as <samp>:</samp><?php echo $_SESSION['username'];  ?></a></li>
          <li><a href="?logout"><span class="glyphicon glyphicon-log-in"></span>  Logout</a></li>
    </ul>
</nav>
<hr>
<?php
if($role_id == 1){
if (isset($_GET['id'])) { $id = $_GET['id']; }
$check = sqlsrv_query( $con ,"SELECT * FROM [employee] WHERE [id] = '$id'");
//$output = $check->fetch_array();
$output = sqlsrv_fetch_array($check );
$unit = $output['Unit_Name'];
}
?>
<style>
    form.content{
  margin: 0px auto;
  width: 58%;
  color: gray;
  background-image: url("");
   background-repeat: no-repeat;
background-size: cover;

  text-align: left;
  border-radius: 10px 10px 10px 10px;
  border: 5px solid;
padding: 20px;
padding-right: 5px;
  font-style: normal; 
  font-family: Century Gothic;

}
label{
  color: #eee;font-size: 18px;
}
.popup {

  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  border-radius: 5px;
  width: 100%;
  position: fixed;
  background: rgba(0, 0, 0, 0.7);
}
.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}

.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  background-color: #eee;
  width: 39%;
  margin: 200px 0 10px 30%;
  text-align: center;
  padding: 45px;
  border: 2px solid rgba(0, 0, 10, 0.7);
  border-radius: 20px/50px;
  font-size: 40px;
  color: black;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  
  .popup{
    width: 70%;
  }
}

           </style><form method="post" class="content" style="background-color:  #6b7477;">  
  <div class="form-group">
    <div class="row">
          <div class="form-group col-md-8">
   <label >UserName</label>       
<input class="form-control"  type="text" style="padding: 8px; font-size:15px;" name="username" placeholder="username" value="<?php echo $output['username']; ?>" ></div>
<br>
<br>
<br>
<hr>
 <?php
$username_update = $_SESSION['username'];
  if( ($_SESSION['username'] == 'aya.abdelfattah') ||
 ($_SESSION['username'] == 'belal.ezzat') || ($_SESSION['username'] == 'iman.makram')) {
  ?>

        <div class="form-group col-md-4">
   <label style="" >Password</label>       

<input class="form-control" type="text" style="padding: 8px; font-size:15px;" name="password" placeholder="password" value="<?php echo $output['password']; ?>"></div>
<?php 
}
 ?>
<br>

<div class="form-group col-md-4">
   <label >Select role id</label>
   <br>

   <select   name="role_id" style="padding: 8px; font-size:15px;" required="true">
  <option <?php if($output['role_id'] == 0) {echo "selected";}else{echo "";} ?> value="0">Engineer</option>
  <option <?php echo $output['role_id'] == 1 ? "selected" : ""; ?> value="1">Admin</option>
  <option <?php echo $output['role_id'] == 2 ? "selected" : ""; ?> value="2">Senior</option>
  <option <?php echo $output['role_id'] == 3 ? "selected" : ""; ?> value="3">Super</option>
  <option <?php echo $output['role_id'] == 4 ? "selected" : ""; ?> value="4">Section</option>
  <option <?php echo $output['role_id'] == 5 ? "selected" : ""; ?> value="5">Unit manager</option>
  <option <?php echo $output['role_id'] == 6 ? "selected" : ""; ?> value="6">Division</option>
  <option <?php echo $output['role_id'] == 7 ? "selected" : ""; ?> value="7">Chat</option>
</select>
</div>

<div class="form-group col-md-4">
   <label style="" >Select senior</label>
   <br>
<select  name="manager_id" style="padding: 8px; font-size:15px;" value="<?php echo $output['manager_id']; ?>">
  <option value="0">- Select senior</option> 
<?php
if($role_id == 1){
$checks = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [role_id] = '2' order by 2");
//while($outputs = $checks->fetch_array()){
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
  $rows .= $output['manager_id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['id'].'">'.$outputs['username'].'</option>';
  echo $rows;
}
}
?> 
</select></div>
<br>
<div class="form-group col-md-4">
   <label  style="" >Select super</label>
   <br>
<select  name="super_id" style="padding: 8px; font-size:15px;">
  <option value="0">- Select super</option> 
<?php
if($role_id == 1){
$checks = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [role_id] = '3' order by 2");
//while($outputs = $checks->fetch_array()){
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
  $rows .= $output['super_id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['id'].'">'.$outputs['username'].'</option>';
  echo $rows;
    }}
?> 
</select></div>
<br>
<div class="form-group col-md-4">
   <label >Select section</label>
   <br>
<select name="section_id" style="padding: 10px; font-size:15px;">
  <option value="">* Select section</option> 
<?php
if($role_id == 1){
$checks = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [role_id] = '4' order by 2");
//while($outputs = $checks->fetch_array()){
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
  $rows .= $output['section_id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['id'].'">'.$outputs['username'].'</option>';
  echo $rows;
}
}
?> 
</select></div>
<br>
<div class="form-group col-md-4">
   <label>Select Unit Manager</label>
   <br>
<select name="UnitManager_id" style="padding: 8px; font-size:15px;">
  <option value="">* Select Unit Manager</option> 
<?php
if($role_id == 1){
$checks = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [role_id] = '5' order by 2");
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
  $rows .= $output['UnitManager_id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['id'].'">'.$outputs['username'].'</option>';
  echo $rows;}}
?> 
</select></div>

<br>
          <div class="form-group col-md-4">
   <label >ID</label>       
<input class="form-control"type="number"style="padding: 8px; font-size:15px;"name="username_id"placeholder="user id"
value="<?php echo $output['username_id']; ?>"></div>
<br>
<div class="form-group col-s-4">
   <!--h4 style="color: lightgray;" >Your Selected Unite
   <input value="<?php echo  $unit; ?>"class="nav-link disabled" /></h4  -->
   <label >Select unit name</label>
   <br>
 <select name="Unit_Name" style="padding: 8px; font-size:15px;color:black;">
  <option value="<?php echo  $unit; ?>"><?php echo  $unit; ?></option>
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

$checks = sqlsrv_query( $con1 ,"SELECT 
      [Units] , [Units_ID]
  FROM [Employess_DB].[dbo].[Tbl_Units]");
//while($outputs = $checks->fetch_array()){
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
  $rows .= $output['id'] == $outputs['Unit_Name'] ? "selected" : " ";;
  $rows .= ' value="'.$outputs['Units'].'">'.$outputs['Units'].'</option>';
  echo $rows;

}}
?> 
</select></div>

<?php  //echo' <h6 style="color:#eee;"> '.$unit.'; </h6>'?>

<br>

<div class="form-group col-md-6">
   <br>
<input type="submit" name="save" value="Save" style="padding: 8px; font-size:15px;width: 35%;
outline: none;box-shadow: 0 15px 25px #eee;color: #fff;padding: 10px 20px;
cursor: pointer;border-radius: 10px;background: orange;">

</div>


<div class="form-group col-md-6">
   <br>
<input type="submit" name="submit" value="Reset Password" style="padding: 8px; font-size:15px;width: 45%;
outline: none;box-shadow: 0 15px 25px #eee;color: #fff;padding: 10px 20px;
cursor: pointer;border-radius: 10px;background: #B2D732;">

</div>

</div>
</form>
<br>
<?php 
/*
if(isset($_POST['save']))
{
  if(isset($_POST['username'])){$username = $_POST['username'];}
  $username_update = $_SESSION['username'];
    $creation_time = date ("Y-m-d H:i:s");

    $insertqry = sqlsrv_query( $con , "INSERT INTO [Aya_Web_APP].[dbo].[employee_demo] SELECT * ,'$username_update',
  '$creation_time' from employee where [id] = '$id' ");

echo "INSERT INTO [Aya_Web_APP].[dbo].[employee_demo] SELECT * ,'$username_update',
  '$creation_time'from employee where [username] = '$username' ";
   
if( $insertqry){
    echo "<h3 style='background-color:white; color:black; text-align: center ; border-radius: 0px 20px 0px 20px;
  border: 5px solid ; margin: 0px auto;
  width: 30%; padding:20px;'> INSERT done...</h3>";
  }
   }*/
   ?>
<?php
if(isset($_POST['save']))
{
  if(isset($_POST['username'])){$username = $_POST['username'];}
  if(isset($_POST['password'])){$password = $_POST['password'];}
  if(isset($_POST['role_id'])){$role_id = $_POST['role_id'];}
  if(isset($_POST['manager_id'])){$manager_id = $_POST['manager_id'];}
  if(isset($_POST['super_id'])){$super_id = $_POST['super_id'];}
  if(isset($_POST['section_id'])){$section_id = $_POST['section_id'];}
  if(isset($_POST['UnitManager_id'])){$UnitManager_id = $_POST['UnitManager_id'];}
  if(isset($_POST['Unit_Name'])){$Unit_Name = $_POST['Unit_Name'];}
  if(isset($_POST['username_id'])){$username_id = $_POST['username_id'];}
  $username_update = $_SESSION['username'];
  $creation_time = date ("Y-m-d h:i:s");


// insert 
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
       from employee where id = '$id')
     ,(select [add_Dtime] from employee where id = '$id')
    from employee where [id] = '$id' ");

 
/*if( $insertqry){
     "<h3 style='background-color:white; color:black; text-align: center ; border-radius: 0px 20px 0px 20px;
  border: 5px solid ; margin: 0px auto;jjjjj
  width: 30%; padding:20px;'> INSERT done...</h3>";
  }*/
  //update
    if( ($_SESSION['username'] == 'aya.abdelfattah') ||
 ($_SESSION['username'] == 'belal.ezzat') || ($_SESSION['username'] == 'iman.makram')) {
      $update_query = sqlsrv_query( $con , "UPDATE employee SET [username] = '$username',password='$password', role_id = '$role_id', [manager_id] = '$manager_id' , [super_id] = '$super_id' , [section_id] = '$section_id' , [UnitManager_id] = '$UnitManager_id' ,[Unit_Name] = '$Unit_Name' , [username_id] = '$username_id' , [updated_by] = '$username_update' , 
    [creation_time]='$creation_time' WHERE [id] = '$id'");
  }


  $update_query = sqlsrv_query( $con , "UPDATE employee SET [username] = '$username', role_id = '$role_id', [manager_id] = '$manager_id' , [super_id] = '$super_id' , [section_id] = '$section_id' , [UnitManager_id] = '$UnitManager_id' ,[Unit_Name] = '$Unit_Name' , [username_id] = '$username_id' , [updated_by] = '$username_update' , 
    [creation_time]='$creation_time' WHERE [id] = '$id'");
  if($update_query){
 echo "<h3 style='background-color:white; color:black; text-align: center ; border-radius: 0px 20px 0px 20px;
  border: 5px solid ; margin: 0px auto;
  width: 30%; padding:20px;'> Done...</h3>";}else{ echo 'error';}
}

?>

<?php 


if(isset($_POST['submit']))
{
    $username_update = $_SESSION['username'];
      $creation_time = date ("Y-m-d h:i:s");



$update_query =sqlsrv_query($con ,"UPDATE employee SET [password] = '123' , [updated_by] = '$username_update' , 
    [creation_time]='$creation_time' WHERE  id ='$id' ");


  if($update_query){
 echo 
 '<div class="popup" id="message">
<div class="content" name="done" ><h2> Your Password has been Reset<i class="fas fa-thumbs-up"></i> </h2></div>
</div>';
}
  else{ echo 'error';}
}


?>




<script type="text/javascript">
  setTimeout(function() {
  document.getElementById("message").style.display = 'none';
}, 3000);
</script>
</body>
</html>