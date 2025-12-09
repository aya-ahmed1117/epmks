
<?php
include ("pages.php");
?>

  <title>My Team Leaves</title>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
      font-size: 10px;
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

 <!--/.c-->

 <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Leaves
                 </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
                            </button>
                        </div>
           <div class="modal-body">
            <input type="text" value="" class="form-control id"  disabled="true" />
      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button></div>

                  </div>
              </div>
          </div>

                              <!------>
<?php
 //// resedint 
            $new_querys2= sqlsrv_query( $con ,"SELECT distinct manager_name
from [Employess_DB].[dbo].[tbl_Personal_info]
where sub_Group=2 and Employee_Status='active' and grade='l8' and unit=12 and Note is NULL");
            while ($resedint_new = sqlsrv_fetch_array($new_querys2)){
            $resedint_user = $resedint_new['manager_name'];
echo  $resedint_user;
}
            ?>


 <?php 
          //if($role_id >=1){
    $new_querys= sqlsrv_query( $con ,"exec view_add_edit_sch_username 
     @username =  '$s_username'");
              $out_new = sqlsrv_fetch_array($new_querys);
            echo $my_username = $out_new['username'];
    //// resedint 
            $new_querys2= sqlsrv_query( $con ,"SELECT distinct manager_name
from [Employess_DB].[dbo].[tbl_Personal_info]
where sub_Group=2 and Employee_Status='active' and grade='l8' and unit=12 and Note is NULL and manager_name ='$s_username'");
            $resedint_new = sqlsrv_fetch_array($new_querys2);
            echo $resedint_user = $resedint_new['manager_name'];
   
           if(($my_username) || ($resedint_user) ){

         // if($role_id <> 0){
            // if($my_username){
          ?>
          <li><a href="edit_team_schedule.php">Add & Edit Schedule
            <i class="fa fa-calendar"></i>
          </a></li>
          <?php
        
      }
        ?>

<div style="padding:20px;">
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


if($_SESSION['role_id'] == 2) {
  
//senior
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE manager_id = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['username_id'];

$check_orders = sqlsrv_query( $con ,"SELECT *
  FROM [Aya_Web_APP].[dbo].[Leaves_counter] WHERE id = '$engineers_id' ");
 while( $output_query = sqlsrv_fetch_array($check_orders)){  
$rows  = '<tr>';
$rows .= '<td class="hovers"><center>'.$output_query["id"].'</center></td>';
$rows .= '<td class="hovers"><center>'.$output_query["username"].'</center></td>';

$rows .= '<td class="hovers"><center>
<button  class="btn btn-primary btn-circle btn-xl"
type="button" data-toggle="modal" data-target="#mediumModal" data-type="'.$output_query["Annual Leave"].'" data-id="'.$output_query["id"].'" href="?Annual Leave='.$output_query["id"].'&engineer_id='.$engineer_id.'" value="Annual Leave">'.$output_query["Annual Leave"].'</button></center></td>';

$rows .= '<td class="hovers"><center>
<button class="btn btn-dark btn-circle ">'.$output_query["Official Mission"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button  class="btn btn-info btn-circle">'.$output_query["Permission"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button  class="btn btn-warning btn-circle ">'.$output_query["Sick Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button  class="btn btn-success btn-circle ">'.$output_query["Unpaid Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-danger btn-circle ">'.$output_query["Maternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-dark btn-circle ">'.$output_query["Compassionate Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-info btn-circle ">'.$output_query["Pilgrimage Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-success btn-circle ">'.$output_query["Paternity Leave"].'</button></center></td>';
$rows .= '<td class="hovers"><center>
<button class="btn btn-warning btn-circle ">'.$output_query["Maternity on duty leave"].'</button></center></td>';

$rows .='</tr>';
echo $rows; }

}}

?>
       </tbody>
      </table>
    </div>
  </div> 
</center>
 <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script>      
  $(document).ready(function(){
 //$('.mediumModal').click(function(){ 

  $('#mediumModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var modal =  $(this);
      var type = button.data('type');
      //var id = elem.data('id');
      //console.log('opened');
    // AJAX request 
   $.ajax({
    url: 'ajax_countLeaves.php',
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
</div>

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
  <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>

  <?php

 include ("footer.html");
 ?>

