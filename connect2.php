

<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
<style type="text/css">
.row {
  
    margin-right: 0;
    margin: 0;
    top: auto;
    padding: 10px;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 5px;
    background-color: #fff;
    width: 30%;
}


 #chkveg li {
      display: list-item;
    float: left;
     margin: 0;
    cursor: pointer;
    padding: 3px;
    font-stretch: expanded;
    font-size: 17px;
}
input ,.former{
    display: block;
    width: 20%;
    height: calc(2.25rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.former:focus{
    display: block;
    outline: 0;
    border-color: #383f88;
    box-shadow: 0 0 10px #383f88;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1pxsolid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

   
</style>



<?php
require_once("inc/config.inc");

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);

      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];

      if(isset($_POST['Unit'])){$Unit = $_POST['Unit'];}
      if(isset($_POST['Group_Name'])){$Group_Name = $_POST['Group_Name'];}
      if(isset($_POST['shift_start'])){$shift_start = $_POST['shift_start'];}
      if(isset($_POST['Username'])){$uechosername = $_POST['Username'];}
      if(isset($_POST['Number'])){$Number = $_POST['Number'];}
$s_username = $_SESSION['username'];
$sqltime = date ("Y-m-d H:i:s");



    if(isset($_POST['date_shift'])){$date_shift = $_POST['date_shift'];}
    if(isset($_POST['pc_ip'])){$pc_ip = $_POST['pc_ip'];}
    //if(isset($_POST['project_id'])){$project_id = $_POST['project_id'];}

    
if(isset($_POST['date_shift'])){
$date_shift = $_POST['date_shift'];
 $sql = sqlsrv_query( $con1 ,"SELECT * from [Employess_DB].[dbo].[pop_reserve] where
    date_shift='$date_shift'");

       while($out = sqlsrv_fetch_array($sql)){
  $project_id = $out['project_id'];
     $pc_ip_name = $out['pc_ip'];
     $Numberss = $out['Number'];
     $Username_pc = $out['Username'];
     $Unitss = $out['Unit'];
     $Group_Names = $out['Group_Name'];
}


 $sql = sqlsrv_query($con1 ,"SELECT * from [Employess_DB].[dbo].[pop_reserve] where
    date_shift='$date_shift'");
 
       while($out = sqlsrv_fetch_array($sql)){
     echo  $rows = '<div class="row"><input class="form-check-input" type="radio" id="chkveg" name="pc_ip[]" value="'.$out['pc_ip'].'" />'.$out['pc_ip'].'</div>';

      $pc_ip = $out['pc_ip'];
 }
}
?>

<br>
<br>


<script type="text/javascript">
    $('#chkveg').multiselect({
  //nonSelectedText: 'Select Framework',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
</script>