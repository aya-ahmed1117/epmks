
<?php
include ("pages.php");
        if(isset($_POST['type'])){$type = $_POST['type'];}
        if(isset($_POST['username'])){$username = $_POST['username'];}
$this_year = date('Y');
      /*   $first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE
  username = '$username' and [type] = '$type' and  year(adate) >=2022 ");
  //while($output_query5 = sqlsrv_fetch_array($first_query)){
    $output_query5 = sqlsrv_fetch_array($first_query);
    $leave_type=$output_query5['type'];*/

?>

	<title>My Team Leaves</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
      /*font-size: 10px;*/
        }
  .zoom:hover{
    transform: scale(1.5);
  }
   td {
  padding:4px;
  font-size: 13px;
  color: black;
}

th {
  text-align: center;
  white-space: nowrap;
  text-overflow: ellipsis;
  font-size: 13px;
  color: #fff;
  line-height: 1.1;
}
  .btn {
   
   font-size: 13px;
    
}
tr:nth-child(even) {
    background-color: #dee2e6;
}

.modal-title {
    margin: 0;
    line-height: 1.42857143;
    position: static;
    z-index: 10;
}
.modal-content, #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
    /*height: 60%;*/
   overflow-x: auto;
    overflow-y: auto;
}
.modal-content {
    background-color: #fefefe;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #888;
    width: 60%;

    position: static;
    z-index: 10;
    

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
/********************/
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
  bottom: 160%;
  left: 50%;
  margin-left: -60px; 
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
          <h2 class="text-dark display-12" >My Team Leaves History</h2>
          <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
      
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Here you can see your  team history of Leaves ( Annual - Permission - ...etc.) in the current year</p>
  </aside>
</div>
</center>

<div style="padding:20px;">
<!------Modal -->
 <div class="container" >

    <div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal" id="empModal" >
      <div id="myOut" class="modal-content" >

        <h5 class="modal-title">
        </h5>
         <div ><button class="close2" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
           </button></div>
 <div class="modal-body">
 
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-info" data-dismiss="modal" style="color:#eee;font-weight: bold; font-size:18px;">Close</button>
      </div>
     </div>
    </div>
   </div>
</div>
</div>
<!-----Modal --->
<center>
  <h2 style="color:;">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
 <div class="tableFixHead">

<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style=" background-color: #55608f;
    text-align: center;color: black;position: relative; ">
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

if(($_SESSION['role_id'] == 1) || ($_SESSION['username'] == 'x_test')){

  

$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 0");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['username_id'];
  $eng_id = $output_engineers['id'];
  $username_emp = $output_engineers['username'];
}
   $check_permission = sqlsrv_query( $con ,"SELECT [id],[engineer_id]
      ,[username]
      ,[adate],[type] ,[count]
      ,[status],[starttime],[endtime]      
  FROM [Aya_Web_APP].[dbo].[leaves]
  where username='$username_emp' ");
  while($output_Permiss = sqlsrv_fetch_array($check_permission)){
 $type = $output_Permiss['type'];

$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 0");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['username_id'];
  $eng_id = $output_engineers['id'];
  $username_emp = $output_engineers['username'];

$check_orders = sqlsrv_query( $con ,"SELECT * FROM Leaves_counter WHERE id = '$engineers_id' ");
 while( $output_query = sqlsrv_fetch_array($check_orders)){
$rows  = '<tr>';
$rows .='<td class="hovers"><center>'.$output_query["id"].'</center></td>';
$rows .= '<td class="hovers"><center>'.$output_query["username"].'</center></td>';
$rows .= '<td class="hovers"><center><span class="hovertext" data-hover="Open, to get data">
<button class="btn btn-primary btn-circle btn-xl userinfo"
    data-type="Annual Leave" data-username="'.$output_query["username"].'">'.$output_query["Annual Leave"].'</button>
   </span></center></td>';
$rows .= '<td class= "hovers"><center>
<button class="btn btn-dark btn-circle btn-xl userinfo" 
data-username="'.$output_query["username"].'" data-type="Official Mission" data-username="'.$output_query["username"].'">'.$output_query["Official Mission"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button  class="btn btn-info btn-circle btn-xl userinfo" data-type="Permission" data-username="'.$output_query["username"].'">'.$output_query["Permission"].'</button></center></td>';
$rows .= '<td  class="hovers"><center>
<button  class="btn btn-warning btn-circle btn-xl userinfo"data-type="Sick Leave" data-username="'.$output_query["username"].'">'.$output_query["Sick Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle btn-xl userinfo"data-type="Unpaid Leave" data-username="'.$output_query["username"].'">'.$output_query["Unpaid Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-danger btn-circle btn-xl userinfo" data-type="Maternity Leave" data-username="'.$output_query["username"].'">'.$output_query["Maternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-dark btn-circle btn-xl userinfo" data-type="Compassionate Leave" data-username="'.$output_query["username"].'">'.$output_query["Compassionate Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-info btn-circle btn-xl userinfo"data-type="Pilgrimage Leave" data-username="'.$output_query["username"].'">'.$output_query["Pilgrimage Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle userinfo"data-type="Paternity Leave" data-username="'.$output_query["username"].'">'.$output_query["Paternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-warning btn-circle userinfo"data-type="Maternity on duty leave" data-username="'.$output_query["username"].'">'.$output_query["Maternity on duty leave"].'</button></center></td>';

$rows .='</tr>';

echo $rows; 
}//types
}}}

if($_SESSION['role_id'] == 2) {
  

//senior
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee 
    WHERE manager_id = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_ids = $output_engineers['username_id'];

$check_orders = sqlsrv_query( $con ,"SELECT *
  FROM [Aya_Web_APP].[dbo].[Leaves_counter] WHERE id = '$engineers_ids' ");
 while( $output_query = sqlsrv_fetch_array($check_orders)){  
$rows  = '<tr>';
$rows .= '<td class="hovers"><center>'.$output_query["id"].'</center></td>';
$rows .= '<td class="hovers"><center>'.$output_query["username"].'</center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-primary btn-circle btn-xl userinfo"
    data-type="Annual Leave" data-username="'.$output_query["username"].'">'.$output_query["Annual Leave"].'</button>
   </center></td>';
$rows .= '<td class= "hovers"><center>
<button class="btn btn-dark btn-circle btn-xl userinfo" 
data-username="'.$output_query["username"].'" data-type="Official Mission" data-username="'.$output_query["username"].'">'.$output_query["Official Mission"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button  class="btn btn-info btn-circle btn-xl userinfo" data-type="Permission" data-username="'.$output_query["username"].'">'.$output_query["Permission"].'</button></center></td>';
$rows .= '<td  class="hovers"><center>
<button  class="btn btn-warning btn-circle btn-xl userinfo"data-type="Sick Leave" data-username="'.$output_query["username"].'">'.$output_query["Sick Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle btn-xl userinfo"data-type="Unpaid Leave" data-username="'.$output_query["username"].'">'.$output_query["Unpaid Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-danger btn-circle btn-xl userinfo" data-type="Maternity Leave" data-username="'.$output_query["username"].'">'.$output_query["Maternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-dark btn-circle btn-xl userinfo" data-type="Compassionate Leave" data-username="'.$output_query["username"].'">'.$output_query["Compassionate Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-info btn-circle btn-xl userinfo"data-type="Pilgrimage Leave" data-username="'.$output_query["username"].'">'.$output_query["Pilgrimage Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle userinfo"data-type="Paternity Leave" data-username="'.$output_query["username"].'">'.$output_query["Paternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-warning btn-circle userinfo"data-type="Maternity on duty leave" data-username="'.$output_query["username"].'">'.$output_query["Maternity on duty leave"].'</button></center></td>';

$rows .='</tr>';
echo $rows; }

}}
if($_SESSION['role_id'] == 3) {
  
//super
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [super_id] = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['username_id'];

$check_orders = sqlsrv_query( $con ,"SELECT * FROM Leaves_counter WHERE id = '$engineers_id' ");

   while( $output_query = sqlsrv_fetch_array($check_orders)){
  
$rows  = '<tr>';
$rows .= '<td class="hovers"><center>'.$output_query["id"].'</center></td>';
$rows .= '<td class="hovers"><center>'.$output_query["username"].'</center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-primary btn-circle btn-xl userinfo"
    data-type="Annual Leave" data-username="'.$output_query["username"].'">'.$output_query["Annual Leave"].'</button>
   </center></td>';
$rows .= '<td class= "hovers"><center>
<button class="btn btn-dark btn-circle btn-xl userinfo" 
data-username="'.$output_query["username"].'" data-type="Official Mission" data-username="'.$output_query["username"].'">'.$output_query["Official Mission"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button  class="btn btn-info btn-circle btn-xl userinfo" data-type="Permission" data-username="'.$output_query["username"].'">'.$output_query["Permission"].'</button></center></td>';
$rows .= '<td  class="hovers"><center>
<button  class="btn btn-warning btn-circle btn-xl userinfo"data-type="Sick Leave" data-username="'.$output_query["username"].'">'.$output_query["Sick Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle btn-xl userinfo"data-type="Unpaid Leave" data-username="'.$output_query["username"].'">'.$output_query["Unpaid Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-danger btn-circle btn-xl userinfo" data-type="Maternity Leave" data-username="'.$output_query["username"].'">'.$output_query["Maternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-dark btn-circle btn-xl userinfo" data-type="Compassionate Leave" data-username="'.$output_query["username"].'">'.$output_query["Compassionate Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-info btn-circle btn-xl userinfo"data-type="Pilgrimage Leave" data-username="'.$output_query["username"].'">'.$output_query["Pilgrimage Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle userinfo"data-type="Paternity Leave" data-username="'.$output_query["username"].'">'.$output_query["Paternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-warning btn-circle userinfo"data-type="Maternity on duty leave" data-username="'.$output_query["username"].'">'.$output_query["Maternity on duty leave"].'</button></center></td>';

$rows .='</tr>';

echo $rows; 
}
}}
if($_SESSION['role_id'] == 4) {
  
//Section
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [section_id] = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['username_id'];

$check_orders = sqlsrv_query( $con ,"SELECT * FROM Leaves_counter WHERE id = '$engineers_id' ");

   while( $output_query = sqlsrv_fetch_array($check_orders)){
   
$rows  = '<tr>';
$rows .= '<td class="hovers"><center>'.$output_query["id"].'</center></td>';
$rows .= '<td class="hovers"><center>'.$output_query["username"].'</center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-primary btn-circle btn-xl userinfo"
    data-type="Annual Leave" data-username="'.$output_query["username"].'">'.$output_query["Annual Leave"].'</button>
   </center></td>';
$rows .= '<td class= "hovers"><center>
<button class="btn btn-dark btn-circle btn-xl userinfo" 
data-username="'.$output_query["username"].'" data-type="Official Mission" data-username="'.$output_query["username"].'">'.$output_query["Official Mission"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button  class="btn btn-info btn-circle btn-xl userinfo" data-type="Permission" data-username="'.$output_query["username"].'">'.$output_query["Permission"].'</button></center></td>';
$rows .= '<td  class="hovers"><center>
<button  class="btn btn-warning btn-circle btn-xl userinfo"data-type="Sick Leave" data-username="'.$output_query["username"].'">'.$output_query["Sick Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle btn-xl userinfo"data-type="Unpaid Leave" data-username="'.$output_query["username"].'">'.$output_query["Unpaid Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-danger btn-circle btn-xl userinfo" data-type="Maternity Leave" data-username="'.$output_query["username"].'">'.$output_query["Maternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-dark btn-circle btn-xl userinfo" data-type="Compassionate Leave" data-username="'.$output_query["username"].'">'.$output_query["Compassionate Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-info btn-circle btn-xl userinfo"data-type="Pilgrimage Leave" data-username="'.$output_query["username"].'">'.$output_query["Pilgrimage Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle userinfo"data-type="Paternity Leave" data-username="'.$output_query["username"].'">'.$output_query["Paternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-warning btn-circle userinfo"data-type="Maternity on duty leave" data-username="'.$output_query["username"].'">'.$output_query["Maternity on duty leave"].'</button></center></td>';

$rows .='</tr>';
echo $rows; 
}
}}
?>
       </tbody>
      </table>
    </div>
  </div> 
</center>
</div>


  <script ssrc="js/jquery-3.6.0.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
<script type="text/javascript">
$(document).ready(function(){

 $('.userinfo').click(function(){
   
   var userid = $(this).data('id');
   var type =$(this).data('type');
   var username = $(this).data('username');

  var dataString = 'id='+userid+'&type='+type+'&username='+username;
  
  //var dataString ='id='+userid+'&type='+type;
   // AJAX request
   $.ajax({
    url: 'connected.php',
    type: 'post',
    data: dataString,
    success: function(response){ 
      // Add response in Modal body
      $('.modal-body').html(response);
      $('.modal-title').html('Type :'+type);
      // Display Modal
      $('#empModal').modal('show'); 
    }
  });
 });
});</script>
 <script type="text/javascript">
      $(".close").click(function () {
    //close action
      document.getElementById("message21").style.display = "none";
          });
    </script>

      <script>
    $('.js-pscroll').each(function(){
      var ps = new PerfectScrollbar(this);

      $(window).on('resize', function(){
        ps.update();
      })
    });
      
    
  </script>
  <script src="table-filter.js"></script>
  <script src="js/table2excel.js" type="text/javascript"></script>


	<?php

 //include ("footer.html");
 ?>

