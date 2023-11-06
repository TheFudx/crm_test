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
    <div class="row">
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
                                <th>#</th>
                                <th>Invoice No</th>
                                <th>Order Taken</th>
                                <th>Kitchen Accept</th>
                                <th>In Cooking</th>
                                <th>Order Ready</th>
                                <th>Picked Up By Waiter</th>
                                <th>Table No</th>
                                <th>Bill Raised</th>
                                <th>Bill Paid</th>
                            </tr>
                        </thead>
                        <tbody>
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

$result = mysqli_query($conn,"SELECT * FROM bill_head Where restaurant_id = $this->restaurant_id and bill_head.is_deleted = 0" );




?>
                      
                        <?php
$i=1;
   while($row = mysqli_fetch_array($result)) {


    ?>
<tr>
      <th scope="row"><?php echo $i++;
          ?></th>
    <!-- Order No  -->
      <td><?php 
      
       $orderId = $row['Id'];  
      //echo "/";
     
      echo $row['invoice_no'];
     ?></td>
      <!-- Order Taken  --> <td><?php 


$time_query = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM order_status_log where order_id='$orderId'  and order_status_log.status = 'OrderTaken' limit 0,1"  ));
if (isset($time_query['create_date'])) {
  echo date("d/M/Y - h:i:s A",strtotime($time_query['create_date']));
 
  // code...
}

else {
  echo 'Not Available';
}

       ?>
</td>




      <!-- KitchenAccept -->  <td><?php 
$time_query = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM order_status_log where order_id=$orderId  and order_status_log.status = 'InCooking' limit 0,1"  ));
if (isset($time_query['create_date'])) {
 echo date("d/M/Y - h:i:s A",strtotime($time_query['create_date']));
  // code...
}

else {
  echo 'Not Available';
}
       ?>
</td>



<!-- InCooking --><td><?php 
$time_query = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM order_status_log where order_id=$orderId  and order_status_log.status = 'InCooking' limit 0,1"  ));
if (isset($time_query['create_date'])) {
 echo date("d/M/Y - h:i:s A",strtotime($time_query['create_date']));
  // code...
}

else {
  echo 'Not Available';
}
       ?>
</td>

<!-- OrderReady --><td><?php 
$time_query = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM order_status_log where order_id=$orderId  and order_status_log.status = 'OrderReady' limit 0,1"  ));
if (isset($time_query['create_date'])) {
 echo date("d/M/Y - h:i:s A",strtotime($time_query['create_date']));
  // code...
}

else {
  echo 'Not Available';
}
       ?>
</td>


<!-- PickedUpByWaiter --><td><?php 
$time_query = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM order_status_log where order_id=$orderId  and order_status_log.status = 'PickedUpByWaiter' limit 0,1"  ));
if (isset($time_query['create_date'])) {
 echo date("d/M/Y - h:i:s A",strtotime($time_query['create_date']));
  // code...
}

else {
  echo 'Not Available';
}
       ?>
</td>
<!-- Table id --><td><?php 
// $time_query = mysqli_fetch_array(mysqli_query($conn,"SELECT table_id FROM bill_head where Id=$orderId  limit 0,1"  ));
$time_query = mysqli_fetch_array(mysqli_query($conn,"SELECT tables.tablename AS tableName FROM bill_head LEFT JOIN `tables` on bill_head.table_id = tables.table_id where Id=$orderId  limit 0,1"  ));
if (isset($time_query['tableName'])) {
 echo ($time_query['tableName']);

}

else {
  echo 'Not Available';
}
       ?>
</td>
<!-- BillRaised--><td><?php 
$time_query = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM order_status_log where order_id=$orderId  and order_status_log.status = 'BillRaised' limit 0,1"  ));
if (isset($time_query['create_date'])) {
 echo date("d/M/Y - h:i:s A",strtotime($time_query['create_date']));
  // code...
}

else {
  echo 'Not Available';
}
       ?>
</td>


<!-- BillPaid--><td><?php 
$time_query = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM order_status_log where order_id=$orderId  and order_status_log.status = 'BillPaid' limit 0,1"  ));
if (isset($time_query['create_date'])) {
 echo date("d/M/Y - h:i:s A",strtotime($time_query['create_date']));
  // code...
}

else {
  echo 'Not Available';
}
       ?>
</td>

    </tr>



<?php 
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
                <button type="button" class="btn btn-danger" id="confirmdelete" data-form="mainfrm">Confirm</button>
                <button type="button" class="btn btn-warning" id="cancelmenu" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>