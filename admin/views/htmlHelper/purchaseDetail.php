
<?php 
    include("../../../connection/DatabaseConnection.php");
    $invoiceNumber = $_GET['search'];

    $sqlQuery = "SELECT p.*, sp.Name, sp.Email, sp.Phone
                FROM purchase p
                INNER JOIN supplier sp ON sp.Id = p.SupplierId
                WHERE p.InvoiceNumber = '$invoiceNumber'";
    $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));

    $companyQuery = "SELECT * FROM `companyinformation`";
    $company = mysqli_fetch_assoc(mysqli_query($con, $companyQuery));
?>

<style>
    #invoiceTable thead, tbody, tfoot {
        font-weight: bold;
    }
</style>

<div class="row">
    <div class="col-md-1">
        <button class="btn btn-success btn-sm" id="purchaseBtnInformationReport">Print</button>
    </div>
    <div class="col-md-10" style="background-color:ghostwhite;" id="purchaseInformationReport">
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
                    <h3 style="font-weight: 900;">INVOICE</h3><br />
                    <h6 style="margin-top: -21px;font-size: 9px;">No. <b id="invoiceNumber">#<?php echo $invoiceNumber;?></b></h6>
                </td>
            </tr>
            <tr>
                <td> <h6 style="font-size: 11px;margin-top: -20px; text-align:center;">Email: <?php echo $company['Email'];?></h6></td>
                <td width="20%"></td>
                <td>
                    <h6 id="date" style="font-size: 11px;margin-top: -20px;">Date: <?php echo $queryResult['PurchaseDate'];?></h6>
                </td>
            </tr>
            <tr>
                <td style="text-align:right;">Supplier Name</td>
                <td style="text-align:left;"><b><?php echo $queryResult['Name'];?></b></td>
                <td width="20%"></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align:right;">Contact</td>
                <td style="text-align:left;"><b><?php echo $queryResult['Phone'];?></b> <br /><b><?php echo $queryResult['Email'];?></b></td>
                <td width="20%"></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align:right;">Payment Mode:</td>
                <td style="text-align:left;"><b><?php echo $queryResult['PaymentMode'];?></b></td>
                <td width="20%"></td>
                <td></td>
            </tr>
        </table>
        <table class="table table-bordered" id="invoiceTable" border="1">
            <thead style="text-align:center;">
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Vat/Tax</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $purchaseId = $queryResult['Id'];
                    $purchaseDetailQuery = "SELECT p.*, b.Name
                                            FROM purchasedetail p
                                            INNER JOIN books b ON b.Id = p.BookId
                                            WHERE PurchaseId = '$purchaseId'";
                    $purchaseDetails = mysqli_query($con, $purchaseDetailQuery);
                    while($row = mysqli_fetch_assoc($purchaseDetails))
                    {
                        echo "<tr>
                                    <td>".$row['Name']."</td>
                                    <td style='text-align:right;'>".number_format($row['Quantity'], 2, '.', ',')."<span>Pcs</span></td>
                                    <td style='text-align:right;'>".number_format($row['PurchaseUnitPrice'], 2, '.', ',')."</td>
                                    <td style='text-align:right;'>".number_format($row['PurchaseTax'], 2, '.', ',')."</td>
                                    <td style='text-align:right;'>".number_format($row['TotalPrice'], 2, '.', ',')."/-</td>
                                </tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="rightAlign">In Words</td>
                    <td id="amountInWords" colspan="2" class="rightAlign">
                    </td>
                    <td style="text-align:right;">Sub Total</td>
                    <td style="text-align:right;"><?php echo number_format($queryResult['SubTotal'], 2, '.', ',') ;?> /-</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;">Discount</td>
                    <td style="text-align:right;"><?php echo number_format($queryResult['Discount'], 2, '.', ',') ;?> %</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;">Grand Total</td>
                    <td style="text-align:right;" id="grandTotal"><?php echo number_format($queryResult['GrandTotal'], 2, '.', ',') ;?> /-</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;">Paid Amount</td>
                    <td style="text-align:right;"><?php echo number_format($queryResult['GrandTotal'], 2, '.', ',') ;?> /-</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;">Dues</td>
                    <td style="text-align:right;"><?php echo number_format($queryResult['Dues'], 2, '.', ',') ;?> /-</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="col-md-1">
        <input type = "hidden" value = "<?php echo $queryResult['GrandTotal'];?>" id="getConversionNumber">
    </div>
</div>

