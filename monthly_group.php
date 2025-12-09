<?php
require_once("pages.php");
?>
<head>
<title>Tables</title>

<link rel="stylesheet" type="text/css" href="font-awesome4/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="css/kpi_css.css">

<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
  }

  .pt-3-half {
    padding-top: 1.4rem;
  }

  @media (max-width: 576px) {

    [id^=dpl-],
    [class^=dpl-],
    .mobile-hidden {
      display: none !important;
    }
  }

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
</style>
</head>

<div style="padding:20px;">

<?php
 

        ////if(isset($_GET['group'])){
    ?>
    
<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Summary Kpi`s
                per Group
      <a href="Summary_kpi.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter"data-table="order-table"placeholder="Filter"/>
    <br>
    <br>

<!--div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
      <th><center>Year</center></th>
      <th><center>Month</center></th>
      <th><center>Group Name</center></th>
      <th><center>Utilization Without Resident Tam Day</center></th>
      <th><center>TAM_utilization_day</center></th>
      <th><center>Absenteeism</center></th>
      <th><center>AHT_Avg</center></th>
      <th><center>AHT%</center></th>
      <th><center>MTTI1_avg</center> </th>
      <th><center>MTTI1%</center></th>
      <th><center>MTTI2_avg</center></th>
      <th><center>MTTI2%</center></th>
      <th><center>MTTV_avg</center></th>
      <th><center>MTTV%</center></th>
      <th><center>MTTR_Logical</center> </th>  
      <th><center>Wrong_node</center> </th>
      <th><center>Not_Assigned</center> </th>
      <th><center>global_tickets_have_PSD</center> </th> 
      <th><center>Performance_enhancement</center> </th> 
      <th><center>New_technology_awareness</center> </th> 
    </tr>
		</thead-->
<div style="padding:20px;">

<!-- Editable table -->
<div class="tableFixHead" >

<table class="table"  >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white;
  overflow-x: auto; ">
    <tr>
            <th class="text-center">Year</th>
            <th class="text-center">Month</th>
            <th class="text-center">Group Name</th>
            <th class="text-center">utilization</th>
            <th class="text-center">TAM_utilization_day</th>
            <th class="text-center">Absenteeism</th>
            <th class="text-center">Performance</th>
            <th class="text-center">New_technolo</th>
           <!--  <th class="text-center">update P </th>
            <th class="text-center">update N</th> -->
            <!--  <th class="text-center">MTTI2_avg</th>
      <th class="text-center">MTTI2%</th>
      <th class="text-center">MTTV_avg</th>
      <th class="text-center">MTTV%</th>
      <th class="text-center">MTTR_Logical </th>  
      <th class="text-center">Wrong_node </th>
      <th class="text-center">Not_Assigned </th>
      <th class="text-center">global_tickets_have_PSD </th> 
      <th class="text-center">Performance_enhancement </th> 
      <th class="text-center">New_technology_awareness </th> -->
          </tr> 
        </thead>
	
  <tbody>
<?php
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);

if(($_SESSION['username'] == 'ahmed.akef') || ($_SESSION['role_id'] == 1) ){
$new_query = sqlsrv_query($con, "SELECT  [ID]
      ,[Year]
      ,[MONTH]
      ,[group_name]
      ,[utilization_without_Resident_TAM_day]
      ,[TAM_utilization_day]
      ,[Absenteeism]
      ,[AHT_Avg]
      ,[AHT%]
      ,[MTTI1_avg]
      ,[MTTI1%]
      ,[MTTI2_avg]
      ,[MTTI2%]
      ,[MTTV_avg]
      ,[MTTV%]
      ,[MTTR_Logical%]
      ,[Wrong_node%]
      ,[Not_Assigned%]
      ,[global_tickets_have_PSD]
      ,[Performance_enhancement]
      ,[New_technology_awareness]
      ,[updated_by]
      ,[creation_time]
  FROM [WorkForce_Reporting_DB].[dbo].[Kpi_2023_new_demo]");
      while($echo = sqlsrv_fetch_array($new_query) ){
         $rows = '<tr>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['group_name'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Performance_enhancement'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['New_technology_awareness'].'</td>';
    
    /*
  ////////// 
    if($echo["Performance_enhancement"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank  <span style="float:right;">
                <button type="button" title="UPDATE" class="btn btn-primary view_data" data-toggle="modal" data-target="#centralModal"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="Performance_enhancement" 
                data-value="' . $echo["Performance_enhancement"] . '"
                data-groupname="' . $echo["group_name"] . '">
                
               <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button>
                </span></td>';
    }
    //red
    if( ($echo['Performance_enhancement'] < 100) && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Performance_enhancement'].' <span style="float:right;">
                <button type="button" title="UPDATE" class="btn btn-primary view_data" data-toggle="modal" data-target="#centralModal"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="Performance_enhancement" 
                data-value="' . $echo["Performance_enhancement"] . '"
                data-groupname="' . $echo["group_name"] . '">
                
               <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button>
                </span></td>';
    }
    if( ($echo['Performance_enhancement'] == 100) && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['Performance_enhancement'].' <span style="float:right;">
                <button type="button" title="UPDATE" class="btn btn-primary view_data" data-toggle="modal" data-target="#centralModal"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="Performance_enhancement" 
                data-value="' . $echo["Performance_enhancement"] . '"
                data-groupname="' . $echo["group_name"] . '">
                
               <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button>
                </span></td>';
    }
    //////////////
     
     if($echo["New_technology_awareness"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank 
    <span style="float:right;">
                <button type="button" title="UPDATE"class="btn  view_data" data-toggle="modal" data-target="#centralModal"
                id="'.$echo['ID'].'"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="New_technology_awareness" 
                data-value="' . $echo["New_technology_awareness"] . '"
                data-groupname="' . $echo["group_name"] . '">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button></span></td>';
    }
    //red
    if( ($echo['New_technology_awareness'] < 100 ) && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['New_technology_awareness'].' 
    <span style="float:right;">
                <button type="button" title="UPDATE"class="btn  view_data" data-toggle="modal" data-target="#centralModal"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="New_technology_awareness" 
                data-value="' . $echo["New_technology_awareness"] . '"
                data-groupname="' . $echo["group_name"] . '">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button></span></td>';
    }
    //green
    if( ($echo['New_technology_awareness'] == 100) && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['New_technology_awareness'].' 
    <span style="float:right;">
                <button type="button" title="UPDATE"class="btn  view_data" data-toggle="modal" data-target="#centralModal"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="New_technology_awareness" 
                data-value="' . $echo["New_technology_awareness"] . '"
                data-groupname="' . $echo["group_name"] . '">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button></span></td>';
    }
 */
// data-toggle="modal" 
     $rows .= '<td><button type="button" title="UPDATE" class="btn btn-primary " data-toggle="modal" data-target="#centralModal"
                id="'.$echo["ID"].'"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"             
                data-groupname="' . $echo["group_name"] . '">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button></td>';
    //////////////

        $rows .= '</tr>';
        echo $rows;
}
}

?>
          </tbody>
        </table>
       </div>
     </div>
   </div>


<div style="padding:20px;">
<div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal mt-5" id="centralModal" >
      <div id="myOut" class="modal-content" >

        <h5 class="modal-title" >Leaves id num</h5>
         <div><button class="close2" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
           </button></div>
        
            <input type="text" class="form-control  groupname"disabled="true" />
             <input type="text" class="form-control  month" disabled="true" />
             <input type="text" class="form-control  id" disabled="true" />

                <div class="modal-body">
                  <br>
                  <div id="New_technology_awareness_div" class="input-group md-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        New_techno </span>
                    </div>
                    <input id="New_technology_awareness_input" class="form-control w-100 New_techno" autofocus="true" name="New_technology_awareness" type="number" placeholder="Update Performance" />

                  </div>

                  <br>
                  <div id="Performance_enhancement_div" class="input-group md-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        Performance enhancement</span>
                    </div>
                    <input id="Performance_enhancement_input" class="form-control w-100 Performan" name="Performance_enhancement" type="text" placeholder="Update New Technology" />

                  </div>
                  <br>
                </div>
          <div class="modal-footer">

          <button class="btn btn-primary submit">Submit</button>
             <button type="button" class="btn btn-secondary close" 
             data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div> 
         
<script type="text/javascript">
      $(".close").click(function () {
    //close action
      document.getElementById("centralModal").style.display = "none";
          });
    </script>  
          <script>
            $(document).ready(function() {
              var modal = $(this);
              $(document).on('click', '.view_data', function() {
                var year = $(this).data("year");
                var id = $(this).attr("id");
                var group_name = $(this).data("groupname");
                var MONTH = $(this).data("month");
                var column = $(this).data("column");
                var value = $(this).data("value");

                var Performan =  $(this).data("Performan");
                var New_techno = $(this).data("New_techno");

      $('.Performan').val(Performan);     
      $('.New_techno').val(New_techno);     

                if (column == 'Performance_enhancement') {
                  $('#Performance_enhancement_div').css("display", "block");
                  $('#New_technology_awareness_div').css("display", "none");
                  $('#Performance_enhancement_input').val(value);

                }

                if (column == 'New_technology_awareness') {
                  $('#Performance_enhancement_div').css("display", "none");
                  $('#New_technology_awareness_div').css("display", "block");
                  $('#New_technology_awareness_input').val(value);
                }        

                //var Performan = $('.Performan').val();
                //var New_techno = $('.New_techno').val();
                
                // var dataString = 'group_name='+group_name+'&year='+year+'&month='+MONTH+'&New_technology_awareness='+New_techno+'&Performance_enhancement='+Performan

                //$('.Performan').val(Performan);
               // $('.New_techno').val(New_techno);

                $('.groupname').val(group_name);
                $('.month').val(MONTH);
               
                $('.submit').on('click', function() {
                  $('.submit').prop('disabled', true);

                  var Performan = $('.Performan').val();
                  var New_techno = $('.New_techno').val();

      // var dataString = 'ID='+id+'&New_technology_awareness='+New_techno+'&Performance_enhancement='+Performan;
                  var dataString = '';
                  dataString += (group_name !== undefined && group_name !== null && group_name !== '' ? 'group_name=' + group_name : '')
                  dataString += (year !== undefined && year !== null && year !== '' ? '&year=' + year : '')
                  dataString += (MONTH !== undefined && MONTH !== null && MONTH !== '' ? '&month=' + MONTH : '')
                  dataString += (New_techno !== undefined && New_techno !== null && New_techno !== '' ? '&New_technology_awareness=' + New_techno : '')
                  dataString += (Performan !== undefined && Performan !== null && Performan !== '' ? '&Performance_enhancement=' + Performan : '')
                  dataString += '&ID='+id


                  $.ajax({
                    url: 'update_monthly.php',
                    type: 'POST',
                    data: dataString,
                    cache: false,
                    success: function(data) {
                      // $('#message21').html(data);
                       swal({ title: "Done", icon: "success",}).then(function() {
            window.location.href=window.location.href
                            });

                    }
                  });

                  $('#centralModal').modal('hide');
                  $('.submit').prop('disabled', false);
                  return false;
                });


                /*$('.submit').on('click', function() {
                  var Performan = $('.Performan').val();
                  var New_techno = $('.New_techno').val();


                  var dataString = '';
                  dataString += (group_name !== undefined && group_name !== null && group_name !== '' ? 'group_name=' + group_name : '')
                  dataString += (year !== undefined && year !== null && year !== '' ? '&year=' + year : '')
                  dataString += (MONTH !== undefined && MONTH !== null && MONTH !== '' ? '&month=' + MONTH : '')
                  dataString += (New_techno !== undefined && New_techno !== null && New_techno !== '' ? '&New_technology_awareness=' + New_techno : '')
                  dataString += (Performan !== undefined && Performan !== null && Performan !== '' ? '&Performance_enhancement=' + Performan : '')


                  $.ajax({
                    url: 'update_monthly.php',
                    type: 'POST',
                    data: dataString,
                    cache: false,
                    success: function(data) {
                      //$('#message').html(data);

            swal({ title: "Done", icon: "success",}).then(function() {
            window.location.href=window.location.href
                            });

                    }
                  });
                  return false;
                });*/
              });
            });
          </script>

   <script src="js/jquery.min.js"></script>
<script src="js/bootstrap2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
<script src="js/table2excel.js"></script>
<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Summary_kpi.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>
  <?php

 ///include ("footer.html");

 ?>