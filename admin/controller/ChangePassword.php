<?php
    session_start();
    
    // database connection
    include("../../connection/DatabaseConnection.php");

    if(isset($_POST['Update'])){
        try 
        {
            $password = md5($_POST['NewPassword']);
            $userId = $_SESSION['user']['Id'];

            $sql = "UPDATE `users` SET `Password`= '$password' WHERE `Id` = '$userId'";
            //echo $sql;
            $result = mysqli_query($con , $sql);
            if($result != null){
                echo json_encode(true);
            }
            else{
                echo json_encode(false);
            }
        } 
        catch (Throwable $th) {
            echo json_encode($th);
        }
    }
?>

