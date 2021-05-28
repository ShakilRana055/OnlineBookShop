

<?php
	session_start();
	include_once '../connections/db_connection.php' ;

	if( isset( $_GET[ 'delete' ] ) )
	{

		$id = $_GET['delete'] ;
		//echo $id ;
		$query = "delete from ledger_for_user where LEDGER_FOR_NO = '$id' " ;
		//echo $query ;
		if( mysqli_query( $con , $query ) )
		{
			$_SESSION['mgs'] = "Ledger Deleted Successfully!";
            $_SESSION['class'] = "green_color alert alert-success col-md-6 alert-dismissable";
			header('Location:../ledger.php'); 
		}
		else
		{
			$_SESSION['mgs'] = "Ledger Deleted Failed!";
            $_SESSION['class'] = "red_color alert alert-success col-md-6 alert-dismissable";
			header('Location:../ledger.php'); 
		} 
	}



?>