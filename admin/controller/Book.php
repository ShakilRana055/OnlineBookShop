<?php
    // database connection
    include("../../connection/DatabaseConnection.php");

    if(isset($_POST['save'])){
        try 
        {
            $Name = $_POST['Name'];
            $WarningQuantity = $_POST['WarningQuantity'];
            $Description = $_POST['Description'];
            $AuthorId = $_POST['AuthorId'];
            $CategoryId = $_POST['CategoryId'];
            $SubCategoryId = $_POST['SubCategoryId'];
            $PublicationId = $_POST['PublicationId'];

            $PhotoUrl = '';
            $Photo = $_FILES["Photo"]["name"];
            $photoName = explode(".", basename($Photo));
            $convertedPhotoName = '';
            
            if($Photo != null){
                $convertedPhotoName = time()."book.".$photoName[1];
                $PhotoUrl = "../../public/image/".$convertedPhotoName;
            }
            
            $sql = "INSERT INTO `books`(`Name`, `WarningQuantity`, `PhotoUrl`, `Description`, `AuthorId`, `CategoryId`, `SubCategoryId`, `PublicationId`, `CreatedDate`) 
                    VALUES ('$Name', '$WarningQuantity', '$PhotoUrl', '$Description', '$AuthorId', '$CategoryId', '$SubCategoryId', '$PublicationId', '$currentDate')";
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
            $id = $_POST['Id'];
            $Name = $_POST['Name'];
            $WarningQuantity = $_POST['WarningQuantity'];
            $Description = $_POST['Description'];
            $AuthorId = $_POST['AuthorId'];
            $CategoryId = $_POST['CategoryId'];
            $SubCategoryId = $_POST['SubCategoryId'];
            $PublicationId = $_POST['PublicationId'];

            $PhotoUrl = '';
            $Photo = $_FILES["Photo"]["name"];
            $photoName = explode(".", basename($Photo));
            $convertedPhotoName = '';
            $sql = '';
            
            if($Photo != null){
                $convertedPhotoName = time()."book.".$photoName[1];
                $PhotoUrl = "../../public/image/".$convertedPhotoName;

                $sql = "UPDATE `books` SET `Name`= '$Name',`WarningQuantity`= '$WarningQuantity',`PhotoUrl`='$PhotoUrl',
                `Description`= '$Description',`AuthorId`='$AuthorId',`CategoryId`='$CategoryId',
                `SubCategoryId`= '$SubCategoryId',`PublicationId`='$PublicationId' WHERE `Id` = '$id'";
            }
            else {
                $sql = "UPDATE `books` SET `Name`= '$Name',`WarningQuantity`= '$WarningQuantity',
                `Description`= '$Description',`AuthorId`='$AuthorId',`CategoryId`='$CategoryId',
                `SubCategoryId`= '$SubCategoryId',`PublicationId`='$PublicationId' WHERE `Id` = '$id'";
            }
            $result = mysqli_query($con, $sql);

            if($result != null){
                if($PhotoUrl != null){
                    move_uploaded_file( $_FILES['Photo']['tmp_name'] , $PhotoUrl);
                }
                header('Location: ../views/bookList.php');
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
            $sql = "DELETE FROM `books` WHERE `Id` = '$id'";
            $result = mysqli_query($con, $sql);
            if($result != null){
                echo json_encode(true);
            }
            else{
                echo json_encode($sql);
            }
        } 
        catch (Throwable $th) {
            echo json_encode($th);
        }
    }
?>

