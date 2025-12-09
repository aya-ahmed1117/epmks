

<?php 
require_once("inc/config.inc"); // Include your database connection
// Initialize variables with default values to prevent 'undefined' notices
$Request_Type = isset($_POST['Request_Type']) ? $_POST['Request_Type'] : '';
$Ticket_Subject = isset($_POST['Ticket_Subject']) ? $_POST['Ticket_Subject'] : '';
$Note = isset($_POST['Note']) ? str_replace("'", "`", $_POST['Note']) : '';
$Request_status = isset($_POST['Request_status']) ? $_POST['Request_status'] : '';
$Employee_Username = isset($_POST['Employee_Username']) ? $_POST['Employee_Username'] : '';
$Last_working_date = isset($_POST['Last_working_date']) ? $_POST['Last_working_date'] : '';
$Employee_new_username = isset($_POST['Employee_new_username']) ? $_POST['Employee_new_username'] : '';
$Employee_new_id = isset($_POST['Employee_new_id']) ? $_POST['Employee_new_id'] : '';
$Employee_new_manager = isset($_POST['Employee_new_manager']) ? $_POST['Employee_new_manager'] : '';
$Reason_of_leave = isset($_POST['Reason_of_leave']) ? $_POST['Reason_of_leave'] : '';
$Employee_grade = isset($_POST['Employee_grade']) ? $_POST['Employee_grade'] : '';
$sub_group = isset($_POST['sub_group']) ? $_POST['sub_group'] : '';
include ("pages.php");
   $unit = $_SESSION['Unit_Name'];
// Set default value for $Request_Type
$Request_Type = isset($_POST['Request_Type']) ? $_POST['Request_Type'] : '';

?>
  <title>Ticketing System </title>
  
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/my_table.css">
    </head>

<!-- //choose_uusers -->
  <div  class="input-group"  id="inputGroupSelect01div">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-choose"></i> Choose your type</samp></span>
  <select name="Request_Type" required class="form-control" id="Request_Type">
  <option value="0"  selected>Select..</option>
   <option value="Change Management">Change Management</option>
    <option value="Change from OutSource to Staff">Change from OutSource to Staff</option>
    <option value="Resign employees">Resign employees</option>
    <option value="Employee Promotion">Employee Promotion</option>
    <option value="Delete recored">Delete recored</option>
    <?php if($_SESSION['role_id'] >= 1){
      echo '<option value="Change sub_group">Change sub group</option>';

    }
      ?>
</select>
</div>

  <div class="input-group sm-5" id="Last_working_date"> 
    <span class="input-group-text" id="basic-addon1">
      <samp><i class="fa fa-stopwatch"></i> Last Working date</samp></span>
    <input type="date" min="<?php $tomorrow 
        = date("Y-m-d", strtotime("0 day"));
                  echo $tomorrow; ?>" class="form-control cur_date" name="Last_working_date" placeholder="Choose date"  id="adate"
      aria-describedby="basic-addon1"/>
  </div>


<div  class="input-group" id="Employee_Username">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-users"></i> Username</samp></span>
  <select class="form-control"   name="Employee_Username">
  <option action="none" value="0" selected>Select....</option>
  <?php
//role_id != 1 and
if($_SESSION['role_id'] == 1){
$checks = sqlsrv_query( $con ,"SELECT * FROM employee
  left join [Employess_DB].[dbo].[tbl_Personal_info]
  on [Employess_DB].[dbo].[tbl_Personal_info].UserName=
  employee.username
  WHERE role_id = 0 and Employee_Status <>'Resigned'");
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
    $rows .= $output['id'] == $outputs['id'] ? "selected" : "";;
    $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  
  echo $rows;}
	}
	?> 
	<?php

//role_id != 1 and
if($_SESSION['role_id'] == 2){
  
$checks = sqlsrv_query( $con ,"SELECT * from  employee where role_id != 1 and  manager_id = '$aya' and username <> '$s_username'");


  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
    $rows .= $output['id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  
  echo $rows;}}
?> 
<?php
if($_SESSION['role_id'] > 2){

$checks = sqlsrv_query( $con ,"SELECT * from  employee where role_id != 1 and [Unit_Name] ='$unit' and username <> '$s_username'  order by username   ");
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
    $rows .= $output['id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  echo $rows;}}
?> 
</select>
</div>


  <!-- Checkbox to confirm action -->
<div id="checkboxDiv" style="display:none;">
  <input type="checkbox" id="checkbox"> I confirm my request
  <a href="#">HR rules</a>
</div>


<div>
<a  href="?done">
  <button type="submit" id="submit" class="btn btn-warning submit"  name="save" style="width: 30%;padding: 10px;color: #fff;font-size: 15px; border-radius: 20px 20px 20px 20px;" >Submit Ticket</button>
</a>
</div>

<script type="text/javascript">
$(document).ready(function() {
    // Trigger AJAX call when Employee Username field changes
    $('select[name="Employee_Username"]').on('change', function() {
        var requestType = $('#Request_Type').val();  // Get the value of Request_Type
        var employeeUsername = $(this).val(); // Get the employee username

        if (requestType === "Resign employees") {
            $("#submit").hide();
            $("#checkboxDiv").hide();

            $.ajax({
			    url: 'check_employee.php',  // Path to the PHP script
			    type: 'POST',
			    data: { Employee_Username: employeeUsername },
			    success: function(data) {
		        // Now output the PHP result returned by check_employee.php
		        console.log(data);  // This will log the result returned by check_employee.php
		        
        // Check if the response is 'nothing'
        if (data.trim() === 'nothing') {
            // If response is 'nothing', show the submit button
            $("#submit").show();
            $("#checkboxDiv").hide(); // Hide the checkbox
        } else {
            // If employee exists as outsourced, show the checkbox and hide submit
            $("#checkboxDiv").show();
            $("#submit").hide();

            // Event to handle checkbox change
            $("#checkbox").on("change", function() {
                if ($(this).is(":checked")) {
                    // Show submit button if checkbox is checked
                    $("#submit").show();
                } else {
                    // Hide submit button if checkbox is unchecked
                    $("#submit").hide();
                }
            });

            //alert("Employee already exists as an outsourced employee.");
        }
    },
    error: function() {
        alert("An error occurred while checking the employee status.");
    }
		});

        }
    });
});
</script>

<!-- <script>
    $(document).ready(function() {
        // Initially hide the submit button and checkbox
       

        // Trigger AJAX call when Employee Username field changes
        $('#Employee_Username').on('change', function() {
            // Only execute if Request_Type is "Resign employees"
            var requestType = $('#Request_Type').val(); // Get the value of Request_Type
            var employeeUsername = $(this).val(); // Get the employee username

            if (requestType === "Resign employees") {
              $("#submit").hide();
              $("#checkboxDiv").hide();
                $.ajax({
                    url: 'check_employee.php',  // Path to the PHP script
                    type: 'POST',
                    data: { Employee_Username: employeeUsername },
                    success: function(data) {
                      console.log(<?php echo $results;?>);

                        // Check if response is 'nothing'
                        if ($results == 'nothing') {
                            // If response is 'nothing', show the submit button
                            $("#submit").show();
                            $("#checkboxDiv").hide(); // Hide the checkbox
                        } else {
                            // If employee exists as outsourced, show the checkbox and hide submit
                            $("#checkboxDiv").show();
                            $("#submit").hide();

                            // Event to handle checkbox change
                            $("#checkbox").on("change", function() {
                                if ($(this).is(":checked")) {
                                    // Show submit button if checkbox is checked
                                    $("#submit").show();
                                } else {
                                    // Hide submit button if checkbox is unchecked
                                    $("#submit").hide();
                                }
                            });

                            alert("Employee already exists as an outsourced employee.");
                        }
                    },
                    error: function() {
                        alert("An error occurred while checking the employee status.");
                    }
                });
            }
        });
    });
</script>
 -->
<script>


  if($('#Request_Type').value = "undefined")
  {
    $('#Employee_Username').hide();
    $('#Last_working_date').hide(); 
    $('#Employee_new_username').hide();
    $('#Employee_new_id').hide();
    $('#Employee_new_manager').hide();
    $('#Reason_of_leave').hide();
    $('#Employee_grade').hide();
    $('#upload').hide();
    $('#sub_group').hide();



  }
  $('#Request_Type').on('change' , function(){
    //alert(this.value);
    if(this.value == "Change Management"){

      $('#Employee_Username').show();
      $('#Last_working_date').show();
      $('#Employee_new_manager').show();
      
      $('#Employee_new_username').hide();
      $('#Employee_new_id').hide();
      $('#Reason_of_leave').hide();
      $('#Employee_grade').hide();
      $('#upload').hide();
      $('#sub_group').hide();
    }      
else if(this.value == "Resign employees"){

        $('#Employee_Username').show();
        $('#Last_working_date').show();
        $('#Reason_of_leave').show();

        // Show alert when 'Annual Leave' is selected
        //alert("You have to conferm on attachment.");
        
        

        $('#Employee_new_username').hide();
        $('#Employee_new_id').hide();
        $('#Employee_new_manager').hide();
        $('#Employee_grade').hide();
        $('#upload').hide();
        $('#sub_group').hide();
    }
 else if(this.value == "Change from OutSource to Staff"){

        $('#Employee_Username').show();
        $('#Last_working_date').show();
        $('#Employee_new_username').show();
        $('#Employee_new_id').show();
        $('#Employee_new_manager').hide();
        $('#Reason_of_leave').hide();
        $('#Employee_grade').hide();
        $('#upload').hide();
        $('#sub_group').hide();
    }

else if(this.value == "Employee Promotion"){

        $('#Employee_Username').show();
        $('#Last_working_date').show();
        $('#Employee_grade').show();
        $('#Employee_new_username').hide();
        $('#Employee_new_id').hide();
        $('#Employee_new_manager').hide();
        $('#Reason_of_leave').hide();
        $('#upload').hide();
    }

     else if(this.value == "Change sub_group"){

      $('#Employee_Username').show();
      $('#Last_working_date').show();
      $('#sub_group').show();
      
      $('#Employee_new_username').hide();
      $('#Employee_new_id').hide();
      $('#Reason_of_leave').hide();
      $('#Employee_grade').hide();
      $('#upload').hide();
    } 

//
else if(this.value == "Change schedule"){
        $('#upload').show();

        $('#Employee_Username').hide();
        $('#Last_working_date').hide();
        $('#Employee_grade').hide();
        $('#Employee_new_username').hide();
        $('#Employee_new_id').hide();
        $('#Employee_new_manager').hide();
        $('#Reason_of_leave').hide();
        $('#sub_group').hide();
    }

//upload
    else
    {
      $('#Employee_Username').hide();
      $('#Last_working_date').hide(); 
      $('#Employee_new_username').hide();
      $('#Employee_new_id').hide();
      $('#Employee_new_manager').hide();
      $('#Reason_of_leave').hide();
      $('#Employee_grade').hide();
      $('#upload').hide();
      $('#sub_group').hide();
      //
      $('#checkboxDiv').hide(); // Hide checkbox
      //$('#submit').show(); // Always show submit button when not Resign.
    }
    

});
</script>

