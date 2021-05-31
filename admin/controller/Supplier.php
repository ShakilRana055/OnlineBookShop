<?php
    // database connection
    include("../../connection/DatabaseConnection.php");

    if(isset($_POST['save'])){
        try 
        {
            $Name = $_POST['Name'];
            $Email = $_POST['Email'];
            $Phone = $_POST['Phone'];
            $Address = $_POST['Address'];
            $CompanyName = $_POST['CompanyName'];
            $Designation = $_POST['Designation'];

            $PhotoUrl = '';

            $sql = "INSERT INTO `supplier`(`Name`, `Email`, `Phone`, `Address`,`PhotoUrl`,`CompanyName`, `Designation`, `CreatedDate`) 
                    VALUES ('$Name','$Email','$Phone','$Address','$PhotoUrl', '$CompanyName','$Designation','$currentDate')";

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
            $Email = $_POST['Email'];
            $Phone = $_POST['Phone'];
            $Address = $_POST['Address'];
            $CompanyName = $_POST['CompanyName'];
            $Designation = $_POST['Designation'];
            $id = $_POST['Id'];
            $PhotoUrl = '';

            $sql = "UPDATE `supplier` SET `Name`= '$Name',`Phone`= '$Phone',`Email`= '$Email',`Address`= '$Address',
                    `PhotoUrl`= '$PhotoUrl',`CompanyName`= '$CompanyName',`Designation`= '$Designation' WHERE `Id` = '$id'";
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
            $sql = "DELETE FROM `supplier` WHERE `Id` = '$id'";
            $result = mysqli_query($con, $sql);
            if($result != null){
                echo json_encode(true);
            }
            else{
                echo json_encode(false);
            }
        } 
        catch (\Throwable $th) {
            echo json_encode(false);
        }
    }
?>

