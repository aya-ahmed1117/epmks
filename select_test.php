




    <div  class="input-group"  >
  <span class="input-group-text" id="basic-addon1"><samp><i class="fas fa-user-tie"></i> Tool name</samp></span>
  <select class="form-control Tool_name" 
  name="Tool_name" id="purpose" required>
  <option action="none" value="0" selected>Select..</option>
   <option value="ACM TOOL">ACM TOOL</option>
        <option value="ECRM Order tool">ECRM Order tool</option>
        <option value="NEW PSC">NEW PSC</option>
        <option value="OLD PSC">OLD PSC</option>
        <option value="PSD">PSD</option>
        <option value="Orion">Orion</option>
        <option value="System Ticketing tool">System Ticketing tool</option>
        <option value="School project tool">School project tool</option>
        <option value="PSC dose not Receiving new mails">PSC dose not Receiving new mails</option>

</select>
</div>

  <br>

<center>
 <div class="row">
  <div class="col-md-6">
        <button id="UpDiv" class="btn btn-rounded Tool_Status" value="Up"><span>Up<i class="fas fa-hand-point-up"></i></span></button>
  </div>


   <div class="col-md-6">
    <button id="DownDiv" class="btn btn-rounded Tool_StatusD" value="Down">
      <span>Down  <i class="fas fa-hand-point-down"></i></span></button>
  </div>
  <?php  

  require_once("inc/config.inc");


  $s_username = $_SESSION['username'];
  $sqltime = date ("Y-m-d H:i:s"); 
  if(isset($_POST['Tool_name'])){$Tool_name = $_POST['Tool_name'];}
  if(isset($_POST['Tool_Status'])){$Tool_Status = $_POST['Tool_Status'];}
  ?>


  <?php
  $check = sqlsrv_query($con ,"with max_time_tool as (
SELECT
[Tool_name]
,max([Record_time]) [Time]
FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
group by [Tool_name])
select 
a.[Tool_name]
,a.Tool_Status

FROM [Aya_Web_APP].[dbo].[tbl_tool_status] a
join max_time_tool b on a.[Tool_name] = b.Tool_name and [time] =  [Record_time]");
  // while($checking = sqlsrv_fetch_array($check)){
$checking = sqlsrv_fetch_array($check);
      $Tools_Status=$checking['Tool_Status'];
      '<br>';
	  $tools_names =$checking['Tool_name'];
//}
echo $Tools_Status;
 '<br>';
echo $tools_names;

$Tools_StatusD = 'Down';
$Tools_StatusU = 'Up';

?>
<script>
   <?php
       echo "var vDown ='$Tools_StatusD';";
       echo "var vUp ='$Tools_StatusU';";
       echo "var tStatus ='$Tools_Status';";
       echo "var tName ='$tools_names';";

   ?>
   //console.log(vDown);
   //console.log(vUp); 
   console.log(tStatus);
   console.log(tName);
</script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
    var optionValue = $(this).attr("value");
     <?php
       "var vDown ='$Tools_StatusD';";
       "var vUp ='$Tools_StatusU';";
       "var tStatus ='$Tools_Status';";
       "var tName ='$tools_names';";
   ?>
      console.log(optionValue,tStatus);   
          //  if(optionValue){  	
    if((optionValue) && ( tStatus == vDown))
      {   	
        $("#UpDiv").show();
        $("#DownDiv").hide();
      }//}
      if((optionValue) && ( tStatus == vUp))
      {
      	 
        $("#UpDiv").hide();
        $("#DownDiv").show();
      }else{
      	$("#UpDiv").hide();
        $("#DownDiv").hide();
      }


      });
    }).change();
});
</script>

<script type="text/javascript">
$(document).ready(function(){
   $("select").change(function(){
     $(this).find("option:selected").each(function(){
    //---------------^---------------
    e.preventDefault();
  var Tool_Status = $(this).val();
  var Tool_name = $('.Tool_name').val();
  var dataString = 'Tool_name='+Tool_name+'&Tool_Status='+Tool_Status;
  //if(atype == 'in'){
    
    $.ajax({
    type:"POST", 
    url:"ajax_Indicator.php",
    data: dataString,
    cache: false,
      success: function(data){
      // $('#logBoard').html(data);
      // window.location.reload();
        $("#UpDiv").hide();
        $("#DownDiv").show();
        },
        error: function(err){
          console.log(err);
        }
    });
     return false;
    
     });
  });
</script>

<!--html lang="en">

  

  <?php
  $check = sqlsrv_query($con ,"with max_time_tool as (
SELECT
[Tool_name]
,max([Record_time]) [Time]
FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
group by [Tool_name])
select 
a.[Tool_name]
,a.Tool_Status
FROM [Aya_Web_APP].[dbo].[tbl_tool_status] a
join max_time_tool b on a.[Tool_name] = b.Tool_name and [time] =  [Record_time]

");
  /*
  where [Tool_name] in ('undefined','System Ticketing tool'
'School project tool','PSD','PSC dose not Receiving new mails','Orion',
'OLD PSC','NEW PSC','ECRM Order tool','ACM TOOL') */
  while($checking = sqlsrv_fetch_array($check)){
//$checking = sqlsrv_fetch_array($check);
      $Tools_Status=$checking['Tool_Status'];
      '<br>';
	  $tools_names =$checking['Tool_name'];
}
echo $Tools_Status;
echo $tools_names;
	//echo $Tools_Status;
	//echo $tools_names;
$Tools_StatusD = 'Down';
$Tools_StatusU = 'Up';

//$var = 'Metallica';

?>
<script>
   <?php
       echo "var vDown ='$Tools_StatusD';";
       echo "var vUp ='$Tools_StatusU';";
       echo "var tStatus ='$Tools_Status';";
       echo "var tName ='$tools_names';";

   ?>
   //console.log(vDown);
   //console.log(vUp); 
   console.log(tStatus);
   console.log(tName);
</script>
<?php 
//}
?>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
    var optionValue = $(this).attr("value");
     <?php
       "var vDown ='$Tools_StatusD';";
       "var vUp ='$Tools_StatusU';";
       "var tStatus ='$Tools_Status';";
       "var tName ='$tools_names';";
   ?>
       console.log(optionValue,tStatus);
          //  if(optionValue){  	
    if((optionValue) && ( tStatus == vDown))
      //...............^.......
      {   	
        $("#UpDiv").show();
        $("#DownDiv").hide();
      }//}
      if((optionValue) && ( tStatus == vUp))
      {
      	 

        $("#UpDiv").hide();
        $("#DownDiv").show();
      }else{
      	$("#UpDiv").hide();
        $("#DownDiv").hide();
      }


      });
    }).change();
});
</script>
-->