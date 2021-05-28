<?php

    
    include ( "../../config/db_connection.php") ;
    $profile_no = $_GET['profile_no'] ;
    $query = "update member_profiles set IS_APPROVED = '1' where PROFILE_NO = '$profile_no'";
	mysqli_query( $con , $query ) ;
    header("Location: ../waiting_for_approval.php"); 
?>