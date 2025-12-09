<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<?php 
include ("pages.php");
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/my_table.css">
<body>

<style type="text/css">



/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 10; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /*Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */



}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: 20px auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
 position: static;
 z-index: 10; 
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.swal-footer {
    text-align: right;
    padding-top: 13px;
    margin-top: 13px;
    padding: 13px 16px;
    border-radius: inherit;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.swal-button {
    background-color: #7cd1f9;
    color: #fff;
    border: none;
    box-shadow: none;
    border-radius: 5px;
    font-weight: 600;
    font-size: 14px;
    padding: 10px 24px;
    margin: 0;
    cursor: pointer;
}
.swal-button:hover{
  background-color: orange;

}


 </style>

 <div class="row form-group"> 

<div class="col-md-6">
    <button class="btn btn--doar in" id="inBtn"  value="in">IN</button>

    <div id="myIN" class="modal">
  <div class="modal-content"  >
    <div style="float:right;"><span class="close" >&times;</span></div>
    <div align="center" style="padding:0;">
      <img src="images/sucess-discord-unscreen.gif" style="width:25%;"></div>
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
        <br>    <div class="swal-footer">
      <button class="swal-button  closed" >OK</button>
  </div>

    </div>
  </div>
</div>



<center>
 <div class="limiter">
    <div class="container-table100">
      <div class="tableFixHead col-8">

<table cellspacing="0"id="tblCustomers" style="border-radius:30px 30px 30px 30px;background-color: #fff;">
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
$rows .='<td class="hovers">'.$output_query["a_date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers">'.$output_query["item"].'</td>';
$rows .='<td class="hovers">'.$output_query["a_time"]->format('H:i:s').'</td>';
$rows .='<td class="hovers">'.$output_query["wfm_note"].'</td>';
// $rows .='<td class="hovers">
//   <button class="btn btn--doar myMod" id="outBtn"  value="'.$output_query["id"].'"
// data-type="'.$output_query["id"].'" data-id2="'.$output_query["id"].' data-id2="'.$output_query["id"].'">Out</button></td>';

$rows .='<td><button type="button"  id="outBtn"  class="btn btn-primary myMod" style="width: 40%;" 
value="'.$output_query["id"].'"
data-type="'.$output_query["id"].'" data-id2="'.$output_query["id"].' data-id2="'.$output_query["id"].'">Update</button></td>';

//   if ($today >= $yesterday){
// $rows .='<td class="hovers">
//   <button type="button" class="btn btn-info btn-xs view_data" data-toggle="modal" data-target="#outBtn" 
//   data-type="'.$output_query["id"].'" data-id="'.$output_query["id"].'">Complain</button></td>';}
//   if( $today < $yesterday){

// $rows .='<td class="hovers">
//   <button type="button" style="color:red;" disabled>exceed</button></td>';
// }
$rows .='</tr>';
 echo$rows;
}

?>
</tbody>
</table>
</div>
</div>
</div>
<div class="col-md-6">
<!--    <button class="btn btn--doar" id="outBtn"  value="out">Out</button>
 -->
   <div id="myOut" class="modal">
  <div class="modal-content">
    <div style="float:right;"><span class="close closeOut">&times;</span></div>
      <div align="center">
        <input type="text" value="<?php echo $output_query["id"];?>" class="form-control id"  disabled="true" />
         <input type="text" name="R_id" style="display: none;" value="<?php if(isset($_GET["id2"])){echo $_GET["id2"] ;}?>">Deduction id num :<?php echo $_GET["id2"] ; ?>
</div>
<br>

<div  class="input-group md-2" id="inputGroupSelect01div">
  <span class="input-group-text" id="basic-addon1">Choose</span>
  <select id="inputGroupSelect01" class="form-control sType" name="type" required="true">
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
      <div class="swal-footer">

      <button class="swal-button  closed2" >OK</button>

    </div>

      </div>
    </div>
  </div>
</center>
<script>
//in
var myIN = document.getElementById("myIN");
//out
var myOut = document.getElementById("myOut");
// in
var btn = document.getElementById("inBtn");
// out 
var out = document.getElementById("outBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var close = document.getElementsByClassName("closeOut")[0];
var closeddd = document.getElementsByClassName("closed")[0];

var closeddd2 = document.getElementsByClassName("closed2")[0];
//confirm

// When the user clicks the button, open the modal 
btn.onclick = function() {
  myIN.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  myIN.style.display = "none";
}


////////////
// When the user clicks the button, open the modal 
out.onclick = function() {
  myOut.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
close.onclick = function() {
  myOut.style.display = "none";
}

//closeddd2
closeddd2.onclick = function() {
  myOut.style.display = "none";
}

// When the user clicks on <span> (x), close the modal
closeddd.onclick = function() {
  myIN.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

////outtt
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == myOut) {
    myOut.style.display = "none";
  }
}
</script>

<script
  src="js/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

  <script>
$(document).ready(function(){
  $('.myMod').click('.id',function(){
      var id2   =$(this).val();
      var sType =$('.sType').val();
      var note  =$('.note').val();
      console.log(id2);


//   $('.submit').click(function(){
//       var id = $('.id').val();
//       var note = $('.note').val();
//       var sType = $('.sType').val();

//    $.ajax({
//     url: 'ajax_deduction2.php',
//     type: 'POST',
//     data:'type='+sType+'&id='+id+'&note='+note,  
//     cache: false,
//     success: function(data){ 
//       // Add response in Modal body 
//       //modal.find('.modal-body').Append(data);
//       swal({ title: "Done ... :)", icon: "success",});

//       //$("tr").find("[data-rowid='" + id + "']")
//       $("tr[data-rowid='" + id +"']").fadeOut();
//       //modal.modal('toggle');
//       modal.find('.close').click();
//     }, error: function(err){
//       swal({ title: "Error", icon: "warning",});

//           console.log(err);
//         }
//   });
// return false;
//   });
 });

});

    </script>
      <script>
// $(document).ready(function(){

//   $('#myOut').click(function () {
//       //var elem = $(event.relatedTarget);
//       //var modal = $(this);
//       //var id = elem.data('id');
//       var id = $('.id').val();
//       var pro_id = $(this).data('id');
//       var sType = $('.sType').val();
//       $('.id').val(id);
//       $('.note').val("");     
//       $('.sType').val("");
//       console.log(id);

//   $('.submit').click(function(){
//       var id = $('.id').val();
//       var note = $('.note').val();
//       var sType = $('.sType').val();

//    $.ajax({
//     url: 'ajax_deduction2.php',
//     type: 'POST',
//     data:'type='+sType+'&id='+id+'&note='+note,  
//     cache: false,
//     success: function(data){ 
//       // Add response in Modal body 
//       //modal.find('.modal-body').Append(data);
//       swal({ title: "Done ... :)", icon: "success",});

//       //$("tr").find("[data-rowid='" + id + "']")
//       $("tr[data-rowid='" + id +"']").fadeOut();
//       //modal.modal('toggle');
//       modal.find('.close').click();
//     }, error: function(err){
//       swal({ title: "Error", icon: "warning",});

//           console.log(err);
//         }
//   });
// return false;
//   });
//  });

// });

  </script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap2.min.js"></script>
            
</body>
</html>