

$(function() {
    $("#exportExcel").click(function(){
         $("#balanceSheet").table2excel({
            filename: "Balance Sheet Report.xls",
            name:  "Balance Sheet Report"
        });
    });
 });
 
// function exportReportToExcel() {
//   let table = document.getElementById("balanceSheet");
//   TableToExcel.convert(table[0], { 
//      name: `BalanceSheet.xlsx`,
//      sheet: {
//      name: 'Balance Sheet Report'
//      }
//  });
// }

//  $("#exportExcel").click(function(){
//     $('<table>').append($("#table_id").DataTable().$('tr').clone()).table2excel({
//           exclude: ".excludeThisClass",
//           name: "Worksheet Name",
//           filename: "SomeFile" //do not include extension
//     });
//  });






$(document).ready(function(){
    var capital = $("#capital").text();
    var currentliability = $("#currentliability").text();
    var totalLiability = parseInt(capital) + parseInt(currentliability);
    $("#totalLiabality").text(totalLiability);
});

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
    var fixedassets = $("#fixedassets").text();
    var currentassets = $("#currentassets").text();
    // var currentliability = $("#currentliability").text();
    var totalassets = parseInt(fixedassets) + parseInt(currentassets);
    $("#totalassets").text(totalassets);
});

$(document).ready(function(){
    $("#suspense").change(function(){
        var fixedassets = $("#fixedassets").text();
        var currentassets = $("#currentassets").text();
        var suspense  = $(this).val();
        // var totalassets = parseInt(fixedassets) + parseInt(currentassets) + parseInt(suspense);
        // $("#totalassets").text(totalassets);

        if(suspense == ""){
            var totalassets = parseInt(fixedassets) + parseInt(currentassets) ;
            $("#totalassets").text(totalassets);
        }else{
            var totalassets = parseInt(fixedassets) + parseInt(currentassets) + parseInt(suspense);
             $("#totalassets").text(totalassets);
        }
        
    });
});


// var intervalId = window.setInterval(function(){

//     var capital = document.getElementById("capital");
//     var currentliability = document.getElementById("currentliability");
//     var loan = document.getElementById("loan");
//     // console.log(capital.innerText)
//     // console.log(loan.value)
//     var totalLiability = capital + currentliability;
//     if(!loan.value){
//         console.log(totalLiability)
//         document.getElementById("totalLiabality").innerHTML =
//     }else{
//         console.log("not empty")
//     }
// }, 1000);
