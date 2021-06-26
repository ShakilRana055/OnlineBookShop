<?php
    // database connection
    include("../../connection/DatabaseConnection.php");


    if(isset($_POST['UpdateStatus'])){
        try 
        {
            $LevelName = $_POST['LevelName'];
            $id = $_POST["Id"];

            $sql = "UPDATE invoice SET Status = '$LevelName' WHERE `Id` = '$id'";
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

