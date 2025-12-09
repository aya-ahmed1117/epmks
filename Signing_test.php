
<?php

 include ("pages.php");
?>
<title>Signing Machine</title>

  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/dialogbox.css">
  <link href="css/my_table.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">

</head>
 <style type="text/css">

 .a{
  display: block;
  width: 250px;
  height: 50px;
  line-height: 50px;
  font-weight: bold;
  text-decoration: none;
  background: #333;
  text-align: center;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 1px;
  border: 3px solid #333;
  transition: all .35s;
}

.icon{
  width: 50px;
  height: 50px;
  border: 3px solid transparent;
  position: absolute;
  transform: rotate(45deg);
  right: 0;
  top: 0;
  z-index: -1;
  transition: all .35s;
}

.icon svg{
  width: 30px;
  position: absolute;
  top: calc(50% - 15px);
  left: calc(50% - 15px);
  transform: rotate(-45deg);
  fill: #2ecc71;
  transition: all .35s;
}

.a:hover{
  width: 200px;
  border: 3px solid #2ecc71;
  background: transparent;
  color: #2ecc71;
}

.a:hover + .icon{
  border: 3px solid #2ecc71;
  right: -25%;
}

.btn--doar {
 padding-right: 10px;
font-weight: 100;
font-size: 2rem;
text-decoration: none;
text-align: center;
transition: all .5s ease;
margin-left: 0;
margin-right: 0;
color: #fff;
padding-right: 0;
background-color: #ee5c42;
-webkit-clip-path: polygon(0% 0%, 100% 0, 100% 70%, 90% 100%, 0% 100%);
clip-path: polygon(0 0, 100% 0, 100% 50%, 75% 100%, 0 100%);

}
 

.btn--doar:hover { 
  -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
  clip-path: polygon(0 0, 100% 0, 100% 100%, 100% 100%, 0 100%);  
}

.btn--doar:after {
  content: "\f011";
  color: black;
  width: 5%;
  font-family: FontAwesome;
  display: inline-block;
  position: relative;
  right: -220px;
  transition: all 0.2s ease;
}

.btn--doar:hover:after {
  margin: -20px 25px 0 40px;
  right: 0px;
}
.in{
  background-color: #2e8b57;
}
.in:after{
content: "\f118";

  }

.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }



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

/*     .success__line{
  transform: scale(1.5);
  opacity: 1;
  pointer-events: auto;
  box-sizing: border-box;
  -webkit-animation: showSweetAlert .3s;
  animation: showSweetAlert .3s;
  will-change: transform;
}
*/

.tableFixHead {
      table-layout: fixed;
      border-collapse: collapse;
    }
      .tableFixHead tbody {
      display: block;
      overflow: auto;
      height: 350px;
      background-color: white;
    }
    .tableFixHead thead  {
      display: block;
    }
    .tableFixHead th,
    .tableFixHead  td{
      width: 500px;
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
<?php
date_default_timezone_set('Africa/Cairo');
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);

      $check_engineers = sqlsrv_query( $con1 ," SELECT distinct [ID],[Gender]
      FROM [Employess_DB].[dbo].[tbl_Personal_info]
      where UserName ='$s_username'");
      $output_query = sqlsrv_fetch_array($check_engineers);

      $Gender = $output_query['Gender'];

?>

<center>
  
  <div class="col-md-6">
    <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
    border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"style="border-radius: 20px 20px 0 0 ;">
                <div class="media">
                        <?php
                    if($Gender =='Female'){
                    ?>
    <img class="align-self rounded-circle mr-3" 
    style="width:85px; height:85px; float: left;" alt="" src="images/profile-icon-female.png">
    <?php
  }
    ?>
    <?php
      if($Gender =='Male'){
    ?>
    <img class="align-self rounded-circle mr-3" 
    style="width:85px; height:85px;" src="images/admin.png">
    <?php
  }
    ?>
            <div class="media-body">
      <h2 class="text-dark display-12" >Signing Machine <span>
        <img src="images/finger.png"style="width:55px;"></span></h2>

      <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
          </div>
      </div>
  </div>
<br>

  <div class="row form-group"> 

<div class="col-md-6">
    <button class="btn btn--doar in" id="inBtn"  value="in">IN</button>

    <div id="myIN" class="modal">
  <div class="modal-content"  >
    <div style="float:right;"><span class="close" >&times;</span></div>
    <div align="center" style="padding:0;">
      <img src="images/sucess-discord-unscreen.gif" style="width:25%;"></div>
    <p> Welcome ... :)</p>
<div class="swal-footer">

    <button class="swal-button swal-button--confirm closed" id="closed">OK</button>

</div>


        </div>
      </div>
    </div>
    

<div class="col-md-6">
   <button class="btn btn--doar" id="outBtn"  value="out">Out</button>

   <div id="myOut" class="modal">
  <div class="modal-content">
      <div style="float:right;"><span class="close closeOut">&times;</span></div>
      <div align="center"><img src="images/waving-hi-unscreen.gif" style="width:80px;"></div>
      <p> Good bay </p>
    <div class="swal-footer">

      <button class="swal-button swal-button--confirm closed2" >OK</button>

    </div>

      </div>
    </div>
  </div>

<br>
<br>
<br>

</div>
</aside>
</div>

  </center>



<br>
<center>
<div class="col-md-5" id="logBoard" style="padding:20p;">
 <div class="tableFixHead">
<table class="table order-table"  cellspacing="0"  >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>  
          <th style="color:#fff;">Type</th>
          <th style="color:#fff;"> Day</th>
          <th style="color:#fff;">Time </th> 
        </tr>
</thead>

<tbody>
<?php      

$engineer_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
$first_query = sqlsrv_query( $con ,"SELECT top 20 * FROM in_and_out WHERE  [engineer_id] = '$engineer_id' or username ='$s_username'  order by 4 DESC ,5 desc ");
  while( $output_query2 = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output_query2["type"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output_query2["cur_date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output_query2["atime"]->format('H:i:s').'</td>';
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
    url: "ajax_load.php",
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


<?php

 include ("footer.html");
 ?>





