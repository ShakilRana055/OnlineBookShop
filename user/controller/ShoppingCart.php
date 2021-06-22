<?php
session_start();
include('../../connection/DatabaseConnection.php');

if(isset($_GET['search']))
{
    $userId = $_SESSION['customer']['Id'];
    if($_GET['search'] == "shoppingCart"){
    
        $sql = "SELECT tmp.`BookId`,tmp.`Quantity`, bk.Name BookName, bk.PhotoUrl, st.UnitPrice, st.Quantity StockQuantity
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
    else if($_GET['search'] == "stock"){}
}
?>