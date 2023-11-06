var controller = "tableorder";
var myInterval ;
var tables = [];
function secondsTimeSpanToHMS(s,id) {
    var h = Math.floor(s / 3600); //Get whole hours
    s -= h * 3600;
    var m = Math.floor(s / 60); //Get remaining minutes
    s -= m * 60;
    $("#seconds_"+id).html((s < 10 ? '0' + s : s));
    $("#minutes_"+id).html((m < 10 ? '0' + m : m));
    $("#hours_"+id).html((h < 10 ? '0' + h : h));
  }

function ShowTimer() {
    tables.forEach(table => {
        id = table['id'];
        s = ++table['sec'];
        console.log(`id : ${id} -- sec : ${s}`);
        var h = Math.floor(s / 3600); //Get whole hours
        s -= h * 3600;
        var m = Math.floor(s / 60); //Get remaining minutes
        s -= m * 60;
        $("#seconds_"+id).html((s < 10 ? '0' + s : s));
        $("#minutes_"+id).html((m < 10 ? '0' + m : m));
        $("#hours_"+id).html((h < 10 ? '0' + h : h));
    });
  }
  
$(function () {
    $(document).ready(function() {
        $("#mainGroupNav").addClass('active');
        $("#manageGroupNav").addClass('active');
        gettabledetails();
        
    });
});

    $(document).on("click", ".createorder", function(e) {
        var id = $(this).attr('table_id');
        $("#main_id").val(id);

        var bill_id = $(this).attr('bill_id');
        var table_id = $(this).attr('table_id');
        $("#table_id").val(table_id);
        $("#bill_id").val(bill_id);

        var url = base_url+controller+"/create";
        $("#mainfrm").attr('action', url);
        $("#mainfrm").submit();
    });

    $(document).on("click", ".vieworder", function(e) {
        var bill_id = $(this).attr('bill_id');
        var table_id = $(this).attr('table_id');
        $("#table_id").val(table_id);
        $("#bill_id").val(bill_id);
        var url = base_url+controller+"/view";
        $("#mainfrm").attr('action', url);
        $("#mainfrm").submit();
    });

    function gettabledetails() {
        // console.log('gettabledetails');
        $.ajax({
            url: base_url +'Api/order/gettabledetails',
            method:'POST',
            data:{restaurant_id},
            dataType: 'json',
            success:function(resp){
                console.log(JSON.stringify(resp));
                if(resp.status == true){
                    LoadTables(resp.data);
                    setTimeout( function(){
                        gettabledetails();
                    }, 5000);
                }else{
                    toastr.error(resp.message);
                }
          }
        })
        return false;
    }
        function LoadTables(table_data){
        tables = [];
        var box = '';
        $("#tabledata").html('');
        table_data.forEach(table_s => {
            // console.log('Each Row : '+JSON.stringify(table_s));
            var table_status_val = '';
            var border = "";
            if(table_s['ord_status'] == "BillPaid"){ 
                table_status_val = "background-color:#dc3545;";  
                border = "border :none !important;";
            }else if(table_s['ord_status'] == "InCooking"){ 
                table_status_val = "background-color:#28a745; "; 
                border = "border :none !important";
            }else if(table_s['ord_status'] == "OrderTaken"){ 
                table_status_val = "background-color:#17a2b8;"; 
                border = "border :none !important";
            }else if(table_s['ord_status'] == "KitchenAccept"){ 
                table_status_val = "background-color:#20c997;";
                border = "border :none !important"; 
            }else if(table_s['ord_status'] == "OrderReady"){ 
                table_status_val = "background-color:#fd7e14;"; 
                border = "border :none !important";
            }else if(table_s['ord_status'] == "PickedUpByWaiter"){ 
                table_status_val = "background-color:#6610f2;";
                border = "border :none !important"; 
            }else if(table_s['ord_status'] == "OrderOnTable"){ 
                table_status_val = "background-color:#6c757d;"; 
                border = "border :none !important";
            }else if(table_s['ord_status'] == "BillRaised"){ 
                table_status_val = "background-color:#e83e8c;"; 
                border = "border :none !important";
            }else{ 
                table_status_val = "background-color:bg-light;";
            }
            var span_OrderOnTable = 'none';
            var span_PrintBill = 'none';
            var span_ViewOrder = 'none';
            var span_EmptyTable= 'none';
            if(table_s['ord_status'] == 'PickedUpByWaiter'){ span_OrderOnTable = "inline";}
            if(table_s['ord_status'] == 'BillPaid' || table_s['ord_status'] == 'BillRaised'){ span_PrintBill = "inline";}
            if(table_s['ord_status'] != '' && table_s['ord_status'] != 'KitchenReject'){ span_ViewOrder = "inline";}
            if(table_s['ord_status'] == 'BillPaid'){ span_EmptyTable = "inline";}

            box = ` <div class="col-lg-2 col-md-3 col-sm-6 btn" >
                            <span class="watchHistory" id="watch"  style="display:${span_ViewOrder};">
                            <a class="btn btn-app action-btn historyBTN" bill_id="${table_s['bill_id']}" tablename="${table_s['tablename']}" ><i class="fas fa-user-clock"></i></a>
                            </span>
                            <div class="small-box hotel-tab  blank-tab " style="${table_status_val}">
                                <div class="inner text-center hotel-table" style="${border}">
                                    <span class=" createorder"  table_id="${table_s['table_id']}" bill_id="${table_s['bill_id']}" >
                                        <div>${table_s['tablename']}</div>
                                        <div>&nbsp;</div>
                                        <div> 
                                            <span id="hours_${table_s['table_id']}" class="hours">00</span>:<span id="minutes_${table_s['table_id']}" class="minutes">00</span>:<span id="seconds_${table_s['table_id']}" class="seconds">00</span>
                                        </div>
                                    </span>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 table-box">
                                                <span style="display:${span_OrderOnTable};" id="OrderOnTable_${table_s['table_id']}">
                                                    <a class="btn btn-app action-btn" href="javascript:void(0);" onclick="orderstatusupdateTable(${table_s['table_id']},'OrderOnTable');" title="Order On Table">
                                                    <i class="fas fa-concierge-bell"></i> 
                                                    </a>
                                                </span>
                                                <span style="display:${span_PrintBill};" id="PrintBill_${table_s['table_id']}">
                                                    <a class="btn btn-app action-btn PrintBill" data-id="${table_s['bill_id']}" href="javascript:void(0);">
                                                    <i class="fas fa-print"></i>
                                                    </a>
                                                </span>
                                                <span style="display:${span_ViewOrder};" id="ViewOrder_${table_s['table_id']}">
                                                    <a class="btn btn-app action-btn vieworder"  table_id="${table_s['table_id']}" bill_id="${table_s['bill_id']}">
                                                        <i class="far fa-eye"></i> 
                                                    </a>
                                                </span>
                                                <span style="display:${span_EmptyTable};" id="EmptyTable_${table_s['table_id']}">
                                                    <a class="btn btn-app action-btn" href="javascript:void(0);" onclick="tableEmpty(${table_s['table_id']});" >
                                                        <i class="far fa-window-close"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
        $("#tabledata").append(box);
        clearInterval(myInterval);
        if(table_s['table_stime'] > 0){
            console.log(table_s['table_id']);
            console.log(table_s['table_stime']);
            var sec = table_s['table_stime'];
            tables.push({'id': table_s['table_id'],'sec' : ++sec});
            // secondsTimeSpanToHMS(++sec,table_s['table_id']);
        }
    });
    ShowTimer();
    myInterval = setInterval( function(){
        ShowTimer();
        console.log('in set interval');
        // secondsTimeSpanToHMS(++sec,table_s['table_id']);
    }, 1000);
    console.log('tables:'+JSON.stringify(tables));
    }
    
    
    
    
    
    
    
    
   
    $(document).on('click',".historyBTN",function (event) { 
    var bill_id = $(this).attr('bill_id');
    var tablename = $(this).attr('tablename');
    console.log(bill_id);
    var time = '';
        if(bill_id == 0){
            $('#myEmpty').modal('show');
            $(".Tablename").html(tablename + " Empty");
        }else{
            $.ajax({
                type: "GET",
                url: base_url + "Api/" + controller + "/watch",
                data: {
                    bill_id:bill_id
                },
                dataType: "json",
                beforeSend: function() {
                    // $("#"+btnid).startLoading();
                },
                success: function(respData) {
                    $('#myOrderHistory').modal('show');
                    $(".Tablename").html(tablename );
                    var arr = respData.data;
        
                    arr.forEach((v,i)=>{ 
                        if(v.status === 'OrderTaken'){
                            $(".OrderTaken").html("<strong>"+v.status + " : </strong>"+ v.create_date);
                            $(".InCooking").html("");
                            $(".OrderReady").html("");
                            $(".PickedUpByWaiter").html("");
                            $(".OrderOnTable").html("");
                            $(".BillRaised").html("");
                            $(".BillPaid").html("");
                            time = v.create_date;
                        }
                        if(v.status === 'InCooking'){
                            var start = new Date(time);
                            var end = new Date(v.create_date);
                            var day = end.getDay() - start.getDay();
                            var hrs = end.getHours() - start.getHours();
                            var min = end.getMinutes() - start.getMinutes(); 
                            var sec = end.getSeconds() - start.getSeconds();  
                            var hour_carry = 0;
                            var minutes_carry = 0;
                            if(min < 0){
                                min += 60;
                                hour_carry += 1;
                            }
                            hrs = hrs - hour_carry;
                            if(sec < 0){
                                sec += 60;
                                minutes_carry += 1;
                            }
                            min = min - minutes_carry;
                            // $(".InCooking").html("<strong>"+v.status +" : </strong>" + day + " Day"+ hrs + " hrs " + min +" min " + sec + " sec ");
                            $(".InCooking").html("<strong>"+v.status +" : </strong>" +  hrs + " hrs " + min +" min " + sec + " sec ");

                            $(".OrderReady").html("");
                            $(".PickedUpByWaiter").html("");
                            $(".OrderOnTable").html("");
                            $(".BillRaised").html("");
                            $(".BillPaid").html("");
                            time = v.create_date;
                        }
                        if(v.status === 'OrderReady'){
                            var start = new Date(time);
                            var end = new Date(v.create_date);
                            var hrs = end.getHours() - start.getHours();
                            var min = end.getMinutes() - start.getMinutes(); 
                            var sec = end.getSeconds() - start.getSeconds();  
                            var hour_carry = 0;
                            var minutes_carry = 0;
                            if(min < 0){
                                min += 60;
                                hour_carry += 1;
                            }
                            hrs = hrs - hour_carry;
                            if(sec < 0){
                                sec += 60;
                                minutes_carry += 1;
                            }
                            min = min - minutes_carry;
                            $(".OrderReady").html("<strong>"+v.status +" : </strong>" + hrs + " hrs " + min +"min " + sec + " sec ");

                            $(".PickedUpByWaiter").html("");
                            $(".OrderOnTable").html("");
                            $(".BillRaised").html("");
                            $(".BillPaid").html("");
                            time = v.create_date;
                        }
                        if(v.status == 'PickedUpByWaiter'){
                            var start = new Date(time);
                            var end = new Date(v.create_date);
                            var hrs = end.getHours() - start.getHours();
                            var min = end.getMinutes() - start.getMinutes(); 
                            var sec = end.getSeconds() - start.getSeconds();  
                            var hour_carry = 0;
                            var minutes_carry = 0;
                            if(min < 0){
                                min += 60;
                                hour_carry += 1;
                            }
                            hrs = hrs - hour_carry;
                            if(sec < 0){
                                sec += 60;
                                minutes_carry += 1;
                            }
                            min = min - minutes_carry;
                            $(".PickedUpByWaiter").html("<strong>"+v.status +" : </strong>" + hrs + " hrs " + min +" min " + sec + " sec ");

                            $(".OrderOnTable").html("");
                            $(".BillRaised").html("");
                            $(".BillPaid").html("");
                            time = v.create_date;
                        }
                        if(v.status === 'OrderOnTable'){
                            var start = new Date(time);
                            var end = new Date(v.create_date);
                            var hrs = end.getHours() - start.getHours();
                            var min = end.getMinutes() - start.getMinutes(); 
                            var sec = end.getSeconds() - start.getSeconds();  
                            var hour_carry = 0;
                            var minutes_carry = 0;
                            if(min < 0){
                                min += 60;
                                hour_carry += 1;
                            }
                            hrs = hrs - hour_carry;
                            if(sec < 0){
                                sec += 60;
                                minutes_carry += 1;
                            }
                            min = min - minutes_carry;
                            $(".OrderOnTable").html("<strong>"+v.status +" : </strong>" + hrs + " hrs " + min +" min " + sec + " sec ");
               
                            $(".BillRaised").html("");
                            $(".BillPaid").html("");
                            time = v.create_date;
                        }
                        if(v.status == 'BillRaised'){
                            var start = new Date(time);
                            var end = new Date(v.create_date);
                            var hrs = end.getHours() - start.getHours();
                            var min = end.getMinutes() - start.getMinutes(); 
                            var sec = end.getSeconds() - start.getSeconds();  
                            var hour_carry = 0;
                            var minutes_carry = 0;
                            if(min < 0){
                                min += 60;
                                hour_carry += 1;
                            }
                            hrs = hrs - hour_carry;
                            if(sec < 0){
                                sec += 60;
                                minutes_carry += 1;
                            }
                            min = min - minutes_carry;
                            $(".BillRaised").html("<strong>"+v.status +" : </strong>" + hrs + " hrs " + min +" min " + sec + " sec ");
                          
                            $(".BillPaid").html("");
                            time = v.create_date;
                        }
                        if(v.status == 'BillPaid'){
                            var start = new Date(time);
                            var end = new Date(v.create_date);
                            var hrs = end.getHours() - start.getHours();
                            var min = end.getMinutes() - start.getMinutes(); 
                            var sec = end.getSeconds() - start.getSeconds();  
                            var hour_carry = 0;
                            var minutes_carry = 0;
                            if(min < 0){
                                min += 60;
                                hour_carry += 1;
                            }
                            hrs = hrs - hour_carry;
                            if(sec < 0){
                                sec += 60;
                                minutes_carry += 1;
                            }
                            min = min - minutes_carry;
                            $(".BillPaid").html("<strong>"+v.status +" : </strong>" + hrs + " hrs " + min +" min " + sec + " sec ");
                            time = v.create_date;

                            var starts = new Date(time);
                            var ends = new Date();
                            var hrss = ends.getHours() - starts.getHours();
                            var mins = ends.getMinutes() - starts.getMinutes(); 
                            var secs = ends.getSeconds() - starts.getSeconds();  
                            var hours_carry = 0;
                            var minutess_carry = 0;
                            if(mins < 0){
                                mins += 60;
                                hours_carry += 1;
                            }
                            hrss = hrss - hours_carry;
                            if(secs < 0){
                                secs += 60;
                                minutess_carry += 1;
                            }
                            mins = mins - minutess_carry;
                            $(".customerOnTable").html("<strong> Customer On Table" +" : </strong>" + hrss + " hrs " + mins +" min " + secs + " sec ");
                        }else{
                            $(".customerOnTable").html("");
                        }

   

                    });
                  
                }, error: function(){

                }, complete:function(data){

                }
            
            });
        }
  
    });