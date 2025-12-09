

<?php
include ("pages.php");
$this_year = date('Y');
$first_query = sqlsrv_query( $con ,"SELECT * FROM deduction
  where username ='$s_username' and year(a_date) >= '$this_year' and ([status] = 'senior reject' or [status] ='' or [status] = 'E-workforce reject'  or [status] is null)order by 5");

$output_query = sqlsrv_fetch_array($first_query);

$idd = null;

if ($first_query !== false) {
    $output_query = sqlsrv_fetch_array($first_query, SQLSRV_FETCH_ASSOC);
    if ($output_query && isset($output_query['id'])) {
        $idd = $output_query['id'];
    }
}


?>
  <title>Deduction </title>
  <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
<!--     <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
 -->    
    <link rel="stylesheet" href="css/my_table.css">


    </head>
    <body>
      <style type="text/css">
        
.modal-content {
    background-color: #fefefe;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
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
label {
    display: inline-block;
 /*   max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;*/
}

h1, h2, h3, h4, h5, h6 {
    font-family: "Nunito", sans-serif;
}
.h5, h5 {
    font-size: 1.25rem;
}


[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
}

textarea.form-control {
    min-height: calc(1.5em + 0.75rem + 2px);
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
<form  method="post">
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
  //if(($_SESSION['id'] == 3047) || ($_SESSION['username'] == 'Hussein.e.ahmed')){
  if($_SESSION['username'] == 'x_test') {
$s_username = $_SESSION['username'];
$first_query = sqlsrv_query($con ,"SELECT * FROM deduction
  where username ='$s_username'and a_date >= '2025-01-01' 
  and ([status] = 'senior reject' or [status] =' ' or [status] = 'E-workforce reject' or [status] is null )
  and [stat_added]='Added' and id <> 9954 order by 5");
    while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ="<tr data-rowid='{$output_query['id']}'>";
$rows .='<td class="hovers">'.$output_query["id"].'</td>';
$rows .='<td class="hovers">'.$output_query["username"].'</td>';
$rows .='<td class="hovers" >'.$output_query["a_date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers">'.$output_query["item"].'</td>';
$rows .='<td class="hovers">'.$output_query["a_time"]->format('H:i:s').'</td>';
$rows .='<td class="hovers" id="logBoard">'.$output_query["wfm_note"].'</td>';
// $rows .='<td class="hovers">
//   <button type="button" class="btn btn-info btn-xs view_data" data-toggle="modal" data-target="#mediumModal" 
//   data-type="'.$output_query["id"].'" data-id="'.$output_query["id"].'">Complain</button></td>';

   $rows .= '<td><input type="button" name="view" value="Complain" id="'.$output_query["id"].'" class="btn btn-info btn-xs view_data" /></td>';
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
$rows  ="<tr data-rowid='{$output_query['id']}' id='logBoard' >";
$rows .='<td class="hovers">'.$output_query["id"].'</td>';
$rows .='<td class="hovers">'.$output_query["username"].'</td>';
$rows .='<td class="hovers" >'.$output_query["a_date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers">'.$output_query["item"].'</td>';
$rows .='<td class="hovers">'.$output_query["a_time"]->format('H:i:s').'</td>';
$rows .='<td class="hovers">'.$output_query["wfm_note"].'</td>';
  if ($today >= $yesterday){
  //   $rows .='<td class="hovers">
  // <button type="button" class="btn btn-info btn-xs view_data" data-toggle="modal" data-target="#mediumModal"
  // data-type="'.$output_query["id"].'" data-id="'.$output_query["id"].'">Complain</button></td>';

   $rows .= '<td><input type="button" name="view" value="Complain" id="'.$output_query["id"].'" class="btn btn-info btn-xs view_data" /></td>';
       }
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


<div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal" id="message21" >
      <div id="myOut" class="modal-content" >
        <h5 class="modal-title" >Deduction id num</h5>
         <div ><button class="close2" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
           </button></div>
         <input type="text" class="form-control id"  disabled="true" />
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
      <label >Notes</label>
        <textarea class="form-control note" ></textarea>
        <br>
          <div class="modal-footer">
          </label>
          <button class="btn btn-primary submit">Submit</button>
             <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
      $(".close").click(function () {
      document.getElementById("message21").style.display = "none";
          });
    </script>        
 <script>  
     $(document).ready(function(){  
       var modal = $(this);
     $(document).on('click', '.view_data', function(){  
           var id = $(this).attr("id"); 
           var note = $('.note').val(); 
           var sType = $('.sType').val();
      $('.id').val(id);
      $('.note').val("");     
      $('.sType').val("");

        var dataString = 'id='+id+'&note='+note+'&type='+sType;
          $('.id').val(id);
          $('.note').val("");
          $('.sType').val("");

              $.ajax({   
              data:dataString,
              cache: false,  
               success:function(data){   
                console.log(dataString);
                    //$('#message21').modal('show');
                    document.getElementById('message21').style.display = 'block';  
               }  
                });  
     $('.submit').on('click',function(){
      var id = $('.id').val();
      var note = $('.note').val();
      var sType = $('.sType').val();
         if(sType != ' '){  
                $.ajax({   
                    url: 'ajax_deduction2.php',
                    type: 'POST',
                    data:'type='+sType+'&id='+id+'&note='+note, 
                    cache: false,  
                 success:function(data){ 
       $('#logBoard').html(data); 
       $('#message21').modal(data);

       setTimeout(function(){// wait for 5 secs(2)
           window.location.href=window.location.href // then reload the page.(3)
      }, 1900); 
       $("tr[data-rowid='" + id +"']").fadeOut();
                     }
                });  
                  
      return false;
      }          
     }); 
 });

   });
  
 </script> 
</div>

</form>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="js/table2excel.js"></script>
  <?php
 include ("footer.html");
 ?>
</body>

