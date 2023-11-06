<style>

input[type="search"] {
  color: red;
  border-radius: 0.75rem;
  padding: 9px 4px 9px 40px;
  background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat 13px center;
  background-color: white;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="">
    <!-- Content Header (Page header) -->
    <!-- <div class="content-header"> -->
      <!-- <div class="container-fluid"> -->

        <!-- <div class="row mb-2"> -->
          <!-- <div class="col-sm-6"> -->
            <!-- <h1 class="m-0">Day End History</h1> -->
          <!-- </div> -->
          <!-- /.col -->
          <!-- <div class="col-sm-6"> -->
            <!-- <ol class="breadcrumb float-sm-right"> -->
            <!-- <a role="button" onclick="goBack()" class="btn btn-outline-danger"><i class="fas fa-chevron-left mr-1"></i><strong>BACK</strong></a> -->
            <!-- </ol> -->
          <!-- </div> -->
          <!-- /.col -->
        <!-- </div> -->
        <!-- /.row -->
       
      <!-- </div> -->
      <!-- /.container-fluid -->
    <!-- </div> -->
    <!-- /.content-header -->
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- <div class="card search-card">
            <div class="card-title p-3" data-toggle="collapse" href="#collapseExample">
                <h4><i class="fas fa-search mr-1"></i>Search</h4>
            </div>
                <div class="card-body collapse" id="collapseExample">
                  <form role="form">

                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="">From</label>
                                <input type="date" name="" class="form-control form-control-sm" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="">To</label>
                                <input type="date" name="" class="form-control form-control-sm" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="">Biller</label>
                                <select class="form-control form-control-sm">
                                <option>All</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer collapse" id="collapseExample">
                    <span><a href="" class="btn btn-sm btn-outline-danger ml-2" role="button">RESET</a></span>
                    <span><a href="" class="btn btn-sm btn-danger " role="button">SEARCH</a></span>
                </div>
                </form>
        </div> -->
        <div class="">
        <div class="card-body">
            <div class="table">


                    <table id="mainTable" class="table   table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Sr No.</th>
                            <th>Day End by</th>
                            <th width="10%">Day End on</th>
                            <th>Invoice Range</th>
                            <th>Day Amount</th>
                            <th>Day Start Balance</th>
                            <th>Day End Balance</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1;?>
                          <?php foreach ($data as $item){?>
                              <tr>
                              <td ><?php echo $i++;?></td>
                                
                                <?php if($item['username'] == '0'){ ?>
                              <th> <?php echo " "; ?> </th>
                                <?php } else { ?>
                                  
                                    <th > <?php echo $item['username'] ; ?> </th>
                                  <?php } ?>
                                  <td><?php echo $item['dayendtime'] ; ?></td>
                                  <td><?php echo $item['order_bill_range'] ; ?></td>
                                  <td><?php echo $item['dayAmount'] ; ?></td>
                                  <!--<td><?php echo $item['start_amount'] ; ?></td>-->
                                  <!--<td><?php echo $item['final_amount'] ; ?></td>-->
                                  <td><?php 
                                  // echo $item['start_amount'] ;
                                  // echo $item['Starting_amount'] ;
                                  echo  ($item['cashIn'] - $item['cashOut']) + $item['Starting_amount'] ;
                                  // echo  ($item['cashIn'] - $item['cashOut']) + $item['dayAmount'] ;
                                  ?></td>
                                  <td><?php 
                                  // echo $item['final_amount'];
                                  // echo $item['Ending_amount'];
                                  echo ($item['cashIn'] - $item['cashOut'] ) + $item['Ending_amount'] ;
                                  // echo ($item['cashIn'] - $item['cashOut'] ) + $item['dayAmount'] ;
                                   ?></td>
                                  
                  
                              </tr>
                          <?php } ?>
                        </tbody>
                      </table>
            </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>