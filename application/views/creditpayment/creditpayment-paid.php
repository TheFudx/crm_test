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
          <table id="mainTable" class="table  table-bordered table-striped">
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>Customer</th>
                <th>Contact No</th>
                <th>Room</th>
                <th>Invoice</th>
                <th>Created Date</th>
                <th>Created By</th>
                <th>Amount</th>
                <!-- <th>Action</th> -->
              </tr>
            </thead>
            <tbody>
            <?php if ($data) : 
                $i = 1;?>
                <?php foreach ($data as $PaymentDetail){?>
                  <tr>
                    <td><?php echo $i++ ?></td>     
                    <td><?php echo $PaymentDetail['customerName'] ; ?> </td>
                    <td><?php echo $PaymentDetail['contactNo'] ; ?> </td>
                    <td><?php echo $PaymentDetail['room'] ; ?> </td>
                    <td><?php echo $PaymentDetail['invoice_no'] ; ?> </td>
                    <td><?php echo $PaymentDetail['createdDate'] ; ?> </td>
                    <td><?php echo $PaymentDetail['createdName'] ; ?> </td>
                    <td><?php echo $PaymentDetail['AmountRecived'] ; ?> </td>
                    <!-- <td nowrap>
                        <button class="btn btn-success getdetail" 
                        data-amount="<?= $PaymentDetail['billAmount']; ?>"
                        data-invoice_no="<?= $PaymentDetail['invoice_no']; ?>" 
                        data-restaurant_id="<?= $PaymentDetail['restaurant_id']; ?>"
                        >Pay Now</button>
                    </td> -->
                  </tr>
                <?php } ?>
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
        <h4 class="modal-title">Pay Credit Payment</h4>
      </div>
      <div class="modal-body" style="overflow: auto;">
        <div class="main-grid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                      <label>Invoice</label>
                    </div>
                </div>
                <div class="col-sm-8">
                    <span id="invoice_no"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                      <label>Bill Amount</label>
                    </div>
                </div>
                <div class="col-sm-8">
                    <span id="BillAmount"></span>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-8">     
                  <input type="hidden" id="invoiceNo" name="invoice_no"/>          
                  <input type="hidden" name="restaurant_id" id="restaurant_id" />          
                  <input type="hidden" name="BillAmount" id="BillAmounts" />          
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id = "paynow" >Confirm</button>
        <button type="button" class="btn btn-warning" id="cancelmenu" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>