<?php session_start();
include ( "../../config/db_connection.php") ;
if(isset($_GET['member_no'])){
$member_no = $_GET['member_no'];
$sql = "update member_profiles set IS_BLOCKED=1 where MEMBER_NO='$member_no'";
if(mysqli_query($con,$sql)){
    $_SESSION['msgPositive'] = "success" ;
    header("location: ../block_a_member.php");
}
}

if(isset($_GET['block_member_no'])){
$block_member_no = $_GET['block_member_no'];
$sql = "update member_profiles set IS_BLOCKED=0 where MEMBER_NO='$block_member_no'";
if(mysqli_query($con,$sql)){
    $_SESSION['msgPositive'] = "success" ;
    header("location: ../block_a_member.php");
}
}

?>