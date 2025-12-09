
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
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
   width: 478px;

    background-color: #fff;
    text-align: center;
    border-radius: 5px;
    position: static;
 
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


.swal-overlay--show-modal .swal-modal {
    opacity: 1;
    pointer-events: auto;
    box-sizing: border-box;
    -webkit-animation: showSweetAlert .3s;
    animation: showSweetAlert .3s;
    will-change: transform;
}

.swal-modal {
    width: 478px;
    opacity: 0;
    pointer-events: none;
    background-color: #fff;
    text-align: center;
    border-radius: 5px;
    position: static;
    margin: 20px auto;
    display: inline-block;
    vertical-align: middle;
    -webkit-transform: scale(1);
    transform: scale(1);
    -webkit-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    z-index: 10001;
    transition: opacity .2s,-webkit-transform .3s;
    transition: transform .3s,opacity .2s;
    transition: transform .3s,opacity .2s,-webkit-transform .3s;
}
.img-hover-zoom {
  height: 300px;
  overflow: hidden; 

}

.img-hover-zoom img {
	position: absolute;
  animation: mymove 5s ;

  transition: transform 1s ease;
  transform: scale(2.5);
  zoom: 150%;
   
}

@keyframes mymove {
  50% {transform: scale(2.5);
  zoom: 150%;}
  
}
</style>
</head>


<!--div class="swal-overlay swal-overlay--show-modal" tabindex="-1">
  <div class="swal-modal" role="dialog" aria-modal="true"><div class="swal-icon swal-icon--success">
    <span class="swal-icon--success__line swal-icon--success__line--long"></span>
    <span class="swal-icon--success__line swal-icon--success__line--tip"></span>

    <div class="swal-icon--success__ring"></div>
    <div class="swal-icon--success__hide-corners"></div>
  </div><div class="swal-title" style="">Welcome ...:)</div><div class="swal-footer"><div class="swal-button-container">

    <button class="swal-button swal-button--confirm">OK</button>

    <div class="swal-button__loader">
      <div></div>
      <div></div>
      <div></div>
    </div>

  </div></div></div></div-->

<body>

<h2>Modal Example</h2>


<?php
//include ("pages.php");
require_once("inc/config.inc");
$engineer_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
date_default_timezone_set('Africa/Cairo');
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);

      $check_engineers = sqlsrv_query( $con1 ,"SELECT distinct [ID],[Gender]
      FROM [Employess_DB].[dbo].[tbl_Personal_info]
      where UserName ='$s_username'");
      $output_query = sqlsrv_fetch_array($check_engineers);
      $Gender = $output_query['Gender'];

?>
<center>
  
<!-- Trigger/Open The Modal >
<button id="myBtn" value="in">Open Modal</button>

<- The Modal ->
<div id="myModal" class="modal">

  <! Modal content ->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>
  </div>

</div-->
  <div class="row form-group"> 
<div class="col-md-6 content">
<button id="myBtn" class="btn btn--doar in" value="in">In</button>

<!-- The Modal -->

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>

    <p>Welcome ...:)</p>
    <img src="images/success3.gif" style="width:80px;">
  </div>

</div>
</div>


<br>
<div class="col-md-6 content">
  <center>
<button class="btn btn--doar" id="out"  value="out">Out</button>
<div id="myOut" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close closeOut">&times;</span>
    <div class="img-hover-zoom">
    	<img src="images/success1.gif" style="width:80px;">
</div>
    <p>Good bye</p>
  </div>

</div>
</div>
</center>
</div>


</section>
</div>
</center>
<br>

<center>
  <div class="col-sm-6" id="logBoard">
  <div class="tableFixHead" >

 <table style="border-radius: 30px 30px 0 0; background-color: white;">
  
    <thead>
          <th style="color:#fff;">Type</th>
          <th style="color:#fff;"> Day</th>
          <th style="color:#fff;">Time </th> 
</thead>
</table>
<table style="border-radius:  0 0 30px 30px;" >
<tbody>
<?php      

$engineer_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
$first_query = sqlsrv_query( $con ,"SELECT top 20 * FROM in_and_out WHERE  [engineer_id] = '$engineer_id' or username ='$s_username'  order by 4 DESC ,5 desc ");
  while( $output_query2 = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td>'.$output_query2["type"].'</td>';
$rows .='<td>'.$output_query2["cur_date"]->format('Y-m-d').'</td>';
$rows .='<td>'.$output_query2["atime"]->format('H:i:s').'</td>';
$rows .='</tr>';

echo $rows;
}
?>

</tbody>
</table>
</div>
</div>
</center>
<script>
//in
var modal = document.getElementById("myModal");
//out
var myOut = document.getElementById("myOut");


// in
var btn = document.getElementById("myBtn");
// out 
var out = document.getElementById("out");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var close = document.getElementsByClassName("closeOut")[0];

//confirm

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
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
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script type="text/javascript">

$(document).ready(function(){
//in
$(".btn btn--doar in").click(function(){
  var atype = $(this).val();
  var dataString = 'type='+atype;
  //if(atype == 'in'){
    $.ajax({
    type:"post", 
    url:"ajax_load.php",
    data: dataString,
    cache: false,
     beforeSend: function(){ 
        //$('.logBoard').html("loading");
      },
        success: function(data){
          $('#logBoard').html(data);
          //$('.alert alert-success').html(data);

        },
        error: function(err){
          console.log(err);
        }
    });
        });

//out
  $(".btn--doar").click(function(){
  var btype = $(this).val();
  var dataString2 = 'type='+btype;

    $.ajax({
    type: "post", 
    url: "ajax_load2.php",
    data: dataString2,
    cache: false,
        beforeSend: function(){ 
        //$('.logBoard').html("loading");
      },
        success: function(data){
          $('#logBoard').html(data);
          //swal("Good by");
        },
        error: function(err){
          console.log(err);
        }
    });
        return false;

  });

});
</script>

</body>
</html>
