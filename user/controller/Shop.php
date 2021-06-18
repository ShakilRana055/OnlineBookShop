<?php
session_start();
include('../../connection/DatabaseConnection.php');

if(isset($_GET['search']))
{
    $bookId = $_GET['search'];
    // first check if session user exist

    if($_SESSION['customer']['Id'] == '')
        echo "login";
    else if($_SESSION['customer']['Id'] != '')
    {
        $userId = $_SESSION['customer']['Id'];
        $existCheck = "SELECT * FROM `temporder` WHERE `UserId` = '$userId' AND BookId = '$bookId'";
        $exist = mysqli_query($con, $existCheck);

        if($exist)
        {
            echo "exist";
        }
        else{
            // Inserting new row
            $sql = "INSERT INTO `temporder`(`UserId`, `BookId`, `Quantity`, `CreatedDate`) 
                    VALUES ('$userId', '$bookId', '1', '$currentDate')";
            $result = mysqli_query($con, $sql);
            $result ? "success" : "error";
        }
    }
}

?>