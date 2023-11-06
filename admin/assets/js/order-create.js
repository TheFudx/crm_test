var controller = "order";
$(document).ready(function() {
    calculate(true)
    getCustomer(customer_id)
});

$(document).on("click", "#save_kot", function(e) {
    Sendkot(e, false);
});

$(document).on("click", "#kot_print", function(e) {
    Sendkot(e, true);
});




function Sendkot(event, printkot){
    event.preventDefault();
    var form = $("#mainfrm").serialize();    //start_load()
    // alert(form)
    // $.ajax({
    //     type: "POST",
    //     url:base_url+'Api/order/add',
    //     data: form,
    //     processData: false,  // Important!
    //     contentType: false,
    //     cache   : false,
    //     dataType: "json",
    //     success:function(resp){
    //     }
    // });

    $.ajax({
        type: "POST",
        url: base_url + "Api/order/add",
        data: form,
        dataType: "json",
        beforeSend: function() {
            // $("#"+btnid).startLoading();
        },
        success: function(resData) {
            console.log("resData " + JSON.stringify(resData));
            var {status,validate,message, data} = resData;
            if (validate === false) {
                $.each(message, function(k, v) {
                    if (v !== "") {
                        toastr.error(v)
                        $("#"+formId+" input[name='" + k + "']").focus();
                        return false
                    }
                });
            } else if (status === false) {
                toastr.error(message)
            } else {

                toastr.success(message);
                print_kot(data,printkot)
                window.setTimeout(function() {
                    window.location.href = base_url+"tableorder";
                }, 1000);
            }
        }, error: function(){
            // $("#"+btnid).stopLoading();
        }, complete:function(data){
            // $("#"+btnid).stopLoading();
        }
    });
    return false;
}



$('#search_text').on("input", function() {
    var formId = "searchForm";
    var form = $("#"+formId).serialize();
    $('.cat_div_data').removeClass('active');
    $('.cat_div_data').removeClass('show');
    // console.log(form);
    // url = base_url+"Api/order/search/";
    var html = '<div class="row p-2">';
    $.ajax({
        type: "POST",
        url: base_url + "Api/"+controller+"/search",
        data: form,
        dataType: "json",
        beforeSend: function() {
            // $("#"+btnid).startLoading();
        },
        success: function(resData) {
            // console.log("resData " + JSON.stringify(resData));
            var {status,validate,message, data} = resData;
            if (validate === false) {
                $.each(message, function(k, v) {
                    if (v !== "") {
                        // toastr.error(v)
                        $("#"+formId+" input[name='" + k + "']").focus();
                        return false
                    }
                });
            } else if (status === false) {
                // toastr.error(message)
            } else {
                // toastr.success(message)
                var item = data.items;
                $.each(item, function(k, v) {
                    // console.log(v.cat_id);
                    html += '<div class="col-md-3 col-lg-3">';
                html += '<a onclick="getitemslist(' + v.item_id + ');" class="btn ingredient_btn" role="button"><i class="fas fa-plus-square listlogo"></i></a>';
                html += "<span data-json = '" + JSON.stringify(v) + "' > ";
                html += '<a onclick="additem_table(' + v.item_id + ');" id="additem_' + v.item_id + '" class="btn items-btn" role="button" data-prod-id="' + v.item_id + '">';
                html += '<i class="far fa-dot-circle veglogo"></i> ' + v.item_name;
                html += '</a>';
                html += '</span>';
                html += '</div>'
                    /// do stuff
                });
                html += '</div>';
                $('#cat_item').html(html);
                $('#cat_item').addClass('active');
                $('#cat_item').addClass('show');
                $('#raw_item').removeClass('show');

            }
        }, error: function(){
            // $("#"+btnid).stopLoading();
        }, complete:function(data){
            // $("#"+btnid).stopLoading();
        }
    });
});

$(document).on("click", "#searchtext", function(e) {
    var formId = "searchForm";
    var form = $("#"+formId).serialize();
    $('.cat_div_data').removeClass('active');
    $('.cat_div_data').removeClass('show');
    // console.log(form);
    // url = base_url+"Api/order/search/";
    var html = '<div class="row p-2">';
    $.ajax({
        type: "POST",
        url: base_url + "Api/"+controller+"/search",
        data: form,
        dataType: "json",
        beforeSend: function() {
            // $("#"+btnid).startLoading();
        },
        success: function(resData) {
            // console.log("resData " + JSON.stringify(resData));
            var {status,validate,message, data} = resData;
            if (validate === false) {
                $.each(message, function(k, v) {
                    if (v !== "") {
                        toastr.error(v)
                        $("#"+formId+" input[name='" + k + "']").focus();
                        return false
                    }
                });
            } else if (status === false) {
                toastr.error(message)
            } else {
                toastr.success(message)
                var item = data.items;
                $.each(item, function(k, v) {
                    // console.log(v.cat_id);
                    html += '<div class="col-md-3 col-lg-3">';
                    html += '<a onclick="getitemslist(' + v.item_id + ');" class="btn ingredient_btn" role="button"><i class="fas fa-plus-square listlogo"></i></a>';
                    html += "<span data-json = '" + JSON.stringify(v) + "' > ";
                    html += '<a onclick="additem_table(' + v.item_id + ');" id="additem_' + v.item_id + '" class="btn items-btn" role="button" data-prod-id="' + v.item_id + '">';
                    html += '<i class="far fa-dot-circle veglogo"></i> ' + v.item_name;
                    html += '</a>';
                    html += '</span>';
                    html += '</div>'
                    /// do stuff
                });
                html += '</div>';
                $('#cat_item').html(html);
                $('#cat_item').addClass('active');
                $('#cat_item').addClass('show');
                $('#raw_item').removeClass('show');

            }
        }, error: function(){
            // $("#"+btnid).stopLoading();
        }, complete:function(data){
            // $("#"+btnid).stopLoading();
        }
    });
});

function getitemslist(id) {
    // console.log(id)
    $('.raw_div_data').removeClass('active');
    $('.raw_div_data').removeClass('show');
    url = base_url+ "order/getItemsrawmaterialbycategory/"+id;
    var html = '<div class="row p-2">';
    html += '<ul class="ingredient_box" > ';
    $.ajax({
        method: "GET",
        url: url,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
            // console.log(data);
            var item = data.item_rawm;
            $.each(item, function(k, v) {
                var units = v.units;
                if(v.units==='1'){
                    units="KG";
                }if(v.units==='2'){
                    units="ML";
                }if(v.units==='3'){
                    units="LTR";
                }if(v.units==='4'){
                    units="GM";
                }if(v.units==='5'){
                    units="Pcs";
                }if(v.units==='6'){
                    units="PACKET";
                }if(v.units==='7'){
                    units="DABBA";
                }if(v.units==='8'){
                    units="BOTTLE";
                }if(v.units==='9'){
                    units="GRM";
                }if(v.units==='10'){
                    units="Pc";
                }if(v.units==='11'){
                    units="Size";
                }if(v.units==='12'){
                    units="Brik";
                }if(v.units==='13'){
                    units="Can";
                }if(v.units==='14'){
                    units="DZ";
                }if(v.units==='15'){
                    units="";
                }if(v.units==='16'){
                    units="Pkt";
                }
                // console.log(v.rawmaterial_id);
                html += '<li>'+v.rawmaterial+ '-' + v.quantity + '-' + units +'</li>'
            });
            html += '</ul>';
            html += '</div>';
            console.log(html);
            $('#raw_item').html(html);
            $('#raw_item').addClass('active');
            $('#raw_item').addClass('show');
        },
        error: function(data) {
            alert("failed");
        }
    });
}


function getitems(id) {

    butId = $(this).attr('id');
    $('.cat_div_data').removeClass('active');
    $('.cat_div_data').removeClass('show');
    $('#' + id + '_cat').html('');
    url = base_url+ "order/getItemsbycategory/"+id;
    var html = '<div class="row p-2">';
    $.ajax({
        method: "GET",
        url: url,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
            // console.log(data);
            // console.log(data.items[0].cat_id)
            var item = data.items;

            $.each(item, function(k, v) {
                // console.log(v.cat_id);

                html += '<div class="col-md-3 col-lg-3">';
                html += '<a onclick="getitemslist(' + v.item_id + ');" class="btn ingredient_btn" role="button"><i class="fas fa-plus-square listlogo"></i></a>';
                html += "<span data-json = '" + JSON.stringify(v) + "' > ";
                html += '<a onclick="additem_table(' + v.item_id + ');" id="additem_' + v.item_id + '" class="btn items-btn" role="button" data-prod-id="' + v.item_id + '">';
                html += '<i class="far fa-dot-circle veglogo"></i> ' + v.item_name;
                html += '</a>';
                html += '</span>';
                html += '</div>'
                /// do stuff
            });
            html += '</div>';
            // console.log(html);
            $('#cat_item').html(html);
            //$('#'+id+'_cat').toggle();
            $('#cat_item').addClass('active');
            $('#cat_item').addClass('show');
            //data.items.forEach(element => console.log(element));
            $('#raw_item').removeClass('show');
        },
        error: function(data) {
            alert("failed");
        }
    });
}

function additem_table(idd) {
    // console.log(idd)
    var data = $('#additem_' + idd).parent('span').attr('data-json')
    
    data = JSON.parse(data)
    if ($('#dinein tr[data-id="' + data.item_id + '"]').length > 0) {
        var tr = $('#dinein tr[data-id="' + data.item_id + '"]')
        var qty = tr.find('[name="qty[]"]').val();
        qty = parseInt(qty) + 1;
        qty = tr.find('[name="qty[]"]').val(qty);
        calculate(false)
        return false;
    }
    
    var tr = $('<tr class="o-item"></tr>')
    tr.attr('data-id', data.item_id)
    tr.append('<td>' + data.item_id + '</td>')
    tr.append('<td>' + data.item_name + '</td>')
    tr.append('<td><div><div class="value-button btn-minus" id="decrease" value="Decrease Value">-</div><input class="number" type="number" name="qty[]" id="number_'+idd+'" value="1" /><div class="value-button btn-plus" id="increase"  value="increase Value">+</div></div></td>')
    tr.append('<td>' + data.price + '</td>')
    tr.append('<td><div><input class="text" type="text" name="instruction[]" id="instruction_'+idd+'" value="" /></div></td>')
    tr.append('<td><span class="btn btn-sm btn-danger btn-rem"><b><i class="fa fa-times text-white"></i></b></span></td>')
    tr.append('<input type="hidden" name="item_id[]" id="item_id_' + data.item_id + '" value="' + data.item_id + '"><input type="hidden" name="price[]" id="" value="' + data.price + '"><input type="hidden" name="amount[]" id="" value="' + data.price + '">')
    $('#dinein tbody').append(tr)
    // qty_func()
    calculate(false)
}

$(document).on("click", "#dinein .btn-minus", function(event) {
    var qty = $(this).siblings('input').val()
    console.log($(this).siblings('input').attr('id'));
    console.log('Minus before:'+qty);
    qty = qty > 1 ? parseInt(qty) - 1 : 1;
    console.log('Minus After:'+qty);
    $(this).siblings('input').val(qty)
    calculate(false)
})
$(document).on("click", "#dinein .btn-plus", function(event) {
        var qty = $(this).siblings('input').val()
        console.log($(this).siblings('input').attr('id'));
        console.log('Plus before:'+qty);
        qty = parseInt(qty) + 1;
        console.log('Plus After:'+qty);
        $(this).siblings('input').val(qty)
        calculate(false)
    })
$(document).on("click", "#dinein .btn-rem", function(event) {
    $(this).closest('tr').remove()
    calculate(false)
})
// }
function getCustomer(id){
    url = base_url+ "order/getCustomer";
    $("#customer_id > option").remove();
    $.ajax({
        type: "GET",
        url: url, 
        success: function(cities){
           var length = Object.keys(cities).length;
           if(length > 0){
                $.each(cities,function(id,city){
                    var opt = $('<option />'); 
                    opt.val(id);
                    opt.text(city);
                    $('#customer_id').append(opt);
                });
           }else{
               $('#customer_id').append('<option value="1">Guest Customer</option>');	
           }
           $('#customer_id').val(id);
        },
       error: function(xhr, textStatus, error){
           console.log(xhr.statusText);
           console.log(textStatus);
           console.log(error);
       }
    });
}

$(document).on('click', '#addcustomerbtn', function(){
    $('#addCustomer').modal('show')
})

$(document).on("click", ".saveChange", function(e) {
    e.preventDefault();
    toastr.remove();
    var btnid = $(this).attr('id');
    var formId = $(this).data('form');
    var form = $("#"+formId).serialize();
    console.log("resData " + form);
    $.ajax({
        type: "POST",
        url: base_url + "Api/customer/save",
        data: form,
        dataType: "json",
        beforeSend: function() {
            $("#"+btnid).startLoading();
        },
        success: function(resData) {
            console.log("resData " + JSON.stringify(resData));
            var {status,validate,message,id} = resData;
            if (validate === false) {
                $.each(message, function(k, v) {
                    if (v !== "") {
                        toastr.error(v)
                        $("#"+formId+" input[name='" + k + "']").focus();
                        return false
                    }
                });
            } else if (status === false) {
                toastr.error(message)
            } else {
                toastr.success(message)
                 getCustomer(id);
                 $('#addCustomer').modal('hide')
            }
        }, error: function(){
            $("#"+btnid).stopLoading();
        }, complete:function(data){
            $("#"+btnid).stopLoading();
        }
    });
});






$(document).ready(function(){
    $('#customer_id').on('change', function() {
    $('.invoice_div_data').removeClass('active');
    $('.invoice_div_data').removeClass('show');
    var customer_id = this.value;
    var restaurant_id = $('#restaurant_id').val();

    var html = '<div class="row p-1">';
    html += '<ul class="invoice_box m-auto" > ';
        $.ajax({
            url: base_url + "Api/" + "customer/fav",
            method:'POST',
            data:{
                customer_id:customer_id,
                restaurant_id:restaurant_id
            },
            dataType: 'json',
            success:function(resp){
               
                console.log(resp);
                if(resp.status == true){
                    if(resp.data == ''){
                        html+= '<li class:"text-center list"> Not visited </li>';
                        html += '</ul>';
                        html += '</div>';
                        $('#invoice').html(html);
                        $('#invoice li').css({'transform':'translate(50px, 0px)'});
                        $('#invoice').addClass('active');
                        $('#invoice').addClass('show');
                    }else{
                        jQuery.each(resp.data, function(i, val) {
                            $.each(val, function(key, value){
                                var {InvoiceNo} = value;
                                if(key == 'visite'){
                                    if(InvoiceNo == 1){
                                        html+= '<li>'+ +'</li>'
                                    }else{
                                    var d = new Date(value);
                                    var curr_date = d.getDate();
                                    var curr_month = d.getMonth();
                                    var curr_year = d.getFullYear();
                                    const monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                                    html += '<li class="invoiceBill"><span> <strong>'+ curr_date + '-' + monthNames[curr_month]+'-' + curr_year+' </strong></span></li>'
                                    }
                                }
                            });
                            $.each(val, function(key, value){
                                if(key=="BillID"){
                                    html+='<button class="btn PrintManageBill fav_btn" data-id='+ value +' ><i class="fa fa-solid fa-eye  text-primary"></i></button>';
                                }
                            })
                        })
                        html += '</ul>';
                        html += '</div>';
                        $('#invoice').html(html);
                        $('#invoice').addClass('active');
                        $('#invoice').addClass('show');

                    }
                }
            }

        });

    });
});


$(document).on("click", "#PAX .btn-minus", function(event) {
    var qty = $(this).siblings('input').val()
    qty = qty > 1 ? parseInt(qty) - 1 : 1;
    $(this).siblings('input').val(qty)
})
$(document).on("click", "#PAX .btn-plus", function(event) {
    var qty = $(this).siblings('input').val()
    qty = parseInt(qty) + 1;
    $(this).siblings('input').val(qty)
})