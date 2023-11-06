var table ;


function myfunction() {
     table = $('#printTable').DataTable({
        dom: "<'row'<'dt-buttons col-sm-2'B><'col-sm-2'l><'col-sm-3'f><'col-sm-5'p>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "ordering": false,
    ajax: {
        url: base_url +  "/inventory/fetch_Indent",
        type: "POST",
        data: {
          daily_required:$("#indentItem").val(),
          productType:$("#productType").val(),
        }
      },
      bDestroy:true,
      language: {
                oPaginate: {
                   sNext: '<i class="fas fa-chevron-right"></i>',
                   sPrevious: '<i class="fas fa-chevron-left"></i>',
                   sFirst: '<i class="fas fa-angle-double-left"></i>',
                   sLast: '<i class="fas fa-angle-double-right"></i>'
                },
                search: "_INPUT_",
                searchPlaceholder: "Search records"
              } ,
              buttons: {
                buttons: [
                    {
                        extend: "excelHtml5",
                        text:"Download XL",
                        className: "btn btn-primary",
                        exportOptions: {
                        columns: [0,1,2,3]
                        },
                        filename: "Indent List",
                        title: 'Indent List'
                    },
                ]

                },
                rowCallback : function( row, data ) {
                    if ( data[2] == 0.00 ) {
                        $('td:eq(2)', row).html( '<b>Not Available</b>' );
                    }
                    if ( data[3] == 0 ) {
                        $('td:eq(3)', row).html( '<b>Not Set</b>' );
                    }
                },
                });
                $("#mainGroupNav").addClass("active");
                $("#manageGroupNav").addClass("active");
  }
  
  myfunction();
  
$('#indentItem').change(function(){
    myfunction();
});


$('#productType').change(function(){
    myfunction();
});




$(document).on("click", ".saveChange", function(e) {
    e.preventDefault();
    toastr.remove();
    var btnid = $(this).attr('id');
    var formId = $(this).data('form');
    var form = $("#"+formId).serialize();
    var selected_items   = [];
    var rawmaterial = table.$(".rawmaterial", {"page": "all"});
    var stock       = table.$(".stock", {"page": "all"});
    var unit       = table.$(".unit", {"page": "all"});

    rawmaterial.each(function(index,elem){
        var rawmaterial_val  = $(rawmaterial[index]).val();
        var stock_val  = $(stock[index]).val();
        var unit_val  = $(unit[index]).val();

        // var res = course.split(",");
        selected_items.push({'stock' : stock_val,'unit' : unit_val,'rawmaterial' : rawmaterial_val}); //selected_items + id + ",";
    });

    $.ajax({
        type: "POST",
        url: base_url + "Api/item/take",
        data: {selected_items},
        dataType: "html",
        beforeSend: function(xhr, opts) {
            var OrderStock = $(".stock").val();
            if(OrderStock == 0){
                toastr.error('Order Stock is Empty');
                xhr.abort();
            }
            if ( ! table.data().any() ) {
                toastr.error('Indent Table is Empty');
                xhr.abort();
            }
        },
        success: function(resData) {
            // console.log(resData);
            // $('#printDiv').html(resData);
            newWin = window.open("");
            newWin.document.write(resData);
            newWin.document.close();
            newWin.focus(); // necessary for IE >= 10
            newWin.print();
            // newWin.close();
        }, error: function(){
            $("#"+btnid).stopLoading();
        }, complete:function(data){
            $("#"+btnid).stopLoading();
        }
    });

})


function isNumber(evt) {
    toastr.remove()
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if(charCode > 31 && (charCode < 48 || charCode > 57)) {
        toastr.error("Only Numbers Allowed")
        return false;
    }
}
