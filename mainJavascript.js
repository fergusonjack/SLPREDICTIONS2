$("#mainDropDown a").click(function(e){
    e.preventDefault(); //prevent page reload
    var selText = $(this).text();
    $("#dropDown1").text(selText);
    salRequest(selText);
});

$('#inlineCheckbox1').click(function() {
    $("#txtAge").toggle(this.checked);
    if (this.checked) {
        $('#gradSal').prop('readonly', true);
    } else {
        $('#gradSal').prop('readonly', false);
    }
});

$('#inlineCheckbox1').click(function() {
    $("#txtAge").toggle(this.checked);
    if (this.checked) {
        $('#gradSal').prop('readonly', true);
    } else {
        $('#gradSal').prop('readonly', false);
    }
});

$(document).ready(function(){
    $('#modalbtn').click(function() {
        if (!$("input[name='x']:checked").val()) {
            alert('Nothing is checked!');
            return false;
        }
        else {
            $("#chartContainer2").append('<div id="chartContainer" style="height: 50%; width: 100%;">appended</div>')
        }
    });
});

//displays the correct data in the modal for table data
$(document).ready(function () {
    $("#tableDataDisplayer").click(function () {
        tableData = '<table class="table table-striped">';
        tableData += '<tr><th>Graduate Salary</th><th>' + parseInt($("#gradSal").val()) + '</th></tr>'
        tableData += '<tr><th>RPI</th><th>' + parseInt($("#rpi").val()) + '</th></tr>'
        tableData += '<tr><th>Margin</th><th>' + parseInt($("#margin").val()) + '</th></tr>'
        tableData += '<tr><th>Pay percentage increase</th><th>' + parseInt($("#payinc").val()) + '</th></tr>'
        tableData += '<tr><th>Repayment threshold</th><th>' + parseInt($("#repaymentthres").val()) + '</th></tr>'
        tableData += '<tr><th>Repayment threshold percenatge increase</th><th>' + parseInt($("#replaymentthresinc").val()) + '</th></tr>'
        tableData += '<tr><th>Repayment rate over threshold</th><th>' + parseInt($("#repayrate").val()); + '</th></tr>'
        tableData += '<tr><th>Degree years</th><th>' + parseInt($("#years").val()); + '</th></tr>'
        tableData += '<tr><th>Tuition fees</th><th>' + parseInt($("#fees").val()) + '</th></tr>'
        tableData += '<tr><th>Year in industry cost</th><th>' + parseInt($("#yiic").val()) + '</th></tr>'
        tableData += '<tr><th>Maintence loan cost</th><th>' + parseInt($("#mainLoan").val()) + '</th></tr>'
        tableData += '<tr><th>Years taken of maintence loan</th><th>' + parseInt($("#yearsMainLoan").val()) + '</th></tr>'
        tableData += '<tr><th>Total</th><th>' + parseInt($("#total").val()) + '</th></tr>'
        tableData += '<tr><th>Degree end</th><th>' + parseInt($("#endYear").val()) + '</th></tr>'
        tableData += "</table>";
        $("#tableDataBody").html(tableData)
    })
})


$(document).ready( function () {
    $("#downloadSpreadSheet").click( function () {
        identNum = Math.floor((Math.random() * 10000000) + 1)
        $.get("excelProc.php" ,
            {
                total: parseInt($("#total").val()),
                repLim: parseInt($("#repaymentthres").val()),
                thresInf: parseInt($("#replaymentthresinc").val()),
                repaymentRate: parseInt($("#repayrate").val()),
                startingPay: parseInt($("#gradSal").val()),
                RPI: parseInt($("#rpi").val()),
                margin: parseInt($("#margin").val()),
                payinf: parseInt($("#payinc").val()),
                IDNUM: identNum
            }
            , function () {
                $("#mainNavBar").append('<li><a href=/mainwebsite/exF/' + identNum + '.xlsx>Download .xlsx</a></li>')
                //$(document).append().html(data)
        })
    })
})

$(function () {
    $("#years").popover({
        title: 'Important',
        content: "Not including the year you may or may not have in industry"
    });
});

$(function () {
    $("#yiic").popover({
        title: 'Important',
        content: "If you don't have a year in industry put 0"
    });
});



$(document).ready(function() {
    $(".txbx").keydown(function (e) {
        preventChar(e);
    })
})

function preventChar(e){
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl+A, Command+A
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}


function salRequest(degree) {
    nocache = "&nocache=" + Math.random() * 1000000
    request = new ajaxRequest()
    request.open("GET" , "getCurrPay.php?deg=" + degree + nocache , true)

    request.onreadystatechange = function () {

        if (this.readyState == 4){
            if (this.status == 200){
                if (this.responseText != null){
                    $("#gradSal").val(this.responseText);
                }
            }
        }
    }

    request.send(null)
}


function ajaxRequest() {
    try{
        var request = new XMLHttpRequest();
    } catch (e1) {
        try {
            request = new ActiveXObject("Msxml2.XMLHTTP")
        } catch (e2){
            try {
                request = new ActiveXObject("Microsoft.XMLHTTP")
            } catch (e3){
                request = false
            }
        }
    }
    return request
}



