
 <?php
        //require_once("inc/config.inc");
        include ("pages.php");
 
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
         $usernames="";
         $Customer_name="";
      if(isset($_POST['Username'])){$uechosername = $_POST['Username'];}
      if(isset($_POST['Number'])){$Number = $_POST['Number'];}
      if(isset($_POST['date_shift'])){$date_shift = $_POST['date_shift'];}

 ?>
<head>
  <title>Reserve PC</title>

    <script type="text/javascript" src="jQuery/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
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
   <div style="padding: 20px;" >

  <center>
<form  method="post" >
    <div class="col col-md-5">
       <div class="input-group">
  <span class="input-group-text" id="basic-addon1 Customer">Date</span>

  <input type="date" class="form-control date_shift" placeholder="From Date" aria-label="From Date" name="date_shift" id="date_shift"required
    value='<?php if(isset($_POST['date_shift'])) echo $_POST['date_shift']; ?>'
    aria-describedby="basic-addon1"/>


<br>
    <div class="input-group-btn">
      <button class="btn btn-primary view_data" type='submit' name='submit' value="Get data">
    Get data</button></div>
        </div>
    </div>
    <br>
    

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <?php 
   $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
   $con1 = sqlsrv_connect($DBhost, $connectionInfo);
  //   if(isset($_POST['submit'])){
  //       if(empty($_POST["date_shift"])){
  //             //echo 'data is not found';
  //             echo '<script>alert("Please Select Project name to proceed");   </script>';
  //           }
  //         }  
   // if(!empty($_POST["date_shift"])){
   //     $projects_NAMES = $_POST["date_shift"];
   //     foreach($projects_NAMES as $project){
   //     }

   // } 



  ?>

<?php
if(isset($_POST['date_shift']))
  $date_shift=$_POST['date_shift'];
        $gogo = sqlsrv_query( $con1 ,"SELECT * from [Employess_DB].[dbo].[pop_reserve] where date_shift='$date_shift'");
        $index = sqlsrv_fetch_array($gogo);

      echo $pc_ip = $index["pc_ip"];
      echo $Unit = $index["Unit"];
      echo $Group_Name = $index["Group_Name"];
      echo $shift_start = $index["shift_start"];
      echo $date_shift = $index["date_shift"]->format('Y-m-d');
      echo $Username = $index["Username"];

     

?>
 
                 <?php 
              //      }
              // }
                 ?>
  <br>       
     <div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal" id="message21" >
      <div id="myOut" class="modal-content" >
        <h5 class="modal-title" >Update my data</h5>
         <div ><button class="close2 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" data-dismiss="modal">×</span>
           </button></div>
     <input type="text" class="form-control date_shift" name="date_shift"  disabled="true" />
       <input type="text" class="form-control pc_ip" name="pc_ip"  disabled="true" />
     <input type="text" class="form-control number" name="number"  disabled="true" />
     <br>
     <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Unit</label>
         <input  class="form-control unit" name="Unit" type="text" disabled="true"/>  
     </div>

     <br>
     <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Group_Name</label>
         <input  class="form-control group_name" name="Group_Name"  disabled="true" type="text" placeholder=""/>

     </div>

      <br>
      <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Shift Start</label>
         <input  class="form-control shift_start" name="shift_start" disabled="true"  type="text" placeholder=""/>

     </div>

      <br>
     <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Username</label>
         <input  class="form-control username" name="Username" disabled="true"/>

     </div>
<br>
     <!-- <div  class="input-group md-3">
  <span class="input-group-text" id="basic-addon1">Choose PC</span>
  <select class="form-control pc_ip" name="pc_ip"required="true" id="pc_ip">
    <option value="">Choose...</option>
</select>
</div> -->

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

<script type="text/javascript">
     $(document).ready(function(){  
       var modal = $(this);
     $(document).on('click', '.view_data', function(){  
           //var date_shift = $(this).val(); 
           var date_shift = $('.date_shift').val();
        var Units_ID=$(this).val();
           var number = $('.number').val(); 
           var pc_ip = $('.pc_ip').val(); 
           var unit = $('.unit').val();
           var group_Name = $('.group_name').val();
           var shift_start = $('.shift_start').val();
           var username = $('.username').val();
    //var project =$('.project_Summary').val();
 if(date_shift == ''){
            //$('.submit').html("<strong class='text-danger'>*** Please enter all details</strong>");
            swal({ title: "*! Please Select Date", icon: "warning",});
        }
      $('.number').val(number);
      $('.pc_ip').val(pc_ip);     
      $('.unit').val(unit);
      $('.group_name').val(group_Name);
      $('.shift_start').val(shift_start);
      $('.date_shift').val(date_shift);
      $('.username').val(username);
    ///var post_id ='date_shift='+Units_ID//+'&project_Summary='+project;
     var post_id ='Number='+number+'&pc_ip='+pc_ip+'&Unit='+unit
  +'&Group_Name='+group_Name+'&shift_start='+shift_start+'&date_shift='+Units_ID+'&Username='+username

          $.ajax({
            type: "POST",
            url: "test_ajax_pc.php",
            data: post_id,
            cache: false,
            success: function(cities){
             console.log(post_id);
             document.getElementById('message21').style.display = 'block';
           // $("#chkveg").html(cities);
            
               } 
            });
        return false;
     });

    });

</script>

  
<script type="text/javascript" src="jQuery/sweetalert.min.js"></script>
<script src="js/table2excel.js" type="text/javascript"></script>
  

</form>
</center>
</div>
<br>
<br>
<br>
<br>

<?php 
  //include("footer.html");

?>
  
 