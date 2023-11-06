    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-6 m-auto">
        <div class="card card-primary " style="border-radius: 1rem;">
				  <div class="card-header" style="border-top-left-radius: 1rem;border-top-right-radius: 1rem;">
              <h3 class="text-center"><?= $todo;?> Table</h3>
            </div>
            <form role="form" method="post" name="mainfrm" id="mainfrm">
            <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                        <label for="tablename">Table Name</label>
                        <input type="taxt" id="tablename" name="tablename" value="<?= ($data['tablename'] ?? '');?>" class="form-control" autocomplete="off" required/>          
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="taxt" id="capacity" name="capacity" value="<?= ($data['capacity'] ?? '');?>" class="form-control" onkeypress="return isNumber(event)" autocomplete="off" required/>          
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" placeholder="" name="status" id="status" required>
                            <option value="0" <?php if(($data['status'] ?? 0) == 0) { ?> selected <?php } ?> >Available</option>
                            <option value="1" <?php if(($data['status'] ?? 0) == 1) { ?> selected <?php } ?>>Not Available</option>                                
                        </select>
                        </div>
                    </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <div class="row">
                  <div class="col">
                    <input type="hidden" id="main_id" name="main_id" value="<?= $main_id; ?>">
                    <input type="hidden" name="restaurant_id" id="restaurant_id" value="<?= $session_data['restaurant_id'];?>">
                    <button class="btn btn-primary saveChange" id="update" type="submit" data-form="mainfrm"><i class="fa fa-save" style="display: none"></i>Save </button>
                    <button class="btn btn-warning goBack" type="button"><i class="fa fa-save" style="display: none"></i>Cancel </button>
                  </div>
                </div>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->