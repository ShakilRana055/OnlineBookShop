<?php

    if( isset( $_POST['member'] ) ) 
    {
        include ( "../../config/db_connection.php") ;
        $id = $_POST['value'] ;
        $query = "SELECT MEMBER_ID FROM member_profiles WHERE MEMBER_ID = '$id' " ;
        $result = mysqli_num_rows ( mysqli_query( $con , $query ) ) ;
        //echo "check" ;
        if( $result > 0 )
        {
            echo 1 ;
        }
        else
        {
            echo 0 ;
        }
        
    }
    if( isset ( $_POST['mobile'] ) ) 
    {
         include ( "../../config/db_connection.php") ;
         $mobile = $_POST['value'] ;
         $query = "SELECT MOBILE FROM member_profiles WHERE MOBILE = '$mobile' " ;
         $result = mysqli_num_rows ( mysqli_query( $con , $query ) ) ;
        if( $result > 0 )
        {
            echo 1 ;
        }
        else
        {
            echo 0 ;
        }
    }
    


?>