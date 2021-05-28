<?php session_start( ) ;?>

<?php 
include ( "../../config/db_connection.php") ;
$member_no = $_GET['member_no'];
$project_no = $_GET['project_no'];

$sql = "update projects set IS_DELETED=1 WHERE PROJECT_NO='$project_no' AND RESPONSIBLE_MEMBER_NO='$member_no'";
if(mysqli_query($con,$sql)){
    $_SESSION['msgPositive'] = "success" ;
    header("Location: ../project_setup.php");
}


?>