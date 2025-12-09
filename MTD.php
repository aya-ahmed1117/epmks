

<?php
        require_once("inc/config.inc");
        
  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }

      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];

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
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="imag/logo.jpg">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MTD report</title>
<meta name="theme-color" content="#33b5e5">
    <link rel="manifest" href="/manifest.json">
     <script src="js/prettify.min.js"></script>
  <script src="lib/example.js"></script>
    <meta name="theme-color" content="#33b5e5">
    
 <script src="https://mdbootstrap.com/wp-includes/js/wp-emoji-release.min.js?ver=5.2.3" type="text/javascript" defer=""></script>
    <style type="text/css">
img.wp-smiley,
img.emoji {
  display: inline !important;
  border: none !important;
  box-shadow: none !important;
  height: 1em !important;
  width: 1em !important;
  margin: 0 .07em !important;
  vertical-align: -0.1em !important;
  background: none !important;
  padding: 0 !important;
}
</style>
  <link rel="stylesheet" id="wp-block-library-css" href="https://mdbootstrap.com/wp-includes/css/dist/block-library/style.min.css?ver=5.2.3" type="text/css" media="all">
<link rel="stylesheet" id="wc-block-style-css" href="https://mdbootstrap.com/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/style.css?ver=2.3.0" type="text/css" media="all">
<link rel="stylesheet" id="contact-form-7-css" href="https://mdbootstrap.com/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=5.1.4" type="text/css" media="all">
<style id="woocommerce-inline-inline-css" type="text/css">
.woocommerce form .form-row .required { visibility: visible; }
</style>
<link rel="stylesheet" id="wsl-widget-css" href="https://mdbootstrap.com/wp-content/plugins/wordpress-social-login/assets/css/style.css?ver=5.2.3" type="text/css" media="all">
<link rel="stylesheet" id="compiled.css-css" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/compiled-4.8.10.min.css?ver=4.8.10" type="text/css" media="all">

<meta name="referrer" content="always">  
    <meta name="p:domain_verify" content="ba4bb1f26dcf05eadc4ea92722eca381">
<meta name="ahrefs-site-verification" content="cd945a30a32beb9f20f22626c5f801f2063a726c6fd9af1db55ce27eafaa1e45">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link href="assets/css/demo.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="report1.css">
      <link rel="stylesheet" type="text/css" href="css/morris.css">

  <link rel="stylesheet" type="text/css" href="css/prettify.min.css">

  <link rel="stylesheet" href="css/bootstrap22.min.css">
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style4.css">

</head>
<body>

	 <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
        <ul style="margin-left: -5%;"><img src="imag/logo.jpg" alt="logo.jpg" style="padding-top: 1px; padding-left: 1px; width: 25px; margin-bottom: 3px; "><span style="font-size:15px;font-family: Century Gothic; ">WorkForce Managment Tool</span></ul>
<a href="senior_home.php">
                    <button type="button" id="sidebarCollapse" class="btn btn-info" style="margin-left: 20px;" >
                        Home
                    </button></a>

                    <a href="mwd_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" style="margin-left:11%;" >
                      <i class="fas fa-backward"></i>  Back
                    </button></a> 
  
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
     
                        <ul class="nav navbar-nav ml-auto">

 <li ><a href="#" style="font-size: 9.5px;"><span class="glyphicon glyphicon-user"></span> login as <samp>:</samp>
        <?php echo $_SESSION["username"];?><h6 style="color: orange;font-size: 10px;text-align: justify;text-indent: 10px;letter-spacing: -.5px;line-height: 0.8;" ></h6></a></li>
                          
<li><a href="?logout"><span class="glyphicon glyphicon-log-in "></span> Logout</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
           <style type="text/css">
           	.head{
           		font-size: 20px;
           		background-color:#002060;
           	}
           	.heads{
           		background-color:#002060;
           	}
.tableFixHead         
 { 
 	overflow-y: auto; height:400px; overflow-x: auto; 
 }
.tableFixHead thead th 
{ 
	position: sticky; top: 0; 
}
      
           </style>
           <div class="form-group">
           <label  style=" font-weight: bold;font-size: 20px;" >Month to Day / Year to Day <span style="color: orange;">Report</span></label>
       </div>

       <form method="post" >
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">

<div class="tableFixHead">
  
<table class="table table-hover order-table" data-status="all" cellspacing="0" width="150%" >
  <thead  style="background-color:rgb(120, 120, 120); color: white; font-weight: bold;">
  	<tr>
     <th class="heads" ></th>
      <th class="heads"></th>
        <th class="heads">Total tickets</th>
        <th  class="heads">Ticket within sla</th>
        <th class="heads">%</th>
        <th class="heads">Total tickets</th>
        <th class="heads">Ticket within sla</th>
        <th class="heads">%</th>
        <th class="heads">Total tickets</th>
        <th class="heads">Ticket within sla</th>
        <th class="heads">%</th>
        <th class="heads">Total tickets</th>
        <th class="heads">Ticket within sla</th>
        <th class="heads">%</th>
        <th class="heads">Total tickets</th>
        <th class="heads">Ticket within sla</th>
        <th class="heads">%</th>
        <th class="heads">Total tickets</th>
        <th class="heads">Ticket within sla</th>
        <th class="heads">%</th>
        
   
    </tr>
    <tr >
      <th  class="head">Month</th>
      <th  class="head">Category</th>
      <th  class="head">BS</th>
      <th  class="head">BS</th>
      <th  class="head">BS</th>
      <!--th class="head">GDS</th>
      <th class="head">GDS</th>
      <th class="head">GDS</th>
      <th  class="head">ICT</th>
      <th  class="head">ICT</th>
      <th  class="head">ICT</th>
      <th class="head">KAM</th>
      <th class="head">KAM</th>
      <th class="head">KAM</th>
      <th class="head">RESIDENT</th>
      <th class="head">RESIDENT</th>
      <th class="head">RESIDENT</th>
      <th  class="head">TAM</th>
      <th  class="head">TAM</th>
      <th  class="head">TAM</th-->

      <th  class="head">Banking</th>
      <th  class="head">Banking</th>
      <th  class="head">Banking</th>

      <th  class="head" style="font-size: 11px;">GDS(Global Partner)</th>
      <th  class="head" style="font-size: 11px;">GDS(Global Partner)</th>
      <th  class="head" style="font-size: 11px;">GDS(Global Partner)</th>


      <th  class="head">GOV</th>
      <th  class="head">GOV</th>
      <th  class="head">GOV</th>

      <th  class="head" style="font-size: 11px;">Mega Projects</th>
      <th  class="head" style="font-size: 11px;">Mega Projects</th>
      <th  class="head" style="font-size: 11px;">Mega Projects</th>

      <th  class="head" style="font-size: 11px;">Private KAM</th>
      <th  class="head" style="font-size: 11px;">Private KAM</th>
      <th  class="head" style="font-size: 11px;">Private KAM</th>


      <!--th  class="head" style="font-size: 11px;">Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)</th>
      <th  class="head" style="font-size: 11px;">Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)</th>
      <th  class="head" style="font-size: 11px;">Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)</th!-->

    
    
    </tr>
  </thead>
  <tbody>
		<?php
		if(($_SESSION['role_id'] <> 0) || ($_SESSION['username'] == 'Ahmed.AbdelFattah') ){
		  
		  $new_query = sqlsrv_query( $connect , "with x1 as (SELECT [Month_num]
      ,[Category],[BS], [GDS], [ICT], [KAM], [RESIDENT], [TAM],

                         [Banking],[GDS(Global Partner)],[GOV],[GOV/Public&Security],[Mega Projects],[Private KAM],[Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)]

 

  FROM [WorkforceDB_indexed].[dbo].[ALLPSCTickets]

 

  union

 

  SELECT [Month_num]

 

  ,'Total' [Category],Sum([BS]) BS,Sum([GDS]) [GDS]

      ,Sum([ICT]) [ICT],Sum([KAM]) [KAM]

      ,Sum([RESIDENT]) [RESIDENT],Sum([TAM]) [TAM] ,Sum([Banking]) [Banking]

         ,sum([GDS(Global Partner)]) [GDS(Global Partner)]

         ,sum([GOV]) [GOV]

         ,Sum([GOV/Public&Security]) [GOV/Public&Security]

         ,Sum([Mega Projects]) [Mega Projects]

         ,SUM([Private KAM]) [Private KAM]

         ,SUM([Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)]) [Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)]

 

  FROM [WorkforceDB_indexed].[dbo].[ALLPSCTickets]

 

  group by [Month_num]),

 

x2 as (SELECT [Month_num]

 

      ,[Category],[BS], [GDS], [ICT], [KAM], [RESIDENT], [TAM],[Banking],[GDS(Global Partner)],[GOV],[GOV/Public&Security],[Mega Projects],[Private KAM],[Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)]

                        

 

  FROM [WorkforceDB_indexed].[dbo].[withinSLA_PSC_Tickets]

 

  union

 

  SELECT [Month_num],'Total' [Category],Sum([BS]) BS,Sum([GDS]) [GDS]

      ,Sum([ICT]) [ICT],Sum([KAM]) [KAM]

      ,Sum([RESIDENT]) [RESIDENT],Sum([TAM]) [TAM] ,Sum([Banking]) [Banking]

         ,sum([GDS(Global Partner)]) [GDS(Global Partner)]

         ,sum([GOV]) [GOV]

         ,Sum([GOV/Public&Security]) [GOV/Public&Security]

         ,Sum([Mega Projects]) [Mega Projects]

         ,SUM([Private KAM]) [Private KAM]

         ,SUM([Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)]) [Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)]

 

  FROM [WorkforceDB_indexed].[dbo].[withinSLA_PSC_Tickets]

 

  group by [Month_num])

 

  select x1.Month_num

 

, x1.[Category]

 

,x1.[BS]

 

,x2.[BS] BS2

 

,iif((x1.[BS] = 0 or x2.[BS] = 0) ,0,cast (round (x2.[BS]*100.0/x1.[BS],1 ) as decimal(10,2))) [BS3]

,x1.[Banking]

 

  ,x2.[Banking]  Banking2

 

,iif((x1.[Banking] = 0 or x2.[Banking] = 0) ,0,cast (round (x2.[Banking]*100.0/x1.[Banking],1 ) as decimal(10,2))) [Banking3]

,x1.[GDS(Global Partner)]

 

  ,x2.[GDS(Global Partner)]  [GDS(Global Partner)2]

 

,iif((x1.[GDS(Global Partner)] = 0 or x2.[GDS(Global Partner)] = 0) ,0,cast (round (x2.[GDS(Global Partner)]*100.0/x1.[GDS(Global Partner)],1 ) as decimal(10,2))) [GDS(Global Partner)3]

,x1.[GOV]

 

  ,x2.[GOV]  [GOV2]

 

,iif((x1.[GOV] = 0 or x2.[GOV] = 0) ,0,cast (round (x2.[GOV]*100.0/x1.[GOV],1 ) as decimal(10,2))) [GOV3]

,x1.[Mega Projects]
  ,x2.[Mega Projects]  [Mega Projects2]
,iif((x1.[Mega Projects] = 0 or x2.[Mega Projects] = 0) ,0,cast (round (x2.[Mega Projects]*100.0/x1.[Mega Projects],1 ) as decimal(10,2))) [Mega Projects3]
,x1.[Private KAM]
  ,x2.[Private KAM]  [Private KAM2]
,iif((x1.[Private KAM] = 0 or x2.[Private KAM] = 0) ,0,cast (round (x2.[Private KAM]*100.0/x1.[Private KAM],1 ) as decimal(10,2))) [Private KAM3]

from x1

  left join x2 on x1.Month_num = x2.month_num and x1.[Category] = x2.[Category]

  where  x1.[Category] in ('Global','Logical','Physical','Request','Total')

  order by 1,2");

		  while($echo = sqlsrv_fetch_array($new_query) ){
		  	$rows = "<tr>";
		  	
		  	if($echo['Category']=='Total'){
	$rows .="<td style='font-size:13px; width:.1%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['Month_num']."</td>";
	$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['Category']."</td>";
$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['BS']."</td>";
$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['BS2']."</td>";
$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".floor($echo['BS3']).'%'."</td>";
    //$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['GDS']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['GDS2']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".floor($echo['GDS3']).'%'."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['ICT']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['ICT2']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".floor($echo['ICT3']).'%'."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['KAM']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['KAM2']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".floor($echo['KAM3']).'%'."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['RESIDENT']." </td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['RESIDENT2']." </td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>
  	//".floor($echo['RESIDENT3']).'%'."</td>";

  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['TAM']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['TAM2']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>
  	//".floor($echo['TAM3']).'%'."</td>";

$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['Banking']."</td>";
$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['Banking2']."</td>";
$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".floor($echo['Banking3']).'%'."</td>";


$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['GDS(Global Partner)']."</td>";
$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['GDS(Global Partner)2']."</td>";
$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".floor($echo['GDS(Global Partner)3']).'%'."</td>";


$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['GOV']."</td>";
$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['GOV2']."</td>";
$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".floor($echo['GOV3']).'%'."</td>";

//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['GOV/Public&Security']."</td>";
//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['GOV/Public&Security2']."</td>";
//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".floor($echo['GOV/Public&Security3']).'%'."</td>";

  $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['Mega Projects']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['Mega Projects2']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".floor($echo['Mega Projects3']).'%'."</td>";



  $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['Private KAM']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['Private KAM2']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".floor($echo['Private KAM3']).'%'."</td>";


//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)']."</td>";
    //$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".$echo['Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)2']."</td>";
    //$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#002060;color:white;'>".floor($echo['Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)3']).'%'."</td>";
    

		  	}
		  	else{
		$rows .="<td style='font-size:13px; width:.1%; border: 1px solid #eee;'>".$echo['Month_num']."</td>";
		$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;background-color:#6f30a0;color:white;'>".$echo['Category']."</td>";
  	$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['BS']."</td>";
  	$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['BS2']."</td>";
  	$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".floor($echo['BS3']).'%'."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['GDS']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['GDS2']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".floor($echo['GDS3']).'%'."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['ICT']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['ICT2']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".floor($echo['ICT3']).'%'."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['KAM']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['KAM2']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".floor($echo['KAM3']).'%'."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['RESIDENT']." </td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['RESIDENT2']." </td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".floor($echo['RESIDENT3']).'%'."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['TAM']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['TAM2']."</td>";
  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".floor($echo['TAM3']).'%'."</td>";
    //$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['UNMANAGED']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Banking']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Banking2']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Banking3']."</td>";

    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['GDS(Global Partner)']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['GDS(Global Partner)2']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['GDS(Global Partner)3']."</td>";

    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['GOV']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['GOV2']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['GOV3']."</td>";


    //$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['GOV/Public&Security']."</td>";
    //$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['GOV/Public&Security2']."</td>";
    //$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['GOV/Public&Security3']."</td>";

    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Mega Projects']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Mega Projects2']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Mega Projects3']."</td>";

    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Private KAM']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Private KAM2']."</td>";
    $rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Private KAM3']."</td>";

  	//$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)']."</td>";
    //$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)2']."</td>";
    //$rows .="<td style='font-size:13px; width:5%; border: 1px solid #eee;'>".$echo['Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)3']."</td>";




    
		  }

		  	$rows .= "</tr>";
		  	echo $rows ;

		  }


		}
		/*
		$t_total = sqlsrv_query($connect,"SELECT sum(BS) t_BS , sum(GDS) t_GDS, sum(ICT) t_ICT,
    sum(KAM) t_KAM, sum(RESIDENT) t_RESIDENT, sum(TAM) t_TAM ,sum([Mega Projects]) t_Mega
    , sum([Private KAM]) t_Private,
     sum([Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)]) t_Pvt,
       sum(Banking) t_Banking, sum([GDS(Global Partner)]) t_GDSglopal, sum(GOV) t_GOV ,
     sum([GOV/Public&Security]) t_GOVPubli
    FROM [WorkforceDB_indexed].[dbo].[ALLPSCTickets] ");
		*/
		
	$t_total = sqlsrv_query($connect,"SELECT sum(BS) t_BS ,sum([Mega Projects]) t_Mega
    , sum([Private KAM]) t_Private,
       sum(Banking) t_Banking, sum([GDS(Global Partner)]) t_GDSglopal, sum(GOV) t_GOV 
    FROM [WorkforceDB_indexed].[dbo].[ALLPSCTickets] ");

  $act_total = sqlsrv_fetch_array($t_total);
   
   //$t_GDS = $act_total['t_GDS'];
   //$t_ICT = $act_total['t_ICT'];
   //$t_KAM = $act_total['t_KAM'];
   //$t_RESIDENT = $act_total['t_RESIDENT'];
   //$t_TAM = $act_total['t_TAM'];
    $t_BS = $act_total['t_BS'];
    $t_Mega =$act_total['t_Mega'];
    $t_Private =$act_total['t_Private'];
    //$t_Pvt =$act_total['t_Pvt'];
    $t_Banking =$act_total['t_Banking'];
    $t_GDSglopal =$act_total['t_GDSglopal'];
    $t_GOV =$act_total['t_GOV'];
    //$t_GOVPubli =$act_total['t_GOVPubli'];
   //$t_UNMANAGED = $act_total['t_UNMANAGED'];
   //2
    /*
    "SELECT sum(BS) t_BS2 , sum(GDS) t_GDS2, sum(ICT) t_ICT2,
    sum(KAM) t_KAM2, sum(RESIDENT) t_RESIDENT2, sum(TAM) t_TAM2 ,sum([Mega Projects]) t_Mega2 , sum([Private KAM]) t_Private2,
     sum([Pvt KAM(L-Corpts,M-nationals,N-Bank,Tele,IT&Tours)]) t_Pvt2,
    sum(Banking) t_Banking2, sum([GDS(Global Partner)]) t_GDSglopal2, sum(GOV) t_GOV2 ,sum([GOV/Public&Security]) t_GOVPubli2 

    FROM [WorkforceDB_indexed].[dbo].[withinSLA_PSC_Tickets] "
    */
   $t_total2 = sqlsrv_query($connect,"SELECT sum(BS) t_BS2 ,sum([Mega Projects]) t_Mega2 , sum([Private KAM]) t_Private2,
    
    sum(Banking) t_Banking2, sum([GDS(Global Partner)]) t_GDSglopal2, sum(GOV) t_GOV2 

    FROM [WorkforceDB_indexed].[dbo].[withinSLA_PSC_Tickets] ");
  $act_total = sqlsrv_fetch_array($t_total2);

   
//$t_GDS2 = $act_total['t_GDS2'];
//$t_ICT2 = $act_total['t_ICT2'];
//$t_KAM2 = $act_total['t_KAM2'];
//$t_RESIDENT2 = $act_total['t_RESIDENT2'];
//$t_TAM2 = $act_total['t_TAM2'];
// $t_UNMANAGED2 = $act_total['t_UNMANAGED2'];
//$t_Pvt2 =$act_total['t_Pvt2'];
//$t_GOVPubli2 =$act_total['t_GOVPubli2'];

  $t_BS2 = $act_total['t_BS2'];
  $t_Mega2 =$act_total['t_Mega2'];
  $t_Private2 =$act_total['t_Private2'];
  $t_Banking2 =$act_total['t_Banking2'];
  $t_GDSglopal2 =$act_total['t_GDSglopal2'];
  $t_GOV2 =$act_total['t_GOV2'];
   // 3
  /*
  if ($t_BS > 0 && $t_GDS > 0 && $t_ICT > 0 && $t_KAM > 0 && $t_RESIDENT > 0 && $t_TAM > 0 && 
  $t_Mega > 0  && $t_Private > 0 && $t_Pvt > 0  && $t_Banking > 0 && $t_GDSglopal > 0 && $t_GOV > 0 && $t_GOVPubli > 0 &&
    $t_Mega2 > 0  && $t_Private2 > 0 && $t_Pvt2 > 0  && $t_Banking2 > 0 && $t_GDSglopal2 > 0 && $t_GOV2 > 0 && $t_GOVPubli2 > 0
&& $t_BS2 > 0 && $t_GDS2 > 0 && $t_ICT2 > 0 && $t_KAM2 > 0 && $t_RESIDENT2 > 0 && $t_TAM2 > 0 ){
  */
if ($t_BS > 0 && $t_Mega > 0  && $t_Banking > 0 && $t_GDSglopal > 0 && $t_GOV > 0 && $t_Private > 0 &&
    $t_Mega2 > 0  && $t_Private2 > 0 && $t_Banking2 > 0 && $t_GDSglopal2 > 0 && $t_GOV2 > 0 
&& $t_BS2 > 0 ){
   	 
   //$t_Pvt3 = ($t_Pvt2/$t_Pvt);
   //$t_GDS3 = ($t_GDS2 / $t_GDS) ;
   //$t_ICT3 = ($t_ICT2 / $t_ICT) ;
   //$t_KAM3 = ($t_KAM2 / $t_KAM);
   //$t_RESIDENT3 = ($t_RESIDENT2 / $t_RESIDENT);
   //$t_TAM3 = ($t_TAM2 / $t_TAM);
   //$t_UNMANAGED3 = ($t_UNMANAGED2 / $t_UNMANAGED);
    $t_BS3 = ($t_BS2/ $t_BS);
    $t_Mega3 = ($t_Mega2/ $t_Mega);
    $t_Private3 = ($t_Private2/$t_Private);
    $t_Banking3 = ($t_Banking2/$t_Banking);
    $t_GDSglopal3 = ($t_GDSglopal2/$t_GDSglopal);
    $t_GOV3 = ($t_GOV2/$t_GOV);
    //$t_GOVPubli3 = ($t_GOVPubli2/$t_GOVPubli);
}
if ($t_BS == 0.0 && 
 $t_Mega == 0.0 && $t_Private == 0.0 && $t_Banking == 0.0 && $t_GDSglopal == 0.0 && $t_GOV == 0.0 && 
 $t_Mega2 == 0.0 && $t_Private2 == 0.0 && $t_Banking2 == 0.0 && $t_GDSglopal2 == 0.0 && $t_GOV2 == 0.0 &&
  $t_BS2  == 0.0 ){
  
  echo 'warning';

  }
   ?>

  </tbody>
  <tfoot style="background-color:rgb(120, 120, 120); color: white; font-weight: bold; font-size:25px;">
    
    <tr >
  		<th style="background-color: #002060;font-weight: bold; font-size:25px;">Total</th>
  		<th style="background-color: #002060;"></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_BS;?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_BS2;?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;">
  			<?php echo  floor(($t_BS3)*100).'%'?></th>
  		<!--th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_GDS; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_GDS2; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;">
  			<?php echo  floor(($t_GDS3)*100).'%'; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_ICT; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_ICT2; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  floor(($t_ICT3)*100).'%'; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_KAM; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_KAM2; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  floor(($t_KAM3)*100).'%'; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_RESIDENT; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_RESIDENT2; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  floor(($t_RESIDENT3)*100).'%'; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_TAM; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_TAM2; ?></th>
  		<th style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  floor(($t_TAM3)*100).'%'; ?></th-->

<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_Banking; ?></th>
<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_Banking2; ?></th>
<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  floor(($t_Banking3)*100).'%'; ?></th>


<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_GDSglopal; ?></th>
<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_GDSglopal2; ?></th>
<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  floor(($t_GDSglopal3)*100).'%'; ?></th>

<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_GOV; ?></th>
<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_GOV2; ?></th>
<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  floor(($t_GOV3)*100).'%'; ?></th>

<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_Mega; ?></th>
<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_Mega2; ?></th>
<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  floor(($t_Mega3)*100).'%'; ?></th>


<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_Private; ?></th>
<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  $t_Private2; ?></th>
<th  style="background-color:#6f30a0;color:white;font-size: 15px; font-weight: bold;"><?php echo  floor(($t_Private3)*100).'%'; ?></th>




  	</tr>
  </tfoot>
</table>

</div>
<script type="text/javascript">
  setTimeout(function() {
  document.getElementById("message").style.display = 'none';
}, 1800);
</script>
<script type="text/javascript">
  
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
  
</script>
</form>
<script>
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>


</div>
</body>
</html>

    