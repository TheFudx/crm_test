<style>

input[type="search"] {
  color: red;
  border-radius: 0.75rem;
  padding: 9px 4px 9px 40px;
  background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat 13px center;
  background-color: white;
}
</style>
<input type="hidden" id="rurl" value="<?= $rurl;?>">
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
                <th>Sr No</th>
                <th>Raw Material</th>
                <th>Used Stock </th>
                <th>Unit</th>
                <th>Last Updated</th> 
                <th  class=" text-center"><a href="<?php echo base_url('rawmaterialused/create') ?>" class="btn btn-default">Add New</a></th>
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
                    <td><?php echo $row['rawmaterial'];?></td>
                    <td><?php echo $row['stock'];?></td>
                    <td><?php echo $row['units'];?></td>  
                    <td><?php echo $row['invoice_date'];?></td>  
                    <td nowrap  class=" text-center">
                      <button onClick="Edit(<?= $row['stock_id']; ?>)" class="btn "><i class="fas fa-pencil-alt edit__btn"></i></button>
                      <button onClick="Delete(<?= $row['stock_id']; ?>)" class="btn "><i class="fa fa-trash delete__btn" ></i></button>
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