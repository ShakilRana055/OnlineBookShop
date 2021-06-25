<?php
session_start();
include('../../connection/DatabaseConnection.php');
include('../../admin/controller/AutoGenerate.php');

include('InvoiceStatus.php');


$userId = $_SESSION['customer']['Id'];

if(isset($_GET['search']))
{
    if($_GET['search'] == "shoppingCart"){
    
        $sql = "SELECT tmp.Id, tmp.`BookId`,tmp.`Quantity`, bk.Name BookName, bk.PhotoUrl, st.UnitPrice, st.Quantity StockQuantity
            FROM temporder tmp
            INNER JOIN books bk ON bk.Id = tmp.BookId
            INNER JOIN stock st ON st.BookId = tmp.BookId
            WHERE tmp.UserId = '$userId' ORDER BY tmp.Id DESC";

        $result = mysqli_query($con, $sql);
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        echo json_encode($data);
    }
    else if($_GET['search'] == "purchaseConfirmed"){
        
    }
    else // remove from tempOrder
    {
        $cartId = $_GET['search'];
        $sql = "DELETE FROM `temporder` WHERE Id = '$cartId'";
        $result = mysqli_query($con, $sql);
        echo $result ? json_encode(true) : json_encode(false);
    }
}

if(isset($_POST['updateQuantity']))
{
    $bookId = $_POST['bookId'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE `temporder` SET `Quantity`= '$quantity',`CreatedDate`= '$currentDate' WHERE BookId = '$bookId' AND UserId = '$userId'";
    $result = mysqli_query($con, $sql);
    echo $result ? json_encode(true) : json_encode(false);
}
if(isset($_POST['confirmPurchase']))
{
    $deliveryCharge = $_POST['DeliveryCharge'];
    $grandTotal = $_POST['GrandTotal'];
    $subTotal = $_POST['SubTotal'];
    $paymentMode = $_POST['PaymentMode'];

    $sql = "SELECT InvoiceNumber FROM invoice ORDER BY Id DESC LIMIT 1";
    $queryResult = mysqli_query($con, $sql);
    $invoiceNumber = '';
    if(mysqli_num_rows($queryResult) > 0){
        $result = mysqli_fetch_assoc($queryResult);
        $invoiceNumber = AutoGenerate::InvoiceNumber($result['InvoiceNumber'], "INV-");
    }
    else{
        $invoiceNumber = AutoGenerate::InvoiceNumber("0", "INV-");
    }

    // pushing into invoice 
    $pending = Status::Pending();
    $invoiceInsert = "INSERT INTO `invoice`( `InvoiceNumber`, `UserId`, `InvoiceDate`, `GrandTotal`, `SubTotal`, `Discount`, `DeliveryCharge`, `PaymentMode`, `Status`, `CreatedDate`) 
                        VALUES ('$invoiceNumber','$userId','$currentDate','$grandTotal','$subTotal',0,'$deliveryCharge','$paymentMode','$pending','$currentDate')";
    mysqli_query($con, $invoiceInsert);
    $lastId = mysqli_insert_id($con);


    $tempOrderQuery = "SELECT tmp.*, st.UnitPrice 
                        FROM `temporder` tmp
                        INNER JOIN stock st ON st.BookId = tmp.BookId 
                        WHERE `UserId` = '$userId'";

    $tempOrderList = mysqli_query($con, $tempOrderQuery);
    while($row = mysqli_fetch_assoc($tempOrderList)){
        $bookId = $row['BookId'];
        $id = $row['Id'];
        $quantity = $row['Quantity'];
        $unitPrice = $row['UnitPrice'];

        $totalPrice = $unitPrice * $quantity;

        $invoiceDetailInsert = "INSERT INTO `invoicedetail`(`InvoiceId`, `BookId`, `Quantity`, `UnitPrice`, `SellTax`, `TotalPrice`, `CreatedDate`) 
        VALUES ('$lastId','$bookId','$quantity','$unitPrice',0,'$totalPrice','$currentDate')";

        mysqli_query($con, $invoiceDetailInsert);

        // stock decrement

        $stockQuery = "UPDATE stock SET Quantity = Quantity - '$quantity', UpdatedDate = '$currentDate' 
                        WHERE Quantity > 0 AND Quantity >= '$quantity' AND BookId = '$bookId'";
        mysqli_query($con, $stockQuery);
    }

    // delete from temp order
    $tempOrderDelete = "DELETE FROM `temporder` WHERE UserId = '$userId'";
    mysqli_query($con, $tempOrderDelete);
    echo json_encode(true);
}
?>