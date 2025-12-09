
<?php
/*
//include('db.php');
  // require_once("inc/config.inc");

  date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);

if(isset($_POST['Units'])){
$Units = $_POST['Units'];
  //echo $Units;



 $sql = sqlsrv_query( $con1 ,"SELECT  distinct Groups
from tbl_Personal_info left join Tbl_Units on Unit=Units_ID
left join Tbl_Groups on [Group]=[Group_ID] WHERE Units =  '$Units'   ");
 //while($outputs = sqlsrv_fetch_array($sql)){
 //echo '<option value="'.$row['Groups'].'">'.$row['Groups'].'</option>';

while($go = sqlsrv_fetch_array($sql)){
   
   
      $rows =  '<option ';
        $rows .= $row['Groups'] ? "selected" : "";;
        $rows .= ' value="'.$row['Groups'].'">'.$row['Groups'].'</option>';
  
  echo $rows;
}
}*/
?>




<?php

  date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);

if(isset($_POST['Units'])){
$Units = $_POST['Units'];
  //echo $Units;
 $sql = sqlsrv_query( $con1 ,"SELECT  distinct Groups
from tbl_Personal_info left join Tbl_Units on Unit=Units_ID
left join Tbl_Groups on [Group]=[Group_ID] WHERE Units =  '$Units' ");
 //while($outputs = sqlsrv_fetch_array($sql)){
 //echo '<option value="'.$row['Groups'].'">'.$row['Groups'].'</option>';

while($row = sqlsrv_fetch_array($sql)){
   
     echo  $rows = '<div class="row" ><li ><input style="padding:2px 20px 3px 4px;padding-top:15px;" type="checkbox" id="chkveg" name="Groups[]" value="'.$row['Groups'].'" />'.$row['Groups'].'</li></div>';
       /*$rows =  '<option ';
        $rows .= $row['Groups'] ? "selected" : "";;
        $rows .= ' value="'.$row['Groups'].'">'.$row['Groups'].'</option>';
  
  echo $rows;*/
}
}

if(isset($_POST['Units2'])){
$Units2 = $_POST['Units2'];
  //echo $Units;
 $sql = sqlsrv_query( $con1 ,"SELECT  distinct Groups
from tbl_Personal_info left join Tbl_Units on Unit=Units_ID
left join Tbl_Groups on [Group]=[Group_ID] WHERE Units =  '$Units2'  ");

while($row = sqlsrv_fetch_array($sql)){
   
     echo  $rows = '<div class="row" ><li ><input type="checkbox" id="Groups2" name="Groups2[]" value="'.$row['Groups'].'" />'.$row['Groups'].'</li></div>';
   
}
}
?>
<style type="text/css">
.row {
    display: -ms-flexbox;
     display: flex; 
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
     margin-right: 0; 
     margin-left: -.5px; 
     padding: 10px;
     background-clip: border-box;
border: 1px solid rgba(0,0,0,.125);
border-radius: 5px;
background-color: #fff;
}


 #chkveg li {
      display: list-item;
    float: left;
     margin: 0;
    height: 50%;
    cursor: pointer;
    font-weight: 400;
    padding: 0px 20px 3px 4px;
font-stretch: expanded;
    font-size: 17px;
}
#Groups2 li {
      display: list-item;
    float: left;
     margin: 0;
    height: 50%;
    cursor: pointer;
    font-weight: 400;
    padding: 0px 20px 3px 4px;
font-stretch: expanded;
    font-size: 17px;
}




</style>
<!--div style="clear:both;    margin: 0;
    height: 50%;
    cursor: pointer;
    font-weight: 400;
    padding: 3px 20px 3px 40px;" class="row">
<input id="chkveg" multiselect type="checkbox"  name="Groups[]"  >

   
</input>
</div-->
<script type="text/javascript">
    $('#chkveg').multiselect({
  //nonSelectedText: 'Select Framework',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
</script>