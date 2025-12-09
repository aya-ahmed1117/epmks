

<?php
 //session_start();
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);
    

sqlsrv_query( $connect , "SET NAMES 'utf8'"); 
sqlsrv_query( $connect ,'SET CHARACTER SET utf8' );

?>



<?php
if(isset($_get['export'])){}
echo '
<div class="tableFixHead">

<table class="table table-hover"  cellspacing="0" width="150%" id="tblCustomers" >
  <thead  style="background-color:rgb(120, 120, 120); color: white; font-weight: bold; text-align: center;">
  	<tr>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>RequestID</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>PSD_number</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>closure_reason</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>closure_Reason_Eng</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>first_Cst_mail</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>creation_time</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>First_in_progress</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTI1_eng</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>First_category</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTI2_eng</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Resolve_time</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTF_Eng</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Final_close</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTV_eng</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>ticket_status</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Ticket_group</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Reopen</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Category</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>First_assigned_engineer</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Last_engineer</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Request_Mode</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Data_source</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Subcategory</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Item</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Fake_Real</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>circuitID</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>RoutecausePSC</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>RoutecausePSD</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>PopName</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Trasmission_media</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>CustomerZone</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Account_Name</center></th>
  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>OrderID</center></th>

  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>nodeID</center></th>

  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>First_Resp_Time</center></th>

  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>First_resp_eng</center></th>

  <th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Num_days</center></th>

		</tr>
		</thead>
	
  <tbody>';

   $mttr = sqlsrv_query($connect,"SELECT distinct *
    ,Iif(datediff(day,creation_time,getdate())=0,'less than 1 day',iif(datediff(day,creation_time,getdate()) between 1 and 2 ,'From 1 to 2 days',
    iif(datediff(day,creation_time,getdate()) between 2 and 3 , 'From 2 to 3 days' , 'More than 3 days'))) Num_days
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where ticket_status <>  'closed' and   cast([creation_time] as date)>='2020-05-28' 
  and datediff(day,creation_time,getdate())<>0  ");

   while ($output = sqlsrv_fetch_array($mttr) ){
$rows  ='<tr>';
  $rows .='<td style="font-size:15px;border: 1px solid #000000;">'.$output["RequestID"].'</td>';
  $rows .='<td style="font-size:15px;border: 1px solid #000000;">'.$output["PSD_number"].'</td>';
  $rows .='<td style="font-size:15px;border: 1px solid #000000;">'.$output["closure_reason"].'</td>';
  $rows .='<td style="font-size:15px;border: 1px solid #000000;">'.$output["closure_Reason_Eng"].'</td>';

  if($output["first_Cst_mail"] == NULL ){
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td style="font-size:15px;border: 1px solid #000000;">'.$output["first_Cst_mail"]->format('Y:m:d H:i:s').'</td>';}
///////////
  if($output["creation_time"] == NULL ){
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["creation_time"]->format('Y:m:d H:i:s').'</td>';}
  ////////////
  if($output["First_in_progress"] == NULL ){
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["First_in_progress"]->format('Y:m:d H:i:s').'</td>';}
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTI1_eng"].'</td>';
  //////////
   if($output["First_category"] == NULL ){
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["First_category"]->format('Y:m:d H:i:s').'</td>';}
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTI2_eng"].'</td>';
  ///////
   if($output["Resolve_time"] == NULL ){
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Resolve_time"]->format('Y:m:d H:i:s').'</td>';}
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTF_Eng"].'</td>';
  //////////
  if($output["Final_close"] == NULL ){
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Final_close"]->format('Y:m:d H:i:s').'</td>';}
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTV_eng"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["ticket_status"].'</td>';
    $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Ticket_group"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Reopen"].'</td>';

 $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Category"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["First_assigned_engineer"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Last_engineer"].'</td>';
  
  
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Request_Mode"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Data_source"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Subcategory"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Item"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Fake_Real"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["circuitID"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["RoutecausePSC"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["RoutecausePSD"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["PopName"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Trasmission_media"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["CustomerZone"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Account_Name"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["OrderID"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["nodeID"].'</td>';
  ////////////
  if($output["First_Resp_Time"] == NULL ){
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["First_Resp_Time"]->format('Y:m:d H:i:s').'</td>';}
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["First_resp_eng"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["Num_days"].'</td>';

$rows .='</tr>';
echo $rows;

}

  ?>

  </tbody>
</table>
</div>

