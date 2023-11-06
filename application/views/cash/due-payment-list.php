<style>

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
          <table id="mainTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>SR No</th>
                <th>Invoice N</th>
                <th>Invoice Date</th>
                <!--<th>Raw Material</th>-->
                <!--<th>Current Stock</th>-->
                <th>From</th>                            
                <th>Total ( <i class="fas fa-rupee-sign"></i> )</th>
                <th>Payment</th>
                <th>Paid Amount ( <i class="fas fa-rupee-sign"></i> )</th>
                <th>Remaining Amount ( <i class="fas fa-rupee-sign"></i> )</th>
                <th>
                    <!-- <a href="<?php echo base_url('purchase/create') ?>" class="btn btn-default">Add New</a> -->
                </th>
              </tr>
            </thead>
            <form id="mainfrm" action="" method="post">
              <input type="hidden" id="main_id" name="main_id" value="">
            </form>
            <tbody>
              <?php if ($data) : 
                $i = 1;?>
                <?php 
                foreach($data as $row) { ?> 
                  <tr>
                    <th scope="row"><?php echo $i;?></th>
                    <td><?php echo $row['invoice_no'];?></td>
                    <td><?php echo $row['invoice_date'];?></td>
                    <!--<td><?php echo $row['rawmaterial'];?></td>-->
                    <!--<td><?php echo $row['stock'].' '.$row['units'];?></td>-->
                    <td><?php echo $row['supplier_name'];?></td>
                    <td><?php echo $row['total_amount'];?></td>
                    <td><?php echo $row['ptype'];?></td>
                    <td><?php echo $row['paid_amount'];?></td>
                    <td><?php echo $row['total_amount'] - $row['paid_amount'];?></td>
                    <td nowrap>
                        <button class="btn btn-success getdetail" data-id="<?= $row['id']; ?>">Pay Now</button>
                    </td>
                  </tr>
                  <?php $i++; }  ?>
              <?php endif; ?>
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
<div id="payNowModal" class="modal fade" role="dialog" data-keyboard="true" data-backdrop="static" tabindex="-1">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pay Due Payment</h4>
      </div>
      <div class="modal-body" style="overflow: auto;">
        <div class="main-grid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                      <label>Total Payment</label>
                    </div>
                </div>
                <div class="col-sm-8">
                    <span id="totalPayment"></span>
                </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Previous Paid</label>
                </div>
              </div>
              <div class="col-sm-8">
                  <span id="previouspaid"></span>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Amount to be pay</label>
                </div>
              </div>
              <div class="col-sm-8">
                  <input type="text" id="paid_amount" name="paid_amount" class="form-control numberOnly" required/>          
                  <input type="hidden" id="ramount" name="ramount"/>          
                  <input type="hidden" id="stock_master_id" name="stock_master_id"/>          
                  <input type="hidden" name="restaurant_id" id="restaurant_id" value="<?= $restaurant_id;?>"/>          
              </div>
              
              
            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Pay Discount</label>
                </div>
              </div>
              <div class="col-sm-8">
                <input type="text" id="pay_discount" name="pay_discount" class="form-control numberOnly" />   
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Pay Remark</label>
                </div>
              </div>
              <div class="col-sm-8">
                <input type="text" id="pay_remark" name="pay_remark" class="form-control" />   
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id = "paynow" data-id="mainfrm">Paynow</button>
        <button type="button" class="btn btn-warning" id="cancelmenu" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>