<style>

input[type="search"] {
  color: red;
  border-radius: 0.75rem;
  padding: 9px 4px 9px 40px;
  background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat 13px center;
  background-color: white;
}
#modal-view-bill .modal-content{
  transform: translate(18rem ,0rem)
}
.filter__box{
  margin: 1rem auto;
  position: absolute;
  top: -3rem;
  left: 18%;
}
.productType__box{
  margin: 1rem auto;
  position: absolute;
  top: -3rem;
  right: 25%;
}


</style>
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="">
        <div class="card-body">
            <!-- <div class="col-md-2  "> -->
            <div class="col-md-3  filter__box">
                <div class="form-group ">
                  <select name="daily_required" class=" form-control" id="indentItem" style="border-radius: 0.75rem;">
                      <option  value="All" class="indentItem">All</option>
                      <option  value="Required" class="indentItem">Only Required</option>
                  </select>
                </div>
            </div>

                <div class="col-md-3  productType__box">
              <?php 
									$js = 'id="productType" class="form-control " style="border-radius: 0.75rem;"';
									echo form_dropdown('productType', $productType, $data['product_Type'] ?? "",$js);
							?>
            </div>
         
            <form method="post" id="indent">
                <div class="panel-heading">
                    <button class="btn  pull-right btn-success mb-2 saveChange" id='submit' data-form="indent" type="submit">Print Indent</button>
                </div>
                <table style="width: 100%;" id="printTable" class="table table-bordered table-striped" cellpadding="5" cellspacing="5">
                  <thead>
                    <tr>
                      <th>Sr No</th>
                      <th>Raw Material</th>
                      <th width="200px">Available Stock</th>
                      <th width="200px">Daily Required Quantity </th>
                      <th width="200px">Order Stock </th>
                      <th width="200px">Unit</th>
    
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
            </form>
          
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














