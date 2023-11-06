$(function () {
    $(document).ready(function() {
        $('#mainTable').DataTable({
            // dom: 'lBfrtip',
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
                    columns: [0,1,2,3,4,5,6]
                    },filename: "Credit Payment Pending List",
                    title: 'Credit Payment Pending List'
                },
                // {
                //     extend: "csvHtml5",
                //     className: "btn btn-default",
                //     exportOptions: {
                //         columns: [0,1]
                //     },
                //     filename: "Credit Payment List",
                // },
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
        $("#mainGroupNav").addClass('active');
        $("#manageGroupNav").addClass('active');
    });
});

  $(document).on("click", ".getdetail", function (e) {
    
    var invoice_no = $(this).data("invoice_no");
    var restaurant_id = $(this).data("restaurant_id");
    var customer_id = $(this).data("customer_id");
    // console.log(restaurant_id);
    e.preventDefault();
    toastr.remove();
    $.ajax({
      type: "POST",
      url: base_url + "Api/creditpayment/getdetail",
      data: { 
        invoice_no : invoice_no,
        restaurant_id : restaurant_id, 
      },
      dataType: "json",
      success: function (resData) {

        console.log(resData);
        var { status, message, grand_total,invoice_no , restaurant_id,customer_id } = resData;
        if (status === true) {
          $("#payNowModal").modal("show");
          // $("#BillAmount").html(billAmount);
          $("#invoice_no").html(invoice_no);
          $("#BillAmount").html(grand_total);
          $("#invoiceNo").val(invoice_no);
          $("#restaurant_id").val(restaurant_id);
          $("#BillAmounts").val(grand_total);
          $("#customer_id").val(customer_id);

        } else if (status == false) {
          toastr.warning(message);
          return false;
        }
      },
      error: function (err) {

        console.log(JSON.stringify(err));
      },
    });
    return false; //stop the actual form post !important!
  });



  $(document).on("click", "#paynow", function (e) {
    var restaurant_id = $("#restaurant_id").val();
    var invoice_no = $("#invoiceNo").val();
    var grand_total = $("#BillAmounts").val();
    var customer_id = $("#customer_id").val();
     var room = $('#room').val();
  
    e.preventDefault();
    toastr.remove();
    $.ajax({
      type: "POST",
      url: base_url + "Api/creditpayment/creditpayamount",
      data: {
        restaurant_id : restaurant_id,
        invoice_no : invoice_no,
        grand_total : grand_total,
        customer_id : customer_id,
         room:room
      },
      dataType: "json",
      success: function (resData) {
        console.log(resData);
        var { status, validate, message } = resData;
        if (validate === false) {
          $.each(message, function (k, v) {
            if (v !== "") {
              toastr.error(v);
              $("#" + formId + " #'" + k).focus();
              return false;
            }
          });
        } else if (status === false) {
          toastr.error(message);
        } else {
          toastr.success(message);
          window.setTimeout(function () {
            window.location.href = base_url + "creditpayment/creditpaymentPending";
          }, 1500);
        }
      },
      error: function (err) {

        console.log(JSON.stringify(err));
      },
    });
    return false; //stop the actual form post !important!
  });