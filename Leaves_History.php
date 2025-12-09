
<?php
include ("pages.php");
?>
<title>Leaves History</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

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
    $check_permission = sqlsrv_query( $con ,"SELECT [id],[engineer_id]
      ,[username]
      ,[adate],[type] ,[count]
      ,[status],[starttime],[endtime]      
      FROM [Aya_Web_APP].[dbo].[leaves]
      where username='$s_username' ");
    $output_Permiss = sqlsrv_fetch_array($check_permission);
    $types = $output_Permiss['type'];


$query = "SELECT SUM([count]) AS Permissions 
          FROM leaves 
          WHERE 
              (status = 'E-workforce and senior approve' OR status = 'PENDING' OR status = 'super approve') 
              AND [type] = 'Permission' 
              AND username = '$s_username' 
              AND (
                  (
                      [adate] BETWEEN DATEADD(DAY, 15, EOMONTH(GETDATE(), -2)) 
                      AND DATEADD(DAY, 14, EOMONTH(GETDATE(), -1)) 
                      AND DAY(GETDATE()) <= 14
                  )
                  OR (
                      [adate] BETWEEN DATEADD(DAY, 15, EOMONTH(GETDATE(), -1)) 
                      AND DATEADD(DAY, 14, EOMONTH(GETDATE(), 0)) 
                      AND DAY(GETDATE()) > 14
                  )
              )
          GROUP BY username
          ORDER BY username";

$check_orders = sqlsrv_query($con, $query);

if ($check_orders && $output_query = sqlsrv_fetch_array($check_orders)) {
    $permission = $output_query["Permissions"];
} else {
    $permission = 0; // أو أي قيمة افتراضية تراها مناسبة
}

 //$type = $output_query['type'];
  //$ $permission - 4///////////////////////////////

    if($types == 'Permission'){
        $check = sqlsrv_query( $con ,"SELECT * FROM leaves where username = '$s_username' and [type] = 'Permission' ");

        while ($get_out = sqlsrv_fetch_array($check)){

         $adate = $get_out['adate']->format('Y-m-d');
         $bdate = $get_out['bdate']->format('Y-m-d');


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

      }}}
    //$ $permission - 4///////////////////////////////
 //official mission   
      $check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countofficial FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
       and [type] like 'official mission%' ");
      $output_query = sqlsrv_fetch_array($check_orders1);
      $countofficial = $output_query["countofficial"];

  //  Sick Leave 
      $check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countSick FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
       and [type] like '%Sick Leave%' ");
      $output_query = sqlsrv_fetch_array($check_orders1);
      $countSick = $output_query["countSick"];

  //Instead of(HR)   
      $check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countInstead FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
       and [type] like '%Instead of(HR)%' ");
      $output_query = sqlsrv_fetch_array($check_orders1);
      $countInstead = $output_query["countInstead"];

  // Paternity Leave  
      $check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countPaternity FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
       and [type] like '%Paternity Leave%' ");
      $output_query = sqlsrv_fetch_array($check_orders1);
      $countPaternity = $output_query["countPaternity"];

  //Pilgrimage Leave   
      $check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countPilgrimage FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
       and [type] like '%Pilgrimage Leave%' ");
      $output_query = sqlsrv_fetch_array($check_orders1);
      $countPilgrimage = $output_query["countPilgrimage"];


  // Unpaid Leave  
      $check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countUnpaid FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
       and [type] like '%Unpaid Leave%' ");
      $output_query = sqlsrv_fetch_array($check_orders1);
      $countUnpaid = $output_query["countUnpaid"];
// Unplanned Leave  
      $check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countUnplanned FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
       and [type] like 'unplanned' ");
      $output_query = sqlsrv_fetch_array($check_orders1);
      $countUnplanned = $output_query["countUnplanned"];



      // if($countUnpaid > 5) {
      //     echo "<b><h2 style='color: #cc0000; font-size=10px; border-radius: 4px 4px 5px 5px;box-sizing: border-box; border: 2px solid #cc0000;width:30%;'>You exceed the 5 days (Unpaid Leave)</h2></b>";
      // }

  //Compassionate Leave   
      $check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countCompa FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
       and [type] like '%Compassionate leave%' ");
      $output_query = sqlsrv_fetch_array($check_orders1);
      $countCompa = $output_query["countCompa"];

   //Maternity Leave   
      $check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countMaternity FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
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
                       
                         sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
                         sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );
                         $s_username = $_SESSION['username'];
                         $newannual  = sqlsrv_query($con,"SELECT Annuel_days
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
                        </div>

                        <div class="card-right float-right text-right">
                            <i class="icon fas fa-baby" style="font-size: 2.68em;"></i>

                        </div>

                    </div>

                </div>
            </div>

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
                        </div>
                        <div class="card-right float-right text-right">
                            <i class="icon fade-5 icon-lg pe-7s-clock"></i>

                        </div>
                    </div>
                </div>
            </div>

            <!-- unplanned-->
       <?php  
$unp_outs = sqlsrv_query($con1,"SELECT *
  FROM [Employess_DB].[dbo].[tbl_Personal_info] p
  LEFT JOIN Annuel_cal ON Annuel_cal.Username = p.UserName 
  WHERE [Employee_Status] <> 'Resigned' 
  AND Employee_Type = 'OutSource'
  AND p.USERname = '$s_username'");

$unplanned_o = sqlsrv_fetch_array($unp_outs);

if ($unplanned_o && isset($unplanned_o['Employee_Type'])) {
    $employee_type = $unplanned_o['Employee_Type'];

    if ($employee_type == 'OutSource') {
?>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-1">
            <div class="card-body">
                <div class="card-right float-right text-right">
                    <i class="icon fa-solid fa-person-walking-dashed-line-arrow-right" style="font-size: 1.48em;padding: 0;float: right;"></i>
                </div>
                <div class="card-left pt-1 float-left">
                    <h3 class="mb-0 fw-r">
                        <span class="currency float-left mr-1"> </span>
                        <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal" data-type="unplanned" value="unplanned">
                            <span class="count"><?php echo $countUnplanned; ?></span>
                        </button>
                    </h3>
                    <br>    
                    <h6 class="text-light mt-1 m-0">* Maximam unplanned Leave = 6 Days</h6>
                </div>
            </div>
        </div>
    </div>
<?php 
    }
} 
?>

          
        </div>
    </div>
</div>

<script ssrc="js/jquery-3.6.0.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>			
  $(document).ready(function(){
      $('#mediumModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var modal = $(this);
          var type = button.data('type');
      //console.log('opened');

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/js/all.min.js">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<?php
include ("footer.html");
?>
<script src="assets/js/widgets.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>