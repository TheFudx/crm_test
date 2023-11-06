<style type="text/css">
  .loan__box{
    margin : 0px !important;
    padding : 5px !important;
  }
	.loan__input{
    width: 105px;
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
                <table class="table " id="balanceSheet">
                  <thead>
                    <tr >
                      <th colspan="4" class="reastaurant__name text-capitalize"><?php echo $RestaurantData['restaurant_name'];?> <br>as at DD-MM-YYYY</th>
                    </tr>
                    <tr >
                      <?php $year = date("Y");?>
                      <th colspan="4" >Balance Sheet <br>1-Apr-<?php echo $year-1 ;?> to 31-Mar-<?php  echo $year;?> </th>
                    </tr>
                    <tr>
                      <th scope="col" colspan="2">Liabilities</th>
                      <th scope="col" colspan="2">Assets</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>Capital Account :</th>
                    <!-- <th><?php echo $cashInvestment['amount'];?></th> -->
                    <!-- <th><?php echo $cashOut['amount'];?></th> -->
                    <th id="capital"><?= $cashInvestment['amount'] ?? '';?></th>
                    <th>Fixed Assets :</th>
                    <th id="fixedassets"><?php echo $fixedassets[0]['TotalPrice'];?></th>
                  </tr>
                  
                  <tr>
                    <th >Loans (Liability) :</th>
                    <th class="loan__box"><input type="number" name="loan_liability" id="loan" class="form-control loan__input"   /></th>
                    <th>Current Assets :</th>
                    <th id="currentassets"><?php echo $currentassets[0]['TotalPrice'];?></th>
                  </tr>
                  
                  <tr>
                    <th>Current Liabilities :</th>
                    <th id="currentliability"><?php echo $CurrentLiabilities['billAmount'];?></th>
                    <th>Suspense A/c :</th>
                    <th class="loan__box"><input type="number" name="suspense" id="suspense" class="form-control loan__input"  /></th>
                  </tr>
                  <tr>
                    <th >Profit & Loss A/c :</th>
                    <th ></th>
                    <th >Non Current Assets :</th>
                    <th ></th>
                  </tr>
                  <tr>
                    <th></th>
                    <th></th>
                    <th>Profit & Loss A/c :</th>
                    <th></th>
                  </tr>
                  <tr>
                    <th>Total :</th>
                    <th id="totalLiabality"></th>
                    <th>Total :</th>
                    <th id="totalassets"></th>
                  </tr>
                  

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














