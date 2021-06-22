<?php
session_start();
include("../../connection/DatabaseConnection.php");

if(isset($_POST['save'])){
    try 
    {
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Phone = $_POST['Phone'];
        $Address = $_POST['Address'];
        $Password = md5($_POST['Password']);
        $Division = $_POST['Division'];
        $outSideCity = $Division == "Dhaka Division" ? '1' : '0';
        
       
        $sql = "INSERT INTO `users`(`Name`, `Email`, `Phone`, `Address`, `Password`, `PhotoUrl`, `UserType`, `CreatedDate`, `OutsideCity`) 
        VALUES ('$Name','$Email','$Phone','$Address','$Password', '', 'Customer', '$currentDate',  '$outSideCity')";

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