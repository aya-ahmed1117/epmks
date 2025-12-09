

<?php
include ("pages.php");
    if(isset($_POST['type'])){$type = $_POST['type'];}  

?>

    <title>Leaves History</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
        </head>
        <body style="text-align:center;">

<h2>Top Tooltip</h2>
<p>Move the mouse over the text below:</p>

<div class="tooltip">Hover over me
  <span class="tooltiptext">Tooltip text</span>
</div>

<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
  .zoom:hover{
    transform: scale(1.5);
  }
  .order-table tr:nth-child(even) {
    background-color: #f8f6ff;
}

.modal-title {
    margin: 0;
    line-height: 1.42857143;
}
.modal-content, #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}
.modal-content {
    background-color: #fefefe;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #888;
    width: 30%;
    position: static;
    z-index: 10;
}

label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}

h1, h2, h3, h4, h5, h6 {
    font-family: "Nunito", sans-serif;
}
.h5, h5 {
    font-size: 1.25rem;
}


[type=button]:not(:disabled) {
    cursor: pointer;
}

textarea.form-control {
    min-height: calc(1.5em + 0.75rem + 2px);
}
.modal-footer {
    display: flex;
    flex-wrap: wrap;
    flex-shrink: 0;
    align-items: center;
    justify-content: flex-end;
    padding: 0.75rem;
    border-top: 1px solid #dee2e6;
    border-bottom-right-radius: calc(0.3rem - 1px);
    border-bottom-left-radius: calc(0.3rem - 1px);
}
button:not(:disabled) {
    cursor: pointer;
}


.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

.close2 {
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
}

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #eee;
    opacity: 1;
}
/**********************/
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  bottom: 100%;
  left: 50%;
  margin-left: -60px;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>

<div style="padding:20px;">
  
<?php  
$curr_year = date('Y');    
if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];}
    ?>
<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >All history leaves
      <a href="allstatus2.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;"> </p></samp>
    </aside>
  </div>
</center>

<?php ///include("alert.html");
?>
<br>

<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
        <th style="color:#fff;"><center>ID</center></th>
  <th style="color:#fff;"><center>Username</center></th>
  <th style="color:#fff;"><center>Annual</center></th>
  <th style="color:#fff;"><center>Official</center></th>
  <th style="color:#fff;"><center>Permission</center></th>
  <th style="color:#fff;"><center>Sick Leave</center></th>
  <th style="color:#fff;"><center>Unpaid</center></th>
  <th style="color:#fff;"><center>Maternity</center></th>
  <th style="color:#fff;"><center>Compassionate</center></th>
  <th style="color:#fff;"><center>Pilgrimage Leave</center></th>
  <th style="color:#fff;"><center>Paternity Leave</center></th>
  <th style="color:#fff;"><center>Maternity on duty le</center></th>
    </tr>
  </thead>

  <tbody>
<?php
$engineer_id = $_SESSION['id'];



    $first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE
  username = 'ahmed.abelhameed' and  year(adate) >=2022 ");
  //while($output_query5 = sqlsrv_fetch_array($first_query)){
    $output_query5 = sqlsrv_fetch_array($first_query);
    echo$leave_type=$output_query5['type'];



$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE 
  username = 'ahmed.abelhameed' ");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['username_id'];
  $eng_id = $output_engineers['id'];
  $username_emp = $output_engineers['username'];

$check_orders = sqlsrv_query( $con ,"SELECT * FROM Leaves_counter WHERE username='ahmed.abelhameed' ");
 while( $output_query = sqlsrv_fetch_array($check_orders)){
  
$rows  = '<tr>';
$rows .= '<td class="hovers"><center>'.$output_query["id"].'</center></td>';
$rows .= '<td class="hovers"><center>'.$output_query["username"].'</center></td>';

$typs_query = sqlsrv_query( $con ,"SELECT distinct  [tbl_Personal_info].id, employee_name, [manager_id], [super_id], [leaves].[username], [type], [count],adate,bdate,starttime,endtime,engineer_id
    ,[Aya_Web_APP].[dbo].[leaves].id [leave_id]
FROM     [Aya_Web_APP].[dbo].[leaves] 
LEFT JOIN
[Employess_DB].[dbo].[tbl_Personal_info] ON [leaves].username = [tbl_Personal_info].username LEFT JOIN
[Aya_Web_APP].[dbo].employee ON employee.username = [leaves].username
WHERE        [status] = 'E-workforce and senior approve' AND (year([adate]) = year(getdate()) OR
year([bdate]) = year(getdate())) AND Employee_Status IN ('active', 'Maternity')
and [leaves].username='ahmed.abelhameed' and [leaves].[type]='$leave_type'
");
    while( $output_type = sqlsrv_fetch_array($typs_query)){
    //$output_type = sqlsrv_fetch_array($typs_query);
       $coun_type = $output_type['type'];
       $coun_id = $output_type['leave_id'];
       $coun_username= $output_type['username'];
      //
// $first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE
//  username = 'ahmed.abelhameed' and  year(adate) >=2022 and [type]='$coun_type'");
//  while($output_query5 = sqlsrv_fetch_array($first_query)){
//  $my_id=$output_query5['id'];
//  $my_username=$output_query5['username'];

//    //while($output_query5 = sqlsrv_fetch_array($first_query)){
// $rows .= '<td>
// <input type="button" value="test" 
//  class="btn btn-info btn-xs view_data"  data-id="'.$output_query5["id"].'" data-username="'.$output_query5["username"].'" data-adate="'.$output_query5["adate"]->format('Y-m-d').'" data-type="'.$coun_type.'"
// data-bdate="'.$output_query5["bdate"]->format('Y-m-d').'" 
//  data-starttime="'.$output_query5['starttime']->format('H:i:s').'" data-endtime="'.$output_query5["endtime"]->format('H:i:s').'" data-engineer_id = "'.$output_query5["engineer_id"].'"/>

//  </td>';
// //  }
// // }
//  $rows .= '<td>
// <input type="button" value="test" 
//  class="btn btn-info btn-xs view_data"  data-id="'.$coun_id.'" data-username="'.$coun_username.'" data-adate="'.$output_type["adate"]->format('Y-m-d').'" data-type="'.$coun_type.'"
// data-bdate="'.$output_type["bdate"]->format('Y-m-d').'" 
//  data-starttime="'.$output_type['starttime']->format('H:i:s').'" data-endtime="'.$output_type["endtime"]->format('H:i:s').'" data-engineer_id = "'.$output_type["engineer_id"].'"
//  data-count="'.$output_type["count"].'" />

//  </td>';
       /*

$typs_query = sqlsrv_query( $con ,"SELECT username , adate,bdate,[count], [type],id,starttime
,endtime from 
[dbo].[leaves]
where 
username = 'ahmed.abelhameed' 
and year(adate) >= '2022' and [status] =
'E-workforce and senior approve'");
    while( $output_type = sqlsrv_fetch_array($typs_query)){
        */
$rows .= '<td class="hovers"><center>
<button class="btn btn-primary btn-circle btn-xl view_data"  data-id="'.$coun_id.'" data-username="'.$coun_username.'" data-adate="'.$output_type["adate"]->format('Y-m-d').'" data-type="'.$coun_type.'" name="Annual Leave"
data-bdate="'.$output_type["bdate"]->format('Y-m-d').'" 
 data-starttime="'.$output_type['starttime']->format('H:i:s').'" data-endtime="'.$output_type["endtime"]->format('H:i:s').'" data-engineer_id = "'.$output_type["engineer_id"].'"
 data-count="'.$output_type["count"].'" data-annual="'.$output_query["Annual Leave"].'">'.$output_query["Annual Leave"].'</button>
   </center></td>';

$rows .= '<td class= "hovers"><center>
<button class="btn btn-dark btn-circle btn-xl view_data"  data-id="'.$coun_id.'" data-username="'.$coun_username.'" data-adate="'.$output_type["adate"]->format('Y-m-d').'" data-type="'.$coun_type.'"
data-bdate="'.$output_type["bdate"]->format('Y-m-d').'" 
 data-starttime="'.$output_type['starttime']->format('H:i:s').'" data-endtime="'.$output_type["endtime"]->format('H:i:s').'" data-engineer_id = "'.$output_type["engineer_id"].'"
 data-count="'.$output_type["count"].'">'.$output_query["Official Mission"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button  class="btn btn-info btn-circle btn-xl" data-target="#leavesType" data-type="Permission">'.$output_query["Permission"].'</button></center></td>';
$rows .= '<td  class="hovers"><center>
<button  class="btn btn-warning btn-circle btn-xl"data-target="leavesType" data-type="Sick Leave">'.$output_query["Sick Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle btn-xl"data-target="leavesType" data-type="Unpaid Leave">'.$output_query["Unpaid Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-danger btn-circle btn-xl"data-target="leavesType">'.$output_query["Maternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-dark btn-circle btn-xl"data-target="leavesType">'.$output_query["Compassionate Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-info btn-circle "data-target="leavesType">'.$output_query["Pilgrimage Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle"data-target="leavesType">'.$output_query["Paternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-warning btn-circle"data-target="leavesType">'.$output_query["Maternity on duty leave"].'</button></center></td>';
$rows .='</tr>';

echo $rows; 

}}}
?>
</tbody>
</table>

   <script src="table-filter.js"></script>

                    </div>
<div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal" id="message21" >
      <div id="myOut" class="modal-content" >

        <h5 class="modal-title" >Leave type
        </h5>
         <div ><button class="close2" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
           </button></div>
         <input type="text" class="form-control id"  disabled="true" />
         
               
        <br>
      <label >Notes</label>
        <div class="tableFixHead">

<table class="table order-table"  cellspacing="0" id="tblCustomers chkveg" >
          <thead>
            <tr>
              <th>type</th>
              <th>adate</th>
              <th>bdate</th>
              <th>count</th>
              <th>Annual</th>
              
            </tr>
          </thead>
  <tbody>
            <tr>
              <td><input type="text" class="form-control type"  disabled="true" /></td>
              <td><input type="text" class="form-control adate"  disabled="true" /></td>
              <td><input type="text" class="form-control bdate"  disabled="true" /></td>
              <td><input type="text" class="form-control count"  disabled="true" /></td>
              <td><input type="text" class="form-control annual"  disabled="true" /></td>

  
            </tr>
          </tbody>

        </table>
</div>
        <br>
          <div class="modal-footer">
          </label>
             <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
    <!--/div-->
    <script type="text/javascript">
      $(".close").click(function () {
    //close action
      document.getElementById("message21").style.display = "none";
          });
    </script>
</div>
<script type="text/javascript">
$(document).ready(function(){  
       var modal = $(this);
     $(document).on('click','.view_data', function(){ 
           //var id = $(this).attr("id"); 
          var username= $(this).data('username'); 
          var id = $(this).data("id");  
          var type= $(this).data('type');
           //var  type1= $(this).data('type'); 
           var adate =$(this).data("adate");
           var bdate =$(this).data("bdate");
           var count =$(this).data("count");
           var annual = $(this).data("annual");

          // var type2 = $('.type').val(); 
        var dataString = 'id='+id+'&type='+type+'&username='+username+'&adate='+adate+'&bdate='+bdate+'&count='+count;
          $('.id').val(id);
          $('.type').val(type);
          $('.username').val(username);
          $('.adate').val(adate);
          $('.bdate').val(bdate);
          $('.count').val(count);
          $('.annual').val(annual);

                    $.ajax({   
                   // url: 'connected.php',
                    url: 'connected.php',
                    type: 'POST',
                    data:dataString,
                    cache: false,  
                     success:function(data){   
                          $('#message21').modal('show'); 
                          console.log(dataString); 
                     }  
                }); 
 return false;
     }); 
     }); 
</script>
</div>

<script>
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
 // popup.classList.toggle("hide");
  popup.style.display = "none"; 

}
</script>

<script src="js/table2excel.js" type="text/javascript"></script>
 <script src="table-filter.js"></script>

  <?php
 //include ("footer.html");
 ?>