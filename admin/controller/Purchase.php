<?php
    include("../../connection/DatabaseConnection.php");
    include("AutoGenerate.php");

    if(isset($_GET['search'])){
        $sql = "SELECT InvoiceNumber FROM purchase ORDER BY Id DESC LIMIT 1";
        $queryResult = mysqli_query($con, $sql);

        if(mysqli_num_rows($queryResult) > 0 ){
            $row = mysqli_fetch_assoc($queryResult);
            echo json_encode(AutoGenerate::InvoiceNumber($row['InvoiceNumber'], "PUR-"));
        }
        else{
            echo AutoGenerate::InvoiceNumber("0", "PUR-");
        } 
    }

?>