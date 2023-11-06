<?php
//echo "<pre>";
// print_r($order); 
// ec)ho (isset($order['vat_amt']) ? $order['vat_amt'] : '0');
?>

<style>
  /* input[type="search"] {
  color: red;
  border-radius: 0.75rem;
  padding: 9px 4px 9px 40px;
  background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat 13px center;
  background-color: white;
} */
@media screen and (max-width: 360px) {
.OVtable{
    font-size: 6px!important;
}
.value-button{
    width: 10px!important;
    height: 30px!important;
}
.number{
    width: 10px!important;
    height: 30px!important;
}
}
@media screen and (min-width: 361px) and (max-width: 900px) {
.OVtable{
    font-size: 8px!important;
}
.value-button{
    width: 10px!important;
    height: 30px!important;
}
.number{
    width: 10px!important;
    height: 30px!important;
}
}
.OVtable{
    font-size: 16px;
}
.OVtable input[name="instruction[]"]{
    width:100%;
}
.custom-select , #customer_id {
  color: #051135;
}
.active a{
    color: #051135;
}

#searchtext{
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    background: white
}
#searchtext i{
    color: #051135;
}
#search_text{
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}
#search_text::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: #051135;
  opacity: 1; /* Firefox */
}
</style>
<div class="">
    <section class="content m-0">
        <div class="container-fluid m-0">
            <div class="row m-0">
                <div class="col-lg-6 col-md-6 ">
                    <form role="form" method="post" name="searchForm" id="searchForm">
                        <div class="input-group mt-2">
                        <div class="input-group-append border-right-0">
                                <button type="button" id="searchtext" class="btn btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <input type="search" class="form-control form-control border-left-0" id="search_text" name="search_text" placeholder="Search Item Here">
                            
                        </div>
                    </form>
                    <div class="row card-body px-0">
                        <div class="col-lg-3 col-md-3 ">
                            <ul class="nav nav-pills nav-sidebar flex-sidebar menu-categories ">
                                <?php
                                foreach ($category as $category_s) {
                                    $c = 1;
                                    echo '<li class="active"><a data-toggle="pill" class="btn " role="button" id="' . $category_s['category_id'] . '" onclick="getitems(' . $category_s['category_id'] . ')"  href="#' . $category_s['category_id'] . '_cat">' . $category_s['category'] . '</a></li>';
                                    $c = $c + 1;
                                }  ?>
                            </ul>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="tab-content container p-2">
                                <div id="cat_item" class="cat_div_data tab-pane fade in"></div>
                                <div id="raw_item" class="raw_div_data tab-pane fade in"></div>
                                <div id="search_cat" class="cat_div_data tab-pane fade in">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 ">

                    <div class="container p-2">
      
                        <div class="tab-content">
                            <form role="form" method="post" name="mainfrm" id="mainfrm">
                                
                                <div class="row" >
                                    <div id="invoice" class="invoice_div_data tab-pane fade in"></div>
                                    <!-- <div class="col-md-4">Select Customer</div> -->
                                    <div class="col-md-6">
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <select name="customer_id" id="customer_id" class="form-control"></select>
                                            <div class="input-group-append" data-toggle="datetimepicker">
                                                <div class="input-group-text" id="addcustomerbtn"><i class="fa fa-plus"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <label for="inputMessage">Select Table</label> -->
                                            <select class="form-control custom-select" placeholder="" name="table_id" required>
                                                <option value="0>">Select Table</option>
                                                <?php
                                                foreach ($table as $table_d) {
                                                    $selected = '';
                                                    if (isset($table_id) && $table_id == $table_d['table_id']) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option ' . $selected . ' value="' . $table_d['table_id'] . '">' . $table_d['tablename'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                               <div class="row">

                                    <div class="btn-group btn-group-toggle pb-3 col-md-6"  data-toggle="buttons">
                                        <label class="btn btn-outline-primary orderType_Btn rounded-0 ">
                                            <input type="radio" name="order_type" value="dinein" id="option_a1" autocomplete="off" class="order_types" checked> Dine In
                                        </label>
                                        <label class="btn btn-outline-primary orderType_Btn">
                                            <input type="radio" name="order_type" value="delivery" id="option_a2" autocomplete="off" class="order_types"> Delivery
                                        </label>
                                        <label class="btn btn-outline-primary orderType_Btn">
                                            <input type="radio" name="order_type" value="pickup" id="option_a3" autocomplete="off" class="order_types"> Pick up
                                        </label>
                                        <label class="btn btn-outline-primary orderType_Btn">
                                            <input type="radio" name="order_type"  value="online" id="option_a4" autocomplete="off" class="order_types"> Online
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="mb-3 row" id="PAX">
                                            <label for="PAX" class="col-sm-2 col-form-label">PAX</label>
                                            <div><div class="value-button btn-minus" ><i class="fas fa-minus"></i></div><input class="form-control inputPAX text-center bg-light" type="number" name="pax" value="2" /><div class="value-button btn-plus" ><i class="fas fa-plus"></i></div></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <form action="" id="manage-order-dineein"> -->
                                <!-- <input type="hidden" name="order_type" value="dinein"> -->
                                <?php if (isset($order) && count($order) > 0) { ?>
                                    <input type="hidden" name="ord_id" id="ord_id" value="<?= $order['Id'] ?>">
                                <?php } else { ?>
                                    <input type="hidden" name="ord_id" id="ord_id" value="">
                                <?php } ?>
                                <div class="row">
                                    <div class="col-md-12" id="dinein">
                                        <table class="table OVtable" style="min-height:100px">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="border-top-left-radius: 1rem !important;">Items</th>
                                                    <th scope="col">Check Items</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col" >Instruction</th>
                                                    <th style="border-top-right-radius: 1rem !important;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <div class="accordion " id="accordionExample">
                                            <div class=" bg-gray">
                                                <button class="btn btn-link bg-white collapsed order-acc " type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <i class="fa fa-chevron-down"></i>
                                                </button>
                                                <div class="card-header pb-0 pt-1 pl-1 pr-1 mt-1 mr-1 ml-1  " id="headingTwo">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 ">
                                                            <a class="btn btn-sm btn-outline-light addDiscount_btn" href="javascript:void(0);" title="Add Discount" data-toggle="modal" data-target="#modal-default-2"><strong>Add Discount</strong></a>


                                                            <input type="hidden" name="tax_id" id="tax_id" value="<?= (isset($tax['tax_id']) ? $tax['tax_id'] : '0'); ?>">
                                                            <input type="hidden" name="vat_percent" id="vat_percent" value="<?= (isset($tax['vat']) ? $tax['vat'] : '0'); ?>">
                                                            <input type="hidden" name="sgst_percent" id="sgst_percent" value="<?= (isset($tax['sgst']) ? $tax['sgst'] : '0'); ?>">
                                                            <input type="hidden" name="cgst_percent" id="cgst_percent" value="<?= (isset($tax['cgst']) ? $tax['cgst'] : '0'); ?>">

                                                            <input type="hidden" name="vat_amt" id="vat_amt" value="<?= (isset($order['vat_amt']) ? $order['vat_amt'] : '0'); ?>">
                                                            <input type="hidden" name="sgst_amt" id="sgst_amt" value="<?= (isset($order['sgst_amt']) ? $order['sgst_amt'] : '0'); ?>">
                                                            <input type="hidden" name="cgst_amt" id="cgst_amt" value="<?= (isset($order['cgst_amt']) ? $order['cgst_amt'] : '0'); ?>">

                                                            <input type="hidden" name="tax_amt" id="tax_amt" value="<?= (isset($order['tax_amt']) ? $order['tax_amt'] : '0'); ?>">

                                                            <input type="hidden" name="sub_total" id="sub_total" value="<?= (isset($order['sub_total']) ? $order['sub_total'] : '0.00'); ?>">
                                                            <input type="hidden" name="total" id="total" value="<?= (isset($order['total']) ? $order['total'] : '0.00'); ?>">

                                                            <input type="hidden" name="discount_id" id="discount_id" value="<?= (isset($order['discount_id']) ? $order['discount_id'] : '0'); ?>">
                                                            <input type="hidden" name="discount_percent" id="discount_percent" value="<?= (isset($order['discount_percent']) ? $order['discount_percent'] : '0'); ?>">
                                                            <input type="hidden" name="discount_amt" id="discount_amt" value="<?= (isset($order['discount_amt']) ? $order['discount_amt'] : '0'); ?>">

                                                            <input type="hidden" name="grand_total" id="grand_total" value="<?= (isset($order['grand_total']) ? $order['grand_total'] : '0.00'); ?>">
                                                            <input type="hidden" name="dis_per_val" id="dis_per_val" value="<?= (isset($order['discount_percent']) ? $order['discount_percent'] : '0'); ?>">
                                                            <input type="hidden" name="dis_fix_val" id="dis_fix_val" value="<?= (isset($order['discount_amt']) ? $order['discount_amt'] : '0'); ?>">
                                                            <input type="hidden" name="totalitem" id="totalitem" value="<?= (isset($order['items']) ? $order['items'] : '0'); ?>">
                                                            <input type="hidden" name="prev_sub_total" id="prev_sub_total" value="<?= (isset($order['sub_total']) ? $order['sub_total'] : '0.00'); ?>">
                                                            <input type="hidden" name="prev_totalitem" id="prev_totalitem" value="<?= (isset($order['items']) ? $order['items'] : '0'); ?>">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-check complimentary float-right text-right">
                                                                <span class="">
                                                                    <h4>Sub Total <i class="fas fa-rupee-sign"></i> <b id="span_sub_total"></b></h4>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 ">
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="form-check complimentary float-right text-right">
                                                                    <span class="">
                                                                        <h4>Vat (<span id="span_vat_percent"></span> %) <i class="fas fa-rupee-sign"></i> <b id="span_vat_amt"></b></h4>
                                                                    </span>
                                                                    <span class="">
                                                                        <h4>SGST (<span id="span_sgst_percent"></span> %) <i class="fas fa-rupee-sign"></i> <b id="span_sgst_amt"> </b></h4>
                                                                    </span>
                                                                    <span class="">
                                                                        <h4>CGST (<span id="span_cgst_percent"></span> %) <i class="fas fa-rupee-sign"></i> <b id="span_cgst_amt"></b></h4>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-header pb-0 pt-1 pl-1 pr-1 mt-1 mr-1 ml-1  " id="headingTwo">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 ">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-check complimentary float-right text-right">
                                                                <span class="">
                                                                    <h4>Total <i class="fas fa-rupee-sign"></i> <b id="span_total"></b></h4>
                                                                </span>
                                                                <span class="">
                                                                    <h4>Discount <span id="span_discount_percent" style="display:none;"></span> <i class="fas fa-rupee-sign"></i> <b id="span_discount_amt"></b></h4>
                                                                </span>
                                                                <span class="">
                                                                    <h4>Grant Total <i class="fas fa-rupee-sign"></i> <b id="span_grand_total"></b></h4>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" pt-2 pb-2">
                                                <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                                                    <button class="btn btn-sm btn-outline-primary orderType_Btn px-md-4"  id="save_kot"><strong>KOT</strong></button>
                                                    <button class="btn btn-sm btn-primary px-md-2" id="kot_print"><strong>KOT and Print</strong></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="addCustomer" class="modal fade" role="dialog" data-keyboard="true" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content col-md-6 m-auto">
            <div class="modal-header">
                <h4 class="modal-title text-center">Add Customer</h4>
            </div>
            <div class="modal-body" style="overflow: auto;">
                <div class="main-grid">
                    <div class=" ">
                        <form role="form" method="post" name="customerForm" id="customerForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="c_name">Name</label>
                                            <input type="text" id="c_name" name="c_name" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile / Phone No</label>
                                            <input type="text" id="mobile" name="mobile" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email">E-Mail</label>
                                            <input type="text" id="email" name="email" autocomplete="off" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="dob">DoB</label>
                                            <input type="date" id="dob" name="dob" autocomplete="off" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="doa">DoA</label>
                                            <input type="date" id="doa" name="doa" autocomplete="off" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="doa">Address</label>
                                            <textarea id="address" name="address" class="form-control" autocomplete="off" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row text-center d-flex justify-content-around">
                                        <div class="col-sm-12 ">
                                            <input type="hidden" id="add_type" name="add_type" value="1">
                                            <input type="hidden" id="main_id" name="main_id" value="0">
                                            <input type="hidden" name="restaurant_id" id="restaurant_id" value="<?= $session_data['restaurant_id']; ?>">
                                            <button class="btn btn-primary saveChange px-md-4" id="update" type="submit" data-form="customerForm"><i class="fa fa-save" style="display: none"></i>Save </button>
                                            <button class="btn btn btn-outline-danger px-md-4" type="button" data-dismiss="modal"><i class="fa fa-save" style="display: none"></i>Cancel </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" id = "confirmdelete" data-form="mainfrm">Confirm</button>
        <button type="button" class="btn btn-warning" id="cancelmenu" data-dismiss="modal">Cancel</button>
      </div> -->
        </div>

    </div>
</div>
<script>
    var customer_id = <?= ($order['customer_id'] ?? 1); ?>;
</script>