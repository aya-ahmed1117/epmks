  <?php  
 //fetch.php  
 /*$connect = mysqli_connect("localhost", "root", "", "testing");  
 if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT * FROM tbl_employee WHERE id = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }
*/
 $first_query = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE username ='$s_username' and id ='".$_POST["id"]."'   and
 ([status] = 'senior reject' or [status] ='' or [status] = 'E-workforce reject'  or [status] is null)");
   echo json_encode($rows);

   echo "SELECT * FROM deduction WHERE username ='$s_username' and id ='".$_POST["id"]."'   and
 ([status] = 'senior reject' or [status] ='' or [status] = 'E-workforce reject'  or [status] is null)";
 ?>



**************
  <?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "testing");  
 if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT * FROM tbl_employee WHERE id = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
 

insert.php

 
  <?php  
 $connect = mysqli_connect("localhost", "root", "", "testing");  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $name = mysqli_real_escape_string($connect, $_POST["name"]);  
      $address = mysqli_real_escape_string($connect, $_POST["address"]);  
      $gender = mysqli_real_escape_string($connect, $_POST["gender"]);  
      $designation = mysqli_real_escape_string($connect, $_POST["designation"]);  
      $age = mysqli_real_escape_string($connect, $_POST["age"]);  
      if($_POST["employee_id"] != '')  
      {  
           $query = "  
           UPDATE tbl_employee   
           SET name='$name',   
           address='$address',   
           gender='$gender',   
           designation = '$designation',   
           age = '$age'   
           WHERE id='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  
           INSERT INTO tbl_employee(name, address, gender, designation, age)  
           VALUES('$name', '$address', '$gender', '$designation', '$age');  
           ";  
           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM tbl_employee ORDER BY id DESC";  
           $result = mysqli_query($connect, $select_query);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="70%">Employee Name</th>  
                          <th width="15%">Edit</th>  
                          <th width="15%">View</th>  
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>' . $row["name"] . '</td>  
                          <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      }  
      echo $output;  
 } 


 /*
 <html><head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>DataTables</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js" datatables=""></script>
    <link rel="stylesheet" type="text/css" href="/css/normalize.css">
    <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="/css/result-light.css">

      <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.0/css/jquery.dataTables.css">
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.0.0/js/dataTables.rowReorder.js"></script>
      <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/rowreorder/1.0.0/css/rowReorder.dataTables.css">

  <style id="compiled-css" type="text/css">
      
    /* EOS */
  </style>

  <script id="insert"></script>


    <script src="/js/stringify.js?512d8e4cdb707dc1d3c1fef01ecde885570a61fd" charset="utf-8"></script>
    <script>
      const customConsole = (w) => {
        const pushToConsole = (payload, type) => {
          w.parent.postMessage({
            console: {
              payload: stringify(payload),
              type:    type
            }
          }, "*")
        }

        w.onerror = (message, url, line, column) => {
          // the line needs to correspond with the editor panel
          // unfortunately this number needs to be altered every time this view is changed
          line = line - 70
          if (line < 0){
            pushToConsole(message, "error")
          } else {
            pushToConsole(`[${line}:${column}] ${message}`, "error")
          }
        }

        let console = (function(systemConsole){
          return {
            log: function(){
              let args = Array.from(arguments)
              pushToConsole(args, "log")
              systemConsole.log.apply(this, args)
            },
            info: function(){
              let args = Array.from(arguments)
              pushToConsole(args, "info")
              systemConsole.info.apply(this, args)
            },
            warn: function(){
              let args = Array.from(arguments)
              pushToConsole(args, "warn")
              systemConsole.warn.apply(this, args)
            },
            error: function(){
              let args = Array.from(arguments)
              pushToConsole(args, "error")
              systemConsole.error.apply(this, args)
            },
            system: function(arg){
              pushToConsole(arg, "system")
            },
            clear: function(){
              systemConsole.clear.apply(this, {})
            },
            time: function(){
              let args = Array.from(arguments)
              systemConsole.time.apply(this, args)
            },
            assert: function(assertion, label){
              if (!assertion){
                pushToConsole(label, "log")
              }

              let args = Array.from(arguments)
              systemConsole.assert.apply(this, args)
            }
          }
        }(window.console))

        window.console = { ...window.console, ...console }

        console.system("Running fiddle")
      }

      if (window.parent){
        customConsole(window)
      }
    </script>
</head>
<body>
    <div id="example_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="example_length"><label>Show <select name="example_length" aria-controls="example" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="example">
    </label>
  </div>
    <table id="example" class="dataTable no-footer" role="grid" aria-describedby="example_info">
        <thead>
            <tr role="row">
              <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="date: activate to sort column descending">date</th>
            </tr>
        </thead>
        <tbody>
            


            
        <tr role="row" class="odd"><td class="">January</td></tr>
        <tr role="row" class="even"><td class="">February</td></tr>
        <tr role="row" class="odd"><td class="">March</td></tr>
        <tr role="row" class="even"><td class="">April</td></tr>
      </tbody>
    </table>
    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 1 to 4 of 4 entries</div>
    <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
      <a class="paginate_button previous disabled" aria-controls="example" data-dt-idx="0" tabindex="0" id="example_previous">Previous</a>
      <span><a class="paginate_button current" aria-controls="example" data-dt-idx="1" tabindex="0">1</a></span>
      <a class="paginate_button next disabled" aria-controls="example" data-dt-idx="2" tabindex="0" id="example_next">Next</a>
    </div></div>

    <script type="text/javascript">//<![CDATA[


jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-range-pre": function ( a ) {
        var monthArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return monthArr.indexOf(a);     
    },
     "date-range-asc": function ( a, b ) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },
     "date-range-desc": function ( a, b ) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
} );

var table = $('#example').DataTable({
    columnDefs: [
       { type: 'date-range', targets: 0 }
    ]
})  



  //]]></script>

  <script>
    // tell the embed parent frame the height of the content
    if (window.parent && window.parent.parent){
      window.parent.parent.postMessage(["resultsFrame", {
        height: document.body.getBoundingClientRect().height,
        slug: ""
      }], "*")
    }

    // always overwrite window.name, in case users try to set it manually
    window.name = "result"
  </script>

    <script>
      let allLines = []

      window.addEventListener("message", (message) => {
        if (message.data.console){
          let insert = document.querySelector("#insert")
          allLines.push(message.data.console.payload)
          insert.innerHTML = allLines.join(";\r")

          let result = eval.call(null, message.data.console.payload)
          if (result !== undefined){
            console.log(result)
          }
        }
      })
    </script>



</body></html>

*/