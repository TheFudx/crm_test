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
            <!--<div class="row justify-content-center">-->
            <!--    <div class="col-sm-3">-->
            <!--      <div class="form-group ">-->
            <!--        <label for="from">Form </label>-->
            <!--        <input type="date" id="from" name="from"  class="form-control"  value=""/>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--    <div class="col-sm-3">-->
            <!--      <div class="form-group">-->
            <!--        <label for="to">To</label>-->
            <!--        <input type="date" id="to" name="to"  class="form-control"  value=""/>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--</div>-->
          <table id="mainTable" class="table table-responsive table-bordered table-striped">
            <thead>
              <tr>
                <!--<th>#</th>-->
                <th>Order No</th>
                <th>Waiter</th>
                <th>Date</th>
                <th>Payment Type</th>
                <th>Order Type</th>
                <th>Bill Amount</th>
                <th>Discount</th>
                <th>Delivery Charges</th>
                <th>Packing Charges</th>
                <th>Service Charges</th>
                <th>VAT</th>
                <th>CGST</th>
                <th>SGST</th>
                <th>Total Bill Amount</th>
                
                <th>Order Cancelled</th>
              </tr>
            </thead>
            <form id="mainfrm" action="" method="post">
              <input type="hidden" id="main_id" name="main_id" value="">
            </form>
            <tbody>
              <?php foreach ($data as $item){?>

                <tr>
                  <!--<th></th>                  -->
                  <th><?php echo $item['invoice_no'] ; ?> </th>
                  <th><?php echo $item['username'] ; ?></th>
                  <th><?php echo $item['created_date'] ; ?> </th>
                  <th><?php echo $item['payment_type'] ; ?> </th>
                  <th><?php echo $item['bill_type'] ; ?> </th>
                  <th><?php echo $item['total'] ; ?> </th>
                  <th><?php echo $item['discount_amt'] ; ?> </th>

                 <?php if($item['tax_name'] == 'Delivery Charges'){ ?>
                  <th> <?php echo "YES"; ?> </th>
                   <?php } else { ?>                      
                        <th> <?php echo "No" ;?> </th>
                      <?php } ?>
                      
                  <?php if($item['tax_name'] == 'Packing Charge'){ ?>
                  <th> <?php echo "YES"; ?> </th>
                   <?php } else { ?>                      
                        <th> <?php echo "No" ;?> </th>
                      <?php } ?>
                     

                 <?php if($item['tax_name'] == 'Service Tax'){ ?>
                  <th> <?php echo "YES" ;?> </th>
                   <?php } else { ?>                      
                        <th> <?php echo "No" ;?> </th>
                      <?php } ?>

                      
                  <th><?php echo $item['vat_amt'] ; ?> </th>

                 <th><?php echo $item['cgst_amt'] ; ?> </th> 
                  <th><?php echo $item['sgst_amt'] ; ?> </th>
                  <th><?php echo $item['grand_total'] ; ?> </th>
                  
                  
                   <?php if($item['is_deleted'] == '1'){ ?>
                  <th> <?php echo "YES" ?> </th>
                    <?php } else { ?>
                      
                        <th> <?php echo "No" ;?> </th>
                      <?php } ?>
                    
                    </tr>

                  <?php } ?>
                  


             
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