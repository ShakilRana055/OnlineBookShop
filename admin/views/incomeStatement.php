<?php 
    $headerName = '- Income Statement';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>
<style>
    .odd {
        background-color: #b3ffff;
    }

    .even {
        background-color: #b3b3ff;
    }

    #purchaseProductList tr, td {
        text-align: center;
    }

    .rightAlign {
        text-align: right;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div id="headingOne" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#advanceSearchProductList" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Income Statement</h5>
                </button>
            </div>
            <div class="card-body">
                <div id="advanceSearchProductList" class="collapse show">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Start Date</label>
                                <input type="text" class="datepicker form-control" id="startDate" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">End Date</label>
                                <input type="text" class="datepicker form-control" id="endDate" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-sm" id="resetIncomeStatement">Reset</button>
                <button class="btn btn-secondary btn-sm" id="showIncomeStatment">Show</button>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="display:none;" id="showIncomeReport">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#incomeReport" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Income Statement Report</h5>
                </button>
            </div>
            <div class="card-body">

                <div id="incomeReport" class="collapse show">


                </div>
            </div>
        </div>
    </div>
</div>


<?php include("layout/footer.php");?>

<script>
        (function () {
            let ajaxOperation = new AjaxOperation();

            function GeneratePurchaseInRange() {
                var purchaseList = $("#purchaseBtnIncomeList").dataTable({
                    "processing": true,
                    "serverSide": false,
                    "filter": true,
                    "pageLength": 10,
                    "autoWidth": false,
                    'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                    "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
                    "order": [[0, "desc"]],
                    "columnDefs": [ { "className": "custome", "targets": [0, 1, 2, 3] }],
                });
            }
            function GenerateSalesInRange() {
                var salesList = $("#salesBtnIncomeList").dataTable({
                    "processing": true,
                    "serverSide": false,
                    "filter": true,
                    "pageLength": 10,
                    "autoWidth": false,
                    'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                    "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
                    "order": [[0, "desc"]],
                    "columnDefs": [{ "className": "custome", "targets": [0, 1, 2, 3] },],
                });
                    
            }

            let selector = {
                resetIncomeStatement: $("#resetIncomeStatement"),
                showIncomeStatment: $("#showIncomeStatment"),
                startDate: $("#startDate"),
                endDate: $("#endDate"),
                showIncomeReport: $("#showIncomeReport"),
                incomeReport: $("#incomeReport"),

                incomeStatement: "",
                printBtnIncomeStatement: $("#printBtnIncomeStatement"),
            }

            selector.resetIncomeStatement.click(function () {
                selector.startDate.val("");
                selector.endDate.val("");
            });

            selector.showIncomeStatment.click(function () {
                if (selector.startDate.val() != "" && selector.endDate.val() != "") {
                    let jsonData = {
                        startDate: selector.startDate.val(),
                        endDate: selector.endDate.val(),
                    };
                    let htmlData = ajaxOperation.GetAjaxHtmlByJson("htmlHelper/incomeStatementDetail.php", jsonData);
                    selector.showIncomeReport.show();
                    selector.incomeReport.html(htmlData);
                    selector.incomeStatement = htmlData;
                    $("#firstIncomeBtn").click();
                    GeneratePurchaseInRange();
                    GenerateSalesInRange();
                }
                else {
                    toastr.error("Fill Up the Range!", "Error");
                }

            });
            selector.resetIncomeStatement.click(function () {
                selector.showIncomeReport.hide();
                selector.startDate.val("");
                selector.endDate.val("");
            });

            $(document).on("click", "#printBtnIncomeStatement", function () {
                printDiv("printIncomeStatement");
                setTimeout(function () {
                    printDiv("printIncomeStatement");
                }, 500);
            });
        })();
    </script>