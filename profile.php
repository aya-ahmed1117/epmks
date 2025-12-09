<?php
 include ("pages.php");
    
$self = $_SESSION['id'];
$role_id = $_SESSION['role_id'];
$s_username = $_SESSION['username'];
    ?>


	    <title>Employee info</title>

        <link rel="icon" href="imag/logo.jpg">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/bootstrap28js.min.js"></script>
<script src="js/jquery28.min.js"></script>
<link href="css/bootstrap28.min.css.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="css/profilecss.css" >

</head>


<?php

    $self = $_SESSION['id'];

      $s_username = $_SESSION['username'];
$check_engineers = sqlsrv_query( $con1 ," SELECT [tbl_Personal_info].[ID]
      ,[tbl_Personal_info].[Employee_Name]
      ,[tbl_Personal_info].[Employee_Type]
      ,[tbl_Personal_info].[Manager_Name]
      ,[tbl_Personal_info].[Hiring_Date]
      ,[tbl_Personal_info].[Operation_date]
      ,[tbl_Personal_info].[UserName]
      ,[tbl_Personal_info].[Mobile_Number]
      ,[tbl_Personal_info].[E-mail]
      ,[tbl_Personal_info].Address
      ,[tbl_Personal_info].Home_Tel
      ,[tbl_Personal_info].[National_ID]
      ,[tbl_Personal_info].National_ID_Expiration_date
      ,[tbl_Personal_info].[Grade]
      ,[tbl_Personal_info].[Employee_Status]

,datediff (year,[tbl_Personal_info].[Birth_Date],getdate() ) Age
      ,[Tbl_departments].[Department]
      ,[Units]
      ,iif([Groups] is null,'',[Groups]) as 'Group'
      ,[tbl_Personal_info].[Location] Location
      ,[tbl_Personal_info].[Floor] Floor
      ,[EDB].[dbo].[Employess_DB].Education_Qualifications Education_Qualifications
      ,[dbo].[Tbl_Medical].Employee_Medical_ID
      ,[dbo].[Tbl_Computers].ComputerName
      ,[dbo].[Tbl_Computers].Computer_type
      ,[dbo].[Tbl_Computers].[VPN-IP]
      ,[dbo].[Tbl_Computers].[Avaya_Extention]
      ,[dbo].[Tbl_Computers].[Avaya_Soft_hard] 
  FROM [Employess_DB].[dbo].[tbl_Personal_info] 
  left join [dbo].[Tbl_departments] on ([Department_ID]=[tbl_Personal_info].[Department])
  left join [dbo].[Tbl_Units] on ([Units_ID] = Unit)
  left join [dbo].[Tbl_Computers] on ([dbo].[Tbl_Computers].ID = [tbl_Personal_info].[ID])
  left join [dbo].[Tbl_Medical] on ([dbo].[Tbl_Medical].ID = [tbl_Personal_info].[ID])
  left join [EDB].[dbo].[Employess_DB] on ([EDB].[dbo].[Employess_DB].ID = [tbl_Personal_info].[ID])
  left join [dbo].[Tbl_Groups] on ([Group_ID] = [group]) where  [tbl_Personal_info].UserName  = '$s_username' order by 14");

 //SELECT * FROM [Employess_DB].[dbo].[tbl_Personal_info]

  //while( $output_query = sqlsrv_fetch_array($check_engineers)){
  	$output_query = sqlsrv_fetch_array($check_engineers);
  	$myid =$output_query["ID"];
	$myname  =$output_query["Employee_Name"];

	$mytype  =$output_query["Employee_Type"];
	$mymanager  =$output_query["Manager_Name"];

	$myHiring_Date  =$output_query["Hiring_Date"];

	if($output_query["Hiring_Date"] == null){
		echo 'blank';
	}
	else{
	$myHiring_Date  =$output_query["Hiring_Date"]->format('Y-m-d');}

/*
$myOperation_date =$output_query["Operation_date"];
	if($output_query["Operation_date"] == null){
		echo 'blank';
	}
	else{
	$myOperation_date =$output_query["Operation_date"]->format("Y-m-d");}
*/
	$myuser =$output_query["UserName"];
	$myMobile_Number =$output_query["Mobile_Number"];
	$mymail =$output_query["E-mail"];
	$myBirth_Date =$output_query["Age"];
	$myNational_ID =$output_query["National_ID"];

	 $myGrade =$output_query["Grade"];
	 $myEmployee_Status =$output_query["Employee_Status"];
	 $myDepartment =$output_query["Department"];
	 $myUnits =$output_query["Units"];
     $myGroup =$output_query["Group"];

     $Location =$output_query["Location"];
     $Floor =$output_query["Floor"];
     $Education_Qualifications =$output_query["Education_Qualifications"];
     $Employee_Medical_ID =$output_query["Employee_Medical_ID"];
     $ComputerName =$output_query["ComputerName"];
     $Computer_type =$output_query["Computer_type"];
     $VPNIP =$output_query["VPN-IP"];
     $Avaya_Extention =$output_query["Avaya_Extention"];
	 $Avaya_Soft_hard =$output_query["Avaya_Soft_hard"];
 


?>


<div class="container emp-profile">
            <form method="post"  onsubmit="return compare()">
                <div class="row">
               
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        <?php echo $myname;?>
                                    </h5>
                                    <h6>
                                        <?php echo $myUnits;?>
                                    </h6>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">More info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="true">More info 2</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">

                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $myid;  ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>UserName</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $myuser ;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Mobile</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $myMobile_Number ;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $mymail ;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Type</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $mytype;?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Manager Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $mymanager;?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label> Group</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $myGroup;?></p>
                                            </div>
                                        </div>

                                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <!--div class="row">
                                            <div class="col-md-6">
                                                <label>my manager</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $mymanager;?></p>
                                            </div>
                                        </div-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label> Hiring Date</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $myHiring_Date;?></p>
                                            </div>
                                        </div>
                                        <!--div class="row">
                                            <div class="col-md-6">
                                                <label> Operation date</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $myOperation_date;?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>English Level</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $myuser;?></p>
                                            </div>
                                        </div-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Age</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $myBirth_Date;?></p>
                                            </div>
                                        </div>
                                <div class="row">
                                            <div class="col-md-6">
                                        <label> National ID</label>
                                        </div>
                                            <div class="col-md-6">
                                        <p><?php echo $myNational_ID;?></p>
                                    </div>
                                     </div>

                                    <div class="row">
                                            <div class="col-md-6">
                                        <label> Grade</label>
                                        </div>
                                            <div class="col-md-6">
                                        <p><?php echo $myGrade;?></p>
                                    </div>
                                     </div>

                                 
                                     <div class="row">
                                            <div class="col-md-6">
                                        <label> Department</label>
                                        </div>
                                            <div class="col-md-6">
                                        <p><?php echo $myDepartment;?></p>
                                    </div>
                                     </div>

<div class="row">
        <div class="col-md-6">
    <label> Location</label>
    </div>
        <div class="col-md-6">
    <p><?php echo $Location;?></p>
</div>
 </div>

<div class="row">
        <div class="col-md-6">
    <label> Floor</label>
    </div>
        <div class="col-md-6">
    <p><?php echo $Floor;?></p>
</div>
 </div>

 
     
                              
                                </div>
                                <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab">

 <div class="row">
        <div class="col-md-6">
    <label> Education_Qualifications</label>
    </div>
        <div class="col-md-6">
    <p><?php echo $Education_Qualifications;?></p>
</div>
 </div>

 <div class="row">
        <div class="col-md-6">
    <label> Employee_Medical_ID</label>
    </div>
        <div class="col-md-6">
    <p><?php echo $Employee_Medical_ID;?></p>
</div>
 </div>

 <div class="row">
        <div class="col-md-6">
    <label> ComputerName</label>
    </div>
        <div class="col-md-6">
    <p><?php echo $ComputerName;?></p>
</div>
 </div>


 <div class="row">
        <div class="col-md-6">
    <label> Computer_type</label>
    </div>
        <div class="col-md-6">
    <p><?php echo $Computer_type;?></p>
</div>
 </div>

<div class="row">
        <div class="col-md-6">
    <label> VPN-IP</label>
    </div>
        <div class="col-md-6">
    <p><?php echo $VPNIP;?></p>
</div>
 </div>

 <div class="row">
        <div class="col-md-6">
    <label> Avaya_Extention</label>
    </div>
        <div class="col-md-6">
    <p><?php echo $Avaya_Extention;?></p>
</div>
 </div>


 <div class="row">
        <div class="col-md-6">
    <label>Avaya_Soft_hard </label>
    </div>
        <div class="col-md-6">
    <p><?php echo $myDepartment;?></p>
</div>
 </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </form>           
        </div>
 <?php
 include ("footer.html");
 ?>