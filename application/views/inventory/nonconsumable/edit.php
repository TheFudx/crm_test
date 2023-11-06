<input type="hidden" id="rurl" value="<?= $rurl;?>">
<section class="content">
	<div class="row">
		<div class="col-md-6 col-xs-6 m-auto">
		<div class="card card-primary " style="border-radius: 1rem;">
				<div class="card-header" style="border-top-left-radius: 1rem;border-top-right-radius: 1rem;">
				<h3 class="text-center"><?= $todo;?> Non Consumable Items</h3>
				</div>
				<form role="form" method="post" name="mainfrm" id="mainfrm">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="rawmaterial" >Item Name</label>
									<input type="text" id="rawmaterial" name="rawmaterial" autocomplete="off" class="form-control"  value="<?= $data ['rawmaterial'] ?? '';?>">
								</div>
							</div>

							
                            <div class="col-sm-6">
								<div class="form-group">
									<label for="unit" >Unit</label>
									<?php 
										$js = 'id="unit" class="form-control"';
										echo form_dropdown('unit', $units, $data['unit'] ?? "",$js);
									?>
								</div>
							</div>
						</div>
						<div class="card-footer text-center">
							<div class="row">
								<div class="col">
									<input type="hidden" id="productType" name="productType" value="nonconsumable">
									<input type="hidden" id="main_id" name="main_id" value="<?= $main_id; ?>">
									<input type="hidden" name="restaurant_id" id="restaurant_id" value="<?= $session_data['restaurant_id'];?>">
									<button class="btn btn-primary saveChange" id="update" type="submit" data-form="mainfrm"><i class="fa fa-save" style="display: none"></i>Save </button>
									<button class="btn btn-warning goBack" type="button"><i class="fa fa-save" style="display: none"></i>Cancel </button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>



