<section class="content">
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title"><?= $page_title;?></h3>
        </div>
        <div class="card-body" style="background-color:#d2e8fd !important">
          <div class="progress mb-30" style="display:none;">
              <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                  20%
              </div>
          </div>
          <form id="categoryForm" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="category">Upload Category</label> 
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <input type="file" id="category" name="category" class="fileupload" autocomplete="off"/>          
                    </div>
                </div>

                <div class="col-sm-4">
                  <input type="hidden" name="restaurant_id" value="<?= $session_data['restaurant_id'];?>">
                  <input class="btn btn-primary" type="submit" value="Upload">
                  <button class="btn  btn-outline-danger goBack" type="button"><i class="fa fa-save" style="display: none"></i>Cancel </button>
                </div>
            </div>
          </form>
          <form id="itemForm" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="items">Upload Item</label> 
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <input type="file" id="items" name="items" class="fileupload" autocomplete="off"/>          
                    </div>
                </div>
                <div class="col-sm-4">
                  <input type="hidden" name="restaurant_id" value="<?= $session_data['restaurant_id'];?>">
                  <input class="btn btn-primary" type="submit" value="Upload">
                  <button class="btn btn-outline-danger goBack" type="button"><i class="fa fa-save" style="display: none"></i>Cancel </button>
                </div>
            </div>
        </form>

        <form id="RawmaterialForm" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="Rawmaterial">Upload Rawmaterial</label> 
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <input type="file" id="rawmaterials" name="rawmaterials" class="fileupload" autocomplete="off"/>          
                    </div>
                </div>
                <div class="col-sm-4">
                  <input type="hidden" name="restaurant_id" value="<?= $session_data['restaurant_id'];?>">
                  <input class="btn btn-primary" type="submit" value="Upload">
                  <button class="btn btn-outline-danger goBack" type="button"><i class="fa fa-save" style="display: none"></i>Cancel </button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</section>