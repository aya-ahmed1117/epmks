

 <title>Hr Payroll</title>
<head>
  <meta name="description" content="Extended bootstrap tables with additional elements like buttons, checkboxes, icons, panels &amp; more.">
  <link rel="canonical" href="https://mdbootstrap.com/docs/jquery/tables/additional/">
  <meta property="og:locale" content="en_US">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap2.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>
 <?php
          include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      ?>  
<style type="text/css">
.cards-list {
  z-index: 0;
  width: 100%;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}

.card {
  margin: 30px auto;
  width: 300px;
  height: 300px;
  border-radius: 40px;
box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22);
  /*cursor: pointer;*/
  cursor: default;
  transition: 0.4s;
}

.card .card_image {
  width: inherit;
  height: inherit;
  border-radius: 40px;
}

.card .card_image img {
  width: inherit;
  height: inherit;
  border-radius: 40px;
  object-fit: cover;
}

.card .card_title {
  text-align: center;
  border-radius: 0px 0px 40px 40px;
  font-family: sans-serif;
  font-weight: bold;
  font-size: 30px;
  margin-top: -80px;
  height: 40px;
}

.card:hover {
  transform: scale(0.9, 0.9);
  box-shadow: 5px 5px 30px 15px rgba(0,0,0,0.25), 
    -5px -5px 30px 15px rgba(0,0,0,0.22);
}

.title-white {
  color: white;
}

.title-black {
  color: black;
}

@media all and (max-width: 500px) {
  .card-list {
    /* On small screens, we are no longer using row direction but column */
    flex-direction: column;
  }
}

</style>

 <div class="cards-list">
  
<div class="card 1">
  <div class="card_image">
   <img src="images/bgm91.jpg" /> </div>
  <div class="card_title title-white">
   <a class="btn btn-success btn-md" href="Active_Employee.php?export" download="Active_Employee.xls" style="width:90%;margin-left:2%; border-radius: 50px 50px 50px 50px;"> <p style="color: #eee;font-weight: bold;"><img src="images/ms-excel.png" style="width:40px;"/> Export  To Excel</p></a>
   <br>
   <br>
       <h5 class="card-title" style="color: black;">Active Employee</h5>
  </div>
</div>


  <div class="card 2">
  <div class="card_image">
    <img src="images/payroll-deduction.png" style="background-color: black;" />
    </div>
  <div class="card_title title-white">
<a class="btn btn-info btn-md" href="deduction_query.php?export" download="deduction_query.xls" style="width:90%;margin-left:2%; border-radius: 50px 50px 50px 50px;"> <p style="color: #eee;font-weight: bold;">
  <img src="images/ms-excel.png" style="width:40px;"/>Export To Excel</p></a>  
<br>
<br>
     <h5 class="card-title" style="color: black;">Deductions</h5>
</div>
</div>

<div class="card 3">
  <div class="card_image">
    <img src="images/resignImage.jpeg" /></div>
  <div class="card_title">
<a class="btn btn-danger btn-md" href="Resignation.php?export" download="Resignation.xls" style="width:90%;margin-left:2%; border-radius: 50px 50px 50px 50px;"> <p style="color: #eee;font-weight: bold;"><img src="images/ms-excel.png" style="width:40px;"/>Export To Excel</p></a>  
<br>
<br>
       <h5 class="card-title" style="color: black;">Resignation</h5>  
</div>
</div>
  
  <div class="card 4">
  <div class="card_image">  
    <!--img src="https://media.giphy.com/media/LwIyvaNcnzsD6/giphy.gif" /-->
    <img src="images/sick-employee.jpg" />

    </div>
  <div class="card_title title-black">
<a class="btn btn-warning btn-md" href="Sick_leave.php?export" download="Sick_leave.xls" style="width:90%;margin-left:2%; border-radius: 50px 50px 50px 50px;"> 
  <p style="color: #eee; font-weight: bold;"><img src="images/ms-excel.png" style="width:40px;"/>Export To Excel</p></a>  
<br>
<br>
       <h5 class="card-title" style="color: black;">Sick leave (Extra than 10)</h5>
  </div>
  </div>

<br>
<br>

<div class="card 5" style="
    margin-left: 2%;
    border-radius: 50px 50px 50px 50px;" >
  <div class="card_image" > 
    <img src="images/onlinepayment.png" />
    </div>
  <div class="card_title title-black" >

<a class="btn btn-dark btn-md" href="unpaid_LeavesExcel.php?download" download="unpaid Leaves.xls" style="width:90%;margin-left:2%; border-radius: 50px 50px 50px 50px;"> 
  <p style="color: #eee; font-weight: bold;"><img src="images/ms-excel.png" style="width:40px;"/>Export To Excel</p></a>  
<br>
<br>
     <h5 class="card-title" style="color: black; font-weight: bold; margin-left:8%;">Unpaid Leaves</h5>
     </div>
  </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </div>
<?php  

include("footer.html");
?>