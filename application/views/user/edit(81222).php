    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-6 m-auto">
			<div class="card card-primary " style="border-radius: 1rem;">
				<div class="card-header" style="border-top-left-radius: 1rem;border-top-right-radius: 1rem;">
              <h3 class="text-center"><?= $todo;?> User</h3>
            </div>
            <form role="form" method="post" name="mainfrm" id="mainfrm">
            <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="user_name">User Name</label>
                      <input type="taxt" id="user_name" name="user_name" value="<?= ($userdata['username'] ?? '');?>" class="form-control" autocomplete="off" required/>          
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="firstname">First Name</label>
                      <input type="taxt" id="firstname" name="firstname" value="<?= ($userdata['firstname'] ?? '');?>" class="form-control" autocomplete="off" required/>          
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="lastname">Last Name</label>
                     <input type="taxt" id="lastname" name="lastname" value="<?= ($userdata['lastname'] ?? '');?>" class="form-control" autocomplete="off" required/>          
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="taxt" id="email" name="email" value="<?= ($userdata['email'] ?? '');?>" class="form-control" autocomplete="off" required/>          
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="pass_word">Password <span class="red-small">(only if you want to change)</span></label>
                      <input type="password" id="pass_word" name="pass_word" class="form-control" value = "" autocomplete="off"/>          
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="groups">Groups</label>
                      <select class="form-control" id="groups" name="groups">
                        <option value="">Select Groups</option>
                        <?php foreach ($group_data as $k => $v): ?>
                          <option <?php if(($userdata['groups'] ??'') == $v['id']) { ?> selected <?php } ?> value="<?php echo $v['id'] ?>"><?php echo $v['group_name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select class="form-control custom-select" placeholder="" name="status" id="status" required>
                        <option value="yes" <?php if(($userdata['status'] ?? 'yes') == "yes") { ?> selected <?php } ?>>Active</option>
                          <option value="no" <?php if(($userdata['status'] ?? 'yes') == "no") { ?> selected <?php } ?>>Non-Active</option>                                
                      </select>
                    </div>
                  </div>  
                  <div class="col-sm-6">
                  <?php if($session_data['groups'] == 1){ ?>
                      <div class="form-group">
                        <label for="restaurant_id">Restaurants</label>
                        <select class="form-control" id="restaurant_id" name="restaurant_id">
                          <option value="0">Select Restaurants</option>
                            <?php foreach ($restaurants as $k => $v): ?>
                            <option <?php if(($userdata['restaurant_id'] ?? '') == $v['restaurant_id']){?>selected<?php }?> value="<?php echo $v['restaurant_id'] ?>"><?php echo $v['restaurant_name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>      
                    <?php }else{ ?>
                      <input type="hidden" name="restaurant_id" id="restaurant_id" value="<?= $session_data['restaurant_id'];?>">
                    <?php } ?>
                    </div>
                  </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <div class="row">
                  <div class="col">
                    <input type="hidden" id="main_id" name="main_id" value="<?= $main_id; ?>">
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
  