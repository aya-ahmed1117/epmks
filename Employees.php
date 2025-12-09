
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

    <title>Employees</title>
    <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style4.css">


</head>
<style>
     #sidebar {
    min-width: 150px;
    max-width: 250px;
    background: #7386D5;
    background-image: initial;
    background-position-x: initial;
    background-position-y: initial;
    background-size: initial;
    background-repeat-x: initial;
    background-repeat-y: initial;
    background-attachment: initial;
    background-origin: initial;
    background-clip: initial;
    background-color: #092834;
    color: #fff;}
  #sidebar .sidebar-header{
    background-color: #092834;

            }

    </style>
<body style="   background-image:url(imag/river.png);
background-repeat: no-repeat; background-size: cover;">
       <?php /*


        background: linear-gradient(to top left, #37205f 0%, #852990 100%);
    border-radius: 20px 20px 20px 20px; 



if($_SESSION['username'] == 'peter.saleeb'){   
    echo'';} */?>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>WFM </h3>
            </div>

            <ul class="list-unstyled components">
              
                <li>
                    <a href="senior_home.php">
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
        if(($_SESSION['role_id'] == 1) || ($_SESSION['role_id'] == 2) || ($_SESSION['role_id'] == 3) || ($_SESSION['role_id'] == 4)){
          echo'
                  <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" style="background-color: #092834;">
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
                    <a href="welcomeadmin2.php" style="color:orange;">
                        <i class="fas fa-copy"></i>
                        Check request
                    </a>
                </li>';}?>
            
  <li ><a  style="color: #666;" href="edit_password2.php" ><span class="glyphicon glyphicon-user"></span>Change Password</a></li>

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
                            <!--li class="nav-item active">
                                <a class="nav-link" href="#">Page</a>
                            </li!-->
                           
<li><a href="?logout"><span class="glyphicon glyphicon-log-in "></span> Logout</a></li>

                        </ul>
                    </div>
                </div>
            </nav>

<form method="post" class="form-horizontal">    
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">
     
  <tbody>
<?php

if($_SESSION['role_id'] == 1){
  echo '
<div id="" style="overflow:scroll; height:399px; overflow-x:hidden;">

<form method="post" class="content" style="border-radius: 20px 20px 10px 10px;border: 10px solid ; width: 50%;">

<div class="form"  style="">
<b><table style="color: ;  font-synthesis: 50px;
 font-size: medium; " align="center" width="40%"></b>';}?>

 <?php
    echo '
    <table align="center" class="order-table table" style="color: #702283; flex-wrap: wrap;
  position: relative; 
  font-style: normal; 
  border-bott: 2px solid #660033;
  font-family: Century Gothic;

   width: 40%; height: 30%;   grid-template-columns: auto auto auto auto; grid-gap: 15px; " >
    <thead style="    background-color: #17a2b8;">
  <th style="border: 1px solid #eee;color:white;font-size:13px;">Engineer Name</th>
    <th style="border: 1px solid #eee;color:white;font-size:13px;">Edit</th>';

  echo "</thead>";
//401a4c

 $check = sqlsrv_query( $con ,"SELECT * FROM [employee]");
    while( $output = sqlsrv_fetch_array($check)){
  $rows    = "<tr>";
 
  $rows   .="<td style='background-color:#eee;border: 1px solid #eee;font-size:15px;'>".$output["username"]."</td>";
  $rows   .="<td style='background-color:#17a2b8;border: 1px solid #eee;'><a style='color:#eee;font-size:15px;' href='edit_employee.php?id=".$output['id']."' target=_blank>edit</a></td>";
  $rows   .= "</tr>";

echo $rows;
}

?>


</table>
</tbody>
</form>
</div>
<script type='text/javascript'>
  
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
  
</script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
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
    </div>
</body>

</html>