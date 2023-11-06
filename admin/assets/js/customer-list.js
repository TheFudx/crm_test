var controller = "customer";

$(function () {
  $(document).ready(function () {
    $("#mainTable").DataTable({
    // dom: "lBfrtip",
    dom: "<'row'<'dt-buttons col-sm-2'B><'col-sm-2'l><'col-sm-3'f><'col-sm-5'p>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      buttons: {
        buttons: [
          {
            extend: "excelHtml5",
            text:"Download XL",
            className: "btn btn-primary",
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5],
            },
            filename: "Customer List",
            title: 'Customer List'
          },
        //   {
        //     extend: "csvHtml5",
        //     className: "btn btn-default",
        //     exportOptions: {
        //       columns: [0, 1, 2, 3, 4, 5],
        //     },
        //     filename: "Customer List",
        //   },
        ],
      },
      language: {
        oPaginate: {
           sNext: '<i class="fas fa-chevron-right"></i>',
           sPrevious: '<i class="fas fa-chevron-left"></i>',
           sFirst: '<i class="fas fa-angle-double-left"></i>',
           sLast: '<i class="fas fa-angle-double-right"></i>'
        },
        search: "_INPUT_",
        searchPlaceholder: "Search records"
      } 
    });
    $("#mainGroupNav").addClass("active");
    $("#manageGroupNav").addClass("active");
  });
});

function Edit(id) {
  $("#main_id").val(id);
  var url = base_url + controller + "/edit";
  $("#mainfrm").attr("action", url);
  $("#mainfrm").submit();
}

function Delete(id) {
  $("#main_id").val(id);
  $("#myModalDelete").modal("show");
}

$(document).on("click", "#confirmdelete", function (e) {
  e.preventDefault();
  toastr.remove();
  var btnid = $(this).attr("id");
  var formId = $(this).data("form");
  var form = $("#" + formId).serialize();
  $(".btn").prop("disabled", true);
  $.ajax({
    type: "POST",
    url: base_url + "Api/" + controller + "/delete",
    data: form,
    dataType: "json",
    beforeSend: function () {
      $("#" + btnid).startLoading();
    },
    success: function (resData) {
      console.log("resData " + JSON.stringify(resData));
      var { status, validate, message } = resData;
      if (validate === false) {
        $.each(message, function (k, v) {
          if (v !== "") {
            toastr.error(v);
            $("#" + formId + " input[name='" + k + "']").focus();
            return false;
          }
        });
      } else if (status === false) {
        toastr.error(message);
      } else {
        $("#myModalDelete").modal("hide");
        toastr.success(message);
        window.setTimeout(function () {
          window.location.href = base_url + controller;
        }, 1500);
      }
    },
    error: function () {
      $("#" + btnid).stopLoading();
    },
    complete: function (data) {
      $("#" + btnid).stopLoading();
    },
  });
});






$(document).on("click", ".View_btn", function(event) {
  event.preventDefault();
  var customer_id = $(this).attr('data-id');
  var restaurant_id = $(this).attr('data-restaurant_id');
  var b = 1;
  // var a = '';
  $.ajax({
    url: base_url + "Api/" + controller + "/view",
      method:'POST',
      data:{customer_id:customer_id,
        restaurant_id:restaurant_id},
      dataType: 'json',
      success:function(resp){
          // var a = (JSON.stringify(resp.data));
          // console.log(a)
          $("#div_customer_view_bill").html('');
          if(resp.status == true){
            $("#modal-customer-view-bill").modal('show');
            jQuery.each(resp.data, function(i, val) {
            $.each(val, function(key, value){
              if(b==1){
                if( (key == 'Name') || (key == 'Mobile') || (key == 'Address') || (key == 'Mobile') || (key == 'Address')){
                  $("#div_customer_view_bill").append('<div class="customerDetailes"><strong > '+ key + "</strong> : <span >" + value + '</span>');
                }
                if((key == 'InvoiceNo') || (key == 'visite') ){
                  $("#div_customer_view_bill").append('<span class=" invoice__Box"><strong>'+key + '</strong> :</span> <span class=" invoice__Box">' + value + '</span>');
                }
                if(key == 'BillID'){
                  $("#div_customer_view_bill").append('');
                }
              }else{
                if((key == 'InvoiceNo') || (key == 'visite') ){
                  $("#div_customer_view_bill").append('<span class=" invoice__Box"><strong>'+key + '</strong> :</span> <span class=" invoice__Box">' + value + '</span>');
                }
                if(key == 'BillID'){
                  $("#div_customer_view_bill").append('');
                }
              }
            })
            $.each(val, function(key, value){
              if(key=="BillID"){
                $("#div_customer_view_bill").append('<button class="btn PrintManageBill" data-id='+ value +' ><i class="fa fa-solid fa-eye  text-primary"></i></button>');
              }
            })
            b++;
          });
  
          }else{
              toastr.error(resp.message);
          }
    }
  })
  return false;
});



$(document).on("click", "#ModelClose", function(event) {
  $('#modal-view-bill').modal('hide');
});