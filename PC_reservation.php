
<?php
  include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
?>
    <title>Reserve PC</title>
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/my_table.css">
</head>
<dody>
<style> 
tr:nth-child(even) {
  background-color: lightgray;
}
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
.emp-profile {
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
    width: 55%;
}
.lon{
    color: #003399;
    font-weight: bold;
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
              <h2 class="text-dark display-12" >Choose PC</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Here you can choose PC</p>
  </aside>
</div>
</center>
<br>

<!-- <section class="border p-6 d-flex justify-content-center mb-6"> -->
<div class="container emp-profile">
<!-- <form method="post"> -->

<div class="input-group md-3">
  <span class="input-group-text" id="basic-addon1">Select Date</span>
  <input type="date" class="form-control date_shift" name="date_shift" id="date_shift"required
    value='<?php if(isset($_POST['date_shift'])) echo $_POST['date_shift']; ?>'
    aria-describedby="basic-addon1"/>
</div>


<br>
<!-- 
<div  class="input-group md-3" id="inputGroupSelect01div">
  <span class="input-group-text" id="basic-addon1">Choose PC</span>
  <select class="form-control pc_ip" name="pc_ip" id="inputGroupSelect01"required="true">
    <option value="">Choose...</option> -->
    <?php
    //include('ajax_PC_reservation.php');
 //  $DBhost = "172.29.29.76";
 //  $DBuser = "Seniors";
 //  $DBpass = "123456789";
 //  $DBname = "Employess_DB";
  
 //  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
 //  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
 //      if(isset($_POST['date_shift'])){$date_shift = $_POST['date_shift'];}
 //      if(isset($_POST['pc_ip'])){$pc_ip = $_POST['pc_ip'];}


 //     if(isset($_POST['date_shift'])){$date_shift = $_POST['date_shift'];}
 // $check_pc_ip = sqlsrv_query( $con1 ,"SELECT *
 //  FROM [Employess_DB].[dbo].[pop_reserve]");
 //  $output_query = sqlsrv_fetch_array($check_pc_ip);
  ?>

<!--   </select>

</div> -->
<br>
<center>
<!-- <input type="submit" class="btn btn-primary submit" onclick="compare()" name="send" value="Reserve"style="width:50%;" /> 
<input type="submit" name="send" value="Reserve"
data-pc_ip="'.$output_query["pc_ip"].'"
 data-number="'.$output_query["Number"].'"
 data-unit="'.$output_query["Unit"].'"
  data-group_name="'.$output_query["Group_Name"].'"
  data-shift_start="'.$output_query["shift_start"].'"
  data-date_shift="'.$output_query["date_shift"]->format('Y-m-d H:i:s').'"
  data-username="'.$output_query["Username"].'"
   class="btn btn-info btn-xs view_data" />-->

<div style="float:right;"><?php

 echo '
   <input type="submit" name="send" value="Reserve"

   class="btn btn-info btn-xs view_data" />';
   ?>
</div>


</center>
   <br>
   <?php 
       include ("ajax_PC_reservation.php");

       // echo$pc_ip_ajax = $row["pc_ip"];
       // echo$Unit_ajax = $row["Unit"];
       // echo$Group_Name_ajax = $row["Group_Name"];
       // echo$shift_start_ajax = $row["shift_start"];
       // echo$date_shift_ajax = $row["date_shift"];
       // echo$Username_ajax = $row["Username"];

   ?>
   <div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal" id="message21" >
      <div id="myOut" class="modal-content" >
        <h5 class="modal-title" >Update my data</h5>
         <div ><button class="close2 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" data-dismiss="modal">×</span>
           </button></div>
     <input type="text" class="form-control date_shift" name="date_shift"  disabled="true" />
     <input type="text" class="form-control Number" name="Number"  disabled="true" />
     <br>
     <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Unit</label>
         <input  class="form-control unit" name="Unit" type="text" disabled="true"/>  <?php echo $Unit_ajax;?>
     </div>

     <br>
     <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Group_Name</label>
         <input  class="form-control group_name" name="Group_Name"  disabled="true" type="text" placeholder="<?php echo $Group_Name_ajax;?>"/><?php echo $Group_Name_ajax;?>

     </div>

      <br>
      <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Shift Start</label>
         <input  class="form-control shift_start" name="shift_start" disabled="true"  type="text" placeholder=""/><?php echo $shift_start_ajax;?>

     </div>      <br>
     <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Username</label>
         <input  class="form-control username" name="Username" disabled="true"  type="text" placeholder="Update your avaya login" value="<?php echo $Username_ajax;?>" />

     </div>
<br>
     <div  class="input-group md-3">
  <span class="input-group-text" id="basic-addon1">Choose PC</span>
  <select class="form-control pc_ip" name="pc_ip" id="inputGroupSelect01"required="true">
    <option value="">Choose...</option>
    <?php 

     if(isset($_POST['date_shift'])){$date_shift = $_POST['date_shift'];}
     $date_shift = $_POST['date_shift'];
     $get_pc_ip = sqlsrv_query( $con1,"SELECT pc_ip
  FROM [Employess_DB].[dbo].[pop_info]
  where [staus]='working' and [pc_ip] not in (SELECT pc_ip from [Employess_DB].[dbo].[pop_reserve]
  where date_shift= '$date_shift_ajax' )");
    while($output =sqlsrv_fetch_array($get_pc_ip)){
  $rows  = '<option ';
  $rows .= $output['pc_ip'] == $output['pc_ip'] ? "selected" : "";;
  $rows .= 'value="'.$output['pc_ip'].'">'.$output['pc_ip'].'</option>';
  echo $rows;
}

/*SELECT groups,Units
from [Employess_DB].[dbo].[tbl_Personal_info] p
left join [Employess_DB].[dbo].[Tbl_Groups] on Group_ID=[group]
left join [Employess_DB].[dbo].[Tbl_Units] on [Units_ID]=Unit
where p.[UserName]='$s_username' 

select [shift_start]
from [Aya_Web_APP].[dbo].[schedule_table]
where username='$s_username' and schedule_date='$date_shift'
*/
    ?>

</select>
</div>

    <br>
        <br>
          <div class="modal-footer">
          </label>
          <button class="btn btn-primary submit">Submit</button>
             <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
            </div>
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
           //var date_shift = $(this).val(); 
           var date_shift = $('.date_shift').val();
           var number = $('.number').val(); 
           var pc_ip = $('.pc_ip').val(); 
           var unit = $('.unit').val();
           var group_Name = $('.group_name').val();
           var shift_start = $('.shift_start').val();
           var Username = $('.username').val();
           // var ID = $(this).data("number"); 
           // var pc_ip = $(this).data("pc_ip"); 
           // var unit = $(this).data("unit");
           // var group_Name = $(this).data("group_name"); 
           // var shift_start = $(this).data("shift_start"); 
           // var Username = $(this).data("username"); 

      $('.Number').val(number);
      $('.pc_ip').val(pc_ip);     
      $('.unit').val(unit);
      $('.group_name').val(group_Name);
      $('.shift_start').val(shift_start);
      $('.date_shift').val(date_shift);
      $('.username').val(Username);

        var dataString ='Number='+number+'&pc_ip='+pc_ip+'&Unit='+unit
  +'&Group_Name='+group_Name+'&shift_start='+shift_start+'&date_shift='+date_shift+'&Username='+Username

              $.ajax({  
              url:'ajax_PC_reservation.php',
              Type:'POST', 
              data:dataString,
              cache: false,  
               success:function(data){  
               console.log(dataString);                  
                    document.getElementById('message21').style.display = 'block';
               }  
                });  
     
 });
return false;
   });
  

  //   date_shift 
  // $('.submit').on('click',function(){
//         var pc_ip = $('.pc_ip').val(); 
//         var unit = $('.unit').val();
//         var group_Name = $('.group_name').val();
//         var shift_start = $('.shift_start').val();
//         var username = $('.username').val();
//         var date_shift = $('.date_shift').val();
//         var number = $('.number').val(); 
// var all_data = 'date_shift='+date_shift+'&Number='+ID+'&pc_ip='+pc_ip+'&Unit='+unit+'&Username='+username+'&shift_start='+shift_start+'&Group_Name='+group_Name
//         // if(!empty(Mobile_Number) || (Mobile_2) ){  
//                 $.ajax({   
//                     url: 'ajax_PC_reservation.php',
//                     type: 'POST',
//                     data: 'date_shift='+date_shift+'&Number='+ID+'&pc_ip='+pc_ip+'&Unit='+unit+'&Username='+username+'&shift_start='+shift_start+'&Group_Name='+group_Name,
//                     cache: false,  
//                  success:function(data){ 
//        //$('#logBoard').html(data); 
//        $('#message21').modal(data);

//       //  setTimeout(function(){// wait for 5 secs(2)
//       //      window.location.href=window.location.href // then reload the page.(3)
//       // }, 1900); 
//                      }
//                 });  
                 
      

 //});
 </script> 
  


<!-- </form> -->
</div>
</dody>

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
