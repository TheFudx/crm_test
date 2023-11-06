    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="col-md-6 col-xs-6 m-auto">
			<div class="card card-primary " style="border-radius: 1rem;">
				<div class="card-header" style="border-top-left-radius: 1rem;border-top-right-radius: 1rem;">
              <h3 class=" text-center " id="todo"><?= $todo;?> User</h3>
            </div>
            <form role="form" method="post" name="mainfrm" id="mainfrm" enctype="multipart/form-data">
            <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12 userdetails">
                    <div class="row">

                      <div class="text-center col-sm-4 m-auto" >
                        <label for="photo ">User Photo <span class="red-small s_photo">(only if you want to change)</span>
                        <p class="red-small s_photo">Dimension: (Height:200px || Width:200px) MAX-SIZE : 500KB </p></label>
                        <div class="photo__container mb-1">
                          <?php   if(empty($user['photo'])){
                            echo '<img id="userphoto" alt="User Photo" src="" />';
                          }else{
                            echo '<img id="userphoto" alt="User Photo" src='.base_url().'assets/images/users/'.$user['photo'].' />';
                          }  ?>
                        </div>
                        <input type='file' name="user_photo" class="custom-file-input"  id="user_photo"  onchange="readURL(this);"  />
                        <label class="custom-file-label" for="customFile">Choose file</label>

                        <?php if(empty($user['photo'])){
                          echo '';
                        }else{
                          echo '<a href='.base_url().$user['photo'].' download='.$userdata['username'].'_photo'.' class="download_icon"><i class="fa fa-download" aria-hidden="true"></i></a>';
                        } ?>
                        
                      </div>

                      <div class="text-center col-sm-4 m-auto">
                      <label for="photo ">ID Proof Photo <span class="red-small s_photo">(only if you want to change)</span><p class="red-small s_photo">Dimension: (Height:800x || Width:800px) MAX-SIZE : 1000KB</p></label>
                        <div class="idphoto__container mb-1" >
                          <?php   if(empty($user['idproof_photo'])){
                            echo '<img id="idphoto" alt="Id Proof Photo" src="" />';
                          }else{
                            echo '<img id="idphoto" alt="Id Proof Photo" src='.base_url().'assets/images/users/'.$user['idproof_photo'].' />';
                          }  ?>
                        </div>
                        <input type='file' name="idproof_photo" class="custom-file-input"  id="idproof_photo"  onchange="idreadURL(this);"  />
                        <label class="custom-file-label" for="customFile">Choose file</label>

                        <?php if(empty($user['idproof_photo'])){
                          echo '';
                        }else{
                          echo '<a href='.base_url().$user['idproof_photo'].' download='.$userdata['username'].'_IDProof'.' class="download_icon"><i class="fa fa-download" aria-hidden="true"></i></a>';
                        } ?>
                      </div>

                      <div class="text-center col-sm-4 m-auto">
                      <label for="photo ">Address Proof Photo <span class="red-small s_photo">(only if you want to change)</span><p class="red-small s_photo">Dimension: (Height:800x || Width:800px) MAX-SIZE : 1000KB</p></label>
                        <div class="addphoto__container mb-1">
                          <?php   if(empty($user['address_photo'])){
                              echo '<img id="addressphoto" alt="Address Proof Photo" src="" />';
                            }else{
                              echo '<img id="addressphoto" alt="Address Photo" src='.base_url().'assets/images/users/'.$user['address_photo'].' />';
                            }  ?>
                        </div>
                        <input type='file' name="address_photo" class="custom-file-input"  id="address_photo" onchange="addreadURL(this);"  />
                        <label class="custom-file-label" for="customFile">Choose file</label>

                        <?php if(empty($user['address_photo'])){
                          echo '';
                        }else{
                          echo '<a href='.base_url().$user['address_photo'].' download='.$userdata['username'].'_AddressProof'.' class="download_icon"><i class="fa fa-download" aria-hidden="true"></i></a>';
                        } ?>
                      </div>

                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="user_name">User Name</label>
                      <input type="text" id="user_name" name="user_name" value="<?= ($userdata['username'] ?? '');?>" class="form-control" autocomplete="off" required/>          
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="firstname">First Name</label>
                      <input type="text" id="firstname" name="firstname" value="<?= ($userdata['firstname'] ?? '');?>" class="form-control" autocomplete="off" required/>          
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="lastname">Last Name</label>
                     <input type="text" id="lastname" name="lastname" value="<?= ($userdata['lastname'] ?? '');?>" class="form-control" autocomplete="off" required/>          
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" id="email" name="email" value="<?= ($userdata['email'] ?? '');?>" class="form-control" autocomplete="off" required/>          
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

  
                    

                  <div class="col-sm-6 userdetails" >
                    <div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="text" id="mobile" name="mobile" value="<?= ($user['mobile'] ?? '');?>" class="form-control numberOnly"   maxlength="10" autocomplete="off" />          
                    </div>
                  </div>
                  <div class="col-sm-6 userdetails">
                    <div class="form-group">
                      <label for="msalary">Monthly Salary</label>
                     <input type="text" id="msalary" name="msalary" value="<?= ($user['msalary'] ?? '');?>" class="form-control numberOnly" autocomplete="off" />          
                    </div>
                  </div>
                
                  <div class="col-sm-12 userdetails">
                    <div class="form-group">
                      <label for="increment">Annual Increment</label>
                      <input type="text" id="increment" name="increment" value="<?= ($user['increment'] ?? '');?>" class="form-control " autocomplete="off" />          
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
  