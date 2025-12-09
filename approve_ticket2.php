
 <?php
        require_once("inc/config.inc");
  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      ?>


<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="imag/logo.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update ticket</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style4.css">


</head>
<body>
       <?php /*
if($_SESSION['username'] == 'peter.saleeb'){   
    echo'';} */?>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>WFM </h3>
                <strong>Wfm</strong>
            </div>

            <ul class="list-unstyled components">
              
                <li>
                    <a href="home.php">
                    <i class="fas fa-home"></i>
                        Home
                    </a>
            <?php
            if($_SESSION['role_id'] == 0) {
              echo'
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        Create new
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">

                     <li>
                           <a href="leaves2.php">Create New leaves</a>
                        </li>
                        <li>
                            <a href="deductions2.php">Create Deduction Complain</a>
                        </li>
                        <li>
                            <a href="create_task2.php">Create New Task</a>
                        </li>
                        
                    </ul>
                </li>';}?>
      
                      <?php
        if($_SESSION['role_id'] == 0) {
          echo'
                  <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-briefcase"></i>
                        View History
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="signview2.php">Sign Log History view</a>
                        </li>
                        <li>
                            <a href="leavesview2.php">leaves History view</a>
                        </li>
              
                        <li>
                            <a href="deductionview2">Deduction History view</a>
                        </li>
                         <li>
                    <a href="welcomeadmin2.php">
                        <i class="fas fa-copy"></i>
                        Tasks History view
                    </a>
                </li>
                      
                    </ul>
                </li>';}?>
                
                      <?php
        if($_SESSION['role_id'] == 0){
echo'

                <li>
                    <a href="utilization2.php">
                        <i class="fas fa-image"></i>
                        My utilization
                    </a>
                </li>
                <li>
                    <a href="schedule2.php">
                        <i class="fas fa-copy"></i>
                        My schedule
                    </a>
                </li>

';}?>
  <?php 
                if($_SESSION['role_id'] == 1){
                  echo '             
                   <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"style="background-color:#82b74b;">
                    <i class="fas fa-copy"></i>
                   Ticketing Pages
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="approve_request.php">Approve ticket</a>
                    </li>
                    <!--li>
                        <a href="view_my_ticket.php">View ticket</a>
                    </li-->
                  
                </ul>
            </li>';}?>
     <?php
        if(($_SESSION['role_id'] == 1) || ($_SESSION['role_id'] == 2) || ($_SESSION['role_id'] == 3) || ($_SESSION['role_id'] == 4)){
          echo'
                  <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-briefcase"></i>
                        Open Me
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="in_and_out2">Sign Log History view</a>
                        </li>
                        <li>
                            <a href="utilizationadmin2">Utilization</a>
                        </li>
                        <li>
                            <a href="alldeduction2">Deduction History view</a>
                        </li>
                        <li>
                            <a href="scheduleadmin2">Schedule view</a>
                        </li>
                    </ul>
                </li>
                 <li>
                    <a href="allstatus2">
                        <i class="fas fa-copy"></i>
                        All views
                    </a>
                </li>
                <li>
                    <a href="welcomeadmin2.php" >
                        <i class="fas fa-copy"></i>
                        Check request
                    </a>
                </li>';}?>
            
                  

  <li ><a  style="color: #6666;" href="edit_password2.php"><span class="glyphicon glyphicon-user"></span>Change Password</a></li>

      <li><a href="?logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    
<?php 
  if(($_SESSION['role_id'] == 1) || ($_SESSION['role_id'] == 2) || ($_SESSION['role_id'] == 3) || ($_SESSION['role_id'] == 4) || ($_SESSION['role_id'] == 0)  ){
$engineer_id = $_SESSION['id'];

$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id  = 482 ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  //$output_engineers = $check_engineers->fetch_array()){
  $engineers_id = $output_engineers['id'];
  
  $check_orders = sqlsrv_query( $con ,"SELECT * FROM chat_box WHERE [send_to] = '$engineers_id'" , array() , array('Scrollable' =>'static') );
  $orders_num = sqlsrv_num_rows($check_orders);
  $sqltime = date ("Y-m-d H:i:s");
     $time =['when_time'];

 
  $check_orders2 = sqlsrv_query( $con ,"SELECT * FROM chat_box WHERE [send_from] = '$engineers_id'" , array() , array('Scrollable' =>'static') );
  $orders_num2 = sqlsrv_num_rows($check_orders2);

  //$max = $orders_num2 - $orders_num;
   if($max = $orders_num2 >= $orders_num ){
  echo'<label class="glyphicon glyphicon-bell" align="center"style="color:#FBBC05;font-size:22px;  height: 35px;text-align:center;
  width: 35px;border-radius: 60%;"></label>' ;}

 $rows ="<tr>";
  $rows.=$max."<td style='border: 1px solid gray;font-size:13px;background-color:#eee;'>".$output_engineers['username']."</td>";

  //if ($orders_num > 0)
   
 $rows.="<div id='myDIV' style=' padding: 10px;'>
  <a style='color:black;'href='chating2.php?engineer_id=".$engineers_id."'>Chat</a></li></div>";
        
      '<div id="myDIV" style=" padding: 9px;margin-left:-6%;">
  <li class="img-circle" style="color:#1e7145; font-size: 22px;margin-left:-6%;"><a style="color:#2A4B7C;margin-left:28%;" href="chating2.php?engineer_id=482"'.$engineers_id.'">Chat</a></li></div>';
  $rows.="</tr>";
}
}
?>
    
<style> 
#myDIV {
  -webkit-animation: mymove 5s infinite;
  animation: mymove 2s infinite;
}


@-webkit-keyframes mymove {
  20% {text-shadow: 2px 5px 10px red;}
}


@keyframes mymove {
  70% {text-shadow: 2px 5px 10px red;}
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

</style>
  
<?php
echo'
                <li >
                    <a id="myDIV"  href="chating2.php?engineer_id='.$engineers_id.'">
                        <i class="fas fa-paper-plane"></i>
                        Contact
                    </a>
                </li>';?>
            </ul>

            <ul class="list-unstyled CTAs">
    
            </ul>
        </nav>

        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <!--span>Toggle Sidebar</span-->
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul><img src="imag/logo.jpg" alt="logo.jpg"  style="padding: 1px; padding-bottom: 1px; margin-right: 1px; padding-top: 1px; padding-left: 1px; width: 25px; margin-bottom: 3px; "><span style="font-size:15px;font-family: Century Gothic; margin-right: 1px; ">WorkForce Managment Tool</span></ul> 
                        <ul class="nav navbar-nav ml-auto">
                            <?php 

if (isset($_SESSION['id'])) { $aya = $_SESSION['id']; }
$checkme = sqlsrv_query( $con ,"SELECT * FROM [employee] WHERE [id] = '$aya'");
$output = sqlsrv_fetch_array($checkme );
$Unit_Name = $output['Unit_Name'];
$username_id = $output['username_id'];
      ?>
 <li ><a href="#" style="font-size: 9.5px;"><span class="glyphicon glyphicon-user"></span> login as <samp>:</samp>
        <?php echo $_SESSION["username"];?><h6 style="color: orange;font-size: 10px;text-align: justify;text-indent: 10px;letter-spacing: -.5px;line-height: 0.8;" >Unit:<?php echo $output["Unit_Name"];?></h6></a></li>
                      
<li><a href="?logout"><span class="glyphicon glyphicon-log-in "></span> Logout</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
                         	<?php

if (isset($_GET['Request_ID'])) { $id = $_GET['Request_ID']; }
$id = $_GET['Request_ID'];

 $checks = sqlsrv_query( $con ,"SELECT * FROM [tbl_Ticketing_system] where Request_ID = '$id' ");
  $output_query = sqlsrv_fetch_array($checks);
$user = $output_query["Requester_username"];
$Request_status = $output_query["Request_status"];


?>
<?php 

 if (isset($_GET['Employee_app_Id'])) { $aya = $_GET['Employee_app_Id']; }
 if (isset($_GET['Request_ID'])) { $id = $_GET['Request_ID']; }
 ?>

             <form method="post"  >

         <div style=" border-width:5px; color: gray; 
    border-style:ridge;">
             		<div style="padding-bottom: 18px;" >Select<br/>
<select name="Request_status"  style="padding: 8px; font-size:15px;" required>
  <option value=""><?php echo $Request_status; ?></option> 
  <option value="in progress">in progress</option> 
  <option value="pending to requester">pending to requester</option>
  <option value="on hold">on hold</option>
  <option value="closed">closed</option>

</select>
</div>
<div style="padding-bottom: 18px;">Update note<br/>
<textarea  name="WFM_Update_note" style="width : 300px;" rows="6"></textarea>
</div>
<div style="padding-bottom: 18px;">
  <input name="formSubmit" value="submit" type="submit"/>
</div>
</div>
 <?php
 //if (isset($_GET['schedule'])) {
if(isset($_POST['formSubmit'])){
  
if (isset($_GET['Request_ID'])) { $idRequest = $_GET['Request_ID']; }
if(isset($_POST['Request_status'])){$Request_status = $_POST['Request_status'];}

$first_query = sqlsrv_query( $con ,"SELECT * FROM [tbl_Ticketing_system] where Request_ID = '$id' ");
  $output_query = sqlsrv_fetch_array($first_query);
 $note2 =$output_query["WFM_Update_note"];
//  [Note] = '$Note'+' _ '+'$note2'

$escaped_str = $_POST['WFM_Update_note'];
 //addslashes($notes) ;
 $WFM_Update_note = str_replace("'", "`", $escaped_str);

//$WFM_Update_note = $_POST['WFM_Update_note'];
// progress
 $inprogress_time =date ("Y/m/d H:i:s");
 $inprogress_username =$_SESSION['username'];
// on hold
 $Onhold_time =date ("Y-m-d H:i:s");
 $Onhold_Username = $_SESSION['username'];
//closed
 $Closed_time =date ("Y-m-d H:i:s");
 $Closed_username = $_SESSION['username'];
//pending to requester
 $Pending_to_requester_time =date ("Y-m-d H:i:s");
 $Pending_to_requester_Username = $_SESSION['username'];
//pending to admin
 $Pending_to_workforce_time =date ("Y-m-d H:i:s");
 $Pending_to_workforce_Username = $_SESSION['username'];
if($_POST['Request_status'] == 'in progress'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = '$Request_status', 
  [WFM_Update_note] = '$WFM_Update_note' +' _ '+'$note2' , [inprogress_username] = '$inprogress_username' 
   , [inprogress_time] = '$inprogress_time' 
     WHERE Request_ID = '$idRequest' ");}

if($_POST['Request_status'] == 'pending to requester'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = '$Request_status', 
  [WFM_Update_note] = '$WFM_Update_note' +' _ '+'$note2',
   [Pending_to_requester_time] = '$Pending_to_requester_time' 
, [Pending_to_requester_Username] = '$Pending_to_requester_Username' 
     WHERE Request_ID = '$idRequest' ");}

if($_POST['Request_status'] == 'pending to admin'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = '$Request_status', 
  [WFM_Update_note] = '$WFM_Update_note' +' _ '+'$note2' , 
  [Pending_to_workforce_time] = '$Pending_to_workforce_time' ,
  [Pending_to_workforce_Username] = '$Pending_to_workforce_Username' 
     WHERE Request_ID = '$idRequest' ");}

if($_POST['Request_status'] == 'on hold'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = '$Request_status', 
  [WFM_Update_note] = '$WFM_Update_note' +' _ '+'$note2' ,
  [Onhold_time] = '$Onhold_time' ,
  [Onhold_Username] = '$Onhold_Username' 
   WHERE Request_ID = '$idRequest' ");}

if($_POST['Request_status'] == 'closed'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = '$Request_status', 
  [WFM_Update_note] = '$WFM_Update_note'+'_'+'$note2', [Closed_time] = '$Closed_time',
  [Closed_username] = '$Closed_username'
     WHERE Request_ID = '$idRequest' ");}


//echo " UPDATE deduction SET type = '$type' , note = '$note',  status = '$status' WHERE id = '$id'";
if($update_query){
 echo "<div class='popup' id='message'>
 <div class='content' name='done' >
 <h2> Ticket has been updated...</h2></div>
</div>";
}else{ echo 'error';}
}?>
  <?php
  /*
 //if (isset($_GET['Management'])) {
if(isset($_POST['formSubmit'])){
  
if (isset($_GET['Request_ID'])) { $idRequest = $_GET['Request_ID']; }
if(isset($_POST['Request_status'])){$Request_status = $_POST['Request_status'];}


$first_query = sqlsrv_query( $con ,"SELECT * FROM [tbl_Ticketing_system] where Request_ID = '$id' ");
  $output_query = sqlsrv_fetch_array($first_query);
 $note2 =$output_query["WFM_Update_note"];
//  [Note] = '$Note'+' _ '+'$note2'


$escaped_str = $_POST['WFM_Update_note'];
 //addslashes($notes) ;
 $WFM_Update_notes = str_replace("'", "''", $escaped_str);

//$WFM_Update_note = $_POST['WFM_Update_note'];
// progress
 $inprogress_time =date ("Y/m/d H:i:s");
 $inprogress_username =$_SESSION['username'];
// on hold
 $Onhold_time =date ("Y-m-d H:i:s");
 $Onhold_Username = $_SESSION['username'];
//closed
 $Closed_time =date ("Y-m-d H:i:s");
 $Closed_username = $_SESSION['username'];
//pending to requester
 $Pending_to_requester_time =date ("Y-m-d H:i:s");
 $Pending_to_requester_Username = $_SESSION['username'];
//pending to admin
 $Pending_to_workforce_time =date ("Y-m-d H:i:s");
 $Pending_to_workforce_Username = $_SESSION['username'];

if($_POST['Request_status'] == 'in progress'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = '$Request_status', 
	[WFM_Update_note] = '$WFM_Update_notes'+'_'+'$note2' , [inprogress_username] = '$inprogress_username' 
	 , [inprogress_time] = '$inprogress_time' 
	   WHERE Request_ID = '$idRequest' ");}

if($_POST['Request_status'] == 'pending to requester'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = '$Request_status', 
	[WFM_Update_note] = '$WFM_Update_notes'+'_'+'$note2' ,
	 [Pending_to_requester_time] = '$Pending_to_requester_time' 
, [Pending_to_requester_Username] = '$Pending_to_requester_Username' 
	   WHERE Request_ID = '$idRequest' ");}



if($_POST['Request_status'] == 'pending to admin'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = '$Request_status', 
	[WFM_Update_note] = '$WFM_Update_notes'+'_'+'$note2', 
	[Pending_to_workforce_time] = '$Pending_to_workforce_time' ,
	[Pending_to_workforce_Username] = '$Pending_to_workforce_Username' 
	   WHERE Request_ID = '$idRequest' ");}

if($_POST['Request_status'] == 'on hold'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = '$Request_status', 
	[WFM_Update_note] = '$WFM_Update_notes'+'_'+'$note2',
	[Onhold_time] = '$Onhold_time',
	[Onhold_Username] = '$Onhold_Username'  WHERE Request_ID = '$idRequest' ");}

if($_POST['Request_status'] == 'closed'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = '$Request_status', 
	[WFM_Update_note] = '$WFM_Update_notes'+'_'+'$note2',
    [Closed_time] = '$Closed_time',
	[Closed_username] = '$Closed_username'
	   WHERE Request_ID = '$idRequest' ");}

//echo " UPDATE deduction SET type = '$type' , note = '$note',  status = '$status' WHERE id = '$id'";
if($update_query){
 echo "<div class='popup' id='message'>
 <div class='content' name='done' >
 <h2> Ticket has been updated <i class='fas fa-thumbs-up'></i>...</h2></div></div>";}else{ echo 'error';}
}//}
*/
?>
<?php 
 
if(isset($_GET['Employee_app_Id'])){
  $engineer_ids = $_GET['Employee_app_Id'];}

if (isset($_GET['Request_ID'])) { 
	$id = $_GET['Request_ID']; }
if (isset($_GET['Management'])) {
if($_SESSION['role_id'] == 1)
{

if (isset($_GET['Request_ID'])) { $idRequest = $_GET['Request_ID']; }
$first_query = sqlsrv_query( $con ,"SELECT *  FROM tbl_Ticketing_system WHERE Request_ID = '$idRequest' order by 6");

   while( $output_query = sqlsrv_fetch_array($first_query)){

$rows  =   '<div style="width:200px;"><br/>';

 $rows .= '<div style="padding-bottom: 18px;" >Employee Username<br/>
<input  disabled value="'.$output_query["Employee_Username"].'" style="width:120%;" />
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Last working date<br/>
<input disabled value="'.$output_query["Last_working_date"]->format('Y-m-d H:i:s').'" style="width:120%;"/>
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Employee new manager<br/>
<input disabled value="'.$output_query["Employee_new_manager"].'" style="width:120%;"/>
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Ticket Subject<br/>
<input disabled value="'.$output_query["Ticket_Subject"].'" style="width:120%;"/>
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Description<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;"  value="'.$output_query["Note"].'"> '.$output_query["Note"].'</textarea>
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Old WFM note<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;"  value="'.$output_query["WFM_Update_note"].'"> '.$output_query["WFM_Update_note"].'</textarea>
</div>';
$rows .=   '</div>';

  echo $rows;
  }} }?>

  <?php 
/*
Employee_Username
Last_working_date
Employee_new_username
Employee_new_id
3*/

if(isset($_GET['Employee_app_Id'])){
  $engineer_ids = $_GET['Employee_app_Id'];}
if (isset($_GET['Request_ID'])) { 
  $id = $_GET['Request_ID']; }
if (isset($_GET['Staff'])) {

if($_SESSION['role_id'] == 1)
{
 
if (isset($_GET['Request_ID'])) { $idRequest = $_GET['Request_ID']; }
$first_query = sqlsrv_query( $con ,"SELECT *  FROM tbl_Ticketing_system WHERE Request_ID = '$idRequest' order by 6");

   while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  =   '<div style="width:200px;"><br/>';

 $rows .= '<div style="padding-bottom: 18px;" >Employee Username<br/>
<input  disabled value="'.$output_query["Employee_Username"].' " style="width:120%;"/>
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Last working date<br/>
<input disabled value="'.$output_query["Last_working_date"]->format('Y-m-d H:i:s').'" style="width:120%;"/>
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Employee new username<br/>
<input disabled value="'.$output_query["Employee_new_username"].'" style="width:120%;"/>
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Employee new id<br/>
<input disabled value="'.$output_query["Employee_new_id"].'" style="width:120%;"/>
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Ticket Subject<br/>
<input disabled value="'.$output_query["Ticket_Subject"].'" style="width:120%;"/>
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Description<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;"  value="'.$output_query["Note"].'"> '.$output_query["Note"].'</textarea>
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Old WFM note<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;"  value="'.$output_query["WFM_Update_note"].'"> '.$output_query["WFM_Update_note"].'</textarea>
</div>';
$rows .='</div>';

  echo $rows;
  }} }

  ?>

    <?php 
if(isset($_GET['Employee_app_Id'])){
  $engineer_ids = $_GET['Employee_app_Id'];}
if (isset($_GET['Request_ID'])) { 
  $id = $_GET['Request_ID']; }
if (isset($_GET['Resign'])) {

if($_SESSION['role_id'] == 1)
{
 
if (isset($_GET['Request_ID'])) { $idRequest = $_GET['Request_ID']; }
$first_query = sqlsrv_query( $con ,"SELECT *  FROM tbl_Ticketing_system WHERE Request_ID = '$idRequest' order by 6");

   while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  =   '<div style="width:200px;"><br>';

 $rows .= '<div style="padding-bottom: 18px;" >Employee_Username<br/>
<input  disabled value="'.$output_query["Employee_Username"].' "/>
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Last_working_date<br/>
<input disabled  value="'.$output_query["Last_working_date"]->format('Y-m-d H:i:s').'" style="width:120%;"/>
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Reason_of_leave<br/>
<input disabled style="width :50%; padding:5%;"  value="'.$output_query["Reason_of_leave"].'" style="width:120%;"/>
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Ticket Subject<br/>
<input disabled style="width :50%; padding:5%;"  value="'.$output_query["Ticket_Subject"].'" style="width:120%;"/>
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Description<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;"  value="'.$output_query["Note"].'"> '.$output_query["Note"].'</textarea>
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Old WFM note<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;"  value="'.$output_query["WFM_Update_note"].'"> '.$output_query["WFM_Update_note"].'</textarea>
</div>';

$rows .='</div>';
$rows .= ' <div style="width: 400px;">
</div> ';
  echo $rows;
  }} }

  ?>

  <?php 

if(isset($_GET['Employee_app_Id'])){
  $engineer_ids = $_GET['Employee_app_Id'];}
if (isset($_GET['Request_ID'])) { 
  $id = $_GET['Request_ID']; }
if (isset($_GET['Promotion'])) {

if($_SESSION['role_id'] == 1)
{
 
if (isset($_GET['Request_ID'])) { $idRequest = $_GET['Request_ID']; }
$first_query = sqlsrv_query( $con ,"SELECT *  FROM tbl_Ticketing_system WHERE Request_ID = '$idRequest' order by 6");

   while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  =   '<div style="width: 400px;">';

 $rows .= '<div style="padding-bottom: 18px;" >Request_ID<br/>
<input  disabled value="'.$output_query["Employee_Username"].' "/>
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Last working date<br/>
<input disabled value="'.$output_query["Last_working_date"]->format('Y-m-d H:i:s').'" />
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Grade<br/>
<input disabled value="'.$output_query["Employee_grade"].'" />
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Ticket Subject<br/>
<input disabled value="'.$output_query["Ticket_Subject"].'" />
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Description<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;"  value="'.$output_query["Note"].'"> '.$output_query["Note"].'</textarea>
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Old WFM note<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;"  value="'.$output_query["WFM_Update_note"].'"> '.$output_query["WFM_Update_note"].'</textarea>
</div>';
$rows .='</div>';
$rows .= ' <div style="width: 400px;">
</div> ';
  echo $rows;
  }} }

  ?>

  <?php 
 
if(isset($_GET['Employee_app_Id'])){
  $engineer_ids = $_GET['Employee_app_Id'];}

if (isset($_GET['Request_ID'])) { 
  $id = $_GET['Request_ID']; }
if (isset($_GET['recored'])) {
if($_SESSION['role_id'] == 1)
{

if (isset($_GET['Request_ID'])) { $idRequest = $_GET['Request_ID']; }
$first_query = sqlsrv_query( $con ,"SELECT *  FROM tbl_Ticketing_system WHERE Request_ID = '$idRequest' order by 6");

   while( $output_query = sqlsrv_fetch_array($first_query)){

$rows  =   '<div style="width: 400px;">';

$rows .= '<div style="padding-bottom: 18px;" >Ticket Subject<br/>
<input disabled value="'.$output_query["Ticket_Subject"].'" />
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Description<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;"  value="'.$output_query["Note"].'"> '.$output_query["Note"].'</textarea>
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Old WFM note<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;"  value="'.$output_query["WFM_Update_note"].'"> '.$output_query["WFM_Update_note"].'</textarea>
</div>';
$rows .=   '</div>';
$rows .=   ' <div style="width: 400px;">

</div>  ';
  echo $rows;
  }} }?>

  <?php 
///sub_group
if(isset($_GET['Employee_app_Id'])){
  $engineer_ids = $_GET['Employee_app_Id'];}
if (isset($_GET['Request_ID'])) { 
  $id = $_GET['Request_ID']; }
if (isset($_GET['sub_group'])) {

if($_SESSION['role_id'] == 1)
{
if (isset($_GET['Request_ID'])) { $idRequest = $_GET['Request_ID']; }
$first_query = sqlsrv_query( $con ,"SELECT *,
CASE
    WHEN sub_group ='1' THEN 'phone'
    WHEN sub_group ='2' THEN 'Resident'
    WHEN sub_group ='3' THEN 'Mail'
    WHEN sub_group ='4' THEN 'TAM'
    WHEN sub_group ='5' THEN 'Schools'
    WHEN sub_group ='6' THEN 'Mega Projects'
   else 'null'
        END sub_group2
         FROM tbl_Ticketing_system  WHERE Request_ID = '$idRequest' order by 6");
       while( $output_query = sqlsrv_fetch_array($first_query)){
    $rows  =   '<div style="width: 400px;">';
 $rows .= '<div style="padding-bottom: 18px;" >Username<br/>
<input  disabled value="'.$output_query["Employee_Username"].' "/>
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Last working date<br/>
<input disabled value="'.$output_query["Last_working_date"]->format('Y-m-d H:i:s').'" />
</div>';
$rows .= '<div style="padding-bottom: 18px;">Sub Group<br/>
<input disabled value="'.$output_query["sub_group2"].'" />
</div>';
$rows .= '<div style="padding-bottom: 18px;" >Ticket Subject<br/>
<input disabled value="'.$output_query["Ticket_Subject"].'" />
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Description<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;" value="'.$output_query["Note"].'"> '.$output_query["Note"].'</textarea>
</div>';
$rows .= '<div style="padding-bottom: 18px; word-wrap: break-word;" >Old WFM note<br/>
<textarea disabled wrap="hard" style="width :250%;border: 2px solid gray;padding:5%;padding-left:0;background-color:lightgray;
  text-align: justify;color:black;"  value="'.$output_query["WFM_Update_note"].'"> '.$output_query["WFM_Update_note"].'</textarea>
</div>';
$rows .='</div>';
$rows .= ' <div style="width: 400px;">
</div> ';
  echo $rows;
  }} }

  ?>


<script type="text/javascript">
  setTimeout(function() {
  document.getElementById("message").style.display = 'none';
}, 1500);
</script>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</form>
</body>

</html>