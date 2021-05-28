<?php 

	include_once '../connections/db_connection.php' ;


	if( isset( $_GET[ 'del'] ) ) 
	{
		
		$new_id = $_GET['del'] ;
		
		$query = "delete from account_groups where ACC_GROUP_NO = '$new_id' " ;
		//echo $query ;
		if( mysqli_query( $con , $query ) ) 
		{
			$_SESSION['mgs'] = "Accounts Group Deleted Successfully!";
            $_SESSION['class'] = "green_color alert alert-success col-md-6 alert-dismissable";
			header("location: ../account_groups.php") ;
		}
		else
		{
			$_SESSION['mgs'] = "Accounts Group Delete Failed!";
            $_SESSION['class'] = "red_color alert alert-success col-md-6 alert-dismissable";
			header("location: ../account_groups.php") ;
		}
	}


?>