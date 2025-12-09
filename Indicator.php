
<?php

 include ("pages.php");
 if(($_SESSION['role_id'] == 1) || ($_SESSION['role_id'] > 2) ){
 ?>
 <title>Tool Indicator</title>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/toggleSwitch.css">
</head>
<style type="text/css">
  .body{
    padding: 40px;
    height: 100%;
   
  }

p {
  font-size:20px;color:#fff;border-style: outset; border-radius:8px;text-indent:15px;
}
.fa-hand-point-down {
  float:right;
  text-indent: -22px;
  position: relative;
  text-align: center;
  line-height: 1.42857143;

}
.fa-hand-point-up {
  float:right;
  text-indent: -22px;
  position: relative;
  text-align: center;
  line-height: 1.42857143;

}
.btn{
  display: block;
  width: 250px;
  height: 40px;
  font-family: sans-serif;
  text-decoration: none;
  color: #333;
  border: 2px solid #333;
  letter-spacing: 2px;
  text-align: center;
  position: relative;
  transition: all .35s;
  font-size: 20px;
  font-weight: 400;
  line-height: 1.42857143;
}

.btn span{
  position: relative;
  z-index: 2;
}

.Tool_Status:after{
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  width: 0;
  height: 100%;
  background: green;
  transition: all .35s;
}

.Tool_StatusD:after{
  position: absolute;
  content: "";
  top: 0;
  left: 0;
  width: 0;
  height: 100%;
  background: #ff003b;
  transition: all .35s;
}

.btn:hover{
  color: #fff;
}

.btn:hover:after{
  width: 100%;
}


</style>

   <?php
   //acm 
   $check = sqlsrv_query( $con ,"with x1 as (SELECT 
   [Tool_name] ,max([Record_time]) max_time
  FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
  group by [Tool_name])

  select 
  x1.Tool_name,Tool_Status ,[tbl_tool_status].Record_time

  from x1
  left join [Aya_Web_APP].[dbo].[tbl_tool_status] on [tbl_tool_status].Tool_name = x1.Tool_name and x1.max_time = [tbl_tool_status].Record_time  where  x1.Tool_name = 'ACM TOOL' ");
     // while($get_out = sqlsrv_fetch_array($check)){
   $get_out = sqlsrv_fetch_array($check);
   
      $ACM = $get_out['Tool_name'];
      $Status_ACM = $get_out['Tool_Status'];
      $ACM_time = $get_out['Record_time']->format('Y-m-d H:i:s');

      //if($Status_ACM == 'Down'){}
    //}
//ecrm
     $check = sqlsrv_query( $con ,"with x1 as (SELECT 
   
      [Tool_name],max([Record_time]) max_time
  FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
  group by [Tool_name])

  select 
  x1.Tool_name
  ,Tool_Status ,[tbl_tool_status].Record_time

  from x1
  left join [Aya_Web_APP].[dbo].[tbl_tool_status] on [tbl_tool_status].Tool_name = x1.Tool_name and x1.max_time = [tbl_tool_status].Record_time  where  x1.Tool_name = 'ECRM Order tool' ");
       $get_out = sqlsrv_fetch_array($check);

      $ECRM = $get_out['Tool_name'];
      $Status_ECRM = $get_out['Tool_Status'];
      $ECRM_time = $get_out['Record_time']->format('Y-m-d H:i:s');



      //new psd
      $check = sqlsrv_query( $con ,"with x1 as (SELECT 
   
      [Tool_name],max([Record_time]) max_time
  FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
  group by [Tool_name])select 
  x1.Tool_name,Tool_Status ,[tbl_tool_status].Record_time
from x1 left join [Aya_Web_APP].[dbo].[tbl_tool_status] on [tbl_tool_status].Tool_name = x1.Tool_name and x1.max_time = [tbl_tool_status].Record_time  where  x1.Tool_name = 'NEW PSC' ");
       $get_out = sqlsrv_fetch_array($check);

      $NEW = $get_out['Tool_name'];
      $Status_new = $get_out['Tool_Status'];
      $NEW_time = $get_out['Record_time']->format('Y-m-d H:i:s');


      // OLD PSC
      $check = sqlsrv_query( $con ,"with x1 as (SELECT [Tool_name]
  ,max([Record_time]) max_time
  FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
  group by [Tool_name]) select 
  x1.Tool_name,Tool_Status ,[tbl_tool_status].Record_time

  from x1
  left join [Aya_Web_APP].[dbo].[tbl_tool_status] on [tbl_tool_status].Tool_name = x1.Tool_name and x1.max_time = [tbl_tool_status].Record_time  where  x1.Tool_name = 'OLD PSC' ");
       $get_out = sqlsrv_fetch_array($check);

      $old  = $get_out['Tool_name'];
      $Status_old = $get_out['Tool_Status'];
      $old_time = $get_out['Record_time']->format('Y-m-d H:i:s');


      //Orion
      $check = sqlsrv_query( $con ,"with x1 as (SELECT 
   [Tool_name],max([Record_time]) max_time
  FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
  group by [Tool_name])select 
  x1.Tool_name,Tool_Status ,[tbl_tool_status].Record_time

  from x1
  left join [Aya_Web_APP].[dbo].[tbl_tool_status] on [tbl_tool_status].Tool_name = x1.Tool_name and x1.max_time = [tbl_tool_status].Record_time  where  x1.Tool_name = 'Orion' ");
       $get_out = sqlsrv_fetch_array($check);

      $Orion  = $get_out['Tool_name'];
      $Status_Orion = $get_out['Tool_Status'];
      $Orion_time = $get_out['Record_time']->format('Y-m-d H:i:s');


      //System Ticketing tool
      $check = sqlsrv_query( $con ,"with x1 as (SELECT 
   [Tool_name],max([Record_time]) max_time
  FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
  group by [Tool_name])select 
  x1.Tool_name,Tool_Status ,[tbl_tool_status].Record_time

  from x1
  left join [Aya_Web_APP].[dbo].[tbl_tool_status] on [tbl_tool_status].Tool_name = x1.Tool_name and x1.max_time = [tbl_tool_status].Record_time  where  x1.Tool_name = 'System Ticketing tool' ");
       $get_out = sqlsrv_fetch_array($check);

      $System = $get_out['Tool_name'];
      $Status_System = $get_out['Tool_Status'];
      $System_time = $get_out['Record_time']->format('Y-m-d H:i:s');


      //PSD
      $check = sqlsrv_query( $con ,"with x1 as (SELECT 
   [Tool_name],max([Record_time]) max_time
  FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
  group by [Tool_name])select 
  x1.Tool_name,Tool_Status ,[tbl_tool_status].Record_time

  from x1
  left join [Aya_Web_APP].[dbo].[tbl_tool_status] on [tbl_tool_status].Tool_name = x1.Tool_name and x1.max_time = [tbl_tool_status].Record_time  where  x1.Tool_name = 'PSD' ");
       $get_out = sqlsrv_fetch_array($check);

      $PSD = $get_out['Tool_name'];
      $Status_PSD = $get_out['Tool_Status'];
      $PSD_time = $get_out['Record_time']->format('Y-m-d H:i:s');

      //School project tool
      $check = sqlsrv_query( $con ,"with x1 as (SELECT 
   [Tool_name],max([Record_time]) max_time
  FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
  group by [Tool_name])
  select 
  x1.Tool_name,Tool_Status ,[tbl_tool_status].Record_time

  from x1
  left join [Aya_Web_APP].[dbo].[tbl_tool_status] on [tbl_tool_status].Tool_name = x1.Tool_name and 
  x1.max_time = [tbl_tool_status].Record_time  where  x1.Tool_name = 'School project tool' ");
       $get_out = sqlsrv_fetch_array($check);

      $School = $get_out['Tool_name'];
      $Status_School = $get_out['Tool_Status'];
      $School_time = $get_out['Record_time']->format('Y-m-d H:i:s');

      //PSC dose not Receiving new mails
       $check = sqlsrv_query( $con ,"with x1 as (SELECT 
   [Tool_name],max([Record_time]) max_time
  FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
  group by [Tool_name])
  select 
  x1.Tool_name,Tool_Status ,[tbl_tool_status].Record_time

  from x1
  left join [Aya_Web_APP].[dbo].[tbl_tool_status] on [tbl_tool_status].Tool_name = x1.Tool_name and 
  x1.max_time = [tbl_tool_status].Record_time  where  x1.Tool_name = 'PSC dose not Receiving new mails' ");
       $get_out = sqlsrv_fetch_array($check);

      $Receiving = $get_out['Tool_name'];
      $Status_Receiving = $get_out['Tool_Status'];
      $Receiving_time = $get_out['Record_time']->format('Y-m-d H:i:s');


?>

<div class="body" >
  <div class="container-fluid">


     <?php //if($_SESSION['role_id'] == 1){?>

 <h3  style="color: #6b5b95;float: left;"> <label>Choose Date & Time</label></h3>
   <br>

   <!-- <div class="row"> -->
    <div class="col-md-4">
      <input class="form-control datetime" type="datetime-local" 
      name="datetime" required="true">
    <!-- </div> -->

    


   </div>
     <?php //}?>

   <br>
<center>
<div class="input"> 
   <h3  style="color: #6b5b95;float: left;padding-right: 10px;min-width: 110px;"> <label>Choose System Name</label></h3>
   <br>
   
    <div  class="input-group"  id="Tool_name">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fas fa-user-tie"></i> Tool name</samp></span>
  <select class="form-control Tool_name" 
  name="Tool_name" id="inputGroupSelect01" required>
  <option action="none" value="" selected>Select..</option>
   <option value="ACM TOOL">ACM TOOL</option>
        <option value="ECRM Order tool">ECRM Order tool</option>
        <?php //if(($_SESSION['role_id'] == 1) || ($_SESSION['role_id'] >2)){?>
        <option value="NEW PSC">NEW PSC</option>
      <?php //}?>
<!--         <option value="OLD PSC">OLD PSC</option>
        <option value="PSD">PSD</option>--> 
        <option value="Orion">Orion</option>
        <option value="System Ticketing tool">System Ticketing tool</option>
        <option value="School project tool">School project tool</option>
        <option value="PSC dose not Receiving new mails">PSC dose not Receiving new mails</option>
 
</select>
</div>
</div>
</center>
  
  <br>
  <br>

<center>
 <div class="row">

  

<?php 
//if(isset($_POST['datetime'])){$datetime = $_POST['datetime'];}

   //$yourDate = date('Y-m-d h:i:s', strtotime($datetime));
  ?>
  <div class="col-md-6">
        <button id="UpDiv" class="btn btn-rounded Tool_Status" value="Up"><span>Up<i class="fas fa-hand-point-up"></i></span></button>
  </div>
  <?php //}
  ?>
  <div class="col-md-6">
    <button id="DownDiv" class="btn btn-rounded Tool_StatusD" value="Down">
      <span>Down  <i class="fas fa-hand-point-down"></i></span></button>
  </div>
</div>
</center>
</div>



<hr>

        <div class="row">

          <div class="col-lg-3">
            <div class="small-box bg"  >
              <div class="inner"  >
      <br>

                <h3> <?php echo $ACM;?><sup style="font-size: 20px;"> </sup></h3>

              <?php 
               if ($Status_ACM == 'Down'){
                  echo '<p style="background-color:tomato;font-size:20px;color:#eee;">'.$Status_ACM.'<i class="fas fa-hand-point-down"></i></p>';
                }
                if ($Status_ACM == 'Up'){
                  echo '<p style="background-color:#4e9843;font-size:20px;color:#eee;">'.$Status_ACM.'<i class="fas fa-hand-point-up"></i></p>';}
                  ?>
              </div>
              <div class="icon"style="background-color: #eee;">
                <i class="fas fa-history"></i><?php echo $ACM_time; ?> 
              </div>
        
            </div>
          </div>
          <!-- ./col -->
      
          <div class="col-lg-3">
            <!-- small box -->
            <div class="small-box bg"  >
              <div class="inner" id="sys" >
      <br>

                <h3><?php echo $ECRM ;?> <sup style="font-size: 20px;"></sup></h3>

                <?php 
               if ($Status_ECRM == 'Down'){
                  echo '<p style="background-color:tomato;font-size:20px;color:#eee;">'.$Status_ECRM.'<i class="fas fa-hand-point-down"></i></p>';
                }
                if ($Status_ECRM == 'Up'){
                  echo '<p style="background-color:#4e9843;font-size:20px;color:#eee;">'.$Status_ECRM.'<i class="fas fa-hand-point-up"></i></p>';}
                  ?>
              </div>
              <div class="icon"style="background-color: #eee;">
                <i class="fas fa-history"></i><?php echo $ECRM_time; ?>
              </div>
            </div>
          </div>
 <!-- ./col -->
      
          <div class="col-lg-3">
            <!-- small box -->
            <div class="small-box bg"  >
              <div class="inner" >
      <br>

                <h3><?php echo $NEW;?> <sup style="font-size: 20px;"></sup></h3>
                <?php
               if ($Status_new == 'Down'){
                  echo '<p style="background-color:tomato;font-size:20px;color:#eee;">'.$Status_new.'<i class="fas fa-hand-point-down"></i></p>';
                }
                if ($Status_new == 'Up'){
                  echo '<p style="background-color:#4e9843;font-size:20px;color:#eee;">'.$Status_new.'<i class="fas fa-hand-point-up"></i></p>';}
                  ?>

            
              </div>
              <div class="icon"style="background-color: #eee;">
                <i class="fas fa-history"></i><?php echo $NEW_time; ?>
              </div>
            </div>
          </div>

          <div class="col-lg-3 ">
            <!-- small box 
            <div class="small-box bg"  >
              <div class="inner">
                <h3><?php echo $old ;?> <sup style="font-size: 20px;"></sup></h3>
                <?php
               if ($Status_old == 'Down'){
                  echo '<p style="background-color:tomato;font-size:20px;color:#eee;">'.$Status_old.'<i class="fas fa-hand-point-down"></i></p>';
                }
                if ($Status_old == 'Up'){
                  echo '<p style="background-color:#4e9843;font-size:20px;color:#eee;">'.$Status_old.'<i class="fas fa-hand-point-up"></i></p>';}
                  ?>
              </div>
              <div class="icon"style="background-color: #eee;">
                <i class="fas fa-history"></i><?php echo $old_time; ?>
              </div>
            </div>
          </div>
-->
      <br>

        </div>
           <!-- ./col -->
           <br>
           <br>
        <div class="row">

          <!--div class="col-lg-3 ">
            <div class="small-box bg" >
              <div class="inner" >
                <h3><?php echo $PSD ;?> <sup style="font-size: 20px;"></sup></h3>

          <?php
               if ($Status_PSD == 'Down'){
                  echo '<p style="background-color:tomato;font-size:20px;color:#eee;">'.$Status_PSD.'<i class="fas fa-hand-point-down"></i></p>';
                }
                if ($Status_PSD == 'Up'){
                  echo '<p style="background-color:#4e9843;font-size:20px;color:#eee;">'.$Status_PSD.'<i class="fas fa-hand-point-up"></i></p>';}
                  ?>
              </div>
              <div class="icon"style="background-color: #eee;">
                <i class="fas fa-history"></i><?php echo $Orion_time; ?>
              </div>
            </div>
          </div>
           < ./col -->
      <br>
      <br>
          <div class="col-lg-3 ">
            <!-- small box -->
            <div class="small-box bg" >
              <div class="inner">
      <br>

                <h3><?php echo $Orion ;?> <sup style="font-size: 20px;"></sup></h3>

                <?php
               if ($Status_Orion == 'Down'){
                  echo '<p style="background-color:tomato;font-size:20px;color:#eee;">'.$Status_Orion.'<i class="fas fa-hand-point-down"></i></p>';
                }
                if ($Status_Orion == 'Up'){
                  echo '<p style="background-color:#4e9843;font-size:20px;color:#eee;">'.$Status_Orion.'<i class="fas fa-hand-point-up"></i></span></p>';}
                  ?>

              </div>
              <div class="icon"style="background-color: #eee;">
                <i class="fas fa-history"></i><?php echo $Orion_time; ?>
              </div>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 ">
            <!-- small box -->
            <div class="small-box bg" >
              <div class="inner" >
      <br>

                <h3><?php echo $System ;?> <sup style="font-size: 20px;"></sup></h3>

              <?php
               if ($Status_System == 'Down'){
                  echo '<p style="background-color:tomato;font-size:20px;color:#eee;">'.$Status_System.'<i class="fas fa-hand-point-down"></i></p>';
                }
                if ($Status_System == 'Up'){
                  echo '<p style="background-color:#4e9843;font-size:20px;color:#eee;">'.$Status_System.'<i class="fas fa-hand-point-up"></i></span></p>';}
                  ?>

              </div>
              <div class="icon" style="background-color: #eee;">
                <i class="fas fa-history"></i> <?php echo $System_time; ?>
              </div>
            </div>
          </div>

          <div class="col-lg-3 ">
            <!-- small box -->
            <div class="small-box bg" >
              <div class="inner" >
      <br>

                <h3><?php echo $School ;?> <sup style="font-size: 20px;"></sup></h3>


              <?php
               if ($Status_School == 'Down'){
                  echo '<p style="background-color:tomato;font-size:20px;color:#eee;">'.$Status_School.'<i class="fas fa-hand-point-down"></i></p>';
                }
                if ($Status_School == 'Up'){
                  echo '<p style="background-color:#4e9843;font-size:20px;color:#eee;">'.$Status_School.'<i class="fas fa-hand-point-up"></i></p>';}
                  ?>

              </div>
              <div class="icon"style="background-color: #eee;">
                <i class="fas fa-history"></i> <?php echo $School_time; ?>
                </div>
            </div>
          </div>

        </div>
           <!-- ./col -->
           <br>
           <br>
<div class="row">
          <div class="col-lg-3 ">

            <div class="small-box bg" >
              <div class="inner" >
      <br>

                <h3><?php echo $Receiving ;?> <sup style="font-size: 20px;"></sup></h3>


              <?php
               if ($Status_Receiving == 'Down'){
                  echo '<p style="background-color:tomato;font-size:20px;color:#eee;border-style: outset; border-radius:8px;text-indent:15px;">'.$Status_Receiving.'<i class="fas fa-hand-point-down"></i></p>';
                }
                if ($Status_Receiving == 'Up'){
                  echo '<p style="background-color:#4e9843;font-size:20px;color:#eee;">'.$Status_Receiving.'<i class="fas fa-hand-point-up"></i></p>';}
                  ?>

              </div>
              <div class="icon" style="background-color: #eee;">
                <i class="fas fa-history" ></i> <?php echo $Receiving_time; ?>
              </div>

            </div>

          </div>
        </div>

          <!-- ./col -->
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