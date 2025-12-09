<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Table Header</title>
   
</head>
<body>
    <?php
    $selec_group = isset($_POST['Group_Name']) ? $_POST['Group_Name'] : '';

    if(($role_id == 1)|| ($role_id >= 3)){ ?>
        <form method="post">
    <div class="row">
        <!-- Group Selection -->
        <div class="col-md-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="group-addon"><i class="fas fa-user-tie"></i> Select Group</span>
                <select class="form-control" required id="Group_Name" name="Group_Name">
                    <option value="" selected>Select Group</option>
                    <?php
                    $checks = sqlsrv_query($connect, "SELECT DISTINCT Group_Name FROM [WorkForce_Reporting_DB].[dbo].[KPI_target_2024]");
                    while($outputs = sqlsrv_fetch_array($checks)) {
                        $selected = (isset($_POST['Group_Name']) && $_POST['Group_Name'] == $outputs['Group_Name']) ? 'selected' : '';
                        echo '<option value="'.$outputs['Group_Name'].'" '.$selected.'>'.$outputs['Group_Name'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Month Selection -->
        <div class="col-md-6">
            <div class="input-group mb-3">
                <span class="input-group-text" id="month-addon">Choose Month</span>
                <input name="month" type="month" required id="month" class="form-control" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-md-12">
            <button class="btn btn-primary w-100" type="submit" name="submit" value="Get data">
                <i class="fa fa-check"></i> Submit
            </button>
        </div>
    </div>
</form>

       <!--
            <div class="row">
    <div class="col col-md-6">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><samp><i class="fas fa-user-tie"></i>Select Group</samp></span>
            <select id="input2-group2" class="form-control"required id="Group_Name" name="Group_Name">
                <option value="<?php if(isset($_POST['Group_Name'])) echo $_POST['Group_Name']; ?>"selected>Select Group</option>
                <?php if(!(empty($selec_group))){?>
                <option disabled="true" value=""><?php if(isset($_POST['Group_Name'])) echo $_POST['Group_Name']; ?></option>
            <?php }?>
                <?php
                $checks = sqlsrv_query($connect, "SELECT DISTINCT Group_Name FROM [WorkForce_Reporting_DB].[dbo].[KPI_target_2024]");
                while($outputs = sqlsrv_fetch_array($checks)) {
                    echo '<option value="'.$outputs['Group_Name'].'">'.$outputs['Group_Name'].'</option>';
                }
                ?>
            </select>
        </div>
    </div>

    <div class="col col-md-6">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1">Choose Month</span>
            <input name="month" type="month" required id="month" class="form-control" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
        </div>
    </div>
    <br>

    <div class="col-md-12">
    <button class="btn btn-primary w-100" type="submit" name="submit" value="Get data">
        <i class="fa fa-check"></i> Submit
    </button>
</div>
</form>
 -->    <div class="tableFixHead2">
        <table class="table order-table" cellspacing="0" id="tblCustomers2">
              
            <tbody>
            <?php
            $selec_group = '';
            $username = $_SESSION['username'];
             $target = sqlsrv_query($connect , "SELECT * from[WorkForce_Reporting_DB].[dbo].[KPI_target_2024] ");
             while($result = sqlsrv_fetch_array($target)){
                $TAM_u_d = round(($result["utilization_without_Resident_TAM_day"])*100,1).'%';
                $TAM_util_day = round(($result["TAM_utilization_day"])*100,1).'%';
                $Abs = floor(($result["Absenteeism"])*100).'%';
                $MTTI = floor(($result["MTTI %"])*100).'%';
                $MTTV = floor(($result["MTTV %"])*100).'%';
                $MTTR_ESP = floor(($result["MTTR_ESP %"])*100).'%';
                $MTTR_Log = floor(($result["MTTR_Logical %"])*100).'%';
                $MTTR_Glo = floor(($result["MTTR_Global %"])*100).'%';
                $MTTR_Phy = floor(($result["MTTR_Physical %"])*100).'%';
                $MTTR_Reque = floor(($result["MTTR_Request %"])*100).'%';
                $AHT_vio_E = round(($result["AHT_violation_ESP %"])*100,1).'%';
                $AHT_vio_lo= round(($result["AHT_violation_logical %"])*100,1).'%';
                $AHT_vio_yes=round(($result["AHT_violation_Phy_yes_onsite %"])*100,1).'%';
                $AHT_vio_no =round(($result["AHT_violation_Phy_no_onsite %"])*100,1).'%';
                $AHT_vio_Req = round(($result["AHT_violation_Request %"])*100,1).'%';
                $AHT_vio_Gl = round(($result["AHT_violation_Global %"])*100,1).'%';
                $AVG_R_Ti = $result["AVG_Ring_Time %"].'%';
                $AVG_C_Ti = floor(($result["AVG_Call_Time %"])*100).'%';
                $AVG_H_Ti = $result["AVG_Hold_Time %"];
                $Aban = floor(($result["Aban %"])*100).'%';
                $AVG_Hold = floor(($result["AVG_Hold_By_Eng %"])*100).'%';
                $p1 = floor(($result["P1 %"])*100).'%';
                $p2 = floor(($result["P2 %"])*100).'%';

             }

             if (isset($_POST['submit'])) {
        

   /* if(isset($_POST['submit'])){*/
        $selec_group = isset($_POST['Group_Name']) ? $_POST['Group_Name'] : '';
        $myMonth = isset($_POST['month']) ? $_POST['month'] : '';

        $newMonth = $myMonth ? date('n', strtotime($myMonth)) : '';
        $this_year = $myMonth ? date('Y', strtotime($myMonth)) : '';

        //$target = "SELECT * FROM [WorkForce_Reporting_DB].[dbo].[KPI_target_2024] WHERE ";

        if (!empty($selec_group)) {
            $target = sqlsrv_query($connect , "SELECT * FROM [WorkForce_Reporting_DB].[dbo].[KPI_target_2024] WHERE [Group_Name] = '$selec_group'");
        }

        if (!empty($newMonth) && !empty($this_year)) {

             $results = sqlsrv_query($connect , "SELECT DISTINCT *  FROM
                [WorkForce_Reporting_DB].[dbo].[SD_Kpi_2024] 
                where [MONTH] ='$newMonth' and [YEAR] >=$this_year");
          
        }

        // if(isset($_POST['Group_Name'])){$selec_group = $_POST['Group_Name'];}



        // $target = sqlsrv_query($connect , "SELECT * from[WorkForce_Reporting_DB].[dbo].[KPI_target_2024] 
        // where Group_Name ='$selec_group'");

        
           while($result = sqlsrv_fetch_array($target)){
                $TAM_u_d = round(($result["utilization_without_Resident_TAM_day"])*100,1).'%';
                $TAM_util_day = round(($result["TAM_utilization_day"])*100,1).'%';
                $Abs = floor(($result["Absenteeism"])*100).'%';
                $MTTI = floor(($result["MTTI %"])*100).'%';
                $MTTV = floor(($result["MTTV %"])*100).'%';
                $MTTR_ESP = floor(($result["MTTR_ESP %"])*100).'%';
                $MTTR_Log = floor(($result["MTTR_Logical %"])*100).'%';
                $MTTR_Glo = floor(($result["MTTR_Global %"])*100).'%';
                $MTTR_Phy = floor(($result["MTTR_Physical %"])*100).'%';
                $MTTR_Reque = floor(($result["MTTR_Request %"])*100).'%';
                $AHT_vio_E = round(($result["AHT_violation_ESP %"])*100,1).'%';
                $AHT_vio_lo= round(($result["AHT_violation_logical %"])*100,1).'%';
                $AHT_vio_yes=round(($result["AHT_violation_Phy_yes_onsite %"])*100,1).'%';
                $AHT_vio_no =round(($result["AHT_violation_Phy_no_onsite %"])*100,1).'%';
                $AHT_vio_Req = round(($result["AHT_violation_Request %"])*100,1).'%';
                $AHT_vio_Gl = round(($result["AHT_violation_Global %"])*100,1).'%';
                $AVG_R_Ti = $result["AVG_Ring_Time %"];
                $AVG_C_Ti = floor(($result["AVG_Call_Time %"])*100);
                $AVG_H_Ti = floor($result["AVG_Hold_Time %"]);
                $Aban = floor($result["Aban %"]).'%';
                $AVG_Hold = $result["AVG_Hold_By_Eng %"];
                $p1 = floor(($result["P1 %"])*100).'%';
                $p2 = floor(($result["P2 %"])*100).'%';
        
         }
     }
 }

        ?>
            </tbody>
        </table>
    </div>



</body>
</html>
