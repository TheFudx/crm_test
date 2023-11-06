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
          <table id="mainTable" class="table   table-bordered table-striped">
            <thead>
              <tr>
                <th>Sr No.</th>
                <th>Category</th>
                <th>Orders</th>
                <th>Net Amount</th>
                <th>Total Discount</th>
                <th>Total Tax</th>
                <th>Total Sales</th>
                <th>Percentage %</th>
                <th>Date</th>
              </tr>
            </thead>
            
            <tbody>
                <?php $i = 1;?>
                <?php foreach ($data as $item){?>
               <td><?php echo $i++ ?></td>                  
                  <td><?php echo $item['category'] ; ?> </td>
                  <td><?php echo $item['order_count'] ; ?></td>
                  <!--<td><?php echo $item['item_name'] ; ?> </td>-->
                  <td><?php echo $item['total_price'] ; ?> </td>
                  <td><?php echo $item['discount_amount'] ; ?> </td>
                  <td><?php echo $item['tax_amt'] ; ?> </td>
                  <td><?php echo $item['grand_total'] ; ?> </td>
                <?php     $sales = $item['total_price'] /  $item['total_bill'] * 100 ; ?>
                  <td> <?php echo round($sales) ; ?>%</td>
                  <td><?php echo date ('d/m/Y' , strtotime($item['created_date'])) ; ?> </td>
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









