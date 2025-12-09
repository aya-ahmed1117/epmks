

 <?php
        require_once("inc/config.inc");
        include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];

      if (isset($_GET['id'])){$idd = $_GET['id']; }
$check = sqlsrv_query( $con ,"SELECT * FROM [employee] ");
//$output = $check->fetch_array();
$output = sqlsrv_fetch_array($check );
$orders_num = 1;
$username_idd = $output['username_id'];

$s_username = $_SESSION['username'];

$sqltime = date ("Y-m-d H:i:s");
$name ="";
 $id_leave ="";
if(isset($_POST['name'])){$name = $_POST['name'];}
     if (isset($_POST['Request_ID'])) { $id_leave = $_POST['Request_ID'];}

     if(isset($_POST['DeleteR']))
     {
///echo $name .'---'.$id_leave;

//insert 

$insertqry = "INSERT into leaves_demo select * ,'$s_username','$sqltime'  from $name where id = '$id_leave' ";
//sqlsrv_query( $con ,$insertqry);
  $insertqry.'<br/>' ;
 if($insertqry){
  '<div class="popup" id="message">
<div class="content" name="done" ><h2>INSERT is done<i class="fas fa-thumbs-up"></i> ...</h2></div>
</div>';}
else{  '<h2>ERROOOOOOOOOOOOOOOOOOR</h2>';}
//delete 
$deleteqry = "DELETE  from $name where id = '$id_leave' and $name <> $name ";
 //sqlsrv_query( $con ,$deleteqry);
 $deleteqry .'<br/>' ;
if($deleteqry){
  '<div class="popup" id="message2">
<div class="content" name="done" ><h2>Deleting is done<i class="fas fa-thumbs-up"></i> ...</h2></div>
</div>';}
     }

      ?>

<!DOCTYPE html>
<html>

<head>
  <title>Delete Recored</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
       
    <div class="wrapper">
        <!-- Sidebar  -->
 
   <style>
    
.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.popup {

  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  border-radius: 5px;
  width: 100%;
  position: absolute;
  background: rgba(0, 0, 0, 0.7);
}

.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  background-color: #eee;
  width: 39%;
  margin: 200px 0 10px 30%;
  text-align: center;
  padding: 45px;
  border: 2px solid rgba(0, 0, 10, 0.7);
  border-radius: 20px/50px;
  font-size: 40px;
  color: black;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  
  .popup{
    width: 70%;
  }
}

    </style>


            
  <?php

$check = sqlsrv_query( $con ,"SELECT * FROM [employee]  ");
$output = sqlsrv_fetch_array($check );
$senior = $output['manager_id'];
$username_idd = $output['username_id'];
$orders_num = 1;
?>

    <div class="content">
    <div class="container-fluid">


    <div class="row">
    <div class="col-md-12">
    <!-- AREA CHART -->
    <div class="box box-primary">

            <div class="box-header with-border">
              <h2 class="box-title">Delete Records</h2>
              <div class="box-tools pull-right">

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

     <div class="box-body chart-responsive">
      
    <form method="post">
     <div class="card-body" style="height:60px;">

<input list="browser" name="name" placeholder="Select Table..." 
value='<?php if($name != '') echo $name; $name != 'leaves_demo'; ?>' style="width:49%;padding:7px;" /> 
<datalist id="browser" name="name"  >
     <?php
     if(isset($_POST['name'])){$name = $_POST['name'];}
$gogo = sqlsrv_query( $con ,"SELECT [name]
FROM SYSOBJECTS WHERE xtype = 'U' and name  in ('leaves' , 'employee')");
//FROM SYSOBJECTS WHERE xtype = 'U' and name != 'leaves_demo' and name != 'schedule_demo' ");
  while($index = sqlsrv_fetch_array($gogo)){
  $rows  = '<option ';
  $rows .= $index['name'] ? "selected" : "";;
  $rows .= 'value="'.$index['name'].'">'.$index['name'].'</option>';
  echo $rows;
$date1 =$index['adate'];
}
  $name = $_POST['name'];?> 
 </datalist>      
 <input list="browsers" placeholder="Select ID..." name="Request_ID" 
 value='<?php if($id_leave != '') echo $id_leave; ?>' required style="width:49%;padding:7px;"/>

</div>


 <!--/datalist-->
<a style='color:#f3e5ab;font-size:13px;' href='?Request_ID=<?php if (isset($_GET['Request_ID'])) { $id_leave = $_GET['Request_ID'];
 echo $id_leave; }?>'>
<button  type='submit' name="datalist" value="Get data" class="btn btn-outline-info btn-rounded col-md-6" 
style="background-color: gray; padding: 10px; color: #eee; font-size: 15px; margin-left:23%;">Get data </button></a>
<br>
<br/>
<br/>
<br/>
<div  class="table table-striped table-hover" style="overflow:scroll;">
   <table  class="order-table table" style="color: #702283; border: 5px solid #eee;  flex-wrap: wrap;
  text-transform: uppercase;">
 <?php 

 if(isset($_POST['datalist'])){
//echo '<div id="msg_txt"  class="order-table table" style="overflow-x:scroll;" >';
   if (isset($_POST['Request_ID'])) { $id_leave = $_POST['Request_ID']; 

 if (isset($_GET['Request_ID'])) { $id_leave = $_GET['Request_ID']; }


 
 $stmt =sqlsrv_query($con, "SELECT top 1 * FROM $name where '$name' <> 'leaves_demo' " ); /// get table header only 
 $stmt2 =sqlsrv_query($con, "SELECT * FROM $name  where id = '$id_leave' and '$name' <> 'leaves_demo'  " ); // get table data

while($rows = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){

echo '<thead>';
 foreach ($rows as $column=>$value){

  echo '<th style="border:  1px solid #660066; background-color:#3b6879 ; color:#eee;">'.$column .'</th>';

}echo '</thead>';
}

while($rows = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)){
echo '<tbody>';
 foreach ($rows as $column=>$value){
if($value instanceof \DateTime) {
   echo '<td style="border: 1px solid #eee;font-size:13px;">'.$value->format('Y-m-d H:i:s') .'</td>';
}
else
{
  echo '<td style="border: 1px solid #eee;font-size:13px;">'.$value .'</td>';
}

}echo '</tbody>';}

 }}
 ?>
</div>
 </table>

<br/>
    <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" name="DeleteR"
     type="submit">Delete Recored</button>


        </form>

        </div>

        <!-- Form -->
        </div>            
        </div>
        <!-- /.box-body -->
        </div>
        </div>
        <?php 
        $username_idd = $output['username_id'];

$s_username = $_SESSION['username'];

$sqltime = date ("Y-m-d H:i:s");
$name ="";
$id_leave ="";
if(isset($_POST['name'])){$name = $_POST['name'];}
     if (isset($_POST['Request_ID'])) { $id_leave = $_POST['Request_ID'];}

     if(isset($_POST['DeleteR']))
     {
///echo $name .'---'.$id_leave;

//insert employee_demo
if($name == 'employee') {
  $employee_insertqry =sqlsrv_query( $con ,"INSERT into employee_demo select        
       [id]
      ,[username]
      ,[password]
      ,[role_id]
      ,[manager_id]
      ,[super_id]
      ,[section_id]
      ,[UnitManager_id]
      ,[Unit_Name]
      ,[username_id]
      ,[updated_by]
      ,[creation_time] 
      ,'$s_username'
      ,'$sqltime'
      ,(select [creator_user]
       from employee where id = '$id_leave')
     ,(select [add_Dtime] from employee where id = '$id_leave')
    from $name where id = '$id_leave' ");

  
//sqlsrv_query( $con ,$insertqry);
 if($employee_insertqry){
 echo '<div class="popup" id="message" >
<div class="content" name="done"   ><h2>INSERT is done<i class="fas fa-thumbs-up"></i> ...</h2></div>
</div>';}
else{ echo '<h2>ERROOO employee OOOR</h2>';}
}
      /*
      [id]
      ,[username]
    ,[username_id]*/
    //insert leaves_demo
if($name == 'leaves') {
$insertqry =sqlsrv_query( $con , "INSERT into leaves_demo select * ,'$s_username','$sqltime'  from $name where id = '$id_leave' ");

//sqlsrv_query( $con ,$insertqry);
  //$insertqry.'<br/>' ;
 if($insertqry){
 echo '<div class="popup" id="message" >
<div class="content" name="done"  ><h2>INSERT is done<i class="fas fa-thumbs-up"></i> ...</h2></div>
</div>';}
else{ echo '<h2>ERROOOOOOOOOOOOOOOOOOR</h2>';}
}
//delete 
if($name == ['leaves_demo'] ){
  echo '<h2>ERROOOOO  delete  OOOOOR</h2>';
}

$deleteqry = "DELETE  from $name where id = '$id_leave' and '$name' <> 'leaves_demo' and '$name' <> 'schedule_demo'   ";
 sqlsrv_query( $con ,$deleteqry);
 $deleteqry .'<br/>' ;
if($deleteqry){
 echo '<div class="popup" id="message2">
<div class="content" name="done" ><h2>Deleting is done<i class="fas fa-thumbs-up"></i> ...</h2></div>
</div>';}
else{ echo '<h2>ERROOOOO  delete  OOOOOR</h2>';}
     }
     ?> 
<script type="text/javascript">
$(document).ready(function(){
  $(".btn-group .btn").click(function(){
    var inputValue = $(this).find("input").val();
    if(inputValue != 'all'){
      var target = $('table tr[data-status="' + inputValue + '"]');
      $("table tbody tr").not(target).hide();
      target.fadeIn();
    } else {
      $("table tbody tr").fadeIn();
    }
  });
  // Changing the class of status label to support Bootstrap 4
    var bs = $.fn.tooltip.Constructor.VERSION;
    var str = bs.split(".");
    if(str[0] == 4){
        $(".label").each(function(){
          var classStr = $(this).attr("class");
            var newClassStr = classStr.replace(/label/g, "badge");
            $(this).removeAttr("class").addClass(newClassStr);
        });
    }
});
</script>

       <script type="text/javascript">
  setTimeout(function() {
  document.getElementById("message").style.display = 'none';
}, 1000);
</script>
 <script type="text/javascript">
  setTimeout(function() {
  document.getElementById("message2").style.display = 'none';
}, 1500);
</script>

</body>
</html>