
<?php 
include ("pages.php");
?>
  <title>Dashboard</title>
<IfModule mod_expires.c>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.1/raphael-min.js"></script>
<script src="js/justgage.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="css/morris22.css">
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/_all-skins.min.css">

</head>   
  <style type="text/css">
  .body{
    padding: 1px 50px 1px 50px;
    /*height: 100%;*/
    height: auto;
  }
    
   
    .gauge {
      width: 100%;
      height: auto;
    }

    .flexbox {
     /* display: flex;*/
      flex-wrap: wrap;
    }
    .flexbox>div {
      flex: 1 0 200px;

    }
     .stat-icon{
  font-size: 60px;
  }
 
.bg-flat-color-1{
    background-color: #00a1c2;
}
.card
{
  background : rgba(0,0,0,.4);
  color: #eee;
}
.card-title{
text-align: center;
color: white;
top: 0;
margin: 0;
padding: 0;
}

.Aht{
color:white; font-weight: bold;
  font-size: 20px;text-align: center; 
}
.Aht:hover  {
transform: scale(1.5);
color: orange;
}
  </style>


</IfModule>
<center>
  
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Dashboard</h2>
              <p style="color:lightgray;"> <?php
              $time = date("H");
              if ($time < "12") {
        echo "<img src='images/morning.png' style='width:50px;' > Good morning : $s_username";
    }if ($time >= "12" && $time < "17") {
        echo "<img src='images/afternoon.png' style='width:50px;margin-top:-15px;' > Good afternoon : $s_username";
    }if ($time >= "17" && $time < "19") {
        echo "<img src='images/evening.png' style='width:50px;' > Good evening : $s_username";
    } if ($time >= "19") {
        echo "<img src='images/night.png' style='width:50px;' > Good night : $s_username";
    }
  ?></p>
      
              </div>
          </div>
      </div>
       <p style="background-color:rgba(0,0,0,.5);;font-weight:bold;font-size:16px;
       color:white;">This dashboard A cross the current Year</p>
  </aside>
</div>
</center>
<form class="body">
<br>
<?php
include ("AbsenUtiliz_group2.php");
?>

       <div class="row">
          <div class="col-lg-3">
              <div class="card">
                <div class="card-header bg-secondary">
                  <strong class="card-title text-light">
                  Utilization</strong>
                        </div>
                <div class="card-body text-secondary">
                   <div id="g1" class="gauge"></div>
                  </div>              
              </div>
          </div>
                    
               <div class="col-lg-3">
          <div class="card">
            <div class="card-header bg-secondary"
            style="background-color: #55608f;">
                <strong class="card-title text-light" >
                Absenteeism</strong>
                      </div>
              <div class="card-body text-secondary">
                 <div id="g2" class="gauge"></div>
                </div>
                
            </div>
        </div>

         <div class="col-lg-3">
            <div class="card">
              <div class="card-header bg-secondary">
                <strong class="card-title text-light">
                  MTTI %
                </strong>
                      </div>
              <div class="card-body text-secondary">
                 <div id="g3" class="gauge"></div>
                </div>
                
            </div>
        </div>

         <div class="col-lg-3">
            <div class="card">
              <div class="card-header bg-secondary">
                <strong class="card-title text-light">
                MTTR %
              </strong>
                      </div>
              <div class="card-body text-secondary">
                 <div id="g4" class="gauge"></div>
                </div>
                
            </div>
        </div>
      </div>
<br>
      <div class="row">

              <div class="col-lg-3">
                  <div class="card">
                    <div class="card-header bg-secondary">
                      <strong class="card-title text-light">
                      AHT SD</strong>
                            </div>
                    <div class="card-body text-secondary">
                       <div class="Aht"><?php echo $get_Aht; ?>
                     </div>
                      </div>
                      
                  </div>
              </div>

              <div class="col-lg-3">
                  <div class="card">
                    <div class="card-header bg-secondary">
                      <strong class="card-title text-light">
                      AHT Onsite & Global</strong>
                            </div>
                    <div class="card-body text-secondary">
                       <div class="Aht"><?php echo $get_Aht2; ?>
                     </div>
                      </div>
                      
                  </div>
              </div>

              <div class="col-lg-3">
                  <div class="card">
                    <div class="card-header bg-secondary">
                      <strong class="card-title text-light">
                    AVG MTTI</strong>
                            </div>
                    <div class="card-body text-secondary">
                       <div class="Aht"><?php echo $MTTI; ?>
                     </div>
                      </div>
                      
                  </div>
              </div>

                 <div class="col-lg-3">
                  <div class="card">
                    <div class="card-header bg-secondary">
                      <strong class="card-title text-light">
                      AVG MTTR </strong>
                            </div>
                    <div class="card-body text-secondary">
                       <div class="Aht"><?php echo $get_MTTR; ?>
                     </div>
                      </div>
                      
                  </div>
              </div>


      </div>
<br>
      <div class="row">
        <div class="col-md-6" >

        <!-- AREA CHART -->
        <div class="box box-warning"style="background-color: #092834;" >
          <div class="box-header with-border">
            <h3 class="box-title" style="color:#eee;">Ticket with Service Desk resolved with 24h</h3>

            <div class="box-tools pull-right"  >
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <!--button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button-->
            </div>
          </div>
            
            <div class="box-body chart-responsive">
              <div class="chart" id="line-chart2" style="height: 300px;"></div>
            </div>
             
          </div>
      </div>

           <div class="col-md-6">
          <!-- LINE CHART -->

          <div class="box box-info" style="background-color: #092834;">
            <div class="box-header with-border">
              <h3 class="box-title" style="color:#eee;">Global Tickets linked with it's PSD with ( 1 hour )</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!--button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button-->
              </div>
            </div>
            <div class="box-body chart-responsive">
          <div class="chart" id="line-chart" style="height: 300px;"></div>
            </div>

          </div>
        </div>
      </div>

  <br>
      <div class="row">
        <div class="col-md-6" >

          <div class="box box-danger"style="background-color: #092834;" >
            <div class="box-header with-border">
              <h3 class="box-title" style="color:#eee;"> for any ticket shows at least one PSD tkt number  SD pool not exceed 90 min</h3>
              <div class="box-tools pull-right"  >
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            
            <div class="box-body chart-responsive">
              <div class="chart" id="line-notExceed" style="height: 300px;"></div>
            </div>
             
          </div>
      </div>

           <div class="col-md-6">
          <div class="box box-success" style="background-color: #092834;">
            <div class="box-header with-border">
              <h3 class="box-title" style="color:#eee;">99% of global tickets to have PSD tickets 
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body chart-responsive">
          <div class="chart" id="line-global" style="height: 300px;"></div>
            </div>

          </div>
        </div>
      </div>
<?php
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);
    
       $first_query = sqlsrv_query( $connect ,"with x as (
select * from (
SELECT[year],[month]
      ,[RequestID]
      ,[SLA]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_be_linked_to_PSC_within_45hr]
  left join [Aya_Web_APP].dbo.employee_web_table on username = Last_Enginner
   where manager = '$self') t
PIVOT(
    COUNT([RequestID]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select cast([year] + '-' + [month] + '-01' as date) [month] , cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([exceed]as float)) 'percentage'
from x");
  $Line_semi ='';
   while( $output = sqlsrv_fetch_array($first_query)){
  $Line_semi .="{ month:'".$output['month']->format('Y-m')."'
  ,percentage:'".floor(($output["percentage"])*100)."'},";
}
$Line_semi = substr($Line_semi, 0);

///////////////////////
    $first_query = sqlsrv_query( $con ,"with x as (
select * from (
SELECT[year],[month]
      ,[RequestID]
      ,[SLA]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_MTTR_SD_24hr]
  left join [Aya_Web_APP].dbo.employee_web_table on username = Last_Enginner
   where manager = '$self') t
PIVOT(
    COUNT([RequestID]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select cast([year] + '-' + [month] + '-01' as date) [month] , cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([exceed]as float)) 'percentage'
from x");
    $Line_percentage ='';

 while( $output = sqlsrv_fetch_array($first_query)){
  $Line_percentage .="{ month:'".$output['month']->format('Y-m')."'
  ,percentage:'".floor(($output["percentage"])*100)."'},";
}
$Line_percentage = substr($Line_percentage, 0);
$months =$output['month'];


?>

<script type="text/javascript">

var g1 = new JustGage({
        id: 'g1',
        value: <?php echo $utiliz;?>,//AbsenUtiliz_group2.php
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: 20,
          bottomlength: 20,
          bottomwidth: 4,
          color:"black"
            },
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });
</script>
<script type="text/javascript">
var g2 = new JustGage({
        id: 'g2',
        value: <?php echo $Absenteeism;?>, //AbsenUtiliz_group2.php
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: 20,
          bottomlength: 20,
          bottomwidth: 4,
          color:"black"
            },
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });
</script>
<script type="text/javascript">
var g3 = new JustGage({
        id: 'g3',
        value: <?php echo $get_MTTI2 ;?>, //AbsenUtiliz_group2.php
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: 15,
          bottomlength: 15,
          bottomwidth: 4,
          color:"black"
            },
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });

</script>
<script type="text/javascript">
var g4 = new JustGage({
        id: 'g4',
        value: <?php echo $get_MTTR2 ;?>,   
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: 15,
          bottomlength: 15,
          bottomwidth: 4,
          color:"black"
            },
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });

 

  </script>


<script type="text/javascript">
     $(function () {
    "use strict";
var line = new Morris.Area({
      element: 'line-chart2',
      resize: true,
      data: [<?php echo $Line_percentage;?>],
      xkey: 'month',
      ykeys: ['percentage' ],
      labels: ['percentage'],
      lineColors: ['#FFA421'],
      hideHover: 'auto'
    }); 
});
  </script>
  <script type="text/javascript">
$(function () {
    "use strict";
//$Line_semi
var line = new Morris.Area({
      element: 'line-chart',
      resize: true,
      data: [<?php echo $Line_semi;?>],
      xkey: 'month',
      ykeys: ['percentage'],
      labels: ['percentage'],
      lineColors: ['#3481B8','#FFA421'],
      hideHover: 'auto'
    });
 });
  </script>
<script type="text/javascript">
  $(function () {
    "use strict";
//$Line_3
var line = new Morris.Bar({
      element: 'line-notExceed',
      resize: true,
      data: [<?php echo $notExceed;?>],
      xkey: 'date',
      ykeys: ['percentages'],
      labels: ['percentages'],
      lineColors: ['#3481B8'],
      hideHover: 'auto'
    });
 });
  </script>
<script type="text/javascript">
  $(function () {
    "use strict";
//$Line_4

var line = new Morris.Line({
      element: 'line-global',
      resize: true,
      data: [<?php echo $global_ticke;?>],
      xkey: 'dates',
      ykeys: ['percent'],
      labels: ['percentage'],
      lineColors: ['#3481B8'],
      hideHover: 'auto'
    });

   });
  </script>

   </form>
  <script src="js/jquery22.min.js"></script>
  <script src="js/bootstrap22.min.js"></script>
  <script src="js/raphael22.min.js"></script>
  <script src="js/morris22.min.js"></script>
  <script src="js/fastclick22.js"></script>
  <script src="js/adminlte22.min.js"></script>
  <script src="js/demo22.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/raphael-min.js"></script>
  <script src="js/morris.js"></script>
  <script src="js/Chart.min"></script>
<?php
 include ("footer.html");
 ?>
