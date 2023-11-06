

$(function () {
    $(document).ready(function() {
        $('#mainTable').DataTable({
            // dom: 'lBfrtip',
            dom: "<'row'<'dt-buttons col-sm-2'B><'col-sm-2'l><'col-sm-3'f><'col-sm-5'p>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            buttons: {
                buttons: [
                {
                    extend: "excelHtml5",
                    text:"Download XL",
                    className: "btn btn-primary",
                    exportOptions: {
                    columns: [0,1,2,3,4]
                    },filename: "Category Report",
                    title: 'Category Report'
                },
                // {
                //     extend: "csvHtml5",
                //     className: "btn btn-default",
                //     exportOptions: {
                //         columns: [0,1,2,3,4]
                //     },
                //     filename: "Category Report",
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

