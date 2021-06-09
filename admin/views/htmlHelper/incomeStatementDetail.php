<?php
    include("../../../connection/DatabaseConnection.php");
    $companyQuery = "SELECT * FROM `companyinformation`";
    $company = mysqli_fetch_assoc(mysqli_query($con, $companyQuery));
    
    $start = new DateTime($_GET['startDate']);
    $end = new DateTime($_GET['endDate']);
    
    $startDate =  $start-> format('Y-m-d');
    $endDate =  $end-> format('Y-m-d'); 

    $salesQuery = "SELECT Round(SUM(GrandTotal)) GrandTotal
                    FROM invoice
                    WHERE InvoiceDate BETWEEN '$startDate' AND '$endDate'";
    $salesResult = mysqli_fetch_assoc(mysqli_query($con, $salesQuery));

    $purchaseQuery = "SELECT ROUND(SUM(GrandTotal)) GrandTotal
                        FROM purchase
                        WHERE PurchaseDate BETWEEN '$startDate' AND '$endDate'";
    $purchaseResult = mysqli_fetch_assoc(mysqli_query($con, $purchaseQuery));
    //echo $purchaseQuery;

?>
<style>
    #invoiceTable thead, tbody, tfoot {
        font-weight: 600;
    }

    .minWidth {
        width: 20% !important;
    }

    .maxWidth {
        width: 40% !important;
    }
</style>

<ul class="nav nav-tabs">
    <li class="active">
        <a href="#reportBtnIncome" id="firstIncomeBtn" class="btn btn-outline-light btn-sm" data-toggle="tab">
            Report
        </a>
    </li>
    <li class="">
        <a href="#purchaseBtnIncome" class="btn btn-outline-light btn-sm" data-toggle="tab">
            Purchase
        </a>
    </li>
    <li class="">
        <a href="#salesBtnIncome" class="btn btn-outline-light btn-sm" data-toggle="tab">
            Sales
        </a>
    </li>
</ul>


<div class="tab-content">
    <div class="tab-pane fade in active" id="reportBtnIncome">
        <div class="row">
            <div class="col-md-1">
                <div class="row">
                    <button class="btn btn-success btn-sm" id="printBtnIncomeStatement">Print</button>
                </div>
            </div>
            <div class="col-md-10" id="printIncomeStatement" style="background-color:ghostwhite;">
                <table class="table table-borderless">
                    <tr>
                        <td id="companyLogo" rowspan="2" align="right">
                            <img src="htmlHelper/bookShop.jpg" width="100" height="100" alt="No" />
                        </td>
                        <td style="text-align:center;">
                            <h3 id="companyName" style="font-weight: 500;"><?php echo $company['Name'];?></h3><br />
                            <h6 id="companySlogan" style="margin-top: -21px;font-size: 10px;"><?php echo $company['Slogan'];?></h6>
                        </td>
                        <td width="20%"></td>
                        <td>
                            <h3 style="font-weight: 900;">Income Statement</h3><br />
                            <h6 style="margin-top: -21px;font-size: 9px;">Date. <b id="invoiceNumber"><?php echo date('d-M-Y');?></b></h6>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:center;"> Duration: <?php echo $_GET['startDate'];?> -  <?php echo $_GET['endDate'];?></td>
                    </tr>
                </table>
                <table class="table table-bordered" id="invoiceTable">
                    <thead style="text-align:center;">
                        <tr>
                            <th style=" width: 20% !important;">Description</th>
                            <th style=" width: 40% !important;"></th>
                            <th style=" width: 20% !important;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style=" width: 20% !important; text-align:center;">Total Sales</td>
                            <td style=" width: 40% !important;"></td>
                            <td style=" width: 20% !important; text-align:right;"><?php echo number_format($salesResult['GrandTotal'], 2, '.', ',');?>/-</td>
                        </tr>
                        
                        <tr>
                            <td style=" width: 20% !important; text-align:center;">Total Purchase</td>
                            <td style=" width: 40% !important;"></td>
                            <td style=" width: 20% !important; text-align:right;"><?php echo number_format($purchaseResult['GrandTotal'], 2, '.', ',');?>/-</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:right;">@Net Income</td>
                            <td style="text-align:right;"><?php echo number_format($salesResult['GrandTotal'] - $purchaseResult['GrandTotal'], 2, '.', ',');?>/-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-1">

            </div>
        </div>
    </div>
    <div class="tab-pane" id="purchaseBtnIncome">
        <table class="table table-bordered table-hover" id="purchaseBtnIncomeList" style="margin-top:10px !important;">
            <thead style="background-color:coral; text-align:center;">
                <tr>
                    <th style="text-align:center;">Invoice No.</th>
                    <th style="text-align:center;">Supplier Name</th>
                    <th style="text-align:center;">Sub Total</th>
                    <th style="text-align:center;">Grand Total</th>
                    <th style="text-align:center;">Dues</th>
                    <th style="text-align:center;">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $purchaseSubTotal = 0;
                    $purchaseGrandTotal = 0;
                    $purchaseDues = 0;
                    $purchaseInvoice = "SELECT p.*, sp.Name
                            FROM purchase p
                            INNER JOIN supplier sp ON sp.Id = p.SupplierId
                            WHERE p.PurchaseDate BETWEEN '$startDate' AND '$endDate' 
                            ORDER BY p.Id DESC";
                    $purchaseInvoiceResult = mysqli_query($con, $purchaseInvoice);
                    while($row = mysqli_fetch_assoc($purchaseInvoiceResult)){
                        $invoiceNumber = $row['InvoiceNumber']; $name = $row['Name'];
                        $grandTotal = $row['GrandTotal']; $subTotal = $row['SubTotal']; 
                        $dues = $row['Dues']; $date = $row['PurchaseDate'];
                        $purchaseSubTotal += $subTotal;
                        $purchaseGrandTotal += $grandTotal;
                        $purchaseDues += $dues;
                        echo "<tr>
                                <td>".$invoiceNumber."</td>
                                <td>".$name."</td>
                                <td>".number_format($subTotal, 2, '.', ',')."</td>
                                <td>".number_format($grandTotal, 2, '.', ',')."</td>
                                <td>".number_format($dues, 2, '.', ',')."</td>
                                <td>".$date."</td>
                            </tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr style="background-color:coral;">
                    <td colspan="2" style="text-align:right;">Total</td>
                    <td style="text-align:right;"><?php echo number_format($purchaseSubTotal, 2, '.', ',');?></td>
                    <td style="text-align:right;"><?php echo number_format($purchaseGrandTotal, 2, '.', ',');?></td>
                    <td style="text-align:right;"><?php echo number_format($purchaseDues, 2, '.', ',');?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="tab-pane" id="salesBtnIncome">
        <table class="table table-bordered" id="salesBtnIncomeList" style="margin-top:10px !important;">
            <thead style="background-color:coral; text-align:center;">
                <tr>
                    <th style="text-align:center;">Invoice No.</th>
                    <th style="text-align:center;">Customer Name</th>
                    <th style="text-align:center;">Sub Total</th>
                    <th style="text-align:center;">Grand Total</th>
                    <th style="text-align:center;">Dues</th>
                    <th style="text-align:center;">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $salesSubTotal = 0;
                    $salesGrandTotal = 0;
                    $salesDues = 0;
                    $salesInvoiceQuery = "SELECT i.*, u.Name
                            FROM invoice i
                            INNER JOIN users u on u.Id = i.UserId
                            WHERE InvoiceDate BETWEEN '$startDate' AND '$endDate'";

                    $salesInvoiceResult = mysqli_query($con, $salesInvoiceQuery);
                    while($row = mysqli_fetch_assoc($salesInvoiceResult)){
                        $invoiceNumber = $row['InvoiceNumber']; $name = $row['Name'];
                        $grandTotal = $row['GrandTotal']; $subTotal = $row['SubTotal']; 
                        $dues = $row['Dues']; $date = $row['InvoiceDate'];

                        $salesSubTotal += $subTotal;
                        $salesGrandTotal += $grandTotal;
                        $salesDues += $dues;

                        echo "<tr>
                                <td>".$invoiceNumber."</td>
                                <td>".$name."</td>
                                <td>".number_format($subTotal, 2, '.', ',')."</td>
                                <td>".number_format($grandTotal, 2, '.', ',')."</td>
                                <td>".number_format($dues, 2, '.', ',')."</td>
                                <td>".$date."</td>
                            </tr>";
                    }
                ?>


            </tbody>
            <tfoot>
                <tr style="background-color:coral;">
                    <td colspan="2" style="text-align:right;">Total</td>
                    <td style="text-align:right;"><?php echo number_format($salesSubTotal, 2, '.', ',');?></td>
                    <td style="text-align:right;"><?php echo number_format($salesGrandTotal, 2, '.', ',');?></td>
                    <td style="text-align:right;"><?php echo number_format($salesDues, 2, '.', ',');?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>




