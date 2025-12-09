<?php
 require_once("pages.php");
 ?>
 <title>Tables</title>
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="Bootstrap 4 DataTables - examples &amp; tutorial.">
  <meta property="twitter:description" content="Bootstrap 4 integration with the most popular plugin enhancing the possibilities of standard tables. Available in Material Design or default Bootstrap style.">
  <meta property="twitter:site" content="@MDBootstrap">
  <meta property="twitter:creator" content="@MDBootstrap">
  <meta property="twitter:image:src" content="https://mdbcdn.b-cdn.net/wp-content/uploads/2015/08/table-fb.jpg">
  <meta property="twitter:player" content="">
  <!-- <link rel="shortcut icon" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/favicon.ico"/>
  <link rel="canonical" href="https://mdbootstrap.com/docs/b4/jquery/tables/editable/" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/compiled-4.20.0.min.css"> -->
  <meta charset="utf-8">
  
  <script data-cfasync="false">
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.'+'js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-W7MBMN');
  </script>
      
    <link rel="stylesheet" type="text/css" href="css/toggleSwitch.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.22.1/bootstrap-table.min.css">


      <style type="text/css">
          .pt-3-half {
              padding-top: 1.4rem;
            }
      </style>

  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9068607355646785" crossorigin="anonymous"></script>

  <style>
    @media (max-width: 576px) {
        [id^=dpl-], [class^=dpl-], .mobile-hidden {
            display: none!important;
        }
    }
  </style>
</head>

<!-- Editable table -->
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">
    Editable table
  </h3>
  <div class="card-body">

   <!--  <span class="table-up">
        <a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-up" aria-hidden="true"></i></a></span>
              <span class="table-down">
                <a href="#!" class="indigo-text">
                    <i class="fas fa-long-arrow-alt-down" aria-hidden="true"></i></a></span>
 -->

    <div id="table" class="table-editable">
     <!--  <span class="table-add float-right mb-3 mr-2"
        ><a href="#!" class="text-success"
          ><i class="fas fa-plus fa-2x" aria-hidden="true">
          </i></a></span> -->
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
      <th class="text-center">Year</th>
      <th class="text-center">Month</th>
      <th class="text-center">Group Name</th>
      <th class="text-center">utilization</th>
      <th class="text-center">TAM_utilization_day</th>
      <th class="text-center">Absenteeism</th>
      <th class="text-center">Performance</th>
      <th class="text-center">New_technolo</th>
      <th class="text-center">update P </th>
      <th class="text-center">update N</th>
     <!--  <th class="text-center">MTTI2_avg</th>
      <th class="text-center">MTTI2%</th>
      <th class="text-center">MTTV_avg</th>
      <th class="text-center">MTTV%</th>
      <th class="text-center">MTTR_Logical </th>  
      <th class="text-center">Wrong_node </th>
      <th class="text-center">Not_Assigned </th>
      <th class="text-center">global_tickets_have_PSD </th> 
      <th class="text-center">Performance_enhancement </th> 
      <th class="text-center">New_technology_awareness </th> 
          </tr> -->
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

   $new_query = sqlsrv_query( $con,"SELECT  [Year]
      ,[MONTH]
      ,k.[group_name]
      ,k.[utilization_without_Resident_TAM_day]
      ,k.[TAM_utilization_day]
      ,k.[Absenteeism]
      ,cast (SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (5,3)) m_absen
      ,[AHT_Avg]
      ,[AHT%]
         ,cast ( SUBSTRING([AHT%],1,LEN([AHT%])-1)  as decimal(5,2)) [k_aht]
         ,[AHT %]*100.00 t_aht
         ,iif(cast ( SUBSTRING([AHT%],1,LEN([AHT%])-1)  as decimal(5,2)) < [AHT %]*100.00,'colour red', 'colour green') [colour_code]
      ,[MTTI1_avg]
      ,[MTTI1%]
         ,iif(cast ( SUBSTRING([MTTI1%],1,LEN([MTTI1%])-1)  as decimal(5,2)) <[MTTI1 %] *100.00,'colour red', 'colour green') [colour_MTTI1]
      ,[MTTI2_avg]
      ,[MTTI2%]
         ,iif(cast ( SUBSTRING([MTTI2%],1,LEN([MTTI2%])-1)  as decimal(5,2)) <[MTTI2 %] *100.00,'colour red', 'colour green') [colour_MTTI2]
      ,[MTTV_avg]
      ,[MTTV%]
         ,iif(cast ( SUBSTRING([MTTV%],1,LEN([MTTV%])-1)  as decimal(5,2)) <[MTTV %] *100.00,'colour red', 'colour green') [colour_MTTV]
   ,[MTTR_Logical%]
          ,iif(cast ( SUBSTRING([MTTR_Logical%],1,LEN([MTTR_Logical%])-1)  as decimal(5,2)) <[MTTR Logical %]*100.00,'colour red', 'colour green') [colourLogical]
      ,[Wrong_node%]
         ,iif(cast ( SUBSTRING([Wrong_node%],1,LEN([Wrong_node%])-1)  as decimal(5,2)) <[Wrong_node %]*100.00,'colour red', 'colour green') [colourWrong_node]
      ,[Not_Assigned%]
         ,iif(cast ( SUBSTRING([Not_Assigned%],1,LEN([Not_Assigned%])-1)  as decimal(5,2)) <[Not Assigned %]*100.00,'colour red', 'colour green') [colour_Assigned]
  ,k.[global_tickets_have_PSD]
       ,iif(cast ( SUBSTRING(k.[global_tickets_have_PSD],1,LEN(k.[global_tickets_have_PSD])-1)  as decimal(5,2)) <t.[global_tickets_have_PSD]*100.00,'colour red', 'colour green') [colour_have_PSD]
      ,k.[Performance_enhancement]
       ,k.[New_technology_awareness]
       /*
         ,iif(cast ( SUBSTRING(k.[Performance_enhancement],1,LEN(k.[Performance_enhancement])-1)  as decimal(5,2)) <t.[Performance_enhancement]*100.00,'colour red', 'colour green') [colour_enhancement]
     
         ,iif(cast ( SUBSTRING(k.[New_technology_awareness],1,LEN(k.[New_technology_awareness])-1)  as decimal(5,2)) <t.[New_technology_awareness]*100.00,'colour red', 'colour green') [colour_awareness]*/
  FROM [WorkForce_Reporting_DB].[dbo].[Kpi_2023_new] k
  left join [WorkForce_Reporting_DB].[dbo].[KPI_target] t on k.group_name=t.Group_Name
order by 1,len([MONTH]),2,3 ");

      while($echo = sqlsrv_fetch_array($new_query) ){
         $rows = '<tr>';
    $rows .='<td    style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td    style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
    $rows .='<td    style="border: 1px solid lightgray;">'.$echo['group_name'].'</td>';
    
    //utilization without resident_day
    //GOV & Public
   /* if(($echo['group_name'] == 'GOV') && 
      ($echo['group_name'] != 'BS')&&
      ($echo['group_name'] != 'Banking')&&
      ($echo['group_name'] != 'Private KAM')&&
      ($echo['utilization_without_Resident_TAM_day'] > 62) ){
    $rows .='<td    style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'GOV') && 
          ($echo['group_name'] != 'BS')&&
          ($echo['group_name'] != 'Banking')&&
          ($echo['group_name'] != 'Private KAM')&&
          ($echo['utilization_without_Resident_TAM_day'] <= 62) ){
    $rows .='<td    style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
        //Private KAM
        if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] >= 57) ){
    $rows .='<td    style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM')   && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] < 57) ){
    $rows .='<td    style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
       
        ///GDS(Global Partner)
        //Banking
        if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 58 ){
    $rows .='<td    style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 58 ){
    $rows .='<td    style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
        //BS
      if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 78 ){
    $rows .='<td    style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 78 ){
    $rows .='<td    style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
   
   if(($echo['group_name'] == 'GDS(Global Partner)') ||
            ($echo['group_name'] == 'Mega Projects') ||
            ($echo['group_name'] == 'Local Loop') || ($echo['group_name'] =='Local Loop  ') ){
    $rows .='<td    style="border: 1px solid lightgray; ">
    '.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
*/
    //******************///TAM_Utilization_day
        
    if(($echo['TAM_utilization_day'] >= '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if(($echo['TAM_utilization_day'] < '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if($echo['TAM_utilization_day'] == NULL){
    $rows .='<td    style="border: 1px solid lightgray;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
   

   $persent = $echo['m_absen'];


   if($persent <=  5.000){
    $rows .='<td    style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['Absenteeism'].'</td>';
        }else{
    $rows .='<td    style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['Absenteeism'].'</td>';   
        }
//AHT_Avg
   /* if($echo["AHT_Avg"] == NULL ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td    style="border: 1px solid lightgray;">'.$echo['AHT_Avg']->format('H:i:s').'</td>';}
//AHT
  if($echo["AHT%"] == NULL ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_code'] == 'colour red') && ($echo["AHT%"] !== NULL )){

  $rows .='<td    style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT%'].'</td>';}
  if( ($echo['colour_code'] != 'colour red') && ($echo["AHT%"] !== NULL )){

  $rows .='<td    style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT%'].'</td>';}
  */
  //MTTI1_avg
      if($echo["MTTI1_avg"] == NULL ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td    style="border: 1px solid lightgray;">'.$echo['MTTI1_avg']->format('H:i:s').'</td>';}

      //colour_MTTI1
   /* if($echo["MTTI1%"] == NULL ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI1'] == 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td    style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI1%'].'</td>';
    }
    if( ($echo['colour_MTTI1'] != 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI1%'].'</td>';
    }

  ///////////////////
    $rows .='<td    style="border: 1px solid lightgray;">'.$echo['MTTI2_avg']->format('H:i:s').'</td>';

    if($echo["MTTI2%"] == NULL ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI2'] == 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td    style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI2%'].'</td>';
    }
    if( ($echo['colour_MTTI2'] != 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI2%'].'</td>';
    }
    if($echo["MTTV_avg"] == NULL ){
    $rows .='<td    style="border: 1px solid lightgray;">Blank</td>';
    }else{
        $rows .='<td    style="border: 1px solid lightgray;">'.$echo['MTTV_avg']->format('H:i:s').'</td>';
    }

    if($echo["MTTV%"] == NULL ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTV'] == 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td    style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTV%'].'</td>';
    }
    if( ($echo['colour_MTTV'] != 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTV%'].'</td>';
    }
    //////////////
    //$rows .='<td    style="border: 1px solid lightgray;">'.$echo['MTTR_Logical%'].'</td>';
    if($echo["MTTR_Logical%"] == NULL ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colourLogical'] == 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td    style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTR_Logical%'].'</td>';
    }
    if( ($echo['colourLogical'] != 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTR_Logical%'].'</td>';
    }
    //////////////
    if($echo["Wrong_node%"] == NULL ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{
        $rows .='<td    style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Wrong_node%'].'</td>';
            }
////

  if($echo["Not_Assigned%"] == NULL ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{

    $rows .='<td    style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Not_Assigned%'].'</td>';
    }
    
    //////////////
    if($echo["global_tickets_have_PSD"] == NULL ){
    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_have_PSD'] == 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td    style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    if( ($echo['colour_have_PSD'] != 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td    style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['global_tickets_have_PSD'].'</td>';
    }*/
    ////////////// 
    if($echo["Performance_enhancement"] == NULL ){
    $rows .='<td contenteditable="false" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;"><svg width="26" height="26" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"></td>';
    }
    if( ($echo['Performance_enhancement'] < 100) && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td contenteditable="false" style="border: 1px solid lightgray;background-color:#ff6666;">'.floor(($echo['Performance_enhancement'])).'%'.'</td>';
    }
    if( ($echo['Performance_enhancement'] >= 100) && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td contenteditable="false" style="border: 1px solid lightgray;background-color:lightgreen;">'.floor(($echo['Performance_enhancement'])).'%'.'</td>';
    }
    //////////////
     $tax = $echo["New_technology_awareness"];
     $test = round($tax,0);

     if($echo["New_technology_awareness"] == NULL ){
    $rows .='<td contenteditable="false" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank<span style="float:right;"></span><svg width="46" height="46" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"></td>';
    }
    if( ($echo['New_technology_awareness'] < 99.5 ) && ($echo["New_technology_awareness"] !== NULL )){

// echo $test = number_format((float)$tax, 2, '.', '');
    $rows .='<td contenteditable="false" style="border: 1px solid lightgray;background-color:#ff6666;">'.floor(($test)).'%'.'<span style="float:right;"></span>  <path d="M9.243 19.002H21v2H3v-4.243l9.9-9.9 4.242 4.244-7.9 7.899h.001Zm5.07-13.556 2.122-2.122a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414l-2.122 2.121-4.242-4.242h-.001Z"></path></td>';
    }
    if( ($echo['New_technology_awareness'] >= 99.5) && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td  style="border: 1px solid lightgray;background-color:lightgreen;">'.floor(($test)).'%'.'<span style="float:right;"></span></svg></td>';
    }
     $rows .='<td>
              <span class="">
                <button type="button" class="btn btn-primary view_data" data-toggle="modal" data-target="#centralModalSm"
                data-year="'.$echo["Year"].'" 
                data-month="'.$echo["MONTH"].'"
                data-groupname="'.$echo["group_name"].'">
                  update
                </button>
            </span>
            </td>
            <td>
              <span class="">
                <button type="button" class="btn btn-primary view_data" data-toggle="modal" data-target="#centralModalSm"
                data-year="'.$echo["Year"].'" 
                data-month="'.$echo["MONTH"].'"
                data-groupname="'.$echo["group_name"].'">
                  update
                </button>
            </span>
            </td>';
    //////////////

        $rows .= '</tr>';
        echo $rows;
}
}
?>
         
          <!-- This is our clonable table line >
          <tr>
            <td  >Guerra Cortez</td>
            <td  >45</td>
            <td  >Insectus</td>
            <td  >USA</td>
            <td  >San Francisco</td>
            <td class="pt-3-half">
              <span class="table-up"
                ><a href="#!" class="indigo-text"
                  ><i class="fas fa-long-arrow-alt-up" aria-hidden="true"></i></a
              ></span>
              <span class="table-down"
                ><a href="#!" class="indigo-text"
                  ><i class="fas fa-long-arrow-alt-down" aria-hidden="true"></i></a
              ></span>
            </td>
            <td>
              <span class="table-remove"
                ><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">
                  Remove
                </button></span
              >
            </td>
          </tr>
          <tr>
            <td  >Guadalupe House</td>
            <td  >26</td>
            <td  >Isotronic</td>
            <td  >Germany</td>
            <td  >Frankfurt am Main</td>
            <td class="pt-3-half">
              <span class="table-up"
                ><a href="#!" class="indigo-text"
                  ><i class="fas fa-long-arrow-alt-up" aria-hidden="true"></i></a
              ></span>
              <span class="table-down"
                ><a href="#!" class="indigo-text"
                  ><i class="fas fa-long-arrow-alt-down" aria-hidden="true"></i></a
              ></span>
            </td>
            <td>
              <span class="table-remove"
                ><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">
                  Remove
                </button></span
              >
            </td>
          </tr>
          <tr class="hide">
            <td  >Elisa Gallagher</td>
            <td  >31</td>
            <td  >Portica</td>
            <td  >United Kingdom</td>
            <td  >London</td>
            <td class="pt-3-half">
              <span class="table-up"
                ><a href="#!" class="indigo-text"
                  ><i class="fas fa-long-arrow-alt-up" aria-hidden="true"></i></a
              ></span>
              <span class="table-down"
                ><a href="#!" class="indigo-text"
                  ><i class="fas fa-long-arrow-alt-down" aria-hidden="true"></i></a
              ></span>
            </td>
            <td>
              <span class="table-remove"
                ><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">
                  Remove
                </button></span
              >
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div-->
<!-- Editable table -->

<!-- Central Modal Small -->
<div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Update</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>


      </div>

         <input type="text" class="form-control groupname"  disabled="true" />
         <input type="text" class="form-control month"  disabled="true" />  

      <div class="modal-body">
 <br>
     <div  class="input-group md-2" >
        <div class="input-group-prepend">
    <span class="input-group-text" >
    Performance enhancement</span>
  </div>
         <input  class="form-control Performan" autofocus="true"
         name="New_technology_awareness"  type="number" 
         placeholder="Update Performance"/>

     </div>
  
      <br>
     <div  class="input-group md-2" >
        <div class="input-group-prepend">
    <span class="input-group-text" >
    New Technology</span>
  </div>
         <input  class="form-control New_techno"
         name="Performance_enhancement"  
         type="number" placeholder="Update New Technology"/>

     </div>
    <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" name="submit" class="btn btn-primary btn-sm submit">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Central Modal Small -->
<div id="message21" >
</div>


<script>  
     $(document).ready(function(){  
       var modal = $(this);
     $(document).on('click', '.view_data', function(){  
           var year = $(this).data("year"); 
           var group_name = $(this).data("groupname"); 
           var MONTH = $(this).data("month"); 

           var Performan = $('.Performan').val(); 
           var New_techno = $('.New_techno').val(); 
    var dataString = 'group_name='+group_name+'&year='+year+'&month='+MONTH+'&New_technology_awareness='+New_techno+'&Performance_enhancement='+Performan
   
          $('.Performan').val(Performan);     
          $('.New_techno').val(New_techno);

          $('.groupname').val(group_name);
          $('.month').val(MONTH);


           $('.submit').on('click',function(){
           var Performan = $('.Performan').val(); 
           var New_techno = $('.New_techno').val(); 
var dataString = 'group_name='+group_name+'&year='+year+'&month='+MONTH+'&New_technology_awareness='+New_techno+'&Performance_enhancement='+Performan
               $.ajax({   
                    url: 'update_monthly.php',
                    type: 'POST',
                    data: dataString,
                    cache: false,  
                 success:function(data){ 
                   $('#message21').html(data);

                     }
                });                  
              return false;
            });
         });
       });
  
 </script>

<script type="text/javascript" src="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/js/bundles/4.20.0/compiled.min.js"></script>
<!--script type="text/javascript" src="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/js/dist/search-v4/search.min.js"></script-->
<script src="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/js/dist/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.22.1/bootstrap-table.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.22.1/bootstrap-table-locale-all.min.js"></script>