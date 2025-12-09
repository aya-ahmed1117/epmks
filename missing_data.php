
<?php

 include ("pages.php");
 if($_SESSION['role_id'] == 1){
 ?>
 <title>Missing Data</title>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!--   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     --> 

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>


   <?php
   //acm 
   $check = sqlsrv_query( $con76 ,"SELECT * from missing_data");
     // while($get_out = sqlsrv_fetch_array($check)){
   $get_out = sqlsrv_fetch_array($check);
   
      $ID_d = $get_out['ID'];
      //$time_d = $get_out['date_time']->format('Y-m-d H:i:s');

    ?>


<div class="body" >


  <div class="container-fluid">



  <form method="post" >
    <div class="row">
            <div class="col-md-4">
    <div class="input-group col-2">
      <span class="input-group-text" id="basic-addon1">Choose Date</span>
      <input type="date" class="form-control col-md-8" placeholder="Date" aria-label="From Date" id="dates"
    name='date' aria-describedby="basic-addon1"
    value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>' required />

    <button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
    </div>

    <br>
    </div>
    <h2 style="color:; ">Table Filter</h2>
        <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
        <br>
        <br>
        <?php 
        if(isset($_POST['submit'])){
          $per_tech = sqlsrv_query($con,"INSERT INTO 
   [WorkForce_Reporting_DB].[dbo].[Perf_Tech]
            ([Year]
           ,[Month]
           ,[Group_]
           ,[Performance]
           ,[Technology])
     VALUES
           ('$year'
           ,'$month'
           ,'$group_name'
           ,'$Performan'
           ,'$New_techno')");
 $per_tech = sqlsrv_query($con,"INSERT INTO 
   [WorkForce_Reporting_DB].[dbo].[Perf_Tech]
            ([Year]
           ,[Month]
           ,[Group_]
           ,[Performance]
           ,[Technology])
     VALUES
           ('$year'
           ,'$month'
           ,'$group_name'
           ,'$Performan'
           ,'$New_techno')");
 
        ?>
    <div class="tableFixHead" style="height:100px;">
    <table class="table order-table"  cellspacing="0" id="tblCustomers" >
      <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
        <tr> 
        <th ><center>Date</center></th>
        <th ><center>PSC_live</center></th>
        <th ><center>PSC his 76</center></th>
        

      </tr>
      </thead> 
      <tbody>
        <?php 
        $chooseD= sqlsrv_query($con , "SELECT * FROM date_time");
        $getData=sqlsrv_fetch_array($chooseD);
          $dateT = $getData['date_time'];
          $dateID = $getData['ID'];
          // $creator_name = $getData['creator_name'];

        ?>
        <tr>
          <td><?php echo $dateID ;?></td>
          <td><?php echo $dateT;?></td>
        </tr>
      </tbody>
    </table>
    <?php }
    ?>
    </div>
    </form>
  </div>


</div>


 <?php $s_username = $_SESSION['username'];?>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function(){

 //up
$(".Tool_Status").click(function(e) {
    //---------------^---------------
    e.preventDefault();
  var Tool_Status = $(this).val();
  var Tool_name = $('.Tool_name').val();
  var datetime = $('.datetime').val();
  var dataString = 'Tool_name='+Tool_name+'&Tool_Status='+Tool_Status+'&datetime='+datetime;
  //if(atype == 'in'){
    if(
      (Tool_name != "") && (datetime != "")  && 
      <?php  echo $s_username != NULL; ?>
    ){
    $.ajax({
    type:"POST", 
    url:"ajax_Indicator.php",
    data: dataString,
    cache: false,
      success: function(data){
 swal({ title: "Tool is Up", icon: "success",})
     .then(function() {
            window.location.href=window.location.href
             });
        },
        error: function(err){
          console.log(err);
        }
    });
     return false;
    }else{
    alert('Empty Data');    
  }
        });

//down
  $(".Tool_StatusD").click(function(){
  var Tool_StatusD = $(this).val();
  var Tool_name = $('.Tool_name').val();
  var datetime = $('.datetime').val();
  var dataString2 = 'Tool_name='+Tool_name+'&Tool_Status='+Tool_StatusD+'&datetime='+datetime;
  // if(Tool_name != ""){
    console.log(datetime);
        if((Tool_name != "") && (datetime != "") ){
    $.ajax({
    type: "POST", 
    url: "ajax_Indicator.php",
    data: dataString2,
    cache: false,
       success: function(data){
       //$('#logBoard').html(data);
         swal({
              title: "Tool is Down",
              icon: "warning",
                        }).then(function() {
            window.location.href=window.location.href
             });
        },
        error: function(err){
          console.log(err);
        }
    });
         return false;
    }else{
    alert('Empty Data');    
    }
  });
});
</script>
<?php // }
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

     <?php
   }else{
    echo '
    <div class="alert alert-warning">
  <strong>Info!</strong> You don\'t have permission to access this page
</div>';
   }
 include ("footer.html");
 ?>