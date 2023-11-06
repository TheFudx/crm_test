<style>
	/* .ui-datepicker-calendar{background:#FFF} */
	.ui-datepicker-calendar th ,.ui-datepicker-calendar td{padding:8px}
	.ui-datepicker-prev{float: left;cursor: pointer;}
	.ui-datepicker-next{float: right;cursor: pointer;}
	.ui-datepicker-month{margin-left:40px}
	#ui-datepicker-div{padding: 20px;border:1px solid #000;background:#FFF}
	
	 input[type="search"] {
  color: red;
  border-radius: 0.75rem;
  padding: 9px 4px 9px 40px;
  background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat 13px center;
  background-color: white;
} 
</style>


<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row item-details-report">
    <div class="col-md-12 col-xs-12">
      <div class="">
        <div class="card-body">
    <!--                   <div class="row justify-content-center">-->
    <!--            <div class="col-sm-3">-->
				<!--	<div class="form-group ">-->
				<!--		<label for="from">Form </label>-->
				<!--		<input type="date" id="from" name="from"  class="form-control"  value=""/>-->
				<!--	</div>-->
				<!--</div>-->
				<!--<div class="col-sm-3">-->
				<!--	<div class="form-group">-->
				<!--		<label for="to">To</label>-->
				<!--		<input type="date" id="to" name="to"  class="form-control"  value=""/>-->
				<!--	</div>-->
				<!--</div>-->
    <!--        </div>-->
          <table id="mainTable" class="table table-bordered table-striped">
            <thead>
              <tr>
<?php
$servername = "localhost";
$username = "u862132972_crmAdmin";
$password = "jgcB9^^3M^";
$dbname = "u862132972_crm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = mysqli_query($conn,"SELECT * FROM bill_head Where restaurant_id = $this->restaurant_id"  );



?>
                      
                   <th>#</th>

                <th>Invoice no</th>
                <th>Items Name</th>
                <th>Quantity</th>
                <th>Net Amount</th>
                <th>Discount</th>
                <th>Total Tax</th>
                <th>Total Sales</th>
              </tr>
            </thead>
            <tbody>

            
               

<?php
$i=1;
   while($row = mysqli_fetch_array($result)) {


    ?>


 <tr>
    <td><?php echo $bill_id = $row['Id'] ?></td>
    <td> <?php echo $row['invoice_no'] ?></td>
    <td>
        <ul><?php  

$item_name = mysqli_query($conn," SELECT item_name  FROM bill_head left join kot_head on bill_head.Id= kot_head.bill_id left join kot_item on  kot_head.Id = kot_item.kot_id left join items on kot_item.item_id = items.item_id where bill_head.Id = $bill_id  " );
 while($item_name_row = mysqli_fetch_array($item_name)) {
echo "<li>";
  echo $item_name_row['item_name'].".";
  echo '</li>';
}

  ?>

      
      </ul> 

    </td>

    <td>

<ul>

<?php  
$item_name = mysqli_query($conn,"SELECT qty   FROM bill_head left join kot_head on bill_head.Id= kot_head.bill_id left join kot_item on  kot_head.Id = kot_item.kot_id left join items on kot_item.item_id = items.item_id where bill_head.Id = $bill_id  " );
while($item_name_row = mysqli_fetch_array($item_name)) {
 echo "<li>";
  echo $item_name_row['qty'].".";
  echo '</li>';

} ?>



</ul>

<?php  
$sum_total= mysqli_query($conn," SELECT sum(qty) as 'Total_qty', sum(kot_item.price) as 'total_price' FROM bill_head left join kot_head on bill_head.Id= kot_head.bill_id left join kot_item on  kot_head.Id = kot_item.kot_id left join items on kot_item.item_id = items.item_id where bill_head.Id = $bill_id " );
$sum_total_row = mysqli_fetch_array($sum_total);
echo "<strong>";
echo "<center>";
echo $sum_total_row['Total_qty'];
echo "</center>";
echo "</strong>";

?>

      </td>
    <td> <ul>
<?php
$item_name = mysqli_query($conn," SELECT kot_item.price FROM bill_head left join kot_head on bill_head.Id= kot_head.bill_id left join kot_item on  kot_head.Id = kot_item.kot_id left join items on kot_item.item_id = items.item_id where bill_head.Id = $bill_id " );
 while($item_name_row = mysqli_fetch_array($item_name)) {
echo "<li>";
  echo $item_name_row['price'].".";
  echo '</li>';
}

  ?>


</ul>
<?php 
echo "<strong>";
echo "<center>";
echo $sum_total_row['total_price'];
echo "</center>";
echo "</strong>";
 ?>

 </td>
    <td> <ul>
<?php
$item_name = mysqli_query($conn," SELECT bill_head.discount_amt FROM bill_head left join kot_head on bill_head.Id= kot_head.bill_id left join kot_item on  kot_head.Id = kot_item.kot_id left join items on kot_item.item_id = items.item_id where bill_head.Id = $bill_id LIMIT 0,1" );
 while($item_name_row = mysqli_fetch_array($item_name)) {
echo "<li>";
  echo $item_name_row['discount_amt'];
  echo '</li>';
}

  ?>

</ul>


 </td>
    <td> <ul>
 <?php
$item_name = mysqli_query($conn," SELECT bill_head.tax_amt FROM bill_head left join kot_head on bill_head.Id= kot_head.bill_id left join kot_item on  kot_head.Id = kot_item.kot_id left join items on kot_item.item_id = items.item_id where bill_head.Id = $bill_id LIMIT 0 , 1 " );
 while($item_name_row = mysqli_fetch_array($item_name)) {
echo "<li>";
  echo $item_name_row['tax_amt'];
  echo '</li>';
}

  ?>
</ul> 


</td>
    <td>  <ul>
  <?php
$item_name = mysqli_query($conn," SELECT kot_item.price  FROM bill_head left join kot_head on bill_head.Id= kot_head.bill_id left join kot_item on  kot_head.Id = kot_item.kot_id left join items on kot_item.item_id = items.item_id where bill_head.Id = $bill_id " );
 while($item_name_row = mysqli_fetch_array($item_name)) {
echo "<li>";
  echo $item_name_row['price'].".";
  echo '</li>';
}

  ?>
   <?php
$item_name = mysqli_query($conn," SELECT bill_head.grand_total   FROM bill_head left join kot_head on bill_head.Id= kot_head.bill_id left join kot_item on  kot_head.Id = kot_item.kot_id left join items on kot_item.item_id = items.item_id where bill_head.Id = $bill_id " );
 $item_name_row = mysqli_fetch_array($item_name);
  
  echo "<strong>";
  echo $item_name_row['grand_total'];
  echo "</strong>";

 ?>
</td>
   

  </tr>


        
            <?php 
            $i++;
}  ?>    
            </tbody>
          </table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- col-md-12 -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<!-- Delete Modal -->
<div id="myModalDelete" class="modal fade" role="dialog" data-keyboard="true" data-backdrop="static" tabindex="-1">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirm Deletion</h4>
      </div>
      <div class="modal-body" style="overflow: auto;">
        <div class="main-grid">
          <div class="col-md-12 ">
            Are you sure You want to Delete the selected Item ?
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id = "confirmdelete" data-form="mainfrm">Confirm</button>
        <button type="button" class="btn btn-warning" id="cancelmenu" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>