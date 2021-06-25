<?php 
    include("../../connection/DatabaseConnection.php");
    if(isset($_GET['search'])){
        try 
        {
            $today = date('Y-m-d');
            $month = date('n');
            $year = date('Y');
            $day = date('d');

            $initialThisMonth = $year.'-'.$month."-1";

            $days = $sales = $purchase = array();

            for($i = 1; $i <= $day; $i++){
                
                $sqlQuery = "SELECT Round(SUM(GrandTotal)) GrandTotal
                            FROM purchase
                            WHERE PurchaseDate = '$initialThisMonth'";
                $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
                
                $days[] = $i; //$initialThisMonth;
                $purchase[] = $queryResult['GrandTotal']; //number_format($queryResult['GrandTotal'], 2, '.', ',');


                $sqlQuery = "SELECT Round(SUM(GrandTotal)) GrandTotal 
                            FROM invoice WHERE InvoiceDate = '$initialThisMonth'";
                $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));

                $sales[] = $queryResult['GrandTotal'];// number_format($queryResult['GrandTotal'], 2, '.', ',');

                $initialThisMonth = $year.'-'.$month."-".($i+1);
            }

            $jsonData = array(
                "days"            => $days,
                "purchase"        => $purchase,
                "sales"           => $sales
                );
            echo json_encode($jsonData);
        } 
        catch (Throwable $th) {
            echo json_encode(false);
        }
    }

?>