<style type="text/css">
	.repeater-heading button{margin: 20px;}
</style>
<?php 
$id = 'repeater';
if($main_id==0){
	$id = 'repeater';
	$readonly = '';
	$disabled = '';
}else{
	$id = '';
	$readonly = 'readonly';
	$disabled = 'disabled';
}
// echo 'readonly '.$readonly;
?>
<input type="hidden" id="rurl" value="<?= $rurl;?>">
<section class="content">
	<div class="row">
	<div class="col-md-6 col-xs-6 m-auto">
			<div class="card card-primary " style="border-radius: 1rem;">
				<div class="card-header" style="border-top-left-radius: 1rem;border-top-right-radius: 1rem;">
				<h3 class=" text-center"><?= $todo;?> Purchase</h3>
				</div>
				<form role="form" method="post" name="mainfrm" id="mainfrm">
					<div id="<?= $id;?>">
					    <?php if($main_id==0){?>
					   
						<?php } ?>
					    <div class="clearfix"></div>
					    <div class="card-body">
							<div class="row">
							    <div class="col-sm-6">
								<div class="form-group">
									<label for="supplier_name">Supplier Name</label>
									<input type="text" <?= $readonly;?> id="supplier_name" name="supplier_name" autocomplete="off" class="form-control"  value="<?= $data ['supplier_name'] ?? '';?>">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="invoice_no">Invoice Number</label>
									<input type="text" id="invoice_no" name="invoice_no" autocomplete="off" class="form-control" <?= $readonly;?> value="<?= $data ['invoice_no'] ?? '';?>">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="invoice_date">Invoice Date</label>
									<input type="date" id="invoice_date" name="invoice_date" autocomplete="off" class="form-control" <?= $readonly;?> max="<?= date('Y-m-d');?>" value="<?= $data['invoice_date'] ?? '';?>"/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="total_amount">Total Amount</label>
									<div class="totalAMT">
										<input type="text"  id="total_amount" name="total_amount" autocomplete="off" class="form-control numberOnly" readonly  value="<?= $data ['total_amount'] ?? '0';?>">
										<a class="btn btn-primary  <?= $disabled;?> " id="addAll">Total Price</a>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="paid_amount">Paid Amount</label>
									<input type="text" id="paid_amount" name="paid_amount" autocomplete="off" class="form-control numberOnly" <?= $readonly;?> value="<?= $data ['paid_amount'] ?? '0';?>">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="payment_type">Select Payment Type</label>
									<?php 
										$js = 'id="payment_type" class="form-control"'.$readonly;
										echo form_dropdown('payment_type', $ptype, $data['payment_type'] ?? "",$js);
									?>
								</div>
							</div>
							</div>
							<div class="row text-center">
								<div class="col-sm-3">
										<label for="rawmaterial">Raw Material</label>
								</div>
								<div class="col-sm-3 ">
										<label for="Qty">Qty</label>
								</div>
								<div class="col-sm-2">
										<label for="price">Total Price</label>
								</div>
								<div class="col-sm-2 ">
									<label for="rateof">Rate of One</label>
								
								</div>
								<div class="col-sm-2 ">
									<button class="btn btn-primary repeater-add-btn" type="button">Add</button>
								</div>
							</div>
						</div>
						<div >
					       
					            
					    
					    </div>

					    <!-- Repeater Items -->
					    <div class="items" data-group="purchase">
					        <!-- Repeater Content -->
					        <div class="item-content">
					            <div class="">
									<div class="row" style="padding:0rem 1rem;">
										<div class="col-sm-3">
											<div class="form-group">
												<?php 
													$js = 'id="rawmaterial_id" class="form-control rawmaterial_id" data-name="rawmaterial_id" required';
													echo form_dropdown('rawmaterial_id', $rawmaterial, $data['rawmaterial_id'] ?? "",$js,true);
												?>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
									
												<div class="input-group mb-3">
													<input type="hidden" id="oldstock" data-name="oldstock" name="oldstock" value="<?= $data['stock'] ?? '0';?>">
													<input type="text" id="stock" name="stock" autocomplete="off" class="form-control stock"  required data-name="stock" value="<?= $data ['stock'] ?? '';?> " onkeypress="return isNumber(event)">
													<div class="input-group-append">
														<span class="input-group-text lblunits"><?= $data ['units'] ?? '';?></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<input type="text" class="form-control price amt" id="price" data-name="price" name="price" placeholder="Total Price" onkeypress="return isNumber(event)"  value="<?= $data ['price'] ?? '0';?>"/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
    											<input type="text" class="form-control stock" id="rateofunit" data-name="rateofunit" name="rateofunit" placeholder="@rate of 1" onkeypress="return isNumber(event)" value="<?= $data ['rateofunit'] ?? '0';?>"/>
											</div>
										</div>
										<?php if($main_id==0){?>
										<div class="col-sm-2" >
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
								<input type="hidden" name="entry_type" value="P">
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