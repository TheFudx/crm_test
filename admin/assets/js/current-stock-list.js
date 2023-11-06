var controller = "Stock";

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
                    columns: [0,1,2,3,4]
                    },filename: "Current Stock List",
                    title: 'Current Stock List'
                },
                // {
                //     extend: "csvHtml5",
                //     className: "btn btn-default",
                //     exportOptions: {
                //         columns: [0,1,2,3,4]
                //     },
                //     filename: "Current Stock List",
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

function Edit(id){
    $("#main_id").val(id);
    var url = base_url+controller+"/edit";
    $("#mainfrm").attr('action', url);
    $("#mainfrm").submit();
}

function Delete(id){
    $("#main_id").val(id);
    $("#myModalDelete").modal('show');
}

$(document).on("click", "#confirmdelete", function(e) {
    e.preventDefault();
    toastr.remove();
    var btnid = $(this).attr('id');
    var formId = $(this).data('form');
    var form = $("#"+formId).serialize();
    $(".btn").prop('disabled',true);    
    $.ajax({
        type: "POST",
        url: base_url + "Api/"+controller+"/delete",
        data: form,
        dataType: "json",
        beforeSend: function() {
            $("#"+btnid).startLoading();
        },
        success: function(resData) {
            console.log("resData " + JSON.stringify(resData));
            var {status,validate,message} = resData;
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
                $("#myModalDelete").modal('hide');
                toastr.success(message)
                 window.setTimeout(function() {
                    window.location.href = base_url+controller;
                }, 1500);
            }
        }, error: function(){
            $("#"+btnid).stopLoading();
        }, complete:function(data){
            $("#"+btnid).stopLoading();
        }
    });
});