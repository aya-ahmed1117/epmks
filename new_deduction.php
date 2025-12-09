
<?php
include ("pages.php");
$first_query = sqlsrv_query( $con ,"SELECT * FROM deduction
  where username ='$s_username' and a_date >= '2021-05-05' and ([status] = 'senior reject' or [status] ='' or [status] = 'E-workforce reject'  or [status] is null)order by 5");

$output_query = sqlsrv_fetch_array($first_query);
  $idd = $output_query['id'];
if(isset($_POST['id'])){$id = $_POST['id'];}  

?>
  <title>Deduction </title>
  <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css"href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/my_table.css">
    </head>
    <user-bio>
    <h3>Richard</h3>
    <img src="img/richard_profile.jpg" alt="Richard's profile picture">
    <p>Before working at Udacity, Richard...
</user-bio>

<div> 
    <h3>Richard</h3>
    <img src="img/richard_profile.jpg" alt="Richard's profile picture">
    <p>Before working at Udacity, Richard...
</div>
 <center>
  
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Create deduction</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Create Deduction : here you can create a complain on your deduction to remove it after runing the payroll or refund it if it exceed 14th of the month</p>
  </aside>
</div>
</center>
<br>

<center>
 <div class="limiter">
    <div class="container-table100">
      <div class="tableFixHead col-8">

<table cellspacing="0"id="tblCustomers" style="border-radius:30px 30px 30px 30px;background-color: #fff;" >
  <thead  style="color: white; font-weight: bold; text-align: center;font-size: 15px; ">
    <tr>
    <th style=" background-color: #55608f;color: white;"><center>ID Num </center></th>
    <th style=" background-color: #55608f;color: white;" ><center>Username</center></th>
    <th style=" background-color: #55608f;color: white;" ><center>Date</center></th>
    <th style=" background-color: #55608f;color: white;" ><center>Item</center></th>
    <th style=" background-color: #55608f;color: white;" ><center>Time</center></th>
    <th style=" background-color: #55608f;color: white;width: 10%;"><center>WFM Note</center></th>
    <th style=" background-color: #55608f;color: white;width: 10%;"><center>Complain</center></th>
          
    </tr>
    </thead>

<tbody id="logBoard">

  <?php 
  //if(($_SESSION['username'] == 'abdelrahman.a70539') || ($_SESSION['username'] == 'ola.m70679') ){sohila.h80054
  //Nourhan.s155206 

$engineer_id = $_SESSION['id'];
  //if(($_SESSION['id'] == 3047) || ($_SESSION['username'] == 'farouk.s113373')){
  if($_SESSION['username'] == 'x_test'){
$s_username = $_SESSION['username'];
$first_query = sqlsrv_query($con ,"SELECT * FROM deduction
  where username ='$s_username'and a_date >= '2021-01-27' and ([status] = 'senior reject' or [status] =' ' or [status] = 'E-workforce reject' or [status] is null )
  and [stat_added]='Added' and id <> 9954 order by 5");
    while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ="<tr data-rowid='{$output_query['id']}'>";
$rows .='<td class="hovers">'.$output_query["id"].'</td>';
$rows .='<td class="hovers">'.$output_query["username"].'</td>';
$rows .='<td class="hovers" >'.$output_query["a_date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers">'.$output_query["item"].'</td>';
$rows .='<td class="hovers">'.$output_query["a_time"]->format('H:i:s').'</td>';
$rows .='<td class="hovers">'.$output_query["wfm_note"].'</td>';
$rows .='<td class="hovers">
  <button type="button" class="btn btn-info btn-xs view_data" data-toggle="modal" data-target="#mediumModal" 
  data-type="'.$output_query["id"].'" data-id="'.$output_query["id"].'">Complain</button></td>';
$rows .='</tr>';
 echo$rows;
}
}

?>

   
    <?php
$today = date('Y-m-d');
$yesterday = date( "Y-m-d", strtotime( "-7 days" ) );
$engineer_id = $_SESSION['id'];
    $s_username = $_SESSION['username'];  
  $first_query = sqlsrv_query( $con ,"SELECT * FROM deduction
  where username = '$s_username' and ([status] = 'senior reject' or [status] =' ' or [status] = 'E-workforce reject' or [status] is null ) and a_date >= DATEADD(day,-14,getdate()) and id <> 9954 order by 5");
while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ="<tr data-rowid='{$output_query['id']}'>";
$rows .='<td class="hovers">'.$output_query["id"].'</td>';
$rows .='<td class="hovers">'.$output_query["username"].'</td>';
$rows .='<td class="hovers" >'.$output_query["a_date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers">'.$output_query["item"].'</td>';
$rows .='<td class="hovers">'.$output_query["a_time"]->format('H:i:s').'</td>';
$rows .='<td class="hovers">'.$output_query["wfm_note"].'</td>';
  if ($today >= $yesterday){
    $rows .='<td class="hovers">
  <button type="button" class="btn btn-info btn-xs view_data" data-toggle="modal" data-target="#mediumModal" 
  data-type="'.$output_query["id"].'" data-id="'.$output_query["id"].'">Complain</button></td>';}
  if( $today < $yesterday){

$rows .='<td class="hovers">
  <button type="button" style="color:red;" disabled>exceed</button></td>';
}
$rows .='</tr>';
 echo$rows;
}

?>
</tbody>
</table>
</div>
</div>
</div>
</center>
<!--- start modal----->
 <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel">COMPLAIN </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
                        </div>
    <div class="modal-body" id="employee_detail">
  
 <input type="text" value="" class="form-control id"  disabled="true" />
<br>

<div  class="input-group md-2" id="inputGroupSelect01div">
  <span class="input-group-text" id="basic-addon1">Choose</span>
  <select id="inputGroupSelect01" class="form-control sType" name="type" required="true">

  <!--select class="form-control sType" required="true"-->
  <option value="0" disabled selected >Select your reason...</option>
  <option value="Refund Request">Refund Request</option>
  <option value="PC problem">PC problem</option>
  <option value="Leave/Permission(pending creation)">Leave/Permission(pending creation)</option>
  <option value="Schedule modification">Schedule modification</option>
  </select>
</div>
 <br>
     <label required="true">Notes</label>
        <textarea class="form-control note" ></textarea>
        <br>
            <div class="modal-footer">
                <button class="btn btn-primary submit">Submit</button>
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
              
                </div>
                  </div>
                </div>
            </div>
        </div>

 <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script>
$(document).ready(function(){

  $('#mediumModal').on('show.bs.modal', function (event) {
      var elem = $(event.relatedTarget);
      var modal = $(this);
      var id = elem.data('id');
      var sType = $('.sType').val();
      $('.id').val(id);
      $('.note').val("");     
      $('.sType').val("");


  $('.submit').click(function(){
      var id    = $('.id').val();
      var note  = $('.note').val();
      var sType = $('.sType').val();

   $.ajax({
    url: 'ajax_deduction2.php',
    type: 'POST',
    data:'type='+sType+'&id='+id+'&note='+note,  
    cache: false,
    success: function(data){ 
      // Add response in Modal body 
      //modal.find('.modal-body').Append(data);
      swal({ title: "Done ... :)", icon: "success",});

      //$("tr").find("[data-rowid='" + id + "']")
      $("tr[data-rowid='" + id +"']").fadeOut();
      //modal.modal('toggle');
      modal.find('.close').click();
    }, error: function(err){
      swal({ title: "Error", icon: "warning",});

          console.log(err);
        }
  });
return false;
  });
 });

});

  </script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<script src="jQuery/bootstrap.min.js"></script> 
<script src="jQuery/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="jQuery/jquery-2.2.4.js"></script>
<script src="jQuery/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="jQuery/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


  <?php
 include ("footer.html");
 ?>

