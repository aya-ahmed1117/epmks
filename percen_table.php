<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Table Header</title>
</head>
<body>

    <?php
    if(($role_id == 1)|| ($role_id >= 3)){
    // if(($_SESSION['username'] == 'ahmed.mohamedbassal') || 
    //         ($_SESSION['username'] == 'Yasmeen.soltan') || ($role_id == 1)
    //     ||($_SESSION['username'] == 'ahmed.akef')){

                    ?>
                <form method="post" >
<div class="col col-md-6">
        <div class="input-group">
<div  class="input-group"  id="Group_Name">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fas fa-user-tie"></i>Select Group</samp></span>
  <select id="input2-group2"
class="form-control" name="Group_Name" >
  <option action="none" value="0" selected>Select..</option>
    <?php
    // if(($_SESSION['username'] == 'ahmed.mohamedbassal') || 
    //         ($_SESSION['username'] == 'Yasmeen.soltan') ){
                $checks = sqlsrv_query($connect , "SELECT * from[WorkForce_Reporting_DB].[dbo].[KPI_Percent_2024] 
               ");
    //     }

    //             if(($role_id == 1)|| ($_SESSION['username'] == 'ahmed.akef')){
    //                 $checks = sqlsrv_query($connect , "SELECT * from[WorkForce_Reporting_DB].[dbo].[KPI_Percent_2024]");}
  
          while($outputs = sqlsrv_fetch_array($checks)){
            $Group_Name = $outputs['Group_Name'];
                $rows = '<option ';
                $rows .= $output['Group_Name'] == $outputs['Group_Name'] ? "selected" : " ";;
                $rows .= ' value="'.$outputs['Group_Name'].'">'.$outputs['Group_Name'].'</option>';
          echo $rows;
}

  ?>
</select>

        <div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
        </div>
    </div>
</div>
</form>
  <?php //}   ?>
    <div class="tableFixHead2">
        <table class="table order-table" cellspacing="0" id="tblCustomers2">
            <tbody> 
    <?php
   //   $username = $_SESSION['username'];
   // //in ('Private KAM','GDS(Global Partner)')
   //   if(($_SESSION['username'] == 'ahmed.mohamedbassal') || 
   //      ($_SESSION['username'] == 'Yasmeen.soltan') || ($role_id == 1)||($_SESSION['username'] == 'ahmed.akef') ){

    $selec_group = '';
    $result = sqlsrv_query($connect , "SELECT * from[WorkForce_Reporting_DB].[dbo].[KPI_Percent_2024] 
            where Group_Name like'$Group_Name%'");
    while($Percent = sqlsrv_fetch_array($result)){

        $TAM_u_d = round(($Percent["TAM_utilization_day"])*100,1).'%';
        $Abs = floor(($Percent["Absenteeism"])*100).'%';
        $MTTI = floor(($Percent["MTTI %"])*100).'%';
        $MTTV = floor(($Percent["MTTV %"])*100).'%';
        $MTTR_ESP = floor(($Percent["MTTR_ESP %"])*100).'%';
        $MTTR_Log = floor(($Percent["MTTR_Logical %"])*100).'%';
        $MTTR_Glo = floor(($Percent["MTTR_Global %"])*100).'%';
        $MTTR_Phy = floor(($Percent["MTTR_Physical %"])*100).'%';
        $MTTR_Reque = floor(($Percent["MTTR_Request %"])*100).'%';
        $AHT_vio_E = round(($Percent["AHT_violation_ESP %"])*100,1).'%';
        $AHT_vio_lo = round(($Percent["AHT_violation_logical %"])*100,1).'%';
        $AHT_vio_yes = round(($Percent["AHT_violation_Phy_yes_onsite %"])*100,1).'%';
        $AHT_vio_no = round(($Percent["AHT_violation__Phy_no_onsite %"])*100,1).'%';
        $AHT_vio_Req = round(($Percent["AHT_violation_Request %"])*100,1).'%';
        $AHT_vio_Gl = round(($Percent["AHT_violation_Global %"])*100,1).'%';
        $AVG_R_Ti = floor(($Percent["AVG_Ring_Time %"])*100).'%';
        $AVG_C_Ti = floor(($Percent["AVG_Call_Time "])*100).'%';
        $AVG_H_Ti = floor(($Percent["AVG_Hold_Time %"])*100).'%';
        $Aban = floor(($Percent["Aban % "])*100).'%';
        $AVG_Hold = floor(($Percent["AVG_Hold_By_Eng %"])*100).'%';
        $p1 = floor(($Percent["P1 %"])*100).'%';
        $p2 = floor(($Percent["P2 %"])*100).'%';
             }

    if(isset($_POST['submit'])){
        if(isset($_POST['Group_Name'])){$selec_group = $_POST['Group_Name'];}

        $result = sqlsrv_query($connect , "SELECT * from[WorkForce_Reporting_DB].[dbo].[KPI_Percent_2024] 
        where Group_Name ='$selec_group'");
                
        while($Percent = sqlsrv_fetch_array($result)){

        $TAM_u_d = round(($Percent["TAM_utilization_day"])*100,1).'%';
        $Abs = floor(($Percent["Absenteeism"])*100).'%';
        $MTTI = floor(($Percent["MTTI %"])*100).'%';
        $MTTV = floor(($Percent["MTTV %"])*100).'%';
        $MTTR_ESP = floor(($Percent["MTTR_ESP %"])*100).'%';
        $MTTR_Log = floor(($Percent["MTTR_Logical %"])*100).'%';
        $MTTR_Glo = floor(($Percent["MTTR_Global %"])*100).'%';
        $MTTR_Phy = floor(($Percent["MTTR_Physical %"])*100).'%';
        $MTTR_Reque = floor(($Percent["MTTR_Request %"])*100).'%';
        $AHT_vio_E = round(($Percent["AHT_violation_ESP %"])*100,1).'%';
        $AHT_vio_lo = round(($Percent["AHT_violation_logical %"])*100,1).'%';
        $AHT_vio_yes = round(($Percent["AHT_violation_Phy_yes_onsite %"])*100,1).'%';
        $AHT_vio_no = round(($Percent["AHT_violation__Phy_no_onsite %"])*100,1).'%';
        $AHT_vio_Req = round(($Percent["AHT_violation_Request %"])*100,1).'%';
        $AHT_vio_Gl = round(($Percent["AHT_violation_Global %"])*100,1).'%';
        $AVG_R_Ti = floor(($Percent["AVG_Ring_Time %"])*100).'%';
        $AVG_C_Ti = floor(($Percent["AVG_Call_Time "])*100).'%';
        $AVG_H_Ti = floor(($Percent["AVG_Hold_Time %"])*100).'%';
        $Aban = floor(($Percent["Aban % "])*100).'%';
        $AVG_Hold = floor(($Percent["AVG_Hold_By_Eng %"])*100).'%';
        $p1 = floor(($Percent["P1 %"])*100).'%';
        $p2 = floor(($Percent["P2 %"])*100).'%';
       }
      }
     }
         /*else{
            $result = sqlsrv_query($connect , "SELECT * from[WorkForce_Reporting_DB].[dbo].[KPI_Percent_2024] 
        where Group_Name='$my_group'");

        while($Percent = sqlsrv_fetch_array($result)){
        $TAM_u_d = floor(($Percent["TAM_utilization_day"])*100).'%';
        $Abs = floor(($Percent["Absenteeism"])*100).'%';
        $MTTI = floor(($Percent["MTTI %"])*100).'%';
        $MTTV = floor(($Percent["MTTV %"])*100).'%';
        $MTTR_ESP = floor(($Percent["MTTR_ESP %"])*100).'%';
        $MTTR_Log = floor(($Percent["MTTR_Logical %"])*100).'%';
        $MTTR_Glo = floor(($Percent["MTTR_Global %"])*100).'%';
        $MTTR_Phy = floor(($Percent["MTTR_Physical %"])*100).'%';
        $MTTR_Reque = floor(($Percent["MTTR_Request %"])*100).'%';
        $AHT_vio_E = floor(($Percent["AHT_violation_ESP %"])*100).'%';
        $AHT_vio_lo = floor(($Percent["AHT_violation_logical %"])*100).'%';
        $AHT_vio_yes = floor(($Percent["AHT_violation_Phy_yes_onsite %"])*100).'%';
        $AHT_vio_no = floor(($Percent["AHT_violation__Phy_no_onsite %"])*100).'%';
        $AHT_vio_Req = floor(($Percent["AHT_violation_Request %"])*100).'%';
        $AHT_vio_Gl = floor(($Percent["AHT_violation_Global %"])*100).'%';
        $AVG_R_Ti = floor(($Percent["AVG_Ring_Time %"])*100).'%';
        $AVG_C_Ti = floor(($Percent["AVG_Call_Time "])*100).'%';
        $AVG_H_Ti = floor(($Percent["AVG_Hold_Time %"])*100).'%';
        $Aban = floor(($Percent["Aban % "])*100).'%';
        $AVG_Hold = floor(($Percent["AVG_Hold_By_Eng %"])*100).'%';
        $p1 = floor(($Percent["P1 %"])*100).'%';
        $p2 = floor(($Percent["P2 %"])*100).'%';
        // $rows  ='<tr>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$Percent["Group_Name"].'</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["TAM_utilization_day"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["Absenteeism"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["MTTI %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["MTTV %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["MTTR_ESP %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["MTTR_Logical %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$Percent["MTTR_Global %"].'</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["MTTR_Physical %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["MTTR_Request %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["AHT_violation_ESP %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["AHT_violation_logical %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["AHT_violation_Global %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["AHT_violation_Phy_yes_onsite %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["AHT_violation__Phy_no_onsite %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["AHT_violation_Request %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["AVG_Ring_Time %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$Percent["AVG_Call_Time "].'</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["AVG_Hold_Time %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["Aban % "])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["AVG_Hold_By_Eng %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["P1 %"])*100).'%</td>';
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($Percent["P2 %"])*100).'%</td>';
         
        //  $rows .='</tr>';
             }*/
         //         }
         //     }
         // }

        ?>
            </tbody>
        </table>
    </div>
</body>
</html>
