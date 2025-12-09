 <?php 
  
include ("pages.php");
    $self = $_SESSION['id'];
    $role_id = $_SESSION['role_id'];
    $usernames="";
    if(isset($_POST['username'])){$usernames = $_POST['username'];}
    $self = $_SESSION['id'];
    $role_id = $_SESSION['role_id'];
    ?>
  <title>Utilization Less than 30%</title>
       
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fixed_s/vendor/animate/animate.css">
</head>
<center>
  
<div class="col-md-9">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >PSC Reports</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Here you can Find Open tickets Report - Closed Ticket reports and Bank Masr Report per Day</p>
  </aside>
</div>
</center>

<div style="padding:20px;">

<p>
 </p><h3 style="font-size: 15px;">kindly be noted that we will run a daily report concerning utilization <u><mark style="background-color: yellow;"> less than 30%</mark></u> with the below process to avoid any mistakes or abusing regarding utilization</h3>
 <br>

    
  <h1 style="font-weight: bold;"><u>No Process  ---> </u>
  </h1> <h2>Mean that he didn't use process in all tickets or some.</h2>

 <h1 style="font-weight: bold;"><u>No Ticket  ---&></u>
 </h1><h2> Mean that he hasn’t input in any ticket or didn't change the status of the Ticket.</h2>

 <h1 style="font-weight: bold;"><u>Normal ---&></u>
 </h1><h2> Mean that he Use the Process normally. </h2>
<br>
<h3>Also it will include the engineers who took much more time in handling few tickets .
</h3>
<p></p>

<hr>
<br>
<br>

<div class="container-fluid">
<a href="utilization_lessthan_30.php">
        <button type="button" class="btn btn-info" style="margin-left:5%;width:30%; padding: 3.5%;">utilization less than 30%</button></a>
<a href="abnormal_behavior_inTickets.php"> 
    <button type="button" class="btn btn-warning" style="margin-left:5%;width:30%; padding: 3.5%;">
        <i class="fa fa-align-justify"></i>Abnormal Behavior In Tickets </button></a>
  </div>


    </div>



    <?php

 include ("footer.html");
 ?>
