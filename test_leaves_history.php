
<?php

 include ("pages.php");
 ?>
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
 <div class="content body">

<?php

    $CurrentYear = date("Y");
// leaves  
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countLeaves FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING' or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] = 'Annual Leave'");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countLeaves = $output_query["countLeaves"];


// permission 

 // permission 
 $check_permission = sqlsrv_query( $con ,"SELECT [id],[engineer_id]
      ,[username]
      ,[adate],[type] ,[count]
      ,[status],[starttime],[endtime]      
  FROM [Aya_Web_APP].[dbo].[leaves]
  where username='$s_username' ");
 $output_Permiss = sqlsrv_fetch_array($check_permission);
$types = $output_Permiss['type'];

 $engineers_id = $output_engineers['username_id'];
$check_orders = sqlsrv_query( $con ,"SELECT sum([count]) as Permissions FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') and [type]='Permission'and username = '$s_username' 
and (( [adate] between dateadd(day,15,EOMONTH(GETDATE(),-2)) and dateadd(day,14,EOMONTH(GETDATE(),-1)) and day(getdate())<=14) or([adate] between dateadd(day,15,Eomonth(getdate(),-1)) and dateadd(day,14,Eomonth(getdate(),0)) and day(getdate())>14 ))
group by username
order by username");
$output_query = sqlsrv_fetch_array($check_orders);
 $permission = $output_query["Permissions"];
 //$type = $output_query['type'];
  //$ $permission - 4///////////////////////////////

if($types == 'Permission'){
    $check = sqlsrv_query( $con ,"SELECT * FROM leaves where username = '$s_username' and [type] = 'Permission' ");
 
   while ($get_out = sqlsrv_fetch_array($check)){

   $adate = $get_out['adate']->format('Y-m-d');
   $bdate = $get_out['bdate']->format('Y-m-d');


  $CurrentYear = date("Y",strtotime($adate));
  $CurrentMonth = date("m",strtotime($adate));
  $NextYear = date("Y", strtotime('+1 month',strtotime($adate)));
  $NextMonth = date("m", strtotime('+1 month',strtotime($adate)));

if (date("d",strtotime($adate)) < 14 ) {
  $CurrentYear = date("Y",strtotime('-1 month',strtotime($adate)));
  $CurrentMonth = date("m",strtotime('-1 month',strtotime($adate)));

  $NextYear = date("Y", strtotime($adate));
  $NextMonth = date("m", strtotime($adate));
}
else
{
  $CurrentYear = date("Y",strtotime($adate));
  $CurrentMonth = date("m",strtotime($adate));

  $NextYear = date("Y", strtotime('+1 month',strtotime($adate)));
  $NextMonth = date("m", strtotime('+1 month',strtotime($adate)));

}}}
    //$ $permission - 4///////////////////////////////
 //official mission   
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countofficial FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like 'official mission%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countofficial = $output_query["countofficial"];

  //  Sick Leave 
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countSick FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Sick Leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countSick = $output_query["countSick"];

  //Instead of(HR)   
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countInstead FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Instead of(HR)%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countInstead = $output_query["countInstead"];

  // Paternity Leave  
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countPaternity FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Paternity Leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countPaternity = $output_query["countPaternity"];

  //Pilgrimage Leave   
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countPilgrimage FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Pilgrimage Leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countPilgrimage = $output_query["countPilgrimage"];

 
  // Unpaid Leave  
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countUnpaid FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Unpaid Leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countUnpaid = $output_query["countUnpaid"];



 if($countUnpaid > 5) {
  echo "<b><h2 style='color: #cc0000; font-size=10px; border-radius: 4px 4px 5px 5px;box-sizing: border-box; border: 2px solid #cc0000;width:30%;'>Your Operation Couldn't be completed because you exceed the 5 days (Unpaid Leave)</h2></b>";
  }

  //Compassionate Leave   
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countCompa FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Compassionate leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countCompa = $output_query["countCompa"];

   //Maternity Leave   
$check_orders1 = sqlsrv_query( $con ,"SELECT sum([count]) as countMaternity FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING'or status ='super approve') AND username = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) ='$CurrentYear'
 and [type] like '%Maternity Leave%' ");
 $output_query = sqlsrv_fetch_array($check_orders1);
 $countMaternity = $output_query["countMaternity"];
///
        if(isset($_POST['type'])){$types = $_POST['type'];}

?> 


<div class="col-md-6">
   <button class="btn btn--doar" id="outBtn"  value="out">Out</button>

   <div id="myOut" class="modal">
  <div class="modal-content">
    <div style="float:right;"><span class="close closeOut">&times;</span></div>
      <div align="center"><img src="images/waving-hi-unscreen.gif" style="width:80px;"></div>
      <p> Good bye </p>
      <div class="swal-footer">

      <button class="swal-button  closed2" >OK</button>

    </div>

      </div>
    </div>
  </div>

 <!--script ssrc="js/jquery-3.6.0.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script-->
        <script>     
        /*       
  $(document).ready(function(){
 //$('.mediumModal').click(function(){ 

    $('#mediumModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var modal = $(this);
      var type = button.data('type');
      //console.log('opened');
    // AJAX request
   $.ajax({
    url: 'ajaxfile.php',
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
   return false;
 });
});
*/
     </script>
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
<script type="text/javascript">
$(document).ready(function(){
//in
$(".btn btn--doar in").click(function(){
  var atype = $(this).val();
  var dataString = 'type='+atype;
  //if(atype == 'in'){
    $.ajax({
    type:"post", 
    url:".php",
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
    url: ".php",
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