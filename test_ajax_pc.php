

<!-- <link rel="stylesheet" type="text/css" href="css/kpi_css.css"> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style type="text/css">
    .inputs-group-addon {
  
    font-weight: 400;
    line-height: 1.25;
    color: #495057;
    text-align: center;
    background-color: #ffff;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 0.25rem;
  }
  .collapsible {
  background-color: #383f88;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #555;

}

.content {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}
.tableFixHead         
    { 
    overflow-y: auto; 
    height:200px; 
    overflow-x: auto;width: 100%;
    }
    .tableFixHead thead th 
    { 
    position: sticky; top: 0;
    background-color:#333d6b;
  z-index:4;
  vertical-align: top; 
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

      if(isset($_POST['pc_ip'])){$pc_ip = $_POST['pc_ip'];}
      if(isset($_POST['Unit'])){$Unit = $_POST['Unit'];}
      if(isset($_POST['Group_Name'])){$Group_Name = $_POST['Group_Name'];}
      if(isset($_POST['shift_start'])){$shift_start = $_POST['shift_start'];}
      if(isset($_POST['date_shift'])){$date_shift = $_POST['date_shift'];}
      if(isset($_POST['Username'])){$uechosername = $_POST['Username'];}
      if(isset($_POST['Number'])){$Number = $_POST['Number'];}
$s_username = $_SESSION['username'];
$sqltime = date ("Y-m-d H:i:s");

 if(isset($_POST['date_shift'])){
 $sql = sqlsrv_query( $con1 ,"SELECT * from [Employess_DB].[dbo].[pop_reserve] where date_shift='$date_shift'");
 
       //while($outs = sqlsrv_fetch_array($sql)){
   $outs = sqlsrv_fetch_array($sql);

     $pc_ip_name = $outs['pc_ip'];
     $Numberss = $outs['Number'];
     $Username_pc = $outs['Username'];
     $Unitss = $outs['Unit'];
     $Group_Names = $outs['Group_Name'];

 $sql = sqlsrv_query( $con1 ,"SELECT * from [Employess_DB].[dbo].[pop_reserve] where date_shift='$date_shift'");
$count_rows = sqlsrv_num_rows($sql);
   $count_rows = 1;

   if($count_rows == 0 ){
    echo 'no reservation';
}
}

if(isset($_POST['pc_ip'])){
if(isset($_POST['date_shift'])){
 $error_query = sqlsrv_query( $con1 ,"SELECT ISNULL((SELECT  pc_ip
  FROM [Employess_DB].[dbo].[pop_reserve]
  where pc_ip = '$pc_ip' and [date_shift] = '$date_shift'),'nothing') resultt");
    
      $error=sqlsrv_fetch_array($error_query);
      $error_aya= $error['resultt'];
     
  if($error_aya !='nothing'){

     echo '
     <script>
    swal({
    title: "Data already exists",
  icon: "success",
  });
     </script>';

  }
}}
?>


         <div id="aya">
             <div class="input-group"style="display: none;">
              <div class="inputs-group-addon" > 
              Reserve Number:
              <input id="Number" name="Number" class="Number"  disabled="true"value=" <?php echo $Numberss;?>" >
          </div>
          </div>
<br>
     <input type="text" class="form-control date_shift" name="date_shift"  disabled="true" value="<?php echo $date_shift;?>" />
<br>

     <br>
      <div  class="input-group md-3">
  <span class="input-group-text" id="basic-addon1">Choose PC</span>
  <select class="form-control sType" name="pc_ip"required="true" id="pc_ip">
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
  $selected_pc =$output['pc_ip'];
}
?>
</select>
  
</div>
<br>
<?php
if($count_rows == 0 ){
    echo 'no reservation';
}

 if($count_rows > 0 ){?>
<button type="button"class="input-group md-2 collapsible" id="collapsible"> Reserved PC</button>
    <div class="content">
   
 <br>
    <div class="col-sm-5 tableFixHead">

  <table class="card-table table" >
     <thead style="color: white;font-size:15px;background-color:#55608f; ">
        <tr>
          <th scope="col">PC</th>
          <th scope="col">user</th>
      </tr>
</thead>
<tbody >
<?php
       $Notifica = sqlsrv_query( $con1 ,"SELECT * from [Employess_DB].[dbo].[pop_reserve] where date_shift='$date_shift'");
 
       //while($outs = sqlsrv_fetch_array($sql)){
   while($all_pc = sqlsrv_fetch_array($Notifica)){
   $reserv_pc_ip = $all_pc['pc_ip']; 
   $reserv_user = $all_pc['Username']; 

    $rows ='<tr>';
      $rows .='<td style="border:3px solid #eee;">'.$reserv_pc_ip.'</td>';
      $rows .='<td style="border:3px solid #eee;">'.$reserv_user.'</td>';
     $rows .='</tr>';
echo $rows ; 
          } 

    
    ?> 
         </tbody>
        </table>
        </div> 
   
   

     </div>
     <?php } 
          ?>
</div>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
      <!--   </div>
    </div>
</div>
</div> -->
 