<?php session_start( ) ;?>
<?php

    
    if( isset ( $_GET['delete'] ))
    {
        include ( "../../config/db_connection.php") ;
        $delete_it = $_GET['delete'] ;
        $query = "update member_profiles set IS_DELETED = '1' where PROFILE_NO = '$delete_it' " ;
        $result = mysqli_query( $con , $query ) ;
        if( $result )
        {
            $_SESSION['msgPositive'] = "success" ;
            header("location: ../approved_members.php") ;
        }
        else
        {
            $_SESSION['msgPositive'] = "error" ;
            header("location: ../approved_members.php") ;
        }
    }



?>