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
            $UserType = "Supplier";

            $PhotoUrl = '';

            $sql = "INSERT INTO `users`(`Name`, `Email`, `Phone`, `Address`,`PhotoUrl`, `UserType`, `CreatedDate`) 
                    VALUES ('$Name','$Email','$Phone','$Address','$PhotoUrl','$UserType','$currentDate',)";
            
            //$image = time().trim( $_FILES['image']['name'] );
            //$target = "image/".basename($image);
            //$member_no1 = mysqli_insert_id( $con ) ;
            //move_uploaded_file( $_FILES['image']['tmp_name'] , $target ) ;

            $result = mysqli_query($con , $sql);
            if($result != null){
                echo true;
            }
            else{
                echo false;
            }
        } 
        catch (Throwable $th) {
            echo false;
        }
        
    }

?>

