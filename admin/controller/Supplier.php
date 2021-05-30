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
            
            //$image = time().trim( $_FILES['image']['name'] );
            //$target = "image/".basename($image);
            //$member_no1 = mysqli_insert_id( $con ) ;
            //move_uploaded_file( $_FILES['image']['tmp_name'] , $target ) ;

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

