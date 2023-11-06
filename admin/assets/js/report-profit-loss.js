
$(function() {
    $("#exportExcel").click(function(){
         $("#profitlossSheet").table2excel({
            filename: "Profit & loss Sheet Report.xls",
            name:  "rofit & loss Sheet Report"
        });
    });
 });
 



//  this is for net Profit Total Start

    //  section A Total 
$(document).ready(function(){
    var openstock = $("#openstock").text();
    var purchaseacc = $("#purchaseacc").text();
    var directexp = $("#directexp").text();
    var grossprofit_co = $("#grossprofit_c/o").text();
    var grossloss_bf = $("#grossloss_b/f").text();
    var gross_totalA = parseInt(openstock) + parseInt(purchaseacc) + parseInt(directexp) + parseInt(grossprofit_co) + parseInt(grossloss_bf) ;
    $("#gross_totalA").text(gross_totalA);
});




$(document).ready(function(){
    var openstock = $("#openstock").text();
    var purchaseacc = $("#purchaseacc").text();
    var directexp = $("#directexp").text();
    var grossprofit_co = $("#grossprofit_c/o").text();
    var grossloss_bf = $("#grossloss_b/f").text();
    var indirectexp = $("#indirectexp").text();
    var netprofit = $("#netprofit").text();
    var netprofit_total = parseInt(openstock) + parseInt(purchaseacc) + parseInt(directexp) + parseInt(grossprofit_co) + parseInt(grossloss_bf) + parseInt(indirectexp) + parseInt(netprofit);
    $("#netprofit_total").text(netprofit_total);
});
//  this is for net Profit Total END


//  this is for net loss Total Start

     //  section B Total 
$(document).ready(function(){
    var saleacc = $("#saleacc").text();
    var closestock = $("#closestock").text();
    var grossloss_co = $("#grossloss_c/o").text();
    var grossprofit_bf = $("#grossprofit_b/f").text();
    var gross_totalB = parseInt(saleacc)  + parseInt(closestock) + parseInt(grossloss_co) + parseInt(grossprofit_bf);
    $("#gross_totalB").text(gross_totalB);
});



$(document).ready(function(){

    var saleacc = $("#saleacc").text();
    var directinc = $("#directinc").text();
    var closestock = $("#closestock").text();
    var grossloss_co = $("#grossloss_c/o").text();
    var grossprofit_bf = $("#grossprofit_b/f").text();
    var indirectinc = $("#indirectinc").text();
    var netloss = $("#netloss").text();
    var netloss_total = parseInt(saleacc) + parseInt(directinc) + parseInt(closestock) + parseInt(grossloss_co) + parseInt(grossprofit_bf) + parseInt(indirectinc) + parseInt(netloss);
    $("#netloss_total").text(netloss_total);
});




//  this is for net loss Total End



$(document).ready(function(){
    $("#loan").change(function(){
        var capital = $("#capital").text();
        var currentliability = $("#currentliability").text();
        var loan  = $(this).val();
        if(loan == ""){
            var totalLiability = parseInt(capital) + parseInt(currentliability) ;
            $("#totalLiabality").text(totalLiability);
        }else{
            var totalLiability = parseInt(capital) + parseInt(currentliability) + parseInt(loan);
            $("#totalLiabality").text(totalLiability);
        }
    });
});



$(document).ready(function(){
    $("#suspense").change(function(){
        var fixedassets = $("#fixedassets").text();
        var currentassets = $("#currentassets").text();
        var suspense  = $(this).val();

        if(suspense == ""){
            var totalassets = parseInt(fixedassets) + parseInt(currentassets) ;
            $("#totalassets").text(totalassets);
        }else{
            var totalassets = parseInt(fixedassets) + parseInt(currentassets) + parseInt(suspense);
            $("#totalassets").text(totalassets);
        }
        
    });
});




$(window).on('load', function() {
    $('#comingsoonModal').modal('show');
});