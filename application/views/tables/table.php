    <div class="tabel__conatainer container-fluid">
      <div class="row">
        <div class="legend order_status col-lg-2 col-12">
          <!-- <button class="btn bg-gray">Move KOT / Items</button> -->
          <span class="legend-span"><i class="fas fa-circle text-white"></i>  Blank Table</span>
          <span class="legend-span"><i class="fas fa-circle text-cyan "></i>  Order Taken</span>
          <!--<span class="legend-span"><i class="fas fa-circle text-teal"></i>  Kitchen Accept</span>-->
          <span class="legend-span"><i class="fas fa-circle text-green"></i> In Cooking</span>
          <span class="legend-span"><i class="fas fa-circle text-orange"></i>  Order Ready</span>
          <span class="legend-span"><i class="fas fa-circle text-indigo"></i>  Picked Up By Waiter</span>
          <span class="legend-span"><i class="fas fa-circle text-secondary"></i>  Order On Table</span>
          <span class="legend-span"><i class="fas fa-circle text-pink"></i>  Bill Raised</span>
          <span class="legend-span"><i class="fas fa-circle text-danger"></i> Bill Paid</span>
        </div>
        <section class="content col-lg-10 col-6">
          <form id="mainfrm" name="mainfrm" method="POST">
            <input type="hidden" id="main_id" name="main_id" value="">
            <input type="hidden" id="table_id" name="table_id" value="">
            <input type="hidden" id="bill_id" name="bill_id" value="">
          </form>
          <div class="container-fluid">
            <div class="row p-2" id="tabledata">
            </div>
          
        </section>
        
      </div>

    </div>
    
    
    
    
    <!-- View Order History Modal -->
<div id="myOrderHistory" class="modal fade" role="dialog" data-keyboard="true"  tabindex="-1">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="Tablename text-center"></h4>
      </div>
      <div class="modal-body" style="overflow: auto;">
        <div class="main-grid text-center" style="font-size: 18px;">
          <p class="OrderTaken"></p>
          <p class="InCooking"></p>
          <p class="OrderReady"></p>
          <p class="PickedUpByWaiter"></p>
          <p class="OrderOnTable"></p>
          <p class="BillRaised"></p>
          <p class="BillPaid"></p>
          <p class="customerOnTable"></p>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<div id="myEmpty" class="modal fade" role="dialog" data-keyboard="true"  tabindex="-1">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body" style="overflow: auto;">
        <div class="main-grid">
          <h3 class="Tablename text-center"></h3>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

    
    <script>
      var restaurant_id = <?= ($restaurant_id ?? 0); ?>;
    </script>