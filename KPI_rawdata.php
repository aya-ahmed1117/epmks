
<?php 
include ("pages.php");


        $self = $_SESSION['id'];
        $role_id = $_SESSION['role_id'];
        $usernames="";
      if(isset($_POST['username'])){$usernames = $_POST['username'];}
        $from_date="";
        $to_date="";
        $mydate ="";
        $mydate2 ="";
        //$Units ="";
        $groups = "";
        $groups2 = "";
        $units="";
        $units2="";
        $schedule_date="";
        $schedule_date2="";
    ?>
    <head>
      <title>Monthly Reports</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets2/css/stylee.css">
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  </head>
  <style type="text/css">
.body{
    padding: 10px 70px 10px 70px;
    height:100%;
  }
 .stat-icon{
  font-size: 60px;
  }
  .flat-color-1 {
    color: #00c292;   
}
.flat-color-2 {
color: #6610f2;
  }
.icon:hover{
  content: "";
transform: scale(1.5);
}
 i .fa-heartbeat{
font-size: 4em;
right: 0;
left: 0;
bottom: 0;
top: 0;

}

.bg-flat-color-9{
	background-color: #0067a5;
}

.bg-flat-color-11{
    background-color: #f6a600;
}

.bg-flat-color-13{
    background-color: #d0748b;
}

.bg-flat-color-14{
    background-color: #5490c4;
}
</style>
<center>
  
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
        <div class="card-header user-header alt bg-light"
        style="border-radius: 20px 20px 0 0 ;">
        <div class="media">
        <div class="media-body">
          <h2 class="text-dark display-12" >Kpi Rawdata Reports</h2>
          <p style="color:lightgray;">Welcome :
           <?php echo $_SESSION["username"];?></p>
          </div>
      </div>
  </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This report generated on Monthly basis</p>
  </aside>
</div>
</center>

    <div class="content body">
      <div class="content">
         <div class="animated fadeIn ">
	<div class="row">

	<div class="col-sm-6 col-md-3">
	    <div class="card text-white bg-flat-color-9">
	        <div class="card-body">

			<i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;color: white;">
        	    </i>
		      <a href="new_KPI_rawdata.php?MTTI">
		       <div class="card-left pt-1 float-left">
              <br>	
		<h6 class="text-light mt-1 m-0">Monthly MTTI raw data</h6>
                </div>
			</a>
      </div><!-- /.card-left -->
	</div>
  </div>

     <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-2">
            <div class="card-body">

			<i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;color: white;">
	    </i>
            <a href="new_KPI_rawdata.php?MTTR">
		       <div class="card-left pt-1 float-left">
              <br>	
    		<h6 class="text-light mt-1 m-0">Monthly MTTR raw data</h6>
        </div>
    	</a>
      </div><!-- /.card-left -->
	</div>
  </div>

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body">		
			<i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;color: white;">
	    </i>
           <a href="new_KPI_rawdata.php?MTTV">
		      <div class="card-left pt-1 float-left">
              <br>	
    		<h6 class="text-light mt-1 m-0">Monthly MTTV raw data</h6>
              </div>
        </a>
      </div>
	</div>
  </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-11">
            <div class="card-body">

   			<i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;color: white;">
   	    </i>
           <a href="new_KPI_rawdata.php?AHT">
   		       <div class="card-left pt-1 float-left">
                 <br>	
           		<h6 class="text-light mt-1 m-0">Monthly AHT raw data</h6>
                </div>
           		</a>
               </div><!-- /.card-left -->
            </div>
          </div>

       </div> 
       <br>

   <div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card text-white bg-flat-color-13">
            <div class="card-body">

            <i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;color: white;">
                </i>
              <a href="new_KPI_rawdata.php?P1" >
               <div class="card-left pt-1 float-left">
              <br>  
                <h6 class="text-light mt-1 m-0">P1 raw data</h6>
                </div>
            </a>
      </div><!-- /.card-left -->
    </div>
  </div>

  <div class="col-sm-6 col-md-3">
        <div class="card text-white bg-flat-color-6">
            <div class="card-body">

            <i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;color: white;">
                </i>
              <a href="new_KPI_rawdata.php?P2">
               <div class="card-left pt-1 float-left">
              <br>  
        <h6 class="text-light mt-1 m-0">P2 raw data </h6>
                </div>
            </a>
      </div><!-- /.card-left -->
    </div>
  </div>

</div> 

    </div>
</div> <!-- row -->
<br>
<!--div class="row">
  <div class="col-sm-6 col-lg-3">
	<div class="card text-white bg-flat-color-6">
	     <div class="card-body"> 6
	     	<i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;color: white;">
   	    </i>
	         <a href="Daily_Average3.php?Eng">
   		       <div class="card-left pt-1 float-left">
                 <br>	
   		<h6 class="text-light mt-1 m-0">Daily No of tkts handled by every Eng</h6>
    </div>
   	</a>
       </div>
    </div>
  </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-13">
            <div class="card-body"> 7
	     	<i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;color: white;">
   	    </i>
	         <a href="Daily_Summary.php?Summary">
   		       <div class="card-left pt-1 float-left">
                 <br>	
   		<h6 class="text-light mt-1 m-0">Check Daily Summary Reports ....</h6>
    </div>
   	</a>
       </div>
    </div>
  </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
       <div class="card-body">8
   			<i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;color: white;">
   	    </i>
   <a href="Daily_Summary2.php?exceeded">
   		<div class="card-left pt-1 float-left">
                 <br>	
   		<h6 class="text-light mt-1 m-0" title="(including Eng.Name)">Daily Table with tkts exceeded 4 hours Mttr in SD only </h6>
            </div>
       		</a>
               </div>
           </div>
       </div>
       <div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-14">
          <div class="card-body"> 9
            <i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;color: white;">
        </i>
             <a href="Daily_Summary.php?statistics">
               <div class="card-left pt-1 float-left">
                 <br>   
        <h6 class="text-light mt-1 m-0">Check Daily API statistics reports</h6>
    </div>
    </a>
       </div>
    </div>
  </div>
    </div>
</div-->

       

       


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
   <script type="text/javascript">
     $('.popover-dismiss').popover({
  trigger: 'focus'
})
$('#example').popover(options)
$('#element').popover('show')
$('#myPopover').on('hidden.bs.popover', function () {
  // do something…
})
   </script>
</div></div>
   <?php
 include ("footer.html");
 ?>