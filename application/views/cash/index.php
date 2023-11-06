<style>

input[type="search"] {
  color: red;
  border-radius: 0.75rem;
  padding: 9px 4px 9px 40px;
  background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat 13px center;
  background-color: white;
}
.cashINOUT_BOX{
  position: absolute;
  right: 15rem;
  top: -6rem;
  
}
.Bank_BOX{
  position: absolute;
  left: 15rem;
  top: -6rem;
}
</style>
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="">
        <?php 
          $AVAILABLE = $cashIN['CashInAmount']+$BILLAmount['BillAmountTotal'];
        echo '<div class="cashINOUT_BOX">';
        echo "<p><strong>CASH IN  : </strong>".$AVAILABLE.' <i class="fas fa-rupee-sign"></i></p>';
        echo "<p><strong>CASH OUT : </strong>".$cashOUT['CashOUTAmount'].' <i class="fas fa-rupee-sign"></i></p>';
        echo "<p><strong>CASH AVAILABLE  : </strong>".round($AVAILABLE - $cashOUT['CashOUTAmount']).' <i class="fas fa-rupee-sign"></i></p>';
        echo "</div>";
        ?>
         <div class="Bank_BOX">
          <p><strong>BANK IN :</strong> <?php echo $cashBANKIN['CashBANKInAmount']?> <i class="fas fa-rupee-sign"></i></p>
          <p><strong>BANK OUT :</strong><?php echo $cashBANKOUT['CashBANKOUTAmount']?> <i class="fas fa-rupee-sign"></i></p>
          <p><strong>BANK AVAILABLE :</strong> <?php echo $cashBANKIN['CashBANKInAmount'] - $cashBANKOUT['CashBANKOUTAmount']?> <i class="fas fa-rupee-sign"></i></p>

        </div>
        <div class="card-body">
          <table id="mainTable" class="table table-bordered table-striped table-hover dataTable dtr-inline">
            <thead>
                <tr>
                    <th>Sr No</th>
                    <?php if(in_array('user', $user_permission)){ ?>
                        <th>User Name </th>
                    <?php } ?> 
                    <th>Reason</th>
                    <th>Amount</th>
                    <th>Cash Type</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
              <?php if ($data) : 
                $i = 1;
                foreach ($data as $k => $user_s) : ?>
                  <tr>
                    <td><?php echo $i++ ?></td>
                    <?php if(in_array('user', $user_permission)){ ?>
                        <td><?= $user_s['username'] ;?></td>
                    <?php } ?> 
                    <td><?php echo $user_s['reason']?></td>
                    <td><?php echo $user_s['amount']?></td>
                    <td><?php if($user_s['flow'] == 1 ){
                      echo 'BANK - '.$user_s['ctype'];
                    }else{echo $user_s['ctype'];}?></td>
                    <td><?php echo $user_s['cash_date']?></td>
                  </tr>
                <?php endforeach ?>
              <?php endif; ?>
            </tbody>
          </table>
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
