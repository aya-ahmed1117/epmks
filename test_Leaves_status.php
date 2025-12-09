

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
/*******************/
.text {
position:relative;
bottom:30px;
left:0px;
visibility:hidden;
}

.text:hover .text {
visibility:visible;
width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  bottom: 100%;
  /*left: 50%;
  margin-left: -60px;  Use half of the width (120/2 = 60), to center the tooltip */
}
.hovertext {
  position: relative;
  border-bottom: 1px dotted black;
}

.hovertext:before {
  content: attr(data-hover);
  visibility: hidden;
  opacity: 0;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 5px;
  padding: 5px 0;
  transition: opacity 1s ease-in-out;

  position: absolute;
  z-index: 10;


  /*top: 100%;
  left: 50%;*/
 margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: red transparent transparent transparent;
}
.hovertext:hover:before {
  opacity: 1;
  visibility: visible;
   width: 120px;
  bottom: 100%;
  left: 50%;
  margin-left: -60px; 
}

</style>
<div style="padding:20px;">
<!--   <h2>Top Tooltip</h2>
<p>Move the mouse over the text below:Hover over me</p>

<div class="tooltip"style="text-align:center;">Hover over me
  <span class="tooltiptext">Tooltip text</span>
</div>
  -->

 <div class="wrapper">
    <img src="images/ImpoliteVapidGuanaco.gif"  />
    <p class="text">text</p>
</div>



<?php  
$curr_year = date('Y');    
if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];}
    ?>
<!-- <center>
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
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">0...0</p></samp>
    </aside>
  </div>
</center> -->
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
        <th >ID</th>
        <th >Username</th>
        <th >Type</th>
        <th  >From Date</th>
        <th >To Date</th>
        <th >From Time</th>
        <th >To Time</th>
        <th >Notes</th>
        <th >Count</th>
        <th >Status</th>
        <th >E-workforce approve</th>
        <th >Senior approved </th>
        <th>Senior rejected</th>
        <th >workforce reject</th>
        <th >wfm_note</th>
    </tr>
  </thead>

  <tbody>
<?php
$check_engineers  = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'   ");
while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
}
    if(isset($_GET['type'])){$type = $_GET['type'];} 

$first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE username = 'ahmed.abelhameed' and  year(adate) >=2022");
//php -> output data from mysqli

while($output_query = sqlsrv_fetch_array($first_query)){

$rows  ='<tr>';
$rows .='<td class="hovers id" style="border: 1px solid lightgray;" >'.$output_query["id"].'</td>';
$rows .='<td class="hovers username" style="border: 1px solid lightgray;">'.$output_query["username"].'</td>';
 if(($output_query["attach_image"] !== "uploads/") && ($output_query["attach_image"] !== "null") && ($output_query["attach"] !== "uploads/") && ($output_query["attach"] !== " ") && ($output_query["type"] == "Sick Leave"  || $output_query["type"] == "Compassionate Leave"  || 
    $output_query["type"] == "Maternity Leave" || $output_query["type"] == "Paternity Leave")){
$rows .='<td  class="pt-3-half" >
<a href='.$output_query["attach"].' ll><samp style="float:right;font-size:15px;">
<i class="fas fa-paperclip" style="color:red;width:35px;"></samp></i>
</a>'.$output_query["type"].'</td>';}
else{
$rows .='<td class="hovers type" style="border: 1px solid lightgray;" title="fhfhtg">
'.$output_query["type"].'</td>';
}

$rows .= '<td><span class="hovertext" data-hover="Open, to get data">
  <input type="button wrapper"  name="idd" value="Notes" id="'.$output_query["id"].'" class="btn btn-info btn-xs view_data" /></span></td>';


$rows .= '<td><input type="button" value="test" class="btn btn-info btn-xs view_data"  data-id="'.$output_query["id"].'" data-username="'.$output_query["username"].'" data-adate="'.$output_query["adate"]->format('Y-m-d').'" data-type="'.$output_query["type"].'"
data-bdate="'.$output_query["bdate"]->format('Y-m-d').'" 
 data-starttime="'.$output_query['starttime']->format('H:i:s').'" data-endtime="'.$output_query["endtime"]->format('H:i:s').'" data-engineer_id = "'.$output_query["engineer_id"].'"/></td>';
  $rows.="</tr>";
  echo $rows;
}
?>
</tbody>
</table>
<?php //}
?>
<?php // if(($_SESSION['role_id'] == 2) || ($_SESSION['role_id'] == 3) ) {
    ?>
 <!--  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >All history leaves seniors
      <a href="allstatus2.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;"></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
        <th >ID</th>
        <th >Username</th>
        <th >Type</th>
        <th >From Date</th>
        <th >To Date</th>
        <th >From Time</th>
        <th >To Time</th>
        <th >Notes</th>
        <th >Count</th>
        <th >Status</th>
    </tr>
  </thead>
  <tbody> -->
<?php
/*
$check_engineers  = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'   ");
  while( $output_engineers = sqlsrv_fetch_array($check_engineers)){

  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
}

$first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE engineer_id ='$engineer_id' and adate >='2021-12-01'");

while( $output_query = sqlsrv_fetch_array($first_query)){

$rows ="<tr>";
$rows .='<td style="border: 1px solid lightgray;">'.$output_query["id"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["username"].'</td>';
  if(($output_query["attach_image"] !== "uploads/") && ($output_query["attach_image"] !== "null") && ($output_query["attach"] !== "uploads/") && ($output_query["attach"] !== " ") && ($output_query["type"] == "Sick Leave"  || $output_query["type"] == "Compassionate Leave"  || 
    $output_query["type"] == "Maternity Leave" || $output_query["type"] == "Paternity Leave")){
$rows .= '<td  class="hovers" style="border: 1px solid lightgray;"><a href='.$output_query["attach_image"].' download><samp style="float:right;font-size:15px;"><i class="fas fa-paperclip" style="color:red;width:35px;"></samp></i>
</a>'.$output_query["type"].'</td>';}

 else{
$rows.='<td class="hovers"style="border: 1px solid lightgray;">'.$output_query["type"].'</td>';
}
$rows.='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["adate"]->format('Y-m-d').'</td>';
$rows.='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["bdate"]->format('Y-m-d').'</td>';
$rows.='<td class="hovers" style="border: 1px solid lightgray;color:blue;">'.$output_query["starttime"]->format('H:i:s').'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;color:blue;">'.$output_query["endtime"]->format('H:i:s').'</td>';
$rows.='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["notes"].'</td>';
$rows.='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["count"].'</td>';
$rows.='<td class="hovers" style="border: 1px solid lightgray;color:green;">'.$output_query["status"].'</td>';

$rows .=  '</tr>';
echo $rows;
}
}
 */
?>

<!-- </tbody>
</table>
</div> -->
<?php //if ($_SESSION['role_id'] == 1){
  //if(isset($_GET['id2']) ){  ?>
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
         <input type="text" class="form-control idd"  disabled="true" />
         <?php //echo  ?>
      
        <br>
      <label >Type</label>

        <div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers chkveg" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;">
            <tr>
              <th>a</th>
              <th>b</th>
              <th>c</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="form-control type" style="color:blue;font-size:25px;"><?php echo $output_query["type"]; ?></td>
              <td class="form-control id" style="color:blue;font-size:25px;"><?php echo $output_query["id"]; ?></td>
              <td class="form-control username" style="color:blue;font-size:25px;"><?php echo $output_query["username"]; ?></td>
  
            </tr>
          </tbody>

        </table>

        <br>
          <div class="modal-footer">
          </label>
             <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
            </div>
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
     $(document).on('click', '.view_data', function(){  
           var idd = $(this).attr("id"); 
          // var type = $('.type').val();
//console.log(idd);
          //var id = $(this).data('id');  
          var  usernames= $(this).data('username');  
          var  type= $(this).data('type');  
          var  adate= $(this).data('adate');  
          var  bdate= $(this).data('bdate');  
          var  starttime= $(this).data('starttime');  
          //var  = $(this).data('');  

           //var type = $('.type').val(); 
        //var dataString = 'username='+username+'&type='+type;


    var dataString ='username='+usernames+'&type='+type+'&id='+idd+'&adate='+adate+'&bdate='+bdate+'&starttime='+starttime;

          // $('.username').val(username);
          // $('.type').val("");

                    $.ajax({   
                    url: 'connected.php',
                    type: 'POST',
                    data:dataString,
                    cache: false,  
                     success:function(data){ 
                     console.log(dataString);  
                          $('#message21').modal('show'); 
                      $('#chkveg').modal('chkveg'); 

                     }  
                }); 
 return false;
     }); 
     }); 
</script>
</div>

<script src="js/table2excel.js" type="text/javascript"></script>
 <script src="table-filter.js"></script>

  <?php
 //include ("footer.html");
 ?>