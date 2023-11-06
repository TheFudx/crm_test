'use strict';
var controller = "user";

$(document).ready(function(){
    var todo = $('#todo').html(); 
    if(todo === 'Add User'){
        $('.userdetails').css("display", "none");
    }
    // $('#user_photo').css("display", "none");
  
    // $('#userphoto').attr('src','');
});

$(document).on('keypress' ,'#username', function( e ) {
   if(e.which === 32) {
        toastr.error('Space Not Allowed');
        return false;
   }
});




$("form#mainfrm").submit(function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: base_url + "Api/"+controller+"/save",
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log("resData " + JSON.stringify(data));
            var {status,validate,message} = data;
            var {user_name,firstname,lastname,email,groups} = message;

            if(status == true && message === 'User Detail Updated successfully'){
                toastr.success(message);
                window.setTimeout(function () {
                    window.location.href = base_url + "user";
                  }, 1500);
            }else if(email == "The Email field must contain a valid email address."){
                toastr.warning(email);
            }else if(user_name == "The Username field must contain a valid Username."){
                toastr.warning(user_name);
            }else if(firstname == "The Firstname field must contain a valid Firstname"){
                toastr.warning(firstname);
            }else if(lastname == "The lastname field must contain a valid lastname"){
                toastr.warning(lastname);
            }else if(groups == "The Groups field must contain a valid Groups"){
                toastr.warning(groups);
            }else{
                toastr.error(message);
            }
        }, error: function(e){
            console.log(e)
        }
    });
});

// $(document).on("click", ".saveChange", function(e) {
//     e.preventDefault();
//     toastr.remove();
//     var btnid = $(this).attr('id');
//     var formId = $(this).data('form');
//     var form = $("#"+formId).serialize();
//     console.log("resData " + form);
//     $.ajax({
//         type: "POST",
//         url: base_url + "Api/"+controller+"/save",
//         data: form,
//         dataType: "json",
//         beforeSend: function() {
//             $("#"+btnid).startLoading();
//         },
//         success: function(resData) {
//             console.log("resData " + JSON.stringify(resData));
//             var {status,validate,message} = resData;
//             if (validate === false) {
//                 $.each(message, function(k, v) {
//                     if (v !== "") {
//                         toastr.error(v)
//                         $("#"+formId+" input[name='" + k + "']").focus();
//                         return false
//                     }
//                 });
//             } else if (status === false) {
//                 toastr.error(message)
//             } else {
//                 toastr.success(message)
//                  window.setTimeout(function() {
//                     window.location.href = base_url+controller;
//                 }, 1500);
//             }
//         }, error: function(){
//             $("#"+btnid).stopLoading();
//         }, complete:function(data){
//             $("#"+btnid).stopLoading();
//         }
//     });
// });





function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var file = input.files[0];//get file   
        var sizeKB = file.size / 1024;
        if(sizeKB <= 500){
            reader.onload = function (e) {
                $('#userphoto')
                    .attr('src', e.target.result)
                    .width(120)
                    .height(120);
                };
                reader.readAsDataURL(input.files[0]);
                    // set to the ajaxt send file 
            }
        }

}

function idreadURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var file = input.files[0];//get file   
        var sizeKB = file.size / 1024;
        
        if(sizeKB <= 1024){
        reader.onload = function (e) {
            $('#idphoto')
                .attr('src', e.target.result)
                .width(120)
                .height(120);
            };
            reader.readAsDataURL(input.files[0]);
                // set to the ajaxt send file 
        }
    }
}

    function addreadURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var file = input.files[0];//get file   
        var sizeKB = file.size / 1024;
        if(sizeKB <= 1024){
        reader.onload = function (e) {
            $('#addressphoto')
                .attr('src', e.target.result)
                .width(120)
                .height(120);
            };
            reader.readAsDataURL(input.files[0]);
                // set to the ajaxt send file 
        }
    }
}
