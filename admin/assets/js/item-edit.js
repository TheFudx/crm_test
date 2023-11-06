'use strict';
var controller = "item";
var mainid =$('#main_id').val();
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
    console.log("resData " + form);
    $.ajax({
        type: "POST",
        url: base_url + "Api/"+controller+"/save",
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

$("#repeater").createRepeater({
    showFirstItemToDefault: true,
});







    $(document).ready(function () {
            $('[name="rawmaterial[0][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[0][units]"] option:contains('+a+')').attr('selected', 'selected');
            });

            $('[name="rawmaterial[1][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[1][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[2][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[2][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[3][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[3][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[4][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[4][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[5][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[5][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[6][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[6][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[7][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[7][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[8][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[8][units]"] option:contains('+a+')').attr('selected', 'selected');
            });

            $('[name="rawmaterial[9][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[9][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[10][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[10][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[11][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[11][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            
            $('[name="rawmaterial[12][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a);
                $('[name="rawmaterial[12][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[13][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[13][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[14][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[14][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[15][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[15][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[16][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[16][units]"] option:contains('+a+')').attr('selected', 'selected');
            });

            $('[name="rawmaterial[17][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
               console.log(a)
                $('[name="rawmaterial[17][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[18][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[18][units]"] option:contains('+a+')').attr('selected', 'selected');
            });
            $('[name="rawmaterial[19][rawmaterial_id]"]').change(function(){ 
                var a =    $(this).find(':selected').attr('data-id');
                console.log(a)
                $('[name="rawmaterial[19][units]"] option:contains('+a+')').attr('selected', 'selected');
            });


        
    });
