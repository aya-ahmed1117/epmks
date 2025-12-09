

     <head>
<script type='text/javascript' src='http://macbook-pro.local:5757/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
<script type='text/javascript' src='http://macbook-pro.local:5757/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>
</head>

<script type='text/javascript' src='http://macbook-pro.local:5757/wp-includes/js/jquery/ui/core.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='http://macbook-pro.local:5757/wp-includes/js/jquery/ui/datepicker.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='http://macbook-pro.local:5757/content/themes/mytheme/js/plugins.min.js?ver=20151215'></script>
<script type='text/javascript' src='http://macbook-pro.local:5757/content/themes/mytheme/js/main.js?ver=20151215'></script>



  <div class="col-lg-8">
    <div class="input-group">
    <span class="input-group-text" id="basic-addon1">Choose multiple days </span>

  <input type="text" id="multiple-date-select" autocomplete="off" name="days" class="form-control days" readonly="true" placeholder="choose days" required  ></input> 

</div>
</div>


<input name="data[entry-date]" id="parkingEntryDate" type="text" placeholder="dd/mm/yy" class="date-input">gbgng

<script type="text/javascript">
	$.datepicker.setDefaults({
  dateFormat: "d-m-y",
  dayNamesMin: [ "S", "M", "T", "W", "T", "F", "S" ],
  minDate: "d",
  maxDate: "+1y",
  prevText: "",
  nextText: "",
  onSelect: function(dateText, inst) {
            alert(dateText);
          }
});

$('#parkingEntryDate').datepicker();
</script>

 <form method="post">

          <div class="row">

    <div class="col-lg-3">
      <div class="input-group col-2">
        <span class="input-group-text" id="basic-addon1">Start Date</span>
        <input type="date" class="form-control" placeholder="From Date" aria-label="From Date" id="dates"
      name='date' aria-describedby="basic-addon1"
      value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>' required />
      </div>
    </div>
<br>
    <div class="col-lg-3">
      <div class="input-group col-2">
        <span class="input-group-text" 
        id="basic-addon1">End date</span>
        <input type="date" class="form-control" placeholder="To Date" aria-label="To Date" name="date2" id="dates"
          aria-describedby="basic-addon1"required
      value='<?php if(isset($_POST['date2'])) echo $_POST['date2']; ?>'/>
  </div>
  <br>
</div>

  </div> <!-- close row-->


