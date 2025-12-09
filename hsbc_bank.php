

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
<title>HSBC bank</title>

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
        <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Here you can Find HSBC Bank Report per Day 
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

<!--div style="padding: 20px;">

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
</div-->


<?php 
if(isset($_POST['day'])){
  $myDate = $_POST['day'];}
 // if(isset($_POST['submit'])){
    $first_query = sqlsrv_query( $connect,"SELECT 
                   [Opening_Date]
                  ,[TKT]
                  ,[Subject]
                  ,[Category]
                  ,[Closure_Reason]
                  ,[Order]
                  ,[Close_Date]
                  ,[RFO]
              FROM [tranning_Database].[dbo].[HSBC]
              order by [Opening_Date] ASC");      
             if (sqlsrv_has_rows($first_query)) {
          ?>

<center>


  <div style="padding:20px;">

    <div class="tableFixHead">
      <table class="table order-table" cellspacing="0" id="tblCustomers" >
        <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
          <tr>
                  <th>Opening Date</th>
                  <th>TKT</th>
                  <th>Subject</th>
                  <th>Category</th>
                  <th>Closure Reason</th>
                  <th>Order</th>
                  <th>Close Date</th>
                  <th>RFO</th>
          
          </tr>
        </thead>

        <tbody>
          <?php   
         while( $output_query = sqlsrv_fetch_array($first_query)){
            $rows  ='<tr>';
            if ($output_query["Opening_Date"] == NULL){
              $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >Blank</td>';
            }else{
              $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Opening_Date"]->format('Y-m-d H:i:s').'</td>';
            }
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["TKT"].'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Subject"].'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Category"].'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Closure_Reason"].'</td>';

              $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Order"].'</td>';
          
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Close_Date"].'</td>';
            $rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["RFO"].'</td>';
            $rows .= '</tr>';

            echo $rows;
          }
       } 
       else{
        echo '<h3>No data found </h3>';
       }
    // }
     
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
      filename: "Report_HSBC.xls"
    });
  }
</script>

<?php 
include ("footer.html");
?>
      