<style>
  #comingsoonModal{
    top: 40% !important;
  }
</style>


<!-- <input type="hidden" id="rurl" value="<?= $rurl;?>"> -->

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="">
      <div class="card-body">
              <div class="container balance_sheet">
                <!-- <button  id="exportExcel" class="btn btn-primary mb-2">Download XL</button> -->
                <table class="table " id="profitlossSheet">
                  <thead>
                    <tr >
                      <th colspan="4" class="reastaurant__name" >Demo41Reastaurant 
                      </th>
                    </tr>
                    <tr >
                      <th colspan="4" class="reastaurant__name" >Trading and Profit Loss Account 
                      </th>
                    </tr>
                    <tr>
                      <th scope="col" colspan="2">Particulars</th>
                      <th scope="col" colspan="2">Particulars</th>
                    </tr>
                </thead>
                
                <tbody>
                  <tr>
                    <th>Opening Stock</th>
                    <th id="openstock"><?php echo $OpeningStock[0]['TotalPrice'];?></th>
                    <th >Sales Accounts </th>
                    <th id="saleacc">Sales Done : <?php echo $SaleDoneBILLAmount['BillAmountTotal'] ?> <br> Sales Credit : <?php echo $SalePending['TotalbillAmountPending'] ?></th>
                  </tr>
                  <tr>
                    <th>Purchase Accounts</th>
                    <th id="purchaseacc"> <?php echo $cashOUT['CashOUTAmount'] ?></th>
                    <th></th>
                    <th></th>
                  </tr> 

                  <?php 
                    $arr1 = explode(",",$ClosingStock['close_stock']);
                    $arr2 = explode(",",$ClosingStock['price']);
                    $total = array();
                    foreach ($arr1 as $key=>$qty) {
                      if($arr2[$key] =="Not Taken"){
                        $arr2[$key]= 0;
                      }
                      $total[] = $qty * $arr2[$key];
                    }
                    $close = array_sum($total);

                  ?>
                  <tr>
                    <th>Direct Expenses</th>
                    <th id="directexp"><?php echo $DirectExpense['TotalPrice'] ?></th>
                    <th>Closing Stock</th>
                    <th id="closestock"><?php echo $close  ;?></th>
                  </tr>
                  <tr>
                    <th>Gross profit c/o</th>
                    <th id="grossprofit_c/o">
                      <?php 
                        echo $gross = $SaleDoneBILLAmount['BillAmountTotal']+ $close - $OpeningStock[0]['TotalPrice'];
                      ?>
                    </th>
                    <th>Gross Loss c/o</th>
                    <th id="grossloss_c/o"></th>
                  </tr>
                  <tr>
                    <th>Gross Loss b/f</th>
                    <th id="grossloss_b/f"></th>
                    <th>Gross profit b/o</th>
                    <th id="grossprofit_b/f"><?php 
                        echo $gross = $SaleDoneBILLAmount['BillAmountTotal']+ $close - $OpeningStock[0]['TotalPrice'];
                      ?></th>
                  </tr>
                  <tr>
                    <th></th>
                    <th id="gross_totalA">Total:</th>
                    <th></th>
                    <th id="gross_totalB">Total:</th>
                  </tr>
                  <!-- <tr>
                    <th >Indirect Expenses</th>
                    <th ><input type="number"   class="form-control "  id="indirectexp" /></th>
                    <th>Indirect Incomes</th>
                    <th ><input type="number"   class="form-control "  id="indirectinc" /></th>
                  </tr>
                  <tr>
                    <th>Nett Profit</th>
                    <th id="netprofit"></th>
                    <th>Nett Loss</th>
                    <th id="netloss"></th>
                  </tr>
          
                  <tr>
                    <th>Total</th>
                    <th id="netprofit_total"></th>
                    <th>Total</th>
                    <th id="netloss_total"></th>
                  </tr> -->

                </tbody>
                </table>
             
              </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- col-md-12 -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->


  <!-- Coming Soon popup start -->
                   
  <div class="modal fade" id="comingsoonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          </div>
                          <div class="modal-body text-center">WORKING COMING SOON!</div>
                          <div class="modal-footer">
                            </div>
                          </div>
                      </div>
                    </div>
                    <!-- div containing the popup End -->




<!-- gross profit  = Total Sale + Closing Stock - opening Stock -->