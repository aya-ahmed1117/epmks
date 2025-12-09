

<?php
include ("pages.php");
if(isset($_POST['ID'])){$ID = $_POST['ID'];}  
if(isset($_POST['Mobile_Number'])){$Mobile_Number = $_POST['Mobile_Number'];}
if(isset($_POST['Mobile_2'])){$Mobile_2 = $_POST['Mobile_2'];}

?>
  <title>Update Info </title>
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
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
              <h2 class="text-dark display-12" >Update Info</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;"> Click on Update to update your Info</p>
  </aside>
</div>
</center>
<br>
<!-- <form  method="post"> -->
  

<!-- <center>
 <div class="limiter">
    <div class="container-table100">
      <div class="tableFixHead col-8">
        <div class="tableFixHead">

<table cellspacing="0" class="table order-table" id="tblCustomers" style="border-radius:30px 30px 30px 30px;background-color: #fff;" >
  <thead  style="color: white; font-weight: bold; text-align: center;font-size: 15px; ">
    <tr>

    <th style=" background-color: #55608f;color: white;"><center>ID Num </center></th>
    <th style=" background-color: #55608f;color: white;" ><center>Username</center></th>
    <th style=" background-color: #55608f;color: white;" ><center>Mobile_Number</center></th>
    <th style=" background-color: #55608f;color: white;" ><center>Mobile_2</center></th>
    <th style=" background-color: #55608f;color: white;" ><center>Avaya LoginID</center></th>
    <th style=" background-color: #55608f;color: white;width: 10%;"><center>Update</center></th>
    </tr>
    </thead> -->

<tbody id="logBoard">


    <?php
    $s_username = $_SESSION['username'];  
//      $first_query = sqlsrv_query( $con,"SELECT  [LoginID]
//       ,[username]
//   FROM [Aya_Web_APP].[dbo].[Avaya_LoginID_username]where username ='$s_username' ");
// //while( $output_query1 = sqlsrv_fetch_array($first_query)){
//     $output_query1 = sqlsrv_fetch_array($first_query);


  $tany_query = sqlsrv_query( $con,"SELECT [ID]
      ,[UserName]
      ,[Mobile_Number]  
      ,[Mobile_2]
  FROM [Employess_DB].[dbo].[tbl_Personal_info] where username ='$s_username' ");
 //while( $output_query = sqlsrv_fetch_array($tany_query)){
    $output_query = sqlsrv_fetch_array($tany_query);

    $talet_query = sqlsrv_query( $con,"SELECT[DomainUserName]
      ,[Avaya_Login]
   FROM [Employess_DB].[dbo].[Tbl_Computers]
   where [DomainUserName]='$s_username' ");
 //while( $output_query3 = sqlsrv_fetch_array($talet_query)){
$output_query3 = sqlsrv_fetch_array($talet_query);

 $IDD = $output_query["ID"];
 $Mobile_Numbera =$output_query["Mobile_Number"];
 $Mobile_2a =$output_query["Mobile_2"];
 $Avaya_Login =$output_query3["Avaya_Login"];
     
?>

<div class="container emp-profile">
            <form id='logBoard'>
<div style="float:right;"><?php echo '<input type="button" name="update" value="Update"
data-Mobile_Number="'.$output_query["Mobile_Number"].'"
 data-Mobile_2="'.$output_query["Mobile_2"].'"
  data-ID="'.$output_query["ID"].'"
  data-Avaya_Login="'.$output_query3["Avaya_Login"].'"

   class="btn btn-info btn-xs view_data" />';
   ?></div>
   <br>
   <br>
                <div class="row"> 

                    <div class="col-md-6">

                        <div class="profile-head">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">My Info</a>
                                </li>
                            </ul>
                        </div>
                    </div>
   
</div>
<br>
<div class="col-md-8">
    <div class="tab-content profile-tab" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6 ">
                            <label>User Id :</label>
                        </div>
                        <div class="col-md-6 lon">
                            <p><?php echo $IDD;  ?></p>
                        </div>
                    </div>
             
                    <div class="row">
                        <div class="col-md-6 ">
                            <label>Mobile 1 :</label>
                        </div>
                        <div class="col-md-6 lon">
                            <p><?php echo $Mobile_Numbera ;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 ">
                            <label>Mobile 2 :</label>
                        </div>
                        <div class="col-md-6 lon">
                            <p><?php echo $Mobile_2a ;?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 ">
                            <label>Avaya :</label>
                        </div>
                        <div class="col-md-6 lon">
                            <p><?php echo $Avaya_Login ;?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal" id="message21" >
      <div id="myOut" class="modal-content" >
        <h5 class="modal-title" >Update my data</h5>
         <div ><button class="close2 close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" data-dismiss="modal">×</span>
           </button></div>
     <input type="text" class="form-control ID" name="ID"  disabled="true" />
     <br>
     <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Mobile Number 1</label>
         <input  class="form-control mobile_number" name="Mobile_Number" type="text" placeholder="Update your Number" />
         
     </div>
     <br>
     <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Mobile Number 2</label>
         <input  class="form-control mobile_2" name="Mobile_2"  type="text" placeholder="Update your Number"/>

     </div>

      <br>
     <div  class="input-group md-2" >
        <label class="form-control"style="border-radius:30px 0px 0px 30px;background-color:lightgray;">Avaya login</label>
         <input  class="form-control avaya_login" name="Avaya_Login"  type="text" placeholder="Update your avaya login"/>

     </div>
    <br>
      <!-- <label >Notes</label>
        <textarea class="form-control note" ></textarea> -->
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
           var ID = $(this).data("id"); 
           var Mobile_Number = $(this).data("mobile_number"); 
           var Mobile_2 = $(this).data("mobile_2");
           var Avaya_Login = $(this).data("avaya_login"); 

      $('.ID').val(ID);
      $('.mobile_number').val(Mobile_Number);     
      $('.mobile_2').val(Mobile_2);
      //$('.avaya_login').val(LoginID);
      $('.avaya_login').val(Avaya_Login);

        var dataString = 'ID='+ID+'&Mobile_Number='+Mobile_Number+'&Mobile_2='+Mobile_2
        +'&LoginID='+Avaya_Login+'&Avaya_Login='+Avaya_Login

          $('.id').val(ID);
          $('.mobile_number').val(Mobile_Number);     
          $('.mobile_2').val(Mobile_2);
          //$('.loginiD').val(Avaya_Login);
          $('.avaya_login').val(Avaya_Login);
              $.ajax({   
              data:dataString,
              cache: false,  
               success:function(data){                    // $('#message21').modal('show');  
                    document.getElementById('message21').style.display = 'block';
               }  
                });  
     $('.submit').on('click',function(){
      var ID = $('.ID').val();
      var Mobile_Number = $('.mobile_number').val();
      var Mobile_2 = $('.mobile_2').val();
      //var LoginID = $('.loginiD').val();
      var Avaya_Login = $('.avaya_login').val();

        //if(!empty(Mobile_Number) || (Mobile_2)){  
        $.ajax({   
            url: 'ajax_info.php',
            type: 'POST',
            data: 'ID='+ID+'&Mobile_Number='+Mobile_Number+'&Mobile_2='+Mobile_2+'&LoginID='+Avaya_Login+'&Avaya_Login='+Avaya_Login,
            cache: false,  
         success:function(data){ 
       $('#logBoard').html(data); 
       $('#message21').modal(data);

       setTimeout(function(){// wait for 5 secs(2)
           window.location.href=window.location.href // then reload the page.(3)
      }, 1900); 
                     }
                });  
                  
      return false;
      //}          
     }); 
 });

   });
  
 </script> 
</div>

<!-- </form> -->
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

