

<!-- <input type="hidden" id="rurl" value="<?= $rurl;?>"> -->

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="">
        <div class="card-body">
                <div class="container balance_sheet">
                  <table class="table " id="balanceSheet">
                    <thead>
                      <tr >
                        <th colspan="4" class="reastaurant__name text-capitalize"><?php echo $RestaurantData['restaurant_name'];?> <br>as at DD-MM-YYYY</th>
                      </tr>
                      <tr >
                        <th colspan="4" >Ledgers Sheet Report <br>1-Apr-2022 to 31-Mar-2023 </th>
                      </tr>
                      <tr>
                        <th scope="col" >Liability</th>
                        <th scope="col" >Misc Remarks</th>
                        <th scope="col" >Tagging</th>
                        <th scope="col" >Classification</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>Capital Account</th>
                        <th><?= $cashInvestment['amount'] ?? '';?></th>
                        <th>Balance Sheet</th>
                        <th>Liability</th>
                      </tr>
                      <tr>
                        <th>Reserves & Surplus</th>
                        <th>(Retained Earnings)</th>
                        <th>Balance Sheet</th>
                        <th>Liability</th>
                      </tr>
                      <tr>
                        <th>Current Assets</th>
                        <th><?php echo $currentassets[0]['TotalPrice'];?></th>
                        <th>Balance Sheet</th>
                        <th>Assets</th>
                      </tr>
                      <tr>
                        <th>Bank Accounts</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Assets</th>
                      </tr>
                      <tr>
                        <th>Cash-in-hand</th>
                        <th><?php echo $cashInvestment['amount'] - $cashOut['amount'];?></th>
                        <th>Balance Sheet</th>
                        <th>Assets</th>
                      </tr>
                      <tr>
                        <th>Cash</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>Deposits (Asset)</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Assets</th>
                      </tr>
                      <tr>
                        <th>Loans & Advances (Asset)</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Assets</th>
                      </tr>
                      <tr>
                        <th>Stock-in-Hand</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Assets</th>
                      </tr>
                      <tr>
                        <th>Sundry Debtors</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Assets</th>
                      </tr>
                      <tr>
                        <th>Current Liabilities</th>
                        <th><?php echo $CurrentLiabilities['billAmount'];?></th>
                        <th>Balance Sheet</th>
                        <th>Liability</th>
                      </tr>
                      <tr>
                        <th>Duties & Taxes</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Liability</th>
                      </tr>
                      <tr>
                        <th>Provisions</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Liability</th>
                      </tr>
                      <tr>
                        <th>Sundry Creditors</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Liability</th>
                      </tr>
                      <tr>
                        <th>Direct Expenses</th>
                        <th>(Expenses (Direct))</th>
                        <th>Profit & Loss</th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>Direct Incomes</th>
                        <th>(Income (Direct))</th>
                        <th>Profit & Loss</th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>Fixed Assets</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Assets</th>
                      </tr>
                      <tr>
                        <th>INDirect Expenses</th>
                        <th>(Expenses (Direct))</th>
                        <th>Profit & Loss</th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>INDirect Incomes</th>
                        <th>(Income (Direct))</th>
                        <th>Profit & Loss</th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>Investments</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Assets</th>
                      </tr>
                      <tr>
                        <th>Loans (Liability)</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Liability</th>
                      </tr>
                      <tr>
                        <th>Bank OD A/c</th>
                        <th>(Bank OCC A/c)</th>
                        <th>Balance Sheet</th>
                        <th>Liability</th>
                      </tr>
                      <tr>
                        <th>Secured Loans</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Liability</th>
                      </tr>
                      <tr>
                        <th>Unsecured Loans</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Liability</th>
                      </tr>
                      <tr>
                        <th>Misc. Expenses (ASSET)</th>
                        <th></th>
                        <th>Balance Sheet</th>
                        <th>Assets</th>
                      </tr>
                      <tr>
                        <th>Purchase Accounts</th>
                        <th></th>
                        <th>Profit & Loss</th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>Sales Accounts</th>
                        <th></th>
                        <th>Profit & Loss</th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>Suspense A/c</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      <tr>
                        <th>Profit & Loss A/c</th>
                        <th></th>
                        <th>Profit & Loss</th>
                        <th></th>
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










