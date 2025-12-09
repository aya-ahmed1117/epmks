

<?php 
include ("pages.php");
date_default_timezone_set('Africa/Cairo');
$DBhost = "172.29.29.76";
$DBuser = "Seniors";
$DBpass = "123456789";
$DBname = "WorkforceDB_indexed";
$CharacterSet = "UTF-8";


$connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789" ,"CharacterSet" => $CharacterSet);
$connect = sqlsrv_connect($DBhost, $connectionInfo);

?>
<title>Bank MASR</title>

<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<center>
  <div class="col-md-8">
    <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
    border-radius: 20px 20px 20px 20px;">
    <div class="card-header user-header alt bg-light"
    style="border-radius: 20px 20px 0 0 ;">
    <div class="media">
      <div class="media-body">
        <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Here you can Find Bank Masr Report per Day 
          <a href="psc_reports.php">
            <button type="button" id="sidebarCollapse" class="btn btn-warning" >
              <i class="fa fa-backward"></i> Back
            </button>
          </a>
        </h2>
      </div>
    </div>
  </div>
  <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">    
    <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
  </a></p></samp>
</aside>
</div>
</center>

<div style="padding: 20px;">

   <form method="post" >
    <div class="row">
      <div class="col-lg-3">
        <div class="input-group col-2">
          <span class="input-group-text" id="basic-addon1">Choose Date</span>
          <input type="date" class="form-control"  id="months"
          name='day' aria-describedby="basic-addon1"
          value='<?php if(isset($_POST['day'])) echo $_POST['day']; ?>' required />
        </div>
      </div>

      <div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >
      Submit</button>
    </div>
  </div>
 </form>
</div>


<?php 
if(isset($_POST['day'])){
  $myDate = $_POST['day'];}
  if(isset($_POST['submit'])){
    $first_query = sqlsrv_query( $connect,"SELECT 
            DISTINCT [ID],
            BM.[Subject], 
            BM.[Contact Name],
            BM.[Date],
            BM.[Status],
            CASE 
            WHEN BM.[Status] = 'Closed' THEN NULL
            WHEN TH.[CURRENT VALUE] IS NULL THEN 'No Updates'
            ELSE TH.[CURRENT VALUE]
            END AS [last update if still open],
            BM.[Closure Reason],
            CASE 
            WHEN BM.[Status] = 'Closed' THEN BM.[Last Updated On]
            ELSE NULL
            END AS [Closed Time],
            BM.[Category],
            BM.[Transmission Media],
            a.AccountNumber AS [AccountNumber] 
            FROM 
            [WorkforceDB_indexed].[dbo].[Bank_Masr_Zoz] BM

            LEFT JOIN  
            [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] k
            ON BM.[ID] = k.RequestID  
            LEFT JOIN  
            [WorkforceDB_indexed].[dbo].[all_nodes] a
            ON k.nodeID = a.NodeID
            OUTER APPLY (
              SELECT TOP 1 
              TH.[CURRENT VALUE]
              FROM 
              [WorkforceDB_indexed].[dbo].[TicketHistory_indexed] TH
              WHERE 
              TH.[RequestID] = BM.[ID] 
              ORDER BY 
            TH.[OPERATION TIME] DESC) TH 
            WHERE  CONVERT(DATE, BM.[Date])  = '$myDate'");

          
             if (sqlsrv_has_rows($first_query)) {
        

    ?>

<center>


  <div style="padding:20px;">

    <div class="tableFixHead">
      <table class="table order-table"  cellspacing="0" id="tblCustomers" >
        <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
          <tr>
            <th>ID</th>
            <th>Subject </th>
            <th> Contact Name</th>
            <th>Date </th>
            <th>Status </th>
            <th>last update if still open </th>
            <th>Closure Reason </th>
            <th >Closed Time</th>
            <th > Category</th>
            <th >Transmission Media</th>
            <th >AccountNumber </th>
          </tr>
        </thead>

        <tbody>
          <?php   
         while( $output_query = sqlsrv_fetch_array($first_query)){
            $rows  ='<tr>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["ID"].'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Subject"].'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Contact Name"].'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Date"]->format('Y-m-d H:i:s').'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Status"].'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["last update if still open"].'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Closure Reason"].'</td>';
            if ($output_query["Closed Time"] == NULL){
              $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >Blank</td>';
            }else{
              $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Closed Time"]->format('Y-m-d H:i:s').'</td>';
            }
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Category"].'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Transmission Media"].'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["AccountNumber"].'</td>';
            $rows .= '</tr>';

            echo $rows;
          }
       } 
       else{
        echo '<h3>No data found </h3>';
       }
     }
     
          ?>

        </tbody>
      </table>
    </div>
  </div>
</center>
<script src="js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
  function Export() {
    $("#tblCustomers").table2excel({
      filename: "Daily_Report_Bank_masr.xls"
    });
  }
</script>

<?php 
include ("footer.html");
?>