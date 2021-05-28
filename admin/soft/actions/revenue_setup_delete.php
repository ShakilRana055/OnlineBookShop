<?php session_start( ) ;?>
<?php 
    
    include ( "../../config/db_connection.php") ;

    if( isset( $_GET['delete'] ) ) 
    {
        $id = $_GET['delete'] ;
        $query = "update project_revenue set IS_DELETED = 1 where PROJECT_REVENUE_NO = '$id'" ;

        $result = mysqli_query( $con , $query ) ;
        if( $result ) 
        {
            $_SESSION['msgPositive'] = "success" ;
            header( "location: ../project_revenue_setup.php" ) ;
        }
        else
        {
            $_SESSION['msgPositive'] = "error" ;
            header( "location: ../project_revenue_setup.php" ) ;
        }
    }


?>