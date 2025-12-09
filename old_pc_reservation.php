
<?php
  include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      $date_shift ="";
      if(isset($_POST['date_shift'])){$date_shift = $_POST['date_shift'];}
$DBhost = "172.29.29.76";
$DBuser = "Seniors";
$DBpass = "123456789";
$DBname = "Employess_DB";

$connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
$con1 = sqlsrv_connect($DBhost, $connectionInfo);


?>
    <title>Reserve PC</title>
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/my_table.css">
</head>
<!-- <div id="google_translate_element"></div><script>
function googleTranslateElementInit() {
new google.translate.TranslateElement({
pageLanguage: 'ar'
}, 'google_translate_element');
}
</script><script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
 -->
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

<div class="container emp-profile">
<!-- <form method="post"> -->

<div class="input-group md-3">
  <span class="input-group-text" id="basic-addon1">Select Date</span>
  <input type="date" class="form-control date_shift"  name="date_shift" id="date_shift"required
  min="<?php $tomorrow = date("Y-m-d", strtotime("0 day"));echo $tomorrow; ?>" 
                     aria-describedby="basic-addon1" data-date_shift="date_shift"
  value='<?php if(isset($_POST['date_shift'])) echo $_POST['date_shift']; ?>'/>
</div>
<br>
<?php 
 
$sql = sqlsrv_query( $con1 ,"SELECT * from [Employess_DB].[dbo].[pop_reserve]");
$output_query = sqlsrv_fetch_array($sql);
     $pc_ip_name = $output_query['pc_ip'];
     $Numberss = $output_query['Number'];
     $Username_pc = $output_query['Username'];
     $Group_Name_s = $output_query['Group_Name'];
     $shift_start_s = $output_query['shift_start'];
     $Unit_s = $output_query['Unit'];
     $date_shift_s = $output_query['date_shift'];
 //}

      if(isset($_POST['pc_ip'])){$pc_ip = $_POST['pc_ip'];}
      if(isset($_POST['Unit'])){$Unit = $_POST['Unit'];}
      if(isset($_POST['Group_Name'])){$Group_Name = $_POST['Group_Name'];}
      if(isset($_POST['shift_start'])){$shift_start = $_POST['shift_start'];}
      if(isset($_POST['date_shift'])){$date_shift = $_POST['date_shift'];}
      if(isset($_POST['Username'])){$uechosername = $_POST['Username'];}
      if(isset($_POST['Number'])){$Number = $_POST['Number'];}
?>
<center>
<div style="float:right;"><?php
       echo '
   <input type="submit" name="send" value="Reserve"
   data-pc_ip="'.$pc_ip_name.'"
 data-Number="'.$Numberss.'"
 data-unit="'.$Unit_s.'"
  data-group_Name="'.$Group_Name_s.'"
  data-shift_start="'.$shift_start_s.'"
  data-username="'.$Username_pc.'"
   class="btn btn-info btn-xs view_data" />';
   ?>
</div>
</center>
   <br>
   <div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal" id="message21" style="overflow-y: 20%;overflow:auto;">
      <div id="myOut" class="modal-content" >
        <h5 class="modal-title" >PC Reservation</h5>
         <div ><button class="close2 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" data-dismiss="modal">×</span>
           </button></div>
     <div id="aya">
             <div class="input-group">
              <div class="inputs-group-addon" > 
              Reserve Number:
              <input id="Number" name="Number" class="Number"  disabled="true"value=" <?php echo $Numberss;?>">
          </div>
          </div>
<br>
     <input type="text" class="form-control date_shift" name="date_shift"  disabled="true" value="<?php echo $date_shift;?>" />
<br>
<input type="text"id="collapsible" class="form-control pc_ip" name="pc_ip"  disabled="true" value=" <?php echo $pc_ip_name; ?>" style="display: none;" />
<br>
     <!-- <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Unit</label>
         <input  class="form-control unit" name="Unit" type="text" disabled="true"
         value=" <?php echo $Unitss;?>"/>  
     </div>
<br>
     <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Group_Name</label>
         <input  class="form-control group_name" name="Group_Name"  disabled="true" type="text" value="<?php echo $Group_Names;?>" />

     </div>
<br>
    <div class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Shift Start</label>
         <input  class="form-control shift_start" name="shift_start" disabled="true"  type="text"/>
     </div>
<br>
     <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Username</label>
         <input  class="form-control username" name="Username" disabled="true"/>
       

     </div> -->
<br>
     <div  class="input-group md-3">
  <span class="input-group-text" id="basic-addon1">Choose PC</span>
  <select class="form-control sType" data-pc_ip="pc_ip" name="pc_ip"required="true" id="pc_ip">
    <option value="">Choose...</option>
    <?php 

     if(isset($_POST['date_shift'])){$date_shift = $_POST['date_shift'];}
     $date_shift = $_POST['date_shift'];
     $get_pc_ip = sqlsrv_query( $con1,"SELECT pc_ip
  FROM [Employess_DB].[dbo].[pop_info]
  where [staus]='working' and [pc_ip] not in (SELECT pc_ip from [Employess_DB].[dbo].[pop_reserve]
  where date_shift= '$date_shift' )");
    while($output =sqlsrv_fetch_array($get_pc_ip)){
  $rows  = '<option ';
  $rows .= $output['pc_ip'] == $output['pc_ip'] ? "selected" : "";;
  $rows .= 'value="'.$output['pc_ip'].'">'.$output['pc_ip'].'</option>';
  echo $rows;
}
?>
</select>
</div>
  
 </div> <!-- aya -->

    <br>
          <div class="modal-footer">
          </label>
          <button class="btn btn-primary submit" id="submit">Submit</button>
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
        var date_shift2 = $(this).data("date_shift"); 
        var date_shift = $('.date_shift').val();
          var number = $('.number').val(); 
           var ID = $(this).data('number'); 
           var pc_ip = $(this).data('pc_ip'); 
           var unit = $(this).data("unit");
           var group_Name = $(this).data("group_name"); 
           var shift_start = $(this).data("shift_start"); 
           var username = $(this).data("username"); 
        $('.date_shift').val(date_shift);   
           
 if(date_shift == ''){
            swal({ title: "*! Please Select Date", icon: "warning",});
        }
        else{
   $.ajax({
    url: 'test_ajax_pc.php',
    type: 'POST',
    data:'date_shift='+date_shift,    
    cache: false,
    success: function(data){ 
      // Add response in Modal body
      //modal.find('.modal-body').html(data);
                     
      document.getElementById('message21').style.display = 'block';
      $('#aya').html(data);
      console.log(date_shift);
    }, error: function(err){
          console.log(err);
        }
      });
}

     });
     $('#submit').on('click',function(){
        var sType = $('.sType').val();
        var date_shift = $('.date_shift').val();
        
var all_data = 'date_shift='+date_shift+'&pc_ip='+sType
    
 if(date_shift == '' || sType == ''){
            swal({ title: "*! Please Select PC", icon: "warning",});
        }  
        else{
                $.ajax({   
                    type: "POST",
            url: "ajax_PC_reservation.php",
            data: all_data,
            cache: false,
            beforeSend:function(data){

    $('#submit').html('Loading...');
    $('#submit').prop('disabled', true);
          },
                success:function(uouo){ 
                console.log(uouo);
                swal({ title: "Done ;)", icon: "success",});
 setTimeout(function(){// wait for 5 secs(2)
           window.location.href=window.location.href // then reload the page.(3)
      }, 1900);
                }
                });
                
                } 
            });  
    });
     </script>

<!-- </form>       //swal({ title: "Done ;)", icon: "success",});

      //  setTimeout(function(){// wait for 5 secs(2)
      //      window.location.href=window.location.href // then reload the page.(3)
      // }, 1900);-->
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
