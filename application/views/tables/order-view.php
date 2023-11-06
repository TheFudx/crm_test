

<style>

fieldset {
    display: none;
}

fieldset.show {
    display: block;
}
.model_container{
    /* border:1px solid red; */
    width: 50%;
    margin: auto;
}
</style>

<?php 
// echo "<br>table_id:".$table_id;
// echo "<br>bill_id:".$bill_id;
// echo "<pre>";
// print_r($order); 
?>
<?php $i = 0; ?>
<?php  //print_r($order);?>
<div class="content-wrapper">
    <section class="content m-0">
        <div class="container-fluid m-0">
          <div class="row m-0">
            <div class="col-lg-6 col-md-6 ">
                <div class="container  p-2">
                    <div class="form-group pl-2 customtable">
                        <label class="h5"><?= $table[0]['tablename']; ?></label>
                        
                        <?php if(($order['bill_type']) === 'delivery' ){

                                if(empty($customer['c_name'])   ){
                                    $name = 'Not Selected';
                                }else{
                                    $name = $customer['c_name'];
                                }  
                                if(empty($customer['email'])   ){
                                    $email = '';
                                }else{
                                    $email = $customer['email'];
                                }  
                                if(empty($customer['mobile'])   ){
                                    $mobile = '';
                                }else{
                                    $mobile = $customer['mobile'];
                                }  
                                if(empty($customer['address'])   ){
                                    $Address = '';
                                }else{
                                    $Address = $customer['address'];
                                }   
                                echo '
                                <div class="customerTable">
                                    <table class="table OVtable" id="Customer_Details">
                                        <tbody>
                                            <thead>
                                                <th colspan="2" class="text-center ">Customer Details</th>
                                            </thead>
                                            <tr>
                                            <td><strong >Name :</strong> </td>
                                            <td >'.$name.'</td>
                                            </tr>
                                            <tr>
                                            <td><strong>Email :</strong></td>
                                            <td>'.$email.'</td>
                                            </tr>
                                            <tr>
                                            <td><strong>Mobile :</strong></td>
                                            <td>'.$mobile.'</td>
                                            </tr>
                                            <tr>
                                            <td><strong>Address:</strong></td>
                                            <td >'.$Address.'</td>
                                            </tr>
                                        </tbody>
                                        </table>
                                </div>';
                            }else{
                                echo "";
                            }?>
                    </div>
                    <div class="row">
                    <div class="btn-group btn-group-toggle pl-2" data-toggle="buttons">
                        <label class="btn btn-outline-primary orderType_Btn ">
                            <input type="radio" name="options" id="option_a1" autocomplete="off" <?php if(($order['bill_type']) === 'dinein' ){
                                echo "checked";
                            }else{
                                echo "";
                            }?> > Dine In
                        </label>
                        <label class="btn btn-outline-primary orderType_Btn">
                            <input type="radio" name="options" id="option_a2" autocomplete="off" <?php if(($order['bill_type']) === 'delivery' ){
                                echo "checked";
                            }else{
                                echo "";
                            }?>> Delivery
                        </label>
                        <label class="btn btn-outline-primary orderType_Btn">
                            <input type="radio" name="options" id="option_a3" autocomplete="off"
                            <?php if(($order['bill_type']) === 'pickup' ){
                                echo "checked";
                            }else{
                                echo "";
                            }?>> Pick up
                        </label>
                        <label class="btn btn-outline-primary orderType_Btn">
                            <input type="radio" name="options" id="option_a4" autocomplete="off"
                            <?php if(($order['bill_type']) === 'online' ){
                                echo "checked";
                            }else{
                                echo "";
                            }?>> Online
                        </label>
                    </div>
                    <?php  if(($order['bill_type']) === 'delivery' ){
                            $style = "style=' position: relative; top: -3.5rem;left: -5.5rem;'";
                        }else{ 
                            $style = "style='position: relative; right: -10rem;' "; 
                        }
                        ?>

                        <div class="col-md-5">
                            <div class=" row" id="PAX"  <?= $style ?> >
                                <label for="PAX" class="col-sm-2 col-form-label">PAX</label>
                                <input class="form-control inputPAX text-center bg-light" readonly type="number" name="pax" value="<?= (isset($order['pax']) ? $order['pax'] : ''); ?>"/>
                            </div>
                        </div>
                    </div>
                <div class="tab-content">
                    <div id="dinein" class="container tab-pane active"><br>
                        <form role="form" method="post" name="mainfrm" id="mainfrm">      
                        <!-- <form action="" id="manage-order-dineein"> -->
                            <input type="hidden" name="order_type" value="<?= (isset($order['bill_type']) ? $order['bill_type'] : ''); ?>">
                            <div class="row">
                                  
                                <div class="col-md-12" id="dinein">
                                    <table class="table OVtable" style="min-height:100px">
                                        <thead >
                                            <tr >
                                                <th scope="col" style="border-top-left-radius: 1rem !important;">Items</th>
                                                <th scope="col">Check Items</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Instruction</th>
                                                <th class="text-right" scope="col">Amount</th>
                                                <th class="text-right" scope="col" style="border-top-right-radius: 1rem !important;">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        if(isset($order['bill_item'])){
                                            foreach($order['bill_item'] as $bill_i){
                                                foreach($bill_i['kot'] as $ord1){ 
                                                    if(count($ord1['kot_item'])>0){ ?>
                                                        <tr>
                                                            <th colspan="4">KOT No. <?=$ord1['kot']?></th>
                                                            <th colspan="4" class="text-right"><a class="btn btn-sm btn-primary" href="javascript:void(0);" onclick="print_kot(<?=$ord1['Id']?>,false);" title="Print KOT">
                                                            <strong>Print KOT</strong></a></th>
                                                        </tr>
                                                        <?php
                                                        foreach($ord1['kot_item'] as $ord){
                                                            $i++;
                                                            ?>
                                                            <tr >
                                                            <td><?=$i?></td>
                                                            <td><?=$ord['item']['item_name']?></td>
                                                            <td>
                                                                <div>
                                                                <!-- <div class="value-button btn-minus" id="decrease"  value="Decrease Value">-</div> -->
                                                                <input type="number" name="qty1[]" class="number" readonly value="<?=$ord['qty']?>" style="background: transparent;">
                                                                <!-- <div class="value-button btn-plus" id="increase"  value="Increase Value">+</div> -->
                                                                </div>
                                                                <input type="hidden" name="item_id[]" id="item_id_6" value="<?=$ord['item_id']?>">
                                                                <input type="hidden" name="price[]" id="" value="<?=$ord['price']?>">
                                                                <input type="hidden" name="amount[]" id="" value="<?=$ord['amount']?>">
                                                            </td>
                                                            <td><?= $ord['instruction'];?></td>
                                                            <td class="text-right"><?=number_format($ord['amount'],2)?></td>
                                                            <td class="text-right"><?=number_format($ord['price'],2)?></td>
                                                            </tr>
                                                        <?php 
                                                        }
                                                    }
                                                }
                                            }
                                        } ?>
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
                                                    <?php if($order['status'] != 'BillRaised' && $order['status'] != 'BillPaid'){ ?>
                                                        <a class="btn btn-sm btn-outline-light addDiscount_btn" href="javascript:void(0);" title="Add Discount" data-toggle="modal" data-target="#modal-default-2"><strong>Add Discount</strong></a>
                                                        <a class="btn btn-sm btn-outline-light  addTip_btn" href="javascript:void(0);" data-toggle="modal" title="Add Tip" data-target="#modal-tip"><strong>Add Tip</strong></a>
                                                    <?php } ?>           
                                                        <input type="hidden" name="ord_id" id="ord_id" value="<?= (isset($order['Id']) ? $order['Id'] : ''); ?>">
                                                        <input type="hidden" name="table_id" id="table_id" value="<?= (isset($order['table_id']) ? $order['table_id'] : '0'); ?>">
                                                        <input type="hidden" name="tax_id" id="tax_id" value="<?= (isset($tax['tax_id']) ? $tax['tax_id'] : '0');?>">
                                                        <input type="hidden" name="vat_percent" id="vat_percent" value="<?= (isset($tax['vat']) ? $tax['vat'] : '0');?>">
                                                        <input type="hidden" name="sgst_percent" id="sgst_percent" value="<?= (isset($tax['sgst']) ? $tax['sgst'] : '0');?>">
                                                        <input type="hidden" name="cgst_percent" id="cgst_percent" value="<?= (isset($tax['cgst']) ? $tax['cgst'] : '0');?>">
                                                        
                                                        <input type="hidden" name="vat_amt" id="vat_amt" value="<?= (isset($order['vat_amt']) ? $order['vat_amt'] : '0');?>">
                                                        <input type="hidden" name="sgst_amt" id="sgst_amt" value="<?= (isset($order['sgst_amt']) ? $order['sgst_amt'] : '0');?>">
                                                        <input type="hidden" name="cgst_amt" id="cgst_amt" value="<?= (isset($order['cgst_amt']) ? $order['cgst_amt'] : '0');?>">

                                                        <input type="hidden" name="tax_amt" id="tax_amt" value="<?= (isset($order['tax_amt']) ? $order['tax_amt'] : '0');?>">

                                                        <input type="hidden" name="sub_total" id="sub_total" value="<?= (isset($order['sub_total']) ? $order['sub_total'] : '0.00'); ?>">
                                                        <input type="hidden" name="total" id="total" value="<?= (isset($order['total']) ? $order['total'] : '0.00'); ?>">
                                                        
                                                        <input type="hidden" name="discount_id" id="discount_id" value="<?= (isset($order['discount_id']) ? $order['discount_id'] : '0'); ?>">
                                                        <input type="hidden" name="discount_percent" id="discount_percent" value="<?= (isset($order['discount_percent']) ? $order['discount_percent'] : '0'); ?>">
                                                        <input type="hidden" name="discount_amt" id="discount_amt" value="<?= (isset($order['discount_amt']) ? $order['discount_amt'] : '0'); ?>">
                                                        
                                                        <input type="hidden" name="tip_amt" id="tip_amt" value="<?= (isset($order['tip_amt']) ? $order['tip_amt'] : '0'); ?>">
                                                        
                                                        <input type="hidden" name="grand_total" id="grand_total" value="<?= (isset($order['grand_total']) ? $order['grand_total'] : '0.00'); ?>">
                                                        <input type="hidden" name="dis_per_val" id="dis_per_val" value="<?= (isset($order['discount_percent']) ? $order['discount_percent'] : '0'); ?>">
                                                        <input type="hidden" name="dis_fix_val" id="dis_fix_val" value="<?= (isset($order['discount_amt']) ? $order['discount_amt'] : '0'); ?>">
                                                        <input type="hidden" name="totalitem"   id="totalitem" value="<?= (isset($order['items']) ? $order['items'] : '0'); ?>">
                                                        <input type="hidden" name="prev_sub_total" id="prev_sub_total" value="<?= (isset($order['sub_total']) ? $order['sub_total'] : '0.00'); ?>">
                                                        <input type="hidden" name="prev_totalitem"   id="prev_totalitem" value="<?= (isset($order['items']) ? $order['items'] : '0'); ?>">
                                                        <input type="hidden" name="status" id="status" value="">
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
                                                                <h4>Tip <span id="span_Tip" style="display:none;"></span> <i class="fas fa-rupee-sign"></i> <b id="span_Tip_amt"></b></h4>
                                                            </span>
                                                            <span class="">
                                                                <h4>Grant Total <i class="fas fa-rupee-sign"></i> <b id="span_grand_total"></b></h4>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-2 bg-primary">
                                                    <div class="col-lg-1 col-md-1"></div>
                                                    <div class="col-lg-2 col-md-2">
                                                        <div class="form-check complimentary">
                                                        <input class="form-check-input form-control-md payment_type" <?php if($order['payment_type'] == "Cash"){ echo "checked"; } ?> name="payment_type" type="radio" value="Cash"
                                                            id="flexCheckDefault4" checked>
                                                        <label class="form-check-label" for="flexCheckDefault4">
                                                            Cash
                                                        </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2">
                                                        <div class="form-check complimentary">
                                                        <input class="form-check-input form-control-md payment_type" <?php if($order['payment_type'] == "Card"){ echo "checked"; } ?> name="payment_type" type="radio" value="Card"
                                                            id="flexCheckDefault3">
                                                        <label class="form-check-label" for="flexCheckDefault3">
                                                            Card
                                                        </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2">
                                                        <div class="form-check complimentary">
                                                        <input class="form-check-input form-control-md payment_type" <?php if($order['payment_type'] == "Online"){ echo "checked"; } ?> name="payment_type" type="radio" value="Online"
                                                            id="flexCheckDefault2">
                                                        <label class="form-check-label" for="flexCheckDefault2">
                                                        Online
                                                        </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2">
                                                        <div class="form-check complimentary">
                                                        <input class="form-check-input form-control-md payment_type" <?php if($order['payment_type'] == "UPI"){ echo "checked"; } ?> name="payment_type" type="radio" value="UPI"
                                                            id="flexCheckDefault1">
                                                        <label class="form-check-label" for="flexCheckDefault1">
                                                            UPI
                                                        </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2">
                                                        <div class="form-check complimentary">
                                                        <input class="form-check-input form-control-md payment_type" <?php if($order['payment_type'] == "CreditPending"){ echo "checked"; } ?> name="payment_type" type="radio" value="CreditPending"
                                                            id="flexCheckDefault1">
                                                        <label class="form-check-label" for="flexCheckDefault1">
                                                            Credit
                                                        </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1"></div>
                                                </div> 
                                            </div>
                                        </div>
                                        <?php 
                                        if(isset($order['Id']) && $i > 0){
                                        ?>
                                        <div class=" pt-2 pb-2">
                                            <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                                            <?php if($order['status'] != 'BillRaised' && $order['status'] != 'BillPaid'){ ?>
                                                <button class="btn btn-sm btn-outline-primary orderType_Btn px-md-2" id="RaiseBill"><strong>Raise Bill</strong></button>

                                                
                                                <?php } ?>
                                                

                                                <!-- <button class="btn btn-sm btn-dark PrintBill" data-id="<?=$order['Id']?>"><strong>Print Bill</strong></button> -->

                                                <!-- Direct print Btn open  -->
                                                
                                                <button class="btn btn-sm btn-primary  PrintBill px-md-2" data-id="<?=$order['Id']?>" id="Dprint"><strong>Print Bill</strong></button>
                                                
                                                <!-- Direct print Btn  close -->

                                                <!-- <button  class="btn btn-sm btn-success" id="Sprint">Demo Print</button> -->

                                                <!-- <button   onclick="printContent(<?=$order['Id']?>)">Click to print table</button> -->
                                                
                                                    

                                                <!-- <a href="<?= base_url('tableorder/imprimir_comprobante'); ?>" class="btn btn-success">Print Bill</a> -->
                                                


                                                <!-- <a class="btn btn-sm btn-dark PrintBill" href="javascript:void(0);" onclick="bill_preview(<?=$order['Id']?>);" title="Bill Print" data-toggle="modal" data-target="#modal-default-1"><strong>Bill Print</strong></a> -->

                                                <!-- <a class="btn btn-sm btn-danger sendBillModel"><strong>Send Bill</strong></a>  -->
                                                
                                                <!-- <button class="btn btn-sm btn-danger" id="save_kot"><strong>KOT</strong></button>
                                                <button class="btn btn-sm btn-dark" id="kot_print"><strong>KOT & Print</strong></button> -->
                                            <?php if($order['status'] != 'BillPaid'){ ?>
                                                <button class="btn btn-sm btn-primary px-md-2  float-right" id="PayBill"><strong>Pay Bill</strong></button>
                                            <?php } ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

    <div class="modal fade" id="sendBillModel" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0">
                            <div class="tabs" id="tab01">
                                <h6 class="text-muted">Telegram</h6>
                            </div>
                            <div class="tabs active" id="tab02">
                                <h6 class="font-weight-bold">WhatsApp</h6>
                            </div>
                            <div class="tabs" id="tab03">
                                <h6 class="text-muted">Email</h6>
                            </div>
                </div>
                <div class="modal-body">
                            <fieldset id="tab011">       
                                <h1>Telegram</h1>
                            </fieldset>
                            <fieldset class="show" id="tab021">
                                <div class="model_container text-center">
                                    <form class="row g-3">
                                        <label for="Wnumber" class="col-sm-2 col-form-label">WhatsApp</label>
                                        <div class="col-auto">
                                            <input type="text" id="Wnumber" class="form-control numberOnly" maxlength="10"  placeholder="Number">
                                        </div>
                                        <a  class="btn btn-danger sendwhatsapp mt-3"  data-id="<?=$order['Id']?>">Send Bill</a>
                                    </form>
                                </div>
                            </fieldset>
                            <fieldset id="tab031">
                            <div class="model_container text-center">
                                    <form class="row g-3" >
                                    <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-auto">
                                            <input type="email" id="Email" name="email"class="form-control "   placeholder="email@example.com">
                                        </div>
                                        <a  class="btn btn-danger sendEmail mt-3" data-id="<?=$order['Id']?>">Send Bill</a>
                                        <label id="info"></label>
                                    </form>
                                </div>
                            </fieldset>
                </div>
                <div class="modal-footer">
                    <a  class="btn btn-secondary closesendBillModel">Close</a>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
function printContent(id){
newwin=window.open('','printwin','left=100,top=100,width=400,height=400')
newwin.document.write('<HTML>\n<HEAD>\n')
newwin.document.write('<TITLE>Print Page</TITLE>\n')
newwin.document.write('<script>\n')
newwin.document.write('function chkstate(){\n')
newwin.document.write('if(document.readyState=="complete"){\n')
newwin.document.write('window.close()\n')
newwin.document.write('}\n')
newwin.document.write('else{\n')
newwin.document.write('setTimeout("chkstate()",2000)\n')
newwin.document.write('}\n')
newwin.document.write('}\n')
newwin.document.write('function print_win(){\n')
newwin.document.write('window.print();\n')
newwin.document.write('chkstate();\n')
newwin.document.write('}\n')
newwin.document.write('<\/script>\n')
newwin.document.write('</HEAD>\n')
newwin.document.write('<BODY onload="print_win()">\n')
newwin.document.write('hello World'.id)
newwin.document.write('</BODY>\n')
newwin.document.write('</HTML>\n')
newwin.document.close()
}

</script>

