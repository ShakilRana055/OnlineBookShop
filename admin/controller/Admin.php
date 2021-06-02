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
            $Password = md5($_POST['Password']);
            
            $PhotoUrl = '';
            $Photo = $_FILES["Photo"]["name"];
            $photoName = explode(".", basename($Photo));
            $convertedPhotoName = '';
            
            if($Photo != null){
                $convertedPhotoName = time()."admin.".$photoName[1];
                $PhotoUrl = "../public/image/".$convertedPhotoName;
            }
            
            $sql = "INSERT INTO `users`(`Name`, `Email`, `Phone`, `Address`, `Password`, `PhotoUrl`, `UserType`, `CreatedDate`) 
            VALUES ('$Name','$Email','$Phone','$Address','$Password', '$PhotoUrl', 'Admin', '$currentDate' )";

            $result = mysqli_query($con , $sql);
            if($result != null){
                if($PhotoUrl != null){
                    move_uploaded_file( $_FILES['Photo']['tmp_name'] , $PhotoUrl);
                }
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
            $Phone = $_POST['Phone'];
            $Address = $_POST['Address'];
            $id = $_POST['Id'];

            $PhotoUrl = '';
            $Photo = $_FILES["Photo"]["name"];
            $photoName = explode(".", basename($Photo));
            $convertedPhotoName = '';
            $sql = '';
            
            if($Photo != null){
                $convertedPhotoName = time()."admin.".$photoName[1];
                $PhotoUrl = "../public/image/".$convertedPhotoName;
                $sql = "UPDATE `users` SET `Name`='$Name',`Phone`='$Phone',`Address`='$Address', `PhotoUrl` = '$PhotoUrl' WHERE `Id` = '$id'";
            
            }
            else {
                $sql = "UPDATE `users` SET `Name`='$Name',`Phone`='$Phone',`Address`='$Address' WHERE `Id` = '$id'";
            }
            $result = mysqli_query($con, $sql);

            if($result != null){
                if($PhotoUrl != null){
                    move_uploaded_file( $_FILES['Photo']['tmp_name'] , $PhotoUrl);
                }
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
            $sql = "DELETE FROM `users` WHERE `Id` = '$id'";
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

