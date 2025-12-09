

<?php 

require_once("inc/config.inc");
  $s_username = $_SESSION['username'];

$first_query = sqlsrv_query( $con ,"SELECT top 8 * FROM leaves WHERE 
  username ='$s_username'  order by [creation_time] DESC ");

while($output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';

$rows .='<td width="1%">'.$output_query["l_id"].'</td>';
$rows .='<td width="1px" style="border:1px solid #eee;">'.$output_query["type"].'</td>';
$rows .='<td width="1%" style="border:1px solid #eee;">'.$output_query["adate"]->format('Y-m-d').'</td>';
$rows .='<td width="1%" style="border:1px solid #eee;">'.$output_query["bdate"]->format('Y-m-d').'</td>';
$rows .='<td width="1px" style="border:1px solid #eee;">'.$output_query["status"].'</td>';
$rows  .='</tr>';
echo $rows;
}
?>

<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="delBtn" record_id="1">
                <span aria-hidden="true">&times;</span>
            </button>

<a class="btn btn-danger" href="#delModal" data-toggle="modal"
               data-row-id="<?php echo $output_query['l_id'];?>">Delete</a>

<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title">Delete Entry</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <input type="hidden" name="id" value=""/>
  <div class="modal-body">
    <p>Are you sure that you want to delete the selected Entry? There is no way to restore the deleted data!</p>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-success" id="accDelBtn">Yes, delete.</button>
    <button type="button" class="btn btn-danger" id="disMdBtn" data- 
 dismiss="modal">No, abort.</button>
  </div>
</div>

<script type="text/javascript">
        var id = null
        $('#delBtn').on('click', function() {
             id=$("#delBtn").attr("record_id")
            $('#deleteModal').show();
        });

        $('#disMdBtn').on('click', function(){
            $('#deleteModal').hide();
        });

        $('#accDelBtn').click(function() {

            $.ajax({
                type: "POST",
                url: "delete.php",
                data: { id: id }
            })
        });
    </script>