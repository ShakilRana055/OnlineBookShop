<?php
session_start();
include("../../connection/DatabaseConnection.php");
$userId = $_SESSION['customer']['Id'];

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

if(isset($_POST['Update'])){
    try 
    {
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Phone = $_POST['Phone'];
        $Password = md5($_POST['Password']);
        $Address = $_POST['Address'];
        $Division = $_POST['Division'];
        $outSideCity = $Division == "Dhaka Division" ? '1' : '0';
        
       $sql = '';
       if($Password != ''){
            $sql = "UPDATE `users` SET `Name`='$Name',`Phone`='$Phone',`Address`='$Address',`OutsideCity`='$outSideCity',`Password`= '$Password' WHERE Id = '$userId'";
        }
       else{
            $sql = "UPDATE `users` SET `Name`='$Name',`Phone`='$Phone',`Address`='$Address',`OutsideCity`='$outSideCity' WHERE Id = '$userId'";
        }

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