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
    <div class="content-header">
      <div class="container-fluid">

        <div class="row ">
          <div class="col-sm-6">

          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <a role="button" onclick="goBack()" class="btn btn-outline-danger"><i class="fas fa-chevron-left mr-1"></i><strong>BACK</strong></a>
            </ol>
          </div> -->
          <!-- /.col -->
        </div><!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
   
    <!-- Main content -->
    <!-- <section class="content">
      <div class="container-fluid">
        <div class="card search-card">
          <div class="card-title p-3" data-toggle="collapse" href="#collapseExample">
            <h4><i class="fas fa-search mr-1"></i>Search</h4>
            </div>
            <form role="form">
              <div class="card-body collapse" id="collapseExample">
                <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="">Raw Material</label>
                                <input type="text" name="rawmaterial" class="form-control form-control-sm" placeholder="Raw Material">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="">Category</label>
                                <select class="form-control form-control-sm" name="">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="start_date">Start Date
                                </label>
                                <input type="date" class="form-control form-control-sm" name="" id="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label for="start_date">End Date
                                </label>
                                <input type="date" class="form-control form-control-sm" name="" id="">
                            </div>
                        </div>
                    </div>
                
                </div>
                <div class="card-footer collapse" id="collapseExample">
                  <span><a href="" class="btn btn-sm btn-danger ml-2" role="button">SEARCH</a></span>
                  <span><a href="" class="btn btn-sm btn-outline-danger " role="button">RESET</a></span>
                </div>
            </form>
        </div> -->
        <div class="">
        <div class="card-body">
            <div class="table">
                    <table id="mainTable" class="table table-responsive  table-striped">
                        <thead>
                        
                          <tr>
                            <th rowspan="2">#</th>
                            <th rowspan="2">Date</th>
                            <?php foreach ($current as $item){?>
                              <th colspan="2"><?php echo $item['rawmaterial'];?></th>
                            <?php } ?>
                          </tr>

                          <tr>
                            <?php for($i=1;$i<=count($current); $i++){?>
                                <th >opening <th>cloasing</th></th>
                            <?php } ?>
                          </tr>

                          
                        </thead>
                        <tbody>
                        <?php  $i = 1; ?>
                        <?php foreach ($data as $item){?>
                          <tr>
                              <th scope="row"><?php echo $i++;?></th>
                              <th ><?php echo $item['created_date'];?></th>
                                <?php 
                                  $open_stock = explode(',',$item['open_stock']);
                                  $close_stock = explode(',',$item['close_stock']);
                                  $count = count($close_stock);
                                 
                                      for($a=0; $a<$count;$a++){ ?>
                                        <th>
                                          <?php
                                            $OPEN = isset($open_stock[$a]) ? $open_stock[$a] : null;
                                            echo $OPEN;
                                          ?>
                                          
                                          <th>
                                          <?php echo $close_stock[$a];?>
                                          </th>
                                        </th>
                                <?php } ?>
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