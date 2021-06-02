<?php
    // database connection
    include("../../connection/DatabaseConnection.php");

    if(isset($_POST['save'])){
        try 
        {
            $Name = $_POST['Name'];

            $sql = "INSERT INTO `category`(`Name`, `CreatedDate`) 
                    VALUES ('$Name', '$currentDate')";
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

    if(isset($_POST['Update'])){
        try 
        {
            $Name = $_POST['Name'];
            $id = $_POST["Id"];
            $sql = "UPDATE `category` SET `Name`= '$Name' WHERE `Id` = '$id'";
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

    if(isset($_GET['search'])){
        try 
        {
            $id = $_GET['search'];
            $sql = "DELETE FROM `category` WHERE `Id` = '$id'";
            $result = mysqli_query($con, $sql);
            if($result != null){
                echo json_encode(true);
            }
            else{
                echo json_encode(false);
            }
        } 
        catch (Throwable $th) {
            echo json_encode(false);
        }
    }
?>

