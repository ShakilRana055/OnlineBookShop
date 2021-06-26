<?php
    // database connection
    include("../../connection/DatabaseConnection.php");


    if(isset($_GET['search'])){
        try 
        {
            $bookName = $quantity = array();
            $sql = "SELECT bk.Name, bk.PhotoUrl, SUM(Quantity) Quantity
                    FROM invoicedetail inv 
                    INNER JOIN books bk ON bk.Id = inv.BookId
                    GROUP BY bk.Name, bk.PhotoUrl
                    ORDER BY Quantity DESC LIMIT 10";
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $bookName[] = $row['Name'];
                $quantity[] = $row['Quantity'];
            }
            $json_data = array(
                "bookName"            => $bookName,
                "quantity"            => $quantity,
            );
            echo json_encode($json_data);
        } 
        catch (Throwable $th) {
            echo json_encode($th);
        }
    }
?>

