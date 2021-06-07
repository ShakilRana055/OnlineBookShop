<?php
    include("../../connection/DatabaseConnection.php");
    include("AutoGenerate.php");

    if(isset($_GET['search'])){
        $sql = "SELECT InvoiceNumber FROM purchase ORDER BY Id DESC LIMIT 1";
        $queryResult = mysqli_query($con, $sql);

        if(mysqli_num_rows($queryResult) > 0 ){
            $row = mysqli_fetch_assoc($queryResult);
            echo AutoGenerate::InvoiceNumber($row['InvoiceNumber'], "PUR-");
        }
        else{
            echo AutoGenerate::InvoiceNumber("0", "PUR-");
        } 
    }

    if(isset($_POST['Save'])){
        $Discount = $_POST['Discount'];
        $Dues = $_POST['Dues'];
        $GrandTotal = $_POST['GrandTotal'];
        $InvoiceNumber = $_POST['InvoiceNumber'];
        $PaidAmount = $_POST['PaidAmount'];
        $PaymentMode = $_POST['PaymentMode'];
        $SubTotal = $_POST['SubTotal'];
        $SupplierId = $_POST['SupplierId'];
        $PurchaseDetail = $_POST['PurchaseDetail'];
        $PurchaseDate = date('d-m-y');

        $sqlQuery = "INSERT INTO `purchase`(`InvoiceNumber`, `SupplierId`, `PurchaseDate`, `GrandTotal`, `SubTotal`, `Discount`, `Dues`, `PaymentMode`, `CreatedDate`) 
                    VALUES ('$InvoiceNumber','$SupplierId','$PurchaseDate','$GrandTotal','$SubTotal','$Discount','$Dues','$PaymentMode', '$currentDate')";
        $queryResult = mysqli_query($con, $sqlQuery);

        if($queryResult){
            $PurchaseId = mysqli_insert_id($con);

            for($i = 0; $i < count($PurchaseDetail); $i ++){
                $BookId = $PurchaseDetail[$i]['bookId'];
                $Quantity = $PurchaseDetail[$i]['quantity'];
                $PurchaseUnitPrice = $PurchaseDetail[$i]['purchaseUnitPrice'];
                $SellUnitPrice = $PurchaseDetail[$i]['sellUnitPrice'];
                $PurchaseTax = $PurchaseDetail[$i]['purchaseTax'];
                $totalPrice = $PurchaseDetail[$i]['totalPrice'];
    
                $sql = "INSERT INTO `purchasedetail`(`PurchaseId`, `BookId`, `Quantity`, `PurchaseUnitPrice`, `SellUnitPrice`, `PurchaseTax`,`TotalPrice`, `CreatedDate`) 
                        VALUES ('$PurchaseId','$BookId','$Quantity','$PurchaseUnitPrice','$SellUnitPrice','$PurchaseTax','$totalPrice','$currentDate')";
                mysqli_query($con, $sql);

                // pushing data into stock
                $searchStock = "SELECT Quantity FROM `stock` WHERE BookId = '$BookId'";
                $stockResult = mysqli_query($con, $searchStock);
                if(mysqli_num_rows($stockResult) > 0){
                    $stockQueryFetch = mysqli_fetch_assoc($stockResult);
                    $currentQuantity = (int)$stockQueryFetch['Quantity'] + $Quantity;
                    $stockUpdate = "UPDATE `stock` SET `Quantity`='$currentQuantity',`UnitPrice`='$SellUnitPrice',`UpdatedDate`='$currentDate' 
                                    WHERE BookId = '$BookId'";
                    mysqli_query($con, $stockUpdate);
                }
                else{
                    $stockInsert = "INSERT INTO `stock`(`BookId`, `Quantity`, `UnitPrice`, `UpdatedDate`) 
                                    VALUES ('$BookId','$Quantity','$SellUnitPrice','$currentDate')";
                    mysqli_query($con, $stockInsert);
                }

            }
            echo json_encode(true);
        }
        else{
            echo json_encode(false);
        }

        
    }

?>