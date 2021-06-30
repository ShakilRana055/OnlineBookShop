<?php
    $headerName = "Cart Details";
    include("layout/topbar.php");
    include("layout/sidebar.php");
    include("../controller/InvoiceStatus.php");
?>


<div class="section-padding">
    <div class="cart-title mt-50">
        <h2>Cart Details</h2>
    </div>
<?php 
    $invoiceNumber = $_GET['search'];
    $className = '';
    $sqlQuery = "SELECT inv.*, us.Name, us.Email, us.Phone
                FROM invoice inv 
                INNER JOIN users us ON us.Id = inv.UserId
                WHERE InvoiceNumber = '$invoiceNumber'";

    $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));

    $companyQuery = "SELECT * FROM `companyinformation`";
    $company = mysqli_fetch_assoc(mysqli_query($con, $companyQuery));
    
    $Status = $queryResult['Status'];
    if($Status == "PENDING"){
        $className = "badge badge-pill badge-primary";
    }
    else if($Status == "SHIPMENT"){
        $className = "badge badge-pill badge-danger";
    }
    else{
        $className = "badge badge-pill badge-success";
    }
?>

<style>
    #invoiceTable thead, tbody, tfoot {
        font-weight: bold;
    }
</style>

<div class="row">
    <div class="col-md-1">
        <!-- <button class="btn btn-success btn-sm" id="purchaseBtnInformationReport">Print</button> -->
    </div>
    <div class="col-md-12" style="background-color:ghostwhite;" id="viewOrderInformationReport">
        
        <table class="table table-borderless">
            <tr>
                <td id="companyLogo" rowspan="2" align="right">
                    <img src="../../admin/views/htmlHelper/bookShop.jpg" width="100" height="100" alt="No" />
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
                    <h6 id="date" style="font-size: 11px;margin-top: -20px;">Date: <?php echo $queryResult['InvoiceDate'];?></h6>
                </td>
            </tr>
            <tr>
                <td style="text-align:right;">Customer Name</td>
                <td style="text-align:left;"><b><?php echo $queryResult['Name'];?></b></td>
                <td width="20%">Status</td>
                <td><span class="<?php echo $className;?>"><?php echo $Status;?></span></td>
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
        <div class="table-responsive">
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
                    $invoiceId = $queryResult['Id'];
                    $invoiceDetailQuery = "SELECT inv.*, bk.Name
                                            FROM invoicedetail inv 
                                            INNER JOIN books bk ON bk.Id = inv.BookId
                                            WHERE inv.InvoiceId = '$invoiceId'";
                    $invoiceDetails = mysqli_query($con, $invoiceDetailQuery);
                    while($row = mysqli_fetch_assoc($invoiceDetails))
                    {
                        echo "<tr>
                                    <td>".$row['Name']."</td>
                                    <td style='text-align:right;'>".number_format($row['Quantity'], 2, '.', ',')."<span>Pcs</span></td>
                                    <td style='text-align:right;'>".number_format($row['UnitPrice'], 2, '.', ',')."</td>
                                    <td style='text-align:right;'>".number_format($row['SellTax'], 2, '.', ',')."</td>
                                    <td style='text-align:right;'>".number_format($row['TotalPrice'], 2, '.', ',')."/-</td>
                                </tr>";
                    }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <!-- <td class="rightAlign">In Words</td>
                        <td id="amountInWords" colspan="2" class="rightAlign">
                        </td> -->
                        <td style="text-align:right;" colspan="4">Sub Total</td>
                        <td style="text-align:right;"><?php echo number_format($queryResult['SubTotal'], 2, '.', ',') ;?> /-</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:right;">Delivery Charge</td>
                        <td style="text-align:right;"><?php echo number_format($queryResult['DeliveryCharge'], 2, '.', ',') ;?> /-</td>
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
                        <td style="text-align:right;">0/-</td>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
        <div class="col-md-1">
            <input type = "hidden" value = "<?php echo $queryResult['GrandTotal'];?>" id="getConversionNumber">
        </div>
    </div>
</div>

<?php include("layout/footer.php");?>

