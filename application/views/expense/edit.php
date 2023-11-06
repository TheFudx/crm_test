    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-6 m-auto">
         <div class="card card-primary " style="border-radius: 1rem;">
				<div class="card-header" style="border-top-left-radius: 1rem;border-top-right-radius: 1rem;">
              <h3 class="text-center"><?= $todo;?> Cash Out</h3>
            </div>
            <form role="form" method="post" name="mainfrm" id="mainfrm">
            <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                    <?php 
                    if(in_array('user', $user_permission)){ ?>
                      <div class="form-group">
                        <label for="groups">User</label>
                        <select class="form-control" id="user_id" name="user_id">
                          <option value="">Select User</option>
                            <?php foreach ($users as $k => $v): ?>
                            <option <?php if(($data['user_id'] ?? '') == $v['id']){?>selected<?php }?> value="<?php echo $v['id'] ?>"><?php echo $v['username'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>      
                    <?php }else{ ?>
                        <input type="hidden" name="user_id" id="user_id" value="<?= $session_data['user_id'];?>">
                    <?php } ?>                  
                    </div>
                    
                    <div class="col-sm-6">
				                    <div class="form-group">
				                    	<label>Type : </label><br />
				                      	<div class="icheck-primary d-inline">
					                        <input type="radio" name="flow" value="0" id="radioDanger1"
                                    <?php if(($data['flow'] ?? '') == 0) {echo "checked"; }?>
                                   >
					                        <label for="radioDanger1">Used </label>
				                      	</div>
				                      	<div class="icheck-primary d-inline">
					                        <input type="radio" name="flow" value="1" id="radioDanger2"
                                  <?php if(($data['flow'] ?? '') == 1) {echo "checked"; }?>
                                  >
					                        <label for="radioDanger2">BANK </label>
				                      	</div>
				                    </div>
				              </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="amount">Amount</label>
                      <input type="text" id="amount" name="amount"  value="<?= $data['amount'] ?? '';?>" onkeypress="return isNumber(event)"  class="form-control" autocomplete="off" required/>          
                    </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="cash_date">Date</label>
                        <input type="date" id="cash_date" data-name="cash_date" name="cash_date" autocomplete="off" class="form-control" required value="<?= ($data['cash_date'] ?? '');?>"/>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="master_heading">Master Heading</label>
                        <input type="text" id="master_heading" name="master_heading"  value="<?= $data['master_heading'] ?? '';?>"   class="form-control" autocomplete="off" required/>          
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="purposeCashout">Purpose of Cash Out</label>
                          <input type="text" id="purposeCashout"  name="purpose_cashout" autocomplete="off" class="form-control" required value="<?= ($data['purpose_cashout'] ?? '');?>"/>
                        </div>
                      </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="reason">Reason</label>
                      <input type="text" id="reason" name="reason" value="<?= ($data['reason'] ?? '');?>" class="form-control" autocomplete="off" required/>          
                    </div>
                  </div>

                </div>

              <!-- /.card-body -->
              <div class="card-footer text-center">
                <div class="row">
                  <div class="col">
                    <input type="hidden" id="main_id" name="main_id" value="<?= $main_id; ?>">
                    <input type="hidden" id="ram" name="ram" value="">
                    <input type="hidden" id="cash_type" name="cash_type" value="O">
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
  