
<style>
  #comingsoonModal{
    top: 40% !important;
  }
</style>
<!-- Main content -->

<div class="content">
  <div class="container-fluid">

    <div class="row mb-2">
      <div class="col-sm-6">
        <!-- <h1 class="m-0">Table View</h1> -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" href="#profile" role="tab" data-toggle="tab" aria-selected="true">Order View</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#buzz" role="tab" data-toggle="tab" aria-selected="false">KOT View</a>
          </li>
        </ul>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <a role="button" href="#" class="btn ml-2"><i class="fas fa-sync-alt"></i> </a>
          <a role="button" href="#" class="btn ml-2 btn-danger"> <strong>FOOD READY</strong> </a>
          <a role="button" href="#" class="btn ml-2 btn-danger"> <strong>DISPATCH</strong> </a>
          <a role="button" href="#" class="btn ml-2 btn-danger"> <strong>DELIVERY</strong> </a>
          <a role="button" href="#" class="btn ml-2 btn-danger"> <strong>
              &lt; BACK</strong> </a>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="card">
        <div class="card-body">
          <div class="tab-content" style="margin-bottom: 25px;">
            <div role="tabpanel" class="tab-pane active" id="profile">
              <div class="row" style="margin: 0;">
                <div class="col-md-8">
                  <div class="legend">
                    <span class="legend-span"><i class="fas fa-circle gray-dot"></i> Blank Table</span>
                    <span class="legend-span"><i class="fas fa-circle blue-dot"></i> Running Table</span>
                    <span class="legend-span"><i class="fas fa-circle green-dot"></i> Printed Table</span>
                    <span class="legend-span"><i class="fas fa-circle yellow-dot"></i> Running KOT Table</span>
                    <span class="legend-span"><i class="fas fa-circle wheat-dot"></i> Paid Table</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="inputNumber" class="sr-only">Enter Order Number</label>
                      <input type="Number" class="form-control" id="exampleInputEmail1" placeholder="Enter Order No.">
                    </div>
                    <button type="submit" class="btn btn-primary">Online Food Ready</button>
                  </form>
                </div>
              </div>
              <div class="row">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" href="#dine-in" role="tab" data-toggle="tab" aria-selected="true">
                      <div class="order-from" style="justify-content: center; flex-direction: column; align-items: center;">
                        <img src="<?= base_url(); ?>assets/images/dine-in.png" style="width: 30px;">
                        <p>Dine In</p>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link coming_soon" href="#delivery-bike" role="tab" data-toggle="tab" aria-selected="true">
                      <div class="order-from" style="justify-content: center; flex-direction: column; align-items: center;">
                        <img src="<?= base_url(); ?>assets/images/delivery-bike.png" style="width: 30px;">
                        <p>Delivery</p>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link coming_soon" href="#pickup" role="tab" data-toggle="tab" aria-selected="true">
                      <div class="order-from" style="justify-content: center; flex-direction: column; align-items: center;">
                        <img src="<?= base_url(); ?>assets/images/pickup.png" style="width: 30px;">
                        <p>Pick up</p>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link coming_soon" href="#fudx" role="tab" data-toggle="tab" aria-selected="true">
                      <div class="order-from" style="justify-content: center; flex-direction: column; align-items: center;">
                        <img src="<?= base_url(); ?>assets/images/fudx.png" style="width: 30px;">
                        <p>FUDX</p>
                      </div>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link coming_soon" href="#swiggy" role="tab" data-toggle="tab" aria-selected="true">
                      <div class="order-from" style="justify-content: center; flex-direction: column; align-items: center;">
                        <img src="<?= base_url(); ?>assets/images/swiggy.png" style="width: 30px;">
                        <p>Swiggy</p>
                      </div>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link coming_soon" href="#zomato" role="tab" data-toggle="tab" aria-selected="true">
                      <div class="order-from" style="justify-content: center; flex-direction: column; align-items: center;">
                        <img src="<?= base_url(); ?>assets/images/zomato.png" style="width: 30px;">
                        <p>Zomato</p>
                      </div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link coming_soon" href="#all" role="tab" data-toggle="tab" aria-selected="true">
                      <div class="order-from" style="justify-content: center; flex-direction: column; align-items: center;">
                        <img src="<?= base_url(); ?>assets/images/all.png" style="width: 30px;">
                        <p>All</p>
                      </div>
                    </a>
                  </li>
                </ul>
                <div class="col-md-12">
                  <div class="tab-content" style="margin-bottom: 25px;">
                    <div role="tabpanel" class="tab-pane active" id="dine-in">
                      Dine In
                    </div>
                    <div role="tabpanel" class="tab-pane" id="delivery-bike">
                      Delivery
                    </div>
                    <div role="tabpanel" class="tab-pane" id="pickup">
                      Pickup
                    </div>
                    <div role="tabpanel" class="tab-pane" id="fudx">
                      fudx
                    </div>
                    <div role="tabpanel" class="tab-pane" id="swiggy">
                      Swiggy
                    </div>
                    <div role="tabpanel" class="tab-pane" id="zomato">
                      zomato
                    </div>
                    <div role="tabpanel" class="tab-pane" id="all">
                      All
                    </div>
                  </div>
                </div>
              </div>
              <!--Tab 1-->
            </div>
            <div role="tabpanel" class="tab-pane" id="buzz">
              <div class="row">
                <div class="col-md-6">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search by Name">
                    <div class="input-group-append">
                      <button class="btn btn-success" type="submit">Go</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="legend">
                    <span class="legend-span"><i class="fas fa-circle green-dot"></i> Delivery</span>
                    <span class="legend-span"><i class="fas fa-circle yellow-dot"></i> Limit exceeds</span>
                    <span class="legend-span"><i class="fas fa-circle blue-dot"></i> FUDX</span>
                    <span class="legend-span"><i class="fas fa-circle orange-dot"></i> Swiggy</span>
                    <span class="legend-span"><i class="fas fa-circle red-dot"></i> Zomato</span>
                    <span class="legend-span"><i class="fas fa-circle wheat-dot"></i> Other</span>
                    <span class="legend-span"><i class="fas fa-circle skyblue-dot"></i> Dine In </span>
                    <span class="legend-span"><i class="fas fa-circle pink-dot"></i> Pick up </span>
                  </div>
                </div>
                <div class="col-md-12">
                  <table id="mainTable" class="table table-bordered table-hover dataTable dtr-inline">
                    <thead>
                      <tr>
                        <th>Sr No</th>
                        <th>Order No.</th>
                        <th>Order Type</th>
                        <th>Table</th>
                        <th>Customer Phone</th>
                        <th>Customer Name</th>
                        <th>No of Items</th>
                        <th>Amount</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-center"><a href="<?php echo base_url('restaurant/create') ?>" class="btn btn-default">Add New</a></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($data) :
                        $i = 1;
                        foreach ($data as $value) {
                          $class = '';
                          if ($value["status"] == "BillPaid") {
                            $class = 'class="table-danger"';
                          } else if ($value["status"] == "Cooking") {
                            $class = 'class="table-success"';
                          } else if ($value["status"] == "Ready") {
                            $class = 'class="table-warning"';
                          }
                      ?>
                          <tr <?= $class; ?>>
                            <td><?= $i++; ?></td>
                            <td><?= $value["invoice_no"] ?></td>
                            <td><?= $value["bill_type"] ?></td>
                            <td><?= $value["tablename"] ?></td>
                            <td><?= $value["mobile"] ?></td>
                            <td><?= $value["name"] ?></td>
                            <td><?= $value["items"] ?></td>
                            <td><?= $value["sub_total"] ?></td>
                            <td><?= $value["discount_amt"] ?></td>
                            <td><?= $value["tax_amt"] ?></td>
                            <td><?= $value["total"] ?></td>
                            <td><?= $value["status"] ?></td>
                            <td class="text-center">
                              <button onClick="View(<?= $value['Id']; ?>)" class="btn btn-warning"><i class="fa fa-eye"></i></button>
                            </td>
                          </tr>
                      <?php  }
                      endif; ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
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
<form id="mainfrm" action="" method="post">
  <input type="hidden" id="main_id" name="main_id" value="">
</form>

<!-- Delete Modal -->
<div id="myModalDelete" class="modal fade" role="dialog" data-keyboard="true" data-backdrop="static" tabindex="-1">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirm Deletion</h4>
      </div>
      <div class="modal-body" style="overflow: auto;">
        <div class="main-grid">
          <div class="col-md-12 ">
            Are you sure You want to Delete the selected Restaurant ?
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="confirmdelete" data-form="mainfrm">Confirm</button>
        <button type="button" class="btn btn-warning" id="cancelmenu" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>

<!-- View Modal -->
<div id="myModalView" class="modal fade" role="dialog" data-keyboard="true" data-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Restaurant View</h4>
      </div>
      <div class="modal-body" style="overflow: auto;">
        <div class="main-grid">
          <div class="row">
            <div class="col-md-3">Restaurant Name</div>
            <div class="col-md-9">
              <div class="view-data" id="res_name"></div>
            </div>
            <div class="col-md-3">Contact No.</div>
            <div class="col-md-9">
              <div class="view-data" id="res_contact"></div>
            </div>
            <div class="col-md-3">Restaurant Address</div>
            <div class="col-md-9">
              <div class="view-data" id="res_address"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




  <!-- Coming Soon popup start -->
                   
  <div class="modal fade" id="comingsoonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          </div>
                          <div class="modal-body text-center">COMING SOON!</div>
                          <div class="modal-footer">
                            </div>
                          </div>
                      </div>
                    </div>
                    <!-- div containing the popup End -->