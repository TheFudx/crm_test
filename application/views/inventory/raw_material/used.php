<style type="text/css">
	.repeater-heading button{margin: 20px;}
</style>
<?php 
$id = 'repeater';
if($main_id==0){
	$id = 'repeater';
}else{
	$id = '';
}
?>
<input type="hidden" id="rurl" value="<?= $rurl;?>">
<section class="content">
	<div class="row">
		<div class="col-md-6 col-xs-6 m-auto">
			<div class="card card-primary " style="border-radius: 1rem;">
				<div class="card-header" style="border-top-left-radius: 1rem;border-top-right-radius: 1rem;">
				<h3 class="text-center"><?= $todo;?> Raw Material</h3>
				</div>
				<form role="form" method="post" name="mainfrm" id="mainfrm">
					<div id="<?= $id;?>">
					    <!-- Repeater Heading -->
					    <?php if($main_id==0){?>
					    <div class="repeater-heading text-right">
					        <button class="btn btn-primary repeater-add-btn" type="button">
					            Add
					        </button>
					    </div>
						<?php } ?>
					    <div class="clearfix"></div>
					    <div class="card-body">
							<div class="row">
							    <div class="col-sm-6">
				                    <!-- radio -->
				                    <div class="form-group">
				                    	<label>Type : </label><br />
				                      	<div class="icheck-danger d-inline">
					                        <input type="radio" name="entry_type" value="U" checked id="radioDanger1">
					                        <label for="radioDanger1">Used </label>
				                      	</div>
				                      	<div class="icheck-danger d-inline">
					                        <input type="radio" name="entry_type" value="W" id="radioDanger2">
					                        <label for="radioDanger2">Wastage</label>
				                      	</div>
				                    </div>
				                </div>
				                <div class="col-sm-6">
									<div class="form-group">
										<label for="invoice_date">Used Date</label>
										<input type="date" id="invoice_date" data-name="invoice_date" name="invoice_date" autocomplete="off" max="<?= date('Y-m-d');?>" class="form-control" value="<?= $data['invoice_date'] ?? '';?>"/>
									</div>
								</div>
							</div>
						</div>

					    <!-- Repeater Items -->
					    <div class="items" data-group="test">
					        <!-- Repeater Content -->
					        <div class="item-content">
					            <div class="card-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="rawmaterial">Raw Material</label>
												<?php 
													$js = 'id="rawmaterial_id" class="form-control rawmaterial_id" data-name="rawmaterial_id"';
													echo form_dropdown('rawmaterial_id', $rawmaterial, $data['rawmaterial_id'] ?? "",$js, true);
												?>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for="stock">Stock</label>
												<div class="input-group mb-3">
													<input type="hidden" id="oldstock" data-name="oldstock" name="oldstock" value="<?= $data['stock'] ?? '0';?>">
													<input type="text" id="stock" name="stock" data-name="stock" autocomplete="off" class="form-control numberOnly" value="<?= $data ['stock'] ?? '';?>">
													<div class="input-group-append">
														<span class="input-group-text lblunits"><?= $data ['units'] ?? '';?></span>
													</div>
												</div>
											</div>
										</div>
										<?php if($main_id==0){?>
										<div class="col-sm-2" style="margin-top: 30px;">
											<div class="pull-right repeater-remove-btn">
									            <button class="btn btn-danger remove-btn">
									                Remove
									            </button>
									        </div>
										</div>
										<?php }?>
									</div>
								</div>
					        </div>
					    </div>
					</div>
					<div class="card-footer text-center">
						<div class="row">
							<div class="col">
								<input type="hidden" id="main_id" name="main_id" value="<?= $main_id; ?>">
								<!-- <input type="hidden" name="entry_type" value="U"> -->
								<input type="hidden" name="restaurant_id" id="restaurant_id" value="<?= $session_data['restaurant_id'];?>">
								<button class="btn btn-primary saveChange" id="update" type="submit" data-form="mainfrm"><i class="fa fa-save" style="display: none"></i>Save </button>
								<button class="btn btn-warning goBack" type="button"><i class="fa fa-save" style="display: none"></i>Cancel </button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>