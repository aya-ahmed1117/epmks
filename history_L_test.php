

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


</style>
<?php


 		if(isset($_POST['type'])){$types = $_POST['type'];}

    $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 0");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['username_id'];
  $eng_id = $output_engineers['id'];
  $username = $output_engineers['username'];
}

 $first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE
  username = '$username' and  year(adate) >=2022 ");
  //while($output_query5 = sqlsrv_fetch_array($first_query)){
    $output_query5 = sqlsrv_fetch_array($first_query);
    $leave_type=$output_query5['type'];

?> 


<div style="padding:20px;">

  <div class="container" >

    <div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal" id="empModal" >
      <div id="myOut" class="modal-content" >

        <h5 class="modal-title" >hena <?php echo $leave_type; ?>
        </h5>
         <div ><button class="close2" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
           </button></div>



   <!-- Modal >
   <div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog">
 
     <-- Modal content>
     <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">User Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div-->
      <div class="modal-body">
 
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
    </div>
   </div>
</div>
</div>
   <?php 
   /*$query = "select * from employee";
   $result = mysqli_query($con,$query);
   while($row = mysqli_fetch_array($result)){
     $id = $row['id'];
     $name = $row['emp_name'];
     $email = $row['email'];

     echo "<tr>";
     echo "<td>".$name."</td>";
     echo "<td>".$email."</td>";
     echo "<td><button data-id='".$id."' class='userinfo'>Info</button></td>";
     echo "</tr>";
   }*/
   ?>
<center>
  <h2 style="color:;">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
 <div class="tableFixHead">

<table class="table order-table"  cellspacing="0" id="tblCustomers chkveg" >
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


$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 0");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['username_id'];
  $eng_id = $output_engineers['id'];
  $username = $output_engineers['username'];
}
    

$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE 
	username = '$username' ");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['username_id'];
  $eng_id = $output_engineers['id'];
  $username_emp = $output_engineers['username'];

$check_orders = sqlsrv_query( $con ,"SELECT * FROM Leaves_counter WHERE id = '$engineers_id' ");
 while( $output_query = sqlsrv_fetch_array($check_orders)){
$rows  = '<tr>';
$rows .= '<td class="hovers"><center>'.$output_query["id"].'</center></td>';
//$rows .= "<td><button data-id='".$output_query["id"]."' class='userinfo'>Info</button></td>";

$rows .= '<td class="hovers"><center>'.$output_query["username"].'</center></td>';

$rows .= '<td class="hovers"><center>
<button class="btn btn-primary btn-circle btn-xl userinfo"
    data-type="Annual Leave" data-username="username">'.$output_query["Annual Leave"].'</button>
   </center></td>';
$rows .= '<td class= "hovers"><center>
<button class="btn btn-dark btn-circle btn-xl userinfo" data-target="#leavesType" data-type="Official Mission" data-username="username">'.$output_query["Official Mission"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button  class="btn btn-info btn-circle btn-xl userinfo" data-type="Permission" data-username="username">'.$output_query["Permission"].'</button></center></td>';
$rows .= '<td  class="hovers"><center>
<button  class="btn btn-warning btn-circle btn-xl userinfo"data-type="Sick Leave">'.$output_query["Sick Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle btn-xl userinfo"data-type="Unpaid Leave">'.$output_query["Unpaid Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-danger btn-circle btn-xl userinfo" data-type="Maternity Leave">'.$output_query["Maternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-dark btn-circle btn-xl userinfo" data-type="Compassionate Leave">'.$output_query["Compassionate Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-info btn-circle btn-xl userinfo"data-type="Pilgrimage Leave">'.$output_query["Pilgrimage Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle userinfo"data-type="Paternity Leave">'.$output_query["Paternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-warning btn-circle userinfo"data-type="Maternity on duty leave">'.$output_query["Maternity on duty leave"].'</button></center></td>';
$rows .='</tr>';

echo $rows; 

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
   // AJAX request
   $.ajax({
    url: 'connected.php',
    type: 'post',
    data: dataString,
    success: function(response){ 
      // Add response in Modal body
      $('.modal-body').html(response);

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

<script src="table-filter.js"></script>
  <script src="js/table2excel.js" type="text/javascript"></script>


	<?php

 //include ("footer.html");
 ?>

