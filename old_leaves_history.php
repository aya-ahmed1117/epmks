
<?php

 include ("pages.php");
 ?>
 <title>Leaves History</title>
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
  <!-- Script -->
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


<div class="content">
<center>
  
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Leaves History</h2>
              <p style="color:lightgray;">Welcome :
               <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Here you can see your history of Leaves ( Annual - Permission - ...etc.) in the current year </p>
  </aside>
</div>
</center>
</div>
<div class="content body">

<?php

	$CurrentYear = date("Y");
// leaves  
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countLeaves FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING' or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] = 'Annual Leave'");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countLeaves = $output_query["countLeaves"];


 // permission 
$check_orders = sqlsrv_query( $con ,"SELECT sum([count]) as Permission FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING') and [type]='Permission'and username = '$s_username' 
and (( [adate] between dateadd(day,15,EOMONTH(GETDATE(),-2)) and dateadd(day,14,EOMONTH(GETDATE(),-1)) and day(getdate())<=14) or([adate] between dateadd(day,15,Eomonth(getdate(),-1)) and dateadd(day,14,Eomonth(getdate(),0)) and day(getdate())>14 ))
group by username order by username");
$output_query = sqlsrv_fetch_array($check_orders);
 $permission = $output_query["Permission"];
 $type = $output_query['type'];
  //$ $permission - 4///////////////////////////////
 if($type == 'Permission'){

  $CurrentYear = date("Y",strtotime($adate));
  $CurrentMonth = date("m",strtotime($adate));

  $NextYear = date("Y", strtotime('+1 month',strtotime($adate)));
  $NextMonth = date("m", strtotime('+1 month',strtotime($adate)));

if (date("d",strtotime($adate)) < 14 ) {
  $CurrentYear = date("Y",strtotime('-1 month',strtotime($adate)));
  $CurrentMonth = date("m",strtotime('-1 month',strtotime($adate)));

  $NextYear = date("Y", strtotime($adate));
  $NextMonth = date("m", strtotime($adate));
}
else
{
  $CurrentYear = date("Y",strtotime($adate));
  $CurrentMonth = date("m",strtotime($adate));

  $NextYear = date("Y", strtotime('+1 month',strtotime($adate)));
  $NextMonth = date("m", strtotime('+1 month',strtotime($adate)));

}
    
$today = date("Y-m-d"); // 2012-01-30
$next_month = date("Y-m-d", strtotime("$today +1 month"));
$diff = abs(strtotime($bdate) - strtotime($adate));
$new_date = date_format(date_create($adate), 'Y-m-d');

$new_time = date('H:i:s', strtotime($starttime));

$new_dateto = date_format(date_create($bdate), 'Y-m-d');
$new_timeto = date('H:i:s', strtotime($endtime));


    $fdatetime = strtotime( $adate ." ".$starttime )  ; 
    $tdatetime = strtotime($bdate ." ". $endtime); 

    if (strtotime($adate.' '.$resshift_start) == strtotime($adate.' '.$starttime)  ) {
      $fdatetime = $fdatetime + 900 ;
    }

    $diff = abs($tdatetime - $fdatetime) ;

$diffMinutes = $diff / 60 ;   // transform to minutes 


    if ($diffMinutes /60 > 4){   //// check if exceed 4 hours 
 echo "<h1 style='font-size:25px;border: 2px solid #5b9291;width:48%;
  border-radius: 4px 4px 5px 5px;'>&#x26A0; You create more than 4 hours </h1>"; 

// message exceed 4 hours    
  }
if($diffMinutes < 15 ){
  echo "<h2 style='color: #cc0000; font-size=10px; border-radius: 4px 4px 5px 5px;box-sizing: border-box; border: 2px solid #cc0000;width:30%;'>".'Wornning: It must be > 15M'."</h2>";
}
  else{
   
    $units =  $diffMinutes ;

$qryUnits =  sqlsrv_query( $con ,"SELECT sum([count]) as countUnits
  FROM [Aya_Web_APP].[dbo].[leaves]
  where adate >= '".$CurrentYear."-".$CurrentMonth."-15 00:00:00' and bdate <= '".$NextYear."-".$NextMonth."-14 23:59:00' 
  and username = '$s_username' and type = 'Permission'
  and ( status  = 'E-workforce and senior approve' or status = 'PENDING' or status ='senior approve')" );

while($output_queryU = sqlsrv_fetch_array($qryUnits)){
  $resUnits = $output_queryU['countUnits'];
}

if($resUnits + $units > 240)
{
 /// messge 
 echo "<h1 style='font-size:29px;border: 2px solid tomato;width:48%;
  border-radius: 4px 4px 5px 5px; color:tomato;'>&#9760; You exceed 4 hours</h1>";
}
}
}


  //$ $permission - 4///////////////////////////////
 //official mission   
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countofficial FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%official mission%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countofficial = $output_query["countofficial"];

  //  Sick Leave 
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countSick FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Sick Leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countSick = $output_query["countSick"];

  //Instead of(HR)   
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countInstead FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Instead of(HR)%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countInstead = $output_query["countInstead"];

  // Paternity Leave  
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countPaternity FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Paternity Leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countPaternity = $output_query["countPaternity"];

  //Pilgrimage Leave   
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countPilgrimage FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Pilgrimage Leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countPilgrimage = $output_query["countPilgrimage"];

 
  // Unpaid Leave  
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countUnpaid FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Unpaid Leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countUnpaid = $output_query["countUnpaid"];



 if($countUnpaid > 5) {
  echo "<b><h2 style='color: #cc0000; font-size=10px; border-radius: 4px 4px 5px 5px;box-sizing: border-box; border: 2px solid #cc0000;width:30%;'>Your Operation Couldn't be completed because you exceed the 5 days (Unpaid Leave)</h2></b>";
  }

  //Compassionate Leave   
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countCompa FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Compassionate leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countCompa = $output_query["countCompa"];

   //Maternity Leave   
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countMaternity FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Maternity Leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countMaternity = $output_query["countMaternity"];
///
 		if(isset($_POST['type'])){$types = $_POST['type'];}

?> 


         <!--/.c-->

 <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">
               Leaves
                 </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       <div class="modal-body">
                  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button></div>

                    </div>
                </div>
            </div>

                    <!------>



<div class="content">
<div class="animated fadeIn ">
             <!-- /Widgets -->
			<div class="row">
			<div class="col-sm-6 col-md-3">
			    <div class="card text-white bg-flat-color-9">
			        <div class="card-body">
			            
                            <div class="card-right float-right text-right">
                <i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;"></i>
                        </div>
                        <div class="card-left pt-1 float-left">
			                <h3 class="mb-0 fw-r">
                                 
			<span class="currency float-left mr-1"> </span>
	 <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal" data-type="Annual Leave" value="Annual Leave">
			   	<span class="count"><?php echo $countLeaves;?></span></button> 
			                </h3>
			                <br>	
		<h6 class="text-light mt-1 m-0">*Annual Leave</h6>
        <h6>*Total for the year 
           <?php 
 date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );
   $s_username = $_SESSION['username'];
 $newannual  = sqlsrv_query($con1,"SELECT Annuel_days
  from Annuel_cal
  where Annuel_cal.UserName = '$s_username'");

   $outputs_query = sqlsrv_fetch_array($newannual);
      $Annuel_days = $outputs_query['Annuel_days'];
echo '( '.$Annuel_days.' )';
      ?>
  </h6>
			            </div><!-- /.card-left -->
			        </div>
			    </div>
			</div>

          <!--/.col-->

     <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-flat-color-2">
                            <div class="card-body">
                                <div class="card-left pt-1 float-left">
                                    <h3 class="mb-0 fw-r">
    <span class="currency float-left mr-1">  </span>
     <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal" data-type="Permission" value="Permission">
            <span class="count"><?php echo $permission;?> </span> Minutes 
                                    </h3>
                                    <br>
                                    <span></span>
                        <p class="text-light mt-1 m-0">Permission</p>
                          </button>
                                </div><!-- /.card-left -->
                                <div class="card-right float-right text-right">
                <i class="icon fade-5 icon-lg pe-7s-stopwatch"></i>
                                </div><!-- /.card-right -->

                            </div>
                        </div>
                    </div>


        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-3">
                <div class="card-body">
                    <div class="card-left pt-1 float-left">
                        <h3 class="mb-0 fw-r">

<button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal" data-type="Sick Leave" value="Sick Leave">
        <span class="count"><?php echo $countSick;?></span></button> 
                        </h3>
                <br>
                <span>  </span>
                <p class="text-light mt-1 m-0">Sick Leave</p>
            </div>
            <div class="card-right float-right text-right">
        <i class="fa fa-heartbeat icon" style="font-size: 3.68em;"></i>
                    </div>
                    </div>

        </div>
    </div>
                    <!--/.col-->
 
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-11">
                <div class="card-body">
                    <div class="card-left pt-1 float-left">
                         <h3 class="mb-0 fw-r">
<button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal" data-type="Instead of(HR)" value="Instead of(HR)">
        <span class="count"><?php echo $countInstead;?></span></button> 
                        </h3>
                        <br>
                        <p class="text-light mt-1 m-0">Instead off</p>
                    </div><!-- /.card-left -->

                    <div class="card-right float-right text-right">
                        <i class="icon fa fa-random" style="font-size: 2.68em;"></i>

                    </div>
                        <div id="flotLine1" class="flotLine1"></div>
                    </div><!-- /.card-right -->

                </div>

            </div>
        </div>
        </div>
                    <!--/.col-->
                    <br>
<!-- /Widgets -->
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-1">
                <div class="card-body">
                    <div class="card-left pt-1 float-left">
    <h3 class="mb-0 fw-r">
<button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal" data-type="Pilgrimage Leave" value="Pilgrimage Leave">
<span class="count"><?php echo $countPilgrimage;?></span></button> 
                        </h3>
                        <br>
                        <span>  </span>
                 <p class="text-light mt-1 m-0">Pilgrimage Leave</p>
                    </div><!-- /.card-left -->

                    <div class="card-right float-right text-right">
                        <i class="icon fas fa-kaaba" style="font-size: 2.68em;"></i>
                    </div><!-- /.card-right -->

                </div>

            </div>
        </div>

                          <!--/.col-->

                    <!------>
         <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-6">
                            <div class="card-body">
                        
                            <div class="card-right float-right text-right">
                <i class="icon fas fa-sign-out-alt" style="font-size: 1.48em;padding: 0;float: right;"></i>
                        </div>
                        <div class="card-left pt-1 float-left">
                            <h3 class="mb-0 fw-r">
                                 
            <span class="currency float-left mr-1"> </span>
     <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal" data-type="Unpaid Leave" value="Unpaid Leave">
                <span class="count"><?php echo $countUnpaid;?></span></button> 
                            </h3>
                            <br>    
    <h6 class="text-light mt-1 m-0">* Unpaid Leave</h6>
    <h6 class="text-light mt-1 m-0">* Maximam Unpaid = 5 Days</h6>
</div>
        
                </div>

            </div>
        </div>
  
                    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-13">
            <div class="card-body">
                <div class="card-left pt-1 float-left">

  <h3 class="mb-0 fw-r">
<button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal" data-type="Compassionate leave" value="Compassionate leave">
<span class="count"><?php echo $countCompa;?></span></button> 
</h3>
                    <br>
    <p class="text-light mt-1 m-0">Compassionate Leave</p>
                </div><!-- /.card-left -->

                <div class="card-right float-right text-right">
                    <i class="icon fa fa-frown-o" style="font-size: 2.68em;"></i>
                </div><!-- /.card-right -->

            </div>

        </div>
    </div>
                    <!--/.col-->

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-4">
            <div class="card-body">
                <div class="card-left pt-1 float-left">

                    <h3 class="mb-0 fw-r">
<button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal" data-type="Maternity Leave" value="Maternity Leave">
<span class="count"><?php echo $countMaternity;?></span></button> 
</h3>
                    <br>
                    <p class="text-light mt-1 m-0">Maternity Leave</p>
                </div><!-- /.card-left -->

                <div class="card-right float-right text-right">
                    <i class="icon fas fa-baby-carriage" style="font-size: 2.68em;"></i>
                </div>
                    <div id="flotLine1" class="flotLine1"></div>
                </div><!-- /.card-right -->

            </div>

        </div>
    </div>
    </div>
<br>
    <div class="row">
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-14">
        <div class="card-body">
            <div class="card-left pt-1 float-left">
                  <h3 class="mb-0 fw-r">
<button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal" data-type="Paternity Leave" value="Paternity Leave">
<span class="count"><?php echo $countPaternity;?></span></button> 
</h3>    
                <br>
                <span> </span>
                <p class="text-light mt-1 m-0">Paternity Leave</p>
            </div><!-- /.card-left -->

            <div class="card-right float-right text-right">
                <i class="icon fas fa-baby" style="font-size: 2.68em;"></i>

            </div><!-- /.card-right -->

        </div>

      </div>
 </div>
                    <!--/.col-->
<div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body">
                        <div class="card-left pt-1 float-left">
         <h3 class="mb-0 fw-r">
<button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal" data-type="official mission" value="official mission">
<span class="count"><?php echo $countofficial;?></span></button> 
</h3>
                            <br>
            <p class="text-light mt-1 m-0">Official Mission</p>
            </div><!-- /.card-left -->

            <div class="card-right float-right text-right">
                <i class="icon fade-5 icon-lg pe-7s-clock"></i>
            
            </div><!-- /.card-right -->

        </div>

    </div>
</div>

       </div>

   </div><!-- end -->
   </div>

  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
		<script>			
  $(document).ready(function(){
 //$('.mediumModal').click(function(){ 

 	$('#mediumModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var modal = $(this);
      var type = button.data('type');
      //console.log('opened');
   // AJAX request
   $.ajax({
    url: 'ajaxfile.php',
    type: 'POST',
	data:'type='+type,    
	cache: false,
    success: function(data){ 
      // Add response in Modal body
      modal.find('.modal-body').html(data);
      //console.log(data);
      //$('#mediumModal').modal(data);
    }, error: function(err){
          console.log(err);
        }
  });
 });
});


     </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
 <?php
 include ("footer.html");
 ?>
   <script src="assets/js/widgets.js"></script>
       <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>