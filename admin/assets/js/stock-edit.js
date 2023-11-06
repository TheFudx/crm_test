'use strict';
var controller = "inventory";
var rurl       = $('#rurl').val();

$(document).on("change", ".rawmaterial_id", function(e) {
    var id = $(this).attr('id');
    var myArray = id.split("_");
    var unit = $('option:selected', this).attr('data-id');
    $( ".lblunits" ).eq(myArray[1]).html(unit);
});


$(document).on("click", ".saveChange", function(e) {
    e.preventDefault();
    toastr.remove();
    var btnid = $(this).attr('id');
    var formId = $(this).data('form');
    var form = $("#"+formId).serialize();
    // console.log("resData " + form);
    $.ajax({
        type: "POST",
        url: base_url + "Api/"+controller+"/"+rurl+"_save",
        data: form,
        dataType: "json",
        beforeSend: function() {
            $("#"+btnid).startLoading();
            var total = $("#total_amount").val();
            if(total == 0){
                toastr.warning('Total is Empty');
            }
        },
        success: function(resData) {
            // console.log("resData " + JSON.stringify(resData));
            var {status,validate,message} = resData;
            if (validate === false) {
                $.each(message, function(k, v) {
                    if (v !== "") {
                        toastr.error(v)
                        $("#"+formId+" #" + k + "").focus();
                        return false
                    }
                });
            } else if (status === false) {
                toastr.error(message)
            } else {
                toastr.success(message)
                 window.setTimeout(function() {
                    window.location.href = base_url+rurl;
                }, 1500);
            }
        }, error: function(err){
            // alert(JSON.stringify(err))
            console.log(JSON.stringify(err))
            $("#"+btnid).stopLoading();
        }, complete:function(data){
            $("#"+btnid).stopLoading();
        }
    });
});

$(document).on("change", "#paid_amount, #total_amount", function (e) {
    console.log('keyup');
    var total_amount = $('#total_amount').val();
    var paid_amount = $('#paid_amount').val();
    if (parseFloat(total_amount) < parseFloat(paid_amount)) {
      toastr.error(`Paid Amount cannot be more then ${total_amount}`);
      $("#paid_amount").val("").focus();
      $("#payment_type").val(0);
    }else if(parseFloat(total_amount) == parseFloat(paid_amount)) {
        $("#payment_type").val(1);
    }else{
        $("#payment_type").val(2);
    }
  });


$("#repeater").createRepeater({
    showFirstItemToDefault: true,
});





function isNumber(evt) {
    toastr.remove()
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if(charCode > 31 && (charCode < 48 || charCode > 57)) {
        toastr.error("Only Numbers Allowed")
        return false;
    }
}




var sum=0;
$(document).on("change", ".price, .stock", function (e) {
    // sum+=Number($(this).val());
    unit();
    // $("#total_amount").val(sum);
});


$(function() {
    $("#addAll").click(function() {
        var add = 0;
        $(".amt").each(function() {
            add += Number($(this).val());
        });
        $("#total_amount").val(add);
    });
});

function unit(){
    for (let index = 0; index < 50; index++) {
        var a = $('#purchase_'+index+'_stock').val();
        var b = $('#purchase_'+index+'_price').val();
        var price = parseFloat(b/a);
        $('#purchase_'+index+'_rateofunit').val(price.toFixed(2));
    }
   
}

