




<?php
include ("pages.php");
$DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );
// declare @us as nvarchar(max),
// @grade as nvarchar(max)
// set @us='x_test'
// set @grade='L7'
$Employee_Username ='x_test';
$Employee_grade = "L6";
$Request_Type='Employee Promotion';
$Requester_username = $_SESSION['username'];
$engineer_id = $_SESSION['id'];
$Request_status = 'Open';
$Creation_time = date ("Y-m-d H:i:s");
  //if(isset($_POST['Employee_grade'])){$Employee_grade = $_POST['Employee_grade'];}
  $promotion = sqlsrv_query($con1 ,"SELECT case 
     when grade='L8' and grade='L7' then 'ok' 
     when Grade='L7' and '$Employee_grade'='L6' then 'ok'
     when Grade='L6' and '$Employee_grade'='L5' then 'ok'
     when Grade='L5' and '$Employee_grade'='L4' then 'ok'
     when Grade='L4' and '$Employee_grade'='L3' then 'ok'
     else 'no'
     end [grade_approval]
from [Employess_DB].[dbo].[tbl_Personal_info]
where UserName='$Employee_Username'"); 
  //while( $outputs = sqlsrv_fetch_array($promotion)){
    $outputs = sqlsrv_fetch_array($promotion);
        echo $first= $outputs['grade_approval'];

        if($first == 'ok'){


    $sql="SELECT employee_username,Employee_grade
    from tbl_Ticketing_system
    where Request_Type='$Request_Type' and 
    Employee_Username='$Employee_Username' and Employee_grade='$Employee_grade'";
    $result=sqlsrv_query($con,$sql, array(), array( "Scrollable" => 'static' ));
    $count=sqlsrv_num_rows($result);
    if($count==1){

        echo "Database Exist!";
    }
    else{
        echo "Database does not exist!";
    $insert_promot =sqlsrv_query($con,"INSERT INTO [Aya_Web_APP].[dbo].[tbl_Ticketing_system] 
   ( [Request_Type],[Requester_username],[Note]
      ,[Request_status],[Creation_time],[Ticket_Subject]
      ,[Employee_Username],[Last_working_date],[Employee_new_manager],[Employee_new_id],[Employee_new_username]
      ,[Reason_of_leave] , [Employee_grade] , [Employee_app_Id])

  VALUES ( '$Request_Type', '$Requester_username','Note','$Request_status','$Creation_time','test',
'$Employee_Username','2022-10-10','aya','','', '', '$Employee_grade','$engineer_id')");

    }

}


/*

---ok grade tamam, nkml eli b3do
---no msg error recheck grade


    IF  EXISTS (SELECT employee_username,Employee_grade
    from tbl_Ticketing_system
    where Request_Type='Employee Promotion' and 
    Employee_Username='$Employee_Username'  and Employee_grade='$Employee_grade')
         BEGIN
           SELECT 'already exists'
           END
           ELSE
           SELECT 'insert him'
       ---here you will insert
      INSERT INTO [Aya_Web_APP].[dbo].[tbl_Ticketing_system] 
   ( [Request_Type],[Requester_username],[Note]
      ,[Request_status],[Creation_time],[Ticket_Subject]
      ,[Employee_Username],[Last_working_date],[Employee_new_manager],[Employee_new_id],[Employee_new_username]
      ,[Reason_of_leave] , [Employee_grade] , [Employee_app_Id])

  VALUES ( '$Request_Type', '$Requester_username','Note','$Request_status','$Creation_time','test',
'$Employee_Username','2022-10-10','aya','','', '', '$Employee_grade','$engineer_id')

end
else 
SELECT 'wrong grade'
*/
?>

<!--   <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>
<style>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1060;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;

}
.modal-content {
  background-color: #fefefe;
  margin: 20px auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
  position: static;
  z-index: 10; 

}

.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}



/*
.callout {
  position: fixed;
  bottom: 35px;
  right: 20px;
  margin-left: 20px;
  max-width: 300px;
  z-index: 10;
}

.callout-header {
  padding: 10px 10px;
 / background: #555;/
 background-color: #2196F3;
  font-size: 20px;
  color: white;
  border-radius: 20px 20px 0 0;
}

.callout-container {
  padding: 10px;
  background-color: #eee;
  border-radius: 0 0 20px 20px ;
  color: black
}

.closebtn {
  position: absolute;
  top: 5px;
  right: 15px;
  color: white;
  font-size: 20px;
  cursor: pointer;
}

.closebtn:hover {
  color: lightgrey;
}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1060;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;

}
.modal-header {
    display: flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1rem;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: calc(0.3rem - 1px);
    border-top-right-radius: calc(0.3rem - 1px);
}
.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
}
.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 0.3rem;
    outline: 0;
}
.modal-dialog {
    position: relative;
    width: auto;
    margin: 10.5rem;
    pointer-events: none;
}
.modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto;
}
.fade {
    transition: opacity .15s linear;
}
*/
</style>

<body>
  <div class="col-md-6">
   <div  class="modal" id="message21" style="display: block; background: rgba(0, 0, 0, 0.2);">
  <div id="myOut" class="modal-content" >
    <div style="float:right;"><span class="close closeOut " id="closeOut">×</span></div>

    <div> Project Num</div>
    <br>
  <button type="button" class="collapsible" id="company_name">PO Documents</button>
    <div class="content">
    <div class="swal-footer">
      <button class="swal-button  closed2">Close</button>
    </div>

   </div>
 </div>
</div>

</div>




  <div class="modal fade" style="padding-right: 17px; display: block;background: rgba(0, 0, 0, 0.2);" aria-modal="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" >
                  Happy Mothers Day For All Lovely Moms and Girls <i><img rel="icon" src="images/Mothers-Day-PNG-Picture" style="width:9%;"> </i>
        </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
              <div class="modal-body">
                <img src="images/giphy13"style="background-repeat:no-repeat;
    background-size:cover; width:50%;hight:30%; "> 
    <center>
   
 <img src="images/giphy13" style="background-repeat:no-repeat;
   background-size:cover; width:50%;hight:30%; "> 

<br>
<br>
Dears,
  Ki
Reason of the mission ( Revolution Day )
<br>
       </center></div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          
      </div>
  </div>
</div>

<script type="text/javascript">
  (function() {
  document.getElementById("message21").style.display = "none";
});

  $(".closeOut").click(function () {
    //close action
    document.getElementById("message21").style.display = "none";
});
</script>
<!-<div class="modal">
  <div class="modal-header">New update <img src="images/ImpoliteVapidGuanaco.gif" style="width:20%;"></div>
  <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span>
  <div class="modal-container">
    <p>Now you can check all (leaves history) <a href="Team_Leaves.php">Go here</a> Click on any number and all data will appear</p>
  </div>
</div> ->

  
  </body>
  </html> -->