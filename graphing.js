countx = 0;
county = 10;

datalist = [];
datalist2 = [];

$(document).ready(function () {
    chart2 = new CanvasJS.Chart("chartContainer2", {
        title: {
            text: "Total paid"
        },
        backgroundColor: "#eeeeee",
        data: [
            {
                xValueType: "dateTime",
                type: "line",
                dataPoints: datalist2
            }
        ]
    });

    chart = new CanvasJS.Chart("chartContainer", {
        title: {
            text: "Plot of loan over time"
        },
        backgroundColor: "#eeeeee",
        data: [
            {
                xValueType: "dateTime",
                type: "line",
                dataPoints: datalist
            }
        ]
    });

    chart.render();
    chart2.render();

    graduateSal = parseInt($("#gradSal").val());
    userrpi = parseInt($("#rpi").val());
    margin = parseInt($("#margin").val());
    payinc = parseInt($("#payinc").val());
    repaymentThres = parseInt($("#repaymentthres").val());
    repaymentThresInc = parseInt($("#replaymentthresinc").val());
    repayrate = parseInt($("#repayrate").val());
    years = parseInt($("#years").val());
    fees = parseInt($("#fees").val());
    industryLoan = parseInt($("#yiic").val());
    mainLoan = parseInt($("#mainLoan").val());
    mainLoanYears = parseInt($("#yearsMainLoan").val());
    total = parseInt($("#total").val());
    endYear = parseInt($("#endYear").val());
    totalCalc()
    graphReDraw()
})

$(document).ready(function () {

    $(".txbx").on("input", function () {
        graduateSal = parseInt($("#gradSal").val());
        userrpi = parseInt($("#rpi").val());
        margin = parseInt($("#margin").val());
        payinc = parseInt($("#payinc").val());
        repaymentThres = parseInt($("#repaymentthres").val());
        repaymentThresInc = parseInt($("#replaymentthresinc").val());
        repayrate = parseInt($("#repayrate").val());
        years = parseInt($("#years").val());
        fees = parseInt($("#fees").val());
        industryLoan = parseInt($("#yiic").val());
        mainLoan = parseInt($("#mainLoan").val());
        mainLoanYears = parseInt($("#yearsMainLoan").val());
        total = parseInt($("#total").val());
        endYear = parseInt($("#endYear").val());
        totalCalc()
        graphReDraw()
    })
})


function graphReDraw() {
    chart.render()
    chart2.render()
    var startYear = endYear;
    var totalMargin = margin + userrpi;
    var totalpaid = 0

    labelfor:
    for (i = 0; i <= 25; i++) {
        graduateSal = graduateSal * ((payinc + 100) / 100);
        repaymentThres = repaymentThres * ((repaymentThresInc + 100) / 100);
        payment = (graduateSal - repaymentThres) * (repayrate/100);
        total = total * ((totalMargin + 100)/100)
        total = total-payment
        
        if (total >= 0){
            totalpaid = totalpaid + payment
        }
        var taxable = graduateSal - repaymentThres;
        if (total >= 0) {
            startYear++;
            datalist[i] = ({x: (new Date((startYear).toString() + "/01/01").getTime()) , y: Math.round(total)})
            datalist2[i] = ({x: (new Date((startYear).toString() + "/01/01").getTime()), y: Math.round(totalpaid)})
        } else {
            datalist[i] = ({x: (new Date((startYear++).toString() + "/01/01").getTime()), y: 0})
            datalist2[i] = ({x: (new Date((startYear).toString() + "/01/01").getTime()) , y: Math.round(totalpaid)})
        }
    }
    chart.render();
    chart2.render()
}

function totalCalc() {
    total = ((years * fees) + industryLoan + (mainLoan * mainLoanYears));
    $("#total").val(total);
}