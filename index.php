<!DOCTYPE html>
<html lang="eng">

<head>
    <!-- Material Design fonts -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="myStyle.css">

    <script src="js/canvasjs.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <script src="js/jquery-3.2.1.min.js"></script>

    <meta charset="utf-8">
    <title><?php echo "student loan forecaster"?></title>
</head>

<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">

            <div class="navbar-header">
                <a class="navbar-brand" href="#">Student Finance Forecast</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul id="mainNavBar" class="nav navbar-nav">
                    <li class="active"><a href="#">Home<span class="sr-only">(current)</span></a></li>
                    <li><a id="downloadSpreadSheet">Create .xlsx</a></li>
                    <li><a href="#" id="tableDataDisplayer" data-toggle="modal" data-target="#tableData">Table of data</a></li>
                </ul>
            </div>

            <div class="jumbotron">
                <h1>Student Finance Forecaster (Plan 2) </h1>
                <p>This website will help to predict how your student loan will increase or decrease over time considering many different parameters. These are shown at the side and can be changed or the pre-sets can be used as selected with the drop-down menu. The values that are used are kept up to date like the rpi etc and can be viewed in the table of data tab.</p>
                <p><a class="btn btn-primary btn-lg" href="https://www.slc.co.uk/" role="button">SLC website</website></a></p>
            </div>


            <div class="row" id="padder-bottom">
                <div class="col-md-4" >
                    <div class="col-md-11" id="sideBar">
                        <div class="dropdown " id="padder">
                                <label for="gradsal">Graduate Job</label>
                                <button class="btn btn-default dropdown-toggle" id="dropDown1" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Dropdown
                                </button>
                                <ul class="dropdown-menu" id="mainDropDown" aria-labelledby="dropdownMenu1">
                                    <?php
                                    require_once "getCurrPay.php";
                                    foreach ($earnings as $name=>$pay){
                                        echo "<li><a href='#'>" . $name . "</a></li>";
                                    }
                                    ?>
                                </ul>
                            <label for="tickBox" >  Use this </label>
                            <input type="checkbox" id="inlineCheckbox1" value="option1">

                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label>Graduate Salary</label>
                            <div class="input-group">
                                <span class="input-group-addon">£</span>
                                <input type="text" class="form-control txbx" id="gradSal" value="21000" aria-label="Amount (to the nearest dollar)" >
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>


                        <div class="form-group form-inline" id="padder repadder">
                            <label for="rpilabel">Current RPI</label>
                            <div class="input-group">
                                <input id="rpi" type="text" class="form-control txbx" value=<?php include_once("getRPI.php"); echo $RPI; ?> aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label for="marginlabel">Margin set by SLC</label>
                            <div class="input-group">
                                <input id="margin" type="text" class="txbx form-control" value=3 aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label>Percentage pay increase per annum</label>
                            <div class="input-group">
                                <input id="payinc" type="text" class="txbx form-control" value=4 aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label for="totalLoanAtEnd">Repayment threshold</label>
                            <div class="input-group" style="padding: 5px;">
                                <span class="input-group-addon">£</span>
                                <input id="repaymentthres" type="text" class="txbx form-control" value=21000 aria-label="Amount (to the nearest dollar)">

                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label for="totalLoanAtEnd">Repayment threshold increase</label>
                            <div class="input-group" style="padding: 5px;">
                                <input id="replaymentthresinc" type="text" class="txbx form-control" value=2 aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label for="totalLoanAtEnd">Repayment rate</label>
                            <div class="input-group" style="padding: 5px;">
                                <input id="repayrate" type="text" class="txbx form-control" value=9 aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label for="totalLoanAtEnd">Years of study</label>
                            <div class="input-group">
                                <input id="years" type="text" class="txbx form-control" value=3 aria-label="Amount (to the nearest dollar)" rel="popover" data-trigger="hover">
                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label for="totalLoanAtEnd">fees per year</label>
                            <div class="input-group">
                                <span class="input-group-addon">£</span>
                                <input id="fees" type="text" class="txbx form-control" value=9000 aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label for="totalLoanAtEnd">Year in industry, cost of year</label>
                            <div class="input-group">
                                <span class="input-group-addon">£</span>
                                <input id="yiic" type="text" class="txbx form-control" value=400 aria-label="Amount (to the nearest dollar)" rel="popover" data-trigger="hover">
                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label for="totalLoanAtEnd">Maintenance loan cost</label>
                            <div class="input-group" style="padding: 5px;">
                                <span class="input-group-addon">£</span>
                                <input id="mainLoan" type="text" class="txbx form-control" value=3000 aria-label="Amount (to the nearest dollar)">

                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label for="totalLoanAtEnd">Years taken of maintenance loan</label>
                            <div class="input-group">
                                <input id="yearsMainLoan" type="text" class="txbx form-control" value=4 aria-label="Amount (to the nearest dollar)">

                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label for="totalLoanAtEnd">Total debt</label>
                            <div class="input-group">
                                <span class="input-group-addon">£</span>
                                <input id="total" type="text" class="txbx form-control" value=000000 aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>

                        <div class="form-group form-inline" id="padder repadder">
                            <label for="totalLoanAtEnd">Finish year</label>
                            <div class="input-group">
                                <input id="endYear" type="text" class="txbx form-control" value=2020 aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>

                    </div>
                </div>



                <div class="col-md-8 graphsSide" id="graphContainermain1" style="padding-bottom: 80px" id="sideBar">
                    <div id="chartContainer" style="height: 50%; width: 100%;"></div>
                    <div id="chartContainer2" style="height: 50%; width: 100%;"></div>
                    <div class="col-md-5"></div><div class="col-md-2"><button id="modalButton" style="padding: 20px" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add another graph</button></div><div class="col-md-5"></div>
                </div>

            </div>

            <div class="container">
                <div class="center">&copy <?php echo date("Y"); ?> Jack Ferguson</div>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Choose X and Y axis</h4>
                </div>
                <div>
                    <div class="col-md-6">
                        <form action="" id = "X_axis_form">
                            <h4>X axis</h4>
                                <input type="radio" name="x" value="year"> year<br>
                                <input type="radio" name="x" value="gradSal"> Graduate Salary<br>
                                <input type="radio" name="x" value="repayment thres"> repayment Threshold<br>
                                <input type="radio" name="x" value="total paid"> Total paid back<br>
                                <input type="radio" name="x" value="total loan"> Total loan<br>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="" id="Y_axis_form">
                            <h4>Y axis</h4>
                            <input type="radio" name="y" value="year"> year<br>
                            <input type="radio" name="y" value="gradSal"> Graduate Salary<br>
                            <input type="radio" name="y" value="repayment thres"> repayment Threshold<br>
                            <input type="radio" name="y" value="total paid"> Total paid back<br>
                            <input type="radio" name="y" value="total loan"> Total loan<br>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="modalbtn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tableData" tabindex="-1" role="dialog" aria-labelledby="tableDataLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body" id="tableDataBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/postscribe/2.0.8/postscribe.min.js"></script>
<script src="mainJavascript.js"></script>
<script src="graphing.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-67080220-4', 'auto');
    ga('send', 'pageview');

</script>
</html>